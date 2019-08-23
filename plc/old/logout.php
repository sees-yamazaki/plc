<?php
session_start();

if (isset($_SESSION["NAME"])) {
    $errorMessage = "ログアウトしました。";
} else {
    $errorMessage = "セッションがタイムアウトしました。";
}

// セッションの変数のクリア
$_SESSION = array();

// セッションクリア
@session_destroy();
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>ログアウト</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="pen-title">
        <img src="img/logogrey.gif" height="40"><br><br>
        <h1>ログアウト画面</h1>
    </div>
    <div class="module form-module">
        <div class=""></div>
        <div class="form">

            <form id="loginForm" name="loginForm" action="" method="POST">
                <div>
                    <font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font>
                </div><br>
                <button type="button" onclick="location.href='index.php'">ログイン画面に戻る</button>
            </form>

        </div>
    </div>


</body>

</html>
