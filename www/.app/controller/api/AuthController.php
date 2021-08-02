<?php
//@ META ===================================
//@=========================================
Log::$IGNORLE_ACCESS = true;

class AuthController extends IController{
    public function index(){ return Response::json(Auth::check()); }
    public function check(){ return Response::json(Auth::check()); }
    public function token(){ return Response::text(Secure::getCsrfToken()); }
    public function name(){ return Response::text(Auth::getVal("name")); }
    public function uid(){ return Response::text(Auth::getVal("id")); }


    public function keep(){ Log::$IGNORLE_ACCESS = false; return Response::noContent(); }
    public function keep_js(){
        Response::setCacheExpires();
        $span = (20 * 60 * 1000);
        $js = 'setInterval(function(){$.ajax({type:"GET",url:"'.Url::get("api/auth/keep").'"});},'.$span.');';
        return Response::text($js,"application/javascript");
    }
}