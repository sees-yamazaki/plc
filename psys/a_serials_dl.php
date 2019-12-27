<?php

// セッション開始
session_start();
require('session.php');

// ログイン状態チェック
if (getSsnIsLogin()==false) {
    header("Location: a_logoff.php");
    exit;
}

// エラーメッセージの初期化
$errorMessage = "";


 try {
    
     $sSeq = $_POST['sSeq'];
     $sQty = $_POST['sQty'];

     //CSV出力
     $fileNm = $sSeq.".csv";
     header('Content-Type: application/octet-stream');
     header('Content-Length: '.filesize("./".getSsn('PATH_SCODE')."/".$fileNm));
     header('Content-Disposition: attachment; filename=serialcode_'.$sQty.'.csv');
     readfile("./".getSsn('PATH_SCODE')."/".$fileNm);
     exit(0);
     
 } catch (PDOException $e) {
     $errorMessage = 'データベースエラー:'.$e->getMessage();
 }


 ?>
