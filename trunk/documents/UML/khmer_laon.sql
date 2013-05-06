# --------------------------------------------------------
# Host:                         127.0.0.1
# Server version:               5.1.53-community-log
# Server OS:                    Win64
# HeidiSQL version:             6.0.0.3603
# Date/time:                    2013-03-31 15:52:32
# --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

# Dumping structure for table loan_khmer.contacts
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `con_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_cid` varchar(45) DEFAULT NULL,
  `con_con_typ_id` int(11) DEFAULT NULL,
  `con_en_name` varchar(45) DEFAULT NULL,
  `con_kh_name` varchar(45) DEFAULT NULL,
  `con_national_identified_card` varchar(20) DEFAULT NULL,
  `status` bit(1) DEFAULT NULL,
  `con_use_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`con_id`),
  KEY `contact type` (`con_con_typ_id`),
  KEY `user_id` (`con_use_id`),
  CONSTRAINT `contact type` FOREIGN KEY (`con_con_typ_id`) REFERENCES `contact_type` (`con_typ_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user_id` FOREIGN KEY (`con_use_id`) REFERENCES `users` (`use_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.contacts: ~0 rows (approximately)
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;


# Dumping structure for table loan_khmer.contacts_detail
DROP TABLE IF EXISTS `contacts_detail`;
CREATE TABLE IF NOT EXISTS `contacts_detail` (
  `con_det_con_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_gender` char(1) DEFAULT NULL,
  `con_civil_status_id` int(11) DEFAULT NULL,
  `con_dob` date DEFAULT NULL,
  `con_address` varchar(45) DEFAULT NULL,
  `con_det_job` varchar(45) DEFAULT NULL,
  `con_det_inc_id` int(11) DEFAULT NULL,
  KEY `contact` (`con_det_con_id`),
  KEY `income` (`con_det_inc_id`),
  CONSTRAINT `contact` FOREIGN KEY (`con_det_con_id`) REFERENCES `contacts` (`con_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `income` FOREIGN KEY (`con_det_inc_id`) REFERENCES `income` (`inc_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.contacts_detail: ~0 rows (approximately)
/*!40000 ALTER TABLE `contacts_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts_detail` ENABLE KEYS */;


# Dumping structure for table loan_khmer.contact_group
DROP TABLE IF EXISTS `contact_group`;
CREATE TABLE IF NOT EXISTS `contact_group` (
  `con_gro_con_id` int(11) NOT NULL,
  `con_gro_gro_id` int(11) NOT NULL,
  PRIMARY KEY (`con_gro_con_id`,`con_gro_gro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

# Dumping data for table loan_khmer.contact_group: ~0 rows (approximately)
/*!40000 ALTER TABLE `contact_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_group` ENABLE KEYS */;


# Dumping structure for table loan_khmer.contact_number
DROP TABLE IF EXISTS `contact_number`;
CREATE TABLE IF NOT EXISTS `contact_number` (
  `con_num_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_num_con_id` int(11) NOT NULL,
  `con_num_line` varchar(15) DEFAULT NULL,
  `status` bit(1) DEFAULT NULL,
  PRIMARY KEY (`con_num_id`),
  KEY `contact number` (`con_num_con_id`),
  CONSTRAINT `contact number` FOREIGN KEY (`con_num_con_id`) REFERENCES `contacts` (`con_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.contact_number: ~0 rows (approximately)
/*!40000 ALTER TABLE `contact_number` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_number` ENABLE KEYS */;


# Dumping structure for table loan_khmer.contact_type
DROP TABLE IF EXISTS `contact_type`;
CREATE TABLE IF NOT EXISTS `contact_type` (
  `con_typ_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_typ_title` varchar(20) DEFAULT NULL,
  `status` bit(1) DEFAULT b'1',
  PRIMARY KEY (`con_typ_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.contact_type: ~0 rows (approximately)
/*!40000 ALTER TABLE `contact_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_type` ENABLE KEYS */;


# Dumping structure for table loan_khmer.group
DROP TABLE IF EXISTS `group`;
CREATE TABLE IF NOT EXISTS `group` (
  `gro_id` int(11) NOT NULL AUTO_INCREMENT,
  `gro_title` varchar(45) DEFAULT NULL,
  `status` bit(1) DEFAULT NULL,
  PRIMARY KEY (`gro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.group: ~0 rows (approximately)
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
/*!40000 ALTER TABLE `group` ENABLE KEYS */;


# Dumping structure for table loan_khmer.income
DROP TABLE IF EXISTS `income`;
CREATE TABLE IF NOT EXISTS `income` (
  `inc_id` int(11) NOT NULL,
  `inc_lable` varchar(50) NOT NULL,
  PRIMARY KEY (`inc_id`),
  UNIQUE KEY `inc_lable_UNIQUE` (`inc_lable`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.income: ~0 rows (approximately)
/*!40000 ALTER TABLE `income` DISABLE KEYS */;
/*!40000 ALTER TABLE `income` ENABLE KEYS */;


# Dumping structure for table loan_khmer.loan_account
DROP TABLE IF EXISTS `loan_account`;
CREATE TABLE IF NOT EXISTS `loan_account` (
  `loa_acc_id` int(11) NOT NULL AUTO_INCREMENT,
  `loa_acc_code` varchar(45) DEFAULT NULL,
  `loa_acc_con_id` int(11) DEFAULT NULL,
  `loa_acc_loa_pro_type_id` int(11) DEFAULT NULL,
  `loa_acc_amount` double DEFAULT NULL,
  `loa_acc_disbustment_date` date DEFAULT NULL,
  `loa_acc_loa_rep_fre_id` int(11) DEFAULT NULL,
  `loa_acc_first_repayment` double DEFAULT NULL,
  `status` bit(1) DEFAULT NULL,
  `loa_use_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`loa_acc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.loan_account: ~0 rows (approximately)
/*!40000 ALTER TABLE `loan_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `loan_account` ENABLE KEYS */;


# Dumping structure for table loan_khmer.loan_product_type
DROP TABLE IF EXISTS `loan_product_type`;
CREATE TABLE IF NOT EXISTS `loan_product_type` (
  `loa_pro_typ_id` int(11) NOT NULL AUTO_INCREMENT,
  `loa_pro_typ_code` int(11) DEFAULT NULL,
  `loa_pro_typ_description` varchar(20) DEFAULT NULL,
  `loa_pro_typ_amount` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`loa_pro_typ_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.loan_product_type: ~0 rows (approximately)
/*!40000 ALTER TABLE `loan_product_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `loan_product_type` ENABLE KEYS */;


# Dumping structure for table loan_khmer.saving_account
DROP TABLE IF EXISTS `saving_account`;
CREATE TABLE IF NOT EXISTS `saving_account` (
  `sav_acc_id` int(11) NOT NULL AUTO_INCREMENT,
  `sav_acc_code` varchar(45) DEFAULT NULL,
  `sav_acc_sav_pro_typ_id` int(11) DEFAULT NULL,
  `sav_acc_create_date` date DEFAULT NULL,
  `sav_acc_modified_date` date DEFAULT NULL,
  `sav_acc_reference` varchar(45) DEFAULT NULL,
  `status` bit(1) DEFAULT NULL,
  `sav_acc_con_id` int(11) DEFAULT NULL,
  `sav_use_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`sav_acc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.saving_account: ~0 rows (approximately)
/*!40000 ALTER TABLE `saving_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `saving_account` ENABLE KEYS */;


# Dumping structure for table loan_khmer.saving_product_type
DROP TABLE IF EXISTS `saving_product_type`;
CREATE TABLE IF NOT EXISTS `saving_product_type` (
  `sav_pro_typ_id` int(11) NOT NULL AUTO_INCREMENT,
  `sav_pro_typ_title` varchar(45) DEFAULT NULL,
  `status` bit(1) DEFAULT NULL,
  PRIMARY KEY (`sav_pro_typ_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.saving_product_type: ~0 rows (approximately)
/*!40000 ALTER TABLE `saving_product_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `saving_product_type` ENABLE KEYS */;


# Dumping structure for table loan_khmer.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `use_id` int(11) NOT NULL AUTO_INCREMENT,
  `use_name` varchar(45) DEFAULT NULL,
  `use_gro_id` int(11) DEFAULT NULL,
  `status` bit(1) DEFAULT b'1',
  `use_password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`use_id`),
  UNIQUE KEY `use_name_UNIQUE` (`use_name`),
  KEY `use_group` (`use_gro_id`),
  CONSTRAINT `use_group` FOREIGN KEY (`use_gro_id`) REFERENCES `user_groups` (`gro_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`use_id`, `use_name`, `use_gro_id`, `status`, `use_password`) VALUES
	(1, 'admin', 1, '', '21232f297a57a5a743894a0e4a801fc3'),
	(2, 'account', 1, '', 'e268443e43d93dab7ebef303bbe9642f');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


# Dumping structure for table loan_khmer.user_groups
DROP TABLE IF EXISTS `user_groups`;
CREATE TABLE IF NOT EXISTS `user_groups` (
  `gro_id` int(11) NOT NULL AUTO_INCREMENT,
  `gro_name` varchar(45) DEFAULT NULL,
  `status` bit(1) DEFAULT NULL,
  PRIMARY KEY (`gro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.user_groups: ~1 rows (approximately)
/*!40000 ALTER TABLE `user_groups` DISABLE KEYS */;
INSERT INTO `user_groups` (`gro_id`, `gro_name`, `status`) VALUES
	(1, 'admin', '');
/*!40000 ALTER TABLE `user_groups` ENABLE KEYS */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
