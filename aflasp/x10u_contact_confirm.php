<?php
include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';
include 'x10c/db/adwares.php';
include 'x10c/db/x10.php';
include 'x10c/db/nuser.php';
include 'x10c/db/system.php';

session_start();

// $LOGIN_ID = $_SESSION[ $SESSION_NAME ];
// if(empty($LOGIN_ID)){ header('Location: x10n_logoff.php'); }

$errorMessage='';


if (isset($_POST['doSend'])) {

        $sys = getSystem();

        mb_language("Japanese");
        mb_internal_encoding("UTF-8");

        $text = "\n\n";
        $text .= "【お問い合わせ項目】\n".$_POST['faq']."\n\n";
        $text .= "【メールアドレス】\n".$_POST['mail']."\n\n";
        $text .= "【お問い合わせ内容】\n".$_POST['txt']."\n\n";

        $to      = trim($sys->mail_address);
        $subject = "【".$sys->site_title."】お問い合わせ";
        $message = $text;
        $headers = 'From:"'.mb_encode_mimeheader($sys->mail_name).'" <'. trim($sys->mail_address).'>';
        mb_send_mail($to, $subject, $message, $headers);
        

        header('Location: x10u_contact_complete.php');
    
} elseif (isset($_POST['4back'])) {
    header('Location: x10u_contact.php', true, 307);
}



?>
<!DOCTYPE html>
<html lang="ja">
<head>
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
        <form action="" method="post" name="mem_conf" class="form__confirm">
          <div class="form__member__basic form__content_block">
            <div class="dl-style">
              <dl>
                <dt>お問い合わせ項目</dt>
                <dd><?php echo $_POST['faq']; ?></dd>
              </dl>
              <dl>
                <dt>メールアドレス</dt>
                <dd><?php echo $_POST['mail']; ?></dd>
              </dl>
              <dl>
                <dt>お問い合わせ内容</dt>
                <dd><?php echo nl2br($_POST['txt']); ?></dd>
              </dl>
            </div>
          </div>


          <div class="form__submit">
            <div class="btn bd_blu"><input type="button" name="doBack"  value="修正する" onclick="document.mem_conf.submit();"></div>
            <div class="btn bg_blu"><input type="submit" name="doSend"  value="確定する"></div>
            <input type="hidden" name="4back" value="1">
            <input type="hidden" name="mail" value="<?php echo $_POST['mail']; ?>">
            <input type="hidden" name="mail_confirm" value="<?php echo $_POST['mail_confirm']; ?>">
            <input type="hidden" name="faq" value="<?php echo $_POST['faq']; ?>">
            <input type="hidden" name="txt" value="<?php echo $_POST['txt']; ?>">
          </div>

        </form>
      </div>
    </section>

  </main>

  <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>
</html>
