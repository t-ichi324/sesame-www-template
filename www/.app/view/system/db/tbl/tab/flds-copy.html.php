{{@layout layout/base-ajax}}
<form method="post" action="{{:url /flds-copy}}" class="ajax-form" id="copy-form">
    <?php FormEcho::tag_hidden("sch_id"); ?>
    <label>Copy</label>
    <select class="form-control" name='tbl_id'>
        <?php 
        FormEcho::tag_option("tbl_id", "", "-- None --");
        foreach (Model::get("tbls", array()) as $e){
            FormEcho::tag_option("tbl_id", $e->tbl_id, $e->phy_name);
        }
        ?>
    </select>
    
    <div class="tb-row">
        <div class="tb-cell-r">
            <button type="button" class="btn btn-primary" id="copy-btn">{{__("sysmte.append-bottom")}}</button>
        </div>
    </div>
</form>
