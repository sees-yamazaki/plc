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



    $uSeq = $_POST['uSeq'];

    require './db/users.php';
    $user = new cls_users();

    try {
        $user->users_seq = $_POST['uSeq'];
        $user->users_id = $_POST['users_id'];
        $user->users_pw = $_POST['users_pw'];
        $user->users_name = $_POST['users_name'];
        
        if (isset($_POST['userEdit'])) {

            $tmp = getUserByID($user);

            if (empty($tmp->users_seq)) {
                if (!empty($uSeq)) {
                    updateUser($user);
                } else {
                    insertUser($user);
                }
            } else {
                $errorMessage = 'このIDはすでに使用されています';
            }
            
            
            if (empty($errorMessage)) {
                header("Location: ./a_users_list.php");
            }

        } elseif (isset($_POST['myPw'])) {

            //パスワードをIDと同値で初期化する
            $user = getUser($uSeq);
            $user->users_pw = $_POST['users_pw'];
            updateUserPW($user);

            header("Location: ./a_users_list.php");

        } elseif (isset($_POST['userPw'])) {

            //パスワードをIDと同値で初期化する
            $user = getUser($uSeq);
            $user->users_pw = $user->users_id ;
            updateUserPW($user);

            header("Location: ./a_users_list.php");

        } elseif (isset($_POST['userDel'])) {
            $rtn = checkUsers($user);
            if (count($rtn)==0) {
                deleteUser($user);

                header("Location: ./users_list.php");

            } else {
                $errorMessage = 'このユーザはシミュレーションデータが登録されているため削除できません';
                
                $user = getUser($uSeq);
            }
        } else {
            $user = getUser($uSeq);
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
                                <div class="row mb-3">
                                    <div class="col-md-8 mx-auto">

                                        <p class="grid-header">Input Types</p>

                                        <form action="" method="POST" onsubmit="return addcheck()">

                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">ID</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="text" class="form-control" name="users_id"
                                                        value="<?php echo $user->users_id; ?>" placeholder="10文字まで"
                                                        maxLength=10 pattern="[a-zA-Z0-9]+" title="半角英数字"
                                                        autocomplete="off" required>
                                                </div>
                                            </div>

                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType13">Password</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="password" class="form-control" name="users_pw"
                                                        value="<?php echo $user->users_pw; ?>" placeholder="10文字まで"
                                                        maxLength=10 pattern="[a-zA-Z0-9]+" title="半角英数字"
                                                        autocomplete="off" required>
                                                </div>
                                            </div>

                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">名前</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    <input type="text" class="form-control" name="users_name"
                                                        value="<?php echo $user->users_name; ?>" placeholder="20文字まで"
                                                        maxLength=20 autocomplete="off" required>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block mt-0"
                                                name="userEdit">登　録</button>
                                            <input type="hidden" name="uSeq" value="<?php echo $user->users_seq; ?>">
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