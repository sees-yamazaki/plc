<?php

    session_start();

    // ログイン状態チェック
    if (!isset($_SESSION["NAME"])) {
        header("Location: Logout.php");
        exit;
    }

    $ini = parse_ini_file('../common.ini', FALSE);

    require_once 'date.php';

    if(isset($_GET['ty'])){
        $tgtTime = getTimestamp_LastDate($_GET['ty'],$_GET['tm']);
        $firstday =  getTimestamp($_GET['ty'],$_GET['tm']);
    }else{
        $tgtTime = getTimestamp_LastDate('','');
        $firstday =  getTimestamp('','');
    }


    $nextTime = getTimestamp_NextMonth($firstday);
    $nextY = date('Y',  $nextTime);
    $nextM = date('m',  $nextTime);
    $lastTime = getTimestamp_LastMonth($firstday);
    $lastY = date('Y',  $lastTime);
    $lastM = date('m',  $lastTime);


    if (!empty($_SESSION["LEVEL"])) {

        
        try {

            require_once 'dns.php';
            
            $eName = $_SESSION['eName'];
            $eSeq = $_SESSION['eSeq'];
            $tY = intval(date('Y',  $tgtTime));
            $tM = intval(date('m',  $tgtTime));
            //$wD = intval(date('d',  $tgtTime));
            $wk = intval(date("w",  $firstday));
            $week_name = array("日", "月", "火", "水", "木", "金", "土");
            
            $stmt = $pdo->prepare('SELECT * FROM schedule WHERE user_seq = ? and work_y = ? and work_m = ? ');
            $stmt->execute(array($eSeq,$tY,$tM));
            $rows = $stmt->fetchAll();
            
            $html="";
            $jSeq="";
            for($i = 1; $i <= idate('t',$tgtTime); ++$i) {
                $str="";
                foreach ($rows as $row) {
                    if($row['work_d']==$i){
                        $str =  "";

                        // 出発時間
                        if (empty($row['leave_time'])){
                            $str .= "<td>".date('H:i',  strtotime($row['plan_leave_time']))."</td>";
                        }else{
                            if ($row['leave_time'] > $row['plan_leave_time']) {
                                $str .= "<td class='late'><div class='fSmall'>".date('H:i',  strtotime($row['plan_leave_time']))."<br></div>".date('H:i',  strtotime($row['leave_time']))."</td>";
                            }else{
                                $str .= "<td class='safe'><div class='fSmall'>".date('H:i',  strtotime($row['plan_leave_time']))."<br></div>".date('H:i',  strtotime($row['leave_time']))."</td>";
                            }
                        }

                        // 出勤時間
                        if (empty($row['start_time'])){
                            $str .= "<td>".date('H:i',  strtotime($row['plan_start_time']))."</td>";
                        }else{
                            if ($row['start_time'] > $row['plan_start_time']) {
                                $str .= "<td class='late'><div class='fSmall'>".date('H:i',  strtotime($row['plan_start_time']))."<br></div>".date('H:i',  strtotime($row['start_time']))."</td>";
                            }else{
                                $str .= "<td class='safe'><div class='fSmall'>".date('H:i',  strtotime($row['plan_start_time']))."<br></div>".date('H:i',  strtotime($row['start_time']))."</td>";
                            }
                        }

                        // 退勤時間
                        if (empty($row['end_time'])){
                            $str .= "<td>".date('H:i',  strtotime($row['plan_end_time']))."</td>";
                        }else{
                            if ($row['end_time'] < $row['plan_end_time']) {
                                $str .= "<td class='late'><div class='fSmall'>".date('H:i',  strtotime($row['plan_end_time']))."<br></div>".date('H:i',  strtotime($row['end_time']))."</td>";
                            }else{
                                $str .= "<td class='safe'><div class='fSmall'>".date('H:i',  strtotime($row['plan_end_time']))."<br></div>".date('H:i',  strtotime($row['end_time']))."</td>";
                            }
                        }

                        $jSeq=$row['job_seq'];
                    }
                }
                if($str==""){
                    $str="<td>--:--</td><td>--:--</td><td>--:--</td>";
                }
                $x = ($wk + $i - 1) % 7;
                $html.="<tr><th>".$tM." / ".$i." (" . ($week_name[$x]) . ")"."</th>".$str."</tr>";
            }


            // 案件情報
            $stmt = $pdo->prepare('SELECT * FROM `job` order by job_seq');
            $stmt->execute(array());
            $rows = $stmt->fetchAll();

            $jName="案件未登録";
            foreach ($rows as $row) {
                if($row['job_seq']==$jSeq){
                    $group .= "<option value='".$row['job_seq']."' selected>".$row['job_id'].":".$row['name']."</option>";
                    $jName = $row['name'];
                }else{
                    $group .= "<option value='".$row['job_seq']."'>".$row['job_id'].":".$row['name']."</option>";
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/employeeEdit.js"></script>
</head>

<body>
    <?php $eSeq ?>
    <?php include('./menu.php'); ?>

    
    <div class="nav">
        <button type="button" onclick="location.href='employeeList.php'" class="back">戻る</button>
        <font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font>
    </div><br>

    <table class="cal" style="width:60%">
        <tr>
            <th style="text-align:left"><a href="employeeShift.php?ty=<?php echo $lastY; ?>&tm=<?php echo $lastM; ?>&eName=<?php echo $eName; ?>" class="btn-sticky">＜＜</a></th>
            <td class="titleYM" colspan=2><?php echo $tY; ?> / <?php echo $tM; ?></td>
            <th style="text-align:right"><a href="employeeShift.php?ty=<?php echo $nextY; ?>&tm=<?php echo $nextM; ?>&eName=<?php echo $eName; ?>" class="btn-sticky">＞＞</a></th>
        </tr>
        <tr>
            <td class="titleYM" colspan=2>[ <?php echo $eName; ?> ]</td>
            <td class="titleYM" colspan=2>[ <?php echo $jName; ?> ]</td>
        </tr>
    </table>
    <br>
    <table class="cal" style="width:60%">
        <tr>
            <th class="add">
                <form action="employeeShiftEdit.php" method="POST">
                    <button type='submit' name='edit'>編集</button>
                    <input type="hidden" name="ty" value="<?php echo $tY; ?>">
                    <input type="hidden" name="tm" value="<?php echo $tM; ?>">
                </form>
            </td>
            <th>出発</th>
            <th>出勤</th>
            <th>退勤</th>
        </tr>
        <?php echo $html; ?>
    </table>



</body>

</html>
