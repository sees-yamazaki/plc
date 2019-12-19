<?php

// セッション開始
session_start();

$ini = $_SESSION['INI'];

// ログイン状態チェック
if (!isset($_SESSION[$ini['sysname']."SEQ"])) {
    header("Location: logoff.php");
    exit;
}

// エラーメッセージの初期化
$errorMessage = "";


    require_once './db/members.php';
    $member = new cls_members();

    try {
		$member->m_id = strtotime("now");
		$member->m_pw = "999";
        $member->m_name = $_POST['m_name'];
        $member->m_mail = $_POST['m_mail'];
        $member->m_post = $_POST['m_post'];
        $member->m_address1 = $_POST['m_address1'];
        $member->m_address2 = $_POST['m_address2'];
		$member->m_tel = $_POST['m_tel'];
        
        if (isset($_POST['mmbrEdit'])) {

			$cnt = checkMemberByMail($member->m_mail);

			if($cnt==0){
                $errorMessage = insertMember($member);
			} else {
				$errorMessage = 'このメールアドレスはすでに登録されています。';
            }
            
            if (empty($errorMessage)) {
				var_dump($member);
                //header("Location: ./membershiped.php");
            }
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (strcmp("1", $ini['debug'])==0) {
            echo $e->getMessage();
        }
    }

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


    <?php include('./menu.php'); ?>


    <?php if(!empty($errorMessage)){ ?>
    <section id="banner2">
        <div class="inner">
            <h3><?php echo $errorMessage; ?></h3>
        </div>
    </section>
    <?php } ?>


    <section id="banner">
        <div class="inner">
            <h1>ポイント登録</h1>
            <form action="membershipe.php" method="POST" name="editFrm">
                <div class="">
                    １２桁のポイントを入力してください
                    <input type="text" name="up_point" id="up_point" value="<?php echo $member->m_name ?>"
                        placeholder="name" />
                </div><br>
                <ul class="actions">
                    <li><a href="javascript:editFrm.submit()" class="button alt scrolly big">登録する</a></li>
                </ul>

            </form>

        </div>
    </section>

    <?php include('./footer.php'); ?>


</body>

</html>