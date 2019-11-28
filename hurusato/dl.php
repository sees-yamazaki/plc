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

	$_number_format = "number_format";

	### 削除処理
	if ($in['delid'] != 0){
		$sql = "delete from $glb[db_prefix]d01 where d01id= ?";
		$sth = $dbh->prepare($sql);
		$sth->execute(array($in[delid]));
		$sth->closeCursor();
		$sql = "delete from $glb[db_prefix]m01 where d01id= ?";
		$sth = $dbh->prepare($sql);
		$sth->execute(array($in[delid]));
		$sth->closeCursor();
	}
	
	
	#===================================
	$arr_sql_where = array();
	if ($in[qr_tokusan_hinmei] != ""){
		$arr_sql_where[] = " d01tokusan_hinmei=".$dbh->quote($in[qr_tokusan_hinmei]);
	}
	if (count($arr_sql_where) > 0){
		$sql_where = " where ".implode(" and ",$arr_sql_where);
	}
	
	
	$data_cnt = $dbh->query("select count(*) from $glb[db_prefix]d01 {$sql_where}")->fetchColumn();
	
	$sth = $dbh->prepare("select * from $glb[db_prefix]v02 $sql_where order by d01id desc, m01id asc");
	$sth->execute();
    while($res = $sth->fetch(PDO::FETCH_ASSOC)){

        if ($res['m01qty']>1) {
            $item = $res['i01name']."x".$res['m01qty']."個";
        }else{
            $item = $res['i01name'];
		}
		
$list .= <<<EOT
EOT;
			
    }
    $sth->closeCursor();

#===============================================================================

    $title = "ふるさと納税台帳";


#===============================================================================
$add_head =<<<EOT
<script type="text/javascript">
<!-- <![CDATA[
	function line_delete(d01id){
		if ( confirm('削除します。よろしいですか？')){	
			document.qfm.delid.value=d01id;
			document.qfm.submit();
		}
	}

	jQuery(window).scroll(function () {
	    var h = jQuery('html, body');
		jQuery("#scrolly").val(h.scrollTop());
	    
	});

	jQuery(function(){
		$scrolly
	});

	
// ]]> -->
</script>
EOT;

#===============================================================================
$inner = <<<EOT
<h1>ダウンロード</h1>
<form name="efm" method="post" action="mnt_data.php">
	<input type="hidden" name="ph" value="21" />
	<input type="hidden" name="d01id" value="0" />
</form> 
<div class="main"> 
	

    <div style="margin:10px;">
    
    <table class="pubTable">
    <tr>
        <td style="width:600px">[ダウンロードのやり方]<br>&nbsp;&nbsp;選択した日付を含む年月のデータをダウンロードします<br>&nbsp;&nbsp;未入力の場合は当月のデータをダウンロードします</td>
    </tr>
    </table>
    <br><br>

        <form method="post" action="daicho_dl.php" download="furusato_output.xlsx">
            <table class="pubTable">
			<tr>
				<th style="width:200px">ふるさと納税台帳</th>
                <td style="width:300px"><input type="text" name="targetdate" value="" class="datepicker2" style="width:150px;" readonly></td>
                <td><input type="submit" class="btn btn-info" value="ダウンロード"></td>
			</tr>
            </table>
        </form>
        <br><br>
        <form method="post" action="hassou_dl.php" download="hassou_output.xlsx">
            <table class="pubTable">
			<tr>
				<th style="width:200px">特産品発送一覧表</th>
                <td style="width:300px"><input type="text" name="targetdate" value="" class="datepicker2" style="width:150px;" readonly></td>
                <td><input type="submit" class="btn btn-info" value="ダウンロード"></td>
			</tr>
            </table>
		</form>
        <br><br>
        <form method="post" action="uchiwake_dl.php" download="hassou_output.xlsx">
            <table class="pubTable">
			<tr>
				<th style="width:200px">特産品内訳書</th>
                <td style="width:300px"><input type="text" name="targetdate" value="" class="datepicker2" style="width:150px;" readonly></td>
                <td><input type="submit" class="btn btn-info" value="ダウンロード"></td>
			</tr>
            </table>
		</form>

	</div>


</div>
EOT;


####################################
	
	require("admin_common.html");
	exit;
	
}
