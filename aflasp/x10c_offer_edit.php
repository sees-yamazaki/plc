<?php
session_start();

include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';
include 'x10c/db/x10.php';
include 'x10c/db/nuser.php';
include 'x10c/db/adwares.php';
include 'x10c/db/system.php';
include 'x10c_mail.php';
//include 'x10c/db/dns.php';
//require('custom/conf.php');
// require('x10c/db/x10.php');
// require('x10c/db/adwares.php')


$LOGIN_ID = $_SESSION[ $SESSION_NAME ];
$LOGIN_TYPE = $_SESSION[ $SESSION_TYPE ];
if (empty($LOGIN_ID)) {
    header('Location: x10c_session_err.php');
}

$id = empty($_GET['id']) ? $_POST['id'] : $_GET['id'];
$pid = empty($_GET['pid']) ? $_POST['pid'] : $_GET['pid'];
$prmOfr = empty($_GET['prmOfr']) ? $_POST['prmOfr'] : $_GET['prmOfr'];
$prmPst = empty($_GET['prmPst']) ? $_POST['prmPst'] : $_GET['prmPst'];



if (isset($_POST['doEdit'])) {
    $user=''; // newStatus : nusr : oldStatus
    $stts = $_POST['stts'];
    $errMsg = '';

    $ad = getAdware($id);
    $money = is_null($ad->money) ? 0 :$ad->money;
    $money_count = is_null($ad->money_count) ? 0 :$ad->money_count;
    foreach ($stts as $sts) {
        $ss = explode(":", $sts);
        if (($ss[2]=="10" && $ss[0]=="12") || ($ss[2]=="11" && $ss[0]=="12")) {
            $money_count = $money_count + $money;
        }
        if (($ss[2]=="12" && $ss[0]=="10") || ($ss[2]=="12" && $ss[0]=="11")) {
            $money_count = $money_count - $money;
        }
    }
    if ($ad->limits>0 && $ad->limits < $money_count) {
        $errMsg = '<tr><td colspan=5 style="color:red;">【広告報酬の上限超過のため確定できませんでした】</td></tr>';
    }


    if ($errMsg=="") {
        foreach ($stts as $sts) {
            $ss = explode(":", $sts);

            updateX10Offer($id, $ss[1], $ss[0]);
            if ($ss[0]=="2" || $ss[0]=="12") {
                $user.=$ss[1].PHP_EOL;
            }


            if (($ss[2]=="10" && $ss[0]=="12") || ($ss[2]=="11" && $ss[0]=="12")) {
                //投稿がOK
                insertPost($id, $LOGIN_ID, $ss[1]);
            } elseif ($ss[0]=="10" || $ss[0]=="11") {
                //投稿がダメ
                deletePost($id, $LOGIN_ID, $ss[1]);
            }

            // 変更前[2]  変更後[0]　
            // 0-承認前　1-否認　2-承認
            // 10-承認前　11-否認　12-承認　<=投稿
            if ($ss[2]<>"2" && $ss[0]=="2") {
                // 【Smafee】承認制広告リクエスト承認のお知らせ
                mail_n04($ss[1], $ad);
            } elseif ($ss[2]<>"1" && $ss[0]=="1") {
                // 【Smafee】承認制広告リクエスト非承認のお知らせ
                mail_n05($ss[1], $ad);
            } elseif ($ss[2]<>"12" && $ss[0]=="12") {
                // 【Smafee】投稿確認完了のお知らせ
                mail_n11($ss[1], $ad);
            } elseif ($ss[2]<>"11" && $ss[0]=="11") {
                // 【Smafee】投稿確認否認のお知らせ
                mail_n12($ss[1], $ad);
            }
        }
        updateAdwareOpenUser($id, $user);
        header('Location: x10c_offer_edited.php');
    }
}


$adware = new cls_adwares();
$adware= getAdware($id);


if ($LOGIN_TYPE=='admin') {
    include 'x10c_header_admin.php';
} else {
    include 'x10c_header_cuser.php';
}


$txt_adtype="成果報酬タイプ";
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
                            <?php echo $errMsg; ?>
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
                            <?php if ($adware->adware_type=="0" || $adware->adware_type=="2") { ?>
                            <tr>
                                <th>獲得単価</th>
                                <td>
                                    <?php echo number_format($adware->money); ?>
                                    <input type="hidden" name="adware_type"
                                        value="<?php echo $adware->commmoneyent; ?>">
                                </td>
                            </tr>
                            <?php } else { ?>
                            <tr>
                                <th>クリック単価</th>
                                <td>
                                    <?php echo number_format($adware->click_money); ?>
                                    <input type="hidden" name="adware_type"
                                        value="<?php echo $adware->click_money; ?>">
                                </td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <th>対象ユーザー</th>
                                <td>
                                    <?php
                                    $where = empty($prmPst) ? ' AND status<10 ' :  ' AND status>=10 ' ;
                                    $offer = getOffer($id, $where);
                                    $i=0;
                                    foreach ($offer as $ofr) {
                                        $stts = array('','','','','','','','','','','','','','');
                                        $stts[$ofr->status] = ' checked';
                                        if ($ofr->status=="0" || $ofr->status=="1" || $ofr->status=="2") {
                                            echo "<input type='radio' name='stts[".$i."]' value='0:".$ofr->nuser.":".$ofr->status."'".$stts[0].">承認待ち</input>　" ;
                                            echo "<input type='radio' name='stts[".$i."]' value='1:".$ofr->nuser.":".$ofr->status."'".$stts[1].">否認</input>　" ;
                                            echo "<input type='radio' name='stts[".$i."]' value='2:".$ofr->nuser.":".$ofr->status."'".$stts[2].">承認</input>　" ;
                                        } else {
                                            echo "<input type='radio' name='stts[".$i."]' value='10:".$ofr->nuser.":".$ofr->status."'".$stts[10].">承認待ち</input>　" ;
                                            echo "<input type='radio' name='stts[".$i."]' value='11:".$ofr->nuser.":".$ofr->status."'".$stts[11].">否認</input>　" ;
                                            echo "<input type='radio' name='stts[".$i."]' value='12:".$ofr->nuser.":".$ofr->status."'".$stts[12].">承認</input>　" ;
                                        }


                                        $user = getNuser($ofr->nuser);

                                        $txt = '';
                                        $sns = getNuserX10($ofr->nuser);
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
                                        $txt = "<span class=''>".$user->name."<br>".$txt."</span><br>";
                                        echo "　　<div class=''>".$ofr->nuser.$txt ."</div><br>" ;
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
            <input type="hidden" name="prmOfr" value="<?php echo $prmOfr; ?>">
            <input type="hidden" name="prmPst" value="<?php echo $prmPst; ?>">
            <input type="hidden" name="doEdit" value="0">
            <?php if ($pid=="ad") { ?>
                <br><br><input type="button" value="戻る" class="input_base" onclick="location.href='x10c_adwares_edit.php?id=<?php echo $id; ?>'">
            <?php } ?>
        </div>
    </form>

</div>


<?php include 'x10c_footer.php';
