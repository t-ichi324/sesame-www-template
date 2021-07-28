<?php
//@ Assign ================================
include __DIR__."/-meta.php";

Meta::vprefix("+/contact");
Meta::breadcrumb( __("admin.menu-contact") , "+/contact");
//@=========================================

class ContactController extends IAuthController{
    private function makeList(){
        $f = new ListForm();
        $q = ContactUtil::query(null, true)->fetchClass(ListItem::class);
        
        if(StringUtil::isNotEmpty($f->keyword)){
            $keywords = explode(" ", str_replace("　"," ", $f->keyword));
            $q->whereLikes(["name", "email", "subject", "body"], $keywords);
        }
        if(StringUtil::isNotEmpty($f->cl)){
            $q->ands("cl", $f->cl);
        }
        
        $q->ordrBy("created_at desc", "id desc");
        $f->setDbQueryList($q);
    }
    
    
    public function index(){
        $this->makeList();
        return "index";
    }
    public function _ajax_post_list(){
        $this->makeList();
        return "-list";
    }
    
    public function check(){
        $f = new Form\ContactUpdForm();
        $f->update_checked();
        return Response::text("done");
    }
    
    public function detail(){
        Meta::breadcrumb( __("detail") , "+/detail");
        
        $f = new Form\ContactDetailForm();
        $f->load();
        return "detail";
    }
    public function del(){
        Meta::breadcrumb( __("delete") , "+/del");
        
        $f = new \Form\ContactUpdForm();
        $f->load();
        Model::set("is_deleted", 0);
        return "del";
    }
    public function _post_del(){
        Meta::breadcrumb( __("delete") , "+/del");
        
        $f = new Form\ContactUpdForm();
        $f->delete();
        Message::addInfo( __("delete-done-*", $f->name));
        return "del";
    }
    
    public function delChecked(){
        Meta::breadcrumb( __("admin.log-delete-readed") , "+/del-checked");
        return "del-checked";
    }
    public function _post_delChecked(){
        Meta::breadcrumb( __("admin.log-delete-readed") , "+/del-checked");
        $f = new Form\ContactUpdForm();
        $f->delChecked();
        return "del-checked";
    }
}

class ListForm extends IListForm{
    public $keyword;
    public $cl;
}
class ListItem extends \Entity\Contact{
    public $cl_name;
}

?>