-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 08, 2019 at 11:56 AM
-- Server version: 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `prog`
--

-- --------------------------------------------------------

--
-- Table structure for table `businesses`
--

CREATE TABLE `businesses` (
  `bus_seq` int(11) NOT NULL,
  `sys_seq` int(11) NOT NULL,
  `bus_name` varchar(20) NOT NULL,
  `bus_que` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `businesses`
--

INSERT INTO `businesses` (`bus_seq`, `sys_seq`, `bus_name`, `bus_que`) VALUES
(1, 1, '連絡・通達', 1),
(2, 2, '会社報告状況管理', 1),
(3, 3, 'キャリアパートナー', 1),
(13, 4, '企業状況報告', 1),
(14, 5, '役職者会議', 1),
(15, 5, '安全衛生委員会', 2);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `groups_seq` int(11) NOT NULL,
  `groups_name` varchar(20) NOT NULL,
  `groups_que` int(11) NOT NULL,
  `users_seq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`groups_seq`, `groups_name`, `groups_que`, `users_seq`) VALUES
(1, '社員代表', 1, 0),
(2, '機電1G', 2, 0),
(3, '機電2G', 3, 0),
(4, 'ITS1G', 4, 0),
(5, 'ITS2G', 5, 0),
(6, 'ITS3G', 6, 0),
(7, 'ITS4G', 7, 0),
(8, 'ITS5G', 8, 0),
(9, 'ITS6G', 9, 0),
(10, 'ITS7G', 10, 0),
(11, 'ITS8G', 11, 0),
(12, 'ITS9G', 12, 0),
(13, 'ITS10G', 13, 0);

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `meet_seq` int(11) NOT NULL,
  `meet_date` date NOT NULL,
  `meet_title` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`meet_seq`, `meet_date`, `meet_title`) VALUES
(2, '2019-11-10', 'aaaaaa');

-- --------------------------------------------------------

--
-- Table structure for table `meeting_menbers`
--

CREATE TABLE `meeting_menbers` (
  `mm_seq` int(11) NOT NULL,
  `meet_seq` int(11) NOT NULL,
  `groups_seq` int(11) NOT NULL,
  `mm_status` int(1) NOT NULL,
  `users_seq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meeting_menbers`
--

INSERT INTO `meeting_menbers` (`mm_seq`, `meet_seq`, `groups_seq`, `mm_status`, `users_seq`) VALUES
(1, 2, 3, 0, 0),
(2, 2, 4, 0, 0),
(3, 2, 5, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `systems`
--

CREATE TABLE `systems` (
  `sys_seq` int(11) NOT NULL,
  `sys_name` varchar(20) NOT NULL,
  `sys_que` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `systems`
--

INSERT INTO `systems` (`sys_seq`, `sys_name`, `sys_que`) VALUES
(1, '全般系', 1),
(2, '総務系', 2),
(3, '技術管理系', 3),
(4, '営業系', 4),
(5, '管理系', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `tsk_seq` int(11) NOT NULL,
  `sys_seq` int(11) NOT NULL,
  `bus_seq` int(11) NOT NULL,
  `wk_seq` int(11) NOT NULL,
  `tsk_name` varchar(30) NOT NULL,
  `tsk_que` int(11) NOT NULL,
  `tsk_i10` int(1) NOT NULL DEFAULT '0',
  `tsk_i9` int(1) NOT NULL DEFAULT '0',
  `tsk_i8` int(1) NOT NULL DEFAULT '0',
  `tsk_i7` int(1) NOT NULL DEFAULT '0',
  `tsk_i6` int(1) NOT NULL DEFAULT '0',
  `tsk_i5` int(1) NOT NULL DEFAULT '0',
  `tsk_i4` int(1) NOT NULL DEFAULT '0',
  `tsk_i3` int(1) NOT NULL DEFAULT '0',
  `tsk_i2` int(1) NOT NULL DEFAULT '0',
  `tsk_i1` int(1) NOT NULL DEFAULT '0',
  `tsk_k2` int(1) NOT NULL DEFAULT '0',
  `tsk_k1` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`tsk_seq`, `sys_seq`, `bus_seq`, `wk_seq`, `tsk_name`, `tsk_que`, `tsk_i10`, `tsk_i9`, `tsk_i8`, `tsk_i7`, `tsk_i6`, `tsk_i5`, `tsk_i4`, `tsk_i3`, `tsk_i2`, `tsk_i1`, `tsk_k2`, `tsk_k1`) VALUES
(21, 1, 1, 9, 'STEPX', 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0),
(29, 5, 15, 39, 'あああ', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_seq` int(11) NOT NULL,
  `users_id` varchar(10) NOT NULL,
  `users_pw` varchar(10) NOT NULL,
  `users_level` int(2) NOT NULL,
  `users_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_seq`, `users_id`, `users_pw`, `users_level`, `users_name`) VALUES
