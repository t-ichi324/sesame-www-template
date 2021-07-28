<?php
namespace Form;
use ContactUtil;
use Validator;
/*------------------------------------------------------------------------*/
class ContactDetailForm extends \IForm{
    use \Entity\__Contact;
    public $cl_name;

    public function load(){
        $q = ContactUtil::query($this->id, TRUE);
        $q->autoClaer_OFF();
        if(!$q->isExists()) { throw new \NotFoundException(); }
        $this->setDbQuery($q);
    }
}