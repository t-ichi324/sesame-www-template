<?php
namespace Form;
use UserUtil;
use Validator;
/*------------------------------------------------------------------------*/
class UserAddForm extends \IForm{
    use \Entity\__User;
    public $pw;
    public $confirm;
    
    public $tmp_name;   //IMG_TMP
 
    public function hasError() {
        Validator::required($this->name, __("name"));
        if(Validator::required($this->pw, __("password"))){
            if(Validator::password($this->pw, __("password"))){
                Validator::compare($this->pw, $this->confirm, __("password"));
            }
        }
        if(!UserUtil::isAvailable_email($this->email)){
            Validator::addError( __("unavailable-*", __("email")) );
        }
        
        return Validator::hasError();
    }
    
    public function insert(){
        \AsyncUploadImg::saveToPub("tmp_name", "img", \ContentConf::DIR_USER);
        
        $e = new \Entity\User($this);
        $e->password = $this->pw;
        
        return UserUtil::insert($e);
    }
}
