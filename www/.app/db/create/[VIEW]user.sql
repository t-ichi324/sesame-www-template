/*-------------------------------
 PHISYCAL: user
 LOGICAL : User view
 COMMENT : 
-------------------------------*/
/* DORP VIEW */
DROP VIEW IF EXISTS `user`;

CREATE VIEW `user` AS 
select * from `user_actual`
where is_deleted = 0
;