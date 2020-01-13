<?php

// セッション開始
session_start();
require('session.php');
require('logging.php');

// ログイン状態チェック
if (getSsnIsLogin()==false) {
    header('Location: a_logoff.php');
    exit;
}

// エラーメッセージの初期化
$errorMessage = '';

$limitRow = 5;

$sSeq = $_POST['sSeq'];
$page = $_POST['page'];
if (!isset($page)) {
    $page = 1;
}


$searchData = array();

if (isset($_POST['back']) || isset($_POST['paging'])) {
    $searchData = getSsn(__CLASS__);
    if (isset($_POST['back'])) {
        $page = $searchData['page'];
    }
} else {
    $searchData['search_s_entry'] = $_POST['search_s_entry'];
    $searchData['search_e_entry'] = $_POST['search_e_entry'];
    $searchData['search_name'] = $_POST['search_name'];
    $searchData['stts0'] = empty($_POST['stts0']) ? "":" checked";
    $searchData['stts1'] = empty($_POST['stts1']) ? "":" checked";
    $searchData['stts99'] = empty($_POST['stts99']) ? "":" checked";
    $searchData['search_promo_title'] = $_POST['search_promo_title'];
    $searchData['search_rows'] = $_POST['search_rows'];
}

//検索条件をセッションに格納
$searchData['page']=$page;
setSsnKV(__CLASS__, $searchData);


$search_rows_100="";
$search_rows_300="";
$search_rows_500="";
if ($searchData['search_rows']=="500") {
    $limitRow = 500;
    $search_rows_500=" checked";
} elseif ($searchData['search_rows']=="300") {
    $limitRow = 300;
    $search_rows_300=" checked";
} else {
    $limitRow = 100;
    $search_rows_100=" checked";
}


$where = "";

$tmp = array();

if (strlen($sSeq)>0) {
    $tmp[] = "(sp_seq=".$sSeq.")";
}
if (strlen($searchData['search_s_entry'])>0) {
    $tmp[] = "(createdt>='".$searchData['search_s_entry']." 00:00:00')";
}
if (strlen($search_e_login)>0) {
    $tmp[] = "(createdt<='".$searchData['search_e_entry']." 23:59:59')";
}

if (!empty($searchData['search_name'])) {
    $tmp[] = "(m_name LIKE '%".$searchData['search_name']."%')";
}

if (!empty($searchData['stts0'])) {
    $tmp2[] = " sp_flg=0";
}
if (!empty($searchData['stts1'])) {
    $tmp2[] = "sp_flg=1";
}
if (!empty($tmp2)) {
    $tmp[] = "(".implode(" OR ", $tmp2).")";
}

if (!empty($searchData['search_promo_title'])) {
    $tmp[] = "(p_title LIKE '%".$searchData['search_promo_title']."%')";
}



if (!empty($tmp)) {
    $where = " WHERE ".implode(" AND ", $tmp);
}

 
$openclose = " fClose";
$formbg = " closeform";
if (!empty($where)) {
    $openclose = " ";
    $formbg = " openform";
}





require_once './db/views.php';

$ups = array();

$cnt = getVShipsRows($where);
$maxPage = ceil($cnt / $limitRow);

$offset = $limitRow * ($page - 1);

$ships = getVShipsLimit($limitRow, $offset, $where);


$html = '';
foreach ($ships as $ship) {
    $html .= '<tr>';
    $html .= '<td>'.substr($ship->createdt, 0, 16).'</td>';
    $html .= '<td>'.$ship->p_title.'</td>';
    $html .= '<td>'.$ship->pz_title.'</td>';
    $html .= '<td>'.$ship->m_name.'</td>';
    $html .= '<td>'.$ship->sp_name.'</td>';
    if ($ship->sp_flg==1) {
        $html .= '<td>発送済み</td>';
    } else {
        $html .= '<td class="clrRed">未発送</td>';
    }
    $html .= "<td>";
    $html .= "<button type='button' name='edit' class='btn btn-inverse-secondary' onclick='shipEdit(".$ship->sp_seq.",".$page.")'>詳細</button>";
    $html .= "</td>";
    $html .= '</tr>';
}

$pHtml = '';
for ($i = 1; $i <= $maxPage; ++$i) {
    $pHtml .= "<a href='javascript:paging(".$i.")'>".$i.'</a>&nbsp;&nbsp;';
}


