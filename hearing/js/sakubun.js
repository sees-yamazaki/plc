function getValueExt(rng, dp) {
    tmp0 = document.getElementById(rng).value.replace(/,/g, '').replace('%', '');
    nf = new Intl.NumberFormat("ja-JP", { useGrouping: true, style: 'decimal', minimumFractionDigits: dp, maximumFractionDigits: dp });
    rtn = nf.format(tmp0);
    return rtn;
}

function getValueExt2(rng, dp, mlp) {
    tmp0 = document.getElementById(rng).value.replace(/,/g, '').replace('%', '');
    tmp0 = tmp0 * mlp;
    nf = new Intl.NumberFormat("ja-JP", { useGrouping: true, style: 'decimal', minimumFractionDigits: dp, maximumFractionDigits: dp });
    rtn = nf.format(tmp0);
    return rtn;
}

function numFormat(vlu, dp) {
    vlu = myCnvNum(vlu);
    nf = new Intl.NumberFormat("ja-JP", { useGrouping: true, style: 'decimal', minimumFractionDigits: dp, maximumFractionDigits: dp });
    rtn = nf.format(vlu);
    return rtn;
}

function myCnvNum(vlu) {
    tmp = '' + vlu;
    tmp = tmp.replace(/,/g, '');
    tmp = tmp.replace('%', '');
    return tmp * 1;
}


