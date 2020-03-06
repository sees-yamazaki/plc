<?php
session_start();

include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';
include 'x10c/db/x10.php';
include 'x10c/db/adwares.php';
//include 'x10c/db/dns.php';
//require('custom/conf.php');
// require('x10c/db/x10.php');
// require('x10c/db/adwares.php')


$LOGIN_ID = $_SESSION[ $SESSION_NAME ];
$LOGIN_TYPE = $_SESSION[ $SESSION_TYPE ];

$id = empty($_GET['id']) ? $_POST['id'] : $_GET['id'];
$pid = empty($_GET['pid']) ? $_POST['pid'] : $_GET['pid'];

if (isset($_POST['doEdit'])) {
    $user='';
    $stts = $_POST['stts'];
    foreach ($stts as $sts) {
        $ss = explode(":", $sts);
        updateX10Offer($id, $ss[1], $ss[0]);
        if ($ss[0]=="2") {
            $user.=$ss[1].PHP_EOL;
        }
    }
    updateAdwareOpenUser($id, $user);

    header('Location: x10c_offer_edited.php');
}


$adware = new cls_adwares();
$adware= getAdware($id);


if ($LOGIN_TYPE=='admin') {
    include 'x10c_header_admin.php';
} else {
    include 'x10c_header_cuser.php';
}


$txt_adtype="目標達成タイプ";
if ($adware->adware_type=="1") {
    $txt_adtype="クリック報酬タイプ";
}



?>

<div id="inc_side_body">

    <div class="topics">HOME &gt; 広告の編集 &gt; <span>対象ユーザー</span> &gt; 登録完了</div>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="search_list">
            <dl>
                <dd>
                    <table class="search_list_table" summary="詳細テーブル">
                        <tbody>
                            <tr>
                                <th>広告タイプ</th>
                                <td>
                                    <?php echo $txt_adtype; ?>
                                    <input type="hidden" name="adware_type"
                                        value="<?php echo $adware->adware_type; ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>成果表示名</th>
                                <td>
                                    <?php echo $adware->name; ?>
                                    <input type="hidden" name="adware_type"
                                        value="<?php echo $adware->name; ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>広告説明文</th>
                                <td>
                                    <?php echo $adware->comment; ?>
                                    <input type="hidden" name="adware_type"
                                        value="<?php echo $adware->comment; ?>">
                                </td>
                            </tr>
                            <?php if ($adware->adware_type=="0") { ?>
                            <tr>
                                <th>獲得単価</th>
                                <td>
                                    <?php echo $adware->money; ?>
                                    <input type="hidden" name="adware_type"
                                        value="<?php echo $adware->commmoneyent; ?>">
                                </td>
                            </tr>
                            <?php } else { ?>
                            <tr>
                                <th>クリック単価</th>
                                <td>
                                    <?php echo $adware->click_money; ?>
                                    <input type="hidden" name="adware_type"
                                        value="<?php echo $adware->click_money; ?>">
                                </td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <th>対象ユーザー</th>
                                <td>
                                    <?php
                                    $offer = getOffer($id);
                                    $i=0;
                                    foreach ($offer as $ofr) {
                                        $stts = array('','','');
                                        $stts[$ofr->status] = ' checked';
                                        echo "<input type='radio' name='stts[".$i."]' value='0:".$ofr->nuser."'".$stts[0].">承認待ち</input>　" ;
                                        echo "<input type='radio' name='stts[".$i."]' value='1:".$ofr->nuser."'".$stts[1].">否認</input>　" ;
                                        echo "<input type='radio' name='stts[".$i."]' value='2:".$ofr->nuser."'".$stts[2].">承認</input>　" ;
                                        echo "　　<a href='x10c_nuser_info.php?nuser=".$ofr->nuser."&id=".$id."'>".$ofr->nuser."</a><br>" ;
                                        $i++;
                                    }

                                    ?>
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </dd>
            </dl>
        </div>

        <div class="input_box">
            <input type="submit" value="登録する" class="input_base">
            <input type="reset" value="リセット" class="input_base">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="doEdit" value="0">
            <?php if ($pid=="ad") { ?>
                <br><br><input type="button" value="戻る" class="input_base" onclick="location.href='x10c_adwares_edit.php?id=<?php echo $id; ?>'">
            <?php } ?>
        </div>
    </form>

</div>


<?php include 'x10c_footer.php';
