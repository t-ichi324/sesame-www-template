/*-------------------------------
 PHISYCAL: app_kv
 LOGICAL : Key&Value
 COMMENT : キーと値
-------------------------------*/
/* DORP TABLE */
DROP TABLE  IF EXISTS `app_kv`;

CREATE TABLE `app_kv`(
  `cl` VARCHAR(20) NOT NULL COMMENT 'クラス',
  `key` VARCHAR(20) NOT NULL COMMENT 'キー',
  `val` VARCHAR(255) NOT NULL COMMENT '値',
  `sort` INT(11) NOT NULL DEFAULT 0 COMMENT '並び順',
  `attr` VARCHAR(45) COMMENT '属性\nフリー',
  `created_at` DATETIME DEFAULT current_timestamp COMMENT '登録日',
  `updated_at` TIMESTAMP COMMENT '更新日'
,  PRIMARY KEY (`cl`,`key`)

)
COMMENT 'Key&Value\nキーと値'
;