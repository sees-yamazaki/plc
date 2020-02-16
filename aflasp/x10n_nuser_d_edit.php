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

$LOGIN_ID =  $_SESSION[ $SESSION_NAME ] ;

$nUser = new cls_nuser_x10();

$nUser->nickname = $_POST['nickname'];
$nUser->instagram = $_POST['instagram'];
$nUser->facebook = $_POST['facebook'];
$nUser->twitter = $_POST['twitter'];
$nUser->youtube = $_POST['youtube'];

if (isset($_POST['doCheck'])) {
    header('Location: x10n_nuser_d_edite.php', true, 307);
} elseif (isset($_POST['doBack'])) {
} else {
    $nUser = getNuserX10($LOGIN_ID);
}


?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo ""; ?>
    </title>
    <link rel="stylesheet" href="x10n/css/main.css">
</head>

<body>


    <?php if (!empty($errorMessage)) { ?>
    <span class="err"><?php echo $errorMessage; ?></span>
    <?php } ?>


    <form action="" method="POST">
        <br>

        ニックネーム<br>
        <input type="text" name="nickname"
            value="<?php echo $nUser->nickname;?>" size="20"
            maxlength="20"><br>
        Instagram<br>
        <input type="text" name="instagram"
            value="<?php echo $nUser->instagram;?>" size="50"
            maxlength="100"><br>
        Facebook<br>
        <input type="text" name="facebook"
            value="<?php echo $nUser->facebook;?>" size="50"
            maxlength="100"><br>
        Twitter<br>
        <input type="text" name="twitter"
            value="<?php echo $nUser->twitter;?>" size="50"
            maxlength="100"><br>
        YouTube<br>
        <input type="text" name="youtube"
            value="<?php echo $nUser->youtube;?>" size="50"
            maxlength="100"><br>



        <input name="doCheck" type="hidden" value="0">

        <div class="input_box">
            <input type="submit" value="入力内容の確認" class="input_base">
            <input type="reset" value="リセット" class="input_base">
        </div>

    </form>



    <br><br>
    <hr>
    <input type="button" onclick="location.href='x10n_home.php'" value="戻る">



</body>

</html>