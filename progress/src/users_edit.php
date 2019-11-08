<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');


    $uSeq = $_POST['uSeq'];

    require './db/users.php';
    $user = new cls_users();

    try {

        $user->users_seq = $_POST['uSeq'];
        $user->users_id = $_POST['users_id'];
        $user->users_name = $_POST['users_name'];
        $user->users_level = $_POST['users_level'];
        
        if(isset($_POST['userEdit'])){


            
            $tmp = getUserByID($user);

            if(empty($tmp->users_seq)){
                if(!empty($uSeq)){
                    updateUser($user);
                }else{
                    insertUser($user);
                }
            }else{
                $errorMessage = 'このIDはすでに使用されています';
            }
            
            
            if(empty($errorMessage)){
                header("Location: ./users_list.php");
            }

        }else if(isset($_POST['userPw'])){

            pwUser($user);

            header("Location: ./users_list.php");

        }else if(isset($_POST['userDel'])){

            deleteUser($user);

            header("Location: ./users_list.php");

        }else{
            
            $user = getUser($uSeq);

        }


    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

    if($user->users_level=="1"){
        $uLvl1 = " checked";
    }else if($user->users_level=="2"){
        $uLvl2 = " checked";
    }else{
        $uLvl3 = " checked";
    }

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>DIAGNOSE</title>
    <link rel="stylesheet" href="../css/main.css" />
    <script src="../js/main.js"></script>
</head>

<body>

    <?php include('./menu.php'); ?>

    <div id="content">

        <div class="nav">
            <button type="button" onclick="location.href='users_list.php'" class="back">戻る</button>
            <span class="err"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></span>
        </div><br>

        <form action="users_edit.php" method="POST" onsubmit="return addcheck()">

            <input type="hidden" name="uSeq" value="<?php echo $uSeq; ?>">

            <table class="edit">
                <tr>
                    <th><span class="required">*</span>権限</th>
                    <td>
                        <input type="radio" name="users_level" value="1" required <?php echo $uLvl1; ?>>マネージャー　
                        <input type="radio" name="users_level" value="2" <?php echo $uLvl2; ?>>リーダー　
                        <input type="radio" name="users_level" value="3" <?php echo $uLvl3; ?>>一般　
                    </td>
                </tr>
                <tr>
                    <th><span class="required">*</span>ID<span class="f50P"> (10)</span></th>
                    <td><input type="text" name="users_id" class="f130P wdtS" maxlength=10
                            style="ime-mode: active;" required  pattern="[0-9a-zA-Z]+" title="半角英数字" placeholder="半角英数字" value="<?php echo $user->users_id; ?>" autocomplete="off">
                    </td>
                </tr>
                <tr>
                    <th><span class="required">*</span>名前<span class="f50P"> (30)</span></th>
                    <td><input type="text" name="users_name" class="f130P wdtL" maxlength=30
                            style="ime-mode: active;" required placeholder="" value="<?php echo $user->users_name; ?>" autocomplete="off">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <button type=submit name="userEdit" class="sbmt f110P">登録</button>
                    </td>
                </tr>
            </table>

        </form>


        <?php if(!empty($uSeq)){ ?>

        <form action="users_edit.php" method="POST" onsubmit="return pwcheck()">

            <input type="hidden" name="uSeq" value="<?php echo $uSeq; ?>">

            <table class="del">
                <tr>
                    <td><button type=submit name="userPw" class="ntc">パスワードを初期化する</button></td>
                </tr>
            </table>

        </form>

        <form action="users_edit.php" method="POST" onsubmit="return delcheck()">

            <input type="hidden" name="uSeq" value="<?php echo $uSeq; ?>">

            <table class="del">
                <tr>
                    <td colspan=2><button type=submit name="userDel" class="del wdtLL">このユーザを削除する</button></td>
                </tr>
                <tr>
                    <td colspan=2><button type=submit name="userDel" class="del wdtLL">このユーザを削除する</button></td>
                </tr>
            </table>

        </form>
        <?php } ?>
    </div>
</body>

</html>