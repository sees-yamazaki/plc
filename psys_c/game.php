<?php

// セッション開始
session_start();

$ini = $_SESSION['INI'];

// ログイン状態チェック
if (!isset($_SESSION[$ini['sysname']."SEQ"])) {
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
    function choise() {
        document.frm.submit();
    }
    </script>
</head>

<body>


    <?php include('./menu.php'); ?>

    <!-- Banner -->
    <?php if(!empty($errorMessage)){ ?>
    <section id="banner2">
        <div class="inner">
            <h3><?php echo $errorMessage; ?></h3>
        </div>
    </section>
    <?php } ?>

    <section id="banner9">
        <div class="inner">
            <ul class="actions actions2">
                <li><a href="select_prize.php" class="button alt scrolly big">戻る</a></li>
            </ul>
        </div>
    </section>

    <section id="banner">

        <form action='gamed.php' method='POST' name="frm">
            <input type='hidden' name='pSeq' value='<?php echo $pSeq; ?>'>
            <input type='hidden' name='gSeq' value='<?php echo $gSeq; ?>'>
            <input type='hidden' name='pzSeq' value='<?php echo $pzSeq; ?>'>
        </form>

        <div class="inner">
            <h1>画像をタップ！！</h1>
            <br>
            <a href="javascript:choise()">
            <img border=0 class="img100" src="<?php echo $ini['parentURL']; ?>/games/<?php echo $game->g_seq; ?>/<?php echo $game->g_image_start; ?>"></a>
        </div>
    </section>



    <?php include('./footer.php'); ?>

</body>

</html>