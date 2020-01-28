-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2020 年 1 月 27 日 15:52
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
DROP TABLE IF EXISTS `games`;

CREATE TABLE `games` (
  `g_seq` int(11) NOT NULL,
  `g_title` varchar(50) NOT NULL,
  `g_image_start` varchar(20) NOT NULL,
  `g_image_hit` varchar(20) NOT NULL,
  `g_image_miss` varchar(20) NOT NULL,
  `g_text` text NOT NULL,
  `editdt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `games`
--


-- --------------------------------------------------------

--
-- テーブルの構造 `hitcounts`
--
DROP TABLE IF EXISTS `hitcounts`;

CREATE TABLE `hitcounts` (
  `hc_seq` int(11) NOT NULL,
  `p_seq` int(11) NOT NULL,
  `pz_seq` int(11) NOT NULL,
  `hc_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `hitcounts`
--


-- --------------------------------------------------------

--
-- テーブルの構造 `infos`
--
DROP TABLE IF EXISTS `infos`;

CREATE TABLE `infos` (
  `inf_seq` int(11) NOT NULL,
  `inf_title` text NOT NULL,
  `inf_text1` text NOT NULL,
  `inf_text2` text NOT NULL,
  `inf_img` varchar(20) NOT NULL,
  `inf_startdt` date NOT NULL,
  `inf_enddt` date NOT NULL,
  `inf_order` int(11) NOT NULL,
  `editdt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `infos`
--


-- --------------------------------------------------------

--
-- テーブルの構造 `log_login`
--
DROP TABLE IF EXISTS `log_login`;

CREATE TABLE `log_login` (
  `logindt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `m_seq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `log_login`
--


-- --------------------------------------------------------

--
-- テーブルの構造 `members`
--
DROP TABLE IF EXISTS `members`;

CREATE TABLE `members` (
  `m_seq` int(11) NOT NULL,
  `m_id` varchar(10) NOT NULL,
  `m_pw` varchar(10) NOT NULL,
  `m_name` varchar(20) NOT NULL,
  `m_mail` varchar(40) NOT NULL,
  `m_post` int(7) NOT NULL,
  `m_address1` varchar(50) NOT NULL,
  `m_address2` varchar(50) NOT NULL,
  `m_tel` varchar(13) NOT NULL,
  `createdt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editdt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `members`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `prizes`
--
DROP TABLE IF EXISTS `prizes`;

CREATE TABLE `prizes` (
  `pz_seq` int(11) NOT NULL,
  `p_seq` int(11) NOT NULL,
  `pz_order` int(11) NOT NULL,
  `pz_title` text NOT NULL,
  `pz_code` varchar(30) NOT NULL,
  `pz_img` varchar(20) NOT NULL,
  `pz_text` text NOT NULL,
  `pz_nowcnt` int(11) NOT NULL DEFAULT '0',
  `pz_kind` int(1) NOT NULL DEFAULT '0',
  `editdt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `prizes`
--


-- --------------------------------------------------------

--
-- テーブルの構造 `promos`
--
DROP TABLE IF EXISTS `promos`;

CREATE TABLE `promos` (
  `p_seq` int(11) NOT NULL,
  `p_title` text NOT NULL,
  `p_text1` text NOT NULL,
  `p_img` varchar(20) NOT NULL,
  `p_text2` text NOT NULL,
  `p_startdt` date NOT NULL,
  `p_enddt` date NOT NULL,
  `g_seq` int(11) NOT NULL,
  `editdt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `promos`
--


-- --------------------------------------------------------

--
-- テーブルの構造 `serialcodes`
--
DROP TABLE IF EXISTS `serialcodes`;

CREATE TABLE `serialcodes` (
  `sc_seq` int(11) NOT NULL,
  `s_seq` int(11) NOT NULL,
  `sc_code` varchar(12) NOT NULL,
  `entrydt` datetime DEFAULT NULL,
  `sc_point` int(11) DEFAULT NULL,
  `m_seq` int(11) DEFAULT NULL,
  `editdt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `serialcodes`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `serials`
--
DROP TABLE IF EXISTS `serials`;

CREATE TABLE `serials` (
  `s_seq` int(11) NOT NULL,
  `s_title` varchar(30) NOT NULL,
  `s_qty` int(5) NOT NULL,
  `createdt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `users_seq` int(11) NOT NULL,
  `editdt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `serials`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `ships`
--
DROP TABLE IF EXISTS `ships`;

CREATE TABLE `ships` (
  `sp_seq` int(11) NOT NULL,
  `m_seq` int(11) NOT NULL,
  `up_seq` int(11) NOT NULL,
  `sp_name` varchar(20) NOT NULL,
  `sp_post` int(7) NOT NULL,
  `sp_address1` varchar(50) NOT NULL,
  `sp_address2` varchar(50) NOT NULL,
  `sp_tel` varchar(13) NOT NULL,
  `sp_text` text NOT NULL,
  `sp_flg` int(11) NOT NULL DEFAULT '0',
  `pz_seq` int(11) NOT NULL,
  `edit_flg` int(1) NOT NULL DEFAULT '0',
  `createdt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editdt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `ships`
--


-- --------------------------------------------------------

--
-- テーブルの構造 `systems`
--
DROP TABLE IF EXISTS `systems`;

CREATE TABLE `systems` (
  `path_root` varchar(100) NOT NULL,
  `path_promo` varchar(100) NOT NULL,
  `path_game` varchar(100) NOT NULL,
  `path_info` varchar(100) NOT NULL,
  `path_scode` varchar(100) NOT NULL,
  `system_name` varchar(30) NOT NULL,
  `point_entry` int(11) NOT NULL,
  `point_game` int(11) NOT NULL,
  `ship_limit` int(11) NOT NULL,
  `editdt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `systems`
--

INSERT INTO `systems` (`path_root`, `path_promo`, `path_game`, `path_info`, `path_scode`, `system_name`, `point_entry`, `point_game`, `ship_limit`, `editdt`) VALUES
('mydata', 'promo', 'game', 'info', 'scode', 'PointSystem', 5, 20, 11, '2020-01-01 00:00:00');

-- --------------------------------------------------------

--
-- テーブルの構造 `usepoints`
--
DROP TABLE IF EXISTS `usepoints`;

CREATE TABLE `usepoints` (
  `up_seq` int(11) NOT NULL,
  `m_seq` int(11) NOT NULL,
  `up_point` int(11) NOT NULL,
  `createdt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `up_status` int(11) NOT NULL,
  `g_seq` int(11) NOT NULL,
  `p_seq` int(11) NOT NULL,
  `pz_seq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `usepoints`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--
DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `users_seq` int(11) NOT NULL,
  `users_id` varchar(20) NOT NULL,
  `users_pw` varchar(20) NOT NULL,
  `users_name` varchar(20) NOT NULL,
  `editdt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`users_seq`, `users_id`, `users_pw`, `users_name`, `editdt`) VALUES
(1, '999', '999', 'あどみん', '2020-01-10 01:35:59');

-- --------------------------------------------------------

--
-- ビュー用の代替構造 `v_lastlogin`
-- (実際のビューを参照するには下にあります)
--
CREATE TABLE `v_lastlogin` (
`logindt` timestamp
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
,`m_tel` varchar(13)
,`createdt` timestamp
,`crnt_point` decimal(35,0)
,`sc_cnt` bigint(21)
,`sc_point` decimal(32,0)
,`cnt_0` bigint(21)
,`up_point_0` decimal(32,0)
,`cnt_1` bigint(21)
,`up_point_1` decimal(32,0)
,`cnt_99` bigint(21)
,`up_point_99` decimal(32,0)
,`logindt` timestamp
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
,`pz_kind` int(1)
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
,`sp_tel` varchar(13)
,`sp_text` text
,`sp_flg` int(11)
,`createdt` timestamp
,`p_title` text
,`pz_title` text
,`pz_code` varchar(30)
,`m_name` varchar(20)
,`m_mail` varchar(40)
,`m_post` int(7)
,`m_address1` varchar(50)
,`m_address2` varchar(50)
,`m_tel` varchar(13)
);

-- --------------------------------------------------------

--
-- ビュー用の代替構造 `v_unships`
-- (実際のビューを参照するには下にあります)
--
CREATE TABLE `v_unships` (
`up_seq` int(11)
,`m_seq` int(11)
,`up_point` int(11)
,`createdt` timestamp
,`up_status` int(11)
,`g_seq` int(11)
,`p_seq` int(11)
,`pz_seq` int(11)
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
,`createdt` timestamp
,`up_status` int(11)
,`g_seq` int(11)
,`p_seq` int(11)
,`pz_seq` int(11)
,`m_name` varchar(20)
,`p_title` text
,`pz_title` text
,`pz_code` varchar(30)
);

-- --------------------------------------------------------

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
  MODIFY `g_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `hitcounts`
--
ALTER TABLE `hitcounts`
  MODIFY `hc_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `infos`
--
ALTER TABLE `infos`
  MODIFY `inf_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `m_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `prizes`
--
ALTER TABLE `prizes`
  MODIFY `pz_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `promos`
--
ALTER TABLE `promos`
  MODIFY `p_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `serialcodes`
--
ALTER TABLE `serialcodes`
  MODIFY `sc_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `serials`
--
ALTER TABLE `serials`
  MODIFY `s_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `ships`
--
ALTER TABLE `ships`
  MODIFY `sp_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `usepoints`
--
ALTER TABLE `usepoints`
  MODIFY `up_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;



--
-- ビュー用の構造 `v_lastlogin`
--
DROP TABLE IF EXISTS `v_lastlogin`;
DROP VIEW IF EXISTS `v_lastlogin`;

CREATE  VIEW `v_lastlogin`  AS  select max(`log_login`.`logindt`) AS `logindt`,`log_login`.`m_seq` AS `m_seq` from `log_login` group by `log_login`.`m_seq` ;

-- --------------------------------------------------------

--
-- ビュー用の構造 `v_members`
--
DROP TABLE IF EXISTS `v_members`;
DROP VIEW IF EXISTS `v_members`;

CREATE  VIEW `v_members`  AS  select `m`.`m_seq` AS `m_seq`,`m`.`m_id` AS `m_id`,`m`.`m_pw` AS `m_pw`,`m`.`m_name` AS `m_name`,`m`.`m_mail` AS `m_mail`,`m`.`m_post` AS `m_post`,`m`.`m_address1` AS `m_address1`,`m`.`m_address2` AS `m_address2`,`m`.`m_tel` AS `m_tel`,`m`.`createdt` AS `createdt`,(case isnull((((`sc`.`sc_point` - `up99`.`up_point_99`) - `up0`.`up_point_0`) - `up1`.`up_point_1`)) when 1 then 0 else (((`sc`.`sc_point` - `up99`.`up_point_99`) - `up0`.`up_point_0`) - `up1`.`up_point_1`) end) AS `crnt_point`,(case isnull(`sc`.`sc_cnt`) when 1 then 0 else `sc`.`sc_cnt` end) AS `sc_cnt`,(case isnull(`sc`.`sc_point`) when 1 then 0 else `sc`.`sc_point` end) AS `sc_point`,(case isnull(`up0`.`cnt_0`) when 1 then 0 else `up0`.`cnt_0` end) AS `cnt_0`,(case isnull(`up0`.`up_point_0`) when 1 then 0 else `up0`.`up_point_0` end) AS `up_point_0`,(case isnull(`up1`.`cnt_1`) when 1 then 0 else `up1`.`cnt_1` end) AS `cnt_1`,(case isnull(`up1`.`up_point_1`) when 1 then 0 else `up1`.`up_point_1` end) AS `up_point_1`,(case isnull(`up99`.`cnt_99`) when 1 then 0 else `up99`.`cnt_99` end) AS `cnt_99`,(case isnull(`up99`.`up_point_99`) when 1 then 0 else `up99`.`up_point_99` end) AS `up_point_99`,`l`.`logindt` AS `logindt` from (((((`members` `m` left join (select `serialcodes`.`m_seq` AS `m_seq`,count(0) AS `sc_cnt`,sum(`serialcodes`.`sc_point`) AS `sc_point` from `serialcodes` where (`serialcodes`.`m_seq` is not null) group by `serialcodes`.`m_seq`) `sc` on((`sc`.`m_seq` = `m`.`m_seq`))) left join (select `usepoints`.`m_seq` AS `m_seq`,count(0) AS `cnt_0`,sum(`usepoints`.`up_point`) AS `up_point_0` from `usepoints` where (`usepoints`.`up_status` = 0) group by `usepoints`.`m_seq`) `up0` on((`up0`.`m_seq` = `m`.`m_seq`))) left join (select `usepoints`.`m_seq` AS `m_seq`,count(0) AS `cnt_1`,sum(`usepoints`.`up_point`) AS `up_point_1` from `usepoints` where (`usepoints`.`up_status` = 1) group by `usepoints`.`m_seq`) `up1` on((`up1`.`m_seq` = `m`.`m_seq`))) left join (select `usepoints`.`m_seq` AS `m_seq`,count(0) AS `cnt_99`,sum(`usepoints`.`up_point`) AS `up_point_99` from `usepoints` where (`usepoints`.`up_status` = 99) group by `usepoints`.`m_seq`) `up99` on((`up99`.`m_seq` = `m`.`m_seq`))) left join `v_lastlogin` `l` on((`l`.`m_seq` = `m`.`m_seq`))) ;

-- --------------------------------------------------------

--
-- ビュー用の構造 `v_point`
--
DROP TABLE IF EXISTS `v_point`;
DROP VIEW IF EXISTS `v_point`;

CREATE  VIEW `v_point`  AS  select `a`.`m_seq` AS `m_seq`,sum(`a`.`point`) AS `point` from (select `serialcodes`.`m_seq` AS `m_seq`,sum(`serialcodes`.`sc_point`) AS `point` from `serialcodes` where (`serialcodes`.`m_seq` is not null) group by `serialcodes`.`m_seq` union select `usepoints`.`m_seq` AS `m_seq`,(sum(`usepoints`.`up_point`) * -(1)) AS `point` from `usepoints` group by `usepoints`.`m_seq`) `a` group by `a`.`m_seq` ;

-- --------------------------------------------------------

--
-- ビュー用の構造 `v_prizes`
--
DROP TABLE IF EXISTS `v_prizes`;
DROP VIEW IF EXISTS `v_prizes`;

CREATE  VIEW `v_prizes`  AS  select `p`.`pz_seq` AS `pz_seq`,`p`.`p_seq` AS `p_seq`,`p`.`pz_order` AS `pz_order`,`p`.`pz_title` AS `pz_title`,`p`.`pz_code` AS `pz_code`,`p`.`pz_img` AS `pz_img`,`p`.`pz_text` AS `pz_text`,`p`.`pz_nowcnt` AS `pz_nowcnt`,`p`.`pz_kind` AS `pz_kind`,`h`.`hc_no` AS `hc_no` from (`prizes` `p` left join (select `hitcounts`.`p_seq` AS `p_seq`,`hitcounts`.`pz_seq` AS `pz_seq`,group_concat(`hitcounts`.`hc_no` separator ',') AS `hc_no` from `hitcounts` group by `hitcounts`.`p_seq`,`hitcounts`.`pz_seq`) `h` on(((`p`.`p_seq` = `h`.`p_seq`) and (`p`.`pz_seq` = `h`.`pz_seq`)))) ;

-- --------------------------------------------------------

--
-- ビュー用の構造 `v_serialcodes`
--
DROP TABLE IF EXISTS `v_serialcodes`;
DROP VIEW IF EXISTS `v_serialcodes`;

CREATE  VIEW `v_serialcodes`  AS  select `s`.`s_seq` AS `s_seq`,`s`.`s_title` AS `s_title`,`s`.`s_qty` AS `s_qty`,`s`.`createdt` AS `createdt`,`s`.`users_seq` AS `users_seq`,`sc`.`sc_seq` AS `sc_seq`,`sc`.`sc_code` AS `sc_code`,`sc`.`entrydt` AS `entrydt`,`sc`.`sc_point` AS `sc_point`,`sc`.`m_seq` AS `m_seq`,`m`.`m_name` AS `m_name` from ((`serials` `s` left join `serialcodes` `sc` on((`s`.`s_seq` = `sc`.`s_seq`))) left join `members` `m` on((`sc`.`m_seq` = `m`.`m_seq`))) ;

-- --------------------------------------------------------

--
-- ビュー用の構造 `v_ships`
--
DROP TABLE IF EXISTS `v_ships`;
DROP VIEW IF EXISTS `v_ships`;

CREATE  VIEW `v_ships`  AS  select `ships`.`sp_seq` AS `sp_seq`,`ships`.`m_seq` AS `m_seq`,`ships`.`up_seq` AS `up_seq`,`ships`.`sp_name` AS `sp_name`,`ships`.`sp_post` AS `sp_post`,`ships`.`sp_address1` AS `sp_address1`,`ships`.`sp_address2` AS `sp_address2`,`ships`.`sp_tel` AS `sp_tel`,`ships`.`sp_text` AS `sp_text`,`ships`.`sp_flg` AS `sp_flg`,`ships`.`createdt` AS `createdt`,`v_usepoints`.`p_title` AS `p_title`,`v_usepoints`.`pz_title` AS `pz_title`,`v_usepoints`.`pz_code` AS `pz_code`,`members`.`m_name` AS `m_name`,`members`.`m_mail` AS `m_mail`,`members`.`m_post` AS `m_post`,`members`.`m_address1` AS `m_address1`,`members`.`m_address2` AS `m_address2`,`members`.`m_tel` AS `m_tel` from ((`ships` left join `v_usepoints` on((`ships`.`up_seq` = `v_usepoints`.`up_seq`))) left join `members` on((`members`.`m_seq` = `ships`.`m_seq`))) ;

-- --------------------------------------------------------

--
-- ビュー用の構造 `v_unships`
--
DROP TABLE IF EXISTS `v_unships`;
DROP VIEW IF EXISTS `v_unships`;

CREATE  VIEW `v_unships`  AS  select `usepoints`.`up_seq` AS `up_seq`,`usepoints`.`m_seq` AS `m_seq`,`usepoints`.`up_point` AS `up_point`,`usepoints`.`createdt` AS `createdt`,`usepoints`.`up_status` AS `up_status`,`usepoints`.`g_seq` AS `g_seq`,`usepoints`.`p_seq` AS `p_seq`,`usepoints`.`pz_seq` AS `pz_seq` from (`usepoints` left join `ships` on((`usepoints`.`up_seq` = `ships`.`up_seq`))) where ((`usepoints`.`up_status` = 1) and isnull(`ships`.`sp_seq`)) ;

-- --------------------------------------------------------

--
-- ビュー用の構造 `v_usepoints`
--
DROP TABLE IF EXISTS `v_usepoints`;
DROP VIEW IF EXISTS `v_usepoints`;

CREATE  VIEW `v_usepoints`  AS  select `u`.`up_seq` AS `up_seq`,`u`.`m_seq` AS `m_seq`,`u`.`up_point` AS `up_point`,`u`.`createdt` AS `createdt`,`u`.`up_status` AS `up_status`,`u`.`g_seq` AS `g_seq`,`u`.`p_seq` AS `p_seq`,`u`.`pz_seq` AS `pz_seq`,`m`.`m_name` AS `m_name`,`p`.`p_title` AS `p_title`,`pz`.`pz_title` AS `pz_title`,`pz`.`pz_code` AS `pz_code` from (((`usepoints` `u` left join `members` `m` on((`u`.`m_seq` = `m`.`m_seq`))) left join `promos` `p` on((`p`.`p_seq` = `u`.`p_seq`))) left join `prizes` `pz` on((`u`.`pz_seq` = `pz`.`pz_seq`))) ;
