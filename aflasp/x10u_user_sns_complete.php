<?php
include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';
include 'x10c/db/adwares.php';
include 'x10c/db/x10.php';
include 'x10c/db/nuser.php';
include 'x10c/db/system.php';

// セッション再開
session_start();

//Timezone
date_default_timezone_set('Asia/Tokyo');

// エラーメッセージの初期化
$errorMessage = '';

$LOGIN_ID = $_SESSION[ $SESSION_NAME ];
if(empty($LOGIN_ID)){ header('Location: x10u_logoff.php'); }


$nUserX = getNuserX10($LOGIN_ID);


?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>SNSアカウントを編集する【完了】</title>
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
        <a href="#">SNSアカウントを編集する【完了】</a>
      </p>
    </div>

    <div class="pageheader">
      <div class="pageheader__inner container">
        <h1 class="pageheader_title">SNSアカウントを編集する【完了】</h1>
      </div>
    </div>

    <section class="sec-user section">
      <div class="sec__inner container">
        <form action="./user_basic_complete.html" method="post" class="form__basic_user">
          <div class="form__member__basic form__content_block">

            <div class="alert_box_complete">
              <h4 class="alert_box_complete_title"><span class="icon_check_grn"></span>変更が完了しました。</h4>
              <p class="alert_box_text">下記より編集項目が変更されている事をご確認ください。</p>
            </div>

            <h3 class="bar-title"><span class="bar-title-text">基本情報</span></h3>

            <div class="dl-style">
              <dl>
                <dt>Instagramアカウント名</dt>
                <dd><?php echo empty($nUserX->instagram) ? '設定なし' :  $nUserX->instagram; ?></dd>
              </dl>
              <dl>
                <dt>Twitterアカウント名</dt>
                <dd><?php echo empty($nUserX->twitter) ? '設定なし' :  $nUserX->twitter; ?></dd>
              </dl>
              <dl>
                <dt>Facebookアカウント名</dt>
                <dd><?php echo empty($nUserX->facebook) ? '設定なし' :  $nUserX->facebook; ?></dd>
              </dl>
              <dl>
                <dt>Youtubeアカウント名</dt>
                <dd><?php echo empty($nUserX->youtube) ? '設定なし' :  $nUserX->youtube; ?></dd>
              </dl>
            </div>
          </div>

          <div class="form__submit">
            <div class="btn"><a href="./x10u_user.php" class="bg_blu">ユーザー情報設定トップへ</a></div>
          </div>

        </form>
      </div>
    </section>

  </main>

  <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>
</html>
