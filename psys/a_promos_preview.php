<?php

// セッション開始
session_start();
require('session.php');

// ログイン状態チェック
if (getSsnIsLogin()==false) {
    header('Location: a_logoff.php');
    exit;
}

// エラーメッセージの初期化
$errorMessage = '';

//$pSeq = $_POST['pSeq'];
$pSeq = $_GET['pSeq'];

require_once './db/promos.php';
$promo = getPromo($pSeq);

$html1 = '';
$html1 .= "<h1>".$promo->p_title>"aaa</h1>";
if (isset($promo->p_text1)) {
    $html1 .= "<h3>".nl2br($promo->p_text1)."</h3>";
}
if (isset($promo->p_text1)) {
    $html1 .= "<img class='img80' border=0 src='./".getSsn('PATH_PROMO')."/".$promo->p_seq."/".$promo->p_img."'>";
}
if (isset($promo->p_text2)) {
    $html1 .= "<h3>".nl2br($promo->p_text2)."</h3>";
}

require_once './db/prizes.php';
$prizes = getPrizes($promo->p_seq);
$html2 = '';
foreach ($prizes as $prize) {
    if (!empty($prize->pz_title)) {
        $html2 .= $prize->pz_title.'<br>';
    }
    if (!empty($prize->pz_img)) {
        $html2 .= "<img class='img80' border=0 src='./".getSsn('PATH_PROMO')."/".$promo->p_seq."/".$prize->pz_img."'><br>";
    }
    if (!empty($prize->p_img)) {
        $html2 .= nl2br($prize->pz_text).'<br>';
    }
    $html2 .= "<ul class='actions'>";
    $html2 .= "<li><a href='javascript:void(0)' class='button alt big'>この商品を希望する</a></li>";
    $html2 .= '</ul><hr>';
}

?>

<!DOCTYPE HTML>
<html lang="ja">

<head>
    <title><?php echo getSsnMyname(); ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="../psys_c/assets/css/main.css" />
    <link rel="stylesheet" href="../psys_c/asset/css/main.css" />
</head>

<body>
    <section id="banner">
        <div class="inner">
            <?php echo $html1; ?>
        </div>
    </section>

    <section id="banner3">
        <div class="inner">
            <?php echo $html2; ?>
        </div>
    </section>

</body>

</html>