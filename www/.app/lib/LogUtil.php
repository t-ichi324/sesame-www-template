<?php
class LogUtil{
    private static function add($cl, $userId, $note = null, $url = null){
        if(StringUtil::isEmpty($url)){
            $url = Request::getUrl();
        }
        $q = new DbQuery();
        $q->_log(-1);
        $q->table("user_log");
        $q->set("user_id", $userId);
        $q->set("cl", $cl);
        $q->set("url", $url);
        $q->set("note", $note);
        $q->set("session_id", Auth::getSessionId())
            ->set("user_agent", Request::getUserAgent())
            ->set("ip", Request::getRemoteAddr());
        $q->insert();
    }
    
    public static function login($user_id, $note = null){
        self::add("login", $user_id, $note);
    }
    public static function logout($user_id, $note = null){
        self::add("logout", $user_id, $note);
    }
    public static function action($cl, $note = null, $url = null){
        $user_id = Auth::getVal("id");
        self::add($cl, $user_id, $note, $url);
    }
}
?>