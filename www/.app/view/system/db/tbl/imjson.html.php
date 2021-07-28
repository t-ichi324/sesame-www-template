{{@layout layout/base, layout/base-ajax}}

<form method="post" action="{{@url}}" enctype="multipart/form-data">
    <?php FormEcho::tag_hidden("sch_id", "phy_name"); ?>
    <p>{{__("system.imjson")}}</p>
    <input type="file" name="importfile" required>
    <div class="tb-row">
        <div class="tb-cell-r">
            <button class="btn btn-primary" type="submit">OK</button>
        </div>
    </div>
</form>
