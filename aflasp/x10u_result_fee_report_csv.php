<?php
include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';
include 'x10c/db/adwares.php';
include 'x10c/db/x10.php';

// セッション再開
session_start();

$LOGIN_ID = $_SESSION[ $SESSION_NAME ];
if (empty($LOGIN_ID)) {
    header('Location: x10u_logoff.php');
}

//Timezone
date_default_timezone_set('Asia/Tokyo');

// エラーメッセージの初期化
$errorMessage = '';


$tgtYM = empty($_POST['tgtYM']) ? date('Ym') : $_POST['tgtYM'];
$tgtY = substr($tgtYM, 0, 4);
$tgtM = substr($tgtYM, -2);


header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=data_".$tgtYM.'.csv');
header("Content-Transfer-Encoding: binary");

echo mb_convert_encoding('振込年月,対象年月,成果報酬額・税込,成果報酬額・税別,成果報酬額・税金,先月繰越金額,振込対象金額,手数料,振込金額,繰越金額'.PHP_EOL, "SJIS", "UTF-8");



//対象年以前の報酬と支払いを取得する
//報酬は２ヶ月前基準
$where = " AND regist < ".strtotime(($tgtY-1).'-11-01 00:00:00');
$past_cost = getTotalCost($where, $LOGIN_ID);
//支払いは当月基準
$where = " AND regist < ".strtotime($tgtY.'-01-01 00:00:00');
$past_pay = getTotalPay($where, $LOGIN_ID);
$carry = $past_cost - $past_pay;

$dataHtml ='';
$oe = "even";
for ($i = 1; $i <= 12; $i++) {
    //報酬は２ヶ月前
    $stt = strtotime(date('Y-m-d 00:00:00', mktime(0, 0, 0, $i - 2, 1, $tgtY)));
    $end = strtotime(date('Y-m-d 23:59:59', mktime(0, 0, 0, $i - 1, 0, $tgtY)));
    $kijun = date('Y年n月', $stt);
    $where = " AND regist  BETWEEN ".$stt." AND ".$end;
    $tmp_cost = getTotalCost($where, $LOGIN_ID);
    $tax = round($tmp_cost * 0.09090909);

    //支払いは当月
    $stt = strtotime($tgtY.'-'.$i.'-01 00:00:00');
    $end = strtotime(date('Y-m-d 23:59:59', mktime(0, 0, 0, $i + 1, 0, $tgtY)));
    $where = " AND regist  BETWEEN ".$stt." AND ".$end;
    $tmp_pay = getTotalPay($where, $LOGIN_ID);

    $carry2 = $carry + $tmp_cost - $tmp_pay;


    echo mb_convert_encoding('"'.$tgtY.'年'.$i.'月"', "SJIS", "UTF-8");
    echo ',';
    echo mb_convert_encoding('"'.$kijun.'"', "SJIS", "UTF-8");
    echo ',';
    echo $tmp_cost;
    echo ',';
    echo $tmp_cost-$tax;
    echo ',';
    echo $tax;
    echo ',';
    echo $carry;
    echo ',';
    echo $carry+$tmp_cost;
    echo ',';
    echo '0';
    echo ',';
    echo $tmp_pay;
    echo ',';
    echo $carry2;
    echo PHP_EOL;
    ;

    $carry = $carry2;

    if (date('Ym', $stt) == date('Ym', strtotime("NOW"))) {
        break;
    }
}

exit(0);
