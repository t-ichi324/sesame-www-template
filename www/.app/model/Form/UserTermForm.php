<?php
namespace Form;
use UserUtil;
use Validator;
/*------------------------------------------------------------------------*/
class UserTermForm extends \Form\IUserEditForm{
    public $term_start;
    public $term_end;
    public function load() {
        parent::__load("term_start","term_end");
    }
    
    public function hasError() {
        return Validator::hasError();
    }
    
    public function update(){
        UserUtil::update_auth_term($this->id, $this->term_start, $this->term_end);
    }
}