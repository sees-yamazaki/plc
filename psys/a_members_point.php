<?php

// セッション開始
session_start();
require('session.php');
require('logging.php');

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

// ログイン状態チェック
if (getSsnIsLogin()==false) {
    header('Location: a_logoff.php');
    exit;
}

// エラーメッセージの初期化
$errorMessage = '';

$mSeq = $_POST['mSeq'];


require './db/usepoints.php';
$usepoint = new cls_usepoints();

$point = $_POST['point'];

if (isset($_POST['point'])) {
    $usepoint->m_seq = $_POST['mSeq'];
    $usepoint->up_point = -1 * $_POST['point'];
    $usepoint->up_status = 99;
    $usepoint->g_seq = 0;
    $usepoint->p_seq = 0;
    $usepoint->pz_seq = 0;

    insertUsepoints($usepoint);

    if (empty($errorMessage)) {
        header('Location: ./a_members_view.php?mSeq='.$mSeq);
    }
}



?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo getSsnMyname(); ?></title>
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
    </form>

    <?php include './a_menu.php'; ?>

    <div class="page-content-wrapper">
        <div class="page-content-wrapper-inner">
            <div class="content-viewport">


                <div class="col-lg-12">
                    <div class="grid">
                        <div class="grid-body">
                            <div class="item-wrapper">
                                <div class="row mb-3">
                                    <div class="col-md-8 mx-auto">
                                        <button type="button" class="btn btn-inverse-dark"
                                            onclick='back(<?php echo $mSeq; ?>)'>＜＜戻る</button>
                                        <br><br>

                                        <p class="grid-header">ポイント付与</p>

                                        <form action="" method="POST" onsubmit="return addcheck()">

                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">付与ポイント</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="number" class="form-control" name="point"
                                                        value="<?php echo $point; ?>" autocomplete="off" required>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary btn-block mt-0"
                                                name="userEdit">付与する</button>
                                            <input type="hidden" name="mSeq" value="<?php echo $mSeq; ?>">
                                        </form>
                                        <span class="clrRed"><?php echo $errorMessage; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>

    <?php include './a_footer.php'; ?>

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