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

class ContentConf{
    const DIR_UPLOAD = "/contents/upload/";
    const DIR_USER = "/contents/user/";
    const NO_IMAGE = "/img/no-image.png";
    const NO_AVATAR = "/img/no-avatar.png";
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

include_once __DIR__.'/conf-user.php';
