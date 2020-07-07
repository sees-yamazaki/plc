<?php
include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';
include 'x10c/db/nuser.php';
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



if (isset($_POST['doCheck'])) {
    $cnt = countNUserByMail($_POST['mail']);

    if (empty($_POST['mail'])) {
        $err_mail_div = ' is-error';
        $err_mail_msg = '<p class="form-row-error-text">メールアドレスを入力してください。</p>';
    } elseif ($cnt=="0") {
        $err_mail_div = ' is-error';
        $err_mail_msg = '<p class="form-row-error-text">このメールアドレスは登録されていません。</p>';
    } else {
        header('Location: x10u_reminder_confirm.php', true, 307);
    }
}


?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-167856896-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-167856896-1');
</script>
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
        <a href="/">トップ</a>
        <a href="#">パスワードをお忘れの方へ</a>
      </p>
    </div>

    <div class="pageheader">
      <div class="pageheader__inner container">
        <h1 class="pageheader_title">パスワードをお忘れの方へ</h1>
      </div>
    </div>

    <section class="sec-login section">
      <div class="sec__inner container">
        <form action="" class="form__login" method="post" name="frm1">
          <div class="form-row <?php echo $err_mail_div; ?>">
            <p>登録しているメールアドレスに新しいパスワードを送信します。</p>
            <br>
            <?php echo $err_mail_msg; ?>
            <input type="text" name="mail" value="<?php echo $_POST['mail']; ?>" placeholder="メールアドレスを入力">
          </div>
          <br>
          <div class="btn"><a href="javascript:document.frm1.submit()" class="bg_blu">登録を確認する</a></div>
          <input type="hidden" name="doCheck" value="1">
        </form>
      </div>
    </section>


  </main>

  <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>
</html>
