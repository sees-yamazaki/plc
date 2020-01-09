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

$gSeq = $_POST['gSeq'];
if (!isset($gSeq)) {
    $gSeq = 0;
}

require './db/games.php';
$game = new cls_games();


$game->g_seq = $gSeq;
$game->g_title = $_POST['g_title'];
$game->g_image_start = basename($_FILES ['g_image_start'] ['name']);
$game->imgStts_start = $_POST['imgStts_start'];
$game->g_image_hit = basename($_FILES ['g_image_hit'] ['name']);
$game->imgStts_hit = $_POST['imgStts_hit'];
$game->g_image_miss =basename($_FILES ['g_image_miss'] ['name']);
$game->imgStts_miss = $_POST['imgStts_miss'];
$game->g_text = $_POST['g_text'];

if (isset($_POST['gameEdit'])) {
    if ($game->imgStts_start=="1") {
        $tmpMgs="";
        //アップロードファイルの検証
        $filepath = pathinfo($_FILES ['g_image_start'] ['name']);

        if (!(strtolower($filepath['extension']) == 'png' || strtolower($filepath['extension']) == 'bmp' || strtolower($filepath['extension']) == 'jpg')) {
            $tmpMgs .= '<br>・アップロード画像が正しくありません。<br>png/bmp/jpgの拡張子のファイルをアップロードしてください。';
        }

        if (mb_strlen($game->g_image_start)>20) {
            $tmpMgs .= '<br>・アップロード画像のファイル名は20文字以内にしてください。';
        }
        if (!empty($tmpMgs)) {
            $errorMessage .= '<br>アップロードされたファイル：'.basename($_FILES ['g_image_start'] ['name']).$tmpMgs."<br>";
        }
    }

    if ($game->imgStts_hit=="1") {
        $tmpMgs="";
        //アップロードファイルの検証
        $filepath = pathinfo($_FILES ['g_image_hit'] ['name']);

        if (!(strtolower($filepath['extension']) == 'png' || strtolower($filepath['extension']) == 'bmp' || strtolower($filepath['extension']) == 'jpg')) {
            $tmpMgs .= '<br>・アップロード画像が正しくありません。<br>png/bmp/jpgの拡張子のファイルをアップロードしてください。';
        }

        if (mb_strlen($game->g_image_hit)>20) {
            $tmpMgs .= '<br>・アップロード画像のファイル名は20文字以内にしてください。';
        }
        if (!empty($tmpMgs)) {
            $errorMessage .= '<br>アップロードされたファイル：'.basename($_FILES ['g_image_hit'] ['name']).$tmpMgs."<br>";
        }
    }

    if ($game->imgStts_miss=="1") {
        $tmpMgs="";
        //アップロードファイルの検証
        $filepath = pathinfo($_FILES ['g_image_miss'] ['name']);

        if (!(strtolower($filepath['extension']) == 'png' || strtolower($filepath['extension']) == 'bmp' || strtolower($filepath['extension']) == 'jpg')) {
            $tmpMgs .= '<br>・アップロード画像が正しくありません。<br>png/bmp/jpgの拡張子のファイルをアップロードしてください。';
        }

        if (mb_strlen($game->g_image_miss)>20) {
            $tmpMgs .= '<br>・アップロード画像のファイル名は20文字以内にしてください。';
        }
        if (!empty($tmpMgs)) {
            $errorMessage .= '<br>アップロードされたファイル：'.basename($_FILES ['g_image_miss'] ['name']).$tmpMgs."<br>";
        }
    }


    if (empty($errorMessage)) {
        if (!empty($gSeq)) {
            updateGame($game);
        } else {
            insertGame($game);
        }

        header("Location: ./a_games_list.php?pSeq=".$pSeq);
    }
} elseif (isset($_POST['del'])) {
    $rtn = countGames($gSeq);
    if ($rtn==0) {
        deleteGame($gSeq);

        header("Location: ./a_games_list.php");
    } else {
        $errorMessage = 'このゲームはキャンペーンで使用されているため削除できません';

        $game = getGame($gSeq);
    }
} else {
    $game = getGame($gSeq);
}



