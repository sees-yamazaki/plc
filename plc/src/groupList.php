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
        
        $stmt = $pdo->prepare('SELECT * FROM `group` order by row_order');
        $stmt->execute(array());

        $html="";
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            
            $html .= '<tr><form action="groupEdit.php" method="POST">';
            $html .= "<input type='hidden' name='gSeq' value='".$row["group_seq"]."'>";
            $html .= "<td>".$row['group_name']."</td>";
            $html .= "<td style='vertical-align:middle;'>";
            $html .= "<button type='submit' name='edit' >編集</button>　";
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../js/main.js"></script>
</head>

<body>
    <?php include('./menu.php'); ?>

    <div class="nav">
        <button type="button" onclick="location.href='home.php'" class="back">戻る</button>
        <font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font>
    </div><br>

    <table class="vw2" width="50%">
        <tr>
            <th>グループ名称</th>
            <th class="add"  width='100px'>
                <div style="vertical-align:middle;"><button type='button'
                        onclick="location.href='groupEdit.php'">新規登録</button>
                </div>
            </th>
        </tr><?php echo $html; ?><div>
    </table>


</body>

</html>