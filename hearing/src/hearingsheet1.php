<?php

// セッション開始
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

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
    <script src="../js/test.js"></script>
</head>

<body>

    <?php include './menu.php'; ?>

    <div id="content">
        <h1>≪設備導入前≫</h1>
        <table class='hs'>
            <colgroup span="1" class="areaA"></colgroup>
            <colgroup span="1" class="areaB"></colgroup>
            <colgroup span="1" class="areaC"></colgroup>
            <colgroup span="1" class="areaD"></colgroup>
            <!--
            <tr>
                <td colspan=4><input type="text" id="d0" name="d0"></td>
            </tr>
            -->
            <tr>
                <th colspan=2>（入）売上規模／年</th>
                <td><input type="text" class="number" id="d2" name="d2"></td>
                <td>万円<!-- <input type="button" onclick="demo()"> --></td>
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
                <td><label id="d5"></td>
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
                <td><label id="e9"></td>
            </tr>
            <tr>
                <td></td>
                <td>（売り平均単価）</td>
                <td>割合</td>
                <td><label id="e10"></td>
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
                <td><label id="d14"></td>
                <td>円／個</td>
            </tr>
            <tr>
                <td>焼菓子平均材料原価</td>
                <td><label id="d15"></td>
                <td>円／個</td>
            </tr>
            <tr>
                <td colspan=4>&nbsp;</td>
            </tr>
            <tr>
                <th rowspan=2>労務</th>
                <td>生菓子平均労務費</td>
                <td><label id="d17"></td>
                <td>円／個</td>
            </tr>
            <tr>
                <td>焼菓子平均労務費</td>
                <td><label id="d18"></td>
                <td>円／個</td>
            </tr>
            <tr>
                <td colspan=4>&nbsp;</td>
            </tr>
            <tr>
                <th rowspan=2>販管</th>
                <td>生菓子平均販管費</td>
                <td><label id="d20"></td>
                <td>円／個</td>
            </tr>
            <tr>
                <td>焼菓子平均販管費</td>
                <td><label id="d21"></td>
                <td>円／個</td>
            </tr>
            <tr>
                <td colspan=4>&nbsp;</td>
            </tr>
            <tr>
                <th rowspan=2>総原価</th>
                <td>生菓子平均総原価</td>
                <td><label id="d23"></td>
                <td></td>
            </tr>
            <tr>
                <td>焼菓子平均総原価</td>
                <td><label id="d24"></td>
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
                <td><input type="number" class="number" id="d29" name="d29" min="100" max="200" step="0.5"></td>
                <td>%</td>
                <td><input type="range" value="1" min="100" max="200" step="1"  oninput="document.getElementById('d29').value=this.value"></td>
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
                <td><label id="d32"></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>生菓子平均単価</th>
                <td><label id="i31"></td>
                <td>円／個</td>
                <td></td>
            </tr>
            <tr>
                <th>焼菓子平均単価</th>
                <td><label id="i32"></td>
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
                <td><label id="l32"></td>
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
                <td><label id="l34"></td>
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
                <td><label id="l36"></td>
                <td><label id="m36"></td>
                <td></td>
            </tr>
            <tr>
                <th></th>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>

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
                <td><label id="d35"></td>
                <td><label id="f35"></td>
            </tr>
            <tr>
                <td>付加価値額 成長</td>
                <td><label id="d36"></td>
                <td><label id="f36"></td>
            </tr>
            <tr>
                <td>労働生産性 成長</td>
                <td><label id="d37"></td>
                <td><label id="f37"></td>
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
                <td><label id="d40"></td>
                <td>万円</td>
            </tr>
            <tr>
                <th colspan=2>（出）労務費／年</th>
                <td><label id="d41"></td>
                <td>万円</td>
            </tr>
            <tr>
                <th colspan=2>（出）販管人件費／年</th>
                <td><label id="d42"></td>
                <td>万円</td>
            </tr>
            <tr>
                <td></td>
                <td>= 粗利率</td>
                <td><label id="d43"></td>
                <td>※仕入除く</td>
            </tr>
            <tr>
                <th colspan=2>従業員数（製造）</th>
                <td><label id="d44"></td>
                <td>名</td>
            </tr>
            <tr>
                <td colspan=4>&nbsp;</td>
            </tr>
            <tr>
                <td></td>
                <td>（商品点数ﾍﾞｰｽ）</td>
                <td>割合</td>
                <td><label id="e47"></td>
            </tr>
            <tr>
                <td></td>
                <td>（売り平均単価）</td>
                <td>割合</td>
                <td><label id="e48"></td>
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
                <td><label id="d52"></td>
                <td>円／個</td>
            </tr>
            <tr>
                <td>焼菓子平均材料原価</td>
                <td><label id="d53"></td>
                <td>円／個</td>
            </tr>
            <tr>
                <td colspan=4>&nbsp;</td>
            </tr>
            <tr>
                <th rowspan=2>労務</th>
                <td>生菓子平均労務費</td>
                <td><label id="d55"></td>
                <td>円／個</td>
            </tr>
            <tr>
                <td>焼菓子平均労務費</td>
                <td><label id="d56"></td>
                <td>円／個</td>
            </tr>
            <tr>
                <td colspan=4>&nbsp;</td>
            </tr>
            <tr>
                <th rowspan=2>販管</th>
                <td>生菓子平均販管費</td>
                <td><label id="d58"></td>
                <td>円／個</td>
            </tr>
            <tr>
                <td>焼菓子平均販管費</td>
                <td><label id="d59"></td>
                <td>円／個</td>
            </tr>
            <tr>
                <td colspan=4>&nbsp;</td>
            </tr>
            <tr>
                <th rowspan=2>総原価</th>
                <td>生菓子平均総原価</td>
                <td><label id="d61"></td>
                <td></td>
            </tr>
            <tr>
                <td>焼菓子平均総原価</td>
                <td><label id="d62"></td>
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
                <td><label id="d68"></td>
                <td><label id="g68"></td>
            </tr>
            <tr>
                <td>付加価値額 成長</td>
                <td><input type="number" class="number wdtSS" id="c69" name="c69">%</td>
                <td><label id="d69"></td>
                <td><label id="g69"></td>
            </tr>
        </table>

















    </div>


</body>

</html>