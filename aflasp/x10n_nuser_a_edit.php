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


$nUser = new cls_nuser();

$nUser->mail = $_POST['mail'];
$nUser->mail_confirm = $_POST['mail_confirm'];
$nUser->pass = $_POST['pass'];
$nUser->pass_confirm = $_POST['pass_confirm'];

if (isset($_POST['doCheck'])) {
    if ($nUser->mail <> $nUser->mail_confirm) {
        $errorMessage='メールアドレスが一致しません。';
    } elseif ($nUser->pass <> $nUser->pass_confirm) {
        $errorMessage='パスワードが一致しません。';
    } elseif (countNUserByMail($nUser->mail)>0) {
        $errorMessage='このメールアドレスは使用されています。';
    } else {
        $pw1 = preg_replace('/^\w+:/', '', $nUser->pass);
        $pw2 = openssl_encrypt($pw1, 'aes-256-ecb', base64_encode('AES'));
        $nUser->pass = $pw2;

        header('Location: x10n_nuser_edite.php', true, 307);
    }
} elseif (isset($_POST['back'])) {
    //
}elseif(!empty($LOGIN_ID)){
    $nUser = getNuser($LOGIN_ID);
}

$html = '<option value="">未選択</option>';
$prefs = getPrefectures();
foreach($prefs as $pref){
    $wk = $nUser->adds==$pref->id ? " selected" : "";
    $html .= '<option value="'.$pref->id.'" '.$wk.'>'.$pref->name.'</option>';
}


?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo ""; ?></title>
    <link rel="stylesheet" href="x10n/css/main.css">
</head>

<body>


    <?php if (!empty($errorMessage)) { ?>
    <span class="err"><?php echo $errorMessage; ?></span>
    <?php } ?>

＜変更しない場合は入力しない＞<br><br>
    <form action="" method="POST">

        メールアドレス<br>
        <input type="text" name="mail" value="<?php echo $nUser->mail;?>" size="50" maxlength="128"><br>
        <br>
        メールアドレス(再入力)<br>
        <input type="text" name="mail_confirm" value="<?php echo $nUser->mail_confirm;?>" size="50" maxlength="128"><br>
        <br>
        パスワード<br>
        <input type="password" name="pass" size="25" maxlength="128"><br>
        <br>
        パスワード(再入力)<br>
        <input type="password" name="pass_confirm" size="25" maxlength="128"><br>

        <input name="doCheck" type="hidden" value="0">
        <input name="nId" type="hidden" value="<?php echo $LOGIN_ID; ?>">

        <div class="input_box">
            <input type="submit" value="入力内容の確認" class="input_base">
            <input type="reset" value="リセット" class="input_base">
        </div>

    </form>



    <br><br><hr>
<input type="button" onclick="location.href='x10n_home.php'" value="戻る">



</body>

</html>