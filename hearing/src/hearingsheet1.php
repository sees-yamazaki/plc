<?php

// セッション開始
session_start();

// $ini = parse_ini_file('../common.ini', false);
// $_SESSION["INI"] = $ini;

// $_SESSION["MY_ROOT"] = $_SERVER['DOCUMENT_ROOT'].$ini['schema'];
    // ログイン状態チェック
    if (!isset($_SESSION["NAME"])) {
        header("Location: logoff.php");
        exit;
    }


// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');



$stts = $_POST['stts'];
$iSeq = $_POST['iSeq'];


require_once './db/infos.php';
$info = array();
$info = getInfo($iSeq);

$ini = $_SESSION['INI'];

?>

<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>HearingSheet</title>
    <link rel="stylesheet" href="../css/main.css" />
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/cal.js"></script>
    <script src="../js/sakubun.js"></script>
    <script src="../js/test.js"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
    document.onkeydown = function(e) {
        $('form').on('keydown', 'input', function(e) {
            if (e.keyCode == 13) {
                if ($(this).attr("type") == 'submit') return;

                var form = $(this).closest('form');
                //var focusable = form.find('input, button[type="submit"], select, textarea').not('[readonly]').filter(':visible');
                var focusable = form.find('input').not(
                    '[readonly],.lbl,input[type="button"],input[type="range"]').filter(':visible');

                if (e.shiftKey) {
                    focusable.eq(focusable.index(this) - 1).focus();
                } else {
                    var next = focusable.eq(focusable.index(this) + 1);
                    if (next.length) {
                        next.focus();
                    } else {
                        focusable.eq(0).focus();
                    }
                }

                e.preventDefault();
            }
        });
    };
    </script>
</head>

