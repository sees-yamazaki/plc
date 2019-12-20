<?php

// セッション開始
session_start();

$ini = parse_ini_file('./common.ini', false);
$_SESSION["INI"] = $ini;

// エラーメッセージの初期化
$errorMessage = "";

    require_once './db/members.php';
    $member = new cls_members();

	$member->m_id = strtotime("now");
	$member->m_pw = "999";
	$member->m_name = $_POST['m_name'];
	$member->m_mail = $_POST['m_mail'];
	$member->m_post = $_POST['m_post'];
	$member->m_address1 = $_POST['m_address1'];
	$member->m_address2 = $_POST['m_address2'];
	$member->m_tel = $_POST['m_tel'];

?>
<!DOCTYPE HTML>
<html lang="ja">
	<head>
    <title><?php echo $ini['sysname']; ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="asset/css/main.css" />
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<a href="javascript:void(0)" class="logo"><strong>PointSystem</strong> by SEES</a>
			</header>


		<!-- Banner -->
			<?php if(!empty($errorMessage)){ ?>
			<section id="banner2">
				<div class="inner">
					<h3><?php echo $errorMessage; ?></h3>
				</div>
			</section>
			<?php } ?>

			<section id="banner9">
        <div class="inner">
            <ul class="actions actions2">
                <li><a href="index.php" class="button alt scrolly big">戻る</a></li>
            </ul>
        </div>
    </section>

			<section id="banner">
				<div class="inner">
					<h1>会員情報</h1>
					<form action="membershipe.php" method="POST" name="editFrm">
                    <div class="">
                        お名前
                        <input type="text" name="m_name" id="m_name" value="<?php echo $member->m_name ?>" placeholder="name" />
                        MAIL
                        <input type="text" name="m_mail" id="m_mail" value="<?php echo $member->m_mail ?>" placeholder="e-mail" />
                        郵便番号
                        <input type="text" name="m_post" id="m_post" value="<?php echo $member->m_post ?>" placeholder="postcode" />
                        住所
						<input type="text" name="m_address1" id="m_address1" value="<?php echo $member->m_address1 ?>" placeholder="address" />
                        <input type="text" name="m_address2" id="m_address2" value="<?php echo $member->m_address2 ?>" placeholder="address" />
                        電話番号
						<input type="text" name="m_tel" id="m_tel" value="<?php echo $member->m_tel ?>" placeholder="tel" />
                    </div><br>
					<ul class="actions">
						<li><a href="javascript:editFrm.submit()" class="button alt scrolly big">登録する</a></li>
					</ul>

					</form>

				</div>
            </section>
            
			<section id="banner2">
				<div class="inner">
					<h1><a href="javascript:void(0)">個人情報など</a></h1>
				</div>
			</section>

            

		<!-- Footer -->
			<section id="geta"></section>
			<footer id="footer">
				<div class="copyright">
					&copy; SEES
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