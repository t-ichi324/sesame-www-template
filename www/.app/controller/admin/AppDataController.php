<?php
//@ Assign ===============================
include __DIR__."/-meta.php";
// + Setting
Meta::vprefix("admin/app-data");

// + Hierarcy
Meta::breadcrumb( __("admin.menu-appdata") , "+/app-data");
//@=========================================

class AppDataController extends IAuthController{
    
    public function index(){
        Model::set("kv", AppKv::query(Form\AdminAppDataEditForm::KV_NAME)->select());
        return "";
    }
    
    public function edit(){
        $f = new Form\AdminAppDataEditForm();
        $f->load();
        
        Meta::breadcrumb( __("update-*", $f->cl_name) );
        if($f->cl_attr == "html"){ return "html"; }
        if($f->cl_attr == "raw"){ return "raw"; }
        return "text";
    }
    
    public function _post_edit(){
        $f = new Form\AdminAppDataEditForm();
        Meta::breadcrumb( __("update-*", $f->cl_name) );
        
        if(!$f->hasError()){
            $f->save();
            Message::addInfo( __("update-done") );
        }
        
        if($f->cl_attr == "html"){ return "html"; }
        if($f->cl_attr == "raw"){ return "raw"; }
        return "text";
    }
}
?>