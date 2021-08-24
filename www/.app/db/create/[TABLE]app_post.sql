/*-------------------------------
 PHISYCAL: app_post
 LOGICAL : sys used
 COMMENT : Simple CMS
-------------------------------*/
/* DORP TABLE */
DROP TABLE  IF EXISTS `app_post`;

CREATE TABLE `app_post`(
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'post id',
  `cl` VARCHAR(45) NOT NULL COMMENT 'category\napp_kv',
  `status` INT(1) NOT NULL DEFAULT 0 COMMENT 'post status\n0: private, 1: public',
  `title` VARCHAR(255) NOT NULL COMMENT 'post title',
  `content` LONGTEXT COMMENT 'post content',
  `description` TEXT COMMENT 'description',
  `img` VARCHAR(255) COMMENT 'image name',
  `layout` VARCHAR(255) COMMENT 'layout name',
  `created_at` DATETIME DEFAULT current_timestamp COMMENT 'create date',
  `updated_at` TIMESTAMP COMMENT 'update date'
,  PRIMARY KEY (`id`)

)
COMMENT 'sys used\nSimple CMS'
;