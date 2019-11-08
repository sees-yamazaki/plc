-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 08, 2019 at 11:53 AM
-- Server version: 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `gijiroku`
--

-- --------------------------------------------------------

--
-- Table structure for table `giji`
--

CREATE TABLE `giji` (
  `giji_seq` int(11) NOT NULL,
  `giji_id` varchar(20) NOT NULL,
  `giji_date` date NOT NULL,
  `giji_title` varchar(30) NOT NULL,
  `giji_note` text NOT NULL,
  `giji_file1` text NOT NULL,
  `giji_file2` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `giji`
--

INSERT INTO `giji` (`giji_seq`, `giji_id`, `giji_date`, `giji_title`, `giji_note`, `giji_file1`, `giji_file2`) VALUES
(14, '123456789', '2019-11-08', '議事録テスト１', '参加者１２人', '第12回議事録.doc', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_seq` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `users_pw` int(11) NOT NULL,
  `users_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_seq`, `users_id`, `users_pw`, `users_name`) VALUES
(1, 123, 456, 'あどみん'),
(2, 1234, 1234, 'aaa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `giji`
--
ALTER TABLE `giji`
  ADD PRIMARY KEY (`giji_seq`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_seq`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `giji`
--
ALTER TABLE `giji`
  MODIFY `giji_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
