<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

 
// 全てのグループを取得
require_once './db/rooms.php';
$rooms = array();
$rooms = getRooms();


$html = "";
foreach ($rooms as $room) {
        
        $html .= '<tr><form id="roomedit" action="room_edit.php" method="POST">';
        $html .= "<input type='hidden' name='rSeq' value='".$room->rooms_seq."'>";
        $html .= "<td>".$room->rooms_name."</td>";
        $html .= "<td><button type='submit' name='edit'>編集</button></td>";
        $html .= "</form></tr>";
            
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>会議室一覧</title>
    <link rel="stylesheet" href="../css/main.css" />
</head>

<body>

    <?php include('./menu.php'); ?>

    <div id="content">

        <table class="vw">
            <tr>
                <th width='300px'>会議室名</th>
                <th width='180px' class="add"><button type='button' onclick="location.href='room_edit.php'">新規登録</button></th>
            </tr>
            <?php echo $html; ?>
        </table>

    </div>
</body>

</html>