<?php

// セッション開始
session_start();
require('session.php');
require('../psys/logging.php');

// ログイン状態チェック
if (getSsnIsLogin()==false) {
    header("Location: logoff.php");
    exit;
}


// エラーメッセージの初期化
$errorMessage = "";

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


    <?php include('./menu.php'); ?>

    <!-- Banner -->
    <section id="banner">
        <div class="inner">
            <h1>登録完了</h1>
            <h2><br>発送先情報の登録が完了しました。</h2>
            <ul class="actions">
                <li><a href="home.php" class="button alt scrolly big">戻る</a></li>
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