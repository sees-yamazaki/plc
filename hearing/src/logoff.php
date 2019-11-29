<?php

// セッションの初期化
session_start();

// セッション変数を全て解除する
$_SESSION = array();

// セッションを破壊する
session_destroy();

?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>HearingSheet</title>
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/login.css" />
</head>

<body>

    <div class="pen-title">
        <br><br><img src="../img/logo2.png" width=200px><br><br>
    </div>
    <div class="module form-module">
        <div class=""></div>
        <div class="form">


                <div>
                    <span class="err">ログアウトしました。</span>
                </div>
                <br>
                <button type="button" onclick="location.href='../index.php'" class="back">ログインする</button>
        </div>
    </div>


</body>

</html>
