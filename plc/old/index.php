<?php
require 'password.php';   // password_verfy()はphp 5.5.0以降の関数のため、バージョンが古くて使えない場合に使用

// セッション開始
session_start();

$ini = parse_ini_file('./common.ini', FALSE);

// エラーメッセージの初期化
$errorMessage = "";

// ログインボタンが押された場合
if (isset($_POST["login"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["userid"])) {  // emptyは値が空のとき
        $errorMessage = 'ユーザーIDが未入力です。';
    } else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    }

    if (!empty($_POST["userid"]) && !empty($_POST["password"])) {
        // 入力したユーザIDを格納
        $userid = $_POST["userid"];

        // 3. エラー処理
        try {

            require_once 'dns.php';

            $stmt = $pdo->prepare('SELECT * FROM user WHERE user_id = ?');

            $stmt->execute(array($userid));

            $password = $_POST["password"];

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                //if (password_verify($password, $row['user_pass'])) {
                if (strcmp($password, $row['user_pass'])==0) {
//                    session_regenerate_id(true);

                    // 入力したIDのユーザー名を取得
                    $id = $row['user_seq'];
                    $sql = "SELECT * FROM user WHERE user_seq = $id";  //入力したIDからユーザー名を取得
                    $stmt = $pdo->query($sql);

                    foreach ($stmt as $row) {
                        $row['user_name'];  // ユーザー名
                    }

                    $_SESSION["NAME"] = $row['user_name'];
                    $_SESSION["SEQ"] = $row['user_seq'];
                    $_SESSION["ID"] = $row['user_id'];
                    $_SESSION["LEVEL"] = $row['user_level'];
                    if($row['user_level']=="3"){
                        header("Location: staff.php");
                    }else{
                        header("Location: home.php");
                    }
                    exit();  // 処理終了
                } else {
                    // 認証失敗
                    $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
                }
            } else {
                // 4. 認証成功なら、セッションIDを新規に発行する
                // 該当データなし
                $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
            // $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
            echo $e->getMessage();
        }
    }
}
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>ログイン</title>
    <link rel="stylesheet" href="css/login.css" />
</head>

<body>
    <div class="pen-title">
        <img src="img/logogrey.gif" height="40"><br><br>
        <h1>ログイン画面</h1>
    </div>
    <div class="module form-module">
        <div class=""></div>
        <div class="form">


            <form id="loginForm" name="loginForm" action="" method="POST">
                <div>
                    <font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font>
                </div>
                <input type="text" id="userid" class="txt" name="userid" placeholder="ユーザーIDを入力" value="<?php if (!empty($_POST["userid"])) {echo htmlspecialchars($_POST["userid"], ENT_QUOTES);} ?>">
                <br>
                <input type="password" id="password" class="txt" name="password" value="" placeholder="パスワードを入力">
                <br>
                <button type="submit" id="login2" name="login">ログイン</button>
            </form>

        </div>
    </div>


</body>

</html>
