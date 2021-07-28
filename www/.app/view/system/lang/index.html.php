{{@layout layout/base, layout/base-ajax}}

<div id="ajax-list">{{@require-vp -list}}</div>

{{@sec js}}
<script>
    function refreshList(){ $('#search').submit(); }
    
    $(document).on('change', '#sel-lang',function(){
        $("#sel-cl").val('');
        refreshList();
    })
    
    $(document).on('change', '#sel-cl',function(){
        refreshList();
    })
    
    $(document).on('change', '.edit', function(){
        $tr = $(this).closest('tr');
        $('#editor-key').val($tr.data('key'));
        $('#editor-val').val($tr.find('.e-val').val());
        ajax.callbackForm($('#editor'), 'text', function(t){
            if(t=="ok"){
                //refreshList();
            }else{
                alert(t);
            }
        });
    });
    
    $(document).on('click', '#add', function(){
        $('#editor-key').val($('#add-key').val());
        $('#editor-val').val($('#add-val').val());
        ajax.callbackForm($('#editor'), 'text',function(t){
            if(t=="ok"){
                refreshList();
            }else{
                alert(t);
            }
        });
    });
    
    $(document).on('click', '.del', function(){
        if(confirm('{{__("delete-cnf")}}')){
            var url = $(this).data('url');
            ajax.callbackGet(url, 'text', function(t){
                refreshList();
            });
        }
    });
</script>
{{@endsec}}