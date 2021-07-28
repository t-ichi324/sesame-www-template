<?php
namespace Form;
use UserUtil;
use Validator;
/*------------------------------------------------------------------------*/
class UserPwForm extends \Form\IUserEditForm{
    public $pw;
    public $confirm;
    public function load() {
        parent::__load("password");
    }
    
    public function hasError() {
        if(Validator::required($this->pw,  __("password") )){
            if(Validator::password($this->pw,  __("password") )){
                Validator::compare($this->pw, $this->confirm,  __("password") );
            }
        }
        return Validator::hasError();
    }
    
    public function update(){
        UserUtil::update_auth_password($this->id, $this->pw);
    }
}
