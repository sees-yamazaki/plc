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
    <script src="../js/calc.js"></script>
    <script src="../js/test.js"></script>
</head>

<body>

    <?php include './menu.php'; ?>

    <div id="content">

        <table class='hs'>
            <colgroup span="1" class="areaA"></colgroup>
            <colgroup span="1" class="areaB"></colgroup>
            <colgroup span="1" class="areaC"></colgroup>
            <colgroup span="1" class="areaD"></colgroup>
            <tr>
                <th colspan=2>（入）売上規模／年</th>
                <td><input type="text" class="number" id="d2" name="d2" onblur="calc1()"></td>
                <td>万円<input type="button" onclick="demo()"></td>
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
            <tr>
                <td colspan=4>&nbsp;</td>
            </tr>
            <tr>
                <th></th>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th></th>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th></th>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th></th>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>

    </div>


</body>

</html>