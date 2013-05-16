# --------------------------------------------------------
# Host:                         127.0.0.1
# Server version:               5.1.53-community-log
# Server OS:                    Win64
# HeidiSQL version:             6.0.0.3603
# Date/time:                    2013-05-08 13:46:03
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.branch: 0 rows
/*!40000 ALTER TABLE `branch` DISABLE KEYS */;
/*!40000 ALTER TABLE `branch` ENABLE KEYS */;


# Dumping structure for table loan_khmer.contacts
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `con_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_cid` varchar(45) DEFAULT NULL,
  `con_con_typ_id` int(11) DEFAULT NULL,
  `con_en_name` varchar(45) DEFAULT NULL,
  `con_kh_name` varchar(45) DEFAULT NULL,
  `con_national_identified_card` varchar(20) DEFAULT NULL,
  `con_status` tinyint(1) DEFAULT '1',
  `con_use_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`con_id`),
  KEY `contact type` (`con_con_typ_id`),
  KEY `user_id` (`con_use_id`),
  CONSTRAINT `contact type` FOREIGN KEY (`con_con_typ_id`) REFERENCES `contact_type` (`con_typ_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user_id` FOREIGN KEY (`con_use_id`) REFERENCES `users` (`use_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.contacts: ~2 rows (approximately)
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` (`con_id`, `con_cid`, `con_con_typ_id`, `con_en_name`, `con_kh_name`, `con_national_identified_card`, `con_status`, `con_use_id`) VALUES
	(1, '168-000001-1-1', 1, 'Chantha', NULL, NULL, 1, 1),
	(2, '168-000002-1-2', 1, 'Vanda', NULL, NULL, 1, 1);
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


# Dumping structure for table loan_khmer.contact_type
DROP TABLE IF EXISTS `contact_type`;
CREATE TABLE IF NOT EXISTS `contact_type` (
  `con_typ_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_typ_title` varchar(20) DEFAULT NULL,
  `con_typ_status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`con_typ_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.contact_type: ~3 rows (approximately)
/*!40000 ALTER TABLE `contact_type` DISABLE KEYS */;
INSERT INTO `contact_type` (`con_typ_id`, `con_typ_title`, `con_typ_status`) VALUES
	(1, 'Individual Loan', 1),
	(2, 'Individual Saving', 1),
	(3, 'Group Loan', 1);
/*!40000 ALTER TABLE `contact_type` ENABLE KEYS */;


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


# Dumping structure for table loan_khmer.gl_list
DROP TABLE IF EXISTS `gl_list`;
CREATE TABLE IF NOT EXISTS `gl_list` (
  `gl_id` int(11) NOT NULL AUTO_INCREMENT,
  `gl_code` varchar(12) DEFAULT NULL,
  `gl_description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`gl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1024 DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.gl_list: ~703 rows (approximately)
/*!40000 ALTER TABLE `gl_list` DISABLE KEYS */;
INSERT INTO `gl_list` (`gl_id`, `gl_code`, `gl_description`) VALUES
	(1, '100009000', 'Total Assets Control Account\r'),
	(2, '111109000', 'Cash in Vault and on Hand \r'),
	(3, '111109111', 'Cash in Vault \r'),
	(4, '111109112', 'Cash in Vault & Hand_PettyCash\r'),
	(5, '111109113', 'Cash in Till \r'),
	(6, '111109114', 'Cash in Vault & Hand_NOT USE\r'),
	(7, '111109121', 'Cash in Vault & Hand_SubBranch\r'),
	(8, '111109131', 'Cash in Vault & Hand_ServicePost\r'),
	(9, '111209000', 'Cash in Transit \r'),
	(10, '111209111', 'Cash Transit _HO & Branch\r'),
	(11, '111209112', 'Cash Transit _Branch & Branch\r'),
	(12, '111209113', 'Cash Transit _Branch & SubBranch\r'),
	(13, '111209119', 'Cash Transit _Other\r'),
	(14, '111309000', 'Cheques in Transit\r'),
	(15, '111309111', 'Cheques Transit_HO & Branch\r'),
	(16, '111309112', 'Cheques Transit_HO & Suppliers\r'),
	(17, '111309119', 'Cheques Transit_Other\r'),
	(18, '114109000', 'Due from NBC\r'),
	(19, '114109111', 'Due from NBC\r'),
	(20, '114209000', 'Capital Guar Depo_NBC\r'),
	(21, '114209111', 'Capital Guar Depo_NBC\r'),
	(22, '114309000', 'Reserve Req_NBC\r'),
	(23, '114309111', 'Reserve Req_NBC\r'),
	(24, '114409000', 'Other Demand Depo_ NBC\r'),
	(25, '114409111', 'Other Demand Depo_ NBC\r'),
	(26, '114609000', 'Other Term Depo_ NBC\r'),
	(27, '114609111', 'Other Term Depo_ NBC\r'),
	(28, '115109000', 'CA (Nostro)_BK rated AAA to AA-\r'),
	(29, '115109111', 'CA (Nostro)_BK rated AAA to AA-\r'),
	(30, '115209000', 'CA (Nostro)_BK rated A+ to A-\r'),
	(31, '115209111', 'CA (Nostro)_BK rated A+ to A-\r'),
	(32, '115309000', 'CA (Nostro)_BK rated below A-\r'),
	(33, '115309100', 'CA (Nostro)_BK rated below A-_ACLEDA\r'),
	(34, '115309101', 'CA (Nostro)_BK rated below A-_ACLEDA_Branch\r'),
	(35, '115309102', 'CA (Nostro)_BK rated below A-_ACLEDA_SubBranch\r'),
	(36, '115309103', 'CA (Nostro)_BK rated below A-_ACLEDA_ServicePost\r'),
	(37, '115309111', 'CA (Nostro)_BK rated below A-_CAMPU\r'),
	(38, '115309112', 'CA (Nostro)_BK rated below A-_CANADIA\r'),
	(39, '115309113', 'CA (Nostro)_BK rated below A-_RDB\r'),
	(40, '115309114', 'CA (Nostro)_BK rated below A-_ANZ\r'),
	(41, '115309119', 'CA (Nostro)_BK rated below A-_Other\r'),
	(42, '116109000', 'DD &SAV  BK rated AAA to AA-\r'),
	(43, '116109111', 'DD &SAV  BK rated AAA to AA-\r'),
	(44, '116209000', 'DD &SAV  BK rated A+ to A-\r'),
	(45, '116209111', 'DD &SAV  BK rated A+ to A-\r'),
	(46, '116309000', 'DD &SAV  BK rated below A-\r'),
	(47, '116309100', 'DD &SAV  BK rated below A-_ACLEDA\r'),
	(48, '116309101', 'DD &SAV  BK rated below A-_ACLEDA_Branch\r'),
	(49, '116309102', 'DD &SAV  BK rated below A-_ACLEDA_SubBranch\r'),
	(50, '116309103', 'DD &SAV  BK rated below A-_ACLEDA_ServicePost\r'),
	(51, '116309111', 'DD &SAV  BK rated below A-_CAMPU\r'),
	(52, '116309112', 'DD &SAV  BK rated below A-_CANADIA\r'),
	(53, '116309113', 'DD &SAV  BK rated below A-_RDB\r'),
	(54, '121109000', 'TD & Palcements BK rated AAA to AA-\r'),
	(55, '121109111', 'TD & Palcements BK rated AAA to AA-\r'),
	(56, '121209000', 'TD & Palcements BK rated A+ to A-\r'),
	(57, '121209111', 'TD & Palcements BK rated A+ to A-\r'),
	(58, '121309000', 'TD & Palcements BK rated below A-\r'),
	(59, '121309111', 'TD & Palcements BK rated below A-\r'),
	(60, '122109000', 'CL Sovereigns rated AAA to AA-\r'),
	(61, '122109111', 'CL Sovereigns rated AAA to AA-\r'),
	(62, '122209000', 'CL Sovereigns rated A+ to A-\r'),
	(63, '122209111', 'CL Sovereigns rated A+ to A-\r'),
	(64, '122309000', 'CL Sovereigns rated BBB+ to BBB-\r'),
	(65, '122309111', 'CL Sovereigns rated BBB+ to BBB-\r'),
	(66, '122409000', 'CL Sovereigns rated below BBB-\r'),
	(67, '122409111', 'CL Sovereigns rated below BBB-\r'),
	(68, '131109000', 'STDL - Groups <=1 year\r'),
	(69, '131109111', 'STDL - Groups <=1 year\r'),
	(70, '131109112', 'STDL - Groups <=1 year_PD<30\r'),
	(71, '131209000', 'STDL - Individuals<=1 year\r'),
	(72, '131209111', 'STDL - Individuals<=1 year\r'),
	(73, '131209112', 'STDL - Individuals<=1 year_PD<30\r'),
	(74, '131209113', 'STDL - Individuals_OD <=1 year\r'),
	(75, '131309000', 'STDL - Enterprises<=1 year\r'),
	(76, '131309111', 'STDL - Enterprises<=1 year\r'),
	(77, '131309112', 'STDL - Enterprises<=1 year_PD<30\r'),
	(78, '131309113', 'STDL - Enterprises_OD <=1 year\r'),
	(79, '131409000', 'STDL - Others<=1 year\r'),
	(80, '131409111', 'STDL - Others<=1 year\r'),
	(81, '131409112', 'STDL - Others<=1 year_PD<30\r'),
	(82, '131409113', 'STDL - Others_OD <=1 year\r'),
	(83, '131519000', 'STDL - Rela Pty<=1 year - Shareholder\r'),
	(84, '131519111', 'STDL - Rela Pty<=1 year - Shareholder\r'),
	(85, '131519112', 'STDL - Rela Pty<=1 year - Shareholder_PD<30\r'),
	(86, '131519113', 'STDL - Rela Pty_OD <=1 year - Shareholder\r'),
	(87, '131529000', 'STDL - Rela Pty<=1 year - Manager\r'),
	(88, '131529111', 'STDL - Rela Pty<=1 year - Manager\r'),
	(89, '131529112', 'STDL - Rela Pty<=1 year - Manager_PD<30\r'),
	(90, '131529113', 'STDL - Rela Pty_OD <=1 year - Manager\r'),
	(91, '131539000', 'STDL - Rela Pty<=1 year - Employee\r'),
	(92, '131539111', 'STDL - Rela Pty<=1 year - Employee\r'),
	(93, '131539112', 'STDL - Rela Pty<=1 year - Employee_PD<30\r'),
	(94, '131539113', 'STDL - Rela Pty_OD <=1 year - Employee\r'),
	(95, '131549000', 'STDL - Rela Pty<=1 year - Ex Audit\r'),
	(96, '131549111', 'STDL - Rela Pty<=1 year - Ex Audit\r'),
	(97, '131549112', 'STDL - Rela Pty<=1 year - Ex Audit_PD<30\r'),
	(98, '131549113', 'STDL - Rela Pty_OD <=1 year - Ex Audit\r'),
	(99, '132109000', 'STDL - Groups>1 year\r'),
	(100, '132109111', 'STDL - Groups>1 year\r'),
	(101, '132109112', 'STDL - Groups>1 year_PD<30\r'),
	(102, '132209000', 'STDL - Individuals>1 year\r'),
	(103, '132209111', 'STDL - Individuals>1 year\r'),
	(104, '132209112', 'STDL - Individuals>1 year_PD<30\r'),
	(105, '132309000', 'STDL - Enterprises>1 year\r'),
	(106, '132309111', 'STDL - Enterprises>1 year\r'),
	(107, '132309112', 'STDL - Enterprises>1 year_PD<30\r'),
	(108, '132409000', 'STDL - Others> 1 year\r'),
	(109, '132409111', 'STDL - Others> 1 year\r'),
	(110, '132409112', 'STDL - Others> 1 year_PD<30\r'),
	(111, '132519000', 'STDL - Rela Pty>1 year - Shareholder\r'),
	(112, '132519111', 'STDL - Rela Pty>1 year - Shareholder\r'),
	(113, '132519112', 'STDL - Rela Pty>1 year - Shareholder_PD<30\r'),
	(114, '132529000', 'STDL - Rela Pty>1 year - Manager\r'),
	(115, '132529111', 'STDL - Rela Pty>1 year - Manager\r'),
	(116, '132529112', 'STDL - Rela Pty>1 year - Manager_PD<30\r'),
	(117, '132539000', 'STDL - Rela Pty>1 year - Employee\r'),
	(118, '132539111', 'STDL - Rela Pty>1 year - Employee\r'),
	(119, '132539112', 'STDL - Rela Pty>1 year - Employee_PD<30\r'),
	(120, '132549000', 'STDL - Rela Pty>1 year - Ex Audit\r'),
	(121, '132549111', 'STDL - Rela Pty>1 year - Ex Audit\r'),
	(122, '132549112', 'STDL - Rela Pty>1 year - Ex Audit_PD<30\r'),
	(123, '141109000', 'Sub STDL - Groups<=1 year\r'),
	(124, '141109111', 'Sub STDL - Groups<=1 year\r'),
	(125, '141209000', 'Sub STDL - Individuals<=1 year\r'),
	(126, '141209111', 'Sub STDL - Individuals<=1 year\r'),
	(127, '141209112', 'Sub STDL - Individuals_OD <=1 year\r'),
	(128, '141309000', 'Sub STDL - Enterprises<=1 year\r'),
	(129, '141309111', 'Sub STDL - Enterprises<=1 year\r'),
	(130, '141309112', 'Sub STDL - Enterprises_OD <=1 year\r'),
	(131, '141409000', 'Sub STDL - Others<=1 year\r'),
	(132, '141409111', 'Sub STDL - Others<=1 year\r'),
	(133, '141409112', 'Sub STDL - Others_OD <=1 year\r'),
	(134, '141519000', 'Sub STDL - Rela Pty<=1 year - Shareholder\r'),
	(135, '141519111', 'Sub STDL - Rela Pty<=1 year - Shareholder\r'),
	(136, '141519112', 'Sub STDL - Rela Pty_OD <=1 year - Shareholder\r'),
	(137, '141529000', 'Sub STDL - Rela Pty<=1 year - Manager\r'),
	(138, '141529111', 'Sub STDL - Rela Pty<=1 year - Manager\r'),
	(139, '141529112', 'Sub STDL - Rela Pty_OD <=1 year - Manager\r'),
	(140, '141539000', 'Sub STDL - Rela Pty<=1 year - Employee\r'),
	(141, '141539111', 'Sub STDL - Rela Pty<=1 year - Employee\r'),
	(142, '141539112', 'Sub STDL - Rela Pty_OD <=1 year - Employee\r'),
	(143, '141549000', 'Sub STDL - Rela Pty<=1 year - Ex Aud\r'),
	(144, '141549111', 'Sub STDL - Rela Pty<=1 year - Ex Audit\r'),
	(145, '141549112', 'Sub STDL - Rela Pty_OD <=1 year - Ex Audit\r'),
	(146, '142109000', 'Sub STDL - Groups>1 year\r'),
	(147, '142109111', 'Sub STDL - Groups>1 year\r'),
	(148, '142209000', 'Sub STDL - Individuals>1 year\r'),
	(149, '142209111', 'Sub STDL - Individuals>1 year\r'),
	(150, '142309000', 'Sub STDL - Enterprises>1 year\r'),
	(151, '142309111', 'Sub STDL - Enterprises>1 year\r'),
	(152, '142409000', 'Sub STDL - Others>1 year\r'),
	(153, '142409111', 'Sub STDL - Others>1 year\r'),
	(154, '142519000', 'Sub STDL - Rela Pty>1 year - Shareholder\r'),
	(155, '142519111', 'Sub STDL - Rela Pty>1 year - Shareholder\r'),
	(156, '142529000', 'Sub STDL - Rela Pty>1 year - Manager\r'),
	(157, '142529111', 'Sub STDL - Rela Pty>1 year - Manager\r'),
	(158, '142539000', 'Sub STDL - Rela Pty>1 year - Employee\r'),
	(159, '142539111', 'Sub STDL - Rela Pty>1 year - Employee\r'),
	(160, '142549000', 'Sub STDL - Rela Pty>1 year - Ex Audit\r'),
	(161, '142549111', 'Sub STDL - Rela Pty>1 year - Ex Audit\r'),
	(162, '151109000', 'DFL - Groups<=1 year\r'),
	(163, '151109111', 'DFL - Groups<=1 year\r'),
	(164, '151209000', 'DFL - Individuals<=1 year\r'),
	(165, '151209111', 'DFL - Individuals<=1 year\r'),
	(166, '151209112', 'DFL - Individuals_OD <=1 year\r'),
	(167, '151309000', 'DFL - Enterprises<=1 year\r'),
	(168, '151309111', 'DFL - Enterprises<=1 year\r'),
	(169, '151309112', 'DFL - Enterprises_OD <=1 year\r'),
	(170, '151409000', 'DFL - Others<=1 year\r'),
	(171, '151409111', 'DFL - Others<=1 year\r'),
	(172, '151409112', 'DFL - Others_OD <=1 year\r'),
	(173, '151519000', 'DFL - Rela Pty<=1 year - Shareholder\r'),
	(174, '151519111', 'DFL - Rela Pty<=1 year - Shareholder\r'),
	(175, '151519112', 'DFL - Rela Pty_OD <=1 year - Shareholder\r'),
	(176, '151529000', 'DFL - Rela Pty<=1 year - Manager\r'),
	(177, '151529111', 'DFL - Rela Pty<=1 year - Manager\r'),
	(178, '151529112', 'DFL - Rela Pty_OD <=1 year - Manager\r'),
	(179, '151539000', 'DFL - Rela Pty<=1 year - Employee\r'),
	(180, '151539111', 'DFL - Rela Pty<=1 year - Employee\r'),
	(181, '151539112', 'DFL - Rela Pty_OD <=1 year - Employee\r'),
	(182, '151549000', 'DFL - Rela Pty<=1 year - Ex Audit\r'),
	(183, '151549111', 'DFL - Rela Pty<=1 year - Ex Audit\r'),
	(184, '151549112', 'DFL - Rela Pty_OD <=1 year - Ex Auditor\r'),
	(185, '152109000', 'DFL - Groups>1 year\r'),
	(186, '152109111', 'DFL - Groups>1 year\r'),
	(187, '152209000', 'DFL - Individuals>1 year\r'),
	(188, '152209111', 'DFL - Individuals>1 year\r'),
	(189, '152309000', 'DFL - Enterprises>1 year\r'),
	(190, '152309111', 'DFL - Enterprises>1 year\r'),
	(191, '152409000', 'DFL - Others>1 year\r'),
	(192, '152409111', 'DFL - Others>1 year\r'),
	(193, '152519000', 'DFL - Rela Pty>1 year - Shareholder\r'),
	(194, '152519111', 'DFL - Rela Pty>1 year - Shareholder\r'),
	(195, '152529000', 'DFL - Rela Pty>1 year - Manager\r'),
	(196, '152529111', 'DFL - Rela Pty>1 year - Manager\r'),
	(197, '152539000', 'DFL - Rela Pty>1 year - Employee\r'),
	(198, '152539111', 'DFL - Rela Pty>1 year - Employee\r'),
	(199, '152549000', 'DFL - Rela Pty>1 year - Ex Audit\r'),
	(200, '152549111', 'DFL - Rela Pty>1 year - Ex Audit\r'),
	(201, '161109000', 'LL - Groups<=1 year\r'),
	(202, '161109111', 'LL - Groups<=1 year\r'),
	(203, '161209000', 'LL - Individuals<=1 year\r'),
	(204, '161209111', 'LL - Individuals<=1 year\r'),
	(205, '161209112', 'LL - Individuals_OD <=1 year\r'),
	(206, '161309000', 'LL - Enterprises<=1 year\r'),
	(207, '161309111', 'LL - Enterprises<=1 year\r'),
	(208, '161309112', 'LL - Enterprises_OD <=1 year\r'),
	(209, '161409000', 'LL - Others<=1 year\r'),
	(210, '161409111', 'LL - Others<=1 year\r'),
	(211, '161409112', 'LL - Others_OD <=1 year\r'),
	(212, '161519000', 'LL - Rela Pty<=1 year - Shareholder\r'),
	(213, '161519111', 'LL - Rela Pty<=1 year - Shareholder\r'),
	(214, '161519112', 'LL - Rela Pty_OD <=1 year - Shareholder\r'),
	(215, '161529000', 'LL - Rela Pty<=1 year - Manager\r'),
	(216, '161529111', 'LL - Rela Pty<=1 year - Manager\r'),
	(217, '161529112', 'LL - Rela Pty_OD <=1 year - Manager\r'),
	(218, '161539000', 'LL - Rela Pty<=1 year - Employee\r'),
	(219, '161539111', 'LL - Rela Pty<=1 year - Employee\r'),
	(220, '161539112', 'LL - Rela Pty_OD <=1 year - Employee\r'),
	(221, '161549000', 'LL - Rela Pty<=1 year - Ex Audit\r'),
	(222, '161549111', 'LL - Rela Pty<=1 year - Ex Audit\r'),
	(223, '161549112', 'LL - Rela Pty_OD <=1 year - Ex Audit\r'),
	(224, '162109000', 'LL - Groups>1 year\r'),
	(225, '162109111', 'LL - Groups>1 year\r'),
	(226, '162209000', 'LL - Individuals>1 year\r'),
	(227, '162209111', 'LL - Individuals>1 year\r'),
	(228, '162309000', 'LL - Enterprises>1 year\r'),
	(229, '162309111', 'LL - Enterprises>1 year\r'),
	(230, '162409000', 'LL - Others>1 year\r'),
	(231, '162409111', 'LL - Others>1 year\r'),
	(232, '162519000', 'LL - Rela Pty>1 year - Shareholder\r'),
	(233, '162519111', 'LL - Rela Pty>1 year - Shareholder\r'),
	(234, '162529000', 'LL - Rela Pty>1 year - Manager\r'),
	(235, '162529111', 'LL - Rela Pty>1 year - Manager\r'),
	(236, '162539000', 'LL - Rela Pty>1 year - Employee\r'),
	(237, '162539111', 'LL - Rela Pty>1 year - Employee\r'),
	(238, '162549000', 'LL - Rela Pty>1 year - Ex Audit\r'),
	(239, '162549111', 'LL - Rela Pty>1 year - Ex Audit\r'),
	(240, '171109000', '(Less) Reser Spec LL\r'),
	(241, '171109111', '(Less) Reser Spec LL_Group\r'),
	(242, '171109112', '(Less) Reser Spec LL_Individual\r'),
	(243, '171109113', '(Less) Reser Spec LL_Enterprises\r'),
	(244, '171109114', '(Less) Reser Spec LL_Related Parties\r'),
	(245, '171109115', '(Less) Reser Spec LL_OD\r'),
	(246, '171109119', '(Less) Reser Spec LL_Others\r'),
	(247, '171209000', '(Less) Reser Gen LL\r'),
	(248, '171209111', '(Less) Reser Gen LL_Group\r'),
	(249, '171209112', '(Less) Reser Gen LL_Individual\r'),
	(250, '171209113', '(Less) Reser Gen LL_Enterprises\r'),
	(251, '171209114', '(Less) Reser Gen LL_Related Parties\r'),
	(252, '171209115', '(Less) Reser Gen LL_OD\r'),
	(253, '171209119', '(Less) Reser Gen LL_Others\r'),
	(254, '200009000', 'Total Assets Control Account\r'),
	(255, '211009000', 'Inv Debt Security - HTM\r'),
	(256, '211009111', 'Inv Debt Security - HTM\r'),
	(257, '211609000', 'Accum Preemium (Discount) - HTM\r'),
	(258, '211609111', 'Accum Preemium (Discount) - HTM\r'),
	(259, '212009000', 'Inv Debt Security - AFS\r'),
	(260, '212009111', 'Inv Debt Security - AFS\r'),
	(261, '212609000', 'Accum Premium (Discount) - AFS\r'),
	(262, '212609111', 'Accum Premium (Discount) - AFS\r'),
	(263, '213809000', 'Other Inv Security\r'),
	(264, '213809111', 'Other Inv Security\r'),
	(265, '214909000', 'Investment in Equity Capital\r'),
	(266, '214909111', 'Investment in Equity Capital\r'),
	(267, '215609000', 'Net Unrealized Holding Gains (Loss) \r'),
	(268, '215609111', 'Net Unrealized Holding Gains (Loss) - AFS\r'),
	(269, '221109000', 'Prepaid Insurance\r'),
	(270, '221109111', 'Prepaid Insurance\r'),
	(271, '221209000', 'Prepaid Deposit Insurance Assessment\r'),
	(272, '221209111', 'Prepaid Deposit Insurance Assessment\r'),
	(273, '221309000', 'Prepaid Service/Maintenance Contract\r'),
	(274, '221309111', 'Prepaid Service / Maintenance Contracts\r'),
	(275, '221409000', 'Prepaid Professional Fees\r'),
	(276, '221409111', 'Prepaid Professional Fees\r'),
	(277, '221509000', 'Prepaid Rent\r'),
	(278, '221509111', 'Prepaid Rent\r'),
	(279, '221609000', 'Prepaid Profit Tax\r'),
	(280, '221609111', 'Prepaid Profit Tax\r'),
	(281, '222309000', 'Advance Payment or Deposits\r'),
	(282, '222309111', 'Advance Payment or Deposits_Travel & Mission\r'),
	(283, '222309112', 'Advance Payment or Deposits_Purchases\r'),
	(284, '222309113', 'Advance Payment or Deposits_Rental\r'),
	(285, '222309119', 'Advance Payment or Deposits_Others\r'),
	(286, '222409000', 'Purchased Interest Receivable\r'),
	(287, '222409111', 'Purchased Interest Receivable\r'),
	(288, '222509000', 'Stationary Supply & Inventory\r'),
	(289, '222509111', 'Stationary Supply & Inventory\r'),
	(290, '231109000', 'AIR - Due from NBC\r'),
	(291, '231109111', 'AIR - Due from NBC\r'),
	(292, '231209000', 'AIR - Capital Guar Depo  with NBC\r'),
	(293, '231209111', 'AIR - Capital Guar Depo  with NBC\r'),
	(294, '231309000', 'AIR - Other Demand Depo with NBC\r'),
	(295, '231309112', 'AIR - Other Demand Depo with NBC\r'),
	(296, '231609000', 'AIR - Other Term Depo with NBC\r'),
	(297, '231609113', 'AIR - Other Term Depo with NBC\r'),
	(298, '232109000', 'AIR-DD&SAV Depo BK rated AAA to AA-\r'),
	(299, '232109111', 'AIR - DD & SAV Depo  BK rated AAA to AA-\r'),
	(300, '232209000', 'AIR-DD & SAV Depo  BK rated A+ to A-\r'),
	(301, '232209111', 'AIR - DD & SAV Depo  BK rated A+ to A-\r'),
	(302, '232309000', 'AIR-DD & SAV Depo  BK rated below A-\r'),
	(303, '232309111', 'AIR - DD & SAV Depo  BK rated below A-\r'),
	(304, '233109000', 'AIR-TD & Placement BK rated AAA to AA-\r'),
	(305, '233109111', 'AIR - TD & Placement BK rated AAA to AA-\r'),
	(306, '233209000', 'AIR-TD & Placement BK rated A+ to A-\r'),
	(307, '233209111', 'AIR - TD & Placement BK rated A+ to A-\r'),
	(308, '233309000', 'AIR-TD & Placement BK rated below A-\r'),
	(309, '233309111', 'AIR - TD & Placement BK rated A+ to A-\r'),
	(310, '234109000', 'AIR - Claims  Sovereigns rated AAA to AA-\r'),
	(311, '234109111', 'AIR - Claims  Sovereigns rated AAA to AA-\r'),
	(312, '234209000', 'AIR - Claims Sovereigns rated A+ to A-\r'),
	(313, '234209111', 'AIR - Claims  Sovereigns rated A+ to A-\r'),
	(314, '234309000', 'AIR - Claims  Sovereigns rated BBB+ to BBB-\r'),
	(315, '234309111', 'AIR - Claims  Sovereigns rated BBB+ to BBB-\r'),
	(316, '234409000', 'AIR - Claims Sovereigns rated below BBB-\r'),
	(317, '234409111', 'AIR - Claims  Sovereigns rated below BBB-\r'),
	(318, '241009000', 'AIR-Investment Debt Securities - HTM\r'),
	(319, '241009111', 'AIR - Investment Debt Securities - HTM \r'),
	(320, '242009000', 'AIR-Investment Debt Securities-AFS\r'),
	(321, '242009111', 'AIR - Investment Debt Securities - AFS\r'),
	(322, '243009000', 'AIR - Other Investment\r'),
	(323, '243009111', 'AIR - Other Investment \r'),
	(324, '251109000', 'AIR - STDL - Groups <=1 year\r'),
	(325, '251109111', 'AIR - STDL - Groups <=1 year\r'),
	(326, '251209000', 'AIR - STDL - Individuals<=1 year\r'),
	(327, '251209111', 'AIR - STDL - Individuals<=1 year\r'),
	(328, '251209112', 'AIR - STDL - Individuals_OD <=1 year\r'),
	(329, '251309000', 'AIR - STDL - Enterprises<=1 year\r'),
	(330, '251309111', 'AIR - STDL - Enterprises<=1 year\r'),
	(331, '251309112', 'AIR - STDL - Enterprises_OD <=1 year\r'),
	(332, '251409000', 'AIR - STDL - Others<=1 year\r'),
	(333, '251409111', 'AIR - STDL - Others<=1 year\r'),
	(334, '251409112', 'AIR - STDL - Others_OD <=1 year\r'),
	(335, '251519000', 'AIR - STDL - Rela Pty<=1 year-Shareholder\r'),
	(336, '251519111', 'AIR - STDL - Rela Pty<=1 year - SHolder\r'),
	(337, '251519112', 'AIR - STDL - Rela Pty_OD <=1 year - Shareholder\r'),
	(338, '251529000', 'AIR - STDL - Rela Pty<=1 year-Manager\r'),
	(339, '251529111', 'AIR - STDL - Rela Pty<=1 year - Manager\r'),
	(340, '251529112', 'AIR - STDL - Rela Pty_OD <=1 year - Manager\r'),
	(341, '251539000', 'AIR - STDL - Rela Pty<=1 year-Employee\r'),
	(342, '251539111', 'AIR - STDL - Rela Pty<=1 year - Employee\r'),
	(343, '251539112', 'AIR - STDL - Rela Pty_OD <=1 year - Employee\r'),
	(344, '251549000', 'AIR - STDL - Rela Pty<=1 year-Ex Audit\r'),
	(345, '251549111', 'AIR - STDL - Rela Pty<=1 year - Ex Audit\r'),
	(346, '251549112', 'AIR - STDL - Rela Pty_OD <=1 year - Ex Auditor\r'),
	(347, '252109000', 'AIR - STDL - Groups>1 year\r'),
	(348, '252109111', 'AIR - STDL - Groups>1 year\r'),
	(349, '252209000', 'AIR - STDL - Individuals>1 year\r'),
	(350, '252209111', 'AIR - STDL - Individuals>1 year\r'),
	(351, '252309000', 'AIR - STDL - Enterprises>1 year\r'),
	(352, '252309111', 'AIR - STDL - Enterprises>1 year\r'),
	(353, '252409000', 'AIR - STDL - Others> 1 year\r'),
	(354, '252409111', 'AIR - STDL - Others> 1 year\r'),
	(355, '252519000', 'AIR - STDL - Rela Pty>1 year-Shareholder\r'),
	(356, '252519111', 'AIR - STDL - Rela Pty>1 year - Shareholder\r'),
	(357, '252529000', 'AIR - STDL - Rela Pty>1 year-Manager\r'),
	(358, '252529111', 'AIR - STDL - Rela Pty>1 year - Manager\r'),
	(359, '252539000', 'AIR - STDL - Rela Pty>1 year-Employee\r'),
	(360, '252539111', 'AIR - STDL - Rela Pty>1 year - Employee\r'),
	(361, '252549000', 'AIR - STDL - Rela Pty>1 year - Ex Audit\r'),
	(362, '252549111', 'AIR - STDL - Rela Pty>1 year - Ex Audit\r'),
	(363, '261109000', 'AIR - Sub STDL - Groups<=1 year\r'),
	(364, '261109111', 'AIR - Sub STDL - Groups<=1 year\r'),
	(365, '261209000', 'AIR - Sub STDL - Individuals<=1 year\r'),
	(366, '261209111', 'AIR - Sub STDL - Individuals<=1 year\r'),
	(367, '261209112', 'AIR - Sub STDL - Individuals_OD <=1 year\r'),
	(368, '261309000', 'AIR - Sub STDL - Enterprises<=1 year\r'),
	(369, '261309111', 'AIR - Sub STDL - Enterprises<=1 year\r'),
	(370, '261309112', 'AIR - Sub STDL - Enterprises_OD <=1 year\r'),
	(371, '261409000', 'AIR - Sub STDL - Others<=1 year\r'),
	(372, '261409111', 'AIR - Sub STDL - Others<=1 year\r'),
	(373, '261409112', 'AIR - Sub STDL - Others_OD <=1 year\r'),
	(374, '261519000', 'AIR - Sub STDL - Rela Pty<=1year-Shareholder\r'),
	(375, '261519111', 'AIR - Sub STDL - Rela Pty<=1 year - SHolder\r'),
	(376, '261519112', 'AIR - Sub STDL - Rela Pty_OD <=1 year - Shareholder\r'),
	(377, '261529000', 'AIR - Sub STDL - Rela Pty<=1 year - Manager\r'),
	(378, '261529111', 'AIR - Sub STDL - Rela Pty<=1 year - Manager\r'),
	(379, '261529112', 'AIR - Sub STDL - Rela Pty_OD <=1 year - Manager\r'),
	(380, '261539000', 'AIR - Sub STDL - Rela Pty<=1 year - Employee\r'),
	(381, '261539111', 'AIR - Sub STDL - Rela Pty<=1 year - Employee\r'),
	(382, '261539112', 'AIR - Sub STDL - Rela Pty_OD <=1 year - Employee\r'),
	(383, '261549000', 'AIR - Sub STDL - Rela Pty<=1year - Ex Audit\r'),
	(384, '261549111', 'AIR - Sub STDL - Rela Pty<=1 year - Ex Audit\r'),
	(385, '261549112', 'AIR - Sub STDL - Rela Pty_OD <=1 year - Ex Audit\r'),
	(386, '262109000', 'AIR - Sub STDL - Groups>1 year\r'),
	(387, '262109111', 'AIR - Sub STDL - Groups>1 year\r'),
	(388, '262209000', 'AIR - Sub STDL - Individuals>1 year\r'),
	(389, '262209111', 'AIR - Sub STDL - Individuals>1 year\r'),
	(390, '262309000', 'AIR - Sub STDL - Enterprises>1 year\r'),
	(391, '262309111', 'AIR - Sub STDL - Enterprises>1 year\r'),
	(392, '262409000', 'AIR - Sub STDL - Others>1 year\r'),
	(393, '262409111', 'AIR - Sub STDL - Others>1 year\r'),
	(394, '262519000', 'AIR - Sub STDL - Rela Pty>1year-Shareholder\r'),
	(395, '262519111', 'AIR - Sub STDL - Rela Pty>1 year - Shareholder\r'),
	(396, '262529000', 'AIR - Sub STDL - Rela Pty>1 year-Manager\r'),
	(397, '262529111', 'AIR - Sub STDL - Rela Pty>1 year - Manager\r'),
	(398, '262539000', 'AIR - Sub STDL - Rela Pty>1 year-Employee\r'),
	(399, '262539111', 'AIR - Sub STDL - Rela Pty>1 year - Employee\r'),
	(400, '262549000', 'AIR - Sub STDL - Rela Pty>1 year-Ex Audit\r'),
	(401, '262549111', 'AIR - Sub STDL - Rela Pty>1 year - Ex Audit\r'),
	(402, '271109000', 'AIR - DFL - Groups<=1 year\r'),
	(403, '271109111', 'AIR - DFL - Groups<=1 year\r'),
	(404, '271209000', 'AIR - DFL - Individuals<=1 year\r'),
	(405, '271209111', 'AIR - DFL - Individuals<=1 year\r'),
	(406, '271209112', 'AIR - DFL - Individuals_OD <=1 year\r'),
	(407, '271309000', 'AIR - DFL - Enterprises<=1 year\r'),
	(408, '271309111', 'AIR - DFL - Enterprises<=1 year\r'),
	(409, '271309112', 'AIR - DFL - Enterprises_OD <=1 year\r'),
	(410, '271409000', 'AIR - DFL - Others<=1 year\r'),
	(411, '271409111', 'AIR - DFL - Others<=1 year\r'),
	(412, '271409112', 'AIR - DFL - Others_OD <=1 year\r'),
	(413, '271519000', 'AIR - DFL - Rela Pty<=1year-Shareholder\r'),
	(414, '271519111', 'AIR - DFL - Rela Pty<=1 year - Shareholder\r'),
	(415, '271519112', 'AIR - DFL - Rela Pty_OD <=1 year - Shareholder\r'),
	(416, '271529000', 'AIR - DFL - Rela Pty<=1year-Manager\r'),
	(417, '271529111', 'AIR - DFL - Rela Pty<=1 year - Manager\r'),
	(418, '271529112', 'AIR - DFL - Rela Pty_OD <=1 year - Manager\r'),
	(419, '271539000', 'AIR - DFL - Rela Pty<=1year-Employee\r'),
	(420, '271539111', 'AIR - DFL - Rela Pty<=1 year - Employee\r'),
	(421, '271539112', 'AIR - DFL - Rela Pty_OD <=1 year - Employee\r'),
	(422, '271549000', 'AIR - DFL - Rela Pty<=1 year-Ex Audit\r'),
	(423, '271549111', 'AIR - DFL - Rela Pty<=1 year - Ex Audit\r'),
	(424, '271549112', 'AIR - DFL - Rela Pty_OD <=1 year - Ex Auditor\r'),
	(425, '272109000', 'AIR - DFL - Groups>1 year\r'),
	(426, '272109111', 'AIR - DFL - Groups>1 year\r'),
	(427, '272209000', 'AIR - DFL - Individuals>1 year\r'),
	(428, '272209111', 'AIR - DFL - Individuals>1 year\r'),
	(429, '272309000', 'AIR - DFL - Enterprises>1 year\r'),
	(430, '272309111', 'AIR - DFL - Enterprises>1 year\r'),
	(431, '272409000', 'AIR - DFL - Others>1 year\r'),
	(432, '272409111', 'AIR - DFL - Others>1 year\r'),
	(433, '272519000', 'AIR - DFL - Rela Pty>1year - Shareholder\r'),
	(434, '272519111', 'AIR - DFL - Rela Pty>1 year - Shareholder\r'),
	(435, '272529000', 'AIR - DFL - Rela Pty>1year - Manager\r'),
	(436, '272529111', 'AIR - DFL - Rela Pty>1 year - Manager\r'),
	(437, '272539000', 'AIR - DFL - Rela Pty>1year-Employee\r'),
	(438, '272539111', 'AIR - DFL - Rela Pty>1 year - Employee\r'),
	(439, '272549000', 'AIR - DFL - Rela Pty>1year-Ex Audit\r'),
	(440, '272549111', 'AIR - DFL - Rela Pty>1 year - Ex Audit\r'),
	(441, '281109000', 'AIR - LL - Groups<=1 year\r'),
	(442, '281109111', 'AIR - LL - Groups<=1 year\r'),
	(443, '281209000', 'AIR - LL - Individuals<=1 year\r'),
	(444, '281209111', 'AIR - LL - Individuals<=1 year\r'),
	(445, '281209112', 'AIR - LL - Individuals_OD <=1 year\r'),
	(446, '281309000', 'AIR - LL - Enterprises<=1 year\r'),
	(447, '281309111', 'AIR - LL - Enterprises<=1 year\r'),
	(448, '281309112', 'AIR - LL - Enterprises_OD <=1 year\r'),
	(449, '281409000', 'AIR - LL - Others<=1 year\r'),
	(450, '281409111', 'AIR - LL - Others<=1 year\r'),
	(451, '281409112', 'AIR - LL - Others_OD <=1 year\r'),
	(452, '281519000', 'AIR - LL - Rela Pty<=1year-Shareholder\r'),
	(453, '281519111', 'AIR - LL - Rela Pty<=1 year - Shareholder\r'),
	(454, '281519112', 'AIR - LL - Rela Pty_OD <=1 year - Shareholder\r'),
	(455, '281529000', 'AIR - LL - Rela Pty<=1 year -Manager\r'),
	(456, '281529111', 'AIR - LL - Rela Pty<=1 year - Manager\r'),
	(457, '281529112', 'AIR - LL - Rela Pty_OD <=1 year - Manager\r'),
	(458, '281539000', 'AIR - LL - Rela Pty<=1 year-Employee\r'),
	(459, '281539111', 'AIR - LL - Rela Pty<=1 year - Employee\r'),
	(460, '281539112', 'AIR - LL - Rela Pty_OD <=1 year - Employee\r'),
	(461, '281549000', 'AIR - LL - Rela Pty<=1 year-Ex Audit\r'),
	(462, '281549111', 'AIR - LL - Rela Pty<=1 year - Ex Audit\r'),
	(463, '281549112', 'AIR - LL - Rela Pty_OD <=1 year - Ex Auditor\r'),
	(464, '282109000', 'AIR - LL - Groups>1 year\r'),
	(465, '282109111', 'AIR - LL - Groups>1 year\r'),
	(466, '282209000', 'AIR - LL - Individuals>1 year\r'),
	(467, '282209111', 'AIR - LL - Individuals>1 year\r'),
	(468, '282309000', 'AIR - LL - Enterprises>1 year\r'),
	(469, '282309111', 'AIR - LL - Enterprises>1 year\r'),
	(470, '282409000', 'AIR - LL - Others>1 year\r'),
	(471, '282409111', 'AIR - LL - Others>1 year\r'),
	(472, '282519000', 'AIR - LL - Rela Pty>1year-Shareholder\r'),
	(473, '282519111', 'AIR - LL - Rela Pty>1 year - Shareholder\r'),
	(474, '282529000', 'AIR - LL - Rela Pty>1 year - Manager\r'),
	(475, '282529111', 'AIR - LL - Rela Pty>1 year - Manager\r'),
	(476, '282539000', 'AIR - LL - Rela Pty>1 year - Employee\r'),
	(477, '282539111', 'AIR - LL - Rela Pty>1 year - Employee\r'),
	(478, '282549000', 'AIR - LL - Rela Pty>1 year - Ex Audit\r'),
	(479, '282549111', 'AIR - LL - Rela Pty>1 year - Ex Audit\r'),
	(480, '289709000', 'Accounts Receivable \r'),
	(481, '289709111', 'Accounts Receivable_Fees on Borrowing\r'),
	(482, '289709112', 'Accounts Receivable_Other\r'),
	(483, '289809000', 'Inc Tax Receivable/Recoverable\r'),
	(484, '289809111', 'Inc Tax Receivable/Recoverable\r'),
	(485, '289909000', 'Dividends Receivable\r'),
	(486, '289909111', 'Dividends Receivable\r'),
	(487, '291109000', 'Land \r'),
	(488, '291109111', 'Land \r'),
	(489, '291209000', 'Land Improvement\r'),
	(490, '291209111', 'Land Improvement\r'),
	(491, '292109000', 'Building \r'),
	(492, '292109111', 'Building \r'),
	(493, '292209000', 'Leasehold Improvement\r'),
	(494, '292209111', 'Leasehold Improvement\r'),
	(495, '292309000', 'FA Under Construction/Development\r'),
	(496, '292309111', 'FA Under Construction/Development\r'),
	(497, '293109000', 'Furniture and Fixtures\r'),
	(498, '293109111', 'Furniture and Fixtures\r'),
	(499, '293209000', 'Equipment\r'),
	(500, '293209111', 'Equipment\r'),
	(501, '293309000', 'Computer Equipment\r'),
	(502, '293309111', 'Computer Equipment\r'),
	(503, '293409000', 'Motor Vehicles\r'),
	(504, '293409111', 'Motor Vehicles\r'),
	(505, '293509000', 'Other Fixed Assets\r'),
	(506, '293509111', 'Other Fixed Assets\r'),
	(507, '294109000', 'Accum Depr - Land Improve\r'),
	(508, '294109111', 'Accum Depr - Land Improve\r'),
	(509, '294209000', 'Accum Depr - Buildings\r'),
	(510, '294209111', 'Accum Depr - Buildings \r'),
	(511, '294309000', 'Accum Depr - Leasehold Improve\r'),
	(512, '294309111', 'Accum Depr - Leasehold Improve \r'),
	(513, '294409000', 'Accum Depr - Furniture and Fixtures\r'),
	(514, '294409111', 'Accum Depr - Furniture and Fixtures \r'),
	(515, '294509000', 'Accum Depr - Equipment\r'),
	(516, '294509111', 'Accum Depr - Equipment \r'),
	(517, '294609000', 'Accum Depr - Computer Equipment \r'),
	(518, '294609111', 'Accum Depr - Computer Equipment \r'),
	(519, '294709000', 'Accum Depr - Motor Vehicles\r'),
	(520, '294709111', 'Accum Depr - Motor Vehicles \r'),
	(521, '294809000', 'Accum Depr - Other Fixed Assets\r'),
	(522, '294809111', 'Accum Depr - Other Fixed Assets \r'),
	(523, '294919000', 'Amort - Intangible Assets\r'),
	(524, '294919111', 'Amort - Intangible Assets \r'),
	(525, '294929000', 'Amort - Formation Exps\r'),
	(526, '294929111', 'Amort - Formation Exps\r'),
	(527, '295109000', 'Formation Exps\r'),
	(528, '295109111', 'Formation Exps\r'),
	(529, '295209000', 'Intangible Assets\r'),
	(530, '295209111', 'Intangible Assets\r'),
	(531, '296509000', 'Inter-Branch Accounts\r'),
	(532, '296509001', 'IBA_Pursat (PUR)\r'),
	(533, '296509002', 'IBA_Kampong Thom (KTM)\r'),
	(534, '296509003', 'IBA_Siem Reap (SRP)\r'),
	(535, '296509004', 'IBA_Banteay Meanchey (BMC)\r'),
	(536, '296509005', 'IBA_Phnom Penh (PNP)\r'),
	(537, '296509006', 'IBA_Kampong Cham (KCM)\r'),
	(538, '296509007', 'IBA_Battambang (BTB)\r'),
	(539, '296509008', 'IBA_Kampong Chnang (KCG)\r'),
	(540, '296509009', 'IBA_Takeo (TAK)\r'),
	(541, '296509010', 'IBA_Pre Veng (PVG)\r'),
	(542, '296509011', 'IBA_Takhmao (TMO)\r'),
	(543, '296509012', 'IBA_Svay Rieng (SVG)\r'),
	(544, '296509013', 'IBA_Kampong Speu (KSP)\r'),
	(545, '296509014', 'IBA_Kamport (KPT)\r'),
	(546, '296509015', 'IBA_Koh Kong (KKG)\r'),
	(547, '296509016', 'IBA_Sihanuk Ville (SNV)\r'),
	(548, '296509017', 'IBA_Kratie (KTE)\r'),
	(549, '296509018', 'IBA_KTM_Staung (STN)\r'),
	(550, '296509019', 'IBA_PNP_Dongkor (DKO)\r'),
	(551, '296509020', 'IBA_KCM_Thoung Khum (TKM)\r'),
	(552, '296509021', 'IBA_PNP_Doun Penh (DNP)\r'),
	(553, '296509022', 'IBA_SRP_Chi Kreng (CKG)\r'),
	(554, '296509023', 'IBA_SRP_Sothnikum (SNK)\r'),
	(555, '296509024', 'IBA_BMC_Pioy Pet (PPT)\r'),
	(556, '296509025', 'IBA_SRP_Pouk (PUK)\r'),
	(557, '296509026', 'IBA_KTM_Baray (BRY)\r'),
	(558, '296509027', 'IBA_PUR_Bakan (BKN)\r'),
	(559, '296509028', 'IBA_KCM_Memut (MMT)\r'),
	(560, '296509029', 'IBA_KDL_Mukampoul (MKP)\r'),
	(561, '296509030', 'IBA_BMC_Thmor Pouk (TPK)\r'),
	(562, '296509031', 'IBA_KCM_Pre Chhor (PCH)\r'),
	(563, '296509032', 'IBA_PNP_Operational Office (OPO)\r'),
	(564, '296509033', 'IBA_BTB_Bavel (BVL)\r'),
	(565, '296509034', 'IBA_Ortdor Meanchey (OMC)\r'),
	(566, '296509035', 'IBA_Preah Vihear (PVH)\r'),
	(567, '296509036', 'IBA_Stung Treng (STG)\r'),
	(568, '296509037', 'IBA_Ratanakiri (RKR)\r'),
	(569, '296509038', 'IBA_Mondul Kiri (MKR)\r'),
	(570, '296509039', 'IBA_Pailin (PLN)\r'),
	(571, '296509040', 'IBA_Kep (KEP)\r'),
	(572, '296509041', 'IBA_SRP_Krong Siem Reap \r'),
	(573, '296509042', 'IBA_OMC_Along Veng\r'),
	(574, '296509043', 'IBA_PVH_Rovieng\r'),
	(575, '296509044', 'IBA_TKM_Sandan\r'),
	(576, '296509045', 'IBA_BMC_Mongkoul Borey\r'),
	(577, '296509046', 'IBA_PNP_Boung Trabek\r'),
	(578, '296509047', 'IBA_KDL_Kien Svay\r'),
	(579, '296509048', 'IBA_KCM_Chamkar Leu\r'),
	(580, '296509049', 'IBA_BTB_Rothanak Mundol\r'),
	(581, '296509050', 'IBA_TAK_Bati\r'),
	(582, '296509051', 'IBA_PVG_Neak Leurng\r'),
	(583, '296509052', 'IBA_PVG_Svay Antor\r'),
	(584, '296509053', 'IBA_KDL_Ang Snoul\r'),
	(585, '296509054', 'IBA_PNP_Russey Keo\r'),
	(586, '296509055', 'IBA_PNP_Preak Leap\r'),
	(587, '296509056', 'IBA_KDL_Koh Thom\r'),
	(588, '296509057', 'IBA_KDL_Saang\r'),
	(589, '296509058', 'IBA_BMC_Malai\r'),
	(590, '296509059', 'IBA_SRP_Krolanh\r'),
	(591, '296509060', 'IBA_BTB_Moung Russey\r'),
	(592, '296509061', 'IBA_KCM_Ponhea Kraek\r'),
	(593, '296509062', 'IBA_BTB_Thmor Koul\r'),
	(594, '296509063', 'IBA_KTE_Chloung\r'),
	(595, '296509064', 'IBA_SRP_Bakorng\r'),
	(596, '296509065', 'IBA_KCM_Batheay\r'),
	(597, '296509066', 'IBA_TAK_Kiribvong\r'),
	(598, '296509999', 'IBA_Head Office (HO)\r'),
	(599, '296609111', 'Equiv FOREX Position Acct\r'),
	(600, '296709000', 'Suspense Asset Account \r'),
	(601, '296709111', 'Suspense Asset Account\r'),
	(602, '296709112', 'OFSS Value Date Mismatch Suspense GL\r'),
	(603, '296709113', 'OFSS Error Posting & Suspense Account\r'),
	(604, '296709114', 'Account to Account Transfers\r'),
	(605, '296709115', 'Items for Clearification\r'),
	(606, '296709116', 'Suspense Asset Account_Others\r'),
	(607, '296709117', 'Suspense Asset Account_Cash Shortage/ Overage\r'),
	(608, '296709211', 'Debit Settlement Bridge for Loans\r'),
	(609, '296809000', 'Other Sundry Assets \r'),
	(610, '296809111', 'Other Sundry Assets \r'),
	(611, '300009000', 'Total Liabilities Control Account\r'),
	(612, '321109000', 'Amounts owed to NBC\r'),
	(613, '321109111', 'Amounts owed to NBC\r'),
	(614, '322109000', 'Voluntary Depo - Demand\r'),
	(615, '322109111', 'Voluntary Depo - Demand\r'),
	(616, '322209000', 'Voluntary Deposits - Savings\r'),
	(617, '322209111', 'Voluntary Depo - Savings\r'),
	(618, '322309000', 'Voluntary Deposits - Term\r'),
	(619, '322309111', 'Voluntary Depo - Term\r'),
	(620, '322409000', 'Voluntary Depo - Other\r'),
	(621, '322409111', 'Voluntary Depo - Other\r'),
	(622, '322909000', 'Compulsory Deposits\r'),
	(623, '322909111', 'Compulsory Depo\r'),
	(624, '322909119', 'Compulsory Depo - Other\r'),
	(625, '331109000', 'Short-term loans payable\r'),
	(626, '331109111', 'ST_Borrow Funds - Shareholder \r'),
	(627, '331109112', '"ST_Borrow Funds - Corp, Associa , Org"\r\n331109113,ST_Borrow Funds -  Banks\r\n331109114,ST_Borrow Fun');
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
  PRIMARY KEY (`sav_acc_id`),
  KEY `sav_product type` (`sav_acc_sav_pro_typ_id`),
  KEY `sav_contact` (`sav_acc_con_id`),
  KEY `sav_user_id` (`sav_use_id`),
  CONSTRAINT `sav_contact` FOREIGN KEY (`sav_acc_con_id`) REFERENCES `contacts` (`con_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `sav_product type` FOREIGN KEY (`sav_acc_sav_pro_typ_id`) REFERENCES `saving_product_type` (`sav_pro_typ_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `sav_user_id` FOREIGN KEY (`sav_use_id`) REFERENCES `users` (`use_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.saving_product_type: ~1 rows (approximately)
/*!40000 ALTER TABLE `saving_product_type` DISABLE KEYS */;
INSERT INTO `saving_product_type` (`sav_pro_typ_id`, `sav_pro_typ_title`, `status`) VALUES
	(1, 'type1', '');
/*!40000 ALTER TABLE `saving_product_type` ENABLE KEYS */;


# Dumping structure for table loan_khmer.transaction
DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `tra_id` int(11) NOT NULL,
  `tra_mod_id` int(11) NOT NULL,
  `tra_cur_id` int(11) DEFAULT NULL,
  `tra_amount` decimal(10,0) DEFAULT NULL,
  `tra_description` varchar(200) DEFAULT NULL,
  `gl_code` int(11) DEFAULT NULL,
  `gl_account_no` int(11) DEFAULT NULL,
  `con_id` int(11) NOT NULL,
  `tra_date` date DEFAULT NULL,
  `tra_gl_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`tra_id`),
  KEY `tra_contact_id` (`con_id`),
  KEY `tra_tra_mod_id` (`tra_mod_id`),
  KEY `tra_currency_id` (`tra_cur_id`),
  KEY `tro_gl_id` (`tra_gl_id`),
  CONSTRAINT `tra_contact_id` FOREIGN KEY (`con_id`) REFERENCES `contacts` (`con_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tra_tra_mod_id` FOREIGN KEY (`tra_mod_id`) REFERENCES `transaction_mode` (`tra_mod_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tro_gl_id` FOREIGN KEY (`tra_gl_id`) REFERENCES `gl_list` (`gl_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.transaction: ~0 rows (approximately)
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
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
	(1, 'Debit', 1),
	(2, 'Credit', 1),
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
	(2, 'account', 1, '', 'e268443e43d93dab7ebef303bbe9642f'),
	(3, 'vannak', 1, '', 'd96783d6bc86fb4d4a1b6cdacbfa9dc5'),
	(4, 'eddddd', 1, '', '25f9e794323b453885f5181f1b624d0b');
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
