<?php

// セッション開始
session_start();
require('session.php');
setMyName('psys_m');
require('logging.php');

$ini = parse_ini_file('./common.ini', false);
setSsnIni($ini);
setSsnCrntPage(basename(__FILE__));

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo getSsnMyname(); ?></title>
    <link rel="stylesheet" href="./asset/css/u_main.css">
</head>

<body>
    <div id="top_menu">
        <div class="top_menu_contents">
            <img src="./asset/image/title_logo.png" alt="logo" />
        </div>
        <div class="top_menu_contents">
            <img src="./asset/image/title_login.png" alt="logo" />
        </div>
        <div class="top_menu_contents">
            <img src="./asset/image/title_menu.png" alt="logo" />
        </div>
    </div>


    <div id="contents">
        <div id="addmember">
            <input type="button" onclick="location.href='u_login.php'" class="rButton w60p btn-red" value="新規登録" />
        </div>
        <div id="login">
            <input type="button" onclick="location.href='u_login.php'"  class="rButton w60p btn-blue" value="ログイン" />
        </div>


    </div>
    <div class="auth_footer">
        <p class="text-muted text-center">© itty</p>
    </div>
    </div>
</body>

</html>