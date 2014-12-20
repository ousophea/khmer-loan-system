# --------------------------------------------------------
# Host:                         127.0.0.1
# Server version:               5.1.53-community-log
# Server OS:                    Win64
# HeidiSQL version:             6.0.0.3603
# Date/time:                    2014-12-20 14:12:01
# --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

# Dumping structure for table loan_khmer.loan_account_type
DROP TABLE IF EXISTS `loan_account_type`;
CREATE TABLE IF NOT EXISTS `loan_account_type` (
  `lat_id` int(10) NOT NULL DEFAULT '0',
  `lat_title` varchar(300) DEFAULT NULL,
  `lat_status` bit(1) DEFAULT NULL,
  PRIMARY KEY (`lat_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

# Dumping data for table loan_khmer.loan_account_type: 0 rows
/*!40000 ALTER TABLE `loan_account_type` DISABLE KEYS */;
INSERT INTO `loan_account_type` (`lat_id`, `lat_title`, `lat_status`) VALUES
	(11, 'លេខគណនីឥណទានប្រចាំសប្តាហ៍ (ឯកត្តជន)', ''),
	(12, 'លេខគណនីឥណទានប្រចាំ២សប្តាហ៍ (ឯកត្តជន)', ''),
	(13, 'លេខគណនីឥណទានប្រចាំខែ (ឯកត្តជន)', ''),
	(14, 'លេខគណនីឥណទានប្រចាំថ្ងៃ (ឯកត្តជន)', ''),
	(21, 'លេខគណនីឥណទានប្រចាំសប្តាហ៍ (ក្រុម)', ''),
	(22, 'លេខគណនីឥណទានប្រចាំ២សប្តាហ៍ (ក្រុម)', ''),
	(23, 'លេខគណនីឥណទានប្រចាំខែ (ក្រុម)', ''),
	(24, 'លេខគណនីឥណទានប្រចាំថ្ងៃ (ក្រុម)', ''),
	(31, 'លេខគណនីធានារាប់រងឥណទាន', ''),
	(32, 'លេខគណនីសេវាកម្មលោះប្លង់', ''),
	(33, 'លេខគណនីប្រាក់ពិន័យ', ''),
	(34, 'លេខគណនីសន្សំ', '');
/*!40000 ALTER TABLE `loan_account_type` ENABLE KEYS */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
