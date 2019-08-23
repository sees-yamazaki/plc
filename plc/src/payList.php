<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: Logout.php");
    exit;
}


require_once 'date.php';
require_once 'calcPay.php';

$ini = parse_ini_file('../common.ini', FALSE);

    if (!empty($_SESSION["LEVEL"])) {

        try {

            if(isset($_POST['moveMonth'])){
                //指定月
                $tY = $_POST['ty'];
                $tM = $_POST['tm'];
            }else{
                //当月
                $tY = date('Y');
                $tM = date('m');
            }

            //今月
            $thisY = date('Y');
            $thisM = date('m');
            $firstday =  getTimestamp($thisY,$thisM);
            //先月
            $lastTime = getTimestamp_LastMonth($firstday);
            $lastY = date('Y',  $lastTime);
            $lastM = date('m',  $lastTime);
            //先々月
            $last2Time = getTimestamp_LastMonth($lastTime);
            $last2Y = date('Y',  $last2Time);
            $last2M = date('m',  $last2Time);



            require_once 'dns.php';
            
            $stmt = $pdo->prepare('SELECT s.*, e.name, e.pay_type,e.pay_unitcost,e.sales_unitcost,e.transport_unitcosts,e.pass_cost FROM schedule as s INNER JOIN employee as e on s.user_seq = e.employee_seq WHERE s.work_y=? and s.work_m=? and s.end_time is NOT NULL ORDER BY s.user_seq, s.work_d');
            $stmt->execute(array($tY,$tM));

            $html="";
            $totalPay = 0;
            $uSeq="";
            $name="";
            $pType="";
            $workCnt = 0;
            $trnsCost = 0;
            $passCost = 0;
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($row['user_seq']<>$uSeq){
                    //break
                    if(!empty($uSeq)){
                        $html .= '<tr><form id="useredit" action="employeeX.php" method="POST">';
                        $html .= "<input type='hidden' name='eSeq' value='".$row["employee_seq"]."'>";
                        $html .= "<input type='hidden' name='name' value='".$name."'>";
                        $html .= "<input type='hidden' name='ty' value='".$tY."'>";
                        $html .= "<input type='hidden' name='tm' value='".$tM."'>";
                        $html .= "<td width='300px'>".$name."</td>";
                        $html .= "<td width='100px'>".$pType."</td>";
                        $html .= "<td width='100px'>".$workCnt."</td>";
                        $html .= "<td width='100px'>".number_format(intval($totalPay))."</td>";
                        if($workCnt>15){
                            $tPay = number_format(intval($passCost));
                        }else{
                            $tPay = number_format(intval($trnsCost * $workCnt));
                        }
                        $html .= "<td width='100px'>".$tPay."</td>";
                        $html .= "</form></tr>";

                    }

                    $uSeq = $row["user_seq"];
                    $name = $row["name"];
                    $trnsCost = $row["transport_unitcosts"];
                    $passCost = $row["pass_cost"];
                    $totalPay = 0;
                    $workCnt = 0;
                }
                if($row['pay_type']==1){
                    //時給　時給算出し加算
                    $work_hm = getWorkTime($row['plan_start_time'],$row['plan_end_time']);
                    $pay = getWorkPay($row['pay_unitcost'],$work_hm);
                    $totalPay += $pay;
                    $pType="時給";
                }elseif($row['pay_type']==2){
                    //日給 日毎に加算
                    $totalPay += $row['pay_unitcost'];
                    $pType="日給";
                }elseif($row['pay_type']==3){
                    //月給　ただただ代入
                    $totalPay = $row['pay_unitcost'];
                    $pType="月給";
                }
                //稼働日をカウント
                $workCnt++;
                    
            }

            $html .= '<tr><form id="useredit" action="employeeX.php" method="POST">';
            $html .= "<input type='hidden' name='eSeq' value='".$row["employee_seq"]."'>";
            $html .= "<input type='hidden' name='name' value='".$name."'>";
            $html .= "<input type='hidden' name='ty' value='".$tY."'>";
            $html .= "<input type='hidden' name='tm' value='".$tM."'>";
            $html .= "<td width='300px'>".$name."</td>";
            $html .= "<td width='100px'>".$pType."</td>";
            $html .= "<td width='100px'>".$workCnt."</td>";
            $html .= "<td width='100px'>".number_format(intval($totalPay))."</td>";
            if($workCnt>15){
                $tPay = number_format(intval($passCost));
            }else{
                $tPay = number_format(intval($trnsCost * $workCnt));
            }
            $html .= "<td width='100px'>".$tPay."</td>";
            $html .= "</form></tr>";

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
            <td class="titleYM" colspan=3><?php echo $tY; ?>/<?php echo $tM; ?></td>
        </tr>
        <tr>
            <td class="titleYM">
            <form action="payList.php" method="POST">
            <input type="hidden" name="ty" value="<?php echo $last2Y; ?>">
            <input type="hidden" name="tm" value="<?php echo $last2M; ?>">
            <button type=submit name="moveMonth" class="del"><?php echo $last2Y; ?>/<?php echo $last2M; ?></button>
            </form>
            </td>
            <td class="titleYM">
            <form action="payList.php" method="POST">
            <input type="hidden" name="ty" value="<?php echo $lastY; ?>">
            <input type="hidden" name="tm" value="<?php echo $lastM; ?>">
            <button type=submit name="moveMonth" class="del"><?php echo $lastY; ?>/<?php echo $lastM; ?></button>
            </form>
            </td>
            <td class="titleYM">
            <form action="payList.php" method="POST">
            <input type="hidden" name="ty" value="<?php echo $thisY; ?>">
            <input type="hidden" name="tm" value="<?php echo $thisM; ?>">
            <button type=submit name="moveMonth" class="del"><?php echo $thisY; ?>/<?php echo $thisM; ?></button>
            </form>
            </td>
        </tr>
    </table>
    <br>

    <table class="vw2">
        <tr>
            <th>氏名</th>
            <th>給与形態</th>
            <th>稼働日</th>
            <th>給与</th>
            <th>交通費</th>
        </tr>
        <?php echo $html; ?>
    </table>


</body>

</html>