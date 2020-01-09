<?php
session_start();

date_default_timezone_set('Asia/Tokyo');

// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: Logout.php");
    exit;
}


$ini = parse_ini_file('../common.ini', FALSE);


try {

    $emp = $_POST['emp'];

    //期間
    $term = $_POST['term'];
    if($term=="1"){
        //今月の処理
        //月初日
        $sDate = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
        //昨日
        $eDate = date('Y-m-d', strtotime('-1 day'));
    }elseif($term=="2"){
        //先月の処理
        //先月初日
        $sDate = date('Y-m-d', strtotime(date('Y-m-01') . '-1 month'));
        //先月末日
        $eDate = date('Y-m-t', strtotime(date('Y-m-01') . '-1 month'));
    }elseif($term=="3"){
        //先々月の処理
        //先々月初日
        $sDate = date('Y-m-d', strtotime(date('Y-m-01') . '-2 month'));
        //先々月末日
        $eDate = date('Y-m-t', strtotime(date('Y-m-01') . '-2 month'));
    }elseif($term=="4"){
        //任意の処理
        $startDate = $_POST['startDate'];
        $sDate = $startDate;
        $endDate = $_POST['endDate'];
        $eDate = $endDate;
    }

    $s = new DateTime($sDate);
    $e = new DateTime($eDate);
    $diff = $s->diff($e);
    $days = $diff->days;
    $days++;



    require_once 'dns.php';
    $sql = "";

    if ($emp=="1") {
        $sql = "SELECT officer_employee_seq as `user_seq`,`officer_employee_id` as `employee_id`,`officer_name` as `name`,COUNT(`user_seq`) as `works`,SUM(`worked`) as `worked`,SUM(`noleave`) as `noleave`,SUM(`nogoing`) as `nogoing`,SUM(`delayed`) as `delayed`,SUM(`lated`) as `lated`,SUM(`leftearly`) as `leftearly`,SUM(`covered`) as `covered`,COUNT(`alert_time`) as `alert_count`,SUM(`alert_count`) as `alert_sum` FROM v_schedule where  plan_leave_time BETWEEN ? AND ? GROUP BY officer_employee_seq";
    }else{
        $sql = "SELECT user_seq,`employee_id`,`name`,COUNT(`user_seq`) as `works`,SUM(`worked`) as `worked`,SUM(`noleave`) as `noleave`,SUM(`nogoing`) as `nogoing`,SUM(`delayed`) as `delayed`,SUM(`lated`) as `lated`,SUM(`leftearly`) as `leftearly`,SUM(`covered`) as `covered`,COUNT(`alert_time`) as `alert_count`,SUM(`alert_count`) as `alert_sum` FROM (select DISTINCT `sche_seq`, `user_seq`, `work_y`, `work_m`, `work_d`, `plan_leave_time`, `plan_start_time`, `plan_end_time`, `leave_time`, `start_time`, `end_time`, `job_seq`, `client_seq`, `alert_count`, `alert_time`, `cover_user_seq`, `cover_time`, `name`, `employee_id`, `worked`, `noleave`, `nogoing`, `delayed`, `lated`, `leftearly`, `covered` from `v_schedule`) x where  plan_leave_time BETWEEN ? AND ? GROUP BY user_seq";
    }
    
    // $stmt = $pdo->prepare('SELECT user_seq,`employee_id`,`name`,COUNT(`user_seq`) as `worked`,SUM(`noleave`) as `noleave`,SUM(`nogoing`) as `nogoing`,SUM(`delayed`) as `delayed`,SUM(`lated`) as `lated`,SUM(`leftearly`) as `leftearly`,SUM(`covered`) as `covered`,COUNT(`alert_time`) as `alert_count`,SUM(`alert_count`) as `alert_sum` FROM v_schedule where  plan_leave_time BETWEEN ? AND ? GROUP BY user_seq');
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($sDate." 00:00:00",$eDate." 23:59:59"));

    $html="";
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
        $html .= '<tr><form id="useredit" action="employeeAnalysisDetail.php" method="POST">';
        $html .= "<input type='hidden' name='sDate' value='".$sDate."'>";
        $html .= "<input type='hidden' name='eDate' value='".$eDate."'>";
        $html .= "<input type='hidden' name='term' value='".$term."'>";
        $html .= "<input type='hidden' name='emp' value='".$emp."'>";
        if (isset($row['employee_id'])) {
            $html .= "<input type='hidden' name='user_seq' value='".$row["user_seq"]."'>";
            $html .= "<td>".$row['employee_id']."</td>";
            $html .= "<td>".$row['name']."</td>";
        }else{
            $html .= "<input type='hidden' name='user_seq' value='0'>";
            $html .= "<td>--</td>";
            $html .= "<td>--</td>";
        }
        $html .= "<td>".$row['works']."</td>";
        $html .= "<td>".$row['worked']."</td>";
        $html .= "<td>".$row['noleave']."</td>";
        $html .= "<td>".$row['nogoing']."</td>";
        $html .= "<td>".$row['delayed']."</td>";
        $html .= "<td>".$row['lated']."</td>";
        $html .= "<td>".$row['leftearly']."</td>";
        $html .= "<td>".$row['covered']."</td>";
        $html .= "<td>".$row['alert_count']."</td>";
        $html .= "<td><input type='submit' value='詳細'></td>";
        $html .= "</form></tr>";
        
            
    }
} catch (PDOException $e) {
    $errorMessage = 'データベースエラー';
    //$errorMessage = $sql;
    if(strcmp("1",$ini['debug'])==0){
        echo $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="../css/employeeEdit.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../js/main.js"></script>
</head>

<body>
    <?php include('./menu.php'); ?>

    <div class="nav">
        <button type="button" onclick="location.href='home.php'" class="back">戻る</button>
        <font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font>
    </div><br>

    <form id="analysis" action="employeeAnalysis.php" method="POST">

        <table class="edit">
            <tr>
                <th>対象期間</th>
                <td>
                    <?php
                        $term1 = "";
                        $term2 = "";
                        $term3 = "";
                        $term4 = "";
                        if(!isset($term) || $term=="1"){
                            $term1 = " checked";
                        }elseif($term=="2"){
                            $term2 = " checked";
                        }elseif($term=="3"){
                            $term3 = " checked";
                        }else{
                            $term4 = " checked";
                        }
                    ?>
                    <input type="radio" name="term" value="1" <?php echo $term1; ?> >今月(1日〜昨日)　
                    <input type="radio" name="term" value="2" <?php echo $term2; ?>>前月　
                    <input type="radio" name="term" value="3" <?php echo $term3; ?>>前々月　<br>
                    <input type="radio" name="term" value="4" <?php echo $term4; ?>>任意
                    <input type='date' class='f130P' name='startDate' value='<?php echo $startDate; ?>'>　〜　<input type='date' class='f130P' name='endDate' value='<?php echo $endDate; ?>'>
                </td>
            </tr>
            <tr>
                <th>対象者</th>
                <td>
                    <?php
                        $emp1 = "";
                        $emp2 = "";
                        if(!isset($emp) || $emp=="1"){
                            $emp1 = " checked";
                        }else{
                            $emp2 = " checked";
                        }
                    ?>
                    <input type="radio" name="emp" value="1" <?php echo $emp1; ?>>社員　
                    <input type="radio" name="emp" value="2" <?php echo $emp2; ?>>派遣　
                </td>
            </tr>
            <tr>
                <td colspan=2>
                <button type='submit' class='f100P' name='coverTime'>検索</button>
                </td>
            </tr>
        </table>

    </form>

    <table class="vw2">
        <tr>
            <th width='100px'>社員番号</th>
            <th width='250px'>名前</th>
            <th width='50px'>稼働日</th>
            <th width='50px'>出勤日</th>
            <th width='50px'>欠勤日</th>
            <th width='50px'>未退勤</th>
            <th width='50px'>遅延</th>
            <th width='50px'>遅刻</th>
            <th width='50px'>早退</th>
            <th width='50px'>代行</th>
            <th width='50px'>警告</th>
            <th></th>
        </tr><?php echo $html; ?>
    </table>


</body>

</html>