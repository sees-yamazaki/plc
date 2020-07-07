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
<title>新規会員登録（会員情報完了）</title>
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

    <section class="section">
      <div class="sec__inner container">

        <div class="form__complete_text text-center">
          <p>初期化が完了しました。<br>入力されたメールアドレスに初期化したパスワードを送信しました。</p>
        </div>

        <div class="form__submit">
          <div class="btn"><a href="/" class="bg_blu">トップへ</a></div>
        </div>

      </div>
    </section>

  </main>

  <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>
</html>
