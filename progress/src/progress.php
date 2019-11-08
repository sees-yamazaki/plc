<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

 
// 全てのユーザを取得
require_once './db/systems.php';
$systems = array();
$systems = getSystems();

require_once './db/businesses.php';
require_once './db/works.php';
require_once './db/tasks.php';

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>PROGRESS</title>
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/progress.css" />
    <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
function show_hide_row(row)
{
    var elements = document.getElementsByName(row);
    for(var i=0;i<elements.length;i++){
        $(elements[i]).toggle();
    }
 
}
</script>
</head>

<body>

    <?php include('./menu.php'); ?>

    <div id="content">

        <div class="nav">
            <button type="button" onclick="location.href='systems_list.php'" class="sysL">Add System</button>
            <span class="err"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></span>
        </div><br>


        <table class="prg">
            <thead>
                <tr>
                    <th class="sys">S<span class="sml">ys</span></th>
                    <th class="bus">B<span class="sml">us</span></th>
                    <th class="wk">W<span class="sml">ork</span></th>
                    <th class="tsk">T<span class="sml">ask</span></th>
                    <th class="kiden">機1</th>
                    <th class="kiden">機2</th>
                    <th class="its">IT1</th>
                    <th class="its">IT2</th>
                    <th class="its">IT3</th>
                    <th class="its">IT4</th>
                    <th class="its">IT5</th>
                    <th class="its">IT6</th>
                    <th class="its">IT7</th>
                    <th class="its">IT8</th>
                    <th class="its">IT9</th>
                    <th class="its">IT10</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($systems as $system) { ?>
                <tr>
                    <td colspan=4 class="sys">
                        <form action='businesses_list.php' method='POST'>
                            <?php echo $system->sys_name; ?>
                            <input type='hidden' name='sSeq' value='<?php echo $system->sys_seq; ?>'>
                            <button type="submit" class="sys add">[ Add Business ]</button>
                        </form>
                    </td>
                    <td colspan=12></td>
                </tr>

                <?php $businesses = getBusinesses($system->sys_seq); ?>
                <?php foreach ($businesses as $business) { ?>
                <tr>
                    <td class="sys"></td>
                    <td class="bus" colspan=3>
                        <form action='works_list.php' method='POST'>
                            <?php echo $business->bus_name; ?>
                            <input type='hidden' name='sSeq' value='<?php echo $business->sys_seq; ?>'>
                            <input type='hidden' name='bSeq' value='<?php echo $business->bus_seq; ?>'>
                            <button type="submit" class="bus add">[ Add Work ]</button>
                        </form>
                    </td>
                    <td colspan=12></td>
                </tr>


                <?php $works = getWorks($business->bus_seq); ?>
                <?php foreach ($works as $work) { ?>
                <tr onclick="show_hide_row('hidden_row<?php echo $work->wk_seq; ?>');">
                    <td class="sys"></td>
                    <td class="bus"></td>
                    <td class="wk" colspan=2>
                        <form action='tasks_list.php' method='POST'>
                            <?php echo $work->wk_name; ?>
                            <input type='hidden' name='sSeq' value='<?php echo $work->sys_seq; ?>'>
                            <input type='hidden' name='bSeq' value='<?php echo $work->bus_seq; ?>'>
                            <input type='hidden' name='wSeq' value='<?php echo $work->wk_seq; ?>'>
                            <button type="submit" class="wk add">[ Add Task ]</button>
                        </form>
                    </td>
                    <td colspan=12 class="sml">
                        <span class="lvl_<?php echo $work->lv; ?>"><?php echo $work->lv; ?> </span>
                        <?php echo $work->wk_note; ?>
                    </td>
                </tr>


                <?php $tasks = getTasks($work->wk_seq); ?>
                <?php foreach ($tasks as $task) { ?>
                <tr name="hidden_row<?php echo $work->wk_seq; ?>">
                    <td class="sys"></td>
                    <td class="bus"></td>
                    <td class="wk"></td>
                    <td class="tsk" colspan=1>
                        <form action='tasks_check.php' method='POST'>
                            <?php echo $task->tsk_name; ?>
                            <input type='hidden' name='sSeq' value='<?php echo $task->sys_seq; ?>'>
                            <input type='hidden' name='bSeq' value='<?php echo $task->bus_seq; ?>'>
                            <input type='hidden' name='wSeq' value='<?php echo $task->wk_seq; ?>'>
                            <input type='hidden' name='tSeq' value='<?php echo $task->tsk_seq; ?>'>
                            <button type="submit" class="tsk add">[ Status ]</button>
                        </form>
                    </td>

                    <?php if($task->tsk_k1==0){ ?>
                        <td class="undone">未済</td>
                    <?php }else{ ?>
                        <td class="done">済</td>
                    <?php } ?>

                    <?php if($task->tsk_k2==0){ ?>
                        <td class="undone">未済</td>
                    <?php }else{ ?>
                        <td class="done">済</td>
                    <?php } ?>

                    <?php if($task->tsk_i1==0){ ?>
                        <td class="undone">未済</td>
                    <?php }else{ ?>
                        <td class="done">済</td>
                    <?php } ?>

                    <?php if($task->tsk_i2==0){ ?>
                        <td class="undone">未済</td>
                    <?php }else{ ?>
                        <td class="done">済</td>
                    <?php } ?>

                    <?php if($task->tsk_i3==0){ ?>
                        <td class="undone">未済</td>
                    <?php }else{ ?>
                        <td class="done">済</td>
                    <?php } ?>

                    <?php if($task->tsk_i4==0){ ?>
                        <td class="undone">未済</td>
                    <?php }else{ ?>
                        <td class="done">済</td>
                    <?php } ?>

                    <?php if($task->tsk_i5==0){ ?>
                        <td class="undone">未済</td>
                    <?php }else{ ?>
                        <td class="done">済</td>
                    <?php } ?>

                    <?php if($task->tsk_i6==0){ ?>
                        <td class="undone">未済</td>
                    <?php }else{ ?>
                        <td class="done">済</td>
                    <?php } ?>

                    <?php if($task->tsk_i7==0){ ?>
                        <td class="undone">未済</td>
                    <?php }else{ ?>
                        <td class="done">済</td>
                    <?php } ?>

                    <?php if($task->tsk_i8==0){ ?>
                        <td class="undone">未済</td>
                    <?php }else{ ?>
                        <td class="done">済</td>
                    <?php } ?>

                    <?php if($task->tsk_i9==0){ ?>
                        <td class="undone">未済</td>
                    <?php }else{ ?>
                        <td class="done">済</td>
                    <?php } ?>

                    <?php if($task->tsk_i10==0){ ?>
                        <td class="undone">未済</td>
                    <?php }else{ ?>
                        <td class="done">済</td>
                    <?php } ?>

                </tr>

                <?php } ?>

                <?php } ?>

                <?php } ?>

                <?php } ?>

            </tbody>
        </table>


    </div>
</body>

</html>