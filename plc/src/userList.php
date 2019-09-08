<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: Logout.php");
    exit;
}

    $ini = parse_ini_file('../common.ini', FALSE);


    try {

        require_once 'dns.php';
        
        $stmt = $pdo->prepare('SELECT * FROM employee where (employee_level=2 or employee_level=3 or employee_level=9)  order by employee_id desc');
        $stmt->execute(array());

        $html="";
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            
            $html .= '<tr><form id="useredit" action="userEdit.php" method="POST">';
            $html .= "<input type='hidden' name='eSeq' value='".$row["employee_seq"]."'>";
            $html .= "<input type='hidden' name='name' value='".$row["name"]."'>";
            $html .= "<td width='100px'>".$row['employee_id']."</td>";
            $html .= "<td width='300px'>".$row['name']."</td>";
            if ($row['employee_level']=="2"){
                $lvl = "管理者";
            }elseif ($row['employee_level']=="9"){
                $lvl = "退職";
            } else {
                $lvl = "社員";
            } 
            $html .= "<td width='100px'>".$lvl."</td>";
            $html .= "<td width='180px'><button type='submit' name='edit'>編集</button>　<button type='submit' name='view'>閲覧</button>　<button type='submit' name='officer'>担当</button></td>";
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../js/main.js"></script>
</head>

<body>

    <?php include('./menu.php'); ?>

    <div class="nav">
        <button type="button" onclick="location.href='home.php'" class="back">戻る</button>
        <font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font>
    </div><br>

    <table class="vw">
        <tr>
            <th>ID</th>
            <th>名前</th>
            <th>権限</th>
            <th class="add"><button type='button' onclick="location.href='userEdit.php'">新規登録</button></th>
        </tr><?php echo $html; ?>
    </table>


</body>

</html>