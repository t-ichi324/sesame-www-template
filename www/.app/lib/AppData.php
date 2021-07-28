<?php
class AppData{
    public static function get($key){
        $x = new DbXml();
        $e = $x->file_Entity(\Entity\AppData::class)->sql("get", ["key"=>$key])->selectFirst();
        if($e != null){
            $e instanceof Entity\AppData;
        }
        return $e;
    }
    
    public static function getData($key){
        $x = new DbXml();
        return $x->file_Entity(\Entity\AppData::class)->sql("get", ["key"=>$key])->getValue("data");
    }
    public static function getDate($key, $format = "Y-m-d"){
        $x = new DbXml();
        $dt = $x->file_Entity(\Entity\AppData::class)->sql("get", ["key"=>$key])->getValue("updated_at");
        if($dt === null){ return ""; }
        return date($format, strtotime($dt));
    }
    
    public static function echoData($key){
        $e = self::get($key);
        if(!empty($e)){
            $e instanceof \Entity\AppData;
            $attr = StringUtil::lowerCase($e->attr);
            if($attr === "raw" || $attr === "html"){
                echo $e->data;
            }else{
                echo StringUtil::toHtmlText($e->data);
            }
        }
    }
    
    public static function save($key, $data){
        $x = new DbXml();
        $x->file("app_data")->sql("save")->bind("key", $key)->bind("data", $data);
        $x->execute();
    }
}
?>