<?php
    $flgCss = Model::get("asyncUpload-flag-css", true);
    $flgJs = Model::get("asyncUpload-flag-js", true);
    
    $parts = Model::get("asyncUpload--parts");
    $src = $parts["src"];
    $pname = $parts["pname"];
    $pval = $parts["pval"];
    $tname = $parts["tname"];
    $tval = $parts["tval"];
    $class = $parts["class"];
    $empty = $parts["empty"];
    
    $areaId = "asyncUploadParts-" . $tname;
    
    Model::set("asyncUpload-flag-css", false);
    Model::set("asyncUpload-flag-js", false);
?>
{{@sec css}}
<?php if($flgJs){ ?><link rel="stylesheet" href="{{/css/asyncUpload.css}}"/><?php } ?>
{{@endsec}}

<div class="{{$class}}" id="{{$areaId}}" data-name="{{$tname}}" data-maxsize="{{Env::max_size_uploads()}}" data-allows="gif,jpg,jpeg,png,svg">
    <span class="{{$class}}-thumb-clear">&times;</span>
    <img class="{{$class}}-thumb" id="{{$areaId}}-thumb" src="{{$src}}" data-empty="{{$empty}}" onerror="this.onerror=null; this.src=this.getAttribute('data-empty');" alt="No Image" />
    <input type="hidden" id="{{$areaId}}-val" name="{{$tname}}" value="{{$tval}}" />
    <input type="hidden" id="{{$areaId}}-org" name="{{$pname}}" value="{{$pval}}" />
</div>

{{@sec js}}
<?php if($flgJs){ ?><script type="text/javascript" src="{{/js/asyncUpload.js}}"></script><?php } ?>
<script>
    $('#{{$areaId}} .{{$class}}-thumb-clear').click(function(e){
        e.stopPropagation();
        var $thumb = $('#{{$areaId}}-thumb');
        if($thumb.attr('src') !== '' && $thumb.attr('src') !== $thumb.data('empty')){
            $thumb.attr('src', $thumb.data('empty'));
        }
        $('#{{$areaId}}-val').val('');
        $('#{{$areaId}}-org').val('');
    });
    asyncUpload.init('{{/api/upload}}', '{{$areaId}}', function(ret){
        try{
            var json = JSON.parse(ret);
            if(json.err == 0){
                if(json.ext == ".jpg" || json.ext == ".jpeg" || json.ext == ".png"){
                    $('#{{$areaId}}-thumb').attr('src', json.tmp_url);
                    $('#{{$areaId}}-val').val(json.tmp_name);
                }
            }
            asyncUpload.close();
        }catch(ex){
            asyncUpload.show("Error!!");
        }
    }, function(err){ });
</script>
{{@endsec}}