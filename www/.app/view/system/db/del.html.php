{{@layout layout/base, layout/base-ajax}}

<form method="post" action="{{@url}}">
    <?php FormEcho::tag_hidden("sch_id", "phy_name"); ?>
    <p>{{__("delete-cnf-*", Form::get("phy_name"))}}</p>
    
    <div class="tb-row">
        <div class="tb-cell-r">
            <button class="btn btn-primary" type="submit">OK</button>
        </div>
    </div>
</form>
