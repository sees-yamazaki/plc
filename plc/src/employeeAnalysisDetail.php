<?php
session_start();

date_default_timezone_set('Asia/Tokyo');

// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: Logout.php");
    exit;
}


$ini = parse_ini_file('../common.ini', false);


try {
    $emp = $_POST['emp'];
    $user_seq = $_POST['user_seq'];
    $sDate = $_POST['sDate'];
    $eDate = $_POST['eDate'];
    $term = $_POST['term'];


    require_once 'dns.php';

    $sql = "";
    if ($emp=="1") {
        if ($user_seq=="0") {
            $sql = 'SELECT * FROM v_schedule where (officer_employee_seq=? OR officer_employee_seq IS NULL) and plan_leave_time BETWEEN ? AND ? ORDER BY user_seq,plan_leave_time';
        } else {
            $sql = 'SELECT * FROM v_schedule where officer_employee_seq=? and plan_leave_time BETWEEN ? AND ? ORDER BY user_seq,plan_leave_time';
        }
    } else {
        $sql = 'SELECT DISTINCT `sche_seq`, `user_seq`, `work_y`, `work_m`, `work_d`, `plan_leave_time`, `plan_start_time`, `plan_end_time`, `leave_time`, `start_time`, `end_time`, `job_seq`, `client_seq`, `alert_count`, `alert_time`, `cover_user_seq`, `cover_time`, `name`, `employee_id`, `worked`, `noleave`, `nogoing`, `delayed`, `lated`, `leftearly`, `covered` FROM v_schedule where user_seq=? and plan_leave_time BETWEEN ? AND ? ORDER BY user_seq,plan_leave_time';
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($user_seq, $sDate." 00:00:00",$eDate." 23:59:59"));

    $html="";
    $preId="";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $html .= '<tr>';
        $html .= "<input type='hidden' name='user_seq' value='".$row["user_seq"]."'>";
        if ($preId==$row['employee_id']) {
            $html .= "<td class='grey'>".$row['employee_id']."</td>";
            $html .= "<td class='grey'>".$row['name']."</td>";
        } else {
            $preId=$row['employee_id'];
            $html .= "<td>".$row['employee_id']."</td>";
            $html .= "<td>".$row['name']."</td>";
        }
        $html .= "<td>".substr($row['plan_leave_time'], 0, 10)."</td>";
        $html .= "<td>".substr($row['plan_leave_time'], 11, 5)." - ".substr($row['plan_start_time'], 11, 5)." - ".substr($row['plan_end_time'], 11, 5)."</td>";
        $html .= "<td>".substr($row['leave_time'], 11, 5)." - ".substr($row['start_time'], 11, 5)." - ".substr($row['end_time'], 11, 5)."</td>";
        $html .= "<td>".$row['noleave']."</td>";
        $html .= "<td>".$row['nogoing']."</td>";
        $html .= "<td>".$row['delayed']."</td>";
        $html .= "<td>".$row['lated']."</td>";
        $html .= "<td>".$row['leftearly']."</td>";
        $html .= "<td>".$row['covered']."</td>";
        if ($row['alert_count']==0) {
            $html .= "<td>0</td>";
        } else {
            $html .= "<td>1</td>";
        }
        $html .= "</tr>";
    }
} catch (PDOException $e) {
    $errorMessage = 'データベースエラー';
    //$errorMessage = $sql;
    if (strcmp("1", $ini['debug'])==0) {
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
    <style>
        .grey {
            color: #cccccc;
        }
    </style>   
</head>

<body>
    <?php include('./menu.php'); ?>

    <div class="nav">
        <form id="analysis" action="employeeAnalysis.php" method="POST">   
        <button type="submit" onclick="location.href='home.php'" class="back">戻る</button>
        <font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font>
        <input type='hidden' name='startDate' value='<?php echo $sDate ; ?>'>
        <input type='hidden' name='endDate' value='<?php echo $eDate ; ?>'>
        <input type='hidden' name='term' value='<?php echo $term; ?>'>
        <input type='hidden' name='emp' value='<?php echo $emp; ?>'>
        </form>
    </div><br>

    <table class="vw2">
        <tr>
            <th width='100px'>社員番号</th>
            <th width='250px'>名前</th>
            <th width='150px'>出勤日</th>
            <th width='250px'>予定</th>
            <th width='250px'>実績</th>
            <th width='50px'>欠勤</th>
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