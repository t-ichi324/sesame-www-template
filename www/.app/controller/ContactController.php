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
        
        $public_key = AppKv::getVal("g-recaptcha", "public-key");
        if(!empty($public_key)){
            $private_key = AppKv::getVal("g-recaptcha", "prviate-key");
            $log = Path::tmp("log", "GoogleRecaptcha.log");
            $code = GoogleRecaptcha::valid($private_key, $log);
            if($code == 1){ Message::addError( __("etc.recaptcha-error-check")); return ""; }
            if($code == 2){ Message::addError( __("etc.recaptcha-error-valid")); return ""; }
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