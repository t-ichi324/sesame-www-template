{{@layout layout/base, layout/base-ajax}}
<form method="post" action="{{@url}}" <?php if(Request::isAjax()){?>class="ajax-modal-form" data-ajax-callback="refreshList();" <?php } ?>>
    <?php FormEcho::tag_hidden("id"); ?>
    <label>loc<span style="color:#f00;">*</span></label>
    <input type="text"  class="form-control" <?php FormEcho::attr_nameVal("loc"); ?> autocomplete="off" required>
    
    <div class="grp">
        <label>parents</label>
        <select name="parents_id" class="form-control">
            <?php 
                FormEcho::tag_option("parents_id", "", "");
                foreach (Model::get("parents_list", array()) as $k => $v){ FormEcho::tag_option("parents_id", $v->id, $v->loc); }
            ?>
        </select>
    </div>
    
    <label>title</label>
    <input type="text" class="form-control" <?php FormEcho::attr_nameVal("title"); ?>>
    <label>description</label>
    <?php FormEcho::tag_textarea("description", array("class"=>"form-control")); ?>

    <label>publish</label>
    <select class="form-control" name="is_publish">
        <?php
            FormEcho::tag_option("is_publish", "", __("private") );
            FormEcho::tag_option("is_publish", Flags::ON, __("public") );
        ?>
    </select>
    <hr>
    <div class="tb-row">
        <div class="tb-cell-r">
            <button type="submit" class="btn btn-primary">OK</button>
        </div>
    </div>
</form>
