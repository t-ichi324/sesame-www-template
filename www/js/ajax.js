const ajax ={
    // callback ---
    callback: function (url, data, dataType, callback, method){
        if(dataType == undefined || dataType == null){ dataType = 'json'; }
        if(method == undefined || method == null){ method = 'post'; }
        $.ajax({
            type: method,
            url: url,
            data: data,
            dataType: dataType,
            xhrFields: {
              withCredentials: true
           }
        })
        .done(function (ret) {
          callback(ret);
        })
        .fail(function (ret, error) {
          callback(null, error);
        });
    },
    callbackGet: function (url, dataType, callback){
        ajax.callback(url, null, dataType, callback, 'get');
    },
    callbackPost: function (url, data, dataType, callback){
        ajax.callback(url, data, dataType, callback, 'post');
    },
    callbackForm: function($form, dataType, callback){
        var url = $form.attr('action');
        var method = $form.attr('method');
        var data = $form.serialize();
        ajax.callback(url, data, dataType, callback, method);
    },
    
    // replace ---
    replace: function (url, data, target, callback, method){
        ajax.callback(url, data, 'html', function(ret, error){
            var hasRet = ((error == undefined || error == null) && ret != undefined);
            if(target instanceof jQuery){
                if(hasRet){ target.html(ret); }else{ target.html(''); }
            }else{
                if(hasRet){ $(target).html(ret); }else{ $(target).html(''); }
            }
            if(callback != undefined || callback != null){ callback(); }
        }, method);
    },
    replaceGet: function (url, target, callback){
        ajax.replace(url, null, target, callback, 'get');
    },
    replacePost: function (url, data, target, callback){
        ajax.replace(url, data, target, callback, 'post');
    },
    replaceForm: function ($form, target, callback){
        var url = $form.attr('action');
        var method = $form.attr('method');
        var data = $form.serialize();
        ajax.replace(url, data, target, callback, method);
    },
    
    // get post form
    get: function (url, callback){
        ajax.callbackGet(url, 'text', callback);
    },
    post: function (url, data, callback){
        ajax.callbackPost(url, data, 'text', callback);
    },
};


(function($){
    $.fn.ajaxLoad = function(callback){
        var url = this.attr('ajax-load');
        if(url == null || url == undefined){ return this; }
        var callback_fnc = this.data('ajax-callback');
        var $target = this;
        ajax.replaceGet(url, $target, function(){
            if(callback_fnc != undefined && callback_fnc != ''){ eval(callback_fnc); }
            if(callback != undefined || callback != null){ callback(); }
        });
        return this;
    }
})(jQuery);
$(document).ready(function(){
    $('[ajax-load]').each(function(){ var auto = $(this).attr('ajax-load-auto'); if(auto == undefined || auto == 'on' || auto == 'true'){ $(this).ajaxLoad(); }});
});

$(document).on('submit','form.ajax-form', function(e){
    var target = $(this).data('ajax-target');
    var callback = $(this).data('ajax-callback');
    if(target == undefined || target == ''){
        target = "body";
    }
    if($(target).length == 0){ return true;}
    e.preventDefault();
    ajax.replaceForm($(this), target, function(){
        if(callback != undefined && callback != ''){
            eval(callback);
        }
    });
    return false;
});

$(document).on('click','a.ajax-replace', function(e){
    var url = $(this).attr('href');
    var target = $(this).data('ajax-target');
    var callback = $(this).data('ajax-callback');
    if(target == undefined || target == ""){
        target = "body";
    }
    if($(target).length == 0){ return true; }
    e.preventDefault();
    ajax.replaceGet(url, target, function(){
        if(callback != undefined && callback != ''){
            eval(callback);
        }
    });
    return false;
});
