{{@layout layout/base}}

<?php
    $files = ["access.log","info.log","access-error.log","error.log","fatal-error.log","GoogleRecaptcha.log"];
    $preId = 0;
?>

{{@sec css}}
<style>
    pre.of-x{ white-space: pre; overflow-x: auto;}
</style>
{{@endsec}}

<div class="row">
    <div class="col-md-12 mx-auto">
        {{@each $files as $f}}
        <h3>{{$f}}</h3>
        <pre style="border:1px solid #eee; overflow-y: auto; height: 20em;" class="of-x" id="pre-{{$preId}}" ajax-load="{{/system/log/file?n=[$f]}}">loading</pre>
        <button class="btn btn-default reload" data-target="#pre-{{$preId}}">{{__("reload")}}</button>
        <a class="btn btn-default dl" href="{{/system/log/file?n=[$f]}}">{{__("download")}}</a>
        <button class="btn btn-default arc" data-url="{{/system/log/arc?n=[$f]}}" data-target="#pre-{{$preId}}">{{__("archive")}}</button>        <hr>
        {{@code $preId += 1; }}
        {{@endeach}}
    </div>
</div>

{{@section js}}
<script>
    $('#of-x').click(function(){ $('pre').toggleClass('of-x'); });
    $(document).on('click','.arc',function(){
        var t = $(this).data('target');
        var url = $(this).data('url');
        ajax.callbackGet(url, 'text', function(r){
            $(t).ajaxLoad();
        });
    });
    $(document).on('click','.reload',function(){
        var t = $(this).data('target');
        $(t).ajaxLoad();
    });
</script>
{{@endsection}}