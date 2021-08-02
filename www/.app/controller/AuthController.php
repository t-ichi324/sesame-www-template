<?php
//@ META ===================================
Meta::vprefix("auth");
Meta::csrf(true);
//@=========================================

class AuthController extends IController{
    
    public function __pre_invoke_handler($func, $name) {
        $ip = Request::getRemoteAddr();
        if(Auth::check()){
            return Response::redirect("home");
        }
    }

    private function indexResult(){
        $f = new \Form\AuthForm();
        $f->remember = Flags::ON;
        if(!empty($f->r)){
            if(!Message::has()){
                Message::isCloseable(true);
                Message::addWarning( __("auth.disconnect-msg") );
            }
        }

        if(Request::isAjax()){
            return "ajax-to-top";
        }
        return "index";
    }
    
    public function index(){
        return $this->indexResult();
    }
    
    public function _post_index(){
        $f = new Form\AuthForm();
        $user = new User();
        
        $params = ["loginId"=>$f->loginId, "password"=>$f->password];
        
        if($user->login($params, Flags::isON($f->remember))){
            if($user->is2fa()){
                $expired_min = 30;
                $key = Auth::get2fa_key();
                $token = Auth::get2fa_token($params, 5, $expired_min);
                MailSender::twoFactorAuth($user->email, ["token"=>$token, "expired"=>$expired_min]);
                return Response::redirect("/auth/two-factor?key=".$key);
            }
            
            Message::addSuccess( __("auth.success-msg") );
            Message::toRedirect();
            $to = base64_decode($f->r, true);
            if(empty($to)){
                return Response::redirect("home");
            }else{
                return Response::redirect($to);
            }
        }else{
            Response::setStatusCode(401);
            if(!Message::has()){
                Message::addError( __("auth.error-msg"));
            }
        }
        return "";
    }
    
    public function forgot(){
        Meta::breadcrumb( __("auth.menu") , "/auth");
        Meta::breadcrumb( __("auth.menu-forgot") );
        $f = new \Form\AuthForm();
        return "forgot";
    }
    
    public  function _post_forgot(){
        Meta::breadcrumb( __("auth.menu") , "/auth");
        Meta::breadcrumb( __("auth.menu-forgot") );
        $f = new Form\ForgotForm();
        if($f->isEmpty("email")){
            return "forgot";
        }
        
        $id = UserUtil::getId_FromEmail($f->email);
        if(StringUtil::isNotEmpty($id)){
            $password = Secure::genPassword(8);
            UserUtil::update_auth_password($id, $password);
            
            $user_entity = UserUtil::getEntity($id);
            $user_entity->password = $password;
            
            MailSender::forgot($f->email, $user_entity->toArray());
            Model::set("msg",  __("auth.forgot-success-msg", $f->email) );
            
            return "forgot-send";
        }else{
            Message::addError( __("auth.forgot-error-msg", $f->email) );
            return "forgot";
        }
    }
    
    public function twoFactor(){
        $f = new \Form\AuthTwoFactorForm();
        if(!Auth::valid2fa_key($f->key)){
            return Response::notFound();
        }
        
        return "two-factor";
    }
    public function _post_twoFactor(){
        $f = new \Form\AuthTwoFactorForm();
        if(!Auth::valid2fa_key($f->key)){
            return Response::notFound();
        }
        
        $user = new User();
        if($user->login_2fa($f->key, $f->token)){
            Message::addSuccess( __("auth.success-msg") );
            Message::toRedirect();
            $to = base64_decode($f->r, true);
            if(empty($to)){
                return Response::redirect("home");
            }else{
                return Response::redirect($to);
            }
        }
        
        Message::addError( __("auth.2fa-err") );
        return "two-factor";
    }
}
?>