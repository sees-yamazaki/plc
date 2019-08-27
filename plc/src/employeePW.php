<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: Logout.php");
    exit;
}

$uSeq = $_SESSION['SEQ'];

$ini = parse_ini_file('../common.ini', FALSE);

$side = $_GET['side'];

    try {

        require_once 'dns.php';
        
        if(isset($_POST['employeePW'])){

            $eSeq = $_POST['eSeq'];
            
            
            $sql = "UPDATE `employee` SET `employee_pw`=`employee_id` WHERE `employee_seq`=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array($eSeq));

            $_SESSION['MSG'] = "パスワードを初期化しました。";

            header("Location: ./home.php");

        }

        if($side=="99"){
            $sql = "SELECT * FROM `employee` WHERE employee_level=99 ORDER BY employee_id";
        }else{
            $sql = "SELECT * FROM `employee` WHERE employee_level=2 OR employee_level=3 ORDER BY employee_id";
        }
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $html="";
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $html .= "<option value='".$row['employee_seq']."'>".$row['employee_id']." : ".$row['name']."</option>";
        }


    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
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
    <link rel="stylesheet" href="../css/employeeEdit.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/employeeEdit.js"></script>
</head>

<body>

    <?php include('./menu.php'); ?>


    <div class="nav">
        <button type="button" onclick="location.href='home.php'" class="back">戻る</button>
        <font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font>
    </div>

    <form action="employeePW.php" method="POST" onsubmit="return rePWcheck()">

        <table class="edit" style="width:70%">
            <tr>
                <th>対象者</th>
                <td>
                    <select id="eSeq" name="eSeq" class="f150P" required>
                        <option value="">選択してください</option>
                        <?php echo $html; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;"><span class="err f150P">&nbsp;<br>初期化するとIDと同じパスワードになります。<br>&nbsp;</span></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;"><button type=submit name="employeePW" class="cal2">初期化</button></td>
            </tr>
        </table>

    </form>


</body>

</html>