$ckImg1 = " checked";
$ckImg2 = "";
$required = " required";
if ($gSeq<>0) {
    $ckImg1 = "";
    $ckImg2 = " checked";
    $required = "";
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
    <form action='a_games_list.php' method='POST' name="frm">
    </form>

    <?php include('./a_menu.php'); ?>

    <div class="page-content-wrapper">
        <div class="page-content-wrapper-inner">
            <div class="content-viewport">
                <button type="button" class="btn btn-inverse-info" onclick="back()">＜＜戻る</button>
                <br><br>


                <div class="col-lg-12">
                    <div class="grid">
                        <div class="grid-body">
                            <div class="item-wrapper">


                                <p class="grid-header">ゲーム登録</p>

                                <form action="" method="POST" onsubmit="return addcheck()"
                                    enctype="multipart/form-data">


                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1">ゲーム名</label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area">
                                            <input type="text" class="form-control" name="g_title"
                                                value="<?php echo $game->g_title; ?>" placeholder="20文字まで"
                                                maxLength=20 autocomplete="off" required>
                                        </div>
                                    </div>

                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1">説明</label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area">
                                            <textarea class="form-control" name="g_text" cols="12"
                                                rows="5"><?php echo $game->g_text; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1">スタート画像</label>
                                        </div>
                                        <div class="form-inline">
                                            <div class="radio mb-3">
                                                <label class="radio-label mr-4">
                                                    <input name="imgStts_start" type="radio" value="1" <?php echo $ckImg1; ?>>アップロードする<i
                                                        class="input-frame"></i>
                                                </label>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="file" class="btn" name="g_image_start" <?php echo $required; ?>>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($gSeq<>0) { ?>
                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1"></label>
                                        </div>
                                        <div class="form-inline">
                                            <div class="radio mb-3">
                                                <label class="radio-label">
                                                    <input name="imgStts_start" type="radio" value="2" <?php echo $ckImg2; ?>>アップロードしない<i
                                                        class="input-frame"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>

                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1">当たり画像</label>
                                        </div>
                                        <div class="form-inline">
                                            <div class="radio mb-3">
                                                <label class="radio-label mr-4">
                                                    <input name="imgStts_hit" type="radio" value="1" <?php echo $ckImg1; ?>>アップロードする<i
                                                        class="input-frame"></i>
                                                </label>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="file" class="btn" name="g_image_hit" <?php echo $required; ?>>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($gSeq<>0) { ?>
                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1"></label>
                                        </div>
                                        <div class="form-inline">
                                            <div class="radio mb-3">
                                                <label class="radio-label">
                                                    <input name="imgStts_hit" type="radio" value="2" <?php echo $ckImg2; ?>>アップロードしない<i
                                                        class="input-frame"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>

                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1">外れ画像</label>
                                        </div>
                                        <div class="form-inline">
                                            <div class="radio mb-3">
                                                <label class="radio-label mr-4">
                                                    <input name="imgStts_miss" type="radio" value="1" <?php echo $ckImg1; ?>>アップロードする<i
                                                        class="input-frame"></i>
                                                </label>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="file" class="btn" name="g_image_miss" <?php echo $required; ?>>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($gSeq<>0) { ?>
                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1"></label>
                                        </div>
                                        <div class="form-inline">
                                            <div class="radio mb-3">
                                                <label class="radio-label">
                                                    <input name="imgStts_miss" type="radio" value="2" <?php echo $ckImg2; ?>>アップロードしない<i
                                                        class="input-frame"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>


                                    <button type="submit" class="btn btn-primary btn-block mt-0"
                                        name="gameEdit">登　録</button>
                                    <input type="hidden" name="gSeq" value="<?php echo $gSeq; ?>">
                                </form>

                                <?php if ($gSeq<>0) { ?>
                                <br><br>
                                <form action="" method="POST" onsubmit="return delcheck()">
                                    <button type="submit" class="btn btn-danger btn-block mt-0" name="del">削　除</button>
                                    <input type="hidden" name="gSeq" value="<?php echo $gSeq; ?>">
                                </form>
                                <?php } ?>

                                <span class="clrRed"><?php echo $errorMessage ?></span>
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