-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 21, 2019 at 06:04 PM
-- Server version: 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `sche`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `groups_seq` int(11) NOT NULL,
  `groups_id` text NOT NULL,
  `groups_name` varchar(40) NOT NULL,
  `parent_groups_seq` int(11) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_users_seq` int(11) NOT NULL,
  `create_users_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`groups_seq`, `groups_id`, `groups_name`, `parent_groups_seq`, `create_date`, `create_users_seq`, `create_users_name`) VALUES
(25, '25-', '本社', 0, '2019-09-05 17:43:10', 1, 'あどみん'),
(26, '26-', '支社', 0, '2019-09-05 17:43:17', 1, 'あどみん'),
(27, '25-27-', '経理', 25, '2019-09-05 17:43:23', 1, 'あどみん'),
(28, '26-28-', '計算', 26, '2019-09-05 17:43:36', 1, 'あどみん'),
(29, '25-27-29-', '集計', 27, '2019-09-05 17:43:43', 1, 'あどみん'),
(30, '26-28-30-', '合計', 28, '2019-09-05 17:43:52', 1, 'あどみん'),
(32, '25-32-', 'システム部', 25, '2019-09-10 17:50:49', 1, 'あどみん'),
(33, '25-32-33-', '保守', 32, '2019-09-10 17:51:00', 1, 'あどみん'),
(34, '25-32-34-', '開発G', 32, '2019-09-10 17:51:13', 1, 'あどみん'),
(35, '', 'test', 0, '2019-09-12 18:11:11', 1, 'あどみん'),
(36, '', 'tesyt', 0, '2019-09-12 18:11:31', 1, 'あどみん'),
(37, '', 'tesyt2', 0, '2019-09-12 18:12:11', 1, 'あどみん'),
(38, '38-', 'test12', 0, '2019-10-21 17:48:19', 1, 'あどみん');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `rooms_seq` int(11) NOT NULL,
  `rooms_name` varchar(20) NOT NULL,
  `rooms_text` text NOT NULL,
  `del_flg` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`rooms_seq`, `rooms_name`, `rooms_text`, `del_flg`) VALUES
