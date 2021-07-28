<?php
class MyStract{
    public static function DB_PATH(){
        return Path::app("db","MyStract.db");
    }
    public static function get(){
        $LITE = array(
            "driver" => "sqlite",
            "dsn"=> self::DB_PATH(),
            "ATTR_ERRMOD" => true,
            "LOG_SELECT_FILE" => Conf::DIR_LOG."define-sel.log",
            "LOG_EXECUTE_FILE" => Conf::DIR_LOG."define-exe.log",
            "LOG_ERROR_FILE" => Conf::DIR_LOG."define-error.log",
        );
        return new \DB\Libs\DbStracts(new DbQuery($LITE));
    }
}
?>