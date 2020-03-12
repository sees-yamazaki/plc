<?php
include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';
include 'x10c/db/adwares.php';
include 'x10c/db/x10.php';
include 'x10c/db/system.php';

// セッション再開
session_start();

//Timezone
date_default_timezone_set('Asia/Tokyo');

// エラーメッセージの初期化
$errorMessage = '';

$LOGIN_ID = $_SESSION[ $SESSION_NAME ];

if(empty($LOGIN_ID)){ header('Location: x10n_logoff.php'); }

$id = empty($_GET['id']) ? $_POST['id'] : $_GET['id'];

$id_title = substr($id, 0, 1)=="A" ? 'adwares' : 's_adwares';

$ad = getAdware($id);

$html = '';

if ($ad->adware_type=="0") {
    $html .= 'オファー詳細（目標報酬）<br>';
} else {
    $html .= 'オファー詳細（クリック報酬）<br>';
}

if (!empty($ad->banner)) {
    $html .= '<img src="'.$ad->banner.'"><br>';
}

$html .= 'オファー登録日　'.date('Y/m/d', $ad->regist).'<br>';

if (empty($ad->startdt) && empty($ad->enddt)) {
    $html .= 'オファー期間　無期限<br>';
} else {
    $html .= 'オファー期間　'.$ad->startdt.'〜'.$ad->enddt.'<br>';
}

$html .= '<h1>'.$ad->name.'</h1><br>';

$stts = getAdwareStatus($id);

switch ($stts) {
    case 22:
    case 21:
    case 20:
    case 12:
    case 2:
    $html .= '<h3>ここのオファーは終了しています。</h3>このオファーは終了しておりますので成果は計測されません<br>';
    break;
    case 11:
    case 10:
    $html .= '<h3>このオファーは期間終了が近づいています。</h3>期間終了後は成果が発生しませんのでご注意下さい<br>';
    break;
    case 11:
    case 1:
    $html .= '<h3>このオファーは予算上限が近づいています。</h3>予算上限到達後は成果が発生しませんのでご注意下さい<br>';
    break;
}







$html .= ''.nl2br($ad->comment).'<br>';

if ($ad->approvable=="0") {
    $html .= '[オープン制]';
} else {
    $html .= '[承認制]';
}

$html .= '<br>';

if ($ad->adware_type=="0") {
    $html .= '[目標報酬]<br>';
    $html .= '報酬単価<br>'.$ad->money.'円/目標達成<br>';
} else {
    $html .= '[クリック報酬]<br>';
    $html .= '報酬単価<br>'.$ad->click_money.'円/1クリック<br>';
}

$html .= '<br>';

$sys = getSystem();
$url = $sys->home;


//広告IDとユーザIDでHASHフォルダ名を決定する
$hashID = hash('fnv132', $LOGIN_ID.$id);

if (!file_exists("p/".$hashID)) {
    mkdir("p/".$hashID, 0777);
    
    // ファイルを書き込みモードで開く
    $file_handle = fopen("p/".$hashID."/index.php", "w");
    
    // ファイルへデータを書き込み
    if (substr($url, -1)=='/') {
        $url = substr($url, 0, -1);
    }
    $rhtml='<?php'.PHP_EOL;
    $rhtml.='header("location: '.$url .'/link.php?id='.$LOGIN_ID.'&'.$id_title .'='.$id.'");'.PHP_EOL;
    $rhtml.='exit();'.PHP_EOL;
    $rhtml.='?>';
    fwrite($file_handle, $rhtml);
    
    // ファイルを閉じる
    fclose($file_handle);
}


if (!is_null($ad->enddt) && $ad->enddt<$tdy) {
    $html .= 'このオファーの掲載期間は終了しています。<br>';
} elseif ($ad->approvable=="1") {
    $ofr = getOfferStatus($id, $LOGIN_ID);

    if (is_null($ofr->status)) {
        $html .= '<form action="x10n_adwares_offer.php" method="POST">';
        $html .= '<input type="submit" value="参加リクエスト"><br>';
        $html .= '<input type="hidden" name="adware" value="'.$id.'">';
        $html .= '<input type="hidden" name="status" value="0">';
        $html .= '</form>';
    } elseif ($ofr->status=="0") {
        $html .= 'リクエスト承認待ち<br>';
        $html .= '<form action="x10n_adwares_offer.php" method="POST">';
        $html .= '<input type="submit" value="参加リクエストを取り下げる"><br>';
        $html .= '<input type="hidden" name="adware" value="'.$id.'">';
        $html .= '<input type="hidden" name="status" value="1">';
        $html .= '</form>';
    } elseif ($ofr->status=="1") {
        $html .= 'このオファーにはリクエスト申請できません<br>';
    } elseif ($ofr->status=="2") {
        $html .= '以下のURLを投稿しよう<br>';
        if (substr($url, -1)=='/') {
            $url = substr($url, 0, -1);
        }
        $html .= '<input type="text" id="url" value="'.$url .'/p/'.$hashID.'" readonly><br>';
//        $html .= '<input type="text" id="url" value="'.$url .'/link.php?id='.$LOGIN_ID.'&'.$id_title .'='.$id.'" readonly><br>';
        $html .= '<input type="button" onclick="document.getElementById(\'url\').select();document.execCommand(\'copy\');" value="URLをコピー"><br>';
    } else {
        $html .= 'what\'s status?'.$ofr->status.'<br>';
    }
    $html .= '<br>';
} else {
    $html .= '以下のURLを投稿しよう<br>';
    if (substr($url, -1)=='/') {
        $url = substr($url, 0, -1);
    }
    $html .= '<input type="text" id="url" value="'.$url .'/p/'.$hashID.'" readonly><br>';
//    $html .= '<input type="text" id="url" value="'.$url .'/link.php?id='.$LOGIN_ID.'&'.$id_title .'='.$id.'" readonly><br>';
    $html .= '<input type="button" onclick="document.getElementById(\'url\').select();document.execCommand(\'copy\');" value="URLをコピー"><br>';
}

$html .= '成果条件<br>'.nl2br($ad->results).'<br>';
$html .= '否認条件<br>'.nl2br($ad->denials).'<br>';
$html .= 'NGキーワード<br>'.nl2br($ad->ngword).'<br>';
$html .= '備考<br>'.nl2br($ad->note).'<br>';
//$html .= 'キーワード<br>'.$ad->keyword.'<br>';
$tags = explode(' ', $ad->keyword);
foreach ($tags as $tag) {
    $html .= '<a href="x10n_adwares_search_tag.php?id='.$id.'&tag='.$tag.'">'.$tag.'</a> ';
}
$html .= '<br>';



?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo ""; ?></title>
    <link rel="stylesheet" href="x10n/css/main.css">
</head>

<body>


<?php echo $html; ?>

<br><br>
<a href="x10n_adwares_search.php">オファー一覧へ</a><br>
<input type="button" onclick="location.href='x10n_home.php'" value="トップへ">

</body>

</html>