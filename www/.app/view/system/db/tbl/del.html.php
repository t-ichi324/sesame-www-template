{{@layout layout/base, layout/base-ajax}}

<form method="post" action="{{@url}}">
    <?php FormEcho::tag_hidden("sch_id", "tbl_id", "phy_name"); ?>
    <p>「{{*phy_name}}」を削除してもよろしいですか？</p>
    <div class="tb-row">
        <div class="tb-cell-r">
            <button class="btn btn-primary" type="submit">OK</button>
        </div>
    </div>
</form>
