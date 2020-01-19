<?php

// セッション開始
session_start();
require('session.php');
setMyName('psys_m');
require('logging.php');

// エラーメッセージの初期化
$errorMessage = '';


$pSeq = $_POST['pSeq'];
$gSeq = $_POST['gSeq'];
$pzSeq = $_POST['pzSeq'];



require_once './db/games.php';
$game = getGame($gSeq);

$gameResult = "残念！！";
$resultImg = "./".getSsn('PATH_GAME')."/".$game->g_seq."/".$game->g_image_miss;


require './db/usepoints.php';
$usepoint = new cls_usepoints();
$usepoint->m_seq = getSsn("SEQ");
$usepoint->up_point = getSsn('POINT_GAME');
$usepoint->up_status = 0;
$usepoint->g_seq = $gSeq;
$usepoint->p_seq = $pSeq;
$usepoint->pz_seq = $pzSeq;
$result = "miss";


require_once './db/prizes.php';
$prize = countupPrize($pzSeq);
$hitcnts = explode(",",$prize->pz_hitcnt);
if (in_array($prize->pz_nowcnt,$hitcnts )) {
     $gameResult = "WINNER！！";
     $resultImg = "./".getSsn('PATH_GAME')."/".$game->g_seq."/".$game->g_image_hit;

     $usepoint->up_status = 1;
     $result = "hit";
     
    require_once './db/members.php';
    $member = getMember(getSsn("SEQ"));

    require_once './db/ships.php';
    $ship = new cls_ships();
    $ship->m_seq = getSsn("SEQ");
    $ship->up_seq = getSsn("SEQ");
    $ship->sp_name = $member->m_name;
    $ship->sp_post = $member->m_post;
    $ship->sp_address1 = $member->m_address1;
    $ship->sp_address2 = $member->m_address2;
    $ship->sp_tel = $member->m_tel;
    $ship->sp_text = "";
    insertShip($ship);
}
 
$upSeq = insertUsepoints($usepoint);


require_once './db/views.php';
$point = getPoint(getSsn("SEQ"));

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
        function doResult() {
            document.frm.submit();
        }
    </script>
</head>

<body onLoad='setTimeout("doResult()",3000)'>

    <form action='u_gamed_result.php' method='POST' name="frm">
        <input type='hidden' name='pSeq'
            value='<?php echo $pSeq; ?>'>
        <input type='hidden' name='pzSeq'
            value='<?php echo $pzSeq; ?>'>
        <input type='hidden' name='result'
            value='<?php echo $result; ?>'>
    </form>

    <?php include('./u_menu.php'); ?>


    <div id="contents">
        <?php include('./u_point.php'); ?>
            <a href="javascript:doResult()">
        <img border=0 class="w100p" src="<?php echo $resultImg; ?>"></a>
    </div>
</body>

</html>