function sakubun(flg) {

    _g68 = document.getElementById("g68");
    _g69 = document.getElementById("g69");
    _g73 = document.getElementById("g73");
    g68 = _g68.value;
    g69 = _g69.value;
    g73 = _g73.value;

    if (!(g68 == "OK" && g69 == "OK" && g73 == "OK")) {
        alert("もの補助要件チェックが全て「OK」になっていないため、作文処理は実行されません。");
        return;
    }

    tmp = document.getElementById("a1r").value;
    if (tmp != "" && flg == 0) {
        if (window.confirm('すでに自動作文が実施されています。　上書きしてよろしいですか？')) {} else {
            return;
        }
    }


    getRange();

    // UriageB = Format(Range(cnUriageB).Value, "#,##0")            '売上額
    // RoumuhiB = Format(Range(cnRoumuhiB).Value, "#,##0")          '労務費
    // HankanhiB = Format(Range(cnHankanhiB).Value, "#,##0")        '販管費
    // JyugyoinB = Range(cnJyugyoinB).Value        '従業員数
    // KashiHirituB_Yaki = Format(Range(cnKashiHirituB_Yaki).Value * 10, "#,##0.0") & "%"    '焼菓子比率
    // KashiHirituB_Nama = Format(Range(cnKashiHirituB_Nama).Value * 10, "#,##0.0") & "%"    '生菓子比率
    // NamaAveTanB = Format(Range(cnNamaAveTanB).Value, "#,##0")    '生菓子平均単価
    // YakiAveTanB = Format(Range(cnYakiAveTanB).Value, "#,##0")    '焼菓子平均単価
    // ZairyoGenkarituB = Format(Range(cnZairyoGenkarituB).Value * 100, "#,##0.0") & "%" '材料原価率
    // NamaAveZaiB = Format(Range(cnNamaAveZaiB).Value, "#,##0.0")     '生：材料原価平均
    // YakiAveZaiB = Format(Range(cnYakiAveZaiB).Value, "#,##0.0")     '焼：材料原価平均
    // NamaAveRoumuB = Format(Range(cnNamaAveRoumuB).Value, "#,##0.0")        '生：労務費平均
    // YakiAveRoumuB = Format(Range(cnYakiAveRoumuB).Value, "#,##0.0")        '焼：労務費平均
    // NamaAveHankanB = Format(Range(cnNamaAveHankanB).Value, "#,##0.0")      '生：販管費平均
    // YakiAveHankanB = Format(Range(cnYakiAveHankanB).Value, "#,##0.0")      '焼：販管費平均
    // NamaAveGenkaB = Format(Range(cnNamaAveGenkaB).Value, "#,##0.0")        '生：平均総原価
    // YakiAveGenkaB = Format(Range(cnYakiAveGenkaB).Value, "#,##0.0")        '焼：平均総原価
    // UriageB_Hitori = Format(Range(cnUriageB_Hitori).Value, "#,##0.0")      '一人当たり売上額
    // NamaUriageB = Format(Range(cnNamaUriageB).Value, "#,##0.0")            '生菓子売上
    // YakiUriageB = Format(Range(cnYakiUriageB).Value, "#,##0.0")            '焼菓子売上
    // NamaTensuNenB = Format(Range(cnNamaTensuNenB).Value, "#,##0")          '生：点数（年）
    // YakiTensuNenB = Format(Range(cnYakiTensuNenB).Value, "#,##0")          '焼：点数（年）
    // NamaTensuTukiB = Format(Range(cnNamaTensuTukiB).Value, "#,##0")        '生：点数（月）
    // YakiTensuTukiB = Format(Range(cnYakiTensuTukiB).Value, "#,##0")        '焼：点数（月）
    // NamaTensuNitiB = Format(Range(cnNamaTensuNitiB).Value, "#,##0")        '生：点数（日）
    // YakiTensuNitiB = Format(Range(cnYakiTensuNitiB).Value, "#,##0")        '焼：点数（日）
    // EigyobiB = Range(cnEigyobiB).Value                  '営業日数
    // NamaNensanB_Hitori = Format(Range(cnNamaNensanB_Hitori).Value, "#,##0")  '生：一人当たり年産
    // YakiNensanB_Hitori = Format(Range(cnYakiNensanB_Hitori).Value, "#,##0")  '焼：一人当たり年産
    // NamaGesanB_Hitori = Format(Range(cnNamaGesanB_Hitori).Value, "#,##0")    '生：一人当たり月産
    // YakiGesanB_Hitori = Format(Range(cnYakiGesanB_Hitori).Value, "#,##0")    '焼：一人当たり月産
    // NamaNisanB_Hitori = Format(Range(cnNamaNisanB_Hitori).Value, "#,##0")    '生：一人当たり日産
    // YakiNisanB_Hitori = Format(Range(cnYakiNisanB_Hitori).Value, "#,##0")    '焼：一人当たり日産
    // Nama1koRiekiB = Format(Range(cnNama1koRiekiB).Value, "#,##0.0")            '生：１個当たり利益
    // Yaki1koRiekiB = Format(Range(cnYaki1koRiekiB).Value, "#,##0.0")            '焼：１個当たり利益
    // NamaRiekiNenB = Format(Range(cnNamaRiekiNenB).Value, "#,##0")            '生：利益（年間）
    // YakiRiekiNenB = Format(Range(cnYakiRiekiNenB).Value, "#,##0")            '焼：利益（年間）
    // NamaRiekiTukiB = Format(Range(cnNamaRiekiTukiB).Value, "#,##0")          '生：利益（月間）
    // YakiRiekiTukiB = Format(Range(cnYakiRiekiTukiB).Value, "#,##0")          '焼：利益（月間）
    // NamaRiekiNitiB = Format(Range(cnNamaRiekiNitiB).Value, "#,##0")          '生：利益（日）
    // YakiRiekiNitiB = Format(Range(cnYakiRiekiNitiB).Value, "#,##0")          '焼：利益（日）
    // NamaRiekiNenB_Hitori = Format(Range(cnNamaRiekiNenB_Hitori).Value, "#,##0")          '生：一人当たり利益（年間）
    // YakiRiekiNenB_Hitori = Format(Range(cnYakiRiekiNenB_Hitori).Value, "#,##0")          '焼：一人当たり利益（年間）
    // NamaRiekiTukiB_Hitori = Format(Range(cnNamaRiekiTukiB_Hitori).Value, "#,##0")        '生：一人当たり利益（月間）
    // YakiRiekiTukiB_Hitori = Format(Range(cnYakiRiekiTukiB_Hitori).Value, "#,##0")        '焼：一人当たり利益（月間）
    // NamaRiekiNitiB_Hitori = Format(Range(cnNamaRiekiNitiB_Hitori).Value, "#,##0")        '生：一人当たり利益（日）
    // YakiRiekiNitiB_Hitori = Format(Range(cnYakiRiekiNitiB_Hitori).Value, "#,##0")        '焼：一人当たり利益（日）
    UriageB = getValueExt(cnUriageB, 0); //売上額
    RoumuhiB = getValueExt(cnRoumuhiB, 0); //労務費
    HankanhiB = getValueExt(cnHankanhiB, 0); //販管費
    JyugyoinB = getValueExt(cnJyugyoinB, 0); //従業員数
    KashiHirituB_Yaki = getValueExt2(cnKashiHirituB_Yaki, 1, 10) + "%"; //焼菓子比率
    KashiHirituB_Nama = getValueExt2(cnKashiHirituB_Nama, 1, 10) + "%"; //生菓子比率
    NamaAveTanB = getValueExt(cnNamaAveTanB, 0); //生菓子平均単価
    YakiAveTanB = getValueExt(cnYakiAveTanB, 0); //焼菓子平均単価
    ZairyoGenkarituB = getValueExt(cnZairyoGenkarituB, 1) + "%"; //材料原価率 *調整*
    NamaAveZaiB = getValueExt(cnNamaAveZaiB, 1); //生：材料原価平均
    YakiAveZaiB = getValueExt(cnYakiAveZaiB, 1); //焼：材料原価平均
    NamaAveRoumuB = getValueExt(cnNamaAveRoumuB, 1); //生：労務費平均
    YakiAveRoumuB = getValueExt(cnYakiAveRoumuB, 1); //焼：労務費平均
    NamaAveHankanB = getValueExt(cnNamaAveHankanB, 1); //生：販管費平均
    YakiAveHankanB = getValueExt(cnYakiAveHankanB, 1); //焼：販管費平均
    NamaAveGenkaB = getValueExt(cnNamaAveGenkaB, 1); //生：平均総原価
    YakiAveGenkaB = getValueExt(cnYakiAveGenkaB, 1); //焼：平均総原価
    UriageB_Hitori = getValueExt(cnUriageB_Hitori, 1); //一人当たり売上額
    NamaUriageB = getValueExt(cnNamaUriageB, 1); //生菓子売上
    YakiUriageB = getValueExt(cnYakiUriageB, 1); //焼菓子売上
    NamaTensuNenB = getValueExt(cnNamaTensuNenB, 0); //生：点数（年）
    YakiTensuNenB = getValueExt(cnYakiTensuNenB, 0); //焼：点数（年）
    NamaTensuTukiB = getValueExt(cnNamaTensuTukiB, 0); //生：点数（月）
    YakiTensuTukiB = getValueExt(cnYakiTensuTukiB, 0); //焼：点数（月）
    NamaTensuNitiB = getValueExt(cnNamaTensuNitiB, 0); //生：点数（日）
    YakiTensuNitiB = getValueExt(cnYakiTensuNitiB, 0); //焼：点数（日）
    EigyobiB = getValueExt(cnEigyobiB, 0); //営業日数
    NamaNensanB_Hitori = getValueExt(cnNamaNensanB_Hitori, 0); //生：一人当たり年産
    YakiNensanB_Hitori = getValueExt(cnYakiNensanB_Hitori, 0); //焼：一人当たり年産
    NamaGesanB_Hitori = getValueExt(cnNamaGesanB_Hitori, 0); //生：一人当たり月産
    YakiGesanB_Hitori = getValueExt(cnYakiGesanB_Hitori, 0); //焼：一人当たり月産
    NamaNisanB_Hitori = getValueExt(cnNamaNisanB_Hitori, 0); //生：一人当たり日産
    YakiNisanB_Hitori = getValueExt(cnYakiNisanB_Hitori, 0); //焼：一人当たり日産
    Nama1koRiekiB = getValueExt(cnNama1koRiekiB, 1); //生：１個当たり利益
    Yaki1koRiekiB = getValueExt(cnYaki1koRiekiB, 1); //焼：１個当たり利益
    NamaRiekiNenB = getValueExt(cnNamaRiekiNenB, 0); //生：利益（年間）
    YakiRiekiNenB = getValueExt(cnYakiRiekiNenB, 0); //焼：利益（年間）
    NamaRiekiTukiB = getValueExt(cnNamaRiekiTukiB, 0); //生：利益（月間）
    YakiRiekiTukiB = getValueExt(cnYakiRiekiTukiB, 0); //焼：利益（月間）
    NamaRiekiNitiB = getValueExt(cnNamaRiekiNitiB, 0); //生：利益（日）
    YakiRiekiNitiB = getValueExt(cnYakiRiekiNitiB, 0); //焼：利益（日）
    NamaRiekiNenB_Hitori = getValueExt(cnNamaRiekiNenB_Hitori, 0); //生：一人当たり利益（年間）
    YakiRiekiNenB_Hitori = getValueExt(cnYakiRiekiNenB_Hitori, 0); //焼：一人当たり利益（年間）
    NamaRiekiTukiB_Hitori = getValueExt(cnNamaRiekiTukiB_Hitori, 0); //生：一人当たり利益（月間）
    YakiRiekiTukiB_Hitori = getValueExt(cnYakiRiekiTukiB_Hitori, 0); //焼：一人当たり利益（月間）
    NamaRiekiNitiB_Hitori = getValueExt(cnNamaRiekiNitiB_Hitori, 0); //生：一人当たり利益（日）
    YakiRiekiNitiB_Hitori = getValueExt(cnYakiRiekiNitiB_Hitori, 0); //焼：一人当たり利益（日）

    // '■成長の設定（５年後）
    // UriSeityou = Format(Range(cnUriSeityou).Value, "#,##0.0") & "%"          '売上成長率
    // GenkaTeigen = "-" & Format(Range(cnGenkaTeigen).Value, "#,##0.0") & "%"        '原価低減
    // Zouin = Range(cnZouin).Value               '増員数
    // KashiHirituA_Yaki = Format(Range(cnKashiHirituA_Yaki).Value * 10, "#,##0.0") & "%"    '焼菓子比率
    // KashiHirituA_Nama = Format(Range(cnKashiHirituA_Nama).Value * 10, "#,##0.0") & "%"    '生菓子比率
    // Setubi1 = Format(Range(cnSetubi1).Value, "#,##0")                   '設備①
    // Setubi2 = Format(Range(cnSetubi2).Value, "#,##0")                   '設備②
    // Setubi3 = Format(Range(cnSetubi3).Value, "#,##0")                   '設備③
    // Hojoritu = Range(cnHojoritu).Value            '補助率
    // If Range(cnSyokyaku).Value = "する" Then Syokyaku = True          '一括償却
    // GenkaSyokyakuhi = Format(Range(cnGenkaSyokyakuhi).Value, "#,##0")
    UriSeityou = getValueExt(cnUriSeityou, 1) + "%"; //売上成長率
    GenkaTeigen = getValueExt(cnGenkaTeigen, 1) + "%"; //原価低減
    Zouin = getValueExt(cnZouin, 0); //増員数
    KashiHirituA_Yaki = getValueExt2(cnKashiHirituA_Yaki, 1), 10; //焼菓子比率
    KashiHirituA_Nama = getValueExt2(cnKashiHirituA_Nama, 1, 10); //生菓子比率
    Setubi1 = getValueExt(cnSetubi1, 0); //設備①
    Setubi2 = getValueExt(cnSetubi2, 0); //設備②
    Setubi3 = getValueExt(cnSetubi3, 0); //設備③
    Hojoritu = getValueExt(cnHojoritu, 0); //補助率
    t0 = document.getElementById(cnSyokyaku);
    if (getValue(t0) == "する") {
        Syokyaku = true;
    } else {
        Syokyaku = false;
    }
    GenkaSyokyakuhi = getValueExt(cnGenkaSyokyakuhi, 0); //(cnGenkaSyokyakuhi).Value, "#,##0")

    // '■設備導入後
    // UriageA = Format(Range(cnUriageA).Value, "#,##0")                '売上額
    // RoumuhiA = Format(Range(cnRoumuhiA).Value, "#,##0")              '労務費
    // HankanhiA = Format(Range(cnHankanhiA).Value, "#,##0")            '販管費
    // JyugyoinA = Range(cnJyugyoinA).Value            '従業員数
    // NamaAveTanA = Format(Range(cnNamaAveTanA).Value, "#,##0.0")        '生菓子平均単価
    // YakiAveTanA = Format(Range(cnYakiAveTanA).Value, "#,##0.0")        '焼菓子平均単価
    // ZairyoGenkarituA = Format(Range(cnZairyoGenkarituA).Value * 100, "#,##0.0") & "%" '材料原価率
    // NamaAveZaiA = Format(Range(cnNamaAveZaiA).Value, "#,##0.0")        '生：材料原価平均
    // YakiAveZaiA = Format(Range(cnYakiAveZaiA).Value, "#,##0.0")        '焼：材料原価平均
    // NamaAveRoumuA = Format(Range(cnNamaAveRoumuA).Value, "#,##0.0")    '生：労務費平均
    // YakiAveRoumuA = Format(Range(cnYakiAveRoumuA).Value, "#,##0.0")    '焼：労務費平均
    // NamaAveHankanA = Format(Range(cnNamaAveHankanA).Value, "#,##0.0")  '生：販管費平均
    // YakiAveHankanA = Format(Range(cnYakiAveHankanA).Value, "#,##0.0")  '焼：販管費平均
    // NamaAveGenkaA = Format(Range(cnNamaAveGenkaA).Value, "#,##0.0")    '生：平均総原価
    // YakiAveGenkaA = Format(Range(cnYakiAveGenkaA).Value, "#,##0.0")    '焼：平均総原価
    // UriageA_Hitori = Format(Range(cnUriageA_Hitori).Value, "#,##0.0")  '一人当たり売上額
    // NamaUriageA = Format(Range(cnNamaUriageA).Value, "#,##0.0")                '生菓子売上
    // YakiUriageA = Format(Range(cnYakiUriageA).Value, "#,##0.0")                '焼菓子売上
    // NamaTensuNenA = Format(Range(cnNamaTensuNenA).Value, "#,##0")              '生：点数（年）
    // YakiTensuNenA = Format(Range(cnYakiTensuNenA).Value, "#,##0")              '焼：点数（年）
    // NamaTensuTukiA = Format(Range(cnNamaTensuTukiA).Value, "#,##0")            '生：点数（月）
    // YakiTensuTukiA = Format(Range(cnYakiTensuTukiA).Value, "#,##0")            '焼：点数（月）
    // NamaTensuNitiA = Format(Range(cnNamaTensuNitiA).Value, "#,##0")          '生：点数（日）
    // YakiTensuNitiA = Format(Range(cnYakiTensuNitiA).Value, "#,##0")          '焼：点数（日）
    // EigyobiA = Range(cnEigyobiA).Value                      '営業日数
    // NamaNensanA_Hitori = Format(Range(cnNamaNensanA_Hitori).Value, "#,##0")  '生：一人当たり年産
    // YakiNensanA_Hitori = Format(Range(cnYakiNensanA_Hitori).Value, "#,##0")  '焼：一人当たり年産
    // NamaGesanA_Hitori = Format(Range(cnNamaGesanA_Hitori).Value, "#,##0")    '生：一人当たり月産
    // YakiGesanA_Hitori = Format(Range(cnYakiGesanA_Hitori).Value, "#,##0")    '焼：一人当たり月産
    // NamaNisanA_Hitori = Format(Range(cnNamaNisanA_Hitori).Value, "#,##0")    '生：一人当たり日産
    // YakiNisanA_Hitori = Format(Range(cnYakiNisanA_Hitori).Value, "#,##0")    '焼：一人当たり日産
    // Nama1koRiekiA = Format(Range(cnNama1koRiekiA).Value, "#,##0.0")            '生：１個当たり利益
    // Yaki1koRiekiA = Format(Range(cnYaki1koRiekiA).Value, "#,##0.0")            '焼：１個当たり利益
    // NamaRiekiNenA = Format(Range(cnNamaRiekiNenA).Value, "#,##0")            '生：利益（年間）
    // YakiRiekiNenA = Format(Range(cnYakiRiekiNenA).Value, "#,##0")            '焼：利益（年間）
    // NamaRiekiTukiA = Format(Range(cnNamaRiekiTukiA).Value, "#,##0")          '生：利益（月間）
    // YakiRiekiTukiA = Format(Range(cnYakiRiekiTukiA).Value, "#,##0")          '焼：利益（月間）
    // NamaRiekiNitiA = Format(Range(cnNamaRiekiNitiA).Value, "#,##0")          '生：利益（日）
    // YakiRiekiNitiA = Format(Range(cnYakiRiekiNitiA).Value, "#,##0")          '焼：利益（日）
    // NamaRiekiNenA_Hitori = Format(Range(cnNamaRiekiNenA_Hitori).Value, "#,##0")          '生：一人当たり利益（年間）
    // YakiRiekiNenA_Hitori = Format(Range(cnYakiRiekiNenA_Hitori).Value, "#,##0")          '焼：一人当たり利益（年間）
    // NamaRiekiTukiA_Hitori = Format(Range(cnNamaRiekiTukiA_Hitori).Value, "#,##0")        '生：一人当たり利益（月間）
    // YakiRiekiTukiA_Hitori = Format(Range(cnYakiRiekiTukiA_Hitori).Value, "#,##0")        '焼：一人当たり利益（月間）
    // NamaRiekiNitiA_Hitori = Format(Range(cnNamaRiekiNitiA_Hitori).Value, "#,##0")        '生：一人当たり利益（日）
    // YakiRiekiNitiA_Hitori = Format(Range(cnYakiRiekiNitiA_Hitori).Value, "#,##0")        '焼：一人当たり利益（日）
    UriageA = getValueExt(cnUriageA, 0); //売上額
    RoumuhiA = getValueExt(cnRoumuhiA, 0); //労務費
    HankanhiA = getValueExt(cnHankanhiA, 0); //販管費
    JyugyoinA = getValueExt(cnJyugyoinA, 0); //従業員数
    NamaAveTanA = getValueExt(cnNamaAveTanA, 1); //生菓子平均単価
    YakiAveTanA = getValueExt(cnYakiAveTanA, 1); //焼菓子平均単価
    ZairyoGenkarituA = getValueExt2(cnZairyoGenkarituA, 1, 100); //材料原価率
    NamaAveZaiA = getValueExt(cnNamaAveZaiA, 1); //生：材料原価平均
    YakiAveZaiA = getValueExt(cnYakiAveZaiA, 1); //焼：材料原価平均
    NamaAveRoumuA = getValueExt(cnNamaAveRoumuA, 1); //生：労務費平均
    YakiAveRoumuA = getValueExt(cnYakiAveRoumuA, 1); //焼：労務費平均
    NamaAveHankanA = getValueExt(cnNamaAveHankanA, 1); //生：販管費平均
    YakiAveHankanA = getValueExt(cnYakiAveHankanA, 1); //焼：販管費平均
    NamaAveGenkaA = getValueExt(cnNamaAveGenkaA, 1); //生：平均総原価
    YakiAveGenkaA = getValueExt(cnYakiAveGenkaA, 1); //焼：平均総原価
    UriageA_Hitori = getValueExt(cnUriageA_Hitori, 1); //一人当たり売上額
    NamaUriageA = getValueExt(cnNamaUriageA, 1); //生菓子売上
    YakiUriageA = getValueExt(cnYakiUriageA, 1); //焼菓子売上
    NamaTensuNenA = getValueExt(cnNamaTensuNenA, 0); //生：点数（年）
    YakiTensuNenA = getValueExt(cnYakiTensuNenA, 0); //焼：点数（年）
    NamaTensuTukiA = getValueExt(cnNamaTensuTukiA, 0); //生：点数（月）
    YakiTensuTukiA = getValueExt(cnYakiTensuTukiA, 0); //焼：点数（月）
    NamaTensuNitiA = getValueExt(cnNamaTensuNitiA, 0); //生：点数（日）
    YakiTensuNitiA = getValueExt(cnYakiTensuNitiA, 0); //焼：点数（日）
    EigyobiA = getValueExt(cnEigyobiA, 0); //営業日数
    NamaNensanA_Hitori = getValueExt(cnNamaNensanA_Hitori, 0); //生：一人当たり年産
    YakiNensanA_Hitori = getValueExt(cnYakiNensanA_Hitori, 0); //焼：一人当たり年産
    NamaGesanA_Hitori = getValueExt(cnNamaGesanA_Hitori, 0); //生：一人当たり月産
    YakiGesanA_Hitori = getValueExt(cnYakiGesanA_Hitori, 0); //焼：一人当たり月産
    NamaNisanA_Hitori = getValueExt(cnNamaNisanA_Hitori, 0); //生：一人当たり日産
    YakiNisanA_Hitori = getValueExt(cnYakiNisanA_Hitori, 0); //焼：一人当たり日産
    Nama1koRiekiA = getValueExt(cnNama1koRiekiA, 1); //生：１個当たり利益
    Yaki1koRiekiA = getValueExt(cnYaki1koRiekiA, 1); //焼：１個当たり利益
    NamaRiekiNenA = getValueExt(cnNamaRiekiNenA, 0); //生：利益（年間）
    YakiRiekiNenA = getValueExt(cnYakiRiekiNenA, 0); //焼：利益（年間）
    NamaRiekiTukiA = getValueExt(cnNamaRiekiTukiA, 0); //生：利益（月間）
    YakiRiekiTukiA = getValueExt(cnYakiRiekiTukiA, 0); //焼：利益（月間）
    NamaRiekiNitiA = getValueExt(cnNamaRiekiNitiA, 0); //生：利益（日）
    YakiRiekiNitiA = getValueExt(cnYakiRiekiNitiA, 0); //焼：利益（日）
    NamaRiekiNenA_Hitori = getValueExt(cnNamaRiekiNenA_Hitori, 0); //生：一人当たり利益（年間）
    YakiRiekiNenA_Hitori = getValueExt(cnYakiRiekiNenA_Hitori, 0); //焼：一人当たり利益（年間）
    NamaRiekiTukiA_Hitori = getValueExt(cnNamaRiekiTukiA_Hitori, 0); //生：一人当たり利益（月間）
    YakiRiekiTukiA_Hitori = getValueExt(cnYakiRiekiTukiA_Hitori, 0); //焼：一人当たり利益（月間）
    NamaRiekiNitiA_Hitori = getValueExt(cnNamaRiekiNitiA_Hitori, 0); //生：一人当たり利益（日）
    YakiRiekiNitiA_Hitori = getValueExt(cnYakiRiekiNitiA_Hitori, 0); //焼：一人当たり利益（日）

    // '■判定
    // KeijoChk = Format(Range(cnKeijoChk).Value * 100, "#,##0.0") & "%"                  '経常利益率（成長要件）
    // HukaChk = Format(Range(cnHukaChk).Value * 100, "#,##0.0") & "%"                    '付加価値成長率（成長要件）
    // RoudouseisanseiB = Format(Range(cnRoudouseisanseiB).Value, "#,##0")            '労働生産性（現状）
    // RoudouseisanseiA = Format(Range(cnRoudouseisanseiA).Value, "#,##0")            '労働生産性（５年後）
    // RoudouseisanChk = Format(Range(cnRoudouseisanChk).Value * 100, "#,##0.0") & "%"    '労働生産性（伸び率）
    // SBEP_Before = Format(Range(cnSBEP_Before).Value * 100, "#,##0.0") & "%"            '損益分岐点（現状）
    // SBEP_After = Format(Range(cnSBEP_After).Value * 100, "#,##0.0") & "%"              '損益分岐点（５年後）
    KeijoChk = getValueExt(cnKeijoChk, 1) + "%"; //経常利益率（成長要件）*調整*
    //    console.log("KeijoChk:" + KeijoChk);
    HukaChk = getValueExt(cnHukaChk, 1) + "%"; //付加価値成長率（成長要件）*調整*
    RoudouseisanseiB = getValueExt(cnRoudouseisanseiB, 0); //労働生産性（現状）
    RoudouseisanseiA = getValueExt(cnRoudouseisanseiA, 0); //労働生産性（５年後）
    RoudouseisanChk = getValueExt(cnRoudouseisanChk, 1) + "%"; //労働生産性（伸び率）*調整*
    SBEP_Before = getValueExt(cnSBEP_Before, 1) + "%"; //損益分岐点（現状）*調整*
    SBEP_After = getValueExt(cnSBEP_After, 1) + "%"; //損益分岐点（５年後）*調整*

    // If Range(cnTousiHantei).Value = "投資に値する" Then TousiHantei = True  '投資判定
    // Kaisyu = Range(cnKaisyu).Value                      '推定回収期間
    // Houjinzeiritu = Range(cnHoujinzeiritu).Value        '法人税率
    // ShihonCost = Range(cnShihonCost).Value              '資本コスト
    // KaisyuComment4 = Range(cnKaisyuComment).Value       '回収ｺﾒﾝﾄ文
    // CIF_1 = Format(Range(cnCIF_1).Value, "#,##0")             '1年目ＣＩＦ
    // CIF_2 = Format(Range(cnCIF_2).Value, "#,##0")             '2年目ＣＩＦ
    // CIF_3 = Format(Range(cnCIF_3).Value, "#,##0")             '3年目ＣＩＦ
    // CIF_4 = Format(Range(cnCIF_4).Value, "#,##0")             '4年目ＣＩＦ
    // CIF_5 = Format(Range(cnCIF_5).Value, "#,##0")             '5年目ＣＩＦ
    // NPV1 = Format(Range(cnNPV).Value, "#,##0")                'NPV
    // Toushigaku2 = Format(Range(cnToushigaku).Value, "#,##0")  '投資額
    t0 = document.getElementById(cnTousiHantei);
    if (getValue(t0) == "投資に値する") {
        TousiHantei = true; //投資判定
    } else {
        TousiHantei = false; //投資判定
    }
    Kaisyu = getValueExt(cnKaisyu, 0); //推定回収期間
    Houjinzeiritu = getValueExt(cnHoujinzeiritu, 0); //法人税率
    ShihonCost = getValueExt(cnShihonCost, 0); //資本コスト
    //KaisyuComment4 = getValueExt(cnKaisyuComment, 0); //回収ｺﾒﾝﾄ文
    CIF_1 = getValueExt(cnCIF_1, 0); //1年目ＣＩＦ
    CIF_2 = getValueExt(cnCIF_2, 0); //2年目ＣＩＦ
    CIF_3 = getValueExt(cnCIF_3, 0); //3年目ＣＩＦ
    CIF_4 = getValueExt(cnCIF_4, 0); //4年目ＣＩＦ
    CIF_5 = getValueExt(cnCIF_5, 0); //5年目ＣＩＦ
    NPV1 = getValueExt(cnNPV, 0); //NPV
    Toushigaku2 = getValueExt(cnToushigaku, 0); //投資額


    // strwk = strwk & "■生産の状況　〜新商品開発を停滞させる生産性要因〜" & vbCrLf
    // '売上高　====================================================================================
    // strwk = strwk & "　当社は生菓子と焼菓子の製造比率を生菓子が" & KashiHirituB_Nama
    // strwk = strwk & "、焼菓子が" & KashiHirituB_Yaki & "にて生産しており、"
    // strwk = strwk & "生菓子の年間売上が" & NamaUriageB & "万円（売上点数約" & NamaTensuNenB & "個）、"
    // strwk = strwk & "焼菓子が" & YakiUriageB & "万円（売上点数約" & YakiTensuNenB & "個）で"
    // strwk = strwk & "売上規模は、" & UriageB & "万円／年となっている。"
    // strwk = strwk & "また、菓子製造に携わる従業員数は現在" & JyugyoinB & "名であり、一人当たりの売上金額は、"
    // strwk = strwk & UriageB_Hitori & "万円／年と"
    // If UriageB_Hitori > 2000 And JyugyoinB < 20 Then
    //     strwk = strwk & "なっており、小規模ながら能率高い運営ができており業界でもトップクラスの水準となっている。"
    // ElseIf UriageB_Hitori > 2000 Then
    //     strwk = strwk & "業界でもトップクラスの生産性水準となっている。"
    // ElseIf UriageB_Hitori > 1500 Then
    //     strwk = strwk & "なっており、中小規模ながら能率高い経営にて運営を行っている。"
    // ElseIf UriageB_Hitori > 700 And JyugyoinB > 100 Then
    //     strwk = strwk & "なっており、従業員数は充実しているものの、生産性は業界中位の水準に留まっている。"
    // ElseIf UriageB_Hitori > 700 Then
    //     strwk = strwk & "業界中位の水準となっている。"
    // ElseIf JyugyoinB > 100 Then
    //     strwk = strwk & "なっており、従業員数は充実しているものの、生産性は不十分な状況である。"
    // ElseIf JyugyoinB > 30 Then
    //     strwk = strwk & "なっており、比較的従業員は確保できているものの、生産性は不十分な状況である。"
    // Else
    //     strwk = strwk & "なっており、生産性としては業界平均を下回る水準となっている。"
    // End If
    // strwk = strwk & vbCrLf
    strwk = '' + "■生産の状況　〜新商品開発を停滞させる生産性要因〜" + br +
        "　当社は生菓子と焼菓子の製造比率を生菓子が" + KashiHirituB_Nama +
        "、焼菓子が" + KashiHirituB_Yaki + "にて生産しており、" +
        "生菓子の年間売上が" + NamaUriageB + "万円（売上点数約" + NamaTensuNenB + "個）、" +
        "焼菓子が" + YakiUriageB + "万円（売上点数約" + YakiTensuNenB + "個）で" +
        "売上規模は、" + UriageB + "万円／年となっている。" +
        "また、菓子製造に携わる従業員数は現在" + JyugyoinB + "名であり、一人当たりの売上金額は、" +
        UriageB_Hitori + "万円／年と";

    // console.log("KashiHirituB_Nama:" + KashiHirituB_Nama);
    // console.log("KashiHirituB_Yaki:" + KashiHirituB_Yaki);
    // console.log("NamaUriageB:" + NamaUriageB);
    // console.log("NamaTensuNenB:" + NamaTensuNenB);
    // console.log("YakiUriageB:" + YakiUriageB);
    // console.log("YakiTensuNenB:" + YakiTensuNenB);
    // console.log("UriageB:" + UriageB);
    // console.log("JyugyoinB:" + JyugyoinB);
    // console.log("UriageB_Hitori:" + UriageB_Hitori);

    if (UriageB_Hitori > 2000 && JyugyoinB < 20) {
        strwk += "なっており、小規模ながら能率高い運営ができており業界でもトップクラスの水準となっている。" + br;
    } else if (UriageB_Hitori > 2000) {
        strwk = strwk + "業界でもトップクラスの生産性水準となっている。" + br;
    } else if (UriageB_Hitori > 1500) {
        strwk = strwk + "なっており、中小規模ながら能率高い経営にて運営を行っている。" + br;
    } else if (UriageB_Hitori > 700 && JyugyoinB > 100) {
        strwk = strwk + "なっており、従業員数は充実しているものの、生産性は業界中位の水準に留まっている。" + br;
    } else if (UriageB_Hitori > 700) {
        strwk = strwk + "業界中位の水準となっている。" + br;
    } else if (JyugyoinB > 100) {
        strwk = strwk + "なっており、従業員数は充実しているものの、生産性は不十分な状況である。" + br;
    } else if (JyugyoinB > 30) {
        strwk = strwk + "なっており、比較的従業員は確保できているものの、生産性は不十分な状況である。" + br;
    } else {
        strwk = strwk + "なっており、生産性としては業界平均を下回る水準となっている。" + br;
    }




    // '売上原価　==================================================================================
    // Dim UriageGenkaRituWK As Currency
    // UriageGenkaRituWK = (CCur(RoumuhiB) + CCur(HankanhiB) + (UriageB * Range(cnZairyoGenkarituB).Value)) / UriageB

    // strwk = strwk & "　次に売上原価であるが、材料原価率が" & ZairyoGenkarituB & "で"
    // strwk = strwk & Format(UriageB * Range(cnZairyoGenkarituB).Value, "#,##0.0") & "万円／年、"
    // strwk = strwk & "人件費が直接労務費（" & RoumuhiB & "万円／年）と間接労務費（" & HankanhiB & "万円／年）を合わせて"
    // strwk = strwk & Format(CCur(RoumuhiB) + CCur(HankanhiB), "#,##0") & "万円／年となり、"
    // strwk = strwk & "原価率が" & Format(UriageGenkaRituWK * 100, "#,##0.0") & "％と"

    // If UriageB_Hitori > 2000 Then
    //     If UriageGenkaRituWK > 0.65 Then
    //         strwk = strwk & "売上生産性は業界上位の水準でありながらも売上原価は非常に高く"
    //     ElseIf UriageGenkaRituWK >= 0.5 And UriageGenkaRituWK <= 0.65 Then
    //         strwk = strwk & "売上生産性は業界上位の水準でありながらも売上原価は平均を上回る高さで"
    //     Else
    //         strwk = strwk & "業界平均に比べて優位とは言えるものの"
    //     End If
    // ElseIf UriageB_Hitori > 1500 Then
    //     If UriageGenkaRituWK > 0.65 Then
    //         strwk = strwk & "売上生産性の高さとは逆に原価効率は非常に低く"
    //     ElseIf UriageGenkaRituWK >= 0.5 And UriageGenkaRituWK <= 0.65 Then
    //         strwk = strwk & "売上生産性の高さとは逆に原価効率は平均を下回る低さで"
    //     Else
    //         strwk = strwk & "売上生産性の高さに加えて原価効率も平均値を若干上回る水準であるものの"
    //     End If
    // ElseIf UriageB_Hitori > 700 And JyugyoinB > 100 Then
    //     strwk = strwk & "、売上生産性が業界中位に留まっている背景として"
    // ElseIf UriageB_Hitori > 700 Then
    //     strwk = strwk & "、売上生産性が平均的な水準に留まっている背景として"
    // ElseIf JyugyoinB > 100 Then
    //     strwk = strwk & "従業員数の強みを生産性向上や能率向上に活かしきれておらず"
    // ElseIf JyugyoinB > 30 Then
    //     strwk = strwk & "生産性や能率を高める活動に注力してこなかった背景もあり"
    // Else
    //     strwk = strwk & "製造原価にフォーカスした改善はもちろんのこと"
    // End If
    //ZairyoGenkarituB = getValueExt(cnZairyoGenkarituB, 0);
    UriageGenkaRituWK = (myCnvNum(RoumuhiB) + myCnvNum(HankanhiB) + (myCnvNum(UriageB) * (myCnvNum(ZairyoGenkarituB) / 100))) / myCnvNum(UriageB);

    tmp1 = numFormat(myCnvNum(UriageB) * myCnvNum(ZairyoGenkarituB) / 100, 1);
    tmp2 = numFormat(myCnvNum(RoumuhiB) + myCnvNum(HankanhiB), 0);
    tmp3 = numFormat(myCnvNum(UriageGenkaRituWK) * 100, 1);
    strwk += "　次に売上原価であるが、材料原価率が" + ZairyoGenkarituB + "で" +
        tmp1 + "万円／年、" +
        "人件費が直接労務費（" + RoumuhiB + "万円／年）と間接労務費（" + HankanhiB + "万円／年）を合わせて" +
        tmp2 + "万円／年となり、" +
        "原価率が" + tmp3 + "％と";
    // console.log("tmp1:" + tmp1);
    // console.log("tmp2:" + tmp2);
    // console.log("tmp3:" + tmp3);

    if (UriageB_Hitori > 2000) {
        if (UriageGenkaRituWK > 0.65) {
            strwk = strwk + "売上生産性は業界上位の水準でありながらも売上原価は非常に高く";
        } else if (UriageGenkaRituWK >= 0.5 && UriageGenkaRituWK <= 0.65) {
            strwk = strwk + "売上生産性は業界上位の水準でありながらも売上原価は平均を上回る高さで";
        } else {
            strwk = strwk + "業界平均に比べて優位とは言えるものの";
        }
    } else if (UriageB_Hitori > 1500) {
        if (UriageGenkaRituWK > 0.65) {
            strwk = strwk + "売上生産性の高さとは逆に原価効率は非常に低く";
        } else if (UriageGenkaRituWK >= 0.5 && UriageGenkaRituWK <= 0.65) {
            strwk = strwk + "売上生産性の高さとは逆に原価効率は平均を下回る低さで";
        } else {
            strwk = strwk + "売上生産性の高さに加えて原価効率も平均値を若干上回る水準であるものの";
        }

    } else if (UriageB_Hitori > 700 && JyugyoinB > 100) {
        strwk = strwk + "、売上生産性が業界中位に留まっている背景として";
    } else if (UriageB_Hitori > 700) {
        strwk = strwk + "、売上生産性が平均的な水準に留まっている背景として";
    } else if (JyugyoinB > 100) {
        strwk = strwk + "従業員数の強みを生産性向上や能率向上に活かしきれておらず";
    } else if (JyugyoinB > 30) {
        strwk = strwk + "生産性や能率を高める活動に注力してこなかった背景もあり";
    } else {
        strwk = strwk + "製造原価にフォーカスした改善はもちろんのこと";
    }

    // strwk = strwk & "、製造効率化を通じた原価低減の余地を多く残している状態にある。"
    // strwk = strwk & vbCrLf
    // strwk = strwk & "　また、近年ではこの原価低減の課題に加えて、商品開発面での課題も顕在化してきている。"
    // strwk = strwk & vbCrLf
    // strwk = strwk & "元々、当社では多様化する顧客志向、ＳＮＳ等で素早く市場浸透してしまう流行・トレンドに遅れないよう、"
    // strwk = strwk & "策として新商品開発や既存商品のカスタマイズ、地元素材を活用したコラボレーション開発を意識した運営を"
    // strwk = strwk & "行ってきた。" & vbCrLf
    // strwk = strwk & "　例えば●●●●を使用した●●●の開発では上記のように開発時間の余力に関する問題に加えて●●を●●加工する際の"
    // strwk = strwk & "工程において●●●が●●●してしまうといった技術的な壁に当たっており＜ここでサイエンスなど＞、商品化の進捗が思わしくない状況"
    // strwk = strwk & "である。他にも、●●を使用した●●や、●●の中身を●●に変えた●●なども、機械設備の能率や機能性の"
    // strwk = strwk & "不十分さから、構想止まりとなっている状況である。" & vbCrLf
    // strwk = strwk & "　よって、今回の設備投資により既存商品の量産化や着想に留まっている商品の具現化など"
    // strwk = strwk & "を通じてさらなる売上向上につなげると同時に、生産効率課題を解決し製造原価低減による"
    // strwk = strwk & "収益向上を図らなければならない。"

    strwk += "、製造効率化を通じた原価低減の余地を多く残している状態にある。" + br +
        "　また、近年ではこの原価低減の課題に加えて、商品開発面での課題も顕在化してきている。" + br +
        "元々、当社では多様化する顧客志向、ＳＮＳ等で素早く市場浸透してしまう流行・トレンドに遅れないよう、" +
        "策として新商品開発や既存商品のカスタマイズ、地元素材を活用したコラボレーション開発を意識した運営を" +
        "行ってきた。" + br +
        "　例えば●●●●を使用した●●●の開発では上記のように開発時間の余力に関する問題に加えて●●を●●加工する際の" +
        "工程において●●●が●●●してしまうといった技術的な壁に当たっており＜ここでサイエンスなど＞、商品化の進捗が思わしくない状況" +
        "である。他にも、●●を使用した●●や、●●の中身を●●に変えた●●なども、機械設備の能率や機能性の" +
        "不十分さから、構想止まりとなっている状況である。" + br +
        "　よって、今回の設備投資により既存商品の量産化や着想に留まっている商品の具現化など" +
        "を通じてさらなる売上向上につなげると同時に、生産効率課題を解決し製造原価低減による" +
        "収益向上を図らなければならない。";

    if (flg == 0) {
        document.getElementById("a1r").value = strwk;
    }


    //【採算性】==================================================================================

    // JinkenhiGaku_NamaWK = CCur(NamaAveRoumuB) + CCur(NamaAveHankanB)
    // JinkenhiGaku_YakiWK = CCur(YakiAveRoumuB) + CCur(YakiAveHankanB)
    // JinkenhiRitu_NamaWK = JinkenhiGaku_NamaWK / NamaAveTanB
    // JinkenhiRitu_YakiWK = JinkenhiGaku_YakiWK / YakiAveTanB
    JinkenhiGaku_NamaWK = myCnvNum(NamaAveRoumuB) + myCnvNum(NamaAveHankanB);
    JinkenhiGaku_YakiWK = myCnvNum(YakiAveRoumuB) + myCnvNum(YakiAveHankanB);
    JinkenhiRitu_NamaWK = myCnvNum(JinkenhiGaku_NamaWK) / myCnvNum(NamaAveTanB);
    JinkenhiRitu_YakiWK = myCnvNum(JinkenhiGaku_YakiWK) / myCnvNum(YakiAveTanB);

    // strwk = strwk & "■商品の採算性について　〜こだわるが故の不採算と技術的な壁〜　" & vbCrLf
    // strwk = strwk & "以下は、菓子分類別に当社の平均的な商品１個あたりの採算を示している。"
    strwk = "■商品の採算性について　〜こだわるが故の不採算と技術的な壁〜　" + br +
        "以下は、菓子分類別に当社の平均的な商品１個あたりの採算を示している。";

    if (flg == 0) {
        document.getElementById("a6r").value = strwk;
    }

    // '生菓子
    // wsSkbn.Range("A9").Value = "生菓子"
    // wsSkbn.Range("B9").Value = NamaAveTanB '平均単価
    // wsSkbn.Range("C9").Value = NamaAveZaiB '材料費
    // wsSkbn.Range("D9").Value = NamaAveRoumuB '直接労務費
    // wsSkbn.Range("E9").Value = NamaAveHankanB '間接労務費
    // wsSkbn.Range("F9").Value = NamaAveGenkaB '総原価
    // wsSkbn.Range("G9").Value = Nama1koRiekiB '収益/個
    // wsSkbn.Range("H9").Value = Format(Nama1koRiekiB / NamaAveTanB * 100, "#,##0.0") & "%" '収益率
    // '焼菓子
    // wsSkbn.Range("A10").Value = "焼菓子"
    // wsSkbn.Range("B10").Value = YakiAveTanB '平均単価
    // wsSkbn.Range("C10").Value = YakiAveZaiB '材料費
    // wsSkbn.Range("D10").Value = YakiAveRoumuB '直接労務費
    // wsSkbn.Range("E10").Value = YakiAveHankanB '間接労務費
    // wsSkbn.Range("F10").Value = YakiAveGenkaB '総原価
    // wsSkbn.Range("G10").Value = Yaki1koRiekiB '収益/個
    // wsSkbn.Range("H10").Value = Format(Yaki1koRiekiB / YakiAveTanB * 100, "#,##0.0") & "%" '収益率
    document.getElementById("b9r").innerText = NamaAveTanB;
    document.getElementById("c9r").innerText = NamaAveZaiB;
    document.getElementById("d9r").innerText = NamaAveRoumuB;
    document.getElementById("e9r").innerText = NamaAveHankanB;
    document.getElementById("f9r").innerText = NamaAveGenkaB;
    document.getElementById("g9r").innerText = Nama1koRiekiB;
    tmp = numFormat(myCnvNum(Nama1koRiekiB) / myCnvNum(NamaAveTanB) * 100, 1);
    tmp = numFormat(myCnvNum(tmp), 2);
    document.getElementById("h9r").innerText = tmp + "%";

    document.getElementById("b10r").innerText = YakiAveTanB;
    document.getElementById("c10r").innerText = YakiAveZaiB;
    document.getElementById("d10r").innerText = YakiAveRoumuB;
    document.getElementById("e10r").innerText = YakiAveHankanB;
    document.getElementById("f10r").innerText = YakiAveGenkaB;
    document.getElementById("g10r").innerText = Yaki1koRiekiB;
    tmp = numFormat(myCnvNum(Yaki1koRiekiB) / myCnvNum(YakiAveTanB) * 100, 1);
    tmp = numFormat(myCnvNum(tmp), 2);
    document.getElementById("h10r").innerText = tmp + "%";


    //'問題判定
    //ZairyoGenkarituB_wk = document.getElementById(cnZairyoGenkarituB).Value
    ZairyoGenkarituB_wk = myCnvNum(getValueExt(cnZairyoGenkarituB, 1), 1) / 100;

    // If ZairyoGenkarituB_wk > 0.4 Then
    //     '材料費率が高いケース
    //     strwk = strwk & "　当社は予てより県産素材や自然素材、レア食材の入手ルートを持っているのが強みであるが、そのこだわりから"
    //     strwk = strwk & "「材料費率」が" & ZairyoGenkarituB & "と非常に高くなっているのが採算上の問題となっている。"
    // ElseIf ZairyoGenkarituB_wk > 0.3 Then
    //     '材料費率が高めのケース
    //     strwk = strwk & "　当社は予てより国内産素材や自然素材など材料にこだわってきたが、"
    //     strwk = strwk & "「材料費率」が、" & ZairyoGenkarituB & "と年々高くなってきており採算を圧迫している。"
    // ElseIf ZairyoGenkarituB_wk < 0.25 Then
    //     '材料費率が低めのケース
    //     strwk = strwk & "　当社は予てより国内素材や自然素材を活用しつつも、"
    //     strwk = strwk & "「材料費率」を" & ZairyoGenkarituB & "程度に抑えることができる仕入先との関係性の深さが強みである。"
    // Else
    //     strwk = strwk & "　当社は予てより国内産素材や自然素材など材料にこだわりつつも、"
    //     strwk = strwk & "「材料費率」が、" & ZairyoGenkarituB & "と年々高くなってきている。"
    // End If
    // If ZairyoGenkarituB_wk < 0.25 Then
    //     strwk = strwk & "通常であれば良い素材と採算性というのは相反する要素であるが、この当社の強みを今後も高めるならば"
    // Else
    //     strwk = strwk & "顧客を惹きつける商品力・素材の持つ力を活用しようとすると採算性が低下するという相反する問題を孕んでおり"
    // End If
    // strwk = strwk & "今後は素材の持つ力のみならず、創作技術の承継や装飾など仕上げへの注力にて審美感に訴求する商品づくりを行い付加価値を"
    // strwk = strwk & "高めていかなければならない。"

    strwk = "";
    console.log("ZairyoGenkarituB_wk:" + ZairyoGenkarituB_wk);
    if (ZairyoGenkarituB_wk > 0.4) {
        //材料費率が高いケース
        strwk = "　当社は予てより県産素材や自然素材、レア食材の入手ルートを持っているのが強みであるが、そのこだわりから" +
            "「材料費率」が" + ZairyoGenkarituB + "と非常に高くなっているのが採算上の問題となっている。";
    } else if (ZairyoGenkarituB_wk > 0.3) {
        //材料費率が高めのケース
        strwk = "　当社は予てより国内産素材や自然素材など材料にこだわってきたが、" +
            "「材料費率」が、" + ZairyoGenkarituB + "と年々高くなってきており採算を圧迫している。";
    } else if (ZairyoGenkarituB_wk < 0.25) {
        //材料費率が低めのケース
        strwk = "　当社は予てより国内素材や自然素材を活用しつつも、" +
            "「材料費率」を" + ZairyoGenkarituB + "程度に抑えることができる仕入先との関係性の深さが強みである。";
    } else {
        strwk += "　当社は予てより国内産素材や自然素材など材料にこだわりつつも、" +
            "「材料費率」が、" + ZairyoGenkarituB + "と年々高くなってきている。";
    }
    if (ZairyoGenkarituB_wk < 0.25) {
        strwk += "通常であれば良い素材と採算性というのは相反する要素であるが、この当社の強みを今後も高めるならば";
    } else {
        strwk += "顧客を惹きつける商品力・素材の持つ力を活用しようとすると採算性が低下するという相反する問題を孕んでおり";

    }
    strwk += "今後は素材の持つ力のみならず、創作技術の承継や装飾など仕上げへの注力にて審美感に訴求する商品づくりを行い付加価値を" +
        "高めていかなければならない。" + br;


    //     If JinkenhiRitu_NamaWK > JinkenhiRitu_YakiWK Then
    //     strwk = strwk & "一方、「人件費」では生菓子の製造労務費が問題で、菓子一個当たりの直接労務費と間接労務費"
    //     strwk = strwk & "の合計が" & NamaAveRoumuB + NamaAveHankanB & "円となっており、"
    //     strwk = strwk & "その「人件費率」も" & Format(JinkenhiRitu_NamaWK * 100, "#,##0.0") & "%となっている。"
    //     IssueKbn = "生菓子"
    // Else
    //     strwk = strwk & "一方、「人件費」では焼菓子の製造労務費が問題で、菓子一個当たりの直接労務費と間接労務費"
    //     strwk = strwk & "の合計が" & YakiAveRoumuB + YakiAveHankanB & "円となっており、"
    //     strwk = strwk & "その人件費率も" & Format(JinkenhiRitu_YakiWK * 100, "#,##0.0") & "%となっている。"
    //     IssueKbn = "焼菓子"
    // End If
    tmp1 = numFormat(JinkenhiRitu_NamaWK * 100, 1);
    tmp2 = numFormat(JinkenhiRitu_YakiWK * 100, 1);
    if (JinkenhiRitu_NamaWK > JinkenhiRitu_YakiWK) {
        strwk += "一方、「人件費」では生菓子の製造労務費が問題で、菓子一個当たりの直接労務費と間接労務費" +
            "の合計が" + (myCnvNum(NamaAveRoumuB) + myCnvNum(NamaAveHankanB)) + "円となっており、" +
            "その「人件費率」も" + tmp1 + "%となっている。" + br;
        IssueKbn = "生菓子";
    } else {
        strwk += "一方、「人件費」では焼菓子の製造労務費が問題で、菓子一個当たりの直接労務費と間接労務費" +
            "の合計が" + (myCnvNum(YakiAveRoumuB) + myCnvNum(YakiAveHankanB)) + "円となっており、" +
            "その人件費率も" + tmp2 + "%となっている。" + br;
        IssueKbn = "焼菓子";
    }


    // strwk = strwk & "　従来より、素材の計量・調合/混合・分割・充填・成型・焼成・仕上げ・冷却・包装/梱包など手作業工程が高頻度で"
    // strwk = strwk & "発生する業態であって、さらに仕上げ工程や装飾などパティシエの実力、ひいては店舗の特長を出す"
    // strwk = strwk & "工程も含めると多大な人手と時間を要してしまう特性があり人件費率が高まりやすい状況となる。"
    // strwk = strwk & vbCrLf
    // strwk = strwk & "　また、綺麗さや形状といった審美感への訴求、またおいしさのバリエーションやシズル感(*)の追究といった"
    // strwk = strwk & "視覚面や情緒面で顧客を魅了する多品種少量型の商品生産となるため、上級パティシエでも単純で"
    // strwk = strwk & "簡易な工程に手を取られたり、繁忙期には包装工程などもアルバイトに混ざって"
    // strwk = strwk & "こなさなければならない状況である。"
    // strwk = strwk & vbCrLf

    // strwk = strwk & "　これらのことから①いかに作業効率化を通じた原価低減、"
    // strwk = strwk & "各工程の能率向上による生産工程全体の最適化を通じた生産拡大(販売拡大)を図ることで"
    // If JinkenhiRitu_NamaWK > JinkenhiRitu_YakiWK Then
    //     strwk = strwk & "生菓子"
    // Else
    //     strwk = strwk & "焼菓子"
    // End If
    // strwk = strwk & "の収益化と材料高騰による減収を補完していくか、また、②いかに熟練パティシエが仕上げ工程や"
    // strwk = strwk & "商品企画・開発に時間を割けるよう生産余力を確保するか、さらに、③それらパティシエが描く"
    // strwk = strwk & "新商品構想を具現化するのに障壁となる技術課題を解消する機能性高い設備を導入するか、など、"
    // strwk = strwk & "いかにしてこだわりを維持・商品開発に仕向けつつ、作業の効率性や全体のスループットを高めるかが課題である｡ "

    strwk += "　従来より、素材の計量・調合/混合・分割・充填・成型・焼成・仕上げ・冷却・包装/梱包など手作業工程が高頻度で" +
        "発生する業態であって、さらに仕上げ工程や装飾などパティシエの実力、ひいては店舗の特長を出す" +
        "工程も含めると多大な人手と時間を要してしまう特性があり人件費率が高まりやすい状況となる。" + br +
        "　また、綺麗さや形状といった審美感への訴求、またおいしさのバリエーションやシズル感(*)の追究といった" +
        "視覚面や情緒面で顧客を魅了する多品種少量型の商品生産となるため、上級パティシエでも単純で" +
        "簡易な工程に手を取られたり、繁忙期には包装工程などもアルバイトに混ざって" +
        "こなさなければならない状況である。" + br +
        "　これらのことから①いかに作業効率化を通じた原価低減、" +
        "各工程の能率向上による生産工程全体の最適化を通じた生産拡大(販売拡大)を図ることで";
    if (JinkenhiRitu_NamaWK > JinkenhiRitu_YakiWK) {
        strwk += "生菓子";
    } else {
        strwk += "焼菓子";
    }
    strwk += "の収益化と材料高騰による減収を補完していくか、また、②いかに熟練パティシエが仕上げ工程や" +
        "商品企画・開発に時間を割けるよう生産余力を確保するか、さらに、③それらパティシエが描く" +
        "新商品構想を具現化するのに障壁となる技術課題を解消する機能性高い設備を導入するか、など、" +
        "いかにしてこだわりを維持・商品開発に仕向けつつ、作業の効率性や全体のスループットを高めるかが課題である｡ "


    if (flg == 0) {
        document.getElementById("a11r").value = strwk;
    }

    //'シズル感説明 -----------------------------------------------------------------
    // strwk = strwk & "*)シズル感…揚げ物や肉が焼ける際の「ジュージュー」と音を立てる意味を表す英語の擬音語'sizzle'(ｼｽﾞﾙ)"
    // strwk = strwk & "が語源で、フルーツやグラスにつく水滴などのおいしそうなツヤ感や瑞々しさ・新鮮さ、焼成物の湯気など"
    // strwk = strwk & "人の五感に訴求して消費者の食欲や購買意欲を掻き立てる感覚・感性を表す広告用語に転じた。" & vbCrLf
    strwk = "*)シズル感…揚げ物や肉が焼ける際の「ジュージュー」と音を立てる意味を表す英語の擬音語'sizzle'(ｼｽﾞﾙ)" +
        "が語源で、フルーツやグラスにつく水滴などのおいしそうなツヤ感や瑞々しさ・新鮮さ、焼成物の湯気など" +
        "人の五感に訴求して消費者の食欲や購買意欲を掻き立てる感覚・感性を表す広告用語に転じた。" + br;

    if (flg == 0) {
        document.getElementById("a26r").value = strwk;
    }




    // '入力チェック
    // If NVL(Setubi1) = 0 And NVL(Setubi2) = 0 And NVL(Setubi1) = 0 Then
    //     MsgBox "設備の金額を入力してください。", vbExclamation, "設備金額"
    //     Exit Sub
    // End If
    if ((Setubi1 + Setubi2 + Setubi3) == 0) {
        alert("設備の金額を入力してください。");
        return;
    }


    // strwk = "■設備投資の内容"
    // strwk = strwk & "以上、当社は新商品開発に必要な設備機能性、既存品量産化のための効率化、"
    // strwk = strwk & "工程ごとの部分最適ではなくラインバランス効率を考慮した全体最適化を図るうえで必要な"
    // strwk = strwk & "下記設備を導入したいと考えている。" & vbCrLf

    // strwk = strwk & "" & vbCrLf
    // If NVL(Setubi1) <> 0 Then
    //     strwk = strwk & "＜設備①＞ ●●●●マシーン　型式：xxxxxxxxx 価格：" & Setubi1 & "円(税抜)" & vbCrLf
    //     strwk = strwk & "　特徴：xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" & vbCrLf
    //     strwk = strwk & "　解決できる課題：●●工程においてxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" & vbCrLf
    //     strwk = strwk & vbCrLf
    // End If
    // If NVL(Setubi2) <> 0 Then
    //     strwk = strwk & "＜設備②＞ ●●●●マシーン　型式：xxxxxxxxx 価格：" & Setubi2 & "円(税抜)" & vbCrLf
    //     strwk = strwk & "　特徴：xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" & vbCrLf
    //     strwk = strwk & "　解決できる課題：●●工程においてxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" & vbCrLf
    //     strwk = strwk & vbCrLf
    // End If
    // If NVL(Setubi3) <> 0 Then
    //     strwk = strwk & "＜設備③＞ ●●●●マシーン　型式：xxxxxxxxx 価格：" & Setubi3 & "円(税抜)" & vbCrLf
    //     strwk = strwk & "　特徴：xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" & vbCrLf
    //     strwk = strwk & "　解決できる課題：●●工程においてxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" & vbCrLf
    //     strwk = strwk & vbCrLf
    // End If
    // If Syokyaku = True Then
    //     '一括償却する
    //     strwk = strwk & "※なお、減価償却については一括償却にて行うため"
    // Else
    //     '一括償却しない
    //     strwk = strwk & "※なお、減価償却については一括償却しないため"
    // End If
    //     strwk = strwk & "初年度の減価償却費は" & GenkaSyokyakuhi & "円を計上する予定。" & vbCrLf

    strwk = "■設備投資の内容" +
        "以上、当社は新商品開発に必要な設備機能性、既存品量産化のための効率化、" +
        "工程ごとの部分最適ではなくラインバランス効率を考慮した全体最適化を図るうえで必要な" +
        "下記設備を導入したいと考えている。" + br + br;
    if (Setubi1 != 0) {
        strwk += "＜設備①＞ ●●●●マシーン　型式：xxxxxxxxx 価格：" + Setubi1 + "円(税抜)" + br +
            "　特徴：xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" + br +
            "　解決できる課題：●●工程においてxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" + br + br;
    }
    if (Setubi2 != 0) {
        strwk += "＜設備②＞ ●●●●マシーン　型式：xxxxxxxxx 価格：" + Setubi2 + "円(税抜)" + br +
            "　特徴：xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" + br +
            "　解決できる課題：●●工程においてxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" + br + br;
    }
    if (Setubi3 != 0) {
        strwk += "＜設備③＞ ●●●●マシーン　型式：xxxxxxxxx 価格：" + Setubi3 + "円(税抜)" + br +
            "　特徴：xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" + br +
            "　解決できる課題：●●工程においてxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" + br + br;
    }
    console.log(Syokyaku);
    if (Syokyaku == true) {
        //一括償却する
        strwk += "※なお、減価償却については一括償却にて行うため";
    } else {
        //一括償却しない
        strwk += "※なお、減価償却については一括償却しないため";
    }
    strwk += "初年度の減価償却費は" + GenkaSyokyakuhi + "円を計上する予定。" + br;


    if (flg == 0) {
        document.getElementById("a29r").value = strwk;
    }



    //'【５か年見込みについて】==================================================================================
    // 設備導入前
    // wsSkbn.Range("B48").Value = UriageB
    // wsSkbn.Range("C48").Value = RoumuhiB
    // wsSkbn.Range("D48").Value = HankanhiB
    // wsSkbn.Range("E48").Value = Format((CCur(RoumuhiB) + CCur(HankanhiB)) / UriageB * 100, "#,##0.0") & "%"    
    document.getElementById("b48r").innerText = UriageB;
    document.getElementById("c48r").innerText = RoumuhiB;
    document.getElementById("d48r").innerText = HankanhiB;
    tmp1 = numFormat((myCnvNum(RoumuhiB) + myCnvNum(HankanhiB)) / myCnvNum(UriageB) * 100, 1);
    document.getElementById("e48r").innerText = numFormat(tmp1, 2) + "%";

    // '設備導入後
    // wsSkbn.Range("B49").Value = UriageA
    // wsSkbn.Range("C49").Value = RoumuhiA
    // wsSkbn.Range("D49").Value = HankanhiA
    // wsSkbn.Range("E49").Value = Format((CCur(RoumuhiA) + CCur(HankanhiA)) / UriageA * 100, "#,##0.0") & "%"
    //console.log("->" + UriageA);
    document.getElementById("b49r").innerText = UriageA;
    document.getElementById("c49r").innerText = RoumuhiA;
    document.getElementById("d49r").innerText = HankanhiA;
    tmp1 = numFormat((myCnvNum(RoumuhiA) + myCnvNum(HankanhiA)) / myCnvNum(UriageA) * 100, 1);
    document.getElementById("e49r").innerText = numFormat(tmp1, 2) + "%";

    // '成長率/削減率
    // wsSkbn.Range("B50").Value = Format((UriageA - UriageB) / UriageB * 100, "#,##0.0") & "%" '収益率
    // wsSkbn.Range("C50").Value = Format((RoumuhiB - RoumuhiA) / RoumuhiB * 100, "#,##0.0") & "%"  '収益率
    // wsSkbn.Range("D50").Value = Format((HankanhiB - HankanhiA) / HankanhiB * 100, "#,##0.0") & "%"  '収益率
    // wsSkbn.Range("E50").Value = Format((((CCur(RoumuhiB) + CCur(HankanhiB)) / UriageB) - ((CCur(RoumuhiA) + CCur(HankanhiA)) / UriageA)) / ((CCur(RoumuhiB) + CCur(HankanhiB)) / UriageB) * 100, "#,##0.0") & "%"
    UA = myCnvNum(UriageA, 1);
    UB = myCnvNum(UriageB, 1);
    RA = myCnvNum(RoumuhiA, 1);
    RB = myCnvNum(RoumuhiB, 1);
    HA = myCnvNum(HankanhiA, 1);
    HB = myCnvNum(HankanhiB, 1);
    tmp1 = numFormat((UA - UB) / UB * 100, 1);
    document.getElementById("b50r").innerText = tmp1 + "%";
    tmp1 = numFormat((RB - RA) / RB * 100, 1);
    document.getElementById("c50r").innerText = tmp1 + "%";
    tmp1 = numFormat((HB - HA) / HB * 100, 1);
    document.getElementById("d50r").innerText = tmp1 + "%";
    e50r = numFormat((((RB + HB) / UB) - ((RA + HA) / UA)) / ((RB + HB) / UB) * 100, 1);
    document.getElementById("e50r").innerText = numFormat(e50r, 2) + "%";



    // strwk = "■効果①　商品開発の進捗と事業成長" & vbCrLf
    // strwk = strwk & "　上記設備を導入することにより、機能設備の能率が大幅に向上するため、"
    // strwk = strwk & "例えば●●●●を使用した●●●の開発時間の余力が生まれるとともに､ "
    // strwk = strwk & "設備の機能性も充実するため、構想止まりとなっていた新商品の商品化も進捗する。具体的には、"
    // strwk = strwk & "前述課題に挙げた●●を●●加工する際の工程において●●●が●●●してしまうといった"
    // strwk = strwk & "技術的な壁を解消することができ、＜前述サイエンスの要約再登場＞といったことも可能となり、"
    // strwk = strwk & "さらに、●●を使用した●●や、●●の中身を●●に変えた●●なども実現可能となる。"
    // strwk = strwk & vbCrLf
    // strwk = strwk & "　これらにより、今後５年間で新商品販売と既存商品の量産（チャンスロスの解消）を要因とした"
    // strwk = strwk & "売上増大効果を通じ、前年比" & UriSeityou & "の売上成長(売上額" & UriageA & "万円)を見込むことができ、"
    // strwk = strwk & "５年間での経常利益の成長率が" & KeijoChk & "、付加価値額の成長率が" & HukaChk & "、労働生産性の伸び率が" & RoudouseisanChk & "となる。" & vbCrLf
    // strwk = strwk & "　なお、"
    strwk = "■効果①　商品開発の進捗と事業成長" + br +
        "　上記設備を導入することにより、機能設備の能率が大幅に向上するため、" +
        "例えば●●●●を使用した●●●の開発時間の余力が生まれるとともに､ " +
        "設備の機能性も充実するため、構想止まりとなっていた新商品の商品化も進捗する。具体的には、" +
        "前述課題に挙げた●●を●●加工する際の工程において●●●が●●●してしまうといった" +
        "技術的な壁を解消することができ、＜前述サイエンスの要約再登場＞といったことも可能となり、" +
        "さらに、●●を使用した●●や、●●の中身を●●に変えた●●なども実現可能となる。" + br +
        "　これらにより、今後５年間で新商品販売と既存商品の量産（チャンスロスの解消）を要因とした" +
        "売上増大効果を通じ、前年比" + UriSeityou + "の売上成長(売上額" + UriageA + "万円)を見込むことができ、" +
        "５年間での経常利益の成長率が" + KeijoChk + "、付加価値額の成長率が" + HukaChk + "、労働生産性の伸び率が" + RoudouseisanChk + "となる。" + br +
        "　なお、";

    //If Zouin > 0 Then
    //     strwk = strwk & "自然退職とあわせて" & CStr(Zouin) & "名の純増を計画しているが、"
    // End If
    // If RoumuhiB - RoumuhiA >= 0 Then
    //     '直接労務費が削減される場合
    //     If (HankanhiB - HankanhiA) >= 0 Then
    //         '間接労務費も削減される場合
    //         strwk = strwk & "材料費含めた製造原価全体として" & Mid(GenkaTeigen, 2, Len(GenkaTeigen) - 1) & "削減見込みであることに加え、"
    //         strwk = strwk & "下表にあるように直接労務費、間接労務費ともに削減がなされ労務費全体としても労務費率が" & Format(wsSkbn.Range("E50").Value * 100, "#,##0.0") & "%削減の見込みであるため"
    //     Else
    //         '間接労務費は削減されない場合
    //         strwk = strwk & "材料費含めた製造原価全体として" & Mid(GenkaTeigen, 2, Len(GenkaTeigen) - 1) & "削減見込みであることに加え、"
    //         strwk = strwk & "下表にあるように直接労務費を中心に削減がなされ労務費全体として労務費率が" & Format(wsSkbn.Range("E50").Value * 100, "#,##0.0") & "%削減の見込みであるため"
    //     End If
    // Else
    //     '直接労務費が削減されない場合（従業員の増員が多い場合）
    //     If (HankanhiB - HankanhiA) >= 0 Then
    //         '間接労務費は削減される場合
    //         strwk = strwk & "材料費含めた製造原価全体として" & Mid(GenkaTeigen, 2, Len(GenkaTeigen) - 1) & "削減見込みであることに加え、"
    //         strwk = strwk & "下表にあるように間接労務費を中心に削減がなされ労務費全体として労務費率が" & Format(wsSkbn.Range("E50").Value * 100, "#,##0.0") & "%削減の見込みであるため"
    //     Else
    //         '間接労務費も削減されない場合
    //         strwk = strwk & "材料費含めた製造原価全体として" & Mid(GenkaTeigen, 2, Len(GenkaTeigen) - 1) & "削減見込みであることに加え、"
    //         strwk = strwk & "下表にあるように労務費全体として労務費率が" & Format(wsSkbn.Range("E50").Value * 100, "#,##0.0") & "%削減の見込みであるため"
    //     End If
    // End If
    // strwk = strwk & "売上成長幅にあわせた収益拡大も可能になる。"
    if (Zouin > 0) {
        strwk += "自然退職とあわせて" + Zouin + "名の純増を計画しているが、";
    }
    if ((myCnvNum(RoumuhiB) - myCnvNum(RoumuhiA)) >= 0) {
        //直接労務費が削減される場合
        if ((myCnvNum(HankanhiB) - myCnvNum(HankanhiA)) >= 0) {
            //間接労務費も削減される場合
            tmp2 = numFormat(e50r * 100, 1);
            strwk += "材料費含めた製造原価全体として" + GenkaTeigen + "削減見込みであることに加え、" +
                "下表にあるように直接労務費、間接労務費ともに削減がなされ労務費全体としても労務費率が" + tmp2 + "%削減の見込みであるため";

        } else {
            //間接労務費は削減されない場合
            tmp2 = numFormat(e50r * 100, 1);
            strwk += "材料費含めた製造原価全体として" + GenkaTeigen + "削減見込みであることに加え、" +
                "下表にあるように直接労務費を中心に削減がなされ労務費全体として労務費率が" + tmp2 + "%削減の見込みであるため";
        }
    } else {
        //直接労務費が削減されない場合（従業員の増員が多い場合）
        if ((myCnvNum(HankanhiB) - myCnvNum(HankanhiA)) >= 0) {
            //間接労務費は削減される場合
            tmp2 = numFormat(e50r * 100, 1);
            strwk += "材料費含めた製造原価全体として" + GenkaTeigen + "削減見込みであることに加え、" +
                "下表にあるように間接労務費を中心に削減がなされ労務費全体として労務費率が" + tmp2 + "%削減の見込みであるため";

        } else {
            //間接労務費は削減されない場合
            tmp2 = numFormat(e50r * 100, 1);
            strwk += "材料費含めた製造原価全体として" + GenkaTeigen + "削減見込みであることに加え、" +
                "下表にあるように労務費全体として労務費率が" + tmp2 + "%削減の見込みであるため";
        }
    }
    strwk += "売上成長幅にあわせた収益拡大も可能になる。";

    if (flg == 0) {
        document.getElementById("a44r").value = strwk;
    }




    //'【原価低減のＢ＆Ａ】===============================================================
    // '生菓子（Before）
    // wsSkbn.Range("B55").Value = NamaAveTanB '平均単価
    // wsSkbn.Range("C55").Value = NamaAveZaiB '材料費
    // wsSkbn.Range("D55").Value = NamaAveRoumuB '直接労務費
    // wsSkbn.Range("E55").Value = NamaAveHankanB '間接労務費
    // wsSkbn.Range("F55").Value = NamaAveGenkaB '総原価
    // wsSkbn.Range("G55").Value = Nama1koRiekiB '収益/個
    // wsSkbn.Range("H55").Value = Format(Nama1koRiekiB / NamaAveTanB * 100, "#,##0.0") & "%" '収益率
    // '生菓子（After）
    // wsSkbn.Range("B56").Value = NamaAveTanA '平均単価
    // wsSkbn.Range("C56").Value = NamaAveZaiA '材料費
    // wsSkbn.Range("D56").Value = NamaAveRoumuA '直接労務費
    // wsSkbn.Range("E56").Value = NamaAveHankanA '間接労務費
    // wsSkbn.Range("F56").Value = NamaAveGenkaA '総原価
    // wsSkbn.Range("G56").Value = Nama1koRiekiA '収益/個
    // wsSkbn.Range("H56").Value = Format(Nama1koRiekiA / NamaAveTanA * 100, "#,##0.0") & "%" '収益率
    document.getElementById("b55r").innerText = NamaAveTanB;
    document.getElementById("c55r").innerText = NamaAveZaiB;
    document.getElementById("d55r").innerText = NamaAveRoumuB;
    document.getElementById("e55r").innerText = NamaAveHankanB;
    document.getElementById("f55r").innerText = NamaAveGenkaB;
    document.getElementById("g55r").innerText = Nama1koRiekiB;
    tmp = numFormat(Nama1koRiekiB / NamaAveTanB * 100, 1);
    document.getElementById("h55r").innerText = numFormat(tmp, 2);

    document.getElementById("b56r").innerText = NamaAveTanA;
    document.getElementById("c56r").innerText = NamaAveZaiA;
    document.getElementById("d56r").innerText = NamaAveRoumuA;
    document.getElementById("e56r").innerText = NamaAveHankanA;
    document.getElementById("f56r").innerText = NamaAveGenkaA;
    document.getElementById("g56r").innerText = Nama1koRiekiA;
    tmp = numFormat(Nama1koRiekiA / NamaAveTanA * 100, 1);
    document.getElementById("h56r").innerText = numFormat(tmp, 2);

    // '焼菓子（Before）
    // wsSkbn.Range("A58").Value = "【焼菓子】": wsSkbn.Range("A58").Font.Bold = True: wsSkbn.Range("A58").Font.Size = "14"
    // wsSkbn.Range("B59").Value = YakiAveTanB '平均単価
    // wsSkbn.Range("C59").Value = YakiAveZaiB '材料費
    // wsSkbn.Range("D59").Value = YakiAveRoumuB '直接労務費
    // wsSkbn.Range("E59").Value = YakiAveHankanB '間接労務費
    // wsSkbn.Range("F59").Value = YakiAveGenkaB '総原価
    // wsSkbn.Range("G59").Value = Yaki1koRiekiB '収益/個
    // wsSkbn.Range("H59").Value = Format(Yaki1koRiekiB / YakiAveTanB * 100, "#,##0.0") & "%" '収益率
    // '焼菓子（After）
    // wsSkbn.Range("B60").Value = YakiAveTanA '平均単価
    // wsSkbn.Range("C60").Value = YakiAveZaiA '材料費
    // wsSkbn.Range("D60").Value = YakiAveRoumuA '直接労務費
    // wsSkbn.Range("E60").Value = YakiAveHankanA '間接労務費
    // wsSkbn.Range("F60").Value = YakiAveGenkaA '総原価
    // wsSkbn.Range("G60").Value = Yaki1koRiekiA '収益/個
    // wsSkbn.Range("H60").Value = Format(Yaki1koRiekiA / YakiAveTanA * 100, "#,##0.0") & "%" '収益率
    document.getElementById("b59r").innerText = YakiAveTanB;
    document.getElementById("c59r").innerText = YakiAveZaiB;
    document.getElementById("d59r").innerText = YakiAveRoumuB;
    document.getElementById("e59r").innerText = YakiAveHankanB;
    document.getElementById("f59r").innerText = YakiAveGenkaB;
    document.getElementById("g59r").innerText = Yaki1koRiekiB;
    tmp = numFormat(Yaki1koRiekiB / YakiAveTanB * 100, 1);
    document.getElementById("h59r").innerText = numFormat(tmp, 2);

    document.getElementById("b60r").innerText = YakiAveTanA;
    document.getElementById("c60r").innerText = YakiAveZaiA;
    document.getElementById("d60r").innerText = YakiAveRoumuA;
    document.getElementById("e60r").innerText = YakiAveHankanA;
    document.getElementById("f60r").innerText = YakiAveGenkaA;
    document.getElementById("g60r").innerText = Yaki1koRiekiA;
    tmp = numFormat(Yaki1koRiekiA / YakiAveTanA * 100, 1);
    document.getElementById("h60r").innerText = numFormat(tmp, 2);


    // JinkenhiGaku_NamaWK = CCur(NamaAveRoumuA) + CCur(NamaAveHankanA)
    // JinkenhiGaku_YakiWK = CCur(YakiAveRoumuA) + CCur(YakiAveHankanA)
    // JinkenhiRitu_NamaWK = JinkenhiGaku_NamaWK / NamaAveTanA
    // JinkenhiRitu_YakiWK = JinkenhiGaku_YakiWK / YakiAveTanA
    JinkenhiGaku_NamaWK = myCnvNum(NamaAveRoumuA) + myCnvNum(NamaAveHankanA);
    JinkenhiGaku_YakiWK = myCnvNum(YakiAveRoumuA) + myCnvNum(YakiAveHankanA);
    JinkenhiRitu_NamaWK = myCnvNum(JinkenhiGaku_NamaWK) / myCnvNum(NamaAveTanA);
    JinkenhiRitu_YakiWK = myCnvNum(JinkenhiGaku_YakiWK) / myCnvNum(YakiAveTanA);

    // strwk = "■効果②　労務費の低下と収益率の向上" & vbCrLf
    // strwk = strwk & "　さらに、設備導入により●●工程や●●工程における菓子製造の労務費率も大幅に低減し、"
    strwk = "■効果②　労務費の低下と収益率の向上" + br +
        "　さらに、設備導入により●●工程や●●工程における菓子製造の労務費率も大幅に低減し、";

    //     If IssueKbn = "生菓子" Then
    //     strwk = strwk & "特に前述で問題となっていた生菓子単価に占める人件費率(直接労務費+間接労務費)が" & Format(JinkenhiRitu_NamaWK * 100, "#,##0.0") & "%と"
    //     strwk = strwk & "大幅に削減でき、収益率も" & Format(Nama1koRiekiA / NamaAveTanA * 100, "#,##0.0") - Format(Nama1koRiekiB / NamaAveTanB * 100, "#,##0.0") & "ポイント伸長することが期待できる。"
    //     '赤太文字
    //     wsSkbn.Range("D56").Font.Color = vbRed
    //     wsSkbn.Range("E56").Font.Color = vbRed
    //     wsSkbn.Range("H56").Font.Color = vbRed
    //     wsSkbn.Range("D56").Font.Bold = True
    //     wsSkbn.Range("E56").Font.Bold = True
    //     wsSkbn.Range("H56").Font.Bold = True

    //     strwk = strwk & vbCrLf
    //     strwk = strwk & "　なお、焼菓子においても単価に占める人件費率(直接労務費+間接労務費)が" & Format(JinkenhiRitu_YakiWK * 100, "#,##0.0") & "%と削減できるとともに、"
    //     strwk = strwk & "収益率も" & Format(Yaki1koRiekiA / YakiAveTanA * 100, "#,##0.0") - Format(Yaki1koRiekiB / YakiAveTanB * 100, "#,##0.0") & "ポイント伸長することが期待できる。"
    // Else
    //     strwk = strwk & "特に前述で問題となっていた焼菓子単価に占める人件費率(直接労務費+間接労務費)が" & Format(JinkenhiRitu_YakiWK * 100, "#,##0.0") & "%と"
    //     strwk = strwk & "大幅に削減でき、収益率も" & Format(Yaki1koRiekiA / YakiAveTanA * 100, "#,##0.0") - Format(Yaki1koRiekiB / YakiAveTanB * 100, "#,##0.0") & "ポイント伸長することが期待できる。"
    //     '赤太文字
    //     wsSkbn.Range("D60").Font.Color = vbRed
    //     wsSkbn.Range("E60").Font.Color = vbRed
    //     wsSkbn.Range("H60").Font.Color = vbRed
    //     wsSkbn.Range("D60").Font.Bold = True
    //     wsSkbn.Range("E60").Font.Bold = True
    //     wsSkbn.Range("H60").Font.Bold = True

    //     strwk = strwk & vbCrLf
    //     strwk = strwk & "　なお、生菓子においても単価に占める人件費率(直接労務費+間接労務費)が" & Format(JinkenhiRitu_NamaWK * 100, "#,##0.0") & "%と削減できるとともに、"
    //     strwk = strwk & "収益率も" & Format(Nama1koRiekiA / NamaAveTanA * 100, "#,##0.0") - Format(Nama1koRiekiB / NamaAveTanB * 100, "#,##0.0") & "ポイント伸長することが期待できる。"
    // End If
    // console.log("JinkenhiRitu_NamaWK-" + JinkenhiRitu_NamaWK);
    // console.log("Nama1koRiekiA-" + Nama1koRiekiA);
    // console.log("NamaAveTanA-" + NamaAveTanA);
    // console.log("Nama1koRiekiB-" + Nama1koRiekiB);
    // console.log("NamaAveTanB-" + NamaAveTanB);
    // console.log("JinkenhiRitu_YakiWK-" + JinkenhiRitu_YakiWK);
    // console.log("Yaki1koRiekiA-" + Yaki1koRiekiA);
    // console.log("YakiAveTanA-" + YakiAveTanA);
    // console.log("Yaki1koRiekiB-" + Yaki1koRiekiB);
    // console.log("YakiAveTanB-" + YakiAveTanB);
    if (IssueKbn == "生菓子") {
        tmp1 = numFormat(myCnvNum(JinkenhiRitu_NamaWK) * 100, 1);
        tmp2 = numFormat((myCnvNum(Nama1koRiekiA) / myCnvNum(NamaAveTanA) * 100) - (myCnvNum(Nama1koRiekiB) / myCnvNum(NamaAveTanB) * 100), 1);
        tmp3 = numFormat(myCnvNum(JinkenhiRitu_YakiWK) * 100, 1);
        tmp4 = numFormat((myCnvNum(Yaki1koRiekiA) / myCnvNum(YakiAveTanA) * 100) - (myCnvNum(Yaki1koRiekiB) / myCnvNum(YakiAveTanB) * 100), 1);
        strwk += "特に前述で問題となっていた生菓子単価に占める人件費率(直接労務費+間接労務費)が" + tmp1 + "%と" +
            "大幅に削減でき、収益率も" + tmp2 + "ポイント伸長することが期待できる。" + br +
            "　なお、焼菓子においても単価に占める人件費率(直接労務費+間接労務費)が" + tmp3 + "%と削減できるとともに、" +
            "収益率も" + tmp4 + "ポイント伸長することが期待できる。";
    } else {
        tmp1 = numFormat(myCnvNum(JinkenhiRitu_YakiWK) * 100, 1);
        tmp2 = numFormat((myCnvNum(Yaki1koRiekiA) / myCnvNum(YakiAveTanA) * 100) - (myCnvNum(Yaki1koRiekiB) / myCnvNum(YakiAveTanB) * 100), 1);
        tmp3 = numFormat(myCnvNum(JinkenhiRitu_NamaWK) * 100, 1);
        tmp4 = numFormat((myCnvNum(Nama1koRiekiA) / myCnvNum(NamaAveTanA) * 100) - (myCnvNum(Nama1koRiekiB) / myCnvNum(NamaAveTanB) * 100), 1);
        strwk += "特に前述で問題となっていた焼菓子単価に占める人件費率(直接労務費+間接労務費)が" + tmp1 + "%と" +
            "大幅に削減でき、収益率も" + tmp2 + "ポイント伸長することが期待できる。" + br +
            "　なお、焼菓子においても単価に占める人件費率(直接労務費+間接労務費)が" + tmp3 + "%と削減できるとともに、" +
            "収益率も" + tmp4 + "ポイント伸長することが期待できる。";

    }


    // strwk = strwk & vbCrLf
    // strwk = strwk & "　以下は、菓子区分別にみた製造原価の比較表、および、" & IssueKbn & "における労務費と収益率の推移グラフである。"
    // strwk = strwk & vbCrLf
    strwk += br + "　以下は、菓子区分別にみた製造原価の比較表、および、" + IssueKbn + "における労務費と収益率の推移グラフである。" + br;

    if (flg == 0) {
        document.getElementById("a51r").value = strwk;
    }

    // strwk = "■効果③　生産性指標の向上" & vbCrLf
    // strwk = strwk & "　本補助事業による設備投資、営業拡大により下記、生産性向上を見込むことができる。"
    strwk = "■効果③　生産性指標の向上" + br +
        "　本補助事業による設備投資、営業拡大により下記、生産性向上を見込むことができる。";

    if (flg == 0) {
        document.getElementById("a62r").value = strwk;
    }

    // If Zouin > 0 Then
    //     strwk = "今後５年間で、当社は働き方改革を推進する中で営業日を現状の" & EigyobiB & "日から" & EigyobiA & "日にする。また、"
    //     strwk = strwk & Zouin & "名の増員（純増）を予定しているが、"
    // ElseIf Zouin = 0 Then
    //     strwk = strwk & "今後５年間では自然退職と新規採用の相殺により従業員の純増はないものの、"
    // End If
    if (Zouin > 0) {
        strwk = "今後５年間で、当社は働き方改革を推進する中で営業日を現状の" + EigyobiB + "日から" + EigyobiA + "日にする。また、" +
            Zouin + "名の増員（純増）を予定しているが、";

    } else if (Zouin = 0) {
        strwk = "今後５年間では自然退職と新規採用の相殺により従業員の純増はないものの、";
    }

    document.getElementById("b66r").innerText = d6;
    document.getElementById("c66r").innerText = d6 + d31;
    document.getElementById("d66r").innerText = numFormat((((d6 + d31) / d6) - 1) * 100, 1) + "%";

    //     wkRow = 67
    //     wkRow2 = 148 '155まで
    //     '付加価値額～労働装備率まで、向上率が５年間で"↑"のもののみをコピーする
    //     Do While wkRow2 <= 155
    //         If wsKeisan.Range("F" & CStr(wkRow2)).Value = "↑" Then
    //             wsKeisan.Range("B" & CStr(wkRow2) & ":E" & CStr(wkRow2)).Copy wsSkbn.Range("A" & CStr(wkRow))
    //             wsSkbn.Range("A" & CStr(wkRow) & ":D" & CStr(wkRow)).Value = wsKeisan.Range("B" & CStr(wkRow2) & ":E" & CStr(wkRow2)).Value
    //             wsSkbn.Range("A" & CStr(wkRow)).ShrinkToFit = True

    //             Select Case wkRow2
    //             Case 148
    //                 '付加価値額
    //                 strwk = strwk & "従業員のコストや設備投資分の減価償却費用を上回る営業利益の確保により「付加価値額」や「一人当たり付加価値額（労働生産性）」や「売上高付加価値率」の指標が向上する。" & vbCrLf
    //             Case 149
    //                 '一人当たり売上高
    //                 strwk = strwk & "一人当たり指標については、新商品開発の販売や既存チャンスロスの解消による売上増大効果により「一人当たり売上高」が向上する。" & vbCrLf
    //             Case 150
    //                 '一人当たり限界利益
    //                 strwk = strwk & "また、生産効率化による製造原価低減により変動費を抑制できるため、「一人当たり限界利益」が上昇する。" & vbCrLf
    //             Case 151
    //                 '一人当たり貢献利益
    //                 strwk = strwk & "さらに、設備投資による固定上昇分を大幅な受注増で吸収できるため相対的に固定費率を押し下げることにより、貢献利益が確保でき「一人当たり貢献利益」の指標が上昇する。" & vbCrLf
    //             Case 154
    //                 '有形固定資産回転率
    //                 strwk = strwk & "なお、有形固定資産額が上昇するものの、新規受注増や逸失売上の回収が進むため資本効率が高まり、「有形固定資産回転率」が上昇する。" & vbCrLf
    //             Case 155
    //                 '労働装備率
    //                 strwk = strwk & "また、設備投資や従業員増で生産面での合理性がさらに高まり、「労働装備率」についても上昇する。" & vbCrLf
    //             End Select

    //             wkRow = wkRow + 1
    //         End If
    //         wkRow2 = wkRow2 + 1
    //     Loop
    if (e148c > 0) {
        document.getElementById("b67r").innerText = numFormat(c148c, 0);
        document.getElementById("c67r").innerText = numFormat(d148c, 0);
        document.getElementById("d67r").innerText = numFormat(myCnvNum(e148c) * 100, 1) + "%";
        strwk += "従業員のコストや設備投資分の減価償却費用を上回る営業利益の確保により「付加価値額」や「一人当たり付加価値額（労働生産性）」や「売上高付加価値率」の指標が向上する。" + br;
    } else {
        document.getElementById("r67r").style.display = 'none';
    }

    if (e149c > 0) {
        document.getElementById("b68r").innerText = numFormat(c149c, 0);
        document.getElementById("c68r").innerText = numFormat(d149c, 0);
        document.getElementById("d68r").innerText = numFormat(myCnvNum(e149c) * 100, 1) + "%";
        strwk += "一人当たり指標については、新商品開発の販売や既存チャンスロスの解消による売上増大効果により「一人当たり売上高」が向上する。" + br;
    } else {
        document.getElementById("r68r").style.display = 'none';
    }

    if (e150c > 0) {
        document.getElementById("b69r").innerText = numFormat(c150c, 0);
        document.getElementById("c69r").innerText = numFormat(d150c, 0);
        document.getElementById("d69r").innerText = numFormat(myCnvNum(e150c) * 100, 1) + "%";
        strwk += "また、生産効率化による製造原価低減により変動費を抑制できるため、「一人当たり限界利益」が上昇する。" + br;
    } else {
        document.getElementById("r69r").style.display = 'none';
    }

    if (e151c > 0) {
        document.getElementById("b70r").innerText = numFormat(c151c, 0);
        document.getElementById("c70r").innerText = numFormat(d151c, 0);
        document.getElementById("d70r").innerText = numFormat(myCnvNum(e151c) * 100, 1) + "%";
        strwk += "さらに、設備投資による固定上昇分を大幅な受注増で吸収できるため相対的に固定費率を押し下げることにより、貢献利益が確保でき「一人当たり貢献利益」の指標が上昇する。" + br;
    } else {
        document.getElementById("r70r").style.display = 'none';
    }

    if (e152c > 0) {
        document.getElementById("b71r").innerText = numFormat(c152c, 0);
        document.getElementById("c71r").innerText = numFormat(d152c, 0);
        document.getElementById("d71r").innerText = numFormat(myCnvNum(e152c) * 100, 1) + "%";
    } else {
        document.getElementById("r71r").style.display = 'none';
    }

    if (e153c > 0) {
        document.getElementById("b72r").innerText = numFormat(myCnvNum(c153c) * 100, 0);
        document.getElementById("c72r").innerText = numFormat(myCnvNum(d153c) * 100, 0);
        document.getElementById("d72r").innerText = numFormat(myCnvNum(e153c) * 100, 1) + "%";
    } else {
        document.getElementById("r72r").style.display = 'none';
    }

    if (e154c > 0) {
        document.getElementById("b73r").innerText = numFormat(c154c, 2);
        document.getElementById("c73r").innerText = numFormat(d154c, 2);
        document.getElementById("d73r").innerText = numFormat(myCnvNum(e154c) * 100, 1) + "%";
        strwk += "なお、有形固定資産額が上昇するものの、新規受注増や逸失売上の回収が進むため資本効率が高まり、「有形固定資産回転率」が上昇する。" + br;
    } else {
        document.getElementById("r73r").style.display = 'none';
    }

    if (e155c > 0) {
        document.getElementById("b74r").innerText = numFormat(c155c, 0);
        document.getElementById("c74r").innerText = numFormat(d155c, 0);
        document.getElementById("d74r").innerText = numFormat(myCnvNum(e155c) * 100, 1) + "%";
        strwk += "また、設備投資や従業員増で生産面での合理性がさらに高まり、「労働装備率」についても上昇する。" + br;
    } else {
        document.getElementById("r74r").style.display = 'none';
    }

    if (flg == 0) {
        document.getElementById("a75r").value = strwk;
    }


    //'【損益分岐点】===============================================================
    // strwk = "■効果④　損益分岐点比率の低下" & vbCrLf
    // strwk = strwk & "　前述のように、変動費率(主に製造原価)の低下に伴う粗利の上昇と、"
    // strwk = strwk & "固定費の相対的低下を主要因として、損益分岐点売上高が低下し、"
    // strwk = strwk & "損益分岐点比率も" & SBEP_Before & "から" & SBEP_After & "と大幅に低下することとなる。" & vbCrLf
    strwk = "■効果④　損益分岐点比率の低下" + br +
        "　前述のように、変動費率(主に製造原価)の低下に伴う粗利の上昇と、" +
        "固定費の相対的低下を主要因として、損益分岐点売上高が低下し、" +
        "損益分岐点比率も" + SBEP_Before + "から" + SBEP_After + "と大幅に低下することとなる。" + br;

    if (flg == 0) {
        document.getElementById("a87r").value = strwk;
    }


    //'【投資の妥当性】===============================================================
    // wsKeisan.Range("B183:H186").Copy wsSkbn.Range("A91")
    // wsSkbn.Range("A91:G94").Value = wsKeisan.Range("B183:H186").Value
    document.getElementById("b92r").innerText = numFormat(c184c, 0);
    document.getElementById("c92r").innerText = numFormat(d184c, 0);
    document.getElementById("d92r").innerText = numFormat(e184c, 0);
    document.getElementById("e92r").innerText = numFormat(f184c, 0);
    document.getElementById("f92r").innerText = numFormat(g184c, 0);
    document.getElementById("g92r").innerText = numFormat(h184c, 0);

    document.getElementById("b93r").innerText = numFormat(c185c, 0);
    document.getElementById("c93r").innerText = numFormat(d185c, 0);
    document.getElementById("d93r").innerText = numFormat(e185c, 0);
    document.getElementById("e93r").innerText = numFormat(f185c, 0);
    document.getElementById("f93r").innerText = numFormat(g185c, 0);
    document.getElementById("g93r").innerText = numFormat(h185c, 0);

    document.getElementById("b94r").innerText = numFormat(myCnvNum(c186c) * 100, 1) + "%";
    document.getElementById("c94r").innerText = numFormat(myCnvNum(d186c) * 100, 1) + "%";
    document.getElementById("d94r").innerText = numFormat(myCnvNum(e186c) * 100, 1) + "%";
    document.getElementById("e94r").innerText = numFormat(myCnvNum(f186c) * 100, 1) + "%";
    document.getElementById("f94r").innerText = numFormat(myCnvNum(g186c) * 100, 1) + "%";
    document.getElementById("g94r").innerText = numFormat(myCnvNum(h186c) * 100, 1) + "%";


    // strwk = "■投資判断の妥当性について" & vbCrLf
    // strwk = strwk & KaisyuComment4
    strwk = "■投資判断の妥当性について" + br + b104;

    if (flg == 0) {
        document.getElementById("a96r").value = strwk;
    }

    // wsTmp.Range("B92:H102").Copy wsSkbn.Range("A103")
    // wsSkbn.Range("A103:G113").Value = wsTmp.Range("B92:H102").Value
    document.getElementById("c104r").innerText = numFormat(d93, 0);
    document.getElementById("d104r").innerText = numFormat(e93, 0);
    document.getElementById("e104r").innerText = numFormat(f93, 0);
    document.getElementById("f104r").innerText = numFormat(g93, 0);
    document.getElementById("g104r").innerText = numFormat(h93, 0);

    document.getElementById("c105r").innerText = numFormat(d94, 0);
    document.getElementById("d105r").innerText = numFormat(e94, 0);
    document.getElementById("e105r").innerText = numFormat(f94, 0);
    document.getElementById("f105r").innerText = numFormat(g94, 0);
    document.getElementById("g105r").innerText = numFormat(h94, 0);

    document.getElementById("c106r").innerText = numFormat(d95, 0);
    document.getElementById("d106r").innerText = numFormat(e95, 0);
    document.getElementById("e106r").innerText = numFormat(f95, 0);
    document.getElementById("f106r").innerText = numFormat(g95, 0);
    document.getElementById("g106r").innerText = numFormat(h95, 0);

    document.getElementById("c107r").innerText = numFormat(d96, 0);
    document.getElementById("d107r").innerText = numFormat(e96, 0);
    document.getElementById("e107r").innerText = numFormat(f96, 0);
    document.getElementById("f107r").innerText = numFormat(g96, 0);
    document.getElementById("g107r").innerText = numFormat(h96, 0);

    document.getElementById("c108r").innerText = numFormat(d97, 0);
    document.getElementById("d108r").innerText = numFormat(e97, 0);
    document.getElementById("e108r").innerText = numFormat(f97, 0);
    document.getElementById("f108r").innerText = numFormat(g97, 0);
    document.getElementById("g108r").innerText = numFormat(h97, 0);

    document.getElementById("c109r").innerText = numFormat(d98, 3);
    document.getElementById("d109r").innerText = numFormat(e98, 3);
    document.getElementById("e109r").innerText = numFormat(f98, 3);
    document.getElementById("f109r").innerText = numFormat(g98, 3);
    document.getElementById("g109r").innerText = numFormat(h98, 3);

    document.getElementById("b110r").innerText = numFormat(c99, 0);
    document.getElementById("c110r").innerText = numFormat(d99, 0);
    document.getElementById("d110r").innerText = numFormat(e99, 0);
    document.getElementById("e110r").innerText = numFormat(f99, 0);
    document.getElementById("f110r").innerText = numFormat(g99, 0);
    document.getElementById("g110r").innerText = numFormat(h99, 0);

    document.getElementById("b111r").innerText = numFormat(c100, 0);
    document.getElementById("c111r").innerText = numFormat(d100, 0);
    document.getElementById("d111r").innerText = numFormat(e100, 0);
    document.getElementById("e111r").innerText = numFormat(f100, 0);
    document.getElementById("f111r").innerText = numFormat(g100, 0);
    document.getElementById("g111r").innerText = numFormat(h100, 0);

    document.getElementById("b112r").innerText = numFormat(c101, 0);
    document.getElementById("c112r").innerText = numFormat(d101, 0);
    document.getElementById("d112r").innerText = numFormat(e101, 0);
    document.getElementById("e112r").innerText = numFormat(f101, 0);
    document.getElementById("f112r").innerText = numFormat(g101, 0);
    document.getElementById("g112r").innerText = numFormat(h101, 0);

    document.getElementById("b113r").innerText = numFormat(c102, 0);




    (function() {
        'use strict';

        // パッケージのロード
        google.charts.load('current', { packages: ['corechart'] });
        // コールバックの登録
        google.charts.setOnLoadCallback(drawChart);

        // コールバック関数の実装
        function drawChart() {

            NamaUriageB = myCnvNum(NamaUriageB);
            YakiUriageB = myCnvNum(YakiUriageB);
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['生菓子売上', NamaUriageB],
                ['焼菓子売上', YakiUriageB]
            ]);

            var options = {
                title: '菓子分類比率',
                width: 800,
                height: 300,
                fontSize: 18
            };

            var chart = new google.visualization.PieChart(document.getElementById('graph1r'));

            chart.draw(data, options);
        }


    })();



    (function() {
        'use strict';

        // パッケージのロード
        google.charts.load('current', { packages: ['corechart'] });
        // コールバックの登録
        google.charts.setOnLoadCallback(drawChart);

        // コールバック関数の実装
        function drawChart() {

            //     If JinkenhiRitu_NamaWK > JinkenhiRitu_YakiWK Then
            //     '生菓子
            //     wsGraph.Range("A11").Value = "生菓子"
            //     wsGraph.Range("B11").Value = NamaAveTanB '平均単価
            //     wsGraph.Range("C11").Value = NamaAveZaiB '材料費
            //     wsGraph.Range("D11").Value = NamaAveRoumuB '直接労務費
            //     wsGraph.Range("E11").Value = NamaAveHankanB '間接労務費
            //     wsGraph.Range("F11").Value = Nama1koRiekiB '収益/個
            // Else
            //     '焼菓子
            //     wsGraph.Range("A11").Value = "焼菓子"
            //     wsGraph.Range("B11").Value = YakiAveTanB '平均単価
            //     wsGraph.Range("C11").Value = YakiAveZaiB '材料費
            //     wsGraph.Range("D11").Value = YakiAveRoumuB '直接労務費
            //     wsGraph.Range("E11").Value = YakiAveHankanB '間接労務費
            //     wsGraph.Range("F11").Value = Yaki1koRiekiB '収益/個
            // End If
            if (myCnvNum(JinkenhiRitu_NamaWK) > myCnvNum(JinkenhiRitu_YakiWK)) {
                tmp0 = "生菓子";
                tmp1 = myCnvNum(NamaAveTanB);
                tmp2 = myCnvNum(NamaAveZaiB);
                tmp3 = myCnvNum(NamaAveRoumuB);
                tmp4 = myCnvNum(NamaAveHankanB);
                tmp5 = myCnvNum(Nama1koRiekiB);
            } else {
                tmp0 = "焼菓子";
                tmp1 = myCnvNum(YakiAveTanB);
                tmp2 = myCnvNum(YakiAveZaiB);
                tmp3 = myCnvNum(YakiAveRoumuB);
                tmp4 = myCnvNum(YakiAveHankanB);
                tmp5 = myCnvNum(Yaki1koRiekiB);
            }

            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['材料費', tmp2],
                ['直接労務費', tmp3],
                ['間接労務費', tmp4],
                ['収益/個', tmp5]
            ]);

            var options = {
                title: '採算性（' + tmp0 + "）",
                width: 800,
                height: 300,
                fontSize: 18
            };

            var chart = new google.visualization.PieChart(document.getElementById('graph2r'));

            chart.draw(data, options);
        }


    })();


    (function() {
        'use strict';

        google.charts.load('current', { packages: ['corechart'] });
        google.setOnLoadCallback(drawChart);

        function drawChart() {
            UB = myCnvNum(UriageB);
            RB = myCnvNum(RoumuhiB);
            HB = myCnvNum(HankanhiB);
            UA = myCnvNum(UriageA);
            RA = myCnvNum(RoumuhiA);
            HA = myCnvNum(HankanhiA);
            var RRB = myTrunc((RB + HB) / UB * 100, 2);
            var RRA = myTrunc((RA + HA) / UA * 100, 2);

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Year');
            data.addColumn('number', '売上額');
            data.addColumn({ type: 'number', role: 'annotation' });
            data.addColumn('number', '労務費率');
            data.addColumn({ type: 'number', role: 'annotation' });

            data.addRows([
                ['設備導入前', UB, UB, RRB, RRB],
                ['設備導入後', UA, UA, RRA, RRA]
            ]);

            var options = {
                title: '売上額と労務費率の推移',
                series: [
                    { targetAxisIndex: 0 }, // 第1系列は左のY軸を使用
                    { targetAxisIndex: 1 }, // 第2系列は右のY時を使用
                ],
                legend: { position: 'bottom' },
                width: 800,
                height: 400,
                fontSize: 18,
                annotation: {
                    1: {
                        style: 'none'
                    }
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('graph3r'));
            chart.draw(data, options);
        }


    })();


    (function() {
        'use strict';

        google.charts.load('current', { packages: ['corechart'] });
        google.setOnLoadCallback(drawChart);

        function drawChart() {
            var tmpB1 = myCnvNum(NamaAveRoumuB);
            var tmpB2 = myCnvNum(NamaAveHankanB);
            var tmpB3 = myTrunc(myCnvNum(Nama1koRiekiB) / myCnvNum(NamaAveTanB) * 100, 1);
            var tmpA1 = myCnvNum(NamaAveRoumuA);
            var tmpA2 = myCnvNum(NamaAveHankanA);
            var tmpA3 = myTrunc(myCnvNum(Nama1koRiekiA) / myCnvNum(NamaAveTanA) * 100, 1);
            if (IssueKbn != "生菓子") {
                tmpB1 = myCnvNum(YakiAveRoumuB);
                tmpB2 = myCnvNum(YakiAveHankanB);
                tmpB3 = myTrunc(myCnvNum(Yaki1koRiekiB) / myCnvNum(YakiAveTanB) * 100, 1);
                tmpA1 = myCnvNum(YakiAveRoumuA);
                tmpA2 = myCnvNum(vAveHankanA);
                tmpA3 = myTrunc(myCnvNum(Yaki1koRiekiA) / myCnvNum(YakiAveTanA) * 100, 1);
            }

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Year');
            data.addColumn('number', '直接労務費');
            data.addColumn({ type: 'number', role: 'annotation' });
            data.addColumn('number', '間接労務費');
            data.addColumn({ type: 'number', role: 'annotation' });
            data.addColumn('number', '収益率');
            data.addColumn({ type: 'number', role: 'annotation' });

            data.addRows([
                ['設備導入前', tmpB1, tmpB1, tmpB2, tmpB2, tmpB3, tmpB3],
                ['設備導入後', tmpA1, tmpA1, tmpA2, tmpA2, tmpA3, tmpA3]
            ]);

            var options = {
                title: '労務費と収益率の推移(' + IssueKbn + ")",
                series: [
                    { targetAxisIndex: 0 }, // 第1系列は左のY軸を使用
                    { targetAxisIndex: 0 }, // 第2系列は右のY時を使用
                    { targetAxisIndex: 1 }, // 第2系列は右のY時を使用
                ],
                legend: { position: 'bottom' },
                width: 800,
                height: 400,
                fontSize: 18
            };

            var chart = new google.visualization.LineChart(document.getElementById('graph4r'));
            chart.draw(data, options);
        }


    })();



    (function() {
        'use strict';

        google.charts.load('current', { packages: ['corechart'] });
        google.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Year');
            data.addColumn('number', '売上高');
            data.addColumn({ type: 'number', role: 'annotation' });
            data.addColumn('number', '損益分岐点売上高');
            data.addColumn({ type: 'number', role: 'annotation' });
            data.addColumn('number', '損益分岐点比率');
            data.addColumn({ type: 'number', role: 'annotation' });

            data.addRows([
                ['前期実績', c184c, c184c, c185c, c185c, c186c, c186c],
                ['1年目', d184c, d184c, d185c, d185c, d186c, d186c],
                ['2年目', e184c, e184c, e185c, e185c, e186c, e186c],
                ['3年目', f184c, f184c, f185c, f185c, f186c, f186c],
                ['4年目', g184c, g184c, g185c, g185c, g186c, g186c],
                ['5年目', h184c, h184c, h185c, h185c, h186c, h186c]
            ]);

            var options = {
                title: '労務費と収益率の推移(' + IssueKbn + ")",
                series: [
                    { targetAxisIndex: 0 }, // 第1系列は左のY軸を使用
                    { targetAxisIndex: 0 }, // 第2系列は右のY時を使用
                    { targetAxisIndex: 1 }, // 第2系列は右のY時を使用
                ],
                legend: { position: 'bottom' },
                width: 1100,
                height: 500,
                fontSize: 18
            };

            var chart = new google.visualization.LineChart(document.getElementById('graph5r'));
            chart.draw(data, options);
        }


    })();



    (function() {
        'use strict';

        google.charts.load('current', { packages: ['corechart'] });
        google.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', '');
            data.addColumn('number', "投資額");
            data.addColumn({ type: 'number', role: 'annotation', baseline: 100 });
            data.addColumn('number', "②'タックスシールド");
            data.addColumn({ type: 'number', role: 'annotation' });
            data.addColumn('number', '①”税引後CIF（営業CF）');
            data.addColumn({ type: 'number', role: 'annotation' });

            data.addRows([
                ['投資時点', c102, c102, c100, c100, c99, c99],
                ['1年目', 0, 0, d100, d100, d99, d99],
                ['2年目', 0, 0, e100, e100, e99, e99],
                ['3年目', 0, 0, f100, f100, f99, f99],
                ['4年目', 0, 0, g100, g100, g99, g99],
                ['5年目', 0, 0, h100, h100, h99, h99]
            ]);


            var options = {
                title: 'シミュレーション(NPV)',
                isStacked: true,
                legend: { position: 'bottom' },
                width: 1200,
                height: 400,
                fontSize: 18
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('graph6r'));
            chart.draw(data, options);
        }


    })();


    page3();

    location.hash = "page-top";


}





