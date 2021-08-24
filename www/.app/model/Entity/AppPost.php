<?php namespace Entity;
/**
 * <b>entity</b> @ app_post<br>
 * - <b>logical : </b>sys used
 * - <b>physical : </b>app_post
 * - <b>comment : </b>Simple CMS
**/
class AppPost extends \IEntity{
    use __AppPost;
    /** @return string "app_post" (<b>table</b> or <b>view</b> name). */
    public static function TABLE(){
        return "app_post";
    }
    /** @return string "app_post" (<b>xml-sql</b> file name). */
    public static function XML(){
        return "app_post";
    }
}

/**
 * <b>trait</b> @ app_post<br>
 * - <b>logical : </b>sys used
 * - <b>physical : </b>app_post
 * - <b>comment : </b>Simple CMS
**/
trait __AppPost{
    /**
     * - <b>logical : </b>post id
     * - <b>physical : </b>id
     * - <b>type : </b>INT
     * - <b>size : </b>11
     * - <b>primary(AI)</b>
     * - <b>notnull</b>
    **/
    public $id;
    /**
     * - <b>logical : </b>category
     * - <b>physical : </b>cl
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>45
     * - <b>notnull</b>
     * - <b>comment : </b>app_kv
    **/
    public $cl;
    /**
     * - <b>logical : </b>post status
     * - <b>physical : </b>status
     * - <b>type : </b>INT
     * - <b>size : </b>1
     * - <b>def : </b>0
     * - <b>notnull</b>
     * - <b>comment : </b>0: private, 1: public
    **/
    public $status;
    /**
     * - <b>logical : </b>post title
     * - <b>physical : </b>title
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>255
     * - <b>notnull</b>
    **/
    public $title;
    /**
     * - <b>logical : </b>post content
     * - <b>physical : </b>content
     * - <b>type : </b>LONGTEXT
    **/
    public $content;
    /**
     * - <b>logical : </b>description
     * - <b>physical : </b>description
     * - <b>type : </b>TEXT
    **/
    public $description;
    /**
     * - <b>logical : </b>image name
     * - <b>physical : </b>img
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>255
    **/
    public $img;
    /**
     * - <b>logical : </b>layout name
     * - <b>physical : </b>layout
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>255
    **/
    public $layout;
    /**
     * - <b>logical : </b>create date
     * - <b>physical : </b>created_at
     * - <b>type : </b>DATETIME
     * - <b>def : </b>current_timestamp
    **/
    public $created_at;
    /**
     * - <b>logical : </b>update date
     * - <b>physical : </b>updated_at
     * - <b>type : </b>TIMESTAMP
    **/
    public $updated_at;
}
?>
