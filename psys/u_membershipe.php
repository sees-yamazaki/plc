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
$menu_r_url="./asset/image/title_menu_off.png";
$menu_r_click="javascript:void(0);";

// エラーメッセージの初期化
$errorMessage = '';

// SESSIONより登録情報の取得
$member = getSsn('prm_member');

//登録するMAILを確認する
$cnt = checkMemberByMail( $member->m_seq, $member->m_mail );

if ($cnt<>0) {
    $errorMessage = 'このメールアドレスはすでに登録されています。<br>';
}

if (isset($_POST['doEdit'])) {
    //if (getSsnPrevPage()==basename(__FILE__)) {

    $member->m_id = strtotime("now");
    $member->m_pw = "999";

    insertMember($member);

    header("Location: ./u_membershiped.php");

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
    <form action='u_membership.php' method='POST' name="frmBack">
    </form>


    <?php include('./u_top_menu.php'); ?>


    <div id="contents">
        <h3><br>会員情報確認</h3>
        <?php if (empty($errorMessage)) { ?>
            <span class="err">下記内容で登録します。<br>登録内容を確認してください。<br><br></span>
        <?php }else{ ?>
            <span class="err"><?php echo $errorMessage; ?></span>
        <?php } ?>
        <div name="editFrm">
            <form action="" method="POST" name="frm">

                <span class="lightgrey">お名前</span><br><?php echo $member->m_name ?><br><br>
                <span class="lightgrey">メールアドレス</span><br><?php echo $member->m_mail ?><br><br>
                <span class="lightgrey">郵便番号(ハイフンなし)</span><br><?php echo $member->m_post ?><br><br>
                <span class="lightgrey">住所</span><br><?php echo $member->m_address1 ?><br><br>
                <span class="lightgrey">マンション名・部屋番号</span><br><?php echo $member->m_address2 ?><br><br>
                <span class="lightgrey">電話番号</span><br><?php echo $member->m_tel ?><br><br>


                <?php if (empty($errorMessage)) { ?>
                <input type="submit" class="rButton w80p btn-red" value="登録する"><br>
                <input type="hidden" name="doEdit">
                <?php } ?>
                <input type="button" class="rButton w80p btn-red-rev" onclick="javascript:frmBack.submit()"
                    value="戻る" />

            </form>
        </div>

    </div>

</body>

</html>