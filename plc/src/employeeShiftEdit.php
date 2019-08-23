<?php

    session_start();

    // ログイン状態チェック
    if (!isset($_SESSION["NAME"])) {
        header("Location: Logout.php");
        exit;
    }

    $ini = parse_ini_file('../common.ini', FALSE);

    require_once 'date.php';
    $ty = $_POST['ty'];
    $tm = $_POST['tm'];
    $title = $ty." / ".$tm;
    $alertTime = $_SESSION['alertTime'];
    $eSeq = $_SESSION['eSeq'];
    $eName = $_SESSION['eName'];

    $tgtTime = getTimestamp_LastDate($ty,$tm);


    if (!empty($_SESSION["LEVEL"])) {
        
        
        
        

        
        try {

            require_once 'dns.php';
            
            
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
                $job_seq = $_POST['job_seq'];
                
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
                
                //job_seq から client_seq を取得
                $stmt = $pdo->prepare('SELECT * FROM job where job_seq =  ? ');
                $stmt->execute(array($job_seq));
                if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $cSeq = $row['client_seq'];
                }

                foreach($times as $aTime){
                    //出勤・退勤の両方が登録されている場合に処理を実行
                    if(!empty($aTime[2]) && !empty($aTime[3])){

                        //出発時間が無いものは計算する
                        if(empty($aTime[1])){
                            //予定開始時間
                            $plan_start_time = date("Y-m-d H:i:s",getTimestamp_ymdhi($ty,$tm,$aTime[0],substr($aTime[2],0,2),substr($aTime[2],-2)));
                            //アラート時間を引いた、出発時間（YMD）
                            $leave_time = date("Y-m-d H:i:s",strtotime($plan_start_time . "-" .$alertTime." minute"));
                            //アラート時間を引いた、出発時間（HMS）
                            $aTime[1] = date("H:i",strtotime($plan_start_time . "-" .$alertTime." minute"));
                        }
                        
                        //予定終了時間
                        $plan_end_time = date("Y-m-d H:i:s",getTimestamp_ymdhi($ty,$tm,$aTime[0],substr($aTime[3],0,2),substr($aTime[3],-2)));
                        
                        //sche_seqの有無でInsert/Updateを分岐する
                        if(!empty($aTime[4])){
                           $sql = "UPDATE `schedule` SET `plan_leave_time`=?, `plan_start_time`=?, `plan_end_time`=?,`job_seq`=?,`client_seq`=? WHERE  `sche_seq`=?";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute(array($leave_time,$plan_start_time,$plan_end_time,$job_seq,$cSeq,$aTime[4]));
                        }else{
                            $sql = "INSERT INTO `schedule`(`user_seq`, `work_y`, `work_m`, `work_d`, `plan_leave_time`, `plan_start_time`, `plan_end_time`,`job_seq`,`client_seq`) VALUES (?,?,?,?,?,?,?,?,?)";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute(array($eSeq,$ty,$tm,$aTime[0],$leave_time,$plan_start_time,$plan_end_time,$job_seq,$cSeq));
                        }
                    }else if(!empty($aTime[4]) && empty($aTime[2]) && empty($aTime[3])){
                        $sql = "DELETE FROM `schedule` WHERE `sche_seq`=? and `leave_time` is null";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(array($aTime[4]));
                    }
                    
                }


                //申請レコードを削除する
                $stmt = $pdo->prepare('DELETE FROM auth_work WHERE employee_seq = ? and work_y = ? and work_m = ? ');
                $stmt->execute(array($eSeq,$ty,$tm));

                //更新後のレコード数を取得する
                $stmt = $pdo->prepare('SELECT * FROM schedule WHERE user_seq = ? and work_y = ? and work_m = ? ');
                $stmt->execute(array($eSeq,$ty,$tm));
                if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    //取得できた場合のみ申請用レコードを追加する
                    $sql = "INSERT INTO `auth_work`(`employee_seq`, `work_y`, `work_m`, `status`, `approver_seq`) VALUES (?,?,?,?,?)";
                    $stmt2 = $pdo->prepare($sql);
                    $stmt2->execute(array($eSeq,$ty,$tm,2,$_SESSION['SEQ']));
                }

                

                header('Location: employeeShift.php?ty='.$ty.'&tm='.$tm, true, 307);

            }

            //$wD = intval(date('d',  $tgtTime));
            $wk = intval(date("w",  $firstday));
            $week_name = array("日", "月", "火", "水", "木", "金", "土");
            
            $stmt = $pdo->prepare('SELECT * FROM schedule WHERE user_seq = ? and work_y = ? and work_m = ? ');
            $stmt->execute(array($eSeq,$ty,$tm));
            $rows = $stmt->fetchAll();
            
            $html="";
            for($i = 1; $i <= idate('t',$tgtTime); ++$i) {
                $str="";
                foreach ($rows as $row) {
                    if($row['work_d']==$i){
                        $str="<td><input type='hidden' name='sSeq".$i."' value='".$row['sche_seq']."'>".date('H:i',  strtotime($row['plan_leave_time']))."</td><td><input type='time' name='sTime".$i."' value='".date('H:i',  strtotime($row['plan_start_time']))."'></td><td><input type='time' name='eTime".$i."' value='".date('H:i',  strtotime($row['plan_end_time']))."'></td>";
                    }
                    $jSeq=$row['job_seq'];
                }
                if($str==""){
                    $str="<td>--:--<input type='hidden' name='pTime".$i."' value=''><input type='hidden' name='sSeq".$i."' value=''></td><td><input type='time' id='sTime".$i."' name='sTime".$i."'></td><td><input type='time' id='eTime".$i."' name='eTime".$i."'></td>";
                }
                $x = ($wk + $i - 1) % 7;
                $html.="<tr><th>".$tm." / ".$i." (" . ($week_name[$x]) . ")"."</th>".$str."</tr>";
            }
            
            
            // 案件情報
            $stmt = $pdo->prepare('SELECT * FROM `job` order by job_seq');
            $stmt->execute(array());
            $rows = $stmt->fetchAll();

            $jName;
            foreach ($rows as $row) {
                if($row['job_seq']==$jSeq){
                    $job .= "<option value='".$row['job_seq']."' selected>".$row['job_id'].":".$row['name']."</option>";
                    $jName = $row['job_id'].":".$row['name'];
                }else{
                    $job .= "<option value='".$row['job_seq']."'>".$row['job_id'].":".$row['name']."</option>";
                }
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
<html lang=”ja”>

<head>
    <meta charset="utf-8">
    <meta http-equiv="content-language" content="ja">
    <meta name="google" content="notranslate" />
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="../css/employeeEdit.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/employeeEdit.js"></script>
</head>

<body>
<script>
        function seTime() {
            var element = document.getElementById("startTime");
            var t = element.value;
            if (t) {
                for( var i = 1; i < 32; i++ ) {
                    element = document.getElementById('sTime' + i);
                    if (element) {
                        element.value = t;
                    }
                }
            }
            element = document.getElementById("endTime");
            t = element.value;
            if (t) {
                for( var i = 1; i < 32; i++ ) {
                    element = document.getElementById('eTime' + i);
                    if (element) {
                        element.value = t;
                    }
                }
            }
        }

    </script>
<?php $eSeq ?>
    <?php include('./menu.php'); ?>

    <div class="nav">
        <button type="button" onclick="location.href='employeeShift.php'" class="back">戻る</button>
        <font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font>
    </div><br>

    <table class="cal" style="width:60%">
        <tr>
            <td class="titleYM" ><?php echo $title; ?></td>
            <td class="titleYM" ><?php echo $eName; ?></td>
        </tr>
    </table>
    <br>
    
    <form action="" method="post">

    <table class="cal" style="width:400px">
        <tr>
            <th>案件</th>
            <td width=500>
                <div class="cp_ipselect cp_sl04">
                <select id="job_seq" name="job_seq" required width="100%">
                    <option value="">選択してください</option>
                    <?php echo $job; ?>
                </select>
                </div>
            </td>
        </tr>
    </table>
    <br>
    
    <table class="cal" style="width:50%">
        <tr>
            <th>簡単設定 (出勤 - 退勤)</th>
        </tr>
        <tr>
            <td width=500><input type="time" id="startTime"> - <input type="time" id="endTime">　
            <input type="button" value="←←　を空き日に適用　" onclick="seTime();"></td>
        </tr>
    </table>
    <br>

    <table class="cal" style="width:50%">
        <tr>
            <td></td>
            <th>出発</th>
            <th>出勤</th>
            <th>退勤</th>
        </tr>
        <?php echo $html; ?>
        <tr><td colspan="4"><button type=submit name="empShift" class="cal">登録</button></td></tr>
        <input type="hidden" name="ty" value="<?php echo $ty; ?>">
        <input type="hidden" name="tm" value="<?php echo $tm; ?>">
    </table>
    </form>



</body>

</html>
