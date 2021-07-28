<?php namespace Entity;
/**
 * <b>entity</b> @ user_log<br>
 * - <b>logical : </b>ユーザログ
 * - <b>physical : </b>user_log
 * - <b>comment : </b>PKなしのログ
**/
class UserLog extends \IEntity{
    use __UserLog;
    /** @return string "user_log" (<b>table</b> or <b>view</b> name). */
    public static function TABLE(){
        return "user_log";
    }
    /** @return string "user_log" (<b>xml-sql</b> file name). */
    public static function XML(){
        return "user_log";
    }
}

/**
 * <b>trait</b> @ user_log<br>
 * - <b>logical : </b>ユーザログ
 * - <b>physical : </b>user_log
 * - <b>comment : </b>PKなしのログ
**/
trait __UserLog{
    /**
     * - <b>logical : </b>ユーザID
     * - <b>physical : </b>user_id
     * - <b>type : </b>INT
     * - <b>size : </b>11
     * - <b>def : </b>0
     * - <b>notnull</b>
     * - <b>comment : </b>user_sys : id
    **/
    public $user_id;
    /**
     * - <b>logical : </b>種別
     * - <b>physical : </b>cl
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>20
     * - <b>notnull</b>
     * - <b>comment : </b>app_kv : key
    **/
    public $cl;
    /**
     * - <b>logical : </b>ノート
     * - <b>physical : </b>note
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>255
    **/
    public $note;
    /**
     * - <b>logical : </b>URL
     * - <b>physical : </b>url
     * - <b>type : </b>TEXT
    **/
    public $url;
    /**
     * - <b>logical : </b>セッションID
     * - <b>physical : </b>session_id
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>255
    **/
    public $session_id;
    /**
     * - <b>logical : </b>ユーザエージェント
     * - <b>physical : </b>ip
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>255
    **/
    public $ip;
    /**
     * - <b>logical : </b>IPアドレス
     * - <b>physical : </b>user_agent
     * - <b>type : </b>TEXT
    **/
    public $user_agent;
    /**
     * - <b>logical : </b>作成日
     * - <b>physical : </b>created_at
     * - <b>type : </b>DATETIME
     * - <b>def : </b>current_timestamp
     * - <b>notnull</b>
    **/
    public $created_at;
}
?>
