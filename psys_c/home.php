<?php

// セッション開始
session_start();

$ini = $_SESSION['INI'];

// ログイン状態チェック
if (!isset($_SESSION[$ini['sysname']."SEQ"])) {
    header("Location: logoff.php");
    exit;
}

// エラーメッセージの初期化
$errorMessage = "";


require_once './db/view.php';
$point = getPoint($_SESSION[$ini['sysname']."SEQ"]);

?>

<!DOCTYPE HTML>
<html lang="ja">

<head>
    <title><?php echo $ini['sysname']; ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="asset/css/main.css" />
</head>

<body>


    <?php include('./menu.php'); ?>

    <!-- Banner -->
    <?php if(!empty($errorMessage)){ ?>
    <section id="banner2">
        <div class="inner">
            <h3><?php echo $errorMessage; ?></h3>
        </div>
    </section>
    <?php } ?>

    <section id="banner2">
        <div class="inner">
            <h1>お知らせ</h1>
        </div>
    </section>

    <section id="banner">
        <div class="inner">
            <h1>現在のポイント：<?php echo $point; ?>PT</h1>
            <ul class="actions">
                <li><a href="pointentry.php" class="button alt scrolly big">ポイント登録する</a></li>
            </ul>


        </div>
    </section>



    <?php include('./footer.php'); ?>

</body>

</html>