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



if (isset($_POST['doEdit'])) {

    withdrawalNuser($LOGIN_ID);

    header('Location: x10u_user_withdrawal_complete.php');

}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>退会する</title>
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
        <a href="#">退会する</a>
      </p>
    </div>

    <div class="pageheader">
      <div class="pageheader__inner container">
        <h1 class="pageheader_title">退会する</h1>
      </div>
    </div>

    <section class="sec-user section">
      <div class="sec__inner container">
        <form action="" name="user_bank" method="post" class="form__bank_user">
          <div class="form__content_block">
            <h3 class="bar-title"><span class="bar-title-text">退会する</span></h3>
            <div class="dl-style">
              <dl>
                <dt>ご注意ください</dt>
                <dd>。。。。。。。。。。</dd>
              </dl>
            </div>
          </div>

          <div class="form__submit">
            <div class="btn bd_blu"><input type="button" value="ユーザー情報設定変更へ戻る" onclick="location.href='x10u_user.php'"></div>
            <div class="btn bg_blu"><input type="submit" name="doEdit" value="確定する"></div>
          </div>

        </form>
      </div>
    </section>

  </main>

  <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>
</html>
