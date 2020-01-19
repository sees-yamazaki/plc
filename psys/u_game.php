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
$gSeq = $_POST['gSeq'];
$pzSeq = $_POST['pzSeq'];


require_once './db/games.php';
$game = getGame($gSeq);

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

    <form action='u_gamed.php' method='POST' name="frm">
        <input type='hidden' name='pSeq'
            value='<?php echo $pSeq; ?>'>
        <input type='hidden' name='pzSeq'
            value='<?php echo $pzSeq; ?>'>
        <input type='hidden' name='gSeq'
            value='<?php echo $gSeq; ?>'>
    </form>

    <?php include('./u_menu.php'); ?>


    <div id="contents">
        <?php include('./u_point.php'); ?>
            <a href="javascript:doGame()">
        <img border=0 class="w100p" src="./<?php echo getSsn('PATH_GAME'); ?>/<?php echo $game->g_seq; ?>/<?php echo $game->g_image_start; ?>"></a>
    </div>
</body>

</html>