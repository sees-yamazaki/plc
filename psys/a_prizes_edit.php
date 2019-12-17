<?php

// セッション開始
session_start();
$ini = $_SESSION['INI'];

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

// ログイン状態チェック
if (!isset($_SESSION["SEQ"])) {
    header("Location: a_logoff.php");
    exit;
}

// エラーメッセージの初期化
$errorMessage = "";

    $pSeq = $_POST['pSeq'];
    $pzSeq = $_POST['pzSeq'];

    require './db/prizes.php';
    $prize = new cls_prizes();

    try {

        $prize->p_seq = $_POST['pSeq'];
        $prize->pz_seq = $_POST['pzSeq'];
        $prize->pz_title = $_POST['pz_title'];
        $prize->pz_text = $_POST['pz_text'];
        $prize->pz_img = basename( $_FILES ['pz_img'] ['name'] );
        $prize->pz_hitcnt = $_POST['pz_hitcnt'];
        
        if (isset($_POST['prommoEdit'])) {

            //アップロードファイルの検証
            $filepath = pathinfo($_FILES ['pz_img'] ['name']);

            if  (!($filepath['extension']=="png" || $filepath['extension']=="bmp" || $filepath['extension']=="jpg")) {
                $errorMessage .= '<br>・アップロード画像が正しくありません。<br>png/bmp/jpgの拡張子のファイルをアップロードしてください。<br>';
            }

            if  (mb_strlen($prize->pz_img)>20) {
                $errorMessage .= '<br>・アップロード画像のファイル名は20文字以内にしてください。<br>';
            }
            
            
            if (empty($errorMessage)) {
                if (!empty($pSeq)) {
                    updateprize($prize);
                } else {
                    insertprize($prize);
                }

                header("Location: ./a_prizes_list.php");
            }else{
                $errorMessage .= '<br>今回アップロードされたファイル：'.basename( $_FILES ['pz_img'] ['name'] );
            }

        } elseif (isset($_POST['del'])) {
            //$rtn = checkUsers($user);
            //if (count($rtn)==0) {
                deleteprize($pSeq);

                header("Location: ./a_prizes_list.php");
            //} else {
                $errorMessage = 'このユーザはシミュレーションデータが登録されているため削除できません';
                
                //$user = getUser($pSeq);
            //}
        } else {
            $prize = getprize($pSeq);
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (strcmp("1", $ini['debug'])==0) {
            echo $e->getMessage();
        }
    }

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $ini['sysname']; ?></title>
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


                                <p class="grid-header">賞品登録</p>

                                <form action="" method="POST" onsubmit="return addcheck()"
                                    enctype="multipart/form-data">

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
                                            <label for="inputType1">説明</label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area">
                                            <textarea class="form-control" name="pz_text" cols="12"
                                                rows="5"><?php echo $prize->pz_text1; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1">画像</label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area">
                                            <input type="file" class="btn" name="pz_img">
                                        </div>
                                    </div>

                                    <?php if($pzSeq > 0){ ?>
                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <?php if(isset($delImg)){ ?>
                                                <input type="checkbox" class="form-check-input" name="delImg" checked>
                                                画像を削除する <i class="input-frame"></i>
                                                <?php }else{ ?>
                                                <input type="checkbox" class="form-check-input" name="delImg"> 画像を削除する
                                                <i class="input-frame"></i>
                                                <?php } ?>
                                            </label>
                                        </div>
                                    </div>
                                    <?php } ?>

                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1">当選カウント</label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area">
                                            <input type="text" class="form-control" name="s_qty"
                                                value="<?php echo $serial->s_qty; ?>" placeholder="5文字まで" maxLength=5
                                                pattern="[0-9]+" title="数字" autocomplete="off" required>
                                        </div>
                                    </div>


                                    <button type="submit" class="btn btn-primary btn-block mt-0"
                                        name="prommoEdit">登　録</button>
                                    <input type="hidden" name="pSeq" value="<?php echo $prize->pz_seq; ?>">
                                </form>

                                <?php if($pSeq<>""){ ?>
                                <br><br>
                                <form action="" method="POST" onsubmit="return delcheck()">
                                    <button type="submit" class="btn btn-danger btn-block mt-0" name="del">削　除</button>
                                    <input type="hidden" name="pSeq" value="<?php echo $prize->pz_seq; ?>">
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