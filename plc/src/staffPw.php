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
        
        
        if(isset($_POST['staffPw'])){

            $password = $_POST['password'];
            $pass = $_POST['pass'];
            
            
            if($password==$pass){
                $sql = "UPDATE `employee` SET `employee_pw`=? WHERE `employee_seq`=?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                    $password,
                    $uSeq));

                    $_SESSION['MSG'] = "パスワードを更新しました。";

                header("Location: ./staff.php");

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

    $fButton = "<div class='headbutton'><a href='staff.php'><img src='../img/home.png'></a></div>";
}
?>
<!DOCTYPE html>
<html>

<head class="wf-sawarabigothic">
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/staff.css">
    <link rel="stylesheet" type="text/css" href="../css/hiraku.css">
    <script src="http://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="../js/hiraku.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic" rel="stylesheet">
    
</head>

<body>

    <?php include('./staffMenu.php'); ?>

    <form action="staffPw.php" method="POST" onsubmit="return pwcheck()">
    <table class="work fnt2em">
        <tbody>
            <tr><td class="err" colspan=2><?php echo $errorMessage; ?></td></tr>
            <tr>
                <th class="arrow_box">新しいパスワード</th>
                <td><input type="password" name="password" size="10" class="txt" value="<?php echo $password; ?>" /></td>
            </tr>
            <tr>
                <th class="arrow_box">確認用</th>
                <td><input type="password" name="pass" size="10" class="txt" value="<?php echo $pass; ?>" /></td>
            </tr>

            <tr><td colspan="2"><button type=submit name="staffPw" class="btn-sticky">登録</button></td></tr>
        </tbody>
    </table>
    </form>


</body>

</html>
