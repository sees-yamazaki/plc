<?php

// セッション開始
session_start();
require('session.php');


// ログイン状態チェック
if (getSsnIsLogin()==false) {
    header("Location: logoff.php");
    exit;
}

// エラーメッセージの初期化
$errorMessage = "";


$upSeq = $_POST['upSeq'];

require_once './db/ships.php';
$ship = new cls_ships();

    try {
        $ship->up_seq = $_POST['upSeq'];
        $ship->sp_name = $_POST['sp_name'];
        $ship->sp_post = $_POST['sp_post'];
        $ship->sp_address1 = $_POST['sp_address1'];
        $ship->sp_address2 = $_POST['sp_address2'];
        $ship->sp_tel = $_POST['sp_tel'];
        $ship->sp_text = $_POST['sp_text'];
        
        if (isset($_POST['shipEdit'])) {
            $ship->m_seq = getSsn("SEQ");

            insertShip($ship);

            if (empty($errorMessage)) {
                header("Location: ./shipformed.php");
            }
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (getSsnIsDebug()) {
            echo $e->getMessage();
        }
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
    function actn(vlu) {
        if (vlu == 1) {
            document.frm.submit();
        } else {
            document.frm2.submit();
        }
    }
    </script>
</head>

<body>

<?php include('./menu.php'); ?>

    <!-- Banner -->
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
                <li><a href="javascript:actn(2)" class="button alt scrolly big">戻る</a></li>
            </ul>
        </div>
    </section>


    <section id="banner">

        <form action='' method='POST' name="frm">
            <input type="hidden" name="upSeq" id="upSeq" value="<?php echo $upSeq ?>" />
            <input type="hidden" name="sp_name" id="sp_name" value="<?php echo $ship->sp_name ?>" />
            <input type="hidden" name="sp_post" id="sp_post" value="<?php echo $ship->sp_post ?>" />
            <input type="hidden" name="sp_address1" id="sp_address1" value="<?php echo $ship->sp_address1 ?>" />
            <input type="hidden" name="sp_address2" id="sp_address2" value="<?php echo $ship->sp_address2 ?>" />
            <input type="hidden" name="sp_tel" id="sp_tel" value="<?php echo $ship->sp_tel ?>" />
            <input type="hidden" name="sp_text" id="sp_text" value="<?php echo $ship->sp_text ?>" />
            <input type="hidden" name="shipEdit" value="1" />
        </form>
        <form action='shipform.php' method='POST' name="frm2">
            <input type="hidden" name="upSeq" id="upSeq" value="<?php echo $upSeq ?>" />
            <input type="hidden" name="sp_name" id="sp_name" value="<?php echo $ship->sp_name ?>" />
            <input type="hidden" name="sp_post" id="sp_post" value="<?php echo $ship->sp_post ?>" />
            <input type="hidden" name="sp_address1" id="sp_address1" value="<?php echo $ship->sp_address1 ?>" />
            <input type="hidden" name="sp_address2" id="sp_address2" value="<?php echo $ship->sp_address2 ?>" />
            <input type="hidden" name="sp_tel" id="sp_tel" value="<?php echo $ship->sp_tel ?>" />
            <input type="hidden" name="sp_text" id="sp_text" value="<?php echo $ship->sp_text ?>" />
            <input type="hidden" name="shipEdit" value="1" />
        </form>

        <div class="inner">
            <h1>会員情報の確認</h1>
            <form action="" method="POST" onsubmit="return addcheck()" name="editFrm">
                <div class="">
                    <h3>
                        お名前：<?php echo $ship->sp_name ?><br>
                        郵便番号：<?php echo $ship->sp_post ?><br>
                        住所：<?php echo $ship->sp_address1 ?>&nbsp;<?php echo $ship->sp_address2 ?><br>
                        電話番号：<?php echo $ship->sp_tel ?><br>
                        備考：<?php echo $ship->sp_text ?>
                    </h3>
                </div><br>
                <ul class="actions">
                    <li><a href="javascript:actn(1)" class="button alt scrolly big">登録する</a></li>
                </ul>

            </form>

        </div>
    </section>




    <?php include('./footer.php'); ?>

</body>

</html>