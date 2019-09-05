<?php
session_start();

 
// 全てのグループを取得
require_once './db/users.php';
$users = array();
$users = getUsers();


$html = "";
$js = "";
foreach ($groups as $group) {
    $html .= "<option name='gSeq' value='".$group->groups_seq."'>".$group->groups_name."</option>";
    if($group->parent_groups_seq=="0"){
        $js .= "[{v: '".$group->groups_seq."', f: '".$group->groups_name."'}, null, ''],";
    }else{
        $js .= "[{v: '".$group->groups_seq."', f: '".$group->groups_name."'}, '".$group->parent_groups_seq."', ''],";
    }
}
$js = substr($js ,0,-1);


?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>組織図</title>
    <link rel="stylesheet" href="../css/main.css" />
</head>

<body>

    <?php include('./menu.php'); ?>

    <div id="content">
        <form action="groupEdit.php" method="POST">
            <select name="gSeq" class="f130P">
                <option value="0">新規作成</option>
                <?php echo $html; ?>
            </select>
            <input type="image" width=25px src="../img/pen.svg">
            <br>
        </form>


        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript">
        google.load('visualization', '1', {
            packages: ['orgchart']
        });
        google.setOnLoadCallback(
            function() {
                // Create and populate the data table.
                var data = google.visualization.arrayToDataTable([
                    ['TITLE', 'TITLE', 'TIP'],
                    <?php echo $js; ?>
                ]);

                // Create and draw the visualization.
                new google.visualization.OrgChart(
                    document.getElementById('group_map')).
                draw(data, {
                    allowHtml: true
                });
            }
        );
        </script>
        <p class="group">グループ構成図</p>
        <div id="group_map"></div>
    </div>
</body>

</html>