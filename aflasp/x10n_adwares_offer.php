<?php
include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';
include 'x10c/db/adwares.php';
include 'x10c/db/x10.php';

// セッション再開
session_start();

//Timezone
date_default_timezone_set('Asia/Tokyo');

// エラーメッセージの初期化
$errorMessage = '';

$ofr = new cls_offer();

$ofr->adware = $_POST['adware'];
$ofr->nuser = $_SESSION[ $SESSION_NAME ];
$ofr->status = $_POST['status'];


if($ofr->status=="0"){
    insertX10Offer($ofr);
    $title ='参加リクエストを申請しました。';
}elseif($ofr->status=="1"){
    deleteX10Offer($ofr);
    $title ='参加リクエストを取り下げました。';
}


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


<?php echo $title; ?>

<br><br>
<input type="button" onclick="location.href='x10n_adwares_info.php?id=<?php echo $ofr->adware; ?>'" value="戻る">

</body>

</html>