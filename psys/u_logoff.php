<?php

require('session.php');
require('logging.php');

// セッション開始
session_start();

//メニュー内容
$menu_m_url="./asset/image/title_login.png";
$menu_m_click="location.href='u_login.php'";

// 自セッションのクリア
$sysname = getSsnMyname();
unsetSsn();


?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo getSsnMyname(); ?>
    </title>
    <link rel="stylesheet" href="./asset/css/u_main.css">
</head>

<body>

    <div id="premenu">
        <?php include('./u_top_menu.php'); ?>
    </div>

    <div id="precontents">
        <h3>ログオフしました</h3>
        <div class="waku">
        <input type='button' class='rButton w80p f1rem btn-red' onclick="location.href='u_login.php'" value='ログインする' />
        <br>


    </div>

</body>

</html>