?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo getSsnMyname(); ?>
    </title>
    <link rel="stylesheet" href="./assets/vendors/iconfonts/mdi/css/materialdesignicons.css">
    <link rel="stylesheet" href="./assets/css/shared/style.css">
    <link rel="stylesheet" href="./assets/css/demo_1/style.css">
    <link rel="shortcut icon" href="../asssets/images/favicon.ico" />
    <link rel="stylesheet" href="./asset/css/main.css">
    <script>
        function shipEdit(vlu, vlu2) {
            document.frm.sSeq.value = vlu;
            document.frm.page.value = vlu2;
            document.frm.submit();
        }

        function paging(vlu) {
            document.pFrm.page.value = vlu;
            document.pFrm.submit();
        }
    </script>
</head>

<body class="header-fixed">
    <form action='a_ships_view.php' method='POST' name="frm">
        <input type='hidden' name='sSeq' value=''>
        <input type='hidden' name='page' value=''>
    </form>
    <form action='' method='POST' name="pFrm">
        <input type='hidden' name='page' value=''>
        <input type='hidden' name='paging' value=''>
    </form>

    <?php include './a_menu.php'; ?>

    <div class="page-content-wrapper">
        <div class="page-content-wrapper-inner">
            <div class="content-viewport">


                <div id="searchfrom"
                    class="grid <?php echo $formbg; ?>">
                    <div class="btn btn-rounded social-icon-btn btn-facebook">
                        <i class="mdi mdi-magnify" onclick="openclose()"></i>
                    </div>
                    <div class="grid-body <?php echo $openclose; ?>"
                        id="open">
                        <form action="" method="POST">

                            <div class="form-group row">
                                <div class="col-md-12 showcase_text_area">
                                    <label for="inputType1">日付-></label>
                                    <input type="date" class="form-control w30p search" name="search_s_entry"
                                        value="<?php echo $searchData['search_s_entry']; ?>"
                                        autocomplete="off">　〜　
                                    <input type="date" class="form-control w30p search" name="search_e_entry"
                                        value="<?php echo $searchData['search_e_entry']; ?>"
                                        autocomplete="off">
                                </div>
                                <div class="col-md-12 showcase_text_area">
                                    <label for="inputType1">キャンペーン名-></label>
                                    <input type="text" class="form-control w50p search" name="search_promo_title"
                                        value="<?php echo $searchData['search_promo_title']; ?>">
                                </div>
                                <div class="col-md-12 showcase_text_area">
                                    <label for="inputType1">当選者-></label>
                                    <input type="text" class="form-control w50p search" name="search_name"
                                        value="<?php echo $searchData['search_name']; ?>">
                                </div>
                                <div class="col-md-12 showcase_text_area">
                                    <label for="inputType1">区分-></label>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label>
                                        <input type="checkbox" class="form-check-input" name="stts0" <?php echo $searchData['stts0']; ?>>未発送<i
                                            class="input-frame"></i>
                                    </label>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label>
                                        <input type="checkbox" class="form-check-input" name="stts1" <?php echo $searchData['stts1']; ?>>発送済み<i
                                            class="input-frame"></i>
                                    </label>
                                </div>
                                <div class="col-md-12 showcase_text_area">
                                    <label for="inputType1">表示件数-></label>
                                    <label class="radio-label mr-4">
                                        <input name="search_rows" type="radio" value="100" <?php echo $search_rows_100; ?>>１００件
                                        <i class="input-frame"></i>
                                        <input name="search_rows" type="radio" value="300" <?php echo $search_rows_300; ?>>３００件
                                        <i class="input-frame"></i>
                                        <input name="search_rows" type="radio" value="500" <?php echo $search_rows_500; ?>>５００件
                                        <i class="input-frame"></i>
                                    </label>
                                </div>

                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary btn-block mt-0" name="search">検索</button>
                        </form>

                        <span class="clrRed"><?php echo $errorMessage ?></span>
                    </div>
                </div>

                <a
                    href="./files/ships_<?php echo getSsn('SEQ') ?>.csv">[検索結果をダウンロード]</a><br>

                <?php echo $pHtml; ?>

                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>日時</th>
                            <th>キャンペーン名</th>
                            <th>賞品名</th>
                            <th>当選者</th>
                            <th>発送先氏名</th>
                            <th>区分</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $html; ?>
                    </tbody>
                </table>

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
    <script src="./asset/js/main.js"></script>
</body>

</html>