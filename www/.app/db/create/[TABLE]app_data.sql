/*-------------------------------
 PHISYCAL: app_data
 LOGICAL : 固定データ
 COMMENT : 固定文言やJsonなど
-------------------------------*/
/* DORP TABLE */
DROP TABLE  IF EXISTS `app_data`;

CREATE TABLE `app_data`(
  `key` VARCHAR(20) NOT NULL COMMENT 'キー',
  `data` TEXT NOT NULL COMMENT 'データ',
  `attr` VARCHAR(45) COMMENT '属性\nフリー',
  `created_at` DATETIME DEFAULT current_timestamp COMMENT '登録日',
  `updated_at` TIMESTAMP COMMENT '更新日'
,  PRIMARY KEY (`key`)

)
COMMENT '固定データ\n固定文言やJsonなど'
;