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
    doUnPay($_POST['id'], $_POST['owner'], $_POST['cost']);
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
    $html.='<form name="form" method="post" action="" style="margin: 0px 0px;">';
    $html.='<td>'.date('Y-m-d H:i:s', $returnss->regist).'</td>';
    $html.='<td>'.$returnss->name.'</td>';
    $html.='<td>'.$returnss->cost.'</td>';
    $html.='<td><input type="submit" value="換金取消"></td>';
    $html.='<input name="fixed" type="hidden" value="1">';
    $html.='<input name="owner" type="hidden" value="'.$returnss->owner.'">';
    $html.='<input name="id" type="hidden" value="'.$returnss->id.'">';
    $html.='<input name="cost" type="hidden" value="'.$returnss->cost.'">';
    $html.='</td>';
    $html.='</form>';
    $html.='</tr>';
}


?>

<div id="inc_side_body">

    <div class="topics">HOME &gt; 換金 &gt; <span>換金取消</span></div>

    <form name="form" method="post" action="" style="margin: 0px 0px;">
        <input name="search" type="hidden" value="1">

        <!--アクセスリスト-->
        <!--
        <div class="topics_accs_list">
            <dl>
                <dt>項目名または広告ID</dt>
                <dd>
                    <input type="text" name="search_adware" value="<?php echo $_POST['search_adware'] ?>" size="30" maxlength="20" required />
                    を&nbsp;<input type="submit" value="表示する">
                </dd>
            </dl>
        </div>
-->
        <!--topics_list_END-->

    </form>



    <div class="search_accs">
        <table class="search_accs_table">
            <tr>
                <th width="140">換金処理日時</th>
                <th width="200">アフィリエイター</th>
                <th width="140">報酬金額</th>
                <th>換金取消</th>
            </tr>

            <?php echo $html; ?>

        </table>
    </div>


    </div>

    <?php include 'x10c_footer.php';?>