{{@layout layout/base}}
{{@sec css}}
<style>
    .log-table{
        width: 100%;
        margin: 1em 0;
    }
    .log-table td{
        font-size: 0.8em;
        padding: 0 0.5em;
        border: 1px solid #eee;
    }
    td.at{
        font-size: 0.8em;
        max-width: 90px;
    }
    td.url{
        font-size: 0.8em;
        max-width: 300px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    td.session, td.ip{
        font-size: 0.7em;
        max-width: 80px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>
{{@endsec}}

<div id="ajax-list">{{@require-vp -list}}</div>

{{@sec js}}
<script>
$(document).on('click', '#date-claer', function(){
    $('#sd').val('');
    $('#ed').val('');
});
</script>
{{@endsec}}