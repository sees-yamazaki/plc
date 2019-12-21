<?php

// セッション開始
session_start();
$ini = $_SESSION['INI'];

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

// ログイン状態チェック
if (!isset($_SESSION['SEQ'])) {
    header('Location: a_logoff.php');
    exit;
}

// エラーメッセージの初期化
$errorMessage = '';

    $mSeq = $_POST['mSeq'];
    if (!isset($mSeq)) {
        $mSeq = $_GET['mSeq'];
    }

    require './db/members.php';
    $member = new cls_members();

    try {
        // $user->users_seq = $_POST['uSeq'];
        // $user->users_id = $_POST['users_id'];
        // $user->users_pw = $_POST['users_pw'];
        // $user->users_name = $_POST['users_name'];

        if (isset($_POST['userEdit'])) {
            // $tmp = getUserByID($user);

            // if (empty($tmp->users_seq)) {
            //     if (!empty($uSeq)) {
            //         updateUser($user);
            //     } else {
            //         insertUser($user);
            //     }
            // } else {
            //     $errorMessage = 'このIDはすでに使用されています';
            // }

            // if (empty($errorMessage)) {
            //     header('Location: ./a_users_list.php');
            // }
        } else {
            $member = getMember($mSeq);
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (strcmp('1', $ini['debug']) == 0) {
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
    <script>
    function mmbrPoint(vlu) {
        document.frm.mSeq.value = vlu;
        document.frm.submit();
    }
    </script>
</head>

<body class="header-fixed">
    <form action='a_members_point.php' method='POST' name="frm">
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
                                        <button type="button" class="btn btn-inverse-info"
                                            onclick="location.href='./a_members_list.php'">＜＜戻る</button>
                                        <button type="button" class="btn btn-inverse-dark"
                                            onclick='mmbrPoint(<?php echo $member->m_seq; ?>)'>ポイント付与する</button>
                                        <br><br>

                                        <p class="grid-header">会員情報</p>


                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">名前</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                <label for="inputType1"><?php echo $member->m_name; ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">メール</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                <label for="inputType1"><?php echo $member->m_mail; ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">郵便番号</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                <label for="inputType1"><?php echo $member->m_post; ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">住所１</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                <label for="inputType1"><?php echo $member->m_address1; ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">住所２</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                <label for="inputType1"><?php echo $member->m_address2; ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">電話番号</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                <label for="inputType1"><?php echo $member->m_tel; ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">登録日時</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                <label for="inputType1"><?php echo $member->createdt; ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">現在ポイント</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                <label for="inputType1"><?php echo $member->point; ?></label>
                                            </div>
                                        </div>

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