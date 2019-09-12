<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

 
// 全てのグループを取得
require_once './db/users.php';
$users = array();
$users = getUsers();


$html = "";
foreach ($users as $user) {
        
        $html .= '<tr><form id="useredit" action="user_edit.php" method="POST">';
        $html .= "<input type='hidden' name='uSeq' value='".$user->users_seq."'>";
        $html .= "<input type='hidden' name='users_name' value='".$user->users_name."'>";
        $html .= "<input type='hidden' name='groups_seq' value='".$user->groups_seq."'>";
        $html .= "<td width='100px'>".$user->users_id."</td>";
        $html .= "<td width='300px'>".$user->users_name."</td>";
        $tip = "";
        foreach( $user->user_group as $ug ){
            $tip .= $ug->groups_name.", ";
        }
        $tip = substr($tip,0,-2);
        $html .= "<td width='300px'>".$tip."</td>";
        if ($user->users_level=="1"){
            $lvl = "管理者";
        } else {
            $lvl = "一般";
        } 
        $html .= "<td width='100px'>".$lvl."</td>";
        $html .= "<td width='180px'><button type='submit' name='edit'>編集</button></td>";
        $html .= "</form></tr>";
            
}
$js = substr($js ,0,-1);


?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>ユーザ一覧</title>
    <link rel="stylesheet" href="../css/main.css" />
</head>

<body>

    <?php include('./menu.php'); ?>

    <div id="content">

        <table class="vw">
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>グループ</th>
                <th>権限</th>
                <th class="add"><button type='button' onclick="location.href='user_edit.php'">新規登録</button></th>
            </tr>
            <?php echo $html; ?>
        </table>

    </div>
</body>

</html>