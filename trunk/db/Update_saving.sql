ALTER TABLE `contacts`  ADD COLUMN `con_cid` VARCHAR(50) NOT NULL AFTER `con_con_job_id`;
ALTER TABLE  `saving_account` ADD  `sav_acc_gl_id` INT( 11 ) NOT NULL AFTER  `sav_use_id`;
ALTER TABLE  `saving_account` ADD  `sav_acc_cur_id` INT( 11 ) NOT NULL AFTER  `sav_acc_gl_id`;