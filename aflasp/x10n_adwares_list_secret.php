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
if(empty($LOGIN_ID)){ header('Location: x10n_logoff.php'); }

$id = empty($_GET['id']) ? $_POST['id'] : $_GET['id'];

// 自身がオファー申請中の広告を全て取得する
$offering = getOfferingAdware($LOGIN_ID);
$html1 = '';
foreach ($offering as $ofr) {
    $wk = $ofr->adware_type=="0" ? "[目標]" : "[クリック]";
    $html1 .= '<tr><td>'.$wk.'</td><td><a href="x10n_adwares_info.php?id='.$ofr->adware.'#url">'.$ofr->name.'</a></td></tr>';
}
if (empty($html1)) {
    $html1 = '承認待ちオファーはありません';
}


$pays = getPaysX10($LOGIN_ID);
foreach ($pays as $pay) {
    $pay->stts = isAdwareFinish(getAdwareStatus($pay->id));
}
// $pays = countMonthlyPaysGroupsAll($LOGIN_ID,0);
// $clickpays = countMonthlyPaysGroupsAll($LOGIN_ID,1);

$today = date('Y-m-d');

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

リクエスト結果待機中<br>
<br>

<table>
    <?php echo $html1; ?>
</table>

<br>
承認済み進行中オファー<br>
<br>
<br>

目的報酬<br>
<table>
        <tr>
            <td>案件名</td>
            <td>クリック</td>
            <td>発生成果</td>
            <td>確定成果</td>
            <td>未確定成果</td>
            <td>確定報酬</td>
            <td></td>
        </tr>
        <?php foreach ($pays as $pay) { ?>
        <?php if ($pay->approvable=="1" && $pay->adware_type=="0" && $pay->stts=="0" ) { ?>
        <tr>
            <td><a href='x10n_adwares_info.php?id=<?php echo $pay->id; ?>#url'><?php echo $pay->name; ?></a></td>
            <?php $cnt = countClicksAdwares($LOGIN_ID, $pay->id); ?>
            <td><?php echo $cnt; ?>件</td>
            <td><?php echo $pay->cnt; ?>件</td>
            <td><?php echo $pay->cnt2; ?>件</td>
            <td><?php echo($pay->cst0 + $pay->cst1); ?>円</td>
            <td><?php echo $pay->cst2; ?>円</td>
            <?php $wk = $cnt>0 ? "成果発生中" : "掲載用URL表示"; ?>
            <td><a href='x10n_adwares_info.php?id=<?php echo $pay->id; ?>#url'><?php echo $wk; ?></a></td>
        </tr>
        <?php } ?>
        <?php } ?>
    </table>

    <br>
    クリック報酬<br>
<table>
        <tr>
            <td>案件名</td>
            <td>クリック</td>
            <td>発生成果</td>
            <td>確定成果</td>
            <td>未確定成果</td>
            <td>確定報酬</td>
            <td></td>
        </tr>
        <?php foreach ($pays as $pay) { ?>
        <?php if ($pay->approvable=="1" && $pay->adware_type=="1" && $pay->stts=="0" ) { ?>
        <tr>
            <td><a href='x10n_adwares_info.php?id=<?php echo $pay->id; ?>'><?php echo $pay->name; ?></a></td>
            <?php $cnt = countClicksAdwares($LOGIN_ID, $pay->id); ?>
            <td><?php echo $cnt; ?>件</td>
            <td><?php echo $pay->cnt; ?>件</td>
            <td><?php echo $pay->cnt2; ?>件</td>
            <td><?php echo($pay->cst0 + $pay->cst1); ?>円</td>
            <td><?php echo $pay->cst2; ?>円</td>
            <?php $wk = $cnt>0 ? "成果発生中" : "掲載用URL表示"; ?>
            <td><a href='x10n_adwares_info.php#url?id=<?php echo $pay->id; ?>'><?php echo $wk; ?></a></td>
        </tr>
        <?php } ?>
        <?php } ?>
    </table>

    <br>
    掲載終了オファー<br>
<br>
<br>

目的報酬<br>
<table>
        <tr>
            <td>案件名</td>
            <td>クリック</td>
            <td>発生成果</td>
            <td>確定成果</td>
            <td>未確定成果</td>
            <td>確定報酬</td>
            <td></td>
        </tr>
        <?php foreach ($pays as $pay) { ?>
        <?php if ($pay->approvable=="1" && $pay->adware_type=="0" && $pay->stts=="1" ) { ?>
        <tr>
            <td><a href='x10n_adwares_info.php?id=<?php echo $pay->id; ?>'><?php echo $pay->name; ?></a></td>
            <?php $cnt = countClicksAdwares($LOGIN_ID, $pay->id); ?>
            <td><?php echo $cnt; ?>件</td>
            <td><?php echo $pay->cnt; ?>件</td>
            <td><?php echo $pay->cnt2; ?>件</td>
            <td><?php echo($pay->cst0 + $pay->cst1); ?>円</td>
            <td><?php echo $pay->cst2; ?>円</td>
            <?php $wk = $cnt>0 ? "成果発生中" : "掲載用URL表示"; ?>
            <td><a href='x10n_adwares_info.php#url?id=<?php echo $pay->id; ?>'><?php //echo $wk; ?></a></td>
        </tr>
        <?php } ?>
        <?php } ?>
    </table>

    <br>
    クリック報酬<br>
<table>
        <tr>
            <td>案件名</td>
            <td>クリック</td>
            <td>発生成果</td>
            <td>確定成果</td>
            <td>未確定成果</td>
            <td>確定報酬</td>
        </tr>
        <?php foreach ($pays as $pay) { ?>
        <?php if ($pay->approvable=="1" && $pay->adware_type=="1" && $pay->stts=="1" ) { ?>
        <tr>
            <td><a href='x10n_adwares_info.php?id=<?php echo $pay->id; ?>'><?php echo $pay->name; ?></a></td>
            <?php $cnt = countClicksAdwares($LOGIN_ID, $pay->id); ?>
            <td><?php echo $cnt; ?>件</td>
            <td><?php echo $pay->cnt; ?>件</td>
            <td><?php echo $pay->cnt2; ?>件</td>
            <td><?php echo($pay->cst0 + $pay->cst1); ?>円</td>
            <td><?php echo $pay->cst2; ?>円</td>
        </tr>
        <?php } ?>
        <?php } ?>
    </table>

    <br><br>
<input type="button" onclick="location.href='x10n_home.php'" value="トップへ">

</body>

</html>