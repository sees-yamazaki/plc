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

$nUser = new cls_nuser();

$nUser->name = $_POST['name'];
$nUser->zip1 = $_POST['zip1'];
$nUser->zip2 = $_POST['zip2'];
$nUser->adds = $_POST['adds'];
$nUser->add_sub = $_POST['add_sub'];
$nUser->tel = $_POST['tel'];
$nUser->fax = $_POST['fax'];
$nUser->url = $_POST['url'];

if (isset($_POST['doCheck'])) {

    header('Location: x10n_nuser_b_edite.php', true, 307);

} elseif (isset($_POST['doBack'])) {
} else{
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


    <form action="" method="POST">
        <br>
        お名前<br>
        <input type="text" name="name" value="<?php echo $nUser->name;?>" size="25" maxlength="32"><br>
        <br>
        <br>
        現住所<br>
        〒&nbsp;<input type="text" name="zip1" value="<?php echo $nUser->zip1;?>" size="3" maxlength="3">
        &nbsp;-&nbsp;<input type="text" name="zip2" value="<?php echo $nUser->zip2;?>" size="4" maxlength="4">

        &nbsp;<select name="adds">
            <?php echo $html; ?>
        </select>
        &nbsp;<input type="text" name="add_sub" value="<?php echo $nUser->add_sub;?>" size="48" maxlength="128"><br>
        <br>
        電話番号<br>
        <input type="text" name="tel" value="<?php echo $nUser->tel;?>" size="15" maxlength="15"><br>
        <br>
        FAX番号<br>
        <input type="text" name="fax" value="<?php echo $nUser->fax;?>" size="15" maxlength="15"><br>
        <br>
        <br>
        バナー掲載ＵＲＬ<br>
        <input type="text" name="url" value="<?php echo $nUser->url;?>" size="80" maxlength="256"><br>
        <br><br>

        <input name="doCheck" type="hidden" value="0">

        <div class="input_box">
            <input type="submit" value="入力内容の確認" class="input_base">
            <input type="reset" value="リセット" class="input_base">
        </div>

    </form>



    <br><br><hr>
<input type="button" onclick="location.href='x10n_home.php'" value="戻る">



</body>

</html>