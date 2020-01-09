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


$sSeq = $_POST['sSeq'];

require_once './db/serials.php';
$serial = new cls_serials();


$serial->s_seq = $_POST['sSeq'];
$serial->s_title = $_POST['s_title'];
$serial->s_qty = $_POST['s_qty'];
$serial->users_seq = getSsn('SEQ');

if (isset($_POST['edit'])) {
    if (!empty($sSeq)) {
        $errorMessage = updateSerials($serial);
    } else {
        $errorMessage = insertSerials($serial);
    }


    if (empty($errorMessage)) {
        header("Location: ./a_serials_list.php");
    }
} elseif (isset($_POST['del'])) {
    $cntc = countSCodes($sSeq);
    if ($cntc==0) {
        deleteSerials($sSeq);

        header("Location: ./a_serials_list.php");
    } else {
        $errorMessage = 'このシリアルコードはすでに使用されているため削除できません';

        $serial = getSerial($sSeq);
    }
} else {
    $serial = getSerial($sSeq);
    $cnt = getSerialOnToday();
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
</head>

<body class="header-fixed">

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

                                    <span class="clrRed"><?php echo $errorMessage ?></span>

                                        <p class="grid-header">シリアルコード新規登録画面</p>
                                        <?php  if ($cnt>0) { ?>
                                        <p class="clrRed">本日は既にシリアルコードを作成しています。<br>コードの取り扱いに気をつけてください。<br>&nbsp;</p>
                                        <?php } ?>

                                        <form action="" method="POST" onsubmit="return addcheck()">

                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">タイトル</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="text" class="form-control" name="s_title"
                                                        value="<?php echo $serial->s_title; ?>" placeholder="30文字まで"
                                                        maxLength=30 autocomplete="off" required>
                                                </div>
                                            </div>

                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">発行数</label>
                                                </div>
                                                <?php if ($sSeq=="") { ?>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="text" class="form-control" name="s_qty"
                                                        value="<?php echo $serial->s_qty; ?>" placeholder="5文字まで"
                                                        maxLength=5 pattern="[0-9]+" title="数字" autocomplete="off"
                                                        required>
                                                </div>
                                                <?php } else { ?>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="text" class="form-control"
                                                        value="<?php echo $serial->s_qty; ?>" readonly>
                                                    <input type="hidden" name="s_qty"
                                                        value="<?php echo $serial->s_qty; ?>">
                                                        <p class="clrRed">発行数は編集することができません。<br>&nbsp;</p>
                                                </div>
                                                <?php } ?>
                                            </div>


                                            <button type="submit" class="btn btn-primary btn-block mt-0"
                                                name="edit">登　録</button>
                                            <input type="hidden" name="sSeq" value="<?php echo $serial->s_seq; ?>">
                                        </form>
                                        <?php if ($sSeq<>"") { ?>
                                        <br><br>
                                        <form action="" method="POST" onsubmit="return delcheck()">
                                            <button type="submit" class="btn btn-danger btn-block mt-0"
                                                name="del">削　除</button>
                                            <input type="hidden" name="sSeq" value="<?php echo $serial->s_seq; ?>">
                                        </form>
                                        <?php } ?>

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
</body>

</html>