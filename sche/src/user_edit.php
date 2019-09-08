<?php
session_start();


    $uSeq = $_POST['uSeq'];

    require './db/users.php';
    $user = new cls_users();

    try {

        
        if(isset($_POST['userEdit'])){

            $user->users_seq = $_POST['uSeq'];
            $user->users_id = $_POST['users_id'];
            $user->users_pw = $_POST['users_pw'];
            $user->users_name = $_POST['users_name'];
            $user->groups_seq = $_POST['groups_seq'];
            $user->users_level = $_POST['users_level'];

            //社員番号の確認
            $tmpUser = getUserByID($uSeq, $user->users_id);

            if(!empty($tmpUser->users_name)){
                $errorMessage = "社員ID(".$user->users_id.")はすでに使用されています。";
            }else{
                if(!empty($uSeq)){
                    updateUser($user);
                }else{
                    insertUser($user);
                }
            }
            
            
            if(empty($errorMessage)){
                header("Location: ./user_list.php");
            }

            /*
        }else if(isset($_POST['userDel'])){
            
                    $sql = "DELETE FROM `employee` WHERE `employee_seq`=?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(array($eSeq));

                    $sql = "DELETE FROM `officer` WHERE `employee_seq`=?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(array($eSeq));



                header("Location: ./userList.php");
*/
        }else{
            
            $user = getUser($uSeq);

        }

        
        // 全てのグループを取得
        require './db/groups.php';
        $groups = array();
        $groups = getGroups();

        $html="";
        foreach ($groups as $group) {
            if($user->groups_seq==$group->groups_seq){
                $html .= "<option value='".$group->groups_seq."' selected>".$group->groups_name."</option>";
            }else{
                $html .= "<option value='".$group->groups_seq."'>".$group->groups_name."</option>";
            }
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
    <title>ユーザ編集</title>
    <link rel="stylesheet" href="../css/main.css" />
</head>

<body>

    <?php include('./menu.php'); ?>

    <div id="content">

        <div class="nav">
            <button type="button" onclick="location.href='user_list.php'" class="back">戻る</button>
            <span class="err"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></span>
        </div><br>

        <form action="user_edit.php" method="POST" onsubmit="return submitChk()">

            <input type="hidden" name="uSeq" value="<?php echo $uSeq; ?>">

            <table class="edit">
                <caption>ユーザ情報</caption>
                <tr>
                    <th><span class="required">*</span>ユーザID<span class="f50P"> (20)</span></th>
                    <td>
                        <input type="number" id="users_id" name="users_id" class="f130P wdtS"
                            oninput="sliceMaxLength(this, 20)" style="ime-mode: disabled;" pattern="^[0-9A-Za-z]+$"
                            title="半角英数字" placeholder="半角英数字" value="<?php echo $user->users_id; ?>" required>
                    </td>
                </tr>
                <tr>
                    <th><span class="required">*</span>パスワード<span class="f50P"> (20)</span></th>
                    <td>
                        <input type="password" id="users_pw" name="users_pw" class="f130P wdtS"
                            oninput="sliceMaxLength(this, 20)" style="ime-mode: disabled;" pattern="^[0-9A-Za-z]+$"
                            title="半角英数字" placeholder="半角英数字" value="<?php echo $user->users_pw; ?>" required>
                    </td>
                </tr>
                <tr>
                    <th><span class="required">*</span>氏名<span class="f50P"> (30)</span></th>
                    <td><input type="text" id="users_name" name="users_name" class="f130P wdtL" maxlength=30
                            style="ime-mode: active;" required placeholder="" value="<?php echo $user->users_name; ?>">
                    </td>
                </tr>
                <tr>
                    <th><span class="required">*</span>アカウント種別</th>
                    <td>
                        <?php if($user->users_level=="1"){ ?>
                        <input type="radio" name="users_level" value="1" checked>管理者
                        <input type="radio" name="users_level" value="2">一般
                        <?php }else{ ?>
                        <input type="radio" name="users_level" value="1">管理者
                        <input type="radio" name="users_level" value="2" checked>一般
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <th><span class="required">*</span>グループ</th>
                    <td>
                        <select name="groups_seq" class="f130P" required>
                            <option value="">選択してください</option>
                            <?php echo $html; ?>
                        </select>
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
        <form action="userEdit.php" method="POST" onsubmit="return delcheck()">

            <input type="hidden" name="uSeq" value="<?php echo $uSeq; ?>">

            <table class="del">
                <tr>
                    <td><button type=submit name="userDel" class="del">このユーザを削除する</button></td>
                </tr>
            </table>

        </form>
        <?php } ?>
    </div>
</body>

</html>