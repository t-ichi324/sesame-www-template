{{@layout layout/base}}

<div class="row">
    <div class="{{col_md_class()}}">
        <form method="post">
            <p class="sec-title">{{@title}}</p>
            <p>{{__("admin.appdata-html-msg")}}</p>
            <?php FormEcho::tag_textarea("data", array("class"=>"form-control p-text", "style"=>"min-height: 60vh;")); ?>
            <hr>
            <div class="a-right">
                <?php FormEcho::tag_hidden("key","cl_name","cl_attr"); ?>
            <button class="btn btn-primary" type="submit">{{__("update")}}</button>
            </div>
        </form>
    </div>
</div>

