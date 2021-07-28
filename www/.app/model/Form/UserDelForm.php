<?php
namespace Form;
use UserUtil;
use Validator;
/*------------------------------------------------------------------------*/
class UserDelForm extends \Form\IUserEditForm{
    public function load() {
        parent::__load("id");
    }
    
    public function hasError() {
        return Validator::hasError();
    }
    
    public function update(){
        UserUtil::delete($this->id);
        \Model::set("is_deleted", \Flags::ON);
    }
}