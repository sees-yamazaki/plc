<?php

// セッション開始
session_start();
require('session.php');
setMyName('psys_m');
require('logging.php');

// エラーメッセージの初期化
$errorMessage = '';


$gamePt = getSsn('POINT_GAME');


require_once './db/views.php';
$point = getPoint(getSsn("SEQ"));


require './db/infos.php';
$infos = getOpenInfos("");

$html1 = '';
foreach ($infos as $info) {
    if (strlen($info->inf_text1)>0) {
        $html1 .= "<h3>".nl2br($info->inf_text1)."</h3>";
    }
    if (strlen($info->inf_img)>0) {
        $html1 .= "<img class='img80' border=0 src='./".getSsn('PATH_INFO')."/".$info->inf_seq."/".$info->inf_img."'>";
    }
    if (strlen($info->inf_text2)>0) {
        $html1 .= "<h3>".nl2br($info->inf_text2)."</h3>";
    }
    $html1 .= "<hr>";
}
$html1 = substr($html1, 0, -4);


require './db/usepoints.php';
$ups = getUnShip(getSsn('SEQ'));

require './db/prizes.php';
$html2 = '';
$shiplimit = getSsn('SHIP_LIMIT');
$today = date("Y-m-d");
foreach ($ups as $up) {
    $prize = getPrize($up->pz_seq);
    $createdt = substr($up->createdt, 0, 10);
    $limitdt = date("Y-m-d", strtotime($createdt."+".$shiplimit." day"));

    if ($today<$limitdt) {
        $html2 .= '申し込み期限：'.$limitdt.'まで<br>';
        $html2 .= "<img class='img80' border=0 src='./". getSsn('PATH_PROMO')."/".$prize->p_seq.'/'.$prize->pz_img."'><br>";
        $html2 .= "<ul class='actions'>";
        $html2 .= "<li><a href='javascript:ship(".$up->up_seq.")' class='button alt big'>発送先を登録する</a></li>";
        $html2 .= '</ul><hr>';
    }
}

require_once './db/promos.php';
$promo = getOpenPromo();
$htmlImg = '<p id="slideshow">';

require_once './db/prizes.php';
$prizes = getPrizes($promo->p_seq);
foreach ($prizes as $prize) {
    if (!empty($prize->pz_img) && ($prize->pz_kind=="0")) {
        $htmlImg .= "<div class='swiper-slide'>";
        $htmlImg .= "<img class='w80p' border=0 src='./". getSsn('PATH_PROMO')."/".$prize->p_seq.'/'.$prize->pz_img."'>";
        $htmlImg .= "</div>";
    }
}
$htmlImg .= '</p>';

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo getSsnMyname(); ?>
    </title>
    <link rel="stylesheet" href="./asset/css/swiper.css">
    <link rel="stylesheet" href="./asset/css/u_main.css">
</head>

<body>
    <form action='u_pointentry.php' method='POST' name="frm">
        <input type='hidden' name='pSeq'
            value='<?php echo $promo->p_seq; ?>'>
    </form>
    <form action='u_select_prize.php' method='POST' name="frm2">
        <input type='hidden' name='pSeq'
            value='<?php echo $promo->p_seq; ?>'>
    </form>

    <?php include('./u_menu.php'); ?>


    <div id="contents">
        <?php include('./u_point.php'); ?>
        <h3><br>MyPAGE</h3>
        <?php if ($html2<>'') { ?>
        <div class="info w80p">現在発送できない商品がございます。<br>メニューのお知らせをご確認ください。</div><br>
        <?php } ?>
        <?php if (!empty($errorMessage)) { ?>
        <span class="err"><?php echo $errorMessage; ?></span>
        <?php } ?>

        <div class="rDiv w80p">
            <div class="rDivTitle">ポイントを登録する</div>
            <img src="./asset/image/pointcard.png" class="w60p" />
            <input type="button" class="rButton w80p f1rem btn-red" onclick="javascript:frm.submit()"
                value="ポイント登録はこちらから" />
        </div>

        <div class="rDiv w80p">
            <div class="rDivTitle">商品に応募する</div>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php echo $htmlImg; ?>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
            <?php if($point>=$gamePt){ ?>
            <input type="button" class="rButton w80p f1rem btn-red" onclick="javascript:frm2.submit()"
                value="商品に応募はこちらから" />
            <?php }else{ ?>
                <h3 class="red">頑張って<?php echo $gamePt; ?>ポイント貯めると、<br>ゲームにチャレンジできます！！</h3>
            <?php } ?>
        </div>


        <script src="./asset/js/swiper.js"></script>
        <script>
            var swiper = new Swiper('.swiper-container', {
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: true
                },
                pagination: {
                    el: '.swiper-pagination',
                    type: 'bullets',
                    clickable: true,
                },
            });
        </script>
</body>

</html>