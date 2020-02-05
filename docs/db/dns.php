<?php
$pdo = new PDO('mysql:dbname=' . getSsnIni('dbname') . ';charset=utf8;host=' . getSsnIni('host') , getSsnIni('dbuser') , getSsnIni('dbpass') );
?>
