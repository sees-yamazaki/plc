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
    $nUser = new cls_nuser();
    $nUser->id = $LOGIN_ID;
    $nUser->bank = $_POST['bank'];
    $nUser->branch = $_POST['branch'];
    $nUser->bank_type = $_POST['bank-type'];
    $nUser->number = $_POST['number'];
    $nUser->bank_name = $_POST['bank_name'];

    updateNuserBank($nUser);

    header('Location: x10u_user_bank_complete.php');

} elseif (isset($_POST['4back'])) {
    header('Location: x10u_user_bank_edit.php', true, 307);
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>口座情報を編集する【確認】</title>
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
        <a href="#">口座情報を編集する【確認】</a>
      </p>
    </div>

    <div class="pageheader">
      <div class="pageheader__inner container">
        <h1 class="pageheader_title">口座情報を編集する【確認】</h1>
      </div>
    </div>

    <section class="sec-user section">
      <div class="sec__inner container">
        <form action="" name="user_bank" method="post" class="form__bank_user">
          <div class="form__content_block">
            <h3 class="bar-title"><span class="bar-title-text">報酬支払い口座設定</span></h3>
            <div class="dl-style">
              <dl>
                <dt>金融機関名</dt>
                <dd><?php echo $_POST['bank']; ?></dd>
              </dl>
              <dl>
                <dt>支店名</dt>
                <dd><?php echo $_POST['branch']; ?></dd>
              </dl>
              <dl>
                <dt>種別</dt>
                <?php
                if ($_POST['bank-type']=="4") {
                    $bankType = "貯蓄";
                } elseif ($_POST['bank-type']=="2") {
                    $bankType = "当座";
                } else {
                    $bankType = "普通";
                }
                ?>
                <dd><?php echo $bankType; ?></dd>
              </dl>
              <dl>
                <dt>口座番号</dt>
                <dd><?php echo $_POST['number']; ?></dd>
              </dl>
              <dl>
                <dt>口座名義（カナ）</dt>
                <dd><?php echo $_POST['bank_name']; ?></dd>
              </dl>
            </div>
          </div>

          <div class="form__submit">
            <div class="btn bd_blu"><input type="button" value="修正する" onclick="document.user_bank.submit();"></div>
            <div class="btn bg_blu"><input type="submit" name="doEdit" value="確定する"></div>
            <input type="hidden" name="4back" value="1">
            <input type="hidden" name="bank" value="<?php echo $_POST['bank']; ?>">
            <input type="hidden" name="branch" value="<?php echo $_POST['branch']; ?>">
            <input type="hidden" name="bank-type" value="<?php echo $_POST['bank-type']; ?>">
            <input type="hidden" name="number" value="<?php echo $_POST['number']; ?>">
            <input type="hidden" name="bank_name" value="<?php echo $_POST['bank_name']; ?>">
          </div>

        </form>
      </div>
    </section>

  </main>

  <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>
</html>
