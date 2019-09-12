<?php
// 設定ファイルからDB接続情報を取得しPDOを生成する
$ini = $_SESSION['INI'];
$pdo = new PDO('mysql:dbname=' . $ini['dbname'] . ';charset=utf8;host=' . $ini['host'] , $ini['dbuser'] , $ini['dbpass'] );
?>
