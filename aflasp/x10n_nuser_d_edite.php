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

$nUser = new cls_nuser_x10();

$nUser->id =  $_SESSION[ $SESSION_NAME ] ;
$nUser->nickname = $_POST['nickname'];
$nUser->instagram = $_POST['instagram'];
$nUser->facebook = $_POST['facebook'];
$nUser->twitter = $_POST['twitter'];
$nUser->youtube = $_POST['youtube'];


if (isset($_POST['doCheck'])) {
    //
} elseif (isset($_POST['doEdit'])) {
    if (countNuserX10($nUser->id)==0) {
        insertNuserX10($nUser);
    } else {
        updateNuserX10($nUser);
    }

    header('Location: x10n_nuser_d_edited.php');
} elseif (isset($_POST['doBack'])) {
    header('Location: x10n_nuser_d_edit.php', true, 307);
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
    <title><?php echo ""; ?>
    </title>
</head>

<body>


    <div id="inc_side_body">


        <?php if (!empty($errorMessage)) { ?>
        <span class="err"><?php echo $errorMessage; ?></span>
        <?php } ?>


        ニックネーム<br>
        <?php echo $nUser->nickname;?><br>

        Instagram<br>
        <?php echo $nUser->instagram;?><br>

        Facebook<br>
        <?php echo $nUser->facebook;?><br>

        Twitter<br>
        <?php echo $nUser->twitter;?><br>

        YouTube<br>
        <?php echo $nUser->youtube;?><br>




        <div class="input_box">

            <form action="" method="POST">
                <input type="submit" name="doEdit" value="登録する" class="input_base">
                <input type="submit" name="doBack" value="戻る" class="input_base">
                <input type="hidden" name="nickname"
                    value="<?php echo $nUser->nickname; ?>">
                <input type="hidden" name="instagram"
                    value="<?php echo $nUser->instagram; ?>">
                <input type="hidden" name="facebook"
                    value="<?php echo $nUser->facebook; ?>">
                <input type="hidden" name="twitter"
                    value="<?php echo $nUser->twitter; ?>">
                <input type="hidden" name="youtube"
                    value="<?php echo $nUser->youtube; ?>">
            </form>
        </div>

    </div>

</body>

</html>