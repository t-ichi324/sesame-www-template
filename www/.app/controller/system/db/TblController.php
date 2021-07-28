<?php
//@ Assign ===============================
include __DIR__."/-meta.php";

Meta::vprefix("+/tbl");
//@=========================================

include_once __DIR__.DIRECTORY_SEPARATOR."_MyStract.php";

class TblController extends IAuthController{
    public function __pre_invoke_handler($func, $name) {
        $sid = Form::get("sch_id");
        $tid = Form::get("tbl_id");

        Meta::breadcrumb("TABLE", "+/tbl"."?sch_id=".$sid);
        
        Model::set("back", Meta::get_url());
        Model::set("ajaxlist", Meta::get_url("list"));
        
        if($func == "-"){
        }elseif($name == "add"){
            Meta::breadcrumb( __("add"), "+/add"."?tbl_id=".$tid);
        }elseif($name == "edit"){
            Meta::breadcrumb( __("edit"), "+/edit"."?tbl_id=".$tid);
        }elseif($name == "del"){
            Meta::breadcrumb( __("delete"), "+/del"."?tbl_id=".$tid);
        }elseif($name == "import"){
            Meta::breadcrumb( __("import") , "+/import"."?tbl_id=".$tid);
        }elseif($name == "imjson"){
            Meta::breadcrumb("ImportJson", "+/imjson");
        }
    }

    public function index(){
        $f = new DbTblListForm();
        $f->load();
        return "";
    }
    public function _get_list(){
        $f = new DbTblListForm();
        $f->load();
        return "list";
    }
    
    public function add(){
        $f = new DbTblEditForm();
        $st = MyStract::get();
        Model::set("tbls", $st->get_tbls($f->sch_id));
        return "add";
    }
    public function _post_add(){
        $f = new DbTblEditForm();
        $f->save();
        return Response::redirect(Model::get("back"));
    }
    
    public function del(){
        $f = new DbTblEditForm();
        $st = MyStract::get();
        $f->phy_name = $st->get_tbl_name($f->tbl_id);
        return "del";
    }
    public function _post_del(){
        $f = new DbTblEditForm();
        $f->delete();
        return Response::redirect(Model::get("back"));
    }

    public function edit(){
        $f = new DbTblEditForm();
        $f->load();
        return "edit";
    }
    public function _post_edit(){
        $f = new DbTblEditForm();
        $f->array2enties_list();
        $f->save();
        return "edit";
    }
    public function export(){
        $f = new DbTblEditForm();
        $st = MyStract::get();
        $gen = $st->export_csv($f->tbl_id);
        return Response::download($gen["file"], $gen["name"].".csv");
    }
    public function import(){
        $f = new DbTblEditForm();
        $st = MyStract::get();
        $f->phy_name = $st->get_tbl_name($f->tbl_id);
        return "import";
    }
    public function _post_import(){
        $f = new DbTblEditForm();
        $file = $_FILES["importfile"];
        if(!empty($file)){
            $st = MyStract::get();
            if($st->import_csv($f->tbl_id, $file["tmp_name"])){
                Message::addSuccess(  __("done")  );
                return "import";
            }
        }
        Message::addError( __("error") );
        return "import";
    }
    
    public function exjson(){
        $f = new DbTblEditForm();
        $st = MyStract::get();
        $gen = $st->export_json($f->tbl_id);
        return Response::download($gen["file"], $gen["name"].".json");
    }
    public function imjson(){
        $f = new DbTblEditForm();
        $f->tbl_id = "";
        $f->phy_name = "JSONから新規テーブルを作成";
        return "imjson";
    }
    public function _post_imjson(){
        $f = new DbTblEditForm();
        $file = $_FILES["importfile"];
        if(!empty($file)){
            $st = MyStract::get();
            if($st->import_json($f->sch_id, $file["tmp_name"])){
                Message::addSuccess( __("done") );
                return "imjson";
            }
        }
        Message::addError( __("error") );
        return "imjson";
    }
    
    public function genEntity(){
        return $this->genResponse("entity");
    }
    
