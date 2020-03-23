<?php
include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';

// セッション再開
session_start();

//Timezone
date_default_timezone_set('Asia/Tokyo');


?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>運営会社</title>
<meta name="description" content="アフィリエイト管理画面">
<?php include(__DIR__ . '/x10u/inc/meta.php'); ?>
</head>

<body>

  <?php include(__DIR__ . '/x10u/inc/header.php'); ?>

  <main class="main">

    <div class="mainheader">
      <p class="breadcrumbs">
        <a href="/">トップ</a>
        <a href="./">運営会社</a>
      </p>
    </div>

    <div class="pageheader">
      <div class="pageheader__inner container">
        <h1 class="pageheader_title">運営会社</h1>
      </div>
    </div>

    <section class="sec-company section">
      <div class="sec__inner container">
        <h3 class="bar-title"><span class="bar-title-text">会社情報</span></h3>
        <div class="dl-style">
          <dl>
            <dt>商号</dt>
            <dd>ForFuture株式会社</dd>
          </dl>
          <dl>
            <dt>設立</dt>
            <dd>2020年2月27日</dd>
          </dl>
          <dl>
            <dt>代表取締役</dt>
            <dd>瀧本 英恵</dd>
          </dl>
          <dl>
            <dt>所在地</dt>
            <dd>106-0032<br>東京都港区六本木4</dd>
          </dl>
        </div>
      </div>
    </section>
  </main>

  <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>
</html>
