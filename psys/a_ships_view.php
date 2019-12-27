<?php

// セッション開始
session_start();
require('session.php');

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

// ログイン状態チェック
if (getSsnIsLogin()==false) {
    header('Location: a_logoff.php');
    exit;
}

// エラーメッセージの初期化
$errorMessage = '';

    $sSeq = $_POST['sSeq'];
    if (!isset($sSeq)) {
        $sSeq = $_GET['sSeq'];
    }
    $spFlg = $_POST['spFlg'];





try {
    $page = $_POST['page'];
    $search_s_entry = $_POST['search_s_entry'];
    $search_e_entry = $_POST['search_e_entry'];
    $search_name = $_POST['search_name'];
    $stts0 = empty($_POST['stts0']) ? "":" checked";
    $stts1 = empty($_POST['stts1']) ? "":" checked";
    $stts99 = empty($_POST['stts99']) ? "":" checked";
    $search_promo_title = $_POST['search_promo_title'];
    $search_rows = $_POST['search_rows'];

    if (isset($_POST['shiped'])) {

        require_once './db/ships.php';
        updateShipFlg($sSeq,$spFlg);

        header('Location: ./a_ships_list.php?search=1&sSeq='.$sSeq);
    }
} catch (PDOException $e) {
    $errorMessage = 'データベースエラー';
    if (getSsnIsDebug()) {
        echo $e->getMessage();
    }
}






    require './db/views.php';
    $ship = getVShip($sSeq);

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
    function mmbrPoint(vlu) {
        document.frm.mSeq.value = vlu;
        document.frm.submit();
    }

    function back() {
        document.pFrm.submit();
    }
    </script>
</head>

<body class="header-fixed">
    <form action='a_members_point.php' method='POST' name="frm">
        <input type='hidden' name='mSeq' value=''>
    </form>
    <form action='a_ships_list.php' method='POST' name="pFrm">
        <input type='hidden' name='page' value='<?php echo $page; ?>''>
        <input type=' hidden' name='search' value='1'>
        <input type='hidden' name='search_s_entry' value='<?php echo $search_s_entry; ?>'>
        <input type='hidden' name='search_e_entry' value='<?php echo $search_e_entry; ?>'>
        <input type='hidden' name='search_name' value='<?php echo $search_name; ?>'>
        <input type='hidden' name='stts0' value='<?php echo $stts0; ?>'>
        <input type='hidden' name='stts1' value='<?php echo $stts1; ?>'>
        <input type='hidden' name='stts99' value='<?php echo $stts99; ?>'>
        <input type='hidden' name='search_promo_title' value='<?php echo $search_promo_title; ?>'>
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
                                        <button type="button" class="btn btn-inverse-info"
                                            onclick="back()">＜＜戻る</button>
                                        <br><br>

                                        <p class="grid-header">発送先情報</p>


                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">名前</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                <label for="inputType1"><?php echo $ship->sp_name; ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">郵便番号</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                <label for="inputType1"><?php echo $ship->sp_post; ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">住所１</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                <label for="inputType1"><?php echo $ship->sp_address1; ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">住所２</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                <label for="inputType1"><?php echo $ship->sp_address2; ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">電話番号</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                <label for="inputType1"><?php echo $ship->sp_tel; ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">備考</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                <label for="inputType1"><?php echo nl2br($ship->sp_text); ?></label>
                                            </div>
                                        </div>


                                        <p class="grid-header">発送先情報</p>


                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">名前</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                <label for="inputType1"><?php echo $ship->m_name; ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">メール</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                <label for="inputType1"><?php echo $ship->m_mail; ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">郵便番号</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                <label for="inputType1"><?php echo $ship->m_post; ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">住所１</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                <label for="inputType1"><?php echo $ship->m_address1; ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">住所２</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                <label for="inputType1"><?php echo $ship->m_address2; ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">電話番号</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                <label for="inputType1"><?php echo $ship->m_tel; ?></label>
                                            </div>
                                        </div>

                                        <?php if ($ship->sp_flg==0) { ?>
                                        <br><br>
                                        <form action="" method="POST" onsubmit="return addcheck()">
                                            <button type="submit" class="btn btn-primary btn-block mt-0"
                                                name="shiped">発送済みにする</button>
                                            <input type="hidden" name="sSeq" value="<?php echo $sSeq; ?>">
                                            <input type="hidden" name="spFlg" value="1">
                                        </form>
                                        <?php }elseif($ship->sp_flg==1){ ?>
                                        <br><br>
                                        <form action="" method="POST" onsubmit="return addcheck()">
                                            <button type="submit" class="btn btn-warning btn-block mt-0"
                                                name="shiped">未発送にする</button>
                                            <input type="hidden" name="sSeq" value="<?php echo $sSeq; ?>">
                                            <input type="hidden" name="spFlg" value="0">
                                        </form>
                                        <?php } ?>
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