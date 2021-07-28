<?php
//@ Assign ===============================
include __DIR__."/-meta.php";

Meta::vprefix("+/app-mail");
Meta::breadcrumb( __("admin.menu-appmail") , "+/app-mail");
//@=========================================

class AppMailController extends IAuthController{

    /*** index */
    public function index(){
        Model::set("kv", AppKv::query(Form\AdminAppMailEditForm::KV_NAME)->select());
        return "";
    }
    
    public function edit(){
        $f = new Form\AdminAppMailEditForm();
        $f->load();
        Meta::breadcrumb( __("update-*", $f->cl_name) , "+/edit");
        return "edit";
    }
    
    public function _post_edit(){
        $f = new Form\AdminAppMailEditForm();
        Meta::breadcrumb( __("update-*", $f->cl_name) );
        
        if(!$f->hasError()){
            $f->save();
            Message::addInfo( __("update-done") );
        }
        return "edit";
    }
}
?>