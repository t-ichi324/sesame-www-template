<?php namespace Entity;
/**
 * <b>entity</b> @ app_data<br>
 * - <b>logical : </b>固定データ
 * - <b>physical : </b>app_data
 * - <b>comment : </b>固定文言やJsonなど
**/
class AppData extends \IEntity{
    use __AppData;
    /** @return string "app_data" (<b>table</b> or <b>view</b> name). */
    public static function TABLE(){
        return "app_data";
    }
    /** @return string "app_data" (<b>xml-sql</b> file name). */
    public static function XML(){
        return "app_data";
    }
}

/**
 * <b>trait</b> @ app_data<br>
 * - <b>logical : </b>固定データ
 * - <b>physical : </b>app_data
 * - <b>comment : </b>固定文言やJsonなど
**/
trait __AppData{
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
     * - <b>logical : </b>データ
     * - <b>physical : </b>data
     * - <b>type : </b>TEXT
     * - <b>notnull</b>
    **/
    public $data;
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
