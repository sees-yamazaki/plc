<?php

// セッション開始
session_start();
require('session.php');
require('logging.php');

// ログイン状態チェック
if (getSsnIsLogin()==false) {
    header("Location: a_logoff.php");
    exit;
}

// エラーメッセージの初期化
$errorMessage = "";




$sSeq = $_POST['sSeq'];
$sQty = $_POST['sQty'];

$dt = date("Ymd");

//CSV出力
header('Content-Type: application/octet-stream');
header('Content-Length: '.filesize("./files/ships_".getSsn('SEQ').".csv"));
header('Content-Disposition: attachment; filename=ships_'.$dt.'.csv');
readfile("./files/ships_".getSsn('SEQ').".csv");
exit(0);




 ?>
