-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 12, 2019 at 01:15 PM
-- Server version: 5.7.24-log
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bqh4l_plc`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_seq` int(11) NOT NULL,
  `name` text NOT NULL,
  `section` text,
  `address` text,
  `tel` text,
  `person` text,
  `email` text,
  `remarks` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_seq`, `name`, `section`, `address`, `tel`, `person`, `email`, `remarks`) VALUES
(1, 'くらいあんと', 'くらいあんと', '', '', 'くらいあんと', '', ''),
(2, 'client2', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `counting`
--

CREATE TABLE `counting` (
  `employee_no` int(11) NOT NULL,
  `job_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `counting`
--

INSERT INTO `counting` (`employee_no`, `job_no`) VALUES
(43, 14);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_seq` int(11) NOT NULL,
  `employee_id` varchar(4) NOT NULL,
  `employee_pw` varchar(20) NOT NULL,
  `employee_level` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `group_seq` int(11) NOT NULL,
  `kind` int(11) DEFAULT NULL,
  `insurance` int(11) DEFAULT NULL,
  `name_kana` varchar(30) DEFAULT NULL,
  `name` varchar(30) NOT NULL,
  `sex` int(11) DEFAULT NULL,
  `birthday` varchar(10) DEFAULT NULL,
  `post` varchar(8) DEFAULT NULL,
  `address_kana` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `tel1` varchar(13) DEFAULT NULL,
  `tel2` varchar(13) DEFAULT NULL,
  `answering` int(11) DEFAULT NULL,
  `fax` varchar(13) DEFAULT NULL,
  `email1` varchar(50) DEFAULT NULL,
  `email2` varchar(50) DEFAULT NULL,
  `priority_email` int(11) DEFAULT NULL,
  `route` varchar(30) DEFAULT NULL,
  `station` varchar(30) DEFAULT NULL,
  `bus` int(11) DEFAULT NULL,
  `bus_name` varchar(30) DEFAULT NULL,
  `bus_stop` varchar(30) DEFAULT NULL,
  `bank_kana` varchar(30) DEFAULT NULL,
  `bank` varchar(30) DEFAULT NULL,
  `branch_code` varchar(3) DEFAULT NULL,
  `branch_kana` varchar(30) DEFAULT NULL,
  `branch` varchar(30) DEFAULT NULL,
  `account` varchar(7) DEFAULT NULL,
  `education_from` varchar(7) DEFAULT NULL,
  `education_to` varchar(7) DEFAULT NULL,
  `school` varchar(30) DEFAULT NULL,
  `graduate` varchar(30) DEFAULT NULL,
  `recruit` varchar(50) DEFAULT NULL,
  `work1_from` varchar(7) DEFAULT NULL,
  `work1_to` varchar(7) DEFAULT NULL,
  `work1_status` varchar(20) DEFAULT NULL,
  `work1_company` varchar(30) DEFAULT NULL,
  `work1_location` varchar(30) DEFAULT NULL,
  `work1_job` varchar(30) DEFAULT NULL,
  `work2_from` varchar(7) DEFAULT NULL,
  `work2_to` varchar(7) DEFAULT NULL,
  `work2_status` varchar(20) DEFAULT NULL,
  `work2_company` varchar(30) DEFAULT NULL,
  `work2_location` varchar(30) DEFAULT NULL,
  `work2_job` varchar(30) DEFAULT NULL,
  `work3_from` varchar(7) DEFAULT NULL,
  `work3_to` varchar(7) DEFAULT NULL,
  `work3_status` varchar(20) DEFAULT NULL,
  `work3_company` varchar(30) DEFAULT NULL,
  `work3_location` varchar(30) DEFAULT NULL,
  `work3_job` varchar(30) DEFAULT NULL,
  `work4_from` varchar(7) DEFAULT NULL,
  `work4_to` varchar(7) DEFAULT NULL,
  `work4_status` varchar(20) DEFAULT NULL,
  `work4_company` varchar(30) DEFAULT NULL,
  `work4_location` varchar(30) DEFAULT NULL,
  `work4_job` varchar(30) DEFAULT NULL,
  `work5_from` varchar(7) DEFAULT NULL,
  `work5_to` varchar(7) DEFAULT NULL,
  `work5_status` varchar(20) DEFAULT NULL,
  `work5_company` varchar(30) DEFAULT NULL,
  `work5_location` varchar(30) DEFAULT NULL,
  `work5_job` varchar(30) DEFAULT NULL,
  `work_remarks` text,
  `emergency_kana` varchar(30) DEFAULT NULL,
  `emergency` varchar(30) DEFAULT NULL,
  `tel10` varchar(13) DEFAULT NULL,
  `tel11` varchar(13) DEFAULT NULL,
  `priority_tel` int(11) DEFAULT NULL,
  `post2` varchar(8) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `remarks` text,
  `alert_time` int(11) DEFAULT NULL,
  `alert_mail_0` text,
  `alert_mail_1` text,
  `alert_mail_2` text,
  `alert_mail_3` text,
  `alert_mail_4` text,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_seq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_seq`, `employee_id`, `employee_pw`, `employee_level`, `status`, `group_seq`, `kind`, `insurance`, `name_kana`, `name`, `sex`, `birthday`, `post`, `address_kana`, `address`, `tel1`, `tel2`, `answering`, `fax`, `email1`, `email2`, `priority_email`, `route`, `station`, `bus`, `bus_name`, `bus_stop`, `bank_kana`, `bank`, `branch_code`, `branch_kana`, `branch`, `account`, `education_from`, `education_to`, `school`, `graduate`, `recruit`, `work1_from`, `work1_to`, `work1_status`, `work1_company`, `work1_location`, `work1_job`, `work2_from`, `work2_to`, `work2_status`, `work2_company`, `work2_location`, `work2_job`, `work3_from`, `work3_to`, `work3_status`, `work3_company`, `work3_location`, `work3_job`, `work4_from`, `work4_to`, `work4_status`, `work4_company`, `work4_location`, `work4_job`, `work5_from`, `work5_to`, `work5_status`, `work5_company`, `work5_location`, `work5_job`, `work_remarks`, `emergency_kana`, `emergency`, `tel10`, `tel11`, `priority_tel`, `post2`, `address2`, `remarks`, `alert_time`, `alert_mail_0`, `alert_mail_1`, `alert_mail_2`, `alert_mail_3`, `alert_mail_4`, `create_date`, `user_seq`) VALUES
