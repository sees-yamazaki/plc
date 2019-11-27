<?php

//==================================================================================================
// 特産品別カウント
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

    foreach($in as $key => $value) {
        $in[$key] = encode_special_char($value);
    }
	#===================================

	
	if($in['ph'] == 0)	{ ph1_rtn() ;}
	if($in['ph'] == 1)	{ ph1_rtn() ;} #一覧
		
	if($in['ph'] == 11)	{ ph11_rtn() ;} #新規入力
	if($in['ph'] == 12)	{ ph12_rtn() ;} #新規登録
		
	if($in['ph'] == 21)	{ ph21_rtn() ;} #修正入力
	if($in['ph'] == 22)	{ ph22_rtn() ;} #修正実行
		
	if($in['ph'] == 50)	{ ph50_rtn() ;} #
	if($in['ph'] == 51)	{ ph51_rtn() ;} #
	if($in['ph'] == 52)	{ ph52_rtn() ;} #
	if($in['ph'] == 53)	{ ph53_rtn() ;} #
		

exit;
;#==============================================================================
	
;#==============================================================================
function ph1_rtn(){	#一覧
;#==============================================================================
    global $dbh;
    global $in;
    global $glb;
    global $lcl;
    $ssid = session_id();

	
	#===================================
	$arr_sql_where = array();
	if ($in[qr_sdate] != ""){
		$arr_sql_where[] = " d01date>=".$dbh->quote($in[qr_sdate]);
	}
	if ($in[qr_edate] != ""){
		$arr_sql_where[] = " d01date<=".$dbh->quote($in[qr_edate]);
	}
	
	if (count($arr_sql_where) > 0){
		$sql_where = " where ".implode(" and ",$arr_sql_where);
	}
	
	$sth = $dbh->prepare("select d01tokusan_hinmei,count(d01id) as cnt from $glb[db_prefix]d01 $sql_where group by d01tokusan_hinmei  order by d01tokusan_hinmei ");
	$sth->execute();
    while($res = $sth->fetch(PDO::FETCH_ASSOC)){
		
$list .= <<<EOT
		<tr style="background:$bgcolor;">
			<td class="tln">{$res['d01tokusan_hinmei']}</td>
			<td class="trn">{$res['cnt']}</td>
		</tr>
EOT;
			
    }
    $sth->closeCursor();

#===============================================================================

$title = "特産品別カウント";


#===============================================================================
$add_head =<<<EOT
EOT;

#===============================================================================
$inner = <<<EOT
<h1>ふるさと納税台帳</h1>
<form name="efm" method="post" action="mnt_data.php">
	<input type="hidden" name="ph" value="21" />
	<input type="hidden" name="d01id" value="0" />
</form> 
<div class="main"> 
	

	<form name="qfm" method="get" action="rep_item.php">
	    <input type="hidden" name="ph" value="1" />
		受付年月日
			<input type="text" name="qr_sdate" value="$in[qr_sdate]" class=" datepicker" style="width:100px;"> ～
			<input type="text" name="qr_edate" value="$in[qr_edate]" class=" datepicker" style="width:100px;">
			<input type="submit" class="btn btn-info" value="検索">
    </form>

	
	<table class="pubTable">
		<thead>
			<tr>
				<th>特産品名</th>
				<th>カウント</th>
			</tr>
		</thead>
		<tbody>
			$list
		</tbody>
	</table>

</div>
EOT;


####################################
	
	require("admin_common.html");
	exit;
	
}
