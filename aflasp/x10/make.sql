
--
-- テーブルの構造 `x10_offer`
--

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
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

DROP VIEW `v_adwares_x10`;
CREATE VIEW `v_adwares_x10`  AS  (select '0' AS `kind`,`s`.`shadow_id` AS `shadow_id`,`s`.`delete_key` AS `delete_key`,`s`.`id` AS `id`,`s`.`cuser` AS `cuser`,`s`.`comment` AS `comment`,`s`.`ad_text` AS `ad_text`,`s`.`category` AS `category`,`s`.`banner` AS `banner`,`s`.`banner2` AS `banner2`,`s`.`banner3` AS `banner3`,`s`.`banner_m` AS `banner_m`,`s`.`banner_m2` AS `banner_m2`,`s`.`banner_m3` AS `banner_m3`,`s`.`url` AS `url`,`s`.`url_m` AS `url_m`,`s`.`url_over` AS `url_over`,`s`.`url_users` AS `url_users`,`s`.`name` AS `name`,`s`.`money` AS `money`,`s`.`ad_type` AS `ad_type`,`s`.`click_money` AS `click_money`,`s`.`continue_money` AS `continue_money`,`s`.`continue_type` AS `continue_type`,`s`.`limits` AS `limits`,`s`.`limit_type` AS `limit_type`,`s`.`money_count` AS `money_count`,`s`.`pay_count` AS `pay_count`,`s`.`click_money_count` AS `click_money_count`,`s`.`continue_money_count` AS `continue_money_count`,`s`.`span` AS `span`,`s`.`span_type` AS `span_type`,`s`.`use_cookie_interval` AS `use_cookie_interval`,`s`.`pay_span` AS `pay_span`,`s`.`pay_span_type` AS `pay_span_type`,`s`.`auto` AS `auto`,`s`.`click_auto` AS `click_auto`,`s`.`continue_auto` AS `continue_auto`,`s`.`check_type` AS `check_type`,`s`.`open` AS `open`,'' AS `open_user`,`s`.`regist` AS `regist`,`c`.`name` AS `category_name`
,`x`.`adware_type` AS `adware_type`
,`x`.`approvable` AS `approvable`
,`x`.`keyword` AS `keyword`
,`x`.`results` AS `results`
,`x`.`hashtag` AS `hashtag`
,`x`.`denials` AS `denials`
,`x`.`ngword` AS `ngword`
,`x`.`note` AS `note`
 from ((`adwares` `s` left join `x10_adwares` `x` on((`s`.`shadow_id` = `x`.`shadow_id`))) left join `category` `c` on((`s`.`category` = `c`.`id`)))) union (select '1' AS `kind`,`s`.`shadow_id` AS `shadow_id`,`s`.`delete_key` AS `delete_key`,`s`.`id` AS `id`,`s`.`cuser` AS `cuser`,`s`.`comment` AS `comment`,`s`.`ad_text` AS `ad_text`,`s`.`category` AS `category`,`s`.`banner` AS `banner`,`s`.`banner2` AS `banner2`,`s`.`banner3` AS `banner3`,`s`.`banner_m` AS `banner_m`,`s`.`banner_m2` AS `banner_m2`,`s`.`banner_m3` AS `banner_m3`,`s`.`url` AS `url`,`s`.`url_m` AS `url_m`,`s`.`url_over` AS `url_over`,`s`.`url_users` AS `url_users`,`s`.`name` AS `name`,`s`.`money` AS `money`,`s`.`ad_type` AS `ad_type`,`s`.`click_money` AS `click_money`,`s`.`continue_money` AS `continue_money`,`s`.`continue_type` AS `continue_type`,`s`.`limits` AS `limits`,`s`.`limit_type` AS `limit_type`,`s`.`money_count` AS `money_count`,`s`.`pay_count` AS `pay_count`,`s`.`click_money_count` AS `click_money_count`,`s`.`continue_money_count` AS `continue_money_count`,`s`.`span` AS `span`,`s`.`span_type` AS `span_type`,`s`.`use_cookie_interval` AS `use_cookie_interval`,`s`.`pay_span` AS `pay_span`,`s`.`pay_span_type` AS `pay_span_type`,`s`.`auto` AS `auto`,`s`.`click_auto` AS `click_auto`,`s`.`continue_auto` AS `continue_auto`,`s`.`check_type` AS `check_type`,`s`.`open` AS `open`,`s`.`open_user` AS `open_user`,`s`.`regist` AS `regist`,`c`.`name` AS `category_name`
,`x`.`adware_type` AS `adware_type`
,`x`.`approvable` AS `approvable`
,`x`.`keyword` AS `keyword`
,`x`.`results` AS `results`
,`x`.`hashtag` AS `hashtag`
,`x`.`denials` AS `denials`
,`x`.`ngword` AS `ngword`
,`x`.`note` AS `note`
  from ((`secretadwares` `s` left join `x10_adwares` `x` on((`s`.`shadow_id` = `x`.`shadow_id`))) left join `category` `c` on((`s`.`category` = `c`.`id`)))) ;
