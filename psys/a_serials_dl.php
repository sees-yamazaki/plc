<?php

// セッション開始
session_start();
$ini = $_SESSION['INI'];

// ログイン状態チェック
if (!isset($_SESSION["SEQ"])) {
    header("Location: a_logoff.php");
    exit;
}

// エラーメッセージの初期化
$errorMessage = "";


 try {
    
     $sSeq = $_POST['sSeq'];

     //CSV出力
     $fileNm = $sSeq.".csv";
     header('Content-Type: application/octet-stream');
     header('Content-Length: '.filesize("./output/".$fileNm));
     header('Content-Disposition: attachment; filename=codes.csv');
     readfile("./output/".$fileNm);
     exit(0);
     
 } catch (PDOException $e) {
     $errorMessage = 'データベースエラー:'.$e->getMessage();
 }


 ?>
