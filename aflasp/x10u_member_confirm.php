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



if (isset($_POST['doCheck'])) {
} elseif (isset($_POST['doEdit'])) {
    $nUser = new cls_nuser();
    $nUser->mail = $_POST['mail'];
    $nUser->mail_confirm = $_POST['mail_confirm'];
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
    $nUser->fax = '';
    $nUser->url = '';
    $nUser->bank = $_POST['bank'];
    $nUser->bank_code = '';
    $nUser->branch = $_POST['branch'];
    $nUser->branch_code = '';
    $nUser->bank_type = $_POST['bank-type'];
    $nUser->number = $_POST['number'];
    $nUser->bank_name = $_POST['bank_name'];

    if (countNUserByMail($nUser->mail)>0) {
        $errorMessage='このメールアドレスは使用されています。';
    } else {
        $pw1 = preg_replace('/^\w+:/', '', $nUser->pass);
        $pw2 = openssl_encrypt($pw1, 'aes-256-ecb', base64_encode('AES'));
        $nUser->pass = $pw2;

        $nId = insertNuser($nUser);

        $nUserX = new cls_nuser_x10();
        $nUserX->id =  $nId;
        $nUserX->nickname = "";
        $nUserX->instagram = $_POST['instagram'];
        $nUserX->facebook = $_POST['facebook'];
        $nUserX->twitter = $_POST['twitter'];
        $nUserX->youtube = $_POST['youtube'];
        $nUserX->kubun = $_POST['kubun'];
        $nUserX->kana = $_POST['kana'];
        $nUserX->birthday = $_POST['birthday-y'].'/'.$_POST['birthday-m'].'/'.$_POST['birthday-d'];

        insertNuserX10($nUserX);


        $sys = getSystem();

        mb_language("Japanese");
        mb_internal_encoding("UTF-8");

        $text = "\n\nメールアドレスを認証するために、下記URLをクリックしてください。\n\n";
        if (substr($sys->home, -1)=='/') {
            $sys->home = substr($sys->home, 0, -1);
        }
        $md5 = md5($nId . $nUser->mail);
        $text .= $sys->home."/x10u_activation.php?type=nUser&id=".$nId."&md5=".$md5;
        $text .= "\n\n".$sys->site_title."\n\n".$sys->home;

        $to      = $nUser->mail;
        $subject = "【".$sys->site_title."】メールアドレスの認証が完了しました。";
        $message = $text;
        $headers = 'From:"'.mb_encode_mimeheader($sys->mail_name).'" <'. trim($sys->mail_address).'>';
        mb_send_mail($to, $subject, $message, $headers);
        

        header('Location: x10u_member_complete.php');
    }
} elseif (isset($_POST['4back'])) {
    header('Location: x10u_member.php', true, 307);
}


$instagram = str_replace('/', '', str_replace('https://www.instagram.com/', '', $_POST['instagram']));
$facebook = str_replace('/', '', str_replace('https://www.facebook.com/', '', $_POST['facebook']));
$twitter = str_replace('/', '', str_replace('https://twitter.com/', '', $_POST['twitter']));
$youtube = str_replace('/', '', str_replace('https://www.youtube.com/channel/', '', $_POST['youtube']));



