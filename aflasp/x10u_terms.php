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
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-167856896-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-167856896-1');
</script>
<meta charset="UTF-8">
<title>利用規約</title>
<meta name="description" content="アフィリエイト管理画面">
<?php include(__DIR__ . '/x10u/inc/meta.php'); ?>
</head>

<body>

  <?php include(__DIR__ . '/x10u/inc/header.php'); ?>

  <main class="main">

    <div class="mainheader">
      <p class="breadcrumbs">
        <a href="/">トップ</a>
        <a href="./">利用規約</a>
      </p>
    </div>

    <div class="pageheader">
      <div class="pageheader__inner container">
        <h1 class="pageheader_title">利用規約</h1>
      </div>
    </div>

    <section class="sec-terms section">
      <div class="sec__inner container">
        <h3 class="bar-title"><span class="bar-title-text">第１章 総則</span></h3>
        <div class="dl-style">
          <dl>
            <dt>第１条（規約）</dt>
            <dd>本規約は、ForFuture株式会社（以下「当社」といいます。<br>提供するサービス（以下「本サービス」といいます。）の利用に関し、当社と会員の間に適用されます。</dd>
          </dl>
          <dl>
            <dt>第２条（定義）</dt>
            <dd>
              <p>本規約において、次の各号に掲げる用語の意味は、当該各号に定めるとおりとします。</p>
              <br>
              <p>（1）会員<br>本規約に同意の上、当社と本サービスの利用に関する契約（以下「本利用契約」といいます。）を締結した法人、団体、組合または個人をいいます。</p>
            </dd>
          </dl>
        </div>
      </div>
    </section>
  </main>

  <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>
</html>
