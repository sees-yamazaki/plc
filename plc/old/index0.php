<?php
require 'password.php';

// セッション開始
session_start();

$db['host'] = "localhost";  // DBサーバのURL
$db['user'] = "plcAdmin";  // ユーザー名
$db['pass'] = "plc2012";  // ユーザー名のパスワード
$db['dbname'] = "plc";  // データベース名

// エラーメッセージの初期化
$errorMessage = "";

// ログインボタンが押された場合
if (isset($_POST["login"])) {
    echo "AAAA";
    echo $_POST["password"];
    echo "BBB";
    
    // 1. ユーザIDの入力チェック
    if (empty($_POST["userid"])) {  // emptyは値が空のとき
        $errorMessage = 'ユーザーIDxが未入力です。';
    } else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    }

    if (!empty($_POST["userid"]) && !empty($_POST["password"])) {
        // 入力したユーザIDを格納
        $userid = $_POST["userid"];

        // 2. ユーザIDとパスワードが入力されていたら認証する
        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);

        // 3. エラー処理
        try {
            $pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

            $stmt = $pdo->prepare('SELECT * FROM userData WHERE name = ?');
            $stmt->execute(array($userid));

            $password = $_POST["password"];

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($password, $row['password'])) {
                    session_regenerate_id(true);

                    // 入力したIDのユーザー名を取得
                    $id = $row['id'];
                    $sql = "SELECT * FROM userData WHERE id = $id";  //入力したIDからユーザー名を取得
                    $stmt = $pdo->query($sql);
                    foreach ($stmt as $row) {
                        $row['name'];  // ユーザー名
                    }
                    $_SESSION["NAME"] = $row['name'];
                    header("Location: Main.php");  // メイン画面へ遷移
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
            // echo $e->getMessage();
        }
    }
}
?>
<html>
    <head>
            <meta charset="UTF-8">
            <title>ログイン</title>
<link rel="stylesheet" href="login.css" />
<script src="login.js"></script>
    </head>
<body>
  <div class="pen-title">
    <img src="logogrey.gif" height="40"><br><br>
    <h1>ログイン画面</h1>
  </div>
  <!-- Form Module-->
  <div class="module form-module">
    <div class="">
    </div>
    <div class="form">
        <div><font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
      <form id="loginForm" name="loginForm" action="" method="POST">
        <input type="text" class="txt" placeholder="ID" id="userid"/>
        <input type="password" class="txt" placeholder="Password" id="password"/>
        <p>
          <input type="checkbox" value="1"><label>ログイン情報を記憶する</label>
        </p>
          <button type="submit" id="login2" name="login">ログイン</button>
          <input type="submit" id="login" name="login" value="ログイン">
      </form>
    </div>
  </div>
</body>
</html>