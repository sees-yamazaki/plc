<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: Logout.php");
    exit;
}

$ini = parse_ini_file('./common.ini', FALSE);

    if (isset($_POST["user"])) {
        
        try{
            require_once 'dns.php';
        
            if(empty($_POST["preId"])){
                //New
                $stmt = $pdo->prepare('INSERT INTO user(`user_id`, `user_name`, `user_level`, `user_pass`) VALUES ( ? , ? , ? , ?)');
                $stmt->execute(array($_POST["uId"],$_POST["uName"],$_POST["uPass"],$_POST["uLevel"]));
            }else if(empty($_POST["uDel"])){
                // Update
                $stmt = $pdo->prepare('UPDATE user SET user_name = ? , user_pass = ? , user_level = ? WHERE user_seq = ?');
                $stmt->execute(array($_POST["uName"],$_POST["uPass"],$_POST["uLevel"],$_POST["uSeq"]));
            }else{
                // delete
                $stmt = $pdo->prepare('DELETE FROM user WHERE user_seq = ?');
                $stmt->execute(array($_POST["uSeq"]));
            }
            header("Location: user.php");
            exit();
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
            if(strcmp("1",$ini['debug'])==0){
                echo $e->getMessage();
            }
        }
    }

    if (!empty($_POST["uSeq"])) {

        $uSeq = $_POST["uSeq"];

        try {

            require_once 'dns.php';
            
            $stmt = $pdo->prepare('SELECT * FROM user where user_seq=?');
            $stmt->execute(array($uSeq));
            //while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                
                $uId = $row['user_id'];
                $uName = $row['user_name'];
                $uPass = $row['user_pass'];
                $uLevel = $row['user_level'];                    
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
    <link rel="stylesheet" href="css/editText.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <script type="text/javascript">

        function submitChk() {
            var element = document.getElementById("uDel"); 
            if(element.checked){
                var flag = confirm("このユーザを削除してもよろしいですか？");
                return flag;
            }else{
                //var flag = confirm("更新してもよろしいですか？\n\n更新したくない場合は[キャンセル]ボタンを押して下さい");
                //return flag;
            }
        }

    </script>
</head>

<body>

    <?php include('./menu.php'); ?>

    <font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font>

    <form id="editUser" action="userEdit.php" method="POST" onsubmit="return submitChk()">

        <input type="hidden" name="uSeq" value="<?php echo $uSeq; ?>">

        <div class="text-input">
            <input type="hidden" name="preId" value="<?php echo $uId; ?>">
            <?php if(empty($uId)){ ?>
            <input type="text" name="uId" placeholder="ID" value="">
            <?php }else{ ?>
            <input type="text" name="uId" placeholder="ID" value="<?php echo $uId; ?>" readonly disabled>
            <?php } ?>
            <label for="uId" class="editLabel">ID</label>
        </div>
        <div class="text-input">
            <input type="text" name="uName" placeholder="お名前" value="<?php echo $uName; ?>">
            <label for="uName" class="editLabel">お名前</label>
        </div>
        <div class="text-input">
            <input type="password" name="uPass" placeholder="パスワード" value="<?php echo $uPass; ?>">
            <label for="uPass" class="editLabel">パスワード</label>
        </div>
        <div class="text-input radioDiv">
            <?php

            if($_SESSION['LEVEL']=='1'){
                $disabled = "";
            }else{
                $disabled = " disabled";
            }
            $ck1="";
            $ck2="";
            $ck3="";

            if($uLevel=='1'){
                $ck1=" checked";
            }else if($uLevel=='2'){
                $ck2=" checked";
            }else{
                $ck3=" checked";
            }
            ?>
            <input type="radio" id="staff1" name="uLevel" value="1" class="leftRadio" <?php echo $ck1;  echo $disabled; ?>>システム管理者
            <input type="radio" name="uLevel" value="2" <?php echo $ck2; ?>>社員
            <input type="radio" name="uLevel" value="3" <?php echo $ck3; ?>>スタッフ
            <label for="staff1" class="editLabel">権限</label>
        </div>

        <div class="text-input">
            <input type="checkbox" id="uDel" name="uDel" <?php if(empty($uId)){ echo "disabled"; } ?>><label for="uDel" class="editLabel <?php if(empty($uId)){ echo "fontGray"; } ?>">このユーザを削除する</label>
        </div>
        
        <div class="text-input" />


        <button type="button" onclick="location.href='user.php'" class="back">戻る</button>
        <?php if(isEdit==true){ ?>
        <button type="submit" id="user" name="user" class="edit">登録</button>
        <?php } ?>
    </form>

</body>

</html>
