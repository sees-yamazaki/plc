<?php
session_start();

    // ログイン状態チェック
    if (!isset($_SESSION["NAME"])) {
        header("Location: logoff.php");
        exit;
    }

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');


    $uSeq = $_POST['uSeq'];

    require './db/users.php';
    $user = new cls_users();

    try {
        $user->users_seq = $_POST['uSeq'];
        $user->users_id = $_POST['users_id'];
        $user->users_name = $_POST['users_name'];
        
        if (isset($_POST['userEdit'])) {
            $tmp = getUserByID($user);

            if (empty($tmp->users_seq)) {
                if (!empty($uSeq)) {
                    updateUser($user);
                } else {
                    insertUser($user);
                }
            } else {
                $errorMessage = 'このIDはすでに使用されています';
            }
            
            
            if (empty($errorMessage)) {
                header("Location: ./users_list.php");
            }
        } elseif (isset($_POST['myPw'])) {

            //パスワードをIDと同値で初期化する
            $user = getUser($uSeq);
            $user->users_pw = $_POST['users_pw'];
            updateUserPW($user);

            header("Location: ./users_list.php");
        } elseif (isset($_POST['userPw'])) {

            //パスワードをIDと同値で初期化する
            $user = getUser($uSeq);
            $user->users_pw = $user->users_id ;
            updateUserPW($user);

            header("Location: ./users_list.php");
        } elseif (isset($_POST['userDel'])) {
            deleteUser($user);

            header("Location: ./users_list.php");
        } else {
            $user = getUser($uSeq);
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (strcmp("1", $ini['debug'])==0) {
            echo $e->getMessage();
        }
    }

    if ($user->users_level=="1") {
        $uLvl1 = " checked";
    } elseif ($user->users_level=="2") {
        $uLvl2 = " checked";
    } else {
        $uLvl3 = " checked";
    }

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>HearingSheet</title>
    <link rel="stylesheet" href="../css/main.css" />
    <script src="../js/main.js"></script>
</head>

<body>


    <form id="sakubun1" class="" action='users_list.php' method='POST'>
        <div class='menu no_print'>
            <ul class='topnav2'>
                <li><a id="back" href="#" onclick="back1();">戻る</a></li>
            </ul>
        </div>
    </form>

    <div id="content">

        <div>
            <span class="err"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></span>
        </div><br>

        <form action="users_edit.php" method="POST" onsubmit="return addcheck()">

            <input type="hidden" name="uSeq" value="<?php echo $uSeq; ?>">

            <table class="hs">
                <tr>
                    <th><span class="required">*</span>ID<span class="f50P"> (10)</span></th>
                    <td style="width:400px"><input type="text" name="users_id" class="f130P wdtL" maxlength=10
                            style="ime-mode: inactive;" required pattern="[0-9a-zA-Z]+" title="半角英数字"
                            placeholder="半角英数字" value="<?php echo $user->users_id; ?>" autocomplete="off">
                    </td>
                </tr>
                <tr>
                    <th><span class="required">*</span>名前<span class="f50P"> (30)</span></th>
                    <td><input type="text" name="users_name" class="f130P wdtLL" maxlength=30 style="ime-mode: active;"
                            required placeholder="" value="<?php echo $user->users_name; ?>" autocomplete="off">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <button type=submit name="userEdit" class="ntc2 f110P">登録</button>
                    </td>
                </tr>
            </table>

        </form>


        <?php if (!empty($uSeq)) { ?>

        <form action="users_edit.php" method="POST" onsubmit="return reMyPWcheck()">

            <input type="hidden" name="uSeq" value="<?php echo $uSeq; ?>">

            <?php if($uSeq == $_SESSION['SEQ']){ ?>
            <br><br><br>
            <table class="hs">
                <tr>
                    <th><span class="required">*</span>PW<span class="f50P"> (10)</span></th>
                    <td style="width:400px"><input type="password" name="users_pw" class="f130P wdtL" maxlength=10
                            style="ime-mode: inactive;" required pattern="[0-9a-zA-Z]+" title="半角英数字"
                            placeholder="半角英数字" value="<?php echo $user->users_pw; ?>" autocomplete="off">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <button type=submit name="myPw" class="ntc f110P">パスワードを変更する</button>
                    </td>
                </tr>
            </table>
            <?php }else{ ?>
            <table class="cntr">
                <tr>
                    <td><button type=submit name="userPw" class="ntc">パスワードを初期化する</button></td>
                </tr>
            </table>
            <?php } ?>

        </form>

        <?php if($uSeq <> $_SESSION['SEQ']){ ?>
        <form action="users_edit.php" method="POST" onsubmit="return delcheck()">

            <input type="hidden" name="uSeq" value="<?php echo $uSeq; ?>">

            <table class="cntr">
                <tr>
                    <td colspan=2><button type=submit name="userDel" class="del wdtLL">このユーザを削除する</button></td>
                </tr>
            </table>

        </form>
        <?php } ?>
        <?php } ?>
    </div>
</body>

</html>