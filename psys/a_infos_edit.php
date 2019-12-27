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
$infMessage = '';

$iSeq = $_POST['iSeq'];
if (!isset($iSeq)) {
    $iSeq = 0;
}


    require './db/infos.php';
    $info = new cls_infos($iSeq);

    try {
        $info->inf_seq = $iSeq;
        $info->inf_title = $_POST['inf_title'];
        $info->inf_text1 = $_POST['inf_text1'];
        $info->inf_text2 = $_POST['inf_text2'];
        $info->inf_img = basename($_FILES['inf_img']['name']);
        $info->inf_startdt = $_POST['inf_startdt'];
        $info->inf_enddt = $_POST['inf_enddt'];
        $info->imgStts = $_POST['imgStts'];
        $info->inf_order = $_POST['inf_order'];

        if (isset($_POST['infoEdit'])) {
            if ($info->imgStts == '1') {
                //アップロードファイルの検証
                $filepath = pathinfo($_FILES['inf_img']['name']);

                if (!($filepath['extension'] == 'png' || $filepath['extension'] == 'bmp' || $filepath['extension'] == 'jpg')) {
                    $errorMessage .= '<br>・アップロード画像が正しくありません。<br>png/bmp/jpgの拡張子のファイルをアップロードしてください。';
                }

                if (mb_strlen($info->inf_img) > 20) {
                    $errorMessage .= '<br>・アップロード画像のファイル名は20文字以内にしてください。';
                }
            }

            if (empty($errorMessage)) {
                if ($iSeq==0) {
                    insertInfo($info);
                } else {
                    updateInfo($info);
                }

                //header('Location: ./a_infos_list.php');
            } else {
                $errorMessage = '<br>アップロードされたファイル：'.basename($_FILES['inf_img']['name']).$errorMessage.'<br>';
            }
        } elseif (isset($_POST['del'])) {
            deleteInfo($iSeq);
            header('Location: ./a_infos_list.php');
        } else {
            $info = getInfo($iSeq);
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (getSsnIsDebug()) {
            echo $e->getMessage();
        }
    }

$ckImg1 = ' checked';
$ckImg2 = '';
if ($iSeq>0) {
    $ckImg1 = '';
    $ckImg2 = ' checked';
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
    function back() {
        document.frm.submit();
    }
    </script>
</head>

<body class="header-fixed">
    <form action='a_home.php' method='POST' name="frm">
    </form>

    <?php include './a_menu.php'; ?>

    <div class="page-content-wrapper">
        <div class="page-content-wrapper-inner">
            <div class="content-viewport">

                <div class="col-lg-12">
                    <div class="grid">
                        <div class="grid-body">
                            <div class="item-wrapper">


                                <p class="grid-header">お知らせ登録</p>

                                <form action="" method="POST" onsubmit="return addcheck()" enctype="multipart/form-data">

                                <div class="form-group row showcase_row_area">
                                    <div class="col-md-3 showcase_text_area">
                                        <label for="inputType1">並び順</label>
                                    </div>
                                    <div class="col-md-9 showcase_content_area">
                                        <input type="text" class="form-control w50p" name="inf_order"
                                            value="<?php echo $info->inf_order; ?>" placeholder="2文字まで" maxLength=2
                                            pattern="[0-9]+" title="数字" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1">タイトル</label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area">
                                            <input type="text" class="form-control" name="inf_title"
                                                value="<?php echo $info->inf_title; ?>" placeholder="20文字まで"
                                                maxLength=20 autocomplete="off" required>
                                        </div>
                                    </div>


                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1">説明１</label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area">
                                            <textarea class="form-control" name="inf_text1" cols="12"
                                                rows="5"><?php echo $info->inf_text1; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1">画像</label>
                                        </div>

                                        <div class="form-inline">
                                            <div class="radio mb-3">
                                                <label class="radio-label mr-4">
                                                    <input name="imgStts" type="radio" value="1"
                                                        <?php echo $ckImg1; ?>>アップロードする<i class="input-frame"></i>
                                                </label>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="file" class="btn" name="inf_img">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1"></label>
                                        </div>

                                        <div class="form-inline">
                                            <div class="radio mb-3">
                                                <label class="radio-label">
                                                    <input name="imgStts" type="radio" value="2"
                                                        <?php echo $ckImg2; ?>>アップロードしない<i class="input-frame"></i>
                                                </label>
                                            </div>
                                        </div>

                                    </div>

                                    <?php if ($iSeq > 0) {    ?>
                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1"></label>
                                        </div>

                                        <div class="form-inline">
                                            <div class="radio mb-3">
                                                <label class="radio-label">
                                                    <input name="imgStts" type="radio" value="3">画像を削除する<i
                                                        class="input-frame"></i>
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                    <?php } ?>

                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1">説明２</label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area">
                                            <textarea class="form-control" name="inf_text2" cols="12"
                                                rows="5"><?php echo $info->inf_text2; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1">開始日</label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area">
                                            <input type="date" class="form-control w50p" name="inf_startdt"
                                                value="<?php echo $info->inf_startdt; ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1">終了日</label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area">
                                            <input type="date" class="form-control w50p" name="inf_enddt"
                                                value="<?php echo $info->inf_enddt; ?>" required>
                                        </div>
                                    </div>



                                    <button type="submit" class="btn btn-primary btn-block mt-0"
                                        name="infoEdit">登　録</button>
                                    <input type="hidden" name="iSeq" value="<?php echo $iSeq; ?>">
                                </form>

                                <?php if ($iSeq != '0') {        ?>
                                <br><br>
                                <form action="" method="POST" onsubmit="return delcheck()">
                                    <button type="submit" class="btn btn-danger btn-block mt-0" name="del">削　除</button>
                                    <input type="hidden" name="iSeq" value="<?php echo $iSeq; ?>">
                                </form>
                                <?php    } ?>

                                <span class="clrRed"><?php echo $errorMessage; ?></span>
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