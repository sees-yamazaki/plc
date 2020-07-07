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
        <a href="./x10u_index.php">トップ</a>
        <a href="#">新規会員登録（会員情報完了）</a>
      </p>
    </div>

    <div class="pageheader">
      <div class="pageheader__inner container">
        <h1 class="pageheader_title">新規会員登録（会員情報完了）</h1>
      </div>
    </div>

    <div class="form__nav">
      <div class="form__nav_inner container">
        <div class="form__nav_list flex">
          <div class="form__nav_step is-complete">
            <span class="num">1</span>
            <p>会員情報<br class="sp">入力</p>
          </div>
          <div class="form__nav_step is-complete">
            <span class="num">2</span>
            <p>内容確認</p>
          </div>
          <div class="form__nav_step is-current">
            <span class="num">3</span>
            <p>完了</p>
          </div>
        </div>
      </div>
    </div>

    <section class="sec-member section">
      <div class="sec__inner container">

        <div class="form__complete_text text-center">
          <p>会員登録が完了しました。<br>登録されたメールアドレスに認証URLを送信しましたのでクリックして認証後、ログイン可能です。</p>
        </div>

        <div class="form__submit">
          <div class="btn"><a href="./x10u_index.php" class="bg_blu">トップへ</a></div>
        </div>

      </div>
    </section>

  </main>

  <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>
</html>
