<?php

// セッション開始
session_start();
require('session.php');

// ログイン状態チェック
if (getSsnIsLogin()==false) {
    header("Location: a_logoff.php");
    exit;
}

// エラーメッセージの初期化
$errorMessage = "";

$search_id = $_POST['search_id'];
$search_name = $_POST['search_name'];

 try {
     $openclose = " fClose";
     $formbg = " closeform";
     $where = "";
     if (isset($_POST['search'])) {
        $tmp = array();

        if (!empty($search_id)) {
            $tmp[] = "(users_id=".$search_id.")"; 
        }
        if (!empty($search_name)) {
            $tmp[] = "(users_name LIKE '%".$search_name."%')"; 
        }

        if(count($tmp)>0){
            $where = " WHERE ".implode(" AND ",$tmp);
        }

        $openclose = " ";
        $formbg = " openform";

     }
     require_once './db/users.php';
     $users = new cls_users();
     $users = getUsers($where);

     $html="";
     foreach ($users as $user) {
         $html .= '<tr>';
         $html .= "<td>".$user->users_id."</td>";
         $html .= "<td>".$user->users_name."</td>";
         $html .= "<td><button type='button' name='edit' class='btn btn-inverse-secondary' onclick='usrEdit(".$user->users_seq.")'>編集</button></td>";
         $html .= "</tr>";
     }
 } catch (PDOException $e) {
     $errorMessage = 'データベースエラー:'.$e->getMessage();
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
    <link rel="shortcut icon" href="../asssets/images/favicon.ico" />
    <link rel="stylesheet" href="./asset/css/main.css">
    <script>
    function usrEdit(vlu) {
        document.frm.uSeq.value = vlu;
        document.frm.submit();
    }
    </script>
</head>

<body class="header-fixed">
    <form action='a_users_edit.php' method='POST' name="frm">
        <input type='hidden' name='uSeq' value=''>
    </form>

    <?php include('./a_menu.php'); ?>

    <div class="page-content-wrapper">
        <div class="page-content-wrapper-inner">
            <div class="content-viewport">


                <div id="searchfrom" class="grid <?php echo $formbg; ?>">
                    <div class="btn btn-rounded social-icon-btn btn-facebook">
                        <i class="mdi mdi-magnify" onclick="openclose()"></i>
                    </div>
                    <div class="grid-body <?php echo $openclose; ?>" id="open">
                        <form action="" method="POST">

                            <div class="form-group row">
                                <div class="col-md-12 showcase_text_area">
                                    <label for="inputType1">ID-></label>
                                    <input type="number" class="form-control w50p search" name="search_id"
                                        value="<?php echo $search_id; ?>" autocomplete="off">
                                </div>
                                <div class="col-md-12 showcase_text_area">
                                    <label for="inputType1">名前-></label>
                                    <input type="text" class="form-control w50p search" name="search_name"
                                        value="<?php echo $search_name; ?>">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block mt-0" name="search">検索</button>
                        </form>

                        <span class="clrRed"><?php echo $errorMessage ?></span>
                    </div>
                </div>





                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>名前</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $html; ?>
                    </tbody>
                </table>




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
    <script src="./asset/js/main.js"></script>
</body>

</html>