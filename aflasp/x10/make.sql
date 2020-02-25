-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2020 年 2 月 25 日 18:15
-- サーバのバージョン： 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `asp`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `access`
--

CREATE TABLE `access` (
  `shadow_id` int(11) NOT NULL,
  `delete_key` tinyint(1) DEFAULT NULL,
  `id` char(32) DEFAULT NULL,
  `ipaddress` varchar(16) DEFAULT NULL,
  `cookie` varchar(32) DEFAULT NULL,
  `adwares_type` char(32) DEFAULT NULL,
  `adwares` char(8) DEFAULT NULL,
  `cuser` char(8) DEFAULT NULL,
  `owner` char(8) DEFAULT NULL,
  `useragent` text,
  `referer` text,
  `state` int(11) DEFAULT NULL,
  `utn` varchar(128) DEFAULT NULL,
  `regist` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

--
-- テーブルのデータのダンプ `access`
--

INSERT INTO `access` (`shadow_id`, `delete_key`, `id`, `ipaddress`, `cookie`, `adwares_type`, `adwares`, `cuser`, `owner`, `useragent`, `referer`, `state`, `utn`, `regist`) VALUES
(1, 0, '1ef1ff9358ce1cb3e9cba7cd59cf8a3e', '::1', 'aa77bad97e845090a4f1de2a7ce13897', 'adwares', 'A0000001', 'C0000001', 'N0000001', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'http://localhost:81/aflasp/x10/', 1, 'FALSE', 1581486063),
(2, 0, '2268ca07906b8f315e80363a921be488', '::1', 'aa77bad97e845090a4f1de2a7ce13897', 'adwares', 'A0000002', 'C0000001', 'N0000001', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'http://localhost:81/aflasp/x10/', 1, 'FALSE', 1581486143),
(3, 0, 'da43be2d44efbeb5118072b2dda94a1a', '::1', 'aa77bad97e845090a4f1de2a7ce13897', 'secretAdwares', 'SA000001', 'C0000001', 'N0000001', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'http://localhost:81/aflasp/x10/', 1, 'FALSE', 1581486149),
(4, 0, 'f5d5ce8ce93c3631831fe5714bb1ccd2', '::1', 'aa77bad97e845090a4f1de2a7ce13897', 'secretAdwares', 'SA000002', 'C0000001', 'N0000001', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'http://localhost:81/aflasp/x10/', 1, 'FALSE', 1581486153),
(5, 0, 'ee5f9bce1452c59170141345ae672a74', '::1', 'aa77bad97e845090a4f1de2a7ce13897', 'adwares', 'A0000001', 'C0000001', 'N0000001', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'http://localhost:81/aflasp/x10/', 1, 'FALSE', 1581487470),
(6, 0, '76c4ea785b9bb6f09190a5c56cc6572a', '::1', 'aa77bad97e845090a4f1de2a7ce13897', 'secretAdwares', 'SA000001', 'C0000001', 'N0000001', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '', 1, 'FALSE', 1581573091),
(7, 0, '19cd417c0be9031ff149c9ef54adad3a', '::1', 'aa77bad97e845090a4f1de2a7ce13897', 'adwares', 'A0000002', 'C0000001', 'N0000001', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '', 1, 'FALSE', 1581573126),
(8, 0, '4fecd62a5e8ff2df1a8f52ad47122228', '::1', '4fecd62a5e8ff2df1a8f52ad47122228', 'secretAdwares', 'SA000002', 'C0000001', 'N0000001', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '', 1, 'FALSE', 1582619127),
(9, 0, '032d5508443d53a0c25fbc6b2c8aa667', '::1', '4fecd62a5e8ff2df1a8f52ad47122228', 'secretAdwares', 'SA000003', 'C0000001', 'N0000001', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '', 1, 'FALSE', 1582620755);

-- --------------------------------------------------------

--
-- テーブルの構造 `accountlock`
--

CREATE TABLE `accountlock` (
  `shadow_id` int(11) NOT NULL,
  `delete_key` tinyint(1) DEFAULT NULL,
  `id` char(16) DEFAULT NULL,
  `login_id` text,
  `try_time` text,
  `unlock_token` varchar(255) DEFAULT NULL,
  `onetime_password` varchar(8) DEFAULT NULL,
  `regist` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

--
-- テーブルのデータのダンプ `accountlock`
--

INSERT INTO `accountlock` (`shadow_id`, `delete_key`, `id`, `login_id`, `try_time`, `unlock_token`, `onetime_password`, `regist`, `update_time`) VALUES
(2, 0, 'ACL0000000000002', 'yamazaki.utg@gmail.com', '', '077dcc35525990c98126a4237abb13b2', '60874788', 0, 0),
(3, 0, 'ACL0000000000003', 'admin@example.com', '', '742fce30c72fc2c998db51792fec2cdd', '0cfd8670', 0, 0),
(4, 0, 'ACL0000000000004', 'a1234', '', 'c8af1ef66440306bde39ec528890d829', 'a50e479e', 0, 0),
(5, 0, 'ACL0000000000005', 'yamazaki.utg+s@gmail.com', '1580862724', 'fb0b6cec4b1dce5bf4b1a5dd7ce86c63', '26195392', 0, 0),
(6, 0, 'ACL0000000000006', 'a123', '', '0634adc5ffa5b930da47c59230edd217', 'bd7224a9', 0, 0),
(7, 0, 'ACL0000000000007', '123', '', '4b70df61fdff37db51d0aa25cdba9411', '308bdf54', 0, 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `accountlockconfig`
--

CREATE TABLE `accountlockconfig` (
  `shadow_id` int(11) NOT NULL,
  `delete_key` tinyint(1) DEFAULT NULL,
  `id` char(8) DEFAULT NULL,
  `user_type` varchar(128) DEFAULT NULL,
  `max_try_time` int(11) DEFAULT NULL,
  `max_try_count` int(11) DEFAULT NULL,
  `is_use` tinyint(1) DEFAULT NULL,
  `regist` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

--
-- テーブルのデータのダンプ `accountlockconfig`
--

INSERT INTO `accountlockconfig` (`shadow_id`, `delete_key`, `id`, `user_type`, `max_try_time`, `max_try_count`, `is_use`, `regist`, `update_time`) VALUES
(1, 0, 'ACLC0001', 'admin', 1800, 5, 1, 0, 0),
(2, 0, 'ACLC0002', 'nUser', 1800, 5, 0, 0, 0),
(3, 0, 'ACLC0003', 'cUser', 1800, 5, 0, 0, 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `admin`
--

CREATE TABLE `admin` (
  `shadow_id` int(11) NOT NULL,
  `delete_key` tinyint(1) DEFAULT NULL,
  `id` char(5) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `pass` varchar(128) DEFAULT NULL,
  `activate` int(11) DEFAULT NULL,
  `logout` int(11) DEFAULT NULL,
  `login` int(11) DEFAULT NULL,
  `old_login` int(11) DEFAULT NULL,
  `mail_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

--
-- テーブルのデータのダンプ `admin`
--

INSERT INTO `admin` (`shadow_id`, `delete_key`, `id`, `name`, `mail`, `pass`, `activate`, `logout`, `login`, `old_login`, `mail_time`) VALUES
(0, 0, 'ADMIN', '管理者', 'admin', 'admin', 2, 1582243010, 1582242643, 1581490115, 1582242643);

-- --------------------------------------------------------

--
-- テーブルの構造 `adwares`
--

CREATE TABLE `adwares` (
  `shadow_id` int(11) NOT NULL,
  `delete_key` tinyint(1) DEFAULT NULL,
  `id` char(8) DEFAULT NULL,
  `cuser` char(8) DEFAULT NULL,
  `comment` text,
  `ad_text` varchar(128) DEFAULT NULL,
  `category` char(8) DEFAULT NULL,
  `banner` text,
  `banner2` text,
  `banner3` text,
  `banner_m` text,
  `banner_m2` text,
  `banner_m3` text,
  `url` varchar(255) DEFAULT NULL,
  `url_m` varchar(255) DEFAULT NULL,
  `url_over` varchar(255) DEFAULT NULL,
  `url_users` tinyint(1) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `money` varchar(10) DEFAULT NULL,
  `ad_type` varchar(10) DEFAULT NULL,
  `click_money` varchar(10) DEFAULT NULL,
  `continue_money` varchar(10) DEFAULT NULL,
  `continue_type` varchar(10) DEFAULT NULL,
  `limits` int(11) DEFAULT NULL,
  `limit_type` char(1) DEFAULT NULL,
  `money_count` int(11) DEFAULT NULL,
  `pay_count` int(11) DEFAULT NULL,
  `click_money_count` int(11) DEFAULT NULL,
  `continue_money_count` int(11) DEFAULT NULL,
  `span` int(11) DEFAULT NULL,
  `span_type` char(1) DEFAULT NULL,
  `use_cookie_interval` tinyint(1) DEFAULT NULL,
  `pay_span` int(11) DEFAULT NULL,
  `pay_span_type` char(1) DEFAULT NULL,
  `auto` char(1) DEFAULT NULL,
  `click_auto` char(1) DEFAULT NULL,
  `continue_auto` char(1) DEFAULT NULL,
  `check_type` varchar(10) DEFAULT NULL,
  `open` tinyint(1) DEFAULT NULL,
  `regist` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

--
-- テーブルのデータのダンプ `adwares`
--

INSERT INTO `adwares` (`shadow_id`, `delete_key`, `id`, `cuser`, `comment`, `ad_text`, `category`, `banner`, `banner2`, `banner3`, `banner_m`, `banner_m2`, `banner_m3`, `url`, `url_m`, `url_over`, `url_users`, `name`, `money`, `ad_type`, `click_money`, `continue_money`, `continue_type`, `limits`, `limit_type`, `money_count`, `pay_count`, `click_money_count`, `continue_money_count`, `span`, `span_type`, `use_cookie_interval`, `pay_span`, `pay_span_type`, `auto`, `click_auto`, `continue_auto`, `check_type`, `open`, `regist`) VALUES
(1, 0, 'A0000001', 'C0000001', '説明１\r\n説明２\r\n説明３', 'テキストこうこく', 'CT000001', 'file/image/202002/a4578ba1473c32f1f5bb3f640ac24461.png', '', '', '', '', '', 'http://localhost:81/aflasp/x10/return.html', '', '', 0, '目標、オープン、かて１の広告', '1240', 'yen', '0', '0', 'yen', 0, '0', NULL, NULL, NULL, NULL, 10, 's', 0, 10, 's', '1', '1', '1', 'ip', 1, 1581467718),
(2, 0, 'A0000002', 'C0000001', '説明あ\n説明い', 'テキスト', 'CT000001', '', '', '', '', '', '', 'http://localhost:81/aflasp/x10/return.html', '', '', 0, 'クリック、オープン、かて１の広告', '0', 'yen', '8', '0', 'yen', 0, '0', 16, 0, 2, 0, 8, 's', 0, 8, 's', '1', '1', '1', 'ip', 1, 1581467853),
(3, 0, 'A0000003', 'C0000002', '456のオープン広告の説明文', '456のオープン広告のテキスト', 'CT000001', '', '', '', '', '', '', 'http://www.google.com', '', '', 0, '456のオープン広告', '1200', 'yen', '0', '0', 'yen', 0, '0', 0, 0, 0, 0, 11, 's', 0, 11, 's', '1', '1', '1', 'ip', 1, 1582246104);

-- --------------------------------------------------------

--
-- テーブルの構造 `area`
--

CREATE TABLE `area` (
  `shadow_id` int(11) NOT NULL,
  `delete_key` tinyint(1) DEFAULT NULL,
  `id` char(6) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

--
-- テーブルのデータのダンプ `area`
--

INSERT INTO `area` (`shadow_id`, `delete_key`, `id`, `name`) VALUES
(0, 0, 'AREA01', '北海道'),
(1, 0, 'AREA02', '東北'),
(2, 0, 'AREA03', '関東'),
(3, 0, 'AREA04', '信越'),
(4, 0, 'AREA05', '北陸'),
(5, 0, 'AREA06', '東海'),
(6, 0, 'AREA07', '近畿'),
(7, 0, 'AREA08', '中国'),
(8, 0, 'AREA09', '四国'),
(9, 0, 'AREA10', '九州'),
(10, 0, 'AREA11', '沖縄');

-- --------------------------------------------------------

--
-- テーブルの構造 `category`
--

CREATE TABLE `category` (
  `shadow_id` int(11) NOT NULL,
  `delete_key` tinyint(1) DEFAULT NULL,
  `id` char(8) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `regist` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

--
-- テーブルのデータのダンプ `category`
--

INSERT INTO `category` (`shadow_id`, `delete_key`, `id`, `name`, `regist`) VALUES
(1, 0, 'CT000001', 'かてごり１', 1580266639),
(2, 0, 'CT000002', 'カテゴリ２', 1580363043),
(3, 0, 'CT000003', 'かてごり３', 1580363059);

-- --------------------------------------------------------

--
-- テーブルの構造 `click_pay`
--

CREATE TABLE `click_pay` (
  `shadow_id` int(11) NOT NULL,
  `delete_key` tinyint(1) DEFAULT NULL,
  `id` char(32) DEFAULT NULL,
  `access_id` char(32) DEFAULT NULL,
  `owner` char(8) DEFAULT NULL,
  `adwares_type` varchar(32) DEFAULT NULL,
  `adwares` char(8) DEFAULT NULL,
  `cuser` char(8) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `state` varchar(10) DEFAULT NULL,
  `is_notice` tinyint(1) DEFAULT NULL,
  `report_id` char(8) DEFAULT NULL,
  `regist` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

--
-- テーブルのデータのダンプ `click_pay`
--

INSERT INTO `click_pay` (`shadow_id`, `delete_key`, `id`, `access_id`, `owner`, `adwares_type`, `adwares`, `cuser`, `cost`, `state`, `is_notice`, `report_id`, `regist`) VALUES
(1, 0, '2268ca07906b8f315e80363a921be488', '2268ca07906b8f315e80363a921be488', 'N0000001', 'adwares', 'A0000002', 'C0000001', 8, '2', 1, '', 1581486143),
(2, 0, '19cd417c0be9031ff149c9ef54adad3a', '19cd417c0be9031ff149c9ef54adad3a', 'N0000001', 'adwares', 'A0000002', 'C0000001', 8, '2', 1, '', 1581573126),
(3, 0, '4fecd62a5e8ff2df1a8f52ad47122228', '4fecd62a5e8ff2df1a8f52ad47122228', 'N0000001', 'secretAdwares', 'SA000002', 'C0000001', 12, '2', 1, '', 1582619127);

-- --------------------------------------------------------

--
-- テーブルの構造 `continue_pay`
--

CREATE TABLE `continue_pay` (
  `shadow_id` int(11) NOT NULL,
  `delete_key` tinyint(1) DEFAULT NULL,
  `id` char(32) DEFAULT NULL,
  `pay_id` char(32) DEFAULT NULL,
  `owner` char(8) DEFAULT NULL,
  `adwares_type` varchar(32) DEFAULT NULL,
  `adwares` char(8) DEFAULT NULL,
  `cuser` char(8) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `sales` int(11) DEFAULT NULL,
  `state` varchar(10) DEFAULT NULL,
  `is_notice` tinyint(1) DEFAULT NULL,
  `report_id` char(8) DEFAULT NULL,
  `regist` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

-- --------------------------------------------------------

--
-- テーブルの構造 `cuser`
--

CREATE TABLE `cuser` (
  `shadow_id` int(11) NOT NULL,
  `delete_key` tinyint(1) DEFAULT NULL,
  `id` char(8) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL,
  `zip1` char(3) DEFAULT NULL,
  `zip2` char(4) DEFAULT NULL,
  `adds` char(4) DEFAULT NULL,
  `add_sub` varchar(255) DEFAULT NULL,
  `tel` varchar(15) DEFAULT NULL,
  `fax` varchar(15) DEFAULT NULL,
  `mail` varchar(128) DEFAULT NULL,
  `pass` varchar(128) DEFAULT NULL,
  `activate` int(11) DEFAULT NULL,
  `mail_reception` varchar(32) DEFAULT NULL,
  `is_mobile` tinyint(1) DEFAULT NULL,
  `limits` int(11) DEFAULT NULL,
  `regist` int(11) DEFAULT NULL,
  `logout` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

--
-- テーブルのデータのダンプ `cuser`
--

INSERT INTO `cuser` (`shadow_id`, `delete_key`, `id`, `name`, `zip1`, `zip2`, `adds`, `add_sub`, `tel`, `fax`, `mail`, `pass`, `activate`, `mail_reception`, `is_mobile`, `limits`, `regist`, `logout`) VALUES
(1, 0, 'C0000001', 'ヤマザキ', '123', '4567', 'PF02', 'aoao\n', '090-0000-0000', '', '123', 'AES_OK:fDI0VZtmHEEKwQw1T+WU3g==', 4, '', 0, 0, 1580200708, 1582602321),
(2, 0, 'C0000002', 'こうこくぬし２', '123', '4567', 'PF05', 'akita', '09090909091', '', '456', 'AES_OK:fDI0VZtmHEEKwQw1T+WU3g==', 4, '', 0, 0, 1580460211, 1580949667);

-- --------------------------------------------------------

--
-- テーブルの構造 `invitation`
--

CREATE TABLE `invitation` (
  `shadow_id` int(11) NOT NULL,
  `delete_key` tinyint(1) DEFAULT NULL,
  `id` char(8) DEFAULT NULL,
  `owner` char(8) DEFAULT NULL,
  `mail` varchar(128) DEFAULT NULL,
  `message` text,
  `regist` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

-- --------------------------------------------------------

--
-- テーブルの構造 `log_pay`
--

CREATE TABLE `log_pay` (
  `shadow_id` int(11) NOT NULL,
  `delete_key` tinyint(1) DEFAULT NULL,
  `id` char(16) DEFAULT NULL,
  `pay_type` varchar(32) DEFAULT NULL,
  `pay_id` char(32) DEFAULT NULL,
  `nuser_id` char(8) DEFAULT NULL,
  `operator` varchar(8) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `action` varchar(16) DEFAULT NULL,
  `regist` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

-- --------------------------------------------------------

--
-- テーブルの構造 `multimail`
--

CREATE TABLE `multimail` (
  `shadow_id` int(11) NOT NULL,
  `delete_key` tinyint(1) DEFAULT NULL,
  `id` char(8) DEFAULT NULL,
  `sub` varchar(128) DEFAULT NULL,
  `main` text,
  `receive_id` text
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

-- --------------------------------------------------------

--
-- テーブルの構造 `nuser`
--

CREATE TABLE `nuser` (
  `shadow_id` int(11) NOT NULL,
  `delete_key` tinyint(1) DEFAULT NULL,
  `id` char(8) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL,
  `zip1` char(3) DEFAULT NULL,
  `zip2` char(4) DEFAULT NULL,
  `adds` char(4) DEFAULT NULL,
  `add_sub` varchar(255) DEFAULT NULL,
  `tel` varchar(15) DEFAULT NULL,
  `fax` varchar(15) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `mail` varchar(128) DEFAULT NULL,
  `bank_code` varchar(4) DEFAULT NULL,
  `bank` varchar(128) DEFAULT NULL,
  `branch_code` varchar(3) DEFAULT NULL,
  `branch` varchar(128) DEFAULT NULL,
  `bank_type` varchar(2) DEFAULT NULL,
  `number` varchar(32) DEFAULT NULL,
  `bank_name` varchar(32) DEFAULT NULL,
  `parent` char(8) DEFAULT NULL,
  `grandparent` char(8) DEFAULT NULL,
  `greatgrandparent` char(8) DEFAULT NULL,
  `pass` varchar(128) DEFAULT NULL,
  `terminal` varchar(255) DEFAULT NULL,
  `activate` int(11) DEFAULT NULL,
  `pay` int(11) DEFAULT NULL,
  `tier` int(11) DEFAULT NULL,
  `rank` char(4) DEFAULT NULL,
  `personal_rate` double DEFAULT NULL,
  `magni` double DEFAULT NULL,
  `mail_reception` varchar(32) DEFAULT NULL,
  `is_mobile` tinyint(1) DEFAULT NULL,
  `limits` int(11) DEFAULT NULL,
  `regist` int(11) DEFAULT NULL,
  `logout` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

--
-- テーブルのデータのダンプ `nuser`
--

INSERT INTO `nuser` (`shadow_id`, `delete_key`, `id`, `name`, `zip1`, `zip2`, `adds`, `add_sub`, `tel`, `fax`, `url`, `mail`, `bank_code`, `bank`, `branch_code`, `branch`, `bank_type`, `number`, `bank_name`, `parent`, `grandparent`, `greatgrandparent`, `pass`, `terminal`, `activate`, `pay`, `tier`, `rank`, `personal_rate`, `magni`, `mail_reception`, `is_mobile`, `limits`, `regist`, `logout`) VALUES
(1, 0, 'N0000001', 'ゆーざ山崎あ', '123', '3210', 'PF05', 'akita', '080-0808-0808', '', 'http://yes.com', 'a123', '999', 'ABCD', '888', 'DEF', '1', '1234567', 'コウザコウザ', '', '', '', 'AES_OK:fDI0VZtmHEEKwQw1T+WU3g==', '', 4, 20920, 0, 'SA01', 5, 100, '', 0, 0, 1580267237, 1582586999),
(2, 0, 'N0000002', 'B-USER', '123', '4567', 'PF06', 'yama', '11', '', 'http://test.com', 'b123', '11', 'aa', '22', 'cc', '1', '11', 'ヤマ', '', '', '', 'AES_OK:fDI0VZtmHEEKwQw1T+WU3g==', '', 4, 0, 0, 'SA01', 5, 100, '', 0, 0, 1580346840, 1580346840),
(4, 0, 'N0000004', '11', '11', '11', 'PF01', '11', '11', '', 'http://11.com', 'yamazaki.utg+d@gmail.com', '11', '11', '11', '11', '1', '11', 'カナ', '', '', '', 'AES_OK:xof+GA/IbryKYxWisWYwVg==', '', 1, 0, 0, 'SA01', 5, 100, '', 0, 0, 1580456775, 1580456775),
(5, 0, 'N0000005', '22', '22', '22', 'PF01', '22', '22', '22', '22', 'a1234', '22', '22', '22', '22', '1', '22', '22', '', '', '', 'AES_OK:r2qV5Yx1RK9I30s5ia/2bg==', '', 4, 0, 0, 'SA01', 5, 100, '', 0, 0, 1580862427, 1580862904),
(6, 0, 'N0000006', '22', '22', '22', 'PF01', '22', '22', '22', 'http://222.com', 'yamazaki.utg+s@gmail.com', '22', '22', '22', '22', '1', '22', 'カナ', '', '', '', 'AES_OK:r2qV5Yx1RK9I30s5ia/2bg==', '', 1, 0, 0, 'SA01', 5, 100, '', 0, 0, 1580862692, 1580862692),
(7, 0, 'N0000007', 'ヤマザキ', '11', '11', 'PF01', '1111111', '222', '333', '444', 'yamazaki.utg+12@gmail.com', '66', '555', '88', '77', '1', '999', 'カナ', '', '', '', 'AES_OK:r2qV5Yx1RK9I30s5ia/2bg==', '', 1, 0, 0, 'SA01', 5, 100, '', 0, 0, 1581577696, 1581577696);

-- --------------------------------------------------------

--
-- テーブルの構造 `page`
--

CREATE TABLE `page` (
  `shadow_id` int(11) NOT NULL,
  `delete_key` tinyint(1) DEFAULT NULL,
  `id` char(6) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `authority` varchar(128) DEFAULT NULL,
  `open` tinyint(1) DEFAULT NULL,
  `regist` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

-- --------------------------------------------------------

--
-- テーブルの構造 `pay`
--

CREATE TABLE `pay` (
  `shadow_id` int(11) NOT NULL,
  `delete_key` tinyint(1) DEFAULT NULL,
  `id` char(32) DEFAULT NULL,
  `access_id` char(32) DEFAULT NULL,
  `ipaddress` varchar(16) DEFAULT NULL,
  `cookie` varchar(32) DEFAULT NULL,
  `owner` char(8) DEFAULT NULL,
  `adwares_type` varchar(32) DEFAULT NULL,
  `adwares` char(8) DEFAULT NULL,
  `cuser` char(8) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `sales` int(11) DEFAULT NULL,
  `froms` text,
  `froms_sub` text,
  `state` int(11) DEFAULT NULL,
  `is_notice` tinyint(1) DEFAULT NULL,
  `utn` varchar(128) DEFAULT NULL,
  `useragent` text,
  `continue_uid` varchar(128) DEFAULT NULL,
  `report_id` char(8) DEFAULT NULL,
  `regist` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

--
-- テーブルのデータのダンプ `pay`
--

INSERT INTO `pay` (`shadow_id`, `delete_key`, `id`, `access_id`, `ipaddress`, `cookie`, `owner`, `adwares_type`, `adwares`, `cuser`, `cost`, `sales`, `froms`, `froms_sub`, `state`, `is_notice`, `utn`, `useragent`, `continue_uid`, `report_id`, `regist`) VALUES
(1, 0, '1', '1ef1ff9358ce1cb3e9cba7cd59cf8a3e', '::1', 'aa77bad97e845090a4f1de2a7ce13897', 'N0000001', 'adwares', 'A0000001', 'C0000001', 1240, 0, '', '', 2, 1, '', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '', '', 1581486154),
(2, 0, '2', 'ee5f9bce1452c59170141345ae672a74', '::1', 'aa77bad97e845090a4f1de2a7ce13897', 'N0000001', 'adwares', 'A0000001', 'C0000001', 1240, 0, '', '', 2, 1, '', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '', '', 1581487471),
(3, 0, '3', '032d5508443d53a0c25fbc6b2c8aa667', '::1', '4fecd62a5e8ff2df1a8f52ad47122228', 'N0000001', 'secretAdwares', 'SA000003', 'C0000001', 11223, 0, '', '', 2, 1, '', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '', '', 1582620835);

-- --------------------------------------------------------

--
-- テーブルの構造 `prefectures`
--

CREATE TABLE `prefectures` (
  `shadow_id` int(11) NOT NULL,
  `delete_key` tinyint(1) DEFAULT NULL,
  `id` char(4) DEFAULT NULL,
  `area_id` char(6) DEFAULT NULL,
  `name` varchar(16) DEFAULT NULL,
  `name_kana` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

--
-- テーブルのデータのダンプ `prefectures`
--

INSERT INTO `prefectures` (`shadow_id`, `delete_key`, `id`, `area_id`, `name`, `name_kana`) VALUES
(0, 0, 'PF01', 'AREA01', '北海道', 'ﾎｯｶｲﾄﾞｳ'),
(1, 0, 'PF02', 'AREA02', '青森県', 'ｱｵﾓﾘｹﾝ'),
(2, 0, 'PF03', 'AREA02', '岩手県', 'ｲﾜﾃｹﾝ'),
(3, 0, 'PF04', 'AREA02', '宮城県', 'ﾐﾔｷﾞｹﾝ'),
(4, 0, 'PF05', 'AREA02', '秋田県', 'ｱｷﾀｹﾝ'),
(5, 0, 'PF06', 'AREA02', '山形県', 'ﾔﾏｶﾞﾀｹﾝ'),
(6, 0, 'PF07', 'AREA02', '福島県', 'ﾌｸｼﾏｹﾝ'),
(7, 0, 'PF08', 'AREA03', '東京都', 'ﾄｳｷｮｳﾄ'),
(8, 0, 'PF09', 'AREA03', '神奈川県', 'ｶﾅｶﾞﾜｹﾝ'),
(9, 0, 'PF10', 'AREA03', '埼玉県', 'ｻｲﾀﾏｹﾝ'),
(10, 0, 'PF11', 'AREA03', '千葉県', 'ﾁﾊﾞｹﾝ'),
(11, 0, 'PF12', 'AREA03', '茨城県', 'ｲﾊﾞﾗｷｹﾝ'),
(12, 0, 'PF13', 'AREA03', '栃木県', 'ﾄﾁｷﾞｹﾝ'),
(13, 0, 'PF14', 'AREA03', '群馬県', 'ｸﾞﾝﾏｹﾝ'),
(14, 0, 'PF15', 'AREA03', '山梨県', 'ﾔﾏﾅｼｹﾝ'),
(15, 0, 'PF16', 'AREA04', '新潟県', 'ﾆｲｶﾞﾀｹﾝ'),
(16, 0, 'PF17', 'AREA04', '長野県', 'ﾅｶﾞﾉｹﾝ'),
(17, 0, 'PF18', 'AREA05', '富山県', 'ﾄﾔﾏｹﾝ'),
(18, 0, 'PF19', 'AREA05', '石川県', 'ｲｼｶﾜｹﾝ'),
(19, 0, 'PF20', 'AREA05', '福井県', 'ﾌｸｲｹﾝ'),
(20, 0, 'PF21', 'AREA06', '愛知県', 'ｱｲﾁｹﾝ'),
(21, 0, 'PF22', 'AREA06', '岐阜県', 'ｷﾞﾌｹﾝ'),
(22, 0, 'PF23', 'AREA06', '静岡県', 'ｼｽﾞｵｶｹﾝ'),
(23, 0, 'PF24', 'AREA06', '三重県', 'ﾐｴｹﾝ'),
(24, 0, 'PF25', 'AREA07', '大阪府', 'ｵｵｻｶﾌ'),
(25, 0, 'PF26', 'AREA07', '兵庫県', 'ﾋｮｳｺﾞｹﾝ'),
(26, 0, 'PF27', 'AREA07', '京都府', 'ｷｮｳﾄﾌ'),
(27, 0, 'PF28', 'AREA07', '滋賀県', 'ｼｶﾞｹﾝ'),
(28, 0, 'PF29', 'AREA07', '奈良県', 'ﾅﾗｹﾝ'),
(29, 0, 'PF30', 'AREA07', '和歌山県', 'ﾜｶﾔﾏｹﾝ'),
(30, 0, 'PF31', 'AREA08', '鳥取県', 'ﾄｯﾄﾘｹﾝ'),
(31, 0, 'PF32', 'AREA08', '島根県', 'ｼﾏﾈｹﾝ'),
(32, 0, 'PF33', 'AREA08', '岡山県', 'ｵｶﾔﾏｹﾝ'),
(33, 0, 'PF34', 'AREA08', '広島県', 'ﾋﾛｼﾏｹﾝ'),
(34, 0, 'PF35', 'AREA08', '山口県', 'ﾔﾏｸﾞﾁｹﾝ'),
(35, 0, 'PF36', 'AREA09', '徳島県', 'ﾄｸｼﾏｹﾝ'),
(36, 0, 'PF37', 'AREA09', '香川県', 'ｶｶﾞﾜｹﾝ'),
(37, 0, 'PF38', 'AREA09', '愛媛県', 'ｴﾋﾒｹﾝ'),
(38, 0, 'PF39', 'AREA09', '高知県', 'ｺｳﾁｹﾝ'),
(39, 0, 'PF40', 'AREA10', '福岡県', 'ﾌｸｵｶｹﾝ'),
(40, 0, 'PF41', 'AREA10', '佐賀県', 'ｻｶﾞｹﾝ'),
(41, 0, 'PF42', 'AREA10', '長崎県', 'ﾅｶﾞｻｷｹﾝ'),
(42, 0, 'PF43', 'AREA10', '熊本県', 'ｸﾏﾓﾄｹﾝ'),
(43, 0, 'PF44', 'AREA10', '大分県', 'ｵｵｲﾀｹﾝ'),
(44, 0, 'PF45', 'AREA10', '宮崎県', 'ﾐﾔｻﾞｷｹﾝ'),
(45, 0, 'PF46', 'AREA10', '鹿児島県', 'ｶｺﾞｼﾏｹﾝ'),
(46, 0, 'PF47', 'AREA11', '沖縄県', 'ｵｷﾅﾜｹﾝ');

-- --------------------------------------------------------

--
-- テーブルの構造 `report`
--

CREATE TABLE `report` (
  `shadow_id` int(11) NOT NULL,
  `delete_key` tinyint(1) DEFAULT NULL,
  `id` char(8) DEFAULT NULL,
  `type` varchar(32) DEFAULT NULL,
  `regist` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

-- --------------------------------------------------------

--
-- テーブルの構造 `returnss`
--

CREATE TABLE `returnss` (
  `shadow_id` int(11) NOT NULL,
  `delete_key` tinyint(1) DEFAULT NULL,
  `id` text,
  `owner` char(8) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `state` varchar(16) DEFAULT NULL,
  `regist` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

-- --------------------------------------------------------

--
-- テーブルの構造 `sales`
--

CREATE TABLE `sales` (
  `shadow_id` int(11) NOT NULL,
  `delete_key` tinyint(1) DEFAULT NULL,
  `id` char(4) DEFAULT NULL,
  `name` varchar(8) DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `lot` int(11) DEFAULT NULL,
  `sales` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

--
-- テーブルのデータのダンプ `sales`
--

INSERT INTO `sales` (`shadow_id`, `delete_key`, `id`, `name`, `rate`, `lot`, `sales`) VALUES
(1, 0, 'SA01', '通常会員', 5, 0, 0),
(2, 0, 'SA02', 'シルバー会員', 10, 3, 200000),
(3, 0, 'SA03', 'ゴールド会員', 15, 10, 1000000),
(4, 0, 'SA04', 'プラチナ会員', 20, 20, 2000000);

-- --------------------------------------------------------

--
-- テーブルの構造 `secretadwares`
--

CREATE TABLE `secretadwares` (
  `shadow_id` int(11) NOT NULL,
  `delete_key` tinyint(1) DEFAULT NULL,
  `id` char(8) DEFAULT NULL,
  `cuser` char(8) DEFAULT NULL,
  `comment` text,
  `ad_text` varchar(128) DEFAULT NULL,
  `category` char(8) DEFAULT NULL,
  `banner` text,
  `banner2` text,
  `banner3` text,
  `banner_m` text,
  `banner_m2` text,
  `banner_m3` text,
  `url` varchar(255) DEFAULT NULL,
  `url_m` varchar(255) DEFAULT NULL,
  `url_over` varchar(255) DEFAULT NULL,
  `url_users` tinyint(1) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `money` varchar(10) DEFAULT NULL,
  `ad_type` varchar(10) DEFAULT NULL,
  `click_money` varchar(10) DEFAULT NULL,
  `continue_money` varchar(10) DEFAULT NULL,
  `continue_type` varchar(10) DEFAULT NULL,
  `limits` int(11) DEFAULT NULL,
  `limit_type` char(1) DEFAULT NULL,
  `money_count` int(11) DEFAULT NULL,
  `pay_count` int(11) DEFAULT NULL,
  `click_money_count` int(11) DEFAULT NULL,
  `continue_money_count` int(11) DEFAULT NULL,
  `span` int(11) DEFAULT NULL,
  `span_type` char(1) DEFAULT NULL,
  `use_cookie_interval` tinyint(1) DEFAULT NULL,
  `pay_span` int(11) DEFAULT NULL,
  `pay_span_type` char(1) DEFAULT NULL,
  `auto` char(1) DEFAULT NULL,
  `click_auto` char(1) DEFAULT NULL,
  `continue_auto` char(1) DEFAULT NULL,
  `check_type` varchar(10) DEFAULT NULL,
  `open` tinyint(1) DEFAULT NULL,
  `open_user` text,
  `regist` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

--
-- テーブルのデータのダンプ `secretadwares`
--

INSERT INTO `secretadwares` (`shadow_id`, `delete_key`, `id`, `cuser`, `comment`, `ad_text`, `category`, `banner`, `banner2`, `banner3`, `banner_m`, `banner_m2`, `banner_m3`, `url`, `url_m`, `url_over`, `url_users`, `name`, `money`, `ad_type`, `click_money`, `continue_money`, `continue_type`, `limits`, `limit_type`, `money_count`, `pay_count`, `click_money_count`, `continue_money_count`, `span`, `span_type`, `use_cookie_interval`, `pay_span`, `pay_span_type`, `auto`, `click_auto`, `continue_auto`, `check_type`, `open`, `open_user`, `regist`) VALUES
(1, 0, 'SA000001', 'C0000001', '説明A\r\n説明B', 'てきすとこーこく', 'CT000002', 'file/image/202002/d956714bb06fd931a621574f9d0ed9f1.png', '', '', '', '', '', 'http://localhost:81/aflasp/x10/return.html', '', '', 0, '目標、承認、かて２の広告', '2340', 'yen', '0', '0', 'yen', 0, '0', 0, 0, 0, 0, 10, 's', 0, 10, 's', '1', '1', '1', 'ip', 1, '', 1581467798),
(2, 0, 'SA000002', 'C0000001', '説明い\r\n説明ろ\r\n説明は', 'こー', 'CT000003', '', '', '', '', '', '', 'http://localhost:81/aflasp/x10/return.html', '', '', 0, 'クリック、承認、かて３', '0', 'yen', '12', '0', 'yen', 0, '0', NULL, NULL, NULL, NULL, 12, 's', 0, 12, 's', '1', '1', '1', 'ip', 1, 'N0000001\n', 1581467921),
(3, 0, 'SA000003', 'C0000001', '目標、承認、１２３目標、承認、１２３', '目標、承認、１２３目標、承認、１２３', 'CT000001', '', '', '', '', '', '', 'http://localhost:81/aflasp/x10/return.html', '', '', 0, '目標、承認、１２３', '11223', 'yen', '0', '0', 'yen', 0, '0', NULL, NULL, NULL, NULL, 1, 's', 0, 1, 's', '1', '1', '1', 'ip', 1, 'N0000001\n', 1582620521);

-- --------------------------------------------------------

--
-- テーブルの構造 `system`
--

CREATE TABLE `system` (
  `shadow_id` int(11) NOT NULL,
  `delete_key` tinyint(1) DEFAULT NULL,
  `id` char(5) DEFAULT NULL,
  `uuid` varchar(64) DEFAULT NULL,
  `home` varchar(255) DEFAULT NULL,
  `mail_address` varchar(255) DEFAULT NULL,
  `mail_name` varchar(128) DEFAULT NULL,
  `login_id_manage` varchar(16) DEFAULT NULL,
  `site_title` varchar(128) DEFAULT NULL,
  `keywords` text,
  `description` text,
  `main_css` varchar(32) DEFAULT NULL,
  `child_per` int(11) DEFAULT NULL,
  `grandchild_per` int(11) DEFAULT NULL,
  `greatgrandchild_per` int(11) DEFAULT NULL,
  `users_returnss` tinyint(1) DEFAULT NULL,
  `exchange_limit` int(11) DEFAULT NULL,
  `nuser_default_activate` int(11) DEFAULT NULL,
  `nuser_accept_admin` int(11) DEFAULT NULL,
  `cuser_default_activate` int(11) DEFAULT NULL,
  `adwares_pass` varchar(32) DEFAULT NULL,
  `sales_auto` char(1) DEFAULT NULL,
  `send_mail_admin` varchar(32) DEFAULT NULL,
  `send_mail_nuser` varchar(32) DEFAULT NULL,
  `send_mail_cuser` varchar(32) DEFAULT NULL,
  `send_mail_status` varchar(32) DEFAULT NULL,
  `access_limit` int(11) DEFAULT NULL,
  `parent_limit` int(11) DEFAULT NULL,
  `parent_limit_url` varchar(255) DEFAULT NULL,
  `regist` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

--
-- テーブルのデータのダンプ `system`
--

INSERT INTO `system` (`shadow_id`, `delete_key`, `id`, `uuid`, `home`, `mail_address`, `mail_name`, `login_id_manage`, `site_title`, `keywords`, `description`, `main_css`, `child_per`, `grandchild_per`, `greatgrandchild_per`, `users_returnss`, `exchange_limit`, `nuser_default_activate`, `nuser_accept_admin`, `cuser_default_activate`, `adwares_pass`, `sales_auto`, `send_mail_admin`, `send_mail_nuser`, `send_mail_cuser`, `send_mail_status`, `access_limit`, `parent_limit`, `parent_limit_url`, `regist`) VALUES
(0, 0, 'ADMIN', 'AEA71C2E-DA99-4588-1449-6B667C12E887', 'http://localhost:81/aflasp/', 'admin@example.com', 'アフィリエイトシステム管理者', 'SESSION', 'アフィリエイトシステム', 'アフィリエイト', 'アフィリエイトシステム', 'standard', 0, 0, 0, 1, 5000, 1, 2, 1, '8Z43e9Hq', '1', '', '', '', '', 86400, 999, 'http://example.com/', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `template`
--

CREATE TABLE `template` (
  `shadow_id` int(11) NOT NULL,
  `delete_key` tinyint(1) DEFAULT NULL,
  `id` char(5) DEFAULT NULL,
  `user_type` varchar(64) DEFAULT NULL,
  `target_type` varchar(32) DEFAULT NULL,
  `activate` int(11) DEFAULT NULL,
  `owner` int(11) DEFAULT NULL,
  `label` varchar(128) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `regist` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

--
-- テーブルのデータのダンプ `template`
--

INSERT INTO `template` (`shadow_id`, `delete_key`, `id`, `user_type`, `target_type`, `activate`, `owner`, `label`, `file`, `regist`) VALUES
(0, 0, 'T0000', '/admin/', '', 6, 3, 'TOP_PAGE_DESIGN', 'admin/Index.html', 0),
(1, 0, 'T0001', '/admin/', 'admin', 6, 3, 'EDIT_FORM_PAGE_DESIGN', 'admin/Edit.html', 0),
(2, 0, 'T0002', '/admin/', 'admin', 6, 3, 'EDIT_CHECK_PAGE_DESIGN', 'admin/EditCheck.html', 0),
(3, 0, 'T0003', '/admin/', 'admin', 6, 3, 'EDIT_COMP_PAGE_DESIGN', 'base/EditComp.html', 0),
(4, 0, 'T0004', '/admin/', 'admin', 6, 3, 'REGIST_ERROR_DESIGN', 'admin/RegistFaled.html', 0),
(5, 0, 'T0005', '/admin/', 'nUser', 6, 3, 'EDIT_FORM_PAGE_DESIGN', 'nUser/EditAdmin.html', 0),
(6, 0, 'T0006', '/admin/', 'nUser', 6, 3, 'EDIT_CHECK_PAGE_DESIGN', 'nUser/EditCheckAdmin.html', 0),
(7, 0, 'T0007', '/admin/', 'nUser', 6, 3, 'EDIT_COMP_PAGE_DESIGN', 'base/EditComp.html', 0),
(8, 0, 'T0008', '/admin/', 'nUser', 6, 3, 'REGIST_ERROR_DESIGN', 'nUser/RegistFaled.html', 0),
(9, 0, 'T0009', '/admin/', 'nUser', 6, 3, 'DELETE_CHECK_PAGE_DESIGN', 'nUser/DeleteCheck.html', 0),
(10, 0, 'T0010', '/admin/', 'nUser', 6, 3, 'DELETE_COMP_PAGE_DESIGN', 'base/UserDeleteComp.html', 0),
(11, 0, 'T0011', '/admin/', 'nUser', 6, 3, 'SEARCH_FORM_PAGE_DESIGN', 'nUser/SearchAdmin.html', 0),
(12, 0, 'T0012', '/admin/', 'nUser', 6, 3, 'SEARCH_RESULT_DESIGN', 'nUser/SearchResultFormatAdmin.html', 0),
(13, 0, 'T0013', '/admin/', 'nUser', 6, 3, 'SEARCH_LIST_PAGE_DESIGN', 'nUser/List.html', 0),
(14, 0, 'T0014', '/admin/', 'nUser', 6, 3, 'SEARCH_NOT_FOUND_DESIGN', 'nUser/SearchFaled.html', 0),
(15, 0, 'T0015', '/admin/', 'nUser', 6, 3, 'INFO_PAGE_DESIGN', 'nUser/InfoAdmin.html', 0),
(16, 0, 'T0016', '/admin/', 'adwares', 6, 3, 'REGIST_FORM_PAGE_DESIGN', 'adwares/RegistAdmin.html', 0),
(17, 0, 'T0017', '/admin/', 'adwares', 6, 3, 'REGIST_CHECK_PAGE_DESIGN', 'adwares/RegistCheck.html', 0),
(18, 0, 'T0018', '/admin/', 'adwares', 6, 3, 'REGIST_COMP_PAGE_DESIGN', 'adwares/RegistComp.html', 0),
(19, 0, 'T0019', '/admin/', 'adwares', 6, 3, 'REGIST_ERROR_DESIGN', 'adwares/RegistFaled.html', 0),
(20, 0, 'T0020', '/admin/', 'adwares', 6, 3, 'EDIT_FORM_PAGE_DESIGN', 'adwares/EditAdmin.html', 0),
(21, 0, 'T0021', '/admin/', 'adwares', 6, 3, 'EDIT_CHECK_PAGE_DESIGN', 'adwares/EditCheck.html', 0),
(22, 0, 'T0022', '/admin/', 'adwares', 6, 3, 'EDIT_COMP_PAGE_DESIGN', 'base/EditComp.html', 0),
(23, 0, 'T0023', '/admin/', 'adwares', 6, 3, 'DELETE_CHECK_PAGE_DESIGN', 'adwares/DeleteCheck.html', 0),
(24, 0, 'T0024', '/admin/', 'adwares', 6, 3, 'DELETE_COMP_PAGE_DESIGN', 'base/DeleteComp.html', 0),
(25, 0, 'T0025', '/admin/', 'adwares', 6, 3, 'SEARCH_RESULT_DESIGN', 'adwares/SearchResultFormat.html', 0),
(26, 0, 'T0026', '/admin/', 'adwares', 6, 3, 'SEARCH_LIST_PAGE_DESIGN', 'adwares/ListAdmin.html', 0),
(27, 0, 'T0027', '/admin/', 'adwares', 6, 3, 'SEARCH_NOT_FOUND_DESIGN', 'adwares/SearchFaled.html', 0),
(28, 0, 'T0028', '/admin/', 'category', 6, 3, 'REGIST_FORM_PAGE_DESIGN', 'category/Regist.html', 0),
(29, 0, 'T0029', '/admin/', 'category', 6, 3, 'REGIST_CHECK_PAGE_DESIGN', 'category/RegistCheck.html', 0),
(30, 0, 'T0030', '/admin/', 'category', 6, 3, 'REGIST_COMP_PAGE_DESIGN', 'category/RegistComp.html', 0),
(31, 0, 'T0031', '/admin/', 'category', 6, 3, 'REGIST_FORM_PAGE_DESIGN_POPUP', 'category/RegistPop.html', 0),
(32, 0, 'T0032', '/admin/', 'category', 6, 3, 'REGIST_CHECK_PAGE_DESIGN_POPUP', 'category/RegistCheckPop.html', 0),
(33, 0, 'T0033', '/admin/', 'category', 6, 3, 'REGIST_COMP_PAGE_DESIGN_POPUP', 'category/RegistCompPop.html', 0),
(34, 0, 'T0034', '/admin/', 'category', 6, 3, 'REGIST_ERROR_DESIGN', 'category/RegistFaled.html', 0),
(35, 0, 'T0035', '/admin/', 'category', 6, 3, 'EDIT_FORM_PAGE_DESIGN', 'category/Edit.html', 0),
(36, 0, 'T0036', '/admin/', 'category', 6, 3, 'EDIT_CHECK_PAGE_DESIGN', 'category/EditCheck.html', 0),
(37, 0, 'T0037', '/admin/', 'category', 6, 3, 'EDIT_COMP_PAGE_DESIGN', 'base/EditComp.html', 0),
(38, 0, 'T0038', '/admin/', 'category', 6, 3, 'DELETE_CHECK_PAGE_DESIGN', 'category/DeleteCheck.html', 0),
(39, 0, 'T0039', '/admin/', 'category', 6, 3, 'DELETE_COMP_PAGE_DESIGN', 'base/DeleteComp.html', 0),
(40, 0, 'T0040', '/admin/', 'category', 6, 3, 'SEARCH_RESULT_DESIGN', 'category/SearchResultAdminFormat.html', 0),
(41, 0, 'T0041', '/admin/', 'category', 6, 3, 'SEARCH_LIST_PAGE_DESIGN', 'category/ListAdmin.html', 0),
(42, 0, 'T0042', '/admin/', 'category', 6, 3, 'SEARCH_NOT_FOUND_DESIGN', 'category/SearchFaled.html', 0),
(43, 0, 'T0043', '/admin/', 'access', 6, 3, 'SEARCH_RESULT_DESIGN', 'access/SearchResultFormatAdmin.html', 0),
(44, 0, 'T0044', '/admin/', 'access', 6, 3, 'SEARCH_LIST_PAGE_DESIGN', 'access/ListAdmin.html', 0),
(45, 0, 'T0045', '/admin/', 'access', 6, 3, 'SEARCH_NOT_FOUND_DESIGN', 'access/SearchFaledAdmin.html', 0),
(46, 0, 'T0046', '/admin/', 'access', 6, 3, 'DELETE_COMP_PAGE_DESIGN', 'base/DeleteComp.html', 0),
(47, 0, 'T0047', '/admin/', 'pay', 6, 3, 'SEARCH_RESULT_DESIGN', 'pay/SearchResultAdminFormat.html', 0),
(48, 0, 'T0048', '/admin/', 'pay', 6, 3, 'SEARCH_LIST_PAGE_DESIGN', 'pay/ListAdmin.html', 0),
(49, 0, 'T0049', '/admin/', 'pay', 6, 3, 'SEARCH_NOT_FOUND_DESIGN', 'pay/SearchFaledAdmin.html', 0),
(50, 0, 'T0050', '/admin/', 'click_pay', 6, 3, 'SEARCH_RESULT_DESIGN', 'click_pay/SearchResultAdminFormat.html', 0),
(51, 0, 'T0051', '/admin/', 'click_pay', 6, 3, 'SEARCH_LIST_PAGE_DESIGN', 'click_pay/ListAdmin.html', 0),
(52, 0, 'T0052', '/admin/', 'click_pay', 6, 3, 'SEARCH_NOT_FOUND_DESIGN', 'click_pay/SearchFaledAdmin.html', 0),
(53, 0, 'T0053', '/admin/', 'returnss', 6, 3, 'SEARCH_RESULT_DESIGN', 'returnss/SearchResultAdminFormat.html', 0),
(54, 0, 'T0054', '/admin/', 'returnss', 6, 3, 'SEARCH_LIST_PAGE_DESIGN', 'returnss/ListAdmin.html', 0),
(55, 0, 'T0055', '/admin/', 'returnss', 6, 3, 'SEARCH_NOT_FOUND_DESIGN', 'returnss/SearchFaled.html', 0),
(56, 0, 'T0056', '/admin/', 'sales', 6, 3, 'REGIST_FORM_PAGE_DESIGN', 'sales/Regist.html', 0),
(57, 0, 'T0057', '/admin/', 'sales', 6, 3, 'REGIST_CHECK_PAGE_DESIGN', 'sales/RegistCheck.html', 0),
(58, 0, 'T0058', '/admin/', 'sales', 6, 3, 'REGIST_COMP_PAGE_DESIGN', 'base/RegistComp.html', 0),
(59, 0, 'T0059', '/admin/', 'sales', 6, 3, 'REGIST_ERROR_DESIGN', 'sales/RegistFaled.html', 0),
(60, 0, 'T0060', '/admin/', 'sales', 6, 3, 'EDIT_FORM_PAGE_DESIGN', 'sales/Edit.html', 0),
(61, 0, 'T0061', '/admin/', 'sales', 6, 3, 'EDIT_CHECK_PAGE_DESIGN', 'sales/EditCheck.html', 0),
(62, 0, 'T0062', '/admin/', 'sales', 6, 3, 'EDIT_COMP_PAGE_DESIGN', 'base/EditComp.html', 0),
(63, 0, 'T0063', '/admin/', 'sales', 6, 3, 'DELETE_CHECK_PAGE_DESIGN', 'sales/DeleteCheck.html', 0),
(64, 0, 'T0064', '/admin/', 'sales', 6, 3, 'DELETE_COMP_PAGE_DESIGN', 'base/DeleteComp.html', 0),
(65, 0, 'T0065', '/admin/', 'sales', 6, 3, 'SEARCH_RESULT_DESIGN', 'sales/SearchResultFormatAdmin.html', 0),
(66, 0, 'T0066', '/admin/', 'sales', 6, 3, 'SEARCH_LIST_PAGE_DESIGN', 'sales/ListAdmin.html', 0),
(67, 0, 'T0067', '/admin/', 'sales', 6, 3, 'SEARCH_NOT_FOUND_DESIGN', 'sales/SearchFaled.html', 0),
(68, 0, 'T0068', '/admin/', 'multimail', 6, 3, 'REGIST_FORM_PAGE_DESIGN', 'multimail/Regist.html', 0),
(69, 0, 'T0069', '/admin/', 'multimail', 6, 3, 'REGIST_CHECK_PAGE_DESIGN', 'multimail/RegistCheck.html', 0),
(70, 0, 'T0070', '/admin/', 'multimail', 6, 3, 'REGIST_COMP_PAGE_DESIGN', 'multimail/RegistComp.html', 0),
(71, 0, 'T0071', '/admin/', 'multimail', 6, 3, 'REGIST_ERROR_DESIGN', 'multimail/RegistFaled.html', 0),
(72, 0, 'T0072', '/admin/', 'system', 6, 3, 'EDIT_FORM_PAGE_DESIGN', 'system/Edit.html', 0),
(73, 0, 'T0073', '/admin/', 'system', 6, 3, 'EDIT_CHECK_PAGE_DESIGN', 'system/EditCheck.html', 0),
(74, 0, 'T0074', '/admin/', 'system', 6, 3, 'EDIT_COMP_PAGE_DESIGN', 'system/EditComp.html', 0),
(75, 0, 'T0075', '/admin/', 'system', 6, 3, 'REGIST_ERROR_DESIGN', 'system/RegistFaled.html', 0),
(76, 0, 'T0076', '/admin/', 'head', 15, 3, 'INCLUDE_DESIGN', 'include/HeadAdmin.html', 0),
(77, 0, 'T0077', '/admin/', 'side_bar', 15, 3, 'INCLUDE_DESIGN', 'include/Side_barAdmin.html', 0),
(78, 0, 'T0078', '/nUser/', '', 2, 3, 'TOP_PAGE_DESIGN', 'nUser/LoginNotActive.html', 0),
(79, 0, 'T0079', '/nUser/', '', 4, 3, 'TOP_PAGE_DESIGN', 'nUser/Index.html', 0),
(80, 0, 'T0080', '/nUser/', '', 8, 3, 'TOP_PAGE_DESIGN', 'nUser/LoginDeny.html', 0),
(81, 0, 'T0081', '/nUser/', 'nUser', 6, 1, 'EDIT_FORM_PAGE_DESIGN', 'nUser/Edit.html', 0),
(82, 0, 'T0082', '/nUser/', 'nUser', 6, 1, 'EDIT_CHECK_PAGE_DESIGN', 'nUser/EditCheck.html', 0),
(83, 0, 'T0083', '/nUser/', 'nUser', 6, 1, 'EDIT_COMP_PAGE_DESIGN', 'base/EditComp.html', 0),
(84, 0, 'T0084', '/nUser/', 'nUser', 6, 1, 'REGIST_ERROR_DESIGN', 'nUser/RegistFaled.html', 0),
(85, 0, 'T0085', '/nUser/', 'nUser', 6, 1, 'DELETE_CHECK_PAGE_DESIGN', 'nUser/DeleteCheck.html', 0),
(86, 0, 'T0086', '/nUser/', 'nUser', 6, 1, 'DELETE_COMP_PAGE_DESIGN', 'base/UserDeleteComp.html', 0),
(87, 0, 'T0087', '/nUser/', 'nUser', 6, 3, 'QUICK_DESIGN', 'quick/SetNUser.html', 0),
(88, 0, 'T0088', '/nUser/', 'adwares', 4, 3, 'SEARCH_RESULT_DESIGN', 'adwares/SearchResultFormat.html', 0),
(89, 0, 'T0089', '/nUser/', 'adwares', 4, 3, 'SEARCH_LIST_PAGE_DESIGN', 'adwares/List.html', 0),
(90, 0, 'T0090', '/nUser/', 'adwares', 4, 3, 'SEARCH_NOT_FOUND_DESIGN', 'adwares/SearchFaled.html', 0),
(91, 0, 'T0091', '/nUser/', 'adwares', 4, 3, 'INFO_PAGE_DESIGN', 'adwares/Info.html', 0),
(92, 0, 'T0092', '/nUser/', 'access', 4, 3, 'SEARCH_RESULT_DESIGN', 'access/SearchResultFormat.html', 0),
(93, 0, 'T0093', '/nUser/', 'access', 4, 3, 'SEARCH_LIST_PAGE_DESIGN', 'access/List.html', 0),
(94, 0, 'T0094', '/nUser/', 'access', 4, 3, 'SEARCH_NOT_FOUND_DESIGN', 'access/SearchFaled.html', 0),
(95, 0, 'T0095', '/nUser/', 'pay', 4, 3, 'SEARCH_RESULT_DESIGN', 'pay/SearchResultFormat.html', 0),
(96, 0, 'T0096', '/nUser/', 'pay', 4, 3, 'SEARCH_LIST_PAGE_DESIGN', 'pay/List.html', 0),
(97, 0, 'T0097', '/nUser/', 'pay', 4, 3, 'SEARCH_NOT_FOUND_DESIGN', 'pay/SearchFaled.html', 0),
(98, 0, 'T0098', '/nUser/', 'click_pay', 4, 3, 'SEARCH_RESULT_DESIGN', 'click_pay/SearchResultFormat.html', 0),
(99, 0, 'T0099', '/nUser/', 'click_pay', 4, 3, 'SEARCH_LIST_PAGE_DESIGN', 'click_pay/List.html', 0),
(100, 0, 'T0100', '/nUser/', 'click_pay', 4, 3, 'SEARCH_NOT_FOUND_DESIGN', 'click_pay/SearchFaled.html', 0),
(101, 0, 'T0101', '/nUser/', 'returnss', 4, 3, 'REGIST_FORM_PAGE_DESIGN', 'returnss/Regist.html', 0),
(102, 0, 'T0102', '/nUser/', 'returnss', 4, 3, 'REGIST_CHECK_PAGE_DESIGN', 'returnss/RegistCheck.html', 0),
(103, 0, 'T0103', '/nUser/', 'returnss', 4, 3, 'REGIST_COMP_PAGE_DESIGN', 'returnss/RegistComp.html', 0),
(104, 0, 'T0104', '/nUser/', 'returnss', 4, 3, 'REGIST_ERROR_DESIGN', 'returnss/RegistFaled.html', 0),
(105, 0, 'T0105', '/nUser/', 'returnss', 4, 3, 'SEARCH_RESULT_DESIGN', 'returnss/SearchResultFormat.html', 0),
(106, 0, 'T0106', '/nUser/', 'returnss', 4, 3, 'SEARCH_LIST_PAGE_DESIGN', 'returnss/List.html', 0),
(107, 0, 'T0107', '/nUser/', 'returnss', 4, 3, 'SEARCH_NOT_FOUND_DESIGN', 'returnss/SearchFaled.html', 0),
(108, 0, 'T0108', '/nUser/', 'returnss', 6, 3, 'ADWARES_EXCHANGE', 'returnss/Faled.html', 0),
(109, 0, 'T0109', '/nUser/', 'head', 4, 3, 'INCLUDE_DESIGN', 'include/HeadNLogin.html', 0),
(110, 0, 'T0110', '/nUser/', 'head', 10, 3, 'INCLUDE_DESIGN', 'include/HeadLoginDeny.html', 0),
(111, 0, 'T0111', '/nUser/', 'side_bar', 15, 3, 'INCLUDE_DESIGN', 'include/Side_barNUser.html', 0),
(112, 0, 'T0112', '/nobody/', 'nUser', 15, 3, 'REGIST_FORM_PAGE_DESIGN', 'nUser/Regist.html', 0),
(113, 0, 'T0113', '/nobody/', 'nUser', 15, 3, 'REGIST_CHECK_PAGE_DESIGN', 'nUser/RegistCheck.html', 0),
(114, 0, 'T0114', '/nobody/', 'nUser', 15, 3, 'REGIST_COMP_PAGE_DESIGN', 'nUser/RegistComp.html', 0),
(115, 0, 'T0115', '/nobody/', 'nUser', 15, 3, 'REGIST_ERROR_DESIGN', 'nUser/RegistFaled.html', 0),
(116, 0, 'T0116', '/nobody/', '', 15, 3, 'LOGIN_PAGE_DESIGN', 'base/Index.html', 0),
(117, 0, 'T0117', '/nobody/', '', 15, 3, 'TOP_PAGE_DESIGN', 'base/Index.html', 0),
(118, 0, 'T0118', '/nobody/', 'head', 15, 3, 'INCLUDE_DESIGN', 'include/HeadNobody.html', 0),
(119, 0, 'T0119', '/nobody/', 'side_bar', 15, 3, 'INCLUDE_DESIGN', 'include/Side_barNobody.html', 0),
(120, 0, 'T0120', '/notFound/', 'multimail', 6, 3, 'REGIST_FORM_PAGE_DESIGN', 'multimail/notFound.html', 0),
(121, 0, 'T0121', '//', '', 15, 3, 'ERROR_PAGE_DESIGN', 'base/Error.html', 0),
(122, 0, 'T0122', '//', '', 15, 3, 'ACTIVATE_FALED_DESIGN_HTML', 'base/ActivateFaled.html', 0),
(123, 0, 'T0123', '//', '', 15, 3, 'REGIST_FALED_DESIGN', 'base/RegistFaled.html', 0),
(124, 0, 'T0124', '//', 'nUser', 15, 3, 'ACTIVATE_MAIL', 'mail_contents/activateNUser.txt', 0),
(125, 0, 'T0125', '//', 'nUser', 15, 3, 'ACTIVATE_COMP_MAIL', 'mail_contents/activatecompNUser.txt', 0),
(126, 0, 'T0126', '//', 'nUser', 15, 3, 'REGIST_COMP_MAIL', 'mail_contents/registcompNUser.txt', 0),
(127, 0, 'T0127', '//', 'standard', 15, 3, 'CSS_LINK_LIST', 'css/base.css', 0),
(128, 0, 'T0128', '/nobody/admin/nUser/', '', 15, 3, 'LOGIN_FALED_DESIGN', 'base/LoginFaled.html', 0),
(129, 0, 'T0129', '/nobody/admin/nUser/', '', 15, 3, 'FOOT_DESIGN', 'base/Foot.html', 0),
(130, 0, 'T0130', '/nobody/admin/nUser/', '', 15, 3, 'HEAD_DESIGN', 'base/Head.html', 0),
(131, 0, 'T0131', '/admin/nUser/', '', 15, 3, 'ACTIVATE_DESIGN_HTML', 'base/Activate.html', 0),
(132, 0, 'T0132', '/admin/nUser/', '', 15, 3, 'SEARCH_PAGE_CHANGE_DESIGN', 'base/SearchPageChange.html', 0),
(133, 0, 'T0133', '/nUser/admin/nobody/', 'login', 15, 3, 'QUICK_FALED_DESIGN', 'quick/LoginFaled.html', 0),
(134, 0, 'T0134', '/nUser/admin/nobody/', 'set', 15, 3, 'QUICK_FALED_DESIGN', 'quick/SetFaled.html', 0),
(135, 0, 'T0135', '/nUser/admin/nobody/', 'drawMailLink', 15, 3, 'EXTENSION_PART_DESIGN', 'extension/Friends_mail_link.html', 0),
(136, 0, 'T0136', '/nUser/', 'invitation', 4, 3, 'REGIST_FORM_PAGE_DESIGN', 'invitation/Regist.html', 0),
(137, 0, 'T0137', '/nUser/', 'invitation', 4, 3, 'REGIST_CHECK_PAGE_DESIGN', 'invitation/RegistCheck.html', 0),
(138, 0, 'T0138', '/nUser/', 'invitation', 4, 3, 'REGIST_COMP_PAGE_DESIGN', 'invitation/RegistComp.html', 0),
(139, 0, 'T0139', '/nUser/', 'invitation', 4, 3, 'REGIST_ERROR_DESIGN', 'invitation/RegistFaled.html', 0),
(140, 0, 'T0140', '//', '', 15, 3, 'INVITATION_MAIL', 'mail_contents/invitation.txt', 0),
(141, 0, 'T0141', '/nobody/nUser/', '', 15, 3, 'HEAD_DESIGN_ADMIN_MODE', 'base/HeadAdminMode.html', 0),
(142, 0, 'T0142', '/nUser/admin/', 'access4month', 6, 3, 'OTHER_PAGE_DESIGN', 'other/Access4Month.html', 0),
(143, 0, 'T0143', '/nUser/admin/', 'access4day', 6, 3, 'OTHER_PAGE_DESIGN', 'other/Access4Day.html', 0),
(144, 0, 'T0144', '//', 'access4', 15, 3, 'EXTENSION_PART_DESIGN', 'extension/Access4.html', 0),
(145, 0, 'T0145', '/nUser/admin/', 'tier4day', 6, 3, 'OTHER_PAGE_DESIGN', 'other/Tier4Day.html', 0),
(146, 0, 'T0146', '/nUser/admin/', 'tier4month', 6, 3, 'OTHER_PAGE_DESIGN', 'other/Tier4Month.html', 0),
(147, 0, 'T0147', '//', 'tier4', 15, 3, 'EXTENSION_PART_DESIGN', 'extension/Tier4.html', 0),
(148, 0, 'T0148', '/admin/', 'continue_pay', 6, 3, 'SEARCH_RESULT_DESIGN', 'continue_pay/SearchResultAdminFormat.html', 0),
(149, 0, 'T0149', '/admin/', 'continue_pay', 6, 3, 'SEARCH_LIST_PAGE_DESIGN', 'continue_pay/ListAdmin.html', 0),
(150, 0, 'T0150', '/admin/', 'continue_pay', 6, 3, 'SEARCH_NOT_FOUND_DESIGN', 'continue_pay/SearchFaledAdmin.html', 0),
(151, 0, 'T0151', '/nUser/', 'continue_pay', 4, 3, 'SEARCH_RESULT_DESIGN', 'continue_pay/SearchResultFormat.html', 0),
(152, 0, 'T0152', '/nUser/', 'continue_pay', 4, 3, 'SEARCH_LIST_PAGE_DESIGN', 'continue_pay/List.html', 0),
(153, 0, 'T0153', '/nUser/', 'continue_pay', 4, 3, 'SEARCH_NOT_FOUND_DESIGN', 'continue_pay/SearchFaled.html', 0),
(154, 0, 'T0154', '/admin/', 'pay_report', 6, 3, 'OTHER_PAGE_DESIGN', 'other/PayReportAdmin.html', 0),
(155, 0, 'T0155', '/nUser/', 'pay_report', 6, 3, 'OTHER_PAGE_DESIGN', 'other/PayReport.html', 0),
(156, 0, 'T0156', '/admin/', 'zenginkyo', 6, 3, 'EDIT_FORM_PAGE_DESIGN', 'zenginkyo/Edit.html', 0),
(157, 0, 'T0157', '/admin/', 'zenginkyo', 6, 3, 'EDIT_CHECK_PAGE_DESIGN', 'zenginkyo/EditCheck.html', 0),
(158, 0, 'T0158', '/admin/', 'zenginkyo', 6, 3, 'EDIT_COMP_PAGE_DESIGN', 'zenginkyo/EditComp.html', 0),
(159, 0, 'T0159', '/admin/', 'zenginkyo', 6, 3, 'REGIST_ERROR_DESIGN', 'zenginkyo/RegistFaled.html', 0),
(160, 0, 'T0160', '//', 'mail_reception', 15, 3, 'EXTENSION_PART_DESIGN', 'extension/MailReception.html', 0),
(161, 0, 'T0161', '/admin/', '', 15, 3, 'PAY_MAIL', 'mail_contents/payMail.txt', 0),
(162, 0, 'T0162', '/nUser/', '', 15, 3, 'PAY_MAIL', 'mail_contents/payMailNUser.txt', 0),
(163, 0, 'T0163', '/admin/', 'pay', 6, 3, 'REGIST_FORM_PAGE_DESIGN', 'pay/Regist.html', 0),
(164, 0, 'T0164', '/admin/', 'pay', 6, 3, 'REGIST_CHECK_PAGE_DESIGN', 'pay/RegistCheck.html', 0),
(165, 0, 'T0165', '/admin/', 'pay', 6, 3, 'REGIST_COMP_PAGE_DESIGN', 'pay/RegistComp.html', 0),
(166, 0, 'T0166', '/admin/', 'pay', 6, 3, 'REGIST_ERROR_DESIGN', 'pay/RegistFaled.html', 0),
(167, 0, 'T0167', '/admin/', 'pay', 6, 3, 'EDIT_FORM_PAGE_DESIGN', 'pay/Edit.html', 0),
(168, 0, 'T0168', '/admin/', 'pay', 6, 3, 'EDIT_CHECK_PAGE_DESIGN', 'pay/EditCheck.html', 0),
(169, 0, 'T0169', '/admin/', 'pay', 6, 3, 'EDIT_COMP_PAGE_DESIGN', 'base/EditComp.html', 0),
(170, 0, 'T0170', '/admin/', 'pay', 6, 3, 'DELETE_CHECK_PAGE_DESIGN', 'pay/DeleteCheck.html', 0),
(171, 0, 'T0171', '/admin/', 'pay', 6, 3, 'DELETE_COMP_PAGE_DESIGN', 'base/DeleteComp.html', 0),
(172, 0, 'T0172', '//', '', 15, 3, 'HIDDEN_NOTICE_MAIL', 'mail_contents/HiddenNotice.txt', 0),
(173, 0, 'T0173', '/admin/', 'click_pay', 6, 3, 'REGIST_ERROR_DESIGN', 'click_pay/RegistFailed.html', 0),
(174, 0, 'T0174', '/admin/', 'click_pay', 6, 3, 'EDIT_FORM_PAGE_DESIGN', 'click_pay/Edit.html', 0),
(175, 0, 'T0175', '/admin/', 'click_pay', 6, 3, 'EDIT_CHECK_PAGE_DESIGN', 'click_pay/EditCheck.html', 0),
(176, 0, 'T0176', '/admin/', 'click_pay', 6, 3, 'EDIT_COMP_PAGE_DESIGN', 'base/EditComp.html', 0),
(177, 0, 'T0177', '/admin/', 'click_pay', 6, 3, 'DELETE_CHECK_PAGE_DESIGN', 'click_pay/DeleteCheck.html', 0),
(178, 0, 'T0178', '/admin/', 'click_pay', 6, 3, 'DELETE_COMP_PAGE_DESIGN', 'base/DeleteComp.html', 0),
(179, 0, 'T0179', '/admin/', 'continue_pay', 6, 3, 'REGIST_ERROR_DESIGN', 'continue_pay/RegistFailed.html', 0),
(180, 0, 'T0180', '/admin/', 'continue_pay', 6, 3, 'EDIT_FORM_PAGE_DESIGN', 'continue_pay/Edit.html', 0),
(181, 0, 'T0181', '/admin/', 'continue_pay', 6, 3, 'EDIT_CHECK_PAGE_DESIGN', 'continue_pay/EditCheck.html', 0),
(182, 0, 'T0182', '/admin/', 'continue_pay', 6, 3, 'EDIT_COMP_PAGE_DESIGN', 'base/EditComp.html', 0),
(183, 0, 'T0183', '/admin/', 'continue_pay', 6, 3, 'DELETE_CHECK_PAGE_DESIGN', 'continue_pay/DeleteCheck.html', 0),
(184, 0, 'T0184', '/admin/', 'continue_pay', 6, 3, 'DELETE_COMP_PAGE_DESIGN', 'base/DeleteComp.html', 0),
(185, 0, 'T0185', '/admin/', 'pay', 6, 3, 'INFO_PAGE_DESIGN', 'pay/InfoAdmin.html', 0),
(186, 0, 'T0186', '/admin/', 'adwares', 6, 3, 'INFO_PAGE_DESIGN', 'adwares/InfoAdmin.html', 0),
(187, 0, 'T0187', '/admin/', 'access', 6, 3, 'INFO_PAGE_DESIGN', 'access/InfoAdmin.html', 0),
(188, 0, 'T0188', '/admin/', 'click_pay', 6, 3, 'INFO_PAGE_DESIGN', 'click_pay/InfoAdmin.html', 0),
(189, 0, 'T0189', '/admin/', 'continue_pay', 6, 3, 'INFO_PAGE_DESIGN', 'continue_pay/InfoAdmin.html', 0),
(190, 0, 'T0190', '//', '', 15, 3, 'MINUS_ERROR_DESIGN', 'extension/MinusError.html', 0),
(191, 0, 'T0191', '/admin/', 'log_pay', 6, 3, 'SEARCH_RESULT_DESIGN', 'log_pay/SearchResultFormat.html', 0),
(192, 0, 'T0192', '/admin/', 'log_pay', 6, 3, 'SEARCH_LIST_PAGE_DESIGN', 'log_pay/List.html', 0),
(193, 0, 'T0193', '/admin/', 'log_pay', 6, 3, 'SEARCH_NOT_FOUND_DESIGN', 'log_pay/SearchFailed.html', 0),
(194, 0, 'T0194', '/returnss/', '', 15, 3, 'RETURNSS_ACTION_INDEX', 'module/returnss/Index.html', 0),
(195, 0, 'T0195', '/returnss/', '', 15, 3, 'RETURNSS_EXECUTE_ERROR', 'module/returnss/Error.html', 0),
(196, 0, 'T0196', '/returnss/', '', 15, 3, 'RETURNSS_EXECUTE_SUCCESS', 'module/returnss/Success.html', 0),
(197, 0, 'T0197', '/nobody/', '', 15, 3, 'LOGIN_LOCK_DESIGN', 'module/accountLock/LoginLock.html', 0),
(198, 0, 'T0198', '/admin/', 'accountLockConfig', 15, 3, 'REGIST_ERROR_DESIGN', 'module/accountLockConfig/RegistError.html', 0),
(199, 0, 'T0199', '/admin/', 'accountLockConfig', 15, 3, 'EDIT_FORM_PAGE_DESIGN', 'module/accountLockConfig/admin/Edit.html', 0),
(200, 0, 'T0200', '/admin/', 'accountLockConfig', 15, 3, 'EDIT_CHECK_PAGE_DESIGN', 'module/accountLockConfig/admin/EditCheck.html', 0),
(201, 0, 'T0201', '/admin/', 'accountLockConfig', 15, 3, 'EDIT_COMP_PAGE_DESIGN', 'module/accountLockConfig/admin/EditComp.html', 0),
(202, 0, 'T0202', '/admin/', 'accountLockConfig', 15, 3, 'SEARCH_RESULT_DESIGN', 'module/accountLockConfig/admin/SearchResult.html', 0),
(203, 0, 'T0203', '/admin/', 'accountLockConfig', 15, 3, 'SEARCH_LIST_PAGE_DESIGN', 'module/accountLockConfig/admin/List.html', 0),
(204, 0, 'T0204', '//', '', 15, 3, 'ACCOUNT_LOCK_ALERT_MAIL', 'module/accountLock/AccountLockAlert.txt', 0),
(205, 0, 'T0205', '//', 'accountLock', 15, 3, 'ACCOUNT_UNLOCK_PAGE_DESIGN', 'module/accountLock/Unlock.html', 0),
(206, 0, 'T0206', '//', 'accountLock', 15, 3, 'ACCOUNT_UNLOCK_SUCCESS_PAGE_DESIGN', 'module/accountLock/UnlockSuccess.html', 0),
(207, 0, 'T0207', '//', 'accountLock', 15, 3, 'ACCOUNT_UNLOCK_FAILED_PAGE_DESIGN', 'module/accountLock/UnlockFailed.html', 0),
(208, 0, 'T0208', '/admin/', 'page', 6, 3, 'REGIST_FORM_PAGE_DESIGN', 'page/Regist.html', 0),
(209, 0, 'T0209', '/admin/', 'page', 6, 3, 'REGIST_ERROR_DESIGN', 'page/RegistFailed.html', 0),
(210, 0, 'T0210', '/admin/', 'page', 6, 3, 'REGIST_CHECK_PAGE_DESIGN', 'page/RegistCheck.html', 0),
(211, 0, 'T0211', '/admin/', 'page', 6, 3, 'REGIST_COMP_PAGE_DESIGN', 'page/RegistComp.html', 0),
(212, 0, 'T0212', '/admin/', 'page', 6, 3, 'DELETE_CHECK_PAGE_DESIGN', 'page/DeleteCheck.html', 0),
(213, 0, 'T0213', '/admin/', 'page', 6, 3, 'DELETE_COMP_PAGE_DESIGN', 'page/DeleteComp.html', 0),
(214, 0, 'T0214', '/admin/', 'page', 6, 3, 'SEARCH_LIST_PAGE_DESIGN', 'page/List.html', 0),
(215, 0, 'T0215', '/admin/', 'page', 6, 3, 'SEARCH_NOT_FOUND_DESIGN', 'page/SearchFailed.html', 0),
(216, 0, 'T0216', '/admin/', 'page', 6, 3, 'SEARCH_RESULT_DESIGN', 'page/SearchResultFormat.html', 0),
(217, 0, 'T0217', '/admin/', 'page', 6, 3, 'EDIT_FORM_PAGE_DESIGN', 'page/Edit.html', 0),
(218, 0, 'T0218', '/admin/', 'page', 6, 3, 'EDIT_CHECK_PAGE_DESIGN', 'page/EditCheck.html', 0),
(219, 0, 'T0219', '/admin/', 'page', 6, 3, 'EDIT_COMP_PAGE_DESIGN', 'page/EditComp.html', 0),
(220, 0, 'T0220', '/reminder/', 'nUser', 15, 3, 'SEND_FORM_DESIGN', 'module/reminder/nUser/EmailSend.html', 0),
(221, 0, 'T0221', '/reminder/', 'nUser', 15, 3, 'SEND_COMP_DESIGN', 'module/reminder/nUser/EmailSendComp.html', 0),
(222, 0, 'T0222', '/reminder/', 'nUser', 15, 3, 'SEND_CHECK_DESIGN', 'module/reminder/nUser/EmailSendCheck.html', 0),
(223, 0, 'T0223', '/reminder/', 'nUser', 15, 3, 'SEND_FALED_DESIGN', 'module/reminder/nUser/EmailSendFailed.html', 0),
(224, 0, 'T0224', '/reminder/', 'nUser', 15, 3, 'SEND_MAIL', 'module/reminder/nUser/mail_contents/reminder.txt', 0),
(225, 0, 'T0225', '/nobody/nUser/cUser/admin/', 'Exception', 15, 3, 'EXCEPTION_DESIGN', 'exception/Exception.html', 0),
(226, 0, 'T0226', '/nobody/nUser/cUser/admin/', 'InvalidQueryException', 15, 3, 'EXCEPTION_DESIGN', 'exception/InvalidQueryException.html', 0),
(227, 0, 'T0227', '/nobody/nUser/cUser/admin/', 'IllegalAccessException', 15, 3, 'EXCEPTION_DESIGN', 'exception/IllegalAccessException.html', 0),
(228, 0, 'T0228', '/nobody/nUser/cUser/admin/', 'FileIOException', 15, 3, 'EXCEPTION_DESIGN', 'exception/FileIOException.html', 0),
(229, 0, 'T0229', '/nobody/nUser/cUser/admin/', 'UpdateFailedException', 15, 3, 'EXCEPTION_DESIGN', 'exception/UpdateFailedException.html', 0),
(230, 0, 'T0230', '/nobody/nUser/cUser/admin/', 'OutputFailedException', 15, 3, 'EXCEPTION_DESIGN', 'exception/OutputFailedException.html', 0),
(231, 0, 'T0231', '/nobody/nUser/cUser/admin/', 'RuntimeException', 15, 3, 'EXCEPTION_DESIGN', 'exception/RuntimeException.html', 0),
(232, 0, 'T0232', '/nobody/nUser/cUser/admin/', 'InvalidArgumentException', 15, 3, 'EXCEPTION_DESIGN', 'exception/InvalidArgumentException.html', 0),
(233, 0, 'T0233', '/nobody/nUser/cUser/admin/', 'InvalidCCArgumentException', 15, 3, 'EXCEPTION_DESIGN', 'exception/InvalidCCArgumentException.html', 0),
(234, 0, 'T0234', '/report/', '', 15, 3, 'REPORT_CASE_NOT_FOUND', 'module/report/Report_case_not_found.html', 0),
(235, 0, 'T0235', '/report/', '', 15, 3, 'REPORT_LINK_LIST', 'module/report/Report_list.html', 0),
(236, 0, 'T0236', '/report/', '', 15, 3, 'REPORT_PARTS', 'module/report/Report_parts.html', 0),
(237, 0, 'T0237', '/report/', '', 15, 3, 'REPORT_DESIGN', 'module/report/Report.html', 0),
(238, 0, 'T0238', '/nobody/', 'secretAdwares', 15, 3, 'INFO_PAGE_DESIGN', 'module/secretAdwares/InfoOuter.html', 0),
(239, 0, 'T0239', '/nUser/', 'secretAdwares', 4, 3, 'SEARCH_RESULT_DESIGN', 'module/secretAdwares/SearchResultFormat.html', 0),
(240, 0, 'T0240', '/nUser/', 'secretAdwares', 4, 3, 'SEARCH_LIST_PAGE_DESIGN', 'module/secretAdwares/List.html', 0),
(241, 0, 'T0241', '/nUser/', 'secretAdwares', 4, 3, 'SEARCH_NOT_FOUND_DESIGN', 'module/secretAdwares/SearchFailed.html', 0),
(242, 0, 'T0242', '/nUser/', 'secretAdwares', 4, 3, 'INFO_PAGE_DESIGN', 'module/secretAdwares/Info.html', 0),
(243, 0, 'T0243', '/admin/', 'secretAdwares', 6, 3, 'REGIST_FORM_PAGE_DESIGN', 'module/secretAdwares/RegistAdmin.html', 0),
(244, 0, 'T0244', '/admin/', 'secretAdwares', 6, 3, 'REGIST_CHECK_PAGE_DESIGN', 'module/secretAdwares/RegistCheck.html', 0),
(245, 0, 'T0245', '/admin/', 'secretAdwares', 6, 3, 'REGIST_COMP_PAGE_DESIGN', 'module/secretAdwares/RegistComp.html', 0),
(246, 0, 'T0246', '/admin/', 'secretAdwares', 6, 3, 'REGIST_ERROR_DESIGN', 'module/secretAdwares/RegistFailed.html', 0),
(247, 0, 'T0247', '/admin/', 'secretAdwares', 6, 3, 'EDIT_FORM_PAGE_DESIGN', 'module/secretAdwares/Edit.html', 0),
(248, 0, 'T0248', '/admin/', 'secretAdwares', 6, 3, 'EDIT_CHECK_PAGE_DESIGN', 'module/secretAdwares/EditCheck.html', 0),
(249, 0, 'T0249', '/admin/', 'secretAdwares', 6, 3, 'EDIT_COMP_PAGE_DESIGN', 'base/EditComp.html', 0),
(250, 0, 'T0250', '/admin/', 'secretAdwares', 6, 3, 'DELETE_CHECK_PAGE_DESIGN', 'module/secretAdwares/DeleteCheck.html', 0),
(251, 0, 'T0251', '/admin/', 'secretAdwares', 6, 3, 'DELETE_COMP_PAGE_DESIGN', 'base/UserDeleteComp.html', 0),
(252, 0, 'T0252', '/admin/', 'secretAdwares', 6, 3, 'SEARCH_RESULT_DESIGN', 'module/secretAdwares/SearchResultFormat.html', 0),
(253, 0, 'T0253', '/admin/', 'secretAdwares', 6, 3, 'SEARCH_LIST_PAGE_DESIGN', 'module/secretAdwares/ListAdmin.html', 0),
(254, 0, 'T0254', '/admin/', 'secretAdwares', 6, 3, 'SEARCH_NOT_FOUND_DESIGN', 'module/secretAdwares/SearchFailed.html', 0),
(255, 0, 'T0255', '/admin/', 'secretAdwares', 6, 3, 'INFO_PAGE_DESIGN', 'module/secretAdwares/InfoAdmin.html', 0),
(256, 0, 'T0256', '/admin/', 'nUser', 6, 3, 'SEARCH_RESULT_DESIGN_SALIST', 'module/secretAdwares/NUserSearchResult.html', 0),
(257, 0, 'T0257', '/admin/', 'nUser', 6, 3, 'SEARCH_NOT_FOUND_DESIGN_SALIST', 'module/secretAdwares/NUserSearchFailed.html', 0),
(258, 0, 'T0258', '/admin/', 'nUser', 6, 3, 'SEARCH_LIST_PAGE_DESIGN_SALIST', 'module/secretAdwares/NUserList.html', 0),
(259, 0, 'T0259', '/admin/', '', 15, 3, 'DISABLED_PAY_MAIL', 'mail_contents/disabledPayMail.txt', 0),
(260, 0, 'T0260', '/nUser/', '', 15, 3, 'DISABLED_PAY_MAIL', 'mail_contents/disabledPayMailNUser.txt', 0),
(261, 0, 'T0261', '/cUser/', '', 15, 3, 'DISABLED_PAY_MAIL', 'mail_contents/disabledPayMailCUser.txt', 0),
(262, 0, 'T0262', '/admin/', '', 15, 3, 'RETURNSS_REGIST_MAIL', 'mail_contents/returnssRegist.txt', 0),
(263, 0, 'T0263', '/admin/', '', 15, 3, 'RETURNSS_ACCEPT_MAIL', 'mail_contents/returnssAccept.txt', 0),
(264, 0, 'T0264', '/admin/', '', 15, 3, 'RETURNSS_DENY_MAIL', 'mail_contents/returnssDeny.txt', 0),
(265, 0, 'T0265', '/reminder/', 'nUser', 15, 3, 'PASSWORD_RESET_FORM_DESIGN', 'module/reminder/nUser/ResetForm.html', 0),
(266, 0, 'T0266', '/reminder/', 'nUser', 15, 3, 'PASSWORD_RESET_COMP_DESIGN', 'module/reminder/nUser/ResetComp.html', 0),
(267, 0, 'T0267', '/reminder/', 'nUser', 15, 3, 'PASSWORD_RESET_FALED_DESIGN', 'module/reminder/nUser/ResetFaled.html', 0),
(268, 0, 'T0268', '/resetter/', 'nUser', 15, 3, 'SEND_MAIL', 'module/reminder/nUser/mail_contents/resetter.txt', 0),
(269, 0, 'T0269', '/reminder/', 'cUser', 15, 3, 'PASSWORD_RESET_FORM_DESIGN', 'module/reminder/cUser/ResetForm.html', 0),
(270, 0, 'T0270', '/reminder/', 'cUser', 15, 3, 'PASSWORD_RESET_COMP_DESIGN', 'module/reminder/cUser/ResetComp.html', 0),
(271, 0, 'T0271', '/reminder/', 'cUser', 15, 3, 'PASSWORD_RESET_FALED_DESIGN', 'module/reminder/cUser/ResetFaled.html', 0),
(272, 0, 'T0272', '/resetter/', 'cUser', 15, 3, 'SEND_MAIL', 'module/reminder/cUser/mail_contents/resetter.txt', 0),
(273, 0, 'T0273', '/admin/', 'page', 6, 3, 'REGIST_ERROR_DESIGN', 'page/RegistFaled.html', 0),
(274, 0, 'T0274', '/admin/', 'page', 6, 3, 'SEARCH_NOT_FOUND_DESIGN', 'page/SearchFaled.html', 0),
(275, 0, 'T0275', '//', 'cUser', 15, 3, 'ACTIVATE_MAIL', 'mail_contents/activateCUser.txt', 0),
(276, 0, 'T0276', '//', 'cUser', 15, 3, 'ACTIVATE_COMP_MAIL', 'mail_contents/activatecompCUser.txt', 0),
(277, 0, 'T0277', '//', 'cUser', 15, 3, 'REGIST_COMP_MAIL', 'mail_contents/registcompCUser.txt', 0),
(278, 0, 'T0278', '/cUser/', '', 15, 3, 'LOGIN_FALED_DESIGN', 'base/LoginFaled.html', 0),
(279, 0, 'T0279', '/cUser/', '', 15, 3, 'FOOT_DESIGN', 'base/Foot.html', 0),
(280, 0, 'T0280', '/cUser/', '', 15, 3, 'HEAD_DESIGN', 'base/Head.html', 0),
(281, 0, 'T0281', '/cUser/', '', 15, 3, 'ACTIVATE_DESIGN_HTML', 'base/Activate.html', 0),
(282, 0, 'T0282', '/cUser/', '', 15, 3, 'SEARCH_PAGE_CHANGE_DESIGN', 'base/SearchPageChange.html', 0),
(283, 0, 'T0283', '/admin/', 'cUser', 6, 3, 'EDIT_FORM_PAGE_DESIGN', 'cUser/Edit.html', 0),
(284, 0, 'T0284', '/admin/', 'cUser', 6, 3, 'EDIT_CHECK_PAGE_DESIGN', 'cUser/EditCheck.html', 0),
(285, 0, 'T0285', '/admin/', 'cUser', 6, 3, 'EDIT_COMP_PAGE_DESIGN', 'base/EditComp.html', 0),
(286, 0, 'T0286', '/admin/', 'cUser', 6, 3, 'REGIST_ERROR_DESIGN', 'cUser/RegistFaled.html', 0),
(287, 0, 'T0287', '/admin/', 'cUser', 6, 3, 'DELETE_CHECK_PAGE_DESIGN', 'cUser/DeleteCheck.html', 0),
(288, 0, 'T0288', '/admin/', 'cUser', 6, 3, 'DELETE_COMP_PAGE_DESIGN', 'base/UserDeleteComp.html', 0),
(289, 0, 'T0289', '/admin/', 'cUser', 6, 3, 'SEARCH_FORM_PAGE_DESIGN', 'cUser/SearchAdmin.html', 0),
(290, 0, 'T0290', '/admin/', 'cUser', 6, 3, 'SEARCH_RESULT_DESIGN', 'cUser/SearchResultFormatAdmin.html', 0),
(291, 0, 'T0291', '/admin/', 'cUser', 6, 3, 'SEARCH_LIST_PAGE_DESIGN', 'cUser/List.html', 0),
(292, 0, 'T0292', '/admin/', 'cUser', 6, 3, 'SEARCH_NOT_FOUND_DESIGN', 'cUser/SearchFaled.html', 0),
(293, 0, 'T0293', '/admin/', 'cUser', 6, 3, 'INFO_PAGE_DESIGN', 'cUser/InfoAdmin.html', 0),
(294, 0, 'T0294', '/nobody/', 'cUser', 6, 3, 'REGIST_FORM_PAGE_DESIGN', 'cUser/Regist.html', 0),
(295, 0, 'T0295', '/nobody/', 'cUser', 6, 3, 'REGIST_CHECK_PAGE_DESIGN', 'cUser/RegistCheck.html', 0),
(296, 0, 'T0296', '/nobody/', 'cUser', 6, 3, 'REGIST_COMP_PAGE_DESIGN', 'cUser/RegistComp.html', 0),
(297, 0, 'T0297', '/nobody/', 'cUser', 6, 3, 'REGIST_ERROR_DESIGN', 'cUser/RegistFaled.html', 0),
(298, 0, 'T0298', '/cUser/', 'cUser', 6, 1, 'EDIT_FORM_PAGE_DESIGN', 'cUser/Edit.html', 0),
(299, 0, 'T0299', '/cUser/', 'cUser', 6, 1, 'EDIT_CHECK_PAGE_DESIGN', 'cUser/EditCheck.html', 0),
(300, 0, 'T0300', '/cUser/', 'cUser', 6, 1, 'EDIT_COMP_PAGE_DESIGN', 'base/EditComp.html', 0),
(301, 0, 'T0301', '/cUser/', 'cUser', 6, 1, 'REGIST_ERROR_DESIGN', 'cUser/RegistFaled.html', 0),
(302, 0, 'T0302', '/cUser/', 'cUser', 6, 1, 'DELETE_CHECK_PAGE_DESIGN', 'cUser/DeleteCheck.html', 0),
(303, 0, 'T0303', '/cUser/', 'cUser', 6, 1, 'DELETE_COMP_PAGE_DESIGN', 'base/UserDeleteComp.html', 0),
(304, 0, 'T0304', '/cUser/', '', 2, 3, 'TOP_PAGE_DESIGN', 'cUser/LoginNotActive.html', 0),
(305, 0, 'T0305', '/cUser/', '', 4, 3, 'TOP_PAGE_DESIGN', 'cUser/Index.html', 0),
(306, 0, 'T0306', '/cUser/', '', 8, 3, 'TOP_PAGE_DESIGN', 'cUser/LoginDeny.html', 0),
(307, 0, 'T0307', '/cUser/', 'adwares', 4, 3, 'REGIST_FORM_PAGE_DESIGN', 'adwares/Regist.html', 0),
(308, 0, 'T0308', '/cUser/', 'adwares', 4, 3, 'REGIST_CHECK_PAGE_DESIGN', 'adwares/RegistCheck.html', 0),
(309, 0, 'T0309', '/cUser/', 'adwares', 4, 3, 'REGIST_COMP_PAGE_DESIGN', 'adwares/RegistComp.html', 0),
(310, 0, 'T0310', '/cUser/', 'adwares', 4, 3, 'REGIST_ERROR_DESIGN', 'adwares/RegistFaled.html', 0),
(311, 0, 'T0311', '/cUser/', 'adwares', 4, 3, 'SEARCH_RESULT_DESIGN', 'adwares/SearchResultFormat.html', 0),
(312, 0, 'T0312', '/cUser/', 'adwares', 4, 3, 'SEARCH_LIST_PAGE_DESIGN', 'adwares/ListCUser.html', 0),
(313, 0, 'T0313', '/cUser/', 'adwares', 4, 3, 'SEARCH_NOT_FOUND_DESIGN', 'adwares/SearchFaled.html', 0),
(314, 0, 'T0314', '/cUser/', 'access', 4, 3, 'SEARCH_RESULT_DESIGN', 'access/SearchResultFormatCUser.html', 0),
(315, 0, 'T0315', '/cUser/', 'access', 4, 3, 'SEARCH_LIST_PAGE_DESIGN', 'access/ListCUser.html', 0),
(316, 0, 'T0316', '/cUser/', 'access', 4, 3, 'SEARCH_NOT_FOUND_DESIGN', 'access/SearchFaled.html', 0),
(317, 0, 'T0317', '/cUser/', 'pay', 4, 3, 'SEARCH_RESULT_DESIGN', 'pay/SearchResultFormat.html', 0),
(318, 0, 'T0318', '/cUser/', 'pay', 4, 3, 'SEARCH_LIST_PAGE_DESIGN', 'pay/ListCUser.html', 0),
(319, 0, 'T0319', '/cUser/', 'pay', 4, 3, 'SEARCH_NOT_FOUND_DESIGN', 'pay/SearchFaled.html', 0),
(320, 0, 'T0320', '/cUser/', 'click_pay', 4, 3, 'SEARCH_RESULT_DESIGN', 'click_pay/SearchResultFormat.html', 0),
(321, 0, 'T0321', '/cUser/', 'click_pay', 4, 3, 'SEARCH_LIST_PAGE_DESIGN', 'click_pay/ListCUser.html', 0),
(322, 0, 'T0322', '/cUser/', 'click_pay', 4, 3, 'SEARCH_NOT_FOUND_DESIGN', 'click_pay/SearchFaled.html', 0),
(323, 0, 'T0323', '/cUser/', 'head', 4, 3, 'INCLUDE_DESIGN', 'include/HeadCLogin.html', 0),
(324, 0, 'T0324', '/cUser/', 'head', 10, 3, 'INCLUDE_DESIGN', 'include/HeadLoginDeny.html', 0),
(325, 0, 'T0325', '/cUser/', 'side_bar', 6, 3, 'INCLUDE_DESIGN', 'include/Side_barCUser.html', 0),
(326, 0, 'T0326', '/cUser/', '', 15, 3, 'HEAD_DESIGN_ADMIN_MODE', 'base/HeadAdminMode.html', 0),
(327, 0, 'T0327', '/cUser/', 'access4month', 6, 3, 'OTHER_PAGE_DESIGN', 'other/Access4Month.html', 0),
(328, 0, 'T0328', '/cUser/', 'access4day', 6, 3, 'OTHER_PAGE_DESIGN', 'other/Access4Day.html', 0),
(329, 0, 'T0329', '/cUser/', 'continue_pay', 4, 3, 'SEARCH_RESULT_DESIGN', 'continue_pay/SearchResultAdminFormat.html', 0),
(330, 0, 'T0330', '/cUser/', 'continue_pay', 4, 3, 'SEARCH_LIST_PAGE_DESIGN', 'continue_pay/ListCUser.html', 0),
(331, 0, 'T0331', '/cUser/', 'continue_pay', 4, 3, 'SEARCH_NOT_FOUND_DESIGN', 'continue_pay/SearchFaled.html', 0),
(332, 0, 'T0332', '/cUser/', 'pay_report', 6, 3, 'OTHER_PAGE_DESIGN', 'other/PayReportCUser.html', 0),
(333, 0, 'T0333', '/cUser/', '', 15, 3, 'PAY_MAIL', 'mail_contents/payMailCUser.txt', 0),
(334, 0, 'T0334', '/owner/', 'adwares', 4, 3, 'EDIT_FORM_PAGE_DESIGN', 'adwares/Edit.html', 0),
(335, 0, 'T0335', '/owner/', 'adwares', 4, 3, 'EDIT_CHECK_PAGE_DESIGN', 'adwares/EditCheck.html', 0),
(336, 0, 'T0336', '/owner/', 'adwares', 4, 3, 'EDIT_COMP_PAGE_DESIGN', 'base/EditComp.html', 0),
(337, 0, 'T0337', '/owner/', 'adwares', 4, 3, 'REGIST_ERROR_DESIGN', 'adwares/RegistFaled.html', 0),
(338, 0, 'T0338', '/owner/', 'adwares', 4, 3, 'DELETE_CHECK_PAGE_DESIGN', 'adwares/DeleteCheck.html', 0),
(339, 0, 'T0339', '/owner/', 'adwares', 4, 3, 'DELETE_COMP_PAGE_DESIGN', 'base/DeleteComp.html', 0),
(340, 0, 'T0340', '/reminder/', 'nUser', 15, 3, 'SEND_FALED_DESIGN', 'module/reminder/nUser/EmailSendFaled.html', 0),
(341, 0, 'T0341', '/reminder/', 'cUser', 15, 3, 'SEND_FORM_DESIGN', 'module/reminder/cUser/EmailSend.html', 0),
(342, 0, 'T0342', '/reminder/', 'cUser', 15, 3, 'SEND_COMP_DESIGN', 'module/reminder/cUser/EmailSendComp.html', 0),
(343, 0, 'T0343', '/reminder/', 'cUser', 15, 3, 'SEND_CHECK_DESIGN', 'module/reminder/cUser/EmailSendCheck.html', 0),
(344, 0, 'T0344', '/reminder/', 'cUser', 15, 3, 'SEND_FALED_DESIGN', 'module/reminder/cUser/EmailSendFaled.html', 0),
(345, 0, 'T0345', '/reminder/', 'cUser', 15, 3, 'SEND_MAIL', 'module/reminder/cUser/mail_contents/reminder.txt', 0),
(346, 0, 'T0346', '/cUser/', 'secretAdwares', 4, 3, 'REGIST_FORM_PAGE_DESIGN', 'module/secretAdwares/Regist.html', 0),
(347, 0, 'T0347', '/cUser/', 'secretAdwares', 4, 3, 'REGIST_CHECK_PAGE_DESIGN', 'module/secretAdwares/RegistCheck.html', 0),
(348, 0, 'T0348', '/cUser/', 'secretAdwares', 4, 3, 'REGIST_COMP_PAGE_DESIGN', 'module/secretAdwares/RegistComp.html', 0),
(349, 0, 'T0349', '/cUser/', 'secretAdwares', 4, 3, 'REGIST_ERROR_DESIGN', 'module/secretAdwares/RegistFailed.html', 0),
(350, 0, 'T0350', '/cUser/', 'secretAdwares', 4, 3, 'SEARCH_RESULT_DESIGN', 'module/secretAdwares/SearchResultFormat.html', 0),
(351, 0, 'T0351', '/cUser/', 'secretAdwares', 4, 3, 'SEARCH_NOT_FOUND_DESIGN', 'module/secretAdwares/SearchFailed.html', 0),
(352, 0, 'T0352', '/cUser/', 'secretAdwares', 4, 3, 'SEARCH_LIST_PAGE_DESIGN', 'module/secretAdwares/ListCUser.html', 0),
(353, 0, 'T0353', '/cUser/', 'nUser', 6, 3, 'SEARCH_RESULT_DESIGN_SALIST', 'module/secretAdwares/NUserSearchResult.html', 0),
(354, 0, 'T0354', '/cUser/', 'nUser', 6, 3, 'SEARCH_NOT_FOUND_DESIGN_SALIST', 'module/secretAdwares/NUserSearchFailed.html', 0),
(355, 0, 'T0355', '/cUser/', 'nUser', 6, 3, 'SEARCH_LIST_PAGE_DESIGN_SALIST', 'module/secretAdwares/NUserList.html', 0),
(356, 0, 'T0356', '/admin/', 'secretAdwares', 6, 3, 'EDIT_FORM_PAGE_DESIGN', 'module/secretAdwares/EditAdmin.html', 0),
(357, 0, 'T0357', '/owner/', 'secretAdwares', 4, 3, 'REGIST_ERROR_DESIGN', 'module/secretAdwares/RegistFailed.html', 0),
(358, 0, 'T0358', '/owner/', 'secretAdwares', 4, 3, 'EDIT_FORM_PAGE_DESIGN', 'module/secretAdwares/Edit.html', 0),
(359, 0, 'T0359', '/owner/', 'secretAdwares', 4, 3, 'EDIT_CHECK_PAGE_DESIGN', 'module/secretAdwares/EditCheck.html', 0),
(360, 0, 'T0360', '/owner/', 'secretAdwares', 4, 3, 'EDIT_COMP_PAGE_DESIGN', 'base/EditComp.html', 0),
(361, 0, 'T0361', '/owner/', 'secretAdwares', 4, 3, 'DELETE_CHECK_PAGE_DESIGN', 'module/secretAdwares/DeleteCheck.html', 0),
(362, 0, 'T0362', '/owner/', 'secretAdwares', 4, 3, 'DELETE_COMP_PAGE_DESIGN', 'base/UserDeleteComp.html', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `tier`
--

CREATE TABLE `tier` (
  `shadow_id` int(11) NOT NULL,
  `delete_key` tinyint(1) DEFAULT NULL,
  `id` char(33) DEFAULT NULL,
  `owner` char(8) DEFAULT NULL,
  `cuser` char(8) DEFAULT NULL,
  `tier` char(8) DEFAULT NULL,
  `adwares` char(8) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `tier1` int(11) DEFAULT NULL,
  `tier2` int(11) DEFAULT NULL,
  `tier3` int(11) DEFAULT NULL,
  `report_id` char(8) DEFAULT NULL,
  `regist` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

-- --------------------------------------------------------

--
-- テーブルの構造 `tool_admin_password`
--

CREATE TABLE `tool_admin_password` (
  `password` text
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

--
-- テーブルのデータのダンプ `tool_admin_password`
--

INSERT INTO `tool_admin_password` (`password`) VALUES
('21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- ビュー用の代替構造 `v_access_x10`
-- (実際のビューを参照するには下にあります)
--
CREATE TABLE `v_access_x10` (
`shadow_id` int(11)
,`delete_key` tinyint(1)
,`id` char(32)
,`ipaddress` varchar(16)
,`cookie` varchar(32)
,`adwares_type` char(32)
,`adwares` char(8)
,`cuser` char(8)
,`owner` char(8)
,`useragent` text
,`referer` text
,`state` int(11)
,`utn` varchar(128)
,`regist` int(11)
,`name` varchar(128)
,`adware_type` int(11)
,`approvable` int(11)
);

-- --------------------------------------------------------

--
-- ビュー用の代替構造 `v_access_x10_summary`
-- (実際のビューを参照するには下にあります)
--
CREATE TABLE `v_access_x10_summary` (
`adwares` char(8)
,`owner` char(8)
,`cnt` bigint(21)
,`adware_type` int(11)
,`approvable` int(11)
);

-- --------------------------------------------------------

--
-- ビュー用の代替構造 `v_adwares_x10`
-- (実際のビューを参照するには下にあります)
--
CREATE TABLE `v_adwares_x10` (
`kind` varchar(1)
,`shadow_id` int(11)
,`delete_key` tinyint(4)
,`id` char(8)
,`cuser` char(8)
,`comment` mediumtext
,`ad_text` varchar(128)
,`category` char(8)
,`banner` mediumtext
,`banner2` mediumtext
,`banner3` mediumtext
,`banner_m` mediumtext
,`banner_m2` mediumtext
,`banner_m3` mediumtext
,`url` varchar(255)
,`url_m` varchar(255)
,`url_over` varchar(255)
,`url_users` tinyint(4)
,`name` varchar(128)
,`money` varchar(10)
,`ad_type` varchar(10)
,`click_money` varchar(10)
,`continue_money` varchar(10)
,`continue_type` varchar(10)
,`limits` int(11)
,`limit_type` char(1)
,`money_count` int(11)
,`pay_count` int(11)
,`click_money_count` int(11)
,`continue_money_count` int(11)
,`span` int(11)
,`span_type` char(1)
,`use_cookie_interval` tinyint(4)
,`pay_span` int(11)
,`pay_span_type` char(1)
,`auto` char(1)
,`click_auto` char(1)
,`continue_auto` char(1)
,`check_type` varchar(10)
,`open` tinyint(4)
,`open_user` mediumtext
,`regist` int(11)
,`category_name` varchar(128)
,`adware_type` int(11)
,`approvable` int(11)
,`keyword` mediumtext
,`results` mediumtext
,`hashtag` mediumtext
,`denials` mediumtext
,`ngword` mediumtext
,`note` mediumtext
,`startdt` date
,`enddt` date
,`cnt_offer` bigint(21)
);

-- --------------------------------------------------------

--
-- ビュー用の代替構造 `v_click_pay_x10`
-- (実際のビューを参照するには下にあります)
--
CREATE TABLE `v_click_pay_x10` (
`shadow_id` int(11)
,`delete_key` tinyint(1)
,`id` char(32)
,`access_id` char(32)
,`owner` char(8)
,`adwares_type` varchar(32)
,`adwares` char(8)
,`cuser` char(8)
,`cost` int(11)
,`state` varchar(10)
,`is_notice` tinyint(1)
,`report_id` char(8)
,`regist` int(11)
,`name` varchar(128)
,`startdt` date
,`enddt` date
,`adware_type` int(11)
,`approvable` int(11)
);

-- --------------------------------------------------------

--
-- ビュー用の代替構造 `v_offer_x10`
-- (実際のビューを参照するには下にあります)
--
CREATE TABLE `v_offer_x10` (
`adware` varchar(8)
,`nuser` varchar(8)
,`status` int(11)
,`regist` int(11)
,`name` varchar(128)
,`adware_type` int(11)
,`approvable` int(11)
);

-- --------------------------------------------------------

--
-- ビュー用の代替構造 `v_offer_x10_by_status`
-- (実際のビューを参照するには下にあります)
--
CREATE TABLE `v_offer_x10_by_status` (
`adware` varchar(8)
,`cnt` bigint(21)
,`status` int(11)
);

-- --------------------------------------------------------

--
-- ビュー用の代替構造 `v_pay_x10`
-- (実際のビューを参照するには下にあります)
--
CREATE TABLE `v_pay_x10` (
`shadow_id` int(11)
,`delete_key` tinyint(1)
,`id` char(32)
,`access_id` char(32)
,`ipaddress` varchar(16)
,`cookie` varchar(32)
,`owner` char(8)
,`adwares_type` varchar(32)
,`adwares` char(8)
,`cuser` char(8)
,`cost` int(11)
,`sales` int(11)
,`froms` text
,`froms_sub` text
,`state` int(11)
,`is_notice` tinyint(1)
,`utn` varchar(128)
,`useragent` text
,`continue_uid` varchar(128)
,`report_id` char(8)
,`regist` int(11)
,`name` varchar(128)
,`startdt` date
,`enddt` date
,`adware_type` int(11)
,`approvable` int(11)
);

-- --------------------------------------------------------

--
-- ビュー用の代替構造 `v_pay_x10_2in1`
-- (実際のビューを参照するには下にあります)
--
CREATE TABLE `v_pay_x10_2in1` (
`shadow_id` int(11)
,`delete_key` tinyint(4)
,`id` char(32)
,`access_id` char(32)
,`owner` char(8)
,`adwares_type` varchar(32)
,`adwares` char(8)
,`cuser` char(8)
,`cost` int(11)
,`state` varchar(11)
,`is_notice` tinyint(4)
,`report_id` char(8)
,`regist` int(11)
,`name` varchar(128)
,`startdt` date
,`enddt` date
,`adware_type` int(11)
,`approvable` int(11)
);

-- --------------------------------------------------------

--
-- テーブルの構造 `x10_adwares`
--

CREATE TABLE `x10_adwares` (
  `shadow_id` int(11) NOT NULL,
  `id` varchar(8) NOT NULL,
  `adware_type` int(1) NOT NULL,
  `approvable` int(1) NOT NULL,
  `keyword` text NOT NULL,
  `results` text NOT NULL,
  `hashtag` text NOT NULL,
  `denials` text NOT NULL,
  `ngword` text NOT NULL,
  `note` text NOT NULL,
  `startdt` date DEFAULT NULL,
  `enddt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

--
-- テーブルのデータのダンプ `x10_adwares`
--

INSERT INTO `x10_adwares` (`shadow_id`, `id`, `adware_type`, `approvable`, `keyword`, `results`, `hashtag`, `denials`, `ngword`, `note`, `startdt`, `enddt`) VALUES
(1, 'A0000001', 0, 0, 'キーワ', 'せいか', 'はっし', 'ひにん', 'NGきー', 'びこー', '2020-01-01', '2020-03-01'),
(1, 'SA000001', 0, 1, 'aaaa', 'bbbb', 'cccc', 'dddd', 'eeee', 'ffff', '2020-02-01', '2020-03-01'),
(2, 'A0000002', 1, 0, '1111', '23233', '3333', '4444', '555', '666', NULL, NULL),
(2, 'SA000002', 1, 1, 'a1', 'a2', 'a3', 'a4', 'a5', 'a5', '2020-01-01', '2020-02-03'),
(3, 'A0000003', 0, 0, 'KeyWord', '', '', '', '', '', NULL, NULL),
(3, 'SA000003', 0, 1, '', '', '', '', '', '', '2020-01-01', '2020-02-01');

-- --------------------------------------------------------

--
-- テーブルの構造 `x10_nuser`
--

CREATE TABLE `x10_nuser` (
  `id` varchar(8) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `instagram` varchar(100) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `youtube` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

--
-- テーブルのデータのダンプ `x10_nuser`
--

INSERT INTO `x10_nuser` (`id`, `nickname`, `instagram`, `facebook`, `twitter`, `youtube`) VALUES
('N0000001', '', '', 'https://ja-jp.facebook.com/welcome.city.yokohama/', '', '');

-- --------------------------------------------------------

--
-- テーブルの構造 `x10_offer`
--

CREATE TABLE `x10_offer` (
  `adware` varchar(8) NOT NULL,
  `nuser` varchar(8) NOT NULL,
  `status` int(11) NOT NULL,
  `regist` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

--
-- テーブルのデータのダンプ `x10_offer`
--

INSERT INTO `x10_offer` (`adware`, `nuser`, `status`, `regist`) VALUES
('SA000001', 'N0000001', 2, 1581468229),
('SA000002', 'N0000001', 2, 1581485525),
('SA000003', 'N0000001', 2, 1582620728);

-- --------------------------------------------------------

--
-- ビュー用の代替構造 `x_all_adwares`
-- (実際のビューを参照するには下にあります)
--
CREATE TABLE `x_all_adwares` (
`id` char(8)
,`nuser` varchar(8)
,`status` bigint(11)
);

-- --------------------------------------------------------

--
-- テーブルの構造 `zenginkyo`
--

CREATE TABLE `zenginkyo` (
  `shadow_id` int(11) NOT NULL,
  `delete_key` tinyint(1) DEFAULT NULL,
  `id` char(5) DEFAULT NULL,
  `name_kana` varchar(128) DEFAULT NULL,
  `commission_code` varchar(16) DEFAULT NULL,
  `bank_code` varchar(4) DEFAULT NULL,
  `bank_name_kana` varchar(32) DEFAULT NULL,
  `branch_code` varchar(3) DEFAULT NULL,
  `branch_name_kana` varchar(32) DEFAULT NULL,
  `bank_type` varchar(1) DEFAULT NULL,
  `number` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

--
-- テーブルのデータのダンプ `zenginkyo`
--

INSERT INTO `zenginkyo` (`shadow_id`, `delete_key`, `id`, `name_kana`, `commission_code`, `bank_code`, `bank_name_kana`, `branch_code`, `branch_name_kana`, `bank_type`, `number`) VALUES
(1, 0, 'ADMIN', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- ビュー用の構造 `v_access_x10`
--
DROP TABLE IF EXISTS `v_access_x10`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_access_x10`  AS  select `a`.`shadow_id` AS `shadow_id`,`a`.`delete_key` AS `delete_key`,`a`.`id` AS `id`,`a`.`ipaddress` AS `ipaddress`,`a`.`cookie` AS `cookie`,`a`.`adwares_type` AS `adwares_type`,`a`.`adwares` AS `adwares`,`a`.`cuser` AS `cuser`,`a`.`owner` AS `owner`,`a`.`useragent` AS `useragent`,`a`.`referer` AS `referer`,`a`.`state` AS `state`,`a`.`utn` AS `utn`,`a`.`regist` AS `regist`,`x`.`name` AS `name`,`x`.`adware_type` AS `adware_type`,`x`.`approvable` AS `approvable` from (`access` `a` left join `v_adwares_x10` `x` on((`a`.`adwares` = `x`.`id`))) ;

-- --------------------------------------------------------

--
-- ビュー用の構造 `v_access_x10_summary`
--
DROP TABLE IF EXISTS `v_access_x10_summary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_access_x10_summary`  AS  select `v_access_x10`.`adwares` AS `adwares`,`v_access_x10`.`owner` AS `owner`,count(0) AS `cnt`,`v_access_x10`.`adware_type` AS `adware_type`,`v_access_x10`.`approvable` AS `approvable` from `v_access_x10` group by `v_access_x10`.`adwares`,`v_access_x10`.`owner`,`v_access_x10`.`adware_type`,`v_access_x10`.`approvable` ;

-- --------------------------------------------------------

--
-- ビュー用の構造 `v_adwares_x10`
--
DROP TABLE IF EXISTS `v_adwares_x10`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_adwares_x10`  AS  (select '0' AS `kind`,`s`.`shadow_id` AS `shadow_id`,`s`.`delete_key` AS `delete_key`,`s`.`id` AS `id`,`s`.`cuser` AS `cuser`,`s`.`comment` AS `comment`,`s`.`ad_text` AS `ad_text`,`s`.`category` AS `category`,`s`.`banner` AS `banner`,`s`.`banner2` AS `banner2`,`s`.`banner3` AS `banner3`,`s`.`banner_m` AS `banner_m`,`s`.`banner_m2` AS `banner_m2`,`s`.`banner_m3` AS `banner_m3`,`s`.`url` AS `url`,`s`.`url_m` AS `url_m`,`s`.`url_over` AS `url_over`,`s`.`url_users` AS `url_users`,`s`.`name` AS `name`,`s`.`money` AS `money`,`s`.`ad_type` AS `ad_type`,`s`.`click_money` AS `click_money`,`s`.`continue_money` AS `continue_money`,`s`.`continue_type` AS `continue_type`,`s`.`limits` AS `limits`,`s`.`limit_type` AS `limit_type`,`s`.`money_count` AS `money_count`,`s`.`pay_count` AS `pay_count`,`s`.`click_money_count` AS `click_money_count`,`s`.`continue_money_count` AS `continue_money_count`,`s`.`span` AS `span`,`s`.`span_type` AS `span_type`,`s`.`use_cookie_interval` AS `use_cookie_interval`,`s`.`pay_span` AS `pay_span`,`s`.`pay_span_type` AS `pay_span_type`,`s`.`auto` AS `auto`,`s`.`click_auto` AS `click_auto`,`s`.`continue_auto` AS `continue_auto`,`s`.`check_type` AS `check_type`,`s`.`open` AS `open`,'' AS `open_user`,`s`.`regist` AS `regist`,`c`.`name` AS `category_name`,`x`.`adware_type` AS `adware_type`,`x`.`approvable` AS `approvable`,`x`.`keyword` AS `keyword`,`x`.`results` AS `results`,`x`.`hashtag` AS `hashtag`,`x`.`denials` AS `denials`,`x`.`ngword` AS `ngword`,`x`.`note` AS `note`,`x`.`startdt` AS `startdt`,`x`.`enddt` AS `enddt`,(case when isnull(`v`.`cnt`) then 0 else `v`.`cnt` end) AS `cnt_offer` from (((`adwares` `s` left join `x10_adwares` `x` on((`s`.`id` = `x`.`id`))) left join `category` `c` on((`s`.`category` = `c`.`id`))) left join `v_offer_x10_by_status` `v` on(((`s`.`id` = `v`.`adware`) and (`v`.`status` = 0))))) union (select '1' AS `kind`,`s`.`shadow_id` AS `shadow_id`,`s`.`delete_key` AS `delete_key`,`s`.`id` AS `id`,`s`.`cuser` AS `cuser`,`s`.`comment` AS `comment`,`s`.`ad_text` AS `ad_text`,`s`.`category` AS `category`,`s`.`banner` AS `banner`,`s`.`banner2` AS `banner2`,`s`.`banner3` AS `banner3`,`s`.`banner_m` AS `banner_m`,`s`.`banner_m2` AS `banner_m2`,`s`.`banner_m3` AS `banner_m3`,`s`.`url` AS `url`,`s`.`url_m` AS `url_m`,`s`.`url_over` AS `url_over`,`s`.`url_users` AS `url_users`,`s`.`name` AS `name`,`s`.`money` AS `money`,`s`.`ad_type` AS `ad_type`,`s`.`click_money` AS `click_money`,`s`.`continue_money` AS `continue_money`,`s`.`continue_type` AS `continue_type`,`s`.`limits` AS `limits`,`s`.`limit_type` AS `limit_type`,`s`.`money_count` AS `money_count`,`s`.`pay_count` AS `pay_count`,`s`.`click_money_count` AS `click_money_count`,`s`.`continue_money_count` AS `continue_money_count`,`s`.`span` AS `span`,`s`.`span_type` AS `span_type`,`s`.`use_cookie_interval` AS `use_cookie_interval`,`s`.`pay_span` AS `pay_span`,`s`.`pay_span_type` AS `pay_span_type`,`s`.`auto` AS `auto`,`s`.`click_auto` AS `click_auto`,`s`.`continue_auto` AS `continue_auto`,`s`.`check_type` AS `check_type`,`s`.`open` AS `open`,`s`.`open_user` AS `open_user`,`s`.`regist` AS `regist`,`c`.`name` AS `category_name`,`x`.`adware_type` AS `adware_type`,`x`.`approvable` AS `approvable`,`x`.`keyword` AS `keyword`,`x`.`results` AS `results`,`x`.`hashtag` AS `hashtag`,`x`.`denials` AS `denials`,`x`.`ngword` AS `ngword`,`x`.`note` AS `note`,`x`.`startdt` AS `startdt`,`x`.`enddt` AS `enddt`,(case when isnull(`v`.`cnt`) then 0 else `v`.`cnt` end) AS `cnt_offer` from (((`secretadwares` `s` left join `x10_adwares` `x` on((`s`.`id` = `x`.`id`))) left join `category` `c` on((`s`.`category` = `c`.`id`))) left join `v_offer_x10_by_status` `v` on(((`s`.`id` = `v`.`adware`) and (`v`.`status` = 0))))) ;

-- --------------------------------------------------------

--
-- ビュー用の構造 `v_click_pay_x10`
--
DROP TABLE IF EXISTS `v_click_pay_x10`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_click_pay_x10`  AS  select `p`.`shadow_id` AS `shadow_id`,`p`.`delete_key` AS `delete_key`,`p`.`id` AS `id`,`p`.`access_id` AS `access_id`,`p`.`owner` AS `owner`,`p`.`adwares_type` AS `adwares_type`,`p`.`adwares` AS `adwares`,`p`.`cuser` AS `cuser`,`p`.`cost` AS `cost`,`p`.`state` AS `state`,`p`.`is_notice` AS `is_notice`,`p`.`report_id` AS `report_id`,`p`.`regist` AS `regist`,`x`.`name` AS `name`,`x`.`startdt` AS `startdt`,`x`.`enddt` AS `enddt`,`x`.`adware_type` AS `adware_type`,`x`.`approvable` AS `approvable` from (`click_pay` `p` left join `v_adwares_x10` `x` on((`p`.`adwares` = `x`.`id`))) ;

-- --------------------------------------------------------

--
-- ビュー用の構造 `v_offer_x10`
--
DROP TABLE IF EXISTS `v_offer_x10`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_offer_x10`  AS  select `X`.`adware` AS `adware`,`X`.`nuser` AS `nuser`,`X`.`status` AS `status`,`X`.`regist` AS `regist`,`v`.`name` AS `name`,`v`.`adware_type` AS `adware_type`,`v`.`approvable` AS `approvable` from (`x10_offer` `X` left join `v_adwares_x10` `v` on((`X`.`adware` = `v`.`id`))) ;

-- --------------------------------------------------------

--
-- ビュー用の構造 `v_offer_x10_by_status`
--
DROP TABLE IF EXISTS `v_offer_x10_by_status`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_offer_x10_by_status`  AS  select `x10_offer`.`adware` AS `adware`,count(0) AS `cnt`,`x10_offer`.`status` AS `status` from `x10_offer` group by `x10_offer`.`adware`,`x10_offer`.`status` ;

-- --------------------------------------------------------

--
-- ビュー用の構造 `v_pay_x10`
--
DROP TABLE IF EXISTS `v_pay_x10`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pay_x10`  AS  select `p`.`shadow_id` AS `shadow_id`,`p`.`delete_key` AS `delete_key`,`p`.`id` AS `id`,`p`.`access_id` AS `access_id`,`p`.`ipaddress` AS `ipaddress`,`p`.`cookie` AS `cookie`,`p`.`owner` AS `owner`,`p`.`adwares_type` AS `adwares_type`,`p`.`adwares` AS `adwares`,`p`.`cuser` AS `cuser`,`p`.`cost` AS `cost`,`p`.`sales` AS `sales`,`p`.`froms` AS `froms`,`p`.`froms_sub` AS `froms_sub`,`p`.`state` AS `state`,`p`.`is_notice` AS `is_notice`,`p`.`utn` AS `utn`,`p`.`useragent` AS `useragent`,`p`.`continue_uid` AS `continue_uid`,`p`.`report_id` AS `report_id`,`p`.`regist` AS `regist`,`x`.`name` AS `name`,`x`.`startdt` AS `startdt`,`x`.`enddt` AS `enddt`,`x`.`adware_type` AS `adware_type`,`x`.`approvable` AS `approvable` from (`pay` `p` left join `v_adwares_x10` `x` on((`p`.`adwares` = `x`.`id`))) ;

-- --------------------------------------------------------

--
-- ビュー用の構造 `v_pay_x10_2in1`
--
DROP TABLE IF EXISTS `v_pay_x10_2in1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pay_x10_2in1`  AS  select `p`.`shadow_id` AS `shadow_id`,`p`.`delete_key` AS `delete_key`,`p`.`id` AS `id`,`p`.`access_id` AS `access_id`,`p`.`owner` AS `owner`,`p`.`adwares_type` AS `adwares_type`,`p`.`adwares` AS `adwares`,`p`.`cuser` AS `cuser`,`p`.`cost` AS `cost`,`p`.`state` AS `state`,`p`.`is_notice` AS `is_notice`,`p`.`report_id` AS `report_id`,`p`.`regist` AS `regist`,`x`.`name` AS `name`,`x`.`startdt` AS `startdt`,`x`.`enddt` AS `enddt`,`x`.`adware_type` AS `adware_type`,`x`.`approvable` AS `approvable` from (`pay` `p` left join `v_adwares_x10` `x` on((`p`.`adwares` = `x`.`id`))) union select `p`.`shadow_id` AS `shadow_id`,`p`.`delete_key` AS `delete_key`,`p`.`id` AS `id`,`p`.`access_id` AS `access_id`,`p`.`owner` AS `owner`,`p`.`adwares_type` AS `adwares_type`,`p`.`adwares` AS `adwares`,`p`.`cuser` AS `cuser`,`p`.`cost` AS `cost`,`p`.`state` AS `state`,`p`.`is_notice` AS `is_notice`,`p`.`report_id` AS `report_id`,`p`.`regist` AS `regist`,`x`.`name` AS `name`,`x`.`startdt` AS `startdt`,`x`.`enddt` AS `enddt`,`x`.`adware_type` AS `adware_type`,`x`.`approvable` AS `approvable` from (`click_pay` `p` left join `v_adwares_x10` `x` on((`p`.`adwares` = `x`.`id`))) ;

-- --------------------------------------------------------

--
-- ビュー用の構造 `x_all_adwares`
--
DROP TABLE IF EXISTS `x_all_adwares`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x_all_adwares`  AS  select `a`.`id` AS `id`,'OPN' AS `nuser`,2 AS `status` from `adwares` `a` union select `s`.`id` AS `id`,`x`.`nuser` AS `nuser`,`x`.`status` AS `status` from (`secretadwares` `s` left join `x10_offer` `x` on((`s`.`id` = `x`.`adware`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`shadow_id`),
  ADD UNIQUE KEY `system_id` (`id`);

--
-- Indexes for table `accountlock`
--
ALTER TABLE `accountlock`
  ADD PRIMARY KEY (`shadow_id`),
  ADD UNIQUE KEY `system_id` (`id`);

--
-- Indexes for table `accountlockconfig`
--
ALTER TABLE `accountlockconfig`
  ADD PRIMARY KEY (`shadow_id`),
  ADD UNIQUE KEY `system_id` (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`shadow_id`),
  ADD UNIQUE KEY `system_id` (`id`);

--
-- Indexes for table `adwares`
--
ALTER TABLE `adwares`
  ADD PRIMARY KEY (`shadow_id`),
  ADD UNIQUE KEY `system_id` (`id`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`shadow_id`),
  ADD UNIQUE KEY `system_id` (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`shadow_id`),
  ADD UNIQUE KEY `system_id` (`id`);

--
-- Indexes for table `click_pay`
--
ALTER TABLE `click_pay`
  ADD PRIMARY KEY (`shadow_id`),
  ADD UNIQUE KEY `system_id` (`id`);

--
-- Indexes for table `continue_pay`
--
ALTER TABLE `continue_pay`
  ADD PRIMARY KEY (`shadow_id`),
  ADD UNIQUE KEY `system_id` (`id`);

--
-- Indexes for table `cuser`
--
ALTER TABLE `cuser`
  ADD PRIMARY KEY (`shadow_id`),
  ADD UNIQUE KEY `system_id` (`id`);

--
-- Indexes for table `invitation`
--
ALTER TABLE `invitation`
  ADD PRIMARY KEY (`shadow_id`),
  ADD UNIQUE KEY `system_id` (`id`);

--
-- Indexes for table `log_pay`
--
ALTER TABLE `log_pay`
  ADD PRIMARY KEY (`shadow_id`),
  ADD UNIQUE KEY `system_id` (`id`);

--
-- Indexes for table `multimail`
--
ALTER TABLE `multimail`
  ADD PRIMARY KEY (`shadow_id`),
  ADD UNIQUE KEY `system_id` (`id`);

--
-- Indexes for table `nuser`
--
ALTER TABLE `nuser`
  ADD PRIMARY KEY (`shadow_id`),
  ADD UNIQUE KEY `system_id` (`id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`shadow_id`),
  ADD UNIQUE KEY `system_id` (`id`);

--
-- Indexes for table `pay`
--
ALTER TABLE `pay`
  ADD PRIMARY KEY (`shadow_id`),
  ADD UNIQUE KEY `system_id` (`id`);

--
-- Indexes for table `prefectures`
--
ALTER TABLE `prefectures`
  ADD PRIMARY KEY (`shadow_id`),
  ADD UNIQUE KEY `system_id` (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`shadow_id`),
  ADD UNIQUE KEY `system_id` (`id`);

--
-- Indexes for table `returnss`
--
ALTER TABLE `returnss`
  ADD PRIMARY KEY (`shadow_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`shadow_id`),
  ADD UNIQUE KEY `system_id` (`id`);

--
-- Indexes for table `secretadwares`
--
ALTER TABLE `secretadwares`
  ADD PRIMARY KEY (`shadow_id`),
  ADD UNIQUE KEY `system_id` (`id`);

--
-- Indexes for table `system`
--
ALTER TABLE `system`
  ADD PRIMARY KEY (`shadow_id`),
  ADD UNIQUE KEY `system_id` (`id`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`shadow_id`),
  ADD UNIQUE KEY `system_id` (`id`);

--
-- Indexes for table `tier`
--
ALTER TABLE `tier`
  ADD PRIMARY KEY (`shadow_id`),
  ADD UNIQUE KEY `system_id` (`id`);

--
-- Indexes for table `zenginkyo`
--
ALTER TABLE `zenginkyo`
  ADD PRIMARY KEY (`shadow_id`),
  ADD UNIQUE KEY `system_id` (`id`);
