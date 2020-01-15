<?php

// セッション開始
session_start();
require('session.php');
setSsnCrntPage(basename(__FILE__));
require('../psys/logging.php');

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
        $sc_code_f = $_POST['sc_code_f'];
        $sc_code_m = $_POST['sc_code_m'];
        $sc_code_e = $_POST['sc_code_e'];
		$scode->sc_code = $sc_code_f.$sc_code_m.$sc_code_e;
        
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
    <script type="text/javascript">
    function nextField(i, n, m) {
        if (i.value.length >= m) {
            i.form.elements[n].focus();
        }
    }
    </script>
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
                    １２桁のポイントを入力してください<br>
                    <input type="text" name="sc_code_f" id="sc_code_f" value="<?php echo $sc_code_f; ?>"
                        placeholder="1234" maxlength=4 class="nn" required onKeyUp="nextField(this, 'sc_code_m', 4)" />-
                    <input type="text" name="sc_code_m" id="sc_code_m" value="<?php echo $sc_code_m; ?>"
                        placeholder="1234" maxlength=4 class="nn" required onKeyUp="nextField(this, 'sc_code_e', 4)" />-
                    <input type="text" name="sc_code_e" id="sc_code_e" value="<?php echo $sc_code_e; ?>"
                        placeholder="1234" maxlength=4 class="nn" required />
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