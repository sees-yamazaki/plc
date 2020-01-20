<?php

require('session.php');
require('logging.php');
require('db//members.php');

// セッション開始
session_start();
setMyName('psys_m');
setSsnCrntPage(__FILE__);

//遷移元の確認
if(!checkPrev(__FILE__)){
    setSsnMsg('Invalid transition');
    header('Location: ./u_error.php');
}

//メニュー内容
$menu_m_url="./asset/image/title_login.png";
$menu_m_click="location.href='u_login.php'";
$menu_r_url="./asset/image/title_menu.png";
$menu_r_click="location.href='u_info.php'";

// エラーメッセージの初期化
$errorMessage = '';

// 変数の初期化
$member = new cls_members();
$mSeq = $_POST['mSeq'];
if(empty($eSeq)){
    $mSeq =0;
}

if (isset($_POST['doEdit'])) {
//if (getSsnPrevPage()==basename(__FILE__)) {
    $member->m_seq = $_POST['mSeq'];
    $member->m_name = $_POST['m_name'];
    $member->m_mail = $_POST['m_mail'];
    $member->m_post = $_POST['m_post'];
    $member->m_address1 = $_POST['m_address1'];
    $member->m_address2 = $_POST['m_address2'];
    $member->m_tel = $_POST['m_tel'];

    setSsnKV('prm_member', $member);
    header('Location: ./u_membershipe.php');

}elseif(getSsnPrevPage()=="u_membershipe.php"){
    $member = getSsn('prm_member');
} else {
    //
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
</head>

<body>

    <?php include('./u_top_menu.php'); ?>


    <div id="contents">
        <h3><br>会員情報登録</h3>
        <span class="err">お名前、お電話番号は現在商品をお届け<br>している情報と同様にしてください。</span>
        <?php if (!empty($errorMessage)) { ?>
        <span class="err"><?php echo $errorMessage; ?></span>
        <?php } ?>
        <div name="editFrm">
            <form action="" method="POST" name="frm">

                お名前<br>
                <input type="text" name="m_name" id="m_name" class="input-text w80p"
                    value="<?php echo $member->m_name ?>" placeholder="富士　花子" maxlength='20' required /><br><br>
                メールアドレス<br>
                <input type="text" name="m_mail" id="m_mail" class="input-text w80p"
                    value="<?php echo $member->m_mail ?>" placeholder="メールアドレス"
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required /><br><br>
                郵便番号(ハイフンなし)<br>
                <input type="text" name="m_post" id="m_post" class="input-text w80p"
                    value="<?php echo $member->m_post ?>" placeholder="1234567" maxlength='7'
                    onKeyUp="AjaxZip3.zip2addr('m_post', '', 'm_address1', 'm_address1');" required /><br><br>
                住所<br>
                <input type="text" name="m_address1" id="m_address1" class="input-text w80p"
                    value="<?php echo $member->m_address1 ?>" placeholder="" maxlength='50' required /><br><br>
                マンション名・部屋番号<br>
                <input type="text" name="m_address2" id="m_address2" class="input-text w80p"
                    value="<?php echo $member->m_address2 ?>" placeholder="" maxlength='50' /><br><br>
                電話番号<br>
                <input type="text" name="m_tel" id="m_tel" class="input-text w80p" value="<?php echo $member->m_tel ?>"
                    placeholder="000-0000-0000" maxlength='13' pattern="^[-0-9]+$" required /><br><br>

                <input type="submit" class="rButton w80p btn-red" value="登録する">
                <input type="hidden" name="mSeq" value="<?php echo $mSeq ?>">
                <input type="hidden" name="doEdit">

            </form>
        </div>

    </div>

    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
</body>

</html>