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
    header('Location: x10u_logoff.php');
}

$errorMessage='';



if (isset($_POST['doCheck'])) {
} elseif (isset($_POST['doEdit'])) {
    $tmpNUser = getNuser($LOGIN_ID);


    $nUser = new cls_nuser();
    $nUser->id = $LOGIN_ID;
    // $nUser->mail = $_POST['mail'];
    // $nUser->mail_confirm = $_POST['mail_confirm'];
    $nUser->mail = $tmpNUser->mail;
    $nUser->mail_confirm = $tmpNUser->mail;
    $nUser->pass = $_POST['pass'];
    $nUser->pass_confirm = $_POST['pass_confirm'];
    $nUser->name = $_POST['name'];
    $nUser->zip1 =substr($_POST['zip'], 0, 3);
    $nUser->zip2 = substr($_POST['zip'], 3);
    if (empty($_POST['pref'])) {
        $nUser->adds = '';
    } else {
        $nUser->adds = getPrefectureByName($_POST['pref']);
    }
    $nUser->add_sub = $_POST['addr'];
    $nUser->tel = $_POST['tel'];

    if ($nUser->pass=="nochange") {
        $nUser->pass = '';
    } else {
        $pw1 = preg_replace('/^\w+:/', '', $nUser->pass);
        $pw2 = openssl_encrypt($pw1, 'aes-256-ecb', base64_encode('AES'));
        $nUser->pass = 'AES_OK:'.$pw2;
    }

    updateNuserBasic($nUser);
    updateNuserX10Kubun($nUser->id, $_POST['kubun'], $_POST['kana'], $_POST['birthday-y'].'/'.$_POST['birthday-m'].'/'.$_POST['birthday-d']);

    //メールアドレスが変更されている場合は拡張テーブルに格納する
    if ($_POST['mail']<>$tmpNUser->mail) {
        $x10mail = new cls_x10mail();
        $x10mail->nuser = $LOGIN_ID;
        $x10mail->mail = $_POST['mail'];
        $x10mail->limittime = strtotime("+24 hours");
        $mailId = insertX10Mail($x10mail);


        $sys = getSystem();

        mb_language("Japanese");
        mb_internal_encoding("UTF-8");

        $text = "\n\nメールアドレスを認証するために、下記URLをクリックしてください。\n\n";
        if (substr($sys->home, -1)=='/') {
            $sys->home = substr($sys->home, 0, -1);
        }
        $md5 = md5($_POST['mail']);
        $text .= $sys->home."/x10u_activation_mail.php?id=".$mailId."z".$md5;
        $text .= "\n\n認証期限：".date('Y-m-d H:i:s', $x10mail->limittime)."　まで\n";
        $text .= "\n\n".$sys->site_title."\n\n".$sys->home;

        $to      = $_POST['mail'];
        $subject = "【".$sys->site_title."】メールアドレスが変更されました。";
        $message = $text;

        $headers = 'From:"'.mb_encode_mimeheader($sys->mail_name).'" <'. trim($sys->mail_address).'>';
        mb_send_mail($to, $subject, $message, $headers);
    }

    header('Location: x10u_user_basic_complete.php', true, 307);
} elseif (isset($_POST['4back'])) {
    header('Location: x10u_user_basic_edit.php', true, 307);
}

$crntNUser = getNuser($LOGIN_ID);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>基本情報を編集する【確認】</title>
<meta name="description" content="アフィリエイト管理画面">
<?php include(__DIR__ . '/x10u/inc/meta.php'); ?>
</head>

