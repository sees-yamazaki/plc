<?php

// セッション開始
session_start();
require('session.php');
require('logging.php');

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

// ログイン状態チェック
if (getSsnIsLogin()==false) {
    header("Location: a_logoff.php");
    exit;
}

// エラーメッセージの初期化
$errorMessage = "";




$m_name_ary = ['',''];
$m_kana_ary = ['',''];

$mSeq = $_POST['mSeq'];

require './db/members.php';
$member = new cls_members();

if (isset($_POST['mmbrEdit'])) {
    $member->m_seq = $_POST['mSeq'];
    $m_name_ary[0] = $_POST['m_name_1'];
    $m_name_ary[1] = $_POST['m_name_2'];
    $m_kana_ary[0] = $_POST['m_kana_1'];
    $m_kana_ary[1] = $_POST['m_kana_2'];
    $member->m_name = $m_name_ary[0]." ".$m_name_ary[1];
    $member->m_kana = $m_kana_ary[0]." ".$m_kana_ary[1];
    $member->m_mail = $_POST['m_mail'];
    $member->m_post = $_POST['m_post'];
    $member->m_address1 = $_POST['m_address1'];
    $member->m_address2 = $_POST['m_address2'];
    $member->m_tel = $_POST['m_tel'];

    $tmp =getMemberByMail($member->m_mail);
    if ($tmp->m_seq<>0 && $tmp->m_seq<>$mSeq) {
        $errorMessage = 'このMAILはすでに登録されています';
    } else {
        updateMember($member);
    }

    if (empty($errorMessage)) {
        header("Location: ./a_members_view.php?mSeq=".$mSeq);
    }
} else {
    $member = getMember($mSeq);
    $m_name_ary =  explode(' ', $member->m_name);
    $m_kana_ary =  explode(' ', $member->m_kana);
}


?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo getSsnMyname(); ?>
    </title>
    <link rel="stylesheet" href="./assets/vendors/iconfonts/mdi/css/materialdesignicons.css">
    <link rel="stylesheet" href="./assets/css/shared/style.css">
    <link rel="stylesheet" href="./assets/css/demo_1/style.css">
    <link rel="shortcut icon" href="./assets/images/favicon.ico" />
    <link rel="stylesheet" href="./asset/css/main.css">
    <script src="./asset/js/main.js"></script>
    <script>
        function back(vlu) {
            document.frm.mSeq.value = vlu;
            document.frm.submit();
        }
    </script>
</head>

<body class="header-fixed">
    <form action='a_members_view.php' method='POST' name="frm">
        <input type='hidden' name='mSeq' value=''>
        <input type='hidden' name='back'>
    </form>

    <?php include('./a_menu.php'); ?>

    <div class="page-content-wrapper">
        <div class="page-content-wrapper-inner">
            <div class="content-viewport">


                <div class="col-lg-12">
                    <div class="grid">
                        <div class="grid-body">
                            <div class="item-wrapper">
                                <div class="row mb-3">
                                    <div class="col-md-8 mx-auto">
                                        <button type="button" class="btn btn-inverse-info"
                                            onclick="back(<?php echo $member->m_seq; ?>)">＜＜戻る</button>
                                        <br><br>

                                        <p class="grid-header">会員情報編集</p>

                                        <form action="" method="POST" onsubmit="return addcheck()">

                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">名前</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="text" class="form-control" style="width:40%; float:left;" name="m_name_1"
                                                        value="<?php echo $m_name_ary[0]; ?>"
                                                        pattern="\S+" title="空白は使用できません" placeholder="10文字まで" maxLength=10 autocomplete="off" required>
                                                    <input type="text" class="form-control " style="width:40%; float:left;margin-left:10pt;"  name="m_name_2"
                                                        value="<?php echo $m_name_ary[1]; ?>"
                                                        pattern="\S+" title="空白は使用できません" placeholder="10文字まで" maxLength=10 autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">フリガナ</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="text" class="form-control" style="width:40%; float:left;" name="m_kana_1"
                                                        value="<?php echo $m_kana_ary[0]; ?>"
                                                        pattern="\S+" title="空白は使用できません" placeholder="10文字まで" maxLength=10 autocomplete="off" required>
                                                    <input type="text" class="form-control" style="width:40%; float:left;margin-left:10pt;" name="m_kana_2"
                                                        value="<?php echo $m_kana_ary[1]; ?>"
                                                        pattern="\S+" title="空白は使用できません" placeholder="10文字まで" maxLength=10 autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">MAIL</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="text" name="m_mail" id="m_mail" class="form-control"
                                                        value="<?php echo $member->m_mail ?>"
                                                        placeholder="e-mail"
                                                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required />
                                                </div>
                                            </div>
                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">郵便番号(ハイフン無し)</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="text" name="m_post" id="m_post" class="form-control"
                                                        value="<?php echo $member->m_post ?>"
                                                        placeholder="postcode" maxlength='7'
                                                        onKeyUp="AjaxZip3.zip2addr('m_post', '', 'm_address1', 'm_address1');"
                                                        required />
                                                </div>
                                            </div>
                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">住所（番地まで）</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="text" name="m_address1" id="m_address1"
                                                        class="form-control"
                                                        value="<?php echo $member->m_address1 ?>"
                                                        placeholder="address" maxlength='50' required />
                                                </div>
                                            </div>
                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">（マンション名・部屋番号）</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="text" name="m_address2" id="m_address2"
                                                        class="form-control"
                                                        value="<?php echo $member->m_address2 ?>"
                                                        placeholder="address" maxlength='50' />
                                                </div>
                                            </div>
                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">電話番号</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="text" name="m_tel" id="m_tel" class="form-control"
                                                        value="<?php echo $member->m_tel ?>"
                                                        placeholder="tel" maxlength='13' pattern="^[-0-9]+$" required />
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block mt-0"
                                                name="mmbrEdit">登　録</button>
                                            <input type="hidden" name="mSeq"
                                                value="<?php echo $member->m_seq; ?>">
                                        </form>
                                        <span class="clrRed"><?php echo $errorMessage ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>

    <?php include('./a_footer.php'); ?>

    </div>
    </div>
    <script src="./assets/vendors/js/core.js"></script>
    <script src="./assets/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="./assets/vendors/chartjs/Chart.min.js"></script>
    <script src="./assets/js/charts/chartjs.addon.js"></script>
    <script src="./assets/js/template.js"></script>
    <script src="./assets/js/dashboard.js"></script>
    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
</body>

</html>