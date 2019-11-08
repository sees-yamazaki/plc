<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');


    $gSeq = $_POST['gSeq'];

    require './db/groups.php';
    $group = new cls_groups();

    try {

        $group->groups_seq = $_POST['gSeq'];
        $group->groups_name = $_POST['groups_name'];
        $group->groups_que = $_POST['groups_que'];
        $group->users_seq = $_POST['users_seq'];
        
        if(isset($_POST['grpEdit'])){

            if(!empty($gSeq)){
                updateGroup($group);
            }else{
                //insertGroup($group);
            }
            
            if(empty($errorMessage)){
                header("Location: ./groups_list.php");
            }

        }else if(isset($_POST['grpDel'])){

            //deleteGroup@($group);

            //header("Location: ./groups_list.php");

        }else{
            
            $group = getGroup($gSeq);

        }


    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

    require './db/users.php';
    $users = array();
    $users = getUsers();

    
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
            <button type="button" onclick="location.href='groups_list.php'" class="back">戻る</button>
            <span class="err"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></span>
        </div><br>

        <form action="groups_edit.php" method="POST" onsubmit="return addcheck()">

            <input type="hidden" name="gSeq" value="<?php echo $gSeq; ?>">
            <input type="hidden" name="groups_que" value="<?php echo $group->groups_que; ?>">

            <table class="edit">
                <tr>
                    <th><span class="required">*</span>名称<span class="f50P"> (20)</span></th>
                    <td><input type="text" name="groups_name" class="f130P wdtL" maxlength=20
                            style="ime-mode: active;" required placeholder="" value="<?php echo $group->groups_name; ?>" autocomplete="off">
                    </td>
                </tr>
                <tr>
                    <th><span class="required">*</span>マネージャー<span class="f50P"> (10)</span></th>
                    <td>
                        <select id="users_seq" name="users_seq" class="f130P wdtL" required>
                            <option value='0'>選択してください</option>
                            <?php foreach ($users as $user) { ?>
                                <?php if ($user->users_seq == $group->users_seq) { ?>
                                    <option value='<?php echo $user->users_seq; ?>' selected><?php echo $user->users_name; ?></option>
                                <?php }else{ ?>
                                    <option value='<?php echo $user->users_seq; ?>'><?php echo $user->users_name; ?></option>
                                <?php } ?>
                            <?php } ?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <button type=submit name="grpEdit" class="sbmt f110P">登録</button>
                    </td>
                </tr>
            </table>

        </form>


        <?php if(!empty($uSeq)){ ?>

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