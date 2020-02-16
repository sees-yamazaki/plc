<?php
require('session.php');
require('logging.php');

// セッション開始
session_start();
setMyName('psys_m');
//セッションの確認
if (!getSsnIsLogin()) {
    setSsnMsg('Invalid transition');
    header('Location: ./u_error.php');
}

// エラーメッセージの初期化
$errorMessage = '';

//メニュー内容
$menu_m_url="./asset/image/title_mypage.png";
$menu_m_click="location.href='u_home.php'";

require_once './db/views.php';
$point = getPoint(getSsn("SEQ"));


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

    <div id="menu">
        <?php include('./u_top_menu.php'); ?>
    </div>


    <div id="contents">

        <h3><br>ポイント登録完了</h3>
        <div class="msg w80p">
            <?php echo getSsn('POINT_ENTRY'); ?>ポイント加算しました。<br>
            ただいまの合計は<br>
            <span class="red"><?php echo $point; ?>ポイント</span>です。
        </div>
        <br><br>
        <div class="waku w80p">
            <input type="button" class="rButton w100p f1rem btn-red" onclick="location.href='u_pointentry.php'"
                value="続けてシリアルコードを登録する" /><br>
            <input type="button" class="rButton w100p f1rem btn-red-rev" onclick="location.href='u_home.php'"
                value="ホームへ戻る" />
        </div>


</body>

</html>