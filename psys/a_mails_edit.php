<?php

// セッション開始
session_start();
require('session.php');
require('logging.php');
require('db/mails.php');

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

// ログイン状態チェック
if (getSsnIsLogin()==false) {
    header("Location: a_logoff.php");
    exit;
}

// エラーメッセージの初期化
$errorMessage = "";



require './db/systems.php';
$mails = new cls_mails();


$mails->add_member_title = $_POST['add_member_title'];
$mails->add_member_text = $_POST['add_member_text'];
$mails->insert_member_title = $_POST['insert_member_title'];
$mails->insert_member_text = $_POST['insert_member_text'];
$mails->change_pw_title = $_POST['change_pw_title'];
$mails->change_pw_text = $_POST['change_pw_text'];
$mails->game_hit_title = $_POST['game_hit_title'];
$mails->game_hit_text = $_POST['game_hit_text'];
$mails->game_miss_title = $_POST['game_miss_title'];
$mails->game_miss_text = $_POST['game_miss_text'];
$mails->ship_change_title = $_POST['ship_change_title'];
$mails->ship_change_text = $_POST['ship_change_text'];

if (isset($_POST['sysEdit'])) {
    updateMail($mails);

    header("Location: ./a_home.php");
} else {
    $mails = getMails();
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

                                        <p class="grid-header">メール設定</p>

                                        <form action="" method="POST" onsubmit="return addcheck()">

                                            <div class="form-group row showcase_row_area">
                                                <label
                                                    for="inputType1">【新規会員登録後メール】<br>変換用キーワード　__NAME__　__URL__　__TIME__</label>
                                            </div>
                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">タイトル</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="text" class="form-control" name="add_member_title"
                                                        value="<?php echo $mails->add_member_title; ?>"
                                                        maxLength=100 autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">本文</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <textarea class="form-control" name="add_member_text" cols="12"
                                                        rows="10"
                                                        required><?php echo $mails->add_member_text; ?></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row showcase_row_area">
                                                <label for="inputType1">【会員認証後メール】<br>変換用キーワード　__NAME__</label>
                                            </div>
                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">タイトル</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="text" class="form-control" name="insert_member_title"
                                                        value="<?php echo $mails->insert_member_title; ?>"
                                                        maxLength=100 autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">本文</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <textarea class="form-control" name="insert_member_text" cols="12"
                                                        rows="10"
                                                        required><?php echo $mails->insert_member_text; ?></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row showcase_row_area">
                                                <label for="inputType1">【パスワード変更後メール】<br>変換用キーワード　__TIME__</label>
                                            </div>
                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">タイトル</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="text" class="form-control" name="change_pw_title"
                                                        value="<?php echo $mails->change_pw_title; ?>"
                                                        maxLength=100 autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">本文</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <textarea class="form-control" name="change_pw_text" cols="12"
                                                        rows="10"
                                                        required><?php echo $mails->change_pw_text; ?></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row showcase_row_area">
                                                <label for="inputType1">【ゲーム（当たり）メール】<br>変換用キーワード　__ITEM__　__NAME__
                                                    　__POST__　__ADD1__　__ADD2__　__TEL__　__URL__</label>
                                            </div>
                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">タイトル</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="text" class="form-control" name="game_hit_title"
                                                        value="<?php echo $mails->game_hit_title; ?>"
                                                        maxLength=100 autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">本文</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <textarea class="form-control" name="game_hit_text" cols="12"
                                                        rows="10"
                                                        required><?php echo $mails->game_hit_text; ?></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row showcase_row_area">
                                                <label for="inputType1">【ゲーム（外れ）メール】<br>変換用キーワード　__ITEM__　__NAME__
                                                    　__POST__　__ADD1__　__ADD2__　__TEL__　__URL__</label>
                                            </div>
                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">タイトル</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="text" class="form-control" name="game_miss_title"
                                                        value="<?php echo $mails->game_miss_title; ?>"
                                                        maxLength=100 autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">本文</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <textarea class="form-control" name="game_miss_text" cols="12"
                                                        rows="10"
                                                        required><?php echo $mails->game_miss_text; ?></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row showcase_row_area">
                                                <label for="inputType1">【発送先変更メール】<br>変換用キーワード　__ITEM__　__NAME__
                                                    __POST__
                                                    __ADD1__ __ADD2__ __TEL__ __BIKOU__　__URL__</label>
                                            </div>
                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">タイトル</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="text" class="form-control" name="ship_change_title"
                                                        value="<?php echo $mails->ship_change_title; ?>"
                                                        maxLength=100 autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">本文</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <textarea class="form-control" name="ship_change_text" cols="12"
                                                        rows="10"
                                                        required><?php echo $mails->ship_change_text; ?></textarea>
                                                </div>
                                            </div>


                                            <button type="submit" class="btn btn-primary btn-block mt-0"
                                                name="sysEdit">更新</button>
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
</body>

</html>