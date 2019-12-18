-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2019 年 12 月 18 日 18:33
-- サーバのバージョン： 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `psys`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `prizes`
--

CREATE TABLE `prizes` (
  `pz_seq` int(11) NOT NULL,
  `p_seq` int(11) NOT NULL,
  `pz_order` int(11) NOT NULL,
  `pz_title` text NOT NULL,
  `pz_img` varchar(20) NOT NULL,
  `pz_text` text NOT NULL,
  `pz_hitcnt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `prizes`
--

INSERT INTO `prizes` (`pz_seq`, `p_seq`, `pz_order`, `pz_title`, `pz_img`, `pz_text`, `pz_hitcnt`) VALUES
(1, 8, 5, 'aa', 'jhome 2.png', 'bb', 124),
(2, 8, 0, 'aa', '', 'bb', 12),
(3, 8, 0, 'aa', '', 'bb', 123),
(4, 8, 0, 'aa', '', 'bb', 123),
(5, 8, 0, '１２３', '', '４５６', 111);

-- --------------------------------------------------------

--
-- テーブルの構造 `promos`
--

CREATE TABLE `promos` (
  `p_seq` int(11) NOT NULL,
  `p_title` text NOT NULL,
  `p_text1` text NOT NULL,
  `p_img` varchar(20) NOT NULL,
  `p_text2` text NOT NULL,
  `p_startdt` date NOT NULL,
  `p_enddt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `promos`
--

INSERT INTO `promos` (`p_seq`, `p_title`, `p_text1`, `p_img`, `p_text2`, `p_startdt`, `p_enddt`) VALUES
(8, 'aaa', 'sss', 'jhome2.png', 'fff', '2019-12-02', '2019-12-18');

-- --------------------------------------------------------

--
-- テーブルの構造 `serialcodes`
--

CREATE TABLE `serialcodes` (
  `sc_seq` int(11) NOT NULL,
  `s_seq` int(11) NOT NULL,
  `sc_code` varchar(12) NOT NULL,
  `entrydt` datetime DEFAULT NULL,
  `sc_point` int(11) DEFAULT NULL,
  `c_seq` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `serialcodes`
--

INSERT INTO `serialcodes` (`sc_seq`, `s_seq`, `sc_code`, `entrydt`, `sc_point`, `c_seq`) VALUES
(16062, 31, '721012131221', NULL, NULL, NULL),
(16063, 31, '483212324232', NULL, NULL, NULL),
(16064, 31, '469432343533', NULL, NULL, NULL),
(16065, 31, '458054345464', NULL, NULL, NULL),
(16066, 31, '756016545655', NULL, NULL, NULL),
(16067, 31, '686722765676', NULL, NULL, NULL),
(16068, 31, '879784387677', NULL, NULL, NULL),
(16069, 31, '898089649878', NULL, NULL, NULL),
(16070, 31, '890919085099', NULL, NULL, NULL),
(16071, 31, '109010211060', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `serials`
--

CREATE TABLE `serials` (
  `s_seq` int(11) NOT NULL,
  `s_title` varchar(30) NOT NULL,
  `s_qty` int(5) NOT NULL,
  `createdt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `users_seq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `serials`
--

INSERT INTO `serials` (`s_seq`, `s_title`, `s_qty`, `createdt`, `users_seq`) VALUES
(31, '1012', 10, '2019-12-16 16:52:24', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `users_seq` int(11) NOT NULL,
  `users_id` varchar(20) NOT NULL,
  `users_pw` varchar(20) NOT NULL,
  `users_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`users_seq`, `users_id`, `users_pw`, `users_name`) VALUES
(1, '123', '456', 'あどみん'),
(2, '1234567890', '111', 'ちょっと長い名前の人'),
(3, '12', '12', 'aaad'),
(4, '1234', '1234', '1112222');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `prizes`
--
ALTER TABLE `prizes`
  ADD PRIMARY KEY (`pz_seq`);

--
-- Indexes for table `promos`
--
ALTER TABLE `promos`
  ADD PRIMARY KEY (`p_seq`);

--
-- Indexes for table `serialcodes`
--
ALTER TABLE `serialcodes`
  ADD PRIMARY KEY (`sc_seq`);

--
-- Indexes for table `serials`
--
ALTER TABLE `serials`
  ADD PRIMARY KEY (`s_seq`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_seq`),
  ADD UNIQUE KEY `users_id` (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `prizes`
--
ALTER TABLE `prizes`
  MODIFY `pz_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `promos`
--
ALTER TABLE `promos`
  MODIFY `p_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `serialcodes`
--
ALTER TABLE `serialcodes`
  MODIFY `sc_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16072;

--
-- AUTO_INCREMENT for table `serials`
--
ALTER TABLE `serials`
  MODIFY `s_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
