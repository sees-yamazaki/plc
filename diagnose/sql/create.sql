-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 27, 2019 at 09:51 AM
-- Server version: 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `diag`
--

-- --------------------------------------------------------

--
-- Table structure for table `answered_note`
--

CREATE TABLE `answered_note` (
  `an_seq` int(11) NOT NULL,
  `an_id` varchar(30) NOT NULL,
  `an_users_seq` int(11) NOT NULL,
  `an_start_time` datetime DEFAULT NULL,
  `an_answered_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answered_note`
--

INSERT INTO `answered_note` (`an_seq`, `an_id`, `an_users_seq`, `an_start_time`, `an_answered_time`) VALUES
(4, '201909261053191', 1, NULL, '2019-09-26 10:53:19'),
(5, '201909270856201', 1, NULL, '2019-09-27 08:56:20');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `an_id` varchar(30) NOT NULL,
  `q_seq` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`an_id`, `q_seq`, `value`) VALUES
('201909261053191', 6, 2),
('201909261053191', 7, 1),
('201909261053191', 8, 2),
('201909261053191', 9, 0),
('201909261053191', 10, 0),
('201909261053191', 11, 2),
('201909261053191', 12, 2),
('201909261053191', 13, 0),
('201909261053191', 14, 2),
('201909261053191', 15, 2),
('201909261053191', 16, 2),
('201909261053191', 17, 2),
('201909261053191', 18, 0),
('201909261053191', 19, 1),
('201909261053191', 20, 1),
('201909261053191', 21, 2),
('201909261053191', 22, 2),
('201909261053191', 23, 2),
('201909261053191', 24, 2),
('201909261053191', 25, 0),
('201909261053191', 26, 2),
('201909261053191', 27, 2),
('201909261053191', 28, 2),
('201909261053191', 29, 2),
('201909261053191', 30, 2),
('201909261053191', 31, 1),
('201909261053191', 32, 0),
('201909261053191', 33, 2),
('201909261053191', 34, 2),
('201909261053191', 35, 0),
('201909261053191', 36, 1),
('201909261053191', 37, 0),
('201909261053191', 38, 2),
('201909261053191', 39, 0),
('201909261053191', 40, 2),
('201909261053191', 41, 1),
('201909261053191', 42, 0),
('201909261053191', 43, 0),
('201909261053191', 44, 1),
('201909261053191', 45, 0),
('201909261053191', 46, 0),
('201909261053191', 47, 1),
('201909261053191', 48, 1),
('201909261053191', 49, 2),
('201909261053191', 50, 2),
('201909261053191', 51, 1),
('201909261053191', 52, 0),
('201909261053191', 53, 1),
('201909261053191', 54, 2),
('201909261053191', 55, 2),
('201909270856201', 6, 2),
('201909270856201', 7, 0),
('201909270856201', 8, 2),
('201909270856201', 9, 0),
('201909270856201', 10, 0),
('201909270856201', 11, 2),
('201909270856201', 12, 2),
('201909270856201', 13, 0),
('201909270856201', 14, 2),
('201909270856201', 15, 0),
('201909270856201', 16, 2),
('201909270856201', 17, 2),
('201909270856201', 18, 0),
('201909270856201', 19, 0),
('201909270856201', 20, 0),
('201909270856201', 21, 2),
('201909270856201', 22, 2),
('201909270856201', 23, 2),
('201909270856201', 24, 2),
('201909270856201', 25, 0),
('201909270856201', 26, 2),
('201909270856201', 27, 2),
('201909270856201', 28, 0),
('201909270856201', 29, 2),
('201909270856201', 30, 2),
('201909270856201', 31, 2),
('201909270856201', 32, 0),
('201909270856201', 33, 2),
('201909270856201', 34, 2),
('201909270856201', 35, 0),
('201909270856201', 36, 0),
('201909270856201', 37, 0),
('201909270856201', 38, 2),
('201909270856201', 39, 0),
('201909270856201', 40, 2),
('201909270856201', 41, 0),
('201909270856201', 42, 0),
('201909270856201', 43, 0),
('201909270856201', 44, 0),
('201909270856201', 45, 0),
('201909270856201', 46, 0),
('201909270856201', 47, 2),
('201909270856201', 48, 2),
('201909270856201', 49, 2),
('201909270856201', 50, 2),
('201909270856201', 51, 0),
('201909270856201', 52, 0),
('201909270856201', 53, 0),
('201909270856201', 54, 2),
('201909270856201', 55, 0);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `q_seq` int(11) NOT NULL,
  `q_id` int(11) NOT NULL,
  `q_text` varchar(200) NOT NULL,
  `types_seq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`q_seq`, `q_id`, `q_text`, `types_seq`) VALUES
(6, 1, '待ち合わせの時間は守りますか？', 1),
(7, 2, '道徳に反する行動をしませんか？', 1),
(8, 3, 'ルールを守りますか？', 1),
(9, 4, '自分や他人の過ちを責めますか？', 1),
(10, 5, '他人の無責任な行動が許せませんか？', 1),
(11, 6, '人との約束を守りますか？', 1),
(12, 7, '借りた物を期限までに返しますか？', 1),
(13, 8, '他人の不正を許せませんか？', 1),
(14, 9, '一度決めた目標は完遂しようと努力しますか？', 1),
(15, 10, '一度決めたことは完遂すべきだと思いますか？', 1),
(16, 11, '他人を褒めますか？', 2),
(17, 12, '他人の失敗を許せますか？', 2),
(18, 13, '他人や動物の世話が好きですか？', 2),
(19, 14, '困っている人をみると助けますか？', 2),
(20, 15, '赤ちゃんや小さい子を可愛がるのが好きですか？', 2),
(21, 16, '他人の話をしっかり聞きますか？', 2),
(22, 17, '相手の立場や気持ちに立って考えますか？', 2),
(23, 18, '他人からの反論を尊重できますか？', 2),
(24, 19, 'ちょっとしたプレゼントやお返しにこだわりますか？', 2),
(25, 20, '初対面であっても自分の方から挨拶しますか？', 2),
(26, 21, '事実を論理的に分析しますか？', 3),
(27, 22, 'その理由を突き詰めますか？', 3),
(28, 23, '感情的になることはありませんか？', 3),
(29, 24, '根本原因を突き詰めますか？', 3),
(30, 25, '数学の証明問題や推理小説が好きですか？', 3),
(31, 26, '長期計画を立てて努力しますか？', 3),
(32, 27, '社会面をよく読みますか？', 3),
(33, 28, '結果を予測したうえで計画的に行動しますか？', 3),
(34, 29, '自分の考えや行動の善し悪しを客観的に評価できますか？', 3),
(35, 30, '仕事やプライベートの予定や記録を付けていますか？', 3),
(36, 31, '楽観的なほうですか？', 4),
(37, 32, 'よく笑うほうですか？', 4),
(38, 33, '好奇心が強いほうですか？', 4),
(39, 34, 'やりたいことが多いですか？', 4),
(40, 35, '上手に気分転換できますか？', 4),
(41, 36, 'へえ！といった感嘆詞をよく使いますか？', 4),
(42, 37, '趣味は多いですか？', 4),
(43, 38, '空想の世界に没頭することがありますか？', 4),
(44, 39, '行ったことのない場所へ行くのが好きですか？', 4),
(45, 40, '自分は茶目っ気があると思いますか？', 4),
(46, 41, '後悔することがありますか？', 5),
(47, 42, '他人から良く思われようと意識しますか？', 5),
(48, 43, '相手の気持ちを気にして自己主張できないことがありますか？', 5),
(49, 44, '他人の顔色をうかがってしまいますか？', 5),
(50, 45, '人前に出るより裏方へ回りがちですか？', 5),
(51, 46, '快くないことがあっても口には出しませんか？', 5),
(52, 47, '自分は悪くなくても謝ることがありますか？', 5),
(53, 48, '協調性があるほうですか？', 5),
(54, 49, '他人に遠慮しがちですか？', 5),
(55, 50, '上司などの指示に素直に従いますか？', 5);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `types_seq` int(11) NOT NULL,
  `types_id` int(11) NOT NULL,
  `types_name` varchar(10) NOT NULL,
  `types_note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`types_seq`, `types_id`, `types_name`, `types_note`) VALUES
