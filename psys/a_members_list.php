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

$page = $_POST['page'];
if (!isset($page) || empty($page)) {
    $page = 1;
}

$searchData = array();

if (isset($_POST['back']) || isset($_POST['paging'])) {
    $searchData = getSsn(__CLASS__);
    if (isset($_POST['back'])) {
        $page = $searchData['page'];
    }
} else {
    $searchData['search_min_point'] = $_POST['search_min_point'];
    $searchData['search_max_point'] = $_POST['search_max_point'];
    $searchData['search_s_login'] = $_POST['search_s_login'];
    $searchData['search_e_login'] = $_POST['search_e_login'];
    $searchData['search_name'] = $_POST['search_name'];
    $searchData['search_rows'] = $_POST['search_rows'];
    $searchData['search_min_cnt_entry'] = $_POST['search_min_cnt_entry'];
    $searchData['search_max_cnt_entry'] = $_POST['search_max_cnt_entry'];
    $searchData['search_min_cnt_hit'] = $_POST['search_min_cnt_hit'];
    $searchData['search_max_cnt_hit'] = $_POST['search_max_cnt_hit'];
    $searchData['search_min_cnt_miss'] = $_POST['search_min_cnt_miss'];
    $searchData['search_max_cnt_miss'] = $_POST['search_max_cnt_miss'];
}

//検索条件をセッションに格納
$searchData['page']=$page;
setSsnKV(__CLASS__, $searchData);


$limitRow = 50;
$search_rows_50="";
$search_rows_100="";
$search_rows_300="";
if ($searchData['search_rows']=="300") {
    $limitRow = 300;
    $search_rows_300=" checked";
} elseif ($searchData['search_rows']=="100") {
    $limitRow = 100;
    $search_rows_100=" checked";
} else {
    $limitRow = 10;
    $search_rows_50=" checked";
}


$where = "";

$tmp = array();

