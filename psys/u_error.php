<?php

require('session.php');
require('logging.php');

// セッション開始
session_start();
setMyName('psys_m');

// エラーメッセージの取得
$errorMessage = '';
if(getSsnMsg()=='Invalid transition'){
    $errorMessage = "不正な遷移を検知しました。";
}

$sysname = getSsnMyname();

// 自セッションのクリア
unsetSsn();

//メニュー内容
$menu_m_url="./asset/image/title_login.png";
$menu_m_click="location.href='u_login.php'";
$menu_r_url="./asset/image/title_menu_off.png";
$menu_r_click="javascript:void(0);";

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

<?php include('./u_top_menu.php'); ?>


    <div id="contents">

        <div id="contents">
            <?php if (!empty($errorMessage)) { ?>
            <span class="err"><br><br><br><?php echo $errorMessage; ?><br><br></span>
            <?php } ?>
            <input type="button" class="rButton w80p btn-red" onclick="location.href='u_index.php'" value="トップに戻る" />
        </div>

    </div>

</body>

</html>