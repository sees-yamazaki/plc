-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2019 年 12 月 27 日 12:56
-- サーバのバージョン： 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `psys`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `games`
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
-- テーブルのデータのダンプ `games`
--

INSERT INTO `games` (`g_seq`, `g_title`, `g_image_start`, `g_image_hit`, `g_image_miss`, `g_text`) VALUES
(1, 'テストゲーム', 'game-start.jpg', 'game-hit.jpg', 'game-miss.jpg', 'テストの説明\r\nテストの説明テストの説明\r\nテストの説明テストの説明テストの説明'),
(3, 'test', 'game-start.jpg', 'game-hit.jpg', 'game-miss.jpg', '');

-- --------------------------------------------------------

--
-- テーブルの構造 `hitcounts`
--

CREATE TABLE `hitcounts` (
  `hc_seq` int(11) NOT NULL,
  `p_seq` int(11) NOT NULL,
  `pz_seq` int(11) NOT NULL,
  `hc_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `hitcounts`
--

INSERT INTO `hitcounts` (`hc_seq`, `p_seq`, `pz_seq`, `hc_no`) VALUES
(7, 9, 9, 1),
(8, 9, 9, 2),
(9, 9, 9, 3),
(10, 9, 9, 4),
(11, 9, 9, 5),
(12, 11, 0, 1),
(13, 11, 0, 6),
(14, 11, 0, 6),
(15, 11, 0, 6),
(29, 11, 12, 1),
(30, 11, 12, 2),
(31, 11, 12, 7),
(32, 11, 12, 7),
(33, 11, 12, 78),
(34, 12, 13, 10),
(35, 12, 13, 3),
(36, 12, 13, 5),
(44, 11, 11, 8),
(45, 11, 11, 9),
(46, 11, 11, 10);

-- --------------------------------------------------------

--
-- テーブルの構造 `infos`
--

CREATE TABLE `infos` (
  `inf_seq` int(11) NOT NULL,
  `inf_title` text NOT NULL,
  `inf_text1` text NOT NULL,
  `inf_text2` text NOT NULL,
  `inf_img` varchar(20) NOT NULL,
  `inf_startdt` date NOT NULL,
  `inf_enddt` date NOT NULL,
  `inf_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `infos`
--

INSERT INTO `infos` (`inf_seq`, `inf_title`, `inf_text1`, `inf_text2`, `inf_img`, `inf_startdt`, `inf_enddt`, `inf_order`) VALUES
(8, 'お知らせのタイトル', 'お知らせ本文\r\n上の本文\r\n画像は黒', 'お知らせの下の本文', 'gray.jpg', '2019-12-05', '2019-12-27', 3),
(10, '１月のお知らせ', 'お知らせ１\r\n２\r\n３\r\n４\r\n', 'お知らせ５\r\n６\r\n７\r\n８\r\n', 'gray.jpg', '2019-12-11', '2020-01-04', 2);

-- --------------------------------------------------------

--
-- テーブルの構造 `log_login`
--

CREATE TABLE `log_login` (
  `logindt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `m_seq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `log_login`
--

INSERT INTO `log_login` (`logindt`, `m_seq`) VALUES
('2019-12-21 19:25:48', 1),
('2019-12-21 19:28:30', 1),
('2019-12-23 09:42:24', 1),
('2019-12-23 09:42:51', 1),
('2019-12-25 17:15:49', 1),
('2019-12-25 17:19:47', 1),
('2019-12-25 17:40:03', 1),
('2019-12-26 12:49:11', 1),
('2019-12-26 14:43:20', 1),
('2019-12-26 14:45:03', 1),
('2019-12-26 14:47:07', 1),
('2019-12-26 14:55:52', 1),
('2019-12-26 15:00:26', 1),
('2019-12-26 15:35:30', 1),
('2019-12-26 15:39:11', 1),
('2019-12-26 16:35:18', 1),
('2019-12-26 16:45:39', 1),
('2019-12-27 10:23:41', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `members`
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
-- テーブルのデータのダンプ `members`
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
(28, '22', '999', '許家印', '22@mail', 1234567, '恒大集団', '中国', 60, '2019-12-21 14:35:39'),
(29, '1577345358', '999', 'ヤマザキ', 'te@tetete', 123, 'add11', 'add22', 90888888, '2019-12-26 16:29:18'),
(30, '1577345383', '999', 'ヤマザキ', 'te@tetete', 123, 'add11', 'add22', 90888888, '2019-12-26 16:29:43');

-- --------------------------------------------------------

--
-- テーブルの構造 `prizes`
--

CREATE TABLE `prizes` (
  `pz_seq` int(11) NOT NULL,
  `p_seq` int(11) NOT NULL,
  `pz_order` int(11) NOT NULL,
  `pz_title` text NOT NULL,
  `pz_code` varchar(30) NOT NULL,
  `pz_img` varchar(20) NOT NULL,
  `pz_text` text NOT NULL,
  `pz_nowcnt` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `prizes`
--

INSERT INTO `prizes` (`pz_seq`, `p_seq`, `pz_order`, `pz_title`, `pz_code`, `pz_img`, `pz_text`, `pz_nowcnt`) VALUES
(1, 8, 21, '最後の賞品', '', 'gray.jpg', '最後の説明\r\nグレーな画像', 0),
(2, 8, 3, '二番目の商品', '', '', '二番目の説明\r\nの２ぎょうめ\r\n画像なし', 0),
(4, 8, 10, '四番目の賞品', '', 'yellow.jpg', '４の説明\r\n黄色の画像', 1),
(5, 8, 5, '３番目の賞品', '', 'green.jpg', '三番目の説明\r\nGreeeen', 0),
(9, 9, 11, '22', 'A124', '', '33', 0),
(11, 11, 1, '2', '3', 'salmon.jpg', '4', 9),
(12, 11, 44, '444', '4444', 'gray.jpg', '4444444', 1),
(13, 12, 1, 'しょうA', 'code123', 'pink.jpg', '説明１、２', 0);

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
  `p_enddt` date NOT NULL,
  `g_seq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `promos`
--

INSERT INTO `promos` (`p_seq`, `p_title`, `p_text1`, `p_img`, `p_text2`, `p_startdt`, `p_enddt`, `g_seq`) VALUES
(11, '111', '22', 'pink.jpg', '4', '2019-12-07', '2019-12-27', 1),
(12, 'キャンペーンのキャンペーン', '説明１\r\n２\r\n３\r\n４\r\n', 'black.jpg', '説明下２\r\n３\r\n４\r\n５６', '2019-12-01', '2019-12-19', 1);

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
  `m_seq` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `serialcodes`
--

INSERT INTO `serialcodes` (`sc_seq`, `s_seq`, `sc_code`, `entrydt`, `sc_point`, `m_seq`) VALUES
(16062, 31, '721012131221', '2019-12-19 00:00:00', 100, 1),
(16063, 31, '483212324232', '2019-12-05 00:00:00', 6, 2),
(16064, 31, '469432343533', NULL, NULL, NULL),
(16065, 31, '458054345464', '2019-12-13 00:00:00', 4, 1),
(16066, 31, '756016545655', NULL, NULL, NULL),
(16067, 31, '686722765676', NULL, NULL, NULL),
(16068, 31, '879784387677', '2019-12-26 16:14:19', 5, 1),
(16069, 31, '898089649878', '2019-12-26 16:16:15', 5, 1),
(16070, 31, '890919085099', NULL, NULL, NULL),
(16071, 31, '109010211060', NULL, NULL, NULL),
(16072, 31, '000000000001', '2019-12-20 09:56:24', 20, 1),
(26073, 33, '621012131321', NULL, NULL, NULL),
(26074, 33, '473212324242', NULL, NULL, NULL),
(26075, 33, '568432343533', NULL, NULL, NULL),
(26076, 33, '468954345464', NULL, NULL, NULL),
(26077, 33, '757006545655', NULL, NULL, NULL),
(26078, 0, '721012131321', NULL, NULL, NULL),
(26079, 0, '483212324242', NULL, NULL, NULL),
(26080, 0, '569432343533', NULL, NULL, NULL),
(26081, 0, '468054345464', NULL, NULL, NULL),
(26082, 0, '757016545655', NULL, NULL, NULL),
(26083, 0, '686822765676', NULL, NULL, NULL),
(26084, 0, '879794387677', NULL, NULL, NULL),
(26085, 0, '898080649878', NULL, NULL, NULL),
(26086, 0, '890919185099', NULL, NULL, NULL),
(26087, 0, '109010212060', NULL, NULL, NULL),
(26088, 0, '721012132321', NULL, NULL, NULL),
(26089, 0, '483212324342', NULL, NULL, NULL),
(26090, 0, '569432343543', NULL, NULL, NULL),
(26091, 0, '568054345464', NULL, NULL, NULL),
(26092, 0, '767016545655', NULL, NULL, NULL),
(26093, 0, '687822765676', NULL, NULL, NULL),
(26094, 0, '879894387677', NULL, NULL, NULL),
(26095, 0, '898090649878', NULL, NULL, NULL),
(26096, 0, '890910185099', NULL, NULL, NULL),
(26097, 0, '109010222060', NULL, NULL, NULL),
(26098, 0, '721012133321', NULL, NULL, NULL),
(26099, 0, '483212324442', NULL, NULL, NULL),
(26100, 0, '569432343553', NULL, NULL, NULL),
(26101, 0, '668054345464', NULL, NULL, NULL),
(26102, 0, '777016545655', NULL, NULL, NULL),
(26103, 0, '688822765676', NULL, NULL, NULL),
(26104, 0, '879994387677', NULL, NULL, NULL),
(26105, 0, '898000649878', NULL, NULL, NULL),
(26106, 0, '890911185099', NULL, NULL, NULL),
(26107, 0, '109010232060', NULL, NULL, NULL),
(26108, 0, '721012134321', NULL, NULL, NULL),
(26109, 0, '483212324542', NULL, NULL, NULL),
(26110, 0, '569432343563', NULL, NULL, NULL),
(26111, 0, '768054345464', NULL, NULL, NULL),
(26112, 0, '787016545655', NULL, NULL, NULL),
(26113, 0, '689822765676', NULL, NULL, NULL),
(26114, 0, '879094387677', NULL, NULL, NULL),
(26115, 0, '898010649878', NULL, NULL, NULL),
(26116, 0, '890912185099', NULL, NULL, NULL),
(26117, 0, '109010242060', NULL, NULL, NULL),
(26118, 0, '721012135321', NULL, NULL, NULL),
(26119, 0, '483212324642', NULL, NULL, NULL),
(26120, 0, '569432343573', NULL, NULL, NULL),
(26121, 0, '868054345464', NULL, NULL, NULL),
(26122, 0, '797016545655', NULL, NULL, NULL),
(26123, 0, '680822765676', NULL, NULL, NULL),
(26124, 0, '879194387677', NULL, NULL, NULL),
(26125, 0, '898020649878', NULL, NULL, NULL),
(26126, 0, '890913185099', NULL, NULL, NULL),
(26127, 0, '109010252060', NULL, NULL, NULL),
(26128, 0, '721012136321', NULL, NULL, NULL),
(26129, 0, '483212324742', NULL, NULL, NULL),
(26130, 0, '569432343583', NULL, NULL, NULL),
(26131, 0, '968054345464', NULL, NULL, NULL),
(26132, 0, '707016545655', NULL, NULL, NULL),
(26133, 0, '681822765676', NULL, NULL, NULL),
(26134, 0, '879294387677', NULL, NULL, NULL),
(26135, 0, '898030649878', NULL, NULL, NULL),
(26136, 0, '890914185099', NULL, NULL, NULL),
(26137, 0, '109010262060', NULL, NULL, NULL),
(26138, 0, '721012137321', NULL, NULL, NULL),
(26139, 0, '483212324842', NULL, NULL, NULL),
(26140, 0, '569432343593', NULL, NULL, NULL),
(26141, 0, '068054345464', NULL, NULL, NULL),
(26142, 0, '717016545655', NULL, NULL, NULL),
(26143, 0, '682822765676', NULL, NULL, NULL),
(26144, 0, '879394387677', NULL, NULL, NULL),
(26145, 0, '898040649878', NULL, NULL, NULL),
(26146, 0, '890915185099', NULL, NULL, NULL),
(26147, 0, '109010272060', NULL, NULL, NULL),
(26148, 0, '721012138321', NULL, NULL, NULL),
(26149, 0, '483212324942', NULL, NULL, NULL),
(26150, 0, '569432343503', NULL, NULL, NULL),
(26151, 0, '168054345464', NULL, NULL, NULL),
(26152, 0, '727016545655', NULL, NULL, NULL),
(26153, 0, '683822765676', NULL, NULL, NULL),
(26154, 0, '879494387677', NULL, NULL, NULL),
(26155, 0, '898050649878', NULL, NULL, NULL),
(26156, 0, '890916185099', NULL, NULL, NULL),
(26157, 0, '109010282060', NULL, NULL, NULL),
(26158, 0, '721012139321', NULL, NULL, NULL),
(26159, 0, '483212324042', NULL, NULL, NULL),
(26160, 0, '569432343513', NULL, NULL, NULL),
(26161, 0, '268054345464', NULL, NULL, NULL),
(26162, 0, '737016545655', NULL, NULL, NULL),
(26163, 0, '684822765676', NULL, NULL, NULL),
(26164, 0, '879594387677', NULL, NULL, NULL),
(26165, 0, '898060649878', NULL, NULL, NULL),
(26166, 0, '890917185099', NULL, NULL, NULL),
(26167, 0, '109010292060', NULL, NULL, NULL),
(26168, 0, '721012130321', NULL, NULL, NULL),
(26169, 0, '483212324142', NULL, NULL, NULL),
(26170, 0, '569432343523', NULL, NULL, NULL),
(26171, 0, '368054345464', NULL, NULL, NULL),
(26172, 0, '747016545655', NULL, NULL, NULL),
(26173, 0, '685822765676', NULL, NULL, NULL),
(26174, 0, '879694387677', NULL, NULL, NULL),
(26175, 0, '898070649878', NULL, NULL, NULL),
(26176, 0, '890918185099', NULL, NULL, NULL),
(26177, 0, '109011202060', NULL, NULL, NULL),
(26178, 0, '721012131321', NULL, NULL, NULL),
(26179, 0, '483212324242', NULL, NULL, NULL),
(26180, 0, '569432343533', NULL, NULL, NULL),
(26181, 0, '468054345464', NULL, NULL, NULL),
(26182, 0, '757016545655', NULL, NULL, NULL),
(26183, 0, '686822765676', NULL, NULL, NULL),
(26184, 0, '879794387677', NULL, NULL, NULL),
(26185, 0, '898080649878', NULL, NULL, NULL),
(26186, 0, '890919185099', NULL, NULL, NULL),
(26187, 0, '109010212060', NULL, NULL, NULL),
(26188, 34, '721012131321', NULL, NULL, NULL),
(26189, 34, '483212324242', NULL, NULL, NULL),
(26190, 34, '569432343533', NULL, NULL, NULL),
(26191, 34, '468054345464', NULL, NULL, NULL),
(26192, 34, '757016545655', NULL, NULL, NULL),
(26193, 34, '686822765676', NULL, NULL, NULL),
(26194, 34, '879794387677', NULL, NULL, NULL),
(26195, 34, '898080649878', NULL, NULL, NULL),
(26196, 34, '890919185099', NULL, NULL, NULL),
(26197, 34, '109010212060', NULL, NULL, NULL);

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
(31, '10123', 10, '2019-12-16 16:52:24', 1),
(33, '5', 5, '2019-12-25 16:11:54', 1),
(34, '１０', 10, '2019-12-26 12:26:58', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `ships`
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
-- テーブルのデータのダンプ `ships`
--

INSERT INTO `ships` (`sp_seq`, `m_seq`, `up_seq`, `sp_name`, `sp_post`, `sp_address1`, `sp_address2`, `sp_tel`, `sp_text`, `sp_flg`, `createdt`) VALUES
(1, 1, 0, 'yamaza', 123, 'add2', 'eess2', 9090, 'ああああ', 0, '2019-12-20 16:37:18'),
(2, 1, 7, 'yama', 123, 'add', 'eess', 90, 'ddd', 0, '2019-12-20 16:39:00'),
(3, 1, 0, 'yama', 123, 'add', 'eess', 90, 'aaaa', 1, '2019-12-26 16:11:30');

-- --------------------------------------------------------

--
-- テーブルの構造 `systems`
--

CREATE TABLE `systems` (
  `url_parent` varchar(100) NOT NULL,
  `url_child` varchar(100) NOT NULL,
  `path_root` varchar(100) NOT NULL,
  `path_promo` varchar(100) NOT NULL,
  `path_game` varchar(100) NOT NULL,
  `path_info` varchar(100) NOT NULL,
  `path_scode` varchar(100) NOT NULL,
  `system_name` varchar(30) NOT NULL,
  `point_entry` int(11) NOT NULL,
  `point_game` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `systems`
--

INSERT INTO `systems` (`url_parent`, `url_child`, `path_root`, `path_promo`, `path_game`, `path_info`, `path_scode`, `system_name`, `point_entry`, `point_game`) VALUES
('http://localhost/psys', 'http://localhost/psys_c', 'mydata', 'promo', 'game', 'info', 'scode', 'PointSystem', 5, 20);

-- --------------------------------------------------------

--
-- テーブルの構造 `usepoints`
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
-- テーブルのデータのダンプ `usepoints`
--

INSERT INTO `usepoints` (`up_seq`, `m_seq`, `up_point`, `createdt`, `up_status`, `g_seq`, `p_seq`, `pz_seq`) VALUES
(4, 1, 20, '2019-12-20 16:07:23', 1, 3, 8, 1),
(5, 1, 20, '2019-12-20 16:09:31', 1, 3, 8, 1),
(6, 1, 20, '2019-12-20 16:11:46', 1, 3, 8, 3),
(7, 1, 20, '2019-12-20 16:38:51', 1, 3, 8, 4),
(8, 1, -100, '2019-12-21 21:14:27', 99, 0, 0, 0),
(9, 1, -6, '2019-12-21 21:18:09', 99, 0, 0, 0),
(10, 1, -200, '2019-12-26 11:49:06', 99, 0, 0, 0),
(11, 1, 20, '2019-12-26 15:55:44', 0, 1, 11, 11),
(12, 1, 20, '2019-12-26 15:59:01', 0, 1, 11, 11),
(13, 1, 20, '2019-12-26 15:59:09', 0, 1, 11, 11),
(14, 1, 20, '2019-12-26 16:03:18', 0, 1, 11, 11),
(15, 1, 20, '2019-12-26 16:05:00', 0, 1, 11, 11),
(16, 1, 20, '2019-12-26 16:06:40', 0, 1, 11, 11),
(17, 1, 20, '2019-12-26 16:07:47', 1, 1, 11, 11),
(18, 1, 20, '2019-12-26 16:09:02', 1, 1, 11, 11);

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

-- --------------------------------------------------------

--
-- ビュー用の代替構造 `v_lastlogin`
-- (実際のビューを参照するには下にあります)
--
CREATE TABLE `v_lastlogin` (
`logindt` datetime
,`m_seq` int(11)
);

-- --------------------------------------------------------

--
-- ビュー用の代替構造 `v_members`
-- (実際のビューを参照するには下にあります)
--
CREATE TABLE `v_members` (
`m_seq` int(11)
,`m_id` varchar(10)
,`m_pw` varchar(10)
,`m_name` varchar(20)
,`m_mail` varchar(40)
,`m_post` int(7)
,`m_address1` varchar(50)
,`m_address2` varchar(50)
,`m_tel` int(11)
,`createdt` datetime
,`crnt_point` decimal(35,0)
,`sc_cnt` bigint(21)
,`sc_point` decimal(32,0)
,`cnt_0` bigint(21)
,`up_point_0` decimal(32,0)
,`cnt_1` bigint(21)
,`up_point_1` decimal(32,0)
,`cnt_99` bigint(21)
,`up_point_99` decimal(32,0)
,`logindt` datetime
);

-- --------------------------------------------------------

--
-- ビュー用の代替構造 `v_point`
-- (実際のビューを参照するには下にあります)
--
CREATE TABLE `v_point` (
`m_seq` int(11)
,`point` decimal(55,0)
);

-- --------------------------------------------------------

--
-- ビュー用の代替構造 `v_prizes`
-- (実際のビューを参照するには下にあります)
--
CREATE TABLE `v_prizes` (
`pz_seq` int(11)
,`p_seq` int(11)
,`pz_order` int(11)
,`pz_title` text
,`pz_code` varchar(30)
,`pz_img` varchar(20)
,`pz_text` text
,`pz_nowcnt` int(11)
,`hc_no` text
);

-- --------------------------------------------------------

--
-- ビュー用の代替構造 `v_serialcodes`
-- (実際のビューを参照するには下にあります)
--
CREATE TABLE `v_serialcodes` (
`s_seq` int(11)
,`s_title` varchar(30)
,`s_qty` int(5)
,`createdt` datetime
,`users_seq` int(11)
,`sc_seq` int(11)
,`sc_code` varchar(12)
,`entrydt` datetime
,`sc_point` int(11)
,`m_seq` int(11)
,`m_name` varchar(20)
);

-- --------------------------------------------------------

--
-- ビュー用の代替構造 `v_ships`
-- (実際のビューを参照するには下にあります)
--
CREATE TABLE `v_ships` (
`sp_seq` int(11)
,`m_seq` int(11)
,`up_seq` int(11)
,`sp_name` varchar(20)
,`sp_post` int(7)
,`sp_address1` varchar(50)
,`sp_address2` varchar(50)
,`sp_tel` int(11)
,`sp_text` text
,`sp_flg` int(11)
,`createdt` datetime
,`p_title` text
,`pz_title` text
,`m_name` varchar(20)
,`m_mail` varchar(40)
,`m_post` int(7)
,`m_address1` varchar(50)
,`m_address2` varchar(50)
,`m_tel` int(11)
);

-- --------------------------------------------------------

--
-- ビュー用の代替構造 `v_usepoints`
-- (実際のビューを参照するには下にあります)
--
CREATE TABLE `v_usepoints` (
`up_seq` int(11)
,`m_seq` int(11)
,`up_point` int(11)
,`createdt` datetime
,`up_status` int(11)
,`g_seq` int(11)
,`p_seq` int(11)
,`pz_seq` int(11)
,`m_name` varchar(20)
,`p_title` text
,`pz_title` text
);

-- --------------------------------------------------------

--
-- ビュー用の構造 `v_lastlogin`
--
DROP TABLE IF EXISTS `v_lastlogin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_lastlogin`  AS  select max(`log_login`.`logindt`) AS `logindt`,`log_login`.`m_seq` AS `m_seq` from `log_login` group by `log_login`.`m_seq` ;

-- --------------------------------------------------------

--
-- ビュー用の構造 `v_members`
--
DROP TABLE IF EXISTS `v_members`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_members`  AS  select `M`.`m_seq` AS `m_seq`,`M`.`m_id` AS `m_id`,`M`.`m_pw` AS `m_pw`,`M`.`m_name` AS `m_name`,`M`.`m_mail` AS `m_mail`,`M`.`m_post` AS `m_post`,`M`.`m_address1` AS `m_address1`,`M`.`m_address2` AS `m_address2`,`M`.`m_tel` AS `m_tel`,`M`.`createdt` AS `createdt`,(case isnull((((`sc`.`sc_point` - `up99`.`up_point_99`) - `up0`.`up_point_0`) - `up1`.`up_point_1`)) when 1 then 0 else (((`sc`.`sc_point` - `up99`.`up_point_99`) - `up0`.`up_point_0`) - `up1`.`up_point_1`) end) AS `crnt_point`,(case isnull(`sc`.`sc_cnt`) when 1 then 0 else `sc`.`sc_cnt` end) AS `sc_cnt`,(case isnull(`sc`.`sc_point`) when 1 then 0 else `sc`.`sc_point` end) AS `sc_point`,(case isnull(`up0`.`cnt_0`) when 1 then 0 else `up0`.`cnt_0` end) AS `cnt_0`,(case isnull(`up0`.`up_point_0`) when 1 then 0 else `up0`.`up_point_0` end) AS `up_point_0`,(case isnull(`up1`.`cnt_1`) when 1 then 0 else `up1`.`cnt_1` end) AS `cnt_1`,(case isnull(`up1`.`up_point_1`) when 1 then 0 else `up1`.`up_point_1` end) AS `up_point_1`,(case isnull(`up99`.`cnt_99`) when 1 then 0 else `up99`.`cnt_99` end) AS `cnt_99`,(case isnull(`up99`.`up_point_99`) when 1 then 0 else `up99`.`up_point_99` end) AS `up_point_99`,`l`.`logindt` AS `logindt` from (((((`members` `M` left join (select `serialcodes`.`m_seq` AS `m_seq`,count(0) AS `sc_cnt`,sum(`serialcodes`.`sc_point`) AS `sc_point` from `serialcodes` where (`serialcodes`.`m_seq` is not null) group by `serialcodes`.`m_seq`) `SC` on((`sc`.`m_seq` = `M`.`m_seq`))) left join (select `usepoints`.`m_seq` AS `m_seq`,count(0) AS `cnt_0`,sum(`usepoints`.`up_point`) AS `up_point_0` from `usepoints` where (`usepoints`.`up_status` = 0) group by `usepoints`.`m_seq`) `UP0` on((`up0`.`m_seq` = `M`.`m_seq`))) left join (select `usepoints`.`m_seq` AS `m_seq`,count(0) AS `cnt_1`,sum(`usepoints`.`up_point`) AS `up_point_1` from `usepoints` where (`usepoints`.`up_status` = 1) group by `usepoints`.`m_seq`) `UP1` on((`up1`.`m_seq` = `M`.`m_seq`))) left join (select `usepoints`.`m_seq` AS `m_seq`,count(0) AS `cnt_99`,sum(`usepoints`.`up_point`) AS `up_point_99` from `usepoints` where (`usepoints`.`up_status` = 99) group by `usepoints`.`m_seq`) `UP99` on((`up99`.`m_seq` = `M`.`m_seq`))) left join `v_lastlogin` `L` on((`l`.`m_seq` = `M`.`m_seq`))) ;

-- --------------------------------------------------------

--
-- ビュー用の構造 `v_point`
--
DROP TABLE IF EXISTS `v_point`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_point`  AS  select `a`.`m_seq` AS `m_seq`,sum(`a`.`point`) AS `point` from (select `serialcodes`.`m_seq` AS `m_seq`,sum(`serialcodes`.`sc_point`) AS `point` from `serialcodes` where (`serialcodes`.`m_seq` is not null) group by `serialcodes`.`m_seq` union select `usepoints`.`m_seq` AS `m_seq`,(sum(`usepoints`.`up_point`) * -(1)) AS `point` from `usepoints` group by `usepoints`.`m_seq`) `a` group by `a`.`m_seq` ;

-- --------------------------------------------------------

--
-- ビュー用の構造 `v_prizes`
--
DROP TABLE IF EXISTS `v_prizes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_prizes`  AS  select `p`.`pz_seq` AS `pz_seq`,`p`.`p_seq` AS `p_seq`,`p`.`pz_order` AS `pz_order`,`p`.`pz_title` AS `pz_title`,`p`.`pz_code` AS `pz_code`,`p`.`pz_img` AS `pz_img`,`p`.`pz_text` AS `pz_text`,`p`.`pz_nowcnt` AS `pz_nowcnt`,`h`.`hc_no` AS `hc_no` from (`prizes` `p` left join (select `hitcounts`.`p_seq` AS `p_seq`,`hitcounts`.`pz_seq` AS `pz_seq`,group_concat(`hitcounts`.`hc_no` separator ',') AS `hc_no` from `hitcounts` group by `hitcounts`.`p_seq`,`hitcounts`.`pz_seq`) `h` on(((`p`.`p_seq` = `h`.`p_seq`) and (`p`.`pz_seq` = `h`.`pz_seq`)))) ;

-- --------------------------------------------------------

--
-- ビュー用の構造 `v_serialcodes`
--
DROP TABLE IF EXISTS `v_serialcodes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_serialcodes`  AS  select `S`.`s_seq` AS `s_seq`,`S`.`s_title` AS `s_title`,`S`.`s_qty` AS `s_qty`,`S`.`createdt` AS `createdt`,`S`.`users_seq` AS `users_seq`,`SC`.`sc_seq` AS `sc_seq`,`SC`.`sc_code` AS `sc_code`,`SC`.`entrydt` AS `entrydt`,`SC`.`sc_point` AS `sc_point`,`SC`.`m_seq` AS `m_seq`,`M`.`m_name` AS `m_name` from ((`serials` `S` left join `serialcodes` `SC` on((`S`.`s_seq` = `SC`.`s_seq`))) left join `members` `M` on((`SC`.`m_seq` = `M`.`m_seq`))) ;

-- --------------------------------------------------------

--
-- ビュー用の構造 `v_ships`
--
DROP TABLE IF EXISTS `v_ships`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_ships`  AS  select `ships`.`sp_seq` AS `sp_seq`,`ships`.`m_seq` AS `m_seq`,`ships`.`up_seq` AS `up_seq`,`ships`.`sp_name` AS `sp_name`,`ships`.`sp_post` AS `sp_post`,`ships`.`sp_address1` AS `sp_address1`,`ships`.`sp_address2` AS `sp_address2`,`ships`.`sp_tel` AS `sp_tel`,`ships`.`sp_text` AS `sp_text`,`ships`.`sp_flg` AS `sp_flg`,`ships`.`createdt` AS `createdt`,`v_usepoints`.`p_title` AS `p_title`,`v_usepoints`.`pz_title` AS `pz_title`,`members`.`m_name` AS `m_name`,`members`.`m_mail` AS `m_mail`,`members`.`m_post` AS `m_post`,`members`.`m_address1` AS `m_address1`,`members`.`m_address2` AS `m_address2`,`members`.`m_tel` AS `m_tel` from ((`ships` left join `v_usepoints` on((`ships`.`up_seq` = `v_usepoints`.`up_seq`))) left join `members` on((`members`.`m_seq` = `ships`.`m_seq`))) ;

-- --------------------------------------------------------

--
-- ビュー用の構造 `v_usepoints`
--
DROP TABLE IF EXISTS `v_usepoints`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_usepoints`  AS  select `U`.`up_seq` AS `up_seq`,`U`.`m_seq` AS `m_seq`,`U`.`up_point` AS `up_point`,`U`.`createdt` AS `createdt`,`U`.`up_status` AS `up_status`,`U`.`g_seq` AS `g_seq`,`U`.`p_seq` AS `p_seq`,`U`.`pz_seq` AS `pz_seq`,`M`.`m_name` AS `m_name`,`P`.`p_title` AS `p_title`,`PZ`.`pz_title` AS `pz_title` from (((`usepoints` `U` left join `members` `M` on((`U`.`m_seq` = `M`.`m_seq`))) left join `promos` `P` on((`P`.`p_seq` = `U`.`p_seq`))) left join `prizes` `PZ` on((`U`.`pz_seq` = `PZ`.`pz_seq`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`g_seq`);

--
-- Indexes for table `hitcounts`
--
ALTER TABLE `hitcounts`
  ADD PRIMARY KEY (`hc_seq`);

--
-- Indexes for table `infos`
--
ALTER TABLE `infos`
  ADD PRIMARY KEY (`inf_seq`);

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
-- AUTO_INCREMENT for table `hitcounts`
--
ALTER TABLE `hitcounts`
  MODIFY `hc_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `infos`
--
ALTER TABLE `infos`
  MODIFY `inf_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `m_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `prizes`
--
ALTER TABLE `prizes`
  MODIFY `pz_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `promos`
--
ALTER TABLE `promos`
  MODIFY `p_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `serialcodes`
--
ALTER TABLE `serialcodes`
  MODIFY `sc_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26198;

--
-- AUTO_INCREMENT for table `serials`
--
ALTER TABLE `serials`
  MODIFY `s_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `ships`
--
ALTER TABLE `ships`
  MODIFY `sp_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usepoints`
--
ALTER TABLE `usepoints`
  MODIFY `up_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
