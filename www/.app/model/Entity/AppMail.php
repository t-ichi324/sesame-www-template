<?php namespace Entity;
/**
 * <b>entity</b> @ app_mail<br>
 * - <b>logical : </b>メール
 * - <b>physical : </b>app_mail
 * - <b>comment : </b>自動送信用メールテンプレート
**/
class AppMail extends \IEntity{
    use __AppMail;
    /** @return string "app_mail" (<b>table</b> or <b>view</b> name). */
    public static function TABLE(){
        return "app_mail";
    }
    /** @return string "app_mail" (<b>xml-sql</b> file name). */
    public static function XML(){
        return "app_mail";
    }
}

/**
 * <b>trait</b> @ app_mail<br>
 * - <b>logical : </b>メール
 * - <b>physical : </b>app_mail
 * - <b>comment : </b>自動送信用メールテンプレート
**/
trait __AppMail{
    /**
     * - <b>logical : </b>トリカー
     * - <b>physical : </b>trigger
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>20
     * - <b>primary</b>
     * - <b>notnull</b>
    **/
    public $trigger;
    /**
     * - <b>logical : </b>タイトル
     * - <b>physical : </b>subject
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>255
     * - <b>notnull</b>
    **/
    public $subject;
    /**
     * - <b>logical : </b>送信者アドレス
     * - <b>physical : </b>sender_addr
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>255
     * - <b>notnull</b>
    **/
    public $sender_addr;
    /**
     * - <b>logical : </b>送信者名
     * - <b>physical : </b>sender_name
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>255
     * - <b>notnull</b>
    **/
    public $sender_name;
    /**
     * - <b>logical : </b>CC
     * - <b>physical : </b>cc
     * - <b>type : </b>TEXT
     * - <b>comment : </b>カンマ区切り
    **/
    public $cc;
    /**
     * - <b>logical : </b>BCC
     * - <b>physical : </b>bcc
     * - <b>type : </b>TEXT
     * - <b>comment : </b>カンマ区切り
    **/
    public $bcc;
    /**
     * - <b>logical : </b>本文
     * - <b>physical : </b>body
     * - <b>type : </b>TEXT
    **/
    public $body;
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
