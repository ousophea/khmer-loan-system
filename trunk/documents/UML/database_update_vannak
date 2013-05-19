-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 19, 2013 at 02:05 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `loan_khmer`
--

-- --------------------------------------------------------

--
-- Table structure for table `communes`
--

CREATE TABLE IF NOT EXISTS `communes` (
  `com_id` int(11) NOT NULL AUTO_INCREMENT,
  `com_dis_id` int(10) unsigned DEFAULT NULL,
  `com_en_name` varchar(80) NOT NULL,
  `com_kh_name` varchar(80) DEFAULT NULL,
  `status` binary(1) DEFAULT '1',
  PRIMARY KEY (`com_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `con_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_cid` varchar(45) DEFAULT NULL,
  `con_con_typ_id` int(11) DEFAULT NULL,
  `con_con_job_id` int(11) NOT NULL DEFAULT '0',
  `con_con_inc_id` int(11) NOT NULL DEFAULT '0',
  `con_en_first_name` varchar(45) NOT NULL,
  `con_en_last_name` varchar(45) NOT NULL,
  `con_en_nickname` varchar(45) DEFAULT NULL,
  `con_kh_first_name` varchar(45) NOT NULL,
  `con_kh_last_name` varchar(45) NOT NULL,
  `con_kh_nickname` varchar(45) DEFAULT NULL,
  `con_sex` char(1) NOT NULL,
  `con_national_identity_card` varchar(20) DEFAULT NULL,
  `con_datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `con_datemodified` timestamp NULL DEFAULT NULL,
  `status` bit(1) DEFAULT b'1',
  `con_use_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`con_id`),
  KEY `contact type` (`con_con_typ_id`),
  KEY `user_id` (`con_use_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

-- --------------------------------------------------------

--
-- Table structure for table `contacts_couple`
--

CREATE TABLE IF NOT EXISTS `contacts_couple` (
  `con_cou_owner` int(11) NOT NULL,
  `con_cou_couple` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contacts_detail`
--

CREATE TABLE IF NOT EXISTS `contacts_detail` (
  `con_det_con_id` int(11) NOT NULL,
  `con_det_email` varchar(45) DEFAULT NULL,
  `con_det_civil_status` tinyint(1) NOT NULL DEFAULT '1',
  `con_det_dob` date DEFAULT NULL,
  `con_de_vil_id` int(11) NOT NULL,
  `con_det_address_detail` varchar(45) DEFAULT NULL,
  KEY `contact` (`con_det_con_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `contacts_family`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `contacts_group`
--

CREATE TABLE IF NOT EXISTS `contacts_group` (
  `con_gro_con_id` int(11) NOT NULL,
  `con_gro_gro_id` int(11) NOT NULL,
  PRIMARY KEY (`con_gro_con_id`,`con_gro_gro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Table structure for table `contacts_income`
--

CREATE TABLE IF NOT EXISTS `contacts_income` (
  `con_inc_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_inc_range` varchar(100) NOT NULL,
  `status` binary(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`con_inc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Table structure for table `contacts_job`
--

CREATE TABLE IF NOT EXISTS `contacts_job` (
  `con_job_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_job_title` varchar(45) NOT NULL,
  `status` binary(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`con_job_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Table structure for table `contacts_number`
--

CREATE TABLE IF NOT EXISTS `contacts_number` (
  `con_num_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_num_con_id` int(11) NOT NULL,
  `con_num_line` varchar(15) DEFAULT NULL,
  `status` bit(1) DEFAULT b'1',
  PRIMARY KEY (`con_num_id`),
  KEY `contact number` (`con_num_con_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Table structure for table `contacts_type`
--

CREATE TABLE IF NOT EXISTS `contacts_type` (
  `con_typ_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_typ_title` varchar(20) DEFAULT NULL,
  `status` bit(1) DEFAULT b'1',
  PRIMARY KEY (`con_typ_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Table structure for table `districts`
--

CREATE TABLE IF NOT EXISTS `districts` (
  `dis_id` int(11) NOT NULL AUTO_INCREMENT,
  `dis_pro_id` int(10) unsigned DEFAULT NULL,
  `dis_en_name` varchar(80) NOT NULL,
  `dis_kh_name` varchar(80) DEFAULT NULL,
  `status` binary(1) DEFAULT '1',
  PRIMARY KEY (`dis_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Table structure for table `income`
--

CREATE TABLE IF NOT EXISTS `income` (
  `inc_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`inc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `provinces`
--

CREATE TABLE IF NOT EXISTS `provinces` (
  `pro_id` int(11) DEFAULT NULL,
  `pro_en_name` varchar(50) NOT NULL,
  `pro_kh_name` varchar(50) DEFAULT NULL,
  `status` binary(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `villages`
--

CREATE TABLE IF NOT EXISTS `villages` (
  `vil_id` int(11) NOT NULL AUTO_INCREMENT,
  `vil_com_id` int(10) unsigned DEFAULT NULL,
  `vil_en_name` varchar(80) NOT NULL,
  `vil_kh_name` varchar(80) DEFAULT NULL,
  `status` binary(1) DEFAULT '1',
  PRIMARY KEY (`vil_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contact type` FOREIGN KEY (`con_con_typ_id`) REFERENCES `contacts_type` (`con_typ_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`con_use_id`) REFERENCES `users` (`use_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `contacts_number`
--
ALTER TABLE `contacts_number`
  ADD CONSTRAINT `contact number` FOREIGN KEY (`con_num_con_id`) REFERENCES `contacts` (`con_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
