{{@layout layout/base}}
{{@sec css}}
<style>
    #side-toggle{
        background-color: #eee; padding: 0.25em;
        border-radius: 4px;
        cursor: pointer;
    }
    #side-toggle:after{ content: "<"; }
    #side-toggle.closed:after{ content: ">"; }
    
    i{ display: block; margin: 0.1em 0.5em; cursor: pointer; color: #007bff; font-size: 0.75em !important;}
    .etbl td select{border: none; height: 2.5em; padding: 0 0.5em; position: relative; width: 100%; min-width: 8em;}
    .etbl td input{
        border: none; height: 2.5em; padding: 0 0.5em; position: relative; width: 100%; min-width: 8em;
    }
    .etbl td input[type='checkbox'], .etbl td input[type='radio']{
        margin: 0 0.5em;  padding: 0.2em; line-height: 1.5; width: auto; min-width: auto;
    }
    
    .etbl th{ text-align: left; padding-top: 1em; padding-right: 0.5em; color: #212529; font-size: 1rem; font-weight: 400;}
    .etbl td{ border: 1px solid #ced4da; padding: 0;}
</style>
{{@endsec}}

<input type='hidden' id='current-name' value='{{*phy_name}}'>
<?php 
    $isView = Flags::isON(Form::get("is_view"));
?>

<div class="row">
    <div class="col-md-2">
        <div id="tbl-list" ajax-load="{{Model::get("ajaxlist")}}"></div>
    </div>
    <div class="col-md-10">
        <form method="post" action="{{@url}}" id="tbl-edit">
            <?php FormEcho::tag_hidden("sch_id","tbl_id", "is_view"); ?>
            <table class="etbl w-100 margin-sm-bottom">
                <tbody>
                    <tr>
                        <th>{{__("system.phy_name")}}</th>
                        <th>{{__("system.log_name")}}</th>
                    </tr>
                    <tr>
                        <td><input type="tel" <?php FormEcho::attr_nameVal("phy_name"); ?> required /></td>
                        <td><input type="text" <?php FormEcho::attr_nameVal("log_name"); ?> /></td>
                    </tr>
                </tbody>
            </table>

            <ul class="nav nav-tabs">
                <li class="nav-item"><a data-toggle="tab" class="nav-link active" href="#flds">{{__("field")}}</a></li>
                <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#dtl">{{__("detail")}}</a></li>
                {{@if $isView}}
                <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#vsql">ViewSQL</a></li>
                {{@endif}}
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="flds">{{@require-vp tab/flds}}</div>
                <div class="tab-pane" id="dtl">{{@require-vp tab/dtl}}</div>
                {{@if $isView}}
                <div class="tab-pane" id="vsql">{{@require-vp tab/vsql}}</div>
                {{@endif}}
            </div>

            <div class="tb-row margin-md-top">
                <div class="tb-cell">
                    <a href="{{@url ../gen-entity}}" class="btn btn-info">Entity.php</a> 
                    <a href="{{@url ../gen-create}}" class="btn btn-info">Create.sql</a> 
                    <a href="{{@url ../gen-xmlsql}}" class="btn btn-info">Sql.xml</a>
                </div>
                <div class="tb-cell-r">
                    <a href="{{@url ../export}}" class="btn btn-default">Export</a> 
                    <a href="{{@url ../import}}" class="btn btn-default">Import</a> 
                    <button class="btn btn-primary" type="submit">{{__("save")}}</button>
                </div>
            </div>
        </form>
    </div>
</div>

<table id="fld-tmp" style="display: none">
    <tbody>
        <?php Model::set("flds", array(new \DB\Libs\Entity\Fld())); ?>
        {{@require-vp tab/flds-tr}}
    </tbody>
</table>

<input type="hidden" id="tbl-rem-msg" value="{{__('system.cnf-delete-table')}}">
<input type="hidden" id="fld-rem-msg" value="{{__('system.cnf-delete-row')}}">
{{@sec js}}
<script>
    function add_fld(){
        $('#fld-tmp tr').clone().appendTo($('#fld-tbl tbody'));
    }
    
    //Submit時のindex rename
    $(document).on('submit', "#tbl-edit", function(){
        var i = 0;
        $('#fld-tbl tr').each(function(){
            renameListIndex(i, $(this));
            i++;
        });
    });
    
    $(document).on('click','#copy-btn', function(){
        ajax.callbackForm($('#copy-form'), 'text', function(html){
            $('#fld-tbl tbody').append(html);
            alert("add");
        });
    });
    
    $(document).on('click', '#side-toggle', function(){
        if($(this).hasClass('closed')){
            $(this).removeClass('closed');
            $('#con-side').css('display', 'block');
            $('#con-main').addClass('col-md-10').removeClass('col-md-12');
        }else{
            $(this).addClass('closed');
            $('#con-side').css('display', 'none');
            $('#con-main').addClass('col-md-12').removeClass('col-md-10');
        }
    });
    
    $(document).on('click', '.tbl-rem', function(){
        if(confirm( $('#tbl-rem-msg').val() )){
            ajax.callbackGet($(this).data('url'), 'text', function(){
                $('#tbl-list').ajaxLoad();
            });
        }
    });
    
    $(document).on('click', '.fld-rem', function(){
        if(confirm( $('#fld-rem-msg').val() )){
            $(this).closest('tr').remove();
        }
    });
    
    $(document).on('click', '.fld-up', function(){
        var $r = $(this).closest('tr');
        var $to = $r.prev('tr');
        if($to.length){ $r.insertBefore($to); }
    });
    $(document).on('click', '.fld-down', function(){
        var $r = $(this).closest('tr');
        var $to = $r.next('tr');
        if($to.length){ $r.insertAfter($to); }
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/TableDnD/0.9.1/jquery.tablednd.js" integrity="sha256-d3rtug+Hg1GZPB7Y/yTcRixO/wlI78+2m08tosoRn7A=" crossorigin="anonymous"></script>
<script type="text/javascript">
$(document).ready(function() {
    // Initialise the table
    $("#fld-tbl").tableDnD();
});
</script>
{{@endsec}}