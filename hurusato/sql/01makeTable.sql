--
-- 明細情報テーブル
--
CREATE TABLE `test_m01` (
  `d01id` bigint(20) NOT NULL,
  `m01id` bigint(20) NOT NULL,
  `m01addtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `m01edittime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `m01deltime` datetime DEFAULT NULL,
  `m01hassouirai` date DEFAULT NULL,
  `i01id` bigint(20) NOT NULL,
  `m01qty` int(11) NOT NULL,
  `m01charge` int(11) NOT NULL,
  `m01postage` int(11) NOT NULL,
  `c01id` bigint(20) DEFAULT NULL,
  `m01hassoubi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `test_m01`
  ADD PRIMARY KEY (`d01id`,`m01id`);

--
-- 商品マスタ
--
CREATE TABLE `test_i01` (
  `i01id` bigint(20) NOT NULL,
  `i01addtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `i01edittime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `i01deltime` datetime DEFAULT NULL,
  `i01name` varchar(255) NOT NULL,
  `i01name2` varchar(255) NOT NULL,
  `i01qty` int(11) NOT NULL,
  `i01price` int(11) NOT NULL,
  `i01gyosha1` int(11) NOT NULL,
  `i01gyosha2` int(11) NOT NULL,
  `i01gyosha3` int(11) NOT NULL,
  `i01gyosha4` int(11) NOT NULL,
  `i01gyosha5` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `test_i01`
  ADD PRIMARY KEY (`i01id`);


--
-- 業者マスタ
--
CREATE TABLE `test_c01` (
  `c01id` bigint(20) NOT NULL,
  `c01addtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `c01edittime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `c01deltime` datetime DEFAULT NULL,
  `c01name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `test_c01`
  ADD PRIMARY KEY (`c01id`);



