<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');


    $mSeq = $_POST['mSeq'];

    require './db/meetings.php';
    $meeting = new cls_meetings();

    require './db/users.php';
    $users = getUsers();




    try {

        $meeting->meet_seq = $_POST['mSeq'];
        $meeting->meet_date = $_POST['meet_date'];
        $meeting->meet_title = $_POST['meet_title'];
        $meeting->gSeqs =  $_POST['gSeq'];
        
        if(isset($_POST['meetAttend'])){

            $attends =  $_POST['attend'];
            foreach($attends as $attend){
                $list = explode("_",$attend);
                $member = new cls_members();
                $member->mm_seq = $list[0];
                if($list[2]=="MST"){
                    $member->mm_status = 0;
                    $member->users_seq = 0;
                } else if($list[2]=="SSK"){
                    $member->mm_status = 1;
                    $member->users_seq = $list[1];
                } else if($list[2]=="KSK"){
                    $member->mm_status = 2;
                    $member->users_seq = 0;
                }else{
                    if($list[1]==$list[2]){
                        $member->mm_status = 1;
                        $member->users_seq = $list[1];
                        }else{
                        $member->mm_status = 3;
                        $member->users_seq = $list[2];
                    }

                }

                updateMember($member);


            }
            
            if(empty($errorMessage)){
                header("Location: ./home.php");
            }

        }else{
            
            $meeting = getMeeting($mSeq);
            $vMeetings = getMeetingView($meeting->meet_seq);

        }


    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

    require './db/groups.php';
    $groups = array();
    $groups = getGroups();
    
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
            <button type="button" onclick="location.href='home.php'" class="back">戻る</button>
            <span class="err"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></span>
        </div><br>

        <form action="" method="POST" onsubmit="return addcheck()">

            <input type="hidden" name="mSeq" value="<?php echo $mSeq; ?>">

            
            <table class="edit">
                <tr>
                    <th>開催日</th>
                    <td><?php echo $meeting->meet_date; ?></td>
                </tr>
                <tr>
                    <th>会議名</th>
                    <td><?php echo $meeting->meet_title; ?></td>
                </tr>
                <?php foreach ($vMeetings as $vMeeting) { ?>
                    <tr>
                    <th><?php echo $vMeeting->groups_name; ?></th>
                    <td>
                    <?php 
                    $ss0 = "";
                    $ss1 = "";
                    $ss2 = "";
                    if($vMeeting->mm_status==1){
                        $ss1 = " selected";
                    }else if($vMeeting->mm_status==2){
                        $ss2 = " selected";
                    }else{
                        $ss0 = " selected";
                    }
                    ?>

                    <select name="attend[]" class="f110P" require>
                        <option value="<?php echo $vMeeting->mm_seq; ?>_<?php echo $vMeeting->mngr_seq; ?>_MST" <?php echo $ss0; ?>>未選択</option>
                        <option value="<?php echo $vMeeting->mm_seq; ?>_<?php echo $vMeeting->mngr_seq; ?>_SSK" <?php echo $ss1; ?>>出席</option>
                        <option value="<?php echo $vMeeting->mm_seq; ?>_<?php echo $vMeeting->mngr_seq; ?>_KSK" <?php echo $ss2; ?>>欠席</option>
                        <option value="">----------------------</option>
                        <option value="">代理出席の場合は以下から選択</option>
                        <option value="">----------------------</option>
                        <?php
                        foreach ($users as $user) {
                            if($vMeeting->mm_status=="3" && $vMeeting->users_seq==$user->users_seq){
                                echo "<option value='".$vMeeting->mm_seq."_".$vMeeting->mngr_seq."_".$user->users_seq."' selected>".$user->users_name."</option>";
                            }else{
                                echo "<option value='".$vMeeting->mm_seq."_".$vMeeting->mngr_seq."_".$user->users_seq."'>".$user->users_name."</option>";
                            }
                        }
                        ?>

                    </select>
                    </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <button type=submit name="meetAttend" class="sbmt f110P">登録</button>
                    </td>
                </tr>
            </table>

        </form>

    </div>
</body>

</html>