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

$pw1 = $_POST['pw1'];
$pw2 = $_POST['pw2'];


    require_once './db/serialcodes.php';
    $scode = new cls_serialcodes();

    try {
        if (isset($_POST['pwChange'])) {
            if (empty($pw1) || empty($pw2)) {
                $errorMessage = 'パスワードが入力されていません。';
            } elseif ($pw1<>$pw2) {
                $errorMessage = 'パスワードが一致しません。';
            } else {
                updatePw($_SESSION[$ini['sysname']."SEQ"], $pw1);
            }
            
            if (empty($errorMessage)) {
                header("Location: ./pointentried.php?addPt=".$scode->sc_point);
            }
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (strcmp("1", $ini['debug'])==0) {
            echo $e->getMessage();
        }
    }

?>
<!DOCTYPE HTML>
<html lang="ja">

<head>
    <title><?php echo $ini['sysname']; ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="asset/css/main.css" />
</head>

<body>


    <?php include('./menu.php'); ?>


    <?php if (!empty($errorMessage)) { ?>
    <section id="banner2">
        <div class="inner">
            <h3><?php echo $errorMessage; ?></h3>
        </div>
    </section>
    <?php } ?>

    <section id="banner9">
        <div class="inner">
            <ul class="actions actions2">
                <li><a href="home.php" class="button alt scrolly big">戻る</a></li>
            </ul>
        </div>
    </section>

    <section id="banner">
        <div class="inner">
            <h1>パスワード変更</h1>
            <form action="" method="POST" name="editFrm">
                <div class="">
                    新しいパスワードを入力してください
                    <input type="password" name="pw1" id="pw1" value=""
                        placeholder="新しいパスワード" required />
                        <input type="password" name="pw2" id="pw2" value=""
                        placeholder="確認用" required />
                </div><br>
                <ul class="actions">
                    <li><a href="javascript:editFrm.submit()" class="button alt scrolly big">更新する</a></li>
                </ul>
                <input type="hidden" name="pwChange" value="1">

            </form>

        </div>
    </section>

    <?php include('./footer.php'); ?>


</body>

</html>