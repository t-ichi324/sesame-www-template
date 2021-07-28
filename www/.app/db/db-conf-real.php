<?php
class DbConf extends \DB\IConf{
    /* デフォルトコール */
    public static function def() {
        $r = array(
            "driver" => "mysql",
            "dsn" => [
                "host" => "localhost",
                "dbname" => "test_db",
            ],
            "username" => "test",
            "password" => "test123!",
            "charaset" => "utf8",
            "timezone" => "Asia/Tokyo",
            "ATTR_ERRMODE" => 2,
            "ATTR_EMULATE_PREPARES" => true,

            "DIR_SQL" => Conf::DIR_DB."sql",
            "LOG_SELECT_FILE" => Conf::DIR_LOG."db-sel.log",
            "LOG_EXECUTE_FILE" => Conf::DIR_LOG."db-exe.log",
            "LOG_ERROR_FILE" => Conf::DIR_LOG."db-error.log",
        );
        return $r;
    }
}
?>