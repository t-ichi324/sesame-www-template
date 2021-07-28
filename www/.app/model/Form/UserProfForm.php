<?php
namespace Form;
use UserUtil;
use Validator;
/*------------------------------------------------------------------------*/
class UserProfForm extends \Form\IUserEditForm{
    use \Entity\__User;
    
    public function hasError() {
        Validator::required($this->name, __("name") );
        if(!UserUtil::isAvailable_email($this->email, $this->id)){
            Validator::addError( __("unavailable-*", __("email")) );
        }
        return Validator::hasError();
    }
    
    public function update(){
        $e = new \Entity\User($this);
        UserUtil::update($e);
    }
}
