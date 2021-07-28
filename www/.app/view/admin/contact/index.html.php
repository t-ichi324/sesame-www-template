{{@layout layout/base, layout/base-ajax}}

<div id="ajax-list">{{@require-vp -list}}</div>

{{@sec js}}
<script>
    $(document).on('click', 'a.btn-request-check', function(e){
        e.preventDefault(false);
        var url = $(this).attr('href');
        ajax.callbackGet(url, 'text', function(){
           refreshList();
        });
    });
</script>
{{@endsec}}