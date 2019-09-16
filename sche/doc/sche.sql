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
  `sche_type` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


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
(1, '1234', '1234', 'あどみん', 1),

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `users_seq` int(11) NOT NULL,
  `groups_seq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Structure for view `v_schedules`
--

CREATE VIEW `v_schedules`  AS  select `s`.`sche_seq` AS `sche_seq`,`s`.`users_seq` AS `users_seq`,`s`.`sche_start_dt` AS `sche_start_dt`,`s`.`sche_start_ymd` AS `sche_start_ymd`,`s`.`sche_start_ym` AS `sche_start_ym`,`s`.`sche_start_hm` AS `sche_start_hm`,`s`.`sche_end_dt` AS `sche_end_dt`,`s`.`sche_end_ymd` AS `sche_end_ymd`,`s`.`sche_end_ym` AS `sche_end_ym`,`s`.`sche_end_hm` AS `sche_end_hm`,`s`.`sche_title` AS `sche_title`,`s`.`sche_note` AS `sche_note`,`s`.`sche_type` AS `sche_type`,`g`.`groups_id` AS `groups_id`,`g`.`groups_name` AS `groups_name` from ((`schedules` `s` left join `user_group` `ug` on((`s`.`users_seq` = `ug`.`users_seq`))) left join `groups` `g` on((`ug`.`groups_seq` = `g`.`groups_seq`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v_user_group`
--

CREATE VIEW `v_user_group`  AS  select `ug`.`users_seq` AS `users_seq`,`ug`.`groups_seq` AS `groups_seq`,`g`.`groups_id` AS `groups_id`,`g`.`groups_name` AS `groups_name` from (`user_group` `ug` left join `groups` `g` on((`ug`.`groups_seq` = `g`.`groups_seq`))) ;

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
  MODIFY `groups_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `sche_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
