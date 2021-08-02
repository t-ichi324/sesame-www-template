<?php
//@ META ===================================

Meta::vprefix("+/lang");
Meta::breadcrumb( __("system.menu-lang") , "+/lang");
//@=========================================

class LangController extends IAuthController{
    
    private function makeList(){
        $f = new ListForm();
        
        $lang_list = array();
        $cl_list = array();
        $ini = array();
        
        $di = new DirectoryInfo(LangLocale::getPath());
        foreach($di->getDirectoryInfos() as $d){
            $d instanceof DirectoryInfo;
            $lang_list[$d->name()] = $d->name();
        }
        foreach($di->getFileInfos() as $d){
            $d instanceof FileInfo;
            $cl_list[$d->name()] = $d->name();
        }
        
        if(StringUtil::isNotEmpty($f->lang)){
            $di = new DirectoryInfo(LangLocale::getPath($f->lang));
            foreach($di->getFileInfos() as $d){
                $d instanceof FileInfo;
                $cl_list[$d->name()] = $d->name();
            }
        }
        
        if(StringUtil::isNotEmpty($f->cl)){
            $file = LangLocale::getPath($f->lang,$f->cl);
            if(file_exists($file)){
                $f->setRawList(parse_ini_file($file));
            }
        }
        
        Model::set("lang_list", $lang_list);
        Model::set("cl_list", $cl_list);
        Model::set("ini", $ini);
    }
    
    public function index(){
        $this->makeList();
        return "index";
    }
    public function _ajax_post_list(){
        $this->makeList();
        return "-list";
    }
    
    public function _ajax_edit(){
        $f = new LangEditForm();
        if($f->update()){
            return Response::text("ok");
        }
        return Response::text( __("system.menu-please-input-lang"));
    }
    public function _ajax_del(){
        $f = new LangEditForm();
        $f->delete();
        return Response::text("ok");
    }
}

class ListForm extends IListForm{
    public $lang;
    public $cl;
}

class LangEditForm extends IForm{
    public $lang;
    public $cl;
    
    public $key;
    public $val;
    
    public function delete(){
        /*
        $fi = new FileInfo(LangLocale::getPath($this->lang, $this->cl));
        if(!$fi->exists()){ return; }
        
        $ini = parse_ini_file($fi->fullName());
        unset($ini[$this->key]);
        $txt = "";
        
        return;
         */
    }
    public function update(){
    }
}

?>