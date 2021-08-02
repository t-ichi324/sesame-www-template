<?php
//@ META ===================================
Meta::vprefix("home");
Meta::breadcrumb( __("home") , "home");
//@=========================================

class HomeController extends IAuthController{
    public function index(){
        return "";
    }
    
}
?>