(0, '123', '456', 1, 1, 2, 1, 1, 'カナカナ', '氏名', 1, '1999-12-31', '111-2345', 'ジュウショ１ー1-a', '住所１ー1-a', '090-1111-2222', '09033334444', 2, '2', 'test@test.com', 'test2@test2.com', 1, '最寄りの路線', '最寄り駅', 1, 'バス路線', 'バス停の名前', 'コウザメイ', 'MIZUHO銀行', '987', 'ダイバ', '台場', '1234561', '2000-01', '2001-12', '学校の名前', '来年卒業予定', '応募の媒体', '2010-01', '2010-12', '正社員', 'オートコーポ', '中目黒', 'てらー', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '銀行の備考ABC', 'エマージェン', 'EMMA', '080-8888-7777', '070-7777-6666', 1, '987-9876', '緊急住所', '全体的な備考', 10, '', '', '', '', '', '2019-08-12 11:44:57', 16),
(16, '0010', '0010', 2, 0, 1, NULL, NULL, NULL, '管理者　社員', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test@mail.com', '', '', '', '', '2019-08-12 20:39:42', 0),
(17, '0011', '0011', 3, 0, 2, NULL, NULL, NULL, '一般　社員', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test@mail.com', '', '', '', '', '2019-08-12 20:40:23', 0),
(28, '0043', '0043', 99, 1, 1, 1, 1, 'ハケン', '派遣　1号', 1, '2000-12-12', '123-4567', 'ジュウショ', '住所', '090-4444-5555', '', 2, '2', 'test@test.com', '', 1, '', '', 2, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 30, NULL, NULL, NULL, NULL, NULL, '2019-08-12 22:11:47', 16);

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `group_seq` int(11) NOT NULL,
  `row_order` int(11) NOT NULL DEFAULT '999',
  `group_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`group_seq`, `row_order`, `group_name`) VALUES
(1, 1, '第１チーム'),
(2, 2, '第２チーム');

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE `information` (
  `info_seq` int(11) NOT NULL,
  `info_staff` text NOT NULL,
  `info_temp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `information`
--

INSERT INTO `information` (`info_seq`, `info_staff`, `info_temp`) VALUES
(1, 'test', 'testtest\r\ntest\r\ntest');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `job_seq` int(11) NOT NULL,
  `job_id` varchar(4) NOT NULL,
  `name` text NOT NULL,
  `client_seq` int(11) NOT NULL,
  `kind` int(11) NOT NULL,
  `pay_type` int(11) NOT NULL,
  `pay_unitcost` int(11) NOT NULL DEFAULT '0',
  `sales_unitcost` int(11) NOT NULL DEFAULT '0',
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`job_seq`, `job_id`, `name`, `client_seq`, `kind`, `pay_type`, `pay_unitcost`, `sales_unitcost`, `remarks`) VALUES
(1, '2', 'あんけん１', 1, 1, 1, 123, 456, '789'),
(3, '0004', 'あんけん１2丁目', 2, 2, 3, 123, 456, '789'),
(4, '0005', 'あんけん１2', 1, 1, 1, 123, 456, '789');

-- --------------------------------------------------------

--
-- Table structure for table `officer`
--

CREATE TABLE `officer` (
  `employee_seq` int(11) NOT NULL,
  `officer_seq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `officer`
--

INSERT INTO `officer` (`employee_seq`, `officer_seq`) VALUES
(14, 8),
(13, 7);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `sche_seq` int(11) NOT NULL,
  `user_seq` int(11) NOT NULL,
  `work_y` int(11) NOT NULL,
  `work_m` int(11) NOT NULL,
  `work_d` int(11) NOT NULL,
  `plan_leave_time` datetime DEFAULT NULL,
  `plan_start_time` datetime NOT NULL,
  `plan_end_time` datetime NOT NULL,
  `leave_time` datetime DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`sche_seq`, `user_seq`, `work_y`, `work_m`, `work_d`, `plan_leave_time`, `plan_start_time`, `plan_end_time`, `leave_time`, `start_time`, `end_time`) VALUES
(15, 8, 2019, 8, 1, '2019-08-01 10:41:00', '2019-08-01 11:11:00', '2019-08-01 12:12:00', NULL, NULL, NULL),
(17, 8, 2019, 8, 23, '2019-08-23 22:53:00', '2019-08-23 23:23:00', '2019-08-23 23:59:00', NULL, NULL, NULL),
(19, 8, 2019, 8, 11, '2019-08-11 10:41:00', '2019-08-11 11:11:00', '2019-08-11 12:12:00', '2019-08-11 05:36:35', '2019-08-11 16:08:31', NULL),
(20, 8, 2019, 8, 12, '2019-08-12 11:42:00', '2019-08-12 12:12:00', '2019-08-12 13:13:00', '2019-08-12 12:10:02', NULL, NULL),
(21, 8, 2019, 9, 1, '2019-09-01 08:51:00', '2019-09-01 09:21:00', '2019-09-01 12:22:00', NULL, NULL, NULL),
(22, 8, 2019, 9, 3, '2019-09-03 08:51:00', '2019-09-03 09:21:00', '2019-09-03 12:22:00', NULL, NULL, NULL),
(23, 8, 2019, 9, 4, '2019-09-04 08:51:00', '2019-09-04 09:21:00', '2019-09-04 12:22:00', NULL, NULL, NULL),
(24, 8, 2019, 9, 5, '2019-09-05 08:51:00', '2019-09-05 09:21:00', '2019-09-05 12:22:00', NULL, NULL, NULL),
(25, 8, 2019, 9, 6, '2019-09-06 08:51:00', '2019-09-06 09:21:00', '2019-09-06 12:22:00', NULL, NULL, NULL),
(26, 8, 2019, 9, 7, '2019-09-07 08:51:00', '2019-09-07 09:21:00', '2019-09-07 12:22:00', NULL, NULL, NULL),
(27, 8, 2019, 9, 8, '2019-09-08 08:51:00', '2019-09-08 09:21:00', '2019-09-08 12:22:00', NULL, NULL, NULL),
(28, 8, 2019, 9, 9, '2019-09-09 08:51:00', '2019-09-09 09:21:00', '2019-09-09 12:22:00', NULL, NULL, NULL),
(29, 8, 2019, 9, 10, '2019-09-10 08:51:00', '2019-09-10 09:21:00', '2019-09-10 12:22:00', NULL, NULL, NULL),
(30, 8, 2019, 9, 11, '2019-09-11 08:51:00', '2019-09-11 09:21:00', '2019-09-11 12:22:00', NULL, NULL, NULL),
(31, 8, 2019, 9, 12, '2019-09-12 08:51:00', '2019-09-12 09:21:00', '2019-09-12 12:22:00', NULL, NULL, NULL),
(32, 8, 2019, 9, 13, '2019-09-13 08:51:00', '2019-09-13 09:21:00', '2019-09-13 12:22:00', NULL, NULL, NULL),
(33, 8, 2019, 9, 14, '2019-09-14 08:51:00', '2019-09-14 09:21:00', '2019-09-14 12:22:00', NULL, NULL, NULL),
(34, 8, 2019, 9, 15, '2019-09-15 08:51:00', '2019-09-15 09:21:00', '2019-09-15 12:22:00', NULL, NULL, NULL),
(35, 8, 2019, 9, 16, '2019-09-16 08:51:00', '2019-09-16 09:21:00', '2019-09-16 12:22:00', NULL, NULL, NULL),
(36, 8, 2019, 9, 17, '2019-09-17 08:51:00', '2019-09-17 09:21:00', '2019-09-17 12:22:00', NULL, NULL, NULL),
(37, 8, 2019, 9, 18, '2019-09-18 08:51:00', '2019-09-18 09:21:00', '2019-09-18 12:22:00', NULL, NULL, NULL),
(38, 8, 2019, 9, 19, '2019-09-19 08:51:00', '2019-09-19 09:21:00', '2019-09-19 12:22:00', NULL, NULL, NULL),
(39, 8, 2019, 9, 20, '2019-09-20 08:51:00', '2019-09-20 09:21:00', '2019-09-20 12:22:00', NULL, NULL, NULL),
(40, 8, 2019, 9, 21, '2019-09-21 08:51:00', '2019-09-21 09:21:00', '2019-09-21 12:22:00', NULL, NULL, NULL),
(41, 8, 2019, 9, 22, '2019-09-22 08:51:00', '2019-09-22 09:21:00', '2019-09-22 12:22:00', NULL, NULL, NULL),
(42, 8, 2019, 9, 23, '2019-09-23 08:51:00', '2019-09-23 09:21:00', '2019-09-23 12:22:00', NULL, NULL, NULL),
(43, 8, 2019, 9, 24, '2019-09-24 08:51:00', '2019-09-24 09:21:00', '2019-09-24 12:22:00', NULL, NULL, NULL),
(44, 8, 2019, 9, 25, '2019-09-25 08:51:00', '2019-09-25 09:21:00', '2019-09-25 12:22:00', NULL, NULL, NULL),
(45, 8, 2019, 9, 26, '2019-09-26 08:51:00', '2019-09-26 09:21:00', '2019-09-26 12:22:00', NULL, NULL, NULL),
(46, 8, 2019, 9, 27, '2019-09-27 08:51:00', '2019-09-27 09:21:00', '2019-09-27 12:22:00', NULL, NULL, NULL),
(47, 8, 2019, 9, 28, '2019-09-28 08:51:00', '2019-09-28 09:21:00', '2019-09-28 12:22:00', NULL, NULL, NULL),
(48, 8, 2019, 9, 29, '2019-09-29 08:51:00', '2019-09-29 09:21:00', '2019-09-29 12:22:00', NULL, NULL, NULL),
(49, 8, 2019, 9, 30, '2019-09-30 08:51:00', '2019-09-30 09:21:00', '2019-09-30 12:22:00', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_seq`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_seq`),
  ADD UNIQUE KEY `employee_id` (`employee_id`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`group_seq`);

--
-- Indexes for table `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`info_seq`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`job_seq`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`sche_seq`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `group_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `information`
--
ALTER TABLE `information`
  MODIFY `info_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `job_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `sche_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
