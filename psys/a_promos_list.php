<?php

// セッション開始
session_start();
require('session.php');
require('logging.php');

// ログイン状態チェック
if (getSsnIsLogin()==false) {
    header("Location: a_logoff.php");
    exit;
}

// エラーメッセージの初期化
$errorMessage = "";



require_once './db/promos.php';
$promos = new cls_promos();
$promos = getPromos();

$html="";
foreach ($promos as $promo) {
    $html .= '<tr>';
    $html .= "<td>".$promo->p_title."</td>";
    $html .= "<td>".$promo->p_startdt." 〜 ".$promo->p_enddt."</td>";
    $html .= "<td>";
    $html .= "<button type='button' name='edit' class='btn btn-inverse-secondary' onclick='prmEdit(".$promo->p_seq.")'>編集</button>";
    $html .= "&nbsp;<button type='button' name='edit' class='btn btn-inverse-secondary' onclick='prmPrize(".$promo->p_seq.")'>賞品</button>";
    $html .= "&nbsp;<button type='button' name='edit' class='btn btn-inverse-secondary' onclick='prmView(".$promo->p_seq.")'>プレビュー</button>";
    $html .= "</td>";
    $html .= "</tr>";
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
    function prmEdit(vlu) {
        document.frm.pSeq.value = vlu;
        document.frm.submit();
    }
    function prmPrize(vlu) {
        document.frm2.pSeq.value = vlu;
        document.frm2.submit();
    }
    function prmView(vlu) {
        //document.frm3.pSeq.value = vlu;
        //document.frm3.submit();
        win = window.open('a_promos_preview.php?pSeq=' + vlu, 'newwindow', 'width=400,height=600'); 
    }
    </script>
</head>

<body class="header-fixed">
    <form action='a_promos_edit.php' method='POST' name="frm">
        <input type='hidden' name='pSeq' value=''>
    </form>
    <form action='a_prizes_list.php' method='POST' name="frm2">
        <input type='hidden' name='pSeq' value=''>
    </form>
    <form action='a_promos_preview.php' method='POST' name="frm3" target="_blank">
        <input type='hidden' name='pSeq' value=''>
    </form>

    <?php include('./a_menu.php'); ?>

    <div class="page-content-wrapper">
        <div class="page-content-wrapper-inner">
            <div class="content-viewport">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>名称</th>
                            <th>開催期間</th>
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