?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>新規会員登録（会員情報確認）</title>
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
        <a href="#">新規会員登録（会員情報確認）</a>
      </p>
    </div>

    <div class="pageheader">
      <div class="pageheader__inner container">
        <h1 class="pageheader_title">新規会員登録（会員情報確認）</h1>
      </div>
    </div>

    <div class="form__nav">
      <div class="form__nav_inner container">
        <div class="form__nav_list flex">
          <div class="form__nav_step is-complete">
            <span class="num">1</span>
            <p>会員情報<br class="sp">入力</p>
          </div>
          <div class="form__nav_step is-current">
            <span class="num">2</span>
            <p>内容確認</p>
          </div>
          <div class="form__nav_step">
            <span class="num">3</span>
            <p>完了</p>
          </div>
        </div>
        <p class="form__nav_text">入力内容を確認いただき、「確定する」ボタンを押して下さい。</p>
      </div>
    </div>

    <section class="sec-member section">
      <div class="sec__inner container">
        <form action="" method="post" name="mem_conf" class="form__confirm">
          <div class="form__member__basic form__content_block">
            <div class="dl-style">
              <dl>
                <dt>メールアドレス</dt>
                <dd><?php echo $_POST['mail']; ?></dd>
              </dl>
              <dl>
                <dt>パスワード</dt>
                <dd><?php echo $_POST['pass']; ?></dd>
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
                <dt>電話番号</dt>
                <dd><?php echo $_POST['tel']; ?></dd>
              </dl>
              <dl>
                <dt>生年月日</dt>
                <dd><?php echo $_POST['birthday-y'].'/'.$_POST['birthday-m'].'/'.$_POST['birthday-d']; ?></dd>
              </dl>
            </div>
          </div>

          <div class="form__member__sns form__content_block">
            <h3 class="bar-title"><span class="bar-title-text">SNSアカウント設定</span></h3>
            <div class="dl-style">
              <dl>
                <dt>Instagramアカウント名</dt>
                <dd><?php echo empty($instagram) ? '未設定' :  $instagram; ?></dd>
              </dl>
              <dl>
                <dt>Twitterアカウント名</dt>
                <dd><?php echo empty($twitter) ? '未設定' :  $twitter; ?></dd>
              </dl>
              <dl>
                <dt>Facebookアカウント名</dt>
                <dd><?php echo empty($facebook) ? '未設定' :  $facebook; ?></dd>
              </dl>
              <dl>
                <dt>Youtubeアカウント名</dt>
                <dd><?php echo empty($youtube) ? '未設定' :  $youtube; ?></dd>
              </dl>
            </div>
          </div>

          <div class="form__member__bank form__content_block">
            <h3 class="bar-title"><span class="bar-title-text">報酬支払い口座設定</span></h3>
            <div class="dl-style">
              <dl>
                <dt>金融機関名</dt>
                <dd><?php echo empty($_POST['bank']) ? '未設定' :  $_POST['bank']; ?></dd>
              </dl>
              <dl>
                <dt>支店名</dt>
                <dd><?php echo empty($_POST['branch']) ? '未設定' :  $_POST['branch']; ?></dd>
              </dl>
              <dl>
                <dt>種別</dt>
                <?php
                if ($_POST['bank-type']=="4") {
                    $bankType = "貯蓄";
                } elseif ($_POST['bank-type']=="2") {
                    $bankType = "当座";
                } elseif ($_POST['bank-type']=="1") {
                    $bankType = "普通";
                } else {
                    $bankType = "未設定";
                }
                ?>
                <dd><?php echo $bankType; ?></dd>
              </dl>
              <dl>
                <dt>口座番号</dt>
                <dd><?php echo empty($_POST['number']) ? '未設定' :  $_POST['number']; ?></dd>
              </dl>
              <dl>
                <dt>口座名義（カナ）</dt>
                <dd><?php echo empty($_POST['bank_name']) ? '未設定' :  $_POST['bank_name']; ?></dd>
              </dl>
            </div>
          </div>


          <div class="form__submit">
            <div class="btn bd_blu"><input type="button" name="doBack"  value="修正する" onclick="document.mem_conf.submit();"></div>
            <div class="btn bg_blu"><input type="submit" name="doEdit"  value="確定する"></div>
            <input type="hidden" name="4back" value="1">
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
            <input type="hidden" name="bank" value="<?php echo $_POST['bank']; ?>">
            <input type="hidden" name="branch" value="<?php echo $_POST['branch']; ?>">
            <input type="hidden" name="bank-type" value="<?php echo $_POST['bank-type']; ?>">
            <input type="hidden" name="number" value="<?php echo $_POST['number']; ?>">
            <input type="hidden" name="bank_name" value="<?php echo $_POST['bank_name']; ?>">
            <input type="hidden" name="instagram" value="<?php echo $instagram; ?>">
            <input type="hidden" name="facebook" value="<?php echo $facebook; ?>">
            <input type="hidden" name="twitter" value="<?php echo $twitter; ?>">
            <input type="hidden" name="youtube" value="<?php echo $youtube; ?>">
          </div>

        </form>
      </div>
    </section>

  </main>

  <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>
</html>
