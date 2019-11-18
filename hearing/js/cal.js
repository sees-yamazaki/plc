$(function() {

    // テキストボックスにフォーカス時、フォームの背景色を変化
    $('.number')
        .focusin(function(e) {
            $(this).css('background-color', '#ffc');
        })
        .focusout(function(e) {
            $(this).css('background-color', '');
        });

    $('input')
        .focusout(function(e) {
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

function writeText(obj, val, val2) {

    if (obj.type == null) {
        obj.innerText = val + val2;;
    } else {
        obj.value = val + val2;;
    }

}

function myTrunc(val, val2) {

    pls = Math.pow(10, val2);
    mns = Math.pow(10, (val2 * -1));

    tmp = val * pls;
    tmp = Math.trunc(tmp);
    return tmp * mns;
    //return tmp / pls;
}

function myRound(val, val2) {

    pls = Math.pow(10, val2);
    mns = Math.pow(10, (val2 * -1));

    tmp = val * pls;
    tmp = Math.round(tmp);
    //return tmp * mns;
    return tmp / pls;
}

function test(obj, val) {
    obj.value = val;
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

    //有形固定資産
    _l73 = document.getElementById("l73");
    l73 = getValue(_l73);

    c16c = d2 * 10000;
    b16c = c16c;

    d42c = d29 / 100;
    d45c = 1 + (d42c - 1) / 5; //=1+($D$42-1)/5
    e45c = d45c;
    f45c = d45c;
    g45c = d45c;
    h45c = d45c;


    d16c = myTrunc(c16c * d45c, -4); //=TRUNC($C$16*D45,-4)
    e16c = myTrunc(d16c * e45c, -4);
    f16c = myTrunc(e16c * f45c, -4);
    g16c = myTrunc(f16c * g45c, -4);
    h16c = myTrunc(g16c * h45c, -4);



    d17c = myRound((d16c - c16c) / c16c, 3); //=(D16-$C$16)/$C$16
    e17c = myRound((e16c - c16c) / c16c, 3);
    f17c = myRound((f16c - c16c) / c16c, 3);
    g17c = myRound((g16c - c16c) / c16c, 3);
    h17c = myRound((h16c - c16c) / c16c, 3);


    c18c = (myTrunc(d14, 1) * i11) + (myTrunc(d15, 1) * i12) + (d3 * 10000); //=ﾃﾝﾌﾟﾚｰﾄ!D14*ﾃﾝﾌﾟﾚｰﾄ!I11+ﾃﾝﾌﾟﾚｰﾄ!D15*ﾃﾝﾌﾟﾚｰﾄ!I12+(ﾃﾝﾌﾟﾚｰﾄ!D3)*10000
    b18c = c18c;

    b55c = b18c / b16c; //=B18/B16
    c55c = c18c / c16c;
    b56c = (b55c + c55c) / 2; //=AVERAGE(B55:C55)


    d55c = ((d30 + (e13 - e51)) * 100) / 100; //=(ﾃﾝﾌﾟﾚｰﾄ!$D$30+(ﾃﾝﾌﾟﾚｰﾄ!$E$13-ﾃﾝﾌﾟﾚｰﾄ!$E$51)*100)/100
    e55c = ((d30 + (e13 - e51)) * 100) / 100 / 2;
    f55c = ((d30 + (e13 - e51)) * 100) / 100 / 3;
    g55c = ((d30 + (e13 - e51)) * 100) / 100 / 4;
    h55c = ((d30 + (e13 - e51)) * 100) / 100 / 5;

    d56c = b56c * (1 - d55c / 100); //=B56*(1-D55)
    e56c = d56c * (1 - e55c / 100);
    f56c = e56c * (1 - f55c / 100);
    g56c = f56c * (1 - g55c / 100);
    h56c = g56c * (1 - h55c / 100);


    d18c = myTrunc(d16c * d56c, -4); //=TRUNC(D16*D56,-4)
    e18c = myTrunc(e16c * e56c, -4);
    f18c = myTrunc(f16c * f56c, -4);
    g18c = myTrunc(g16c * g56c, -4);
    h18c = myTrunc(h16c * h56c, -4);



    b19c = b18c / b16c; //=B18/B16
    c19c = c18c / c16c;
    d19c = d18c / d16c;
    e19c = e18c / e16c;
    f19c = f18c / f16c;
    g19c = g18c / g16c;
    h19c = h18c / h16c;

    b20c = b16c - b18c; //=(B16-B18)
    c20c = c16c - c18c;
    d20c = d16c - d18c;
    e20c = e16c - e18c;
    f20c = f16c - f18c;
    g20c = g16c - g18c;
    h20c = h16c - h18c;


    d63c = d31; //=ﾃﾝﾌﾟﾚｰﾄ!D31
    d64c = d41 / d44 * 10000; //=ﾃﾝﾌﾟﾚｰﾄ!D41/ﾃﾝﾌﾟﾚｰﾄ!D44*10000
    d66c = d64c * d63c / 5; //=$D$64*$D$63/5
    e66c = d64c * d63c / 5;
    f66c = d64c * d63c / 5;
    g66c = d64c * d63c / 5;
    h66c = d64c * d63c / 5;

    b86c = l29; //=ﾃﾝﾌﾟﾚｰﾄ!L29
    b87c = l30;
    b88c = l31;
    b95c = b86c + b87c + b88c;

    //=IF(ﾃﾝﾌﾟﾚｰﾄ!L35="する",ﾃﾝﾌﾟﾚｰﾄ!L36,SUM(計算ワーク!E86:E93))
    if (l35 == 0) {
        e94c = l36;
        f94c = 0;
        g94c = 0;
        h94c = 0;
        i94c = 0;
    } else {
        //TODO ここが固定値
        e94c = 3750000;
        f94c = 2812500;
        g94c = 2531250;
        h94c = 1476562;
        i94c = 1107422;
    }
    e95c = e94c;
    f95c = f94c;
    g95c = g94c;
    h95c = h94c;
    i95c = i94c;
    j95c = e95c + f95c + g95c + h95c + i95c;


    //    _d74c = document.getElementById("d74c");
    //    d74c = getValue(_d74c);
    d74c = 0;
    e74c = 0;
    f74c = 0;
    g74c = 0;
    h74c = 0;


    c21c = d4 * 10000; //=ﾃﾝﾌﾟﾚｰﾄ!D4*10000
    b21c = c21c;
    d21c = myTrunc(c21c + d66c + e95c + d74c, -4); //=TRUNC($C$21+D66+E95+D74,-4)
    e21c = myTrunc(d21c + e66c + f95c + e74c, -4);
    f21c = myTrunc(e21c + f66c + g95c + f74c, -4);
    g21c = myTrunc(f21c + g66c + h95c + g74c, -4);
    h21c = myTrunc(g21c + h66c + i95c + h74c, -4);


    b22c = b20c - b21c; //=(B20-B21)
    c22c = c20c - c21c;
    d22c = d20c - d21c;
    e22c = e20c - e21c;
    f22c = f20c - f21c;
    g22c = g20c - g21c;
    h22c = h20c - h21c;

    d23c = myTrunc(((d22c - c22c) / Math.abs(c22c)), 3); //=TRUNC(((D22-$C$22)/ABS($C$22)),3)
    e23c = myTrunc(((e22c - c22c) / Math.abs(c22c)), 3);
    f23c = myTrunc(((f22c - c22c) / Math.abs(c22c)), 3);
    g23c = myTrunc(((g22c - c22c) / Math.abs(c22c)), 3);
    h23c = myTrunc(((h22c - c22c) / Math.abs(c22c)), 3);


    //TODO 固定値？
    b106c = 2 / 100;

    c24c = 0;
    b24c = c24c;
    b112c = b106c; //=B106
    b113c = b95c;
    b114c = b113c * b112c; //=B113*B112

    d24c = myTrunc(d16c * b106c, -4); //=TRUNC(D16*$B$106,-4)
    e24c = myTrunc(e16c * b106c + b114c, -4); //=TRUNC(E16*$B$106+B114,-4)
    f24c = myTrunc(f16c * b106c + b114c, -4);
    g24c = myTrunc(g16c * b106c + b114c, -4);
    h24c = myTrunc(h16c * b106c + b114c, -4);



    b25c = b22c - b24c; //=(B22-B24)
    c25c = c22c - c24c;
    d25c = d22c - d24c;
    e25c = e22c - e24c;
    f25c = f22c - f24c;
    g25c = g22c - g24c;
    h25c = h22c - h24c;


    d26c = myTrunc((d25c - c25c) / Math.abs(c25c), 3); //=TRUNC((D25-$C$25)/ABS($C$25),3) 
    e26c = myTrunc((e25c - c25c) / Math.abs(c25c), 3);
    f26c = myTrunc((f25c - c25c) / Math.abs(c25c), 3);
    g26c = myTrunc((d25c - c25c) / Math.abs(c25c), 3);
    h26c = myTrunc((h25c - c25c) / Math.abs(c25c), 3);

    c27c = (d3 + d4) * 10000; //=(ﾃﾝﾌﾟﾚｰﾄ!D3+ﾃﾝﾌﾟﾚｰﾄ!D4)*10000
    b27c = c27c;
    d27c = c27c + d66c; //=C27+D66
    e27c = d27c + e66c;
    f27c = e27c + f66c;
    g27c = f27c + g66c;
    h27c = g27c + h66c;

    c28c = 0;
    b28c = c28c;
    d28c = c28c + e95c; //=$C$28+E95
    e28c = c28c + f95c;
    f28c = c28c + g95c;
    g28c = c28c + h95c;
    h28c = c28c + i95c;

    b29c = b22c + b27c + b28c; //=(B22+B27+B28)
    c29c = c22c + c27c + c28c;
    d29c = d22c + d27c + d28c;
    e29c = e22c + e27c + e28c;
    f29c = f22c + f27c + f28c;
    g29c = g22c + g27c + g28c;
    h29c = h22c + h27c + h28c;

    d30c = myTrunc((d29c - c29c) / Math.abs(c29c), 3); //=TRUNC((D29-$C$29)/ABS($C$29),3)
    e30c = myTrunc((e29c - c29c) / Math.abs(c29c), 3);
    f30c = myTrunc((f29c - c29c) / Math.abs(c29c), 3);
    g30c = myTrunc((g29c - c29c) / Math.abs(c29c), 3);
    h30c = myTrunc((h29c - c29c) / Math.abs(c29c), 3);

    d31c = b95c;



    //=((E22+E28+F22+F28+G22+G28)-3*(D22+D28))/3/D31
    g32c = ((e22c + e28c + f22c + f28c + g22c + g28c) - 3 * (d22c + d28c)) / 3 / d31c;



    c36c = c22c / c16c; //=C22/C16
    d36c = d22c / d16c;
    e36c = e22c / e16c;
    f36c = f22c / f16c;
    g36c = g22c / g16c;
    h36c = h22c / h16c;

    c37c = c25c / c16c; //=C25/C16
    d37c = d25c / d16c;
    e37c = e25c / e16c;
    f37c = f25c / f16c;
    g37c = g25c / g16c;
    h37c = h25c / h16c;


    c122c = 0.01;
    d122c = h26c;
    e122c = (d122c >= c122c * 5 ? "OK" : "NG"); //=IF(D122>=($C$122*5),"OK","NG")
    c123c = 0.03;
    d123c = h30c;
    e123c = (d123c >= c123c * 5 ? "OK" : "NG"); //=IF(D123>=($C$123*5),"OK","NG")
    c124c = 0.05;
    d124c = g32c;
    e124c = (d124c >= c124c ? "OK" : "NG"); //=IF(D124>=($C$124),"OK","NG")





    c164c = c16c;
    d164c = d16c;
    e164c = e16c;
    f164c = f16c;
    g164c = g16c;
    h164c = h16c;

    c165c = c18c;

    c166c = c165c / c164c; //=C165/C164
    d166c = c166c;
    e166c = d166c;
    f166c = e166c;
    g166c = f166c;
    h166c = g166c;

    d165c = myTrunc(d164c * d166c, -4); //=TRUNC(D164*D166,-4)
    e165c = myTrunc(e164c * e166c, -4);
    f165c = myTrunc(f164c * f166c, -4);
    g165c = myTrunc(g164c * g166c, -4);
    h165c = myTrunc(h164c * h166c, -4);


    c167c = c164c - c165c; //=C164-C165
    d167c = d164c - d165c;
    e167c = e164c - e165c;
    f167c = f164c - f165c;
    g167c = g164c - g165c;
    h167c = h164c - h165c;

    c168c = c167c / c164c; //=C167/C164
    d168c = d167c / d164c;
    e168c = e167c / e164c;
    f168c = f167c / f164c;
    g168c = g167c / g164c;
    h168c = h167c / h164c;

    c169c = c18c + c21c - c165c; //=C18+C21-C165
    d169c = d18c + d21c - d165c;
    e169c = e18c + e21c - e165c;
    f169c = f18c + f21c - f165c;
    g169c = g18c + g21c - g165c;
    h169c = h18c + h21c - h165c;


    c170c = c169c / c164c; //=C169/C164
    d170c = d169c / d164c;
    e170c = e169c / e164c;
    f170c = f169c / f164c;
    g170c = g169c / g164c;
    h170c = h169c / h164c;

    c171c = c167c - c169c; //=C167-C169
    d171c = d167c - d169c;
    e171c = e167c - e169c;
    f171c = f167c - f169c;
    g171c = g167c - g169c;
    h171c = h167c - h169c;

    c172c = c171c / c164c; //=C171/C164
    d172c = d171c / d164c;
    e172c = e171c / e164c;
    f172c = f171c / f164c;
    g172c = g171c / g164c;
    h172c = h171c / h164c;

    c174c = c169c / (1 - c166c); //=C169/(1-C166)
    d174c = d169c / (1 - d166c);
    e174c = e169c / (1 - e166c);
    f174c = f169c / (1 - f166c);
    g174c = g169c / (1 - g166c);
    h174c = h169c / (1 - h166c);

    c175c = c174c / c164c; //=C174/C164
    d175c = d174c / d164c;
    e175c = e174c / e164c;
    f175c = f174c / f164c;
    g175c = g174c / g164c;
    h175c = h174c / h164c;

    c178c = c21c;
    d178c = d21c;
    e178c = e21c;
    f178c = f21c;
    g178c = g21c;
    h178c = h21c;


    c179c = b114c;
    d179c = c179c + b114c;
    e179c = d179c;
    f179c = e179c;
    g179c = f179c;
    h179c = g179c;

    c184c = c164c;
    d184c = d164c;
    e184c = e164c;
    f184c = f164c;
    g184c = g164c;
    h184c = h164c;

    c185c = c174c;
    d185c = d174c;
    e185c = e174c;
    f185c = f174c;
    g185c = g174c;
    h185c = h174c;

    c186c = c175c;
    d186c = d175c;
    e186c = e175c;
    f186c = f175c;
    g186c = g175c;
    h186c = h175c;

    c144c = l73;
    d144c = c144c + b95c - j95c; //=C144+B95-J95

    c147c = d6;
    d147c = c147c + d31; //=C147+ﾃﾝﾌﾟﾚｰﾄ!D31

    c148c = c29c;
    c149c = c164c / c147c; //=C164/C147
    c150c = c167c / c147c;
    c151c = c171c / c147c;
    c152c = c148c / c147c;
    c153c = c148c / c164c;
    c154c = c164c / c144c;
    c155c = c144c / c147c;

    d148c = h29c;
    d149c = h164c / d147c; //=C164/C147
    d150c = h167c / d147c;
    d151c = h171c / d147c;
    d152c = d148c / d147c;
    d153c = d148c / h164c;
    d154c = h164c / d144c;
    d155c = d144c / d147c;


    e147c = (d147c - c147c) / c147c; //=(D147-C147)/C147
    e148c = (d148c - c148c) / c148c;
    e149c = (d149c - c149c) / c149c;
    e150c = (d150c - c150c) / c150c;
    e151c = (d151c - c151c) / c151c;
    e152c = (d152c - c152c) / c152c;
    e153c = (d153c - c153c) / c153c;
    e154c = (d154c - c154c) / c154c;
    e155c = (d155c - c155c) / c155c;






    c202c = myTrunc(c29c / c147c, 0); //=TRUNC($C$29/$C$147)
    d202c = myTrunc(h29c / d147c, 0); //=TRUNC($H$29/$D$147)
    e202c = (d202c - c202c) / c202c; //=(D202-C202)/C202
    f202c = (e202c >= 0.15 ? "OK" : "NG"); //=IF(E202>=15%,"OK","NG")

    c203c = myRound(c29c / c147c / 1000, 0); //=ROUND($C$29/$C$147,-3)/1000
    d203c = myRound(h29c / d147c / 1000, 0); //=ROUND(($H$29/$D$147),-3)/1000
    e203c = (d203c - c203c) / c203c; //=(D203-C203)/C203
    f203c = (e203c >= 0.15 ? "OK" : "NG"); //=IF(E203>=15%,"OK","NG")


    c212c = 10000000; //TODO 固定値？
    c213c = 3640000; //TODO 固定値？
    c214c = c213c / c212c; //=C213/C212

    c217c = 30000000; //TODO 固定値？
    c218c = 55000000; //TODO 固定値？

    c221c = 8 / 100 //TODO 固定値？
    c222c = b106c;

    //=C221*C217/(C217+C218)+C222*(1-C214)*C218/(C217+C218)
    c223c = c221c * c217c / (c217c + c218c) + c222c * (1 - c214c) * c218c / (c217c + c218c);


    d226c = d22c;
    e226c = e22c;
    f226c = f22c;
    g226c = g22c;
    h226c = h22c;
    i226c = d226c + e226c + f226c + g226c + h226c;


    d227c = d226c * (1 - c214c); //=D226*(1-$C$214)
    e227c = e226c * (1 - c214c);
    f227c = f226c * (1 - c214c);
    g227c = g226c * (1 - c214c);
    h227c = h226c * (1 - c214c);
    i227c = d227c + e227c + f227c + g227c + h227c;


    d228c = d28c;
    e228c = e28c;
    f228c = f28c;
    g228c = g28c;
    h228c = h28c;

    d229c = d228c * c214c; //=D228*$C$214
    e229c = e228c * c214c;
    f229c = f228c * c214c;
    g229c = g228c * c214c;
    h229c = h228c * c214c;

    d230c = d227c + d229c; //=D227+D229
    e230c = e227c + e229c;
    f230c = f227c + f229c;
    g230c = g227c + g229c;
    h230c = h227c + h229c;
    i230c = d230c + e230c + f230c + g230c + h230c;


    d231c = myTrunc(Math.pow(1 + c223c, -1), 3); //=TRUNC(POWER(1+$C$223,-1),3)
    e231c = myTrunc(Math.pow(1 + c223c, -2), 3);
    f231c = myTrunc(Math.pow(1 + c223c, -3), 3);
    g231c = myTrunc(Math.pow(1 + c223c, -4), 3);
    h231c = myTrunc(Math.pow(1 + c223c, -5), 3);


    d232c = myTrunc(d227c * d231c, 0); //=TRUNC(D227*D231)
    e232c = myTrunc(e227c * e231c, 0);
    f232c = myTrunc(f227c * f231c, 0);
    g232c = myTrunc(g227c * g231c, 0);
    h232c = myTrunc(h227c * h231c, 0);
    c232c = d232c + e232c + f232c + g232c + h232c;

    d233c = myTrunc(d229c * d231c, 0); //=TRUNC(D229*D231)
    e233c = myTrunc(e229c * e231c, 0);
    f233c = myTrunc(f229c * f231c, 0);
    g233c = myTrunc(g229c * g231c, 0);
    h233c = myTrunc(h229c * h231c, 0);
    c233c = d233c + e233c + f233c + g233c + h233c;

    d234c = myTrunc(d232c + d233c, 0); //=TRUNC(D232+D233)
    e234c = myTrunc(e232c + e233c, 0);
    f234c = myTrunc(f232c + f233c, 0);
    g234c = myTrunc(g232c + g233c, 0);
    h234c = myTrunc(h232c + h233c, 0);
    c234c = d234c + e234c + f234c + g234c + h234c;

    c235c = d31c * -1;

    //=IF(C234>ABS(C235),"投資に値する","投資に値しない")
    c240c = (c234c > Math.abs(c235c) ? "投資に値する" : "投資に値しない");

    //++++++++++++++++++++++++++++++++++++++
    //経常利益 成長      計算値（５年後）
    //=計算ワーク!D122
    _d68 = document.getElementById("d68");
    d68 = d122c;
    tmp1 = myTrunc(d68 * 100, 1);
    writeValue(_d68, tmp1, "%");

    //経常利益 成長      もの補助要件チェック結果
    //=計算ワーク!E122
    _g68 = document.getElementById("g68");
    g68 = e122c;
    writeText(_g68, g68, "");



    //付加価値額 成長      計算値（５年後）
    //=計算ワーク!D123
    _d69 = document.getElementById("d69");
    d69 = d123c;
    tmp1 = myTrunc(d69 * 100, 1);
    writeValue(_d69, tmp1, "%");

    //付加価値額 成長      もの補助要件チェック結果
    //=計算ワーク!E123
    _g69 = document.getElementById("g69");
    g69 = e123c;
    writeText(_g69, g69, "");



    //現状
    //=計算ワーク!C202
    _c73 = document.getElementById("c73");
    c73 = c202c;
    writeValue(_c73, c73, "");


    //５年後
    //=計算ワーク!D202
    _d73 = document.getElementById("d73");
    d73 = d202c;
    writeValue(_d73, d73, "");


    //伸び率
    //=計算ワーク!E202
    _e73 = document.getElementById("e73");
    e73 = e202c;
    tmp1 = myRound(e73 * 100, 1);
    writeValue(_e73, tmp1, "%");

    //判定
    //=計算ワーク!F202
    _f73 = document.getElementById("f73");
    f73 = f202c;
    writeText(_f73, f73, "");

    //３．損益分岐点の推移
    //売上高
    //=計算ワーク!C184
    _c77 = document.getElementById("c77");
    _d77 = document.getElementById("d77");
    _e77 = document.getElementById("e77");
    _f77 = document.getElementById("f77");
    _g77 = document.getElementById("g77");
    _h77 = document.getElementById("h77");
    c77 = c184c;
    d77 = d184c;
    e77 = e184c;
    f77 = f184c;
    g77 = g184c;
    h77 = h184c;
    writeValue(_c77, c77, "");
    writeValue(_d77, d77, "");
    writeValue(_e77, e77, "");
    writeValue(_f77, f77, "");
    writeValue(_g77, g77, "");
    writeValue(_h77, h77, "");

    //損益分岐点売上高
    //=計算ワーク!C185
    _c78 = document.getElementById("c78");
    _d78 = document.getElementById("d78");
    _e78 = document.getElementById("e78");
    _f78 = document.getElementById("f78");
    _g78 = document.getElementById("g78");
    _h78 = document.getElementById("h78");
    c78 = c185c;
    d78 = d185c;
    e78 = e185c;
    f78 = f185c;
    g78 = g185c;
    h78 = h185c;
    tmp1 = myRound(c78, 0);
    tmp2 = myRound(d78, 0);
    tmp3 = myRound(e78, 0);
    tmp4 = myRound(f78, 0);
    tmp5 = myRound(g78, 0);
    tmp6 = myRound(h78, 0);
    writeValue(_c78, tmp1, "");
    writeValue(_d78, tmp2, "");
    writeValue(_e78, tmp3, "");
    writeValue(_f78, tmp4, "");
    writeValue(_g78, tmp5, "");
    writeValue(_h78, tmp6, "");

    //損益分岐点比率
    //=計算ワーク!C186
    _c79 = document.getElementById("c79");
    _d79 = document.getElementById("d79");
    _e79 = document.getElementById("e79");
    _f79 = document.getElementById("f79");
    _g79 = document.getElementById("g79");
    _h79 = document.getElementById("h79");
    c79 = c186c;
    d79 = d186c;
    e79 = e186c;
    f79 = f186c;
    g79 = g186c;
    h79 = h186c;
    tmp1 = myRound(c79 * 100, 1);
    tmp2 = myRound(d79 * 100, 1);
    tmp3 = myRound(e79 * 100, 1);
    tmp4 = myRound(f79 * 100, 1);
    tmp5 = myRound(g79 * 100, 1);
    tmp6 = myRound(h79 * 100, 1);
    writeValue(_c79, tmp1, "%");
    writeValue(_d79, tmp2, "%");
    writeValue(_e79, tmp3, "%");
    writeValue(_f79, tmp4, "%");
    writeValue(_g79, tmp5, "%");
    writeValue(_h79, tmp6, "%");


    //４．投資判断としての妥当性


    //法人税率
    _c88 = document.getElementById("c88");
    c88 = getValue(_c88);

    //資本コスト
    _c89 = document.getElementById("c89");
    c89 = getValue(_c89);


    //CIF（営業CF）
    //=計算ワーク!D22
    _d93 = document.getElementById("d93");
    _e93 = document.getElementById("e93");
    _f93 = document.getElementById("f93");
    _g93 = document.getElementById("g93");
    _h93 = document.getElementById("h93");
    d93 = d22c;
    e93 = e22c;
    f93 = f22c;
    g93 = g22c;
    h93 = h22c;
    tmp2 = myRound(d93, 0);
    tmp3 = myRound(e93, 0);
    tmp4 = myRound(f93, 0);
    tmp5 = myRound(g93, 0);
    tmp6 = myRound(h93, 0);
    writeValue(_d93, tmp2, "");
    writeValue(_e93, tmp3, "");
    writeValue(_f93, tmp4, "");
    writeValue(_g93, tmp5, "");
    writeValue(_h93, tmp6, "");

    //税引き後CIF（営業CF）
    //=D93*(1-$C$88)
    _d94 = document.getElementById("d94");
    _e94 = document.getElementById("e94");
    _f94 = document.getElementById("f94");
    _g94 = document.getElementById("g94");
    _h94 = document.getElementById("h94");
    d94 = d93 * (1 - (c88 / 100));
    e94 = e93 * (1 - (c88 / 100));
    f94 = f93 * (1 - (c88 / 100));
    g94 = g93 * (1 - (c88 / 100));
    h94 = h93 * (1 - (c88 / 100));
    tmp2 = myRound(d94, 0);
    tmp3 = myRound(e94, 0);
    tmp4 = myRound(f94, 0);
    tmp5 = myRound(g94, 0);
    tmp6 = myRound(h94, 0);
    writeValue(_d94, tmp2, "");
    writeValue(_e94, tmp3, "");
    writeValue(_f94, tmp4, "");
    writeValue(_g94, tmp5, "");
    writeValue(_h94, tmp6, "");

    //設備の減価償却費
    //=計算ワーク!D28
    _d95 = document.getElementById("d95");
    _e95 = document.getElementById("e95");
    _f95 = document.getElementById("f95");
    _g95 = document.getElementById("g95");
    _h95 = document.getElementById("h95");
    d95 = d28c;
    e95 = e28c;
    f95 = f28c;
    g95 = g28c;
    h95 = h28c;
    tmp2 = myRound(d95, 0);
    tmp3 = myRound(e95, 0);
    tmp4 = myRound(f95, 0);
    tmp5 = myRound(g95, 0);
    tmp6 = myRound(h95, 0);
    writeValue(_d95, tmp2, "");
    writeValue(_e95, tmp3, "");
    writeValue(_f95, tmp4, "");
    writeValue(_g95, tmp5, "");
    writeValue(_h95, tmp6, "");

    //減価償却費のﾀｯｸｽｼｰﾙﾄﾞ
    //=D95*$C$88
    _d96 = document.getElementById("d96");
    _e96 = document.getElementById("e96");
    _f96 = document.getElementById("f96");
    _g96 = document.getElementById("g96");
    _h96 = document.getElementById("h96");
    d96 = d95 * c88 / 100;
    e96 = e95 * c88 / 100;
    f96 = f95 * c88 / 100;
    g96 = g95 * c88 / 100;
    h96 = h95 * c88 / 100;
    tmp2 = myRound(d96, 0);
    tmp3 = myRound(e96, 0);
    tmp4 = myRound(f96, 0);
    tmp5 = myRound(g96, 0);
    tmp6 = myRound(h96, 0);
    writeValue(_d96, tmp2, "");
    writeValue(_e96, tmp3, "");
    writeValue(_f96, tmp4, "");
    writeValue(_g96, tmp5, "");
    writeValue(_h96, tmp6, "");

    //正味CF計（①'＋②）
    //=D94+D96
    _d97 = document.getElementById("d97");
    _e97 = document.getElementById("e97");
    _f97 = document.getElementById("f97");
    _g97 = document.getElementById("g97");
    _h97 = document.getElementById("h97");
    d97 = d94 + d96;
    e97 = e94 + e96;
    f97 = f94 + f96;
    g97 = g94 + g96;
    h97 = h94 + h96;
    tmp2 = myRound(d97, 0);
    tmp3 = myRound(e97, 0);
    tmp4 = myRound(f97, 0);
    tmp5 = myRound(g97, 0);
    tmp6 = myRound(h97, 0);
    writeValue(_d97, tmp2, "");
    writeValue(_e97, tmp3, "");
    writeValue(_f97, tmp4, "");
    writeValue(_g97, tmp5, "");
    writeValue(_h97, tmp6, "");

    //割引率
    //=TRUNC(POWER(1+$C$89,-1),3)
    _d98 = document.getElementById("d98");
    _e98 = document.getElementById("e98");
    _f98 = document.getElementById("f98");
    _g98 = document.getElementById("g98");
    _h98 = document.getElementById("h98");
    d98 = myTrunc(Math.pow(1 + (c89 / 100), -1), 3);
    e98 = myTrunc(Math.pow(1 + (c89 / 100), -2), 3);
    f98 = myTrunc(Math.pow(1 + (c89 / 100), -3), 3);
    g98 = myTrunc(Math.pow(1 + (c89 / 100), -4), 3);
    h98 = myTrunc(Math.pow(1 + (c89 / 100), -5), 3);
    tmp2 = myRound(d98, 3);
    tmp3 = myRound(e98, 3);
    tmp4 = myRound(f98, 3);
    tmp5 = myRound(g98, 3);
    tmp6 = myRound(h98, 3);
    writeValue(_d98, tmp2, "");
    writeValue(_e98, tmp3, "");
    writeValue(_f98, tmp4, "");
    writeValue(_g98, tmp5, "");
    writeValue(_h98, tmp6, "");


    //税引後CIF（営業CF）
    //=TRUNC(D94*D98)
    _d99 = document.getElementById("d99");
    _e99 = document.getElementById("e99");
    _f99 = document.getElementById("f99");
    _g99 = document.getElementById("g99");
    _h99 = document.getElementById("h99");
    d99 = myTrunc(d94 * d98, 0);
    e99 = myTrunc(e94 * e98, 0);
    f99 = myTrunc(f94 * f98, 0);
    g99 = myTrunc(g94 * g98, 0);
    h99 = myTrunc(h94 * h98, 0);
    writeValue(_d99, d99, "");
    writeValue(_e99, e99, "");
    writeValue(_f99, f99, "");
    writeValue(_g99, g99, "");
    writeValue(_h99, h99, "");

    _c99 = document.getElementById("c99");
    c99 = d99 + e99 + f99 + g99 + h99;
    writeValue(_c99, c99, "");



    //タックスシールド
    //=TRUNC(D96*D98)
    _d100 = document.getElementById("d100");
    _e100 = document.getElementById("e100");
    _f100 = document.getElementById("f100");
    _g100 = document.getElementById("g100");
    _h100 = document.getElementById("h100");
    d100 = myTrunc(d96 * d98, 0);
    e100 = myTrunc(e96 * e98, 0);
    f100 = myTrunc(f96 * f98, 0);
    g100 = myTrunc(g96 * g98, 0);
    h100 = myTrunc(h96 * h98, 0);
    writeValue(_d100, d100, "");
    writeValue(_e100, e100, "");
    writeValue(_f100, f100, "");
    writeValue(_g100, g100, "");
    writeValue(_h100, h100, "");

    _c100 = document.getElementById("c100");
    c100 = d100 + e100 + f100 + g100 + h100;
    writeValue(_c100, c100, "");



    //割引現在価値合計
    //=TRUNC(D99+D101)
    _d101 = document.getElementById("d101");
    _e101 = document.getElementById("e101");
    _f101 = document.getElementById("f101");
    _g101 = document.getElementById("g101");
    _h101 = document.getElementById("h101");
    d101 = myTrunc(d99 + d100, 0);
    e101 = myTrunc(e99 + e100, 0);
    f101 = myTrunc(f99 + f100, 0);
    g101 = myTrunc(g99 + g100, 0);
    h101 = myTrunc(h99 + h100, 0);
    writeValue(_d101, d101, "");
    writeValue(_e101, e101, "");
    writeValue(_f101, f101, "");
    writeValue(_g101, g101, "");
    writeValue(_h101, h101, "");

    _c101 = document.getElementById("c101");
    c101 = d101 + e101 + f101 + g101 + h101;
    writeValue(_c101, c101, "");

    //投資額
    //=L32*(-1)
    _c102 = document.getElementById("c102");
    c102 = l32 * -1;
    writeValue(_c102, c102, "");



    //判定 
    //=IF(C101>ABS(C102),"投資に値する","投資に値しない")
    _c83 = document.getElementById("c83");
    g69 = e123c;
    writeText(_g69, g69, "");







}