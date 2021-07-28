<?php namespace Entity;
/**
 * <b>entity</b> @ contact<br>
 * - <b>logical : </b>お問合せ
 * - <b>physical : </b>contact
 * - <b>comment : </b>問合せ履歴
**/
class Contact extends \IEntity{
    use __Contact;
    /** @return string "contact" (<b>table</b> or <b>view</b> name). */
    public static function TABLE(){
        return "contact";
    }
    /** @return string "contact" (<b>xml-sql</b> file name). */
    public static function XML(){
        return "contact";
    }
}

/**
 * <b>trait</b> @ contact<br>
 * - <b>logical : </b>お問合せ
 * - <b>physical : </b>contact
 * - <b>comment : </b>問合せ履歴
**/
trait __Contact{
    /**
     * - <b>logical : </b>問い合わせID
     * - <b>physical : </b>id
     * - <b>type : </b>INT
     * - <b>size : </b>11
     * - <b>primary(AI)</b>
     * - <b>notnull</b>
    **/
    public $id;
    /**
     * - <b>logical : </b>問合せ種類
     * - <b>physical : </b>cl
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>20
     * - <b>notnull</b>
    **/
    public $cl;
    /**
     * - <b>logical : </b>確認済み
     * - <b>physical : </b>is_checked
     * - <b>type : </b>INT
     * - <b>size : </b>1
     * - <b>def : </b>0
     * - <b>notnull</b>
     * - <b>comment : </b>0:未確認、1:確認済み
    **/
    public $is_checked;
    /**
     * - <b>logical : </b>削除済み
     * - <b>physical : </b>is_deleted
     * - <b>type : </b>INT
     * - <b>size : </b>1
     * - <b>def : </b>0
     * - <b>notnull</b>
     * - <b>comment : </b>0:有効、1:削除済み
    **/
    public $is_deleted;
    /**
     * - <b>logical : </b>問合せ者名
     * - <b>physical : </b>name
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>255
    **/
    public $name;
    /**
     * - <b>logical : </b>メールアドレス
     * - <b>physical : </b>email
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>255
    **/
    public $email;
    /**
     * - <b>logical : </b>タイトル
     * - <b>physical : </b>subject
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>255
    **/
    public $subject;
    /**
     * - <b>logical : </b>本文
     * - <b>physical : </b>body
     * - <b>type : </b>TEXT
    **/
    public $body;
    /**
     * - <b>logical : </b>IPアドレス
     * - <b>physical : </b>ip
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>255
     * - <b>comment : </b>送信者のIP
    **/
    public $ip;
    /**
     * - <b>logical : </b>ユーザエージェント
     * - <b>physical : </b>user_agent
     * - <b>type : </b>TEXT
     * - <b>comment : </b>送信者のUA
    **/
    public $user_agent;
    /**
     * - <b>physical : </b>remarks
     * - <b>type : </b>TEXT
    **/
    public $remarks;
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
