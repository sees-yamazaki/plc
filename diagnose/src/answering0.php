<?php

// セッション開始
session_start();

$uSeq = $_SESSION['SEQ'];
 
// 
require_once './db/accepting.php';
$acceptings = array();
$acceptings = getAcceptingQuesToday($uSeq);

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


        <table class="vw">
            <tr>
                <th style="width:300px;">アンケート名</th>
                <th style="width:100px;">開始日時</th>
                <th style="width:100px;">終了日時</th>
                <th style="width:100px;"></th>
            </tr>
            <?php foreach ($acceptings as $accepting) { ?>
                <tr>

                    <form  action='answering1.php' method='POST'>
                    <td><?php echo $accepting->aq_title; ?></td>
                    <td><?php echo $accepting->aq_start_time; ?></td>
                    <td><?php echo $accepting->aq_end_time; ?></td>
                    <?php if(empty($accepting->an_seq)){ ?>
                    <td><button type='submit' class="editS">回答する</button></td>
                    <?php }else{ ?>
                        <td>回答済</td>
                    <?php } ?>
                    <input type='hidden' name='aqSeq' value='<?php echo $accepting->aq_seq; ?>'>
                    <input type='hidden' name='queSeq' value='<?php echo $accepting->que_seq; ?>'>
                    </form>

                </tr>
            <?php } ?>
        </table>




    </div>

</body>

</html>