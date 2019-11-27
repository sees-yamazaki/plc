<?php
    require "./config.inc.php";
    session_start();

    #===================================
    if(!function_exists('strip_magic_quotes_slashes')) {
      if (get_magic_quotes_gpc()) {
        function strip_magic_quotes_slashes($arr)
        {
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
    #===================================
    
    if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') == 0) {
        $in = $_POST;
    } else {
        $in= $_GET;
    }

    foreach($in as $key => $value) {
        $value = mb_ereg_replace("\x0d\x0a|\x0d|\x0a","_!br!_", $value,"i");
        $value = htmlspecialchars($value,ENT_COMPAT,"utf-8");
        $value = mb_ereg_replace("_!br!_","<br />", $value);
        $in[$key] = $value;
    }
    
	
	
	###################################
	
	if (isset($_REQUEST['mode'])){
		if ($_REQUEST['mode'] == 'logoff'){
			unset($_SESSION["aid"]);
			unset($_SESSION["aname"]);
			unset($_SESSION["permit"]);
			admin_login_rtn();
		}
	}else{
		if ((isset($in['aid'])) and (isset($in['apw']))){
	    	$sth = $dbh->prepare("select * from $glb[db_prefix]a01 where a01aid=? and a01apw=?");
			$sth->bindParam(1, $in['aid'], PDO::PARAM_STR);
			$sth->bindParam(2, $in['apw'], PDO::PARAM_STR);
			$sth->execute();
		    $res = $sth->fetch(PDO::FETCH_ASSOC);
		    $sth->closeCursor();
		
			if ($res["a01id"] == 0){
				admin_login_rtn();
			}else{
				$_SESSION["aid"]	= $res[a01id];
				$_SESSION["aname"]	= $res[a01aname];
				$_SESSION["permit"]	= $res[a01permit];
				admin_menu_rtn();
			}
		}else{
			if ($_SESSION["aid"] == 0){
				admin_login_rtn();
			}else{
				admin_menu_rtn();
			}
		}
	}
	###################################
	exit();
	
;###############################################################################
function admin_login_rtn(){
;###############################################################################
	$_SESSION["admin_login_flg"] = 0;
	global $dbh;
    global $in;
    global $glb;
    global $lcl;
    $ssid = session_id();

print <<<EOT
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>管理画面</title>
<link rel="stylesheet" href="./css/mgstd.css" type="text/css" media="all" />
<style type="text/css">
<!--
#wrapper {
	width: 100%;
	text-align:center;
}
-->
</style>
</head>
<body> 
  <div id="wrapper"> 
      <div class="nrm_box" style="width:400px; margin:150px auto 10px auto;">
        <form method="post" action="./"> 
          <table cellspacing="0" cellpadding="3" style="width:100%; margin:10px auto;"> 
            <tr> 
              <th width="40%">ログインID</th> 
              <td width="60%" class="topline"><input type="text" name="aid" value="" style="width:150px;ime-mode:inactive" /></td> 
            </tr> 
            <tr> 
              <th>パスワード</th> 
              <td><input type="password" name="apw" value="" style="width:150px;ime-mode:inactive" /></td> 
            </tr> 
          </table>
          <input type="submit" value="ログイン" class="cmd" /> 
        </form> 
      </div>
<div style="vertical-align:top">
{$_SERVER['REMOTE_ADDR']}
</div>
</div> 
</body>
</html>


EOT;
	
}
#


;###############################################################################
function admin_menu_rtn(){
;###############################################################################
    global $dbh;
    global $in;
    global $glb;
    global $lcl;
	
	header("Location: ./mnt_data.php");
	exit;
	
//$title = "";
//$add_head = <<<EOT
//EOT;
//
//
//$inner = <<<EOT
//<h1>トップページ</h1>
//<div class="main">
//</div>
//EOT;
//
//	require("admin_common.html");
    
	exit;
}
