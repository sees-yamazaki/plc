<?php

// セッション開始
session_start();
require('session.php');
require('../psys/logging.php');

// エラーメッセージの初期化
$errorMessage = "";

?>
<!DOCTYPE HTML>
<html lang="ja">
	<head>
    <title><?php echo getSsnMyname(); ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="asset/css/main.css" />
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<a href="javascript:void(0)" class="logo"><strong><?php echo getSsnMyname(); ?></strong> by itty</a>
			</header>


		<!-- Banner -->
			<section id="banner">
				<div class="inner">
                <h1>会員登録完了</h1>
					<h2><br><s>メールアドレスにPWを送信しました。</s><br>テスト中のためメールは送信しません。<br>パスワードは「999」です。</h2>
					<ul class="actions">
						<li><a href="index.php" class="button alt scrolly big">ログインする</a></li>
					</ul>

				</div>
            </section>
            
			<section id="banner">
				<div class="inner">
					<h1><br>&nbsp;<br>&nbsp;<br>&nbsp;</h1>
				</div>
			</section>


		<!-- Footer -->
			<footer id="footer">
				<div class="copyright">
					&copy; itty
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script src="asset/js/main.js"></script>

	</body>
</html>