(1, '第一会議室', 'だい１', 1),
(2, '第二会議室', '第二\r\n', 0),
(3, 'RoomA', 'aa', 0);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `sche_seq` int(11) NOT NULL,
  `users_seq` int(11) NOT NULL,
  `sche_start_dt` datetime NOT NULL,
  `sche_start_ymd` varchar(8) NOT NULL,
  `sche_start_ym` varchar(6) NOT NULL,
  `sche_start_hm` varchar(4) NOT NULL,
  `sche_end_dt` datetime NOT NULL,
  `sche_end_ymd` varchar(8) NOT NULL,
  `sche_end_ym` varchar(6) NOT NULL,
  `sche_end_hm` varchar(4) NOT NULL,
  `sche_title` varchar(50) NOT NULL,
  `sche_note` text NOT NULL,
  `sche_type` int(2) NOT NULL,
  `sche_allday` int(1) NOT NULL DEFAULT '0',
  `rooms_seq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`sche_seq`, `users_seq`, `sche_start_dt`, `sche_start_ymd`, `sche_start_ym`, `sche_start_hm`, `sche_end_dt`, `sche_end_ymd`, `sche_end_ym`, `sche_end_hm`, `sche_title`, `sche_note`, `sche_type`, `sche_allday`, `rooms_seq`) VALUES
(1, 1, '2019-09-04 10:00:00', '20190904', '201909', '1000', '2019-09-04 18:45:00', '20190904', '201909', '1845', 'TEST', 'これは本人の\r\nテキストめもです', 1, 0, 0),
(2, 1, '2019-09-04 17:00:00', '20190904', '201909', '1700', '2019-09-04 20:00:00', '20190904', '201909', '2000', 'title2', 'これは\r\n別のユーザの\r\n\r\n改行のめもです。', 2, 0, 0),
(3, 1, '2019-09-09 18:00:00', '20190909', '201909', '1800', '2019-09-11 21:00:00', '20190911', '201909', '2100', 'test33', 'test\r\nert\r\n', 2, 0, 0),
(4, 1, '2019-09-09 18:07:00', '20190909', '201909', '1807', '2019-09-09 21:21:00', '20190909', '201909', '2121', '12112121121121211211212112112121', '2121212', 1, 0, 0),
(9, 4, '2019-09-09 09:00:00', '20190909', '201909', '0900', '2019-09-11 15:58:00', '20190911', '201909', '1558', 'システム部一般', 'test-test', 1, 0, 0),
(10, 5, '2019-09-05 10:00:00', '20190905', '201909', '1000', '2019-09-06 18:00:00', '20190906', '201909', '1800', '保守メモ', 'qqq', 1, 0, 0),
(11, 6, '2019-09-11 18:07:00', '20190911', '201909', '1807', '2019-09-11 21:07:00', '20190911', '201909', '2107', '経理メモ', '', 2, 0, 0),
(12, 1, '2019-09-11 09:07:00', '20190911', '201909', '0907', '2019-09-11 17:07:00', '20190911', '201909', '1707', '自分非公開', 'てst', 2, 0, 0),
(13, 9, '2019-10-15 10:00:00', '20191015', '201910', '1000', '2019-10-15 11:00:00', '20191015', '201910', '1100', 'システム会議', '', 1, 0, 0),
(14, 10, '2019-10-15 12:00:00', '20191015', '201910', '1200', '2019-10-15 14:00:00', '20191015', '201910', '1400', '運用会議', '', 1, 0, 0),
(15, 1, '2019-10-16 10:24:00', '20191016', '201910', '1024', '2019-10-16 14:24:00', '20191016', '201910', '1424', 'Admin', 'AAAADDDMMMIIINNN', 1, 0, 0),
(18, 1, '2019-10-17 00:00:00', '20191017', '201910', '0000', '2019-10-17 23:59:00', '20191017', '201910', '2359', 'AllDayEvent', '', 1, 1, 0),
(19, 1, '2019-10-18 00:00:00', '20191018', '201910', '0000', '2019-10-20 23:59:00', '20191020', '201910', '2359', 'TwoDays', '', 1, 1, 3),
(20, 1, '2019-10-08 13:39:00', '20191008', '201910', '1339', '2019-10-08 15:39:00', '20191008', '201910', '1539', '会議室利用', '', 1, 0, 2),
(21, 11, '2019-10-11 17:49:00', '20191011', '201910', '1749', '2019-10-11 20:49:00', '20191011', '201910', '2049', 'RA testUser', '', 2, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_seq` int(11) NOT NULL,
  `users_id` varchar(20) NOT NULL,
  `users_pw` varchar(20) NOT NULL,
  `users_name` varchar(30) NOT NULL,
  `users_level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_seq`, `users_id`, `users_pw`, `users_name`, `users_level`) VALUES
