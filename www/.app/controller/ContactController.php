<?php
//@ META ===================================
Meta::breadcrumb( __("contact"));
Meta::vprefix("contact");

Meta::MAP_LOAD();
Meta::csrf(true);
//@=========================================
class ContactController extends IController{
    public function index(){
        
        $f = new \Form\ContactForm();
        $f->agreed = Flags::OFF;
        if(Auth::check()){
            $f->name = UserUtil::getValue(Auth::getVal("id"), "name");
            $f->email = UserUtil::getValue(Auth::getVal("id"), "email");
        }
        return "";
    }
    public function _post_index(){
        $f = new \Form\ContactForm();
        
        if(Env::isReal()){
            $log = Path::tmp("log", "GoogleRecaptcha.log");
            $key =  __("etc.recaptcha-pirvate-key");
            $code = GoogleRecaptcha::valid($key, $log);
            if($code == 1){ Message::addError( __("etc.recaptcha-error-check") ); return ""; }
            if($code == 2){ Message::addError( __("etc.recaptcha-error-valid") ); return ""; }
        }
        
        if($f->hasError()){ return "index"; }
        $f->insert();
        
        MailSender::contact($f->email, $f->toArray());
        return Response::redirect("contact/thanks");
    }
    
    public function thanks(){
        return "thanks";
    }
}
?>