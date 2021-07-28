/*-------------------------------
 PHISYCAL: user_log
 LOGICAL : ユーザログ
 COMMENT : PKなしのログ
-------------------------------*/
/* DORP TABLE */
DROP TABLE  IF EXISTS `user_log`;

CREATE TABLE `user_log`(
  `user_id` INT(11) NOT NULL DEFAULT 0 COMMENT 'ユーザID\nuser_sys : id',
  `cl` VARCHAR(20) NOT NULL COMMENT '種別\napp_kv : key',
  `note` VARCHAR(255) COMMENT 'ノート',
  `url` TEXT COMMENT 'URL',
  `session_id` VARCHAR(255) COMMENT 'セッションID',
  `ip` VARCHAR(255) COMMENT 'ユーザエージェント',
  `user_agent` TEXT COMMENT 'IPアドレス',
  `created_at` DATETIME NOT NULL DEFAULT current_timestamp COMMENT '作成日'

)
COMMENT 'ユーザログ\nPKなしのログ'
;