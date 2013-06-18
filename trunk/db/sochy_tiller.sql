
#
# Table structure for table 'tiller'
#

CREATE TABLE /*!32312 IF NOT EXISTS*/ `tiller` (
  `til_id` int(10) NOT NULL AUTO_INCREMENT,
  `til_tel_id` int(10) NOT NULL DEFAULT '0',
  `til_modifide_date` timestamp NULL DEFAULT NULL,
  `til_create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `til_debit` double DEFAULT NULL,
  `til_credit` double DEFAULT NULL,
  `til_balance` double DEFAULT NULL,
  `til_cur_id` int(10) NOT NULL,
  PRIMARY KEY (`til_id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;



#
# Dumping data for table 'tiller'
#

/*!40000 ALTER TABLE `tiller` DISABLE KEYS*/;
LOCK TABLES `tiller` WRITE;
REPLACE INTO `tiller` (`til_id`, `til_tel_id`, `til_modifide_date`, `til_create_date`, `til_debit`, `til_credit`, `til_balance`, `til_cur_id`) VALUES (37,4,'2013-06-17 03:35:08','2013-06-17 22:09:35','1.1111111111111E68','11',NULL,1),
	(38,4,NULL,'2013-06-17 22:09:58','22',NULL,NULL,2),
	(39,4,NULL,'2013-06-17 22:10:24','33',NULL,NULL,3);
UNLOCK TABLES;
/*!40000 ALTER TABLE `tiller` ENABLE KEYS*/;


#
# Table structure for table 'transaction_type'
#

CREATE TABLE /*!32312 IF NOT EXISTS*/ `transaction_type` (
  `tra_typ_id` int(11) NOT NULL AUTO_INCREMENT,
  `tra_typ_title` varchar(50) NOT NULL,
  `tra_typ_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`tra_typ_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;



#
# Dumping data for table 'transaction_type'
#

/*!40000 ALTER TABLE `transaction_type` DISABLE KEYS*/;
LOCK TABLES `transaction_type` WRITE;
REPLACE INTO `transaction_type` (`tra_typ_id`, `tra_typ_title`, `tra_typ_status`) VALUES (1,'Credit',1),
	(2,'Debit',1);
UNLOCK TABLES;
/*!40000 ALTER TABLE `transaction_type` ENABLE KEYS*/;
