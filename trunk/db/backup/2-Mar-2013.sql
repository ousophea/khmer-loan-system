-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 02, 2013 at 09:21 AM
-- Server version: 5.1.53
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `loan`
--

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `rol_id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_name` varchar(50) NOT NULL,
  `rol_des` text NOT NULL,
  `rol_authorize` int(11) NOT NULL,
  `rol_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`rol_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`rol_id`, `rol_name`, `rol_des`, `rol_authorize`, `rol_status`) VALUES
(1, 'SuperAdmin', 'Full access on system and Database', 0, 0),
(2, 'Admin', 'Full access on system', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `new_password` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `rol_id`, `email`, `username`, `password`, `new_password`) VALUES
(14, 1, 'sochy', '', 'b0baee9d279d34fa1dfd71aadb908c3f', 1),
(15, 2, 'sochyc', '', 'b0baee9d279d34fa1dfd71aadb908c3f', 1),
(16, 2, 'sochya', '', '594f803b380a41396ed63dca39503542', 1),
(17, 2, 'sochyb', '', '594f803b380a41396ed63dca39503542', 1);
