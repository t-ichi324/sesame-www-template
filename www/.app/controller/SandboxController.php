<?php
//@ Assign =================================
// + Setting
Meta::vprefix("sandbox");

//@=========================================

class SandboxController extends IController{
    public function index(){
        Meta::breadcrumb("sandbox", "/sandbox");
        $di = new DirectoryInfo(Path::app("view/sandbox"));
        $pages = array();
        foreach ($di->getFileInfos("*.html.php") as $fi){
            $fi instanceof FileInfo;
            $pages[] = str_replace(".html.php","", $fi->name());
        }
        Model::set("pages", $pages);
        return "";
    }
    
    public function __id($name) {
        if(Form::get("breadcrumb") == "on"){
            Meta::breadcrumb("sandbox", "/sandbox");
            Meta::breadcrumb($name);
        }
        return $name;
    }
}
?>