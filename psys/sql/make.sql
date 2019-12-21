-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 21, 2019 at 12:21 PM
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
-- Database: `psys`
--

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `g_seq` int(11) NOT NULL,
  `g_title` varchar(50) NOT NULL,
  `g_image_start` varchar(20) NOT NULL,
  `g_image_hit` varchar(20) NOT NULL,
  `g_image_miss` varchar(20) NOT NULL,
  `g_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`g_seq`, `g_title`, `g_image_start`, `g_image_hit`, `g_image_miss`, `g_text`) VALUES
(1, 'テストゲーム', '', '', '', 'テストの説明\r\nテストの説明テストの説明\r\nテストの説明テストの説明テストの説明'),
(3, 'test', 'game-start.jpg', 'game-hit.jpg', 'game-miss.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `log_login`
--

CREATE TABLE `log_login` (
  `logindt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `m_seq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `log_login`
--

INSERT INTO `log_login` (`logindt`, `m_seq`) VALUES
('2019-12-21 19:25:48', 1),
('2019-12-21 19:28:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `m_seq` int(11) NOT NULL,
  `m_id` varchar(10) NOT NULL,
  `m_pw` varchar(10) NOT NULL,
  `m_name` varchar(20) NOT NULL,
  `m_mail` varchar(40) NOT NULL,
  `m_post` int(7) NOT NULL,
  `m_address1` varchar(50) NOT NULL,
  `m_address2` varchar(50) NOT NULL,
  `m_tel` int(11) NOT NULL,
  `createdt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`m_seq`, `m_id`, `m_pw`, `m_name`, `m_mail`, `m_post`, `m_address1`, `m_address2`, `m_tel`, `createdt`) VALUES
(1, '123', '456', 'yama', '123', 123, 'add', 'eess', 90, '2019-12-19 15:47:12'),
(7, '1', '999', 'ジェフ・ベゾス', '1@mail', 1234567, 'アマゾン', 'アメリカ', 55, '2019-12-21 12:30:36'),
(8, '2', '999', 'ビル・ゲイツ', '2@mail', 1234567, 'マイクロソフト', 'アメリカ', 63, '2019-12-21 12:30:58'),
(9, '3', '999', 'ウォーレン・バフェット', '3@mail', 1234567, 'バークシャー・ハサウェイ', 'アメリカ', 88, '2019-12-21 12:30:58'),
(10, '4', '999', 'ベルナール・アルノー', '4@mail', 1234567, 'LVMH', 'フランス', 70, '2019-12-21 12:30:58'),
(11, '5', '999', 'カルロス・スリム', '5@mail', 1234567, 'テレフォノス・デ・メヒコ', 'メキシコ', 79, '2019-12-21 12:30:59'),
(12, '6', '999', 'アマンシオ・オルテガ', '6@mail', 1234567, 'インディテックス(ザラ)', 'スペイン', 82, '2019-12-21 12:30:59'),
(13, '7', '999', 'ラリー・エリソン', '7@mail', 1234567, 'オラクル', 'アメリカ', 74, '2019-12-21 12:30:59'),
(14, '8', '999', 'マーク・ザッカーバーグ', '8@mail', 1234567, 'フェイスブック', 'アメリカ', 34, '2019-12-21 12:30:59'),
(15, '9', '999', 'マイケル・ブルームバーグ', '9@mail', 1234567, 'ブルームバーグ', 'アメリカ', 77, '2019-12-21 12:30:59'),
(16, '10', '999', 'ラリー・ペイジ', '10@mail', 1234567, 'グーグル', 'アメリカ', 45, '2019-12-21 12:30:59'),
(17, '11', '999', 'チャールズ・コック', '11@mail', 1234567, 'コック・インダストリーズ', 'アメリカ', 83, '2019-12-21 12:30:59'),
(18, '11', '999', 'デイヴィッド・コック', '11@mail', 1234567, 'コック・インダストリーズ', 'アメリカ', 78, '2019-12-21 12:31:00'),
(19, '13', '999', 'ムケシュ・アンバニ', '13@mail', 1234567, 'リライアンス・インダストリーズ', 'インド', 61, '2019-12-21 12:31:00'),
(20, '14', '999', 'セルゲイ・ブリン', '14@mail', 1234567, 'グーグル', 'アメリカ', 45, '2019-12-21 12:31:00'),
(21, '15', '999', 'フランソワーズ・マイヤーズ', '15@mail', 1234567, 'ロレアル', 'フランス', 65, '2019-12-21 14:35:38'),
(22, '16', '999', 'ジム・ウォルトン', '16@mail', 1234567, 'ウォルマート', 'アメリカ', 70, '2019-12-21 14:35:39'),
(23, '17', '999', 'アリス・ウォルトン', '17@mail', 1234567, 'ウォルマート', 'アメリカ', 69, '2019-12-21 14:35:39'),
(24, '18', '999', 'ロブ・ウォルトン', '18@mail', 1234567, 'ウォルマート', 'アメリカ', 74, '2019-12-21 14:35:39'),
(25, '19', '999', 'スティーブ・バルマー', '19@mail', 1234567, 'マイクロソフト', 'アメリカ', 62, '2019-12-21 14:35:39'),
(26, '20', '999', '馬化騰', '20@mail', 1234567, 'テンセント', '中国', 47, '2019-12-21 14:35:39'),
(27, '21', '999', 'ジャック・マー', '21@mail', 1234567, 'アリババ', '中国', 54, '2019-12-21 14:35:39'),
(28, '22', '999', '許家印', '22@mail', 1234567, '恒大集団', '中国', 60, '2019-12-21 14:35:39');

