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

$limitRow = 10;
$page = $_POST['page'];
if (!isset($page)) {
    $page = 1;
}

$searchData = array();

if (isset($_POST['paging'])) {
    $searchData = getSsn(__CLASS__);
} else {
    $searchData['search_code'] = $_POST['search_code'];
    $searchData['search_min_point'] = $_POST['search_min_point'];
    $searchData['search_max_point'] = $_POST['search_max_point'];
    $searchData['search_s_create'] = $_POST['search_s_create'];
    $searchData['search_e_create'] = $_POST['search_e_create'];
    $searchData['search_s_entry'] = $_POST['search_s_entry'];
    $searchData['search_e_entry'] = $_POST['search_e_entry'];
    $searchData['search_name'] = $_POST['search_name'];
    $searchData['ichi'] =empty($_POST['ichi']) ? "":" checked";
    $searchData['unreg'] =empty($_POST['unreg']) ? "":" checked";
    $searchData['search_rows'] = $_POST['search_rows'];
}

//検索条件をセッションに格納
$searchData['page']=$page;
setSsnKV(__CLASS__, $searchData);



$search_rows_10="";
$search_rows_100="";
$search_rows_300="";
$search_rows_500="";
if ($searchData['search_rows']=="500") {
    $limitRow = 500;
    $search_rows_500=" checked";
} elseif ($searchData['search_rows']=="300") {
    $limitRow = 300;
    $search_rows_300=" checked";
} elseif ($searchData['search_rows']=="10") {
    $limitRow = 10;
    $search_rows_10=" checked";
} else {
    $limitRow = 100;
    $search_rows_100=" checked";
}


$where = "";


$tmp = array();

if (!empty($searchData['search_name'])) {
    $tmp[] = "(m_name LIKE '%".$searchData['search_name']."%')";
}
if (strlen($searchData['search_code'])>0) {
    if (strlen($searchData['ichi'])>0) {
        $tmp[] = "(sc_code=".$searchData['search_code'].")";
    } else {
        $tmp[] = "(sc_code LIKE '%".$searchData['search_code']."%')";
    }
}
if (strlen($searchData['search_min_point'])>0) {
    $tmp[] = "(sc_point>=".$searchData['search_min_point'].")";
}
if (strlen($searchData['search_max_point'])>0) {
    $tmp[] = "(sc_point<=".$searchData['search_max_point'].")";
}
if (strlen($searchData['search_s_create'])>0) {
    $tmp[] = "(createdt>='".$searchData['search_s_create']." 00:00:00')";
}
if (strlen($searchData['search_e_create'])>0) {
    $tmp[] = "(createdt<='".$searchData['search_e_create']." 23:59:59')";
}
if (strlen($search_unreg)>0) {
    if ((strlen($searchData['search_s_entry'])>0) && (strlen($searchData['search_e_entry'])>0)) {
        $tmp[] = "(((entrydt>='".$searchData['search_s_entry']." 00:00:00') AND (entrydt<='".$searchData['search_e_entry']." 23:59:59')) OR entrydt IS NULL)";
    } elseif (strlen($searchData['search_s_entry'])>0) {
        $tmp[] = "((entrydt>='".$searchData['search_s_entry']." 00:00:00') OR entrydt IS NULL)";
    } elseif (strlen($searchData['search_e_entry'])>0) {
        $tmp[] = "((entrydt<='".$searchData['search_e_entry']." 23:59:59') OR entrydt IS NULL)";
    } else {
        $tmp[] = "(entrydt IS NULL)";
    }
} else {
    if (strlen($searchData['search_s_entry'])>0) {
        $tmp[] = "(entrydt>='".$searchData['search_s_entry']." 00:00:00')";
    }
    if (strlen($searchData['search_e_entry'])>0) {
        $tmp[] = "(entrydt<='".$searchData['search_e_entry']." 23:59:59')";
    }
}

if (count($tmp)>0) {
    $where = " WHERE ".implode(" AND ", $tmp);
}


$openclose = " fClose";
$formbg = " closeform";
if (!empty($where)) {
    $openclose = " ";
    $formbg = " openform";
}




require_once './db/serials.php';
$serialcodes = new cls_v_serialcodes();

$cnt = countVSCodes($where);
$maxPage = ceil($cnt / $limitRow);

$offset = $limitRow * ($page - 1);

$serialcodes = getSCodesLimit($limitRow, $offset, $where);

