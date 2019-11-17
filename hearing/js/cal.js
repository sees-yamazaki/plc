$(function () {

    // テキストボックスにフォーカス時、フォームの背景色を変化
    $('.number')
        .focusin(function (e) {
            $(this).css('background-color', '#ffc');
        })
        .focusout(function (e) {
            $(this).css('background-color', '');
        });

    $('input')
        .focusout(function (e) {
            xxx();
        });

});

function getValue(obj) {
    if (obj.type == null) {
        txt = obj.innerText.replace(",", "");
    } else {
        txt = obj.value.replace(",", "");
    }
    if (Number.isInteger()) {
        return parseInt(txt);
    } else {
        return parseFloat(txt);
    }
}

function getNumValue(obj) {
    tmp = getValue(obj);
    if (isNaN(tmp) || tmp == "") {
        return 0;
    } else {
        return tmp;
    }
}

function writeValue(obj, val, val2) {

    if (isNaN(val)) {
        txt = "";
    } else {
        txt = val + val2;
    }

    if (obj.type == null) {
        obj.innerText = txt;
    } else {
        obj.value = txt;
    }

}


function xxx() {

    _d0 = document.getElementById("d0");


    //####################################
    //   ≪設備導入前≫
    //####################################

    //（入）売上規模／年
    _d2 = document.getElementById("d2");
    d2 = getValue(_d2);
    //（出）労務費／年
    _d3 = document.getElementById("d3");
    d3 = getValue(_d3);
    //（出）販管人件費／年
    _d4 = document.getElementById("d4");
    d4 = getValue(_d4);

    //'= 粗利率
    //=(D2-D3-D4)/D2
    _d5 = document.getElementById("d5");
    d5 = d2 - d3 - d4;
    d5 = ((d5 / d2) * 100);
    tmp1 = Math.round(d5);
    writeValue(_d5, tmp1, "%");


    //従業員数（製造）
    _d6 = document.getElementById("d6");
    d6 = getValue(_d6);

    //生菓子：焼菓子　＝
    _d8 = document.getElementById("d8");
    d8 = getValue(_d8);
    _f8 = document.getElementById("f8");
    f8 = getValue(_f8);

    //（商品点数ﾍﾞｰｽ）
    //=SUM(D8)*10%
    _e9 = document.getElementById("e9");
    e9 = d8 * 10;
    writeValue(_e9, e9, "%");

    //（売り平均単価）
    //=SUM(F8)*10%
    _e10 = document.getElementById("e10");
    e10 = f8 * 10;
    writeValue(_e10, e10, "%");

    //生菓子平均単価
    _d11 = document.getElementById("d11");
    d11 = getValue(_d11);

    //焼菓子平均単価
    _d12 = document.getElementById("d12");
    d12 = getValue(_d12);

    //（材料原価）
    _e13 = document.getElementById("e13");
    e13 = getValue(_e13);

    //生菓子平均材料原価
    //=TRUNC(SUM(D11)*E13*1.05,1)
    _d14 = document.getElementById("d14");
    d14 = d11 * (e13 / 100) * 1.05;
    tmp1 = Math.trunc(d14 * 10) / 10;
    writeValue(_d14, tmp1, "");


    //焼菓子平均材料原価
    //=TRUNC(SUM(D12)*E13*0.9,1)
    _d15 = document.getElementById("d15");
    d15 = d12 * (e13 / 100) * 0.9;
    tmp1 = Math.trunc(d15 * 10) / 10;
    writeValue(_d15, tmp1, "");

    //生菓子平均労務費
    //=TRUNC(SUM(D3)*D8*0.1*10000/I11,1)*1.1
    //I11 --> =TRUNC(I8*10000/D11)
    //I8  --> =TRUNC(D2*D8/10,1)
    _d17 = document.getElementById("d17");

    //I8  --> =TRUNC(D2*D8/10,1)
    i8 = d2 * d8 / 10;

    //I11 --> =TRUNC(I8*10000/D11)
    i11 = Math.trunc(i8 * 10000 / d11);

    //=TRUNC(SUM(D3)*D8*0.1*10000/I11,1)*1.1
    d17 = Math.trunc((d3 * d8 * 0.1 * 10000) / i11 * 10) / 10 * 1.1;
    tmp1 = Math.trunc(d17 * 10) / 10;

    writeValue(_d17, tmp1, "");


    //焼菓子平均労務費
    //=TRUNC(SUM(D3)*F8*0.1*10000/I12,1)
    //I12 --> =TRUNC(I9*10000/D12)
    //I9  --> =TRUNC(D2*F8/10,1)
    _d18 = document.getElementById("d18");

    //I9  --> =TRUNC(D2*F8/10,1)
    i9 = d2 * f8 / 10;

    //I12 --> =TRUNC(I9*10000/D12)
    i12 = Math.trunc(i9 * 10000 / d12);

    //=TRUNC(SUM(D3)*F8*0.1*10000/I12,1)
    d18 = Math.trunc((d3 * f8 * 0.1 * 10000) / i12 * 10) / 10;

    writeValue(_d18, d18, "");


    //生菓子平均販管費
    //=TRUNC(SUM(D4)*D8*0.1*10000/I11,1)
    _d20 = document.getElementById("d20");
    d20 = Math.trunc((d4 * d8 * 0.1 * 10000) / i11 * 10) / 10;

    writeValue(_d20, d20, "");


    //焼菓子平均販管費
    //=TRUNC(SUM(D4)*F8*0.1*10000/I12,1)
    _d21 = document.getElementById("d21");
    d21 = Math.trunc((d4 * f8 * 0.1 * 10000) / i12 * 10) / 10;

    writeValue(_d21, d21, "");


    //生菓子平均総原価
    //=SUM(D14)+D17+D20
    _d23 = document.getElementById("d23");
    d23 = d14 + d17 + d20;

    writeValue(_d23, d23, "");

    //焼菓子平均総原価
    //=SUM(D15)+D18+D21
    _d24 = document.getElementById("d24");
    d24 = d15 + d18 + d21;

    writeValue(_d24, d24, "");



    //####################################
    //   ≪成長を設定（５年後）≫
    //####################################

    //売上成長
    _d29 = document.getElementById("d29");
    d29 = getValue(_d29);

    //製造原価低減
    _d30 = document.getElementById("d30");
    d30 = getValue(_d30);

    //製造　増員数
    _d31 = document.getElementById("d31");
    d31 = getValue(_d31);


    //生菓子：焼菓子　＝
    _d32 = document.getElementById("d32");
    _d32.innerText = d8 + "：" + f8;

    //生菓子平均
    _i31 = document.getElementById("i31");
    _i31.innerText = d11;

    //焼菓子平均単価
    _i32 = document.getElementById("i32");
    _i32.innerText = d12;


    //設備①
    _l29 = document.getElementById("l29");
    l29 = getNumValue(_l29);

    //設備②
    _l30 = document.getElementById("l30");
    l30 = getNumValue(_l30);

    //設備③
    _l31 = document.getElementById("l31");
    l31 = getNumValue(_l31);

    //計
    _l32 = document.getElementById("l32");
    l32 = l29 + l30 + l31;

    writeValue(_l32, l32, "");


    //補助率
    //0 -> 1/2   1 -> 2/3
    _l33 = document.getElementById("l33");
    l33 = getValue(_l33);


    //補助額
    //=IF(L32*(IF(L33="2/3",0.666,0.5))>10000000,10000000,TRUNC(L32*(IF(L33="2/3",2/3,0.5))))

    _l34 = document.getElementById("l34");

    rate = 0.5;
    if (l33 == 1) { rate = 0.666; }

    l34 = l32 * rate;

    if (l34 > 10000000) {
        l34 = 10000000;
    } else {
        if (l33 == 1) {
            l34 = l32 * 2 / 3;
        } else {
            l34 = l32 / 2;
        }
    }

    tmp1 = Math.trunc(l34);

    writeValue(_l34, tmp1, "");

    //一括償却
    _l35 = document.getElementById("l35");
    l35 = getValue(_l35);

    //減価償却費
    ////=IF(L35="する",L32-L34,(L32-L34)/10)

    _l36 = document.getElementById("l36");

    l36 = l32 - l34;
    if (l35 == 1) {
        l36 = l36 / 10;
    }

    writeValue(_l36, l36, "");




    //####################################
    //   ≪設備導入後≫
    //####################################


    //（入）売上規模／年
    //=D2*D29/100
    _d40 = document.getElementById("d40");
    d40 = d2 * d29 / 100;
    tmp1 = Math.trunc(d40);

    writeValue(_d40, tmp1, "");


    //（出）労務費／年
    //=D40*((D3/D2)-D30/100)
    _d41 = document.getElementById("d41");
    d41 = d40 * ((d3 / d2) - d30 / 100);
    tmp1 = Math.round(d41);

    writeValue(_d41, tmp1, "");


    //（出）販管費／年
    //=D40*(D4/D2)*0.92
    _d42 = document.getElementById("d42");
    d42 = (d40 * (d4 / d2) * 0.92);

    tmp1 = Math.round(d42);

    writeValue(_d42, tmp1, "");


    //= 営業利益率
    //=(D40-D41-D42)/D40
    _d43 = document.getElementById("d43");
    d43 = (d40 - d41 - d42) / d40 * 100;
    tmp1 = Math.round(d43);

    writeValue(_d43, tmp1, "%");


    //従業員数（製造）
    //=D6+D31
    _d44 = document.getElementById("d44");
    d44 = d6 + d31;

    writeValue(_d44, d44, "");

    //（商品点数ﾍﾞｰｽ）
    //=SUM(D32)*10
    _e47 = document.getElementById("e47");
    e47 = d8 * 10;

    writeValue(_e47, e47, "%");


    //（売り平均単価）
    //=SUM(F32)*10%
    _e48 = document.getElementById("e48");
    e48 = f8 * 10;

    writeValue(_e48, e48, "%");


    //生菓子平均単価
    _d49 = document.getElementById("d49");
    d49 = getValue(_d49);

    //焼菓子平均単価
    _d50 = document.getElementById("d50");
    d50 = getValue(_d50);

    //（材料原価）
    _e51 = document.getElementById("e51");
    e51 = getValue(_e51);

    //生菓子平均材料原価
    //=TRUNC(SUM(D49)*E51*1.05,1)
    _d52 = document.getElementById("d52");
    d52 = d49 * (e51 / 100) * 1.05;
    tmp1 = Math.trunc(d52 * 10) / 10;
    writeValue(_d52, tmp1, "");


    //焼菓子平均材料原価
    //=TRUNC(SUM(D50)*E51*0.9,1)
    _d53 = document.getElementById("d53");
    d53 = d50 * (e51 / 100) * 0.9;
    tmp1 = Math.trunc(d53 * 10) / 10;
    writeValue(_d53, tmp1, "");

    //生菓子平均労務費
    //=TRUNC(SUM(D41)*D32*0.1*10000/I49,1)*1.1
    //I49 --> =TRUNC(I46*10000/D49)
    //I46  --> =TRUNC(D40*D32/10,1)
    _d55 = document.getElementById("d55");

    //I46  --> =TRUNC(D40*D32/10,1)
    //d32 = d8
    i46 = d40 * d8 / 10;

    //I49 --> =TRUNC(I46*10000/D49)
    i49 = Math.trunc(i46 * 10000 / d49);

    //=TRUNC(SUM(D41)*D32*0.1*10000/I49,1)*1.1
    d55 = Math.trunc((d41 * d8 * 0.1 * 10000) / i49 * 10) / 10 * 1.1;
    tmp1 = Math.trunc(d55 * 10) / 10;

    writeValue(_d55, tmp1, "");


    //焼菓子平均労務費
    //=TRUNC(SUM(D41)*F32*0.1*10000/I50,1)
    //I50 --> =TRUNC(I47*10000/D50)
    //I47  --> =TRUNC(D40*F32/10,1)
    _d56 = document.getElementById("d56");

    //I47  --> =TRUNC(D40*F32/10,1)
    i47 = d40 * f8 / 10;

    //I50 --> =TRUNC(I47*10000/D50)
    i50 = Math.trunc(i47 * 10000 / d50);

    //=TRUNC(SUM(D41)*F32*0.1*10000/I50,1)
    d56 = Math.trunc((d41 * f8 * 0.1 * 10000) / i50 * 10) / 10;

    writeValue(_d56, d56, "");


    //生菓子平均販管費
    //=TRUNC(SUM(D42)*D32*0.1*10000/I49,1)
    _d58 = document.getElementById("d58");
    d58 = Math.trunc((d42 * d8 * 0.1 * 10000) / i49 * 10) / 10;

    writeValue(_d58, d58, "");


    //焼菓子平均販管費
    //=TRUNC(SUM(D42)*F32*0.1*10000/I50,1)
    _d59 = document.getElementById("d59");
    d59 = Math.trunc((d42 * f8 * 0.1 * 10000) / i50 * 10) / 10;

    writeValue(_d59, d59, "");


    //生菓子平均総原価
    //=SUM(D52)+D55+D58
    _d61 = document.getElementById("d61");
    d61 = d52 + d55 + d58;

    writeValue(_d61, d61, "");

    //焼菓子平均総原価
    //=SUM(D53)+D56+D59
    _d62 = document.getElementById("d62");
    d62 = d53 + d56 + d59;

    writeValue(_d62, d62, "");


    //####################################
    //   ≪判定≫
    //####################################

    //++++++++++++++++++++++++++++++++++++++
    //経常利益 成長      計算値（５年後）
    //=計算ワーク!D122
    //=H26
    //=TRUNC((H25-$C$25)/ABS($C$25),3)

    //C25  --> =(C22-C24)
    //C24  --> 0
    //C22  --> =(C20-C21)

    //C20 --> =(C16-C18)

    //C16 --> =ﾃﾝﾌﾟﾚｰﾄ!D2*10000
    c16x = d2 * 10000;
    //C18 --> =ﾃﾝﾌﾟﾚｰﾄ!D14*ﾃﾝﾌﾟﾚｰﾄ!I11+ﾃﾝﾌﾟﾚｰﾄ!D15*ﾃﾝﾌﾟﾚｰﾄ!I12+(ﾃﾝﾌﾟﾚｰﾄ!D3)*10000
    c18x = d14 * i11 + d15 * i12 + d3 * 10000;

    //C21 --> =ﾃﾝﾌﾟﾚｰﾄ!D4*10000
    c21x = d4 * 10000;

    c20x = c16x - c18x;

    c22x = c20x - c21x;

    c25x = c22x;

    //H25 -->  =(H22-H24)
    // H22 --> =H20-H21
    //  H20 --> =(H16-H18)
    //   H18 --> =TRUNC(H16*H56,-4)

    //B55 --> =B18/B16
    //b16 = c16 --> =ﾃﾝﾌﾟﾚｰﾄ!D2*10000
    b16x = c16x;
    b18x = c18x;
    b55x = b18x / b16x;

    //C55 --> =C18/C16
    c55x = c18x / c16x;

    b56x = (b55x + c55x) / 2;

    //D55 --> =(ﾃﾝﾌﾟﾚｰﾄ!$D$30+(ﾃﾝﾌﾟﾚｰﾄ!$E$13-ﾃﾝﾌﾟﾚｰﾄ!$E$51)*100)/100
    d55x = (d30 + (e13 - e51) * 100) / 100;
    //D56 --> =B56*(1-D55)
    d56x = b56x * (1 - d55x);
    //E55 --> =(ﾃﾝﾌﾟﾚｰﾄ!$D$30+(ﾃﾝﾌﾟﾚｰﾄ!$E$13-ﾃﾝﾌﾟﾚｰﾄ!$E$51)*100)/100/2
    e55x = d55x / 2;
    //E56 --. =D56*(1-E55)
    e56x = d56x * (1 - e55x);
    //F55 --> =(ﾃﾝﾌﾟﾚｰﾄ!$D$30+(ﾃﾝﾌﾟﾚｰﾄ!$E$13-ﾃﾝﾌﾟﾚｰﾄ!$E$51)*100)/100/3
    f55x = d55x / 3;
    //F56 --> =E56*(1-F55)
    f56x = e56x * (1 - f55x);
    //G55 --> =(ﾃﾝﾌﾟﾚｰﾄ!$D$30+(ﾃﾝﾌﾟﾚｰﾄ!$E$13-ﾃﾝﾌﾟﾚｰﾄ!$E$51)*100)/100/4
    g55x = d55x / 4;
    //G56 --> =F56*(1-G55)
    g56x = f56x * (1 - g55x);
    //H55 --> =(ﾃﾝﾌﾟﾚｰﾄ!$D$30+(ﾃﾝﾌﾟﾚｰﾄ!$E$13-ﾃﾝﾌﾟﾚｰﾄ!$E$51)*100)/100/5
    h55x = d55x / 5;
    //G56 --> =G56*(1-H55)
    h56x = g56x * (1 - h55x);




    // H24 --> =TRUNC(H16*$B$106+B114,-4)
    //  H16 --> =TRUNC($G$16*H45,-4)
    c16x = d2;
    d45x = 1 + (((d29 / 100) - 1) / 5);
    d16x = c16x * d45x;
    e16x = d16x * d45x;
    f16x = e16x * d45x;
    g16x = f16x * d45x;
    h16x = g16x * d45x;

    //  B106
    b106x = 2;

    //  B114 --> =B113*B112
    //   B113
    b113x = l29 + l30 + l31;
    //   B112
    b112x = b106x;

    b114x = b113x * b112x;

    h24x = h16x * b106x + b114x;

    //   H18 --> =TRUNC(H16*H56,-4)
    h18x = h56x * h56x;

    //  H20 --> =(H16-H18)
    h20x = h16x - h18x;

    //H21 --> =TRUNC($G$21+H66+I95+H74,-4)
    //H66 --> =$D$64*$D$63/5
    //D64 --> =ﾃﾝﾌﾟﾚｰﾄ!D41/ﾃﾝﾌﾟﾚｰﾄ!D44*10000
    //D63 --> =ﾃﾝﾌﾟﾚｰﾄ!D31
    h66x = (d41 / d44 * 10000) * d31 / 5;
    h74x = 0;

    //I95 --> =I94
    //I94 --> =IF(ﾃﾝﾌﾟﾚｰﾄ!L35="する",0,SUM(計算ワーク!I86:I93))
    //ここで中断。。。
    //減価償却費は固定値になってして、参照する意味を確認中





    // H22 --> =H20-H21
    h22x = h20x - h21x;

    //H25 -->  =(H22-H24)
    h25x = h22x - h24x;



    //=H26
    //=TRUNC((H25-$C$25)/ABS($C$25),3)

    //++++++++++++++++++++++++++++++++++++++
    //経常利益 成長      計算値（５年後）
    //=計算ワーク!D122
    d122x = (h25x - c25x) / (Math.abs(c25x));



    writeValue(_d0, d122x, "a");






}
