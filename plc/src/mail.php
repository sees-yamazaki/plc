<?php

$dr = dirname(__FILE__);
$dir2 = strrpos($dr,"/");
$dir3 = substr($dr,0,$dir2);

$ini = parse_ini_file($dir3.'/common.ini', FALSE);

try {

        $pdo = new PDO('mysql:dbname=' . $ini['dbname'] . ';charset=utf8;host=' . $ini['host'] , $ini['dbuser'] , $ini['dbpass'] );
        $stmt = $pdo->prepare('SELECT * FROM alerting');
        $stmt->execute(array());

        $str = "";
        $checkTime;
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $checkTime = $row['f_now'];
            $str .= $row['name']."　：　".$row['f_plt']."　：　".$row['f_pst']."\n";

            //alert回数をインクリメント
            $cnt = intval($row["alert_count"]);
            $cnt++; 
            $stmt2 = $pdo->prepare('UPDATE `schedule` SET alert_count=?, alert_time=NOW() WHERE sche_seq = ?');
            $stmt2->execute(array($cnt,$row['sche_seq']));
    
        }

        $stmt = $pdo->prepare('SELECT * FROM alertmail');
        $stmt->execute(array());
        if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $mails = $row['mails'];
        }

        $stmt = $pdo->prepare('SELECT * FROM `system_info`');
        $stmt->execute(array());
        $isRead = "";
        if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $from_mail = $row['from_mail'];
            $mail_title = $row['mail_title'];
            $mail_body1 = $row['mail_body1'];
            $mail_body2 = $row['mail_body2'];
            $isRead = "OK";
        }

        if(!empty($str) && !empty($mails) && !empty($isRead)){

            mb_language("Japanese");
            mb_internal_encoding("UTF-8");
            
            $to      = $mails;
            $subject = $mail_title;
            $message = $mail_body1;
            $message .= "\n\n名前　：　出発予定時間　：　出勤予定時間\n" . $str. "\n\n";
            $message .= $mail_body2;
            $headers = "From: ".$from_mail;
            
            mb_send_mail($to, $subject, $message, $headers);
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        echo $e->getMessage();
    }





?>