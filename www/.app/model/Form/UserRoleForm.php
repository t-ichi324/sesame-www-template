<?php
namespace Form;
use UserUtil;
use Validator;
/*------------------------------------------------------------------------*/
class UserRoleForm extends \Form\IUserEditForm{
    public $roles;
    
    public function load() {
        parent::__load("roles");
        if(!empty($this->roles)){
            $this->roles = explode(",", $this->roles);
        }
    }
    public function hasError() {
        return Validator::hasError();
    }
    public function update(){
        UserUtil::update_auth_roles($this->id, $this->roles);
    }
}