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
    
	if($in['ph'] == 100) { ph100_rtn() ;} #
	//if($in['ph'] == 100) { ph1_rtn() ;} #
		

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
    if(isset($in[delid])){
        $sth = $dbh->prepare("select count(*) as cnt from $glb[db_prefix]i01 where `i01gyosha1`= '$in[delid]' or `i01gyosha2`= '$in[delid]' or`i01gyosha3`= '$in[delid]' or`i01gyosha4`= '$in[delid]' or`i01gyosha5`= '$in[delid]'");
        $sth->execute();
        $cnt=0;
        if ($res = $sth->fetch()) {
            $cnt = $res['cnt'];
        }

        if ($cnt==0) {
            $sth = $dbh->prepare("delete from $glb[db_prefix]c01 where `c01id`= '$in[delid]' ");
            $sth->execute();
        }else{
            $err_msg = "<span style='color:red' >削除しようとした業者は商品マスタで使用されています。<br>先に商品マスタを編集してください。</span>";
        }

    }
    $in[delid]="";

	
    $sth = $dbh->prepare("select * from $glb[db_prefix]c01 order by c01id ");
	$sth->execute();
    while($res = $sth->fetch(PDO::FETCH_ASSOC)){
		
$list .= <<<EOT
		<tr style="background:$bgcolor;">
        <td class="tln">{$res['c01id']}</td>
        <td class="tln">{$res['c01name']}</td>
        <form name="qfm" method="get" action="clients.php">
        <td class="tln">
        <input type="submit" class="btn btn-xs btn-info" value="編集">
        <input type="button" class="btn btn-xs btn-danger" value="削除" onclick="line_delete($res[c01id]);">
        </td>
        <input type="hidden" name="ph" value="100" />
        <input type="hidden" name="c01id" value="{$res['c01id']}">
        <input type="hidden" name="c01name" value="{$res['c01name']}">
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
	function line_delete(c01id){
		if ( confirm('削除します。よろしいですか？')){	
			document.qfmD.delid.value=c01id;
			document.qfmD.submit();
		}
	}
	
// ]]> -->
</script>
EOT;

#===============================================================================
$inner = <<<EOT
<h1>業者管理画面</h1>
<form name="efm" method="post" action="mnt_data.php">
	<input type="hidden" name="ph" value="21" />
	<input type="hidden" name="d01id" value="0" />
</form> 
<div class="main"> 
$err_msg 
    <form name="qfm" method="get" action="clients.php">
    <input type="hidden" name="ph" value="100" />
        <input type="submit" class="btn btn-info" value="新規登録">
    </form>
	<form name="qfmD" method="get" action="clients.php">
	    <input type="hidden" name="ph" value="1" />
	    <input type="hidden" name="delid" value="" />
    </form>

    <br>
	
	<table class="pubTable">
		<thead>
			<tr>
                <th style="width:100px;">ID</th>
                <th style="width:300px;">業者名</th>
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

            if (isset($in[cID]) && $in[cID]<>"" ) {

                $sth = $dbh->prepare("UPDATE $glb[db_prefix]c01 SET `c01name`=?, `c01edittime`=? WHERE `c01id`=?");
                $sth->execute(array( $in[c01name], date("Y/m/d H:i:s"), $in[cID] ) );

                header("Location: ./clients.php");
            }else{

                $sth = $dbh->prepare("INSERT INTO $glb[db_prefix]c01 ( `c01name`) VALUES (?)");
                $sth->execute(array( $in[c01name]) );

                header("Location: ./clients.php");
            }
        }
    
        
        $sth = $dbh->prepare("select * from $glb[db_prefix]c01 where c01id = '$in[c01id]' ");
        $sth->execute();
        if ($res = $sth->fetch()) {
            $c01id = $res['c01id'];
            $c01name = $res['c01name'];
        }

        $sth->closeCursor();
    

    #===============================================================================
    
    $title = "業者マスタ編集";
    
    
    #===============================================================================
    $add_head =<<<EOT
    EOT;
    
    #===============================================================================
    $inner = <<<EOT
    <h1>$title <a href="#" onClick="location.href='./clients.php?sw_ss=1'; return false;" class="btn">一覧に戻る</a></h1>

    <div class="main"> 
    
        <form name="qfm" method="get" action="clients.php">
            <input type="hidden" name="ph" value="100" />
            <table class="pubTable">
            <tr>
            <th>業者ID</th>
            <td>$c01id</td>
            </tr>
            <tr>
            <th>業者名</th>
            <td><input type="text" name="c01name" value="$c01name" style="width:300px;" required></td>
            </tr>
            <tr>
            <td colspan="2" style="text-align:center;">
           <input type="submit" class="btn btn-info" value="登録">
                <input type="hidden" name="cID" value="$in[c01id]">
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
    
    