-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 20, 2019 at 05:32 PM
-- Server version: 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `plc`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `alerting`
-- (See below for the actual view)
--
CREATE TABLE `alerting` (
`sche_seq` int(11)
,`user_seq` int(11)
,`work_y` int(11)
,`work_m` int(11)
,`work_d` int(11)
,`plan_leave_time` datetime
,`plan_start_time` datetime
,`plan_end_time` datetime
,`leave_time` datetime
,`start_time` datetime
,`end_time` datetime
,`job_seq` int(11)
,`client_seq` int(11)
,`alert_count` int(2)
,`name` varchar(30)
,`f_plt` varchar(10)
,`f_pst` varchar(10)
,`f_now` varchar(10)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `alertmail`
-- (See below for the actual view)
--
CREATE TABLE `alertmail` (
`mails` text
);

-- --------------------------------------------------------

--
-- Table structure for table `auth_work`
--

CREATE TABLE `auth_work` (
  `aw_seq` int(11) NOT NULL,
  `employee_seq` int(11) NOT NULL,
  `work_y` int(11) NOT NULL,
  `work_m` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `approver_seq` int(11) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_work`
--

INSERT INTO `auth_work` (`aw_seq`, `employee_seq`, `work_y`, `work_m`, `status`, `approver_seq`, `create_date`) VALUES
(25, 31, 2019, 8, 2, 30, '2019-08-14 09:18:40'),
(31, 29, 2019, 8, 2, 30, '2019-08-14 14:09:50'),
(32, 30, 2019, 8, 2, 0, '2019-08-16 09:49:05'),
(36, 29, 2019, 9, 2, 0, '2019-08-19 12:52:10'),
(37, 28, 2019, 8, 2, 0, '2019-08-19 17:37:39'),
(40, 28, 2019, 10, 2, 0, '2019-09-09 16:30:03'),
(42, 31, 2019, 10, 2, 0, '2019-09-12 10:37:40'),
(46, 31, 2019, 9, 2, 0, '2019-09-18 18:24:02'),
(47, 28, 2019, 9, 2, 0, '2019-09-19 08:59:27');

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
(2, 'client2', '', '', '', '', '', ''),
(3, 'testClient', '', '', '', '', '', '');

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
(61, 19);

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
  `pay_type` int(11) DEFAULT NULL,
  `pay_unitcost` int(11) DEFAULT NULL,
  `sales_unitcost` int(11) DEFAULT NULL,
  `transport_unitcosts` int(11) DEFAULT NULL,
  `pass_cost` int(11) DEFAULT NULL,
  `alert_mail_0` varchar(50) DEFAULT NULL,
  `alert_mail_1` varchar(50) DEFAULT NULL,
  `alert_mail_2` varchar(50) DEFAULT NULL,
  `alert_mail_3` varchar(50) DEFAULT NULL,
  `alert_mail_4` varchar(50) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_seq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_seq`, `employee_id`, `employee_pw`, `employee_level`, `status`, `group_seq`, `kind`, `insurance`, `name_kana`, `name`, `sex`, `birthday`, `post`, `address_kana`, `address`, `tel1`, `tel2`, `answering`, `fax`, `email1`, `email2`, `priority_email`, `route`, `station`, `bus`, `bus_name`, `bus_stop`, `bank_kana`, `bank`, `branch_code`, `branch_kana`, `branch`, `account`, `education_from`, `education_to`, `school`, `graduate`, `recruit`, `work1_from`, `work1_to`, `work1_status`, `work1_company`, `work1_location`, `work1_job`, `work2_from`, `work2_to`, `work2_status`, `work2_company`, `work2_location`, `work2_job`, `work3_from`, `work3_to`, `work3_status`, `work3_company`, `work3_location`, `work3_job`, `work4_from`, `work4_to`, `work4_status`, `work4_company`, `work4_location`, `work4_job`, `work5_from`, `work5_to`, `work5_status`, `work5_company`, `work5_location`, `work5_job`, `work_remarks`, `emergency_kana`, `emergency`, `tel10`, `tel11`, `priority_tel`, `post2`, `address2`, `remarks`, `alert_time`, `pay_type`, `pay_unitcost`, `sales_unitcost`, `transport_unitcosts`, `pass_cost`, `alert_mail_0`, `alert_mail_1`, `alert_mail_2`, `alert_mail_3`, `alert_mail_4`, `create_date`, `user_seq`) VALUES
(0, '123', '456', 1, 1, 2, 1, 1, 'カナカナ', '氏名', 1, '1999-12-31', '111-2345', 'ジュウショ１ー1-a', '住所１ー1-a', '090-1111-2222', '09033334444', 2, '2', 'test@test.com', 'test2@test2.com', 1, '最寄りの路線', '最寄り駅', 1, 'バス路線', 'バス停の名前', 'コウザメイ', 'MIZUHO銀行', '987', 'ダイバ', '台場', '1234561', '2000-01', '2001-12', '学校の名前', '来年卒業予定', '応募の媒体', '2010-01', '2010-12', '正社員', 'オートコーポ', '中目黒', 'てらー', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '銀行の備考ABC', 'エマージェン', 'EMMA', '080-8888-7777', '070-7777-6666', 1, '987-9876', '緊急住所', '全体的な備考', 10, NULL, NULL, NULL, NULL, NULL, 'yamazaki.utg@gmail.com', '', '', '', '', '2019-08-12 11:44:57', 16),
(16, '0010', '0010', 3, 0, 1, NULL, NULL, NULL, '管理者　社員', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'yamazaki.utg@gmail.com', 'yamazaki.utg+1@gmail.com', '', '', '', '2019-08-12 20:39:42', 0),
(17, '0011', '0011', 3, 0, 1, NULL, NULL, NULL, '一般　社員', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'yamazaki.utg@gmail.com', '', '', '', '', '2019-08-12 20:40:23', 0),
(28, '0050', '0043', 99, 1, 1, 9, 1, 'ハケン', 'John　Smith', 1, '2000-12-12', '123-4567', 'ジュウショ', '住所', '090-4444-5555', '', 2, '2', 'test@test.com', '', 1, '', '', 2, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 30, 1, 100, 200, 300, 400, NULL, NULL, NULL, NULL, NULL, '2019-08-12 22:11:47', 0),
(29, '0044', '0044', 99, 1, 2, 2, 1, 'テスト　ユーザ', '時給　太郎', 1, '1990-12-31', '111-2345', '', '', '090-9999-8888', '', 2, '2', 'test@mail.com', '', 1, '京急', '大井町', 2, '日鉄', '大盛', 'ギンコ', 'みずほ', '123', 'ホンテン', '本店', '7776653', '', '', '', '', '', '2000-04', '2001-03', '正社員', 'ABC株', '台場', '歩く', '2001-04', '2002-03', '正社員', 'XZCorp', '中目黒', '走る', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'キンキュー', '緊急　四郎', '090-4444-5555', '080-8888-8777', 2, '333-4444', '東京都西東京', '', 30, 1, 1000, 1300, 1000, 14000, NULL, NULL, NULL, NULL, NULL, '2019-08-13 16:48:16', 0),
(30, '0045', '0045', 99, 1, 2, 1, 1, 'テスト　ユーザ', '日給　二郎', 1, '1990-11-29', '111-2345', 'トウキョウト　ミナトク　ダイバ　２ー４ー８', '東京都港区台場２丁目４−８', '090-1111-2222', '', 2, '2', 'test@test.com', '', 1, '', '', 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 50, 2, 10000, 12000, 1000, 14000, NULL, NULL, NULL, NULL, NULL, '2019-08-14 08:54:38', 0),
(31, '0046', '0046', 99, 1, 2, 1, 1, 'テスト　ユーザ', '月給　三郎', 1, '1990-12-31', '111-2345', 'トウキョウト　ミナトク　ダイバ　２ー４ー８', '東京都港区台場２丁目４−８', '090-1111-2222', '', 2, '2', 'test@test.com', '', 1, '', '', 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 20, 3, 150000, 200000, 1500, 20000, NULL, NULL, NULL, NULL, NULL, '2019-08-14 08:55:14', 0),
(32, '0001', '0047', 3, 0, 1, NULL, NULL, NULL, 'テストテスト', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'yamazaki.utg@gmail.com', '', '', '', '', '2019-08-19 10:50:56', 0),
(34, '0014', '0014', 3, 0, 1, NULL, NULL, NULL, 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'yamazaki.utg@gmail.com', '', '', '', '', '2019-08-19 11:42:51', 0),
(41, '0054', '0052', 3, 0, 2, NULL, NULL, NULL, 'aaaz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'yamazaki.utg@gmail.com', '', '', '', '', '2019-08-29 18:24:59', 0),
(42, '0055', '0055', 3, 0, 2, NULL, NULL, '', 'ああa', 1, '', '', '', '', '', '', 2, '2', '', '', 1, 'a', 'b', 1, 'c', 'd', 'カナ', 'e', '999', 'カナカナ', 'f', '9876543', '2019-09', '2019-10', 'ee', 'ff', 'ggg', '2019-02', '2019-03', 'aa', 'bb', 'cc', 'dd', '', '', 'ee', 'ff', 'hh', 'ii', '', '', 'jj', 'kk', 'll', 'mm', '', '', 'nn', 'opo', 'pp', 'qq', '', '', 'rr', 'ss', 'tt', 'uu', 'vvv', 'キンキュウ', 'ww', '030-333-3333', '040-444-4444', 1, '111-2222', 'xxx', 'yyyy', NULL, 1, 1000, 2000, 3000, 4000, 'yamazaki.utg@gmail.com', '', '', '', '', '2019-08-29 18:31:00', 0),
(45, '0061', '0061', 3, 0, 1, NULL, NULL, '', 'shainnnnn', 1, '', '', '', '', '', '', 2, '2', '', '', 1, '', '', 2, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'yamazaki.utg@gmail.com', '', '', '', '', '2019-09-19 09:10:16', 0);

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
(2, 2, '第２チーム'),
(4, 99, '第3チーム'),
(5, 99, 'アイウエオアイウエオアイウエオアイウエオ'),
(6, 99, '第５グルー');

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
(1, 'test', '今月は遅刻ゼロを頑張る月間です\r\n余裕を持って出掛けましょう');

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
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`job_seq`, `job_id`, `name`, `client_seq`, `kind`, `remarks`) VALUES
(1, '2', 'あんけん１', 1, 1, '789'),
(6, '0019', 'テストジョブ', 3, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE `login_history` (
  `login_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `login_id` text NOT NULL,
  `login_pw` text NOT NULL,
  `login_result` int(1) NOT NULL,
  `login_addr` varchar(20) NOT NULL,
  `login_referer` text NOT NULL,
  `login_agent` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_history`
--

INSERT INTO `login_history` (`login_date`, `login_id`, `login_pw`, `login_result`, `login_addr`, `login_referer`, `login_agent`) VALUES
('2019-08-23 16:51:53', '0044', '0044', 0, '::1', 'http://localhost/plc/index.php', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1'),
('2019-08-23 16:52:46', '0044', '0044', 0, '::1', 'http://localhost/plc/index.php', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1'),
('2019-08-23 16:54:28', '0044', '0044', 0, '::1', 'http://localhost/plc/index.php', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1'),
('2019-08-23 17:27:21', '123', '456', 0, '::1', 'http://localhost/plc/index.php', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36'),
('2019-08-23 18:12:55', '0044', '0044', 0, '::1', 'http://localhost/plc/index.php', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1'),
('2019-08-23 18:20:09', '123', '456', 0, '::1', 'http://localhost/plc/index.php', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36'),
('2019-08-27 11:44:48', '123', '456', 0, '::1', 'http://localhost/plc/', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36'),
('2019-08-28 12:51:52', '123', '456', 0, '::1', 'http://localhost/plc/', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36'),
('2019-08-28 13:22:33', '123', '456', 0, '::1', 'http://localhost/plc/', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36'),
('2019-08-29 17:44:57', '123', '456', 0, '::1', 'http://localhost/plc/', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36'),
('2019-09-02 16:58:20', '123', '456', 0, '::1', 'http://localhost/plc/', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36'),
('2019-09-02 17:14:56', '123', '456', 0, '::1', 'http://localhost/plc/', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36'),
('2019-09-02 17:35:12', '0044', '0044', 0, '::1', 'http://localhost/plc/', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36'),
('2019-09-03 17:40:35', '123', '456', 0, '::1', 'http://localhost/plc/', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36'),
('2019-09-05 11:32:07', '123', '456', 0, '::1', 'http://localhost/plc/', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36'),
('2019-09-09 16:26:25', '123', '456', 0, '::1', 'http://localhost/plc/', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36'),
('2019-09-09 16:58:34', '123', '456', 0, '::1', 'http://localhost/plc/', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36'),
('2019-09-10 08:47:24', '123', '456', 0, '::1', 'http://localhost/plc/', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36'),
('2019-09-10 08:58:09', '123', '456', 0, '::1', 'http://localhost/plc/', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36'),
('2019-09-10 09:04:16', '123', '456', 1, '::1', 'http://localhost/plc/index.php', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36'),
('2019-09-10 09:04:19', '123', '1234', 0, '::1', 'http://localhost/plc/index.php', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36'),
('2019-09-12 10:34:15', '123', '456', 0, '::1', 'http://localhost/plc/', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36'),
('2019-09-12 10:34:30', '0046', '0046', 0, '::1', 'http://localhost/plc/index.php', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36'),
('2019-09-12 10:39:27', '123', '456', 0, '::1', 'http://localhost/plc/index.php', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36'),
('2019-09-12 10:40:06', '0050', '0050', 1, '::1', 'http://localhost/plc/index.php', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36'),
('2019-09-12 10:40:21', '0050', '0043', 0, '::1', 'http://localhost/plc/index.php', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1'),
('2019-09-12 17:03:21', '123', '456', 0, '::1', 'http://localhost/plc/', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36'),
('2019-09-18 14:55:24', '123', '456', 0, '::1', 'http://localhost/plc/', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36'),
('2019-09-18 16:07:57', '123', '456', 0, '::1', 'http://localhost/plc/', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36'),
('2019-09-19 15:13:45', '123', '456', 0, '::1', 'http://localhost/plc/', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36');

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
(13, 7),
(17, 28),
(17, 29);

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
  `end_time` datetime DEFAULT NULL,
  `job_seq` int(11) NOT NULL,
  `client_seq` int(11) NOT NULL,
  `alert_count` int(2) NOT NULL DEFAULT '0',
  `cover_user_seq` int(11) NOT NULL DEFAULT '0',
  `cover_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`sche_seq`, `user_seq`, `work_y`, `work_m`, `work_d`, `plan_leave_time`, `plan_start_time`, `plan_end_time`, `leave_time`, `start_time`, `end_time`, `job_seq`, `client_seq`, `alert_count`, `cover_user_seq`, `cover_time`) VALUES
(69, 28, 2019, 9, 1, '2019-09-01 10:41:00', '2019-09-01 11:11:00', '2019-09-01 12:12:00', NULL, NULL, NULL, 1, 1, 0, 0, NULL),
(103, 29, 2019, 8, 1, '2019-08-01 08:30:00', '2019-08-01 09:00:00', '2019-08-01 15:00:00', NULL, NULL, NULL, 3, 2, 0, 0, NULL),
(104, 29, 2019, 8, 2, '2019-08-02 08:30:00', '2019-08-02 09:00:00', '2019-08-02 15:00:00', NULL, NULL, NULL, 3, 2, 0, 0, NULL),
(105, 29, 2019, 8, 3, '2019-08-03 08:30:00', '2019-08-03 09:00:00', '2019-08-03 15:00:00', NULL, NULL, NULL, 3, 2, 0, 0, NULL),
(106, 29, 2019, 8, 4, '2019-08-04 08:30:00', '2019-08-04 09:00:00', '2019-08-04 15:00:00', NULL, NULL, NULL, 3, 2, 0, 0, NULL),
(107, 29, 2019, 8, 5, '2019-08-05 08:30:00', '2019-08-05 09:00:00', '2019-08-05 15:00:00', NULL, NULL, NULL, 3, 2, 0, 0, NULL),
(108, 29, 2019, 8, 6, '2019-08-06 08:30:00', '2019-08-06 09:00:00', '2019-08-06 15:00:00', NULL, NULL, NULL, 3, 2, 0, 0, NULL),
(109, 29, 2019, 8, 7, '2019-08-07 08:30:00', '2019-08-07 09:00:00', '2019-08-07 15:00:00', NULL, NULL, NULL, 3, 2, 0, 0, NULL),
(110, 29, 2019, 8, 8, '2019-08-08 08:30:00', '2019-08-08 09:00:00', '2019-08-08 15:00:00', NULL, NULL, NULL, 3, 2, 0, 0, NULL),
(111, 29, 2019, 8, 9, '2019-08-09 08:30:00', '2019-08-09 09:00:00', '2019-08-09 15:00:00', NULL, NULL, NULL, 3, 2, 0, 0, NULL),
(112, 29, 2019, 8, 10, '2019-08-10 08:30:00', '2019-08-10 09:00:00', '2019-08-10 15:00:00', NULL, NULL, NULL, 3, 2, 0, 0, NULL),
(113, 29, 2019, 8, 11, '2019-08-11 08:30:00', '2019-08-11 09:00:00', '2019-08-11 15:00:00', NULL, NULL, NULL, 3, 2, 0, 0, NULL),
(114, 29, 2019, 8, 12, '2019-08-12 08:30:00', '2019-08-12 09:00:00', '2019-08-12 15:00:00', NULL, NULL, NULL, 3, 2, 0, 0, NULL),
(115, 29, 2019, 8, 13, '2019-08-13 08:30:00', '2019-08-13 09:00:00', '2019-08-13 15:30:00', '2019-08-13 08:25:30', '2019-08-13 08:55:33', '2019-08-13 14:55:35', 3, 2, 0, 0, NULL),
(116, 29, 2019, 8, 14, '2019-08-14 08:30:00', '2019-08-14 09:00:00', '2019-08-14 15:00:00', '2019-08-14 08:00:00', '2019-08-14 08:50:00', '2019-08-14 16:00:00', 3, 2, 0, 0, NULL),
(117, 29, 2019, 8, 15, '2019-08-15 08:30:00', '2019-08-15 09:00:00', '2019-08-15 15:00:00', NULL, NULL, NULL, 3, 2, 0, 0, NULL),
(118, 29, 2019, 8, 16, '2019-08-16 08:30:00', '2019-08-16 09:00:00', '2019-08-16 15:00:00', NULL, NULL, NULL, 3, 2, 0, 0, NULL),
(119, 29, 2019, 8, 17, '2019-08-17 08:30:00', '2019-08-17 09:00:00', '2019-08-17 15:00:00', NULL, NULL, NULL, 3, 2, 0, 0, NULL),
(120, 29, 2019, 8, 18, '2019-08-18 08:30:00', '2019-08-18 09:00:00', '2019-08-18 15:00:00', NULL, NULL, NULL, 3, 2, 0, 0, NULL),
(121, 29, 2019, 8, 19, '2019-08-19 08:30:00', '2019-08-19 09:00:00', '2019-08-19 15:00:00', NULL, NULL, NULL, 3, 2, 0, 0, NULL),
(122, 29, 2019, 8, 20, '2019-08-20 08:30:00', '2019-08-20 09:00:00', '2019-08-20 15:00:00', NULL, NULL, NULL, 3, 2, 0, 0, NULL),
(123, 29, 2019, 8, 21, '2019-08-21 08:30:00', '2019-08-21 09:00:00', '2019-08-21 15:00:00', NULL, NULL, NULL, 3, 2, 0, 0, NULL),
(124, 29, 2019, 8, 22, '2019-08-22 14:00:00', '2019-08-22 16:20:00', '2019-08-22 15:00:00', '2019-08-22 15:00:00', NULL, NULL, 3, 2, 3, 0, NULL),
(125, 29, 2019, 8, 23, '2019-08-23 08:30:00', '2019-08-23 09:00:00', '2019-08-23 15:00:00', '2019-08-23 15:39:13', NULL, NULL, 3, 2, 0, 0, NULL),
(126, 29, 2019, 8, 24, '2019-08-24 08:30:00', '2019-08-24 09:00:00', '2019-08-24 15:00:00', NULL, NULL, NULL, 3, 2, 0, 0, NULL),
(127, 29, 2019, 8, 25, '2019-08-25 08:30:00', '2019-08-25 09:00:00', '2019-08-25 15:00:00', NULL, NULL, NULL, 3, 2, 0, 0, NULL),
(128, 29, 2019, 8, 26, '2019-08-26 08:30:00', '2019-08-26 09:00:00', '2019-08-26 15:00:00', NULL, NULL, NULL, 3, 2, 0, 0, NULL),
(129, 29, 2019, 8, 27, '2019-08-27 08:30:00', '2019-08-27 09:00:00', '2019-08-27 15:00:00', NULL, NULL, NULL, 3, 2, 0, 0, NULL),
(130, 29, 2019, 8, 28, '2019-08-28 08:30:00', '2019-08-28 09:00:00', '2019-08-28 15:00:00', NULL, NULL, NULL, 3, 2, 0, 0, NULL),
(131, 29, 2019, 8, 29, '2019-08-29 08:30:00', '2019-08-29 09:00:00', '2019-08-29 15:00:00', NULL, NULL, NULL, 3, 2, 0, 0, NULL),
(132, 29, 2019, 8, 30, '2019-08-30 08:30:00', '2019-08-30 09:00:00', '2019-08-30 15:00:00', NULL, NULL, NULL, 3, 2, 0, 0, NULL),
(133, 29, 2019, 8, 31, '2019-08-31 08:30:00', '2019-08-31 09:00:00', '2019-08-31 15:00:00', NULL, NULL, NULL, 3, 2, 0, 0, NULL),
(134, 30, 2019, 8, 14, '2019-08-14 08:10:00', '2019-08-14 09:00:00', '2019-08-14 12:00:00', '2019-08-14 08:02:23', '2019-08-14 09:00:00', '2019-08-14 11:11:11', 3, 2, 0, 0, NULL),
(135, 30, 2019, 8, 15, '2019-08-15 08:10:00', '2019-08-15 09:00:00', '2019-08-15 12:00:00', NULL, NULL, NULL, 3, 2, 0, 0, NULL),
(136, 30, 2019, 8, 9, '2019-08-09 08:10:00', '2019-08-09 09:00:00', '2019-08-09 12:00:00', '2019-08-09 08:00:00', '2019-08-09 09:00:00', '2019-08-09 12:00:00', 3, 2, 0, 0, NULL),
(137, 31, 2019, 8, 9, '2019-08-09 08:50:00', '2019-08-09 09:00:00', '2019-08-09 10:00:00', '2019-08-09 08:00:00', '2019-08-09 08:50:00', '2019-08-09 10:05:00', 3, 1, 0, 0, NULL),
(138, 31, 2019, 8, 10, '2019-08-10 08:50:00', '2019-08-10 09:00:00', '2019-08-10 10:00:00', '2019-08-10 08:00:00', '2019-08-10 08:50:00', '2019-08-10 11:00:00', 3, 1, 0, 0, NULL),
(139, 30, 2019, 8, 16, '2019-08-16 08:10:00', '2019-08-16 18:00:00', '2019-08-16 20:00:00', NULL, NULL, NULL, 3, 2, 0, 0, NULL),
(143, 29, 2019, 9, 1, '2019-09-01 08:30:00', '2019-09-01 09:00:00', '2019-09-01 12:00:00', NULL, NULL, NULL, 6, 3, 0, 0, NULL),
(144, 28, 2019, 8, 1, '2019-08-01 08:30:00', '2019-08-01 09:00:00', '2019-08-01 12:00:00', NULL, NULL, NULL, 6, 3, 0, 0, NULL),
(145, 28, 2019, 9, 2, '2019-09-02 09:30:00', '2019-09-02 10:00:00', '2019-09-02 12:00:00', NULL, NULL, NULL, 1, 1, 0, 0, NULL),
(146, 31, 2019, 9, 1, '2019-09-01 09:40:00', '2019-09-01 10:00:00', '2019-09-01 12:00:00', NULL, NULL, NULL, 6, 3, 0, 0, NULL),
(147, 28, 2019, 10, 6, '2019-10-06 08:30:00', '2019-10-06 09:00:00', '2019-10-06 10:00:00', NULL, NULL, NULL, 6, 3, 0, 0, NULL),
(148, 28, 2019, 10, 7, '2019-10-07 10:30:00', '2019-10-07 11:00:00', '2019-10-07 12:00:00', NULL, NULL, NULL, 6, 3, 0, 0, NULL),
(149, 28, 2019, 10, 8, '2019-10-08 12:30:00', '2019-10-08 13:00:00', '2019-10-08 14:00:00', NULL, NULL, NULL, 6, 3, 0, 0, NULL),
(150, 31, 2019, 10, 5, '2019-10-05 09:52:00', '2019-10-05 10:12:00', '2019-10-05 12:12:00', NULL, NULL, NULL, 6, 3, 0, 0, NULL),
(151, 28, 2019, 9, 12, '2019-09-12 18:30:00', '2019-09-12 19:00:00', '2019-09-12 21:00:00', '2019-09-12 10:40:32', NULL, NULL, 1, 1, 0, 0, NULL),
(152, 28, 2019, 9, 18, '2019-09-18 16:30:00', '2019-09-18 17:00:00', '2019-09-18 23:30:00', '2019-09-18 12:12:00', NULL, NULL, 1, 1, 0, 0, '2019-09-18 18:31:29'),
(153, 31, 2019, 9, 18, '2019-09-18 12:13:00', '2019-09-18 15:00:00', '2019-09-18 20:00:00', '2019-09-18 14:59:00', NULL, NULL, 6, 3, 0, 0, '2019-09-18 18:29:02'),
(154, 28, 2019, 9, 19, '2019-09-19 08:30:00', '2019-09-19 09:00:00', '2019-09-19 12:00:00', NULL, NULL, NULL, 1, 1, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `alert_mail_0` varchar(50) NOT NULL,
  `from_mail` varchar(50) NOT NULL,
  `mail_title` varchar(30) NOT NULL,
  `mail_body1` text NOT NULL,
  `mail_body2` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`alert_mail_0`, `from_mail`, `mail_title`, `mail_body1`, `mail_body2`) VALUES
('yamazaki.utg@gmail.com', 'xxx@test.com', '出発確認アラート2', '出発報告が確認出来ていません。\r\nただちに出発報告を行ってください。\r\n※このアラートは全社員宛にメールで通知されています。\r\n', '何かあった場合は担当営業に報告連絡してください。\r\nまた、担当営業が不通の場合は03-5829-9042まで連絡をお願い致します。');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_employeecost`
-- (See below for the actual view)
--
CREATE TABLE `v_employeecost` (
`user_seq` int(11)
,`work_y` int(11)
,`work_m` int(11)
,`group_seq` int(11)
,`group_name` varchar(20)
,`client_seq` int(11)
,`client_name` text
,`name` varchar(30)
,`work_day` bigint(21)
,`worktime` decimal(42,0)
,`pay_unitcost` int(11)
,`sales_unitcost` int(11)
,`transport_unitcosts` int(11)
,`pass_cost` int(11)
,`payType` varchar(2)
,`totalPay` decimal(52,0)
,`totalSales` decimal(52,0)
,`totalTrnsCost` bigint(31)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_mails`
-- (See below for the actual view)
--
CREATE TABLE `v_mails` (
`alert_mail` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_schedule`
-- (See below for the actual view)
--
CREATE TABLE `v_schedule` (
`sche_seq` int(11)
,`user_seq` int(11)
,`work_y` int(11)
,`work_m` int(11)
,`work_d` int(11)
,`plan_leave_time` datetime
,`plan_start_time` datetime
,`plan_end_time` datetime
,`leave_time` datetime
,`start_time` datetime
,`end_time` datetime
,`job_seq` int(11)
,`client_seq` int(11)
,`alert_count` int(2)
,`cover_user_seq` int(11)
,`cover_time` datetime
,`name` varchar(30)
,`employee_id` varchar(4)
,`worked` int(1)
,`noleave` int(1)
,`nogoing` int(1)
,`delayed` int(1)
,`lated` int(1)
,`leftearly` int(1)
,`covered` int(1)
);

-- --------------------------------------------------------

--
-- Structure for view `alerting`
--
DROP TABLE IF EXISTS `alerting`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `alerting`  AS  select `s`.`sche_seq` AS `sche_seq`,`s`.`user_seq` AS `user_seq`,`s`.`work_y` AS `work_y`,`s`.`work_m` AS `work_m`,`s`.`work_d` AS `work_d`,`s`.`plan_leave_time` AS `plan_leave_time`,`s`.`plan_start_time` AS `plan_start_time`,`s`.`plan_end_time` AS `plan_end_time`,`s`.`leave_time` AS `leave_time`,`s`.`start_time` AS `start_time`,`s`.`end_time` AS `end_time`,`s`.`job_seq` AS `job_seq`,`s`.`client_seq` AS `client_seq`,`s`.`alert_count` AS `alert_count`,`e`.`name` AS `name`,date_format(`s`.`plan_leave_time`,'%H:%i') AS `f_plt`,date_format(`s`.`plan_start_time`,'%H:%i') AS `f_pst`,date_format(now(),'%H:%i') AS `f_now` from (`schedule` `s` join `employee` `e` on((`s`.`user_seq` = `e`.`employee_seq`))) where ((date_format(`s`.`plan_leave_time`,'%m%d') = date_format(now(),'%m%d')) and isnull(`s`.`leave_time`) and ((date_format(`s`.`plan_start_time`,'%H%i') > date_format(now(),'%H%i')) or (`s`.`alert_count` < 5)) and (date_format(`s`.`plan_leave_time`,'%H%i') <= date_format(now(),'%H%i'))) ;

-- --------------------------------------------------------

--
-- Structure for view `alertmail`
--
DROP TABLE IF EXISTS `alertmail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `alertmail`  AS  select group_concat(`x`.`alert_mail` separator ',') AS `mails` from (select `employee`.`alert_mail_0` AS `alert_mail` from `employee` where ((`employee`.`employee_level` = 2) or (`employee`.`employee_level` = 3)) union select `employee`.`alert_mail_1` AS `alert_mail` from `employee` where ((`employee`.`employee_level` = 2) or (`employee`.`employee_level` = 3)) union select `employee`.`alert_mail_2` AS `alert_mail` from `employee` where ((`employee`.`employee_level` = 2) or (`employee`.`employee_level` = 3)) union select `employee`.`alert_mail_3` AS `alert_mail` from `employee` where ((`employee`.`employee_level` = 2) or (`employee`.`employee_level` = 3)) union select `employee`.`alert_mail_4` AS `alert_mail` from `employee` where ((`employee`.`employee_level` = 2) or (`employee`.`employee_level` = 3))) `x` ;

-- --------------------------------------------------------

--
-- Structure for view `v_employeecost`
--
DROP TABLE IF EXISTS `v_employeecost`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_employeecost`  AS  select `ec`.`user_seq` AS `user_seq`,`ec`.`work_y` AS `work_y`,`ec`.`work_m` AS `work_m`,`ec`.`group_seq` AS `group_seq`,`g`.`group_name` AS `group_name`,`ec`.`client_seq` AS `client_seq`,`c`.`name` AS `client_name`,`ec`.`name` AS `name`,`ec`.`work_day` AS `work_day`,`ec`.`worktime` AS `worktime`,`ec`.`pay_unitcost` AS `pay_unitcost`,`ec`.`sales_unitcost` AS `sales_unitcost`,`ec`.`transport_unitcosts` AS `transport_unitcosts`,`ec`.`pass_cost` AS `pass_cost`,(case when (`ec`.`pay_type` = 3) then '月給' when (`ec`.`pay_type` = 2) then '日給' else '時給' end) AS `payType`,(case when (`ec`.`pay_type` = 3) then `ec`.`pay_unitcost` when (`ec`.`pay_type` = 2) then (`ec`.`pay_unitcost` * `ec`.`work_day`) else truncate(((`ec`.`pay_unitcost` * `ec`.`worktime`) / 60),0) end) AS `totalPay`,(case when (`ec`.`pay_type` = 3) then `ec`.`sales_unitcost` when (`ec`.`pay_type` = 2) then (`ec`.`sales_unitcost` * `ec`.`work_day`) else truncate(((`ec`.`sales_unitcost` * `ec`.`worktime`) / 60),0) end) AS `totalSales`,(case when (`ec`.`work_day` > 15) then `ec`.`pass_cost` else truncate((`ec`.`transport_unitcosts` * `ec`.`work_day`),0) end) AS `totalTrnsCost` from ((((select `s`.`user_seq` AS `user_seq`,`s`.`work_y` AS `work_y`,`s`.`work_m` AS `work_m`,`s`.`client_seq` AS `client_seq`,sum(timestampdiff(MINUTE,`s`.`plan_start_time`,`s`.`plan_end_time`)) AS `worktime`,count(`s`.`sche_seq`) AS `work_day`,`e`.`group_seq` AS `group_seq`,`e`.`sales_unitcost` AS `sales_unitcost`,`e`.`name` AS `name`,`e`.`pay_unitcost` AS `pay_unitcost`,`e`.`pay_type` AS `pay_type`,`e`.`transport_unitcosts` AS `transport_unitcosts`,`e`.`pass_cost` AS `pass_cost` from (`schedule` `s` join `employee` `e` on((`s`.`user_seq` = `e`.`employee_seq`))) where (`s`.`leave_time` is not null) group by `s`.`user_seq`,`s`.`work_y`,`s`.`work_m`,`s`.`client_seq`)) `ec` left join `client` `c` on((`ec`.`client_seq` = `c`.`client_seq`))) left join `group` `g` on((`ec`.`group_seq` = `g`.`group_seq`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v_mails`
--
DROP TABLE IF EXISTS `v_mails`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_mails`  AS  select `employee`.`alert_mail_0` AS `alert_mail` from `employee` where ((`employee`.`employee_level` = 2) or (`employee`.`employee_level` = 3)) union select `employee`.`alert_mail_1` AS `alert_mail` from `employee` where ((`employee`.`employee_level` = 2) or (`employee`.`employee_level` = 3)) union select `employee`.`alert_mail_2` AS `alert_mail` from `employee` where ((`employee`.`employee_level` = 2) or (`employee`.`employee_level` = 3)) union select `employee`.`alert_mail_3` AS `alert_mail` from `employee` where ((`employee`.`employee_level` = 2) or (`employee`.`employee_level` = 3)) union select `employee`.`alert_mail_4` AS `alert_mail` from `employee` where ((`employee`.`employee_level` = 2) or (`employee`.`employee_level` = 3)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_schedule`
--
DROP TABLE IF EXISTS `v_schedule`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_schedule`  AS  select `s`.`sche_seq` AS `sche_seq`,`s`.`user_seq` AS `user_seq`,`s`.`work_y` AS `work_y`,`s`.`work_m` AS `work_m`,`s`.`work_d` AS `work_d`,`s`.`plan_leave_time` AS `plan_leave_time`,`s`.`plan_start_time` AS `plan_start_time`,`s`.`plan_end_time` AS `plan_end_time`,`s`.`leave_time` AS `leave_time`,`s`.`start_time` AS `start_time`,`s`.`end_time` AS `end_time`,`s`.`job_seq` AS `job_seq`,`s`.`client_seq` AS `client_seq`,`s`.`alert_count` AS `alert_count`,`s`.`cover_user_seq` AS `cover_user_seq`,`s`.`cover_time` AS `cover_time`,`e`.`name` AS `name`,`e`.`employee_id` AS `employee_id`,(case when (`s`.`end_time` is not null) then 1 else 0 end) AS `worked`,(case when ((`s`.`leave_time` is not null) and isnull(`s`.`start_time`)) then 1 else 0 end) AS `noleave`,(case when ((`s`.`start_time` is not null) and isnull(`s`.`end_time`)) then 1 else 0 end) AS `nogoing`,(case when (`s`.`plan_leave_time` < `s`.`leave_time`) then 1 else 0 end) AS `delayed`,(case when (`s`.`plan_start_time` < `s`.`start_time`) then 1 else 0 end) AS `lated`,(case when (`s`.`plan_end_time` > `s`.`end_time`) then 1 else 0 end) AS `leftearly`,(case when (`s`.`cover_time` is not null) then 1 else 0 end) AS `covered` from (`schedule` `s` left join `employee` `e` on((`s`.`user_seq` = `e`.`employee_seq`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_work`
--
ALTER TABLE `auth_work`
  ADD PRIMARY KEY (`aw_seq`);

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
-- AUTO_INCREMENT for table `auth_work`
--
ALTER TABLE `auth_work`
  MODIFY `aw_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `group_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `information`
--
ALTER TABLE `information`
  MODIFY `info_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `job_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `sche_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;
