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
$cnt_click_0 = countMonthlyClicks($thisY, $thisM, $LOGIN_ID, 0);
$pays_0 = countMonthlyPays($thisY, $thisM, $LOGIN_ID, 0);
$cnt_click_1 = countMonthlyClicks($thisY, $thisM, $LOGIN_ID, 1);
$pays_1 = countMonthlyPays($thisY, $thisM, $LOGIN_ID, 1);


$ads = getAdwaresRecentry(7);

$rcntyHtml='';
foreach($ads as $ad){
    $rcntyHtml .= '<tr><td>';
    if ($ad->adware_type=="0") {
        $rcntyHtml .= '[目標]';
    }else{
        $rcntyHtml .= '[クリック]';
    }
    if ($ad->approvable=="1") {
        $rcntyHtml .= '</td><td><a href="x10n_adwares_info.php?id='.$ad->id.'">'.$ad->name.'</a></td><td>';
    }else{
        $rcntyHtml .= '</td><td><a href="x10n_adwares_info.php?id='.$ad->id.'">'.$ad->name.'</a> [承認制]</td><td>';
    }
    $rcntyHtml .= '</td></tr>';
}



?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo ""; ?></title>
    <link rel="stylesheet" href="x10n/css/main.css">
</head>

<body>


    <?php if (!empty($errorMessage)) { ?>
    <span class="err"><?php echo $errorMessage; ?></span>
    <?php } ?>
    今月の成果<br>

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
            <td><?php echo ($cnt_click_0 + $cnt_click_1); ?>件</td>
            <td><?php echo ($pays_0->cnt + $pays_1->cnt); ?>件</td>
            <td><?php echo ($pays_0->cnt2 + $pays_1->cnt2); ?>件</td>
            <td><?php echo ($pays_0->cst0 + $pays_0->cst1 + $pays_1->cst0 + $pays_1->cst1); ?>円</td>
            <td><?php echo ($pays_0->cst2 + $pays_1->cst2); ?>円</td>
            <td><?php echo ($pays_0->cnt0 + $pays_0->cnt1 + $pays_1->cnt0 + $pays_1->cnt1); ?>件</td>
        </tr>
        <tr>
            <td colspan=6>もっと見る</td>
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
            <td><?php echo ($pays_0->cst0 + $pays_0->cst1); ?>円</td>
            <td><?php echo $pays_0->cst2; ?>円</td>
            <td><?php echo ($pays_0->cnt0 + $pays_0->cnt1); ?>件</td>
        </tr>
        <tr>
            <td colspan=6>もっと見る</td>
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
            <td><?php echo ($pays_1->cst0 + $pays_1->cst1); ?>円</td>
            <td><?php echo $pays_1->cst2; ?>円</td>
            <td><?php echo ($pays_1->cnt0 + $pays_1->cnt1); ?>件</td>
        </tr>
        <tr>
            <td colspan=6>もっと見る</td>
        </tr>
    </table>

    <br><br>
    新着オファー<br>
    <table>
        <?php echo  $rcntyHtml; ?>
        <tr>
            <td colspan=2>オファー一覧へ</td>
        </tr>
    </table>

    <br><br>
    承認制オファー概要<br>
    <table>
    </table>

<br><br>
    <input type="button" onclick="location.href='x10n_result_list.php'" value="成果情報">
    <br><br>
    <input type="button" onclick="location.href='x10n_adwares_search.php'" value="オファー一覧へ">
</body>

</html>