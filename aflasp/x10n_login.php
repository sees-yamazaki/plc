<?php
include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';
include 'x10c/db/x10.php';

// セッション再開
session_start();


// エラーメッセージの初期化
$errorMessage = '';

// ログインボタンが押された場合
if (isset($_POST['login'])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST['m_mail'])) {  // emptyは値が空のとき
        $errorMessage = 'メールアドレスが未入力です。';
    } elseif (empty($_POST['m_pw'])) {
        $errorMessage = 'パスワードが未入力です。';
    } else {

        // 入力したユーザIDを格納
        $m_mail = $_POST['m_mail'];
        $m_pw = $_POST['m_pw'];
        $nId = doLogin($m_mail, $m_pw);
        if (!empty($nId)) {
            $_SESSION[ $SESSION_NAME ] = $nId;
            header('Location: x10n_home.php');
        }else{
            $errorMessage = 'ログインできませんでした。';
        }

    }
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo ""; ?></title>
</head>

<body>


    <h3>ログイン</h3>
    <?php if (!empty($errorMessage)) { ?>
    <span class="err"><?php echo $errorMessage; ?></span>
    <?php } ?>
    <div name="editFrm">
        <form action="" method="POST" name="frm">
            <input type="text" name="m_mail" id="m_mail" value="<?php echo $m_mail; ?>" required /><br><br>
            <input type="password" name="m_pw" id="m_pw" required><br><br>
            <input type="button" class="rButton w80p btn-blue" onclick="javascript:frm.submit()" value="ログイン" />
            <input type="hidden" name="login" id="login" value="1" />
        </form>
    </div>

</body>

</html>