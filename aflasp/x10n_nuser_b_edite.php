<?php
include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';
include 'x10c/db/adwares.php';
include 'x10c/db/x10.php';
include 'x10c/db/nuser.php';
include 'x10c/db/system.php';

session_start();

$errorMessage='';

$nUser = new cls_nuser();

$nUser->id =  $_SESSION[ $SESSION_NAME ] ;
$nUser->name = $_POST['name'];
$nUser->zip1 = $_POST['zip1'];
$nUser->zip2 = $_POST['zip2'];
$nUser->adds = $_POST['adds'];
$nUser->add_sub = $_POST['add_sub'];
$nUser->tel = $_POST['tel'];
$nUser->fax = $_POST['fax'];
$nUser->url = $_POST['url'];


if (isset($_POST['doCheck'])) {
    //
} elseif (isset($_POST['doEdit'])) {
    updateNuserB($nUser);
    header('Location: x10n_nuser_b_edited.php');
} elseif (isset($_POST['doBack'])) {
    header('Location: x10n_nuser_b_edit.php', true, 307);
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

        お名前<br>
        <?php echo $nUser->name;?><br>

        現住所<br>
        <?php echo $nUser->zip1;?>-<?php echo $nUser->zip2;?><br>
        <?php echo $prefName;?><?php echo $nUser->add_sub;?><br>

        電話番号<br>
        <?php echo $nUser->tel;?><br>

        FAX番号<br>
        <?php echo $nUser->tel;?><br>

        バナー掲載ＵＲＬ<br>
        <?php echo $nUser->url;?><br>



        <div class="input_box">

            <form action="" method="POST">
                <input type="submit" name="doEdit" value="登録する" class="input_base">
                <input type="submit" name="doBack" value="戻る" class="input_base">
                <input type="hidden" name="name" value="<?php echo $nUser->name; ?>">
                <input type="hidden" name="zip1" value="<?php echo $nUser->zip1; ?>">
                <input type="hidden" name="zip2" value="<?php echo $nUser->zip2; ?>">
                <input type="hidden" name="adds" value="<?php echo $nUser->adds; ?>">
                <input type="hidden" name="add_sub" value="<?php echo $nUser->add_sub; ?>">
                <input type="hidden" name="tel" value="<?php echo $nUser->tel; ?>">
                <input type="hidden" name="fax" value="<?php echo $nUser->fax; ?>">
                <input type="hidden" name="url" value="<?php echo $nUser->url; ?>">
            </form>
        </div>

    </div>

</body>

</html>