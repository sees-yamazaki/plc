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

$addPt = $_GET['addPt'];


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


    <?php if(!empty($errorMessage)){ ?>
    <section id="banner2">
        <div class="inner">
            <h3><?php echo $errorMessage; ?></h3>
        </div>
    </section>
    <?php } ?>


    <section id="banner">
				<div class="inner">
                <h1>ポイント登録完了</h1>
					<h2><br><?php echo $addPt; ?>ポイント加算されました。<br></h2>
					<ul class="actions">
						<li><a href="home.php" class="button alt scrolly big">ホームに戻る</a></li>
					</ul>

				</div>
            </section>


    <?php include('./footer.php'); ?>


</body>

</html>