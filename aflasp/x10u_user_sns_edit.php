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


if (isset($_POST['doCheck'])) {
  $isErr ='';
  //   if (empty($_POST['instagram'])) {
  //       $err_instagram_div = ' is-error';
  //       $err_instagram_msg = '<p class="form-row-error-text">入力してください。</p>';
  //       $isErr ='e';
  //   }elseif (empty($_POST['twitter'])) {
  //     $err_twitter_div = ' is-error';
  //     $err_twitter_msg = '<p class="form-row-error-text">入力してください。</p>';
  //     $isErr ='e';
  //   }elseif (empty($_POST['facebook'])) {
  //     $err_facebook_div = ' is-error';
  //     $err_facebook_msg = '<p class="form-row-error-text">入力してください。</p>';
  //     $isErr ='e';
  //   }elseif (empty($_POST['youtube'])) {
  //     $err_youtube_div = ' is-error';
  //     $err_youtube_msg = '<p class="form-row-error-text">入力してください。</p>';
  //     $isErr ='e';
  // } 

    if (empty($isErr)) {
      header('Location: x10u_user_sns_confirm.php', true, 307);
  }
}elseif(isset($_POST['4back'])){
    $nUserX->instagram = $_POST['instagram'];
    $nUserX->twitter = $_POST['twitter'];
    $nUserX->facebook = $_POST['facebook'];
    $nUserX->youtube = $_POST['youtube'];
}else{
    $nUserX = getNuserX10($LOGIN_ID);
}


?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>SNSアカウントを編集する</title>
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
        <a href="#">SNSアカウントを編集する</a>
      </p>
    </div>

    <div class="pageheader">
      <div class="pageheader__inner container">
        <h1 class="pageheader_title">SNSアカウントを編集する</h1>
      </div>
    </div>

    <section class="sec-user section">
      <div class="sec__inner container">
        <form action="" method="post" class="form__sns_user">
          <div class="form__user__sns form__content_block">
            <h3 class="bar-title"><span class="bar-title-text">SNSアカウント設定</span></h3>
            <div class="form-row <?php echo $err_instagram_div; ?>">
              <p class="form-row-text"><span class="op">任意</span>Instagramアカウント名</p>
              <?php echo $err_instagram_msg; ?>
              <div class="icon-sns-wrap">
                <span class="icon-sns icon-sns-insta"></span><input type="text" name="instagram" value="<?php echo $nUserX->instagram; ?>" placeholder="アカウント名を入力" class="input-sns">
              </div>
              <p class="form-row-anno">※注意書きがここに入ります</p>
            </div>
            <div class="form-row <?php echo $err_twitter_div; ?>">
              <p class="form-row-text"><span class="op">任意</span>Twitterアカウント名</p>
              <?php echo $err_twitter_msg; ?>
              <div class="icon-sns-wrap">
                <span class="icon-sns icon-sns-tw"></span><input type="text" name="twitter" value="<?php echo $nUserX->twitter; ?>" placeholder="アカウント名を入力" class="input-sns">
              </div>
              <p class="form-row-anno">※注意書きがここに入ります</p>
            </div>
            <div class="form-row <?php echo $err_facebook_div; ?>">
              <p class="form-row-text"><span class="op">任意</span>Facebookアカウント名</p>
              <?php echo $err_facebook_msg; ?>
              <div class="icon-sns-wrap">
                <span class="icon-sns icon-sns-fb"></span><input type="text" name="facebook" value="<?php echo $nUserX->facebook; ?>" placeholder="アカウント名を入力" class="input-sns">
              </div>
              <p class="form-row-anno">※注意書きがここに入ります</p>
            </div>
            <div class="form-row <?php echo $err_twitter_div; ?>">
              <p class="form-row-text"><span class="op">任意</span>Youtubeアカウント名</p>
              <?php echo $err_twitter_msg; ?>
              <div class="icon-sns-wrap">
                <span class="icon-sns icon-sns-yt"></span><input type="text" name="youtube" value="<?php echo $nUserX->youtube; ?>" placeholder="アカウント名を入力" class="input-sns">
              </div>
              <p class="form-row-anno">※注意書きがここに入ります</p>
            </div>
          </div>

          <div class="form__submit">
            <div class="btn bd_blu"><input type="button" value="ユーザー情報設定変更へ戻る" onclick="location.href='x10u_user.php'"></div>
            <div class="btn bg_blu"><input type="submit" value="入力内容を確認する"></div>
                        <input name="doCheck" type="hidden" value="0">
          </div>

        </form>
      </div>
    </section>

  </main>

  <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>
</html>
