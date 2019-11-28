<?php

//==================================================================================================
// 特産品内訳書
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


$filename = "uchiwake_output.xlsx";
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
$sql .= "  m01hassoubi";
$sql .= " ,i01id";
$sql .= " ,i01name2";
$sql .= " ,i01price";
$sql .= " ,sum_m01qty";
$sql .= " ,sum_i01qty";
$sql .= " ,c01id";
$sql .= " ,c01name";
$sql .= " from ".$glb[db_prefix]."v03";
$sql .= " where m01hassoubi between '" . $firstDate . "' and '" . $lastDate . "' ";
$sql .= " order by m01hassoubi desc, i01id asc";

	$sth = $dbh->prepare($sql);
	$sth->execute();

$writer = new XLSXWriter();
$writer->setAuthor('Some Author'); 

$head_row = array(
 "日付"
,"品名"
,"数量"
,"単価"
,"金額（税込）"
,"（業者名）"
);

$writer->writeSheetRow('Sheet1', $head_row);
    $i =2;
    $siki = '=C'.$i.'*E'.$i;
    while($res = $sth->fetch(PDO::FETCH_ASSOC)){

        $data_row = array(
        $res['m01hassoubi'],
        $res['i01name2'],
        '='.$res['sum_m01qty'].'*'.$res['sum_i01qty'],
        $res['i01price'],
        '=PRODUCT(C'.$i.':D'.$i.')',
        $res['c01name']
        );

        $writer->writeSheetRow('Sheet1', $data_row);
        $i++;
    }
    $sth->closeCursor();

echo $writer->writeToString();
exit(0);
			

?>
