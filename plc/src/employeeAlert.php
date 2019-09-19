<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: Logout.php");
    exit;
}


$ini = parse_ini_file('../common.ini', FALSE);

    // 3. エラー処理
    try {


        require_once 'dns.php';

        if(isset($_POST['coverTime'])){

            if(!empty($_POST['startTime'])){
                $sche_seq = $_POST['sche_seq'];
                $timestamp = time() ;
                $startTime = date( "Y/m/d" , $timestamp ) . " " . $_POST['startTime'];
    
                $cover_user_seq = $_SESSION['SEQ'];
                $sql = "UPDATE `schedule` SET `leave_time`=?,`cover_user_seq`=?,`cover_time`=now() WHERE `sche_seq`=?";
    
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array( $startTime, $cover_user_seq, $sche_seq));
    
                $name = $_POST['name'];
                $errorMessage = $_POST['name']."さんの出勤時間を(".$startTime.")で代行登録しました";
            }
        }




        
        $stmt = $pdo->prepare('SELECT * FROM alerting  order by plan_leave_time');
        $stmt->execute(array($userlvl));

        $html="";
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            
            $html .= '<tr><form id="useredit" action="employeeAlert.php" method="POST" onsubmit="return coverCheck()">';
            $html .= "<input type='hidden' name='sche_seq' value='".$row["sche_seq"]."'>";
            $html .= "<input type='hidden' name='user_seq' value='".$row["user_seq"]."'>";
            $html .= "<input type='hidden' name='name' value='".$row["name"]."'>";
            $html .= "<td>".$row['name']."</td>";
            $html .= "<td>".$row['f_plt']." - ".$row['f_pst']." - ".date('H:i',strtotime($row['plan_end_time']))."</td>";
            $html .= "<td width='130px' >";
            $html .= "<input type='time' class='f130P' name='startTime' required>";
            $html .= "</td>";
            $html .= "<td width='90px' >";
            $html .= "<button type='submit' class='f100P' name='coverTime'>出発登録</button>";
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

?>
<!DOCTYPE html>
<html>

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

    <table class="vw2">
        <tr>
            <th width='250px'>氏名</th>
            <th width='250px'>出発 - 出勤 - 退勤</th>
            <th width='150px'>出発時間</th>
            <th></th>
        </tr><?php echo $html; ?>
    </table>


</body>

</html>