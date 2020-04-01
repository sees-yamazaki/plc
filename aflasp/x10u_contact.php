<?php
include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';
include 'x10c/db/nuser.php';

// セッション再開
session_start();

//Timezone
date_default_timezone_set('Asia/Tokyo');

if (isset($_POST['doCheck'])) {
    $isErr ='';


    if (empty($_POST['faq'])) {
        $err_faq_div = ' is-error';
        $err_faq_msg = '<p class="form-row-error-text">お問い合わせ項目を選択してください。</p>';
        $isErr ='e';
    }

    if (empty($_POST['mail']) || empty($_POST['mail_confirm'])) {
        $err_mail_div = ' is-error';
        $err_mail_msg = '<p class="form-row-error-text">メールアドレスとメールアドレス（再入力）を入力してください。</p>';
        $isErr ='e';
    } elseif ($_POST['mail'] <> $_POST['mail_confirm']) {
        $err_mail_div = ' is-error';
        $err_mail_msg = '<p class="form-row-error-text">メールアドレスが一致しません。</p>';
        $isErr ='e';
    } elseif (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\+\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['mail'])) {
        $err_mail_div = ' is-error';
        $err_mail_msg = '<p class="form-row-error-text">メールアドレスが正しい形式ではありません。</p>';
        $isErr ='e';
    }


    if (empty($_POST['txt'])) {
        $err_txt_div = ' is-error';
        $err_txt_msg = '<p class="form-row-error-text">お問い合わせ内容を入力してください。</p>';
        $isErr ='e';
    }

    if (empty($isErr)) {
        header('Location: x10u_contact_confirm.php', true, 307);
    }

    $mail = $_POST['mail'];
    $mail_confirm = $_POST['mail_confirm'];
}elseif (isset($_POST['4back'])) {
  $mail = $_POST['mail'];
  $mail_confirm = $_POST['mail_confirm'];
}else{
  $LOGIN_ID = $_SESSION[ $SESSION_NAME ];
  if(!empty($LOGIN_ID)){
     $nUser = getNuser($LOGIN_ID);
     $mail = $nUser->mail;
     $mail_confirm = $nUser->mail;

  }
}

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
        <form action="" method="post" class="form__basic_user">
          <div class="form__user__basic form__content_block">
            <h3 class="bar-title"><span class="bar-title-text">お問い合わせ内容入力</span></h3>
            <div class="form-row <?php echo $err_faw_div; ?>">
              <p class="form-row-text"><span class="req">必須</span>お問い合わせ項目</p>
              <?php echo $err_faq_msg; ?>
              <?php
              if ($_POST['faq']=="スマフィーについて") {
                  $faq1=" selected";
              } elseif ($_POST['faq']=="スマフィーへのオファー（広告）出稿について") {
                  $faq2=" selected";
              } elseif ($_POST['faq']=="その他のお問い合せ") {
                  $faq3=" selected";
              }
               ?>
              <select name="faq">
                <option value="" selected>選択して下さい</option>
                <option value="スマフィーについて" <?php echo $faq1; ?>>スマフィーについて</option>
                <option value="スマフィーへのオファー（広告）出稿について" <?php echo $faq2; ?>>スマフィーへのオファー（広告）出稿について</option>
                <option value="その他のお問い合せ" <?php echo $faq3; ?>>その他のお問い合せ</option>
              </select>
            </div>
            <div class="form-row <?php echo $err_mail_div; ?>">
              <p class="form-row-text"><span class="req">必須</span>メールアドレス</p>
              <?php echo $err_mail_msg; ?>
              <input type="text" name="mail"
            value="<?php echo $mail;?>" placeholder="メールアドレスを入力">
              <p class="form-row-anno">※注意書きがここに入ります</p>
            </div>
            <div class="form-row <?php echo $err_mail_div; ?>">
              <p class="form-row-text"><span class="req">必須</span>メールアドレス（再入力）</p>
              <input type="text" name="mail_confirm"
            value="<?php echo $mail_confirm;?>" placeholder="メールアドレスを入力">
              <p class="form-row-anno">※注意書きがここに入ります</p>
            </div>
            <div class="form-row <?php echo $err_txt_div; ?>">
              <p class="form-row-text"><span class="req">必須</span>ご記入欄</p>
              <?php echo $err_txt_msg; ?>
              <textarea name="txt" placeholder="お問い合せ内容を入力"><?php echo $_POST['txt'];?></textarea>
            </div>
          </div>

          <div class="form__submit">
            <div class="btn bg_blu"><input type="submit" value="入力内容を確認する"></div>
            <input name="doCheck" type="hidden" value="1">
          </div>

        </form>
      </div>
    </section>

  </main>

  <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>
</html>
