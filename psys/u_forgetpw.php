<?php

require('session.php');
require('logging.php');

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
$menu_r_url="./asset/image/title_menu.png";
$menu_r_click="location.href='u_info.php'";

// エラーメッセージの初期化
$errorMessage = '';

if (getSsnPrevPage()=="u_forgotpw.php") {
    $m_mail=getSsn('m_mail');
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

<?php include('./u_top_menu.php'); ?>


    <div id="contents">
        <h3><br>パスワード再発行</h3>
        <span class="err">登録しているメールアドレスに<br>新しいパスワードを送信します。<br><br></span>

        <div name="editFrm">
            <form action="u_forgotpw.php" method="POST" name="frm">

                登録メールアドレス<br>
                <input type="text" name="m_mail" id="m_mail" class="input-text w80p"
                    value="<?php echo $m_mail ?>" placeholder="メールアドレス"
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required /><br><br>

                <input type="submit" class="rButton w80p btn-red" value="登録を確認する">
                <input type="hidden" name="doEdit">

            </form>
        </div>

    </div>

</body>

</html>