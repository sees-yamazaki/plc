<?php
session_start();

    // ログイン状態チェック
    if (!isset($_SESSION["NAME"])) {
        header("Location: logoff.php");
        exit;
    }

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

$ini = $_SESSION['INI'];

    $tSeq = $_POST['tSeq'];

    require './db/templates.php';
    $template = new cls_templates();

    try {

        $template->t_seq = $_POST['tSeq'];
        $template->t_title = $_POST['t_title'];
        $template->t_word_1 = $_POST['t_word_1'];
        $template->t_word_2 = $_POST['t_word_2'];
        $template->t_word_3 = $_POST['t_word_3'];
        $template->t_word_4 = $_POST['t_word_4'];
        $template->t_word_5 = $_POST['t_word_5'];
        $template->t_word_6 = $_POST['t_word_6'];
        $template->t_word_7 = $_POST['t_word_7'];
        $template->t_word_8 = $_POST['t_word_8'];
        $template->t_word_9 = $_POST['t_word_9'];
        $template->t_word_10 = $_POST['t_word_10'];
        $template->t_word_11 = $_POST['t_word_11'];
        $template->t_word_12 = $_POST['t_word_12'];
        $template->t_word_13 = $_POST['t_word_13'];
        $template->t_word_14 = $_POST['t_word_14'];
        $template->t_word_15 = $_POST['t_word_15'];
        
        if (isset($_POST['tempEdit'])) {

            if (!empty($tSeq)) {
                updateTemplate($template);
            } else {
                insertTemplate($template);
            }
        
            
            if (empty($errorMessage)) {
                header("Location: ./temps_list.php");
            }

        } elseif (isset($_POST['tempDel'])) {

            $cnt = countTemplates($tSeq);

            if ($cnt==0) {
                deleteTemplate($tSeq);
                header("Location: ./temps_list.php");
            } else {
                $errorMessage = 'このテンプレートはフォーマットで使用されているため削除できません';
                
                $template = getTemplate($tSeq);
            }
        } else {
            $template = getTemplate($tSeq);
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (strcmp("1", $ini['debug'])==0) {
            echo $e->getMessage();
        }
    }


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>HearingSheet</title>
    <link rel="stylesheet" href="../css/main.css" />
    <script src="../js/main.js"></script>
    <script src="../js/test.js"></script>
</head>

<body>


    <form id="sakubun1" class="" action='temps_list.php' method='POST'>
        <div class='menu no_print'>
            <ul class='topnav2'>
                <li><a id="back" href="#" onclick="back1();">戻る</a></li>
                <?php if($ini['support']==1){ ?>
                <li><input type="button" onclick="demo2()" value="デモ用数値">
                <?php } ?>
            </ul>
        </div>
    </form>

    <div id="content">

        <div>
            <span class="redBold"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></span>
        </div><br>

        <form action="" method="POST" onsubmit="return addcheck()">

            <input type="hidden" name="tSeq" value="<?php echo $tSeq; ?>">

            <table class="tpl">
                <tr>
                    <th><span class="required">*</span>テンプレート名<span class="f50P"> (20)</span></th>
                    <td><input type="text" name="t_title" id="t_title" class="f130P wdtL" maxlength=20 style="ime-mode: active;"
                            required placeholder="" value="<?php echo $template->t_title; ?>" autocomplete="off">
                    </td>
                </tr>

                <tr>
                    <th><span class="required">*</span>Word1<span class="f50P"> (50)</span></th>
                    <td><input type="text" name="t_word_1" id="t_word_1" class="f130P wdtL" maxlength=50 style="ime-mode: active;"
                            required placeholder="" value="<?php echo $template->t_word_1; ?>" autocomplete="off">
                    </td>
                </tr>

                <tr>
                    <th><span class="required">*</span>Word2<span class="f50P"> (50)</span></th>
                    <td><input type="text" name="t_word_2" id="t_word_2" class="f130P wdtL" maxlength=50 style="ime-mode: active;"
                            required placeholder="" value="<?php echo $template->t_word_2; ?>" autocomplete="off">
                    </td>
                </tr>

                <tr>
                    <th><span class="required">*</span>Word3<span class="f50P"> (50)</span></th>
                    <td><input type="text" name="t_word_3" id="t_word_3" class="f130P wdtL" maxlength=50 style="ime-mode: active;"
                            required placeholder="" value="<?php echo $template->t_word_3; ?>" autocomplete="off">
                    </td>
                </tr>

                <tr>
                    <th><span class="required">*</span>Word4<span class="f50P"> (50)</span></th>
                    <td><input type="text" name="t_word_4" id="t_word_4" class="f130P wdtL" maxlength=50 style="ime-mode: active;"
                            required placeholder="" value="<?php echo $template->t_word_4; ?>" autocomplete="off">
                    </td>
                </tr>

                <tr>
                    <th><span class="required">*</span>Word5<span class="f50P"> (50)</span></th>
                    <td><input type="text" name="t_word_5" id="t_word_5" class="f130P wdtL" maxlength=50 style="ime-mode: active;"
                            required placeholder="" value="<?php echo $template->t_word_5; ?>" autocomplete="off">
                    </td>
                </tr>

                <tr>
                    <th><span class="required">*</span>Word6<span class="f50P"> (50)</span></th>
                    <td><input type="text" name="t_word_6" id="t_word_6" class="f130P wdtL" maxlength=50 style="ime-mode: active;"
                            required placeholder="" value="<?php echo $template->t_word_6; ?>" autocomplete="off">
                    </td>
                </tr>

                <tr>
                    <th><span class="required">*</span>Word7<span class="f50P"> (50)</span></th>
                    <td><input type="text" name="t_word_7" id="t_word_7" class="f130P wdtL" maxlength=50 style="ime-mode: active;"
                            required placeholder="" value="<?php echo $template->t_word_7; ?>" autocomplete="off">
                    </td>
                </tr>

                <tr>
                    <th><span class="required">*</span>Word8<span class="f50P"> (50)</span></th>
                    <td><input type="text" name="t_word_8" id="t_word_8" class="f130P wdtL" maxlength=50 style="ime-mode: active;"
                            required placeholder="" value="<?php echo $template->t_word_8; ?>" autocomplete="off">
                    </td>
                </tr>

                <tr>
                    <th><span class="required">*</span>Word9<span class="f50P"> (50)</span></th>
                    <td><input type="text" name="t_word_9" id="t_word_9" class="f130P wdtL" maxlength=50 style="ime-mode: active;"
                            required placeholder="" value="<?php echo $template->t_word_9; ?>" autocomplete="off">
                    </td>
                </tr>

                <tr>
                    <th><span class="required">*</span>Word10<span class="f50P"> (50)</span></th>
                    <td><input type="text" name="t_word_10" id="t_word_10" class="f130P wdtL" maxlength=50 style="ime-mode: active;"
                            required placeholder="" value="<?php echo $template->t_word_10; ?>" autocomplete="off">
                    </td>
                </tr>

                <tr>
                    <th><span class="required">*</span>Word11<span class="f50P"> (50)</span></th>
                    <td><input type="text" name="t_word_11" id="t_word_11" class="f130P wdtL" maxlength=50 style="ime-mode: active;"
                            required placeholder="" value="<?php echo $template->t_word_11; ?>" autocomplete="off">
                    </td>
                </tr>

                <tr>
                    <th><span class="required">*</span>Word12<span class="f50P"> (50)</span></th>
                    <td><input type="text" name="t_word_12" id="t_word_12" class="f130P wdtL" maxlength=50 style="ime-mode: active;"
                            required placeholder="" value="<?php echo $template->t_word_12; ?>" autocomplete="off">
                    </td>
                </tr>

                <tr>
                    <th><span class="required">*</span>Word13<span class="f50P"> (50)</span></th>
                    <td><input type="text" name="t_word_13" id="t_word_13" class="f130P wdtL" maxlength=50 style="ime-mode: active;"
                            required placeholder="" value="<?php echo $template->t_word_13; ?>" autocomplete="off">
                    </td>
                </tr>

                <tr>
                    <th><span class="required">*</span>Word14<span class="f50P"> (50)</span></th>
                    <td><input type="text" name="t_word_14" id="t_word_14" class="f130P wdtL" maxlength=50 style="ime-mode: active;"
                            required placeholder="" value="<?php echo $template->t_word_14; ?>" autocomplete="off">
                    </td>
                </tr>

                <tr>
                    <th><span class="required">*</span>Word15<span class="f50P"> (50)</span></th>
                    <td><input type="text" name="t_word_15" id="t_word_15" class="f130P wdtL" maxlength=50 style="ime-mode: active;"
                            required placeholder="" value="<?php echo $template->t_word_15; ?>" autocomplete="off">
                    </td>
                </tr>


                <tr>
                    <td colspan="2" style="text-align:center;">
                        <button type=submit name="tempEdit" class="ntc2 f110P">登録</button>
                    </td>
                </tr>
            </table>

        </form>

        <?php if ($tSeq==1) { ?>
            <table class="cntr">
                <tr>
                    <td colspan=2><button type=button name="kbnDel" class="del wdtLL" onclick="alert('基準テンプレートは削除できません')">削　除</button></td>
                </tr>
            </table>
        <?php }elseif (isset($tSeq) ) { ?>
        <form action="" method="POST" onsubmit="return delcheck()">

            <input type="hidden" name="tSeq" value="<?php echo $tSeq; ?>">

            <table class="cntr">
                <tr>
                    <td colspan=2><button type=submit name="tempDel" class="del wdtLL">削　除</button></td>
                </tr>
            </table>

        </form>
        <?php } ?>

    </div>
</body>

</html>