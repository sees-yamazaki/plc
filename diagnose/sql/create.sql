-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2019 年 10 月 03 日 14:37
-- サーバのバージョン： 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `diag`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `accepting_que`
--

CREATE TABLE `accepting_que` (
  `aq_seq` int(11) NOT NULL,
  `aq_title` varchar(30) NOT NULL,
  `aq_start_time` date NOT NULL,
  `aq_end_time` date NOT NULL,
  `aq_text` text NOT NULL,
  `que_seq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `accepting_que`
--

INSERT INTO `accepting_que` (`aq_seq`, `aq_title`, `aq_start_time`, `aq_end_time`, `aq_text`, `que_seq`) VALUES
(1, '2019 3Q', '2019-10-01', '2019-10-06', '設問は５０問あります。\r\n時間をかけずに直感で答えてください。', 2),
(2, '2019 3Q 2回目', '2019-10-01', '2019-10-10', '比較用', 2);

-- --------------------------------------------------------

--
-- テーブルの構造 `answered_note`
--

CREATE TABLE `answered_note` (
  `an_seq` int(11) NOT NULL,
  `aq_seq` int(11) NOT NULL DEFAULT '0',
  `que_seq` int(11) NOT NULL DEFAULT '0',
  `an_id` varchar(30) NOT NULL,
  `an_users_seq` int(11) NOT NULL,
  `an_start_time` datetime DEFAULT NULL,
  `an_answered_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `answered_note`
--

INSERT INTO `answered_note` (`an_seq`, `aq_seq`, `que_seq`, `an_id`, `an_users_seq`, `an_start_time`, `an_answered_time`) VALUES
(7, 1, 2, '201910011251201', 1, '2019-10-01 12:50:14', '2019-10-01 12:51:20'),
(8, 1, 2, '201910021351394', 4, '2019-10-02 13:50:52', '2019-10-02 13:51:39');

-- --------------------------------------------------------

--
-- テーブルの構造 `answers`
--

CREATE TABLE `answers` (
  `an_id` varchar(30) NOT NULL,
  `q_seq` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `answers`
--

INSERT INTO `answers` (`an_id`, `q_seq`, `value`) VALUES
('201910011247361', 42, 2),
('201910011247361', 7, 2),
('201910011247361', 50, 2),
('201910011247361', 40, 2),
('201910011247361', 36, 2),
('201910011247361', 44, 2),
('201910011247361', 24, 2),
('201910011247361', 23, 1),
('201910011247361', 21, 1),
('201910011247361', 17, 1),
('201910011247361', 25, 1),
('201910011247361', 43, 1),
('201910011247361', 33, 1),
('201910011247361', 39, 1),
('201910011247361', 55, 1),
('201910011247361', 47, 0),
('201910011247361', 13, 0),
('201910011247361', 48, 0),
('201910011247361', 27, 0),
('201910011247361', 28, 0),
('201910011247361', 38, 0),
('201910011247361', 20, 0),
('201910011247361', 11, 1),
('201910011247361', 22, 2),
('201910011247361', 32, 1),
('201910011247361', 54, 0),
('201910011247361', 12, 1),
('201910011247361', 41, 2),
('201910011247361', 18, 1),
('201910011247361', 19, 0),
('201910011247361', 34, 1),
('201910011247361', 46, 2),
('201910011247361', 6, 2),
('201910011247361', 9, 2),
('201910011247361', 29, 2),
('201910011247361', 51, 2),
('201910011247361', 31, 1),
('201910011247361', 53, 1),
('201910011247361', 45, 1),
('201910011247361', 16, 1),
('201910011247361', 26, 0),
('201910011247361', 49, 1),
('201910011247361', 30, 1),
('201910011247361', 52, 1),
('201910011247361', 35, 1),
('201910011247361', 37, 1),
('201910011247361', 15, 2),
('201910011247361', 10, 2),
('201910011247361', 8, 2),
('201910011247361', 14, 2),
('201910011251201', 48, 2),
('201910011251201', 53, 2),
('201910011251201', 24, 2),
('201910011251201', 54, 2),
('201910011251201', 17, 2),
('201910011251201', 14, 1),
('201910011251201', 46, 1),
('201910011251201', 13, 1),
('201910011251201', 19, 1),
('201910011251201', 9, 1),
('201910011251201', 33, 1),
('201910011251201', 15, 0),
('201910011251201', 10, 0),
('201910011251201', 31, 0),
('201910011251201', 34, 0),
('201910011251201', 42, 0),
('201910011251201', 18, 0),
('201910011251201', 37, 0),
('201910011251201', 23, 1),
('201910011251201', 25, 1),
('201910011251201', 52, 1),
('201910011251201', 45, 1),
('201910011251201', 55, 1),
('201910011251201', 28, 1),
('201910011251201', 39, 1),
('201910011251201', 47, 1),
('201910011251201', 8, 2),
('201910011251201', 6, 2),
('201910011251201', 29, 2),
('201910011251201', 49, 2),
('201910011251201', 26, 2),
('201910011251201', 51, 2),
('201910011251201', 30, 2),
('201910011251201', 32, 1),
('201910011251201', 44, 1),
('201910011251201', 40, 1),
('201910011251201', 21, 0),
('201910011251201', 11, 0),
('201910011251201', 35, 0),
('201910011251201', 16, 0),
('201910011251201', 20, 1),
('201910011251201', 7, 1),
('201910011251201', 27, 1),
('201910011251201', 41, 1),
('201910011251201', 12, 2),
('201910011251201', 50, 2),
('201910011251201', 22, 2),
('201910011251201', 38, 2),
('201910011251201', 43, 1),
('201910011251201', 36, 1),
('201910021351394', 6, 2),
('201910021351394', 13, 2),
('201910021351394', 38, 2),
('201910021351394', 32, 2),
('201910021351394', 24, 2),
('201910021351394', 48, 2),
('201910021351394', 7, 2),
('201910021351394', 12, 2),
('201910021351394', 31, 2),
('201910021351394', 23, 2),
('201910021351394', 9, 2),
('201910021351394', 53, 2),
('201910021351394', 36, 2),
('201910021351394', 49, 2),
('201910021351394', 54, 2),
('201910021351394', 34, 2),
('201910021351394', 11, 2),
('201910021351394', 39, 2),
('201910021351394', 18, 2),
('201910021351394', 27, 2),
('201910021351394', 41, 2),
('201910021351394', 35, 2),
('201910021351394', 40, 2),
('201910021351394', 20, 2),
('201910021351394', 43, 2),
('201910021351394', 19, 2),
('201910021351394', 42, 2),
('201910021351394', 28, 2),
('201910021351394', 14, 2),
('201910021351394', 30, 2),
('201910021351394', 52, 2),
('201910021351394', 29, 2),
('201910021351394', 51, 2),
('201910021351394', 15, 2),
('201910021351394', 33, 2),
('201910021351394', 45, 2),
('201910021351394', 55, 2),
('201910021351394', 17, 2),
('201910021351394', 8, 2),
('201910021351394', 26, 2),
('201910021351394', 16, 2),
('201910021351394', 10, 2),
('201910021351394', 25, 2),
('201910021351394', 47, 2),
('201910021351394', 44, 2),
('201910021351394', 21, 2),
('201910021351394', 50, 2),
('201910021351394', 37, 2),
('201910021351394', 22, 2),
('201910021351394', 46, 2);

-- --------------------------------------------------------

--
-- テーブルの構造 `questionnaires`
--

CREATE TABLE `questionnaires` (
  `que_seq` int(11) NOT NULL,
  `que_title` varchar(50) NOT NULL,
  `que_text` text NOT NULL,
  `que_create_time` datetime NOT NULL,
  `que_editable` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `questionnaires`
--

INSERT INTO `questionnaires` (`que_seq`, `que_title`, `que_text`, `que_create_time`, `que_editable`) VALUES
(2, 'エゴグラム（５０問）', '参考サイト\r\nhttps://jobchange-recipe.com/egogram/', '2019-09-27 15:54:50', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `questions`
--

CREATE TABLE `questions` (
  `q_seq` int(11) NOT NULL,
  `q_id` int(11) NOT NULL,
  `q_text` varchar(200) NOT NULL,
  `types_seq` int(11) NOT NULL,
  `que_seq` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `questions`
--

INSERT INTO `questions` (`q_seq`, `q_id`, `q_text`, `types_seq`, `que_seq`) VALUES
(6, 1, '待ち合わせの時間は守りますか？', 1, 2),
(7, 2, '道徳に反する行動をしませんか？', 1, 2),
(8, 3, 'ルールを守りますか？', 1, 2),
(9, 4, '自分や他人の過ちを責めますか？', 1, 2),
(10, 5, '他人の無責任な行動が許せませんか？', 1, 2),
(11, 6, '人との約束を守りますか？', 1, 2),
(12, 7, '借りた物を期限までに返しますか？', 1, 2),
(13, 8, '他人の不正を許せませんか？', 1, 2),
(14, 9, '一度決めた目標は完遂しようと努力しますか？', 1, 2),
(15, 10, '一度決めたことは完遂すべきだと思いますか？', 1, 2),
(16, 11, '他人を褒めますか？', 2, 2),
(17, 12, '他人の失敗を許せますか？', 2, 2),
(18, 13, '他人や動物の世話が好きですか？', 2, 2),
(19, 14, '困っている人をみると助けますか？', 2, 2),
(20, 15, '赤ちゃんや小さい子を可愛がるのが好きですか？', 2, 2),
(21, 16, '他人の話をしっかり聞きますか？', 2, 2),
(22, 17, '相手の立場や気持ちに立って考えますか？', 2, 2),
(23, 18, '他人からの反論を尊重できますか？', 2, 2),
(24, 19, 'ちょっとしたプレゼントやお返しにこだわりますか？', 2, 2),
(25, 20, '初対面であっても自分の方から挨拶しますか？', 2, 2),
(26, 21, '事実を論理的に分析しますか？', 3, 2),
(27, 22, 'その理由を突き詰めますか？', 3, 2),
(28, 23, '感情的になることはありませんか？', 3, 2),
(29, 24, '根本原因を突き詰めますか？', 3, 2),
(30, 25, '数学の証明問題や推理小説が好きですか？', 3, 2),
(31, 26, '長期計画を立てて努力しますか？', 3, 2),
(32, 27, '社会面をよく読みますか？', 3, 2),
(33, 28, '結果を予測したうえで計画的に行動しますか？', 3, 2),
(34, 29, '自分の考えや行動の善し悪しを客観的に評価できますか？', 3, 2),
(35, 30, '仕事やプライベートの予定や記録を付けていますか？', 3, 2),
(36, 31, '楽観的なほうですか？', 4, 2),
(37, 32, 'よく笑うほうですか？', 4, 2),
(38, 33, '好奇心が強いほうですか？', 4, 2),
(39, 34, 'やりたいことが多いですか？', 4, 2),
(40, 35, '上手に気分転換できますか？', 4, 2),
(41, 36, 'へえ！といった感嘆詞をよく使いますか？', 4, 2),
(42, 37, '趣味は多いですか？', 4, 2),
(43, 38, '空想の世界に没頭することがありますか？', 4, 2),
(44, 39, '行ったことのない場所へ行くのが好きですか？', 4, 2),
(45, 40, '自分は茶目っ気があると思いますか？', 4, 2),
(46, 41, '後悔することがありますか？', 5, 2),
(47, 42, '他人から良く思われようと意識しますか？', 5, 2),
(48, 43, '相手の気持ちを気にして自己主張できないことがありますか？', 5, 2),
(49, 44, '他人の顔色をうかがってしまいますか？', 5, 2),
(50, 45, '人前に出るより裏方へ回りがちですか？', 5, 2),
(51, 46, '快くないことがあっても口には出しませんか？', 5, 2),
(52, 47, '自分は悪くなくても謝ることがありますか？', 5, 2),
(53, 48, '協調性があるほうですか？', 5, 2),
(54, 49, '他人に遠慮しがちですか？', 5, 2),
(55, 50, '上司などの指示に素直に従いますか？', 5, 2),
(56, 51, 'ccc', 11, 0),
(57, 52, 'aaxcc', 11, 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `types`
--

CREATE TABLE `types` (
  `types_seq` int(11) NOT NULL,
  `types_id` int(11) NOT NULL,
  `types_name` varchar(10) NOT NULL,
  `types_note` text NOT NULL,
  `que_seq` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `types`
--

INSERT INTO `types` (`types_seq`, `types_id`, `types_name`, `types_note`, `que_seq`) VALUES
(1, 1, 'CP', 'CP（Controlling Parent：支配的な父親）は、理想的な自分であろうとする自我状態であり、自分の価値観を強く信じる厳しい心です。CPが高いと、理想や向上心、使命感や責任感をもって行動し、完全主義になる傾向があります。\r\n\r\n誠実で倫理的ですが、CPの自我が強すぎると独善的になったり頑固になったりし、厳格なあまり他人に批判的になることもあります。いっぽうCPが低い人は、怠惰、中途半端、無責任、ルーズ、目標意識が低いなどの面が出てくる傾向があります。', 2),
(2, 2, 'NP', 'NP（Nurturing Parent：世話する母親）は、他人への愛情や思いやりに基づいて行動しようとする自我で、世話好きで保護的な優しい心です。NPが高いと、肯定的で他人への理解力に富み、親切で面倒見が良い性格になる傾向があります。\r\n\r\nしかし、NPの奉仕的な自我が強すぎると、お節介だと思われてしまったり、過保護によってかえって相手の自立や成長を妨げてしまう場合もあります。\r\n\r\nいっぽうNPが極端に低い人は、冷淡で他人を拒絶したり、自分のことしか関心がなく、自らの利益のために他人を利用する傾向があります。', 2),
(3, 3, 'A', 'A（Adult ego state：大人の自我状態）は、現実に重きを置き、知的で計算力に優れ、頭脳明晰で論理的な心です。\r\n\r\nAの自我が強いと、自分の感情をうまくコントロールできますし、合理性・客観性・計画性にもとづいた判断力にも優れるため、何事も合理的に効率よくこなすことができます。\r\n\r\nしかし、Aが強すぎると、打算的、理屈っぽい、冷たい、などの印象を持たれてしまうこともあります。いっぽうAが低い人は、非合理的な性格になる傾向があり、物事をあまり深く考えず失敗を繰り返しがちだったり、計画性がなく衝動的な行動をとりがちです。', 2),
(4, 4, 'FC', 'FC（Free Child：自由な子共）は、明るく好奇心旺盛、純粋かつ自由奔放な心で、自己中心的な子供の自我状態です。FCが高いと、楽しみや自分の感情を大切にするとともに、周囲の人々を楽しませるユーモアのセンスも持っています。\r\n\r\nFCが高い人は、自分の気持ちを隠さず表現し、好奇心をもって新しいことに挑戦していきます。人見知りすることがなく、他人とスムーズに交流することができます。\r\n\r\nしかし、FCばかり高すぎると、TPOをわきまえられなかったり、思ったことをすぐ言葉にしてしまうなど、自己中心的な行動をとってしまうことがあります。\r\n\r\nいっぽうFCが低い人は、閉鎖的で暗い性格になる傾向があり、表情や言動から感情が分かりにくかったり、楽しむことが苦手などの傾向がみられます。', 2),
(5, 5, 'AC', 'AC（adapted child：順応した子供）は、従順で協調的な心です。ACが高いと、他人の意見を素直に聞く傾向があり、協調性が高く、周囲の期待に応えようと頑張ります。\r\n\r\n協調的な「良い子」なのですが、他人の評価を気にして遠慮がちになり、自分の考えを言えなかったり辛いことでも我慢してしまうため、ストレスを溜めこみやすい傾向があります。また、消極的で主体性に欠ける傾向もあり、自分以外の人に依存しがちです。\r\n\r\nいっぽうACが低い人は、他人の意見を聞かなかったり好き勝手に行動するなど、マイペースで自己中心的になる傾向があります。\r\n\r\nACは、ストレスや生きがいの感じ方と関わりが深く、ACが強い従順な人はストレスを感じやすく、生きがいを感じにくいといわれているので、ACは普通～低いが良いようです。', 2);

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `users_seq` int(11) NOT NULL,
  `users_id` varchar(10) NOT NULL,
  `users_pw` varchar(10) NOT NULL,
  `users_level` int(2) NOT NULL,
  `users_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`users_seq`, `users_id`, `users_pw`, `users_level`, `users_name`) VALUES
(1, '123', '456', 1, 'ADMIN'),
(2, '1111', '1111', 2, 'John Tomas 1111'),
(3, '2222', '2222', 1, '管理者　太郎'),
(4, '2000', '2000', 2, 'テスト登録');

-- --------------------------------------------------------

--
-- ビュー用の代替構造 `v_answered_note`
-- (実際のビューを参照するには下にあります)
--
CREATE TABLE `v_answered_note` (
`an_seq` int(11)
,`aq_seq` int(11)
,`que_seq` int(11)
,`an_id` varchar(30)
,`an_users_seq` int(11)
,`an_start_time` datetime
,`an_answered_time` datetime
,`aq_title` varchar(30)
,`que_title` varchar(50)
);

-- --------------------------------------------------------

--
-- ビュー用の代替構造 `v_questionnaires`
-- (実際のビューを参照するには下にあります)
--
CREATE TABLE `v_questionnaires` (
`que_seq` int(11)
,`que_title` varchar(50)
,`que_text` text
,`que_create_time` datetime
,`que_editable` int(1)
,`qCnt` bigint(21)
,`tCnt` bigint(21)
);

-- --------------------------------------------------------

--
-- ビュー用の代替構造 `v_result`
-- (実際のビューを参照するには下にあります)
--
CREATE TABLE `v_result` (
`types_seq` int(11)
,`sum_value` decimal(32,0)
,`an_id` varchar(30)
);

-- --------------------------------------------------------

--
-- ビュー用の代替構造 `v_result_list`
-- (実際のビューを参照するには下にあります)
--
CREATE TABLE `v_result_list` (
`users_seq` int(11)
,`users_id` varchar(10)
,`users_pw` varchar(10)
,`users_level` int(2)
,`users_name` varchar(30)
,`an_answered_time` datetime
,`aq_seq` int(11)
,`que_seq` int(11)
,`aq_title` varchar(30)
,`que_title` varchar(50)
);

-- --------------------------------------------------------

--
-- ビュー用の構造 `v_answered_note`
--
DROP TABLE IF EXISTS `v_answered_note`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_answered_note`  AS  select `an`.`an_seq` AS `an_seq`,`an`.`aq_seq` AS `aq_seq`,`an`.`que_seq` AS `que_seq`,`an`.`an_id` AS `an_id`,`an`.`an_users_seq` AS `an_users_seq`,`an`.`an_start_time` AS `an_start_time`,`an`.`an_answered_time` AS `an_answered_time`,`aq`.`aq_title` AS `aq_title`,`q`.`que_title` AS `que_title` from ((`answered_note` `an` left join `accepting_que` `aq` on((`an`.`aq_seq` = `aq`.`aq_seq`))) left join `questionnaires` `q` on((`an`.`que_seq` = `q`.`que_seq`))) ;

-- --------------------------------------------------------

--
-- ビュー用の構造 `v_questionnaires`
--
DROP TABLE IF EXISTS `v_questionnaires`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_questionnaires`  AS  select `que`.`que_seq` AS `que_seq`,`que`.`que_title` AS `que_title`,`que`.`que_text` AS `que_text`,`que`.`que_create_time` AS `que_create_time`,`que`.`que_editable` AS `que_editable`,`q`.`qCnt` AS `qCnt`,`t`.`tCnt` AS `tCnt` from ((`questionnaires` `que` left join (select count(`questions`.`q_seq`) AS `qCnt`,`questions`.`que_seq` AS `que_seq` from `questions` group by `questions`.`que_seq`) `q` on((`q`.`que_seq` = `que`.`que_seq`))) left join (select count(`types`.`types_seq`) AS `tCnt`,`types`.`que_seq` AS `que_seq` from `types` group by `types`.`que_seq`) `t` on((`t`.`que_seq` = `que`.`que_seq`))) ;

-- --------------------------------------------------------

--
-- ビュー用の構造 `v_result`
--
DROP TABLE IF EXISTS `v_result`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_result`  AS  select `aq`.`types_seq` AS `types_seq`,sum(`aq`.`value`) AS `sum_value`,`aq`.`an_id` AS `an_id` from (select `q`.`q_seq` AS `q_seq`,`q`.`types_seq` AS `types_seq`,`a`.`value` AS `value`,`a`.`an_id` AS `an_id` from (`questions` `q` left join `answers` `a` on((`a`.`q_seq` = `q`.`q_seq`)))) `aq` group by `aq`.`an_id`,`aq`.`types_seq` ;

-- --------------------------------------------------------

--
-- ビュー用の構造 `v_result_list`
--
DROP TABLE IF EXISTS `v_result_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_result_list`  AS  select `u`.`users_seq` AS `users_seq`,`u`.`users_id` AS `users_id`,`u`.`users_pw` AS `users_pw`,`u`.`users_level` AS `users_level`,`u`.`users_name` AS `users_name`,`r`.`an_answered_time` AS `an_answered_time`,`r`.`aq_seq` AS `aq_seq`,`r`.`que_seq` AS `que_seq`,`r`.`aq_title` AS `aq_title`,`r`.`que_title` AS `que_title` from ((`users` `u` left join (select `v_answered_note`.`an_users_seq` AS `users_seq`,max(`v_answered_note`.`an_answered_time`) AS `an_answered_time` from `v_answered_note` group by `v_answered_note`.`an_users_seq`) `r0` on((`u`.`users_seq` = `r0`.`users_seq`))) left join (select `rr`.`an_users_seq` AS `users_seq`,`rr`.`an_answered_time` AS `an_answered_time`,`rr`.`aq_seq` AS `aq_seq`,`rr`.`que_seq` AS `que_seq`,`rr`.`aq_title` AS `aq_title`,`rr`.`que_title` AS `que_title` from `v_answered_note` `rr`) `r` on(((`r0`.`users_seq` = `r`.`users_seq`) and (`r0`.`an_answered_time` = `r`.`an_answered_time`)))) order by `u`.`users_id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accepting_que`
--
ALTER TABLE `accepting_que`
  ADD PRIMARY KEY (`aq_seq`);

--
-- Indexes for table `answered_note`
--
ALTER TABLE `answered_note`
  ADD PRIMARY KEY (`an_seq`);

--
-- Indexes for table `questionnaires`
--
ALTER TABLE `questionnaires`
  ADD PRIMARY KEY (`que_seq`);

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
-- AUTO_INCREMENT for table `accepting_que`
--
ALTER TABLE `accepting_que`
  MODIFY `aq_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `answered_note`
--
ALTER TABLE `answered_note`
  MODIFY `an_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `questionnaires`
--
ALTER TABLE `questionnaires`
  MODIFY `que_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `q_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `types_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
