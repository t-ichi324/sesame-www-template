<?php
namespace Form;
use UserUtil;
use Validator;
/*------------------------------------------------------------------------*/
class UserProfForm extends \Form\IUserEditForm{
    use \Entity\__User;
    
    public $tmp_name;
    
    public function hasError() {
        Validator::required($this->name, __("name") );
        if(!UserUtil::isAvailable_email($this->email, $this->id)){
            Validator::addError( __("unavailable-*", __("email")) );
        }
        return Validator::hasError();
    }
    
    public function update(){
        \AsyncUploadImg::saveToPub("tmp_name", "img", \ContentConf::DIR_USER);
        
        $e = new \Entity\User($this);
        UserUtil::update($e);
    }
}
