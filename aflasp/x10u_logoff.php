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
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-167856896-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-167856896-1');
</script>
<meta charset="UTF-8">
<title>ログオフ完了</title>
<meta name="description" content="アフィリエイト管理画面">
<?php include(__DIR__ . '/x10u/inc/meta.php'); ?>
</head>

<body>

  <?php include(__DIR__ . '/x10u/inc/header.php'); ?>

  <main class="main">

    <div class="mainheader">
      <p class="breadcrumbs">
        <a href="#">トップ</a>
      </p>
    </div>

    <div class="pageheader">
      <div class="pageheader__inner container">
        <h1 class="pageheader_title">ログオフ</h1>
      </div>
    </div>

    <section class="sec-member section">
      <div class="sec__inner container">
        <div class="form__member__basic form__content_block">

          <div class="alert_box_complete">
            <h4 class="alert_box_complete_title"><span class="icon_check_grn"></span>ログオフ致しました。</h4>
            <p class="alert_box_text">下記よりサービストップに戻れます。</p>
          </div>


        <div class="form__submit">
          <div class="btn"><a href="./x10u_index.php" class="bg_blu">トップへ戻る</a></div>
        </div>
      </div>
    </section>

  </main>

  <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>
</html>
