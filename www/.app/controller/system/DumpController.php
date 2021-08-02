<?php
//@ META ===================================

Meta::vprefix("+/dump");
Meta::breadcrumb( __("system.menu-dump") , "+/dump");
//@=========================================

class DumpController extends IAuthController{
    private static $SAVE_DIR = "dumps";
    private static $FILE_EXT = ".dump";
    
    public function index(){
        $this->init();
        return "";
    }
    
    public function _post_index(){
        $f = new FileInfo(Path::tmp(self::$SAVE_DIR, date("Ymd_His").self::$FILE_EXT));
        $f->makeDirectory();
        
        $q = new DbQuery();
        $ret = $q->_mysql()->createDump($f->fullName());
        
        if(!empty($ret)){
            Message::addError($ret);
        }else{
            Message::addSuccess( __("system.dump-done-*", $f->fullName()));
        }
        
        $this->init();
        return "";
    }
    
    private function init(){
        $d = new DirectoryInfo(Path::tmp(self::$SAVE_DIR));
        $dumps = $d->getFileNames("*".self::$FILE_EXT);
        Model::set("dumps", array_reverse($dumps));
    }
    
    public function download(){
        if(Form::isEmpty("n")){ return Response::notFound(); }
        $name = Form::get("n");
        
        $f = new FileInfo(Path::tmp(self::$SAVE_DIR, $name));
        if(!$f->exists()){ return Response::notFound(); }
        return Response::download($f->fullName(), $name);
    }
}