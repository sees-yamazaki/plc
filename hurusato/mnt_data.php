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
	
	$sth = $dbh->prepare("select * from $glb[db_prefix]d01 $sql_where order by d01id desc");
	$sth->execute();
    while($res = $sth->fetch(PDO::FETCH_ASSOC)){
		
$list .= <<<EOT

		<tr style="background:$bgcolor;">
			<td><a href="javascript:;" onclick="document.efm.d01id.value=$res[d01id];document.efm.submit();">{$res['d01id']}</a></td>
			<td>{$res['d01date']}</td>
			<td>{$res['d01name']}</td>
			<td>{$res['d01zip']}</td>
			<td>{$res['d01addr']}</td>
			<td>{$_number_format($res['d01price'])}</td>
			<td>{$glb['mokuteki'][$res['d01mokuteki']]}</td>
			<td>{$glb['pmethod'][$res['d01pmethod']]}</td>
			<td>{$glb['f_open'][$res['d01f_open']]}</td>
			<td>{$glb['tokurei'][$res['d01tokurei']]}</td>
			<td>{$res['d01comm']}</td>
			<td>{$res['d01entry_date']}</td>
			<td>{$res['d01nyukin_kakunin_date']}</td>
			<td>{$res['d01tel']}</td>
			<td>{$res['d01fax']}</td>
			<td>{$res['d01email']}</td>
			<td>{$res['d01cyotei']}</td>
			<td>{$res['d01furikomihyo']}</td>
			<td>{$res['d01jyuryosyo']}</td>
			<td>{$glb['tokusan_offer'][$res['d01tokusan_offer']]}</td>
			<td>{$res['d01tokusan_hinmei']}</td>
			<td>{$res['d01hassouirai']}</td>
			<td>{$res['d01tokusanhin']}</td>

			<td style="width:90px;" nowrap>
				<input type="button" class="btn btn-xs btn-info" value="編集" onclick="document.efm.d01id.value=$res[d01id];document.efm.submit();">
				<input type="button" class="btn btn-xs btn-danger" value="削除" onclick="line_delete($res[d01id]);">
			</td>
		</tr>
EOT;
			
    }
    $sth->closeCursor();

	$opt_tokusan_hinmei = "<option value=''></option>";
	$sth = $dbh->prepare("select d01tokusan_hinmei from $glb[db_prefix]d01 group by d01tokusan_hinmei order by d01tokusan_hinmei");
	$sth->execute();
    while($res = $sth->fetch(PDO::FETCH_ASSOC)){
    	if ($res[d01tokusan_hinmei] == ""){ continue; }
		if ($in[qr_tokusan_hinmei] === $res[d01tokusan_hinmei]){ $wk="selected"; }else{ $wk=""; }
		$opt_tokusan_hinmei .= "<option value='{$res[d01tokusan_hinmei]}' {$wk}>{$res[d01tokusan_hinmei]}</option>";
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
<h1>ふるさと納税台帳</h1>
<form name="efm" method="post" action="mnt_data.php">
	<input type="hidden" name="ph" value="21" />
	<input type="hidden" name="d01id" value="0" />
</form> 
<div class="main"> 
	
	<form name="qfm" method="get" action="mnt_data.php">
	    <input type="hidden" name="ph" value="1" />
	    <input type="hidden" name="sortkey" value="$in[sortkey]" />
		<input type="hidden" name="page" value="{$in[page]}" />
		<input type="hidden" name="delid" value="0" />
		<input type="hidden" name="scrolly" id="scrolly" />
			
		<table class='pubTable'>
			<tr>
				<th>特産品</th>
				<td><select name="qr_tokusan_hinmei" onchange="document.qfm.submit();">$opt_tokusan_hinmei</select></td>
			</tr>
		</table>
    </form>

	<div style="margin:10px;">
		<form method="post" action="mnt_data.php">
			<input type="submit" class="btn btn-info" value="新規登録">
			<input type="hidden" name="ph" value="11">
<a class="btn btn-info" style="margin-left: 20px;" href="./list_dl.php" download="furusato_output.xlsx">ダウンロード</a>
		</form>

	</div>

	<div>{$data_cnt}件</div>

	<table class="pubTable hfix" style="width:980px;">
		<thead>
			<tr>
				<th>整理番号</th>
				<th>受付年月日</th>
				<th>氏名（団体名）</th>
				<th>郵便番号</th>
				<th>住所（所在地）</th>
				<th>寄附金額（円）</th>
				<th>寄附目的</th>
				<th>払込方法</th>
				<th>公表の有無</th>
				<th>特例申請</th>
				<th>備考</th>
				<th>申込日</th>
				<th>入金確認日</th>
				<th>電話番号</th>
				<th>ＦＡＸ</th>
				<th>メール</th>
				<th>調定</th>
				<th>振込票</th>
				<th>受領書</th>
				<th>特産品希望</th>
				<th>特産品名</th>
				<th>発送依頼</th>
				<th>発送日</th>
				<th></th>
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


;#==============================================================================
function ph11_rtn(){	#新規入力
;#==============================================================================
    global $dbh;
    global $in;
    global $glb;
    global $lcl;
    $ssid = session_id();
    
	$_number_format = "number_format";

	$title = "新規登録";
	
	if ($lcl["msg"] != ""){
		$msg = "<div class='nrm_msg'>{$lcl[msg]}</div>";
	}
	
	
	if ($in[sw_ss] == 1){
	    foreach($_SESSION["spa"] as $key => $value) {
			$in[$key] = $value;
		}
	}
	
	foreach($in as $key => $value) {
        $in[$key] = decode_special_char($value);
	}
	
	
	for($i=1;$i<=count($glb[f_open]);$i++){
		if ($in["d01f_open"] == $i){ $wk="checked"; }else{ $wk=""; }
		$parts_f_open.=<<<EOT
		<label class="btn btn-xs btn-default "><input type="radio" name="d01f_open" value="{$i}" {$wk}>{$glb[f_open][$i]}</label>
EOT;
	}

	for($i=1;$i<=count($glb[tokurei]);$i++){
		if ($in["d01tokurei"] == $i){ $wk="checked"; }else{ $wk=""; }
		$parts_tokurei.=<<<EOT
		<label class="btn btn-xs btn-default "><input type="radio" name="d01tokurei" value="{$i}" {$wk}>{$glb[tokurei][$i]}</label>
EOT;
	}

	for($i=1;$i<=count($glb[tokusan_offer]);$i++){
		if ($in["d01tokusan_offer"] == $i){ $wk="checked"; }else{ $wk=""; }
		$parts_tokusan_offer.=<<<EOT
		<label class="btn btn-xs btn-default "><input type="radio" name="d01tokusan_offer" value="{$i}" {$wk}>{$glb[tokusan_offer][$i]}</label>
EOT;
	}



	#寄付目的
	$opt_mokuteki = "<option value='0'></option>";
	for($i=1;$i<=count($glb[mokuteki]);$i++){
		if ($in["d01mokuteki"] == $i){ $wk="selected"; }else{ $wk=""; }
		$opt_mokuteki.= "<option value='$i' $wk>{$glb[mokuteki][$i]}</option>";
	}

	#寄付の理由
	$opt_riyuu = "<option value='0'></option>";
	for($i=1;$i<=count($glb[riyuu]);$i++){
		if ($in["d01riyuu"] == $i){ $wk="selected"; }else{ $wk=""; }
		$opt_riyuu.= "<option value='$i' $wk>{$glb[riyuu][$i]}</option>";
	}
	
	#支払方法
	$opt_pmethod = "<option value='0'></option>";
	for($i=1;$i<=count($glb[pmethod]);$i++){
		if ($in["d01pmethod"] == $i){ $wk="selected"; }else{ $wk=""; }
		$opt_pmethod.= "<option value='$i' $wk>{$glb[pmethod][$i]}</option>";
	}
	
	#特産品
	$opt_item = "<option value='0'></option>";
	$sth = $dbh->prepare("select * from $glb[db_prefix]i01 order by i01id");
	$sth->execute();
    while($res = $sth->fetch(PDO::FETCH_ASSOC)){
    	if ($res[i01name] == ""){ continue; }
		$opt_item .= "<option value='{$res[i01id]}'>{$res[i01name]}</option>";
    }
    $sth->closeCursor();

	#業者
	$opt_cli1 = "<option value=''></option>";
	$opt_cli2 = "<option value=''></option>";
	$opt_cli3 = "<option value=''></option>";
	$sth = $dbh->prepare("select * from $glb[db_prefix]v01 order by c01id");
	$sth->execute();
    while($res = $sth->fetch(PDO::FETCH_ASSOC)){
    	if ($res[c01id] == ""){ continue; }
		$opt_cli1 .= "<option value='{$res[c01id]}' data-i01id_1='{$res[items]}'>{$res[c01name]}</option>";
		$opt_cli2 .= "<option value='{$res[c01id]}' data-i01id_2='{$res[items]}'>{$res[c01name]}</option>";
		$opt_cli3 .= "<option value='{$res[c01id]}' data-i01id_3='{$res[items]}'>{$res[c01name]}</option>";
	}
	$sth->closeCursor();



    $title = "ふるさと納税台帳〔新規登録〕";
    
$add_head = <<<EOT
<script type="text/javascript">
$(function () {
	$("#i01id_1").narrows("#c01id_1", {
		allow_multiple_parent_values: true
	});
	$("#i01id_2").narrows("#c01id_2", {
		allow_multiple_parent_values: true
	});
	$("#i01id_3").narrows("#c01id_3", {
		allow_multiple_parent_values: true
	});
});
</script>

EOT;
;#==============================================================================
$inner = <<<EOT
<h1>$title <a href="#" onClick="location.href='./mnt_data.php?sw_ss=1'; return false;" class="btn">一覧に戻る</a></h1>
	
<div class="main">
	$err_msg
	<form name="ifm" method="post" action="mnt_data.php">
		<table class="pubTable">
			<tr>
				<th>受付年月日</th>
				<td><input type="text" name="d01date" value="$in[d01date]" class=" datepicker" style="width:100px;"></td>
			</tr>
			<tr>
				<th>氏名(団体名)</th>
				<td><input type="text" name="d01name" value="$in[d01name]" class="" style="width:500px;"></td>
			</tr>
			<tr>
				<th>郵便番号</th>
				<td><input type="text" name="d01zip" value="$in[d01zip]" class="" style="width:8em;" maxlength="8" /></td>
			</tr>
			<tr>
				<th>住所(所在地)</th>
				<td>
	            	<input type="text" name="d01addr" style="width:500px;" value="$in[d01addr]">
	           	</td>
			</tr>
			<tr>
				<th>寄付金額</th>
				<td><input type="text" name="d01price" value="{$_number_format($in[d01price])}" style="width:100px;">円</td>
			</tr>
			<tr>
				<th>寄付目的</th>
				<td><select name="d01mokuteki">$opt_mokuteki</select></td>
			</tr>
			<tr>
				<th>払込方法</th>
				<td><select name="d01pmethod">$opt_pmethod</select></td>
			</tr>
			<tr>
				<th>公表の有無</th>
				<td>$parts_f_open</td>
			</tr>
			<tr>
				<th>特例申請</th>
				<td>$parts_tokurei</td>
			</tr>
			<tr>
				<th>備考</th>
				<td><input type="text" name="d01comm" value="$in[d01comm]" style="width:500px;"></td>
			</tr>
			<tr>
				<th>申込日</th>
				<td><input type="text" name="d01entry_date" value="$in[d01entry_date]" class="datepicker" style="width:100px;"></td>
			</tr>
			<tr>
				<th>入金確認日</th>
				<td><input type="text" name="d01nyukin_kakunin_date" value="$in[d01nyukin_kakunin_date]" class="datepicker" style="width:100px;"></td>
			</tr>
			<tr>
				<th>電話番号</th>
				<td><input type="text" name="d01tel" value="$in[d01tel]" style="width:150px;"></td>
			</tr>
			<tr>
				<th>FAX番号</th>
				<td><input type="text" name="d01fax" value="$in[d01fax]" style="width:150px;"></td>
			</tr>
			<tr>
				<th>メールアドレス</th>
				<td><input type="text" name="d01email" value="$in[d01email]" style="width:500px;"></td>
			</tr>
			<tr>
				<th>申出書による申し込み</th>
				<td><input type="checkbox" name="d01moushide" value="1" style="width:100px;"></td>
			</tr>
			<tr>
				<th>調定</th>
				<td><input type="text" name="d01cyotei" value="$in[d01cyotei]" class=" datepicker" style="width:100px;"></td>
			</tr>
			<tr>
				<th>振込票</th>
				<td><input type="text" name="d01furikomihyo" value="$in[d01furikomihyo]" class=" datepicker" style="width:100px;"></td>
			</tr>
			<tr>
				<th>受領書</th>
				<td><input type="text" name="d01jyuryosyo" value="$in[d01jyuryosyo]" class=" datepicker" style="width:100px;"></td>
			</tr>
			<tr>
				<th>特産品希望</th>
				<td>$parts_tokusan_offer</td>
			</tr>

			<!-- 特産品 -->

			<tr>
				<th colspan=2>特産品１</th>
			</tr>

			<tr>
				<th>特産品名</th>
				<td><select id="i01id_1" name="i01id_1">$opt_item</select></td>
			</tr>
			<tr>
				<th>業者</th>
				<td><select id="c01id_1" name="c01id_1">$opt_cli1</select></td>
			</tr>
			<tr>
				<th>発送依頼</th>
				<td><input type="text" name="m01hassouirai_1" value="" class=" datepicker" style="width:100px;"></td>
			</tr>
			<tr>
				<th>発送日</th>
				<td><input type="text" name="m01hassoubi_1" value="" class=" datepicker" style="width:100px;"></td>
			</tr>
			<tr>
				<th>数量</th>
				<td><input type="number" name="m01qty_1" value="" style="width:100px;"></td>
			</tr>
			<tr>
				<th>箱代</th>
				<td><input type="number" name="m01charge_1" value="" style="width:100px;"></td>
			</tr>
			<tr>
				<th>送料</th>
				<td><input type="number" name="m01postage_1" value="" style="width:100px;"></td>
			</tr>

			<tr>
				<th colspan=2>特産品２</th>
			</tr>

			<tr>
				<th>特産品名</th>
				<td><select id="i01id_2" name="i01id_2">$opt_item</select></td>
			</tr>
			<tr>
				<th>業者</th>
				<td><select id="c01id_2" name="c01id_2">$opt_cli2</select></td>
			</tr>
			<tr>
				<th>発送依頼</th>
				<td><input type="text" name="m01hassouirai_2" value="" class=" datepicker" style="width:100px;"></td>
			</tr>
			<tr>
				<th>発送日</th>
				<td><input type="text" name="m01hassoubi_2" value="" class=" datepicker" style="width:100px;"></td>
			</tr>
			<tr>
				<th>数量</th>
				<td><input type="number" name="m01qty_2" value="" style="width:100px;"></td>
			</tr>
			<tr>
				<th>箱代</th>
				<td><input type="number" name="m01charge_2" value="" style="width:100px;"></td>
			</tr>
			<tr>
				<th>送料</th>
				<td><input type="number" name="m01postage_2" value="" style="width:100px;"></td>
			</tr>
			
			<tr>
				<th colspan=2>特産品３</th>
			</tr>

			<tr>
				<th>特産品名</th>
				<td><select id="i01id_3" name="i01id_3">$opt_item</select></td>
			</tr>
			<tr>
				<th>業者</th>
				<td><select id="c01id_3" name="c01id_3">$opt_cli3</select></td>
			</tr>
			<tr>
				<th>発送依頼</th>
				<td><input type="text" name="m01hassouirai_3" value="" class=" datepicker" style="width:100px;"></td>
			</tr>
			<tr>
				<th>発送日</th>
				<td><input type="text" name="m01hassoubi_3" value="" class=" datepicker" style="width:100px;"></td>
			</tr>
			<tr>
				<th>数量</th>
				<td><input type="number" name="m01qty_3" value="" style="width:100px;"></td>
			</tr>
			<tr>
				<th>箱代</th>
				<td><input type="number" name="m01charge_3" value="" style="width:100px;"></td>
			</tr>
			<tr>
				<th>送料</th>
				<td><input type="number" name="m01postage_3" value="" style="width:100px;"></td>
			</tr>
			
			<tr>
				<td colspan="2" style="text-align:center;">
					<input type="button" class="cmd btn btn-info" value="保存" onclick="document.ifm.submit();">
				</td>
			</tr>
		</table>
		<input type="hidden" name="ph" value="12" />
	</form>

</div>
EOT;

	require("admin_common.html");
	exit;
}

;#==============================================================================
function ph12_rtn(){ #新規登録
;#==============================================================================
    global $dbh;
    global $in;
    global $glb;
    global $lcl;
    
	mb_language('ja');
	mb_internal_encoding('UTF-8');
	
    foreach($in as $key => $value) {
        $_SESSION["spa"][$key] = $value;
    }
	
	#===================================
	$lcl[err_msg] = "";
	#===================================
    
	foreach($in as $key => $value) {
		$value = mb_ereg_replace("\n","<br />", $value,"i");
		$value = htmlspecialchars_decode($value,ENT_COMPAT);
		$in[$key] = $value;
	}
    
	$in["d01p_method"] += 0;
	$in["d01f_open"] += 0;
	$in['d01price'] = str_replace(",","",$in['d01price']);
	$in["d01price"] += 0;
	$in["d01tourei"] += 0;
	$in["d01tokusan_offer"] += 0;
	
    if ($in['d01date'] == ""){ $in["d01date"] = null; }
    if ($in['d01entry_date'] == ""){ $in["d01entry_date"] = null; }
    if ($in['d01nyukin_kakunin_date'] == ""){ $in["d01nyukin_kakunin_date"] = null; }
    
    if ($in['d01cyotei'] == ""){ $in["d01cyotei"] = null; }
    if ($in['d01furikomihyo'] == ""){ $in["d01furikomihyo"] = null; }
    if ($in['d01hassouirai'] == ""){ $in["d01hassouirai"] = null; }
    if ($in['d01tokusanhin'] == ""){ $in["d01tokusanhin"] = null; }
	if ($in['d01jyuryosyo'] == ""){ $in["d01jyuryosyo"] = null; }
	
    if ($in['d01moushide'] == ""){
		 $in["d01moushide"] = NULL; 
	}else{
		$in["d01moushide"] =date("Y/m/d");
	} 
    
//    if (($in["d01zip1"] != "") or ($in["d01zip2"] != "")){
//    	$in["d01zip"] = sprintf("%03d-%04d",$in["d01zip1"],$in["d01zip2"]);
//    }
    

	$sql =<<<EOT
	insert into $glb[db_prefix]d01(
		 d01addtime
		,d01edittime
		,d01deltime
		,d01date
		,d01name
		,d01zip
		,d01addr
		,d01price
		,d01mokuteki
		,d01pmethod
		,d01f_open
		,d01tokurei
		,d01comm
		,d01entry_date
		,d01nyukin_kakunin_date
		,d01tel
		,d01fax
		,d01email
		,d01moushide
		,d01cyotei
		,d01furikomihyo
		,d01jyuryosyo
		,d01tokusan_offer
	) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
EOT;
	
	$sth = $dbh->prepare($sql);
		$sth->bindValue(1, date("Y/m/d H:i:s"));
		$sth->bindValue(2, date("Y/m/d H:i:s"));
		$sth->bindValue(3, null);
		
		$sth->bindValue(4, $in['d01date']);
		$sth->bindValue(5, $in['d01name']);
		$sth->bindValue(6, $in['d01zip']);
		$sth->bindValue(7, $in['d01addr']);
		$sth->bindValue(8, $in['d01price']);
		$sth->bindValue(9, $in['d01mokuteki']);
		$sth->bindValue(10, $in['d01pmethod']);
		$sth->bindValue(11, $in['d01f_open']);
		$sth->bindValue(12, $in['d01tokurei']);
		$sth->bindValue(13, $in['d01comm']);
		$sth->bindValue(14, $in['d01entry_date']);
		$sth->bindValue(15, $in['d01nyukin_kakunin_date']);
		$sth->bindValue(16, $in['d01tel']);
		$sth->bindValue(17, $in['d01fax']);
		$sth->bindValue(18, $in['d01email']);
		$sth->bindValue(19, $in['d01moushide']);
		$sth->bindValue(20, $in['d01cyotei']);
		$sth->bindValue(21, $in['d01furikomihyo']);
		$sth->bindValue(22, $in['d01jyuryosyo']);
		$sth->bindValue(23, $in['d01tokusan_offer']);

	$ret = $sth->execute(); 
	
	if (!$ret) {
		$arr = $sth->errorInfo();
		print_r($arr);
	    die('INSERT 失敗');
	}
	
	$insertid = $dbh->lastInsertId();
	$sth->closeCursor();

	
    for ($i=1;$i<=3;$i++) {
		//商品１
		if(isset($in['i01id_'.$i]) && $in['i01id_'.$i]<>"0"){

			$in["m01qty_".$i] += 0;
			$in["m01charge_".$i] += 0;
			$in["m01postage_".$i] += 0;

			if ($in['c01id_'.$i] == ""){ $in["c01id_".$i] = 0; }
			if ($in['m01hassouirai_'.$i] == ""){ $in["m01hassouirai_".$i] = null; }
			if ($in['m01hassoubi_'.$i] == ""){ $in["m01hassoubi_".$i] = null; }

			$sql =<<<EOT
			insert into $glb[db_prefix]m01(
				m01addtime
				,m01edittime
				,m01deltime
				,d01id
				,m01hassouirai
				,i01id
				,m01qty
				,m01charge
				,m01postage
				,m01hassoubi
				,c01id
				,m01id
			) values (?,?,?,?,?,?,?,?,?,?,?,?)
EOT;

			$sth = $dbh->prepare($sql);
			$sth->bindValue(1, date("Y/m/d H:i:s"));
			$sth->bindValue(2, date("Y/m/d H:i:s"));
			$sth->bindValue(3, null);
			
			$sth->bindValue(4, $insertid);
			$sth->bindValue(5, $in['m01hassouirai_'.$i]);
			$sth->bindValue(6, $in['i01id_'.$i]);
			$sth->bindValue(7, $in['m01qty_'.$i]);
			$sth->bindValue(8, $in['m01charge_'.$i]);
			$sth->bindValue(9, $in['m01postage_'.$i]);
			$sth->bindValue(10, $in['m01hassoubi_'.$i]);
			$sth->bindValue(11, $in['c01id_'.$i]);
			$sth->bindValue(12, $i);

			$ret = $sth->execute(); 
			
			if (!$ret) {
				$arr = $sth->errorInfo();
				print_r($arr);
				die('INSERT 失敗');
			}
			
			$sth->closeCursor();

		}
	}

	
	unset($_SESSION["spa"]);
	$in = array();
	
	ph1_rtn();

	exit;
	
}

;#==============================================================================
function ph21_rtn(){	#修正入力
;#==============================================================================
    global $dbh;
    global $in;
    global $glb;
    global $lcl;
    $ssid = session_id();
	
	$_number_format = "number_format";

	if ($in["sw_ss"] == 1){
		foreach($_SESSION["spa"] as $key => $value) {
			$in[$key] = $value;
		}
	}else{
		$sth = $dbh->prepare("select * from $glb[db_prefix]d01 where d01id=?");
		$sth->bindParam(1, $in[d01id], PDO::PARAM_STR);
		$sth->execute();
	    $res = $sth->fetch(PDO::FETCH_ASSOC);
	    $sth->closeCursor();
	    foreach($res as $key => $value) {
			$in[$key] = $value;
		}
		
//		list($in["d01zip1"],$in["d01zip2"]) = explode("-",$in["d01zip"]);
	}

	foreach($in as $key => $value) {
        $in[$key] = decode_special_char($value);
	}

	
	for($i=1;$i<=count($glb[f_open]);$i++){
		if ($in["d01f_open"] == $i){ $wk="checked"; }else{ $wk=""; }
		$parts_f_open.=<<<EOT
		<label class="btn btn-xs btn-default "><input type="radio" name="d01f_open" value="{$i}" {$wk}>{$glb[f_open][$i]}</label>
EOT;
	}

	for($i=1;$i<=count($glb[tokurei]);$i++){
		if ($in["d01tokurei"] == $i){ $wk="checked"; }else{ $wk=""; }
		$parts_tokurei.=<<<EOT
		<label class="btn btn-xs btn-default "><input type="radio" name="d01tokurei" value="{$i}" {$wk}>{$glb[tokurei][$i]}</label>
EOT;
	}

	for($i=1;$i<=count($glb[tokusan_offer]);$i++){
		if ($in["d01tokusan_offer"] == $i){ $wk="checked"; }else{ $wk=""; }
		$parts_tokusan_offer.=<<<EOT
		<label class="btn btn-xs btn-default "><input type="radio" name="d01tokusan_offer" value="{$i}" {$wk}>{$glb[tokusan_offer][$i]}</label>
EOT;
	}


	#寄付目的
	$opt_mokuteki = "<option value='0'></option>";
	for($i=1;$i<=count($glb[mokuteki]);$i++){
		if ($in["d01mokuteki"] == $i){ $wk="selected"; }else{ $wk=""; }
		$opt_mokuteki.= "<option value='$i' $wk>{$glb[mokuteki][$i]}</option>";
	}

	#支払方法
	$opt_pmethod = "<option value='0'></option>";
	for($i=1;$i<=count($glb[pmethod]);$i++){
		if ($in["d01pmethod"] == $i){ $wk="selected"; }else{ $wk=""; }
		$opt_pmethod.= "<option value='$i' $wk>{$glb[pmethod][$i]}</option>";
	}
	
	#申出書
	if ($in["d01moushide"] <> ""){ $moushide="checked"; }else{ $moushide=""; }

	#明細の取得
	$d01id = array("","","");
	$m01id = array("","","");
	$m01hassouirai = array("","","");
	$i01id = array("","","");
	$m01qty = array("","","");
	$m01charge = array("","","");
	$m01postage = array("","","");
	$c01id = array("","","");
	$m01hassoubi = array("","","");

    for ($i=0;$i<=2;$i++) {
        $sth = $dbh->prepare("select * from $glb[db_prefix]m01 where d01id=? and m01id=?");
		$sth->bindParam(1, $in[d01id], PDO::PARAM_STR);
		$j = $i + 1;
        $sth->bindParam(2, $j , PDO::PARAM_STR);
        $sth->execute();
        $res = $sth->fetch(PDO::FETCH_ASSOC);
        $d01id[$i] = $res[d01id];
        $m01id[$i] = $res[m01id];
        $m01hassouirai[$i] = $res[m01hassouirai];
        $i01id[$i] = $res[i01id];
        $m01qty[$i] = $res[m01qty];
        $m01charge[$i] = $res[m01charge];
        $m01postage[$i] = $res[m01postage];
        $c01id[$i] = $res[c01id];
        $m01hassoubi[$i] = $res[m01hassoubi];
    }

	#特産品
	$opt_item1 = "<option value='0'></option>";
	$opt_item2 = "<option value='0'></option>";
	$opt_item3 = "<option value='0'></option>";
	$sth = $dbh->prepare("select * from $glb[db_prefix]i01 order by i01id");
	$sth->execute();
    while($res = $sth->fetch(PDO::FETCH_ASSOC)){
    	if ($res[i01name] == ""){ continue; }
		if ($i01id[0] === $res[i01id]){ $wk="selected"; }else{ $wk=""; }
		$opt_item1 .= "<option value='{$res[i01id]}' {$wk}>{$res[i01name]}</option>";
		if ($i01id[1] === $res[i01id]){ $wk="selected"; }else{ $wk=""; }
		$opt_item2 .= "<option value='{$res[i01id]}' {$wk}>{$res[i01name]}</option>";
		if ($i01id[2] === $res[i01id]){ $wk="selected"; }else{ $wk=""; }
		$opt_item3 .= "<option value='{$res[i01id]}' {$wk}>{$res[i01name]}</option>";
    }
	$sth->closeCursor();

	
	#業者
	$opt_cli1 = "<option value=''></option>";
	$opt_cli2 = "<option value=''></option>";
	$opt_cli3 = "<option value=''></option>";
	$sth = $dbh->prepare("select * from $glb[db_prefix]v01 order by c01id");
	$sth->execute();
    while($res = $sth->fetch(PDO::FETCH_ASSOC)){
    	if ($res[c01id] == ""){ continue; }
		if ($c01id[0] === $res[c01id]){ $wk="selected"; }else{ $wk=""; }
		$opt_cli1 .= "<option value='{$res[c01id]}' data-i01id_1='{$res[items]}' {$wk}>{$res[c01name]}</option>";
		if ($c01id[1] === $res[c01id]){ $wk="selected"; }else{ $wk=""; }
		$opt_cli2 .= "<option value='{$res[c01id]}' data-i01id_2='{$res[items]}' {$wk}>{$res[c01name]}</option>";
		if ($c01id[2] === $res[c01id]){ $wk="selected"; }else{ $wk=""; }
		$opt_cli3 .= "<option value='{$res[c01id]}' data-i01id_3='{$res[items]}' {$wk}>{$res[c01name]}</option>";
	}
	$sth->closeCursor();
	
    $title = "ふるさと納税台帳〔修正〕";
    
$add_head = <<<EOT
<script type="text/javascript">
$(function () {
	$("#i01id_1").narrows("#c01id_1", {
		allow_multiple_parent_values: true
	});
	$("#i01id_2").narrows("#c01id_2", {
		allow_multiple_parent_values: true
	});
	$("#i01id_3").narrows("#c01id_3", {
		allow_multiple_parent_values: true
	});
});
</script>
EOT;
;#==============================================================================
$inner = <<<EOT
<h1>$title <a href="#" onClick="location.href='./mnt_data.php?sw_ss=1'; return false;" class="btn">一覧に戻る</a></h1>
	
<div class="main">
	$err_msg
	<form name="ifm" method="post" action="mnt_data.php">
		<table class="pubTable">
			<tr>
				<th>受付年月日</th>
				<td><input type="text" name="d01date" value="$in[d01date]" class=" datepicker" style="width:100px;"></td>
			</tr>
			<tr>
				<th>氏名(団体名)</th>
				<td><input type="text" name="d01name" value="$in[d01name]" class="" style="width:500px;"></td>
			</tr>
			<tr>
				<th>郵便番号</th>
				<td><input type="text" name="d01zip" value="$in[d01zip]" class="" style="width:8em;" maxlength="8" /></td>
			</tr>
			<tr>
				<th>住所(所在地)</th>
				<td>
	            	<input type="text" name="d01addr" style="width:500px;" value="$in[d01addr]">
	           	</td>
			</tr>
			<tr>
				<th>寄付金額</th>
				<td><input type="text" name="d01price" value="{$_number_format($in[d01price])}" style="width:100px;">円</td>
			</tr>
			<tr>
				<th>寄付目的</th>
				<td><select name="d01mokuteki">$opt_mokuteki</select></td>
			</tr>
			<tr>
				<th>払込方法</th>
				<td><select name="d01pmethod">$opt_pmethod</select></td>
			</tr>
			<tr>
				<th>公表の有無</th>
				<td>$parts_f_open</td>
			</tr>
			<tr>
				<th>特例申請</th>
				<td>$parts_tokurei</td>
			</tr>
			<tr>
				<th>備考</th>
				<td><input type="text" name="d01comm" value="$in[d01comm]" style="width:500px;"></td>
			</tr>
			<tr>
				<th>申込日</th>
				<td><input type="text" name="d01entry_date" value="$in[d01entry_date]" class="datepicker" style="width:100px;"></td>
			</tr>
			<tr>
				<th>入金確認日</th>
				<td><input type="text" name="d01nyukin_kakunin_date" value="$in[d01nyukin_kakunin_date]" class="datepicker" style="width:100px;"></td>
			</tr>
			<tr>
				<th>電話番号</th>
				<td><input type="text" name="d01tel" value="$in[d01tel]" style="width:150px;"></td>
			</tr>
			<tr>
				<th>FAX番号</th>
				<td><input type="text" name="d01fax" value="$in[d01fax]" style="width:150px;"></td>
			</tr>
			<tr>
				<th>メールアドレス</th>
				<td><input type="text" name="d01email" value="$in[d01email]" style="width:500px;"></td>
			</tr>
			<tr>
				<th>申出書による申し込み</th>
				<td><input type="checkbox" name="d01moushide" value="1" style="width:100px;" $moushide></td>
			</tr>
			<tr>
				<th>調定</th>
				<td><input type="text" name="d01cyotei" value="$in[d01cyotei]" class=" datepicker" style="width:100px;"></td>
			</tr>
			<tr>
				<th>振込票</th>
				<td><input type="text" name="d01furikomihyo" value="$in[d01furikomihyo]" class=" datepicker" style="width:100px;"></td>
			</tr>
			<tr>
				<th>受領書</th>
				<td><input type="text" name="d01jyuryosyo" value="$in[d01jyuryosyo]" class=" datepicker" style="width:100px;"></td>
			</tr>
			<tr>
				<th>特産品希望</th>
				<td>$parts_tokusan_offer</td>
			</tr>


			<!-- 特産品 -->

			<tr>
				<th colspan=2>特産品１</th>
			</tr>

			<tr>
				<th>特産品名</th>
				<td><select id="i01id_1" name="i01id_1">$opt_item1</select><input type="hidden"  name="i01id_1x" value="$i01id[0]"></td>
			</tr>
			<tr>
				<th>業者</th>
				<td><select id="c01id_1" name="c01id_1">$opt_cli1</select></td>
			</tr>
			<tr>
				<th>発送依頼</th>
				<td><input type="text" name="m01hassouirai_1" value="$m01hassouirai[0]" class=" datepicker" style="width:100px;"></td>
			</tr>
			<tr>
				<th>発送日</th>
				<td><input type="text" name="m01hassoubi_1" value="$m01hassoubi[0]" class=" datepicker" style="width:100px;"></td>
			</tr>
			<tr>
				<th>数量</th>
				<td><input type="number" name="m01qty_1" value="$m01qty[0]" style="width:100px;"></td>
			</tr>
			<tr>
				<th>箱代</th>
				<td><input type="number" name="m01charge_1" value="$m01charge[0]" style="width:100px;"></td>
			</tr>
			<tr>
				<th>送料</th>
				<td><input type="number" name="m01postage_1" value="$m01postage[0]" style="width:100px;"></td>
			</tr>

			<tr>
				<th colspan=2>特産品２</th>
			</tr>

			<tr>
				<th>特産品名</th>
				<td><select id="i01id_2" name="i01id_2">$opt_item2</select><input type="hidden"  name="i01id_2x" value="$i01id[1]"></td>
			</tr>
			<tr>
				<th>業者</th>
				<td><select id="c01id_2" name="c01id_2">$opt_cli2</select></td>
			</tr>
			<tr>
				<th>発送依頼</th>
				<td><input type="text" name="m01hassouirai_2" value="$m01hassouirai[1]" class=" datepicker" style="width:100px;"></td>
			</tr>
			<tr>
				<th>発送日</th>
				<td><input type="text" name="m01hassoubi_2" value="$m01hassoubi[1]" class=" datepicker" style="width:100px;"></td>
			</tr>
			<tr>
				<th>数量</th>
				<td><input type="number" name="m01qty_2" value="$m01qty[1]" style="width:100px;"></td>
			</tr>
			<tr>
				<th>箱代</th>
				<td><input type="number" name="m01charge_2" value="$m01charge[1]" style="width:100px;"></td>
			</tr>
			<tr>
				<th>送料</th>
				<td><input type="number" name="m01postage_2" value="$m01postage[1]" style="width:100px;"></td>
			</tr>
			
			<tr>
				<th colspan=2>特産品３</th>
			</tr>

			<tr>
				<th>特産品名</th>
				<td><select id="i01id_3" name="i01id_3">$opt_item3</select><input type="hidden"  name="i01id_3x" value="$i01id[2]"></td>
			</tr>
			<tr>
				<th>業者</th>
				<td><select id="c01id_3" name="c01id_3">$opt_cli3</select></td>
			</tr>
			<tr>
				<th>発送依頼</th>
				<td><input type="text" name="m01hassouirai_3" value="$m01hassouirai[2]" class=" datepicker" style="width:100px;"></td>
			</tr>
			<tr>
				<th>発送日</th>
				<td><input type="text" name="m01hassoubi_3" value="$m01hassoubi[2]" class=" datepicker" style="width:100px;"></td>
			</tr>
			<tr>
				<th>数量</th>
				<td><input type="number" name="m01qty_3" value="$m01qty[2]" style="width:100px;"></td>
			</tr>
			<tr>
				<th>箱代</th>
				<td><input type="number" name="m01charge_3" value="$m01charge[2]" style="width:100px;"></td>
			</tr>
			<tr>
				<th>送料</th>
				<td><input type="number" name="m01postage_3" value="$m01postage[2]" style="width:100px;"></td>
			</tr>			
			<tr>
				<td colspan="2" style="text-align:center;">
					<input type="button" class="cmd btn btn-info" value="保存" onclick="document.ifm.submit();">
				</td>
			</tr>
		</table>
		<input type="hidden" name="ph" value="22" />
		<input type="hidden" name="d01id" value="{$in[d01id]}" />
	</form>

</div>
EOT;

	require("admin_common.html");
	exit;

}


;#==============================================================================
function ph22_rtn(){ #修正実行
;#==============================================================================
    global $dbh;
    global $in;
    global $glb;
    global $lcl;
	
	mb_language('ja');
	mb_internal_encoding('UTF-8');
	
	
    foreach($in as $key => $value) {
        $_SESSION["spa"][$key] = $value;
    }

	#===================================
	$lcl["err_msg"] = "";
	#===================================
	
	foreach($in as $key => $value) {
		$value = mb_ereg_replace("\n","<br />", $value,"i");
		$value = htmlspecialchars_decode($value,ENT_COMPAT);
		$in[$key] = $value;
	}

	$in["d01p_method"] += 0;
	$in["d01f_open"] += 0;
	$in['d01price'] = str_replace(",","",$in['d01price']);
	$in["d01price"] += 0;
	$in["d01tokrei"] += 0;
	$in["d01tokusan_offer"] += 0;
    
    if ($in['d01date'] == ""){ $in["d01date"] = null; }
    if ($in['d01entry_date'] == ""){ $in["d01entry_date"] = null; }
    if ($in['d01nyukin_kakunin_date'] == ""){ $in["d01nyukin_kakunin_date"] = null; }
    
    if ($in['d01cyotei'] == ""){ $in["d01cyotei"] = null; }
    if ($in['d01furikomihyo'] == ""){ $in["d01furikomihyo"] = null; }
    if ($in['d01hassouirai'] == ""){ $in["d01hassouirai"] = null; }
    if ($in['d01tokusanhin'] == ""){ $in["d01tokusanhin"] = null; }
    if ($in['d01jyuryosyo'] == ""){ $in["d01jyuryosyo"] = null; }
	
    if ($in['d01moushide'] == ""){
		$in["d01moushide"] = NULL; 
   }else{
	   $in["d01moushide"] =date("Y/m/d");
   } 
	
//    if (($in["d01zip1"] != "") or ($in["d01zip2"] != "")){
//    	$in["d01zip"] = sprintf("%03d-%04d",$in["d01zip1"],$in["d01zip2"]);
//    }
    

	$sql =<<<EOT
	update $glb[db_prefix]d01 set 
		 d01date=?
		,d01name=?
		,d01zip=?
		,d01addr=?
		,d01price=?
		,d01mokuteki=?
		,d01pmethod=?
		,d01f_open=?
		,d01tokurei=?
		,d01comm=?
		,d01entry_date=?
		,d01nyukin_kakunin_date=?
		,d01tel=?
		,d01fax=?
		,d01email=?
		,d01moushide=?
		,d01cyotei=?
		,d01furikomihyo=?
		,d01jyuryosyo=?
		
		,d01edittime=?
		,d01tokusan_offer=?
	where d01id = ?
EOT;
		
	$sth = $dbh->prepare($sql);
		$sth->bindValue(1, $in['d01date']);
		$sth->bindValue(2, $in['d01name']);
		$sth->bindValue(3, $in['d01zip']);
		$sth->bindValue(4, $in['d01addr']);
		$sth->bindValue(5, $in['d01price']);
		$sth->bindValue(6, $in['d01mokuteki']);
		$sth->bindValue(7, $in['d01pmethod']);
		$sth->bindValue(8, $in['d01f_open']);
		$sth->bindValue(9, $in['d01tokurei']);
		$sth->bindValue(10, $in['d01comm']);
		$sth->bindValue(11, $in['d01entry_date']);
		$sth->bindValue(12, $in['d01nyukin_kakunin_date']);
		$sth->bindValue(13, $in['d01tel']);
		$sth->bindValue(14, $in['d01fax']);
		$sth->bindValue(15, $in['d01email']);
		$sth->bindValue(16, $in['d01moushide']);
		$sth->bindValue(17, $in['d01cyotei']);
		$sth->bindValue(18, $in['d01furikomihyo']);
		$sth->bindValue(19, $in['d01jyuryosyo']);
		
		$sth->bindValue(20, date("Y/m/d H:i:s"));

		$sth->bindValue(21,$in['d01tokusan_offer']);

		// bindの順序注意！
		$sth->bindValue(22,$in['d01id']);

	$sth->execute();
	$sth->closeCursor();


    for ($i=1;$i<=3;$i++) {

		if (!isset($in['i01id_'.$i]) || $in['i01id_'.$i]=="" || $in['i01id_'.$i]=="0") {

			$sth = $dbh->prepare("delete from $glb[db_prefix]m01 where d01id=? and m01id=?");
            $ret = $sth->execute(array($in['d01id'],$i));
        } else {

            $in["m01qty_".$i] += 0;
            $in["m01charge_".$i] += 0;
            $in["m01postage_".$i] += 0;

            if ($in['c01id_'.$i] == "") {
                $in["c01id_".$i] = 0;
            }
            if ($in['m01hassouirai_'.$i] == "") {
                $in["m01hassouirai_".$i] = null;
            }
            if ($in['m01hassoubi_'.$i] == "") {
                $in["m01hassoubi_".$i] = null;
            }


            if (!isset($in['i01id_'.$i.'x']) || $in['i01id_'.$i.'x']=="") {
                //過去に登録がないので新規登録
                $sql =<<<EOT
			insert into $glb[db_prefix]m01(
				 m01addtime
				,m01edittime
				,m01deltime
				,d01id
				,m01hassouirai
				,i01id
				,m01qty
				,m01charge
				,m01postage
				,m01hassoubi
				,c01id
				,m01id
			) values (?,?,?,?,?,?,?,?,?,?,?,?)
EOT;
    
                $sth = $dbh->prepare($sql);
                $sth->bindValue(1, date("Y/m/d H:i:s"));
                $sth->bindValue(2, date("Y/m/d H:i:s"));
                $sth->bindValue(3, null);
            
                $sth->bindValue(4, $in['d01id']);
                $sth->bindValue(5, $in['m01hassouirai_'.$i]);
                $sth->bindValue(6, $in['i01id_'.$i]);
                $sth->bindValue(7, $in['m01qty_'.$i]);
                $sth->bindValue(8, $in['m01charge_'.$i]);
                $sth->bindValue(9, $in['m01postage_'.$i]);
                $sth->bindValue(10, $in['m01hassoubi_'.$i]);
                $sth->bindValue(11, $in['c01id_'.$i]);
				$sth->bindValue(12, $i);
				
				$ret = $sth->execute();
        
				if (!$ret) {
					$arr = $sth->errorInfo();
					print_r($arr);
					die('INSERT 失敗');
				}

            } else {
                //過去に登録がないので新規登録
                $sql =<<<EOT
			update $glb[db_prefix]m01 set 
				 m01edittime=?
				,m01hassouirai=?
				,i01id=?
				,m01qty=?
				,m01charge=?
				,m01postage=?
				,m01hassoubi=?
				,c01id=?
			where d01id=? and m01id=?
EOT;
    
                $sth = $dbh->prepare($sql);
                $sth->bindValue(1, date("Y/m/d H:i:s"));
                $sth->bindValue(2, $in['m01hassouirai_'.$i]);
                $sth->bindValue(3, $in['i01id_'.$i]);
                $sth->bindValue(4, $in['m01qty_'.$i]);
                $sth->bindValue(5, $in['m01charge_'.$i]);
                $sth->bindValue(6, $in['m01postage_'.$i]);
                $sth->bindValue(7, $in['m01hassoubi_'.$i]);
                $sth->bindValue(8, $in['c01id_'.$i]);
                $sth->bindValue(9, $in['d01id']);
				$sth->bindValue(10,$i);
				
				$ret = $sth->execute();
        
				if (!$ret) {
					$arr = $sth->errorInfo();
					print_r($arr);
					die('UPADTE 失敗');
				}

            }
        

        
            $sth->closeCursor();
        }
    }






	unset($_SESSION["spa"]);
	$in = array();
	ph1_rtn();

	exit;
	
}
