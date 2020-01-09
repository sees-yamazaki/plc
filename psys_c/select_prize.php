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
$errorMessage = '';

require_once '../psys/db/promos.php';
$promo = getOpenPromo();
$html1 = '';
if ($promo->p_seq==0) {
    $html1 .= '<h2>ただいま、キャンペーンは実施されていません。</h2>';
} else {
    $html1 .= "<h1>".$promo->p_title>"aaa</h1>";
    if (isset($promo->p_text1)) {
        $html1 .= "<h3>".nl2br($promo->p_text1)."</h3>";
    }
    if (isset($promo->p_text1)) {
        $html1 .= "<img class='img80' border=0 src='../psys/". getSsn('PATH_PROMO')."/".$promo->p_seq."/".$promo->p_img."'>";
    }
    if (isset($promo->p_text2)) {
        $html1 .= "<h3>".nl2br($promo->p_text2)."</h3>";
    }
}

require_once './db/prizes.php';
$prizes = getPrizes($promo->p_seq);
$html2 = '';
foreach ($prizes as $prize) {
    if (!empty($prize->pz_title)) {
        $html2 .= $prize->pz_title.'<br>';
    }
    if (!empty($prize->pz_img)) {
        $html2 .= "<img class='img80' border=0 src='../psys/". getSsn('PATH_PROMO')."/".$promo->p_seq.'/'.$prize->pz_img."'><br>";
    }
    if (!empty($prize->p_img)) {
        $html2 .= nl2br($prize->pz_text).'<br>';
    }
    $html2 .= "<ul class='actions'>";
    $html2 .= "<li><a href='javascript:choise(".$prize->pz_seq.")' class='button alt big'>この商品を希望する</a></li>";
    $html2 .= '</ul><hr>';
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
    function choise(vlu) {
        document.frm.pzSeq.value = vlu;
        document.frm.submit();
    }
    </script>
</head>

<body>


    <?php include './menu.php'; ?>

    <!-- Banner -->
    <?php if (!empty($errorMessage)) {
    ?>
    <section id="banner2">
        <div class="inner">
            <h3><?php echo $errorMessage; ?></h3>
        </div>
    </section>
    <?php
} ?>

    <section id="banner9">
        <div class="inner">
            <ul class="actions actions2">
                <li><a href="home.php" class="button alt scrolly big">戻る</a></li>
            </ul>
        </div>
    </section>

    <section id="banner">

        <form action='game.php' method='POST' name="frm">
            <input type='hidden' name='pSeq' value='<?php echo $promo->p_seq; ?>'>
            <input type='hidden' name='gSeq' value='<?php echo $promo->g_seq; ?>'>
            <input type='hidden' name='pzSeq' value=''>
        </form>

        <div class="inner">
            <?php echo $html1; ?>
        </div>
    </section>

    <section id="banner3">
        <div class="inner">
            <?php echo $html2; ?>
        </div>
    </section>


    <?php include './footer.php'; ?>

</body>

</html>