<?php

// セッション開始
session_start();
require('session.php');
setSsnCrntPage(basename(__FILE__));
require('../psys/logging.php');

// エラーメッセージの初期化
$errorMessage = "";

setSsnKV('m_mail','');

?>
<!DOCTYPE HTML>
<html lang="ja">

<head>
    <title><?php echo getSsnMyname(); ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="asset/css/main.css" />
</head>

<body>


<header id="header">
        <a href="javascript:void(0)" class="logo"><strong><?php echo getSsnMyname(); ?></strong> by itty</a>
    </header>

    <!-- Banner -->
    <section id="banner">
        <div class="inner">
            <h1>送信完了</h1>
            <h2><br>新しいパスワードを送信しました。</h2>
            <ul class="actions">
                <li><a href="index.php" class="button alt scrolly big">戻る</a></li>
            </ul>

        </div>
    </section>

    <section id="banner">
        <div class="inner">
            <h1><br>&nbsp;<br>&nbsp;<br>&nbsp;</h1>
        </div>
    </section>

    <?php include('./footer.php'); ?>

</body>

</html>