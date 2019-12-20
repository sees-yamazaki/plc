		<!-- Header -->
		<header id="header">
		    <a href="javascript:void(0)" class="logo"><strong>PointSystem</strong> by SEES</a>
		    <nav>
		        <a href="#menu">Menu</a>
		    </nav>
		</header>

		<!-- Nav -->
		<nav id="menu">
		    <?php echo $_SESSION[$ini['sysname']."NAME"].でログイン中 ?><br>
		    <ul class="links">
		        <li><a href="home.php">ホーム</a></li>
		        <li><a href="pointentry.php">ポイント登録</a></li>
		        <li><a href="pwchange.php">パスワード変更</a></li>
		        <li><a href="logoff.php">ログオフ</a></li>
		    </ul>
		</nav>