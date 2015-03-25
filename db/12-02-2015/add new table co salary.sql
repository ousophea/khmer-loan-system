# --------------------------------------------------------
# Host:                         127.0.0.1
# Server version:               5.6.12-log
# Server OS:                    Win64
# HeidiSQL version:             6.0.0.3603
# Date/time:                    2015-02-26 08:38:20
# --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

# Dumping structure for table loan_khmer.creadit_officer_salary
DROP TABLE IF EXISTS `creadit_officer_salary`;
CREATE TABLE IF NOT EXISTS `creadit_officer_salary` (
  `cos_id` int(10) DEFAULT NULL,
  `cos_salary` double DEFAULT NULL,
  `cos_date_create` date DEFAULT NULL,
  `cos_date_modified` date DEFAULT NULL,
  `cos_status` int(10) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Data exporting was unselected.
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
