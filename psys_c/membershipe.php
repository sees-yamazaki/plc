<?php

require('session.php');
require('../psys/logging.php');
require('../psys/db/members.php');

// セッション開始
session_start();
setSsnCrntPage(__FILE__);

//遷移元の確認
if(!checkPrev(__FILE__)){
    setSsnMsg('Invalid transition');
    header('Location: ./error.php');
}

// エラーメッセージの初期化
$errorMessage = "";

$member = getSsn('prm_member');

//$cnt = checkMemberByMail($_POST['m_mail']);
$cnt = checkMemberByMail($member->m_mail );

if ($cnt<>0) {
    $errorMessage = 'このメールアドレスはすでに登録されています。';
}

//if (isset($_POST['mmbrEdit'])) {
if (getSsnPrevPage()==basename(__FILE__)) {

    $member->m_id = strtotime("now");
    $member->m_pw = "999";

    insertMember($member);

    header("Location: ./membershiped.php");

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
        <a href="javascript:void(0)" class="logo"><strong><?php echo getSsnMyname(); ?></strong> by itty</a>
    </header>


    <!-- Banner -->
    <?php if (!empty($errorMessage)) { ?>
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
                <?php if (empty($errorMessage)) { ?>
                <ul class="actions">
                    <li><a href="" class="button alt scrolly big">登録する</a></li>
                </ul>
                <?php } ?>
                <ul class="actions">
                    <li><a href="membership.php" class="button special scrolly big">戻る</a></li>
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
            &copy; itty
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