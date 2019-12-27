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

$gamePt = getSsn('POINT_GAME');


require_once './db/view.php';
$point = getPoint(getSsn("SEQ"));


require '../psys/db/infos.php';
$infos = getOpenInfos("");

$html1 = '';
foreach ($infos as $info) {
    if (strlen($info->inf_text1)>0) {
        $html1 .= "<h3>".nl2br($info->inf_text1)."</h3>";
    }
    if (strlen($info->inf_img)>0) {
        $html1 .= "<img class='img80' border=0 src='../psys/".getSsn('PATH_INFO')."/".$info->inf_seq."/".$info->inf_img."'>";
    }
    if (strlen($info->inf_text2)>0) {
        $html1 .= "<h3>".nl2br($info->inf_text2)."</h3>";
    }
    $html1 .= "<hr>";
}
$html1 = substr($html1,0,-4);

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

    <section id="banner8">
        <div class="inner">
            <?php echo $html1; ?>
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

    <section id="banner">
        <div class="inner">
        <?php if($point>=$gamePt){ ?>
            <h1><?php echo $gamePt; ?>ポイント貯まりました！！</h1>
            <ul class="actions">
                <li><a href="select_prize.php" class="button alt scrolly big">ゲームにチャレンジ</a></li>
            </ul>
            <?php }else{ ?>
                <h3>頑張って<?php echo $gamePt; ?>ポイント貯めると、ゲームにチャレンジできます！！</h3>
        <?php } ?>
        </div>
    </section>


    <?php include('./footer.php'); ?>

</body>

</html>