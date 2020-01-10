<?php

// セッション開始
session_start();
require('session.php');
setSsnCrntPage(basename(__FILE__));
require('../psys/logging.php');


// エラーメッセージの初期化
$errorMessage = "";

$m_mail = $_POST['m_mail'];
setSsnKV('m_mail',$m_mail);

require_once '../psys/db/members.php';

if (empty($m_mail)) {
    $errorMessage = 'メールアドレスが入力されていません。';
} else {
    $member = getMemberByMial($m_mail);
    if ($member->m_seq==0) {
        $errorMessage = 'メールアドレスが登録されていません。';
    }
}

if (isset($_POST['repw'])) {

    if (empty($m_mail)) {
        $errorMessage = 'メールアドレスが入力されていません。';
    } else {
        $member = getMemberByMial($m_mail);
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
        header("Location: ./forgottenpw.php");
    }
}

?>
<!DOCTYPE HTML>
<html lang="ja">

<head>
    <title><?php echo getSsnMyname(); ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="asset/css/main.css" />
</head>

<body>

    <!-- Header -->
    <header id="header">
        <a href="javascript:void(0)" class="logo"><strong><?php echo getSsnMyname(); ?></strong> by itty</a>
    </header>

    <section id="banner9">
        <div class="inner">
            <ul class="actions actions2">
                <li><a href="forgetpw.php" class="button alt scrolly big">戻る</a></li>
            </ul>
        </div>
    </section>

    <?php if (!empty($errorMessage)) { ?>
    <section id="bannerErr" class="err">
        <div class="inner">
            <h3><?php echo $errorMessage; ?></h3>
        </div>
    </section>
    <?php } ?>



    <section id="banner">
        <div class="inner">
            <h1>パスワード再発行</h1>
            <form action="" method="POST" name="editFrm">
                <div class="">
                    下記のアドレスに新しいパスワードを送信します。<br><br>
                    <h3><?php echo $m_mail ?></h3>
                </div><br>

                <ul class="actions">
                <?php if (empty($errorMessage)) { ?>
                    <li><a href="javascript:editFrm.submit()" class="button alt scrolly big">送信する</a></li>
                <?php }else{ ?>
                    <li><a href="forgetpw.php" class="button alt scrolly big">戻る</a></li>
                <?php } ?>
                </ul>
                <input type="hidden" name="repw" value="1">
                <input type="hidden" name="m_mail" value="<?php echo $m_mail ?>">

            </form>

        </div>
    </section>

    <?php include('./footer.php'); ?>


</body>

</html>