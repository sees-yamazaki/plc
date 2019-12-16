-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2019 年 12 月 16 日 15:52
-- サーバのバージョン： 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `psys`
--

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
-- AUTO_INCREMENT for table `serialcodes`
--
ALTER TABLE `serialcodes`
  MODIFY `sc_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16062;

--
-- AUTO_INCREMENT for table `serials`
--
ALTER TABLE `serials`
  MODIFY `s_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
