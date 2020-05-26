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
if (empty($LOGIN_ID)) {
    header('Location: x10c_session_err.php');
}

$search_pay = isset($_POST['search_pay']) ? $_POST['search_pay']: 5000;

$dayHtml='';
for ($i = 0; $i < 50; $i++) {
    $wk = ($i==$pastday) ? " selected" : "";
    $dayHtml .= '<option value="'.$i.'" '.$wk.'>'.$i."</option>";
}


if (isset($_POST['fixed'])) {
    $payNusers = $_POST['payNuser'];
    foreach ($payNusers as $payNuser) {
        $data = explode('_', $payNuser);
        doPay($data[0], $data[1]);
    }
}

$nusers = getNuserByPay($search_pay);



if ($LOGIN_TYPE=='admin') {
    include 'x10c_header_admin.php';
} else {
    include 'x10c_header_cuser.php';
}

$html='';
foreach ($nusers as $nuser) {
    $html.='<tr>';
    $html.='';
    $html.='<td class="t_left">'.$nuser->id.'</td>';
    $html.='<td class="t_left">'.$nuser->name.'</td>';
    $html.='<td>'.$nuser->pay.'</td>';
    $html.='<td><input type="checkbox" name="payNuser[]" value="'.$nuser->id.'_'.$nuser->pay.'" />　支払う</td>';
    $html.='';
    $html.='<input name="search" type="hidden" value="1">';
    $html.='</td>';
    $html.='';
    $html.='</tr>';
}


?>

<div id="inc_side_body">

    <div class="topics">HOME &gt; アクセスリスト &gt; <span>検索結果一覧</span></div>

    <form name="form" method="post" action="" style="margin: 0px 0px;">
        <input name="search" type="hidden" value="1">

        <!--アクセスリスト-->
        <div class="topics_accs_list">
            <dl>
                <dt>金額指定</dt>
                <dd>
                <input type="number" name="search_pay" value="<?php echo $search_pay; ?>" size="15" maxlength="6" required />
                    &nbsp;円を超えたアフィリエイターを&nbsp;<input type="submit" value="表示する">
                </dd>
            </dl>
        </div>
        <!--topics_list_END-->

    </form>



    <div class="search_accs">
        <table class="search_accs_table">
            <form name="form" method="post" action="" style="margin: 0px 0px;">
            <input name="fixed" type="hidden" value="1">
            <tr>
                <td colspan=5><input type="submit" style="width:90%" value="報酬確定"></td>
            </tr>
            <tr>
                <th width="140">ID</th>
                <th width="200">アフィリエイター</th>
                <th>報酬金額</th>
                <th>報酬確定</th>
            </tr>

            <?php echo $html; ?>
            </form>
        </table>
    </div>


    </div>

    <?php include 'x10c_footer.php';?>