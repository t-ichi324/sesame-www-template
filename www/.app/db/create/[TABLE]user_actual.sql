/*-------------------------------
 PHISYCAL: user_actual
 LOGICAL : ユーザデータ
 COMMENT : 削除済みを含む実データ
-------------------------------*/
/* DORP TABLE */
DROP TABLE  IF EXISTS `user_actual`;

CREATE TABLE `user_actual`(
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'ユーザID',
  `password` VARCHAR(255) NOT NULL COMMENT 'パスワード\nHash衝突比較',
  `roles` VARCHAR(255) COMMENT '権限\nカンマ区切り',
  `is_deleted` INT(1) NOT NULL DEFAULT 0 COMMENT '削除済み\n1:削除済み',
  `is_ban` INT(1) NOT NULL DEFAULT 0 COMMENT '利用停止\n1:BAN',
  `is_single` INT(1) NOT NULL DEFAULT 0 COMMENT '同時ログイン判定\n1:重複ログイン判定',
  `is_tfa` INT(1) NOT NULL DEFAULT 0 COMMENT '2段階認証',
  `session_id` VARCHAR(255) COMMENT 'セッションID',
  `term_start` DATE COMMENT '利用開始',
  `term_end` DATE COMMENT '利用期限',
  `notice` VARCHAR(255) COMMENT '通知',
  `token` VARCHAR(255) COMMENT 'トークン',
  `attr` VARCHAR(45) COMMENT '属性',
  `remarks` TEXT COMMENT '備考',
  `email` VARCHAR(255) NOT NULL COMMENT 'メールアドレス',
  `name` VARCHAR(255) NOT NULL COMMENT '氏名\nシステム側で重複チェック',
  `kana` VARCHAR(255) COMMENT '氏名（カナ）',
  `company` VARCHAR(255) COMMENT '会社名',
  `branch` VARCHAR(50) COMMENT '部署',
  `post` VARCHAR(50) COMMENT '役職',
  `addr1` VARCHAR(255) COMMENT '住所１',
  `addr2` VARCHAR(255) COMMENT '住所２',
  `tel` VARCHAR(20) COMMENT '電話',
  `fax` VARCHAR(20) COMMENT 'FAX',
  `zip_code` VARCHAR(10) COMMENT '郵便番号',
  `created_at` DATETIME DEFAULT current_timestamp COMMENT '登録日',
  `updated_at` TIMESTAMP COMMENT '更新日'
,  PRIMARY KEY (`id`)
, INDEX `idx_password` (`password`), INDEX `idx_is_deleted` (`is_deleted`), INDEX `idx_email` (`email`)
)
COMMENT 'ユーザデータ\n削除済みを含む実データ'
;