$html = '';
foreach ($serialcodes as $serialcode) {
    $html .= '<tr>';
    $html .= '<td>'.$serialcode->sc_code.'</td>';
    $html .= '<td>'.substr($serialcode->createdt, 0, 10).'</td>';
    if (empty($serialcode->entrydt)) {
        $html .= '<td>--</td>';
    } else {
        $html .= '<td>'.substr($serialcode->entrydt, 0, 10).'</td>';
    }
    if (empty($serialcode->sc_point)) {
        $html .= '<td>--</td>';
    } else {
        $html .= '<td>'.$serialcode->sc_point.'</td>';
    }
    if (empty($serialcode->m_name)) {
        $html .= '<td>--</td>';
    } else {
        $html .= '<td>'.$serialcode->m_name.'</td>';
    }
    $html .= '</tr>';
}

$pHtml = '';

for ($i = 1; $i <= $maxPage; ++$i) {
    if ($i<6) {
        $pHtml .= "<a href='javascript:paging(".$i.")'>".$i.'</a>&nbsp;&nbsp;';
    } elseif (($i > ($page-3)) && ($i < ($page+3))) {
        $pHtml .= "<a href='javascript:paging(".$i.")'>".$i.'</a>&nbsp;&nbsp;';
    } elseif ($i > ($maxPage-6)) {
        $pHtml .= "<a href='javascript:paging(".$i.")'>".$i.'</a>&nbsp;&nbsp;';
    } else {
        $pHtml .= ".";
    }

//         $pHtml .= "<a href='javascript:paging(".$i.")'>".$i.'</a>&nbsp;&nbsp;';
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
        <input type='hidden' name='paging' value=''>
    </form>

    <?php include './a_menu.php'; ?>

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
                                    <label for="inputType1">シリアルコード-></label>
                                    <input type="text" class="form-control w30p search" name="search_code"
                                        value="<?php echo $searchData['search_code']; ?>">
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <label>
                                        <input type="checkbox" class="form-check-input" name="ichi"
                                            <?php echo $searchData['ichi']; ?>> 完全一致 <i class="input-frame"></i>
                                    </label>
                                </div>
                                <div class="col-md-12 showcase_text_area">
                                    <label for="inputType1">作成日-></label>
                                    <input type="date" class="form-control w30p search" name="search_s_create"
                                        value="<?php echo $searchData['search_s_create']; ?>" autocomplete="off">　〜　
                                    <input type="date" class="form-control w30p search" name="search_e_create"
                                        value="<?php echo $searchData['search_e_create']; ?>" autocomplete="off">
                                </div>
                                <div class="col-md-12 showcase_text_area">
                                    <label for="inputType1">登録日-></label>
                                    <input type="date" class="form-control w30p search" name="search_s_entry"
                                        value="<?php echo $searchData['search_s_entry']; ?>" autocomplete="off">　〜　
                                    <input type="date" class="form-control w30p search" name="search_e_entry"
                                        value="<?php echo $searchData['search_e_entry']; ?>" autocomplete="off">
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <label>
                                        <input type="checkbox" class="form-check-input" name="unreg"
                                            <?php echo $searchData['unreg']; ?>> 未登録を含める <i class="input-frame"></i>
                                    </label>
                                </div>
                                <div class="col-md-12 showcase_text_area">
                                    <label for="inputType1">保有ポイント-></label>
                                    <input type="number" class="form-control w20p search" name="search_min_point"
                                        value="<?php echo $searchData['search_min_point']; ?>" autocomplete="off">　〜　
                                    <input type="number" class="form-control w20p search" name="search_max_point"
                                        value="<?php echo $searchData['search_max_point']; ?>" autocomplete="off">
                                </div>
                                <div class="col-md-12 showcase_text_area">
                                    <label for="inputType1">ユーザ名-></label>
                                    <input type="text" class="form-control w50p search" name="search_name"
                                        value="<?php echo $searchData['search_name']; ?>">
                                </div>
                                <div class="col-md-12 showcase_text_area">
                                    <label for="inputType1">表示件数-></label>
                                    <label class="radio-label mr-4">
                                        <input name="search_rows" type="radio" value="10"
                                            <?php echo $search_rows_10; ?>>１０件 <i class="input-frame"></i>
                                            <input name="search_rows" type="radio" value="100"
                                            <?php echo $search_rows_100; ?>>１００件 <i class="input-frame"></i>
                                        <input name="search_rows" type="radio" value="300"
                                            <?php echo $search_rows_300; ?>>３００件 <i class="input-frame"></i>
                                        <input name="search_rows" type="radio" value="500"
                                            <?php echo $search_rows_500; ?>>５００件 <i class="input-frame"></i>
                                    </label>
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary btn-block mt-0" name="search">検索</button>
                        </form>

                        <span class="clrRed"><?php echo $errorMessage ?></span>
                    </div>
                </div>





                <?php echo $pHtml; ?>
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>シリアルコード</th>
                            <th>作成日</th>
                            <th>登録日</th>
                            <th>獲得ポイント</th>
                            <th>ユーザ名</th>
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