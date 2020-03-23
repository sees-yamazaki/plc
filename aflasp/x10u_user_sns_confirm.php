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
if(empty($LOGIN_ID)){ header('Location: x10u_logoff.php'); }

$errorMessage='';



if (isset($_POST['doCheck'])) {
} elseif (isset($_POST['doEdit'])) {
    

        $nUser = new cls_nuser_x10();
        $nUser->id =  $LOGIN_ID;
        $nUser->nickname = "";
        $nUser->instagram = $_POST['instagram'];
        $nUser->facebook = $_POST['facebook'];
        $nUser->twitter = $_POST['twitter'];
        $nUser->youtube = $_POST['youtube'];

        updateNuserX10($nUser);

        header('Location: x10u_user_sns_complete.php');

} elseif (isset($_POST['4back'])) {
    header('Location: x10u_user_sns_edit.php', true, 307);
}


$instagram = str_replace('/','',str_replace('https://www.instagram.com/','',$_POST['instagram']));
$facebook = str_replace('/','',str_replace('https://www.facebook.com/','',$_POST['facebook']));
$twitter = str_replace('/','',str_replace('https://twitter.com/','',$_POST['twitter']));
$youtube = str_replace('/','',str_replace('https://www.youtube.com/channel/','',$_POST['youtube']));



?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>SNSアカウントを編集する【確認】</title>
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
        <a href="#">SNSアカウントを編集する【確認】</a>
      </p>
    </div>

    <div class="pageheader">
      <div class="pageheader__inner container">
        <h1 class="pageheader_title">SNSアカウントを編集する【確認】</h1>
      </div>
    </div>

    <section class="sec-user section">
      <div class="sec__inner container">
        <form action="" method="post" class="form__sns_user">
          <div class="form__content_block">
            <h3 class="bar-title"><span class="bar-title-text">SNSアカウント</span></h3>
            <div class="dl-style">
              <dl>
                <dt>Instagramアカウント名</dt>
                <dd><?php echo $instagram; ?></dd>
              </dl>
              <dl>
                <dt>Twitterアカウント名</dt>
                <dd><?php echo $twitter; ?></dd>
              </dl>
              <dl>
                <dt>Facebookアカウント名</dt>
                <dd><?php echo $facebook; ?></dd>
              </dl>
              <dl>
                <dt>Youtubeアカウント名</dt>
                <dd><?php echo $youtube; ?></dd>
              </dl>
            </div>
          </div>

          <div class="form__submit">
            <div class="btn bd_blu"><input type="button" value="修正する" onclick="history.back(); return false;"></div>
            <div class="btn bg_blu"><input type="submit" name="doEdit" value="確定する"></div>
            <input type="hidden" name="4back" value="1">
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
