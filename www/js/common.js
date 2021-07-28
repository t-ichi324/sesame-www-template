function isEmpty(v){
    if (v == null || v === undefined){ return true; }
    if(v instanceof jQuery){
        return (v.length == 0);
    }else if(v == ''){
        return true;
    }
    return false;
}

/*
function checkedLabelCss($c){
    if($c.attr('type') == 'radio'){ $c.closest('form').find('label>input[name='+$c.attr('name')+']').each(function(){ $(this).closest("label").removeClass("active"); }); }
    if($c.prop("checked")){ $c.closest("label").addClass("active");
    }else{ $c.closest("label").removeClass("active"); }
}
$(document).on('change', "label>input[type='checkbox']", function(){ checkedLabelCss($(this)); });
$(document).on('change', "label>input[type='radio']", function(){ checkedLabelCss($(this)); });
*/

function patternOfKeypress(e, ptn){
    if(isEmpty(ptn) || e == null){ return true; }
    var c = String.fromCharCode(e.which);
    if(c.match(new RegExp('[' + ptn + ']'))==null){ return false; }
    return true;
}
function patternOfChange(obj, ptn){
    if(isEmpty(ptn) || obj == null || obj.value == null){ return; }
    obj.value = obj.value.replace(new RegExp('[^' + ptn + ']', 'g'), '');
}
function patternOfSubmit(obj, ptn){
    if(isEmpty(ptn) || obj == null){ return; }
    $j = $(obj); if(isEmpty($j.attr('pattern'))){ $j.attr('pattern', ptn); }
}
$(document).on('keypress','input[valid-pattern]', function(e) { return patternOfKeypress(e, $(this).attr('valid-pattern')); });
$(document).on('change',  'input[valid-pattern]', function(){ patternOfChange(this, $(this).attr('valid-pattern')); });
$(document).on('keypress','input[valid=auth]', function(e){ return patternOfKeypress(e, "0-9a-zA-Z@\\.\\-"); });
$(document).on('change',  'input[valid=auth]', function(){ patternOfChange(this, "0-9a-zA-Z@\\.\\-"); });
$(document).on('keypress','input[valid=number]', function(e){ return patternOfKeypress(e, "0-9"); });
$(document).on('change',  'input[valid=number]', function(){ patternOfChange(this, "0-9"); });
$(document).on('keypress','input[valid=alpha]', function(e){ return patternOfKeypress(e, "a-zA-Z"); });
$(document).on('change',  'input[valid=alpha]', function(){ patternOfChange(this, "a-zA-Z"); });
$(document).on('keypress','input[valid=alpha-number]', function(e){ return patternOfKeypress(e, "a-zA-Z0-9"); });
$(document).on('change',  'input[valid=alpha-number]', function(){ patternOfChange(this, "a-zA-Z0-9"); });

$(document).on('keypress','input[valid=tel]', function(e){ return patternOfKeypress(e, "0-9\\-"); });
$(document).on('change',  'input[valid=tel]', function(){ patternOfChange(this, "0-9\\-"); patternOfSubmit(this, "\\d{2,4}-\\d{3,4}-\\d{3,4}"); });
$(document).on('keypress','input[valid=zipcode]', function(e){ return patternOfKeypress(e, "0-9\\-"); });
$(document).on('change',  'input[valid=zipcode]', function(e){ patternOfChange(this, "0-9\\-"); patternOfSubmit(this, "\\d{3}-\\d{4}"); });


$(document).on('click', 'table.asortable thead th[data-key]', function(){
    var key = $(this).data('key');
    var desc = $(this).data('desc');
    var f = $(this).closest('form');
    if(isEmpty(f)){ return; }
    
    var $t1 = f.find('input[name="sort"]');
    var $t2 = f.find('input[name="sort"]');
    if($t1.length == 0){
        f.append('<input type="hidden" name="sort" value="'+key+'">');
    }else{
        $t1.val(key);
    }
    if($t2.length == 0){
        if(!isEmpty(desc)){ f.append('<input type="hidden" name="desc" value="'+desc+'">'); }
    }else{
        if(!isEmpty(desc)){ $t2.val(desc); }
    }
    f.submit();
});

$(document).ready(function(){
    $('a.check-head').each(function(){
        var $a = $(this);
        var u = $a.attr('href');
        if(u == '' || u == '#') return;
        $.ajax({
            type: 'head', url: u
        })
        .done(function () {
            $a.removeClass('disabled');
        })
        .fail(function () {
            $a.addClass('disabled', 'disabled').attr('href','#').attr('orginal-href', u);
        });
    });
});

function renameListIndex(index, $row_selector){
    $row_selector.find('input,select,textarea').each(function(){
        var n = $(this).attr('name');
        if(!isEmpty(n)){
            $(this).attr("name",n.replace('[]', '['+index+']')); 
        }
    });
}