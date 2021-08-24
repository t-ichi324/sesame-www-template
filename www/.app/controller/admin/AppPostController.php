<?php
//@ META ===================================
Meta::vprefix("admin/app-post");
Meta::breadcrumb( __("admin.menu-apppost") , "+/app-post");
Meta::action(Meta::get_url());
//@=========================================

class AppPostController extends IAuthController{
    /*** index */
    public function index(){
        $f = new ListForm();
        $f->load();
        return "index";
    }
    public function _ajax_post_list(){
        $f = new ListForm();
        $f->load();
        return "-list";
    }
    
    /*------------------------------------------------------------------------*/
    public function add(){
        $f = new Form\AdminAppPostEditForm();
        Meta::breadcrumb( __("add") , "+/add");
        return "add";
    }
    public function _post_add(){
        $f = new Form\AdminAppPostEditForm();
        if($f->hasError()){
            Meta::breadcrumb( __("add") , "+/add");
            return "add";
        }
        $f->save();
        return Response::redirect(Meta::get_url("/edit/?id=".$f->id));
    }
    
    /*------------------------------------------------------------------------*/
    public function edit(){
        $f = new Form\AdminAppPostEditForm();
        $f->load();
        Meta::breadcrumb( __("update-*", $f->title) , "+/edit");
        return "edit";
    }
    public function _post_edit(){
        $f = new Form\AdminAppPostEditForm();
        Meta::breadcrumb( __("update-*", $f->title) , "+/edit");
        if($f->hasError()){
            Meta::breadcrumb( __("add") , "+/add");
            return "add";
        }
        $f->save();
        return "edit";
    }
    
    /*------------------------------------------------------------------------*/
    public function del(){
        $f = new \Form\AdminAppPostEditForm();
        $f->load();
        Meta::breadcrumb( __("delete-*", $f->title) , "+/delete");
        return "del";
    }
    public function _post_del(){
        $f = new \Form\AdminAppPostEditForm();
        Meta::breadcrumb( __("delete-*", $f->title) , "+/delete");
        
        $f->delete();
        Message::addInfo( __("delete-done-*", $f->title) );
        Model::set("is_deleted", Flags::ON);
        return "del";
    }
    
    /*------------------------------------------------------------------------*/
    public function _post_attachment(){
        $ret = new AttachmentResult();
        $ret->err = 1;
        if(isset($_FILES["file"])){
            try{
                $ret->tmp_name = $_FILES["file"]["tmp_name"];
                $ret->name = $_FILES["file"]["name"];

                $na = explode(".", $ret->name);
                if(count($na) > 1){ $ret->ext = ".".end($na); }
                $ret->name = sha1_file($ret->tmp_name) . $ret->ext;
                
                move_uploaded_file($ret->tmp_name, Path::pub(ContentConf::DIR_POST, $ret->name));
                $ret->url = Url::get(ContentConf::DIR_POST, $ret->name);
                $ret->err = 0;
                
                return Response::text($ret->tmp_url);
            } catch (Exception $ex) {
                $ret->err_msg = $ex->getMessage();
            }
        }
        return Response::json($ret);
    }
}

class ListForm extends IListForm{
    public $keyword;
    public $cl;
    
    public function load(){
        $this->setLimit(20);
        $q = new DbQuery();
        $q->table_Entity(ListItem::class);
        
        if(StringUtil::isNotEmpty($this->keyword)){
            $kw = explode(" ", str_replace("　", " ", $this->keyword));
            $q->whereLikes(["title","body","description"], $kw);
        }
        if(StringUtil::isNotEmpty($this->cl)){
            $q->where("cl", $this->cl);
        }
        $q->ordrBy("id DESC");
        $this->setDbQueryList($q);
    }
}
class ListItem extends \Entity\AppPost{
    use \Entity\__AppPost;
}

class AttachmentResult{
    public $err;
    public $name;
    public $url;
    public $tmp_name;
}
?>