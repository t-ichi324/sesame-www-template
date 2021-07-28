/*-------------------------------
 PHISYCAL: contact
 LOGICAL : お問合せ
 COMMENT : 問合せ履歴
-------------------------------*/
/* DORP TABLE */
DROP TABLE  IF EXISTS `contact`;

CREATE TABLE `contact`(
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '問い合わせID',
  `cl` VARCHAR(20) NOT NULL COMMENT '問合せ種類',
  `is_checked` INT(1) NOT NULL DEFAULT 0 COMMENT '確認済み\n0:未確認、1:確認済み',
  `is_deleted` INT(1) NOT NULL DEFAULT 0 COMMENT '削除済み\n0:有効、1:削除済み',
  `name` VARCHAR(255) COMMENT '問合せ者名',
  `email` VARCHAR(255) COMMENT 'メールアドレス',
  `subject` VARCHAR(255) COMMENT 'タイトル',
  `body` TEXT COMMENT '本文',
  `ip` VARCHAR(255) COMMENT 'IPアドレス\n送信者のIP',
  `user_agent` TEXT COMMENT 'ユーザエージェント\n送信者のUA',
  `remarks` TEXT,
  `created_at` DATETIME DEFAULT current_timestamp COMMENT '登録日',
  `updated_at` TIMESTAMP COMMENT '更新日'
,  PRIMARY KEY (`id`)
, INDEX `idx_cl` (`cl`)
)
COMMENT 'お問合せ\n問合せ履歴'
;