<?php
include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';
include 'x10c/db/nuser.php';
include 'x10c/db/system.php';
include 'x10c/db/x10.php';

// セッション再開
session_start();

//Timezone
date_default_timezone_set('Asia/Tokyo');

// エラーメッセージの初期化
$errorMessage = '';

// $LOGIN_ID = $_SESSION[ $SESSION_NAME ];
// if (empty($LOGIN_ID)) {
//     header('Location: x10u_logoff.php');
// }



if(isset($_POST['doRePW'])){

    $nUser = getNuserByMail($_POST['mail']);

    $newPw=strtotime("now");
    $pw1 = preg_replace('/^\w+:/', '', $newPw);
    $pw2 = openssl_encrypt($pw1, 'aes-256-ecb', base64_encode('AES'));
    $nUser->pass = 'AES_OK:'.$pw2;

    updateNuserBasic($nUser);



    $sys = getSystem();

    mb_language("Japanese");
    mb_internal_encoding("UTF-8");

    $text = "\n\n新しいパスワードは以下となります。\n\n\n\n";
    $text .= $newPw;
    $text .= "\n\n\n\nログイン後にパスワードの再設定を行ってください。";

    $to      = $nUser->mail;
    $subject = "【".$sys->site_title."】パスワードを初期化しました。";
    $message = $text;
    $headers = 'From:"'.mb_encode_mimeheader($sys->mail_name).'" <'. trim($sys->mail_address).'>';
    mb_send_mail($to, $subject, $message, $headers);
    

    header('Location: x10u_reminder_complete.php');

} elseif (isset($_POST['4back'])) {
    header('Location: x10u_reminder.php', true, 307);
}


?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>パスワードをお忘れの方へ</title>
<meta name="description" content="アフィリエイト管理画面">
<?php include(__DIR__ . '/x10u/inc/meta.php'); ?>
<link rel="stylesheet" href="./x10u/assets/css/member.css">
</head>

<body>

  <?php include(__DIR__ . '/x10u/inc/header.php'); ?>

  <main class="main">

    <div class="mainheader">
      <p class="breadcrumbs">
        <a href="x10u_index.php">トップ</a>
        <a href="#">パスワードをお忘れの方へ</a>
      </p>
    </div>

    <div class="pageheader">
      <div class="pageheader__inner container">
        <h1 class="pageheader_title">パスワードをお忘れの方へ</h1>
      </div>
    </div>

    <section class="sec-login section">
    <form action="" method="post" name="mem_conf" class="form__confirm">
      <div class="sec__inner container">
        　<p>初期化したパスワードをメールアドレスに送信します。</p>
        <?php echo $_POST['mail']; ?>
          </div>
      </div>
      <div class="form__submit">
            <div class="btn bd_blu"><input type="button" name="doBack"  value="修正する" onclick="document.mem_conf.submit();"></div>
            <div class="btn bg_blu"><input type="submit" name="doRePW"  value="確定する"></div>
            <input type="hidden" name="4back" value="1">
            <input type="hidden" name="mail" value="<?php echo $_POST['mail']; ?>">
        </div>
    </form>
    </section>


  </main>

  <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>
</html>
