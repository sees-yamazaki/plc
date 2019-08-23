<div id="menu-container">
    <table border="0" width="100%">
        <tr>
            <td width="40px">
                <div id="menu-wrapper">
                    <div id="hamburger-menu"><span></span><span></span><span></span></div>
                    <!-- hamburger-menu -->
                </div>
            </td>
            <td><img src="img/logogrey.gif" height="35"> </td>
            <td style="text-align: center;">ログイン：<?php echo $_SESSION["NAME"] ?>　<button type="button" onclick="logout()">ログアウト</button></td>
        </tr>
    </table>
    <!-- menu-wrapper -->
    <ul class="menu-list accordion">
        <li id="nav1" class="toggle accordion-toggle">
            <span class="icon-plus"></span>
            <a class="menu-link" href="#">社員情報</a>
        </li>
        <!-- accordion-toggle -->
        <ul class="menu-submenu accordion-content">
            <li><a class="head" href="user.php">社員一覧</a></li>
            <li><a class="head" href="#" style="color:white;">.</a></li>
            <li><a class="head" href="schedule.php">勤務状況一覧</a></li>
        </ul>
        <!-- menu-submenu accordon-content-->
        <li id="nav2" class="toggle accordion-toggle">
            <span class="icon-plus"></span>
            <a class="menu-link" href="#">勤怠</a>
        </li>
        <!-- accordion-toggle -->
        <ul class="menu-submenu accordion-content">
            <li><a class="head" href="#">シフト管理</a></li>
            <li><a class="head" href="#" style="color:white;">.</a></li>
            <li><a class="head" href="#">勤務表管理</a></li>
        </ul>
        <!-- menu-submenu accordon-content-->
        <li id="nav3" class="toggle accordion-toggle">
            <a class="menu-link" href="#">その他</a>
        </li>
        <ul class="menu-submenu accordion-content">
            <li><a class="head" href="logout.php">ログアウト</a></li>
        </ul>

        <!-- menu-submenu accordon-content-->
    </ul>
    <!-- menu-list accordion-->
</div>
<!-- menu-container -->
