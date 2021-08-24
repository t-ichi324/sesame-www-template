<?php

class AsyncUploadImg {
    public static function saveToPub($tmp_name, $pub_name, $pub_dir, $make_YM_dir = false){
        Path::upload("asyncupload");
        
        $ym = ($make_YM_dir) ? date("Y/m") : "";
        $di = new DirectoryInfo(Path::pub($pub_dir, $ym));
        
        $tmp = Form::getVal($tmp_name);
        $pub = Form::getVal($pub_name);
        if(StringUtil::isEmpty($tmp)){ return false; }
        
        $fi = new FileInfo(Path::upload($tmp));
        if($fi->exists()){
            $di->make();
            if(!$di->exists()){ return false; }
            
            $name = $fi->name(true);
                
            $to = Path::combine($di->fullName(), $name);
            $fi->rename($to);
            
            if(StringUtil::isNotEmpty($pub)){
                $fip = new FileInfo(Path::pub($pub_dir, $pub));
                $fip->delete();
            }
            
            Form::setVal($pub_name, $ym."/".$name);
            Form::setVal($tmp_name, null);
            return true;
        }
        return false;
    }
    
    public static function getSrcPub($tmp_name, $pub_dir, $empty_file){
        $filename = Form::get($tmp_name);
        if(StringUtil::isNotEmpty($filename)){
            return Url::get($pub_dir, $filename);
        }else{
            return Url::get($empty_file);
        }
    }
    
    public static function rendForm($tmp_name, $pub_name, $pub_dir, $empty_file, $class_name = null){
        $tval = Form::get($tmp_name);
        $pval = Form::get($pub_name);
        if(StringUtil::isNotEmpty($tval)){
            $src = Url::get($pub_dir, $tval);
        }elseif(StringUtil::isNotEmpty($pval)){
            $src = Url::get($pub_dir, $pval);
        }else{
            $src = null;
        }
        
        $parts = array();
        $parts["src"] = $src;
        $parts["pname"] = $pub_name;
        $parts["pval"] = $pval;
        $parts["tname"] = $tmp_name;
        $parts["tval"] = $tval;
        
        $parts["empty"] = StringUtil::isNotEmpty($empty_file) ? Url::get($empty_file) : "";
        $parts["class"] = ($class_name !== null) ? $class_name : "asyncUpload-area";
        
        Model::set("asyncUpload--parts", $parts);
        
        Render::echoRequire("/layout/asset/asyncUploadImg");
    }
}