if (!empty($searchData['search_name'])) {
    $tmp[] = "(m_name LIKE '%".$searchData['search_name']."%')";
}
if (strlen($searchData['search_min_point'])>0) {
    $tmp[] = "(crnt_point>=".$searchData['search_min_point'].")";
}
if (strlen($searchData['search_max_point'])>0) {
    $tmp[] = "(crnt_point<=".$searchData['search_max_point'].")";
}
if (strlen($searchData['search_s_login'])>0) {
    $tmp[] = "(logindt>='".$searchData['search_s_login']." 00:00:00')";
}
if (strlen($searchData['search_e_login'])>0) {
    $tmp[] = "(logindt<='".$searchData['search_e_login']." 23:59:59')";
}
if (strlen($searchData['search_min_cnt_entry'])>0) {
    $tmp[] = "(sc_cnt>=".$searchData['search_min_cnt_entry'].")";
}
if (strlen($searchData['search_max_cnt_entry'])>0) {
    $tmp[] = "(sc_cnt<=".$searchData['search_max_cnt_entry'].")";
}
if (strlen($searchData['search_min_cnt_hit'])>0) {
    $tmp[] = "(cnt_1>=".$searchData['search_min_cnt_hit'].")";
}
if (strlen($searchData['search_max_cnt_hit'])>0) {
    $tmp[] = "(cnt_1<=".$searchData['search_max_cnt_hit'].")";
}
if (strlen($searchData['search_min_cnt_miss'])>0) {
    $tmp[] = "(cnt_0>=".$searchData['search_min_cnt_miss'].")";
}
if (strlen($searchData['search_max_cnt_miss'])>0) {
    $tmp[] = "(cnt_0<=".$searchData['search_max_cnt_miss'].")";
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



require_once './db/members.php';
$members = new cls_members();

$cnt = getMemberRows($where);
$maxPage = ceil($cnt / $limitRow);

$offset = $limitRow * ($page - 1);

$members = getMembersLimit($limitRow, $offset, $where);

$html = '';
foreach ($members as $member) {
    $html .= '<tr>';
    $html .= '<td>'.$member->m_name.'</td>';
    $html .= '<td>'.$member->crnt_point.'</td>';
    if (empty($member->logindt)) {
        $html .= '<td>--</td>';
    } else {
        $html .= '<td>'.$member->logindt.'</td>';
    }
    $html .= '<td>'.$member->sc_cnt.'</td>';
    $html .= '<td>'.$member->cnt_1.'</td>';
    $html .= '<td>'.$member->cnt_0.'</td>';
    $html .= '<td><button type="button" name="edit" class="btn btn-inverse-secondary" onclick="mmbrView('.$member->m_seq.')">閲覧</button></td>';
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
                                    <label for="inputType1">名前-></label>
                                    <input type="text" class="form-control w50p search" name="search_name"
                                        value="<?php echo $searchData['search_name']; ?>">
                                </div>
                            <div class="col-md-12 showcase_text_area">
                                <label for="inputType1">保有ポイント-></label>
                                <input type="number" class="form-control w20p search" name="search_min_point"
                                    value="<?php echo $searchData['search_min_point']; ?>" autocomplete="off">　〜　
                                <input type="number" class="form-control w20p search" name="search_max_point"
                                    value="<?php echo $searchData['search_max_point']; ?>" autocomplete="off">
                            </div>
                            <div class="col-md-12 showcase_text_area">
                                <label for="inputType1">最終ログイン-></label>
                                <input type="date" class="form-control w30p search" name="search_s_login"
                                    value="<?php echo $searchData['search_s_login']; ?>" autocomplete="off">　〜　
                                <input type="date" class="form-control w30p search" name="search_e_login"
                                    value="<?php echo $searchData['search_e_login']; ?>" autocomplete="off">
                            </div>
                            <div class="col-md-12 showcase_text_area">
                                <label for="inputType1">登録回数-></label>
                                <input type="number" class="form-control w20p search" name="search_min_cnt_entry"
                                    value="<?php echo $searchData['search_min_cnt_entry']; ?>" autocomplete="off">　〜　
                                <input type="number" class="form-control w20p search" name="search_max_cnt_entry"
                                    value="<?php echo $searchData['search_max_cnt_entry']; ?>" autocomplete="off">
                            </div>
                            <div class="col-md-12 showcase_text_area">
                                <label for="inputType1">当り回数-></label>
                                <input type="number" class="form-control w20p search" name="search_min_cnt_hit"
                                    value="<?php echo $searchData['search_min_cnt_hit']; ?>" autocomplete="off">　〜　
                                <input type="number" class="form-control w20p search" name="search_max_cnt_hit"
                                    value="<?php echo $searchData['search_max_cnt_hit']; ?>" autocomplete="off">
                            </div>
                            <div class="col-md-12 showcase_text_area">
                                <label for="inputType1">外れ回数-></label>
                                <input type="number" class="form-control w20p search" name="search_min_cnt_miss"
                                    value="<?php echo $searchData['search_min_cnt_miss']; ?>" autocomplete="off">　〜　
                                <input type="number" class="form-control w20p search" name="search_max_cnt_miss"
                                    value="<?php echo $searchData['search_max_cnt_miss']; ?>" autocomplete="off">
                            </div>
                                <div class="col-md-12 showcase_text_area">
                                    <label for="inputType1">表示件数-></label>
                                    <label class="radio-label mr-4">
                                        <input name="search_rows" type="radio" value="50"
                                            <?php echo $search_rows_50; ?>>１０件 <i class="input-frame"></i>
                                        <input name="search_rows" type="radio" value="100"
                                            <?php echo $search_rows_100; ?>>１００件 <i class="input-frame"></i>
                                        <input name="search_rows" type="radio" value="300"
                                            <?php echo $search_rows_300; ?>>３００件 *ページングのテストのため最小人数は少なくしてあります。<i class="input-frame"></i>
                                    </label>
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary btn-block mt-0" name="search" value="1">検索</button>
                        </form>

                        <span class="clrRed"><?php echo $errorMessage ?></span>
                    </div>
                </div>




                <?php echo $pHtml; ?>

                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>名前</th>
                            <th>保有ポイント</th>
                            <th>最終ログイン</th>
                            <th>登録回数</th>
                            <th>当り回数</th>
                            <th>外れ回数</th>
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