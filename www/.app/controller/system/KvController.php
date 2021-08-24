<?php
//@ META ===================================

Meta::vprefix("+/kv");
Meta::breadcrumb( __("system.menu-kv") , "+/kv");
//@=========================================

class KvController extends IAuthController{
    
    private function makeList(){
        $cl_list = [
            "user_role" => "(System) UserRole",
            "app_data_cl" => "(System) AppData ",
            "app_mail_cl" => "(System) AppMail ",
            "app_post_cl" => "Post Category",
            "contact_cl" => "Contact Category",
            "oauth" => "OAuth Setting",
            /*ここにマスター項目を追加*/
        ];
        
        Model::set("cl_list", $cl_list);
        
        $f = new ListForm();
        if(StringUtil::isNotEmpty($f->cl)){
            $q = AppKv::query($f->cl);
            $f->setDbQueryList($q);
        }
    }
    
    public function index(){
        $this->makeList();
        return "index";
    }
    public function _ajax_post_list(){
        $this->makeList();
        return "-list";
    }
    
    public function _ajax_edit(){
        $f = new MasterEditForm();
        if($f->update()){
            return Response::text("ok");
        }
        return Response::text( __("system.menu-please-input-kv"));
    }
    public function _ajax_del(){
        $f = new MasterEditForm();
        $f->delete();
        return Response::text("ok");
    }
}

class ListForm extends IListForm{
    public $cl;
}

class MasterEditForm extends IForm{
    public $cl;
    public $key;
    public $val;
    public $attr;
    public $sort;
    
    public function delete(){
        return AppKv::delete($this->cl, $this->key);
    }
    public function update(){
        return AppKv::insertUpdate($this->cl, $this->key, $this->val, $this->attr, $this->sort);
    }
}

?>