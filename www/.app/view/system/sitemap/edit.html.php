{{@layout layout/base, layout/base-ajax}}

<form method="post" action="{{@url}}" <?php if(Request::isAjax()){?>class="ajax-modal-form" data-ajax-callback="refreshList();" <?php } ?>>
    <?php FormEcho::tag_hidden("id"); ?>
    <?php $url = Url::get(Form::get("loc"));  ?>
    <div class="grp">
        <label>url / loc<span style="color:#f00;">*</span></label>
        <input type="text" class="form-control" <?php FormEcho::attr_nameVal("loc"); ?> required>
        <a href="{{$url}}" target="_blank">{{$url}}</a>
    </div>
    <div class="grp">
        <label>parents</label>
        <select name="parents_id" class="form-control">
            <?php 
                FormEcho::tag_option("parents_id", "", "");
                foreach (Model::get("parents_list", array()) as $k => $v){ FormEcho::tag_option("parents_id", $v->id, $v->loc); }
            ?>
        </select>
    </div>
    
    <hr>
    <div class="row">
        <div class="col-md-6">
            <p># META</p>
            <label>title</label>
            <input type="text" class="form-control" <?php FormEcho::attr_nameVal("title"); ?>>
            
            <label>description</label>
            <?php FormEcho::tag_textarea("description", array("class"=>"form-control")); ?>
            
            <label>tag</label>
            <input type="text" class="form-control" <?php FormEcho::attr_nameVal("tag"); ?>>
            
            <label>og:image</label>
            <input type="text" class="form-control" <?php FormEcho::attr_nameVal("og_image"); ?>>
        </div>
        
        <div class="col-md-6">
            <p># XML</p>
            <label>publish</label>
            <select class="form-control" name="is_publish">
                <?php
                    FormEcho::tag_option("is_publish", "",  __("private") );
                    FormEcho::tag_option("is_publish", Flags::ON, __("public") );
                ?>
            </select>

            <label>lastmod</label>
            <div class="input-group">
                <input type="date" class="form-control" <?php FormEcho::attr_nameVal("lastmod"); ?> id="lastmod">
                <button type="button" class="btn btn-default" id="clear-lastmod" onclick="$('#lastmod').val('');">&times;</button>
            </div>
            
            <label>changefreq</label>
            <select class="form-control" name="changefreq">
                <?php
                    FormEcho::tag_option("changefreq", "", "");
                    foreach(Sitemap::CHANGEFREQ() as $v){ FormEcho::tag_option("changefreq", $v, $v); }
                ?>
            </select>
            <label>priority</label>
            <select class="form-control" name="priority">
                <?php 
                    FormEcho::tag_option("priority", "", "");
                    foreach(Sitemap::PRIORITY() as $v){ FormEcho::tag_option("priority", $v, $v); }
                ?>
            </select>
        </div>
    </div>
    
    <hr>
    
    <div class="tb-row">
        <div class="tb-cell-r">
            <button type="submit" class="btn btn-primary">OK</button>
        </div>
    </div>
</form>
