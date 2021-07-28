<?php
//@ Assign =================================
include __DIR__."/-meta.php";
//@=========================================

class IndexController extends IAuthController{
    public function index(){
        return "";
    }
    
    public function cache(){
        Meta::breadcrumb( __("system.menu-cache") , "+/cache");
        
        return "cache";
    }
    public function _post_cache(){
        Meta::breadcrumb( __("system.menu-cache") , "+/cache");
        
        $op = Form::get("op");
        if($op == "view"){
            Cache::clean_view();
            Message::addInfo( __("clear-done") );
        }elseif($op == "route"){
            Cache::clean_route();
            Message::addInfo( __("clear-done") );
        }elseif($op == "log"){
            Cache::clean("log");
            Message::addInfo( __("clear-done") );
        }
        return "cache";
    }
    
    public function fver(){
        Meta::breadcrumb( __("system.menu-fver") , "+/fver");
        
        $f = new VersionForm();
        $f->ver_css = VERSION_CSS;
        $f->ver_js = VERSION_JS;
        return "fver";
    }
    public function _post_fver(){
        Meta::breadcrumb( __("system.menu-fver") , "+/fver");
        
        $f = new VersionForm();
        $css = $f->ver_css;
        $js = $f->ver_js;
        
        $f = new FileInfo(Path::app("version.php"));
        $v = "<?php\n"
                ."const VERSION_CSS = '{$css}';\n"
                ."const VERSION_JS = '{$js}';\n"
                ."function vCSS(){ if(empty(VERSION_CSS)){ return null; } return '?'.VERSION_CSS;}\n"
                ."function vJS(){ if(empty(VERSION_JS)){ return null; } return '?'.VERSION_JS;}\n"
                . "?>";
        $f->save($v);
        
        Message::addInfo( __("update-done") );
        return "fver";
    }
}

class VersionForm extends IForm{
    public $ver_css;
    public $ver_js;
}