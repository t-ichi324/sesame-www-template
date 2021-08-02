{{@layout layout/base, layout/base-ajax}}

<form method="post" action="{{:url}}">
    <?php FormEcho::tag_hidden("sch_id"); ?>
    <div class="row">
        <div class="col-md-6">
            <label>{{__("system.phy_name")}}</label>
            <input class="form-control" type="tel" <?php FormEcho::attr_nameVal("phy_name"); ?> required />
        </div>
        <div class="col-md-6">
            <label>{{__("system.log_name")}}</label>
            <input class="form-control" type="text" <?php FormEcho::attr_nameVal("log_name"); ?> />
        </div>
        <hr>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label>collation</label>
            <select class="form-control" name="collation">
                <?php FormEcho::tag_option("collation", "", "-- Server Default --") ?>
                <?php FormEcho::tag_option("collation", "utf8-general-ci", "utf8-general-ci") ?>
            </select>
        </div>
        <div class="col-md-6">
            <label>db_type</label>
            <select class="form-control" name="db_type">
                <?php FormEcho::tag_option("db_type", "mysql", "MySQL") ?>
                <?php FormEcho::tag_option("db_type", "sqlite", "SQLite") ?>
            </select>
        </div>
    </div>
    <label>Comment</label>
    <input class="form-control" type="text" <?php FormEcho::attr_nameVal("comment"); ?> />
    <button type="submit">OK</button>
</form>
