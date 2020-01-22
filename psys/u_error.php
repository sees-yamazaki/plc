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
        <?php if (!empty($errorMessage)) { ?>
        <span class="err"><br><br><br><?php echo $errorMessage; ?><br><br></span>
        <?php } ?>
        <input type="button" class="rButton w80p btn-red" onclick="location.href='u_index.php'" value="トップに戻る" />
    </div>


</body>

</html>