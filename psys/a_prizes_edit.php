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

    $pSeq = $_POST['pSeq'];
    $pzSeq = $_POST['pzSeq'];

    require './db/prizes.php';
    $prize = new cls_prizes();

    try {
        $prize->p_seq = $_POST['pSeq'];
        $prize->pz_seq = $_POST['pzSeq'];
        $prize->pz_order = $_POST['pz_order'];
        $prize->pz_title = $_POST['pz_title'];
        $prize->pz_code = $_POST['pz_code'];
        $prize->pz_text = $_POST['pz_text'];
        $prize->pz_img = basename($_FILES['pz_img']['name']);
        $prize->pz_hitcnt = $_POST['pz_hitcnt'];
        $prize->imgStts = $_POST['imgStts'];

        if (isset($_POST['prizeEdit'])) {
            if ($prize->imgStts == '1') {
                //アップロードファイルの検証
                $filepath = pathinfo($_FILES['pz_img']['name']);

                if (!($filepath['extension'] == 'png' || $filepath['extension'] == 'bmp' || $filepath['extension'] == 'jpg')) {
                    $errorMessage .= '<br>・アップロード画像が正しくありません。<br>png/bmp/jpgの拡張子のファイルをアップロードしてください。';
                }

                if (mb_strlen($prize->pz_img) > 20) {
                    $errorMessage .= '<br>・アップロード画像のファイル名は20文字以内にしてください。';
                }
            }

            if (empty($errorMessage)) {
                if (!empty($pzSeq)) {
                    updateprize($prize);
                } else {
                    insertprize($prize);
                }

                header('Location: ./a_prizes_list.php?pSeq='.$pSeq);
            } else {
                $errorMessage = '<br>アップロードされたファイル：'.basename($_FILES['pz_img']['name']).$errorMessage.'<br>';
            }
        } elseif (isset($_POST['del'])) {
            require './db/usepoints.php';
            $rtn = countUsepointsByPzseq($pzSeq);

            if ($rtn == 0) {
                deleteprize($pzSeq);

                header('Location: ./a_prizes_list.php?pSeq='.$pSeq);
            } else {
                $errorMessage = 'この賞品はエントリー済のため削除できません';

                $prize = getprize($pzSeq);
            }
        } else {
            $prize = getprize($pzSeq);
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (getSsnIsDebug()) {
            echo $e->getMessage();
        }
    }

$ckImg1 = ' checked';
$ckImg2 = '';
if (!empty($pzSeq)) {
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
    <form action='a_prizes_list.php' method='POST' name="frm">
        <input type='hidden' name='pSeq' value='<?php echo $pSeq; ?>'>
    </form>

    <?php include './a_menu.php'; ?>

    <div class="page-content-wrapper">
        <div class="page-content-wrapper-inner">
            <div class="content-viewport">
                <button type="button" class="btn btn-inverse-info" onclick="back()">＜＜戻る</button>
                <br><br>


                <div class="col-lg-12">
                    <div class="grid">
                        <div class="grid-body">
                            <div class="item-wrapper">


                                <p class="grid-header">賞品登録</p>

                                <form action="" method="POST" onsubmit="return addcheck()"
                                    enctype="multipart/form-data">

                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1">並び順</label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area">
                                            <input type="text" class="form-control" name="pz_order"
                                                value="<?php echo $prize->pz_order; ?>" placeholder="2文字まで" maxLength=2
                                                pattern="[0-9]+" title="数字" autocomplete="off" required>
                                        </div>
                                    </div>

                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1">賞品名</label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area">
                                            <input type="text" class="form-control" name="pz_title"
                                                value="<?php echo $prize->pz_title; ?>" placeholder="20文字まで"
                                                maxLength=20 autocomplete="off" required>
                                        </div>
                                    </div>

                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1">賞品コード</label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area">
                                            <input type="text" class="form-control" name="pz_code"
                                                value="<?php echo $prize->pz_code; ?>" placeholder="30文字まで"
                                                maxLength=30 autocomplete="off" required>
                                        </div>
                                    </div>

                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1">説明</label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area">
                                            <textarea class="form-control" name="pz_text" cols="12"
                                                rows="5"><?php echo $prize->pz_text; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1">画像</label>
                                        </div>

                                        <div class="form-inline">
                                            <div class="radio mb-3">
                                                <label class="radio-label mr-4">
                                                    <input name="imgStts" type="radio" value="1" <?php echo $ckImg1; ?>>アップロードする<i
                                                        class="input-frame"></i>
                                                </label>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="file" class="btn" name="pz_img">
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
                                                    <input name="imgStts" type="radio" value="2" <?php echo $ckImg2; ?>>アップロードしない<i
                                                        class="input-frame"></i>
                                                </label>
                                            </div>
                                        </div>

                                    </div>

                                    <?php if ($pzSeq > 0) { ?>
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
                                            <label for="inputType1">当選カウント</label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area">
                                            <input type="text" class="form-control" name="pz_hitcnt"
                                                value="<?php echo $prize->pz_hitcnt; ?>" placeholder="複数の場合は , で区切ってください" maxLength=100
                                                pattern="[0-9,]+" title="数字、半角カンマ" autocomplete="off" required>
                                        </div>
                                    </div>


                                    <button type="submit" class="btn btn-primary btn-block mt-0"
                                        name="prizeEdit">登　録</button>
                                    <input type="hidden" name="pSeq" value="<?php echo $pSeq; ?>">
                                    <input type="hidden" name="pzSeq" value="<?php echo $pzSeq; ?>">
                                </form>

                                <?php if ($pzSeq != '0') { ?>
                                <br><br>
                                <form action="" method="POST" onsubmit="return delcheck()">
                                    <button type="submit" class="btn btn-danger btn-block mt-0" name="del">削　除</button>
                                    <input type="hidden" name="pSeq" value="<?php echo $pSeq; ?>">
                                    <input type="hidden" name="pzSeq" value="<?php echo $pzSeq; ?>">
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