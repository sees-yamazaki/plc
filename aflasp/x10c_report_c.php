<?php
session_start();

include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';
include 'x10c/db/x10.php';
include 'x10c/db/nuser.php';
include 'x10c/db/adwares.php';


$LOGIN_ID = $_SESSION[ $SESSION_NAME ];
$LOGIN_TYPE = $_SESSION[ $SESSION_TYPE ];

$search_y = isset($_POST['search_y']) ? $_POST['search_y']: date('Y');
$search_m = isset($_POST['search_m']) ? $_POST['search_m']: date('n');

$adtype = ['[目標]','[クリック]','[投稿]'];

$yHtml='';
for ($i = 2020; $i <= date('Y'); $i++) {
    $wk = ($i==$search_y) ? " selected" : "";
    $yHtml .= '<option value="'.$i.'" '.$wk.'>'.$i."</option>";
}
$mHtml='';
for ($i = 1; $i <= 12; $i++) {
    $wk = ($i==$search_m) ? " selected" : "";
    $mHtml .= '<option value="'.$i.'" '.$wk.'>'.$i."</option>";
}


$rows = getReportPayC($LOGIN_TYPE, $LOGIN_ID, $search_y, $search_m);

if (isset($_POST['output'])) {
    $file_name = "report_".$search_y."_".$search_m.".csv";
    $fp = fopen('php://output', 'w');

    foreach ($rows as $row) {
        //$data = [$row->cname,$adtype[$row->adware_type],$row->adname,$row->cost,$row->nname,$row->owner];
        $data = [$row->cname,$row->cost,round($row->cost*1.3)];
        fputcsv($fp, $data, ',', '"');
    }
    fclose($fp);
    header('Content-Type: application/octet-stream');
    header("Content-Disposition: attachment; filename={$file_name}");
    header('Content-Transfer-Encoding: binary');
    exit;
}



$html='';
$total=0;
$taxtotal=0;
foreach ($rows as $row) {
    $html.='<tr>';
    $html.='';
    $html.='<td class="t_left">'.$row->cname.'</td>';
    $html.='<td class="t_right">'.number_format($row->cost).'</td>';
    $total = $total + $row->cost;
    $html.='<td class="t_right">'.number_format(round($row->cost*1.3)).'</td>';
    $taxtotal=$taxtotal + round($row->cost*1.3);
    $html.='<input name="search" type="hidden" value="1">';
    $html.='';
    $html.='</tr>';
}

if (!empty($html)) {
    $html.='<tr>';
    $html.='<td class="t_right">合計</td>';
    $html.='<td class="t_right">'.number_format($total).'</td>';
    $html.='<td class="t_right">'.number_format($taxtotal).'</td>';
    $html.='</tr>';
}


if ($LOGIN_TYPE=='admin') {
    include 'x10c_header_admin.php';
} else {
    include 'x10c_header_cuser.php';
}



?>

<div id="inc_side_body">

    <div class="topics">HOME &gt; レポート &gt; <span>成果一覧</span></div>

    <form name="form" method="post" action="" style="margin: 0px 0px;">
        <input name="search" type="hidden" value="1">

        <!--アクセスリスト-->
        <div class="topics_accs_list">
            <dl>
                <dt>対象年月指定</dt>
                <dd>
                <select name="search_y"><?php echo $yHtml; ?></select>&nbsp;
                <select name="search_m"><?php echo $mHtml; ?></select>
                    &nbsp;を&nbsp;<input type="submit" value="表示する">
                </dd>
            </dl>
        </div>
        <!--topics_list_END-->

    </form>



    <div class="search_accs">
        <table class="search_accs_table">
            <form name="form" method="post" action="" style="margin: 0px 0px;">
            <input name="output" type="hidden" value="1">
            <input name="search_y" type="hidden" value="<?php echo $search_y; ?>">
            <input name="search_m" type="hidden" value="<?php echo $search_m; ?>">
            <tr>
                <td colspan=5><input type="submit" style="width:90%" value="CSV出力する"></td>
            </tr>
            <tr>
                <th width="300">広告主</th>
                <th width="200">広告成果総額</th>
                <th>請求額</th>
            </tr>

            <?php echo $html; ?>
            </form>
        </table>
    </div>

    </div>

    <?php include 'x10c_footer.php';?>