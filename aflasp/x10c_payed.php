<?php
session_start();

include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';
include 'x10c/db/x10.php';
include 'x10c/db/nuser.php';
include 'x10c/db/adwares.php';
//include 'x10c/db/dns.php';
//require('custom/conf.php');
// require('x10c/db/x10.php');
// require('x10c/db/adwares.php')


$LOGIN_ID = $_SESSION[ $SESSION_NAME ];
$LOGIN_TYPE = $_SESSION[ $SESSION_TYPE ];


if (isset($_POST['fixed'])) {
    $IDs = $_POST['id'];
    foreach ($IDs as $ID) {
        updatePayStatus($ID, '入金済み');
    }
}

$where = " WHERE `returnss`.`state`='入金待ち'";
$returnsses = getReturnsses($where);



if ($LOGIN_TYPE=='admin') {
    include 'x10c_header_admin.php';
} else {
    include 'x10c_header_cuser.php';
}

$html='';
foreach ($returnsses as $returnss) {
    $html.='<tr>';
    $html.='<td>'.date('Y-m-d H:i:s', $returnss->regist).'</td>';
    $html.='<td>'.$returnss->name.'</td>';
    $html.='<td>'.$returnss->cost.'</td>';
    $html.='<td><input type="checkbox" name="id[]" value="'.$returnss->id.'" />　入金済みにする</td>';
    $html.='</td>';
    $html.='</tr>';
}


?>

<div id="inc_side_body">

    <div class="topics">HOME &gt; アクセスリスト &gt; <span>検索結果一覧</span></div>

    <div class="search_accs">
        <table class="search_accs_table">
            <form name="form" method="post" action="" style="margin: 0px 0px;">
            <input name="fixed" type="hidden" value="1">
            <tr>
                <td colspan=5><input type="submit" style="width:90%" value="入金済みにする"></td>
            </tr>
            <tr>
                <th width="140">換金処理日時</th>
                <th width="200">アフィリエイター</th>
                <th width="140">報酬金額</th>
                <th>入金済み処理</th>
            </tr>

            <?php echo $html; ?>
            </form>
        </table>
    </div>


    </div>

    <?php include 'x10c_footer.php';?>