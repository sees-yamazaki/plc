<?php
//$dsnS = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $ini['host'], $ini['dbname']);
//$pdo = new PDO($dsnS, $ini['dbuser'], $ini['dbpass'],array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
$pdo = new PDO('mysql:dbname=' . $ini['dbname'] . ';host=' . $ini['host'] , $ini['dbuser'] , $ini['dbpass'] );
?>
