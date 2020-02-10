
CREATE TABLE `x10_adwares` (
  `shadow_id` int(11) NOT NULL,
  `id` varchar(8) NOT NULL,
  `adware_type` int(1) NOT NULL,
  `approvable` int(1) NOT NULL,
  `keyword` text NOT NULL,
  `results` text NOT NULL,
  `hashtag` text NOT NULL,
  `denials` text NOT NULL,
  `ngword` text NOT NULL,
  `note` text NOT NULL,
  `startdt` date DEFAULT NULL,
  `enddt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

--
-- ???????????? `x10_adwares`
--

INSERT INTO `x10_adwares` (`shadow_id`, `id`, `adware_type`, `approvable`, `keyword`, `results`, `hashtag`, `denials`, `ngword`, `note`, `startdt`, `enddt`) VALUES
(1, 'A0000001', 0, 0, '', '', '', '', '', '', NULL, NULL),
(1, 'SA000001', 0, 1, '', '', '', '', '', '', NULL, NULL),
(2, 'A0000002', 1, 0, '', '', '', '', '', '', NULL, NULL),
(2, 'SA000002', 1, 1, '', '', '', '', '', '', '2020-02-01', '2020-02-28');


CREATE TABLE `x10_offer` (
  `adware` varchar(8) NOT NULL,
  `nuser` varchar(8) NOT NULL,
  `status` int(11) NOT NULL,
  `regist` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

--
-- ???????????? `x10_offer`
--

INSERT INTO `x10_offer` (`adware`, `nuser`, `status`, `regist`) VALUES
('SA000001', 'N0000001', 0, 1581317931);



-- --------------------------------------------------------

--
-- ??????? `v_access_x10`
--
DROP VIEW IF EXISTS `v_access_x10`;

CREATE VIEW `v_access_x10`  AS  select `a`.`shadow_id` AS `shadow_id`,`a`.`delete_key` AS `delete_key`,`a`.`id` AS `id`,`a`.`ipaddress` AS `ipaddress`,`a`.`cookie` AS `cookie`,`a`.`adwares_type` AS `adwares_type`,`a`.`adwares` AS `adwares`,`a`.`cuser` AS `cuser`,`a`.`owner` AS `owner`,`a`.`useragent` AS `useragent`,`a`.`referer` AS `referer`,`a`.`state` AS `state`,`a`.`utn` AS `utn`,`a`.`regist` AS `regist`,`x`.`name` AS `name`,`x`.`adware_type` AS `adware_type`,`x`.`approvable` AS `approvable` from (`access` `a` left join `v_adwares_x10` `x` on((`a`.`adwares` = `x`.`id`))) ;

-- --------------------------------------------------------

--
-- ??????? `v_adwares_x10`
--
DROP VIEW IF EXISTS `v_adwares_x10`;

CREATE VIEW `v_adwares_x10`  AS  (select '0' AS `kind`,`s`.`shadow_id` AS `shadow_id`,`s`.`delete_key` AS `delete_key`,`s`.`id` AS `id`,`s`.`cuser` AS `cuser`,`s`.`comment` AS `comment`,`s`.`ad_text` AS `ad_text`,`s`.`category` AS `category`,`s`.`banner` AS `banner`,`s`.`banner2` AS `banner2`,`s`.`banner3` AS `banner3`,`s`.`banner_m` AS `banner_m`,`s`.`banner_m2` AS `banner_m2`,`s`.`banner_m3` AS `banner_m3`,`s`.`url` AS `url`,`s`.`url_m` AS `url_m`,`s`.`url_over` AS `url_over`,`s`.`url_users` AS `url_users`,`s`.`name` AS `name`,`s`.`money` AS `money`,`s`.`ad_type` AS `ad_type`,`s`.`click_money` AS `click_money`,`s`.`continue_money` AS `continue_money`,`s`.`continue_type` AS `continue_type`,`s`.`limits` AS `limits`,`s`.`limit_type` AS `limit_type`,`s`.`money_count` AS `money_count`,`s`.`pay_count` AS `pay_count`,`s`.`click_money_count` AS `click_money_count`,`s`.`continue_money_count` AS `continue_money_count`,`s`.`span` AS `span`,`s`.`span_type` AS `span_type`,`s`.`use_cookie_interval` AS `use_cookie_interval`,`s`.`pay_span` AS `pay_span`,`s`.`pay_span_type` AS `pay_span_type`,`s`.`auto` AS `auto`,`s`.`click_auto` AS `click_auto`,`s`.`continue_auto` AS `continue_auto`,`s`.`check_type` AS `check_type`,`s`.`open` AS `open`,'' AS `open_user`,`s`.`regist` AS `regist`,`c`.`name` AS `category_name`,`x`.`adware_type` AS `adware_type`,`x`.`approvable` AS `approvable`,`x`.`keyword` AS `keyword`,`x`.`results` AS `results`,`x`.`hashtag` AS `hashtag`,`x`.`denials` AS `denials`,`x`.`ngword` AS `ngword`,`x`.`note` AS `note`,`x`.`startdt` AS `startdt`,`x`.`enddt` AS `enddt` from ((`adwares` `s` left join `x10_adwares` `x` on((`s`.`id` = `x`.`id`))) left join `category` `c` on((`s`.`category` = `c`.`id`)))) union (select '1' AS `kind`,`s`.`shadow_id` AS `shadow_id`,`s`.`delete_key` AS `delete_key`,`s`.`id` AS `id`,`s`.`cuser` AS `cuser`,`s`.`comment` AS `comment`,`s`.`ad_text` AS `ad_text`,`s`.`category` AS `category`,`s`.`banner` AS `banner`,`s`.`banner2` AS `banner2`,`s`.`banner3` AS `banner3`,`s`.`banner_m` AS `banner_m`,`s`.`banner_m2` AS `banner_m2`,`s`.`banner_m3` AS `banner_m3`,`s`.`url` AS `url`,`s`.`url_m` AS `url_m`,`s`.`url_over` AS `url_over`,`s`.`url_users` AS `url_users`,`s`.`name` AS `name`,`s`.`money` AS `money`,`s`.`ad_type` AS `ad_type`,`s`.`click_money` AS `click_money`,`s`.`continue_money` AS `continue_money`,`s`.`continue_type` AS `continue_type`,`s`.`limits` AS `limits`,`s`.`limit_type` AS `limit_type`,`s`.`money_count` AS `money_count`,`s`.`pay_count` AS `pay_count`,`s`.`click_money_count` AS `click_money_count`,`s`.`continue_money_count` AS `continue_money_count`,`s`.`span` AS `span`,`s`.`span_type` AS `span_type`,`s`.`use_cookie_interval` AS `use_cookie_interval`,`s`.`pay_span` AS `pay_span`,`s`.`pay_span_type` AS `pay_span_type`,`s`.`auto` AS `auto`,`s`.`click_auto` AS `click_auto`,`s`.`continue_auto` AS `continue_auto`,`s`.`check_type` AS `check_type`,`s`.`open` AS `open`,`s`.`open_user` AS `open_user`,`s`.`regist` AS `regist`,`c`.`name` AS `category_name`,`x`.`adware_type` AS `adware_type`,`x`.`approvable` AS `approvable`,`x`.`keyword` AS `keyword`,`x`.`results` AS `results`,`x`.`hashtag` AS `hashtag`,`x`.`denials` AS `denials`,`x`.`ngword` AS `ngword`,`x`.`note` AS `note`,`x`.`startdt` AS `startdt`,`x`.`enddt` AS `enddt` from ((`secretadwares` `s` left join `x10_adwares` `x` on((`s`.`id` = `x`.`id`))) left join `category` `c` on((`s`.`category` = `c`.`id`)))) ;

-- --------------------------------------------------------

--
-- ??????? `v_click_pay_x10`
--
DROP VIEW IF EXISTS `v_click_pay_x10`;

CREATE VIEW `v_click_pay_x10`  AS  select `p`.`shadow_id` AS `shadow_id`,`p`.`delete_key` AS `delete_key`,`p`.`id` AS `id`,`p`.`access_id` AS `access_id`,`p`.`owner` AS `owner`,`p`.`adwares_type` AS `adwares_type`,`p`.`adwares` AS `adwares`,`p`.`cuser` AS `cuser`,`p`.`cost` AS `cost`,`p`.`state` AS `state`,`p`.`is_notice` AS `is_notice`,`p`.`report_id` AS `report_id`,`p`.`regist` AS `regist`,`x`.`adware_type` AS `adware_type`,`x`.`approvable` AS `approvable` from (`click_pay` `p` left join `x10_adwares` `x` on((`p`.`adwares` = `x`.`id`))) ;

-- --------------------------------------------------------

--
-- ??????? `v_pay_x10`
--
DROP VIEW IF EXISTS `v_pay_x10`;

CREATE VIEW `v_pay_x10`  AS  select `p`.`shadow_id` AS `shadow_id`,`p`.`delete_key` AS `delete_key`,`p`.`id` AS `id`,`p`.`access_id` AS `access_id`,`p`.`ipaddress` AS `ipaddress`,`p`.`cookie` AS `cookie`,`p`.`owner` AS `owner`,`p`.`adwares_type` AS `adwares_type`,`p`.`adwares` AS `adwares`,`p`.`cuser` AS `cuser`,`p`.`cost` AS `cost`,`p`.`sales` AS `sales`,`p`.`froms` AS `froms`,`p`.`froms_sub` AS `froms_sub`,`p`.`state` AS `state`,`p`.`is_notice` AS `is_notice`,`p`.`utn` AS `utn`,`p`.`useragent` AS `useragent`,`p`.`continue_uid` AS `continue_uid`,`p`.`report_id` AS `report_id`,`p`.`regist` AS `regist`,`x`.`name` AS `name`,`x`.`adware_type` AS `adware_type`,`x`.`approvable` AS `approvable` from (`pay` `p` left join `v_adwares_x10` `x` on((`p`.`adwares` = `x`.`id`))) ;

