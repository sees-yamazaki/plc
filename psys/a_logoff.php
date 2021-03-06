<?php
session_start();
require('session.php');
require('logging.php');

$errorMessage = "ログオフしました。";

// 自セッションのクリア
unsetSsn();

// セッションの変数のクリア
// $_SESSION = array();

// // セッションクリア
// @session_destroy();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Label - Premium Responsive Bootstrap 4 Admin & Dashboard Template</title>
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
                                <form name="loginForm" action="a_login.php" method="POST">
                                    <span class="clrRed"><?php echo $errorMessage;?></span><br><br>
                                    <button type="submit" class="btn btn-primary btn-block" name="login">
                                        ログインする</button>
                                </form>
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