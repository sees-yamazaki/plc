<?php

require('session.php');
require('logging.php');
require('db//ships.php');

// セッション開始
session_start();
setMyName('psys_m');
//セッションの確認
if (!getSsnIsLogin()) {
    setSsnMsg('Invalid transition');
    header('Location: ./u_error.php');
}
setSsnCrntPage(__FILE__);

//遷移元の確認
// if(!checkPrev(__FILE__)){
//     setSsnMsg('Invalid transition');
//     header('Location: ./u_error.php');
// }

//メニュー内容
$menu_m_url="./asset/image/title_mypage.png";
$menu_m_click="location.href='u_home.php'";

require_once './db/views.php';
$point = getPoint(getSsn("SEQ"));

// エラーメッセージの初期化
$errorMessage = '';

// SESSIONより登録情報の取得
$ship = getSsn('prm_ship');

if (isset($_POST['doEdit'])) {
    updateShip($ship);

    header("Location: ./u_shipformed.php");
}

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
    <form action='u_shipform.php' method='POST' name="frmBack">
    </form>

    <div id="menu">
        <?php include('./u_top_menu.php'); ?>
    </div>


    <div id="contents">
        <div class="waku w80p">
            <h3><br>発送先登録完了</h3>
            <span class="info">
                <h2><br>発送先を登録しました</h2><br>
            </span>
            <input type='button' class='rButton w80p f1rem btn-red' onclick="location.href='u_home.php'"
                value='MY PAGEに戻る' />

        </div>

    </div>

</body>

</html>