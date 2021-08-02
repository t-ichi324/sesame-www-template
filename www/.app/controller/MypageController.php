<?php
//@ META ===================================
Meta::vprefix("mypage");
Meta::breadcrumb( __("mypage") , "mypage");
//@=========================================


class MypageController extends IAuthController{
    public function index(){
        $f = new MyPageForm();
        $f->load();
        return "";
    }
    
    public function edit(){
        Meta::breadcrumb( __("edit") , "+/edit");
        
        $f = new Form\UserProfForm();
        $f->id = Auth::getVal("id");
        $f->load();
        return "edit";
    }
    
    public function _post_edit(){
        Meta::breadcrumb( __("edit") , "+/edit");
        
        $f = new Form\UserProfForm();
        $f->id = Auth::getVal("id");
        if(!$f->hasError()){
            $f->update();
            Message::addInfo( __("update-done") );
        }
        return "edit";
    }
    
    public function pw(){
        Meta::breadcrumb( __("password") , "+/pw");
        
        $f = new Form\UserPwForm();
        $f->id = Auth::getVal("id");
        $f->load();
        return "pw";
    }
    
    public function _post_pw(){
        Meta::breadcrumb( __("password") , "+/pw");
        
        $f = new Form\UserPwForm();
        $f->id = Auth::getVal("id");
        if(!$f->hasError()){
            $f->update();
            Message::addInfo( __("update-done") );
        }
        return "pw";
    }
    
}

class MyPageForm extends IForm{
    use \Entity\__User;
    
    public $roles_name;
    public $roles;

    public $expired;
    public $term_start;
    public $term_end;
    
    public function load(){
        $id = Auth::getVal("id");
        if(!UserUtil::isExists($id)){ return false; }
        $this->setDbQuery(UserUtil::query($id, true));
        
        $this->expired = $this->term_start."～".$this->term_end;
        if($this->expired === "～"){
            $this->expired = __("unlimited");
        }
        
        return true;
    }
    
    public function getRolesName(){
    }
}