<body id="page-top">
    <?php if (!isset($stts)) { ?>
    <input type="hidden" id="cnt" value="0">
    <?php } elseif ($stts=="edit") { ?>
    <input type="hidden" id="cnt" value="1">
    <input type="hidden" id="iSeq" value="<?php echo $iSeq;  ?>">
    <input type="hidden" id="users_seqx" value="<?php echo $info->users_seq;  ?>">
    <input type="hidden" id="title1x" value="<?php echo $info->title1;  ?>">
    <input type="hidden" id="title2x" value="<?php echo $info->title2;  ?>">
    <input type="hidden" id="d2x" value="<?php echo $info->d2;  ?>">
    <input type="hidden" id="d3x" value="<?php echo $info->d3;  ?>">
    <input type="hidden" id="d4x" value="<?php echo $info->d4;  ?>">
    <input type="hidden" id="d6x" value="<?php echo $info->d6;  ?>">
    <input type="hidden" id="d8x" value="<?php echo $info->d8;  ?>">
    <input type="hidden" id="f8x" value="<?php echo $info->f8;  ?>">
    <input type="hidden" id="d11x" value="<?php echo $info->d11;  ?>">
    <input type="hidden" id="d12x" value="<?php echo $info->d12;  ?>">
    <input type="hidden" id="e13x" value="<?php echo $info->e13;  ?>">
    <input type="hidden" id="d29x" value="<?php echo $info->d29;  ?>">
    <input type="hidden" id="d30x" value="<?php echo $info->d30;  ?>">
    <input type="hidden" id="d31x" value="<?php echo $info->d31;  ?>">
    <input type="hidden" id="l29x" value="<?php echo $info->l29;  ?>">
    <input type="hidden" id="l30x" value="<?php echo $info->l30;  ?>">
    <input type="hidden" id="l31x" value="<?php echo $info->l31;  ?>">
    <input type="hidden" id="d49x" value="<?php echo $info->d49;  ?>">
    <input type="hidden" id="d50x" value="<?php echo $info->d50;  ?>">
    <input type="hidden" id="e51x" value="<?php echo $info->e51;  ?>">
    <input type="hidden" id="c68x" value="<?php echo $info->c68;  ?>">
    <input type="hidden" id="c69x" value="<?php echo $info->c69;  ?>">
    <input type="hidden" id="l73x" value="<?php echo $info->l73;  ?>">
    <input type="hidden" id="c88x" value="<?php echo $info->c88;  ?>">
    <input type="hidden" id="c89x" value="<?php echo $info->c89;  ?>">
    <input type="hidden" id="i18x" value="<?php echo $info->i18;  ?>">
    <input type="hidden" id="i56x" value="<?php echo $info->i56;  ?>">
    <input type="hidden" id="a1rx" value="<?php echo $info->a1r;  ?>">
    <input type="hidden" id="a6rx" value="<?php echo $info->a6r;  ?>">
    <input type="hidden" id="a11rx" value="<?php echo $info->a11r;  ?>">
    <input type="hidden" id="a26rx" value="<?php echo $info->a26r;  ?>">
    <input type="hidden" id="a29rx" value="<?php echo $info->a29r;  ?>">
    <input type="hidden" id="a44rx" value="<?php echo $info->a44r;  ?>">
    <input type="hidden" id="a51rx" value="<?php echo $info->a51r;  ?>">
    <input type="hidden" id="a62rx" value="<?php echo $info->a62r;  ?>">
    <input type="hidden" id="a75rx" value="<?php echo $info->a75r;  ?>">
    <input type="hidden" id="a87rx" value="<?php echo $info->a87r;  ?>">
    <input type="hidden" id="a96rx" value="<?php echo $info->a96r;  ?>">
    <?php } else { ?>
    <input type="hidden" id="cnt" value="1">
    <input type="hidden" id="iSeq" value="<?php echo $iSeq;  ?>">
    <input type="hidden" id="users_seqx" value="<?php echo $_POST['users_seq'];  ?>">
    <input type="hidden" id="title1x" value="<?php echo $_POST['title1'];  ?>">
    <input type="hidden" id="title2x" value="<?php echo $_POST['title2'];  ?>">
    <input type="hidden" id="d2x" value="<?php echo $_POST['d2'];  ?>">
    <input type="hidden" id="d3x" value="<?php echo $_POST['d3'];  ?>">
    <input type="hidden" id="d4x" value="<?php echo $_POST['d4'];  ?>">
    <input type="hidden" id="d6x" value="<?php echo $_POST['d6'];  ?>">
    <input type="hidden" id="d8x" value="<?php echo $_POST['d8'];  ?>">
    <input type="hidden" id="f8x" value="<?php echo $_POST['f8'];  ?>">
    <input type="hidden" id="d11x" value="<?php echo $_POST['d11'];  ?>">
    <input type="hidden" id="d12x" value="<?php echo $_POST['d12'];  ?>">
    <input type="hidden" id="e13x" value="<?php echo $_POST['e13'];  ?>">
    <input type="hidden" id="d29x" value="<?php echo $_POST['d29'];  ?>">
    <input type="hidden" id="d30x" value="<?php echo $_POST['d30'];  ?>">
    <input type="hidden" id="d31x" value="<?php echo $_POST['d31'];  ?>">
    <input type="hidden" id="l29x" value="<?php echo $_POST['l29'];  ?>">
    <input type="hidden" id="l30x" value="<?php echo $_POST['l30'];  ?>">
    <input type="hidden" id="l31x" value="<?php echo $_POST['l31'];  ?>">
    <input type="hidden" id="d49x" value="<?php echo $_POST['d49'];  ?>">
    <input type="hidden" id="d50x" value="<?php echo $_POST['d50'];  ?>">
    <input type="hidden" id="e51x" value="<?php echo $_POST['e51'];  ?>">
    <input type="hidden" id="c68x" value="<?php echo $_POST['c68'];  ?>">
    <input type="hidden" id="c69x" value="<?php echo $_POST['c69'];  ?>">
    <input type="hidden" id="l73x" value="<?php echo $_POST['l73'];  ?>">
    <input type="hidden" id="c88x" value="<?php echo $_POST['c88'];  ?>">
    <input type="hidden" id="c89x" value="<?php echo $_POST['c89'];  ?>">
    <input type="hidden" id="i18x" value="<?php echo $_POST['i18'];  ?>">
    <input type="hidden" id="i56x" value="<?php echo $_POST['i56'];  ?>">
    <input type="hidden" id="a1rx" value="<?php echo $_POST['a1r'];  ?>">
    <input type="hidden" id="a6rx" value="<?php echo $_POST['a6r'];  ?>">
    <input type="hidden" id="a11rx" value="<?php echo $_POST['a11r'];  ?>">
    <input type="hidden" id="a26rx" value="<?php echo $_POST['a26r'];  ?>">
    <input type="hidden" id="a29rx" value="<?php echo $_POST['a29r'];  ?>">
    <input type="hidden" id="a44rx" value="<?php echo $_POST['a44r'];  ?>">
    <input type="hidden" id="a51rx" value="<?php echo $_POST['a51r'];  ?>">
    <input type="hidden" id="a62rx" value="<?php echo $_POST['a62r'];  ?>">
    <input type="hidden" id="a75rx" value="<?php echo $_POST['a75r'];  ?>">
    <input type="hidden" id="a87rx" value="<?php echo $_POST['a87r'];  ?>">
    <input type="hidden" id="a96rx" value="<?php echo $_POST['a96r'];  ?>">
    <?php } ?>

    <form id="infos" name="infos" action="info_edit.php" method="POST">
        <input type="hidden" name="iSeq" value="<?php echo $iSeq; ?>">
        <input type="hidden" id="title1" name="title1" value="">
        <input type="hidden" id="title2" name="title2" value="">
        <input type="hidden" id="users_seq" name="users_seq" value="">
        <div class='menu no_print'>
            <ul class='topnav'>
                <li><a id="page1" href="#" onclick="page1();">入力シート</a></li>
                <li><a id="page2" href="#" onclick="page2();">計算結果</a></li>
                <li><a id="page3" href="#" onclick="page3();">自動作文</a></li>
                <li><a href='javascript:isReset()'>リセット</a></li>
                <li><a id="infoRec" href="javascript:sakubunCheck()" class="lst">登録する</a></li>
                <li><a id="info" href="javascript:showList()" class="lst">登録情報</a></li>
                <li><a id="info" href="javascript:showUser()" class="lst">ユーザ</a></li>
                <?php if($ini['support']==1){ ?>
                <li><input type="button" onclick="demo()" value="デモ用数値">
                <?php } ?>
                <li class='right'><a href='./logoff.php' class="rvc">ログオフ</a></li>
            </ul>
        </div>

        <div id="content">

            <div id="inputsheet">

                <h1>≪設備導入前≫</h1>
                <table class='hs'>
                    <colgroup span="1" class="areaA"></colgroup>
                    <colgroup span="1" class="areaB"></colgroup>
                    <colgroup span="1" class="areaC"></colgroup>
                    <colgroup span="1" class="areaD"></colgroup>
                    <tr>
                        <th colspan=2>（入）売上規模／年</th>
                        <td><input type="text" class="number" id="d2" name="d2"></td>
                        <td>万円</td>
                    </tr>
                    <tr>
                        <th colspan=2>（出）労務費／年</th>
                        <td><input type="text" class="number" id="d3" name="d3"></td>
                        <td>万円</td>
                    </tr>
                    <tr>
                        <th colspan=2>（出）販管人件費／年</th>
                        <td><input type="text" class="number" id="d4" name="d4"></td>
                        <td>万円</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>= 粗利率</td>
                        <td><input type="text" class="lbl" id="d5" name="d5" readonly></td>
                        <td>※仕入除く</td>
                    </tr>
                    <tr>
                        <th colspan=2>従業員数（製造）</th>
                        <td><input type="text" class="number" id="d6" name="d6"></td>
                        <td>名</td>
                    </tr>
                    <tr>
                        <td colspan=4>&nbsp;</td>
                    </tr>
                    <tr>
                        <th colspan=2>生菓子：焼菓子　＝</th>
                        <td>
                            <input type="text" class="number wdtSS" style="text-align: center" id="d8" name="d8">
                            ：<input type="text" class="number wdtSS" style="text-align: center" id="f8" name="f8">
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>（商品点数ﾍﾞｰｽ）</td>
                        <td>割合</td>
                        <td><input type="text" class="lbl" id="e9" name="e9"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>（売り平均単価）</td>
                        <td>割合</td>
                        <td><input type="text" class="lbl" id="e10" name="e10"></td>
                    </tr>
                    <tr>
                        <th rowspan=2>平均単価</th>
                        <td>生菓子平均単価</td>
                        <td><input type="text" class="number1" id="d11" name="d11"></td>
                        <td>円／個</td>
                    </tr>
                    <tr>
                        <td>焼菓子平均単価</td>
                        <td><input type="text" class="number1" id="d12" name="d12"></td>
                        <td>円／個</td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>（材料原価）</td>
                        <td>率 <input type="text" class="number1 wdtS" id="e13" name="e13">%</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th rowspan=2>材料</th>
                        <td>生菓子平均材料原価</td>
                        <td><input type="text" class="lbl" id="d14" name="d14"></td>
                        <td>円／個</td>
                    </tr>
                    <tr>
                        <td>焼菓子平均材料原価</td>
                        <td><input type="text" class="lbl" id="d15" name="d15" readonly></td>
                        <td>円／個</td>
                    </tr>
                    <tr>
                        <td colspan=4>&nbsp;</td>
                    </tr>
                    <tr>
                        <th rowspan=2>労務</th>
                        <td>生菓子平均労務費</td>
                        <td><input type="text" class="lbl" id="d17" name="d17" readonly></td>
                        <td>円／個</td>
                    </tr>
                    <tr>
                        <td>焼菓子平均労務費</td>
                        <td><input type="text" class="lbl" id="d18" name="d18" readonly></td>
                        <td>円／個</td>
                    </tr>
                    <tr>
                        <td colspan=4>&nbsp;</td>
                    </tr>
                    <tr>
                        <th rowspan=2>販管</th>
                        <td>生菓子平均販管費</td>
                        <td><input type="text" class="lbl" id="d20" name="d20" readonly></td>
                        <td>円／個</td>
                    </tr>
                    <tr>
                        <td>焼菓子平均販管費</td>
                        <td><input type="text" class="lbl" id="d21" name="d21" readonly></td>
                        <td>円／個</td>
                    </tr>
                    <tr>
                        <td colspan=4>&nbsp;</td>
                    </tr>
                    <tr>
                        <th rowspan=2>総原価</th>
                        <td>生菓子平均総原価</td>
                        <td><input type="text" class="lbl" id="d23" name="d23" readonly></td>
                        <td>円／個</td>
                    </tr>
                    <tr>
                        <td>焼菓子平均総原価</td>
                        <td><input type="text" class="lbl" id="d24" name="d24" readonly></td>
                        <td>円／個</td>
                    </tr>
                </table>

                <h1>≪成長を設定（５年後）≫</h1>
                <table class='hs'>
                    <colgroup span="1" class="areaA"></colgroup>
                    <colgroup span="1" class="areaB"></colgroup>
                    <colgroup span="1" class="areaC"></colgroup>
                    <colgroup span="1" class="areaD"></colgroup>
                    <tr>
                        <th>売上成長</th>
                        <td><input type="number" class="number1 wdtM" id="d29" name="d29" min="100" max="200" step="0.5"
                                onchange="document.getElementById('scrl1').value=this.value">%</td>
                        <td colspan=2>
                            <input type="button" class="tgl" style="font-size:10pt;" value="＜" onclick="minusUriage();">
                            <input type="button" class="tgl" style="font-size:10pt;" value="＞" onclick="plusUriage();">
                            &nbsp;&nbsp;&nbsp;
                            <input type="range" id="scrl1" value="1" min="100" max="200" step="0.5"
                                oninput="doSlide(this.value)"></td>
                        <td rowspan="3">
                            <a href="javascript:void(0)" class="btn-sakubun2" onclick="btning()">自動計算</a>
                        </td>
                    </tr>
                    <tr>
                        <th>製造原価低減</th>
                        <td colspan=2>
                            マイナス<input type="number" class="number1 wdtSS" id="d30" name="d30" min="0" max="100"
                                step="0.1">%
                            &nbsp;&nbsp;&nbsp;
                            <input type="button" class="tgl" style="font-size:10pt;" value="＜" onclick="minusGenka();">
                            <input type="button" class="tgl" style="font-size:10pt;" value="＞" onclick="plusGenka();">
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>製造　増員数</th>
                        <td>プラス<input type="number" class="number wdtS" id="d31" name="d31" min="0" max="999">名</td>
                        <td>
                            <input type="button" class="tgl" style="font-size:10pt;" value="＜" onclick="minusStaff();">
                            <input type="button" class="tgl" style="font-size:10pt;" value="＞" onclick="plusStaff();">
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>生菓子：焼菓子　＝</th>
                        <td><input type="text" class="lbl wdtSSS" style="text-align: center" id="d32" name="d32"
                                readonly>：<input type="text" class="lbl wdtSSS" style="text-align: center" id="f32"
                                name="f32" readonly></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>生菓子平均単価</th>
                        <td><input type="text" class="lbl" id="i31" name="i31" readonly></td>
                        <td>円／個</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>焼菓子平均単価</th>
                        <td><input type="text" class="lbl" id="i32" name="i32" readonly></td>
                        <td>円／個</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>設備1</th>
                        <td><input type="text" class="number" id="l29" name="l29"></td>
                        <td>円　税抜</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>設備2</th>
                        <td><input type="text" class="number" id="l30" name="l30"></td>
                        <td>円　税抜</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>設備3</th>
                        <td><input type="text" class="number" id="l31" name="l31"></td>
                        <td>円　税抜</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>計</th>
                        <td><input type="text" class="lbl" id="l32" name="l32" readonly></td>
                        <td>円</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>補助率</th>
                        <td><select class="f130P" id="l33">
                                <option value=0>1/2
                                <option value=1>2/3
                            </select></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>補助額</th>
                        <td><input type="text" class="lbl" id="l34" name="l34" readonly></td>
                        <td>円</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>一括償却</th>
                        <td><select class="f130P" id="l35">
                                <option value=0>する
                                <option value=1>しない
                            </select></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>減価償却費</th>
                        <td><input type="text" class="lbl" id="l36" name="l36" readonly></td>
                        <td>円</td>
                        <td><input type="text" class="lbl" id="m36" name="m36" readonly></td>
                    </tr>
                </table>

                <br><br>

                <table class='hs'>
                    <colgroup span="1" class="areaA"></colgroup>
                    <colgroup span="1" class="areaB"></colgroup>
                    <colgroup span="1" class="areaC"></colgroup>
                    <tr>
                        <th>要件</th>
                        <th>計算値（５年後）</th>
                        <th>要件チェック</th>
                    </tr>
                    <tr>
                        <td>経常利益 成長</td>
                        <td><input type="text" class="lbl" id="d35" name="d35" readonly></td>
                        <td><input type="text" class="lbl" style="text-align: center;" id="f35" name="f35" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>付加価値額 成長</td>
                        <td><input type="text" class="lbl" id="d36" name="d36" readonly></td>
                        <td><input type="text" class="lbl" style="text-align: center;" id="f36" name="f36" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>労働生産性 成長</td>
                        <td><input type="text" class="lbl" id="d37" name="d37" readonly></td>
                        <td><input type="text" class="lbl" style="text-align: center;" id="f37" name="f37" readonly>
                        </td>
                    </tr>
                </table>



                <h1>≪設備導入後≫</h1>
                <table class='hs'>
                    <colgroup span="1" class="areaA"></colgroup>
                    <colgroup span="1" class="areaB"></colgroup>
                    <colgroup span="1" class="areaC"></colgroup>
                    <colgroup span="1" class="areaD"></colgroup>
                    <tr>
                        <th colspan=2>（入）売上規模／年</th>
                        <td><input type="text" class="lbl" id="d40" name="d40" readonly></td>
                        <td>万円</td>
                    </tr>
                    <tr>
                        <th colspan=2>（出）労務費／年</th>
                        <td><input type="text" class="lbl" id="d41" name="d41" readonly></td>
                        <td>万円</td>
                    </tr>
                    <tr>
                        <th colspan=2>（出）販管人件費／年</th>
                        <td><input type="text" class="lbl" id="d42" name="d42" readonly></td>
                        <td>万円</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>= 粗利率</td>
                        <td><input type="text" class="lbl" id="d43" name="d43" readonly></td>
                        <td>※仕入除く</td>
                    </tr>
                    <tr>
                        <th colspan=2>従業員数（製造）</th>
                        <td><input type="text" class="lbl" id="d44" name="d44" readonly></td>
                        <td>名</td>
                    </tr>
                    <tr>
                        <td colspan=4>&nbsp;</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>（商品点数ﾍﾞｰｽ）</td>
                        <td>割合</td>
                        <td><input type="text" class="lbl" id="e47" name="e47" readonly></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>（売り平均単価）</td>
                        <td>割合</td>
                        <td><input type="text" class="lbl" id="e48" name="e48" readonly></td>
                    </tr>
                    <tr>
                        <th rowspan=2>平均単価</th>
                        <td>生菓子平均単価</td>
                        <td><input type="text" class="number1" id="d49" name="d49"></td>
                        <td>円／個</td>
                    </tr>
                    <tr>
                        <td>焼菓子平均単価</td>
                        <td><input type="text" class="number1" id="d50" name="d50"></td>
                        <td>円／個</td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>（材料原価）</td>
                        <td>率 <input type="text" class="number1 wdtS" id="e51" name="e51">%</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th rowspan=2>材料</th>
                        <td>生菓子平均材料原価</td>
                        <td><input type="text" class="lbl" id="d52" name="d52" readonly></td>
                        <td>円／個</td>
                    </tr>
                    <tr>
                        <td>焼菓子平均材料原価</td>
                        <td><input type="text" class="lbl" id="d53" name="d53" readonly></td>
                        <td>円／個</td>
                    </tr>
                    <tr>
                        <td colspan=4>&nbsp;</td>
                    </tr>
                    <tr>
                        <th rowspan=2>労務</th>
                        <td>生菓子平均労務費</td>
                        <td><input type="text" class="lbl" id="d55" name="d55" readonly></td>
                        <td>円／個</td>
                    </tr>
                    <tr>
                        <td>焼菓子平均労務費</td>
                        <td><input type="text" class="lbl" id="d56" name="d56" readonly></td>
                        <td>円／個</td>
                    </tr>
                    <tr>
                        <td colspan=4>&nbsp;</td>
                    </tr>
                    <tr>
                        <th rowspan=2>販管</th>
                        <td>生菓子平均販管費</td>
                        <td><input type="text" class="lbl" id="d58" name="d58" readonly></td>
                        <td>円／個</td>
                    </tr>
                    <tr>
                        <td>焼菓子平均販管費</td>
                        <td><input type="text" class="lbl" id="d59" name="d59" readonly></td>
                        <td>円／個</td>
                    </tr>
                    <tr>
                        <td colspan=4>&nbsp;</td>
                    </tr>
                    <tr>
                        <th rowspan=2>総原価</th>
                        <td>生菓子平均総原価</td>
                        <td><input type="text" class="lbl" id="d61" name="d61" readonly></td>
                        <td>円／個</td>
                    </tr>
                    <tr>
                        <td>焼菓子平均総原価</td>
                        <td><input type="text" class="lbl" id="d62" name="d62" readonly></td>
                        <td>円／個</td>
                    </tr>
                </table>






                <h1>≪判定≫</h1>
                <h3>１．もの補助要件</h3>
                <table class='hs'>
                    <colgroup span="1" class="areaA"></colgroup>
                    <colgroup span="1" class="areaB"></colgroup>
                    <colgroup span="1" class="areaC"></colgroup>
                    <colgroup span="1" class="areaD"></colgroup>
                    <tr>
                        <th>要件</th>
                        <th>年率（毎年平均）</th>
                        <th>計算値（５年後）</th>
                        <th>もの補助要件チェック結果</th>
                    </tr>
                    <tr>
                        <td>経常利益 成長</td>
                        <td><input type="number" class="number wdtSS" id="c68" name="c68" value="1">%</td>
                        <td><input type="text" class="lbl" id="d68" name="d68" readonly></td>
                        <td><input type="text" class="lbl" style="text-align: center;" id="g68" name="g68" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>付加価値額 成長</td>
                        <td><input type="number" class="number wdtSS" id="c69" name="c69" value="3">%</td>
                        <td><input type="text" class="lbl" id="d69" name="d69" readonly></td>
                        <td><input type="text" class="lbl" style="text-align: center;" id="g69" name="g69" readonly>
                        </td>
                    </tr>
                </table>


                <h3>２．労働生産性</h3>
                <table class='hs'>
                    <colgroup span="1" class="areaA"></colgroup>
                    <colgroup span="1" class="areaB"></colgroup>
                    <tr>
                        <th>有形固定資産</th>
                        <td nowrap><input type="text" class="number" id="l73" name="l73">円</td>
                    </tr>
                </table>
                <br><br>
                <table class='hs'>
                    <caption>（円）</caption>
                    <colgroup span="1" class="areaA"></colgroup>
                    <colgroup span="1" class="areaB"></colgroup>
                    <colgroup span="1" class="areaC"></colgroup>
                    <colgroup span="1" class="areaD"></colgroup>
                    <tr>
                        <th>現状</th>
                        <th>５年後</th>
                        <th>伸び率</th>
                        <th>判定</th>
                    </tr>
                    <tr>
                        <td><input type="text" class="lbl" id="c73" name="c73" readonly></td>
                        <td><input type="text" class="lbl" id="d73" name="d73" readonly></td>
                        <td><input type="text" class="lbl" id="e73" name="e73" readonly></td>
                        <td><input type="text" class="lbl" style="text-align: center;" id="g73" name="g73" readonly>
                        </td>
                    </tr>
                </table>




                <h3>３．損益分岐点の推移</h3>

                <table class='hs'>
                    <caption>（円）</caption>
                    <tr>
                        <th><input type="text" class="lbl" readonly></th>
                        <th>前期実績</th>
                        <th>1年目</th>
                        <th>2年目</th>
                        <th>3年目</th>
                        <th>4年目</th>
                        <th>5年目</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>売上高</th>
                        <td><input type="text" class="lbl widthBunki" id="c77" name="c77" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="d77" name="d77" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="e77" name="e77" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="g77" name="g77" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="h77" name="h77" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="i77" name="i77" readonly></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>損益分岐点売上高</th>
                        <td><input type="text" class="lbl widthBunki" id="c78" name="c78" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="d78" name="d78" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="e78" name="e78" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="g78" name="g78" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="h78" name="h78" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="i78" name="i78" readonly></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>損益分岐点比率</th>
                        <td><input type="text" class="lbl widthBunki" id="c79" name="c79" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="d79" name="d79" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="e79" name="e79" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="g79" name="g79" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="h79" name="h79" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="i79" name="i79" readonly></td>
                        <td></td>
                    </tr>
                </table>




                <h3>４．投資判断としての妥当性</h3>
                <table class='hs'>
                    <tr>
                        <td>
                            <a href="javascript:void(0)" class="btn-sakubun" onclick="btning()">自動計算</a>
                        </td>
                    </tr>
                </table>

                <br><br>

                <table class='hs'>
                    <colgroup span="1" class="areaA"></colgroup>
                    <colgroup span="1" class="areaB"></colgroup>
                    <tr>
                        <th>判定</th>
                        <td><input type="text" class="lbl" style="text-align: center;" id="c83" name="c83" readonly>
                        </td>
                    </tr>
                </table>

                <br><br>
                <table class='hs'>
                    <colgroup span="1" class="areaA"></colgroup>
                    <colgroup span="1" class="areaB"></colgroup>
                    <colgroup span="1" class="areaC"></colgroup>
                    <colgroup span="1" class="areaD"></colgroup>
                    <tr>
                        <th>推定回収期間</th>
                        <td><input type="text" class="lbl wdtS" id="c85" name="c85" readonly>年</td>
                    </tr>
                </table>

                <br><br>

                <table class='hs'>
                    <colgroup span="1" class="areaA"></colgroup>
                    <colgroup span="1" class="areaB"></colgroup>
                    <colgroup span="1" class="areaC"></colgroup>
                    <colgroup span="1" class="areaD"></colgroup>
                    <tr>
                        <th>法人税率</th>
                        <td><input type="number" class="number2 wdtS" id="c88" name="c88" step="0.01" value="25.00">%
                        </td>
                    </tr>
                    <tr>
                        <th>資本コスト</th>
                        <td><input type="number" class="number2 wdtS" id="c89" name="c89" step="0.01" value="10.00">%
                        </td>
                    </tr>
                </table>

                <br><br>

                <table class='hs'>
                    <caption>（円）</caption>
                    <tr>
                        <th><input type="text" class="lbl widthBunki" readonly></th>
                        <th>投資時点</th>
                        <th>1年目</th>
                        <th>2年目</th>
                        <th>3年目</th>
                        <th>4年目</th>
                        <th>5年目</th>
                    </tr>
                    <tr>
                        <th>①CIF（営業CF）</th>
                        <td rowspan=6 class="emptyTd"></td>
                        <td><input type="text" class="lbl widthBunki" id="d93" name="d93" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="e93" name="e93" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="f93" name="f93" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="g93" name="g93" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="h93" name="h93" readonly></td>
                    </tr>
                    <tr>
                        <th>①'税引き後CIF（営業CF）</th>
                        <td><input type="text" class="lbl widthBunki" id="d94" name="d94" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="e94" name="e94" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="f94" name="f94" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="g94" name="g94" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="h94" name="h94" readonly></td>
                    </tr>
                    <tr>
                        <th>　設備の減価償却費</th>
                        <td><input type="text" class="lbl widthBunki" id="d95" name="d95" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="e95" name="e95" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="f95" name="f95" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="g95" name="g95" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="h95" name="h95" readonly></td>
                    </tr>
                    <tr>
                        <th class="nwrp">②減価償却費のﾀｯｸｽｼｰﾙﾄﾞ</th>
                        <td><input type="text" class="lbl widthBunki" id="d96" name="d96" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="e96" name="e96" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="f96" name="f96" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="g96" name="g96" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="h96" name="h96" readonly></td>
                    </tr>
                    <tr>
                        <th>正味CF計（①'＋②）</th>
                        <td><input type="text" class="lbl widthBunki" id="d97" name="d97" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="e97" name="e97" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="f97" name="f97" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="g97" name="g97" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="h97" name="h97" readonly></td>
                    </tr>
                    <tr>
                        <th>割引率</th>
                        <td><input type="text" class="lbl widthBunki" id="d98" name="d98" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="e98" name="e98" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="f98" name="f98" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="g98" name="g98" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="h98" name="h98" readonly></td>
                    </tr>
                    <tr>
                        <th class="nwrp">①”税引後CIF（営業CF）</th>
                        <td><input type="text" class="lbl widthBunki" id="c99" name="c99" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="d99" name="d99" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="e99" name="e99" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="f99" name="f99" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="g99" name="g99" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="h99" name="h99" readonly></td>
                    </tr>
                    <tr>
                        <th>②'タックスシールド</th>
                        <td><input type="text" class="lbl widthBunki" id="c100" name="c100" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="d100" name="d100" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="e100" name="e100" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="f100" name="f100" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="g100" name="g100" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="h100" name="h100" readonly></td>
                    </tr>
                    <tr>
                        <th class="nwrp">割引現在価値合計（①"＋②'）</th>
                        <td><input type="text" class="lbl widthBunki blueBold" id="c101" name="c101" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="d101" name="d101" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="e101" name="e101" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="f101" name="f101" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="g101" name="g101" readonly></td>
                        <td><input type="text" class="lbl widthBunki" id="h101" name="h101" readonly></td>
                    </tr>
                    <tr>
                        <th>投資額</th>
                        <td><input type="text" class="lbl widthBunki redBold" id="c102" name="c102" readonly></td>
                        <td colspan=5></td>
                    </tr>
                </table>
                <br><br>
                <table class='hs'>
                    <colgroup span="1" class="areaA"></colgroup>
                    <colgroup span="1" class="areaB"></colgroup>
                    <colgroup span="1" class="areaC"></colgroup>
                    <colgroup span="5" class="areaD"></colgroup>
                    <tr>
                        <td colspan=8>
                            <div id="b104" name="b104"></div>
                        </td>
                    </tr>
                </table>


                <div class="no_print">
                    <br><br><a href="javascript:void(0)" class="btn-sakubun" onclick="sakubun(0)">自動作文</a><br><br>
                </div>

            </div>

            <div id="calcsheet">

                <h1>≪設備導入前≫</h1>
                <table class="calc">
                    <colgroup span="1" class="area1"></colgroup>
                    <colgroup span="1" class="area2"></colgroup>
                    <colgroup span="1" class="area3"></colgroup>
                    <colgroup span="1" class="area4"></colgroup>
                    <colgroup span="1" class="area5"></colgroup>
                    <colgroup span="1" class="area6"></colgroup>
                    <colgroup span="1" class="area7"></colgroup>
                    <tr>
                        <td colspan=7>
                            <h1>製造生産規模推計<br>（数）</h1>
                        </td>
                    </tr>
                    <tr>
                        <td>売上高／人</td>
                        <td class="uline"><input type="text" class="lbl" id="i6" name="i6" readonly></td>
                        <td class="tani">万円</td>
                        <td colspan=4></td>
                    </tr>
                    <tr>
                        <td>（内訳）</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>生菓子売上</td>
                        <td class="uline"><input type="text" class="lbl" id="i8" name="i8" readonly></td>
                        <td class="tani">万円</td>
                        <td colspan=4></td>
                    </tr>
                    <tr>
                        <td>焼菓子売上</td>
                        <td class="uline"><input type="text" class="lbl" id="i9" name="i9" readonly></td>
                        <td class="tani">万円</td>
                        <td colspan=4></td>
                    </tr>
                    <tr>
                        <td>（総合年産）</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>（一人当たり年産）</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="fline">生菓子商品点数</td>
                        <td class="fline"><input type="text" class="lbl" id="i11" name="i11" readonly></td>
                        <td class="fline">個/年間</td>
                        <td></td>
                        <td class="fline">焼菓子商品点数</td>
                        <td class="fline"><input type="text" class="lbl" id="m11" name="m11" readonly></td>
                        <td class="fline">個/年間</td>
                    </tr>
                    <tr>
                        <td class="fline">生菓子商品点数</td>
                        <td class="fline"><input type="text" class="lbl" id="i12" name="i12" readonly></td>
                        <td class="fline">個/年間</td>
                        <td></td>
                        <td class="fline">焼菓子商品点数</td>
                        <td class="fline"><input type="text" class="lbl" id="m12" name="m12" readonly></td>
                        <td class="fline">個/年間</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>（総合月産）</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>（一人当たり月産）</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="fline">生菓子商品点数</td>
                        <td class="fline"><input type="text" class="lbl" id="i15" name="i15" readonly></td>
                        <td class="fline">個/月間</td>
                        <td></td>
                        <td class="fline">焼菓子商品点数</td>
                        <td class="fline"><input type="text" class="lbl" id="m15" name="m15" readonly></td>
                        <td class="fline">個/月間</td>
                    </tr>
                    <tr>
                        <td class="fline">生菓子商品点数</td>
                        <td class="fline"><input type="text" class="lbl" id="i16" name="i16" readonly></td>
                        <td class="fline">個/月間</td>
                        <td></td>
                        <td class="fline">焼菓子商品点数</td>
                        <td class="fline"><input type="text" class="lbl" id="m16" name="m16" readonly></td>
                        <td class="fline">個/月間</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>（総合日産）</td>
                        <td><input type="number" class="number wdtSS" id="i18" name="i18" min="1" max="31"
                                value="25">営業日</td>
                        <td></td>
                        <td></td>
                        <td>（一人当たり日産）</td>
                        <td><input type="text" class="lbl wdtSS" id="m18" name="m18"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="fline">生菓子商品点数</td>
                        <td class="fline"><input type="text" class="lbl" id="i19" name="i19"></td>
                        <td class="fline">個/日間</td>
                        <td></td>
                        <td class="fline">焼菓子商品点数</td>
                        <td class="fline"><input type="text" class="lbl" id="m19" name="m19" readonly></td>
                        <td class="fline">個/日間</td>
                    </tr>
                    <tr>
                        <td class="fline">生菓子商品点数</td>
                        <td class="fline"><input type="text" class="lbl" id="i20" name="i20" readonly></td>
                        <td class="fline">個/日間</td>
                        <td></td>
                        <td class="fline">焼菓子商品点数</td>
                        <td class="fline"><input type="text" class="lbl" id="m20" name="m20" readonly></td>
                        <td class="fline">個/日間</td>
                    </tr>

                </table>

                <br><br>

                <table class="calc">
                    <colgroup span="1" class="area1"></colgroup>
                    <colgroup span="1" class="area2"></colgroup>
                    <colgroup span="1" class="area3"></colgroup>
                    <colgroup span="1" class="area4"></colgroup>
                    <colgroup span="1" class="area5"></colgroup>
                    <colgroup span="1" class="area6"></colgroup>
                    <colgroup span="1" class="area7"></colgroup>
                    <tr>
                        <td colspan=7>
                            <h1>実収益推計<br>（額）</h1>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="fline">平均単価</td>
                        <td></td>
                        <td class="fline">総原価</td>
                        <td></td>
                        <td class="fline">年間実収益/個<br>（決算書ベース）</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="fline">生）/個</td>
                        <td class="fline"><input type="text" class="lbl" id="q6" name="q6" readonly></td>
                        <td>－</td>
                        <td class="fline"><input type="text" class="lbl" id="s6" name="s6" readonly></td>
                        <td>→</td>
                        <td class="fline"><input type="text" class="lbl" id="u6" name="u6" readonly></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="fline">焼）/個</td>
                        <td class="fline"><input type="text" class="lbl" id="q7" name="q7" readonly></td>
                        <td>－</td>
                        <td class="fline"><input type="text" class="lbl" id="s7" name="s7" readonly></td>
                        <td>→</td>
                        <td class="fline"><input type="text" class="lbl" id="u7" name="u7" readonly></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>（総合年産）</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>（一人当たり年産）</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="fline">生菓子商品実収益</td>
                        <td class="fline"><input type="text" class="lbl" id="q11" name="q11" readonly></td>
                        <td class="fline">円/年間</td>
                        <td></td>
                        <td class="fline">生菓子商品実収益</td>
                        <td class="fline"><input type="text" class="lbl" id="u11" name="u11" readonly></td>
                        <td class="fline">円/年間</td>
                    </tr>
                    <tr>
                        <td class="fline">焼菓子商品実収益</td>
                        <td class="fline"><input type="text" class="lbl" id="q12" name="q12" readonly></td>
                        <td class="fline">円/年間</td>
                        <td></td>
                        <td class="fline">焼菓子商品実収益</td>
                        <td class="fline"><input type="text" class="lbl" id="u12" name="u12" readonly></td>
                        <td class="fline">円/年間</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>（総合月産）</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>（一人当たり月産）</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="fline">生菓子商品実収益</td>
                        <td class="fline"><input type="text" class="lbl" id="q15" name="q15" readonly></td>
                        <td class="fline">円/月間</td>
                        <td></td>
                        <td class="fline">生菓子商品実収益</td>
                        <td class="fline"><input type="text" class="lbl" id="u15" name="u15" readonly></td>
                        <td class="fline">円/月間</td>
                    </tr>
                    <tr>
                        <td class="fline">焼菓子商品実収益</td>
                        <td class="fline"><input type="text" class="lbl" id="q16" name="q16" readonly></td>
                        <td class="fline">円/月間</td>
                        <td></td>
                        <td class="fline">焼菓子商品実収益</td>
                        <td class="fline"><input type="text" class="lbl" id="u16" name="u16" readonly></td>
                        <td class="fline">円/月間</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>（総合日産）</td>
                        <td><input type="text" class="lbl wdtSS" id="q18" name="q18"></td>
                        <td></td>
                        <td></td>
                        <td>（一人当たり日産）</td>
                        <td><input type="text" class="lbl wdtSS" id="u18" name="u18"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="fline">生菓子商品実収益</td>
                        <td class="fline"><input type="text" class="lbl" id="q19" name="q19" readonly></td>
                        <td class="fline">円/日間</td>
                        <td></td>
                        <td class="fline">生菓子商品実収益</td>
                        <td class="fline"><input type="text" class="lbl" id="u19" name="u19" readonly></td>
                        <td class="fline">円/日間</td>
                    </tr>
                    <tr>
                        <td class="fline">焼菓子商品実収益</td>
                        <td class="fline"><input type="text" class="lbl" id="q20" name="q20" readonly></td>
                        <td class="fline">円/日間</td>
                        <td></td>
                        <td class="fline">焼菓子商品実収益</td>
                        <td class="fline"><input type="text" class="lbl" id="u20" name="u20" readonly></td>
                        <td class="fline">円/日間</td>
                    </tr>
                </table>

                <br><br>

                <h1>≪設備導入後≫</h1>
                <table class="calc">
                    <colgroup span="1" class="area1"></colgroup>
                    <colgroup span="1" class="area2"></colgroup>
                    <colgroup span="1" class="area3"></colgroup>
                    <colgroup span="1" class="area4"></colgroup>
                    <colgroup span="1" class="area5"></colgroup>
                    <colgroup span="1" class="area6"></colgroup>
                    <colgroup span="1" class="area7"></colgroup>
                    <tr>
                        <td colspan=7>
                            <h1>製造生産規模推計<br>（数）</h1>
                        </td>
                    </tr>
                    <tr>
                        <td>売上高／人</td>
                        <td class="uline"><input type="text" class="lbl" id="i44" name="i44" readonly></td>
                        <td class="tani">万円</td>
                        <td colspan=4></td>
                    </tr>
                    <tr>
                        <td>（内訳）</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>生菓子売上</td>
                        <td class="uline"><input type="text" class="lbl" id="i46" name="i46" readonly></td>
                        <td class="tani">万円</td>
                        <td colspan=4></td>
                    </tr>
                    <tr>
                        <td>焼菓子売上</td>
                        <td class="uline"><input type="text" class="lbl" id="i47" name="i47" readonly></td>
                        <td class="tani">万円</td>
                        <td colspan=4></td>
                    </tr>
                    <tr>
                        <td>（総合年産）</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>（一人当たり年産）</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="fline">生菓子商品点数</td>
                        <td class="fline"><input type="text" class="lbl" id="i49" name="i49" readonly></td>
                        <td class="fline">個/年間</td>
                        <td></td>
                        <td class="fline">焼菓子商品点数</td>
                        <td class="fline"><input type="text" class="lbl" id="m49" name="m49" readonly></td>
                        <td class="fline">個/年間</td>
                    </tr>
                    <tr>
                        <td class="fline">生菓子商品点数</td>
                        <td class="fline"><input type="text" class="lbl" id="i50" name="i50" readonly></td>
                        <td class="fline">個/年間</td>
                        <td></td>
                        <td class="fline">焼菓子商品点数</td>
                        <td class="fline"><input type="text" class="lbl" id="m50" name="m50" readonly></td>
                        <td class="fline">個/年間</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>（総合月産）</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>（一人当たり月産）</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="fline">生菓子商品点数</td>
                        <td class="fline"><input type="text" class="lbl" id="i53" name="i53" readonly></td>
                        <td class="fline">個/月間</td>
                        <td></td>
                        <td class="fline">焼菓子商品点数</td>
                        <td class="fline"><input type="text" class="lbl" id="m53" name="m53" readonly></td>
                        <td class="fline">個/月間</td>
                    </tr>
                    <tr>
                        <td class="fline">生菓子商品点数</td>
                        <td class="fline"><input type="text" class="lbl" id="i54" name="i54" readonly></td>
                        <td class="fline">個/月間</td>
                        <td></td>
                        <td class="fline">焼菓子商品点数</td>
                        <td class="fline"><input type="text" class="lbl" id="m54" name="m54" readonly></td>
                        <td class="fline">個/月間</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>（総合日産）</td>
                        <td><input type="number" class="number wdtSS" id="i56" name="i56" min="1" max="31"
                                value="25">営業日</td>
                        <td></td>
                        <td></td>
                        <td>（一人当たり日産）</td>
                        <td><input type="text" class="lbl wdtSS" id="m56" name="m56"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="fline">生菓子商品点数</td>
                        <td class="fline"><input type="text" class="lbl" id="i57" name="i57" readonly></td>
                        <td class="fline">個/日間</td>
                        <td></td>
                        <td class="fline">焼菓子商品点数</td>
                        <td class="fline"><input type="text" class="lbl" id="m57" name="m57" readonly></td>
                        <td class="fline">個/日間</td>
                    </tr>
                    <tr>
                        <td class="fline">生菓子商品点数</td>
                        <td class="fline"><input type="text" class="lbl" id="i58" name="i58" readonly></td>
                        <td class="fline">個/日間</td>
                        <td></td>
                        <td class="fline">焼菓子商品点数</td>
                        <td class="fline"><input type="text" class="lbl" id="m58" name="m58" readonly></td>
                        <td class="fline">個/日間</td>
                    </tr>

                </table>
                <br><br>

                <table class="calc">
                    <colgroup span="1" class="area1"></colgroup>
                    <colgroup span="1" class="area2"></colgroup>
                    <colgroup span="1" class="area3"></colgroup>
                    <colgroup span="1" class="area4"></colgroup>
                    <colgroup span="1" class="area5"></colgroup>
                    <colgroup span="1" class="area6"></colgroup>
                    <colgroup span="1" class="area7"></colgroup>
                    <tr>
                        <td colspan=7>
                            <h1>実収益推計<br>（額）</h1>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="fline">平均単価</td>
                        <td></td>
                        <td class="fline">総原価</td>
                        <td></td>
                        <td class="fline">年間実収益/個<br>（決算書ベース）</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="fline">生）/個</td>
                        <td class="fline"><input type="text" class="lbl" id="q44" name="q44" readonly></td>
                        <td>－</td>
                        <td class="fline"><input type="text" class="lbl" id="s44" name="s44" readonly></td>
                        <td>→</td>
                        <td class="fline"><input type="text" class="lbl" id="u44" name="u44" readonly></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="fline">焼）/個</td>
                        <td class="fline"><input type="text" class="lbl" id="q45" name="q45" readonly></td>
                        <td>－</td>
                        <td class="fline"><input type="text" class="lbl" id="s45" name="s45" readonly></td>
                        <td>→</td>
                        <td class="fline"><input type="text" class="lbl" id="u45" name="u45" readonly></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>（総合年産）</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>（一人当たり年産）</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="fline">生菓子商品実収益</td>
                        <td class="fline"><input type="text" class="lbl" id="q49" name="q49" readonly></td>
                        <td class="fline">円/年間</td>
                        <td></td>
                        <td class="fline">生菓子商品実収益</td>
                        <td class="fline"><input type="text" class="lbl" id="u49" name="u49" readonly></td>
                        <td class="fline">円/年間</td>
                    </tr>
                    <tr>
                        <td class="fline">焼菓子商品実収益</td>
                        <td class="fline"><input type="text" class="lbl" id="q50" name="q50" readonly></td>
                        <td class="fline">円/年間</td>
                        <td></td>
                        <td class="fline">焼菓子商品実収益</td>
                        <td class="fline"><input type="text" class="lbl" id="u50" name="u50" readonly></td>
                        <td class="fline">円/年間</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>（総合月産）</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>（一人当たり月産）</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="fline">生菓子商品実収益</td>
                        <td class="fline"><input type="text" class="lbl" id="q53" name="q53" readonly></td>
                        <td class="fline">円/月間</td>
                        <td></td>
                        <td class="fline">生菓子商品実収益</td>
                        <td class="fline"><input type="text" class="lbl" id="u53" name="u53" readonly></td>
                        <td class="fline">円/月間</td>
                    </tr>
                    <tr>
                        <td class="fline">焼菓子商品実収益</td>
                        <td class="fline"><input type="text" class="lbl" id="q54" name="q54" readonly></td>
                        <td class="fline">円/月間</td>
                        <td></td>
                        <td class="fline">焼菓子商品実収益</td>
                        <td class="fline"><input type="text" class="lbl" id="u54" name="u54" readonly></td>
                        <td class="fline">円/月間</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>（総合日産）</td>
                        <td><input type="text" class="lbl wdtSS" id="q56" name="q56"></td>
                        <td></td>
                        <td></td>
                        <td>（一人当たり日産）</td>
                        <td><input type="text" class="lbl wdtSS" id="u56" name="u56"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="fline">生菓子商品実収益</td>
                        <td class="fline"><input type="text" class="lbl" id="q57" name="q57" readonly></td>
                        <td class="fline">円/日間</td>
                        <td></td>
                        <td class="fline">生菓子商品実収益</td>
                        <td class="fline"><input type="text" class="lbl" id="u57" name="u57" readonly></td>
                        <td class="fline">円/日間</td>
                    </tr>
                    <tr>
                        <td class="fline">焼菓子商品実収益</td>
                        <td class="fline"><input type="text" class="lbl" id="q58" name="q58" readonly></td>
                        <td class="fline">円/日間</td>
                        <td></td>
                        <td class="fline">焼菓子商品実収益</td>
                        <td class="fline"><input type="text" class="lbl" id="u58" name="u58" readonly></td>
                        <td class="fline">円/日間</td>
                    </tr>
                </table>

            </div>


            <div id="report">


                <table class="rep">
                    <tr>
                        <td>
                            <hr class="skbnHr">
                            <textarea id="a1r" name="a1r" rows=20 class="sakubun"></textarea><br>
                        </td>
                    </tr>
                </table>
                <table class="rep">
                    <tr>
                        <td class="skbnGrph">
                            <div class="grph" id="graph1r"></div>
                        </td>
                    </tr>
                </table>
                <table class="rep">
                    <tr>
                        <td>
                        <hr class="skbnHr">
                            <textarea id="a6r" name="a6r" rows=6 class="sakubun"></textarea>
                        </td>
                    </tr>
                </table>
                <table class="repS">
                    <caption>（円）</caption>
                    <tr class="bgClr">
                        <th class="fline"></th>
                        <th class="fline">①平均単価</th>
                        <th class="fline">②材料費</th>
                        <th class="fline">③直接労務費</th>
                        <th class="fline">④間接労務費</th>
                        <th class="fline">⑤総原価<br>(②＋③＋④)</th>
                        <th class="fline">⑥収益/個</th>
                        <th class="fline">⑦収益率</th>
                    </tr>
                    <tr>
                        <th class="fline">生菓子</th>
                        <td class="fline">
                            <p id="b9r"></p>
                        </td>
                        <td class="fline">
                            <p id="c9r"></p>
                        </td>
                        <td class="fline redBold">
                            <p id="d9r"></p>
                        </td>
                        <td class="fline redBold">
                            <p id="e9r"></p>
                        </td>
                        <td class="fline">
                            <p id="f9r"></p>
                        </td>
                        <td class="fline">
                            <p id="g9r"></p>
                        </td>
                        <td class="fline">
                            <p id="h9r"></p>
                        </td>
                    </tr>
                    <tr>
                        <th class="fline">焼菓子</th>
                        <td class="fline">
                            <p id="b10r"></p>
                        </td>
                        <td class="fline">
                            <p id="c10r"></p>
                        </td>
                        <td class="fline">
                            <p id="d10r"></p>
                        </td>
                        <td class="fline">
                            <p id="e10r"></p>
                        </td>
                        <td class="fline">
                            <p id="f10r"></p>
                        </td>
                        <td class="fline">
                            <p id="g10r"></p>
                        </td>
                        <td class="fline">
                            <p id="h10r"></p>
                        </td>
                    </tr>
                </table>
                <table class="rep">
                    <tr>
                        <td>
                            <hr class="skbnHr">
                            <textarea id="a11r" name="a11r" rows=20 class="sakubun"></textarea><br>
                            <textarea id="a26r" name="a26r" rows=4 class="sakubun"></textarea><br>
                        </td>
                    </tr>
                </table>
                <table class="rep">
                    <tr>
                        <td class="skbnGrph">
                            <div class="grph" id="graph2r"></div>
                        </td>
                    </tr>
                </table>
                <table class="rep">
                    <tr>
                        <td>
                        <hr class="skbnHr">
                            <textarea id="a29r" name="a29r" rows=20 class="sakubun"></textarea>
                        </td>
                    </tr>
                </table>
                <table class="rep">
                    <tr>
                        <td>
                        <hr class="skbnHr">
                            <textarea id="a44r" name="a44r" rows=13 class="sakubun"></textarea>
                        </td>
                    </tr>
                </table>
                <table class="rep">
                    <tr>
                        <td class="skbnGrph">
                            <div class="grph" id="graph3r"></div>
                        </td>
                    </tr>
                </table>
                <br><br>
                <table class="repS">
                    <caption>（万円）</caption>
                    <tr class="bgClr">
                        <th class="fline"></th>
                        <th class="fline">売上額</th>
                        <th class="fline">直接労務費</th>
                        <th class="fline">間接労務費</th>
                        <th class="fline">労務費率</th>
                    </tr>
                    <tr>
                        <th class="fline">設備導入前</th>
                        <td class="fline">
                            <p id="b48r"></p>
                        </td>
                        <td class="fline">
                            <p id="c48r"></p>
                        </td>
                        <td class="fline">
                            <p id="d48r"></p>
                        </td>
                        <td class="fline">
                            <p id="e48r"></p>
                        </td>
                    </tr>
                    <tr>
                        <th class="fline">設備導入後</th>
                        <td class="fline">
                            <p id="b49r"></p>
                        </td>
                        <td class="fline">
                            <p id="c49r"></p>
                        </td>
                        <td class="fline">
                            <p id="d49r"></p>
                        </td>
                        <td class="fline">
                            <p id="e49r"></p>
                        </td>
                    </tr>
                    <tr>
                        <th class="fline">成長率/削減率</th>
                        <td class="fline">
                            <p id="b50r"></p>
                        </td>
                        <td class="fline">
                            <p id="c50r"></p>
                        </td>
                        <td class="fline">
                            <p id="d50r"></p>
                        </td>
                        <td class="fline">
                            <p id="e50r"></p>
                        </td>
                    </tr>
                </table>
                <table class="rep">
                    <tr>
                        <td>
                            <hr class="skbnHr">
                            <textarea id="a51r" name="a51r" rows=11 class="sakubun"></textarea>
                        </td>
                    </tr>
                </table>
                <table class="rep">
                    <tr>
                        <td class="skbnGrph">
                            <div class="grph" id="graph4r"></div>
                        </td>
                    </tr>
                </table>
                <table class="repS">
                    <caption>（円）</caption>
                    <tr class="bgClr">
                        <th class="fline">【生菓子】</th>
                        <th class="fline">①平均単価</th>
                        <th class="fline">②材料費</th>
                        <th class="fline">③直接労務費</th>
                        <th class="fline">④間接労務費</th>
                        <th class="fline">⑤総原価<br>(②＋③＋④)</th>
                        <th class="fline">⑥収益/個</th>
                        <th class="fline">⑦収益率</th>
                    </tr>
                    <tr>
                        <th class="fline">設備導入前</th>
                        <td class="fline">
                            <p id="b55r"></p>
                        </td>
                        <td class="fline">
                            <p id="c55r"></p>
                        </td>
                        <td class="fline">
                            <p id="d55r"></p>
                        </td>
                        <td class="fline">
                            <p id="e55r"></p>
                        </td>
                        <td class="fline">
                            <p id="f55r"></p>
                        </td>
                        <td class="fline">
                            <p id="g55r"></p>
                        </td>
                        <td class="fline">
                            <p id="h55r"></p>
                        </td>
                    </tr>
                    <tr>
                        <th class="fline">設備導入後</th>
                        <td class="fline">
                            <p id="b56r"></p>
                        </td>
                        <td class="fline">
                            <p id="c56r"></p>
                        </td>
                        <td class="fline redBold">
                            <p id="d56r"></p>
                        </td>
                        <td class="fline redBold">
                            <p id="e56r"></p>
                        </td>
                        <td class="fline">
                            <p id="f56r"></p>
                        </td>
                        <td class="fline">
                            <p id="g56r"></p>
                        </td>
                        <td class="fline redBold">
                            <p id="h56r"></p>
                        </td>
                    </tr>
                </table><br>
                <table class="repS">
                    <caption>（円）</caption>
                    <tr class="bgClr">
                        <th class="fline">【焼菓子】</th>
                        <th class="fline">①平均単価</th>
                        <th class="fline">②材料費</th>
                        <th class="fline">③直接労務費</th>
                        <th class="fline">④間接労務費</th>
                        <th class="fline">⑤総原価<br>(②＋③＋④)</th>
                        <th class="fline">⑥収益/個</th>
                        <th class="fline">⑦収益率</th>
                    </tr>
                    <tr>
                        <th class="fline">設備導入前</th>
                        <td class="fline">
                            <p id="b59r"></p>
                        </td>
                        <td class="fline">
                            <p id="c59r"></p>
                        </td>
                        <td class="fline ">
                            <p id="d59r"></p>
                        </td>
                        <td class="fline ">
                            <p id="e59r"></p>
                        </td>
                        <td class="fline">
                            <p id="f59r"></p>
                        </td>
                        <td class="fline">
                            <p id="g59r"></p>
                        </td>
                        <td class="fline">
                            <p id="h59r"></p>
                        </td>
                    </tr>
                    <tr>
                        <th class="fline">設備導入後</th>
                        <td class="fline">
                            <p id="b60r"></p>
                        </td>
                        <td class="fline">
                            <p id="c60r"></p>
                        </td>
                        <td class="fline redBold">
                            <p id="d60r"></p>
                        </td>
                        <td class="fline redBold">
                            <p id="e60r"></p>
                        </td>
                        <td class="fline">
                            <p id="f60r"></p>
                        </td>
                        <td class="fline">
                            <p id="g60r"></p>
                        </td>
                        <td class="fline redBold">
                            <p id="h60r"></p>
                        </td>
                    </tr>
                </table>
                <table class="rep">
                    <tr>
                        <td>
                            <hr class="skbnHr">
                            <textarea id="a62r" name="a62r" rows=4 class="sakubun"></textarea>
                        </td>
                        <td>
                            <hr class="skbnHr500">
                        </td>
                    </tr>
                </table>
                <table class="repS">
                    <caption>（円）</caption>
                    <tr class="bgClr">
                        <th class="fline">生産性指標</th>
                        <th class="fline">実施前</th>
                        <th class="fline">５年後</th>
                        <th class="fline">向上率</th>
                    </tr>
                    <tr>
                        <th class="fline">従業員数</th>
                        <td class="fline">
                            <p id="b66r"></p>
                        </td>
                        <td class="fline">
                            <p id="c66r"></p>
                        </td>
                        <td class="fline">
                            <p id="d66r"></p>
                        </td>
                    </tr>
                    <tr id="r67r">
                        <th class="fline">付加価値額</th>
                        <td class="fline">
                            <p id="b67r"></p>
                        </td>
                        <td class="fline">
                            <p id="c67r"></p>
                        </td>
                        <td class="fline">
                            <p id="d67r"></p>
                        </td>
                    </tr>
                    <tr id="r68r">
                        <th class="fline">一人当たり売上高</th>
                        <td class="fline">
                            <p id="b68r"></p>
                        </td>
                        <td class="fline">
                            <p id="c68r"></p>
                        </td>
                        <td class="fline">
                            <p id="d68r"></p>
                        </td>
                    </tr>
                    <tr id="r69r">
                        <th class="fline">一人当たり限界利益</th>
                        <td class="fline">
                            <p id="b69r"></p>
                        </td>
                        <td class="fline">
                            <p id="c69r"></p>
                        </td>
                        <td class="fline">
                            <p id="d69r"></p>
                        </td>
                    </tr>
                    <tr id="r70r">
                        <th class="fline">一人当たり貢献利益</th>
                        <td class="fline">
                            <p id="b70r"></p>
                        </td>
                        <td class="fline">
                            <p id="c70r"></p>
                        </td>
                        <td class="fline">
                            <p id="d70r"></p>
                        </td>
                    </tr>
                    <tr id="r71r">
                        <th class="fline">一人当たり付加価値額</th>
                        <td class="fline">
                            <p id="b71r"></p>
                        </td>
                        <td class="fline">
                            <p id="c71r"></p>
                        </td>
                        <td class="fline">
                            <p id="d71r"></p>
                        </td>
                    </tr>
                    <tr id="r72r">
                        <th class="fline">売上高付加価値率</th>
                        <td class="fline">
                            <p id="b72r"></p>
                        </td>
                        <td class="fline">
                            <p id="c72r"></p>
                        </td>
                        <td class="fline">
                            <p id="d72r"></p>
                        </td>
                    </tr>
                    <tr id="r73r">
                        <th class="fline">有形固定資産回転率</th>
                        <td class="fline">
                            <p id="b73r"></p>
                        </td>
                        <td class="fline">
                            <p id="c73r"></p>
                        </td>
                        <td class="fline">
                            <p id="d73r"></p>
                        </td>
                    </tr>
                    <tr id="r74r">
                        <th class="fline">労働装備率</th>
                        <td class="fline">
                            <p id="b74r"></p>
                        </td>
                        <td class="fline">
                            <p id="c74r"></p>
                        </td>
                        <td class="fline">
                            <p id="d74r"></p>
                        </td>
                    </tr>

                </table>

                <table class="rep">

                    <tr>
                        <td>
                            <hr class="skbnHr">
                            <textarea id="a75r" name="a75r" rows=14 class="sakubun"></textarea>
                        </td>
                        <td>
                            <hr class="skbnHr500">
                        </td>
                    </tr>

                </table>

                <table class="rep">

                    <tr>
                        <td>
                            <hr class="skbnHr">
                            <textarea id="a87r" name="a87r" rows=5 class="sakubun"></textarea>
                        </td>
                    </tr>

                </table>

                <table class="rep">


                    <tr>
                        <td rowspan=2 class="skbnGrph">
                            <div class="grph" id="graph5r"></div>
                        </td>
                    </tr>

                </table>

                <table class="rep">


                    <tr>
                        <td>
                            <table class="repS">
                                <caption>（円）</caption>
                                <tr class="bgClr">
                                    <th class="fline"></th>
                                    <th class="fline">前期実績</th>
                                    <th class="fline">1年目</th>
                                    <th class="fline">2年目</th>
                                    <th class="fline">3年目</th>
                                    <th class="fline">4年目</th>
                                    <th class="fline">5年目</th>
                                </tr>
                                <tr>
                                    <th class="fline">売上高</th>
                                    <td class="fline">
                                        <p id="b92r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="c92r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="d92r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="e92r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="f92r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="g92r"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="fline">損益分岐点売上高</th>
                                    <td class="fline">
                                        <p id="b93r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="c93r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="d93r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="e93r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="f93r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="g93r"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="fline">損益分岐点比率</th>
                                    <td class="fline blueBold">
                                        <p id="b94r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="c94r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="d94r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="e94r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="f94r"></p>
                                    </td>
                                    <td class="fline blueBold">
                                        <p id="g94r"></p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <table class="rep">
                    <tr>
                        <td>
                            <hr class="skbnHr">
                            <textarea id="a96r" name="a96r" rows=9 class="sakubun"></textarea>
                        </td>
                    </tr>
                </table>

                <table class="rep">

                    <tr>
                        <td rowspan=2 class="skbnGrph">
                            <div class="grph" id="graph6r"></div>
                        </td>
                    </tr>
                </table>