(1, 1, 'CP', 'CP（Controlling Parent：支配的な父親）は、理想的な自分であろうとする自我状態であり、自分の価値観を強く信じる厳しい心です。CPが高いと、理想や向上心、使命感や責任感をもって行動し、完全主義になる傾向があります。\r\n\r\n誠実で倫理的ですが、CPの自我が強すぎると独善的になったり頑固になったりし、厳格なあまり他人に批判的になることもあります。いっぽうCPが低い人は、怠惰、中途半端、無責任、ルーズ、目標意識が低いなどの面が出てくる傾向があります。'),
(2, 2, 'NP', 'NP（Nurturing Parent：世話する母親）は、他人への愛情や思いやりに基づいて行動しようとする自我で、世話好きで保護的な優しい心です。NPが高いと、肯定的で他人への理解力に富み、親切で面倒見が良い性格になる傾向があります。\r\n\r\nしかし、NPの奉仕的な自我が強すぎると、お節介だと思われてしまったり、過保護によってかえって相手の自立や成長を妨げてしまう場合もあります。\r\n\r\nいっぽうNPが極端に低い人は、冷淡で他人を拒絶したり、自分のことしか関心がなく、自らの利益のために他人を利用する傾向があります。'),
(3, 3, 'A', 'A（Adult ego state：大人の自我状態）は、現実に重きを置き、知的で計算力に優れ、頭脳明晰で論理的な心です。\r\n\r\nAの自我が強いと、自分の感情をうまくコントロールできますし、合理性・客観性・計画性にもとづいた判断力にも優れるため、何事も合理的に効率よくこなすことができます。\r\n\r\nしかし、Aが強すぎると、打算的、理屈っぽい、冷たい、などの印象を持たれてしまうこともあります。いっぽうAが低い人は、非合理的な性格になる傾向があり、物事をあまり深く考えず失敗を繰り返しがちだったり、計画性がなく衝動的な行動をとりがちです。'),
(4, 4, 'FC', 'FC（Free Child：自由な子共）は、明るく好奇心旺盛、純粋かつ自由奔放な心で、自己中心的な子供の自我状態です。FCが高いと、楽しみや自分の感情を大切にするとともに、周囲の人々を楽しませるユーモアのセンスも持っています。\r\n\r\nFCが高い人は、自分の気持ちを隠さず表現し、好奇心をもって新しいことに挑戦していきます。人見知りすることがなく、他人とスムーズに交流することができます。\r\n\r\nしかし、FCばかり高すぎると、TPOをわきまえられなかったり、思ったことをすぐ言葉にしてしまうなど、自己中心的な行動をとってしまうことがあります。\r\n\r\nいっぽうFCが低い人は、閉鎖的で暗い性格になる傾向があり、表情や言動から感情が分かりにくかったり、楽しむことが苦手などの傾向がみられます。'),
(5, 5, 'AC', 'AC（adapted child：順応した子供）は、従順で協調的な心です。ACが高いと、他人の意見を素直に聞く傾向があり、協調性が高く、周囲の期待に応えようと頑張ります。\r\n\r\n協調的な「良い子」なのですが、他人の評価を気にして遠慮がちになり、自分の考えを言えなかったり辛いことでも我慢してしまうため、ストレスを溜めこみやすい傾向があります。また、消極的で主体性に欠ける傾向もあり、自分以外の人に依存しがちです。\r\n\r\nいっぽうACが低い人は、他人の意見を聞かなかったり好き勝手に行動するなど、マイペースで自己中心的になる傾向があります。\r\n\r\nACは、ストレスや生きがいの感じ方と関わりが深く、ACが強い従順な人はストレスを感じやすく、生きがいを感じにくいといわれているので、ACは普通～低いが良いようです。');

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
(2, '1212', '1212w', 1, 'ssss'),
(3, '123123', '123123', 2, '22222');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_result`
-- (See below for the actual view)
--
CREATE TABLE `v_result` (
`types_seq` int(11)
,`sum_value` decimal(32,0)
,`an_id` varchar(30)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_result_list`
-- (See below for the actual view)
--
CREATE TABLE `v_result_list` (
`users_seq` int(11)
,`users_id` varchar(10)
,`users_pw` varchar(10)
,`users_level` int(2)
,`users_name` varchar(30)
,`an_answered_time` datetime
);

