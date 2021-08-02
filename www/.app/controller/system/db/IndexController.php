<?php
//@ META ===================================

//@=========================================

include_once __DIR__.DIRECTORY_SEPARATOR."_MyStract.php";

class IndexController extends IAuthController{
    public function __pre_invoke_handler($func, $name) {
        $sid = Form::get("sch_id");

        Model::set("back", Meta::get_url());
        
        if($func == "-"){
        }elseif($name == "add"){
            Meta::breadcrumb( __("add") , "+/add"."?sch_id=".$sid);
        }elseif($name == "edit"){
            Meta::breadcrumb( __("edit") , "+/edit"."?sch_id=".$sid);
        }elseif($name == "del"){
            Meta::breadcrumb( __("delete") , "+/del"."?sch_id=".$sid);
        }else{
        }
    }

    public function index(){
        $fi = new FileInfo(MyStract::DB_PATH());
        if(!$fi->exists()){
            return Response::redirect(Meta::get_url("setup")); 
        }
        $f = new DbSchListForm();
        $f->load();
        
        return "";
    }
    public function setup(){
        $st = MyStract::get();
        $fi = new FileInfo(MyStract::DB_PATH());
        try {
            $r = $st->setup();
            Message::addInfo("Created: ".$fi->fullName()." ({$r})");
            Message::toRedirect();
        } catch (Exception $ex) {
            Message::addError( "Error: ", $ex->getMessage() );
            Message::toRedirect();
        }
        return Response::redirect(Meta::get_url());
    }
    
    //
    public function add(){
        $f = new DbSchForm();
        $f->load();
        return "add";
    }
    public function _post_add(){
        $f = new DbSchForm();
        $f->save();
        Message::addInfo("add");
        return Response::redirect(Model::get("back"));
    }
    
    public function edit(){
        $f = new DbSchForm();
        $f->load();
        return "edit";
    }
    public function _post_edit(){
        $f = new DbSchForm();
        $f->save();
        Message::addInfo("Save");
        return "edit";
    }

    public function del(){
        $f = new DbSchForm();
        $f->load();
        return "del";
    }
    public function _post_del(){
        $f = new DbSchForm();
        $f->delete();
        Message::addInfo("deleted");
        return Response::redirect(Model::get("back"));
    }
}

//Lists
class DbSchListForm extends IForm{
    public $list;
    public function load(){
        $st = MyStract::get();
        $this->list = $st->get_schs();
    }
}

//Edits
class DbSchForm extends IForm{
    use \DB\Libs\Entity\__Sch;
    
    public function load(){
        if(StringUtil::isNotEmpty($this->sch_id)){
            $st = MyStract::get();
            $this->bindData($st->get_sch($this->sch_id));
        }
    }
    public function save(){
        $st = MyStract::get();
        $e = new DB\Libs\Entity\Sch($this);
        $this->sch_id = $st->set_sch($e);
    }
    
    public function delete(){
        
        $sch_id = $this->sch_id;
        $st = MyStract::get();
        
        $st->beginTran();
        try{
            $st->del_sch($sch_id);
            $st->commit();
        } catch (Exception $ex) {
            $st->rollback();
            throw $ex;
        }
    }
}
?>