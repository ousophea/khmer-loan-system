ALTER TABLE `loan_account`
ADD COLUMN `loa_acc_loa_sch_id` INT(11) NULL DEFAULT NULL AFTER `loa_acc_loa_pro_type_code`;
ALTER TABLE `loan_account`
	ADD COLUMN `loa_accc_ownership_type` INT(2) NULL DEFAULT NULL AFTER `loa_acc_loa_sch_id`;
	UPDATE `loan_khmer`.`loan_account` SET `loa_accc_ownership_type`=1 ;
	ALTER TABLE `loan_account`
	CHANGE COLUMN `loa_acc_amount_in_word` `loa_acc_amount_in_word` VARCHAR(200) NULL DEFAULT NULL AFTER `loa_acc_amount`;