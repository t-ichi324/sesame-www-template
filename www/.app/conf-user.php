<?php
class User extends IAuthUser {
    public $id;
    public $email;
    public $name;
    public $company;
    public $roles;
    public $term_start;
    public $term_end;
    public $is_ban;
    public $is_tfa;
    
    /* Login / Remember時に１度だけ呼ばれる。 */
    public static function GET_AUTH_KEY(array $cert) {
        $x = new DbXml();
            
        if(!isset($cert["oauth"])){
            //Email / Password
            $param = ["id" => $cert["loginId"], "pw" => UserUtil::PW_HASH($cert["password"])];
            $akey = $x->file("sys/auth")->sql("login", $param)->selectFirst();
            
        }else{
            //OAuth
            $param = ["id" => $cert["loginId"], "attr"=>$cert["oauth"]];
            $akey = $x->file("sys/auth")->sql("login-oauth", $param)->selectFirst();
        }
        
        if(!empty($akey)){
            $x->file("sys/auth")->sql("sid", ["id"=>$akey["id"], "session_id"=>session_id()])->execute();
            LogUtil::login($akey["id"]);
        }
        return $akey;
    }
    
    /* リクエスト時毎にコールされる */
    public static function GET_FETCH_DATA(array $akey) {
        $param = [
            "id" => $akey["id"],
            "session_id" => session_id()
        ];
        $x = new DbXml();
        return $x->file("sys/auth")->sql("data", $param)->selectFirst();
    }
    
    /** ロールの取得 */
    public function getRoles(){
        return explode(',', $this->roles);
    }
    
    /** 2段階認証ユーザ */
    public function is2fa() {
        return Flags::isON($this->is_tfa);
    }

    protected function after_fetch() {
        //term
        $termerr = false;
        $cDate = strtotime(now());
        if(!empty($this->term_start) && strtotime($this->term_start) > $cDate){ $termerr = true; }
        if(!empty($this->term_end) && strtotime($this->term_end) < $cDate){ $termerr = true; }
        if($termerr){
            self::THROW_ERROR_REASON( __("error.auht-term", $this->term_start, $this->term_end) );
        }
        //BAN
        if(Flags::isON($this->is_ban)){
            self::THROW_ERROR_REASON( __("error.auht-ban") );
        }
    }
}
