<?php

// セッション開始
session_start();
$ini = $_SESSION['INI'];

// ログイン状態チェック
if (!isset($_SESSION["SEQ"])) {
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
        $html .= "<td>".$serial->createdt."</td>";
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
    <title><?php echo $ini['sysname']; ?></title>
    <link rel="stylesheet" href="./assets/vendors/iconfonts/mdi/css/materialdesignicons.css">
    <link rel="stylesheet" href="./assets/css/shared/style.css">
    <link rel="stylesheet" href="./assets/css/demo_1/style.css">
    <link rel="shortcut icon" href="../asssets/images/favicon.ico" />
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
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>タイトル</th>
                            <th>発行数</th>
                            <th>作成日</th>
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