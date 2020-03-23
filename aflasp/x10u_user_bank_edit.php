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


$nUser = new cls_nuser();

if(isset($_POST['4back'])){
    $nUser->bank = $_POST['bank'];
    $nUser->branch = $_POST['branch'];
    $nUser->bank_type = $_POST['bank-type'];
    $nUser->number = $_POST['number'];
    $nUser->bank_name = $_POST['bank_name'];
}else{
    $nUser = getNuser($LOGIN_ID);
}


?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>口座情報を編集する</title>
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
        <a href="#">口座情報を編集する</a>
      </p>
    </div>

    <div class="pageheader">
      <div class="pageheader__inner container">
        <h1 class="pageheader_title">口座情報を編集する</h1>
      </div>
    </div>

    <section class="sec-user section">
      <div class="sec__inner container">
        <form action="x10u_user_bank_confirm.php" method="post" class="form__bank_user">
          <div class="form__user__bank form__content_block">
            <h3 class="bar-title"><span class="bar-title-text">報酬支払い口座設定</span></h3>
            <div class="form-row">
              <p class="form-row-text">金融機関名</p>
              <input type="text" name="bank"
            value="<?php echo $nUser->bank;?>" placeholder="金融機関名を入力">
            </div>
            <div class="form-row">
              <p class="form-row-text">支店名</p>
              <input type="text" name="branch"
            value="<?php echo $nUser->branch;?>" placeholder="支店名を入力">
            </div>
            <div class="form-row">
              <p class="form-row-text">種別</p>
                <?php
                if($nUser->bank_type=="4" ){
                    $bt4 = " checked";    
                }elseif($nUser->bank_type=="2" ){
                    $bt2 = " checked";    
                }else{
                    $bt1 = " checked";    
                }
                ?>
              <label class="label-radio"><input type="radio" class="radiocheck" name="bank-type" value="1" <?php echo $bt1;?>>普通</label>
              <label class="label-radio"><input type="radio" class="radiocheck" name="bank-type" value="2" <?php echo $bt2;?>>当座</label>
              <label class="label-radio"><input type="radio" class="radiocheck" name="bank-type" value="4" <?php echo $bt4;?>>貯蓄</label>
            </div>
            <div class="form-row">
              <p class="form-row-text">口座番号</p>
              <input type="text" name="number"
            value="<?php echo $nUser->number;?>" placeholder="お名前を入力">
            </div>
            <div class="form-row">
              <p class="form-row-text">口座名義（カナ）</p>
              <input type="text" name="bank_name"
            value="<?php echo $nUser->bank_name;?>" placeholder="お名前を入力">
            </div>
          </div>

          <div class="form__submit">
            <div class="btn bd_blu"><input type="button" value="ユーザー情報設定変更へ戻る" onclick="location.href='x10u_user.php'"></div>
            <div class="btn bg_blu"><input type="submit" value="入力内容を確認する"></div>
          </div>

        </form>
      </div>
    </section>

  </main>

  <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>
</html>
