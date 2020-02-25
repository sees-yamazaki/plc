<?php
include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';
include 'x10c/db/adwares.php';
include 'x10c/db/x10.php';

// セッション再開
session_start();

//Timezone
date_default_timezone_set('Asia/Tokyo');

// エラーメッセージの初期化
$errorMessage = '';

$LOGIN_ID = $_SESSION[ $SESSION_NAME ];
$thisY = date('Y');
$thisM = date('m');
// 指定月の目標設定広告のデータを取得
$cnt_click_0 = countMonthlyClicks($thisY, $thisM, $LOGIN_ID, 0);
$pays_0 = countMonthlyPays($thisY, $thisM, $LOGIN_ID, 0);
// 指定月のクリック広告のデータを取得
$cnt_click_1 = countMonthlyClicks($thisY, $thisM, $LOGIN_ID, 1);
$pays_1 = countMonthlyPays($thisY, $thisM, $LOGIN_ID, 1);

// 直近７日間に公開されて、現在公開中の広告を取得する
$ads = getAdwaresRecentry(7);

$rcntyHtml='';
foreach ($ads as $ad) {
    $rcntyHtml .= '<tr><td>';
    if ($ad->adware_type=="0") {
        $rcntyHtml .= '[目標]';
    } else {
        $rcntyHtml .= '[クリック]';
    }
    if ($ad->approvable=="0") {
        $rcntyHtml .= '</td><td><a href="x10n_adwares_info.php?id='.$ad->id.'">'.$ad->name.'</a></td><td>';
    } else {
        $rcntyHtml .= '</td><td><a href="x10n_adwares_info.php?id='.$ad->id.'">'.$ad->name.'</a> [承認制]</td><td>';
    }
    $rcntyHtml .= '</td></tr>';
}
if (empty($rcntyHtml)) {
    $rcntyHtml='＞新着オファーはありません。';
}

// 自身がオファー申請中の広告を全て取得する
$offering = getOfferingAdware($LOGIN_ID);

$html1 = '';
foreach ($offering as $ofr) {
    $wk = $ofr->adware_type=="0" ? "[目標]" : "[クリック]";
    $html1 .= '<tr><td>'.$wk.'</td><td>'.$ofr->name.'</td></tr>';
}
if (empty($html1)) {
    $html1='＞リクエスト申請中のオファーはありません。';
}


$approved = getApprovedAdwareLimit($LOGIN_ID, 3);
$html2 = '';
foreach ($approved as $app) {
    $wk = $app->adware_type=="0" ? "[目標]" : "[クリック]";
    $html2 .= '<tr><td>'.$wk.'</td><td>'.$app->name.'</td></tr>';
}
if (empty($html2)) {
    $html2='＞承認済オファーはありません。';
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo ""; ?>
    </title>
    <link rel="stylesheet" href="x10n/css/main.css">
</head>

<body>


    <?php if (!empty($errorMessage)) { ?>
    <span class="err"><?php echo $errorMessage; ?></span>
    <?php } ?>
    ■今月の成果<br>

    <table>
        <tr>
            <td colspan=6>すべて</td>
        </tr>
        <tr>
            <td>クリック</td>
            <td>発生成果</td>
            <td>確定成果</td>
            <td>未確定成果</td>
            <td>確定報酬</td>
            <td>非認証</td>
        </tr>
        <tr>
            <td><?php echo($cnt_click_0 + $cnt_click_1); ?>件</td>
            <td><?php echo($pays_0->cnt + $pays_1->cnt); ?>件</td>
            <td><?php echo($pays_0->cnt2 + $pays_1->cnt2); ?>件</td>
            <td><?php echo($pays_0->cst0 + $pays_0->cst1 + $pays_1->cst0 + $pays_1->cst1); ?>円
            </td>
            <td><?php echo($pays_0->cst2 + $pays_1->cst2); ?>円</td>
            <td><?php echo($pays_0->cnt0 + $pays_0->cnt1 + $pays_1->cnt0 + $pays_1->cnt1); ?>件
            </td>
        </tr>
        <tr>
            <td colspan=6><a href='x10n_result_list.php'>もっと見る</a></td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td colspan=6>目標報酬</td>
        </tr>
        <tr>
            <td>クリック</td>
            <td>発生成果</td>
            <td>確定成果</td>
            <td>未確定成果</td>
            <td>確定報酬</td>
            <td>非認証</td>
        </tr>
        <tr>
            <td><?php echo $cnt_click_0; ?>件</td>
            <td><?php echo $pays_0->cnt; ?>件</td>
            <td><?php echo $pays_0->cnt2; ?>件</td>
            <td><?php echo($pays_0->cst0 + $pays_0->cst1); ?>円</td>
            <td><?php echo $pays_0->cst2; ?>円</td>
            <td><?php echo($pays_0->cnt0 + $pays_0->cnt1); ?>件</td>
        </tr>
        <tr>
            <td colspan=6><a href='x10n_result_monthly.php?adtype=0'>もっと見る</a></td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td colspan=6>クリック報酬</td>
        </tr>
        <tr>
            <td>クリック</td>
            <td>発生成果</td>
            <td>確定成果</td>
            <td>未確定成果</td>
            <td>確定報酬</td>
            <td>非認証</td>
        </tr>
        <tr>
            <td><?php echo $cnt_click_1; ?>件</td>
            <td><?php echo $pays_1->cnt; ?>件</td>
            <td><?php echo $pays_1->cnt2; ?>件</td>
            <td><?php echo($pays_1->cst0 + $pays_1->cst1); ?>円</td>
            <td><?php echo $pays_1->cst2; ?>円</td>
            <td><?php echo($pays_1->cnt0 + $pays_1->cnt1); ?>件</td>
        </tr>
        <tr>
            <td colspan=6><a href='x10n_result_monthly.php?adtype=1'>もっと見る</a></td>
        </tr>
    </table>

    <br><br>
    ■新着オファー<br>
    <table>
        <?php echo  $rcntyHtml; ?>
        <tr>
            <td colspan=2><a href='x10n_adwares_search.php'>オファー一覧へ</a></td>
        </tr>
    </table>

    <br><br>
    ■承認制オファー概要<br>
    <br>
    リクエスト結果待機中<br>
    <table>
        <?php echo $html1; ?>
    </table>
    <br>
    承認済オファー<br>
    <table>
        <?php echo $html2; ?>
    </table>

    <br><a href='x10n_offer_list.php'>もっと見る</a><br>


    <br><br>
    <input type="button" onclick="location.href='x10n_offer_list.php'" value="承認制オファー概要">
    <br><br>
    <input type="button" onclick="location.href='x10n_result_list.php'" value="成果情報">
    <br><br>
    <input type="button" onclick="location.href='x10n_nuser_info.php'" value="ユーザー情報">

    <br><br>
    <hr>
    <input type="button" onclick="location.href='x10n_logoff.php'" value="ログオフ">


</body>

</html>