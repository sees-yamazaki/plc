<div class="menu">
    <ul class="topnav">
        <li><a class="active" href="cal_month.php">Calendar</a></li>
        <?php if($_SESSION['LEVEL']==1){ ?>
        <li><a href="groupList.php">Group</a></li>
        <li><a href="user_list.php">User</a></li>
        <li><a href="room_list.php">Room</a></li>
        <?php } ?>
        <li class="right"><a href="logoff.php">LogOff</a></li>
    </ul>
</div>