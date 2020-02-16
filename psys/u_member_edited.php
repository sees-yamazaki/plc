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
setSsnCrntPage(__FILE__);

//遷移元の確認
// if(!checkPrev(__FILE__)){
//     setSsnMsg('Invalid transition');
//     header('Location: ./u_error.php');
// }

//メニュー内容
$menu_m_url="./asset/image/title_mypage.png";
$menu_m_click="location.href='u_home.php'";

// エラーメッセージの初期化
$errorMessage = '';



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
    <form action='u_member_edit.php' method='POST' name="frmBack">
    </form>


    <div id="menu">
        <?php include('./u_top_menu.php'); ?>
    </div>



    <div id="contents">
        <div class="waku w80p">
            <h3><br>会員情報の更新完了</h3>
            <span class="info">
                <h2><br>会員情報を更新しました</h2><br>
            </span>
            <input type='button' class='rButton w80p f1rem btn-red' onclick="location.href='u_home.php'"
                value='MY PAGEに戻る' />

        </div>

    </div>

</body>

</html>