<br><br>
                <table class="rep">

                    <tr>
                        <td>
                            <table class="repS">
                                <caption>（円）</caption>
                                <tr class="bgClr">
                                    <th class="fline"></th>
                                    <th class="fline">投資時点</th>
                                    <th class="fline">1年目</th>
                                    <th class="fline">2年目</th>
                                    <th class="fline">3年目</th>
                                    <th class="fline">4年目</th>
                                    <th class="fline">5年目</th>
                                </tr>
                                <tr>
                                    <th class="fline">①CIF（営業CF）</th>
                                    <td rowspan=6 class="emptyTd"></td>
                                    <td class="fline">
                                        <p id="c104r" name="c104r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="d104r" name="d104r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="e104r" name="e104r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="f104r" name="f104r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="g104r" name="g104r"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="fline">①'税引き後CIF（営業CF）</th>
                                    <td class="fline">
                                        <p id="c105r" name="c105r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="d105r" name="d105r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="e105r" name="e105r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="f105r" name="f105r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="g105r" name="g105r"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="fline">　設備の減価償却費</th>
                                    <td class="fline">
                                        <p id="c106r" name="c106r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="d106r" name="d106r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="e106r" name="e106r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="f106r" name="f106r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="g106r" name="g106r"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="fline">②減価償却費のﾀｯｸｽｼｰﾙﾄﾞ</th>
                                    <td class="fline">
                                        <p id="c107r" name="c107r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="d107r" name="d107r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="e107r" name="e107r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="f107r" name="f107r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="g107r" name="g107r"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="fline">正味CF計（①'＋②）</th>
                                    <td class="fline">
                                        <p id="c108r" name="c108r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="d108r" name="d108r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="e108r" name="e108r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="f108r" name="f108r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="g108r" name="g108r"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="fline">割引率</th>
                                    <td class="fline">
                                        <p id="c109r" name="c109r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="d109r" name="d109r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="e109r" name="e109r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="f109r" name="f109r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="g109r" name="g109r"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="fline">①”税引後CIF（営業CF）</th>
                                    <td class="fline">
                                        <p id="b110r" name="b110r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="c110r" name="c110r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="d110r" name="d110r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="e110r" name="e110r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="f110r" name="f110r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="g110r" name="g110r"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="fline">②'タックスシールド</th>
                                    <td class="fline">
                                        <p id="b111r" name="b111r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="c111r" name="c111r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="d111r" name="d111r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="e111r" name="e111r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="f111r" name="f111r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="g111r" name="g111r"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="fline">割引現在価値合計（①"＋②'）</th>
                                    <td class="fline blueBold">
                                        <p id="b112r" name="b112r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="c112r" name="c112r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="d112r" name="d112r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="e112r" name="e112r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="f112r" name="f112r"></p>
                                    </td>
                                    <td class="fline">
                                        <p id="g112r" name="g112r"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="fline">投資額</th>
                                    <td class="fline redBold">
                                        <p id="b113r" name="b113r"></p>
                                    </td>
                                    <td colspan=5></td>
                                </tr>

                            </table>
                        </td>
                    </tr>





                </table>



            </div>
        </div>
    </form>
    <br><br><br>



</body>

</html>