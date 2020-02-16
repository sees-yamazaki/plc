<?php

require('session.php');
require('logging.php');
require('db//ships.php');
require('db/mails.php');
require('db/views.php');

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

//MAIL
$mails = getMails();

require_once './db/views.php';
$point = getPoint(getSsn("SEQ"));

// エラーメッセージの初期化
$errorMessage = '';

// SESSIONより登録情報の取得
$ship = getSsn('prm_ship');

if (isset($_POST['doEdit'])) {
    updateShip($ship);

    $sp = getVShip($ship->sp_seq);


    require_once './db/members.php';
    $member = getMember(getSsn("SEQ"));

    mb_language("Japanese");
    mb_internal_encoding("UTF-8");
    $base_text = $mails->ship_change_text;
    $text = str_replace('__ITEM__', $sp->pz_title, $base_text);
    $text = str_replace('__NAME__', $sp->sp_name, $text);
    $text = str_replace('__POST__', $sp->sp_post, $text);
    $text = str_replace('__ADD1__', $sp->sp_address1, $text);
    $text = str_replace('__ADD2__', $sp->sp_address2, $text);
    $text = str_replace('__TEL__', $sp->sp_tel, $text);
    $text = str_replace('__BIKOU__', nl2br($sp->sp_text), $text);
    $url = getSsnIni('url');
    $url = $url."u_auth.php?code=".$ship->sp_seq."z".md5($member->m_mail.$member->m_pw)."z".$sp->m_seq;
    $text = str_replace('__URL__', $url, $text);
    logging($url);
    
    $to      = $sp->m_mail;
    $subject = $mails->ship_change_title;
    $message = $text;
    $headers = "From:" .mb_encode_mimeheader("アスミールポイントプログラム");
    
    mb_send_mail($to, $subject, $message, $headers);


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
        <h3><br>発送先情報登録</h3>
        <?php if (!empty($errorMessage)) { ?>
        <span class="err"><?php echo $errorMessage; ?></span>
        <?php } ?>
        <div name="editFrm">
            <form action="" method="POST" name="frm">
                <span class="lightgrey">SP</span><br><?php echo $ship->sp_seq ?><br><br>

                <span class="lightgrey">お名前</span><br><?php echo $ship->sp_name ?><br><br>
                <span class="lightgrey">フリガナ</span><br><?php echo $ship->sp_kana ?><br><br>
                <span class="lightgrey">郵便番号(ハイフンなし)</span><br><?php echo $ship->sp_post ?><br><br>
                <span class="lightgrey">住所</span><br><?php echo $ship->sp_address1 ?><br><br>
                <span class="lightgrey">マンション名・部屋番号</span><br><?php echo $ship->sp_address2 ?><br><br>
                <span class="lightgrey">電話番号</span><br><?php echo $ship->sp_tel ?><br><br>
                <span class="lightgrey">備考</span><br><?php echo nl2br($ship->sp_text) ?><br><br>


                <?php if (empty($errorMessage)) { ?>
                <input type="submit" class="rButton w80p btn-red" value="登録する"><br>
                <input type="hidden" name="doEdit">
                <?php } ?>
                <input type="button" class="rButton w80p btn-red-rev" onclick="javascript:frmBack.submit()"
                    value="戻る" />

            </form>
        </div>

    </div>

    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
</body>

</html>