<?php

// セッション開始
session_start();
require('session.php');
setMyName('psys_m');
require('logging.php');

// エラーメッセージの初期化
$errorMessage = '';

require_once './db/views.php';
$point = getPoint(getSsn("SEQ"));


$pSeq = $_POST['pSeq'];
$pzSeq = $_POST['pzSeq'];
$result = $_POST['result'];

require_once './db/promos.php';
$promo = getPromo($pSeq);

require_once './db/prizes.php';
$html2 = '';
$html2 .= '<div class="rDiv w80p">';

if ($result=="hit") {
    $imageUrl = './asset/image/result_hit.png';
    $prize = getPrize($pzSeq);
    if (!empty($prize->pz_title)) {
        $html2 .= '<div class="rDivTitle">'.$prize->pz_title.'を発送します</div>';
    }
    if (!empty($prize->pz_img)) {
        $html2 .= "<img class='w80p' border=0 src='./". getSsn('PATH_PROMO')."/".$pSeq.'/'.$prize->pz_img."'><br>";
    }
} else {
    $imageUrl = './asset/image/result_miss.png';
    $missPrize = getMissPrize($pSeq);
    if (!empty($missPrize->pz_title)) {
        $html2 .= '<div class="rDivTitleGrey">'.$missPrize->pz_title.'を発送します</div>';
    }
    if (!empty($missPrize->pz_img)) {
        $html2 .= "<img class='w80p' border=0 src='./". getSsn('PATH_PROMO')."/".$pSeq.'/'.$missPrize->pz_img."'><br>";
    }
}
$html2 .= '商品は来月末のご発送になります。<br>商品発送まで今しばらくお待ちくださいませ。';
$html2 .= '</div>';


?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo getSsnMyname(); ?>
    </title>
    <link rel="stylesheet" href="./asset/css/u_main.css">
    <script>
        function doGame() {
            document.frm.submit();
        }
    </script>
</head>

<body>

    <form action='u_game.php' method='POST' name="frm">
        <input type='hidden' name='pSeq'
            value='<?php echo $pSeq; ?>'>
        <input type='hidden' name='pzSeq'
            value='<?php echo $pzSeq; ?>'>
        <input type='hidden' name='gSeq'
            value='<?php echo $promo->g_seq; ?>'>
    </form>

    <?php include('./u_menu.php'); ?>


    <div id="contents">
        <?php include('./u_point.php'); ?>

        <div class="waku">
        <img class='w100p' border=0 src="<?php echo $imageUrl; ?>">
        </div>
        <?php echo $html2; ?>
        <div class="waku">
        <input type='button' class='rButton w80p f1rem btn-red' onclick="location.href='u_home.php'" value='MY PAGEに戻る' />
        </div>
        </div>
</body>

</html>