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
            $stmt = $pdo->prepare('SELECT * FROM v_employeecost WHERE work_y = ? AND work_m=? ORDER BY user_seq');
            $stmt->execute(array($tY,$tM));

            $html="";
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $html .= '<tr><form id="useredit" action="employeeX.php" method="POST">';
                $html .= "<input type='hidden' name='eSeq' value='".$row["user_seq"]."'>";
                $html .= "<input type='hidden' name='ty' value='".$tY."'>";
                $html .= "<input type='hidden' name='tm' value='".$tM."'>";
                $html .= "<td>".$row["name"]."</td>";
                $html .= "<td>".$row['group_name']."</td>";
                $html .= "<td>".$row['client_name']."</td>";
                $tSales = intval($row["totalSales"]); //売上
                $tPay = intval($row["totalPay"]);  //給与
                $tTrns = intval($row["totalTrnsCost"]); //交通費
                $arari = $tSales - $tPay - $tTrns; //粗利
                $html .= "<td width='100px'>".number_format($tSales)."</td>";
                $html .= "<td width='100px'>".number_format($tPay)."</td>";
                $html .= "<td width='100px'>".number_format($tTrns)."</td>";
                $html .= "<td width='100px'>".number_format($arari)."</td>";
                $html .= "</form></tr>";
                $tSalesSum += $tSales;
                $tPaySum += $tPay;
                $tTrnsSum += $tTrns;
                $arariSum += $arari;
            }


            $stmt = $pdo->prepare('SELECT g.*,ec.* FROM `group` g LEFT JOIN (select group_seq, sum(totalPay) totalPay,sum(totalSales) totalSales,sum(totalTrnsCost) totalTrnsCost from v_employeecost where work_y=? and work_m=? group by group_seq) ec on g.group_seq = ec.group_seq');
            $stmt->execute(array($tY,$tM));

            $html2="";
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $html2 .= '<tr><form id="useredit" action="employeeX.php" method="POST">';
                $html2 .= "<td width='100px'>".$row['group_name']."</td>";
                $tSales = intval($row["totalSales"]); //売上
                $tPay = intval($row["totalPay"]);  //給与
                $tTrns = intval($row["totalTrnsCost"]); //交通費
                $arari = $tSales - $tPay - $tTrns; //粗利
                $html2 .= "<td width='100px'>".number_format($tSales)."</td>";
                $html2 .= "<td width='100px'>".number_format($tPay)."</td>";
                $html2 .= "<td width='100px'>".number_format($tTrns)."</td>";
                $html2 .= "<td width='100px'>".number_format($arari)."</td>";
                $html2 .= "</form></tr>";
                $tSalesSum2 += $tSales;
                $tPaySum2 += $tPay;
                $tTrnsSum2 += $tTrns;
                $arariSum2 += $arari;
                    
            }

            
            $stmt = $pdo->prepare('SELECT c.*,ec.* FROM `client` c LEFT JOIN (select client_seq, sum(totalPay) totalPay,sum(totalSales) totalSales,sum(totalTrnsCost) totalTrnsCost from v_employeecost where work_y=? and work_m=? group by client_seq) ec on c.client_seq = ec.client_seq');
            $stmt->execute(array($tY,$tM));

            $html3="";
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $html3 .= '<tr><form id="useredit" action="employeeX.php" method="POST">';
                $html3 .= "<td width='100px'>".$row['name']."</td>";
                $tSales = intval($row["totalSales"]); //売上
                $tPay = intval($row["totalPay"]);  //給与
                $tTrns = intval($row["totalTrnsCost"]); //交通費
                $arari = $tSales - $tPay - $tTrns; //粗利
                $html3 .= "<td width='100px'>".number_format($tSales)."</td>";
                $html3 .= "<td width='100px'>".number_format($tPay)."</td>";
                $html3 .= "<td width='100px'>".number_format($tTrns)."</td>";
                $html3 .= "<td width='100px'>".number_format($arari)."</td>";
                $html3 .= "</form></tr>";
                $tSalesSum3 += $tSales;
                $tPaySum3 += $tPay;
                $tTrnsSum3 += $tTrns;
                $arariSum3 += $arari;
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
            <td class="titleYM" colspan=3><?php echo $tY; ?>/<?php echo $tM; ?></td>
        </tr>
        <tr>
            <td class="titleYM">
            <form action="salesList.php" method="POST">
            <input type="hidden" name="ty" value="<?php echo $last2Y; ?>">
            <input type="hidden" name="tm" value="<?php echo $last2M; ?>">
            <button type=submit name="moveMonth" class="del"><?php echo $last2Y; ?>/<?php echo $last2M; ?></button>
            </form>
            </td>
            <td class="titleYM">
            <form action="salesList.php" method="POST">
            <input type="hidden" name="ty" value="<?php echo $lastY; ?>">
            <input type="hidden" name="tm" value="<?php echo $lastM; ?>">
            <button type=submit name="moveMonth" class="del"><?php echo $lastY; ?>/<?php echo $lastM; ?></button>
            </form>
            </td>
            <td class="titleYM">
            <form action="salesList.php" method="POST">
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
            <th width=200px>氏名</th>
            <th width=200px>グループ</th>
            <th width=200px>クライアント</th>
            <th width=150px>売上</th>
            <th width=150px>給与</th>
            <th width=150px>交通費</th>
            <th width=150px>粗利</th>
        </tr>
        <?php echo $html; ?>
        <tr>
            <td colspan=3 class="sumrow"></td>
            <td class="sumrow"><?php echo $tSalesSum; ?></td>
            <td class="sumrow"><?php echo $tPaySum; ?></td>
            <td class="sumrow"><?php echo $tTrnsSum; ?></td>
            <td class="sumrow"><?php echo $arariSum; ?></td>
        </tr>
    </table><br>

    <table class="vw2">
        <tr>
            <th width=280px>グループ</th>
            <th width=150px>売上</th>
            <th width=150px>給与</th>
            <th width=150px>交通費</th>
            <th width=150px>粗利</th>
        </tr>
        <?php echo $html2; ?>
        <tr>
            <td class="sumrow"></td>
            <td class="sumrow"><?php echo $tSalesSum2; ?></td>
            <td class="sumrow"><?php echo $tPaySum2; ?></td>
            <td class="sumrow"><?php echo $tTrnsSum2; ?></td>
            <td class="sumrow"><?php echo $arariSum2; ?></td>
        </tr>
    </table><br>


    <table class="vw2">
        <tr>
            <th width=280px>クライアント</th>
            <th width=150px>売上</th>
            <th width=150px>給与</th>
            <th width=150px>交通費</th>
            <th width=150px>粗利</th>
        </tr>
        <?php echo $html3; ?>
        <tr>
            <td class="sumrow"></td>
            <td class="sumrow"><?php echo $tSalesSum3; ?></td>
            <td class="sumrow"><?php echo $tPaySum3; ?></td>
            <td class="sumrow"><?php echo $tTrnsSum3; ?></td>
            <td class="sumrow"><?php echo $arariSum3; ?></td>
        </tr>
    </table>

</body>

</html>