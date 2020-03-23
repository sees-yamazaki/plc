<?php
include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';
include 'x10c/db/adwares.php';
include 'x10c/db/x10.php';
include 'x10c/db/nuser.php';
include 'x10c/db/system.php';

// セッション再開
session_start();

//Timezone
date_default_timezone_set('Asia/Tokyo');

// エラーメッセージの初期化
$errorMessage = '';

$LOGIN_ID = $_SESSION[ $SESSION_NAME ];
if(empty($LOGIN_ID)){ header('Location: x10u_logoff.php'); }


if(isset($_POST['doCheck'])){

    $nUser->mail = $_POST['mail'];
    $nUser->mail_confirm = $_POST['mail_confirm'];
    $nUser->pass = $_POST['pass'];
    $nUser->pass_confirm = $_POST['pass_confirm'];
    $nUser->name = $_POST['name'];
    $nUser->tel = $_POST['tel'];
    if ($_POST['mail'] <> $_POST['mail_confirm']) {
        $err_mail_div = ' is-error';
        $err_mail_msg = '<p class="form-row-error-text">メールアドレスが一致しません。</p>';
    } elseif ($_POST['pass'] <> $_POST['pass_confirm']) {
        $err_pass_div = ' is-error';
        $err_pass_msg = '<p class="form-row-error-text">パスワードが一致しません。</p>';
    } elseif (countNUserByMailOthers($_POST['mail'],$LOGIN_ID)>0) {
        $err_mail_div = ' is-error';
        $err_mail_msg = '<p class="form-row-error-text">このメールアドレスは使用されています。</p>';
    } else {
        // $pw1 = preg_replace('/^\w+:/', '', $nUser->pass);
        // $pw2 = openssl_encrypt($pw1, 'aes-256-ecb', base64_encode('AES'));
        // $nUser->pass = $pw2;

        header('Location: x10u_user_basic_confirm.php', true, 307);
    }
}elseif(isset($_POST['4back'])){
    $nUser->mail = $_POST['mail'];
    $nUser->mail_confirm = $_POST['mail_confirm'];
    $nUser->pass = $_POST['pass'];
    $nUser->pass_confirm = $_POST['pass_confirm'];
    $nUser->name = $_POST['name'];
    $nUser->tel = $_POST['tel'];
}else{
    $nUser = getNuser($LOGIN_ID);
    $nUser->pass = "nochange";
    $nUser->mail_confirm = $nUser->mail;
    $nUser->pass_confirm = $nUser->pass;
}


?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>基本情報を編集する</title>
    <meta name="description" content="アフィリエイト管理画面">
    <?php include(__DIR__ . '/x10u/inc/meta.php'); ?>
</head>

<body>

    <?php include(__DIR__ . '/x10u/inc/header.php'); ?>

    <main class="main">

        <div class="mainheader">
            <p class="breadcrumbs">
                <a href="#">トップ</a>
                <a href="#">ユーザー情報設定変更</a>
                <a href="#">基本情報を編集する</a>
            </p>
        </div>

        <div class="pageheader">
            <div class="pageheader__inner container">
                <h1 class="pageheader_title">基本情報を編集する</h1>
            </div>
        </div>

        <section class="sec-user section">
            <div class="sec__inner container">
                <form action="" method="post" class="form__basic_user">
                    <div class="form__user__basic form__content_block">
                        <h3 class="bar-title"><span class="bar-title-text">基本情報</span></h3>
                        <div class="form-row <?php echo $err_mail_div; ?>">
                            <p class="form-row-text"><span class="req">必須</span>メールアドレス</p>
                              <?php echo $err_mail_msg; ?>
                            <input type="text" name="mail" value="<?php echo $nUser->mail;?>" placeholder="メールアドレスを入力" required>
                            <p class="form-row-anno">※注意書きがここに入ります</p>
                        </div>
                        <div class="form-row <?php echo $err_mail_div; ?>">
                            <p class="form-row-text"><span class="req">必須</span>メールアドレス（再入力）</p>
                            <input type="text" name="mail_confirm" value="<?php echo $nUser->mail_confirm;?>"
                                placeholder="メールアドレスを入力" required>
                            <p class="form-row-anno">※注意書きがここに入ります</p>
                        </div>
                        <div class="form-row <?php echo $err_pass_div; ?>">
                            <p class="form-row-text"><span class="req">必須</span>パスワード</p>
                              <?php echo $err_pass_msg; ?>
                            <input type="password" name="pass" value="<?php echo $nUser->pass;?>"　placeholder="パスワードを入力">
                            <p class="form-row-anno">※注意書きがここに入ります</p>
                        </div>
                        <div class="form-row <?php echo $err_pass_div; ?>">
                            <p class="form-row-text"><span class="req">必須</span>パスワード（再入力）</p>
                            <input type="password" name="pass_confirm" value="<?php echo $nUser->pass_confirm;?>"
                                placeholder="パスワードを入力">
                            <p class="form-row-anno">※注意書きがここに入ります</p>
                        </div>
                        <div class="form-row">
                            <p class="form-row-text"><span class="req">必須</span>お名前</p>
                            <input type="text" name="name" value="<?php echo $nUser->name;?>" placeholder="お名前を入力" required>
                            <p class="form-row-anno">※注意書きがここに入ります</p>
                        </div>
                        <div class="form-row">
                            <p class="form-row-text"><span class="req">必須</span>電話番号</p>
                            <input type="tel" name="tel" value="<?php echo $nUser->tel;?>" placeholder="電話番号を入力" required>
                            <p class="form-row-anno">※注意書きがここに入ります</p>
                        </div>
                    </div>

                    <div class="form__submit">
                        <div class="btn bd_blu"><input type="button" value="ユーザー情報設定変更へ戻る"
                                onclick="location.href='x10u_user.php'"></div>
                        <div class="btn bg_blu"><input type="submit" value="入力内容を確認する"></div>
                        <input name="doCheck" type="hidden" value="0">
                    </div>

                </form>
            </div>
        </section>

    </main>

    <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>

</html>