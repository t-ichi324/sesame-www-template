<?php
//@ META ===================================
//@=========================================

class IndexController extends IController{
    private $error_redirect = "/auth";
    private $ok_redirect = "/home";
    
    public function index(){
        $google_client_id = AppKv::getVal("oauth", "google_client_id");
        $google_callback = AppKv::getVal("oauth", "google_callback");
        
        $facebook_client_id = AppKv::getVal("oauth", "facebook_client_id");
        $facebook_callback = AppKv::getVal("oauth", "facebook_callback");
        
        $html = "";
        $html .= "<a href='".OAuthGoogle::getUrlAuth($google_client_id, Url::get($google_callback))."'>Google OAuth 2.0</a><br>";
        $html .= "<a href='". OAuthFacebook::getUrlAuth($facebook_client_id, Url::get($facebook_callback))."'>Facebook OAuth</a><br>";
        return Response::html($html);
    }
    
    public function google(){
        $log = Path::tmp("google-oauth.log");
        $code = Form::get("code");
        $google_client_id = AppKv::getVal("oauth", "google_client_id");
        $google_client_secret= AppKv::getVal("oauth", "google_secret");
        $google_callback = AppKv::getVal("oauth", "google_callback");
        
        $token = OAuthGoogle::getAccessToken($code, $google_client_id, $google_client_secret, Url::get($google_callback), $log);
        $ui = OAuthGoogle::getUserInfo($token, $log);
        
        if(empty($ui)){ return Response::redirect($this->error_redirect); }
        
        return $this->onRegisterLogin("facebook", $ui->email, $ui->given_name, $ui->family_name);
    }
    
    public function facebook(){
        $log = Path::tmp("facebook-oauth.log");
        $code = Form::get("code");
        $google_client_id = AppKv::getVal("oauth", "facebook_client_id");
        $google_client_secret= AppKv::getVal("oauth", "facebook_secret");
        $google_callback = AppKv::getVal("oauth", "facebook_callback");
        
        $token = OAuthFacebook::getAccessToken($code, $google_client_id, $google_client_secret, Url::get($google_callback), $log);
        $ui = OAuthFacebook::getUserInfo($token, $log);
        
        if(empty($ui)){ return Response::redirect($this->error_redirect); }
        return $this->onRegisterLogin("facebook", $ui->email, $ui->first_name, $ui->last_name);
    }
    
    private function onRegisterLogin($attr, $email, $name = null, $last_name = null){
        if(UserUtil::isAvailable_email($email)){
            $role = AppKv::getVal("oauth", "default_role");
            $e = new \Entity\User();
            $e->password = Request::getRemoteAddr().date("YmdHis");  //TEMP
            $e->roles = $role;
            $e->attr = $attr;
            $e->email = $email;
            $e->name = (StringUtil::isNotEmpty($name) ? $name : $email);
            //$e->last_name = $last_name;
            UserUtil::insert($e);
        }
        
        $cred = ["loginId"=>$email, "oauth"=>$attr];
        $user = new User();
        if($user->login($cred, true)){
            return Response::redirect($this->ok_redirect);
        }
        return Response::redirect($this->error_redirect);
    }
}
?>