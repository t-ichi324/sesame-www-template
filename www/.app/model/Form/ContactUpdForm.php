<?php
namespace Form;
use ContactUtil;
use Validator;
/*------------------------------------------------------------------------*/
class ContactUpdForm extends \IForm{
    public $id;
    public $name;
    public $flag;
    public $remarks;
    
    public function load(){
        $q = ContactUtil::query($this->id);
        $q->autoClaer_OFF();
        if(!$q->isExists()) { throw new \NotFoundException(); }
        $this->setDbQuery($q);
    }

    public function delete(){
        $q = ContactUtil::query($this->id);
        $q->set("is_deleted", 1)->update();
        \Model::set("is_deleted", Flags::ON);
    }
    
    public function delChecked(){
        $q = ContactUtil::query();
        $q->where("is_checked", 1);
        $q->set("is_deleted", 1)->update();
        \Model::set("is_deleted", Flags::ON);
    }
    
    public function update_checked(){
        if(\StringUtil::isEmpty($this->id) || \StringUtil::isEmpty($this->flag)){ return ; }
        $f = $this->flag == "0" ? 0 : 1;
        
        $q = ContactUtil::query($this->id);
        $q->set("is_checked", $f);
        $q->update();
    }
    public function update_remarks(){
        if(\StringUtil::isEmpty($this->id) || \StringUtil::isEmpty($this->remarks)){ return ; }
        $q = ContactUtil::query($this->id);
        $q->set("remarks", $this->remarks);
        $q->update();
    }
}
