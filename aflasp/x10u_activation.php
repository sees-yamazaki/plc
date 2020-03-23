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

$nId = $_GET['id'];
$md5 = $_GET['md5'];

$nUser = getNuser($nId);

$md5_ = md5($nId . $nUser->mail);

$html='';
if ($md5_==$md5) {
  updateNuserActivate($nId,2);
  $html.='<div class="alert_box_complete">';
  $html.='<h4 class="alert_box_complete_title"><span class="icon_check_grn"></span>アクティベーションが完了致しました。</h4>';
  $html.='<p class="alert_box_text">下記よりログイン画面にお進み下さい。</p>';
  $html.='</div>';
  $html.='<div class="form__submit">';
  $html.='<div class="btn"><a href="./x10u_login.php" class="bg_blu">ログイン画面へ</a></div>';
  $html.='</div>';
  
}else{
  $html.='<div class="alert_box_complete">';
  $html.='<h4 class="alert_box_complete_title"><span class="icon_check_grn"></span>アクティベーションに失敗しました。</h4>';
  $html.='<p class="alert_box_text">メニューのお問い合わせよりお問い合わせください。</p>';
  $html.='</div>';
  $html.='<div class="form__submit">';
  $html.='<div class="btn"><a href="./x10u_index.php" class="bg_blu">トップ画面へ</a></div>';
  $html.='</div>';

}


?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>アクティベーション完了</title>
<meta name="description" content="アフィリエイト管理画面">
<?php include(__DIR__ . '/x10u/inc/meta.php'); ?>
</head>

<body>

  <?php include(__DIR__ . '/x10u/inc/header.php'); ?>

  <main class="main">

    <div class="mainheader">
      <p class="breadcrumbs">
        <a href="/">トップ</a>
      </p>
    </div>

    <div class="pageheader">
      <div class="pageheader__inner container">
        <h1 class="pageheader_title">アクティベーション完了</h1>
      </div>
    </div>

    <section class="sec-member section">
      <div class="sec__inner container">
        <div class="form__member__basic form__content_block">
          <?php echo $html; ?>
      </div>
    </section>

  </main>

  <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>
</html>
