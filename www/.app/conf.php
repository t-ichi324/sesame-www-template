<?php
define("USE_VIEW_CACHE", true);
define("USE_ROUTE_CACHE", true);
define("USE_SYS_CACHE", true);
define("USE_HEADER_CACHE", true);
define("COOKIE_NAME", "gid");

include_once __DIR__.'/functions.php';
include_once __DIR__.'/version.php';

define("ENV_FILE", __DIR__."/env.txt");
//環境により切り替えるもの
if(Env::isDev()){ 
    include_once Conf::DIR_DB.'db-conf-dev.php'; 
}elseif(Env::isTest()){
    include_once Conf::DIR_DB.'db-conf-test.php'; 
}else{
    include_once Conf::DIR_DB.'db-conf-real.php'; 
}

class Conf {
    const SITE_NAME  = "Template";
    const SITE_HOME_NAME = "Template";
    const DESCRIPTION = "Template-DESCRIPTION";
    const TITLE_DELIMITER = " - ";
    const COPY_RIGHT = "© example.com";
    const AUHTOR = "example.com";
    
    const ROUTEING_CONF = "routeing.php";
    const ERROR_ROUTEING = "error/code";
    const ERROR_VIEW = ".err";
    const ZONE_ID = "Asia/Tokyo";
    const TIME_lIMIT = 30;      // 0:unlimit
    const MEMORY_LIMIT = -1;    // -1:unlimit
    
    const REMEMBER_COOKIE_NAME = "remember";
    const REMEMBER_COOKIE_PASSWORD = "cookie-password";
    const REMEMBER_EXPIRE_DAY = 3;
    
    const USER_PW_MIN = 3;
    const USER_PW_LEVEL = 1;
    
    const DIR_APP   = __DIR__."/";
    const DIR_PUB   = Self::DIR_APP."../";
    const DIR_DB    = Self::DIR_APP."db/";
    const DIR_LIB   = Self::DIR_APP."lib/";
    const DIR_TMP   = Self::DIR_APP.".tmp/";
    const DIR_LOG   = Self::DIR_TMP."log/";
}

class User extends IAuthUser {
    public $id;
    public $email;
    public $name;
    public $company;
    public $roles;
    public $term_start;
    public $term_end;
    public $is_ban;
    
    /* Login / Remember時に１度だけ呼ばれる。 */
    public static function GET_AUTH_KEY(array $cert) {
        $param = [
            "id" => $cert["loginId"],
            "pw" => UserUtil::PW_HASH($cert["password"])
        ];
        
        $x = new DbXml();
        $akey = $x->file("sys/auth")->sql("login", $param)->selectFirst();
        
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
    
    public function getRoles(){
        return explode(',', $this->roles);
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
