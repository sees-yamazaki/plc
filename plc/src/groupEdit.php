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
        
        $gSeq = $_POST['gSeq'];
        
        if(isset($_POST['groupEdit'])){
            
            $group_name = $_POST['group_name'];
            
            if(!empty($gSeq)){
                $sql = "UPDATE `group` SET `group_name`=?  WHERE `group_seq`=?";

                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                    $group_name,
                    $gSeq));
            }else{
                $sql = "INSERT INTO `group`(`row_order`, `group_name`) VALUES(99,?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array($group_name));
            }

            header("Location: ./groupList.php");

        }else if(isset($_POST['groupDel'])){
            
            $stmt = $pdo->prepare('SELECT * FROM employee where group_seq = ?');
            $stmt->execute(array($gSeq));
            
            if($row = $stmt->fetch()){
                $errorMessage = "このグループには社員が存在します。先に社員を編集してください。";

            }else{
                    $sql = "DELETE FROM `group` WHERE `group_seq`=?";
                    $stmt2 = $pdo->prepare($sql);
                    $stmt2->execute(array($gSeq));

                header("Location: ./groupList.php");
            } 

        }
        
        $stmt = $pdo->prepare('SELECT * FROM `group` where group_seq = ?');
        $stmt->execute(array($gSeq));
        
        if($row = $stmt->fetch()){
            $gSeq = $row['group_seq'];
            $group_name = $row['group_name'];
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
<html lang=”ja”>

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
        <button type="button" onclick="location.href='groupList.php'" class="back">戻る</button>
        <font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font>
    </div><br>


    <form action="groupEdit.php" method="POST">

        <input type="hidden" name="gSeq" value="<?php echo $gSeq; ?>">

        <table class="edit">
            <caption>グループ情報</caption>
            <tr>
                <th><span class="required">グループ名<span class="f50P"> (20)</span></span></th>
                <td><input type="text" id="group_name" name="group_name" class="f130P wdtL" maxlength=20 style="ime-mode: active;" required placeholder=""
                        value="<?php echo $group_name; ?>">
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center;"><button type=submit name="groupEdit" class="cal2">登録</button>
                </td>
            </tr>
        </table>

    </form>

    <?php if(!empty($gSeq)){ ?>
    <form action="groupEdit.php" method="POST" onsubmit="return delcheck()">

        <input type="hidden" name="gSeq" value="<?php echo $gSeq; ?>">

        <table class="del">
            <tr>
                <td><button type=submit name="groupDel" class="del">このグループを削除する</button></td>
            </tr>
        </table>

    </form>
    <?php } ?>

</body>

</html>