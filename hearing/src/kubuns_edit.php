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

    $kSeq = $_POST['kSeq'];

    require './db/kubuns.php';
    $kubun = new cls_kubuns();

    try {

        $kubun->k_seq = $_POST['kSeq'];
        $kubun->k_title = $_POST['k_title'];
        $kubun->k_kubun1 = $_POST['k_kubun1'];
        $kubun->k_kubun2 = $_POST['k_kubun2'];
        $kubun->t_seq = $_POST['t_seq'];
        
        if (isset($_POST['kbnEdit'])) {

            if (!empty($kSeq)) {
                updateKubun($kubun);
            } else {
                insertKubun($kubun);
            }
        
            
            if (empty($errorMessage)) {
                header("Location: ./kubuns_list.php");
            }

        } elseif (isset($_POST['kbnDel'])) {

            $cnt = countKubuns($kSeq);

            if ($cnt==0) {
                deleteKubun($kSeq);
                header("Location: ./kubuns_list.php");
            } else {
                $errorMessage = 'このフォーマットは作文結果で使用されているため削除できません';
                
                $kubun = getKubun($kSeq);
            }
        } else {
            $kubun = getKubun($kSeq);
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (strcmp("1", $ini['debug'])==0) {
            echo $e->getMessage();
        }
    }

    require_once './db/templates.php';
    $templates = array();
    $templates = getTemplates();

    foreach ($templates as $template) { 
        if ($kubun->t_seq == $template->t_seq ){ $wk="selected"; }else{ $wk=""; }
        $opt_tmp .= "<option value='".$template->t_seq."' {$wk}>".$template->t_title."</option>";
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


    <form id="sakubun1" class="" action='kubuns_list.php' method='POST'>
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

            <input type="hidden" name="kSeq" value="<?php echo $kSeq; ?>">

            <table class="tpl">
                <tr>
                    <th><span class="required">*</span>フォーマット名<span class="f50P"> (20)</span></th>
                    <td><input type="text" name="k_title" id="k_title" class="f130P wdtL" maxlength=20 style="ime-mode: active;"
                            required placeholder="" value="<?php echo $kubun->k_title; ?>" autocomplete="off">
                    </td>
                </tr>
                <tr>
                    <th><span class="required">*</span>区分１<span class="f50P"> (5)</span></th>
                    <td><input type="text" name="k_kubun1" id="k_kubun1" class="f130P wdtS" maxlength=40 style="ime-mode: active;"
                            required placeholder="" value="<?php echo $kubun->k_kubun1; ?>" autocomplete="off">
                    </td>
                </tr>

                <tr>
                    <th><span class="required">*</span>区分２<span class="f50P"> (5)</span></th>
                    <td><input type="text" name="k_kubun2" id="k_kubun2" class="f130P wdtS" maxlength=40 style="ime-mode: active;"
                            required placeholder="" value="<?php echo $kubun->k_kubun2; ?>" autocomplete="off">
                    </td>
                </tr>

                <tr>
                    <th><span class="required">*</span>テンプレート</th>
                    <td><select id="t_seq"name="t_seq" class="f130P" required><?php echo $opt_tmp; ?></select></td>
                </tr>

                <tr>
                    <td colspan="2" style="text-align:center;">
                        <button type=submit name="kbnEdit" class="ntc2 f110P">登録</button>
                    </td>
                </tr>
            </table>

        </form>


        <?php if ($kSeq==1) { ?>
            <table class="cntr">
                <tr>
                    <td colspan=2><button type=button name="kbnDel" class="del wdtLL" onclick="alert('基準フォーマットは削除できません')">削　除</button></td>
                </tr>
            </table>
        <?php }elseif (isset($kSeq) ) { ?>
        <form action="" method="POST" onsubmit="return delcheck()">

            <input type="hidden" name="kSeq" value="<?php echo $kSeq; ?>">

            <table class="cntr">
                <tr>
                    <td colspan=2><button type=submit name="kbnDel" class="del wdtLL">削　除</button></td>
                </tr>
            </table>

        </form>
        <?php } ?>

    </div>
</body>

</html>