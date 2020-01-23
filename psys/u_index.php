<?php

require('session.php');
require('logging.php');

// セッションのクリア
session_start();
setMyName('psys_m');
$sysname = getSsnMyname();
unsetSsn();

// セッション再開
session_start();
setMyName('psys_m');

setSsnIni(parse_ini_file('./common.ini', false));
setSsnTran(parse_ini_file('./transition.ini', false));
setSsnCrntPage(basename(__FILE__));



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
        <img class="bgimage" src="./asset/image/u_index_bg_1.png">
        <img class="bgimage" src="./asset/image/u_index_bg_2.png"
            onmouseover="this.src='./asset/image/u_index_bg_2_on.png'"
            onmouseout="this.src='./asset/image/u_index_bg_2.png'" onclick="location.href='u_membership.php'">
        <img class="bgimage" src='./asset/image/u_index_bg_3.png'
            onmouseover="this.src='./asset/image/u_index_bg_3_on.png'"
            onmouseout="this.src='./asset/image/u_index_bg_3.png'" onclick=" location.href='u_login.php'">
        <img class=" bgimage" src="./asset/image/u_index_bg_4.png">

    </div>

</body>

</html>