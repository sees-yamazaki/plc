<?php

// セッション開始
session_start();


?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>DIAGNOSE</title>
    <link rel="stylesheet" href="../css/main.css" />
</head>

<body>

    <?php include('./menu.php'); ?>

    <div id="content">

        <div >
            <span class="err">ご確認ください</span><br>
            設問は５０問あります。　時間をかけずに直感で答えてください。
        </div>

        <div style="margin-top:30px;">
            <input class="answer" type="button" onclick="location.href='answering1.php'" value="回答する">
        </div>

    </div>

</body>

</html>