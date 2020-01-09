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
$errorMessage = "";


$upSeq = $_POST['upSeq'];

    require_once '../psys/db/ships.php';
    $ship = new cls_ships();

    try {
        if (isset($_POST['shipEdit'])) {
            $ship->up_seq = $_POST['upSeq'];
            $ship->sp_name = $_POST['sp_name'];
            $ship->sp_post = $_POST['sp_post'];
            $ship->sp_address1 = $_POST['sp_address1'];
            $ship->sp_address2 = $_POST['sp_address2'];
            $ship->sp_tel = $_POST['sp_tel'];
            $ship->sp_text = $_POST['sp_text'];
        } else {
            require_once '../psys/db/members.php';
            $member = new cls_members();
            $member = getMember(getSsn("SEQ"));

            $ship->sp_name = $member->m_name;
            $ship->sp_post = $member->m_post;
            $ship->sp_address1 = $member->m_address1;
            $ship->sp_address2 = $member->m_address2;
            $ship->sp_tel = $member->m_tel;
            $ship->sp_text = "";
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


    <section id="banner">
        <div class="inner">
            <h1>発送先情報</h1>
            <form action="shipforme.php" method="POST" name="editFrm">
                <div class="">
                    お名前
                    <input type="text" name="sp_name" id="sp_name" value="<?php echo $ship->sp_name ?>"
                    placeholder="name" maxlength='20'  required />
                        郵便番号(ハイフン無し)
                    <input type="text" name="sp_post" id="sp_post" value="<?php echo $ship->sp_post ?>"
                        placeholder="postcode" maxlength='7'  onKeyUp="AjaxZip3.zip2addr('sp_post', '', 'sp_address1', 'sp_address1');"/>
                    住所
                    <input type="text" name="sp_address1" id="sp_address1" value="<?php echo $ship->sp_address1 ?>"
                        placeholder="address" maxlength='50'  required />
                    <input type="text" name="sp_address2" id="sp_address2" value="<?php echo $ship->sp_address2 ?>"
                        placeholder="address" maxlength='50'  />
                    電話番号
                    <input type="text" name="sp_tel" id="sp_tel" value="<?php echo $ship->sp_tel ?>" placeholder="tel" maxlength='13' pattern="^[-0-9]+$" required />
                    備考
                    <textarea name="sp_text" id="sp_text" placeholder="Enter your message"
                        rows="6"><?php echo $ship->sp_text ?></textarea>
                </div><br>
                <ul class="actions">
                    <li><a href="javascript:editFrm.submit()" class="button alt scrolly big">登録する</a></li>
                </ul>
                <input type="hidden" name="upSeq" value="<?php echo $upSeq; ?>">
            </form>

        </div>
    </section>




    <?php include('./footer.php'); ?>
    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>

</body>

</html>