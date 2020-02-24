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

$id = empty($_GET['id']) ? $_POST['id'] : $_GET['id'];

$ad = getAdware($id );

$html = '';

if ($ad->adware_type=="0") {
    $html .= 'オファー詳細（目標報酬）<br>';
}else{
    $html .= 'オファー詳細（クリック報酬）<br>';
}

if (!empty($ad->banner)) {
    $html .= '<img src="'.$ad->banner.'"><br>';
}

$html .= 'オファー登録日　'.date('Y/m/d', $ad->regist).'<br>';

if (empty($ad->startdt) && empty($ad->enddt)) {
    $html .= 'オファー期間　無期限<br>';
}else{
    $html .= 'オファー期間　'.$ad->startdt.'〜'.$ad->enddt.'<br>';
}

$html .= '<h1>'.$ad->name.'</h1><br>';

$html .= ''.nl2br($ad->comment).'<br>';

if ($ad->approvable=="0") {
    $html .= '[オープン制]';
}else{
    $html .= '[承認制]';
}

$html .= '<br>';

if ($ad->adware_type=="0") {
    $html .= '[目標報酬]<br>';
    $html .= '報酬単価<br>'.$ad->money.'円/目標達成<br>';

}else{
    $html .= '[クリック報酬]<br>';
    $html .= '報酬単価<br>'.$ad->click_money.'円/1クリック<br>';
}

$html .= '<br>';

$url = getSystemUrl();

$tdy = date('Y-m-d');

if ($ad->enddt<$tdy) {    
    $html .= 'このオファーの掲載期間は終了しています。<br>';
}elseif ($ad->approvable=="1") {
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
        $html .= '<input type="text" value="'.$url .'/link.php?id='.$LOGIN_ID.'&s_adwares='.$id.'" readonly><br>';
        $html .= '<input type="button" onclick="document.getElementById(\'url\').select();document.execCommand(\'copy\');" value="URLをコピー"><br>';
    } else {
        $html .= 'what\'s status?'.$ofr->status.'<br>';
    }
    $html .= '<br>';
}else{
    $html .= '以下のURLを投稿しよう<br>';
    if (substr($url, -1)=='/') {
        $url = substr($url, 0, -1);
    }
    $html .= '<input type="text" id="url" value="'.$url .'/link.php?id='.$LOGIN_ID.'&adwares='.$id.'" readonly><br>';
    $html .= '<input type="button" onclick="document.getElementById(\'url\').select();document.execCommand(\'copy\');" value="URLをコピー"><br>';
}

$html .= '成果条件<br>'.nl2br($ad->results).'<br>';
$html .= '否認条件<br>'.nl2br($ad->denials).'<br>';
$html .= 'NGキーワード<br>'.nl2br($ad->ngword).'<br>';
$html .= '備考<br>'.nl2br($ad->note).'<br>';
$html .= 'キーワード<br>'.$ad->keyword.'<br>';


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