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
            
            $stmt = $pdo->prepare('SELECT * FROM employee where employee_level=99 order by employee_id desc');
            $stmt->execute(array($userlvl));

            $html="";
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                
                $html .= '<tr><form id="useredit" action="employeeX.php" method="POST">';
                $html .= "<input type='hidden' name='eSeq' value='".$row["employee_seq"]."'>";
                $html .= "<input type='hidden' name='alert_time' value='".$row["alert_time"]."'>";
                $html .= "<input type='hidden' name='eName' value='".$row["name"]."'>";
                $html .= "<td>".$row['employee_id']."</td>";
                $html .= "<td>".$row['name']."</td>";
                if($row['kind']=="1"){
                    $html .= "<td>CP</td>";
                }elseif($row['kind']=="2"){
                    $html .= "<td>派遣社員</td>";
                }elseif($row['kind']=="9"){
                    $html .= "<td>退職</td>";
                }else{
                    $html .= "<td>社員</td>";
                }
                if($row['sex']=="1"){
                    $html .= "<td>男</td>";
                }else{
                    $html .= "<td>女</td>";
                }
                $html .= "<td>".$row['birthday']."</td>";
                $html .= "<td width='130px' >";
                $html .= "<button type='submit' name='edit' >編集</button>　";
                $html .= "<button type='submit' name='view' >閲覧</button>";
                $html .= "</td>";
                $html .= "<td width='90px' >";
                $html .= "<button type='submit' name='shift'>シフト</button>";
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
            <th width='100px'>社員番号</th>
            <th width='250px'>氏名</th>
            <th width='120px'>属性</th>
            <th width='80px'>性別</th>
            <th width='130px'>生年月日</th>
            <th class="add" colspan="2"><button type='button' onclick="location.href='employeeEdit.php'">新規登録</button></th>
        </tr><?php echo $html; ?>
    </table>


</body>

</html>