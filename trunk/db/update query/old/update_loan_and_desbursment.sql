# --------------------------------------------------------
# Host:                         127.0.0.1
# Server version:               5.1.53-community-log
# Server OS:                    Win64
# HeidiSQL version:             6.0.0.3603
# Date/time:                    2013-07-11 14:01:31
# --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

# Dumping structure for table loan_khmer.loan_account
DROP TABLE IF EXISTS `loan_account`;
CREATE TABLE IF NOT EXISTS `loan_account` (
  `loa_acc_id` int(11) NOT NULL AUTO_INCREMENT,
  `loa_acc_code` varchar(20) DEFAULT NULL,
  `loa_acc_con_id` int(11) DEFAULT NULL,
  `loa_acc_loa_pro_type_id` int(11) DEFAULT NULL,
  `loa_acc_amount` decimal(12,0) DEFAULT NULL,
  `loa_acc_cur_id` int(11) DEFAULT NULL,
  `loa_acc_gl_code` varchar(20) DEFAULT NULL,
  `loa_acc_loa_rep_fre_id` int(11) DEFAULT NULL,
  `loa_acc_status` tinyint(4) DEFAULT NULL,
  `loa_acc_created_date` date DEFAULT NULL,
  `loa_acc_modified_date` date DEFAULT NULL,
  `loa_acc_use_id` int(11) DEFAULT NULL,
  `loa_acc_first_repayment` decimal(12,0) DEFAULT NULL,
  `loa_acc_disbustment` date DEFAULT NULL,
  `status` int(10) DEFAULT NULL,
  PRIMARY KEY (`loa_acc_id`),
  KEY `loa_product_type` (`loa_acc_loa_pro_type_id`),
  KEY `loa_contact` (`loa_acc_con_id`),
  KEY `loa_user_id` (`loa_acc_use_id`),
  KEY `loa_cur_id` (`loa_acc_cur_id`),
  KEY `loa_acc_gl_code` (`loa_acc_gl_code`),
  CONSTRAINT `loa_acc_gl_code` FOREIGN KEY (`loa_acc_gl_code`) REFERENCES `gl_list` (`gl_code`),
  CONSTRAINT `loa_acc_user_id` FOREIGN KEY (`loa_acc_use_id`) REFERENCES `users` (`use_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `loa_contact` FOREIGN KEY (`loa_acc_con_id`) REFERENCES `contacts` (`con_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `loa_cur_id` FOREIGN KEY (`loa_acc_cur_id`) REFERENCES `currency` (`cur_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `loa_product_type` FOREIGN KEY (`loa_acc_loa_pro_type_id`) REFERENCES `loan_product_type` (`loa_pro_typ_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.loan_account: ~2 rows (approximately)
/*!40000 ALTER TABLE `loan_account` DISABLE KEYS */;
INSERT INTO `loan_account` (`loa_acc_id`, `loa_acc_code`, `loa_acc_con_id`, `loa_acc_loa_pro_type_id`, `loa_acc_amount`, `loa_acc_cur_id`, `loa_acc_gl_code`, `loa_acc_loa_rep_fre_id`, `loa_acc_status`, `loa_acc_created_date`, `loa_acc_modified_date`, `loa_acc_use_id`, `loa_acc_first_repayment`, `loa_acc_disbustment`, `status`) VALUES
	(1, '66-000001-00-1', 1, 4, 20000, 1, '571109000', NULL, 0, '2013-07-05', NULL, NULL, NULL, NULL, 0),
	(2, '66-000001-00-2', 2, 1, 20000, 1, '571109000', NULL, 0, '2013-07-05', NULL, NULL, NULL, '2013-07-05', 0);
/*!40000 ALTER TABLE `loan_account` ENABLE KEYS */;


# Dumping structure for table loan_khmer.loan_disbursments
DROP TABLE IF EXISTS `loan_disbursments`;
CREATE TABLE IF NOT EXISTS `loan_disbursments` (
  `loa_dis_id` int(10) NOT NULL AUTO_INCREMENT,
  `loa_dis_date` datetime DEFAULT NULL,
  `loa_dis_value` decimal(10,0) DEFAULT NULL,
  `loa_dis_use_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `loa_dis_loa_acc_code` varchar(20) DEFAULT NULL,
  `loa_dis_tra_mod_id` int(11) DEFAULT NULL,
  `loa_dis_description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`loa_dis_id`),
  KEY `loa_dis_loa_acc_id` (`loa_dis_loa_acc_code`),
  KEY `loa_dis_use_id` (`loa_dis_use_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.loan_disbursments: ~10 rows (approximately)
/*!40000 ALTER TABLE `loan_disbursments` DISABLE KEYS */;
INSERT INTO `loan_disbursments` (`loa_dis_id`, `loa_dis_date`, `loa_dis_value`, `loa_dis_use_id`, `status`, `loa_dis_loa_acc_code`, `loa_dis_tra_mod_id`, `loa_dis_description`) VALUES
	(8, '2013-07-07 01:14:31', 2000, 5, 1, '66-000001-00-1', 1, ''),
	(9, '2013-07-07 01:15:49', 200, 5, 1, '66-000001-00-1', 1, 'test'),
	(10, '2013-07-07 01:20:30', 200, 5, 1, '66-000001-00-1', 1, 'test'),
	(11, '2013-07-07 01:20:41', 200, 5, 1, '66-000001-00-1', 1, 'test'),
	(12, '2013-07-07 01:21:08', 111, 5, 1, '66-000001-00-1', 1, ''),
	(13, '2013-07-07 13:28:55', 100, 5, 1, '66-000001-00-1', 1, 'test'),
	(14, '2013-07-07 13:54:02', 100, 5, 1, '66-000001-00-1', 1, 'test'),
	(15, '2013-07-07 14:08:48', 200, 5, 1, '66-000001-00-1', 1, ''),
	(16, '2013-07-07 14:12:55', 200, 5, 1, '66-000001-00-1', 1, ''),
	(17, '2013-07-07 14:20:12', 100, 5, 1, '66-000001-00-1', 1, '');
/*!40000 ALTER TABLE `loan_disbursments` ENABLE KEYS */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
