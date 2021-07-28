<?php namespace Entity;
/**
 * <b>entity</b> @ app_kv<br>
 * - <b>logical : </b>Key&Value
 * - <b>physical : </b>app_kv
 * - <b>comment : </b>キーと値
**/
class AppKv extends \IEntity{
    use __AppKv;
    /** @return string "app_kv" (<b>table</b> or <b>view</b> name). */
    public static function TABLE(){
        return "app_kv";
    }
    /** @return string "app_kv" (<b>xml-sql</b> file name). */
    public static function XML(){
        return "app_kv";
    }
}

/**
 * <b>trait</b> @ app_kv<br>
 * - <b>logical : </b>Key&Value
 * - <b>physical : </b>app_kv
 * - <b>comment : </b>キーと値
**/
trait __AppKv{
    /**
     * - <b>logical : </b>クラス
     * - <b>physical : </b>cl
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>20
     * - <b>primary</b>
     * - <b>notnull</b>
    **/
    public $cl;
    /**
     * - <b>logical : </b>キー
     * - <b>physical : </b>key
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>20
     * - <b>primary</b>
     * - <b>notnull</b>
    **/
    public $key;
    /**
     * - <b>logical : </b>値
     * - <b>physical : </b>val
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>255
     * - <b>notnull</b>
    **/
    public $val;
    /**
     * - <b>logical : </b>並び順
     * - <b>physical : </b>sort
     * - <b>type : </b>INT
     * - <b>size : </b>11
     * - <b>def : </b>0
     * - <b>notnull</b>
    **/
    public $sort;
    /**
     * - <b>logical : </b>属性
     * - <b>physical : </b>attr
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>45
     * - <b>comment : </b>フリー
    **/
    public $attr;
    /**
     * - <b>logical : </b>登録日
     * - <b>physical : </b>created_at
     * - <b>type : </b>DATETIME
     * - <b>def : </b>current_timestamp
    **/
    public $created_at;
    /**
     * - <b>logical : </b>更新日
     * - <b>physical : </b>updated_at
     * - <b>type : </b>TIMESTAMP
    **/
    public $updated_at;
}
?>
