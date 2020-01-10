<?php

// セッション開始
session_start();
require('session.php');
setSsnCrntPage(basename(__FILE__));
require('../psys/logging.php');

// ログイン状態チェック
if (getSsnIsLogin()==false) {
    header("Location: logoff.php");
    exit;
}

// エラーメッセージの初期化
$errorMessage = "";

$pSeq = $_POST['pSeq'];
$gSeq = $_POST['gSeq'];
$pzSeq = $_POST['pzSeq'];


require_once './db/games.php';
$game = getGame($gSeq);

$gameResult = "残念！！";
$resultImg = "../psys/".getSsn('PATH_GAME')."/".$game->g_seq."/".$game->g_image_miss;


require '../psys/db/usepoints.php';
$usepoint = new cls_usepoints();
$usepoint->m_seq = getSsn("SEQ");
$usepoint->up_point = getSsn('POINT_GAME');;
$usepoint->up_status = 0;
$usepoint->g_seq = $gSeq;
$usepoint->p_seq = $pSeq;
$usepoint->pz_seq = $pzSeq;


require_once './db/prizes.php';
$prize = countupPrize($pzSeq);
$hitcnts = explode(",",$prize->pz_hitcnt);
 if (in_array($prize->pz_nowcnt,$hitcnts )) {
     $gameResult = "WINNER！！";
     $resultImg = "../psys/".getSsn('PATH_GAME')."/".$game->g_seq."/".$game->g_image_hit;

     $usepoint->up_status = 1;
 }
 
$upSeq = insertUsepoints($usepoint);



?>

<!DOCTYPE HTML>
<html lang="ja">

<head>
    <title><?php echo $ini['sysname']; ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="asset/css/main.css" />
    <script>
    function ship() {
        document.frm.submit();
    }
    </script>
</head>

<body>


    <?php include('./menu.php'); ?>

    <section id="banner9">
        <div class="inner">
            <ul class="actions actions2">
                <li><a href="home.php" class="button alt scrolly big">戻る</a></li>
            </ul>
        </div>
    </section>

    <section id="banner">

        <form action='shipform.php' method='POST' name="frm">
            <input type='hidden' name='upSeq' value='<?php echo $upSeq; ?>'>
        </form>

        <div class="inner">
            <h1><?php echo $gameResult; ?></h1>
            <br>
            <img border=0 class="img100" src="<?php echo $resultImg; ?>">
            <?php if (in_array($prize->pz_nowcnt,$hitcnts )) {?>
                <br>
            <ul class="actions">
                <li><a href="javascript:ship();" class="button alt scrolly big">発送依頼する</a></li>
            </ul>
            <?php } ?>

        </div>
    </section>



    <?php include('./footer.php'); ?>

</body>

</html>