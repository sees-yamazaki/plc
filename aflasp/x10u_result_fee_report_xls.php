<?php
include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';
include 'x10c/db/adwares.php';
include 'x10c/db/x10.php';

include_once("xlsxwriter.class.php");

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


$filename = 'data_'.$tgtYM.'.xlsx';
header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');

$writer = new XLSXWriter();
$writer->setAuthor('Some Author');

$head_row = array(
    "振込年月"
   ,"対象年月"
   ,"成果報酬額・税込"
   ,"成果報酬額・税別"
   ,"成果報酬額・税金"
   ,"先月繰越金額"
   ,"振込対象金額"
   ,"手数料"
   ,"振込金額"
   ,"繰越金額"
   );

$writer->writeSheetRow('Sheet1', $head_row);




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

    //支払いは当月
    $stt = strtotime($tgtY.'-'.$i.'-01 00:00:00');
    $end = strtotime(date('Y-m-d 23:59:59', mktime(0, 0, 0, $i + 1, 0, $tgtY)));
    $where = " AND regist  BETWEEN ".$stt." AND ".$end;
    $tmp_pay = getTotalPay($where, $LOGIN_ID);

    $oe = $oe=='even' ? "odd" : "even";
//     $dataHtml2 ='<tr class="'.$oe.'">';
//     $dataHtml2 .='<td>'.$tgtY.'年'.$i.'月</td>';
//     $dataHtml2 .='<td class="sitename">'.$kijun.'</td>';
//     $dataHtml2 .='<td>'.number_format(round($tmp_cost * 1.1)).'</td>';//成果報酬額・税込
//     $dataHtml2 .='<td>'.number_format($tmp_cost).'</td>';//成果報酬額・税別
//     $dataHtml2 .='<td>'.number_format(round($tmp_cost * 0.1)).'</td>';//成果報酬額・税金
//     $dataHtml2 .='<td>'.number_format($carry).'</td>';//先月繰越金額
//     $dataHtml2 .='<td>'.number_format($carry+round($tmp_cost * 1.1)).'</td>';//振込対象金額
//     $dataHtml2 .='<td>00</td>';//手数料
//     $dataHtml2 .='<td class="bold bgcheck">'.number_format($tmp_pay).'</td>';//振込金額

    $carry2 = $carry + $tmp_cost - $tmp_pay;
//     $dataHtml2 .='<td>'.number_format($carry).'</td>';//繰越金額
//     $dataHtml2 .='</tr>';

//     $dataHtml = $dataHtml2.$dataHtml;
    $data_row = array(
        $tgtY.'年'.$i.'月',
        $kijun,
        round($tmp_cost * 1.1),
        $tmp_cost,
        round($tmp_cost * 0.1),
        $carry,
        $carry+round($tmp_cost * 1.1),
        0,
        $tmp_pay,
        $carry2
    );
    $writer->writeSheetRow('Sheet1', $data_row);

    $carry = $carry2;

    if (date('Ym', $stt) == date('Ym', strtotime("NOW"))) {
        break;
    }
}

echo $writer->writeToString();
exit(0);
