<?php
include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';

// セッション再開
session_start();

//Timezone
date_default_timezone_set('Asia/Tokyo');

// エラーメッセージの初期化
$errorMessage = '';

$_SESSION[ $SESSION_NAME ] = '';

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>トップ</title>
<meta name="description" content="アフィリエイト管理画面">
<?php include(__DIR__ . '/x10u/inc/meta.php'); ?>
<link rel="stylesheet" href="./x10u/assets/css/index.css">
</head>

<body>

  <?php include(__DIR__ . '/x10u/inc/header.php'); ?>

  <main class="main">
    <section class="sec-mv">
      <div class="mv__inner container flex-center">
        <div class="mv__contents">
          <div class="mv__catch_wrap">
            <h2 class="mv__logo"><img src="./x10u/assets/img/mv_logo.png" alt=""></h2>
            <div class="mv__catch">
              <p class="mv__catch_text1">好きなコトを</p>
              <p class="mv__catch_text2">好きな<span class="f-grn">ジカン</span>に</p>
            </div>
          </div>
          <div class="btn mv__btn_member"><a href="./x10u_member.php" class="bg_grad_pnk">無料で会員登録</a></div>
        </div>
      </div>
    </section>
  </main>

  <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>
</html>
