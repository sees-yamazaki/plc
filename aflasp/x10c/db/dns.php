<?php
require('../custom/extends/sqlConf.php');
$pdo = new PDO('mysql:dbname='.$DB_NAME.';charset=utf8;host='.$SQL_SERVER, $SQL_ID, $SQL_PASS);
?>