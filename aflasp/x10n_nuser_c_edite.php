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
if(empty($LOGIN_ID)){ header('Location: x10n_logoff.php'); }

$errorMessage='';

$nUser = new cls_nuser();

$nUser->id =  $_SESSION[ $SESSION_NAME ] ;
$nUser->bank = $_POST['bank'];
$nUser->bank_code = $_POST['bank_code'];
$nUser->branch = $_POST['branch'];
$nUser->branch_code = $_POST['branch_code'];
$nUser->bank_type = $_POST['bank_type'];
$nUser->number = $_POST['number'];
$nUser->bank_name = $_POST['bank_name'];


if (isset($_POST['doCheck'])) {
    //
} elseif (isset($_POST['doEdit'])) {
    updateNuserC($nUser);
    header('Location: x10n_nuser_c_edited.php');
} elseif (isset($_POST['doBack'])) {
    header('Location: x10n_nuser_c_edit.php', true, 307);
}

$prefs = getPrefectures();
$prefName = "";
foreach ($prefs as $pref) {
    if ($nUser->adds==$pref->id) {
        $prefName = $pref->name;
    }
}





?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo ""; ?></title>
</head>

<body>


    <div id="inc_side_body">


        <?php if (!empty($errorMessage)) { ?>
        <span class="err"><?php echo $errorMessage; ?></span>
        <?php } ?>


        金融機関名<br>
        <?php echo $nUser->bank;?><br>

        金融機関番号<br>
        <?php echo $nUser->bank_code;?><br>

        支店名<br>
        <?php echo $nUser->branch;?><br>

        支店番号<br>
        <?php echo $nUser->branch_code;?><br>

        種別<br>
        <?php echo $nUser->bank_type;?><br>

        口座番号<br>
        <?php echo $nUser->number;?><br>

        口座名義(カナ)<br>
        <?php echo $nUser->bank_name;?><br>



        <div class="input_box">

            <form action="" method="POST">
                <input type="submit" name="doEdit" value="登録する" class="input_base">
                <input type="submit" name="doBack" value="戻る" class="input_base">
                <input type="hidden" name="bank" value="<?php echo $nUser->bank; ?>">
                <input type="hidden" name="bank_code" value="<?php echo $nUser->bank_code; ?>">
                <input type="hidden" name="branch" value="<?php echo $nUser->branch; ?>">
                <input type="hidden" name="branch_code" value="<?php echo $nUser->branch_code; ?>">
                <input type="hidden" name="bank_type" value="<?php echo $nUser->bank_type; ?>">
                <input type="hidden" name="number" value="<?php echo $nUser->number; ?>">
                <input type="hidden" name="bank_name" value="<?php echo $nUser->bank_name; ?>">
            </form>
        </div>

    </div>

</body>

</html>