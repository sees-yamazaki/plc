<?php

// セッション開始
session_start();
require('session.php');
setSsnCrntPage(basename(__FILE__));
require('../psys/logging.php');


// エラーメッセージの初期化
$errorMessage = "";

if (getSsnPrevPage()=="forgotpw.php") {
    $m_mail=getSsn('m_mail');
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
                <li><a href="index.php" class="button alt scrolly big">戻る</a></li>
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
            <form action="forgotpw.php" method="POST" name="editFrm">
                <div class="">
                    登録しているメールアドレスに新しいパスワードを送信します。<br>
                    <input type="text" name="m_mail" id="m_mail" value="<?php echo $m_mail ?>" placeholder="e-mail"
                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required />
                </div><br>
                <ul class="actions">
                    <li><a href="javascript:editFrm.submit()" class="button alt scrolly big">登録を確認する</a></li>
                </ul>

            </form>

        </div>
    </section>

    <?php include('./footer.php'); ?>


</body>

</html>