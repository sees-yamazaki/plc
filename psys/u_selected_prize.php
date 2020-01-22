<?php

require('logging.php');
require('session.php');

// セッション開始
session_start();
setMyName('psys_m');

// エラーメッセージの初期化
$errorMessage = '';


//メニュー内容
$menu_m_url="./asset/image/title_mypage.png";
$menu_m_click="location.href='u_home.php'";

require_once './db/views.php';
$point = getPoint(getSsn("SEQ"));


$pSeq = $_POST['pSeq'];
$pzSeq = $_POST['pzSeq'];

require_once './db/promos.php';
$promo = getPromo($pSeq);

require_once './db/prizes.php';
$prize = getPrize($pzSeq);
$html2 = '';
$html2 .= '<div class="rDiv w80p">';
if (!empty($prize->pz_title)) {
    $html2 .= '<div class="rDivTitle">'.$prize->pz_title.'に応募する</div>';
}
if (!empty($prize->pz_img)) {
    $html2 .= "<img class='w90p' border=0 src='./". getSsn('PATH_PROMO')."/".$pSeq.'/'.$prize->pz_img."'><br>";
}
if (!empty($prize->pz_text)) {
    $html2 .= nl2br($prize->pz_text)."<br>";
}
$html2 .= "<div class='entryBtn'><input type='button' onclick='javascript:doGame()' value='ゲームにチャレンジ' /></div>";
$html2 .= '</div>';

$missPrize = getMissPrize($pSeq);
$html3 = '';
$html3 .= '<div class="rDiv w80p">';
if (!empty($missPrize->pz_title)) {
    $html3 .= '<div class="rDivTitleGrey">今月の'.$missPrize->pz_title.'はコレ！</div>';
}
if (!empty($missPrize->pz_img)) {
    $html3 .= "<img class='w90p' border=0 src='./". getSsn('PATH_PROMO')."/".$pSeq.'/'.$missPrize->pz_img."'><br>";
}
if (!empty($prize->pz_text)) {
    $html3 .= nl2br($missPrize->pz_text)."<br>";
}
$html3 .= '</div>';

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

    <div id="menu">
        <?php include('./u_top_menu.php'); ?>
    </div>


    <div id="contents">

    <br><br><img class="w70p" src="./asset/image/select_prize.png"><br><br>
        <?php if (!empty($errorMessage)) { ?>
        <div class="info w80p"><?php echo $errorMessage; ?>
        </div>
        <?php } ?>

        <?php echo $html2; ?>

        <?php echo $html3; ?>

</body>

</html>