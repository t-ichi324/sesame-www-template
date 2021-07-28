<?php
//@ Assign =================================
include __DIR__."/-meta.php";

Meta::vprefix("+/log");
//@=========================================

Log::$IGNORLE_ACCESS = true;

class LogController extends IAuthController{
    
    public function index(){
        Meta::breadcrumb("アクセスログ", "*/log");
        return;
    }
    public function db(){
        Meta::breadcrumb("DBログ", "*/log");
        return "db";
    }
    
    public function file(){
        $n = Form::get("n");
        $f = new FileInfo(Path::log($n));
        if(Request::isAjax()){
            return Response::text($f->readH());
        }else{
            return Response::stream($f->fullName(), $f->name());
        }
    }
        
    public function _ajax_arc(){
        $n = Form::get("n");
        $f = new FileInfo(Path::log($n));
        if($f->exists()){
            $newName = $f->baseDirectory().DIRECTORY_SEPARATOR.$f->name(false)."_".date("Ymd_His").$f->extension(true);
            $f->rename($newName);
        }
        return Response::text("done");
    }
}
?>