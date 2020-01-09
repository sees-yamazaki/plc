<?php

// セッション開始
session_start();
require('session.php');
require('../psys/logging.php');


// ログイン状態チェック
if (getSsnIsLogin()==false) {
    header("Location: logoff.php");
    exit;
}

// エラーメッセージの初期化
$errorMessage = "";

$gamePt = getSsn('POINT_GAME');


require_once '../psys/db/views.php';
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


require '../psys/db/usepoints.php';
$ups = getUnShip(getSsn('SEQ'));

require '../psys/db/prizes.php';
$html2 = '';
$shiplimit = getSsn('SHIP_LIMIT');
$today = date("Y-m-d");
foreach ($ups as $up) {
    $prize = getPrize($up->pz_seq);
    $createdt = substr($up->createdt,0,10);
    $limitdt = date("Y-m-d",strtotime($createdt."+".$shiplimit." day"));

    if($today<$limitdt){
        $html2 .= '申し込み期限：'.$limitdt.'まで<br>';
        $html2 .= "<img class='img80' border=0 src='../psys/". getSsn('PATH_PROMO')."/".$prize->p_seq.'/'.$prize->pz_img."'><br>";
        $html2 .= "<ul class='actions'>";
        $html2 .= "<li><a href='javascript:ship(".$up->up_seq.")' class='button alt big'>発送先を登録する</a></li>";
        $html2 .= '</ul><hr>';

    }


}



?>

<!DOCTYPE HTML>
<html lang="ja">

<head>
    <title><?php echo getSsnMyname(); ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="asset/css/main.css" />
    <script>
    function ship(vlu) {
        document.frm.upSeq.value = vlu;
        document.frm.submit();
    }
    </script>
</head>

<body>


    <?php include('./menu.php'); ?>

    <?php if($html2<>''){ ?>
        <form action='shipform.php' method='POST' name="frm">
            <input type='hidden' name='upSeq' value=''>
        </form>
        <section id="banner8">
            <div class="inner">
                <h1>未発送の当選品があります</h1>
                <?php echo $html2; ?>
            </div>
        </section>
    <?php }elseif($html1<>''){ ?>
        <section id="banner8">
            <div class="inner">
                <?php echo $html1; ?>
            </div>
        </section>
    <?php } ?>

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