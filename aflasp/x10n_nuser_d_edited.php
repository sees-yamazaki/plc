<?php
include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';
include 'x10c/db/adwares.php';
include 'x10c/db/x10.php';
include 'x10c/db/nuser.php';

session_start();

$errorMessage='';



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

    登録が完了しました。


    <br><br>
    <hr>
    <input type="button" onclick="location.href='x10n_home.php'" value="戻る">

</body>

</html>