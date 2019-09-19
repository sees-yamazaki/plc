<div id="menu-container">
    <table border="0" width="100%">
        <tr>
            <td width="40px">
                <div id="menu-wrapper">
                    <div id="hamburger-menu"><span></span><span></span><span></span></div>
                    <!-- hamburger-menu -->
                </div>
            </td>
            <td><a class="head" href="home.php"><img src="../img/logogrey.gif" height="35"></a> </td>
            <td style="text-align: right;">ログイン：<?php echo $_SESSION["NAME"] ?>　<button type="button" onclick="logout()">ログアウト</button></td>
        </tr>
    </table>
    <!-- menu-wrapper -->
    <ul class="menu-list accordion">
        
        <li id="nav1" class="toggle accordion-toggle">
            <span class="icon-plus"></span>
            <a class="menu-link" href="#">派遣管理</a>
        </li>
        <!-- accordion-toggle -->
        <ul class="menu-submenu accordion-content">
            <li><a class="head" href="employeeList.php">派遣社員・正社員情報一覧</a></li>
            <li><a class="head" href="#" style="color:white;">.</a></li>
            <li><a class="head" href="employeeWork.php">勤務状況一覧</a></li>
            <li><a class="head" href="#" style="color:white;">.</a></li>
            <li><a class="head" href="employeePW.php?side=99">パスワードの初期化</a></li>
        </ul>

        
        <li id="nav1" class="toggle accordion-toggle">
            <span class="icon-plus"></span>
            <a class="menu-link" href="#">社員情報</a>
        </li>
        <!-- accordion-toggle -->
        <ul class="menu-submenu accordion-content">
            <li><a class="head" href="userList.php">社員一覧</a></li>
            <li><a class="head" href="#" style="color:white;">.</a></li>
            <li><a class="head" href="employeeAuth.php">承認待ち一覧</a></li>
            <li><a class="head" href="#" style="color:white;">.</a></li>
            <li><a class="head" href="payList.php">給与一覧</a></li>
            <li><a class="head" href="#" style="color:white;">.</a></li>
            <li><a class="head" href="salesList.php">売上一覧</a></li>
            <li><a class="head" href="#" style="color:white;">.</a></li>
            <li><a class="head" href="employeeAlert.php">アラート一覧</a></li>
            <li><a class="head" href="#" style="color:white;">.</a></li>
            <li><a class="head" href="employeePW.php?side=0">パスワードの初期化</a></li>
        </ul>
        <!-- menu-submenu accordon-content-->
        <li id="nav2" class="toggle accordion-toggle">
            <span class="icon-plus"></span>
            <a class="menu-link" href="#">クライアント・案件</a>
        </li>
        <!-- accordion-toggle -->
        <ul class="menu-submenu accordion-content">
            <li><a class="head" href="clientList.php">クライアント管理</a></li>
            <li><a class="head" href="#" style="color:white;">.</a></li>
            <li><a class="head" href="jobList.php">案件管理</a></li>
        </ul>
        <!-- menu-submenu accordon-content-->
        <li id="nav3" class="toggle accordion-toggle">
            <a class="menu-link" href="#">その他</a>
        </li>
        <ul class="menu-submenu accordion-content">
            <li><a class="head" href="userPw.php">パスワード変更</a></li>
            <li><a class="head" href="#" style="color:white;">.</a></li>
            <li><a class="head" href="information.php">インフォメーション</a></li>
            <li><a class="head" href="#" style="color:white;">.</a></li>
            <li><a class="head" href="groupList.php">グループ編集</a></li>
            <li><a class="head" href="#" style="color:white;">.</a></li>
            <li><a class="head" href="system.php">システム情報</a></li>
            <li><a class="head" href="#" style="color:white;">.</a></li>
            <li><a class="head" href="logout.php">ログアウト</a></li>
        </ul>

        <!-- menu-submenu accordon-content-->
    </ul>
    <!-- menu-list accordion-->
</div>
<!-- menu-container -->
