<?php
require('../x10c/db/x10.php');

// セッション再開
session_start();


// エラーメッセージの初期化
$errorMessage = '';


?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo ""; ?></title>
</head>

<body>


    <h3>ログインしました</h3>
    <?php if (!empty($errorMessage)) { ?>
    <span class="err"><?php echo $errorMessage; ?></span>
    <?php } ?>


</body>

</html>