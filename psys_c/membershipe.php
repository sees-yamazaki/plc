<?php

// セッション開始
session_start();
require('session.php');

// エラーメッセージの初期化
$errorMessage = "";

    require_once './db/members.php';
    $member = new cls_members();

    $cnt = checkMemberByMail($_POST['m_mail']);

    if($cnt<>0){
        $errorMessage = 'このメールアドレスはすでに登録されています。';
    }

    try {
        $member->m_name = $_POST['m_name'];
        $member->m_mail = $_POST['m_mail'];
        $member->m_post = str_replace("-","",$_POST['m_post']);
        $member->m_address1 = $_POST['m_address1'];
        $member->m_address2 = $_POST['m_address2'];
		$member->m_tel = $_POST['m_tel'];
        
        if (isset($_POST['mmbrEdit'])) {

            $member->m_id = strtotime("now");
            $member->m_pw = "999";

            $errorMessage = insertMember($member);

            if (empty($errorMessage)) {
                header("Location: ./membershiped.php");
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

    <!-- Header -->
    <header id="header">
        <a href="javascript:void(0)" class="logo"><strong><?php echo getSsnMyname(); ?></strong> by SEES</a>
    </header>


    <!-- Banner -->
    <?php if(!empty($errorMessage)){ ?>
    <section id="banner8" class="err">
        <div class="inner">
            <h3><?php echo $errorMessage; ?></h3>
        </div>
    </section>
    <?php } ?>

    <section id="banner">

        <form action='' method='POST' name="frm">
            <input type="hidden" name="m_name" id="m_name" value="<?php echo $member->m_name ?>" />
            <input type="hidden" name="m_mail" id="m_mail" value="<?php echo $member->m_mail ?>" />
            <input type="hidden" name="m_post" id="m_post" value="<?php echo $member->m_post ?>" />
            <input type="hidden" name="m_address1" id="m_address1" value="<?php echo $member->m_address1 ?>" />
            <input type="hidden" name="m_address2" id="m_address2" value="<?php echo $member->m_address2 ?>" />
            <input type="hidden" name="m_tel" id="m_tel" value="<?php echo $member->m_tel ?>" />
            <input type="hidden" name="mmbrEdit" value="1" />
        </form>
        <form action='membership.php' method='POST' name="frm2">
            <input type="hidden" name="m_name" id="m_name" value="<?php echo $member->m_name ?>" />
            <input type="hidden" name="m_mail" id="m_mail" value="<?php echo $member->m_mail ?>" />
            <input type="hidden" name="m_post" id="m_post" value="<?php echo $member->m_post ?>" />
            <input type="hidden" name="m_address1" id="m_address1" value="<?php echo $member->m_address1 ?>" />
            <input type="hidden" name="m_address2" id="m_address2" value="<?php echo $member->m_address2 ?>" />
            <input type="hidden" name="m_tel" id="m_tel" value="<?php echo $member->m_tel ?>" />
        </form>

        <div class="inner">
            <h1>会員情報の確認</h1>
            <form action="" method="POST" onsubmit="return addcheck()" name="editFrm">
                <div class="">
                    <h3>
                        お名前：<?php echo $member->m_name ?><br>
                        MAIL：<?php echo $member->m_mail ?><br>
                        郵便番号：<?php echo $member->m_post ?><br>
                        住所：<?php echo $member->m_address1 ?>&nbsp;<?php echo $member->m_address2 ?><br>
                        電話番号：<?php echo $member->m_tel ?>
                    </h3>
                </div><br>
                <?php if(empty($errorMessage)){ ?>
                <ul class="actions">
                    <li><a href="javascript:actn(1)" class="button alt scrolly big">登録する</a></li>
                </ul>
                <?php } ?>
                <ul class="actions">
                    <li><a href="javascript:actn(2)" class="button special scrolly big">戻る</a></li>
                </ul>

            </form>

        </div>
    </section>

    <section id="banner2">
        <div class="inner">
            <h1><a href="javascript:void(0)">個人情報など</a></h1>
        </div>
    </section>


    <!-- Footer -->
    <footer id="footer">
        <div class="copyright">
            &copy; SEES
        </div>
    </footer>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.scrolly.min.js"></script>
    <script src="assets/js/skel.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="asset/js/main.js"></script>

</body>

</html>