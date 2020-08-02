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


$stmt = $pdo->prepare("SELECT * FROM `system` ");
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sys_mail_address = $row['mail_address'];
$sys_mail_name = $row['mail_name'];
$sys_site_title = $row['site_title'];


$stmt = $pdo->prepare("SELECT DISTINCT(`cuser`) AS 'cuser' FROM `v_offer_x10` WHERE `status`=0");
$stmt->execute();

$cusers = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    array_push($cusers, $row['cuser']);
}

mb_language("Japanese");
mb_internal_encoding("UTF-8");

foreach ($cusers as $cuser) {
    $stmt2 = $pdo->prepare("SELECT  `A`.`name` AS `aname`,`U`.`id` AS `uid`, `U`.`name`,`U`.`mail`,`X`.`instagram`,`X`.`facebook`,`X`.`twitter`,`X`.`youtube`  FROM `v_offer_x10` AS `O` LEFT JOIN `nuser` AS `U` ON `O`.`nuser`=`U`.`id`  LEFT JOIN `x10_nuser` AS `X` ON `O`.`nuser`=`X`.`id` LEFT JOIN `v_adwares_x10` AS `A` ON `O`.`adware`=`A`.`id`  WHERE `status`=10 AND `O`.`cuser`='".$cuser."' AND `O`.`cuser`<>'ADMIN'");
    $stmt2->execute();


    $text = "この度は、Smafeeのご利用ありがとうございます。\n";
    $text .= "投稿報酬型タイプの投稿確認依頼が1件以上残っているクライアント様にお送りしております。\n\n";

    $text .= "下記内容をご確認ください。\n\n";

    while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
        $text .= "■オファーリクエスト情報━━━━━━━━━━━━━━━━━━━━\n";
        $text .= "オファー名　　：".$row2['aname']."\n";
        $text .= "リクエスト者　：".$row2['uid'].$row2['name']."\n";

        $sns2 = empty($row2['instagram']) ? '' : "instagram:https://www.instagram.com/".$row2['instagram']."\n";
        $sns2 .= empty($row2['facebook']) ? '' : "facebook:https://www.facebook.com/".$row2['facebook']."\n";
        $sns2 .= empty($row2['twitter']) ? '' : "twitter:https://twitter.com/".$row2['twitter']."\n";
        $sns2 .= empty($row2['youtube']) ? '' : "youtube:https://www.youtube.com/channel/".$row2['youtube']."\n";
        $text .= empty($sns2) ? "SNSアカウントは設定されていません" : $sns2;
        $text .= "\n";
        $text .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    }

    $text .= "投稿確認の承認は\n";
    $text .= "下記のアドレスよりログインしてご確認ください。\n";
    $text .= "https://smafee.jp/a/\n";
    
    $text .= "その他ご不明な点・ご質問などございましたら、\n";
    $text .= "Smafee サポートデスクもしくは担当者までお問い合わせください。\n\n";
    
    $text .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    $text .= "お問い合わせ\n";
    $text .= "https://smafee.jp/contact/\n";
    
    $text .= "このメールは、送信専用メールアドレスから配信されています。\n";
    $text .= "ご返信いただいてもお答えできませんので、ご了承ください。\n\n";
    
    $text .= "■Smafee\n";
    $text .= "https://smafee.jp/\n";
    $text .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";

    $stmt3 = $pdo->prepare("SELECT * FROM `cuser` WHERE id=:cuser");
    $stmt3->bindParam(':cuser', $cuser, PDO::PARAM_STR);
    $stmt3->execute();
    $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
    $u_mail = $row3['mail'];

    $to      = $u_mail;
    $subject = "【".$sys_site_title."】投稿確認依頼をご確認下さい";
    $message = $text;
    $headers = 'From:"'.mb_encode_mimeheader($sys_mail_name).'" <'. trim($sys_mail_address).'>';
    mb_send_mail($to, $subject, $message, $headers);
}
