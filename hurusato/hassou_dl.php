<?php

//==================================================================================================
// 特産品発送一覧表
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


$filename = "hassou_output.xlsx";
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

    list($Y, $m, $d) = explode('-', $in[targetdate]);
 
    if (checkdate($m, $d, $Y) === true) {
        $firstDate = date('Y-m-d', strtotime('first day of ' . $Y."-".$m));
        $lastDate = date('Y-m-d', strtotime('last day of ' . $Y."-".$m));
    } else {
        $firstDate = date('Y-m-d', strtotime('first day of ' . date('Y-m')));
        $lastDate = date('Y-m-d', strtotime('last day of ' . date('Y-m')));
    }

$sql = "select";
$sql .= "  d01id";
$sql .= " ,d01date";
$sql .= " ,d01name";
$sql .= " ,d01zip";
$sql .= " ,d01addr";
$sql .= " ,i01name";
$sql .= " ,d01tel";
$sql .= " ,c01name";
$sql .= " ,m01hassoubi";
$sql .= " ,i01price";
$sql .= " ,m01charge";
$sql .= " ,m01postage";
$sql .= " from ".$glb[db_prefix]."v02";
$sql .= " where m01hassoubi between '" . $firstDate . "' and '" . $lastDate . "' ";
$sql .= " order by d01id, m01id asc";

	$sth = $dbh->prepare($sql);
	$sth->execute();

$writer = new XLSXWriter();
$writer->setAuthor('Some Author'); 

$head_row = array(
 "整理番号"
,"通し番号"
,"寄附年月日"
,"氏名（団体名）"
,"郵便番号"
,"住所（所在地）"
,"商品名"
,"電話番号"
,"業者名"
,"発送日"
,"商品代"
,"箱代"
,"送料"
);

$writer->writeSheetRow('Sheet1', $head_row);

    $i = 1;
    while($res = $sth->fetch(PDO::FETCH_ASSOC)){

        $data_row = array(
        $res['d01id'],
        $i,
        $res['d01date'],
        $res['d01name'],
        $res['d01zip'],
        $res['d01addr'],
        $res['i01name'],
        $res['d01tel'],
        $res['c01name'],
        $res['m01hassoubi'],
        $res['i01price'],
        $res['m01charge'],
        $res['m01postage']
        );

        $writer->writeSheetRow('Sheet1', $data_row);
        $i++;
    }
    $sth->closeCursor();

echo $writer->writeToString();
exit(0);
			

?>
