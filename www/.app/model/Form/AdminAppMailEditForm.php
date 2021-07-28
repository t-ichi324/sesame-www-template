<?php
namespace Form;
use AppKv;
use Validator;

class AdminAppMailEditForm extends \IForm{
    const KV_NAME = "app_mail_cl";
    
    use \Entity\__AppMail;
    public $cl_name;
    public $cl_attr;
    
    public function hasError() {
        Validator::required("trigger", "Trigger");
        Validator::required("subject", __("email.subject") );
        Validator::required("sender_addr", __("email.sender-addr") );
        Validator::required("sender_name", __("email.sender") );
        Validator::required("body", __("email.body") );
        return Validator::hasError();
    }
    public function load(){
        if(!AppKv::isExists(self::KV_NAME, $this->trigger)) { throw new \NotFoundException(); }

        $x = new \DbXml();
        $x->file_Entity(\Entity\AppMail::class);
        $r = $x->sql("get", $this->toArray())->selectFirst();
        if(!empty($r)){
            $this->bind($r);
        }
        
        $this->cl_name = AppKv::getVal(self::KV_NAME, $this->trigger);
        $this->cl_attr = AppKv::getAttr(self::KV_NAME, $this->trigger);
    }
    public function save(){
        if(!AppKv::isExists(self::KV_NAME, $this->trigger)) { throw new \NotFoundException(); }
        
        $x = new \DbXml();
        $x->file_Entity(\Entity\AppMail::class);
        $x->sql("save", $this->toArray())->execute();
    }
}