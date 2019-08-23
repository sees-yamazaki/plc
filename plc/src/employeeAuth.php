<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: Logout.php");
    exit;
}


$ini = parse_ini_file('../common.ini', FALSE);

    if (!empty($_SESSION["LEVEL"])) {

        // SESSIONのユーザLEVELを格納
        $userlvl = $_SESSION["LEVEL"];

        // 3. エラー処理
        try {

            require_once 'dns.php';
            
            $stmt = $pdo->prepare('SELECT a.*, b.name FROM auth_work as a inner join employee b on a.employee_seq = b.employee_seq where a.status=1');
            $stmt->execute(array());

            $html="";
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                
                $html .= '<tr><form action="employeeAuthWork.php" method="POST">';
                $html .= "<input type='hidden' name='aSeq' value='".$row["aw_seq"]."'>";
                $html .= "<input type='hidden' name='name' value='".$row["name"]."'>";
                $html .= "<td width='150px'>".$row['work_y']."/".$row['work_m']."</td>";
                $html .= "<td width='200px'>".$row['name']."</td>";
                $t = date("Y/m/d H:i", strtotime($row['create_date']));
                $html .= "<td width='200px'>".$t."</td>";
                $html .= "<td width='100px' >";
                $html .= "<button type='submit' name='auth'>確認</button>";
                $html .= "</td>";
                $html .= "</form></tr>";
                
                    
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

    <table class="vw2">
        <tr>
            <th width="180px">対象年月</th>
            <th width="180px">氏名</th>
            <th width="250px">申請日時</th>
            <th width="80px"></th>
        </tr><?php echo $html; ?>
    </table>


</body>

</html>