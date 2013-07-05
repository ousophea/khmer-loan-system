ALTER TABLE `saving_account`  ADD COLUMN `sav_acc_interest_rate` DOUBLE NULL AFTER `sav_acc_cur_id`;


ALTER TABLE `saving_account`  ADD COLUMN `sav_acc_signature` VARCHAR(100) NULL DEFAULT NULL AFTER `sav_acc_interest_rate`;


ALTER TABLE `saving_account`  CHANGE COLUMN `sav_acc_create_date` `sav_acc_create_date` TIMESTAMP NULL AFTER `sav_acc_sav_pro_typ_id`,  CHANGE COLUMN `sav_acc_modified_date` `sav_acc_modified_date` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP AFTER `sav_acc_create_date`;


CREATE TABLE  `loan_khmer`.`signature_rule` (
`sir_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`sir_title` VARCHAR( 100 ) NOT NULL ,
`status` TINYINT NOT NULL DEFAULT  '1'
) ENGINE = InnoDB ;

ALTER TABLE `saving_account`  ADD COLUMN `sav_acc_sig_rul_id` INT(11) NULL AFTER `sav_acc_signature`;

ALTER TABLE  `saving_account` ADD FOREIGN KEY (  `sav_acc_sig_rul_id_id` ) REFERENCES  `loan_khmer`.`signature_rule` (
`sir_id`
) ON DELETE NO ACTION ON UPDATE NO ACTION ;