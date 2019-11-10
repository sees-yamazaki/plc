<header id="header" class="headTitle">
    <button class="hiraku-open-btn" id="offcanvas-btn-left" data-toggle-offcanvas="#js-hiraku-offcanvas-1">
        <span class="hiraku-open-btn-line"></span>
    </button>
    <div class="headTitle">PLC 勤怠管理システム</div>
</header>
<div class="offcanvas-left">
    <table style="width:90%; background-color: #999; border-spacing: 0px 45px;">
        <tr>
            <td style="font-size:3em;"><?php echo $_SESSION['NAME'] ?></td>
        </tr>
        <tr>
            <td><a href="staff.php" class="btn-flat-simple">
                    <i class="fa fa-caret-right"></i> TOP
                </a></td>
        </tr>
        <tr>
            <td><a href="staffWork.php" class="btn-flat-simple">
                    <i class="fa fa-caret-right"></i> 出発・入店・退勤報告
                </a></td>
        </tr>
        <tr>
            <td><a href="staffCal.php" class="btn-flat-simple">
                    <i class="fa fa-caret-right"></i> 今月の稼働シフト
                </a></td>
        </tr>
        <tr>
            <td><a href="staffRec.php" class="btn-flat-simple">
                    <i class="fa fa-caret-right"></i> 翌月のシフト申請
                </a></td>
        </tr>
        <tr>
            <td><a href="staffPw.php" class="btn-flat-simple">
                    <i class="fa fa-caret-right"></i> パスワード変更
                </a></td>
        </tr>
        <tr>
            <td><a href="logout.php" class="btn-flat-simple">
                    <i class="fa fa-caret-right"></i> ログアウト
                </a></td>
        </tr>
    </table>
</div>
<script>
    $(".offcanvas-left").hiraku({
        btn: "#offcanvas-btn-left",
        direction: "left"
    });

</script>
