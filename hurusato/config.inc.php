<?php
####################################################################################################
// ふるさと納税台帳
####################################################################################################
error_reporting(E_ALL ^ E_NOTICE);

$glb["version"] = "0.03";

mb_language('Japanese');
mb_internal_encoding("UTF-8");
mb_http_output('UTF-8');

# 環境設定
$glb['dbhost']	= '127.0.0.1';
$glb['dbport']	= '3306';
$glb['dbname']	= 'furusato';
$glb['dbuser']	= 'plcAdmin';
$glb['dbpass']	= 'plc2012';

$glb['db_prefix'] = "test_";

####################################################################################################
//	Constant Data
####################################################################################################

$glb[pref][1]="北海道";$glb[pref][2]="青森県";$glb[pref][3]="岩手県";$glb[pref][4]="宮城県";
$glb[pref][5]="秋田県";$glb[pref][6]="山形県";$glb[pref][7]="福島県";$glb[pref][8]="茨城県";
$glb[pref][9]="栃木県";$glb[pref][10]="群馬県";$glb[pref][11]="埼玉県";$glb[pref][12]="千葉県";
$glb[pref][13]="東京都";$glb[pref][14]="神奈川県";$glb[pref][15]="新潟県";$glb[pref][16]="富山県";
$glb[pref][17]="石川県";$glb[pref][18]="福井県";$glb[pref][19]="山梨県";$glb[pref][20]="長野県";
$glb[pref][21]="岐阜県";$glb[pref][22]="静岡県";$glb[pref][23]="愛知県";$glb[pref][24]="三重県";
$glb[pref][25]="滋賀県";$glb[pref][26]="京都府";$glb[pref][27]="大阪府";$glb[pref][28]="兵庫県";
$glb[pref][29]="奈良県";$glb[pref][30]="和歌山県";$glb[pref][31]="鳥取県";$glb[pref][32]="島根県";
$glb[pref][33]="岡山県";$glb[pref][34]="広島県";$glb[pref][35]="山口県";$glb[pref][36]="徳島県";
$glb[pref][37]="香川県";$glb[pref][38]="愛媛県";$glb[pref][39]="高知県";$glb[pref][40]="福岡県";
$glb[pref][41]="佐賀県";$glb[pref][42]="長崎県";$glb[pref][43]="熊本県";$glb[pref][44]="大分県";
$glb[pref][45]="宮崎県";$glb[pref][46]="鹿児島県";$glb[pref][47]="沖縄県";


#公表の有無
$glb[f_open][1] = "不可";
$glb[f_open][2] = "可";

#特例申請
$glb[tokurei][1] = "無";
$glb[tokurei][2] = "有";

#特産品希望
$glb[tokusan_offer][1] = "無";
$glb[tokusan_offer][2] = "有";


#寄付目的
$glb[mokuteki][1] = "福祉基金";
$glb[mokuteki][2] = "教育振興基金";
$glb[mokuteki][3] = "ふるさと創生基金";
$glb[mokuteki][4] = "農山漁村地域活性化基金";
$glb[mokuteki][5] = "洋野町に一任";


#払込方法
$glb[pmethod][1] = "クレジットカード";
$glb[pmethod][2] = "ゆうちょ銀行";
$glb[pmethod][3] = "指定金融機関";
$glb[pmethod][4] = "その他金融機関";
$glb[pmethod][5] = "窓口";


//> 特産品リストは26種類ありますので、添付ファイルにて
//> ご確認をお願い致します。 */

####################################################################################################


	try{
		$dsn = "mysql:dbname=$glb[dbname];host=$glb[dbhost]";
	    $dbh = new PDO($dsn, $glb['dbuser'], $glb['dbpass']);
	    $dbh->query('set names utf8');
	}catch (PDOException $e){
	    print('Error:'.$e->getMessage());
	    die();
	}
	

