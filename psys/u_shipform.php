<?php

require('session.php');
require('logging.php');
require('db//ships.php');

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
$menu_m_url="./asset/image/title_mypage.png";
$menu_m_click="location.href='u_home.php'";

require_once './db/views.php';
$point = getPoint(getSsn("SEQ"));

// エラーメッセージの初期化
$errorMessage = '';

// 変数の初期化
$spSeq = $_POST['spSeq'];
$ship = new cls_ships();

if (isset($_POST['doEdit'])) {
    $ship->sp_seq = $_POST['spSeq'];
    $ship->sp_name = $_POST['sp_name'];
    $ship->sp_post = $_POST['sp_post'];
    $ship->sp_address1 = $_POST['sp_address1'];
    $ship->sp_address2 = $_POST['sp_address2'];
    $ship->sp_tel = $_POST['sp_tel'];
    $ship->sp_text = $_POST['sp_text'];

    setSsnKV('prm_ship', $ship);
    header('Location: ./u_shipforme.php');

}elseif(getSsnPrevPage()=="u_shipforme.php"){
    $ship = getSsn('prm_ship');
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

    <div id="menu">
        <?php include('./u_top_menu.php'); ?>
    </div>


    <div id="contents">
        <h3><br>発送先情報登録</h3>
        <?php if (!empty($errorMessage)) { ?>
        <span class="err"><?php echo $errorMessage; ?></span>
        <?php } ?>
        <div name="editFrm" class="editFrm">
            <form action="" method="POST" name="frm">

                お名前<br>
                <input type="text" name="sp_name" id="sp_name" class="input-text w90p"
                    value="<?php echo $ship->sp_name ?>" placeholder="富士　花子" maxlength='20' required /><br><br>
                郵便番号(ハイフンなし)<br>
                <input type="text" name="sp_post" id="sp_post" class="input-text w90p"
                    value="<?php echo $ship->sp_post ?>" placeholder="1234567" maxlength='7'
                    onKeyUp="AjaxZip3.zip2addr('sp_post', '', 'sp_address1', 'sp_address1');" required /><br><br>
                住所<br>
                <input type="text" name="sp_address1" id="sp_address1" class="input-text w90p"
                    value="<?php echo $ship->sp_address1 ?>" placeholder="" maxlength='50' required /><br><br>
                マンション名・部屋番号<br>
                <input type="text" name="sp_address2" id="sp_address2" class="input-text w90p"
                    value="<?php echo $ship->sp_address2 ?>" placeholder="" maxlength='50' /><br><br>
                電話番号<br>
                <input type="text" name="sp_tel" id="sp_tel" class="input-text w90p" value="<?php echo $ship->sp_tel ?>"
                    placeholder="000-0000-0000" maxlength='13' pattern="^[-0-9]+$" required /><br><br>
                    備考<br>
                    <textarea name="sp_text" id="sp_text" class="input-text w90p" placeholder=""
                        rows="6"><?php echo $ship->sp_text ?></textarea>

                <input type="submit" class="rButton w90p btn-red" value="登録する">
                <input type="hidden" name="spSeq" value="<?php echo $spSeq; ?>">
                <input type="hidden" name="doEdit">

            </form>
        </div>

    </div>

    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
</body>

</html>