<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: Logout.php");
    exit;
}

if (isset($_POST["edit"])) {
    echo $_POST["uSeq"];
}

$ini = parse_ini_file('./common.ini', FALSE);

    if (!empty($_SESSION["LEVEL"])) {

        // SESSIONのユーザLEVELを格納
        $userlvl = $_SESSION["LEVEL"];

        // 3. エラー処理
        try {

            require_once 'dns.php';
            
            $stmt = $pdo->prepare('SELECT * FROM user order by user_level, user_seq');
            $stmt->execute(array($userlvl));

            $html="";
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            //if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                
                $html .= '<tr><form id="useredit" action="userEdit.php" method="POST">';
                $html .= "<td width='100px'>".$row['user_id']."<input type='hidden' name='uSeq' value='".$row["user_seq"]."'></td>";
                $html .= "<td width='300px'>".$row['user_name']."</td>";
                $html .= "<td width='100px'>".$row['user_level']."</td>";
                $html .= "<td width='100px' ><button type='submit' name='edit' class='edit'>edit</button></td>";
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
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/table.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="js/main.js"></script>
</head>

<body>

    <?php include('./menu.php'); ?>

    <font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font>

    <button type='button' class='edit' onclick="location.href='userEdit.php'">新規登録</button><br><br>
    <table class="vw"><tr><th>ID</th><th>名前</th><th>権限</th><th></th></tr><?php echo $html; ?></table>


</body>

</html>
