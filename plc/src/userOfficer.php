<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: Logout.php");
    exit;
}


$ini = parse_ini_file('../common.ini', FALSE);

$eSeq = $_POST['eSeq'];


    try {

        require_once 'dns.php';
        

        if(isset($_POST['userEdit'])){

            //現在の値を削除する
            $sql = "DELETE FROM `officer` WHERE `employee_seq`=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array($eSeq));

            //新しい紐づきを登録する
            if (isset($_POST['officer']) && is_array($_POST['officer'])) {
                foreach( $_POST['officer'] as $value ){
                    $sql = "INSERT INTO `officer`(`employee_seq`, `officer_seq`) VALUES (?,?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(array($eSeq,$value));
                }
            }
            
            header("Location: ./userList.php");

        }else{


            //
            $stmt = $pdo->prepare("SELECT officer_seq FROM officer where employee_seq=?");
            $stmt->execute(array($eSeq));
            $officersX = $stmt->fetchAll();
            $officers = array_column($officersX, 0);

            $stmt = $pdo->prepare('SELECT * FROM employee where employee_level=99 order by employee_seq');
            $stmt->execute(array());
            
            $html="";
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                
                $html .= '<tr>';
                $html .= "<td width='100px'>".$row['employee_id']."</td>";
                $html .= "<td width='300px'>".$row['name']."</td>";
                if($row['sex']=="1"){
                    $html .= "<td width='80px'>男</td>";
                }else{
                    $html .= "<td width='80px'>女</td>";
                }
                $html .= "<td width='150px'>".$row['birthday']."</td>";
                $html .= "<td width='50px' >";
                if(in_array($row['employee_seq'],$officers)){
                    $html .= "<input type='checkbox' name='officer[]'  value=".$row['employee_seq']." checked>";
                }else{
                    $html .= "<input type='checkbox' name='officer[]'  value=".$row['employee_seq'].">";
                }
                $html .= "</td>";
                $html .= "</tr>";
                
                    
            }

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
    <script src="../js/employeeEdit.js"></script>
</head>

<body>
    <?php include('./menu.php'); ?>

    <div class="nav">
        <button type="button" onclick="location.href='userList.php'" class="back">戻る</button>
        <font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font>
    </div>
    <br>

    <table class="vw2" width="60%">
        <tr>
            <td><?php echo $_POST['name']; ?>の担当を選択中</td>
        </tr>
    </table><br>


    <form action="userOfficer.php" method="POST">
        <input type="hidden" name="eSeq" value="<?php echo $eSeq; ?>">
        <table class="vw2">
            <tr>
                <th>社員番号</th>
                <th>氏名</th>
                <th>性別</th>
                <th>生年月日</th>
                <th></th>
            </tr>
            <?php echo $html; ?> 
            <tr>
                <td colspan="5" style="text-align:center;">
                    <button type=submit name="userEdit" class="cal2">登録</button>
                </td>
            </tr>
        </table>
    </form>

</body>

</html>