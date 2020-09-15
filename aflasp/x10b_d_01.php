<?php
$sv=$_SERVER['SCRIPT_FILENAME'];
if (strpos($sv, 'smafee.jp') !== false) {
    $rt = '/home/inforeal/smafee.jp/public_html/aff/a/';
    $SQL_SERVER = '202.254.238.42';
    $DB_NAME = 'inforeal_smafee';
    $SQL_ID = 'inforeal_aff';
    $SQL_PASS = 'P6azL4D9';
} elseif (strpos($sv, '510ti.com') !== false) {
    $rt = '/home/inforeal/510ti.com/public_html/aff/a/';
    $SQL_SERVER = '202.254.238.42';
    $DB_NAME = 'inforeal_aff';
    $SQL_ID = 'inforeal_aff';
    $SQL_PASS = 'P6azL4D9';
} else {
    $rt = '/Applications/MAMP/htdocs/aflasp/';
    $SQL_SERVER = '127.0.0.1';
    $DB_NAME = 'asp';
    $SQL_ID = 'plcAdmin';
    $SQL_PASS = 'plc2012';
}

$pdo = new PDO('mysql:dbname='.$DB_NAME.';charset=utf8;host='.$SQL_SERVER, $SQL_ID, $SQL_PASS);


$pDay =  strtotime("-30 day");
$sql = "SELECT `pay`.*, `ad`.`name` FROM `pay` LEFT JOIN `v_adwares_status` as `ad` ON `pay`.`adwares`=`ad`.`id` WHERE `pay`.`state`=0 AND `pay`.`regist`<".$pDay." AND `ad`.`adware_type`=2";

$stmt = $pdo->prepare($sql);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $adware = $row['adwares'];
    $nuser=$row['owner'];
    $cost=$row['cost'];

    $now = strtotime("NOW");
    $sql = "UPDATE `x10_offer` SET `status`=13 ,edittime=:edittime WHERE `adware`=:adware AND `nuser`=:nuser ";
    $stmt2 = $pdo -> prepare($sql);
    $stmt2->bindParam(':adware', $adware, PDO::PARAM_STR);
    $stmt2->bindParam(':nuser', $nuser, PDO::PARAM_STR);
    $stmt2->bindParam(':edittime', $now, PDO::PARAM_INT);
    $stmt2->execute();


    $sql = "UPDATE `nuser` SET `pay`= `pay`+:cost WHERE  id=:id";
    $stmt3 = $pdo -> prepare($sql);
    $stmt3->bindParam(':id', $nuser, PDO::PARAM_STR);
    $stmt3->bindParam(':cost', $cost, PDO::PARAM_INT);
    $stmt3->execute();


    $sql = "UPDATE `pay` SET `state`=2 , `is_notice`=1 WHERE owner=:owner AND  adwares=:adwares";
    $stmt4 = $pdo -> prepare($sql);
    $stmt4->bindParam(':adwares', $adwares, PDO::PARAM_STR);
    $stmt4->bindParam(':owner', $nuser, PDO::PARAM_STR);
    $stmt4->execute();


    if (substr($adwares, 0, 1)=="A") {
        $sql = "UPDATE `adwares` SET `money_count`= COALESCE(`money_count`,0)+:cost, `pay_count`=COALESCE(`pay_count`,0)+1 WHERE  id=:id";
    } else {
        $sql = "UPDATE `secretadwares` SET `money_count`= COALESCE(`money_count`,0)+:cost, `pay_count`=COALESCE(`pay_count`,0)+1 WHERE  id=:id";
    }
    $stmt5 = $pdo -> prepare($sql);
    $stmt5->bindParam(':id', $adwares, PDO::PARAM_STR);
    $stmt5->bindParam(':cost', $cost, PDO::PARAM_INT);
    $stmt5->execute();
}
