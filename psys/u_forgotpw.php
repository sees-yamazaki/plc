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
$menu_r_url="./asset/image/title_menu_off.png";
$menu_r_click="javascript:void(0);";

// エラーメッセージの初期化
$errorMessage = '';

$m_mail = $_POST['m_mail'];
setSsnKV('m_mail',$m_mail);

if (empty($m_mail)) {
    $errorMessage = 'メールアドレスが入力されていません。';
} else {
    $member = getMemberByMail($m_mail);
    if ($member->m_seq==0) {
        $errorMessage = 'メールアドレスが登録されていません。';
    }
}

if (isset($_POST['doMail'])) {

    if (empty($m_mail)) {
        $errorMessage = 'メールアドレスが入力されていません。';
    } else {
        $member = getMemberByMail($m_mail);
        if ($member->m_seq==0) {
            $errorMessage = 'メールアドレスが登録されていません。';
        }else{

            $newPw=strtotime("now");
            updatePw($member->m_seq,$newPw);

            mb_language("Japanese");
            mb_internal_encoding("UTF-8");
            
            $to      = $m_mail;
            $subject = "新しいパスワード";
            $message = "新しいパスワードは以下となります。\n\n\n\n";
            $message .= $newPw;
            $message .= "\n\n\n\nログイン後にパスワードの再設定を行ってください。";
            $headers = "From: テスト";
            
            mb_send_mail($to, $subject, $message, $headers);
        }
    }

    if (empty($errorMessage)) {
        header("Location: ./u_forgottenpw.php");
    }
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
    <form action='u_forgetpw.php' method='POST' name="frmBack">
    </form>

    <?php include('./u_top_menu.php'); ?>


    <div id="contents">
        <h3><br>パスワード再発行の確認</h3>

        <?php if (empty($errorMessage)) { ?>
        <span class="err">下記のメールアドレスに<br>新しいパスワードを送信します。<br><br></span>
        <?php }else{ ?>
        <span class="err"><?php echo $errorMessage; ?><br><br></span>
        <?php } ?>

        <div name="editFrm">

            <?php echo $m_mail; ?><br><br>
            <?php if (empty($errorMessage)) { ?>
            <form action='' method='POST' name="frm">
                <input type="submit" class="rButton w80p btn-red" value="メールを送信する"><br>
                <input type="hidden" name="m_mail" value="<?php echo $m_mail; ?>">
                <input type="hidden" name="doMail">
            </form>
            <?php } ?>
            <input type="button" class="rButton w80p btn-red-rev" onclick="javascript:frmBack.submit()" value="戻る" />

        </div>

    </div>

</body>

</html>