//==================================================================================================
function arr2csv($arr) {
    $fp = fopen('php://temp', 'r+b');
    foreach ($arr as $fields) {
        fputcsv($fp, $fields);
    }
    rewind($fp);
    $tmp = str_replace(PHP_EOL, "\r\n", stream_get_contents($fp));
    return mb_convert_encoding($tmp, 'SJIS-win', 'UTF-8');
}



;#==============================================================================
function encode_special_char_simple($value){
;#==============================================================================
	$value = mb_ereg_replace("\x0d\x0a|\x0d|\x0a|<br>|<br \/>","_!br!_", $value);
	$value = mb_ereg_replace("\t","", $value);
	$value = mb_ereg_replace("&","&amp;", $value);
	$value = mb_ereg_replace("_!br!_","<br \/>", $value);
	return $value;
}

;#==============================================================================
function decode_special_char_simple($value){
;#==============================================================================
	$value = mb_ereg_replace("&amp;","&", $value);
	$value = mb_ereg_replace("<br>|<br \/>","\n", $value);
	return $value;
}

;#==============================================================================
function encode_special_char($value){
;#==============================================================================
	$value = mb_ereg_replace("\x0d\x0a|\x0d|\x0a|<br>|<br \/>","_!br!_", $value);
	$value = mb_ereg_replace("\t","", $value);
	$value = mb_ereg_replace("&","&amp;", $value);
	$value = mb_ereg_replace("<","&lt;", $value);
	$value = mb_ereg_replace(">","&gt;", $value);
	$value = mb_ereg_replace("\"","&quot;", $value);
	$value = mb_ereg_replace("\'","&#39;", $value);
	$value = mb_ereg_replace("_!br!_","<br \/>", $value);
	return $value;
}

;#==============================================================================
function decode_special_char($value){
;#==============================================================================
	$value = mb_ereg_replace("&quot;","\"", $value);
	$value = mb_ereg_replace("&#39;","\'", $value);
	$value = mb_ereg_replace("&amp;","&", $value);
	$value = mb_ereg_replace("&lt;","<", $value);
	$value = mb_ereg_replace("&gt;",">", $value);
	$value = mb_ereg_replace("<br>|<br \/>","\n", $value);
	
	$value = mb_ereg_replace("&","&amp;", $value);
	$value = mb_ereg_replace("\"","&quot;", $value);
	$value = mb_ereg_replace("\'","&#39;", $value);
	$value = mb_ereg_replace("<","&lt;", $value);
	$value = mb_ereg_replace(">","&gt;", $value);

	return $value;
}

;#==============================================================================
function decode_special_char_full($value){
;#==============================================================================
	$value = mb_ereg_replace("&quot;","\"", $value);
	$value = mb_ereg_replace("&amp;","&", $value);
	$value = mb_ereg_replace("&lt;","<", $value);
	$value = mb_ereg_replace("&gt;",">", $value);
	$value = mb_ereg_replace("&#39;","\'", $value);
	$value = mb_ereg_replace("<br>|<br \/>","\n", $value);

	return $value;
}


;#==============================================================================
function isdate($date){
;#==============================================================================
	if ($date == ""){ return 1; }
    $date = mb_ereg_replace("/","-", $date);
	list($yy, $mm, $dd) =  @explode("-", $date);
	if(! @checkdate($mm, $dd, $yy)){
		return 0;
	}else{
		return 1;
	}
}

;#==============================================================================
function set_const($key,$value){
;#==============================================================================
    global $dbh;
    global $glb;
	$res = $dbh->query("select * from {$glb[db_prefix]}a00 where a00key=".$dbh->quote($key))->fetch(PDO::FETCH_ASSOC);
	
	if ($res[a00id] == 0){
		$now_datetime = date("Y-m-d H:i:s");
		$sql = "insert into $glb[db_prefix]a00 (a00addtime,a00key,a00value) values (:time,:key,:value)";
		$sth = $dbh->prepare($sql);
		$sth->bindValue(':time', date("Y-m-d H:i:s"));
		$sth->bindParam(':key', $key);
		$sth->bindParam(':value', $value);
		$sth->execute();
	}else{
		$sql = "update $glb[db_prefix]a00 set a00value=:value where a00key=:key";
		$sth = $dbh->prepare($sql);
		$sth->bindParam(':value', $value);
		$sth->bindParam(':key', $key);
		$sth->execute();
	}
	return;
}

