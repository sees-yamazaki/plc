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




if (isset($_POST['fixed'])) {
    updatePayStatus($_POST['id'], '入金待ち');
}

if (isset($_POST['search'])) {
    $where = " WHERE `returnss`.`state`='入金済み' AND (`returnss`.`owner`='".$_POST['search_nuser']."' OR `nuser`.`name` LIKE '%".$_POST['search_nuser']."%' )";

    $returnsses = getReturnsses($where);
}





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
    $html.='<td><input type="submit" value="入金取消し"></td>';
    $html.='<input name="search" type="hidden" value="1">';
    $html.='<input name="fixed" type="hidden" value="1">';
    $html.='<input name="id" type="hidden" value="'.$returnss->id.'">';
    $html.='<input name="search_nuser" type="hidden" value="'.$_POST['search_nuser'].'">';
    $html.='</td>';
    $html.='</form>';
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
                <dt>アフィリエイターまたはアフィリエイターID</dt>
                <dd>
                    <input type="text" name="search_nuser" value="<?php echo $_POST['search_nuser'] ?>" size="30" maxlength="20" required />
                    を&nbsp;<input type="submit" value="表示する">
                </dd>
            </dl>
        </div>
        <!--topics_list_END-->

    </form>



    <div class="search_accs">
        <table class="search_accs_table">
            <tr>
                <th width="140">投稿申請日時</th>
                <th>アフィリエイター</th>
                <th>報酬金額</th>
                <th>入金取消し</th>
            </tr>

            <?php echo $html; ?>

        </table>
    </div>


    </div>

    <?php include 'x10c_footer.php';?>