(1, '123', '456', 'あどみん', 1),
(8, '111', '111', '１１１', 2),
(9, '0010', '0010', 'システム部 ユーザ', 2),
(10, '0011', '0011', '保守　ユーザ', 2),
(11, '44', '44', 'MrTEST', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `users_seq` int(11) NOT NULL,
  `groups_seq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`users_seq`, `groups_seq`) VALUES
(1, 27),
(1, 32),
(8, 27),
(8, 29),
(9, 32),
(10, 33),
(11, 38);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_schedules`
-- (See below for the actual view)
--
CREATE TABLE `v_schedules` (
`sche_seq` int(11)
,`users_seq` int(11)
,`sche_start_dt` datetime
,`sche_start_ymd` varchar(8)
,`sche_start_ym` varchar(6)
,`sche_start_hm` varchar(4)
,`sche_end_dt` datetime
,`sche_end_ymd` varchar(8)
,`sche_end_ym` varchar(6)
,`sche_end_hm` varchar(4)
,`sche_title` varchar(50)
,`sche_allday` int(1)
,`sche_note` text
,`sche_type` int(2)
,`groups_id` text
,`groups_name` varchar(40)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_schedules_user`
-- (See below for the actual view)
--
CREATE TABLE `v_schedules_user` (
`sche_seq` int(11)
,`users_seq` int(11)
,`sche_start_dt` datetime
,`sche_start_ymd` varchar(8)
,`sche_start_ym` varchar(6)
,`sche_start_hm` varchar(4)
,`sche_end_dt` datetime
,`sche_end_ymd` varchar(8)
,`sche_end_ym` varchar(6)
,`sche_end_hm` varchar(4)
,`sche_title` varchar(50)
,`sche_note` text
,`sche_type` int(2)
,`sche_allday` int(1)
,`rooms_seq` int(11)
,`users_name` varchar(30)
,`rooms_name` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_user_group`
-- (See below for the actual view)
--
CREATE TABLE `v_user_group` (
`users_seq` int(11)
,`groups_seq` int(11)
,`groups_id` text
,`groups_name` varchar(40)
);

-- --------------------------------------------------------

--
-- Structure for view `v_schedules`
--
DROP TABLE IF EXISTS `v_schedules`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_schedules`  AS  select `s`.`sche_seq` AS `sche_seq`,`s`.`users_seq` AS `users_seq`,`s`.`sche_start_dt` AS `sche_start_dt`,`s`.`sche_start_ymd` AS `sche_start_ymd`,`s`.`sche_start_ym` AS `sche_start_ym`,`s`.`sche_start_hm` AS `sche_start_hm`,`s`.`sche_end_dt` AS `sche_end_dt`,`s`.`sche_end_ymd` AS `sche_end_ymd`,`s`.`sche_end_ym` AS `sche_end_ym`,`s`.`sche_end_hm` AS `sche_end_hm`,`s`.`sche_title` AS `sche_title`,`s`.`sche_allday` AS `sche_allday`,`s`.`sche_note` AS `sche_note`,`s`.`sche_type` AS `sche_type`,`g`.`groups_id` AS `groups_id`,`g`.`groups_name` AS `groups_name` from ((`schedules` `s` left join `user_group` `ug` on((`s`.`users_seq` = `ug`.`users_seq`))) left join `groups` `g` on((`ug`.`groups_seq` = `g`.`groups_seq`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v_schedules_user`
--
DROP TABLE IF EXISTS `v_schedules_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_schedules_user`  AS  select `s`.`sche_seq` AS `sche_seq`,`s`.`users_seq` AS `users_seq`,`s`.`sche_start_dt` AS `sche_start_dt`,`s`.`sche_start_ymd` AS `sche_start_ymd`,`s`.`sche_start_ym` AS `sche_start_ym`,`s`.`sche_start_hm` AS `sche_start_hm`,`s`.`sche_end_dt` AS `sche_end_dt`,`s`.`sche_end_ymd` AS `sche_end_ymd`,`s`.`sche_end_ym` AS `sche_end_ym`,`s`.`sche_end_hm` AS `sche_end_hm`,`s`.`sche_title` AS `sche_title`,`s`.`sche_note` AS `sche_note`,`s`.`sche_type` AS `sche_type`,`s`.`sche_allday` AS `sche_allday`,`s`.`rooms_seq` AS `rooms_seq`,`u`.`users_name` AS `users_name`,`r`.`rooms_name` AS `rooms_name` from ((`schedules` `s` left join `users` `u` on((`s`.`users_seq` = `u`.`users_seq`))) left join `rooms` `r` on((`s`.`rooms_seq` = `r`.`rooms_seq`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v_user_group`
--
DROP TABLE IF EXISTS `v_user_group`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_user_group`  AS  select `ug`.`users_seq` AS `users_seq`,`ug`.`groups_seq` AS `groups_seq`,`g`.`groups_id` AS `groups_id`,`g`.`groups_name` AS `groups_name` from (`user_group` `ug` left join `groups` `g` on((`ug`.`groups_seq` = `g`.`groups_seq`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`groups_seq`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`rooms_seq`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`sche_seq`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_seq`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `groups_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `rooms_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `sche_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
