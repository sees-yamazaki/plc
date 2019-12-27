<?php

// セッション開始
session_start();
require('session.php');

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
    $system = new cls_systems();

    try {
        $system->url_parent = $_POST['url_parent'];
        $system->url_child = $_POST['url_child'];
        $system->path_root = $_POST['path_root'];
        $system->path_promo = $_POST['path_promo'];
        $system->path_game = $_POST['path_game'];
        $system->path_info = $_POST['path_info'];
        $system->system_name = $_POST['system_name'];
        $system->path_scode = $_POST['path_scode'];
        $system->point_game = $_POST['point_game'];
        $system->point_entry = $_POST['point_entry'];
        
        if (isset($_POST['sysEdit'])) {
            updateSystem($system);
            setSsnKV('URL_PARENT',$system->url_parent);
            setSsnKV('URL_CHILD',$system->url_child);
            setSsnKV('PATH_PROMO',$system->path_root."/".$system->path_promo);
            setSsnKV('PATH_GAME',$system->path_root."/".$system->path_game);
            setSsnKV('PATH_INFO',$system->path_root."/".$system->path_info);
            setSsnKV('PATH_SCODE',$system->path_root."/".$system->path_scode);
            setSsnKV('SYSTEM_NAME',$system->system_name);
            setSsnKV('POINT_ENTRY',$system->point_entry);
            setSsnKV('POINT_GAME',$system->point_game);

            header("Location: ./a_home.php");
        } else {
            $system = getSystems();
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (getSsnIsDebug()) {
            echo $e->getMessage();
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

                                        <p class="grid-header">Input Types</p>

                                        <form action="" method="POST" onsubmit="return addcheck()">

                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">url_parent</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="text" class="form-control" name="url_parent"
                                                        value="<?php echo $system->url_parent; ?>" maxLength=100
                                                        autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">url_child</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="text" class="form-control" name="url_child"
                                                        value="<?php echo $system->url_child; ?>" maxLength=100
                                                        autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">path_root</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="text" class="form-control" name="path_root"
                                                        value="<?php echo $system->path_root; ?>" maxLength=100
                                                        autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">path_promo</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="text" class="form-control" name="path_promo"
                                                        value="<?php echo $system->path_promo; ?>" maxLength=100
                                                        autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">path_game</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="text" class="form-control" name="path_game"
                                                        value="<?php echo $system->path_game; ?>" maxLength=100
                                                        autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">path_info</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="text" class="form-control" name="path_info"
                                                        value="<?php echo $system->path_info; ?>" maxLength=100
                                                        autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">path_scode</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="text" class="form-control" name="path_scode"
                                                        value="<?php echo $system->path_scode; ?>" maxLength=100
                                                        autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">system_name</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="text" class="form-control" name="system_name"
                                                        value="<?php echo $system->system_name; ?>" maxLength=100
                                                        autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">entry point</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="number" class="form-control" name="point_entry"
                                                        value="<?php echo $system->point_entry; ?>" maxLength=2
                                                        autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">game point</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="number" class="form-control" name="point_game"
                                                        value="<?php echo $system->point_game; ?>" maxLength=2
                                                        autocomplete="off" required>
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