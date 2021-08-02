<?php
//@ META ===================================
//@=========================================

class UploadController extends IController{
    public function index() {
        $ret = new UploadInfo();
        $ret->allow = ini_get("file_uploads");
        
        $ret->maxsize = $this->return_bytes(ini_get("upload_max_filesize"));
        
        $post = $this->return_bytes(ini_get("post_max_size"));
        if($post > 0 && $post < $ret->maxsize){
            $ret->maxsize = $post;
        }
        
        $mem = $this->return_bytes(ini_get("memory_limit"));
        if($mem > 0 && $mem < $ret->maxsize){
            $ret->maxsize = $mem;
        }
        
        return Response::json($ret);
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
    
    private function return_bytes($val) {
        $val = trim($val);
        $int = intval($val);
        $last = strtolower($val[strlen($val)-1]);
        switch($last) {
            case 'g':
                $int *= 1024;
            case 'm':
                $int *= 1024;
            case 'k':
                $int *= 1024;
        }
        return $int;
    }
}
class UploadInfo{
    public $allow;
    public $maxsize;
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