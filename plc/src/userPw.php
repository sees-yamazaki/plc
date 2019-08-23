<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: Logout.php");
    exit;
}

$uSeq = $_SESSION['SEQ'];

$ini = parse_ini_file('../common.ini', FALSE);

if (!empty($_SESSION["LEVEL"])) {

    try {

        require_once 'dns.php';
        
        
        if(isset($_POST['userEdit'])){

            $password = $_POST['password'];
            $pass = $_POST['pass'];
            
            
            if($password==$pass){
                $sql = "UPDATE `employee` SET `employee_pw`=? WHERE `employee_seq`=?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                    $password,
                    $uSeq));

                    $_SESSION['MSG'] = "パスワードを更新しました。";

                header("Location: ./home.php");

            }else{
                $errorMessage = 'パスワードが一致しません。';
            }
            


        }


    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
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

    <form action="userPw.php" method="POST" onsubmit="return pwcheck()">

        <table class="edit" style="width:50%">
            <caption>ユーザ情報</caption>
            <tr>
                <th>新しいパスワード</th>
                <td><input type="password" id="password" name="password" style="ime-mode: disabled;" required>
                </td>
            </tr>
            <tr>
                <th>確認用</th>
                <td><input type="password" id="pass" name="pass" style="ime-mode: disabled;" required>
                </td>
            </tr>
            <tr><td colspan="2"><button type=submit name="empShift" class="btn-sticky">登録</button></td></tr>
        </table>

    </form>


</body>

</html>
