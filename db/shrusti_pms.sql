-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 16, 2016 at 12:27 PM
-- Server version: 5.5.38-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shrusti_pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_grp`
--

CREATE TABLE IF NOT EXISTS `activity_grp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `added_by` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `activity_grp`
--

INSERT INTO `activity_grp` (`id`, `name`, `added_by`, `time`) VALUES
(1, 'test activity', 'bhaskar', '1460623933'),
(2, 'test activity 2', 'bhaskar', '1460626379'),
(3, 'test activity 3', 'bhaskar', '1460626580'),
(4, '', 'bhaskar', '1460626580'),
(5, 'test activity 4', 'bhaskar', '1460626632'),
(6, '', 'bhaskar', '1460626632'),
(7, 'test activity 5', '', '1460629149'),
(8, '', '', '1460629149'),
(9, 'test activity 6', 'bhaskar', '1460629202'),
(10, '', 'bhaskar', '1460629202');

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE IF NOT EXISTS `activity_log` (
  `activity_id` varchar(25) NOT NULL,
  `client_id` varchar(25) NOT NULL,
  `fromDate` varchar(25) NOT NULL,
  `toDate` varchar(25) NOT NULL,
  `activity_grp` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `venue` varchar(100) NOT NULL,
  `remarks` varchar(500) NOT NULL,
  `added_by` varchar(50) NOT NULL,
  `time_added` varchar(25) NOT NULL,
  `approved_by` varchar(50) NOT NULL,
  `time_approved` varchar(25) NOT NULL,
  `approval_status` int(11) NOT NULL,
  PRIMARY KEY (`activity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`activity_id`, `client_id`, `fromDate`, `toDate`, `activity_grp`, `name`, `venue`, `remarks`, `added_by`, `time_added`, `approved_by`, `time_approved`, `approval_status`) VALUES
('16/SA/00001', 'CL22001', '10/07/2016', '20/07/2016', 'Test activity', 'Some activity', 'KBS', 'just some remarks', 'bhaskar', '1460666192', 'bhaskar', '1460667011', 1),
('16/SA/00002', 'CL22003', '10/07/2016', '20/07/2016', 'Test activity 4', 'Some activity 1', 'Mkt', 'just some remarks 2', 'bhaskar', '1460698402', 'bhaskar', '1460698411', 1);

-- --------------------------------------------------------

--
-- Table structure for table `city_grp`
--

CREATE TABLE IF NOT EXISTS `city_grp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `added_by` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `city_grp`
--

INSERT INTO `city_grp` (`id`, `name`, `added_by`, `time`) VALUES
(1, 'bangalore', 'bhaskar', '1460621889'),
(2, 'mysore', 'bhaskar', '1460630071'),
(3, 'mangalore', 'bhaskar', '1460630080'),
(4, 'belgaum', 'bhaskar', '1460632266'),
(5, '', 'bhaskar', '1460632267');

-- --------------------------------------------------------

--
-- Table structure for table `client_grp`
--

CREATE TABLE IF NOT EXISTS `client_grp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `added_by` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `client_grp`
--

INSERT INTO `client_grp` (`id`, `name`, `added_by`, `time`) VALUES
(1, 'test client', 'bhaskar', '1460623505'),
(2, 'client 1', 'bhaskar', '1460633996'),
(3, '', 'bhaskar', '1460633997'),
(4, 'test client 2', 'bhaskar', '1460649097'),
(5, '', 'bhaskar', '1460649097');

-- --------------------------------------------------------

--
-- Table structure for table `client_log`
--

CREATE TABLE IF NOT EXISTS `client_log` (
  `client_id` varchar(10) NOT NULL,
  `client_grp` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `city` varchar(25) NOT NULL,
  `state` varchar(25) NOT NULL,
  `office_phn` varchar(25) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `fax` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_person` varchar(50) NOT NULL,
  `contact_no` varchar(25) NOT NULL,
  `website` varchar(50) NOT NULL,
  `pan` varchar(25) NOT NULL,
  `tin` varchar(50) NOT NULL,
  `cst` varchar(50) NOT NULL,
  `ecc` varchar(50) NOT NULL,
  `service_tax_no` varchar(50) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `account_no` varchar(50) NOT NULL,
  `bank_branch` varchar(100) NOT NULL,
  `ifsc` varchar(50) NOT NULL,
  `added_by` varchar(50) NOT NULL,
  `time_added` varchar(50) NOT NULL,
  `approved_by` varchar(50) NOT NULL,
  `time_approved` varchar(50) NOT NULL,
  `approval_status` int(11) NOT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_log`
--

INSERT INTO `client_log` (`client_id`, `client_grp`, `name`, `address`, `city`, `state`, `office_phn`, `mobile`, `fax`, `email`, `contact_person`, `contact_no`, `website`, `pan`, `tin`, `cst`, `ecc`, `service_tax_no`, `bank_name`, `account_no`, `bank_branch`, `ifsc`, `added_by`, `time_added`, `approved_by`, `time_approved`, `approval_status`) VALUES
('CL22001', 'Test client', 'Suraj', 'S6, 2nd Floor, Emerald Enclave', 'Bangalore', 'Karnataka', '', '8553236639', 'NA', 'suraj@abo.life', 'sangu', '9900697205', 'NA', 'auipj5323m', 'w4vddf4234234', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'bhaskar', '1460645917', 'NA', 'NA', 0),
('CL22002', 'Test client', 'Sangu', 'RMV 2nd Stage', 'Bangalore', 'Karnataka', 'NA', '9900679205', '', 'sangu@abo.life', 'Suraj', '8553236639', '', 'sdfsdfsd', '534534bcb', '', '', '', '', '', '', '', 'admin', '1460646449', 'bhaskar', '1460656270', 1),
('CL22003', 'Test client', 'Abo Life', 'Hebbal', 'Bangalore', 'Karnataka', '', '8553236639', '', 'suraj@abo.life', 'suraj', '8553236639', 'http://abo.life', 'auipj5323m', '45454545445', '', '', '', '', '', '', '', 'bhaskar', '1460648486', '', '', 0),
('CL22004', 'Test client 2', 'Opencube Labs', 'Incubation Center, BMSIT', 'Bangalore', 'Karnataka', '', '8553236639', '', 'surajjana2@gmail.com', 'suraj', '8553236639', '', 'auipj5323m', '45454545445', '', '', '', '', '', '', '', 'bhaskar', '1460651715', 'bhaskar', '1460656216', 1),
('CL22005', 'Test client 2', 'Rockstat', 'Incubation Center, BMSIT', 'Bangalore', 'Karnataka', '', '8553236639', '', 'surajjana2@gmail.com', 'suraj', '8553236639', 'http://rockstat.com', 'auipj5323m', '45454545445', '', '', '', '', '', '', '', 'bhaskar', '1460659511', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `po_log`
--

CREATE TABLE IF NOT EXISTS `po_log` (
  `po_id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` varchar(25) NOT NULL,
  `vendor_id` varchar(25) NOT NULL,
  `vendor_grp` varchar(50) DEFAULT NULL,
  `po_amount` varchar(50) DEFAULT NULL,
  `po_balance` varchar(50) DEFAULT NULL,
  `po_remarks` varchar(100) DEFAULT NULL,
  `added_by` varchar(50) DEFAULT NULL,
  `time_added` varchar(25) DEFAULT NULL,
  `approved_by` varchar(50) DEFAULT NULL,
  `time_approved` varchar(25) DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `time_modified` varchar(25) DEFAULT NULL,
  `approval_status` int(11) DEFAULT NULL,
  `activity_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`po_id`),
  KEY `activity_id` (`activity_id`),
  KEY `vendor_id` (`vendor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `po_log`
--

INSERT INTO `po_log` (`po_id`, `activity_id`, `vendor_id`, `vendor_grp`, `po_amount`, `po_balance`, `po_remarks`, `added_by`, `time_added`, `approved_by`, `time_approved`, `modified_by`, `time_modified`, `approval_status`, `activity_status`) VALUES
(1, '16/SA/00002', 'VL11001', 'test vendor', '20000', '20000', 'yo yo', 'bhaskar', '1460707006', 'bhaskar', '1460708484', 'admin', '1460721634', 1, 1),
(2, '16/SA/00001', 'VL11001', 'test vendor', '15000', '0', 'yo yo', 'bhaskar', '1460709636', 'bhaskar', '1460709644', 'admin', '1460785328', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `state_grp`
--

CREATE TABLE IF NOT EXISTS `state_grp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `added_by` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `state_grp`
--

INSERT INTO `state_grp` (`id`, `name`, `added_by`, `time`) VALUES
(9, 'karnataka', 'bhaskar', '1460619657'),
(12, 'kerala', 'bhaskar', '1460626812'),
(13, 'tamil nadu', 'bhaskar', '1460626822'),
(14, 'madhya pradesh', 'bhaskar', '1460698859'),
(15, '', 'bhaskar', '1460698859');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(50) NOT NULL,
  `pwd` varchar(500) NOT NULL,
  `email` varchar(100) NOT NULL,
  `rights` int(11) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `uname`, `pwd`, `email`, `rights`) VALUES
(1, 'admin', 'admin123', 'admin@srushti.net.in', 3),
(2, 'bhaskar', 'bhaskar123', 'bhaskar@srushti.biz', 3),
(3, 'suraj', 'hack123', 'suraj@abo.life', 0),
(4, 'sangu', 'sangu', 'sangavi@abo.life', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_grp`
--

CREATE TABLE IF NOT EXISTS `vendor_grp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `added_by` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `vendor_grp`
--

INSERT INTO `vendor_grp` (`id`, `name`, `added_by`, `time`) VALUES
(1, 'test vendor', 'bhaskar', '1460623058');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_log`
--

CREATE TABLE IF NOT EXISTS `vendor_log` (
  `vendor_id` varchar(10) NOT NULL,
  `vendor_grp` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `city` varchar(25) NOT NULL,
  `state` varchar(25) NOT NULL,
  `office_phn` varchar(25) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `fax` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_person` varchar(50) NOT NULL,
  `contact_no` varchar(25) NOT NULL,
  `website` varchar(50) NOT NULL,
  `pan` varchar(25) NOT NULL,
  `tin` varchar(50) NOT NULL,
  `cst` varchar(50) NOT NULL,
  `ecc` varchar(50) NOT NULL,
  `service_tax_no` varchar(50) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `account_no` varchar(50) NOT NULL,
  `bank_branch` varchar(100) NOT NULL,
  `ifsc` varchar(50) NOT NULL,
  `added_by` varchar(50) NOT NULL,
  `time_added` varchar(50) NOT NULL,
  `approved_by` varchar(50) NOT NULL,
  `time_approved` varchar(50) NOT NULL,
  `approval_status` int(11) NOT NULL,
  PRIMARY KEY (`vendor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor_log`
--

INSERT INTO `vendor_log` (`vendor_id`, `vendor_grp`, `name`, `address`, `city`, `state`, `office_phn`, `mobile`, `fax`, `email`, `contact_person`, `contact_no`, `website`, `pan`, `tin`, `cst`, `ecc`, `service_tax_no`, `bank_name`, `account_no`, `bank_branch`, `ifsc`, `added_by`, `time_added`, `approved_by`, `time_approved`, `approval_status`) VALUES
('VL11001', 'Test vendor', 'Opencube Labs', 'Incubation Center, BMSIT', 'Bangalore', 'Karnataka', 'NA', '8553236639', '', 'suraj@abo.life', 'suraj', '8553236639', 'opencube.in', 'auipj5323m', '45454545445', '', '', '', '', '', '', '', 'bhaskar', '1460660519', 'bhaskar', '1460661208', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `po_log`
--
ALTER TABLE `po_log`
  ADD CONSTRAINT `po_log_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `activity_log` (`activity_id`),
  ADD CONSTRAINT `po_log_ibfk_2` FOREIGN KEY (`vendor_id`) REFERENCES `vendor_log` (`vendor_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
