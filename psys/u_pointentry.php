<?php

// セッション開始
session_start();
require('session.php');
setMyName('psys_m');
require('logging.php');

// エラーメッセージの初期化
$errorMessage = '';


require_once './db/views.php';
$point = getPoint(getSsn("SEQ"));


require_once './db/serialcodes.php';
$scode = new cls_serialcodes();


$sc_code_f = $_POST['sc_code_f'];
$sc_code_m = $_POST['sc_code_m'];
$sc_code_e = $_POST['sc_code_e'];
$scode->sc_code = $sc_code_f.$sc_code_m.$sc_code_e;

if (isset($_POST['pointEntry'])) {
    $scode = getSerialCodeBySCode($scode->sc_code);

    
    if (!isset($scode->sc_seq)) {
        $errorMessage = 'シリアルコードが確認できませんでした。<br>入力内容を確認してください。';
    } elseif (isset($scode->sc_point)) {
        $errorMessage = 'このシリアルコードはすでに登録されています。';
    } else {
        $scode->sc_point = getSsn('POINT_ENTRY');
        $scode->m_seq = getSsn("SEQ");
        updateSerialCode($scode);
    }
    
    if (empty($errorMessage)) {
        header("Location: ./u_pointentried.php?addPt=".$scode->sc_point);
    }
}


?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo getSsnMyname(); ?>
    </title>
    <link rel="stylesheet" href="./asset/css/u_main.css">
    <script type="text/javascript">
        function nextField(i, n, m) {
            if (i.value.length >= m) {
                i.form.elements[n].focus();
            }
        }
    </script>
</head>

<body>

    <?php include('./u_menu.php'); ?>


    <div id="contents">
        <?php include('./u_point.php'); ?>

        <h3><br>ポイント登録</h3>
        <?php if (!empty($errorMessage)) { ?>
        <div class="info w80p"><?php echo $errorMessage; ?>
        </div>
        <?php } ?>

        <form action="" method="POST" name="editFrm">
            <div class="rDiv w80p">
                <img src="./asset/image/pointcard_entry.png" class="w80p" /><br>
                12桁のシリアルコードを入力する<br>
                <input type="text" name="sc_code_f" id="sc_code_f"
                    value="<?php echo $sc_code_f; ?>"
                    placeholder="1234" maxlength=4 class="w25p" required onKeyUp="nextField(this, 'sc_code_m', 4)" />-
                <input type="text" name="sc_code_m" id="sc_code_m"
                    value="<?php echo $sc_code_m; ?>"
                    placeholder="1234" maxlength=4 class="w25p" required onKeyUp="nextField(this, 'sc_code_e', 4)" />-
                <input type="text" name="sc_code_e" id="sc_code_e"
                    value="<?php echo $sc_code_e; ?>"
                    placeholder="1234" maxlength=4 class="w25p" required /><br><br>
                <input type="button" class="rButton w80p f1rem btn-red" onclick="javascript:editFrm.submit()"
                    value="シリアルコードを登録する" />
                <input type="hidden" name="pointEntry" value="1">
            </div>

        </form>

</body>

</html>