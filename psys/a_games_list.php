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


$gSeq = $_POST['gSeq'];
if (!isset($gSeq)) {
    $gSeq = $_GET['gSeq'];
}


require_once './db/games.php';
$games = new cls_games();
$games = getGames();

$html="";
foreach ($games as $game) {
    $html .= '<tr>';
    $html .= "<td>".$game->g_title."</td>";
    $html .= "<td><button type='button' name='edit' class='btn btn-inverse-secondary' onclick='gameEdit(".$game->g_seq.")'>編集</button></td>";
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
    function gameEdit(vlu) {
        document.frm.gSeq.value = vlu;
        document.frm.submit();
    }
    </script>
</head>

<body class="header-fixed">
    <form action='a_games_edit.php' method='POST' name="frm">
        <input type='hidden' name='gSeq' value=''>
    </form>

    <?php include('./a_menu.php'); ?>

    <div class="page-content-wrapper">
        <div class="page-content-wrapper-inner">
            <div class="content-viewport">
                <!--
                <button type="button" class="btn btn-inverse-dark" onclick='gameEdit(0)'>新規登録</button>
                <br><br>
-->

                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>ゲーム名</mge-mumei></th>
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