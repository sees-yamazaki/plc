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
    
	//if($in['ph'] == 100) { ph100_rtn() ;} #
	if($in['ph'] == 100) { ph100_rtn() ;} #
		

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
	
    #===================================
    if(isset($in[delid])){
        //TODO 注文が存在するかどうか確認する
        $sth = $dbh->prepare("select count(*) as cnt from $glb[db_prefix]m01 where `i01id`= '$in[delid]' ");
        $sth->execute();
        $cnt=0;
        if ($res = $sth->fetch()) {
            $cnt = $res['cnt'];
        }

        if ($cnt==0) {
            $sth = $dbh->prepare("delete from $glb[db_prefix]i01 where i01id ='$in[delid]'");
            $sth->execute();
        }else{
            $err_msg = "<span style='color:red' >削除しようとした商品は注文履歴に存在するため削除できません。</span>";
        }


    }

    $in[delid]="";


	
    $sth = $dbh->prepare("select * from $glb[db_prefix]i01  order by i01id ");
	$sth->execute();
    while($res = $sth->fetch(PDO::FETCH_ASSOC)){
		
$list .= <<<EOT
		<tr style="background:$bgcolor;">
            <td class="tln">{$res['i01id']}</td>
            <td class="tln">{$res['i01name']}</td>
            <td class="tln">{$res['i01name2']}</td>
            <td class="tln">{$res['i01qty']}</td>
            <td class="tln">{$_number_format($res['i01price'])}</td>
            <form name="qfm" method="get" action="items.php">
            <td class="tln">
            <input type="submit" class="btn btn-xs btn-info" value="編集">
            <input type="button" class="btn btn-xs btn-danger" value="削除" onclick="line_delete($res[i01id]);">
            </td>
            <input type="hidden" name="ph" value="100" />
            <input type="hidden" name="i01id" value="{$res['i01id']}">
            <input type="hidden" name="i01name" value="{$res['i01name']}">
            </form>
		</tr>
EOT;
			
    }
    $sth->closeCursor();

#===============================================================================

$title = "特産品別カウント";