    public function genCreate(){
        return $this->genResponse("create");
    }
    
    public function genXmlsql(){
        return $this->genResponse("sqlxml");
    }
    
    private function genResponse($x){
        $f = new DbGenFileForm();
        if(StringUtil::isEmpty($f->sch_id)){ return Response::notFound(); }
        
        $st = MyStract::get();
        
        //１つ
        if(StringUtil::isNotEmpty($f->tbl_id)){
            $gen = $this->genX($st, $f->tbl_id, $x);
            if($gen === null){ Response::notFound(); }
            return Response::textDownload($gen["data"], $gen["filename"]);
        }
        
        //まとめてZip
        $d = new DirectoryInfo(Path::download_tmpdirectory());
        $d->make();
        $zipname = $d->fullName().".zip";
        $dlname = $st->get_sch_name($f->sch_id).".zip";
        
        $tbls = $st->get_tbls($f->sch_id);
        foreach($tbls as $tbl){
            $gen = $this->genX($st, $tbl->tbl_id, $x);
            if($gen === null){ continue; }
            $f = new FileInfo(Path::combine($d->fullName(), $gen["filename"]));
            $f->save($gen["data"]);
        }
        
        $zip = new ZipUtil();
        $zip->toZip($d->fullName(), $zipname);
        return Response::download($zipname, $dlname);
    }
    private function genX(DB\Libs\DbStracts $st, $tbl_id, $x){
        if($x == "sqlxml"){
            return $st->gen_sql_xml($tbl_id);
        }
        if($x == "create"){
            return $st->gen_create_sql($tbl_id);
        }
        if($x == "entity"){
            return $st->gen_entity_php($tbl_id);
        }
        return null;
    }
}


class DbTblListForm extends IForm{
    public $sch_id;
    public $tbl_id;
    public $list;
    public function load(){
        $st = MyStract::get();
        $this->sch_name = $st->get_sch_name($this->sch_id);
        $this->list = $st->get_tbls($this->sch_id);
    }
}

class DbTblEditForm extends IForm{
    use \DB\Libs\Entity\__Tbl;
    public $list;
    public $copy_by;

    public function load(){
        if(StringUtil::isNotEmpty($this->tbl_id)){
            $st = MyStract::get();
            $this->bind($st->get_tbl($this->tbl_id));
            $this->list = $st->get_flds($this->tbl_id);
        }
    }
    
    public function array2enties_list(){
        $tmp = array();
        if(!empty($this->list)){
            foreach($this->list as $r){ $tmp[] = new \DB\Libs\Entity\Fld($r); }
        }
        $this->list = $tmp;
    }
    
    public function save(){
        $e = new \DB\Libs\Entity\Tbl($this->toArray("list"));
        $st = MyStract::get();
        
        $st->beginTran();
        try{
            $this->tbl_id = $st->set_tbl($e);
            $e->tbl_id = $this->tbl_id;
            
            $st->del_tbl_fld($this->tbl_id);
            if(!empty($this->copy_by)){
                $this->list = $st->get_flds($this->copy_by);
            }
            
            $fid = 1;
            if(!empty($this->list)){
                foreach($this->list as $f){
                    $f instanceof \DB\ext\Entity\Fld;
                    $f->sch_id = $e->sch_id;
                    $f->tbl_id = $e->tbl_id;
                    $f->fld_id = $fid;
                    $st->set_fld($f);
                    $fid++;
                }
            }
            
            $st->commit();
        } catch (Exception $ex) {
            $st->rollback();
            throw $ex;
        }
    }
    
    public function delete(){
        $tbl_id = $this->tbl_id;
        $st = MyStract::get();
        
        $st->beginTran();
        try{
            $st->del_tbl($tbl_id);
            $st->commit();
        } catch (Exception $ex) {
            $st->rollback();
            throw $ex;
        }
    }
}

class DbGenFileForm extends IForm{
    public $sch_id;
    public $tbl_id;
    
    public function hasError() {
        Validator::required($this->sch_id, "SchID");
        return Validator::hasError();
    }
}
?>