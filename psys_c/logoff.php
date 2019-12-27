<?php

// セッション開始
session_start();
require('session.php');

// エラーメッセージの初期化
$errorMessage = "";

// 自セッションのクリア
$sysname = getSsnMyname();
unsetSsn();

// // セッションの変数のクリア
// $_SESSION = array();

// // セッションクリア
// @session_destroy();

?>
<!DOCTYPE HTML>
<html lang="ja">

<head>
    <title><?php echo $sysname; ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="asset/css/main.css" />
</head>

<body>

    <!-- Header -->
    <header id="header">
        <a href="javascript:void(0)" class="logo"><strong><?php echo $sysname; ?></strong> by SEES</a>
    </header>

    <!-- Banner -->
    <section id="banner">
        <div class="inner">
                <h1>ログアウトしました</h1>
                <br><br>
                <ul class="actions">
                    <li><a href="index.php" class="button alt scrolly big">ログインする</a></li>
                </ul>
        </div>
    </section>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.scrolly.min.js"></script>
    <script src="assets/js/skel.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>