<?php
namespace Form;
use ContactUtil;
use Validator;
/*------------------------------------------------------------------------*/
class ContactForm extends \IForm{
    use \Entity\__Contact;
    public $agreed;

    public function hasError(){
        Validator::required($this->name, __("name") );
        if(Validator::required($this->email, __("email") )){
            Validator::format_email($this->email, __("email"));
        }
        //Validator::required($this->subject, __("email.subject") );
        Validator::required($this->body, __("email.body"));
        return Validator::hasError();
    }
    
    public function insert(){
        $e = new \Entity\Contact($this->toArray_ignoreNull());
        
        $e->id = null;
        $e->is_checked = null;
        $e->is_deleted = null;
        $e->ip = \Request::getRemoteAddr();
        $e->user_agent = \Request::getUserAgent();
        $e->remarks = null;
        $e->created_at = now();
        $e->updated_at = now();
        
        $q = new \DbQuery();
        $q->table_Entity(\Entity\Contact::class)->setArray($e->toArray_ignoreNull());
        $q->insert();
    }
}