<?php

require('session.php');
require('logging.php');

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
            $html2 .= "<img class='w90p' border=0 src='./". getSsn('PATH_PROMO')."/".$pSeq.'/'.$prize->pz_img."'><br>";
        }
        $html2 .= "<div class='entryBtn'><input type='button' onclick='javascript:choise(".$prize->pz_seq.")' value='".$prize->pz_title."に応募' /></div>";
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

    <div id="menu">
        <?php include('./u_top_menu.php'); ?>
    </div>


    <div id="contents">

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