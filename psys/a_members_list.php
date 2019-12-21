<?php

// セッション開始
session_start();
$ini = $_SESSION['INI'];

// ログイン状態チェック
if (!isset($_SESSION['SEQ'])) {
    header('Location: a_logoff.php');
    exit;
}

// エラーメッセージの初期化
$errorMessage = '';

$limitRow = 8;
$page = $_POST['page'];
if (!isset($page)) {
    $page = 1;
}

 try {
     require_once './db/members.php';
     $members = new cls_members();

     $cnt = getMemberRows();
     $maxPage = ceil($cnt / $limitRow);

     $offset = $limitRow * ($page - 1);

     $members = getMembersLimit($limitRow, $offset);

     $html = '';
     foreach ($members as $member) {
         $html .= '<tr>';
         $html .= '<td>'.$member->m_name.'</td>';
         if (empty($member->point)) {
             $html .= '<td>0</td>';
         } else {
             $html .= '<td>'.$member->point.'</td>';
         }
         if (empty($member->logindt)) {
             $html .= '<td>--</td>';
         } else {
             $html .= '<td>'.$member->logindt.'</td>';
         }
         $html .= '<td><button type="button" name="edit" class="btn btn-inverse-secondary" onclick="mmbrView('.$member->m_seq.')">閲覧</button></td>';
         $html .= '</tr>';
     }

     $pHtml = '';
     for ($i = 1; $i <= $maxPage; ++$i) {
         $pHtml .= "<a href='javascript:paging(".$i.")'>".$i.'</a>&nbsp;&nbsp;';
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
    <link rel="stylesheet" href="./asset/css/main.css">
    <script>
    function mmbrView(vlu) {
        document.frm.mSeq.value = vlu;
        document.frm.submit();
    }
    function paging(vlu) {
        document.pFrm.page.value = vlu;
        document.pFrm.submit();
    }
    </script>
</head>

<body class="header-fixed">
    <form action='a_members_view.php' method='POST' name="frm">
        <input type='hidden' name='mSeq' value=''>
    </form>
    <form action='' method='POST' name="pFrm">
        <input type='hidden' name='page' value=''>
    </form>

    <?php include './a_menu.php'; ?>

    <div class="page-content-wrapper">
        <div class="page-content-wrapper-inner">
            <div class="content-viewport">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>名前</th>
                            <th>保有ポイント</th>
                            <th>最終ログイン</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $html; ?>
                    </tbody>
                </table>
                
                <?php echo $pHtml; ?>
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