<?php

// セッション開始
session_start();
require('session.php');
require('logging.php');

$ini = parse_ini_file('./common.ini', false);
setSsnIni($ini);

// エラーメッセージの初期化
$errorMessage = "";

// ログインボタンが押された場合
if (isset($_POST["login"])) {

// 1. ユーザIDの入力チェック
if (empty($_POST["users_id"])) {  // emptyは値が空のとき
$errorMessage = 'ユーザーIDが未入力です。';
} elseif (empty($_POST["users_pw"])) {
    $errorMessage = 'パスワードが未入力です。';
} else {
    // 入力したユーザIDを格納
    $users_id = $_POST["users_id"];
    $users_pw = $_POST["users_pw"];


    require_once './db/users.php';
    $users = new cls_users();
    $users = loginUsers($users_id, $users_pw);

    if ($users->users_seq==0) {
        $errorMessage = 'ログインできませんでした。';
    } else {
        require_once './db/systems.php';
        $system = new cls_systems();
        $system = getSystems();

        if (!file_exists($system->path_root)) {
            mkdir($system->path_root, 0777);
            mkdir($system->path_root."/".$system->path_promo, 0777);
            mkdir($system->path_root."/".$system->path_game, 0777);
            mkdir($system->path_root."/".$system->path_info, 0777);
            mkdir($system->path_root."/".$system->path_scode, 0777);
        }

        setSsnKV('PATH_PROMO', $system->path_root."/".$system->path_promo);
        setSsnKV('PATH_GAME', $system->path_root."/".$system->path_game);
        setSsnKV('PATH_INFO', $system->path_root."/".$system->path_info);
        setSsnKV('PATH_SCODE', $system->path_root."/".$system->path_scode);
        setSsnKV('SYSTEM_NAME', $system->system_name);
        setSsnKV('POINT_ENTRY', $system->point_entry);
        setSsnKV('POINT_GAME', $system->point_game);
        setSsnKV('SEQ', $users->users_seq);
        setSsnKV('ID', $users->users_id);
        setSsnKV('NAME', $users->users_name);

        if (!file_exists("log")) {
            mkdir("log", 0777);
        }

        $errorMessage = 'ログインできました。'.$users->users_seq;
        header('Location: ./a_home.php');
        exit();
    }
}
}


?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo getSsnMyname(); ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="./assets/vendors/iconfonts/mdi/css/materialdesignicons.css" />
    <link rel="stylesheet" href="./assets/vendors/css/vendor.addons.css" />
    <!-- endinject -->
    <!-- vendor css for this page -->
    <!-- End vendor css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="./assets/css/shared/style.css" />
    <!-- endinject -->
    <!-- Layout style -->
    <link rel="stylesheet" href="./assets/css/demo_1/style.css">
    <!-- Layout style -->
    <link rel="shortcut icon" href="./assets/images/favicon.ico" />
  </head>
  <body>
    <div class="authentication-theme auth-style_1">
      <div class="row">
        <div class="col-12 logo-section">
          <a href="" class="logo">
            <img src="./assets/images/logo.png" alt="logo" />
          </a>
        </div>
      </div>

      
      <div class="row">
        <div class="col-lg-5 col-md-7 col-sm-9 col-11 mx-auto">
          <div class="grid">
            <div class="grid-body">
              <div class="row">
                <div class="col-lg-7 col-md-8 col-sm-9 col-12 mx-auto form-wrapper">
                <form name="loginForm" action="" method="POST">
                    <div class="form-group input-rounded">
                      <input type="text" name="users_id" class="form-control" placeholder="IDを入力" />
                    </div>
                    <div class="form-group input-rounded">
                      <input type="password" name="users_pw" class="form-control" placeholder="パスワードを入力" />
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" name="login"> ログイン</button>
                  </form>
                                        <span class="clrRed"><?php echo $errorMessage ?></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="auth_footer">
        <p class="text-muted text-center">© itty</p>
      </div>
    </div>
    <!--page body ends -->
    <!-- SCRIPT LOADING START FORM HERE /////////////-->
    <!-- plugins:js -->
    <script src="./assets/vendors/js/core.js"></script>
    <script src="./assets/vendors/js/vendor.addons.js"></script>
    <!-- endinject -->
    <!-- Vendor Js For This Page Ends-->
    <!-- Vendor Js For This Page Ends-->
    <!-- build:js -->
    <!-- endbuild -->
  </body>
</html>