# --------------------------------------------------------
# Host:                         127.0.0.1
# Server version:               5.1.53-community-log
# Server OS:                    Win64
# HeidiSQL version:             6.0.0.3603
# Date/time:                    2013-06-11 15:14:28
# --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

# Dumping structure for table loan_khmer.branch
DROP TABLE IF EXISTS `branch`;
CREATE TABLE IF NOT EXISTS `branch` (
  `bra_id` int(10) NOT NULL AUTO_INCREMENT,
  `bra_name` varchar(50) DEFAULT '0',
  `bra_address` varchar(200) DEFAULT '0',
  `bra_status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`bra_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.branch: ~2 rows (approximately)
/*!40000 ALTER TABLE `branch` DISABLE KEYS */;
INSERT INTO `branch` (`bra_id`, `bra_name`, `bra_address`, `bra_status`) VALUES
	(1, 'Phnom Penh', '0', 1),
	(2, 'Kandal', '0', 1);
/*!40000 ALTER TABLE `branch` ENABLE KEYS */;


# Dumping structure for table loan_khmer.communes
DROP TABLE IF EXISTS `communes`;
CREATE TABLE IF NOT EXISTS `communes` (
  `com_id` int(11) NOT NULL AUTO_INCREMENT,
  `com_dis_id` int(10) unsigned DEFAULT NULL,
  `com_en_name` varchar(80) NOT NULL,
  `com_kh_name` varchar(80) DEFAULT NULL,
  `status` binary(1) DEFAULT '1',
  PRIMARY KEY (`com_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.communes: ~0 rows (approximately)
/*!40000 ALTER TABLE `communes` DISABLE KEYS */;
/*!40000 ALTER TABLE `communes` ENABLE KEYS */;


# Dumping structure for table loan_khmer.contacts
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `con_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_account_number` varchar(45) DEFAULT NULL,
  `con_con_typ_id` int(11) DEFAULT NULL,
  `con_en_first_name` varchar(50) DEFAULT NULL,
  `con_en_last_name` varchar(50) DEFAULT NULL,
  `con_en_nickname` varchar(50) DEFAULT NULL,
  `con_kh_first_name` varchar(50) DEFAULT NULL,
  `con_kh_last_name` varchar(50) DEFAULT NULL,
  `con_kh_nickname` varchar(50) DEFAULT NULL,
  `con_en_name` varchar(45) DEFAULT NULL,
  `con_kh_name` varchar(45) DEFAULT NULL,
  `con_national_identity_card` varchar(20) DEFAULT NULL,
  `con_status` tinyint(1) DEFAULT '1',
  `con_use_id` int(11) DEFAULT NULL,
  `con_bra_id` int(10) DEFAULT NULL,
  `con_con_job_id` int(10) DEFAULT NULL,
  `con_cid` varchar(50) NOT NULL,
  PRIMARY KEY (`con_id`),
  KEY `contact type` (`con_con_typ_id`),
  KEY `user_id` (`con_use_id`),
  KEY `con_branch` (`con_bra_id`),
  CONSTRAINT `contact type` FOREIGN KEY (`con_con_typ_id`) REFERENCES `contact_type` (`con_typ_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `con_branch` FOREIGN KEY (`con_bra_id`) REFERENCES `branch` (`bra_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user_id` FOREIGN KEY (`con_use_id`) REFERENCES `users` (`use_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.contacts: ~2 rows (approximately)
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` (`con_id`, `con_account_number`, `con_con_typ_id`, `con_en_first_name`, `con_en_last_name`, `con_en_nickname`, `con_kh_first_name`, `con_kh_last_name`, `con_kh_nickname`, `con_en_name`, `con_kh_name`, `con_national_identity_card`, `con_status`, `con_use_id`, `con_bra_id`, `con_con_job_id`, `con_cid`) VALUES
	(1, '168-000001-1-1', 1, 'Pin', 'Borin', 'Jack', NULL, NULL, NULL, 'Chantha', NULL, '212145453', 1, 1, 1, 1, '168-000001-1-1'),
	(2, '168-000002-1-2', 1, 'Par', 'Raksmey', NULL, NULL, NULL, NULL, 'Vanda', NULL, '454454457', 1, 1, 1, 1, '168-000001-1-2');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;


# Dumping structure for table loan_khmer.contacts_couple
DROP TABLE IF EXISTS `contacts_couple`;
CREATE TABLE IF NOT EXISTS `contacts_couple` (
  `con_cou_owner` int(11) NOT NULL,
  `con_cou_couple` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.contacts_couple: ~0 rows (approximately)
/*!40000 ALTER TABLE `contacts_couple` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts_couple` ENABLE KEYS */;


# Dumping structure for table loan_khmer.contacts_detail
DROP TABLE IF EXISTS `contacts_detail`;
CREATE TABLE IF NOT EXISTS `contacts_detail` (
  `con_det_con_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_gender` char(1) DEFAULT NULL,
  `con_civil_status_id` int(11) DEFAULT NULL,
  `con_dob` date DEFAULT NULL,
  `con_det_address_detail` varchar(45) DEFAULT NULL,
  `con_det_job` varchar(45) DEFAULT NULL,
  `con_det_inc_id` int(11) DEFAULT NULL,
  `con_del_date_created` date DEFAULT NULL,
  `con_del_date_modified` date DEFAULT NULL,
  KEY `contact` (`con_det_con_id`),
  KEY `income` (`con_det_inc_id`),
  CONSTRAINT `contact` FOREIGN KEY (`con_det_con_id`) REFERENCES `contacts` (`con_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `income` FOREIGN KEY (`con_det_inc_id`) REFERENCES `income` (`inc_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.contacts_detail: ~2 rows (approximately)
/*!40000 ALTER TABLE `contacts_detail` DISABLE KEYS */;
INSERT INTO `contacts_detail` (`con_det_con_id`, `con_gender`, `con_civil_status_id`, `con_dob`, `con_det_address_detail`, `con_det_job`, `con_det_inc_id`, `con_del_date_created`, `con_del_date_modified`) VALUES
	(1, 'M', NULL, NULL, NULL, '1', NULL, '2013-05-15', '2013-05-15'),
	(2, 'F', NULL, NULL, NULL, '1', NULL, '2013-05-15', '2013-05-15');
/*!40000 ALTER TABLE `contacts_detail` ENABLE KEYS */;


# Dumping structure for table loan_khmer.contacts_family
DROP TABLE IF EXISTS `contacts_family`;
CREATE TABLE IF NOT EXISTS `contacts_family` (
  `con_fam_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_fam_con_id` int(11) NOT NULL,
  `con_fam_inc_id` int(11) NOT NULL DEFAULT '0',
  `con_fam_kh_first_name` varchar(45) NOT NULL,
  `con_fam_kh_last_name` varchar(45) NOT NULL,
  `con_fam_kh_nickname` varchar(45) DEFAULT NULL,
  `con_fam_en_first_name` varchar(45) NOT NULL,
  `con_fam_en_last_name` varchar(45) NOT NULL,
  `con_fam_en_nickname` varchar(45) DEFAULT NULL,
  `con_fam_con_job_id` int(11) NOT NULL DEFAULT '0',
  `con_fam_national_identity` int(11) NOT NULL,
  `con_fam_datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `con_fam_datemodified` timestamp NULL DEFAULT NULL,
  `status` binary(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`con_fam_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.contacts_family: ~0 rows (approximately)
/*!40000 ALTER TABLE `contacts_family` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts_family` ENABLE KEYS */;


# Dumping structure for table loan_khmer.contacts_group
DROP TABLE IF EXISTS `contacts_group`;
CREATE TABLE IF NOT EXISTS `contacts_group` (
  `con_gro_con_id` int(11) NOT NULL,
  `con_gro_gro_id` int(11) NOT NULL,
  PRIMARY KEY (`con_gro_con_id`,`con_gro_gro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

# Dumping data for table loan_khmer.contacts_group: ~0 rows (approximately)
/*!40000 ALTER TABLE `contacts_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts_group` ENABLE KEYS */;


# Dumping structure for table loan_khmer.contacts_income
DROP TABLE IF EXISTS `contacts_income`;
CREATE TABLE IF NOT EXISTS `contacts_income` (
  `con_inc_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_inc_range` varchar(100) NOT NULL,
  `status` binary(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`con_inc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.contacts_income: ~0 rows (approximately)
/*!40000 ALTER TABLE `contacts_income` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts_income` ENABLE KEYS */;


# Dumping structure for table loan_khmer.contacts_job
DROP TABLE IF EXISTS `contacts_job`;
CREATE TABLE IF NOT EXISTS `contacts_job` (
  `con_job_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_job_title` varchar(45) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`con_job_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.contacts_job: ~1 rows (approximately)
/*!40000 ALTER TABLE `contacts_job` DISABLE KEYS */;
INSERT INTO `contacts_job` (`con_job_id`, `con_job_title`, `status`) VALUES
	(1, 'Famer', 0);
/*!40000 ALTER TABLE `contacts_job` ENABLE KEYS */;


# Dumping structure for table loan_khmer.contacts_number
DROP TABLE IF EXISTS `contacts_number`;
CREATE TABLE IF NOT EXISTS `contacts_number` (
  `con_num_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_num_con_id` int(11) NOT NULL,
  `con_num_line` varchar(15) DEFAULT NULL,
  `status` bit(1) DEFAULT b'1',
  PRIMARY KEY (`con_num_id`),
  KEY `contact number` (`con_num_con_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.contacts_number: ~0 rows (approximately)
/*!40000 ALTER TABLE `contacts_number` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts_number` ENABLE KEYS */;


# Dumping structure for table loan_khmer.contacts_type
DROP TABLE IF EXISTS `contacts_type`;
CREATE TABLE IF NOT EXISTS `contacts_type` (
  `con_typ_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_typ_title` varchar(20) DEFAULT NULL,
  `con_typ_status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`con_typ_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.contacts_type: ~2 rows (approximately)
/*!40000 ALTER TABLE `contacts_type` DISABLE KEYS */;
INSERT INTO `contacts_type` (`con_typ_id`, `con_typ_title`, `con_typ_status`) VALUES
	(1, 'Group', 1),
	(2, 'Indivitule', 1);
/*!40000 ALTER TABLE `contacts_type` ENABLE KEYS */;


# Dumping structure for table loan_khmer.contact_group
DROP TABLE IF EXISTS `contact_group`;
CREATE TABLE IF NOT EXISTS `contact_group` (
  `con_gro_con_id` int(11) NOT NULL,
  `con_gro_gro_id` int(11) NOT NULL,
  `con_gro_id` int(11) NOT NULL,
  PRIMARY KEY (`con_gro_con_id`,`con_gro_gro_id`,`con_gro_id`),
  KEY `con_gro_contact` (`con_gro_con_id`),
  KEY `con_gro_group` (`con_gro_gro_id`),
  CONSTRAINT `con_gro_contact` FOREIGN KEY (`con_gro_con_id`) REFERENCES `contacts` (`con_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `con_gro_group` FOREIGN KEY (`con_gro_gro_id`) REFERENCES `group` (`gro_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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


# Dumping structure for table loan_khmer.currency
DROP TABLE IF EXISTS `currency`;
CREATE TABLE IF NOT EXISTS `currency` (
  `cur_id` int(11) NOT NULL AUTO_INCREMENT,
  `cur_title` varchar(45) DEFAULT NULL,
  `cur_status` int(11) DEFAULT '1',
  PRIMARY KEY (`cur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.currency: ~3 rows (approximately)
/*!40000 ALTER TABLE `currency` DISABLE KEYS */;
INSERT INTO `currency` (`cur_id`, `cur_title`, `cur_status`) VALUES
	(1, 'KHR (៛)', 1),
	(2, 'USD ($)', 1),
	(3, 'THB', 1);
/*!40000 ALTER TABLE `currency` ENABLE KEYS */;


# Dumping structure for table loan_khmer.districts
DROP TABLE IF EXISTS `districts`;
CREATE TABLE IF NOT EXISTS `districts` (
  `dis_id` int(11) NOT NULL AUTO_INCREMENT,
  `dis_pro_id` int(10) unsigned DEFAULT NULL,
  `dis_en_name` varchar(80) NOT NULL,
  `dis_kh_name` varchar(80) DEFAULT NULL,
  `status` binary(1) DEFAULT '1',
  PRIMARY KEY (`dis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.districts: ~0 rows (approximately)
/*!40000 ALTER TABLE `districts` DISABLE KEYS */;
/*!40000 ALTER TABLE `districts` ENABLE KEYS */;


# Dumping structure for table loan_khmer.gl_list
DROP TABLE IF EXISTS `gl_list`;
CREATE TABLE IF NOT EXISTS `gl_list` (
  `gl_id` int(11) NOT NULL AUTO_INCREMENT,
  `gl_code` varchar(12) DEFAULT NULL,
  `gl_description` varchar(100) DEFAULT NULL,
  `gl_debit` double DEFAULT NULL,
  `gl_credit` double DEFAULT NULL,
  `gl_balance` double DEFAULT NULL,
  PRIMARY KEY (`gl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=628 DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.gl_list: ~703 rows (approximately)
/*!40000 ALTER TABLE `gl_list` DISABLE KEYS */;
INSERT INTO `gl_list` (`gl_id`, `gl_code`, `gl_description`, `gl_debit`, `gl_credit`, `gl_balance`) VALUES
	(1, '100009000', 'Total Assets Control Account\r', NULL, NULL, NULL),
	(2, '111109000', 'Cash in Vault and on Hand \r', NULL, NULL, NULL),
	(3, '111109111', 'Cash in Vault \r', -200, 200, 0),
	(4, '111109112', 'Cash in Vault & Hand_PettyCash\r', NULL, NULL, NULL),
	(5, '111109113', 'Cash in Till \r', NULL, NULL, NULL),
	(6, '111109114', 'Cash in Vault & Hand_NOT USE\r', NULL, NULL, NULL),
	(7, '111109121', 'Cash in Vault & Hand_SubBranch\r', NULL, NULL, NULL),
	(8, '111109131', 'Cash in Vault & Hand_ServicePost\r', NULL, NULL, NULL),
	(9, '111209000', 'Cash in Transit \r', NULL, NULL, NULL),
	(10, '111209111', 'Cash Transit _HO & Branch\r', NULL, NULL, NULL),
	(11, '111209112', 'Cash Transit _Branch & Branch\r', NULL, NULL, NULL),
	(12, '111209113', 'Cash Transit _Branch & SubBranch\r', NULL, NULL, NULL),
	(13, '111209119', 'Cash Transit _Other\r', NULL, NULL, NULL),
	(14, '111309000', 'Cheques in Transit\r', NULL, NULL, NULL),
	(15, '111309111', 'Cheques Transit_HO & Branch\r', NULL, NULL, NULL),
	(16, '111309112', 'Cheques Transit_HO & Suppliers\r', NULL, NULL, NULL),
	(17, '111309119', 'Cheques Transit_Other\r', NULL, NULL, NULL),
	(18, '114109000', 'Due from NBC\r', NULL, NULL, NULL),
	(19, '114109111', 'Due from NBC\r', NULL, NULL, NULL),
	(20, '114209000', 'Capital Guar Depo_NBC\r', NULL, NULL, NULL),
	(21, '114209111', 'Capital Guar Depo_NBC\r', NULL, NULL, NULL),
	(22, '114309000', 'Reserve Req_NBC\r', NULL, NULL, NULL),
	(23, '114309111', 'Reserve Req_NBC\r', NULL, NULL, NULL),
	(24, '114409000', 'Other Demand Depo_ NBC\r', NULL, NULL, NULL),
	(25, '114409111', 'Other Demand Depo_ NBC\r', NULL, NULL, NULL),
	(26, '114609000', 'Other Term Depo_ NBC\r', NULL, NULL, NULL),
	(27, '114609111', 'Other Term Depo_ NBC\r', NULL, NULL, NULL),
	(28, '115109000', 'CA (Nostro)_BK rated AAA to AA-\r', NULL, NULL, NULL),
	(29, '115109111', 'CA (Nostro)_BK rated AAA to AA-\r', NULL, NULL, NULL),
	(30, '115209000', 'CA (Nostro)_BK rated A+ to A-\r', NULL, NULL, NULL),
	(31, '115209111', 'CA (Nostro)_BK rated A+ to A-\r', NULL, NULL, NULL),
	(32, '115309000', 'CA (Nostro)_BK rated below A-\r', NULL, NULL, NULL),
	(33, '115309100', 'CA (Nostro)_BK rated below A-_ACLEDA\r', NULL, NULL, NULL),
	(34, '115309101', 'CA (Nostro)_BK rated below A-_ACLEDA_Branch\r', NULL, NULL, NULL),
	(35, '115309102', 'CA (Nostro)_BK rated below A-_ACLEDA_SubBranch\r', NULL, NULL, NULL),
	(36, '115309103', 'CA (Nostro)_BK rated below A-_ACLEDA_ServicePost\r', NULL, NULL, NULL),
	(37, '115309111', 'CA (Nostro)_BK rated below A-_CAMPU\r', NULL, NULL, NULL),
	(38, '115309112', 'CA (Nostro)_BK rated below A-_CANADIA\r', NULL, NULL, NULL),
	(39, '115309113', 'CA (Nostro)_BK rated below A-_RDB\r', NULL, NULL, NULL),
	(40, '115309114', 'CA (Nostro)_BK rated below A-_ANZ\r', NULL, NULL, NULL),
	(41, '115309119', 'CA (Nostro)_BK rated below A-_Other\r', NULL, NULL, NULL),
	(42, '116109000', 'DD &SAV  BK rated AAA to AA-\r', NULL, NULL, NULL),
	(43, '116109111', 'DD &SAV  BK rated AAA to AA-\r', NULL, NULL, NULL),
	(44, '116209000', 'DD &SAV  BK rated A+ to A-\r', NULL, NULL, NULL),
	(45, '116209111', 'DD &SAV  BK rated A+ to A-\r', NULL, NULL, NULL),
	(46, '116309000', 'DD &SAV  BK rated below A-\r', NULL, NULL, NULL),
	(47, '116309100', 'DD &SAV  BK rated below A-_ACLEDA\r', NULL, NULL, NULL),
	(48, '116309101', 'DD &SAV  BK rated below A-_ACLEDA_Branch\r', NULL, NULL, NULL),
	(49, '116309102', 'DD &SAV  BK rated below A-_ACLEDA_SubBranch\r', NULL, NULL, NULL),
	(50, '116309103', 'DD &SAV  BK rated below A-_ACLEDA_ServicePost\r', NULL, NULL, NULL),
	(51, '116309111', 'DD &SAV  BK rated below A-_CAMPU\r', NULL, NULL, NULL),
	(52, '116309112', 'DD &SAV  BK rated below A-_CANADIA\r', NULL, NULL, NULL),
	(53, '116309113', 'DD &SAV  BK rated below A-_RDB\r', NULL, NULL, NULL),
	(54, '121109000', 'TD & Palcements BK rated AAA to AA-\r', NULL, NULL, NULL),
	(55, '121109111', 'TD & Palcements BK rated AAA to AA-\r', NULL, NULL, NULL),
	(56, '121209000', 'TD & Palcements BK rated A+ to A-\r', NULL, NULL, NULL),
	(57, '121209111', 'TD & Palcements BK rated A+ to A-\r', NULL, NULL, NULL),
	(58, '121309000', 'TD & Palcements BK rated below A-\r', NULL, NULL, NULL),
	(59, '121309111', 'TD & Palcements BK rated below A-\r', NULL, NULL, NULL),
	(60, '122109000', 'CL Sovereigns rated AAA to AA-\r', NULL, NULL, NULL),
	(61, '122109111', 'CL Sovereigns rated AAA to AA-\r', NULL, NULL, NULL),
	(62, '122209000', 'CL Sovereigns rated A+ to A-\r', NULL, NULL, NULL),
	(63, '122209111', 'CL Sovereigns rated A+ to A-\r', NULL, NULL, NULL),
	(64, '122309000', 'CL Sovereigns rated BBB+ to BBB-\r', NULL, NULL, NULL),
	(65, '122309111', 'CL Sovereigns rated BBB+ to BBB-\r', NULL, NULL, NULL),
	(66, '122409000', 'CL Sovereigns rated below BBB-\r', NULL, NULL, NULL),
	(67, '122409111', 'CL Sovereigns rated below BBB-\r', NULL, NULL, NULL),
	(68, '131109000', 'STDL - Groups <=1 year\r', NULL, NULL, NULL),
	(69, '131109111', 'STDL - Groups <=1 year\r', NULL, NULL, NULL),
	(70, '131109112', 'STDL - Groups <=1 year_PD<30\r', NULL, NULL, NULL),
	(71, '131209000', 'STDL - Individuals<=1 year\r', NULL, NULL, NULL),
	(72, '131209111', 'STDL - Individuals<=1 year\r', NULL, NULL, NULL),
	(73, '131209112', 'STDL - Individuals<=1 year_PD<30\r', NULL, NULL, NULL),
	(74, '131209113', 'STDL - Individuals_OD <=1 year\r', NULL, NULL, NULL),
	(75, '131309000', 'STDL - Enterprises<=1 year\r', NULL, NULL, NULL),
	(76, '131309111', 'STDL - Enterprises<=1 year\r', NULL, NULL, NULL),
	(77, '131309112', 'STDL - Enterprises<=1 year_PD<30\r', NULL, NULL, NULL),
	(78, '131309113', 'STDL - Enterprises_OD <=1 year\r', NULL, NULL, NULL),
	(79, '131409000', 'STDL - Others<=1 year\r', NULL, NULL, NULL),
	(80, '131409111', 'STDL - Others<=1 year\r', NULL, NULL, NULL),
	(81, '131409112', 'STDL - Others<=1 year_PD<30\r', NULL, NULL, NULL),
	(82, '131409113', 'STDL - Others_OD <=1 year\r', NULL, NULL, NULL),
	(83, '131519000', 'STDL - Rela Pty<=1 year - Shareholder\r', NULL, NULL, NULL),
	(84, '131519111', 'STDL - Rela Pty<=1 year - Shareholder\r', NULL, NULL, NULL),
	(85, '131519112', 'STDL - Rela Pty<=1 year - Shareholder_PD<30\r', NULL, NULL, NULL),
	(86, '131519113', 'STDL - Rela Pty_OD <=1 year - Shareholder\r', NULL, NULL, NULL),
	(87, '131529000', 'STDL - Rela Pty<=1 year - Manager\r', NULL, NULL, NULL),
	(88, '131529111', 'STDL - Rela Pty<=1 year - Manager\r', NULL, NULL, NULL),
	(89, '131529112', 'STDL - Rela Pty<=1 year - Manager_PD<30\r', NULL, NULL, NULL),
	(90, '131529113', 'STDL - Rela Pty_OD <=1 year - Manager\r', NULL, NULL, NULL),
	(91, '131539000', 'STDL - Rela Pty<=1 year - Employee\r', NULL, NULL, NULL),
	(92, '131539111', 'STDL - Rela Pty<=1 year - Employee\r', NULL, NULL, NULL),
	(93, '131539112', 'STDL - Rela Pty<=1 year - Employee_PD<30\r', NULL, NULL, NULL),
	(94, '131539113', 'STDL - Rela Pty_OD <=1 year - Employee\r', NULL, NULL, NULL),
	(95, '131549000', 'STDL - Rela Pty<=1 year - Ex Audit\r', NULL, NULL, NULL),
	(96, '131549111', 'STDL - Rela Pty<=1 year - Ex Audit\r', NULL, NULL, NULL),
	(97, '131549112', 'STDL - Rela Pty<=1 year - Ex Audit_PD<30\r', NULL, NULL, NULL),
	(98, '131549113', 'STDL - Rela Pty_OD <=1 year - Ex Audit\r', NULL, NULL, NULL),
	(99, '132109000', 'STDL - Groups>1 year\r', NULL, NULL, NULL),
	(100, '132109111', 'STDL - Groups>1 year\r', NULL, NULL, NULL),
	(101, '132109112', 'STDL - Groups>1 year_PD<30\r', NULL, NULL, NULL),
	(102, '132209000', 'STDL - Individuals>1 year\r', NULL, NULL, NULL),
	(103, '132209111', 'STDL - Individuals>1 year\r', NULL, NULL, NULL),
	(104, '132209112', 'STDL - Individuals>1 year_PD<30\r', NULL, NULL, NULL),
	(105, '132309000', 'STDL - Enterprises>1 year\r', NULL, NULL, NULL),
	(106, '132309111', 'STDL - Enterprises>1 year\r', NULL, NULL, NULL),
	(107, '132309112', 'STDL - Enterprises>1 year_PD<30\r', NULL, NULL, NULL),
	(108, '132409000', 'STDL - Others> 1 year\r', NULL, NULL, NULL),
	(109, '132409111', 'STDL - Others> 1 year\r', NULL, NULL, NULL),
	(110, '132409112', 'STDL - Others> 1 year_PD<30\r', NULL, NULL, NULL),
	(111, '132519000', 'STDL - Rela Pty>1 year - Shareholder\r', NULL, NULL, NULL),
	(112, '132519111', 'STDL - Rela Pty>1 year - Shareholder\r', NULL, NULL, NULL),
	(113, '132519112', 'STDL - Rela Pty>1 year - Shareholder_PD<30\r', NULL, NULL, NULL),
	(114, '132529000', 'STDL - Rela Pty>1 year - Manager\r', NULL, NULL, NULL),
	(115, '132529111', 'STDL - Rela Pty>1 year - Manager\r', NULL, NULL, NULL),
	(116, '132529112', 'STDL - Rela Pty>1 year - Manager_PD<30\r', NULL, NULL, NULL),
	(117, '132539000', 'STDL - Rela Pty>1 year - Employee\r', NULL, NULL, NULL),
	(118, '132539111', 'STDL - Rela Pty>1 year - Employee\r', NULL, NULL, NULL),
	(119, '132539112', 'STDL - Rela Pty>1 year - Employee_PD<30\r', NULL, NULL, NULL),
	(120, '132549000', 'STDL - Rela Pty>1 year - Ex Audit\r', NULL, NULL, NULL),
	(121, '132549111', 'STDL - Rela Pty>1 year - Ex Audit\r', NULL, NULL, NULL),
	(122, '132549112', 'STDL - Rela Pty>1 year - Ex Audit_PD<30\r', NULL, NULL, NULL),
	(123, '141109000', 'Sub STDL - Groups<=1 year\r', NULL, NULL, NULL),
	(124, '141109111', 'Sub STDL - Groups<=1 year\r', NULL, NULL, NULL),
	(125, '141209000', 'Sub STDL - Individuals<=1 year\r', NULL, NULL, NULL),
	(126, '141209111', 'Sub STDL - Individuals<=1 year\r', NULL, NULL, NULL),
	(127, '141209112', 'Sub STDL - Individuals_OD <=1 year\r', NULL, NULL, NULL),
	(128, '141309000', 'Sub STDL - Enterprises<=1 year\r', NULL, NULL, NULL),
	(129, '141309111', 'Sub STDL - Enterprises<=1 year\r', NULL, NULL, NULL),
	(130, '141309112', 'Sub STDL - Enterprises_OD <=1 year\r', NULL, NULL, NULL),
	(131, '141409000', 'Sub STDL - Others<=1 year\r', NULL, NULL, NULL),
	(132, '141409111', 'Sub STDL - Others<=1 year\r', NULL, NULL, NULL),
	(133, '141409112', 'Sub STDL - Others_OD <=1 year\r', NULL, NULL, NULL),
	(134, '141519000', 'Sub STDL - Rela Pty<=1 year - Shareholder\r', NULL, NULL, NULL),
	(135, '141519111', 'Sub STDL - Rela Pty<=1 year - Shareholder\r', NULL, NULL, NULL),
	(136, '141519112', 'Sub STDL - Rela Pty_OD <=1 year - Shareholder\r', NULL, NULL, NULL),
	(137, '141529000', 'Sub STDL - Rela Pty<=1 year - Manager\r', NULL, NULL, NULL),
	(138, '141529111', 'Sub STDL - Rela Pty<=1 year - Manager\r', NULL, NULL, NULL),
	(139, '141529112', 'Sub STDL - Rela Pty_OD <=1 year - Manager\r', NULL, NULL, NULL),
	(140, '141539000', 'Sub STDL - Rela Pty<=1 year - Employee\r', NULL, NULL, NULL),
	(141, '141539111', 'Sub STDL - Rela Pty<=1 year - Employee\r', NULL, NULL, NULL),
	(142, '141539112', 'Sub STDL - Rela Pty_OD <=1 year - Employee\r', NULL, NULL, NULL),
	(143, '141549000', 'Sub STDL - Rela Pty<=1 year - Ex Aud\r', NULL, NULL, NULL),
	(144, '141549111', 'Sub STDL - Rela Pty<=1 year - Ex Audit\r', NULL, NULL, NULL),
	(145, '141549112', 'Sub STDL - Rela Pty_OD <=1 year - Ex Audit\r', NULL, NULL, NULL),
	(146, '142109000', 'Sub STDL - Groups>1 year\r', NULL, NULL, NULL),
	(147, '142109111', 'Sub STDL - Groups>1 year\r', NULL, NULL, NULL),
	(148, '142209000', 'Sub STDL - Individuals>1 year\r', NULL, NULL, NULL),
	(149, '142209111', 'Sub STDL - Individuals>1 year\r', NULL, NULL, NULL),
	(150, '142309000', 'Sub STDL - Enterprises>1 year\r', NULL, NULL, NULL),
	(151, '142309111', 'Sub STDL - Enterprises>1 year\r', NULL, NULL, NULL),
	(152, '142409000', 'Sub STDL - Others>1 year\r', NULL, NULL, NULL),
	(153, '142409111', 'Sub STDL - Others>1 year\r', NULL, NULL, NULL),
	(154, '142519000', 'Sub STDL - Rela Pty>1 year - Shareholder\r', NULL, NULL, NULL),
	(155, '142519111', 'Sub STDL - Rela Pty>1 year - Shareholder\r', NULL, NULL, NULL),
	(156, '142529000', 'Sub STDL - Rela Pty>1 year - Manager\r', NULL, NULL, NULL),
	(157, '142529111', 'Sub STDL - Rela Pty>1 year - Manager\r', NULL, NULL, NULL),
	(158, '142539000', 'Sub STDL - Rela Pty>1 year - Employee\r', NULL, NULL, NULL),
	(159, '142539111', 'Sub STDL - Rela Pty>1 year - Employee\r', NULL, NULL, NULL),
	(160, '142549000', 'Sub STDL - Rela Pty>1 year - Ex Audit\r', NULL, NULL, NULL),
	(161, '142549111', 'Sub STDL - Rela Pty>1 year - Ex Audit\r', NULL, NULL, NULL),
	(162, '151109000', 'DFL - Groups<=1 year\r', NULL, NULL, NULL),
	(163, '151109111', 'DFL - Groups<=1 year\r', NULL, NULL, NULL),
	(164, '151209000', 'DFL - Individuals<=1 year\r', NULL, NULL, NULL),
	(165, '151209111', 'DFL - Individuals<=1 year\r', NULL, NULL, NULL),
	(166, '151209112', 'DFL - Individuals_OD <=1 year\r', NULL, NULL, NULL),
	(167, '151309000', 'DFL - Enterprises<=1 year\r', NULL, NULL, NULL),
	(168, '151309111', 'DFL - Enterprises<=1 year\r', NULL, NULL, NULL),
	(169, '151309112', 'DFL - Enterprises_OD <=1 year\r', NULL, NULL, NULL),
	(170, '151409000', 'DFL - Others<=1 year\r', NULL, NULL, NULL),
	(171, '151409111', 'DFL - Others<=1 year\r', NULL, NULL, NULL),
	(172, '151409112', 'DFL - Others_OD <=1 year\r', NULL, NULL, NULL),
	(173, '151519000', 'DFL - Rela Pty<=1 year - Shareholder\r', NULL, NULL, NULL),
	(174, '151519111', 'DFL - Rela Pty<=1 year - Shareholder\r', NULL, NULL, NULL),
	(175, '151519112', 'DFL - Rela Pty_OD <=1 year - Shareholder\r', NULL, NULL, NULL),
	(176, '151529000', 'DFL - Rela Pty<=1 year - Manager\r', NULL, NULL, NULL),
	(177, '151529111', 'DFL - Rela Pty<=1 year - Manager\r', NULL, NULL, NULL),
	(178, '151529112', 'DFL - Rela Pty_OD <=1 year - Manager\r', NULL, NULL, NULL),
	(179, '151539000', 'DFL - Rela Pty<=1 year - Employee\r', NULL, NULL, NULL),
	(180, '151539111', 'DFL - Rela Pty<=1 year - Employee\r', NULL, NULL, NULL),
	(181, '151539112', 'DFL - Rela Pty_OD <=1 year - Employee\r', NULL, NULL, NULL),
	(182, '151549000', 'DFL - Rela Pty<=1 year - Ex Audit\r', NULL, NULL, NULL),
	(183, '151549111', 'DFL - Rela Pty<=1 year - Ex Audit\r', NULL, NULL, NULL),
	(184, '151549112', 'DFL - Rela Pty_OD <=1 year - Ex Auditor\r', NULL, NULL, NULL),
	(185, '152109000', 'DFL - Groups>1 year\r', NULL, NULL, NULL),
	(186, '152109111', 'DFL - Groups>1 year\r', NULL, NULL, NULL),
	(187, '152209000', 'DFL - Individuals>1 year\r', NULL, NULL, NULL),
	(188, '152209111', 'DFL - Individuals>1 year\r', NULL, NULL, NULL),
	(189, '152309000', 'DFL - Enterprises>1 year\r', NULL, NULL, NULL),
	(190, '152309111', 'DFL - Enterprises>1 year\r', NULL, NULL, NULL),
	(191, '152409000', 'DFL - Others>1 year\r', NULL, NULL, NULL),
	(192, '152409111', 'DFL - Others>1 year\r', NULL, NULL, NULL),
	(193, '152519000', 'DFL - Rela Pty>1 year - Shareholder\r', NULL, NULL, NULL),
	(194, '152519111', 'DFL - Rela Pty>1 year - Shareholder\r', NULL, NULL, NULL),
	(195, '152529000', 'DFL - Rela Pty>1 year - Manager\r', NULL, NULL, NULL),
	(196, '152529111', 'DFL - Rela Pty>1 year - Manager\r', NULL, NULL, NULL),
	(197, '152539000', 'DFL - Rela Pty>1 year - Employee\r', NULL, NULL, NULL),
	(198, '152539111', 'DFL - Rela Pty>1 year - Employee\r', NULL, NULL, NULL),
	(199, '152549000', 'DFL - Rela Pty>1 year - Ex Audit\r', NULL, NULL, NULL),
	(200, '152549111', 'DFL - Rela Pty>1 year - Ex Audit\r', NULL, NULL, NULL),
	(201, '161109000', 'LL - Groups<=1 year\r', NULL, NULL, NULL),
	(202, '161109111', 'LL - Groups<=1 year\r', NULL, NULL, NULL),
	(203, '161209000', 'LL - Individuals<=1 year\r', NULL, NULL, NULL),
	(204, '161209111', 'LL - Individuals<=1 year\r', NULL, NULL, NULL),
	(205, '161209112', 'LL - Individuals_OD <=1 year\r', NULL, NULL, NULL),
	(206, '161309000', 'LL - Enterprises<=1 year\r', NULL, NULL, NULL),
	(207, '161309111', 'LL - Enterprises<=1 year\r', NULL, NULL, NULL),
	(208, '161309112', 'LL - Enterprises_OD <=1 year\r', NULL, NULL, NULL),
	(209, '161409000', 'LL - Others<=1 year\r', NULL, NULL, NULL),
	(210, '161409111', 'LL - Others<=1 year\r', NULL, NULL, NULL),
	(211, '161409112', 'LL - Others_OD <=1 year\r', NULL, NULL, NULL),
	(212, '161519000', 'LL - Rela Pty<=1 year - Shareholder\r', NULL, NULL, NULL),
	(213, '161519111', 'LL - Rela Pty<=1 year - Shareholder\r', NULL, NULL, NULL),
	(214, '161519112', 'LL - Rela Pty_OD <=1 year - Shareholder\r', NULL, NULL, NULL),
	(215, '161529000', 'LL - Rela Pty<=1 year - Manager\r', NULL, NULL, NULL),
	(216, '161529111', 'LL - Rela Pty<=1 year - Manager\r', NULL, NULL, NULL),
	(217, '161529112', 'LL - Rela Pty_OD <=1 year - Manager\r', NULL, NULL, NULL),
	(218, '161539000', 'LL - Rela Pty<=1 year - Employee\r', NULL, NULL, NULL),
	(219, '161539111', 'LL - Rela Pty<=1 year - Employee\r', NULL, NULL, NULL),
	(220, '161539112', 'LL - Rela Pty_OD <=1 year - Employee\r', NULL, NULL, NULL),
	(221, '161549000', 'LL - Rela Pty<=1 year - Ex Audit\r', NULL, NULL, NULL),
	(222, '161549111', 'LL - Rela Pty<=1 year - Ex Audit\r', NULL, NULL, NULL),
	(223, '161549112', 'LL - Rela Pty_OD <=1 year - Ex Audit\r', NULL, NULL, NULL),
	(224, '162109000', 'LL - Groups>1 year\r', NULL, NULL, NULL),
	(225, '162109111', 'LL - Groups>1 year\r', NULL, NULL, NULL),
	(226, '162209000', 'LL - Individuals>1 year\r', NULL, NULL, NULL),
	(227, '162209111', 'LL - Individuals>1 year\r', NULL, NULL, NULL),
	(228, '162309000', 'LL - Enterprises>1 year\r', NULL, NULL, NULL),
	(229, '162309111', 'LL - Enterprises>1 year\r', NULL, NULL, NULL),
	(230, '162409000', 'LL - Others>1 year\r', NULL, NULL, NULL),
	(231, '162409111', 'LL - Others>1 year\r', NULL, NULL, NULL),
	(232, '162519000', 'LL - Rela Pty>1 year - Shareholder\r', NULL, NULL, NULL),
	(233, '162519111', 'LL - Rela Pty>1 year - Shareholder\r', NULL, NULL, NULL),
	(234, '162529000', 'LL - Rela Pty>1 year - Manager\r', NULL, NULL, NULL),
	(235, '162529111', 'LL - Rela Pty>1 year - Manager\r', NULL, NULL, NULL),
	(236, '162539000', 'LL - Rela Pty>1 year - Employee\r', NULL, NULL, NULL),
	(237, '162539111', 'LL - Rela Pty>1 year - Employee\r', NULL, NULL, NULL),
	(238, '162549000', 'LL - Rela Pty>1 year - Ex Audit\r', NULL, NULL, NULL),
	(239, '162549111', 'LL - Rela Pty>1 year - Ex Audit\r', NULL, NULL, NULL),
	(240, '171109000', '(Less) Reser Spec LL\r', NULL, NULL, NULL),
	(241, '171109111', '(Less) Reser Spec LL_Group\r', NULL, NULL, NULL),
	(242, '171109112', '(Less) Reser Spec LL_Individual\r', NULL, NULL, NULL),
	(243, '171109113', '(Less) Reser Spec LL_Enterprises\r', NULL, NULL, NULL),
	(244, '171109114', '(Less) Reser Spec LL_Related Parties\r', NULL, NULL, NULL),
	(245, '171109115', '(Less) Reser Spec LL_OD\r', NULL, NULL, NULL),
	(246, '171109119', '(Less) Reser Spec LL_Others\r', NULL, NULL, NULL),
	(247, '171209000', '(Less) Reser Gen LL\r', NULL, NULL, NULL),
	(248, '171209111', '(Less) Reser Gen LL_Group\r', NULL, NULL, NULL),
	(249, '171209112', '(Less) Reser Gen LL_Individual\r', NULL, NULL, NULL),
	(250, '171209113', '(Less) Reser Gen LL_Enterprises\r', NULL, NULL, NULL),
	(251, '171209114', '(Less) Reser Gen LL_Related Parties\r', NULL, NULL, NULL),
	(252, '171209115', '(Less) Reser Gen LL_OD\r', NULL, NULL, NULL),
	(253, '171209119', '(Less) Reser Gen LL_Others\r', NULL, NULL, NULL),
	(254, '200009000', 'Total Assets Control Account\r', NULL, NULL, NULL),
	(255, '211009000', 'Inv Debt Security - HTM\r', NULL, NULL, NULL),
	(256, '211009111', 'Inv Debt Security - HTM\r', NULL, NULL, NULL),
	(257, '211609000', 'Accum Preemium (Discount) - HTM\r', NULL, NULL, NULL),
	(258, '211609111', 'Accum Preemium (Discount) - HTM\r', NULL, NULL, NULL),
	(259, '212009000', 'Inv Debt Security - AFS\r', NULL, NULL, NULL),
	(260, '212009111', 'Inv Debt Security - AFS\r', NULL, NULL, NULL),
	(261, '212609000', 'Accum Premium (Discount) - AFS\r', NULL, NULL, NULL),
	(262, '212609111', 'Accum Premium (Discount) - AFS\r', NULL, NULL, NULL),
	(263, '213809000', 'Other Inv Security\r', NULL, NULL, NULL),
	(264, '213809111', 'Other Inv Security\r', NULL, NULL, NULL),
	(265, '214909000', 'Investment in Equity Capital\r', NULL, NULL, NULL),
	(266, '214909111', 'Investment in Equity Capital\r', NULL, NULL, NULL),
	(267, '215609000', 'Net Unrealized Holding Gains (Loss) \r', NULL, NULL, NULL),
	(268, '215609111', 'Net Unrealized Holding Gains (Loss) - AFS\r', NULL, NULL, NULL),
	(269, '221109000', 'Prepaid Insurance\r', NULL, NULL, NULL),
	(270, '221109111', 'Prepaid Insurance\r', NULL, NULL, NULL),
	(271, '221209000', 'Prepaid Deposit Insurance Assessment\r', NULL, NULL, NULL),
	(272, '221209111', 'Prepaid Deposit Insurance Assessment\r', NULL, NULL, NULL),
	(273, '221309000', 'Prepaid Service/Maintenance Contract\r', NULL, NULL, NULL),
	(274, '221309111', 'Prepaid Service / Maintenance Contracts\r', NULL, NULL, NULL),
	(275, '221409000', 'Prepaid Professional Fees\r', NULL, NULL, NULL),
	(276, '221409111', 'Prepaid Professional Fees\r', NULL, NULL, NULL),
	(277, '221509000', 'Prepaid Rent\r', NULL, NULL, NULL),
	(278, '221509111', 'Prepaid Rent\r', NULL, NULL, NULL),
	(279, '221609000', 'Prepaid Profit Tax\r', NULL, NULL, NULL),
	(280, '221609111', 'Prepaid Profit Tax\r', NULL, NULL, NULL),
	(281, '222309000', 'Advance Payment or Deposits\r', NULL, NULL, NULL),
	(282, '222309111', 'Advance Payment or Deposits_Travel & Mission\r', NULL, NULL, NULL),
	(283, '222309112', 'Advance Payment or Deposits_Purchases\r', NULL, NULL, NULL),
	(284, '222309113', 'Advance Payment or Deposits_Rental\r', NULL, NULL, NULL),
	(285, '222309119', 'Advance Payment or Deposits_Others\r', NULL, NULL, NULL),
	(286, '222409000', 'Purchased Interest Receivable\r', NULL, NULL, NULL),
	(287, '222409111', 'Purchased Interest Receivable\r', NULL, NULL, NULL),
	(288, '222509000', 'Stationary Supply & Inventory\r', NULL, NULL, NULL),
	(289, '222509111', 'Stationary Supply & Inventory\r', NULL, NULL, NULL),
	(290, '231109000', 'AIR - Due from NBC\r', NULL, NULL, NULL),
	(291, '231109111', 'AIR - Due from NBC\r', NULL, NULL, NULL),
	(292, '231209000', 'AIR - Capital Guar Depo  with NBC\r', NULL, NULL, NULL),
	(293, '231209111', 'AIR - Capital Guar Depo  with NBC\r', NULL, NULL, NULL),
	(294, '231309000', 'AIR - Other Demand Depo with NBC\r', NULL, NULL, NULL),
	(295, '231309112', 'AIR - Other Demand Depo with NBC\r', NULL, NULL, NULL),
	(296, '231609000', 'AIR - Other Term Depo with NBC\r', NULL, NULL, NULL),
	(297, '231609113', 'AIR - Other Term Depo with NBC\r', NULL, NULL, NULL),
	(298, '232109000', 'AIR-DD&SAV Depo BK rated AAA to AA-\r', NULL, NULL, NULL),
	(299, '232109111', 'AIR - DD & SAV Depo  BK rated AAA to AA-\r', NULL, NULL, NULL),
	(300, '232209000', 'AIR-DD & SAV Depo  BK rated A+ to A-\r', NULL, NULL, NULL),
	(301, '232209111', 'AIR - DD & SAV Depo  BK rated A+ to A-\r', NULL, NULL, NULL),
	(302, '232309000', 'AIR-DD & SAV Depo  BK rated below A-\r', NULL, NULL, NULL),
	(303, '232309111', 'AIR - DD & SAV Depo  BK rated below A-\r', NULL, NULL, NULL),
	(304, '233109000', 'AIR-TD & Placement BK rated AAA to AA-\r', NULL, NULL, NULL),
	(305, '233109111', 'AIR - TD & Placement BK rated AAA to AA-\r', NULL, NULL, NULL),
	(306, '233209000', 'AIR-TD & Placement BK rated A+ to A-\r', NULL, NULL, NULL),
	(307, '233209111', 'AIR - TD & Placement BK rated A+ to A-\r', NULL, NULL, NULL),
	(308, '233309000', 'AIR-TD & Placement BK rated below A-\r', NULL, NULL, NULL),
	(309, '233309111', 'AIR - TD & Placement BK rated A+ to A-\r', NULL, NULL, NULL),
	(310, '234109000', 'AIR - Claims  Sovereigns rated AAA to AA-\r', NULL, NULL, NULL),
	(311, '234109111', 'AIR - Claims  Sovereigns rated AAA to AA-\r', NULL, NULL, NULL),
	(312, '234209000', 'AIR - Claims Sovereigns rated A+ to A-\r', NULL, NULL, NULL),
	(313, '234209111', 'AIR - Claims  Sovereigns rated A+ to A-\r', NULL, NULL, NULL),
	(314, '234309000', 'AIR - Claims  Sovereigns rated BBB+ to BBB-\r', NULL, NULL, NULL),
	(315, '234309111', 'AIR - Claims  Sovereigns rated BBB+ to BBB-\r', NULL, NULL, NULL),
	(316, '234409000', 'AIR - Claims Sovereigns rated below BBB-\r', NULL, NULL, NULL),
	(317, '234409111', 'AIR - Claims  Sovereigns rated below BBB-\r', NULL, NULL, NULL),
	(318, '241009000', 'AIR-Investment Debt Securities - HTM\r', NULL, NULL, NULL),
	(319, '241009111', 'AIR - Investment Debt Securities - HTM \r', NULL, NULL, NULL),
	(320, '242009000', 'AIR-Investment Debt Securities-AFS\r', NULL, NULL, NULL),
	(321, '242009111', 'AIR - Investment Debt Securities - AFS\r', NULL, NULL, NULL),
	(322, '243009000', 'AIR - Other Investment\r', NULL, NULL, NULL),
	(323, '243009111', 'AIR - Other Investment \r', NULL, NULL, NULL),
	(324, '251109000', 'AIR - STDL - Groups <=1 year\r', NULL, NULL, NULL),
	(325, '251109111', 'AIR - STDL - Groups <=1 year\r', NULL, NULL, NULL),
	(326, '251209000', 'AIR - STDL - Individuals<=1 year\r', NULL, NULL, NULL),
	(327, '251209111', 'AIR - STDL - Individuals<=1 year\r', NULL, NULL, NULL),
	(328, '251209112', 'AIR - STDL - Individuals_OD <=1 year\r', NULL, NULL, NULL),
	(329, '251309000', 'AIR - STDL - Enterprises<=1 year\r', NULL, NULL, NULL),
	(330, '251309111', 'AIR - STDL - Enterprises<=1 year\r', NULL, NULL, NULL),
	(331, '251309112', 'AIR - STDL - Enterprises_OD <=1 year\r', NULL, NULL, NULL),
	(332, '251409000', 'AIR - STDL - Others<=1 year\r', NULL, NULL, NULL),
	(333, '251409111', 'AIR - STDL - Others<=1 year\r', NULL, NULL, NULL),
	(334, '251409112', 'AIR - STDL - Others_OD <=1 year\r', NULL, NULL, NULL),
	(335, '251519000', 'AIR - STDL - Rela Pty<=1 year-Shareholder\r', NULL, NULL, NULL),
	(336, '251519111', 'AIR - STDL - Rela Pty<=1 year - SHolder\r', NULL, NULL, NULL),
	(337, '251519112', 'AIR - STDL - Rela Pty_OD <=1 year - Shareholder\r', NULL, NULL, NULL),
	(338, '251529000', 'AIR - STDL - Rela Pty<=1 year-Manager\r', NULL, NULL, NULL),
	(339, '251529111', 'AIR - STDL - Rela Pty<=1 year - Manager\r', NULL, NULL, NULL),
	(340, '251529112', 'AIR - STDL - Rela Pty_OD <=1 year - Manager\r', NULL, NULL, NULL),
	(341, '251539000', 'AIR - STDL - Rela Pty<=1 year-Employee\r', NULL, NULL, NULL),
	(342, '251539111', 'AIR - STDL - Rela Pty<=1 year - Employee\r', NULL, NULL, NULL),
	(343, '251539112', 'AIR - STDL - Rela Pty_OD <=1 year - Employee\r', NULL, NULL, NULL),
	(344, '251549000', 'AIR - STDL - Rela Pty<=1 year-Ex Audit\r', NULL, NULL, NULL),
	(345, '251549111', 'AIR - STDL - Rela Pty<=1 year - Ex Audit\r', NULL, NULL, NULL),
	(346, '251549112', 'AIR - STDL - Rela Pty_OD <=1 year - Ex Auditor\r', NULL, NULL, NULL),
	(347, '252109000', 'AIR - STDL - Groups>1 year\r', NULL, NULL, NULL),
	(348, '252109111', 'AIR - STDL - Groups>1 year\r', NULL, NULL, NULL),
	(349, '252209000', 'AIR - STDL - Individuals>1 year\r', NULL, NULL, NULL),
	(350, '252209111', 'AIR - STDL - Individuals>1 year\r', NULL, NULL, NULL),
	(351, '252309000', 'AIR - STDL - Enterprises>1 year\r', NULL, NULL, NULL),
	(352, '252309111', 'AIR - STDL - Enterprises>1 year\r', NULL, NULL, NULL),
	(353, '252409000', 'AIR - STDL - Others> 1 year\r', NULL, NULL, NULL),
	(354, '252409111', 'AIR - STDL - Others> 1 year\r', NULL, NULL, NULL),
	(355, '252519000', 'AIR - STDL - Rela Pty>1 year-Shareholder\r', NULL, NULL, NULL),
	(356, '252519111', 'AIR - STDL - Rela Pty>1 year - Shareholder\r', NULL, NULL, NULL),
	(357, '252529000', 'AIR - STDL - Rela Pty>1 year-Manager\r', NULL, NULL, NULL),
	(358, '252529111', 'AIR - STDL - Rela Pty>1 year - Manager\r', NULL, NULL, NULL),
	(359, '252539000', 'AIR - STDL - Rela Pty>1 year-Employee\r', NULL, NULL, NULL),
	(360, '252539111', 'AIR - STDL - Rela Pty>1 year - Employee\r', NULL, NULL, NULL),
	(361, '252549000', 'AIR - STDL - Rela Pty>1 year - Ex Audit\r', NULL, NULL, NULL),
	(362, '252549111', 'AIR - STDL - Rela Pty>1 year - Ex Audit\r', NULL, NULL, NULL),
	(363, '261109000', 'AIR - Sub STDL - Groups<=1 year\r', NULL, NULL, NULL),
	(364, '261109111', 'AIR - Sub STDL - Groups<=1 year\r', NULL, NULL, NULL),
	(365, '261209000', 'AIR - Sub STDL - Individuals<=1 year\r', NULL, NULL, NULL),
	(366, '261209111', 'AIR - Sub STDL - Individuals<=1 year\r', NULL, NULL, NULL),
	(367, '261209112', 'AIR - Sub STDL - Individuals_OD <=1 year\r', NULL, NULL, NULL),
	(368, '261309000', 'AIR - Sub STDL - Enterprises<=1 year\r', NULL, NULL, NULL),
	(369, '261309111', 'AIR - Sub STDL - Enterprises<=1 year\r', NULL, NULL, NULL),
	(370, '261309112', 'AIR - Sub STDL - Enterprises_OD <=1 year\r', NULL, NULL, NULL),
	(371, '261409000', 'AIR - Sub STDL - Others<=1 year\r', NULL, NULL, NULL),
	(372, '261409111', 'AIR - Sub STDL - Others<=1 year\r', NULL, NULL, NULL),
	(373, '261409112', 'AIR - Sub STDL - Others_OD <=1 year\r', NULL, NULL, NULL),
	(374, '261519000', 'AIR - Sub STDL - Rela Pty<=1year-Shareholder\r', NULL, NULL, NULL),
	(375, '261519111', 'AIR - Sub STDL - Rela Pty<=1 year - SHolder\r', NULL, NULL, NULL),
	(376, '261519112', 'AIR - Sub STDL - Rela Pty_OD <=1 year - Shareholder\r', NULL, NULL, NULL),
	(377, '261529000', 'AIR - Sub STDL - Rela Pty<=1 year - Manager\r', NULL, NULL, NULL),
	(378, '261529111', 'AIR - Sub STDL - Rela Pty<=1 year - Manager\r', NULL, NULL, NULL),
	(379, '261529112', 'AIR - Sub STDL - Rela Pty_OD <=1 year - Manager\r', NULL, NULL, NULL),
	(380, '261539000', 'AIR - Sub STDL - Rela Pty<=1 year - Employee\r', NULL, NULL, NULL),
	(381, '261539111', 'AIR - Sub STDL - Rela Pty<=1 year - Employee\r', NULL, NULL, NULL),
	(382, '261539112', 'AIR - Sub STDL - Rela Pty_OD <=1 year - Employee\r', NULL, NULL, NULL),
	(383, '261549000', 'AIR - Sub STDL - Rela Pty<=1year - Ex Audit\r', NULL, NULL, NULL),
	(384, '261549111', 'AIR - Sub STDL - Rela Pty<=1 year - Ex Audit\r', NULL, NULL, NULL),
	(385, '261549112', 'AIR - Sub STDL - Rela Pty_OD <=1 year - Ex Audit\r', NULL, NULL, NULL),
	(386, '262109000', 'AIR - Sub STDL - Groups>1 year\r', NULL, NULL, NULL),
	(387, '262109111', 'AIR - Sub STDL - Groups>1 year\r', NULL, NULL, NULL),
	(388, '262209000', 'AIR - Sub STDL - Individuals>1 year\r', NULL, NULL, NULL),
	(389, '262209111', 'AIR - Sub STDL - Individuals>1 year\r', NULL, NULL, NULL),
	(390, '262309000', 'AIR - Sub STDL - Enterprises>1 year\r', NULL, NULL, NULL),
	(391, '262309111', 'AIR - Sub STDL - Enterprises>1 year\r', NULL, NULL, NULL),
	(392, '262409000', 'AIR - Sub STDL - Others>1 year\r', NULL, NULL, NULL),
	(393, '262409111', 'AIR - Sub STDL - Others>1 year\r', NULL, NULL, NULL),
	(394, '262519000', 'AIR - Sub STDL - Rela Pty>1year-Shareholder\r', NULL, NULL, NULL),
	(395, '262519111', 'AIR - Sub STDL - Rela Pty>1 year - Shareholder\r', NULL, NULL, NULL),
	(396, '262529000', 'AIR - Sub STDL - Rela Pty>1 year-Manager\r', NULL, NULL, NULL),
	(397, '262529111', 'AIR - Sub STDL - Rela Pty>1 year - Manager\r', NULL, NULL, NULL),
	(398, '262539000', 'AIR - Sub STDL - Rela Pty>1 year-Employee\r', NULL, NULL, NULL),
	(399, '262539111', 'AIR - Sub STDL - Rela Pty>1 year - Employee\r', NULL, NULL, NULL),
	(400, '262549000', 'AIR - Sub STDL - Rela Pty>1 year-Ex Audit\r', NULL, NULL, NULL),
	(401, '262549111', 'AIR - Sub STDL - Rela Pty>1 year - Ex Audit\r', NULL, NULL, NULL),
	(402, '271109000', 'AIR - DFL - Groups<=1 year\r', NULL, NULL, NULL),
	(403, '271109111', 'AIR - DFL - Groups<=1 year\r', NULL, NULL, NULL),
	(404, '271209000', 'AIR - DFL - Individuals<=1 year\r', NULL, NULL, NULL),
	(405, '271209111', 'AIR - DFL - Individuals<=1 year\r', NULL, NULL, NULL),
	(406, '271209112', 'AIR - DFL - Individuals_OD <=1 year\r', NULL, NULL, NULL),
	(407, '271309000', 'AIR - DFL - Enterprises<=1 year\r', NULL, NULL, NULL),
	(408, '271309111', 'AIR - DFL - Enterprises<=1 year\r', NULL, NULL, NULL),
	(409, '271309112', 'AIR - DFL - Enterprises_OD <=1 year\r', NULL, NULL, NULL),
	(410, '271409000', 'AIR - DFL - Others<=1 year\r', NULL, NULL, NULL),
	(411, '271409111', 'AIR - DFL - Others<=1 year\r', NULL, NULL, NULL),
	(412, '271409112', 'AIR - DFL - Others_OD <=1 year\r', NULL, NULL, NULL),
	(413, '271519000', 'AIR - DFL - Rela Pty<=1year-Shareholder\r', NULL, NULL, NULL),
	(414, '271519111', 'AIR - DFL - Rela Pty<=1 year - Shareholder\r', NULL, NULL, NULL),
	(415, '271519112', 'AIR - DFL - Rela Pty_OD <=1 year - Shareholder\r', NULL, NULL, NULL),
	(416, '271529000', 'AIR - DFL - Rela Pty<=1year-Manager\r', NULL, NULL, NULL),
	(417, '271529111', 'AIR - DFL - Rela Pty<=1 year - Manager\r', NULL, NULL, NULL),
	(418, '271529112', 'AIR - DFL - Rela Pty_OD <=1 year - Manager\r', NULL, NULL, NULL),
	(419, '271539000', 'AIR - DFL - Rela Pty<=1year-Employee\r', NULL, NULL, NULL),
	(420, '271539111', 'AIR - DFL - Rela Pty<=1 year - Employee\r', NULL, NULL, NULL),
	(421, '271539112', 'AIR - DFL - Rela Pty_OD <=1 year - Employee\r', NULL, NULL, NULL),
	(422, '271549000', 'AIR - DFL - Rela Pty<=1 year-Ex Audit\r', NULL, NULL, NULL),
	(423, '271549111', 'AIR - DFL - Rela Pty<=1 year - Ex Audit\r', NULL, NULL, NULL),
	(424, '271549112', 'AIR - DFL - Rela Pty_OD <=1 year - Ex Auditor\r', NULL, NULL, NULL),
	(425, '272109000', 'AIR - DFL - Groups>1 year\r', NULL, NULL, NULL),
	(426, '272109111', 'AIR - DFL - Groups>1 year\r', NULL, NULL, NULL),
	(427, '272209000', 'AIR - DFL - Individuals>1 year\r', NULL, NULL, NULL),
	(428, '272209111', 'AIR - DFL - Individuals>1 year\r', NULL, NULL, NULL),
	(429, '272309000', 'AIR - DFL - Enterprises>1 year\r', NULL, NULL, NULL),
	(430, '272309111', 'AIR - DFL - Enterprises>1 year\r', NULL, NULL, NULL),
	(431, '272409000', 'AIR - DFL - Others>1 year\r', NULL, NULL, NULL),
	(432, '272409111', 'AIR - DFL - Others>1 year\r', NULL, NULL, NULL),
	(433, '272519000', 'AIR - DFL - Rela Pty>1year - Shareholder\r', NULL, NULL, NULL),
	(434, '272519111', 'AIR - DFL - Rela Pty>1 year - Shareholder\r', NULL, NULL, NULL),
	(435, '272529000', 'AIR - DFL - Rela Pty>1year - Manager\r', NULL, NULL, NULL),
	(436, '272529111', 'AIR - DFL - Rela Pty>1 year - Manager\r', NULL, NULL, NULL),
	(437, '272539000', 'AIR - DFL - Rela Pty>1year-Employee\r', NULL, NULL, NULL),
	(438, '272539111', 'AIR - DFL - Rela Pty>1 year - Employee\r', NULL, NULL, NULL),
	(439, '272549000', 'AIR - DFL - Rela Pty>1year-Ex Audit\r', NULL, NULL, NULL),
	(440, '272549111', 'AIR - DFL - Rela Pty>1 year - Ex Audit\r', NULL, NULL, NULL),
	(441, '281109000', 'AIR - LL - Groups<=1 year\r', NULL, NULL, NULL),
	(442, '281109111', 'AIR - LL - Groups<=1 year\r', NULL, NULL, NULL),
	(443, '281209000', 'AIR - LL - Individuals<=1 year\r', NULL, NULL, NULL),
	(444, '281209111', 'AIR - LL - Individuals<=1 year\r', NULL, NULL, NULL),
	(445, '281209112', 'AIR - LL - Individuals_OD <=1 year\r', NULL, NULL, NULL),
	(446, '281309000', 'AIR - LL - Enterprises<=1 year\r', NULL, NULL, NULL),
	(447, '281309111', 'AIR - LL - Enterprises<=1 year\r', NULL, NULL, NULL),
	(448, '281309112', 'AIR - LL - Enterprises_OD <=1 year\r', NULL, NULL, NULL),
	(449, '281409000', 'AIR - LL - Others<=1 year\r', NULL, NULL, NULL),
	(450, '281409111', 'AIR - LL - Others<=1 year\r', NULL, NULL, NULL),
	(451, '281409112', 'AIR - LL - Others_OD <=1 year\r', NULL, NULL, NULL),
	(452, '281519000', 'AIR - LL - Rela Pty<=1year-Shareholder\r', NULL, NULL, NULL),
	(453, '281519111', 'AIR - LL - Rela Pty<=1 year - Shareholder\r', NULL, NULL, NULL),
	(454, '281519112', 'AIR - LL - Rela Pty_OD <=1 year - Shareholder\r', NULL, NULL, NULL),
	(455, '281529000', 'AIR - LL - Rela Pty<=1 year -Manager\r', NULL, NULL, NULL),
	(456, '281529111', 'AIR - LL - Rela Pty<=1 year - Manager\r', NULL, NULL, NULL),
	(457, '281529112', 'AIR - LL - Rela Pty_OD <=1 year - Manager\r', NULL, NULL, NULL),
	(458, '281539000', 'AIR - LL - Rela Pty<=1 year-Employee\r', NULL, NULL, NULL),
	(459, '281539111', 'AIR - LL - Rela Pty<=1 year - Employee\r', NULL, NULL, NULL),
	(460, '281539112', 'AIR - LL - Rela Pty_OD <=1 year - Employee\r', NULL, NULL, NULL),
	(461, '281549000', 'AIR - LL - Rela Pty<=1 year-Ex Audit\r', NULL, NULL, NULL),
	(462, '281549111', 'AIR - LL - Rela Pty<=1 year - Ex Audit\r', NULL, NULL, NULL),
	(463, '281549112', 'AIR - LL - Rela Pty_OD <=1 year - Ex Auditor\r', NULL, NULL, NULL),
	(464, '282109000', 'AIR - LL - Groups>1 year\r', NULL, NULL, NULL),
	(465, '282109111', 'AIR - LL - Groups>1 year\r', NULL, NULL, NULL),
	(466, '282209000', 'AIR - LL - Individuals>1 year\r', NULL, NULL, NULL),
	(467, '282209111', 'AIR - LL - Individuals>1 year\r', NULL, NULL, NULL),
	(468, '282309000', 'AIR - LL - Enterprises>1 year\r', NULL, NULL, NULL),
	(469, '282309111', 'AIR - LL - Enterprises>1 year\r', NULL, NULL, NULL),
	(470, '282409000', 'AIR - LL - Others>1 year\r', NULL, NULL, NULL),
	(471, '282409111', 'AIR - LL - Others>1 year\r', NULL, NULL, NULL),
	(472, '282519000', 'AIR - LL - Rela Pty>1year-Shareholder\r', NULL, NULL, NULL),
	(473, '282519111', 'AIR - LL - Rela Pty>1 year - Shareholder\r', NULL, NULL, NULL),
	(474, '282529000', 'AIR - LL - Rela Pty>1 year - Manager\r', NULL, NULL, NULL),
	(475, '282529111', 'AIR - LL - Rela Pty>1 year - Manager\r', NULL, NULL, NULL),
	(476, '282539000', 'AIR - LL - Rela Pty>1 year - Employee\r', NULL, NULL, NULL),
	(477, '282539111', 'AIR - LL - Rela Pty>1 year - Employee\r', NULL, NULL, NULL),
	(478, '282549000', 'AIR - LL - Rela Pty>1 year - Ex Audit\r', NULL, NULL, NULL),
	(479, '282549111', 'AIR - LL - Rela Pty>1 year - Ex Audit\r', NULL, NULL, NULL),
	(480, '289709000', 'Accounts Receivable \r', NULL, NULL, NULL),
	(481, '289709111', 'Accounts Receivable_Fees on Borrowing\r', NULL, NULL, NULL),
	(482, '289709112', 'Accounts Receivable_Other\r', NULL, NULL, NULL),
	(483, '289809000', 'Inc Tax Receivable/Recoverable\r', NULL, NULL, NULL),
	(484, '289809111', 'Inc Tax Receivable/Recoverable\r', NULL, NULL, NULL),
	(485, '289909000', 'Dividends Receivable\r', NULL, NULL, NULL),
	(486, '289909111', 'Dividends Receivable\r', NULL, NULL, NULL),
	(487, '291109000', 'Land \r', NULL, NULL, NULL),
	(488, '291109111', 'Land \r', NULL, NULL, NULL),
	(489, '291209000', 'Land Improvement\r', NULL, NULL, NULL),
	(490, '291209111', 'Land Improvement\r', NULL, NULL, NULL),
	(491, '292109000', 'Building \r', NULL, NULL, NULL),
	(492, '292109111', 'Building \r', NULL, NULL, NULL),
	(493, '292209000', 'Leasehold Improvement\r', NULL, NULL, NULL),
	(494, '292209111', 'Leasehold Improvement\r', NULL, NULL, NULL),
	(495, '292309000', 'FA Under Construction/Development\r', NULL, NULL, NULL),
	(496, '292309111', 'FA Under Construction/Development\r', NULL, NULL, NULL),
	(497, '293109000', 'Furniture and Fixtures\r', NULL, NULL, NULL),
	(498, '293109111', 'Furniture and Fixtures\r', NULL, NULL, NULL),
	(499, '293209000', 'Equipment\r', NULL, NULL, NULL),
	(500, '293209111', 'Equipment\r', NULL, NULL, NULL),
	(501, '293309000', 'Computer Equipment\r', NULL, NULL, NULL),
	(502, '293309111', 'Computer Equipment\r', NULL, NULL, NULL),
	(503, '293409000', 'Motor Vehicles\r', NULL, NULL, NULL),
	(504, '293409111', 'Motor Vehicles\r', NULL, NULL, NULL),
	(505, '293509000', 'Other Fixed Assets\r', NULL, NULL, NULL),
	(506, '293509111', 'Other Fixed Assets\r', NULL, NULL, NULL),
	(507, '294109000', 'Accum Depr - Land Improve\r', NULL, NULL, NULL),
	(508, '294109111', 'Accum Depr - Land Improve\r', NULL, NULL, NULL),
	(509, '294209000', 'Accum Depr - Buildings\r', NULL, NULL, NULL),
	(510, '294209111', 'Accum Depr - Buildings \r', NULL, NULL, NULL),
	(511, '294309000', 'Accum Depr - Leasehold Improve\r', NULL, NULL, NULL),
	(512, '294309111', 'Accum Depr - Leasehold Improve \r', NULL, NULL, NULL),
	(513, '294409000', 'Accum Depr - Furniture and Fixtures\r', NULL, NULL, NULL),
	(514, '294409111', 'Accum Depr - Furniture and Fixtures \r', NULL, NULL, NULL),
	(515, '294509000', 'Accum Depr - Equipment\r', NULL, NULL, NULL),
	(516, '294509111', 'Accum Depr - Equipment \r', NULL, NULL, NULL),
	(517, '294609000', 'Accum Depr - Computer Equipment \r', NULL, NULL, NULL),
	(518, '294609111', 'Accum Depr - Computer Equipment \r', NULL, NULL, NULL),
	(519, '294709000', 'Accum Depr - Motor Vehicles\r', NULL, NULL, NULL),
	(520, '294709111', 'Accum Depr - Motor Vehicles \r', NULL, NULL, NULL),
	(521, '294809000', 'Accum Depr - Other Fixed Assets\r', NULL, NULL, NULL),
	(522, '294809111', 'Accum Depr - Other Fixed Assets \r', NULL, NULL, NULL),
	(523, '294919000', 'Amort - Intangible Assets\r', NULL, NULL, NULL),
	(524, '294919111', 'Amort - Intangible Assets \r', NULL, NULL, NULL),
	(525, '294929000', 'Amort - Formation Exps\r', NULL, NULL, NULL),
	(526, '294929111', 'Amort - Formation Exps\r', NULL, NULL, NULL),
	(527, '295109000', 'Formation Exps\r', NULL, NULL, NULL),
	(528, '295109111', 'Formation Exps\r', NULL, NULL, NULL),
	(529, '295209000', 'Intangible Assets\r', NULL, NULL, NULL),
	(530, '295209111', 'Intangible Assets\r', NULL, NULL, NULL),
	(531, '296509000', 'Inter-Branch Accounts\r', NULL, NULL, NULL),
	(532, '296509001', 'IBA_Pursat (PUR)\r', NULL, NULL, NULL),
	(533, '296509002', 'IBA_Kampong Thom (KTM)\r', NULL, NULL, NULL),
	(534, '296509003', 'IBA_Siem Reap (SRP)\r', NULL, NULL, NULL),
	(535, '296509004', 'IBA_Banteay Meanchey (BMC)\r', NULL, NULL, NULL),
	(536, '296509005', 'IBA_Phnom Penh (PNP)\r', NULL, NULL, NULL),
	(537, '296509006', 'IBA_Kampong Cham (KCM)\r', NULL, NULL, NULL),
	(538, '296509007', 'IBA_Battambang (BTB)\r', NULL, NULL, NULL),
	(539, '296509008', 'IBA_Kampong Chnang (KCG)\r', NULL, NULL, NULL),
	(540, '296509009', 'IBA_Takeo (TAK)\r', NULL, NULL, NULL),
	(541, '296509010', 'IBA_Pre Veng (PVG)\r', NULL, NULL, NULL),
	(542, '296509011', 'IBA_Takhmao (TMO)\r', NULL, NULL, NULL),
	(543, '296509012', 'IBA_Svay Rieng (SVG)\r', NULL, NULL, NULL),
	(544, '296509013', 'IBA_Kampong Speu (KSP)\r', NULL, NULL, NULL),
	(545, '296509014', 'IBA_Kamport (KPT)\r', NULL, NULL, NULL),
	(546, '296509015', 'IBA_Koh Kong (KKG)\r', NULL, NULL, NULL),
	(547, '296509016', 'IBA_Sihanuk Ville (SNV)\r', NULL, NULL, NULL),
	(548, '296509017', 'IBA_Kratie (KTE)\r', NULL, NULL, NULL),
	(549, '296509018', 'IBA_KTM_Staung (STN)\r', NULL, NULL, NULL),
	(550, '296509019', 'IBA_PNP_Dongkor (DKO)\r', NULL, NULL, NULL),
	(551, '296509020', 'IBA_KCM_Thoung Khum (TKM)\r', NULL, NULL, NULL),
	(552, '296509021', 'IBA_PNP_Doun Penh (DNP)\r', NULL, NULL, NULL),
	(553, '296509022', 'IBA_SRP_Chi Kreng (CKG)\r', NULL, NULL, NULL),
	(554, '296509023', 'IBA_SRP_Sothnikum (SNK)\r', NULL, NULL, NULL),
	(555, '296509024', 'IBA_BMC_Pioy Pet (PPT)\r', NULL, NULL, NULL),
	(556, '296509025', 'IBA_SRP_Pouk (PUK)\r', NULL, NULL, NULL),
	(557, '296509026', 'IBA_KTM_Baray (BRY)\r', NULL, NULL, NULL),
	(558, '296509027', 'IBA_PUR_Bakan (BKN)\r', NULL, NULL, NULL),
	(559, '296509028', 'IBA_KCM_Memut (MMT)\r', NULL, NULL, NULL),
	(560, '296509029', 'IBA_KDL_Mukampoul (MKP)\r', NULL, NULL, NULL),
	(561, '296509030', 'IBA_BMC_Thmor Pouk (TPK)\r', NULL, NULL, NULL),
	(562, '296509031', 'IBA_KCM_Pre Chhor (PCH)\r', NULL, NULL, NULL),
	(563, '296509032', 'IBA_PNP_Operational Office (OPO)\r', NULL, NULL, NULL),
	(564, '296509033', 'IBA_BTB_Bavel (BVL)\r', NULL, NULL, NULL),
	(565, '296509034', 'IBA_Ortdor Meanchey (OMC)\r', NULL, NULL, NULL),
	(566, '296509035', 'IBA_Preah Vihear (PVH)\r', NULL, NULL, NULL),
	(567, '296509036', 'IBA_Stung Treng (STG)\r', NULL, NULL, NULL),
	(568, '296509037', 'IBA_Ratanakiri (RKR)\r', NULL, NULL, NULL),
	(569, '296509038', 'IBA_Mondul Kiri (MKR)\r', NULL, NULL, NULL),
	(570, '296509039', 'IBA_Pailin (PLN)\r', NULL, NULL, NULL),
	(571, '296509040', 'IBA_Kep (KEP)\r', NULL, NULL, NULL),
	(572, '296509041', 'IBA_SRP_Krong Siem Reap \r', NULL, NULL, NULL),
	(573, '296509042', 'IBA_OMC_Along Veng\r', NULL, NULL, NULL),
	(574, '296509043', 'IBA_PVH_Rovieng\r', NULL, NULL, NULL),
	(575, '296509044', 'IBA_TKM_Sandan\r', NULL, NULL, NULL),
	(576, '296509045', 'IBA_BMC_Mongkoul Borey\r', NULL, NULL, NULL),
	(577, '296509046', 'IBA_PNP_Boung Trabek\r', NULL, NULL, NULL),
	(578, '296509047', 'IBA_KDL_Kien Svay\r', NULL, NULL, NULL),
	(579, '296509048', 'IBA_KCM_Chamkar Leu\r', NULL, NULL, NULL),
	(580, '296509049', 'IBA_BTB_Rothanak Mundol\r', NULL, NULL, NULL),
	(581, '296509050', 'IBA_TAK_Bati\r', NULL, NULL, NULL),
	(582, '296509051', 'IBA_PVG_Neak Leurng\r', NULL, NULL, NULL),
	(583, '296509052', 'IBA_PVG_Svay Antor\r', NULL, NULL, NULL),
	(584, '296509053', 'IBA_KDL_Ang Snoul\r', NULL, NULL, NULL),
	(585, '296509054', 'IBA_PNP_Russey Keo\r', NULL, NULL, NULL),
	(586, '296509055', 'IBA_PNP_Preak Leap\r', NULL, NULL, NULL),
	(587, '296509056', 'IBA_KDL_Koh Thom\r', NULL, NULL, NULL),
	(588, '296509057', 'IBA_KDL_Saang\r', NULL, NULL, NULL),
	(589, '296509058', 'IBA_BMC_Malai\r', NULL, NULL, NULL),
	(590, '296509059', 'IBA_SRP_Krolanh\r', NULL, NULL, NULL),
	(591, '296509060', 'IBA_BTB_Moung Russey\r', NULL, NULL, NULL),
	(592, '296509061', 'IBA_KCM_Ponhea Kraek\r', NULL, NULL, NULL),
	(593, '296509062', 'IBA_BTB_Thmor Koul\r', NULL, NULL, NULL),
	(594, '296509063', 'IBA_KTE_Chloung\r', NULL, NULL, NULL),
	(595, '296509064', 'IBA_SRP_Bakorng\r', NULL, NULL, NULL),
	(596, '296509065', 'IBA_KCM_Batheay\r', NULL, NULL, NULL),
	(597, '296509066', 'IBA_TAK_Kiribvong\r', NULL, NULL, NULL),
	(598, '296509999', 'IBA_Head Office (HO)\r', NULL, NULL, NULL),
	(599, '296609111', 'Equiv FOREX Position Acct\r', NULL, NULL, NULL),
	(600, '296709000', 'Suspense Asset Account \r', NULL, NULL, NULL),
	(601, '296709111', 'Suspense Asset Account\r', NULL, NULL, NULL),
	(602, '296709112', 'OFSS Value Date Mismatch Suspense GL\r', NULL, NULL, NULL),
	(603, '296709113', 'OFSS Error Posting & Suspense Account\r', NULL, NULL, NULL),
	(604, '296709114', 'Account to Account Transfers\r', NULL, NULL, NULL),
	(605, '296709115', 'Items for Clearification\r', NULL, NULL, NULL),
	(606, '296709116', 'Suspense Asset Account_Others\r', NULL, NULL, NULL),
	(607, '296709117', 'Suspense Asset Account_Cash Shortage/ Overage\r', NULL, NULL, NULL),
	(608, '296709211', 'Debit Settlement Bridge for Loans\r', NULL, NULL, NULL),
	(609, '296809000', 'Other Sundry Assets \r', NULL, NULL, NULL),
	(610, '296809111', 'Other Sundry Assets \r', NULL, NULL, NULL),
	(611, '300009000', 'Total Liabilities Control Account\r', NULL, NULL, NULL),
	(612, '321109000', 'Amounts owed to NBC\r', NULL, NULL, NULL),
	(613, '321109111', 'Amounts owed to NBC\r', NULL, NULL, NULL),
	(614, '322109000', 'Voluntary Depo - Demand\r', NULL, NULL, NULL),
	(615, '322109111', 'Voluntary Depo - Demand\r', NULL, NULL, NULL),
	(616, '322209000', 'Voluntary Deposits - Savings\r', NULL, NULL, NULL),
	(617, '322209111', 'Voluntary Depo - Savings\r', NULL, NULL, NULL),
	(618, '322309000', 'Voluntary Deposits - Term\r', NULL, NULL, NULL),
	(619, '322309111', 'Voluntary Depo - Term\r', NULL, NULL, NULL),
	(620, '322409000', 'Voluntary Depo - Other\r', NULL, NULL, NULL),
	(621, '322409111', 'Voluntary Depo - Other\r', NULL, NULL, NULL),
	(622, '322909000', 'Compulsory Deposits\r', NULL, NULL, NULL),
	(623, '322909111', 'Compulsory Depo\r', NULL, NULL, NULL),
	(624, '322909119', 'Compulsory Depo - Other\r', NULL, NULL, NULL),
	(625, '331109000', 'Short-term loans payable\r', NULL, NULL, NULL),
	(626, '331109111', 'ST_Borrow Funds - Shareholder \r', NULL, NULL, NULL),
	(627, '331109112', '"ST_Borrow Funds - Corp, Associa , Org"\r\n331109113,ST_Borrow Funds -  Banks\r\n331109114,ST_Borrow Fun', NULL, NULL, NULL);
/*!40000 ALTER TABLE `gl_list` ENABLE KEYS */;


# Dumping structure for table loan_khmer.group
DROP TABLE IF EXISTS `group`;
CREATE TABLE IF NOT EXISTS `group` (
  `gro_id` int(11) NOT NULL AUTO_INCREMENT,
  `gro_title` varchar(45) DEFAULT NULL,
  `status` bit(1) DEFAULT NULL,
  PRIMARY KEY (`gro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `loa_acc_amount` decimal(12,0) DEFAULT NULL,
  `loa_acc_loa_rep_fre_id` int(11) DEFAULT NULL,
  `loa_acc_status` tinyint(4) DEFAULT '1',
  `loa_acc_created_date` date DEFAULT NULL,
  `loa_acc_modified_date` date DEFAULT NULL,
  `loa_use_id` int(11) DEFAULT NULL,
  `loa_acc_first_repayment` decimal(12,0) DEFAULT NULL,
  `loa_acc_disbustment` date DEFAULT NULL,
  PRIMARY KEY (`loa_acc_id`),
  KEY `loa_product_type` (`loa_acc_loa_pro_type_id`),
  KEY `loa_contact` (`loa_acc_con_id`),
  KEY `loa_user_id` (`loa_use_id`),
  CONSTRAINT `loa_contact` FOREIGN KEY (`loa_acc_con_id`) REFERENCES `contacts` (`con_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `loa_product_type` FOREIGN KEY (`loa_acc_loa_pro_type_id`) REFERENCES `loan_product_type` (`loa_pro_typ_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `loa_user_id` FOREIGN KEY (`loa_use_id`) REFERENCES `users` (`use_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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


# Dumping structure for table loan_khmer.provinces
DROP TABLE IF EXISTS `provinces`;
CREATE TABLE IF NOT EXISTS `provinces` (
  `pro_id` int(11) DEFAULT NULL,
  `pro_en_name` varchar(50) NOT NULL,
  `pro_kh_name` varchar(50) DEFAULT NULL,
  `status` binary(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.provinces: ~0 rows (approximately)
/*!40000 ALTER TABLE `provinces` DISABLE KEYS */;
/*!40000 ALTER TABLE `provinces` ENABLE KEYS */;


# Dumping structure for table loan_khmer.saving_account
DROP TABLE IF EXISTS `saving_account`;
CREATE TABLE IF NOT EXISTS `saving_account` (
  `sav_acc_id` int(11) NOT NULL AUTO_INCREMENT,
  `sav_acc_code` varchar(45) DEFAULT NULL,
  `sav_acc_sav_pro_typ_id` int(11) DEFAULT NULL,
  `sav_acc_create_date` date DEFAULT NULL,
  `sav_acc_modified_date` date DEFAULT NULL,
  `sav_acc_reference` varchar(45) DEFAULT NULL,
  `sav_acc_status` tinyint(4) DEFAULT '1',
  `sav_acc_con_id` int(11) DEFAULT NULL,
  `sav_use_id` int(11) DEFAULT NULL,
  `sav_acc_gl_id` int(11) NOT NULL,
  `sav_acc_cur_id` int(11) NOT NULL,
  PRIMARY KEY (`sav_acc_id`),
  KEY `sav_product type` (`sav_acc_sav_pro_typ_id`),
  KEY `sav_contact` (`sav_acc_con_id`),
  KEY `sav_user_id` (`sav_use_id`),
  CONSTRAINT `sav_contact` FOREIGN KEY (`sav_acc_con_id`) REFERENCES `contacts` (`con_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `sav_product type` FOREIGN KEY (`sav_acc_sav_pro_typ_id`) REFERENCES `saving_product_type` (`sav_pro_typ_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `sav_user_id` FOREIGN KEY (`sav_use_id`) REFERENCES `users` (`use_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.saving_account: ~1 rows (approximately)
/*!40000 ALTER TABLE `saving_account` DISABLE KEYS */;
INSERT INTO `saving_account` (`sav_acc_id`, `sav_acc_code`, `sav_acc_sav_pro_typ_id`, `sav_acc_create_date`, `sav_acc_modified_date`, `sav_acc_reference`, `sav_acc_status`, `sav_acc_con_id`, `sav_use_id`, `sav_acc_gl_id`, `sav_acc_cur_id`) VALUES
	(1, '168-168-000001-1-1-201', 1, NULL, NULL, 'ddsadfadsf', 1, 1, 1, 0, 0);
/*!40000 ALTER TABLE `saving_account` ENABLE KEYS */;


# Dumping structure for table loan_khmer.saving_product_type
DROP TABLE IF EXISTS `saving_product_type`;
CREATE TABLE IF NOT EXISTS `saving_product_type` (
  `sav_pro_typ_id` int(11) NOT NULL AUTO_INCREMENT,
  `sav_pro_typ_title` varchar(45) DEFAULT NULL,
  `status` bit(1) DEFAULT NULL,
  PRIMARY KEY (`sav_pro_typ_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.saving_product_type: ~1 rows (approximately)
/*!40000 ALTER TABLE `saving_product_type` DISABLE KEYS */;
INSERT INTO `saving_product_type` (`sav_pro_typ_id`, `sav_pro_typ_title`, `status`) VALUES
	(1, 'type1', '');
/*!40000 ALTER TABLE `saving_product_type` ENABLE KEYS */;


# Dumping structure for table loan_khmer.teller_balance
DROP TABLE IF EXISTS `teller_balance`;
CREATE TABLE IF NOT EXISTS `teller_balance` (
  `tel_bal_tel_id` int(10) NOT NULL AUTO_INCREMENT,
  `tel_bal_modifide_date` timestamp NULL DEFAULT NULL,
  `tel_bal_create_date` double DEFAULT NULL,
  `tel_bal_debit` double DEFAULT NULL,
  `tel_bal_credit` double DEFAULT NULL,
  `tel_balance` double DEFAULT NULL,
  PRIMARY KEY (`tel_bal_tel_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.teller_balance: 1 rows
/*!40000 ALTER TABLE `teller_balance` DISABLE KEYS */;
INSERT INTO `teller_balance` (`tel_bal_tel_id`, `tel_bal_modifide_date`, `tel_bal_create_date`, `tel_bal_debit`, `tel_bal_credit`, `tel_balance`) VALUES
	(1, NULL, NULL, NULL, 0, NULL);
/*!40000 ALTER TABLE `teller_balance` ENABLE KEYS */;


# Dumping structure for table loan_khmer.transaction
DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `tra_id` int(11) NOT NULL AUTO_INCREMENT,
  `tra_tra_mod_id` int(11) NOT NULL,
  `tra_cur_id` int(11) DEFAULT NULL,
  `tra_type` int(11) DEFAULT NULL,
  `tra_amount` decimal(10,0) DEFAULT NULL,
  `tra_description` varchar(200) DEFAULT NULL,
  `tra_gl_id` int(11) DEFAULT NULL,
  `trn_ref_no` int(11) DEFAULT NULL,
  `tra_con_id` int(11) DEFAULT NULL,
  `tra_ref_no` int(11) DEFAULT NULL,
  `tra_credit` float(10,2) DEFAULT NULL,
  `tra_debit` float(10,2) DEFAULT NULL,
  `tra_date` date DEFAULT NULL,
  `tra_value_date` date DEFAULT NULL,
  `tra_use_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`tra_id`),
  KEY `tra_contact_id` (`tra_con_id`),
  KEY `tra_tra_mod_id` (`tra_tra_mod_id`),
  KEY `tra_currency_id` (`tra_cur_id`),
  CONSTRAINT `tra_contact_id` FOREIGN KEY (`tra_con_id`) REFERENCES `contacts` (`con_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tra_tra_mod_id` FOREIGN KEY (`tra_tra_mod_id`) REFERENCES `transaction_mode` (`tra_mod_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.transaction: ~9 rows (approximately)
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
INSERT INTO `transaction` (`tra_id`, `tra_tra_mod_id`, `tra_cur_id`, `tra_type`, `tra_amount`, `tra_description`, `tra_gl_id`, `trn_ref_no`, `tra_con_id`, `tra_ref_no`, `tra_credit`, `tra_debit`, `tra_date`, `tra_value_date`, `tra_use_id`) VALUES
	(15, 1, 1, 1, 200, '', 5, NULL, 2, NULL, 0.00, 200.00, '2013-05-26', '2013-05-26', 1),
	(16, 1, 1, 2, 401, '', 5, NULL, 2, NULL, 400.50, 0.00, '2013-05-26', '2013-05-26', 1),
	(17, 1, 1, 2, 40044, '', 5, NULL, 2, NULL, 40044.00, 0.00, '2013-05-26', '2013-05-26', 1),
	(21, 1, 1, 2, 2000, '', 2, NULL, 1, NULL, 2000.00, 0.00, '2013-05-28', '2013-05-28', 1),
	(22, 1, 1, 2, 2000, '', 2, NULL, 1, NULL, 2000.00, 0.00, '2013-05-28', '2013-05-28', 1),
	(23, 1, 1, 2, 55, '', 3, NULL, 1, NULL, 55.00, 0.00, '2013-05-28', '2013-05-28', 1),
	(24, 1, 1, 2, 400, '', 4, NULL, 1, NULL, 400.00, 0.00, '2013-05-28', '2013-05-28', 1),
	(25, 1, 2, 2, 4000, '', 4, NULL, 2, NULL, 4000.00, 0.00, '2013-06-08', '2013-06-08', 1),
	(26, 1, 1, 2, 566, 'uhuhuhuhu', 4, NULL, 2, NULL, 566.00, 0.00, '2013-06-08', '2013-06-08', 1);
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;


# Dumping structure for table loan_khmer.transaction_mode
DROP TABLE IF EXISTS `transaction_mode`;
CREATE TABLE IF NOT EXISTS `transaction_mode` (
  `tra_mod_id` int(11) NOT NULL AUTO_INCREMENT,
  `tra_mod_title` varchar(45) DEFAULT NULL,
  `tra_mod_status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`tra_mod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.transaction_mode: ~3 rows (approximately)
/*!40000 ALTER TABLE `transaction_mode` DISABLE KEYS */;
INSERT INTO `transaction_mode` (`tra_mod_id`, `tra_mod_title`, `tra_mod_status`) VALUES
	(1, 'Cash', 1),
	(2, 'Voucher', 1),
	(3, 'Other...', 1);
/*!40000 ALTER TABLE `transaction_mode` ENABLE KEYS */;


# Dumping structure for table loan_khmer.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `use_id` int(11) NOT NULL AUTO_INCREMENT,
  `use_name` varchar(45) DEFAULT NULL,
  `use_gro_id` int(11) DEFAULT NULL,
  `status` bit(1) DEFAULT b'1',
  `use_password` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`use_id`),
  UNIQUE KEY `use_name_UNIQUE` (`use_name`),
  KEY `use_group` (`use_gro_id`),
  CONSTRAINT `use_group` FOREIGN KEY (`use_gro_id`) REFERENCES `user_groups` (`gro_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.users: ~4 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`use_id`, `use_name`, `use_gro_id`, `status`, `use_password`) VALUES
	(1, 'admin', 1, '', '21232f297a57a5a743894a0e4a801fc3'),
	(2, 'account', 3, '', 'e268443e43d93dab7ebef303bbe9642f'),
	(3, 'vannak', 2, '', 'd96783d6bc86fb4d4a1b6cdacbfa9dc5'),
	(4, 'eddddd', 1, '', '25f9e794323b453885f5181f1b624d0b');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


# Dumping structure for table loan_khmer.user_groups
DROP TABLE IF EXISTS `user_groups`;
CREATE TABLE IF NOT EXISTS `user_groups` (
  `gro_id` int(11) NOT NULL AUTO_INCREMENT,
  `gro_name` varchar(45) DEFAULT NULL,
  `status` bit(1) DEFAULT NULL,
  PRIMARY KEY (`gro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.user_groups: ~3 rows (approximately)
/*!40000 ALTER TABLE `user_groups` DISABLE KEYS */;
INSERT INTO `user_groups` (`gro_id`, `gro_name`, `status`) VALUES
	(1, 'admin', ''),
	(2, 'Acount', ''),
	(3, 'Teller', '');
/*!40000 ALTER TABLE `user_groups` ENABLE KEYS */;


# Dumping structure for table loan_khmer.villages
DROP TABLE IF EXISTS `villages`;
CREATE TABLE IF NOT EXISTS `villages` (
  `vil_id` int(11) NOT NULL AUTO_INCREMENT,
  `vil_com_id` int(10) unsigned DEFAULT NULL,
  `vil_en_name` varchar(80) NOT NULL,
  `vil_kh_name` varchar(80) DEFAULT NULL,
  `status` binary(1) DEFAULT '1',
  PRIMARY KEY (`vil_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.villages: ~0 rows (approximately)
/*!40000 ALTER TABLE `villages` DISABLE KEYS */;
/*!40000 ALTER TABLE `villages` ENABLE KEYS */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
