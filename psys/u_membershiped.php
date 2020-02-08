<?php

require('session.php');
require('logging.php');
require('db//members.php');

// セッション開始
session_start();
setMyName('psys_m');
setSsnCrntPage(__FILE__);

//遷移元の確認
if(!checkPrev(__FILE__)){
    setSsnMsg('Invalid transition');
    header('Location: ./u_error.php');
}

//メニュー内容
$menu_m_url="./asset/image/title_login.png";
$menu_m_click="location.href='u_login.php'";

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
    <form action='u_membership.php' method='POST' name="frmBack">
    </form>


    <div id="premenu">
        <?php include('./u_top_menu.php'); ?>
    </div>


    <div id="precontents">
        <div class="waku w80p">
        <span class="red"><h2><br>ご登録ありがとうございます。</h2></span>
            <span class="info">
                <br>本人確認用のメールを配信させていただきました。<br>
                <span class="red">メール内のリンクをクリック</span>してください。<br>
                よろしくお願いいたします。<br><br>
                メールが見当たらない場合は、迷惑フィルターに入っている可能性がありますので、ご確認ください。<br><br><br>
            </span>
            <input type="button" class="rButton w80p btn-red" onclick="location.href='u_login.php'" value="ログインする" />

        </div>

    </div>

</body>

</html>