-- --------------------------------------------------------

--
-- Structure for view `v_result`
--
DROP TABLE IF EXISTS `v_result`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_result`  AS  select `aq`.`types_seq` AS `types_seq`,sum(`aq`.`value`) AS `sum_value`,`aq`.`an_id` AS `an_id` from (select `q`.`q_seq` AS `q_seq`,`q`.`types_seq` AS `types_seq`,`a`.`value` AS `value`,`a`.`an_id` AS `an_id` from (`questions` `q` left join `answers` `a` on((`a`.`q_seq` = `q`.`q_seq`)))) `aq` group by `aq`.`an_id`,`aq`.`types_seq` ;

-- --------------------------------------------------------

--
-- Structure for view `v_result_list`
--
DROP TABLE IF EXISTS `v_result_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_result_list`  AS  select `u`.`users_seq` AS `users_seq`,`u`.`users_id` AS `users_id`,`u`.`users_pw` AS `users_pw`,`u`.`users_level` AS `users_level`,`u`.`users_name` AS `users_name`,`r`.`an_answered_time` AS `an_answered_time` from (`users` `u` left join (select `answered_note`.`an_users_seq` AS `users_seq`,max(`answered_note`.`an_answered_time`) AS `an_answered_time` from `answered_note` group by `answered_note`.`an_users_seq`) `r` on((`u`.`users_seq` = `r`.`users_seq`))) order by `u`.`users_id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answered_note`
--
ALTER TABLE `answered_note`
  ADD PRIMARY KEY (`an_seq`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`q_seq`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`types_seq`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_seq`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answered_note`
--
ALTER TABLE `answered_note`
  MODIFY `an_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `q_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `types_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
