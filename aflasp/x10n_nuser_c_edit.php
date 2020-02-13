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

$nUser->bank = $_POST['bank'];
$nUser->bank_code = $_POST['bank_code'];
$nUser->branch = $_POST['branch'];
$nUser->branch_code = $_POST['branch_code'];
$nUser->bank_type = $_POST['bank_type'];
$nUser->number = $_POST['number'];
$nUser->bank_name = $_POST['bank_name'];

if (isset($_POST['doCheck'])) {

    header('Location: x10n_nuser_c_edite.php', true, 307);

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

        金融機関名<br>
        <input type="text" name="bank" value="<?php echo $nUser->bank;?>" size="30" maxlength="30"><br>
        金融機関番号<br>
        <input type="text" name="bank_code" value="<?php echo $nUser->bank_code;?>" size="6" maxlength="4"><br>
        支店名<br>
        <input type="text" name="branch" value="<?php echo $nUser->branch;?>" size="30" maxlength="30"><br>
        支店番号<br>
        <input type="text" name="branch_code" value="<?php echo $nUser->branch_code;?>" size="5" maxlength="3"><br>
        種別<br>
        <label><input type="radio" name="bank_type" value="1" checked="checked">普通</label>
        <label><input type="radio" name="bank_type" value="2">当座</label>
        <label><input type="radio" name="bank_type" value="4">貯蓄</label><br>
        口座番号<br>
        <input type="text" name="number" value="<?php echo $nUser->number;?>" size="15" maxlength="7"><br>
        口座名義(カナ)<br>
        <input type="text" name="bank_name" value="<?php echo $nUser->bank_name;?>" size="30" maxlength="30"><br>


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