<?php

require('session.php');
require('logging.php');

// セッション開始
session_start();
setMyName('psys_m');
setSsnCrntPage(__FILE__);

// エラーメッセージの初期化
$errorMessage = '';

//メニュー内容
$menu_m_url="./asset/image/title_mypage.png";
$menu_m_click="location.href='u_home.php'";

require_once './db/views.php';
$point = getPoint(getSsn("SEQ"));


$pSeq = $_POST['pSeq'];
$pzSeq = $_POST['pzSeq'];
$result = $_POST['result'];
$spSeq = $_POST['spSeq'];
$sendPzSeq = "";

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
    $sendPzSeq = $prize->pz_seq;
} else {
    $imageUrl = './asset/image/result_miss.png';
    $missPrize = getMissPrize($pSeq);
    if (!empty($missPrize->pz_title)) {
        $html2 .= '<div class="rDivTitleGrey">'.$missPrize->pz_title.'を発送します</div>';
    }
    if (!empty($missPrize->pz_img)) {
        $html2 .= "<img class='w80p' border=0 src='./". getSsn('PATH_PROMO')."/".$pSeq.'/'.$missPrize->pz_img."'><br>";
    }
    $sendPzSeq = $missPrize->pz_seq;
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

    <div id="menu">
        <?php include('./u_top_menu.php'); ?>
    </div>


    <div id="contents">

        <div class="waku">
            <img class='w100p' border=0
                src="<?php echo $imageUrl; ?>">
        </div>
        <?php echo $html2; ?>
        <div class="waku">
            <input type='button' class='rButton w80p f1rem btn-red' onclick="location.href='u_home.php'"
                value='MY PAGEに戻る' />
            <br>
            <form action="u_shipform.php" method="POST" name="frm">
                <input type="submit" class="rButton w80p btn-red-rev" value="発送先を指定する場合はこちら" />
                <input type="hidden" name="pzSeq"
                    value="<?php echo $sendPzSeq; ?>">
                <input type="hidden" name="spSeq"
                    value="<?php echo $spSeq; ?>">
            </form>
        </div>
    </div>
</body>

</html>