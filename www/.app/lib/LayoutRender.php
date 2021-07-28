<?php
class LayoutRender{
    public static function listAddon($uri, $replacetarget){
        Model::set("__list_addon_url__", Url::get($uri));
        Model::set("__list_addon_replacetarget__", $replacetarget);
        Render::echoRequire("layout/list/addon");
    }
}
?>