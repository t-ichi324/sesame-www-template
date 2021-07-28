<?php
class AppKv{
    public static function SQL_NAME_FIELD_QUERY($kv_cl, $baseField, $find_in_set = false){
        if($find_in_set){
            $sql = "SELECT GROUP_CONCAT(kv.val order by kv.sort) AS nm FROM app_kv kv WHERE kv.cl = '".$kv_cl."' AND FIND_IN_SET( kv.`key`, ".$baseField." )";
        }else{
            $sql = "SELECT MAX(val) AS nm FROM app_kv kv WHERE kv.cl = '".$kv_cl."' AND kv.`key` = ".$baseField."";
        }
        return $sql;
    }
    /*------------------------------------------------------------------------*/
    
    /** クエリを取得 */
    public static function query($cl){
        $q = new \DbQuery();
        $q->table_Entity(Entity\AppKv::class)->where("cl", $cl)->ordrBy("sort","key");
        return $q;
    }
    /** 配列(key => val)を取得 */
    public static function keyVal($cl){
        $rows = self::query($cl)->select("key","val");
        $ret = array();
        foreach($rows as $r){
            $k = $r->key;
            $v = $r->val;
            $ret[$k] = $v;
        }
        return $ret;
    }

    public static function getVal($cl, $key){
        return self::query($cl)->ands("key", $key)->getValue("val");
    }
    public static function getAttr($cl, $key){
        return self::query($cl)->ands("key", $key)->getValue("attr");
    }
    public static function isExists($cl, $key){
        return self::query($cl)->ands("key", $key)->isExists();
    }
    
    /** 登録 */
    public static function insertUpdate($cl, $key, $val, $attr, $sort){
        if(StringUtil::isEmpty($cl) || StringUtil::isEmpty($key) || StringUtil::isEmpty($val)){
            return false;
        }
        
        $q = new \DbQuery();
        $find = $q->table_Entity(Entity\AppKv::class)->where("cl", $cl)->ands("key", $key)->isExists();
        
        $q->table_Entity(Entity\AppKv::class);
        if($find){
            $q->where("cl", $cl)->ands("key", $key);
            $q->set("val", $val)->set("attr", $attr)->set("sort", NumUtil::toInt($sort));
            $q->update();
        }else{
            $q->set("val", $val)->set("attr", $attr)->set("sort", NumUtil::toInt($sort));
            $q->set("cl", $cl)->set("key", $key)->set("created_at", now());
            $q->insert();
        }
        return true;
    }
    
    public static function delete($cl, $key){
        if(StringUtil::isEmpty($cl) || StringUtil::isEmpty($key)){
            return false;
        }
        
        $q = new \DbQuery();
        $q->table_Entity(Entity\AppKv::class)->where("cl", $cl)->ands("key", $key)->delete();
        return true;
    }
}
