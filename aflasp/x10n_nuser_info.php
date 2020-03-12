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
if(empty($LOGIN_ID)){ header('Location: x10n_logoff.php'); }


$nUser = getNuser($LOGIN_ID);

$html = '<option value="">未選択</option>';
$prefs = getPrefectures();
foreach ($prefs as $pref) {
    $wk = $nUser->adds==$pref->id ? " selected" : "";
    $html .= '<option value="'.$pref->id.'" '.$wk.'>'.$pref->name.'</option>';
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

    設定変更<br>
    <br>
    ニックネーム<br>
    <input type="button" onclick="location.href='x10n_nuser_d_edit.php'" value="編集する"><br>
    <br>
    アバターアイコン<br>
    <br>
    ログインID、パス<br>
    <br>
    SNSアカウント<br>
    <input type="button" onclick="location.href='x10n_nuser_d_edit.php'" value="編集する"><br>
    <br>
    ユーザ情報<br>
    <input type="button" onclick="location.href='x10n_nuser_b_edit.php'" value="編集する"><br>
    <br>
    報酬支払先<br>
    <input type="button" onclick="location.href='x10n_nuser_c_edit.php'" value="編集する"><br>
    <br>
    <br>
    退会する



    <br><br>
    <hr>
    <input type="button" onclick="location.href='x10n_home.php'" value="戻る">



</body>

</html>