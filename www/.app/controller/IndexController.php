<?php
//@ Assign =================================
// + Setting
Meta::vprefix("index");

//@=========================================

Meta::MAP_LOAD();

class IndexController extends IController{
    public function index(){
        Meta::clear_breadcrumb();
        return "";
    }
    
    public function terms(){
        Meta::clear_breadcrumb();
        Meta::breadcrumb(__("menu-terms"));
        return "terms";
    }
    public function privacy(){
        Meta::clear_breadcrumb();
        Meta::breadcrumb(__("menu-privacy"));
        return "privacy";
    }
    public function about(){
        Meta::clear_breadcrumb();
        Meta::breadcrumb(__("menu-about"));
        return "about";
    }
    public function howto(){
        Meta::clear_breadcrumb();
        Meta::breadcrumb(__("menu-howto"));
        return "howto";
    }
    
    public function sitemap_xml(){
        $xml = Sitemap::XML();
        return Response::text($xml, "text/xml");
    }
    public function robots_txt(){
        $t = new Seo\RobotsTxtGenelator();
        if(Env::isReal() || Env::isDev()){
            $t->disallow("/api/");
            $t->sitemap("sitemap.xml");
        }else{
            $t->disallowAll();
        }
        return $t->ResponseTxt();
    }
    
    public function logout(){
        $user = new User();
        $user->logout();
        return Response::redirect("auth");
    }
}
?>