;#==============================================================================
function get_const($key){
;#==============================================================================
    global $dbh;
    global $glb;
	$res = $dbh->query("select * from {$glb[db_prefix]}a00 where a00key=".$dbh->quote($key))->fetch(PDO::FETCH_ASSOC);
	
	return $res[a00value];
}

;#==============================================================================
function get_pageindex_admin($now_page,$line_max,$data_cnt,$form_name,$line_start,$prev_btn,$next_btn){
;#==============================================================================
;#	$data_cnt = $dbh->query("select count(d01id) from $glb[db_prefix]d01 {$sql_where}")->fetchColumn();
;#
;#	$line_max = 20;
;#	list($button_page,$line_start) = get_pageindex_admin($in[page],$line_max,$data_cnt,"qfm",$line_start,"","");
;#		
;#	$sth = $dbh->prepare("select * from $glb[db_prefix]d01 order by d01addtime desc limit $line_start,$line_max");



	if ($now_page == 0){ $now_page = 1; }
	$page_back = $now_page - 1;
	if ($page_back <= 0){
		$page_back = 1;
	}
	if ($data_cnt > $now_page * $line_max){
		$page_next = $now_page + 1;
	}else{
		$page_next = $now_page;
	}
	
	$line_start = ($now_page-1) * $line_max;

	if ($data_cnt % $line_max){
		$last_page = (int)($data_cnt/$line_max) + 1;
	}else{
		$last_page = (int)($data_cnt/$line_max);
	}
	###########
	
	### ページINDEX
	if ($last_page == 1){
		$page_index = "";
	}else{
		for($p=1;$p<=$last_page;$p++){
			if (($p >= $now_page - 5) and ($p <= $now_page + 5)){
				if ($p == $now_page){
					$page_index .= "<li class='active'><a>$p</a></li>&nbsp;&nbsp;";
				}else{
					$page_index .= "<li><a href=\"javascript:document.$form_name.page.value=$p;document.$form_name.submit();\">$p</a></li>&nbsp;&nbsp;";
				}
			}
		}
		if (($now_page - 5) > 1){
			$page_index = "…".$page_index;
		}
		if (($now_page + 5) < $last_page){
			$page_index .= "…";
		}
//		$page_index = "<li><a href=\"javascript:document.$form_name.page.value=1;document.$form_name.submit();\">TOP</a></li>&nbsp;&nbsp;".$page_index;
//		$page_index .= "<li><a href=\"javascript:document.$form_name.page.value=$last_page;document.$form_name.submit();\">LAST</a></li>&nbsp;&nbsp;";
	}
	
	### 改ページボタン
	if ($now_page> 1){
		$button_back = "<li><a href=\"javascript:document.$form_name.page.value=$page_back;document.$form_name.submit();\">前のページ</a></li>&nbsp;";
	}else{
		$button_back = "";
	}
	
	$PAGE_BUTTON .= $page_index;
	if ($now_page < $last_page){	
		$button_next = "<li><a href=\"javascript:document.$form_name.page.value=$page_next;document.$form_name.submit();\">次のページ</a></li>";
	}else{
		$button_next = "";
	}

	if ($data_cnt <= $line_max){
		return array("",0);
	}else{
		
		$wk=<<<EOT
			<nav>
				<ul class="pagination">
					$button_back
					$page_index
					$button_next
				</ul>
			</nav>
EOT;
		
		return array("$wk",$line_start);
	}
}