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

require_once './db/prizes.php';
$prizes = getPrizes($pSeq);
$html2 = '';
foreach ($prizes as $prize) {
    if ($prize->pz_kind=="0") {
        $html2 .= '<div class="rDiv w80p">';
        if (!empty($prize->pz_title)) {
            $html2 .= '<div class="rDivTitle">'.$prize->pz_title.'に応募する</div>';
        }
        if (!empty($prize->pz_img)) {
            $html2 .= "<img class='w80p' border=0 src='./". getSsn('PATH_PROMO')."/".$pSeq.'/'.$prize->pz_img."'><br>";
        }
        $html2 .= "<input type='button' class='rButton w80p f1rem btn-red' onclick='javascript:choise(".$prize->pz_seq.")' value='この商品を希望する' />";
        $html2 .= '</div>';
    }
}

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
        function choise(vlu) {
            document.frm.pzSeq.value = vlu;
            document.frm.submit();
        }
    </script>
</head>

<body>

    <form action='u_selected_prize.php' method='POST' name="frm">
        <input type='hidden' name='pSeq'
            value='<?php echo $pSeq; ?>'>
        <input type='hidden' name='pzSeq' value=''>
    </form>

    <?php include('./u_menu.php'); ?>


    <div id="contents">
        <?php include('./u_point.php'); ?>

        <h3><br>商品を選択</h3>
        <?php if (!empty($errorMessage)) { ?>
        <div class="info w80p"><?php echo $errorMessage; ?>
        </div>
        <?php } ?>

        <form action="" method="POST" name="editFrm">
            <?php echo $html2; ?>
        </form>

</body>

</html>