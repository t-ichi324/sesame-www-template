var modal_id_val = null;
const modal = {
    open: function (options){
        if(!options.id){options.id = 'ac-modal'; }
        if(!options.backdrop){ options.backdrop = 'true'; } // true / false / static
        if(!options.title){ options.title = ''; }
        if(!options.body){ options.body = ''; }
        if(!options.width){ options.width = ''; }
        if(!options.callback){ options.callback = null; }
        modal_id_val = options.id;
        var $s = $("#"+modal_id_val);
        if($s.length == 0){ 
            $("body").append("<div class='modal hide fade' data-backdrop='static' id='"+modal_id_val+"' tabindex='-1' role='dialog' aria-hidden='true'>"
            + "<div class='modal-dialog' role='document'><div class='modal-content'><div class='modal-header'>"
            + "<h5 class='modal-title'></h5><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>"
            + "</div><div class='modal-body'></div></div></div></div>"
            );
            $s = $("#"+modal_id_val);
        }
        $s.data('backdrop', options.backdrop);
        $s.find(".modal-title").html(options.title);
        $s.find(".modal-body").html(options.body);
        $('#'+modal_id_val+' .modal-dialog').css("max-width", options.width);        
        if(options.callback != null){eval(options.callback);}
        $s.modal();
    },
    close: function(){if(modal_id_val == null){ return; }  $("#"+modal_id_val).modal('hide'); },
    title: function(args){
        if(args == undefined){
            return $('#'+modal_id_val+' ,modal-title').text();
        }else{
            $('#'+modal_id_val+' ,modal-title').html(args);
        }
    },
    body: function(args){
        if(args == undefined){
            return $('#'+modal_id_val+' ,modal-title').text();
        }else{
            $('#'+modal_id_val+' ,modal-title').html(args);
        }
    }
};

$(document).on('click','a.iframe-modal', function(e){
    e.preventDefault();
    var url = $(this).attr('href');
    var title = $(this).data('title');
    var backdrop = $(this).data('backdrop');
    var width = $(this).data('width');
    var height = $(this).data('height');
    if(height == undefined || height == ""){ height = "80vh" }
    if(title == undefined || title == ""){ title = $(this).text(); }
    var tag = "<iframe frameborder='0' style='overflow:auto;border:0;width:100%;height:"+height+"' allowfullscreen src='"+url+"'></iframe>";
    modal.open({title:title, body:tag, backdrop: backdrop, width:width});
    return false;
});
$(document).on('click','a.ajax-modal', function(e){
    e.preventDefault();
    var url = $(this).attr('href');
    var title = $(this).data('title');
    var backdrop = $(this).data('backdrop');
    var width = $(this).data('width');
    if(title == undefined || title == ""){ title = $(this).text(); }
    ajax.callbackGet(url, 'text', function(ret, error){
        var hasRet = ((error == undefined || error == null) && ret != undefined);
        if(hasRet){
            modal.open({title:title, body:ret, backdrop: backdrop, width:width}); }
        else{
            modal.open({title:title, body:error, backdrop: backdrop, width:width}); }
        }
    );
    return false;
});
$(document).on('submit','form.ajax-modal-form', function(e){
    var target = $(this).data('ajax-target');
    var callback = $(this).data('ajax-callback');
    if(target == undefined || target == ""){
        target = $(this).closest('.modal-body');
    }
    e.preventDefault();
    ajax.replaceForm($(this), target, function(){
        if(callback != undefined && callback != ''){
            eval(callback);
        }
    });
    return false;
});
