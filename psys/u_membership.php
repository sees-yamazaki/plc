<?php

require('session.php');
require('logging.php');
require('db//members.php');

// セッション開始
session_start();
setMyName('psys_m');
setSsnCrntPage(__FILE__);

//遷移元の確認
// if(!checkPrev(__FILE__)){
//     setSsnMsg('Invalid transition');
//     header('Location: ./u_error.php');
// }

//メニュー内容
$menu_m_url="./asset/image/title_login.png";
$menu_m_click="location.href='u_login.php'";

// エラーメッセージの初期化
$errorMessage = '';

// 変数の初期化
$member = new cls_members();
$mSeq = $_POST['mSeq'];
if (empty($eSeq)) {
    $mSeq =0;
}

$m_name_ary = ['',''];
$m_kana_ary = ['',''];
if (isset($_POST['doEdit'])) {
    //if (getSsnPrevPage()==basename(__FILE__)) {
    $member->m_seq = $_POST['mSeq'];
    $m_name_ary[0] = $_POST['m_name_1'];
    $m_name_ary[1] = $_POST['m_name_2'];
    $m_kana_ary[0] = $_POST['m_kana_1'];
    $m_kana_ary[1] = $_POST['m_kana_2'];
    $member->m_name = $m_name_ary[0]." ".$m_name_ary[1];
    $member->m_kana = $m_kana_ary[0]." ".$m_kana_ary[1];
    $member->m_pw = $_POST['m_pw'];
    $member->m_pw2 = $_POST['m_pw2'];
    $member->m_mail = $_POST['m_mail'];
    $member->m_post = $_POST['m_post'];
    $member->m_address1 = $_POST['m_address1'];
    $member->m_address2 = $_POST['m_address2'];
    $member->m_tel = $_POST['m_tel'];
    
    if ($_POST['m_pw']<>$_POST['m_pw2']) {
        $errorMessage .= 'パスワードが一致しません。<br>';
    } else {
        if (preg_match('/\A(?=.*?[a-zA-Z])(?=.*?\d)[a-zA-Z\d]{8,12}+\z/i', $_POST['m_pw'])==0) {
            $errorMessage .= 'パスワードは<br>半角英数混合8～12文字で入力してください。<br>';
        }
    }
    if (empty($errorMessage)) {
        setSsnKV('prm_member', $member);
        header('Location: ./u_membershipe.php');
    }
} elseif (getSsnPrevPage()=="u_membershipe.php") {
    $member = getSsn('prm_member');
    $m_name_ary =  explode(' ', $member->m_name);
    $m_kana_ary =  explode(' ', $member->m_kana);
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

    <div id="premenu">
        <?php include('./u_top_menu.php'); ?>
    </div>


    <div id="precontents">
        <h3><br>会員情報登録</h3>
        <span>お名前、お電話番号は現在商品をお届け<br>している情報と同様にしてください。<br><br></span>
        <?php if (!empty($errorMessage)) { ?>
        <span class="err"><?php echo $errorMessage; ?></span>
        <?php } ?>
        <div name="editFrm" class="editFrm">
            <form action="" method="POST" name="frm">

                お名前<br>
                <input type="text" name="m_name_1" id="m_name_1" class="input-text " style="width: 40%;"
                    value="<?php echo $m_name_ary[0] ?>"
                    pattern="\S+" title="空白は使用できません" placeholder="富士" maxlength='10' required />
                <input type="text" name="m_name_2" id="m_name_2" class="input-text" style="width: 40%;"
                    value="<?php echo $m_name_ary[1] ?>"
                    pattern="\S+" title="空白は使用できません" placeholder="花子" maxlength='10' required /><br><br>
                フリガナ(全角カナ)<br>
                <input type="text" name="m_kana_1" id="m_kana_1" class="input-text" style="width: 40%;"
                    value="<?php echo $m_kana_ary[0] ?>"
                    pattern="[ァ-ヴー\s]+" title="カタカナ" placeholder="フジ" maxlength='10' required />
                <input type="text" name="m_kana_2" id="m_kana_2" class="input-text" style="width: 40%;"
                    value="<?php echo $m_kana_ary[1] ?>"
                    pattern="[ァ-ヴー\s]+" title="カタカナ" placeholder="ハナコ" maxlength='10' required /><br><br>
                パスワード<br>
                <input type="password" name="m_pw" id="m_pw" class="input-text w90p" value="" maxlength='10'
                    required /><br><br>
                <input type="password" name="m_pw2" id="m_pw2" class="input-text w90p" value="" maxlength='10'
                    placeholder="確認のため再度入力してください" required /><br><br>
                メールアドレス<br>
                <input type="text" name="m_mail" id="m_mail" class="input-text w90p"
                    value="<?php echo $member->m_mail ?>"
                    placeholder="メールアドレス" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required /><br><br>
                郵便番号(ハイフンなし)<br>
                <input type="text" name="m_post" id="m_post" class="input-text w90p"
                    value="<?php echo $member->m_post ?>"
                    placeholder="1234567" maxlength='7'
                    onKeyUp="AjaxZip3.zip2addr('m_post', '', 'm_address1', 'm_address1');" required /><br><br>
                住所<br>
                <input type="text" name="m_address1" id="m_address1" class="input-text w90p"
                    value="<?php echo $member->m_address1 ?>"
                    placeholder="" maxlength='50' required /><br><br>
                マンション名・部屋番号<br>
                <input type="text" name="m_address2" id="m_address2" class="input-text w90p"
                    value="<?php echo $member->m_address2 ?>"
                    placeholder="" maxlength='50' /><br><br>
                電話番号<br>
                <input type="text" name="m_tel" id="m_tel" class="input-text w90p"
                    value="<?php echo $member->m_tel ?>"
                    placeholder="000-0000-0000" maxlength='13' pattern="^[-0-9]+$" required /><br><br>

                <input type="submit" class="rButton w90p btn-red" value="登録する">
                <input type="hidden" name="mSeq"
                    value="<?php echo $mSeq ?>">
                <input type="hidden" name="doEdit">

            </form>
        </div>

    </div>

    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
</body>

</html>