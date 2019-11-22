<?php

// セッション開始
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

$test = 1;

?>

<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../css/main.css" />
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/cal.js"></script>
    <script src="../js/sakubun.js"></script>
    <script src="../js/test.js"></script>
</head>

<body>

    <?php include './menu.php'; ?>

    <div id="content">

        <div id="inputsheet">

            <h1>≪設備導入前≫</h1>
            <table class='hs'>
                <colgroup span="1" class="areaA"></colgroup>
                <colgroup span="1" class="areaB"></colgroup>
                <colgroup span="1" class="areaC"></colgroup>
                <colgroup span="1" class="areaD"></colgroup>
                <?php if($test==1){ ?>
                <tr>
                    <td colspan=4><input type="text" style="width:500px;" id="d0" name="d0"></td>
                </tr>
                <?php } ?>
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
                        <input type="text" class="number wdtSS" id="d8" name="d8">
                        ：<input type="text" class="number wdtSS" id="f8" name="f8">
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
                    <td><input type="text" class="number" id="d11" name="d11"></td>
                    <td>円／個</td>
                </tr>
                <tr>
                    <td>焼菓子平均単価</td>
                    <td><input type="text" class="number" id="d12" name="d12"></td>
                    <td>円／個</td>
                </tr>
                <tr>
                    <th></th>
                    <td>（材料原価）</td>
                    <td>率 <input type="text" class="number wdtS" id="e13" name="e13">%</td>
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
                    <td></td>
                </tr>
                <tr>
                    <td>焼菓子平均総原価</td>
                    <td><input type="text" class="lbl" id="d24" name="d24" readonly></td>
                    <td></td>
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
                    <td><input type="number" class="number" id="d29" name="d29" min="100" max="200" step="0.5"
                            onchange="document.getElementById('scrl1').value=this.value"></td>
                    <td>%</td>
                    <td><input type="range" id="scrl1" value="1" min="100" max="200" step="0.5"
                            oninput="document.getElementById('d29').value=this.value"></td>
                </tr>
                <tr>
                    <th>製造原価低減</th>
                    <td>マイナス<input type="number" class="number wdtS" id="d30" name="d30" min="0" max="100"></td>
                    <td>%</td>
                    <td></td>
                </tr>
                <tr>
                    <th>製造　増員数</th>
                    <td>プラス<input type="number" class="number wdtS" id="d31" name="d31" min="0" max="999"></td>
                    <td>名</td>
                    <td></td>
                </tr>
                <tr>
                    <th>生菓子：焼菓子　＝</th>
                    <td><input type="text" class="lbl wdtSSS" id="d32" name="d32" readonly>：<input type="text"
                            class="lbl wdtSSS" id="f32" name="f32" readonly></td>
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
                    <td>税抜</td>
                    <td></td>
                </tr>
                <tr>
                    <th>設備2</th>
                    <td><input type="text" class="number" id="l30" name="l30"></td>
                    <td>税抜</td>
                    <td></td>
                </tr>
                <tr>
                    <th>設備3</th>
                    <td><input type="text" class="number" id="l31" name="l31"></td>
                    <td>税抜</td>
                    <td></td>
                </tr>
                <tr>
                    <th>計</th>
                    <td><input type="text" class="lbl" id="l32" name="l32" readonly></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th>補助率</th>
                    <td><select style="f130P" id="l33">
                            <option value=0>1/2
                            <option value=1>2/3
                        </select></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th>補助額</th>
                    <td><input type="text" class="lbl" id="l34" name="l34" readonly></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th>一括償却</th>
                    <td><select style="f130P" id="l35">
                            <option value=0>する
                            <option value=1>しない
                        </select></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th>減価償却費</th>
                    <td><input type="text" class="lbl" id="l36" name="l36" readonly></td>
                    <td><input type="text" class="lbl" id="m36" name="m36" readonly></td>
                    <td></td>
                </tr>
                <tr>
                    <th></th>
                    <td></td>
                    <td></td>
                    <td></td>
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
                    <td><input type="text" class="lbl" id="f35" name="f35" readonly></td>
                </tr>
                <tr>
                    <td>付加価値額 成長</td>
                    <td><input type="text" class="lbl" id="d36" name="d36" readonly></td>
                    <td><input type="text" class="lbl" id="f36" name="f36" readonly></td>
                </tr>
                <tr>
                    <td>労働生産性 成長</td>
                    <td><input type="text" class="lbl" id="d37" name="d37" readonly></td>
                    <td><input type="text" class="lbl" id="f37" name="f37" readonly></td>
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
                    <td><input type="text" class="number" id="d49" name="d49"></td>
                    <td>円／個</td>
                </tr>
                <tr>
                    <td>焼菓子平均単価</td>
                    <td><input type="text" class="number" id="d50" name="d50"></td>
                    <td>円／個</td>
                </tr>
                <tr>
                    <th></th>
                    <td>（材料原価）</td>
                    <td>率 <input type="text" class="number wdtS" id="e51" name="e51">%</td>
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
                    <td></td>
                </tr>
                <tr>
                    <td>焼菓子平均総原価</td>
                    <td><input type="text" class="lbl" id="d62" name="d62" readonly></td>
                    <td></td>
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
                    <td><input type="number" class="number wdtSS" id="c68" name="c68">%</td>
                    <td><input type="text" class="lbl" id="d68" name="d68" readonly></td>
                    <td><input type="text" class="lbl" id="g68" name="g68" readonly></td>
                </tr>
                <tr>
                    <td>付加価値額 成長</td>
                    <td><input type="number" class="number wdtSS" id="c69" name="c69">%</td>
                    <td><input type="text" class="lbl" id="d69" name="d69" readonly></td>
                    <td><input type="text" class="lbl" id="g69" name="g69" readonly></td>
                </tr>
            </table>


            <h3>２．労働生産性</h3>
            <table class='hs'>
                <colgroup span="1" class="areaA"></colgroup>
                <colgroup span="1" class="areaB"></colgroup>
                <colgroup span="1" class="areaC"></colgroup>
                <colgroup span="1" class="areaD"></colgroup>
                <tr>
                    <th colspan=2>有形固定資産</th>
                    <td colspan=2><input type="text" class="number" id="l73" name="l73"></td>
                </tr>
            </table>

            <table class='hs'>
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
                    <td><input type="text" class="lbl" id="g73" name="g73" readonly></td>
                </tr>
            </table>




            <h3>３．損益分岐点の推移</h3>

            <table class='hs'>
                <colgroup span="1" class="areaA"></colgroup>
                <colgroup span="1" class="areaB"></colgroup>
                <colgroup span="1" class="areaC"></colgroup>
                <colgroup span="4" class="areaD"></colgroup>
                <tr>
                    <th></th>
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
                    <td><input type="text" class="lbl" id="c77" name="c77" readonly></td>
                    <td><input type="text" class="lbl" id="d77" name="d77" readonly></td>
                    <td><input type="text" class="lbl" id="e77" name="e77" readonly></td>
                    <td><input type="text" class="lbl" id="g77" name="g77" readonly></td>
                    <td><input type="text" class="lbl" id="h77" name="h77" readonly></td>
                    <td><input type="text" class="lbl" id="i77" name="i77" readonly></td>
                    <td></td>
                </tr>
                <tr>
                    <th>損益分岐点売上高</th>
                    <td><input type="text" class="lbl" id="c78" name="c78" readonly></td>
                    <td><input type="text" class="lbl" id="d78" name="d78" readonly></td>
                    <td><input type="text" class="lbl" id="e78" name="e78" readonly></td>
                    <td><input type="text" class="lbl" id="g78" name="g78" readonly></td>
                    <td><input type="text" class="lbl" id="h78" name="h78" readonly></td>
                    <td><input type="text" class="lbl" id="i78" name="i78" readonly></td>
                    <td></td>
                </tr>
                <tr>
                    <th>損益分岐点比率</th>
                    <td><input type="text" class="lbl" id="c79" name="c79" readonly></td>
                    <td><input type="text" class="lbl" id="d79" name="d79" readonly></td>
                    <td><input type="text" class="lbl" id="e79" name="e79" readonly></td>
                    <td><input type="text" class="lbl" id="g79" name="g79" readonly></td>
                    <td><input type="text" class="lbl" id="h79" name="h79" readonly></td>
                    <td><input type="text" class="lbl" id="i79" name="i79" readonly></td>
                    <td></td>
                </tr>
            </table>




            <h3>４．投資判断としての妥当性</h3>
            <table class='hs'>
                <tr>
                    <td><input type="button" value="自動計算" onclick="btning();"></td>
                </tr>
            </table>

            <br><br>

            <table class='hs'>
                <colgroup span="1" class="areaA"></colgroup>
                <colgroup span="1" class="areaB"></colgroup>
                <colgroup span="1" class="areaC"></colgroup>
                <colgroup span="1" class="areaD"></colgroup>
                <tr>
                    <th>判定</th>
                    <td><input type="text" class="lbl" id="c83" name="c83" readonly></td>
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
                    <td><input type="number" class="number wdtSS" id="c88" name="c88">%</td>
                </tr>
                <tr>
                    <th>資本コスト</th>
                    <td><input type="number" class="number wdtSS" id="c89" name="c89">%</td>
                </tr>
            </table>

            <br><br>

            <table class='hs'>
                <colgroup span="1" class="areaA"></colgroup>
                <colgroup span="1" class="areaB"></colgroup>
                <colgroup span="1" class="areaC"></colgroup>
                <colgroup span="4" class="areaD"></colgroup>
                <tr>
                    <th></th>
                    <th>投資時点</th>
                    <th>1年目</th>
                    <th>2年目</th>
                    <th>3年目</th>
                    <th>4年目</th>
                    <th>5年目</th>
                </tr>
                <tr>
                    <th>①CIF（営業CF）</th>
                    <td rowspan=6></td>
                    <td><input type="text" class="lbl" id="d93" name="d93" readonly></td>
                    <td><input type="text" class="lbl" id="e93" name="e93" readonly></td>
                    <td><input type="text" class="lbl" id="f93" name="f93" readonly></td>
                    <td><input type="text" class="lbl" id="g93" name="g93" readonly></td>
                    <td><input type="text" class="lbl" id="h93" name="h93" readonly></td>
                </tr>
                <tr>
                    <th>①'税引き後CIF（営業CF）</th>
                    <td><input type="text" class="lbl" id="d94" name="d94" readonly></td>
                    <td><input type="text" class="lbl" id="e94" name="e94" readonly></td>
                    <td><input type="text" class="lbl" id="f94" name="f94" readonly></td>
                    <td><input type="text" class="lbl" id="g94" name="g94" readonly></td>
                    <td><input type="text" class="lbl" id="h94" name="h94" readonly></td>
                </tr>
                <tr>
                    <th>　設備の減価償却費</th>
                    <td><input type="text" class="lbl" id="d95" name="d95" readonly></td>
                    <td><input type="text" class="lbl" id="e95" name="e95" readonly></td>
                    <td><input type="text" class="lbl" id="f95" name="f95" readonly></td>
                    <td><input type="text" class="lbl" id="g95" name="g95" readonly></td>
                    <td><input type="text" class="lbl" id="h95" name="h95" readonly></td>
                </tr>
                <tr>
                    <th>②減価償却費のﾀｯｸｽｼｰﾙﾄﾞ</th>
                    <td><input type="text" class="lbl" id="d96" name="d96" readonly></td>
                    <td><input type="text" class="lbl" id="e96" name="e96" readonly></td>
                    <td><input type="text" class="lbl" id="f96" name="f96" readonly></td>
                    <td><input type="text" class="lbl" id="g96" name="g96" readonly></td>
                    <td><input type="text" class="lbl" id="h96" name="h96" readonly></td>
                </tr>
                <tr>
                    <th>正味CF計（①'＋②）</th>
                    <td><input type="text" class="lbl" id="d97" name="d97" readonly></td>
                    <td><input type="text" class="lbl" id="e97" name="e97" readonly></td>
                    <td><input type="text" class="lbl" id="f97" name="f97" readonly></td>
                    <td><input type="text" class="lbl" id="g97" name="g97" readonly></td>
                    <td><input type="text" class="lbl" id="h97" name="h97" readonly></td>
                </tr>
                <tr>
                    <th>割引率</th>
                    <td><input type="text" class="lbl" id="d98" name="d98" readonly></td>
                    <td><input type="text" class="lbl" id="e98" name="e98" readonly></td>
                    <td><input type="text" class="lbl" id="f98" name="f98" readonly></td>
                    <td><input type="text" class="lbl" id="g98" name="g98" readonly></td>
                    <td><input type="text" class="lbl" id="h98" name="h98" readonly></td>
                </tr>
                <tr>
                    <th>①”税引後CIF（営業CF）</th>
                    <td><input type="text" class="lbl" id="c99" name="c99" readonly></td>
                    <td><input type="text" class="lbl" id="d99" name="d99" readonly></td>
                    <td><input type="text" class="lbl" id="e99" name="e99" readonly></td>
                    <td><input type="text" class="lbl" id="f99" name="f99" readonly></td>
                    <td><input type="text" class="lbl" id="g99" name="g99" readonly></td>
                    <td><input type="text" class="lbl" id="h99" name="h99" readonly></td>
                </tr>
                <tr>
                    <th>②'タックスシールド</th>
                    <td><input type="text" class="lbl" id="c100" name="c100" readonly></td>
                    <td><input type="text" class="lbl" id="d100" name="d100" readonly></td>
                    <td><input type="text" class="lbl" id="e100" name="e100" readonly></td>
                    <td><input type="text" class="lbl" id="f100" name="f100" readonly></td>
                    <td><input type="text" class="lbl" id="g100" name="g100" readonly></td>
                    <td><input type="text" class="lbl" id="h100" name="h100" readonly></td>
                </tr>
                <tr>
                    <th>割引現在価値合計（①"＋②'）</th>
                    <td><input type="text" class="lbl" id="c101" name="c101" readonly></td>
                    <td><input type="text" class="lbl" id="d101" name="d101" readonly></td>
                    <td><input type="text" class="lbl" id="e101" name="e101" readonly></td>
                    <td><input type="text" class="lbl" id="f101" name="f101" readonly></td>
                    <td><input type="text" class="lbl" id="g101" name="g101" readonly></td>
                    <td><input type="text" class="lbl" id="h101" name="h101" readonly></td>
                </tr>
                <tr>
                    <th>投資額</th>
                    <td><input type="text" class="lbl" id="c102" name="c102" readonly></td>
                    <td colspan=5></td>
                </tr>
            </table>


        </div>
        <br><br>
        <hr><br><br>
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
                    <td colspan=7><?php if($test==1){ ?> <input type="text"><?php } ?></td>
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
                    <td class="fline">生菓子商品点数</td>
                    <td class="fline"><input type="text" class="lbl" id="m11" name="m11" readonly></td>
                    <td class="fline">個/年間</td>
                </tr>
                <tr>
                    <td class="fline">焼菓子商品点数</td>
                    <td class="fline"><input type="text" class="lbl" id="i12" name="i12" readonly></td>
                    <td class="fline">個/年間</td>
                    <td></td>
                    <td class="fline">生菓子商品点数</td>
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
                    <td class="fline">生菓子商品点数</td>
                    <td class="fline"><input type="text" class="lbl" id="m15" name="m15" readonly></td>
                    <td class="fline">個/月間</td>
                </tr>
                <tr>
                    <td class="fline">焼菓子商品点数</td>
                    <td class="fline"><input type="text" class="lbl" id="i16" name="i16" readonly></td>
                    <td class="fline">個/月間</td>
                    <td></td>
                    <td class="fline">生菓子商品点数</td>
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
                    <td><input type="number" class="number wdtSS" id="i18" name="i18" min="1" max="31">営業日</td>
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
                    <td class="fline">生菓子商品点数</td>
                    <td class="fline"><input type="text" class="lbl" id="m19" name="m19" readonly></td>
                    <td class="fline">個/日間</td>
                </tr>
                <tr>
                    <td class="fline">焼菓子商品点数</td>
                    <td class="fline"><input type="text" class="lbl" id="i20" name="i20" readonly></td>
                    <td class="fline">個/日間</td>
                    <td></td>
                    <td class="fline">生菓子商品点数</td>
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
                    <td colspan=7><?php if($test==1){ ?> <input type="text"><?php } ?></td>
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
                    <td colspan=7><?php if($test==1){ ?> <input type="text"><?php } ?></td>
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
                    <td class="fline">生菓子商品点数</td>
                    <td class="fline"><input type="text" class="lbl" id="m49" name="m49" readonly></td>
                    <td class="fline">個/年間</td>
                </tr>
                <tr>
                    <td class="fline">焼菓子商品点数</td>
                    <td class="fline"><input type="text" class="lbl" id="i50" name="i50" readonly></td>
                    <td class="fline">個/年間</td>
                    <td></td>
                    <td class="fline">生菓子商品点数</td>
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
                    <td class="fline">生菓子商品点数</td>
                    <td class="fline">
                        <<input type="text" class="lbl" id="m53" name="m53" readonly>/td>
                    <td class="fline">個/月間</td>
                </tr>
                <tr>
                    <td class="fline">焼菓子商品点数</td>
                    <td class="fline"><input type="text" class="lbl" id="i54" name="i54" readonly></td>
                    <td class="fline">個/月間</td>
                    <td></td>
                    <td class="fline">生菓子商品点数</td>
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
                    <td><input type="number" class="number wdtSS" id="i56" name="i56" min="1" max="31">営業日</td>
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
                    <td class="fline">生菓子商品点数</td>
                    <td class="fline"><input type="text" class="lbl" id="m57" name="m57" readonly></td>
                    <td class="fline">個/日間</td>
                </tr>
                <tr>
                    <td class="fline">焼菓子商品点数</td>
                    <td class="fline"><input type="text" class="lbl" id="i58" name="i58" readonly></td>
                    <td class="fline">個/日間</td>
                    <td></td>
                    <td class="fline">生菓子商品点数</td>
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
                    <td colspan=7><?php if($test==1){ ?> <input type="text"><?php } ?></td>
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

        <br><br>
        <hr><br><br>

        <div id="report">

            <table class="rep">
                <colgroup span="1" class="report1"></colgroup>
                <colgroup span="1" class="report2"></colgroup>
                <colgroup span="1" class="report3"></colgroup>
                <colgroup span="1" class="report4"></colgroup>
                <colgroup span="1" class="report5"></colgroup>
                <colgroup span="1" class="report6"></colgroup>
                <colgroup span="1" class="report7"></colgroup>
                <colgroup span="1" class="report8"></colgroup>
                <colgroup span="1" class="report9"></colgroup>
                <tr>
                    <td colspan=8>
                        <div id="a1r"></div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan=9>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan=8>
                        <div id="a6r"></div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="fline"></td>
                    <td class="fline">①平均単価</td>
                    <td class="fline">②材料費</td>
                    <td class="fline">③直接労務費</td>
                    <td class="fline">④間接労務費</td>
                    <td class="fline">⑤総原価<br>(②＋③＋④)</td>
                    <td class="fline">⑥収益/個</td>
                    <td class="fline">⑦収益率</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="fline">生菓子</td>
                    <td class="fline"><div id="b9r"></div></td>
                    <td class="fline"><div id="c9r"></div></td>
                    <td class="fline redBold"><div id="d9r"></div></td>
                    <td class="fline redBold"><div id="e9r"></div></td>
                    <td class="fline"><div id="f9r"></div></td>
                    <td class="fline"><div id="g9r"></div></td>
                    <td class="fline"><div id="h9r"></div></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="fline">焼菓子</td>
                    <td class="fline"><div id="b10r"></div></td>
                    <td class="fline"><div id="c10r"></div></td>
                    <td class="fline redBold"><div id="d10r"></div></td>
                    <td class="fline redBold"><div id="e10r"></div></td>
                    <td class="fline"><div id="f10r"></div></td>
                    <td class="fline"><div id="g10r"></div></td>
                    <td class="fline"><div id="h10r"></div></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan=8>
                        <div id="a11r"></div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan=8>
                        <div id="a26r"></div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan=8>
                        <div id="a29r"></div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan=9>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan=8>
                        <div id="a44r"></div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="fline"></td>
                    <td class="fline">売上額</td>
                    <td class="fline">直接労務費</td>
                    <td class="fline">間接労務費</td>
                    <td class="fline">労務費率</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="fline">設備導入前</td>
                    <td class="fline"><div id="b48r"></div></td>
                    <td class="fline"><div id="c48r"></div></td>
                    <td class="fline"><div id="d48r"></div></td>
                    <td class="fline"><div id="e48r"></div></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="fline">設備導入後</td>
                    <td class="fline"><div id="b49r"></div></td>
                    <td class="fline"><div id="c49r"></div></td>
                    <td class="fline"><div id="d49r"></div></td>
                    <td class="fline"><div id="e49r"></div></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="fline">成長率/削減率</td>
                    <td class="fline"><div id="b50r"></div></td>
                    <td class="fline"><div id="c50r"></div></td>
                    <td class="fline"><div id="d50r"></div></td>
                    <td class="fline"><div id="e50r"></div></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan=8>
                        <div id="a51r"></div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="fline">【生菓子】</td>
                    <td class="fline">①平均単価</td>
                    <td class="fline">②材料費</td>
                    <td class="fline">③直接労務費</td>
                    <td class="fline">④間接労務費</td>
                    <td class="fline">⑤総原価<br>(②＋③＋④)</td>
                    <td class="fline">⑥収益/個</td>
                    <td class="fline">⑦収益率</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="fline">設備導入前</td>
                    <td class="fline"><div id="b55r"></div></td>
                    <td class="fline"><div id="c55r"></div></td>
                    <td class="fline redBold"><div id="d55r"></div></td>
                    <td class="fline redBold"><div id="e55r"></div></td>
                    <td class="fline"><div id="f55r"></div></td>
                    <td class="fline"><div id="g55r"></div></td>
                    <td class="fline"><div id="h55r"></div></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="fline">設備導入後</td>
                    <td class="fline"><div id="b56r"></div></td>
                    <td class="fline"><div id="c56r"></div></td>
                    <td class="fline redBold"><div id="d56r"></div></td>
                    <td class="fline redBold"><div id="e56r"></div></td>
                    <td class="fline"><div id="f56r"></div></td>
                    <td class="fline"><div id="g56r"></div></td>
                    <td class="fline"><div id="h56r"></div></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan=9></td>
                </tr>
                <tr>
                    <td class="fline">【焼菓子】</td>
                    <td class="fline">①平均単価</td>
                    <td class="fline">②材料費</td>
                    <td class="fline">③直接労務費</td>
                    <td class="fline">④間接労務費</td>
                    <td class="fline">⑤総原価<br>(②＋③＋④)</td>
                    <td class="fline">⑥収益/個</td>
                    <td class="fline">⑦収益率</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="fline">設備導入前</td>
                    <td class="fline"><div id="b59r"></div></td>
                    <td class="fline"><div id="c59r"></div></td>
                    <td class="fline redBold"><div id="d59r"></div></td>
                    <td class="fline redBold"><div id="e59r"></div></td>
                    <td class="fline"><div id="f59r"></div></td>
                    <td class="fline"><div id="g59r"></div></td>
                    <td class="fline"><div id="h59r"></div></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="fline">設備導入後</td>
                    <td class="fline"><div id="b60r"></div></td>
                    <td class="fline"><div id="c60r"></div></td>
                    <td class="fline redBold"><div id="d60r"></div></td>
                    <td class="fline redBold"><div id="e60r"></div></td>
                    <td class="fline"><div id="f60r"></div></td>
                    <td class="fline"><div id="g60r"></div></td>
                    <td class="fline"><div id="h60r"></div></td>
                    <td></td>
                </tr>
            </table>



        </div>
    </div>
    <br><br><br>

</body>

</html>