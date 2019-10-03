<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: Logout.php");
    exit;
}


$ini = parse_ini_file('../common.ini', FALSE);

    if (!empty($_SESSION["LEVEL"])) {

        try {

            require_once 'dns.php';
            require_once 'date.php';
            
            if(isset($_GET['ty'])){
                $ty = $_GET['ty'];
                $tm = $_GET['tm'];
                $td = $_GET['td'];
            }else{
                $ty = date("Y");
                $tm = date("n");
                $td = date("d");
            }

            $thisTime = date("Y-m-d H:i:59");

            $targetTime =  getTimestamp_ymd($ty,$tm,$td);
            $yesterday  = strtotime('-1 day', $targetTime);
            $nextday  = strtotime('1 day', $targetTime);


            $stmt = $pdo->prepare('SELECT emp.employee_id,emp.name, sch.* FROM `schedule` as sch inner join `employee` as emp on sch.`user_seq` = emp.`employee_seq`  INNER JOIN `officer` ON `officer`.`officer_seq`=emp.`employee_seq` AND  `officer`.`employee_seq`=? WHERE sch.work_y=? and sch.work_m=? and sch.work_d=? ');
            $stmt->execute(array($_SESSION['SEQ'],$ty,$tm,$td));

            $html="";
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                

                $str =  "<tr>";
                $str .= "<td>".$row['name']."</td>";

                // 出発時間
                if (empty($row['leave_time'])){
                    if ($row['plan_leave_time'] < $thisTime) {
                        $str .= "<td class='late'>".date('H:i',  strtotime($row['plan_leave_time']))."</td>";
                    }else{
                        $str .= "<td>".date('H:i',  strtotime($row['plan_leave_time']))."</td>";
                    }
                }else{
                    if ($row['leave_time'] > $row['plan_leave_time']) {
                        $str .= "<td class='late'>".date('H:i',  strtotime($row['leave_time']))."<span class='fSmall'> (".date('H:i',  strtotime($row['plan_leave_time'])).")</span></td>";
                    }else{
                        $str .= "<td class='safe'>".date('H:i',  strtotime($row['leave_time']))."<span class='fSmall'> (".date('H:i',  strtotime($row['plan_leave_time'])).")</span></td>";
                    }
                }

                // 出勤時間
                if (empty($row['start_time'])){
                    if ($row['plan_start_time'] < $thisTime) {
                        $str .= "<td class='late'>".date('H:i',  strtotime($row['plan_start_time']))."</td>";
                    }else{
                        $str .= "<td>".date('H:i',  strtotime($row['plan_start_time']))."</td>";
                    }
                }else{
                    if ($row['start_time'] > $row['plan_start_time']) {
                        $str .= "<td class='late'>".date('H:i',  strtotime($row['start_time']))."<span class='fSmall'> (".date('H:i',  strtotime($row['plan_start_time'])).")</span></td>";
                    }else{
                        $str .= "<td class='safe'>".date('H:i',  strtotime($row['start_time']))."<span class='fSmall'> (".date('H:i',  strtotime($row['plan_start_time'])).")</span></td>";
                    }
                }

                // 退勤時間
                if (empty($row['end_time'])){
                    if ($row['plan_end_time'] < $thisTime) {
                        $str .= "<td class='late'>".date('H:i',  strtotime($row['plan_end_time']))."</td>";
                    }else{
                        $str .= "<td>".date('H:i',  strtotime($row['plan_end_time']))."</td>";
                    }
                }else{
                    if ($row['end_time'] < $row['plan_end_time']) {
                        $str .= "<td class='late'>".date('H:i',  strtotime($row['end_time']))."<span class='fSmall'> (".date('H:i',  strtotime($row['plan_end_time'])).")</span></td>";
                    }else{
                        $str .= "<td class='safe'>".date('H:i',  strtotime($row['end_time']))."<span class='fSmall'> (".date('H:i',  strtotime($row['plan_end_time'])).")</span></td>";
                    }
                }

                $str .= "</tr>";
                
                $html.=$str;
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

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/table.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../js/main.js"></script>
</head>

<body>
    <?php include('./menu.php'); ?>

    <div class="nav">
        <button type="button" onclick="location.href='home.php'" class="back">戻る</button>
        <font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font>
    </div><br>

    <table class="cal" style="width:60%">
        <tr>
            <th style="text-align:left"><a href="employeeWork.php?ty=<?php echo date('Y',$yesterday); ?>&tm=<?php echo date('n',$yesterday); ?>&td=<?php echo date('d',$yesterday); ?>" class="btn-sticky">＜＜</a></th>
            <td class="titleYM"><?php echo $ty; ?> / <?php echo $tm; ?> / <?php echo $td; ?></td>
            <th style="text-align:right"><a href="employeeWork.php?ty=<?php echo date('Y',$nextday); ?>&tm=<?php echo date('n',$nextday); ?>&td=<?php echo date('d',$nextday); ?>" class="btn-sticky">＞＞</a></th>
        </tr>
    </table>
<br>
    <table class="cal" width="80%"><tr><th>名前</th><th>出発</th><th>出勤</th><th>退勤</th></tr><?php echo $html; ?></table>


</body>

</html>
