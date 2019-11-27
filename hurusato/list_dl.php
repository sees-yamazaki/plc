<?php

//==================================================================================================
// ふるさと納税台帳
//==================================================================================================
	require "./config.inc.php";
    session_start();

	if ($_SESSION["aid"] == 0){ header("Location: ./"); }

    #===================================
    if(!function_exists('strip_magic_quotes_slashes')) {
      if (get_magic_quotes_gpc()) {
        function strip_magic_quotes_slashes($arr) {
          return is_array($arr) ?
            array_map('strip_magic_quotes_slashes', $arr) :
            stripslashes($arr);
        }
        $_GET     = strip_magic_quotes_slashes($_GET);
        $_POST    = strip_magic_quotes_slashes($_POST);
        $_REQUEST = strip_magic_quotes_slashes($_REQUEST);
        $_COOKIE  = strip_magic_quotes_slashes($_COOKIE);
      }
    }
    
    if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') == 0) {
        $in = $_POST;
    } else {
        $in= $_GET;
    }



include_once("./xlsxwriter.class.php");
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);


$filename = "furusato_output.xlsx";
header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');

    global $dbh;
    global $in;
    global $glb;
    global $lcl;
    $ssid = session_id();

$sql = "select";
$sql .= "  d01id";
$sql .= " ,d01date";
$sql .= " ,d01name";
$sql .= " ,d01zip";
$sql .= " ,d01addr";
$sql .= " ,d01price";
$sql .= " ,d01mokuteki";
$sql .= " ,d01pmethod";
$sql .= " ,d01f_open";
$sql .= " ,d01tokurei";
$sql .= " ,d01comm";
$sql .= " ,d01entry_date";
$sql .= " ,d01nyukin_kakunin_date";
$sql .= " ,d01tel";
$sql .= " ,d01fax";
$sql .= " ,d01email";
$sql .= " ,d01cyotei";
$sql .= " ,d01furikomihyo";
$sql .= " ,d01jyuryosyo";
$sql .= " ,d01tokusan_offer";
$sql .= " ,d01tokusan_hinmei";
$sql .= " ,d01hassouirai";
$sql .= " ,d01tokusanhin";
$sql .= " from ".$glb[db_prefix]."d01";
$sql .= " order by d01id";

	$sth = $dbh->prepare($sql);
	$sth->execute();

$writer = new XLSXWriter();
$writer->setAuthor('Some Author'); 

$head_row = array(
 "整理番号"
,"受付年月日"
,"氏名（団体名）"
,"郵便番号"
,"住所（所在地）"
,"寄附金額（円）"
,"寄附目的"
,"払込方法"
,"公表の有無"
,"特例申請"
,"備考"
,"申込日"
,"入金確認日"
,"電話番号"
,"ＦＡＸ"
,"email"
,"調定"
,"振込票"
,"受領書"
,"特産品希望"
,"特産品名"
,"発送依頼"
,"発送日"
);

$writer->writeSheetRow('Sheet1', $head_row);

    while($res = $sth->fetch(PDO::FETCH_ASSOC)){

$data_row = array(
$res['d01id'],
$res['d01date'],
$res['d01name'],
$res['d01zip'],
$res['d01addr'],
$res['d01price'],
$glb['mokuteki'][$res['d01mokuteki']],
$glb['pmethod'][$res['d01pmethod']],
$glb['f_open'][$res['d01f_open']],
$glb['tokurei'][$res['d01tokurei']],
$res['d01comm'],
$res['d01entry_date'],
$res['d01nyukin_kakunin_date'],
$res['d01tel'],
$res['d01fax'],
$res['d01email'],
$res['d01cyotei'],
$res['d01furikomihyo'],
$res['d01jyuryosyo'],
$glb['tokusan_offer'][$res['d01tokusan_offer']],
$res['d01tokusan_hinmei'],
$res['d01hassouirai'],
$res['d01tokusanhin']
);

	$writer->writeSheetRow('Sheet1', $data_row);

}
    $sth->closeCursor();

echo $writer->writeToString();
exit(0);
			

?>
