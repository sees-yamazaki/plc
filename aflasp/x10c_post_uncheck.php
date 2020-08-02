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


$dayHtml='';
for ($i = 0; $i < 50; $i++) {
    $wk = ($i==$pastday) ? " selected" : "";
    $dayHtml .= '<option value="'.$i.'" '.$wk.'>'.$i."</option>";
}


if (isset($_POST['fixed'])) {
    delCost($_POST['adwares'], $_POST['owner'], $_POST['cost']);
}

if (isset($_POST['search'])) {
    $pDay =  strtotime("-30 day");

    $where = " WHERE `pay`.`state`<>0 AND (`pay`.`adwares`='".$_POST['search_adware']."' OR `ad`.`name` LIKE '%".$_POST['search_adware']."%' ) AND `pay`.regist>".$pDay;

    $posts = getPosts($where);
}





if ($LOGIN_TYPE=='admin') {
    include 'x10c_header_admin.php';
} else {
    include 'x10c_header_cuser.php';
}

$html='';
foreach ($posts as $post) {
    $html.='<tr>';
    $html.='<form name="form" method="post" action="" style="margin: 0px 0px;">';
    $html.='<td>'.date('Y-m-d H:i:s', $post->regist).'</td>';
    $html.='<td>'.$post->name.'</td>';
    $html.='<td>'.$post->cost.'</td>';


    $user = getNuser($post->owner);

    $txt = '';
    $sns = getNuserX10($post->owner);
    if (!empty($sns->instagram)) {
        $txt .= '[instagram]<a href="https://www.instagram.com/'.str_replace('@', '', $sns->instagram).'" target="_blank" class="text-link text-underline">'.$sns->instagram."</a><br>";
    }
    if (!empty($sns->facebook)) {
        $txt .= '[facebook]<a href="https://www.facebook.com/'.str_replace('@', '', $sns->facebook).'" target="_blank" class="text-link text-underline">'.$sns->facebook."</a><br>";
    }
    if (!empty($sns->twitter)) {
        $txt .= '[twitter]<a href="https://twitter.com/'.str_replace('@', '', $sns->twitter).'"
        target="_blank" class="text-link text-underline">'.$sns->twitter."</a><br>";
    }
    if (!empty($sns->youtube)) {
        $txt .= '[youtube]<a href="https://www.youtube.com/user/'.str_replace('@', '', $sns->youtube).'"
        target="_blank" class="text-link text-underline">'.$sns->youtube."</a><br>";
    }
    if (empty($txt)) {
        $txt .= 'SNSアカウントは設定されていません';
    }
    $html.='<td class="t_left">'.$user->name."<br>".$txt.'</td>';
    if ($post->state==2) {
        $html.='<td><input type="submit" value="確定取消"></td>';
        $html.='<input name="cost" type="hidden" value="'.$post->cost.'">';
    } else {
        $html.='<td><input type="submit" value="否認取消"></td>';
        $html.='<input name="cost" type="hidden" value="0">';
    }
    $html.='<input name="fixed" type="hidden" value="1">';
    $html.='<input name="search" type="hidden" value="1">';
    $html.='<input name="owner" type="hidden" value="'.$post->owner.'">';
    $html.='<input name="adwares" type="hidden" value="'.$post->adwares.'">';
    $html.='<input name="search_adware" type="hidden" value="'.$_POST['search_adware'].'">';
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
                <dt>広告名または広告ID</dt>
                <dd>
                    <input type="text" name="search_adware" value="<?php echo $_POST['search_adware'] ?>" size="30" maxlength="20" required />
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
                <th width="120">広告名</th>
                <th>報酬金額</th>
                <th>アフィリエイター</th>
                <th>報酬確定</th>
            </tr>

            <?php echo $html; ?>

        </table>
    </div>


    </div>

    <?php include 'x10c_footer.php';?>