#===============================================================================
$add_head =<<<EOT
<script type="text/javascript">
<!-- <![CDATA[
	function line_delete(i01id){
		if ( confirm('削除します。よろしいですか？')){	
			document.qfmD.delid.value=i01id;
			document.qfmD.submit();
		}
	}
	
// ]]> -->
</script>
EOT;

#===============================================================================
$inner = <<<EOT
<h1>商品管理画面</h1>
<form name="efm" method="post" action="mnt_data.php">
	<input type="hidden" name="ph" value="21" />
	<input type="hidden" name="d01id" value="0" />
</form> 
<div class="main"> 
$err_msg 
	<form name="qfm" method="get" action="items.php">
	    <input type="hidden" name="ph" value="100" />
            <input type="submit" class="btn btn-info" value="新規登録">
    </form>
	<form name="qfmD" method="get" action="items.php">
	    <input type="hidden" name="ph" value="1" />
	    <input type="hidden" name="delid" value="" />
    </form>

    <br>
	
	<table class="pubTable">
		<thead>
			<tr>
                <th style="width:100px;">ID</th>
                <th style="width:300px;">商品名</th>
                <th style="width:300px;">商品名(内訳用)	</th>
                <th style="width:300px;">数量(内訳用)</th>
                <th style="width:300px;">金額</th>
                <th style=""></th>
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
function ph100_rtn(){	#編集
    ;#==============================================================================
        global $dbh;
        global $in;
        global $glb;
        global $lcl;
        $ssid = session_id();

        #===================================
        if($in[stts]=="edit"){

            if (isset($in[iID]) && $in[iID]<>"" ) {

                $sth = $dbh->prepare("UPDATE $glb[db_prefix]i01 SET `i01name`=?,`i01name2`=?,`i01qty`=?,`i01price`=?,`i01gyosha1`=?,`i01gyosha2`=?,`i01gyosha3`=?,`i01gyosha4`=?,`i01gyosha5`=?, `i01edittime`=? WHERE `i01id`=?");
                $sth->execute(array( $in[i01name],$in[i01name2],$in[i01qty],$in[i01price],$in[i01gyosha1],$in[i01gyosha2],$in[i01gyosha3],$in[i01gyosha4] ,$in[i01gyosha5],date("Y/m/d H:i:s"), $in[iID] ) );

                header("Location: ./items.php");
            }else{

                $sth = $dbh->prepare("INSERT INTO $glb[db_prefix]i01 ( `i01name`, `i01name2`, `i01qty`, `i01price`, `i01gyosha1`, `i01gyosha2`, `i01gyosha3`, `i01gyosha4`, `i01gyosha5`) VALUES  (?,?,?,?,?,?,?,?,?)");
                $sth->execute(array( $in[i01name],$in[i01name2],$in[i01qty],$in[i01price],$in[i01gyosha1],$in[i01gyosha2],$in[i01gyosha3],$in[i01gyosha4] ,$in[i01gyosha5] ) );

                header("Location: ./items.php");
            }
        }

        if($in[stts]=="delete"){
            $sth = $dbh->prepare("delete from $glb[db_prefix]c01 where `c01id`= '$in[cli_id]' ");
            $sth->execute();
        }
        $in[iID]="";
    
        
        $sth = $dbh->prepare("select * from $glb[db_prefix]i01 where i01id = '$in[i01id]' ");
        $sth->execute();
        if ($res = $sth->fetch()) {
            $i01id = $res['i01id'];
            $i01name = $res['i01name'];
            $i01name2 = $res['i01name2'];
            $i01qty = $res['i01qty'];
            $i01price = $res['i01price'];
            $i01gyosha1 = $res['i01gyosha1'];
            $i01gyosha2 = $res['i01gyosha2'];
            $i01gyosha3 = $res['i01gyosha3'];
            $i01gyosha4 = $res['i01gyosha4'];
            $i01gyosha5 = $res['i01gyosha5'];
        }

        $sth->closeCursor();
    
	$gyosha1 = "<option value='0'></option>";
	$gyosha2 = "<option value='0'></option>";
	$gyosha3 = "<option value='0'></option>";
	$gyosha4 = "<option value='0'></option>";
	$gyosha5 = "<option value='0'></option>";
	$sth = $dbh->prepare("select * from $glb[db_prefix]c01 order by c01id");
	$sth->execute();
    while($res = $sth->fetch(PDO::FETCH_ASSOC)){
    	if ($res[c01name] == ""){ continue; }
		if ($i01gyosha1 === $res[c01id]){ $wk="selected"; }else{ $wk=""; }
		$gyosha1 .= "<option value='{$res[c01id]}' {$wk}>{$res[c01name]}</option>";
		if ($i01gyosha2 === $res[c01id]){ $wk="selected"; }else{ $wk=""; }
		$gyosha2 .= "<option value='{$res[c01id]}' {$wk}>{$res[c01name]}</option>";
		if ($i01gyosha3 === $res[c01id]){ $wk="selected"; }else{ $wk=""; }
		$gyosha3 .= "<option value='{$res[c01id]}' {$wk}>{$res[c01name]}</option>";
		if ($i01gyosha4 === $res[c01id]){ $wk="selected"; }else{ $wk=""; }
		$gyosha4 .= "<option value='{$res[c01id]}' {$wk}>{$res[c01name]}</option>";
		if ($i01gyosha5 === $res[c01id]){ $wk="selected"; }else{ $wk=""; }
		$gyosha5 .= "<option value='{$res[c01id]}' {$wk}>{$res[c01name]}</option>";
    }
    $sth->closeCursor();

    #===============================================================================
    
    $title = "商品マスタ編集";
    
    
    #===============================================================================
    $add_head =<<<EOT
EOT;
    
    #===============================================================================
    $inner = <<<EOT
    <h1>$title <a href="#" onClick="location.href='./items.php?sw_ss=1'; return false;" class="btn">一覧に戻る</a></h1>

    <div class="main"> 
    
        <form name="qfm" method="get" action="items.php">
            <input type="hidden" name="ph" value="100" />
            <table class="pubTable">
            <tr>
            <th>商品ID</th>
            <td>$i01id</td>
            </tr>
            <tr>
            <th>商品名</th>
            <td><input type="text" name="i01name" value="$i01name" style="width:300px;" required></td>
            </tr>
            <tr>
            <th>商品名(内訳用)</th>
            <td><input type="text" name="i01name2" value="$i01name2" style="width:300px;" required></td>
            </tr>
            <tr>
            <th>数量(内訳用)</th>
            <td><input type="number" name="i01qty" value="$i01qty" style="width:200px;" min=0 max=9999 required></td>
            </tr>
            <tr>
            <th>金額</th>
            <td><input type="number" name="i01price" value="$i01price" style="width:200px;" min=0 max=999999 required></td>
            </tr>
            <tr>
            <th>取扱業者</th>
            <td><select name="i01gyosha1" required>$gyosha1</select></td>
            </tr>
            <tr>
            <th>取扱業者</th>
            <td><select name="i01gyosha2">$gyosha2</select></td>
            </tr>
            <tr>
            <th>取扱業者</th>
            <td><select name="i01gyosha3">$gyosha3</select></td>
            </tr>
            <tr>
            <th>取扱業者</th>
            <td><select name="i01gyosha4">$gyosha4</select></td>
            </tr>
            <tr>
            <th>取扱業者</th>
            <td><select name="i01gyosha5">$gyosha5</select></td>
            </tr>
            <tr>
            <td colspan="2" style="text-align:center;">
           <input type="submit" class="btn btn-info" value="登録">
                <input type="hidden" name="iID" value="$in[i01id]">
                <input type="hidden" name="stts" value="edit">
                </td>
                </tr>
                </form>
    
        <hr>
    
    </div>
EOT;
    
    
    ####################################
    
    require("admin_common.html");
        exit;
        
    }
    
    