<body>

  <?php include(__DIR__ . '/x10u/inc/header.php'); ?>

  <main class="main">

    <div class="mainheader">
      <p class="breadcrumbs">
        <a href="#">トップ</a>
        <a href="#">ユーザー情報設定変更</a>
        <a href="#">基本情報を編集する【確認】</a>
      </p>
    </div>

    <div class="pageheader">
      <div class="pageheader__inner container">
        <h1 class="pageheader_title">基本情報を編集する【確認】</h1>
      </div>
    </div>

    <section class="sec-member section">
      <div class="sec__inner container">

        <?php if ($crntNUser->mail<> $_POST['mail']) { ?>
            <div class="alert_box">
            <h4 class="alert_box_title"><span class="icon_chuui_pnk"></span>メールアドレスが変更されています</h4>
            <p class="alert_box_text">新しいアドレスは確定するボタンを押した後に送られる認証メール内のURLをクリックすると変更が完了致します。</p>
            </div>
          <?php } ?>    

        <form action="" method="post" name="mem_conf" class="form__basic_user">
          <div class="form__member__basic form__content_block">

            <h3 class="bar-title"><span class="bar-title-text">基本情報</span></h3>
            <div class="dl-style">
              <dl>
                <dt>メールアドレス</dt>
                <dd><?php echo $_POST['mail']; ?></dd>
              </dl>
              <dl>
                <dt>パスワード</dt>
                <dd>xxxxxxxxxx</dd>
              </dl>
              <dl>
                <dt>区分</dt>
                <?php
                if ($_POST['kubun']=="1") {
                    $kubun = "法人";
                } else {
                    $kubun = "個人または個人事業主";
                }
                ?>
                <dd><?php echo $kubun; ?></dd>
              </dl>
              <dl>
                <dt>お名前</dt>
                <dd><?php echo $_POST['name']; ?></dd>
              </dl>
              <dl>
                <dt>フリガナ</dt>
                <dd><?php echo $_POST['kana']; ?></dd>
              </dl>
              <dl>
                <dt>住所</dt>
                <dd><?php echo $_POST['zip']; ?>　<?php echo $_POST['pref']; ?><?php echo $_POST['addr']; ?></dd>
              </dl>
              <dl>
                <dt>生年月日</dt>
                <dd><?php echo $_POST['birthday-y'].'/'.$_POST['birthday-m'].'/'.$_POST['birthday-d']; ?></dd>
              </dl>
              <dl>
                <dt>電話番号</dt>
                <dd><?php echo $_POST['tel']; ?></dd>
              </dl>
            </div>
          </div>

          <div class="form__submit">
            <div class="btn bd_blu"><input type="button" name="doBack"  value="修正する" onclick="document.mem_conf.submit();"></div>
            <div class="btn bg_blu"><input type="submit" name="doEdit"  value="確定する"></div>
            <input type="hidden" name="4back" value="1">
            <input type="hidden" name="newmail" value="<?php echo $_POST['mail']; ?>">
            <input type="hidden" name="mail" value="<?php echo $_POST['mail']; ?>">
            <input type="hidden" name="mail_confirm" value="<?php echo $_POST['mail_confirm']; ?>">
            <input type="hidden" name="pass" value="<?php echo $_POST['pass']; ?>">
            <input type="hidden" name="pass_confirm" value="<?php echo $_POST['pass_confirm']; ?>">
            <input type="hidden" name="kubun" value="<?php echo $_POST['kubun']; ?>">
            <input type="hidden" name="name" value="<?php echo $_POST['name']; ?>">
            <input type="hidden" name="kana" value="<?php echo $_POST['kana']; ?>">
            <input type="hidden" name="birthday-y" value="<?php echo $_POST['birthday-y']; ?>">
            <input type="hidden" name="birthday-m" value="<?php echo $_POST['birthday-m']; ?>">
            <input type="hidden" name="birthday-d" value="<?php echo $_POST['birthday-d']; ?>">
            <input type="hidden" name="pref" value="<?php echo $_POST['pref']; ?>">
            <input type="hidden" name="zip" value="<?php echo $_POST['zip']; ?>">
            <input type="hidden" name="addr" value="<?php echo $_POST['addr']; ?>">
            <input type="hidden" name="tel" value="<?php echo $_POST['tel']; ?>">
          </div>

        </form>
      </div>
    </section>

  </main>

  <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>
</html>
