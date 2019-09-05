-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 05, 2019 at 06:24 PM
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
(26, '25-27-26-', '支社', 27, '2019-09-05 17:43:17', 1, 'あどみん'),
(27, '25-27-', '経理', 25, '2019-09-05 17:43:23', 1, 'あどみん'),
(28, '25-27-26-28-', '計算', 26, '2019-09-05 17:43:36', 1, 'あどみん'),
(29, '25-27-29-', '集計', 27, '2019-09-05 17:43:43', 1, 'あどみん'),
(30, '25-27-26-28-30-', '合計', 28, '2019-09-05 17:43:52', 1, 'あどみん');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `sche_seq` int(11) NOT NULL,
  `users_seq` int(11) NOT NULL,
  `sche_start_dt` datetime NOT NULL,
  `sche_start_ymd` varchar(8) NOT NULL,
  `sche_start_hm` varchar(4) NOT NULL,
  `sche_end_dt` datetime NOT NULL,
  `sche_end_ymd` varchar(8) NOT NULL,
  `sche_end_hm` varchar(4) NOT NULL,
  `sche_title` varchar(50) NOT NULL,
  `sche_note` text NOT NULL,
  `sche_type` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`sche_seq`, `users_seq`, `sche_start_dt`, `sche_start_ymd`, `sche_start_hm`, `sche_end_dt`, `sche_end_ymd`, `sche_end_hm`, `sche_title`, `sche_note`, `sche_type`) VALUES
(1, 1, '2019-09-04 10:00:00', '20190904', '1000', '2019-09-04 18:45:00', '20190904', '1845', 'TEST', 'これは本人の\r\nテキストめもです', 1),
(2, 1, '2019-09-04 17:00:00', '20190904', '1700', '2019-09-04 20:00:00', '20190904', '2000', 'title2', 'これは\r\n別のユーザの\r\n\r\n改行のめもです。', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_seq` int(11) NOT NULL,
  `users_id` varchar(20) NOT NULL,
  `users_pw` varchar(20) NOT NULL,
  `users_name` varchar(30) NOT NULL,
  `groups_seq` int(11) NOT NULL,
  `users_level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_seq`, `users_id`, `users_pw`, `users_name`, `groups_seq`, `users_level`) VALUES
(1, '123', '456', 'あどみん', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `users_seq` int(11) NOT NULL,
  `groups_seq` int(11) NOT NULL,
  `groups_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`users_seq`, `groups_seq`, `groups_id`) VALUES
(1, 11, '0-10-9-8-');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`groups_seq`);

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
  MODIFY `groups_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `sche_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
