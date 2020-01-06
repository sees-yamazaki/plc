<?php

// セッション開始
session_start();
require('session.php');

// ログイン状態チェック
if (getSsnIsLogin()==false) {
    header("Location: logoff.php");
    exit;
}

// エラーメッセージの初期化
$errorMessage = "";

$addPt = $_GET['addPt'];


require_once './db/members.php';
$member = new cls_members();
$member = getMyPoints(getSsn("SEQ"));


?>
<!DOCTYPE HTML>
<html lang="ja">

<head>
    <title><?php echo getSsnMyname(); ?></title>
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
					<h2><br><?php echo $addPt; ?>ポイント加算されて、合計<?php echo $member->crnt_point; ?>ポイントになりました。<br></h2>
					<ul class="actions">
						<li><a href="pointentry.php" class="button alt scrolly big">続けて登録する</a></li>
						<li><a href="home.php" class="button alt scrolly big">ホームに戻る</a></li>
					</ul>

				</div>
            </section>


    <?php include('./footer.php'); ?>


</body>

</html>