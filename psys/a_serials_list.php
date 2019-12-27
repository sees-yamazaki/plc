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


 try {

    require_once './db/serials.php';
     $serials = new cls_serials();
     $serials = getSerials();

     $html="";
     foreach ($serials as $serial) {
         $html .= '<tr>';
         $html .= "<td>".$serial->s_title."</td>";
         $html .= "<td>".$serial->s_qty."</td>";
         $html .= "<td>".substr($serial->createdt,0,16)."</td>";
         $html .= "<td>";
         $html .= "<button type='button' name='edit' class='btn btn-inverse-secondary' onclick='scEdit(".$serial->s_seq.")'>編集</button>";
         $html .= "&nbsp;<button type='button' name='edit' class='btn btn-inverse-secondary' onclick='scDL(".$serial->s_seq.",".$serial->s_qty.")'>DL</button>";
         $html .= "</td>";
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
    function scEdit(vlu) {
        document.frm.sSeq.value = vlu;
        document.frm.submit();
    }
    function scDL(vlu,qty) {
        document.frm2.sSeq.value = vlu;
        document.frm2.sQty.value = qty;
        document.frm2.submit();
    }
    </script>
</head>

<body class="header-fixed">
    <form action='a_serials_edit.php' method='POST' name="frm">
        <input type='hidden' name='sSeq' value=''>
    </form>
    <form action='a_serials_dl.php' method='POST' name="frm2">
        <input type='hidden' name='sSeq' value=''>
        <input type='hidden' name='sQty' value=''>
    </form>

    <?php include('./a_menu.php'); ?>

    <div class="page-content-wrapper">
        <div class="page-content-wrapper-inner">
            <div class="content-viewport">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>タイトル</th>
                            <th>発行数</th>
                            <th>作成日時</th>
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
</body>

</html>