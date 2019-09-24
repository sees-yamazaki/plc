<?php

session_start();


// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

require_once 'date.php';

    // ログイン状態チェック
    if (!isset($_SESSION["NAME"])) {
        header("Location: Logout.php");
        exit;
    }

    $alertTime = $_SESSION['alertTime'];

    //当月
    $thisY = date('Y');
    $thisM = date('m');

    //来月
    $firstday =  getTimestamp($thisY,$thisM);
    $nextTime = getTimestamp_NextMonth($firstday);
    $nextY = date('Y',  $nextTime);
    $nextM = date('m',  $nextTime);

    $ini = parse_ini_file('../common.ini', FALSE);


    if ($_SESSION["MODE"]=="TEMP") {
        

        try {
            
            require_once 'dns.php';
            $eSeq = $_SESSION['SEQ'];

            //当月のステータスを確認する
            $stmt = $pdo->prepare('SELECT * FROM auth_work WHERE employee_seq = ? and work_y = ? and work_m = ? ');
            $stmt->execute(array($eSeq,$nextY,$nextM));
            $statusTitle = "未提出";
            if($row = $stmt->fetch()){
                $status = $row['status'];
                if ($status=="1"){
                    $statusTitle = "承認依頼中";
                }elseif ($status=="2"){
                    $statusTitle = "承認済";
                }
            }

            
            if(isset($_POST['empShift'])){
                $pTime1 = $_POST['pTime1'];
                $sTime1 = $_POST['sTime1'];
                $eTime1 = $_POST['eTime1'];
                $sSeq1 = $_POST['sSeq1'];
                $pTime2 = $_POST['pTime2'];
                $sTime2 = $_POST['sTime2'];
                $eTime2 = $_POST['eTime2'];
                $sSeq2 = $_POST['sSeq2'];
                $pTime3 = $_POST['pTime3'];
                $sTime3 = $_POST['sTime3'];
                $eTime3 = $_POST['eTime3'];
                $sSeq3 = $_POST['sSeq3'];
                $pTime4 = $_POST['pTime4'];
                $sTime4 = $_POST['sTime4'];
                $eTime4 = $_POST['eTime4'];
                $sSeq4 = $_POST['sSeq4'];
                $pTime5 = $_POST['pTime5'];
                $sTime5 = $_POST['sTime5'];
                $eTime5 = $_POST['eTime5'];
                $sSeq5 = $_POST['sSeq5'];
                $pTime6 = $_POST['pTime6'];
                $sTime6 = $_POST['sTime6'];
                $eTime6 = $_POST['eTime6'];
                $sSeq6 = $_POST['sSeq6'];
                $pTime7 = $_POST['pTime7'];
                $sTime7 = $_POST['sTime7'];
                $eTime7 = $_POST['eTime7'];
                $sSeq7 = $_POST['sSeq7'];
                $pTime8 = $_POST['pTime8'];
                $sTime8 = $_POST['sTime8'];
                $eTime8 = $_POST['eTime8'];
                $sSeq8 = $_POST['sSeq8'];
                $pTime9 = $_POST['pTime9'];
                $sTime9 = $_POST['sTime9'];
                $eTime9 = $_POST['eTime9'];
                $sSeq9 = $_POST['sSeq9'];
                $pTime10 = $_POST['pTime10'];
                $sTime10 = $_POST['sTime10'];
                $eTime10 = $_POST['eTime10'];
                $sSeq10 = $_POST['sSeq10'];
                $pTime11 = $_POST['pTime11'];
                $sTime11 = $_POST['sTime11'];
                $eTime11 = $_POST['eTime11'];
                $sSeq11 = $_POST['sSeq11'];
                $pTime12 = $_POST['pTime12'];
                $sTime12 = $_POST['sTime12'];
                $eTime12 = $_POST['eTime12'];
                $sSeq12 = $_POST['sSeq12'];
                $pTime13 = $_POST['pTime13'];
                $sTime13 = $_POST['sTime13'];
                $eTime13 = $_POST['eTime13'];
                $sSeq13 = $_POST['sSeq13'];
                $pTime14 = $_POST['pTime14'];
                $sTime14 = $_POST['sTime14'];
                $eTime14 = $_POST['eTime14'];
                $sSeq14 = $_POST['sSeq14'];
                $pTime15 = $_POST['pTime15'];
                $sTime15 = $_POST['sTime15'];
                $eTime15 = $_POST['eTime15'];
                $sSeq15 = $_POST['sSeq15'];
                $pTime16 = $_POST['pTime16'];
                $sTime16 = $_POST['sTime16'];
                $eTime16 = $_POST['eTime16'];
                $sSeq16 = $_POST['sSeq16'];
                $pTime17 = $_POST['pTime17'];
                $sTime17 = $_POST['sTime17'];
                $eTime17 = $_POST['eTime17'];
                $sSeq17 = $_POST['sSeq17'];
                $pTime18 = $_POST['pTime18'];
                $sTime18 = $_POST['sTime18'];
                $eTime18 = $_POST['eTime18'];
                $sSeq18 = $_POST['sSeq18'];
                $pTime19 = $_POST['pTime19'];
                $sTime19 = $_POST['sTime19'];
                $eTime19 = $_POST['eTime19'];
                $sSeq19 = $_POST['sSeq19'];
                $pTime20 = $_POST['pTime20'];
                $sTime20 = $_POST['sTime20'];
                $eTime20 = $_POST['eTime20'];
                $sSeq20 = $_POST['sSeq20'];
                $pTime21 = $_POST['pTime21'];
                $sTime21 = $_POST['sTime21'];
                $eTime21 = $_POST['eTime21'];
                $sSeq21 = $_POST['sSeq21'];
                $pTime22 = $_POST['pTime22'];
                $sTime22 = $_POST['sTime22'];
                $eTime22 = $_POST['eTime22'];
                $sSeq22 = $_POST['sSeq22'];
                $pTime23 = $_POST['pTime23'];
                $sTime23 = $_POST['sTime23'];
                $eTime23 = $_POST['eTime23'];
                $sSeq23 = $_POST['sSeq23'];
                $pTime24 = $_POST['pTime24'];
                $sTime24 = $_POST['sTime24'];
                $eTime24 = $_POST['eTime24'];
                $sSeq24 = $_POST['sSeq24'];
                $pTime25 = $_POST['pTime25'];
                $sTime25 = $_POST['sTime25'];
                $eTime25 = $_POST['eTime25'];
                $sSeq25 = $_POST['sSeq25'];
                $pTime26 = $_POST['pTime26'];
                $sTime26 = $_POST['sTime26'];
                $eTime26 = $_POST['eTime26'];
                $sSeq26 = $_POST['sSeq26'];
                $pTime27 = $_POST['pTime27'];
                $sTime27 = $_POST['sTime27'];
                $eTime27 = $_POST['eTime27'];
                $sSeq27 = $_POST['sSeq27'];
                $pTime28 = $_POST['pTime28'];
                $sTime28 = $_POST['sTime28'];
                $eTime28 = $_POST['eTime28'];
                $sSeq28 = $_POST['sSeq28'];
                $pTime29 = $_POST['pTime29'];
                $sTime29 = $_POST['sTime29'];
                $eTime29 = $_POST['eTime29'];
                $sSeq29 = $_POST['sSeq29'];
                $pTime30 = $_POST['pTime30'];
                $sTime30 = $_POST['sTime30'];
                $eTime30 = $_POST['eTime30'];
                $sSeq30 = $_POST['sSeq30'];
                $pTime31 = $_POST['pTime31'];
                $sTime31 = $_POST['sTime31'];
                $eTime31 = $_POST['eTime31'];
                $sSeq31 = $_POST['sSeq31'];
                
                $times=array(
                    array(1,$pTime1,$sTime1,$eTime1,$sSeq1),
                    array(2,$pTime2,$sTime2,$eTime2,$sSeq2),
                    array(3,$pTime3,$sTime3,$eTime3,$sSeq3),
                    array(4,$pTime4,$sTime4,$eTime4,$sSeq4),
                    array(5,$pTime5,$sTime5,$eTime5,$sSeq5),
                    array(6,$pTime6,$sTime6,$eTime6,$sSeq6),
                    array(7,$pTime7,$sTime7,$eTime7,$sSeq7),
                    array(8,$pTime8,$sTime8,$eTime8,$sSeq8),
                    array(9,$pTime9,$sTime9,$eTime9,$sSeq9),
                    array(10,$pTime10,$sTime10,$eTime10,$sSeq10),
                    array(11,$pTime11,$sTime11,$eTime11,$sSeq11),
                    array(12,$pTime12,$sTime12,$eTime12,$sSeq12),
                    array(13,$pTime13,$sTime13,$eTime13,$sSeq13),
                    array(14,$pTime14,$sTime14,$eTime14,$sSeq14),
                    array(15,$pTime15,$sTime15,$eTime15,$sSeq15),
                    array(16,$pTime16,$sTime16,$eTime16,$sSeq16),
                    array(17,$pTime17,$sTime17,$eTime17,$sSeq17),
                    array(18,$pTime18,$sTime18,$eTime18,$sSeq18),
                    array(19,$pTime19,$sTime19,$eTime19,$sSeq19),
                    array(20,$pTime20,$sTime20,$eTime20,$sSeq20),
                    array(21,$pTime21,$sTime21,$eTime21,$sSeq21),
                    array(22,$pTime22,$sTime22,$eTime22,$sSeq22),
                    array(23,$pTime23,$sTime23,$eTime23,$sSeq23),
                    array(24,$pTime24,$sTime24,$eTime24,$sSeq24),
                    array(25,$pTime25,$sTime25,$eTime25,$sSeq25),
                    array(26,$pTime26,$sTime26,$eTime26,$sSeq26),
                    array(27,$pTime27,$sTime27,$eTime27,$sSeq27),
                    array(28,$pTime28,$sTime28,$eTime28,$sSeq28),
                    array(29,$pTime29,$sTime29,$eTime29,$sSeq29),
                    array(30,$pTime30,$sTime30,$eTime30,$sSeq30),
                    array(31,$pTime31,$sTime31,$eTime31,$sSeq31)
                );

                if($status=="2"){
                    //承認済みだと処理を中止
                    $errorMessage = '来月のシフトは承認済みです。';
                }else{
                    

                    // 現在の登録を削除する
                    // 来月シフトなので実績は無いため一括削除
                    $sql = "DELETE FROM `schedule` WHERE user_seq = ? and work_y = ? and work_m = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(array($eSeq,$nextY,$nextM));


                    
                    foreach($times as $aTime){
                        //出勤・退勤の両方が登録されている場合に処理を実行
                        if(!empty($aTime[2]) && !empty($aTime[3])){
                            //出発時間が無いものは計算する
                            if(empty($aTime[1])){
                                //予定開始時間
                                $plan_start_time = date("Y-m-d H:i:s",getTimestamp_ymdhi($nextY,$nextM,$aTime[0],substr($aTime[2],0,2),substr($aTime[2],-2)));
                                //アラート時間を引いた、出発時間（YMD）
                                $leave_time = date("Y-m-d H:i:s",strtotime($plan_start_time . "-" .$alertTime." minute"));
                                //アラート時間を引いた、出発時間（HMS）
                                $aTime[1] = date("H:i",strtotime($plan_start_time . "-" .$alertTime." minute"));
                            }
                            
                            //予定終了時間
                            $plan_end_time = date("Y-m-d H:i:s",getTimestamp_ymdhi($nextY,$nextM,$aTime[0],substr($aTime[3],0,2),substr($aTime[3],-2)));
                            //Insertする
                            $sql = "INSERT INTO `schedule`(`user_seq`, `work_y`, `work_m`, `work_d`, `plan_leave_time`, `plan_start_time`, `plan_end_time`,`job_seq`,`client_seq`) VALUES (?,?,?,?,?,?,?,0,0)";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute(array($eSeq,$nextY,$nextM,$aTime[0],$leave_time,$plan_start_time,$plan_end_time));

                        }
                        
                    }
                    //申請用レコードを更新
                    $stmt = $pdo->prepare('DELETE FROM auth_work WHERE employee_seq = ? and work_y = ? and work_m = ? ');
                    $stmt->execute(array($eSeq,$nextY,$nextM));
                    $sql = "INSERT INTO `auth_work`(`employee_seq`, `work_y`, `work_m`, `status`, `approver_seq`) VALUES (?,?,?,?,?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(array($eSeq,$nextY,$nextM,1,0));

                    header('Location: staffRec.php', true);

                }
                
            }






            $wk = intval(date("w",  $nextTime));
            $week_name = array("日", "月", "火", "水", "木", "金", "土");
            


            $stmt = $pdo->prepare('SELECT * FROM schedule WHERE user_seq = ? and work_y = ? and work_m = ? ');
            $stmt->execute(array($eSeq,$nextY,$nextM));
            $rows = $stmt->fetchAll();
            
            $html="";
            for($i = 1; $i <= idate('t',$nextTime); ++$i) {
                $str="";
                foreach ($rows as $row) {
                    if($row['work_d']==$i){
                        if($status=="2"){
                            //承認済み
                            $str = "<td class='plan'>".date('H:i',  strtotime($row['plan_start_time']))."</td><td>".date('H:i',  strtotime($row['plan_end_time']))."</td>";
                        }else{
                            //未承認
                            $str = "<td><input type='hidden' name='sSeq".$i."' value='".$row['sche_seq']."'><input type='hidden' name='pTime".$i."'><input type='time' class='time' name='sTime".$i."' value='".date('H:i',  strtotime($row['plan_start_time']))."'></td><td><input type='time' class='time' name='eTime".$i."' value='".date('H:i',  strtotime($row['plan_end_time']))."'></td>";
                        }

                    }
                }
                if($str==""){
                    if($status=="2"){
                            //承認済み
                            $str = "<td class='plan'>--:--</td><td>--:--</td>";
                    }else{
                        //申請無し
                        $str = "<td><input type='hidden' name='sSeq".$i."' value='".$row['sche_seq']."'><input type='hidden' name='pTime".$i."'><input type='time' class='time' name='sTime".$i."'></td><td><input type='time' class='time' name='eTime".$i."'></td>";
                    }
                }
                $x = ($wk + $i - 1) % 7;
                $html.="<tr><th>".$nextM." / ".$i." (" . ($week_name[$x]) . ")</th>".$str."</tr>";
            }
            
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
            if(strcmp("1",$ini['debug'])==0){
                echo $e->getMessage();
            }
        }
    }

?>
<!DOCTYPE html>
<html>

<head class="wf-sawarabigothic">
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/staff.css">
    <link rel="stylesheet" type="text/css" href="../css/hiraku.css">
    <script src="http://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="../js/hiraku.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic" rel="stylesheet">
</head>

<body>
    <div class="wrapper">

        <?php include('./staffMenu.php'); ?>        

    <div class='headbutton'><a href='staff.php'><img src='../img/home.png'></a></div>

        <form action="staffRec.php" method="post">
        <table class="cal fnt2em">
        <tr><td colspan=4 class="err"><?php echo $errorMessage; ?></td></tr>
            <tr>
                <td class="titleYM  fnt1p5em" colspan=3><?php echo $nextY; ?> / <?php echo $nextM; ?>　:
                 <?php echo $statusTitle; ?></td>
            </tr>
            <?php echo $html; ?>
            <?php if($status<>"2"){ ?>
            <tr><td colspan="4"><button type=submit name="empShift" class="btn-sticky">登録</button></td></tr>
            <?php } ?>
        </table>
        </form>

        <?php include('./footer.php'); ?>
    </div>
</body>

</html>
