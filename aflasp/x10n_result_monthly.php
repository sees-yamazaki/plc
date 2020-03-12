<?php
include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';
include 'x10c/db/adwares.php';
include 'x10c/db/x10.php';

// セッション再開
session_start();

$LOGIN_ID = $_SESSION[ $SESSION_NAME ];
if(empty($LOGIN_ID)){ header('Location: x10n_logoff.php'); }

//Timezone
date_default_timezone_set('Asia/Tokyo');

// エラーメッセージの初期化
$errorMessage = '';

$adtype =  isset($_GET['adtype']) ? $_GET['adtype'] : $_POST['adtype'] ;

$thisY = empty($_POST['thisY']) ? date('Y') : $_POST['thisY'];
$thisM = empty($_POST['thisM']) ? date('m') : $_POST['thisM'];
//$cnt_click = countMonthlyClicks($thisY, $thisM, $LOGIN_ID, $adtype);
//$pays = countMonthlyPaysGroups($thisY, $thisM, $LOGIN_ID, $adtype);
$pays = getPaysX10Monthly($thisY, $thisM, $LOGIN_ID);
$nextYM = date('Ym', strtotime(date($thisY.'-'.$thisM.'-1') . '+1 month'));
$lastYM = date('Ym', strtotime(date($thisY.'-'.$thisM.'-1') . '-1 month'));

$ads = getAdwaresRecentry(7);

$titleHtml='';
$backHtml='';
if ($adtype=="0") {
    $titleHtml .= '目標達成報酬（月別）';
    $backHtml='<a href="x10n_result_action.php?adtype=0">目的達成報酬（発生別）へ</a>';
} else {
    $titleHtml .= 'クリック報酬（月別）';
    $backHtml='<a href="x10n_result_action.php?adtype=1">クリック報酬（発生別）へ</a>';
}

$yHtml='<select name="thisY">';
for ($i = 2020; $i <= date('Y'); $i++) {
    $sd = $i==$thisY ? ' selected' : '';
    $yHtml.="<option value='".$i."' ".$sd.">".$i."</option>";
}
$yHtml.='</select>';
$mHtml='<select name="thisM">';
for ($i = 1; $i <= 12; $i++) {
    $sd = $i==($thisM*1) ? ' selected' : '';
    $mHtml.="<option value='".$i."' ".$sd.">".$i."</option>";
}
$mHtml.='</select>';




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

    <?php echo $titleHtml; ?><br>
    月選択<br>
    <form action="" method="POST" name="frm">
    <?php echo $yHtml; ?><?php echo $mHtml; ?><br>
    <input type="submit" value="表示">
    <input type="hidden" name="adtype" value="<?php echo $adtype; ?>">
    </form>
    <br>

    <?php echo $thisY; ?>年<?php echo $thisM; ?>月の成果一覧<br>

    <table>
        <tr>
            <td>案件名</td>
            <td>クリック</td>
            <td>発生成果</td>
            <td>確定成果</td>
            <td>未確定成果</td>
            <td>確定報酬</td>
            <td>非認証</td>
        </tr>
        <?php foreach($pays as $p){ ?>
        <?php if($p->adware_type==$adtype){ ?>
        <tr>
            <?php $stts = isAdwareFinish(getAdwareStatus($p->id));?>
            <?php $wk =  $stts =="0" ? "": "[終了]"; ?>
            <td><a href='x10n_adwares_info.php?id=<?php echo $p->id; ?>'><?php echo $wk.$p->name; ?></a></td>
            <?php $cnt = countMonthlyClicksAdwares($thisY, $thisM, $LOGIN_ID, $p->id); ?>
            <td><?php echo $cnt; ?>件</td>
            <td><?php echo $p->cnt; ?>件</td>
            <td><?php echo $p->cnt2; ?>件</td>
            <td><?php echo($p->cst0 + $p->cst1); ?>円</td>
            <td><?php echo $p->cst2; ?>円</td>
            <td><?php echo($p->cnt0 + $p->cnt1); ?>件</td>
        </tr>
        <?php } ?>
        <?php } ?>
    </table>

    <table>
        <tr>
        <form action="" method="POST" name="frm">
            <td><input type="submit" value="＜前月へ"></td>
            <input type="hidden" name="thisY" value="<?php echo substr($lastYM,0,4); ?>">
            <input type="hidden" name="thisM" value="<?php echo substr($lastYM,4); ?>">
            <input type="hidden" name="adtype" value="<?php echo $adtype; ?>">
        </form>
        <form action="" method="POST" name="frm">
            <td><input type="submit" value="翌月へ＞"></td>
            <input type="hidden" name="thisY" value="<?php echo substr($nextYM,0,4); ?>">
            <input type="hidden" name="thisM" value="<?php echo substr($nextYM,4); ?>">
            <input type="hidden" name="adtype" value="<?php echo $adtype; ?>">
        </form>
        </tr>
        </table>



    <br><br>
    <?php echo $backHtml; ?><br>
    <a href='x10n_result_list.php?adtype=0'>成果報酬トップへ</a><br><br>
    <input type="button" onclick="location.href='x10n_home.php'" value="トップへ">
</body>

</html>