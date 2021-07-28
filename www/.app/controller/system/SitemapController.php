<?php
//@ Assign =================================
include __DIR__."/-meta.php";

Meta::vprefix("+/sitemap");
Meta::action("+/sitemap");
Meta::breadcrumb( __("system.menu-sitemap") , "+/sitemap");

//@=========================================

class SitemapController extends IAuthController{
    public function index(){
        $f = new SystemMapForm();
        $f->load();
        return "";
    }
    public function _ajax_list(){
        $f = new SystemMapForm();
        $f->load();
        return "-list";
    }
    
    public function add(){
        Meta::breadcrumb( __("add") , "+/add");
        Model::set("parents_list", Sitemap::getAll());
        return "add";
    }
    public function _ajax_post_add(){
        Meta::breadcrumb( __("add") , "+/add");
        $f = new SystemMapEditForm();
        if($f->hasError()){ return "add"; }
        $f->save();
        $f->id = null;
        $f->loc = null;
        $f->title = null;
        $f->description = null;
        Model::set("parents_list", Sitemap::getAll());
        Message::addSuccess( __("add-done") );
        return "add";
    }
    
    public function edit(){
        Meta::breadcrumb( __("edit") , "+/edit");
        $f = new SystemMapEditForm();
        $f->load();
        Model::set("parents_list", Sitemap::getAll());
        return "edit";
    }
    public function _post_edit(){
        Meta::breadcrumb( __("edit"), "+/edit");
        $f = new SystemMapEditForm();
        if(!$f->hasError()){
            Message::addSuccess( __("edit-done"));
            $f->save();
        }
        Model::set("parents_list", Sitemap::getAll());
        return "edit";
    }
    public function del(){
        Meta::breadcrumb( __("delete"), "+/del");
        $f = new SystemMapEditForm();
        $f->load();
        return "del";
    }
    public function _post_del(){
        Meta::breadcrumb( __("delete"), "+/del");
        $id = Form::get("id");
        Sitemap::delete($id);
        Message::addSuccess( __("delete-done"));
        Model::set("is_deleted", Flags::ON);
        return "del";
    }
}
class SystemMapForm extends IListForm{
    public $attr;
    public $oder;
    public $keyword;
    public function load(){
        $q = Sitemap::dbQuery();
        $q->table("map")->ordrBy("loc");
        $this->setDbQueryList($q);
    }
}
class SystemMapEditForm extends IForm{
    use __SitemapItem;
    
    public function load(){
        $e = Sitemap::get($this->id);
        if($e === null) { throw new NotFoundException(); }
        $this->bind($e);
    }
    public function save(){
        $e = new SitemapItem($this);
        $this->id = Sitemap::save($e);
    }
    public function hasError(){
        if(Validator::required($this->loc, "`loc`")){
            if(!Sitemap::is_registable_loc($this->loc, $this->id)){
                Validator::addError( __("unavailable-*", "`loc`"));
            }
        }
        return Validator::hasError();
    }
}