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

$id = empty($_GET['id']) ? $_POST['id'] : $_GET['id'];

$offering = getOfferingAdware($LOGIN_ID);
$html1 = '';
foreach($offering as $ofr ){
    $wk = $ofr->adware_type=="0" ? "[目標]" : "[クリック]";
    $html1 .= '<tr><td>'.$wk.'</td><td>'.$ofr->name.'</td></tr>';
}

$pays = countMonthlyPaysGroupsAll($LOGIN_ID,0);
$clickpays = countMonthlyPaysGroupsAll($LOGIN_ID,1);
var_dump($clickpays);
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

オファー進行中<br>
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
        <?php foreach($pays as $pay){ ?>
        <?php if(is_null($pay->enddt) || $pay->enddt >= $today){ ?>
        <tr>
            <td><a href='x10n_adwares_info.php?id=<?php echo $pay->id; ?>'><?php echo $pay->name; ?></a></td>
            <?php $cnt = countClicksAdwares($LOGIN_ID, $pay->id); ?>
            <td><?php echo $cnt; ?>件</td>
            <td><?php echo $pay->cnt; ?>件</td>
            <td><?php echo $pay->cnt2; ?>件</td>
            <td><?php echo($pay->cst0 + $pay->cst1); ?>円</td>
            <td><?php echo $pay->cst2; ?>円</td>
            <td>掲載用URL表示</td>
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
        <?php foreach($clickpays as $clkpay){ ?>
        <?php if(is_null($clkpay->enddt) || $clkpay->enddt >= $today){ ?>
        <tr>
            <td><a href='x10n_adwares_info.php?id=<?php echo $clkpay->id; ?>'><?php echo $clkpay->name; ?></a></td>
            <?php $cnt = countClicksAdwares($LOGIN_ID, $clkpay->id); ?>
            <td><?php echo $cnt; ?>件</td>
            <td><?php echo $clkpay->cnt; ?>件</td>
            <td><?php echo $clkpay->cnt2; ?>件</td>
            <td><?php echo($clkpay->cst0 + $clkpay->cst1); ?>円</td>
            <td><?php echo $clkpay->cst2; ?>円</td>
            <td>掲載用URL表示</td>
        </tr>
        <?php } ?>
        <?php } ?>
    </table>

    <br>
期間終了オファー<br>
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
        <?php foreach($pays as $pay){ ?>
        <?php if(!is_null($pay->enddt) && $pay->enddt < $today){ ?>
        <tr>
            <td><a href='x10n_adwares_info.php?id=<?php echo $pay->id; ?>'><?php echo $pay->name; ?></a></td>
            <?php $cnt = countClicksAdwares($LOGIN_ID, $pay->id); ?>
            <td><?php echo $cnt; ?>件</td>
            <td><?php echo $pay->cnt; ?>件</td>
            <td><?php echo $pay->cnt2; ?>件</td>
            <td><?php echo($pay->cst0 + $pay->cst1); ?>円</td>
            <td><?php echo $pay->cst2; ?>円</td>
            <td>掲載用URL表示</td>
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
        <?php foreach($clickpays as $clkpay){ ?>
        <?php if(!is_null($clkpay->enddt) && $clkpay->enddt < $today){ ?>
        <tr>
            <td><a href='x10n_adwares_info.php?id=<?php echo $clkpay->id; ?>'><?php echo $clkpay->name; ?></a></td>
            <?php $cnt = countClicksAdwares($LOGIN_ID, $clkpay->id); ?>
            <td><?php echo $cnt; ?>件</td>
            <td><?php echo $clkpay->cnt; ?>件</td>
            <td><?php echo $clkpay->cnt2; ?>件</td>
            <td><?php echo($clkpay->cst0 + $clkpay->cst1); ?>円</td>
            <td><?php echo $clkpay->cst2; ?>円</td>
        </tr>
        <?php } ?>
        <?php } ?>
    </table>

    <br><br>
<input type="button" onclick="location.href='x10n_home.php'" value="トップへ">

</body>

</html>