-- --------------------------------------------------------

--
-- Table structure for table `prizes`
--

CREATE TABLE `prizes` (
  `pz_seq` int(11) NOT NULL,
  `p_seq` int(11) NOT NULL,
  `pz_order` int(11) NOT NULL,
  `pz_title` text NOT NULL,
  `pz_img` varchar(20) NOT NULL,
  `pz_text` text NOT NULL,
  `pz_hitcnt` int(11) NOT NULL,
  `pz_nowcnt` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prizes`
--

INSERT INTO `prizes` (`pz_seq`, `p_seq`, `pz_order`, `pz_title`, `pz_img`, `pz_text`, `pz_hitcnt`, `pz_nowcnt`) VALUES
(1, 8, 21, '最後の賞品', 'gray.jpg', '最後の説明\r\nグレーな画像', 1, 0),
(2, 8, 3, '二番目の商品', '', '二番目の説明\r\nの２ぎょうめ\r\n画像なし', 1, 0),
(4, 8, 10, '四番目の賞品', 'yellow.jpg', '４の説明\r\n黄色の画像', 1, 1),
(5, 8, 5, '３番目の賞品', 'green.jpg', '三番目の説明\r\nGreeeen', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `promos`
--

CREATE TABLE `promos` (
  `p_seq` int(11) NOT NULL,
  `p_title` text NOT NULL,
  `p_text1` text NOT NULL,
  `p_img` varchar(20) NOT NULL,
  `p_text2` text NOT NULL,
  `p_startdt` date NOT NULL,
  `p_enddt` date NOT NULL,
  `g_seq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `promos`
--

INSERT INTO `promos` (`p_seq`, `p_title`, `p_text1`, `p_img`, `p_text2`, `p_startdt`, `p_enddt`, `g_seq`) VALUES
(8, 'キャンペーンのタイトル', '上の説明文\r\n２行目', 'jhome2.png', '説明文下\r\n２行目\r\n３ぎょうめ', '2019-12-02', '2019-12-21', 3),
(9, 'camp2', 'te1111', 'pink.jpg', 'te2222', '2019-12-04', '2019-12-07', 3);

-- --------------------------------------------------------

--
-- Table structure for table `serialcodes`
--

CREATE TABLE `serialcodes` (
  `sc_seq` int(11) NOT NULL,
  `s_seq` int(11) NOT NULL,
  `sc_code` varchar(12) NOT NULL,
  `entrydt` datetime DEFAULT NULL,
  `sc_point` int(11) DEFAULT NULL,
  `m_seq` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `serialcodes`
--

INSERT INTO `serialcodes` (`sc_seq`, `s_seq`, `sc_code`, `entrydt`, `sc_point`, `m_seq`) VALUES
(16062, 31, '721012131221', '2019-12-19 00:00:00', 100, 1),
(16063, 31, '483212324232', '2019-12-05 00:00:00', 6, 2),
(16064, 31, '469432343533', NULL, NULL, NULL),
(16065, 31, '458054345464', '2019-12-13 00:00:00', 4, 1),
(16066, 31, '756016545655', NULL, NULL, NULL),
(16067, 31, '686722765676', NULL, NULL, NULL),
(16068, 31, '879784387677', NULL, NULL, NULL),
(16069, 31, '898089649878', NULL, NULL, NULL),
(16070, 31, '890919085099', NULL, NULL, NULL),
(16071, 31, '109010211060', NULL, NULL, NULL),
(16072, 31, '000000000001', '2019-12-20 09:56:24', 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `serials`
--

CREATE TABLE `serials` (
  `s_seq` int(11) NOT NULL,
  `s_title` varchar(30) NOT NULL,
  `s_qty` int(5) NOT NULL,
  `createdt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `users_seq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `serials`
--

INSERT INTO `serials` (`s_seq`, `s_title`, `s_qty`, `createdt`, `users_seq`) VALUES
(31, '1012', 10, '2019-12-16 16:52:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ships`
--

CREATE TABLE `ships` (
  `sp_seq` int(11) NOT NULL,
  `m_seq` int(11) NOT NULL,
  `up_seq` int(11) NOT NULL,
  `sp_name` varchar(20) NOT NULL,
  `sp_post` int(7) NOT NULL,
  `sp_address1` varchar(50) NOT NULL,
  `sp_address2` varchar(50) NOT NULL,
  `sp_tel` int(11) NOT NULL,
  `sp_text` text NOT NULL,
  `sp_flg` int(11) NOT NULL DEFAULT '0',
  `createdt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ships`
--

INSERT INTO `ships` (`sp_seq`, `m_seq`, `up_seq`, `sp_name`, `sp_post`, `sp_address1`, `sp_address2`, `sp_tel`, `sp_text`, `sp_flg`, `createdt`) VALUES
(1, 1, 0, 'yamaza', 123, 'add2', 'eess2', 9090, 'ああああ', 0, '2019-12-20 16:37:18'),
(2, 1, 7, 'yama', 123, 'add', 'eess', 90, 'ddd', 0, '2019-12-20 16:39:00');

-- --------------------------------------------------------

--
-- Table structure for table `usepoints`
--

CREATE TABLE `usepoints` (
  `up_seq` int(11) NOT NULL,
  `m_seq` int(11) NOT NULL,
  `up_point` int(11) NOT NULL,
  `createdt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `up_status` int(11) NOT NULL,
  `g_seq` int(11) NOT NULL,
  `p_seq` int(11) NOT NULL,
  `pz_seq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usepoints`
--

INSERT INTO `usepoints` (`up_seq`, `m_seq`, `up_point`, `createdt`, `up_status`, `g_seq`, `p_seq`, `pz_seq`) VALUES
(4, 1, 20, '2019-12-20 16:07:23', 1, 3, 8, 1),
(5, 1, 20, '2019-12-20 16:09:31', 1, 3, 8, 1),
(6, 1, 20, '2019-12-20 16:11:46', 1, 3, 8, 3),
(7, 1, 20, '2019-12-20 16:38:51', 1, 3, 8, 4),
(8, 1, -100, '2019-12-21 21:14:27', 99, 0, 0, 0),
(9, 1, -6, '2019-12-21 21:18:09', 99, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_seq` int(11) NOT NULL,
  `users_id` varchar(20) NOT NULL,
  `users_pw` varchar(20) NOT NULL,
  `users_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_seq`, `users_id`, `users_pw`, `users_name`) VALUES
(1, '123', '456', 'あどみん'),
(2, '1234567890', '111', 'ちょっと長い名前の人'),
(3, '12', '12', 'aaad'),
(4, '1234', '1234', '1112222');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_lastlogin`
-- (See below for the actual view)
--
CREATE TABLE `v_lastlogin` (
`logindt` datetime
,`m_seq` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_point`
-- (See below for the actual view)
--
CREATE TABLE `v_point` (
`m_seq` int(11)
,`point` decimal(55,0)
);

-- --------------------------------------------------------

--
-- Structure for view `v_lastlogin`
--
DROP TABLE IF EXISTS `v_lastlogin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_lastlogin`  AS  select max(`log_login`.`logindt`) AS `logindt`,`log_login`.`m_seq` AS `m_seq` from `log_login` group by `log_login`.`m_seq` ;

-- --------------------------------------------------------

--
-- Structure for view `v_point`
--
DROP TABLE IF EXISTS `v_point`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_point`  AS  select `a`.`m_seq` AS `m_seq`,sum(`a`.`point`) AS `point` from (select `serialcodes`.`m_seq` AS `m_seq`,sum(`serialcodes`.`sc_point`) AS `point` from `serialcodes` where (`serialcodes`.`m_seq` is not null) group by `serialcodes`.`m_seq` union select `usepoints`.`m_seq` AS `m_seq`,(sum(`usepoints`.`up_point`) * -(1)) AS `point` from `usepoints` group by `usepoints`.`m_seq`) `a` group by `a`.`m_seq` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`g_seq`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`m_seq`);

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
-- Indexes for table `ships`
--
ALTER TABLE `ships`
  ADD PRIMARY KEY (`sp_seq`);

--
-- Indexes for table `usepoints`
--
ALTER TABLE `usepoints`
  ADD PRIMARY KEY (`up_seq`);

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
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `g_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `m_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `prizes`
--
ALTER TABLE `prizes`
  MODIFY `pz_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `promos`
--
ALTER TABLE `promos`
  MODIFY `p_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `serialcodes`
--
ALTER TABLE `serialcodes`
  MODIFY `sc_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16073;

--
-- AUTO_INCREMENT for table `serials`
--
ALTER TABLE `serials`
  MODIFY `s_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `ships`
--
ALTER TABLE `ships`
  MODIFY `sp_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usepoints`
--
ALTER TABLE `usepoints`
  MODIFY `up_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