function getRange() {

    br = "\r\n";

    //'■設備導入前
    cnUriageB = "d2"; // 売上額
    cnRoumuhiB = "d3"; // 労務費
    cnHankanhiB = "d4"; // 販管費
    cnJyugyoinB = "d6"; // 従業員数
    cnKashiHirituB_Yaki = "f8"; // 焼菓子比率
    cnKashiHirituB_Nama = "d8"; // 生菓子比率
    cnNamaAveTanB = "d11"; // 生菓子平均単価
    cnYakiAveTanB = "d12"; // 焼菓子平均単価
    cnZairyoGenkarituB = "e13"; // 材料原価率
    cnNamaAveZaiB = "d14"; // 生：材料原価平均
    cnYakiAveZaiB = "d15"; // 焼：材料原価平均
    cnNamaAveRoumuB = "d17"; // 生：労務費平均
    cnYakiAveRoumuB = "d18"; // 焼：労務費平均
    cnNamaAveHankanB = "d20"; // 生：販管費平均
    cnYakiAveHankanB = "d21"; // 焼：販管費平均
    cnNamaAveGenkaB = "d23"; // 生：平均総原価
    cnYakiAveGenkaB = "d24"; // 焼：平均総原価
    cnUriageB_Hitori = "i6"; // 一人当たり売上額
    cnNamaUriageB = "i8"; // 生菓子売上
    cnYakiUriageB = "i9"; // 焼菓子売上
    cnNamaTensuNenB = "i11"; // 生：点数（年）
    cnYakiTensuNenB = "i12"; // 焼：点数（年）
    cnNamaTensuTukiB = "i15"; // 生：点数（月）
    cnYakiTensuTukiB = "i16"; // 焼：点数（月）
    cnNamaTensuNitiB = "i19"; // 生：点数（日）
    cnYakiTensuNitiB = "i20"; // 焼：点数（日）
    cnEigyobiB = "i18"; // 営業日数
    cnNamaNensanB_Hitori = "m11"; // 生：一人当たり年産
    cnYakiNensanB_Hitori = "m12"; // 焼：一人当たり年産
    cnNamaGesanB_Hitori = "m15"; // 生：一人当たり月産
    cnYakiGesanB_Hitori = "m16"; // 焼：一人当たり月産
    cnNamaNisanB_Hitori = "m19"; // 生：一人当たり日産
    cnYakiNisanB_Hitori = "m20"; // 焼：一人当たり日産
    cnNama1koRiekiB = "u6"; // 生：１個当たり利益
    cnYaki1koRiekiB = "u7"; // 焼：１個当たり利益
    cnNamaRiekiNenB = "q11"; // 生：利益（年間）
    cnYakiRiekiNenB = "q12"; // 焼：利益（年間）
    cnNamaRiekiTukiB = "q15"; // 生：利益（月間）
    cnYakiRiekiTukiB = "q16"; // 焼：利益（月間）
    cnNamaRiekiNitiB = "q19"; // 生：利益（日）
    cnYakiRiekiNitiB = "q20"; // 焼：利益（日）
    cnNamaRiekiNenB_Hitori = "u11"; // 生：一人当たり利益（年間）
    cnYakiRiekiNenB_Hitori = "u12"; // 焼：一人当たり利益（年間）
    cnNamaRiekiTukiB_Hitori = "u15"; // 生：一人当たり利益（月間）
    cnYakiRiekiTukiB_Hitori = "u16"; // 焼：一人当たり利益（月間）
    cnNamaRiekiNitiB_Hitori = "u19"; // 生：一人当たり利益（日）
    cnYakiRiekiNitiB_Hitori = "u20"; // 焼：一人当たり利益（日）

    //'■成長の設定（５年後）
    cnUriSeityou = "d29"; // 売上成長率
    cnGenkaTeigen = "d30"; // 原価低減
    cnZouin = "d31"; // 増員数
    cnKashiHirituA_Yaki = "d32"; // 焼菓子比率
    cnKashiHirituA_Nama = "f32"; // 生菓子比率
    cnSetubi1 = "l29"; // 設備①
    cnSetubi2 = "l30"; // 設備②
    cnSetubi3 = "l31"; // 設備③
    cnHojoritu = "l33"; // 補助率
    cnSyokyaku = "l35"; // 一括償却
    cnGenkaSyokyakuhi = "l36"; // 減価償却費

    //'■設備導入後
    cnUriageA = "d40"; // 売上額
    cnRoumuhiA = "d41"; // 労務費
    cnHankanhiA = "d42"; // 販管費
    cnJyugyoinA = "d44"; // 従業員数
    cnNamaAveTanA = "d49"; // 生菓子平均単価
    cnYakiAveTanA = "d50"; // 焼菓子平均単価
    cnZairyoGenkarituA = "e51"; // 材料原価率
    cnNamaAveZaiA = "d52"; // 生：材料原価平均
    cnYakiAveZaiA = "d53"; // 焼：材料原価平均
    cnNamaAveRoumuA = "d55"; // 生：労務費平均
    cnYakiAveRoumuA = "d56"; // 焼：労務費平均
    cnNamaAveHankanA = "d58"; // 生：販管費平均
    cnYakiAveHankanA = "d59"; // 焼：販管費平均
    cnNamaAveGenkaA = "d61"; // 生：平均総原価
    cnYakiAveGenkaA = "d62"; // 焼：平均総原価
    cnUriageA_Hitori = "i44"; // 一人当たり売上額
    cnNamaUriageA = "i46"; // 生菓子売上
    cnYakiUriageA = "i47"; // 焼菓子売上
    cnNamaTensuNenA = "i49"; // 生：点数（年）
    cnYakiTensuNenA = "i50"; // 焼：点数（年）
    cnNamaTensuTukiA = "i53"; // 生：点数（月）
    cnYakiTensuTukiA = "i54"; // 焼：点数（月）
    cnNamaTensuNitiA = "i57"; // 生：点数（日）
    cnYakiTensuNitiA = "i58"; // 焼：点数（日）
    cnEigyobiA = "i56"; // 営業日数
    cnNamaNensanA_Hitori = "m49"; // 生：一人当たり年産
    cnYakiNensanA_Hitori = "m50"; // 焼：一人当たり年産
    cnNamaGesanA_Hitori = "m53"; // 生：一人当たり月産
    cnYakiGesanA_Hitori = "m54"; // 焼：一人当たり月産
    cnNamaNisanA_Hitori = "m57"; // 生：一人当たり日産
    cnYakiNisanA_Hitori = "m58"; // 焼：一人当たり日産
    cnNama1koRiekiA = "u44"; // 生：１個当たり利益
    cnYaki1koRiekiA = "u45"; // 焼：１個当たり利益
    cnNamaRiekiNenA = "q49"; // 生：利益（年間）
    cnYakiRiekiNenA = "q50"; // 焼：利益（年間）
    cnNamaRiekiTukiA = "q53"; // 生：利益（月間）
    cnYakiRiekiTukiA = "q54"; // 焼：利益（月間）
    cnNamaRiekiNitiA = "q57"; // 生：利益（日）
    cnYakiRiekiNitiA = "q58"; // 焼：利益（日）
    cnNamaRiekiNenA_Hitori = "u49"; // 生：一人当たり利益（年間）
    cnYakiRiekiNenA_Hitori = "u50"; // 焼：一人当たり利益（年間）
    cnNamaRiekiTukiA_Hitori = "u53"; // 生：一人当たり利益（月間）
    cnYakiRiekiTukiA_Hitori = "u54"; // 焼：一人当たり利益（月間）
    cnNamaRiekiNitiA_Hitori = "u57"; // 生：一人当たり利益（日）
    cnYakiRiekiNitiA_Hitori = "u58"; // 焼：一人当たり利益（日）

    //'■判定
    cnKeijoChk = "d68"; // 経常利益率（成長要件）
    cnHukaChk = "d69"; // 付加価値成長率（成長要件）
    cnRoudouseisanseiB = "c73"; // 労働生産性（現状）
    cnRoudouseisanseiA = "d73"; // 労働生産性（５年後）
    cnRoudouseisanChk = "e73"; // 労働生産性（伸び率）
    cnSBEP_Before = "c79"; // 損益分岐点（現状）
    cnSBEP_After = "i79"; // 損益分岐点（５年後）
    cnYouken_Keijo = "g68"; // 要件チェック　経常利益の成長率
    cnYouken_Hukakati = "g69"; // 要件チェック　付加価値額の成長率
    cnYouken_Roudouseisansei = "g73"; // 要件チェック　経常利益の成長率
    cnTousiHantei = "c83"; // 投資判定
    cnKaisyu = "c85"; // 推定回収期間
    cnHoujinzeiritu = "c88"; // 法人税率
    cnShihonCost = "c89"; // 資本コスト
    cnKaisyuComment = "b104"; // 回収ｺﾒﾝﾄ文
    cnCIF_1 = "d101"; // 1年目ＣＩＦ
    cnCIF_2 = "e101"; // 2年目ＣＩＦ
    cnCIF_3 = "f101"; // 3年目ＣＩＦ
    cnCIF_4 = "g101"; // 4年目ＣＩＦ
    cnCIF_5 = "h101"; // 5年目ＣＩＦ
    cnNPV = "c101"; // NPV
    cnToushigaku = "c102"; // 投資額
}