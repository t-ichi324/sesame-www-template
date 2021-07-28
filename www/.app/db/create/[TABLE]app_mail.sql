/*-------------------------------
 PHISYCAL: app_mail
 LOGICAL : メール
 COMMENT : 自動送信用メールテンプレート
-------------------------------*/
/* DORP TABLE */
DROP TABLE  IF EXISTS `app_mail`;

CREATE TABLE `app_mail`(
  `trigger` VARCHAR(20) NOT NULL COMMENT 'トリカー',
  `subject` VARCHAR(255) NOT NULL COMMENT 'タイトル',
  `sender_addr` VARCHAR(255) NOT NULL COMMENT '送信者アドレス',
  `sender_name` VARCHAR(255) NOT NULL COMMENT '送信者名',
  `cc` TEXT COMMENT 'CC\nカンマ区切り',
  `bcc` TEXT COMMENT 'BCC\nカンマ区切り',
  `body` TEXT COMMENT '本文',
  `created_at` DATETIME DEFAULT current_timestamp COMMENT '登録日',
  `updated_at` TIMESTAMP COMMENT '更新日'
,  PRIMARY KEY (`trigger`)

)
COMMENT 'メール\n自動送信用メールテンプレート'
;