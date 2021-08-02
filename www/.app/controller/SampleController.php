<?php
//@ META ===================================
Meta::vprefix("sample");
Meta::url("sample");
//@=========================================

class SampleController extends IController{
    public function index(){
        $di = new DirectoryInfo(Path::app("view/sample"));
        $pages = array();
        foreach ($di->getFileInfos("*.html.php") as $fi){
            $fi instanceof FileInfo;
            $pages[] = str_replace(".html.php","", $fi->name());
        }
        Model::set("pages", $pages);
        return "";
    }
    
    public function upload() {
        return "upload";
    }
}
?>