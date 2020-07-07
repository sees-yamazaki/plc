<?php
include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';
include 'x10c/db/adwares.php';
include 'x10c/db/x10.php';
include 'x10c/db/nuser.php';
include 'x10c/db/system.php';

session_start();

$LOGIN_ID = $_SESSION[ $SESSION_NAME ];
if (empty($LOGIN_ID)) {
    $html = '<div class="btn"><a href="./x10u_index.php" class="bg_blu">トップへ</a></div>';
} else {
    $html = '<div class="btn"><a href="./x10u_mypage.php" class="bg_blu">トップへ</a></div>';
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
<title>お問い合わせ</title>
<?php include(__DIR__ . '/x10u/inc/meta.php'); ?>
<link rel="stylesheet" href="./x10u/assets/css/member.css">
</head>

<body>

  <?php include(__DIR__ . '/x10u/inc/header.php'); ?>

  <main class="main">

    <div class="mainheader">
      <p class="breadcrumbs">
        <a href="#">トップ</a>
        <a href="#">お問い合わせ</a>
      </p>
    </div>

    <div class="pageheader">
      <div class="pageheader__inner container">
        <h1 class="pageheader_title">お問い合わせ</h1>
      </div>
    </div>

    <section class="sec-member section">
      <div class="sec__inner container">

        <div class="form__complete_text text-center">
          <p>お問い合わせを送信しました。</p>
        </div>

        <div class="form__submit">
            <?php echo $html; ?>
        </div>

      </div>
    </section>

  </main>

  <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>
</html>
