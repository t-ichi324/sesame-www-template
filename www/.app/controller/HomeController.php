<?php
//@ Assign =================================
// + Setting
Meta::vprefix("home");

// + Hierarcy
Meta::breadcrumb( __("home") , "home");
//@=========================================

class HomeController extends IAuthController{
    public function index(){
        return "";
    }
    
}
?>