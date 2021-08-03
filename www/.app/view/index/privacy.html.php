{{@layout layout/base}}

<div class="row">
    <div class="{{col_md_class()}}">
        <!--<h1 class="page-title">{{:title}}</h1>-->
        <div class="margin-sm-top contents long-text"><?= AppData::echoData("privacy"); ?></div>
        <!--<p><?= AppData::getDate("privacy") ?></p>-->
    </div>
</div>