<?php

// セッション開始
session_start();

$ini = parse_ini_file('./common.ini', FALSE);
$_SESSION["INI"] = $ini;

$_SESSION["MY_ROOT"] = $_SERVER['DOCUMENT_ROOT'].'/sche';

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
        $userpw = $_POST["password"];


        try {

            require_once './src/db/users.php';
            $users = new cls_users();
            $users = loginUsers($userid,$userpw);

            if(empty($users->users_id)){
                $errorMessage = 'ログインできませんでした。';
            }else{
                $errorMessage = 'ログインできました。';
                $_SESSION["SEQ"] = $users->users_seq;
                $_SESSION["ID"] = $users->users_id;
                $_SESSION["NAME"] = $users->users_name;

                header("Location: ./src/cal_month.php");
            }


        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
            // $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
            echo $e->getMessage();
        }
/*
 
        // 3. エラー処理
        try {

            require_once 'src/dns.php';
            
            $stmt = $pdo->prepare('SELECT * FROM employee WHERE employee_id = ?');
            $stmt->execute(array($userid));
            $password = $_POST["password"];

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                //if (password_verify($password, $row['user_pass'])) {
                if (strcmp($password, $row['employee_pw'])==0) {

                    // login-log
                    $stmt2 = $pdo->prepare($sql_histry);
                    $stmt2->execute(array( $userid, $password,0, $sv_addr, $sv_referer, $sv_agent));

                    // 入力したIDのユーザー名を取得
                    $id = $row['employee_seq'];
                    $sql = "SELECT * FROM employee WHERE user_seq = $id";  //入力したIDからユーザー名を取得
                    $stmt = $pdo->query($sql);

                    $_SESSION["NAME"] = $row['name'];
                    $_SESSION["SEQ"] = $row['employee_seq'];
                    $_SESSION["ID"] = $row['employee_id'];
                    $_SESSION["LEVEL"] = $row['employee_level'];
                    if($row['employee_level']=="99"){
                        $_SESSION["MODE"] = "TEMP";
                        $_SESSION["alertTime"] = $row['alert_time'];
                        header("Location: src/staff.php");
                    }else{
                        header("Location: src/home.php");
                    }
                    exit();  // 処理終了
                } else {

                    // login-log
                    $stmt2 = $pdo->prepare($sql_histry);
                    $stmt2->execute(array( $userid, $password,1, $sv_addr, $sv_referer, $sv_agent));

                    // 認証失敗
                    $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
                }
            } else {
                // login-log
                $stmt2 = $pdo->prepare($sql_histry);
                $stmt2->execute(array( $userid, $password,1, $sv_addr, $sv_referer, $sv_agent));

                $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
            // $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
            echo $e->getMessage();
        }
    */
    }
}

?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>ログイン</title>
    <link rel="stylesheet" href="./css/main.css" />
    <link rel="stylesheet" href="./css/login.css" />
</head>

<body>
<?php //print_r($_POST); ?>
    <div class="pen-title">
        <img src="img/logo.png" height="40"><br><br>
        <h1>ログイン画面</h1>
    </div>
    <div class="module form-module">
        <div class=""></div>
        <div class="form">


            <form id="loginForm" name="loginForm" action="" method="POST">
                <div>
                    <span class="err"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></span>
                </div>
                <input type="text" id="userid" class="txt" name="userid" placeholder="ユーザーIDを入力" value="<?php $_POST["userid"]; ?>">
                <br>
                <input type="password" id="password" class="txt" name="password" value="" placeholder="パスワードを入力">
                <br>
                <button type="submit" id="login2" name="login">ログイン</button>
            </form>

        </div>
    </div>


</body>

</html>
