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



require_once './db/infos.php';
$infos = new cls_infos();
$infos = getInfos();

$html="";
foreach ($infos as $info) {
    $html .= '<tr>';
    $html .= "<td>".$info->inf_title."</td>";
    $html .= "<td>".$info->inf_startdt." 〜 ".$info->inf_enddt."</td>";
    $html .= "<td>";
    $html .= "<button type='button' name='edit' class='btn btn-inverse-secondary' onclick='infoEdit(".$info->inf_seq.")'>編集</button>";
    //$html .= "&nbsp;<button type='button' name='edit' class='btn btn-inverse-secondary' onclick='infoView(".$info->inf_seq.")'>プレビュー</button>";
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
    function infoEdit(vlu) {
        document.frm.iSeq.value = vlu;
        document.frm.submit();
    }

    function infoView(vlu) {
        win = window.open('a_infos_preview.php?iSeq=' + vlu, 'newwindow', 'width=400,height=600');
    }

    function infoView2() {
        win = window.open('a_infos_preview.php?tDate=' + document.getElementById('predt').value, 'newwindow', 'width=400,height=600');
    }
    </script>
</head>

<body class="header-fixed">
    <form action='a_infos_edit.php' method='POST' name="frm">
        <input type='hidden' name='iSeq' value=''>
    </form>

    <?php include('./a_menu.php'); ?>

    <div class="page-content-wrapper">
        <div class="page-content-wrapper-inner">
            <div class="content-viewport">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>名称</th>
                            <th>表示期間</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $html; ?>
                    </tbody>
                </table>
                <br>
                <!--
                <table class="table table-dark">
                    <tbody>
                        <tr>
                            <td>指定日のプレビュー</td>
                            <td><input type="date" class="form-control" id="predt"
                                    value="<?php echo date("Y-m-d"); ?>"></td>
                            <td><button type='button' name='edit' class='btn btn-inverse-secondary'
                                    onclick='infoView2()'>プレビュー</button></td>
                        </tr>
                    </tbody>
                </table>
-->
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