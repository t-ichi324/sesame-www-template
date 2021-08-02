<?php namespace Entity;
/**
 * <b>entity</b> @ user<br>
 * - <b>logical : </b>User view
 * - <b>physical : </b>user
**/
class User extends \IEntity{
    use __User;
    /** @return string "user" (<b>table</b> or <b>view</b> name). */
    public static function TABLE(){
        return "user";
    }
    /** @return string "user" (<b>xml-sql</b> file name). */
    public static function XML(){
        return "user";
    }
}

/**
 * <b>trait</b> @ user<br>
 * - <b>logical : </b>User view
 * - <b>physical : </b>user
**/
trait __User{
    /**
     * - <b>logical : </b>ユーザID
     * - <b>physical : </b>id
     * - <b>type : </b>INT
     * - <b>size : </b>11
     * - <b>primary(AI)</b>
     * - <b>notnull</b>
    **/
    public $id;
    /**
     * - <b>logical : </b>パスワード
     * - <b>physical : </b>password
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>255
     * - <b>notnull</b>
     * - <b>comment : </b>Hash衝突比較
    **/
    public $password;
    /**
     * - <b>logical : </b>権限
     * - <b>physical : </b>roles
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>255
     * - <b>comment : </b>カンマ区切り
    **/
    public $roles;
    /**
     * - <b>logical : </b>削除済み
     * - <b>physical : </b>is_deleted
     * - <b>type : </b>INT
     * - <b>size : </b>1
     * - <b>def : </b>0
     * - <b>notnull</b>
     * - <b>comment : </b>1:削除済み
    **/
    public $is_deleted;
    /**
     * - <b>logical : </b>利用停止
     * - <b>physical : </b>is_ban
     * - <b>type : </b>INT
     * - <b>size : </b>1
     * - <b>def : </b>0
     * - <b>notnull</b>
     * - <b>comment : </b>1:BAN
    **/
    public $is_ban;
    /**
     * - <b>logical : </b>同時ログイン判定
     * - <b>physical : </b>is_single
     * - <b>type : </b>INT
     * - <b>size : </b>1
     * - <b>def : </b>0
     * - <b>notnull</b>
     * - <b>comment : </b>1:重複ログイン判定
    **/
    public $is_single;
    /**
     * - <b>logical : </b>2段階認証
     * - <b>physical : </b>is_tfa
     * - <b>type : </b>INT
     * - <b>size : </b>1
     * - <b>def : </b>0
     * - <b>notnull</b>
    **/
    public $is_tfa;
    /**
     * - <b>logical : </b>セッションID
     * - <b>physical : </b>session_id
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>255
    **/
    public $session_id;
    /**
     * - <b>logical : </b>利用開始
     * - <b>physical : </b>term_start
     * - <b>type : </b>DATE
    **/
    public $term_start;
    /**
     * - <b>logical : </b>利用期限
     * - <b>physical : </b>term_end
     * - <b>type : </b>DATE
    **/
    public $term_end;
    /**
     * - <b>logical : </b>通知
     * - <b>physical : </b>notice
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>255
    **/
    public $notice;
    /**
     * - <b>logical : </b>トークン
     * - <b>physical : </b>token
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>255
    **/
    public $token;
    /**
     * - <b>logical : </b>属性
     * - <b>physical : </b>attr
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>45
    **/
    public $attr;
    /**
     * - <b>logical : </b>備考
     * - <b>physical : </b>remarks
     * - <b>type : </b>TEXT
    **/
    public $remarks;
    /**
     * - <b>logical : </b>メールアドレス
     * - <b>physical : </b>email
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>255
     * - <b>notnull</b>
    **/
    public $email;
    /**
     * - <b>logical : </b>氏名
     * - <b>physical : </b>name
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>255
     * - <b>notnull</b>
     * - <b>comment : </b>システム側で重複チェック
    **/
    public $name;
    /**
     * - <b>logical : </b>氏名（カナ）
     * - <b>physical : </b>kana
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>255
    **/
    public $kana;
    /**
     * - <b>logical : </b>会社名
     * - <b>physical : </b>company
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>255
    **/
    public $company;
    /**
     * - <b>logical : </b>部署
     * - <b>physical : </b>branch
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>50
    **/
    public $branch;
    /**
     * - <b>logical : </b>役職
     * - <b>physical : </b>post
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>50
    **/
    public $post;
    /**
     * - <b>logical : </b>住所１
     * - <b>physical : </b>addr1
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>255
    **/
    public $addr1;
    /**
     * - <b>logical : </b>住所２
     * - <b>physical : </b>addr2
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>255
    **/
    public $addr2;
    /**
     * - <b>logical : </b>電話
     * - <b>physical : </b>tel
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>20
    **/
    public $tel;
    /**
     * - <b>logical : </b>FAX
     * - <b>physical : </b>fax
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>20
    **/
    public $fax;
    /**
     * - <b>logical : </b>郵便番号
     * - <b>physical : </b>zip_code
     * - <b>type : </b>VARCHAR
     * - <b>size : </b>10
    **/
    public $zip_code;
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
