{{@layout layout/base, layout/base-ajax}}
<form method="post" action="{{@url}}" >
    <?php FormEcho::tag_hidden("sch_id"); ?>
    <div class="row">
        <div class="col-md-6">
            <label>{{__("system.phy_name")}}</label>
            <input class="form-control" type="tel" <?php FormEcho::attr_nameVal("phy_name"); ?> required />
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <label>collation</label>
            <select class="form-control" name="collation">
                <?php FormEcho::tag_option("collation", "", "-- Sch Default --") ?>
                <?php FormEcho::tag_option("collation", "utf8-general-ci", "utf8-general-ci") ?>
            </select>
        </div>
        <div class="col-md-6">
            <label>is_view</label>
            <select class="form-control" name="is_view">
                <?php FormEcho::tag_option("is_view", "0", "TABLE") ?>
                <?php FormEcho::tag_option("is_view", "1", "VIEW") ?>
            </select>
        </div>
    </div>
    
    <label>Copy</label>
    <select class="form-control" name='copy_by'>
        <?php 
        FormEcho::tag_option("copy_by", "", "-- None --");
        foreach (Model::get("tbls", array()) as $e){
            FormEcho::tag_option("copy_by", $e->tbl_id, $e->phy_name);
        }
        ?>
    </select>
        
    <hr>
    
    <div class="tb-row">
        <div class="tb-cell-r">
            <button type="submit" class="btn btn-primary">{{__("save")}}</button>
        </div>
    </div>
</form>
