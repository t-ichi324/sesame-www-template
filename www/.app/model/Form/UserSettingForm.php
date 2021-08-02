<?php
namespace Form;
use UserUtil;
use Validator;
/*------------------------------------------------------------------------*/
class UserSettingForm extends \Form\IUserEditForm{
    public $is_single;
    public $is_ban;
    public $is_tfa;
    public $notice;
    public $remarks;
    
    public function load() {
        parent::__load("is_tfa","is_single","is_ban","notice", "remarks");
    }
    
    public function hasError() {
        return Validator::hasError();
    }
    
    public function update(){
        UserUtil::update_auth_notice($this->id, $this->notice);
        UserUtil::update_auth_tfa($this->id, $this->is_tfa);
        UserUtil::update_auth_single($this->id, $this->is_single);
        UserUtil::update_auth_ban($this->id, $this->is_ban);
        UserUtil::update_auth_remarks($this->id, $this->remarks);
    }
}