(1, '123', '456', 1, 'ADMIN'),
(3, '1112', '1112', 2, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

CREATE TABLE `works` (
  `wk_seq` int(11) NOT NULL,
  `sys_seq` int(11) NOT NULL,
  `bus_seq` int(11) NOT NULL,
  `wk_name` varchar(20) NOT NULL,
  `wk_que` int(11) NOT NULL,
  `wk_note` text NOT NULL,
  `wk_level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `works`
--

INSERT INTO `works` (`wk_seq`, `sys_seq`, `bus_seq`, `wk_name`, `wk_que`, `wk_note`, `wk_level`) VALUES
(9, 1, 1, 'メンバーへ展開', 1, '提出日:随時、　報告ツール:メール／電話、　必要書類:―、　確認に必要なもの:、　対応役職:Ｌ/Ｍ、　優先 :SSSS', 1),
(10, 2, 2, 'WEB打刻', 1, '提出日:毎日、　報告ツール:UTアプリ、　必要書類:―、　確認に必要なもの:、　対応役職:Ｌ/Ｍ、　優先 :A', 4),
(11, 2, 2, '月報', 2, '提出日:15日、　報告ツール:GoogleForms（月報）、　必要書類:―、　確認に必要なもの:スプレットシート（回答）、　対応役職:Ｌ/Ｍ、　優先 :B', 5),
(12, 2, 2, '勤務表', 3, '提出日:末日、　報告ツール:メール（月末アドレス）、　必要書類:（定型文）、　確認に必要なもの:、　対応役職:Ｌ/Ｍ、　優先 :A', 4),
(13, 2, 2, '立替精算', 4, '提出日:15、25、末日、　報告ツール:メール（月末アドレス）、　必要書類:立替精算書、　確認に必要なもの:、　対応役職:Ｌ/Ｍ、　優先 :B', 5),
(14, 2, 2, '出張申請・精算', 5, '提出日:随時、　報告ツール:メール（届出アドレス）、　必要書類:届出書類、　確認に必要なもの:、　対応役職:Ｌ/Ｍ、　優先 :A', 4),
(15, 2, 2, '残業超過通知', 6, '提出日:（残業超過30H）、　報告ツール:メール（届出アドレス）、　必要書類:（定型文）、　確認に必要なもの:、　対応役職:Ｌ/Ｍ、　優先 :A', 4),
(16, 2, 2, '振休・代休連絡', 7, '提出日:随時、　報告ツール:GoogleForms（勤怠）（（届出アドレス）可）、　必要書類:―、　確認に必要なもの:スプレットシート（回答）、　対応役職:Ｌ/Ｍ、　優先 :B', 5),
(17, 2, 2, '休暇連絡', 8, '提出日:基本3営業日前、　報告ツール:GoogleForms（勤怠）（（届出アドレス）可）、　必要書類:―、　確認に必要なもの:スプレットシート（回答）、　対応役職:Ｌ/Ｍ、　優先 :B', 5),
(18, 2, 2, '届出（交通費変更）', 9, '提出日:随時、　報告ツール:メール（届出アドレス）、　必要書類:社員情報変更シート、　確認に必要なもの:、　対応役職:Ｌ/Ｍ、　優先 :C', 6),
(19, 2, 2, '届出（住所・住所等）', 10, '提出日:随時、　報告ツール:メール（届出アドレス）、　必要書類:社員情報変更シート、　確認に必要なもの:、　対応役職:Ｌ/Ｍ、　優先 :C', 6),
(20, 2, 2, 'その他問い合わせ事項', 11, '提出日:随時、　報告ツール:メール（届出アドレス）、　必要書類:―、　確認に必要なもの:、　対応役職:Ｌ/Ｍ、　優先 :C', 6),
(21, 2, 2, '慶弔関係（報告）', 12, '提出日:随時、　報告ツール:メール（届出アドレス）、　必要書類:―慶弔申請書総務対応、　確認に必要なもの:、　対応役職:Ｌ/Ｍ、　優先 :C', 6),
(22, 2, 2, '緊急連絡（個別災害・リスク）', 13, '提出日:随時、　報告ツール:直接、担当営業、総務へ連絡（TEL等）、　必要書類:―、　確認に必要なもの:、　対応役職:―、　優先 :―', 0),
(23, 2, 2, '大規模災害安否確認', 14, '提出日:随時（避難勧告以上）、　報告ツール:GoogleForms（安否確認）、　必要書類:―、　確認に必要なもの:スプレットシート（回答）、　対応役職:Ｌ/Ｍ、　優先 :A', 4),
(24, 2, 2, '総務系提出フォロー', 15, '提出日:随時、　報告ツール:メール／電話、　必要書類:―、　確認に必要なもの:、　対応役職:Ｌ/Ｍ、　優先 :S', 3),
(25, 3, 3, 'キャリア面談', 1, '提出日:最低6ヶ月1回、　報告ツール:キャリア面談表／基本面談／電話可、　必要書類:―、　確認に必要なもの:、　対応役職:Ｌ/Ｍ、　優先 :S', 3),
(26, 3, 3, '査定実施／面談', 2, '提出日:最低6ヶ月1回、　報告ツール:査定報告書記入、　必要書類:査定表、　確認に必要なもの:、　対応役職:Ｌ/Ｍ、　優先 :S', 3),
(27, 3, 3, '査定実施／評価', 3, '提出日:最低6ヶ月1回、　報告ツール:査定報告書集約、　必要書類:査定表、　確認に必要なもの:、　対応役職:M、　優先 :S', 3),
(28, 3, 3, 'CP資格取得', 4, '提出日:2020／3迄、　報告ツール:CP研修受講、試験合格、　必要書類:、　確認に必要なもの:、　対応役職:Ｌ/Ｍ、　優先 :S', 3),
(29, 3, 3, 'UT-Leaning管理・把握', 5, '提出日:随時、　報告ツール:MUST（教育）、　必要書類:MUST（教育）、　確認に必要なもの:、　対応役職:Ｌ/Ｍ、　優先 :B', 5),
(30, 4, 13, '業務内容把握', 1, '提出日:月1回、　報告ツール:各自、　必要書類:―、　確認に必要なもの:、　対応役職:Ｌ/Ｍ、　優先 :S', 3),
(31, 4, 13, '契約状況把握', 2, '提出日:随時、　報告ツール:各自、　必要書類:―、　確認に必要なもの:、　対応役職:Ｌ/Ｍ、　優先 :S', 3),
(32, 4, 13, '問題・悩み相談', 3, '提出日:随時、　報告ツール:各自、　必要書類:MUST（苦情処理台帳）、　確認に必要なもの:、　対応役職:Ｌ/Ｍ、　優先 :S', 3),
(33, 4, 13, '営業との情報連携', 4, '提出日:随時、　報告ツール:各自、　必要書類:―、　確認に必要なもの:、　対応役職:Ｌ/Ｍ、　優先 :S', 3),
(34, 5, 14, '会議参加', 1, '提出日:月1回、　報告ツール:当日参加、　必要書類:―、　確認に必要なもの:、　対応役職:Ｌ/Ｍ、　優先 :S', 3),
(35, 5, 14, 'メンバー状況報告（問題、変化）', 2, '提出日:月1回、　報告ツール:各自、　必要書類:―、　確認に必要なもの:、　対応役職:Ｌ/Ｍ、　優先 :A', 4),
(36, 5, 14, 'メンバー状況報告（通常）', 3, '提出日:月1回、　報告ツール:各自、　必要書類:―、　確認に必要なもの:、　対応役職:Ｌ/Ｍ、　優先 :A', 4),
(37, 5, 14, '議長対応', 4, '提出日:6ヶ月1回、　報告ツール:開催連絡、アジェンダ作成、　必要書類:定型フォーマット、　確認に必要なもの:、　対応役職:Ｌ/Ｍ、　優先 :B', 5),
(38, 5, 14, '書記対応', 5, '提出日:6ヶ月1回、　報告ツール:議事録作成、　必要書類:定型フォーマット、　確認に必要なもの:、　対応役職:Ｌ/Ｍ、　優先 :B', 5),
(39, 5, 15, 'メンバー状況把握（36関係）', 1, '提出日:随時、　報告ツール:内容把握（本人ヒアリング）、　必要書類:―、　確認に必要なもの:、　対応役職:Ｌ/Ｍ、　優先 :A', 4),
(40, 5, 15, 'メンバー状況把握（休暇関係）', 2, '提出日:随時、　報告ツール:内容把握（本人ヒアリング）、　必要書類:―、　確認に必要なもの:、　対応役職:Ｌ/Ｍ、　優先 :A', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `businesses`
--
ALTER TABLE `businesses`
  ADD PRIMARY KEY (`bus_seq`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`groups_seq`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`meet_seq`);

--
-- Indexes for table `meeting_menbers`
--
ALTER TABLE `meeting_menbers`
  ADD PRIMARY KEY (`mm_seq`);

--
-- Indexes for table `systems`
--
ALTER TABLE `systems`
  ADD PRIMARY KEY (`sys_seq`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`tsk_seq`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_seq`);

--
-- Indexes for table `works`
--
ALTER TABLE `works`
  ADD PRIMARY KEY (`wk_seq`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `businesses`
--
ALTER TABLE `businesses`
  MODIFY `bus_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `groups_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `meet_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `meeting_menbers`
--
ALTER TABLE `meeting_menbers`
  MODIFY `mm_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `systems`
--
ALTER TABLE `systems`
  MODIFY `sys_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `tsk_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `works`
--
ALTER TABLE `works`
  MODIFY `wk_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
