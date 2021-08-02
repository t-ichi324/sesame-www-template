<?php
//@ META ===================================
//@=========================================

class UploadController extends IController{
    public function index() {
        return Response::notFound();
    }
    
    public function _post_index(){
        $ret = new UploadResult();
        $ret->err = 1;
        if(isset($_FILES["file"])){
            try{
                $ret->size = filesize($_FILES['file']['tmp_name']);
                $ret->tmp_name = sha1($_FILES["file"]["tmp_name"]);
                $ret->name = $_FILES["file"]["name"];

                $na = explode(".", $ret->name);
                if(count($na) > 1){ $ret->ext = ".".end($na); }
                $ret->tmp_name .= $ret->ext;
                $ret->tmp_url = Url::get(Request::getUrl(), $ret->tmp_name);

                move_uploaded_file($_FILES['file']['tmp_name'], Path::upload($ret->tmp_name));
                $ret->err = 0;
            } catch (Exception $ex) {
                $ret->err_msg = $ex->getMessage();
            }
        }
        return Response::json($ret);
    }
    
    public function __id($name) {
        $f = Path::upload($name);
        if(file_exists($f)){
            return Response::file($f);
        }
        return Response::notFound();
    }
}
class UploadResult{
    public $err;
    public $err_msg;
    public $name;
    public $size;
    public $ext;
    public $tmp_name;
    public $tmp_url;
}