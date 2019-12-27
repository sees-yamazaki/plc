<?php

// セッション開始
session_start();
require('session.php');

// ログイン状態チェック
if (getSsnIsLogin()==false) {
    header("Location: logoff.php");
    exit;
}

// エラーメッセージの初期化
$errorMessage = "";


    require_once './db/serialcodes.php';
    $scode = new cls_serialcodes();

    try {
		$scode->sc_code = $_POST['sc_code'];
        
        if (isset($_POST['pointEntry'])) {

            $scode = getSerialCodeBySCode($scode->sc_code);

            
			if(!isset($scode->sc_seq)){
                $errorMessage = 'シリアルコードが確認できませんでした。入力内容を確認してください。';
			} else if(isset($scode->sc_point)){
                $errorMessage = 'このシリアルコードはすでに登録されています。';
			} else {
                $scode->sc_point = getSsn('POINT_ENTRY');
                $scode->m_seq = getSsn("SEQ");
                $errorMessage = updateSerialCode($scode);
            }
            
            if (empty($errorMessage)) {
                header("Location: ./pointentried.php?addPt=".$scode->sc_point );
            }
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (getSsnIsDebug()) {
            echo $e->getMessage();
        }
    }

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


    <?php include('./menu.php'); ?>


    <?php if(!empty($errorMessage)){ ?>
    <section id="banner8" class="err">
        <div class="inner">
            <h3><?php echo $errorMessage; ?></h3>
        </div>
    </section>
    <?php } ?>

    <section id="banner9">
        <div class="inner">
            <ul class="actions actions2">
                <li><a href="home.php" class="button alt scrolly big">戻る</a></li>
            </ul>
        </div>
    </section>

    <section id="banner">
        <div class="inner">
            <h1>ポイント登録</h1>
            <form action="" method="POST" name="editFrm">
                <div class="">
                    １２桁のポイントを入力してください
                    <input type="text" name="sc_code" id="sc_code" value="<?php echo $scode->sc_code； ?>"
                        placeholder="123456789012" />
                </div><br>
                <ul class="actions">
                    <li><a href="javascript:editFrm.submit()" class="button alt scrolly big">登録する</a></li>
                </ul>
                <input type="hidden" name="pointEntry" value="1">

            </form>

        </div>
    </section>

    <?php include('./footer.php'); ?>


</body>

</html>