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
<title>お問い合わせ</title>
<meta name="description" content="アフィリエイト管理画面">
<?php include(__DIR__ . '/x10u/inc/meta.php'); ?>
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

    <section class="sec-user section">
      <div class="sec__inner container">
        <p>該当するお問い合せ項目をご選択いただき、お問い合せ内容をご入力下さい</p>
        <br>
        <form action="./x10n_nuser_b_edite.php" method="post" class="form__basic_user">
          <div class="form__user__basic form__content_block">
            <h3 class="bar-title"><span class="bar-title-text">お問い合わせ内容入力</span></h3>
            <div class="form-row">
              <p class="form-row-text"><span class="req">必須</span>お問い合わせ項目</p>
              <select name="pref">
                <option value="" selected>選択して下さい</option>
                <option value="スマフィーについて">スマフィーについて</option>
                <option value="スマフィーへのオファー（広告）出稿について">スマフィーへのオファー（広告）出稿について</option>
                <option value="その他のお問い合せ">その他のお問い合せ</option>
              </select>
            </div>
            <div class="form-row">
              <p class="form-row-text"><span class="req">必須</span>メールアドレス</p>
              <input type="text" placeholder="メールアドレスを入力">
              <p class="form-row-anno">※注意書きがここに入ります</p>
            </div>
            <div class="form-row">
              <p class="form-row-text"><span class="req">必須</span>メールアドレス（再入力）</p>
              <input type="text" placeholder="メールアドレスを入力">
              <p class="form-row-anno">※注意書きがここに入ります</p>
            </div>
            <div class="form-row">
              <p class="form-row-text"><span class="req">必須</span>ご記入欄</p>
              <input type="textarea" placeholder="お問い合せ内容を入力">
            </div>
          </div>

          <div class="form__submit">
            <div class="btn bg_blu"><input type="submit" value="入力内容を確認する"></div>
          </div>

        </form>
      </div>
    </section>

  </main>

  <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>
</html>
