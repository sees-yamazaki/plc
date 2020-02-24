<?php
require('session.php');
require('helper.php');
require('logging.php');
require('db/members.php');

// セッション開始
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

// // ログイン状態チェック
// if (getSsnIsLogin()==false) {
//     header('Location: a_logoff.php');
//     exit;
// }

// エラーメッセージの初期化
$errorMessage = '';


$mSeq = $_POST['mSeq'];
$member = getMember($mSeq);
$grp = $_POST['grp'];
if (isset($_POST['grp'])) {
    $url ='app4grp.php';
} else {
    $url ='appointment.php';
}

if (isset($_POST['doEdit'])) {
    $member->m_date = $_POST['m_date'];
    $member->m_time = $_POST['m_time'];
    $member->m_flg1 = $_POST['m_flg1'];

    updateMember($member);

    if (!empty($_POST['grp'])) {
        header("Location: app4grp.php?grp=".$member->m_group);
    } else {
        header("Location: appointment.php");
    }
} elseif (isset($_POST['doClear'])) {
    clearMember($mSeq);

    if (!empty($_POST['grp'])) {
        header("Location: app4grp.php?grp=".$member->m_group);
    } else {
        header("Location: appointment.php");
    }
}






if ($member->m_flg1==0) {
    $m_flg1_0 = " checked";
    $m_flg1_1 = "";
    $m_flg1_2 = "";
} elseif ($member->m_flg1==9) {
    $m_flg1_0 = "";
    $m_flg1_1 = "";
    $m_flg1_2 = " checked";
} else {
    $m_flg1_0 = "";
    $m_flg1_1 = " checked";
    $m_flg1_2 = "";
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
        function back() {
            document.frm.submit();
        }
    </script>
</head>

<body class="header-fixed">
    <form action='<?php echo $url; ?>' method='POST' name="frm">
        <input type='hidden' name='grp' value='<?php echo $grp; ?>'>
    </form>



    <?php include('./menu.php'); ?>

    <div class="page-content-wrapper">
        <div class="page-content-wrapper-inner">
            <div class="content-viewport">



                <div class="col-lg-12">
                    <button type="button" class="btn btn-outline-dark" onclick="back()">戻る</button>
                    <div class="grid">
                        <div class="grid-body">
                            <div class="item-wrapper">

                                <span class="clrRed"><?php echo $errorMessage; ?></span>

                                <p class="grid-header">面談予約</p>

                                <form action='' method="POST" onsubmit="return addcheck()"
                                    enctype="multipart/form-data">

                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1">GROUP</label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area">
                                            <?php echo $member->m_group; ?>
                                        </div>
                                    </div>

                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1">NAME</label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area">
                                            <?php echo $member->m_name; ?>
                                        </div>
                                    </div>

                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1">DATE</label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area">
                                            <input type="date" class="form-control" name="m_date"
                                                value="<?php echo $member->m_date; ?>"
                                                required>
                                        </div>
                                    </div>

                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1">TIME</label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area">
                                            <input type="time" class="form-control" name="m_time"
                                                value="<?php echo $member->m_time; ?>"
                                                required>
                                        </div>
                                    </div>


                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1">TYPE</label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area">
                                            <label class="radio-label mr-4">
                                                <input name="m_flg1" type="radio" value="0" <?php echo $m_flg1_0; ?>>仮予約
                                                <i class="input-frame"></i>

                                                <input name="m_flg1" type="radio" value="1" <?php echo $m_flg1_1; ?>>決定
                                                <i class="input-frame"></i>

                                                <input name="m_flg1" type="radio" value="9" <?php echo $m_flg1_2; ?>>実施無し
                                                <i class="input-frame"></i>
                                            </label>
                                        </div>
                                    </div>



                                    <button type="submit" class="btn btn-primary btn-block mt-0"
                                        name="prizeEdit">登　録</button>
                                    <input type="hidden" name="doEdit" value="0">
                                    <input type="hidden" name="mSeq"
                                        value="<?php echo $mSeq; ?>">
                                </form>
                                <br><br>
                                <form action='' method="POST" onsubmit="return addcheck()">
                                    <button type="submit" class="btn btn-danger btn-block mt-0"
                                        name="prizeEdit">日付をクリアする</button>
                                    <input type="hidden" name="doClear" value="0">
                                    <input type="hidden" name="mSeq"
                                        value="<?php echo $mSeq; ?>">
                                    <input type="hidden" name="grp"
                                        value="<?php echo $grp; ?>">
                                </form>

                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>


    </div>
    </div>
    <script src="./assets/vendors/js/core.js"></script>
    <script src="./assets/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="./assets/vendors/chartjs/Chart.min.js"></script>
    <script src="./assets/js/charts/chartjs.addon.js"></script>
    <script src="./assets/js/template.js"></script>
    <script src="./assets/js/dashboard.js"></script>


</body>

</html>