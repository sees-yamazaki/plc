<?php

    session_start();

    //引数を取得
    $gSeq = $_POST['gSeq'];



    try {

        require_once './db/groups.php';
        $group = new cls_groups();

        if(isset($_POST['groupEdit'])){
            
            $group->groups_seq=$_POST['gSeq'];;
            $group->parent_groups_seq=$_POST['parent_groups_seq'];;
            $group->groups_name=$_POST['groups_name'];
            $group->create_users_seq =$_SESSION['SEQ'];
            $group->create_users_name =$_SESSION['NAME'];

            
            if($gSeq=="0"){

                $ckGroup = getGroupByName($group->groups_name);

                if(empty($ckGroup->create_users_name)){
                    insertGroup($group);
                }else{
                    $errorMessage = "このグループ名は既に使用されています。";
                }

            }elseif(!empty($gSeq)){

                updateGroup($group);

            }else{
                //ERR
            }

            if(empty($errorMessage)){
                header("Location: ./groupList.php");
            }

        }else if(isset($_POST['groupDel'])){
            

            require './db/user_group.php';
            $ug = array();
            $ug = getUserGroupListByGID($gSeq);

            if(count($ug)<>0){
                $errorMessage = "このグループには社員が存在します。先に社員を編集してください。";

            }else{
                $errorMessage = "削除可能。";
                    //sakujo

                //header("Location: ./groupList.php");
            } 
        }else{
            // 指定のグループを取得
            $group = getGroup($gSeq);
        }
        
        $groups_seq=$group->groups_seq;
        $groups_name=$group->groups_name;
        $parent_groups_seq=$group->parent_groups_seq;

        
        //全てのグループを取得
        $groups = array();
        $groups = getGroups();

        $html = "";
        foreach ($groups as $aGroup) {
            if($aGroup->groups_seq == $parent_groups_seq ){
                $html .= "<option name='gSeq' value='".$aGroup->groups_seq."' selected>".$aGroup->groups_name."</option>";
            }elseif($aGroup->groups_seq == $groups_seq ){
                //none
            }else{
                $html .= "<option name='gSeq' value='".$aGroup->groups_seq."'>".$aGroup->groups_name."</option>";
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
<html lang=”ja”>

<head>
    <meta charset="utf-8">
    <title>組織図</title>
    <link rel="stylesheet" href="../css/main.css">
    <script src="../js/main.js"></script>
</head>

<body>

    <?php include('./menu.php'); ?>

    <div id="content">

        <div class="nav">
            <button type="button" onclick="location.href='groupList.php'" class="back">戻る</button>
            <span class="err"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></span>
        </div><br>


        <form action="groupEdit.php" method="POST">

            <input type="hidden" name="gSeq" value="<?php echo $gSeq; ?>">

            <table class="edit">
                <tr>
                    <th><span class="required">*</span>上位グループ</th>
                    <td>
                        <select class="f130P" name="parent_groups_seq" required>
                            <option value="">選択して下さい</option>
                            <?php if(0==$parent_group_seq){ ?>
                            <option value="0" selected>TOP</option>
                            <?php }else{ ?>
                            <option value="0">TOP</option>
                            <?php } ?>
                            <?php echo $html; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><span class="required">*</span>グループ名<span class="f50P"> (30)</span></th>
                    <td><input type="text" id="groups_name" name="groups_name" class="f130P wdtL" maxlength=30
                            style="ime-mode: active;" required placeholder="" value="<?php echo $groups_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <button type=submit name="groupEdit" class="sbmt f110P">登録</button>
                    </td>
                </tr>
            </table>

        </form>

        <?php if(!empty($gSeq)){ ?>
        <form action="groupEdit.php" method="POST" onsubmit="return delcheck()">

            <input type="hidden" name="gSeq" value="<?php echo $gSeq; ?>">

            <table class="del">
                <tr>
                    <td><button type=submit name="groupDel" class="del f110P">このグループを削除する</button></td>
                </tr>
            </table>

        </form>
        <?php } ?>
    </div>
</body>

</html>