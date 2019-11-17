$(function() {

    // テキストボックスにフォーカス時、フォームの背景色を変化
    $('.number')
        .focusin(function(e) {
            $(this).css('background-color', '#ffc');
        })
        .focusout(function(e) {
            $(this).css('background-color', '');
        });


    //####################################
    //   ≪設備導入前≫
    //####################################

    $('#d2, #d3, #d4')
        .focusout(function(e) {
            d2 = document.getElementById("d2").value.replace(",", "");
            d2 = parseInt(d2);
            d3 = document.getElementById("d3").value.replace(",", "");
            d3 = parseInt(d3);
            d4 = document.getElementById("d4").value.replace(",", "");
            d4 = parseInt(d4);
            d5 = document.getElementById("d5");
            //=(D2-D3-D4)/D2
            d00 = d2 - d3 - d4
            sumd = Math.round((d00 / d2) * 100);
            if (isNaN(sumd)) {
                d5.innerText = "";
            } else {
                d5.innerText = sumd + "%";
            }
        });


    $('#d8')
        .focusout(function(e) {
            x1 = document.getElementById("d8").value.replace(",", "");
            x1 = parseInt(x1);
            y1 = document.getElementById("e9");
            z1 = x1 * 10;
            if (isNaN(z1)) {
                y1.innerText = "";
            } else {
                y1.innerText = z1 + "%";
                document.getElementById("e47").innerHTML = z1 + "%";
            }

            d8 = document.getElementById("d8").value.replace(",", "");
            f8 = document.getElementById("f8").value.replace(",", "");
            document.getElementById("d32").innerHTML = d8 + "：" + f8;


        });

    $('#f8')
        .focusout(function(e) {
            x1 = document.getElementById("f8").value.replace(",", "");
            x1 = parseInt(x1);
            y1 = document.getElementById("e10");
            z1 = x1 * 10;
            if (isNaN(z1)) {
                y1.innerText = "";
            } else {
                y1.innerText = z1 + "%";
                document.getElementById("e48").innerHTML = z1 + "%";
            }

            d8 = document.getElementById("d8").value.replace(",", "");
            f8 = document.getElementById("f8").value.replace(",", "");
            document.getElementById("d32").innerHTML = d8 + "：" + f8;
        });

    $('#d11')
        .focusout(function(e) {
            document.getElementById("i31").innerHTML = document.getElementById("d11").value;
        });
    $('#d12')
        .focusout(function(e) {
            document.getElementById("i32").innerHTML = document.getElementById("d12").value;
        });

    //=TRUNC(SUM(D11)*E13*1.05,1)
    $('#d11, #e13')
        .focusout(function(e) {
            x1 = document.getElementById("d11").value.replace(",", "");
            x1 = parseInt(x1);
            x2 = document.getElementById("e13").value.replace(",", "");
            x2 = parseFloat(x2);
            y1 = document.getElementById("d14");
            z1 = Math.trunc(x1 * (x2 / 100) * 1.05 * 10) / 10;
            if (isNaN(z1)) {
                y1.innerText = "";
            } else {
                y1.innerText = z1;
            }

            d23();
        });

    //=TRUNC(SUM(D12)*E13*0.9,1)
    $('#d12, #e13')
        .focusout(function(e) {
            x1 = document.getElementById("d12").value.replace(",", "");
            x1 = parseInt(x1);
            x2 = document.getElementById("e13").value.replace(",", "");
            x2 = parseFloat(x2);
            y1 = document.getElementById("d15");
            z1 = Math.trunc(x1 * (x2 / 100) * 0.9 * 10) / 10;
            if (isNaN(z1)) {
                y1.innerText = "";
            } else {
                y1.innerText = z1;
            }
            d24();
        });

    //=TRUNC(SUM(D3)*D8*0.1*10000/I11,1)*1.1
    //I11 --> =TRUNC(I8*10000/D11)
    //I8  --> =TRUNC(D2*D8/10,1)
    $('#d3, #d8, #d11, #d2')
        .focusout(function(e) {
            d3 = document.getElementById("d3").value.replace(",", "");
            d3 = parseInt(d3);
            d8 = document.getElementById("d8").value.replace(",", "");
            d8 = parseInt(d8);
            d11 = document.getElementById("d11").value.replace(",", "");
            d11 = parseInt(d11);
            d2 = document.getElementById("d2").value.replace(",", "");
            d2 = parseInt(d2);
            y1 = document.getElementById("d17");

            //I8  --> =TRUNC(D2*D8/10,1)
            i8 = d2 * d8 / 10;
            //I11 --> =TRUNC(I8*10000/D11)
            i11 = Math.trunc(i8 * 10000 / d11);

            //=TRUNC(SUM(D3)*D8*0.1*10000/I11,1)*1.1
            z1 = Math.trunc((d3 * d8 * 0.1 * 10000) / i11 * 10) / 10 * 1.1;
            z1 = Math.trunc(z1 * 10) / 10;


            if (isNaN(z1)) {
                y1.innerText = "";
            } else {
                y1.innerText = z1;
            }

            //合計値の計算
            // d14 = document.getElementById("d14").innerText;
            // d14 = parseFloat(d14);
            // d17 = document.getElementById("d17").innerText;
            // d17 = parseFloat(d17);
            // d20 = document.getElementById("d20").innerText;
            // d20 = parseFloat(d20);
            // y1 = document.getElementById("d23");
            // z1 = d14 + d17 + d20;
            // if (isNaN(z1)) {
            //     y1.innerText = "";
            // } else {
            //     y1.innerText = z1;
            // }
            d23();


        });


    //=TRUNC(SUM(D3)*F8*0.1*10000/I12,1)
    //I12 --> =TRUNC(I9*10000/D12)
    //I9  --> =TRUNC(D2*F8/10,1)
    $('#d3, #f8, #d12, #d2')
        .focusout(function(e) {
            d3 = document.getElementById("d3").value.replace(",", "");
            d3 = parseInt(d3);
            f8 = document.getElementById("f8").value.replace(",", "");
            f8 = parseInt(f8);
            d12 = document.getElementById("d12").value.replace(",", "");
            d12 = parseInt(d12);
            d2 = document.getElementById("d2").value.replace(",", "");
            d2 = parseInt(d2);
            y1 = document.getElementById("d18");

            //I9  --> =TRUNC(D2*F8/10,1)
            i9 = d2 * f8 / 10;
            //I12 --> =TRUNC(I9*10000/D12)
            i12 = Math.trunc(i9 * 10000 / d12);

            //=TRUNC(SUM(D3)*F8*0.1*10000/I12,1)
            z1 = Math.trunc((d3 * f8 * 0.1 * 10000) / i12 * 10) / 10;


            if (isNaN(z1)) {
                y1.innerText = "";
            } else {
                y1.innerText = z1;
            }

            d24();
        });


    //=TRUNC(SUM(D4)*D8*0.1*10000/I11,1)
    $('#d4, #d8, #d11, #d2')
        .focusout(function(e) {
            d4 = document.getElementById("d4").value.replace(",", "");
            d4 = parseInt(d4);
            d8 = document.getElementById("d8").value.replace(",", "");
            d8 = parseInt(d8);
            d11 = document.getElementById("d11").value.replace(",", "");
            d11 = parseInt(d11);
            d2 = document.getElementById("d2").value.replace(",", "");
            d2 = parseInt(d2);
            y1 = document.getElementById("d20");

            //I8  --> =TRUNC(D2*D8/10,1)
            i8 = d2 * d8 / 10;
            //I11 --> =TRUNC(I8*10000/D11)
            i11 = Math.trunc(i8 * 10000 / d11);

            //=TRUNC(SUM(D4)*D8*0.1*10000/I11,1)
            z1 = Math.trunc((d4 * d8 * 0.1 * 10000) / i11 * 10) / 10;


            if (isNaN(z1)) {
                y1.innerText = "";
            } else {
                y1.innerText = z1;
            }

            d23();

        });

    //=TRUNC(SUM(D4)*F8*0.1*10000/I12,1)
    $('#d4, #f8, #d12, #d2')
        .focusout(function(e) {
            d4 = document.getElementById("d4").value.replace(",", "");
            d4 = parseInt(d4);
            f8 = document.getElementById("f8").value.replace(",", "");
            f8 = parseInt(f8);
            d12 = document.getElementById("d12").value.replace(",", "");
            d12 = parseInt(d12);
            d2 = document.getElementById("d2").value.replace(",", "");
            d2 = parseInt(d2);
            y1 = document.getElementById("d21");

            //I9  --> =TRUNC(D2*F8/10,1)
            i9 = d2 * f8 / 10;
            //I12 --> =TRUNC(I9*10000/D12)
            i12 = Math.trunc(i9 * 10000 / d12);

            //=TRUNC(SUM(D4)*F8*0.1*10000/I12,1)
            z1 = Math.trunc((d4 * f8 * 0.1 * 10000) / i12 * 10) / 10;


            if (isNaN(z1)) {
                y1.innerText = "";
            } else {
                y1.innerText = z1;
            }

            d24();
        });

    function d23() {

        //合計値の計算
        d14 = document.getElementById("d14").innerText;
        d14 = parseFloat(d14);
        d17 = document.getElementById("d17").innerText;
        d17 = parseFloat(d17);
        d20 = document.getElementById("d20").innerText;
        d20 = parseFloat(d20);
        y1 = document.getElementById("d23");
        z1 = d14 + d17 + d20;
        if (isNaN(z1)) {
            y1.innerText = "";
        } else {
            y1.innerText = z1;
        }
    }

    function d24() {

        //合計値の計算
        d15 = document.getElementById("d15").innerText;
        d15 = parseFloat(d15);
        d18 = document.getElementById("d18").innerText;
        d18 = parseFloat(d18);
        d21 = document.getElementById("d21").innerText;
        d21 = parseFloat(d21);
        y1 = document.getElementById("d24");
        z1 = d15 + d18 + d21;
        if (isNaN(z1)) {
            y1.innerText = "";
        } else {
            y1.innerText = z1;
        }
    }

    //####################################
    //   ≪成長を設定（５年後）≫
    //####################################


    //=TRUNC(SUM(D4)*F8*0.1*10000/I12,1)
    $('#l29, #l30, #l31')
        .focusout(function(e) {
            l29 = document.getElementById("l29").value.replace(",", "");
            if (isNaN(l29) || l29 == "") {
                l29 = 0;
            }
            l29 = parseInt(l29);
            l30 = document.getElementById("l30").value.replace(",", "");
            if (isNaN(l30) || l30 == "") {
                l30 = 0;
            }
            l30 = parseInt(l30);
            l31 = document.getElementById("l31").value.replace(",", "");
            if (isNaN(l31) || l31 == "") {
                l31 = 0;
            }
            l31 = parseInt(l31);
            y1 = document.getElementById("l32");


            z1 = l29 + l30 + l31;

            if (isNaN(z1)) {
                y1.innerText = "";
            } else {
                y1.innerText = z1;
            }

        });


    //=IF(L32*(IF(L33="2/3",0.666,0.5))>10000000,10000000,TRUNC(L32*(IF(L33="2/3",2/3,0.5))))
    $('#l29, #l30, #l31')
        .focusout(function(e) {
            l32 = document.getElementById("l32").innerHTML;
            l32 = parseInt(l32);
            l33 = document.getElementById("l33").value;
            l33 = parseInt(l33);

            y1 = document.getElementById("l34");

            rate = 0.5;
            if (l33 == 1) { rate = 0.666; }

            z1 = l32 * rate;

            if (z1 > 10000000) {
                z1 = 10000000;
            }

            z1 = Math.trunc(z1);

            if (isNaN(z1)) {
                y1.innerText = "";
            } else {
                y1.innerText = z1;
            }

        });

    //=IF(L35="する",L32-L34,(L32-L34)/10)
    $('#l29, #l30, #l31')
        .focusout(function(e) {
            l32 = document.getElementById("l32").innerHTML;
            l32 = parseInt(l32);
            l34 = document.getElementById("l34").innerHTML;
            l34 = parseInt(l34);
            l35 = document.getElementById("l35").value;
            l35 = parseInt(l35);

            y1 = document.getElementById("l36");

            z1 = l32 - l34;
            if (l35 == 1) {
                z1 = z1 / 10;
            }

            if (isNaN(z1)) {
                y1.innerText = "";
            } else {
                y1.innerText = z1;
            }

        });

    //=D2*D29/100
    $('#d2, #d29')
        .focusout(function(e) {

            //d40=================
            d2 = document.getElementById("d2").value.replace(",", "");
            d2 = parseInt(d2);
            d29 = document.getElementById("d29").value;
            d29 = parseInt(d29);
            d40 = (d2 * d29 / 100);
            //=====================

            y1 = document.getElementById("d40");

            z1 = d40;
            z1 = Math.trunc(z1);

            if (isNaN(z1)) {
                y1.innerText = "";
            } else {
                y1.innerText = z1;
            }

        });



    //=D40*((D3/D2)-D30/100)
    $('#d2, #d3, #d30')
        .focusout(function(e) {

            //d40=================
            d2 = document.getElementById("d2").value.replace(",", "");
            d2 = parseInt(d2);
            d29 = document.getElementById("d29").value;
            d29 = parseInt(d29);
            d40 = (d2 * d29 / 100);
            //=====================

            //d41======================
            d2 = document.getElementById("d2").value.replace(",", "");
            d2 = parseInt(d2);
            d3 = document.getElementById("d3").value.replace(",", "");
            d3 = parseInt(d3);
            d30 = document.getElementById("d30").value;
            d30 = parseFloat(d30);

            d41 = (d40 * ((d3 / d2) - (d30 / 100)));
            //========================


            y1 = document.getElementById("d41");

            z1 = d41;
            z1 = Math.round(z1);

            if (isNaN(z1)) {
                y1.innerText = "";
            } else {
                y1.innerText = z1;
            }

        });



    //=D40*(D4/D2)*0.92
    $('#d2, #d4')
        .focusout(function(e) {

            //d40=================
            d2 = document.getElementById("d2").value.replace(",", "");
            d2 = parseInt(d2);
            d29 = document.getElementById("d29").value;
            d29 = parseInt(d29);
            d40 = (d2 * d29 / 100);
            //=====================

            //d42===========================
            d2 = document.getElementById("d2").value.replace(",", "");
            d2 = parseInt(d2);
            d4 = document.getElementById("d4").value.replace(",", "");
            d4 = parseInt(d4);
            //d40 = d40();
            d29 = document.getElementById("d29").value;
            d29 = parseInt(d29);

            d42 = (d40 * (d4 / d2) * 0.92);
            //==============================

            y1 = document.getElementById("d42");

            z1 = d42;
            z1 = Math.round(z1);

            if (isNaN(z1)) {
                y1.innerText = "";
            } else {
                y1.innerText = z1;
            }

        });

    //=(D40-D41-D42)/D40
    $('#d2, #d4')
        .focusout(function(e) {

            //d40=================
            d2 = document.getElementById("d2").value.replace(",", "");
            d2 = parseInt(d2);
            d29 = document.getElementById("d29").value;
            d29 = parseInt(d29);
            d40 = (d2 * d29 / 100);
            //=====================

            //d41======================
            d2 = document.getElementById("d2").value.replace(",", "");
            d2 = parseInt(d2);
            d3 = document.getElementById("d3").value.replace(",", "");
            d3 = parseInt(d3);
            d30 = document.getElementById("d30").value;
            d30 = parseFloat(d30);

            d41 = (d40 * ((d3 / d2) - (d30 / 100)));
            //========================

            //d42===========================
            d2 = document.getElementById("d2").value.replace(",", "");
            d2 = parseInt(d2);
            d4 = document.getElementById("d4").value.replace(",", "");
            d4 = parseInt(d4);
            //d40 = d40();
            d29 = document.getElementById("d29").value;
            d29 = parseInt(d29);

            d42 = (d40 * (d4 / d2) * 0.92);
            //==============================


            y1 = document.getElementById("d43");

            z1 = (d40 - d41 - d42) / d40 * 100;
            z1 = Math.round(z1);

            if (isNaN(z1)) {
                y1.innerText = "";
            } else {
                y1.innerText = z1 + "%";
            }

        });

    //=D6+D31
    $('#d6, #d31')
        .focusout(function(e) {

            d6 = document.getElementById("d6").value.replace(",", "");
            d6 = parseInt(d2);
            d31 = document.getElementById("d31").value;
            d31 = parseInt(d31);

            y1 = document.getElementById("d44");

            z1 = d6 + d31;

            if (isNaN(z1)) {
                y1.innerText = "";
            } else {
                y1.innerText = z1;
            }

        });

    //####################################
    //   ≪設備導入後≫
    //####################################

    //生菓子平均材料原価
    //=TRUNC(SUM(D49)*E51*1.05,1)
    $('#d49, #e51')
        .focusout(function(e) {
            d49 = document.getElementById("d49").value.replace(",", "");
            d49 = parseInt(d49);
            e51 = document.getElementById("e51").value.replace(",", "");
            e51 = parseFloat(e51);
            y1 = document.getElementById("d52");
            z1 = Math.trunc(d49 * (e51 / 100) * 1.05 * 10) / 10;
            if (isNaN(z1)) {
                y1.innerText = "";
            } else {
                y1.innerText = z1;
            }

            d61();
        });


    //焼菓子平均材料原価
    //=TRUNC(SUM(D50)*E51*0.9,1)
    $('#d50, #e51')
        .focusout(function(e) {
            d50 = document.getElementById("d50").value.replace(",", "");
            d50 = parseInt(d50);
            e51 = document.getElementById("e51").value.replace(",", "");
            e51 = parseFloat(e51);
            y1 = document.getElementById("d53");
            z1 = Math.trunc(d50 * (e51 / 100) * 0.9 * 10) / 10;
            if (isNaN(z1)) {
                y1.innerText = "";
            } else {
                y1.innerText = z1;
            }
            d62();
        });



    //生菓子平均労務費
    //=TRUNC(SUM(D41)*D32*0.1*10000/I49,1)*1.1
    //I49 --> =TRUNC(I46*10000/D49)
    //I46 --> =TRUNC(D40*D32/10,1)
    $('#d3, #d30, #d32, #d2')
        .focusout(function(e) {

            //d41======================
            d2 = document.getElementById("d2").value.replace(",", "");
            d2 = parseInt(d2);
            d3 = document.getElementById("d3").value.replace(",", "");
            d3 = parseInt(d3);
            d30 = document.getElementById("d30").value;
            d30 = parseFloat(d30);

            d41 = (d40 * ((d3 / d2) - (d30 / 100)));
            //========================

            //d32はd8を参照している
            d32 = document.getElementById("d8").value.replace(",", "");
            d32 = parseInt(d32);
            d49 = document.getElementById("d49").value.replace(",", "");
            d49 = parseInt(d49);

            y1 = document.getElementById("d55");

            //I46 --> =TRUNC(D40*D32/10,1)
            i46 = d40 * d32 / 10;
            //I49 --> =TRUNC(I46*10000/D49)
            i49 = Math.trunc(i46 * 10000 / d49);

            //=TRUNC(SUM(D41)*D32*0.1*10000/I49,1)*1.1
            z1 = Math.trunc((d41 * d32 * 0.1 * 10000) / i49 * 10) / 10 * 1.1;
            z1 = Math.trunc(z1 * 10) / 10;


            if (isNaN(z1)) {
                y1.innerText = "";
            } else {
                y1.innerText = z1;
            }

            d61();

        });


    //焼菓子平均労務費
    //=TRUNC(SUM(D41)*F32*0.1*10000/I50,1)
    //I50 --> =TRUNC(I47*10000/D50)
    //I47 --> =TRUNC(D40*F32/10,1)
    $('#d3, #f32, #d30, #d2')
        .focusout(function(e) {

            //d41======================
            d2 = document.getElementById("d2").value.replace(",", "");
            d2 = parseInt(d2);
            d3 = document.getElementById("d3").value.replace(",", "");
            d3 = parseInt(d3);
            d30 = document.getElementById("d30").value;
            d30 = parseFloat(d30);

            d41 = (d40 * ((d3 / d2) - (d30 / 100)));
            //========================

            //f32はf8を参照している
            f32 = document.getElementById("f8").value.replace(",", "");
            f32 = parseInt(f32);
            d50 = document.getElementById("d50").value.replace(",", "");
            d50 = parseInt(d50);

            //d40=================
            d2 = document.getElementById("d2").value.replace(",", "");
            d2 = parseInt(d2);
            d29 = document.getElementById("d29").value;
            d29 = parseInt(d29);
            d40 = (d2 * d29 / 100);
            //=====================

            y1 = document.getElementById("d56");

            //I47 --> =TRUNC(D40*F32/10,1)
            i47 = d40 * f32 / 10;
            //I50 --> =TRUNC(I47*10000/D50)
            i50 = Math.trunc(i47 * 10000 / d50);

            //=TRUNC(SUM(D41)*F32*0.1*10000/I50,1)
            z1 = Math.trunc((d41 * f32 * 0.1 * 10000) / i50 * 10) / 10;


            if (isNaN(z1)) {
                y1.innerText = "";
            } else {
                y1.innerText = z1;
            }

            d62();
        });


    //生菓子平均販管費
    //=TRUNC(SUM(D42)*D32*0.1*10000/I49,1)

    //=TRUNC(SUM(D4)*D8*0.1*10000/I11,1)
    $('#d4, #d8, #d11, #d2')
        .focusout(function(e) {

            //d42===========================
            d2 = document.getElementById("d2").value.replace(",", "");
            d2 = parseInt(d2);
            d4 = document.getElementById("d4").value.replace(",", "");
            d4 = parseInt(d4);
            //d40 = d40();
            d29 = document.getElementById("d29").value;
            d29 = parseInt(d29);

            d42 = (d40 * (d4 / d2) * 0.92);
            //==============================
alert("W1");
            d32 = document.getElementById("d32").value.replace(",", "");
            d32 = parseInt(d32);
            d49 = document.getElementById("d49").value.replace(",", "");
            d49 = parseInt(d49);
            alert("W2");

            y1 = document.getElementById("d58");

            //I46 --> =TRUNC(D40*D32/10,1)
            i46 = d40 * d32 / 10;
            //I49 --> =TRUNC(I46*10000/D49)
            i49 = Math.trunc(i46 * 10000 / d49);
            alert("W3");

            //=TRUNC(SUM(D42)*D32*0.1*10000/I49,1)
            z1 = Math.trunc((d42 * d32 * 0.1 * 10000) / i49 * 10) / 10;

            alert("W4");

            if (isNaN(z1)) {
                y1.innerText = "";
            } else {
                y1.innerText = z1;
            }

            d61();

        });

    //焼菓子平均販管費
    //=TRUNC(SUM(D42)*F32*0.1*10000/I50,1)

    //=TRUNC(SUM(D4)*F8*0.1*10000/I12,1)
    $('#d4, #f8, #d12, #d2')
        .focusout(function(e) {

            //d42===========================
            d2 = document.getElementById("d2").value.replace(",", "");
            d2 = parseInt(d2);
            d4 = document.getElementById("d4").value.replace(",", "");
            d4 = parseInt(d4);
            //d40 = d40();
            d29 = document.getElementById("d29").value;
            d29 = parseInt(d29);

            d42 = (d40 * (d4 / d2) * 0.92);
            //==============================

            f32 = document.getElementById("f32").value.replace(",", "");
            f32 = parseInt(f32);
            d50 = document.getElementById("d50").value.replace(",", "");
            d50 = parseInt(d50);

            y1 = document.getElementById("d59");

            //I47 --> =TRUNC(D40*F32/10,1)
            i47 = d40 * f32 / 10;
            //I50 --> =TRUNC(I47*10000/D50)
            i50 = Math.trunc(i47 * 10000 / d50);

            //=TRUNC(SUM(D42)*F32*0.1*10000/I50,1)
            z1 = Math.trunc((d42 * f32 * 0.1 * 10000) / i50 * 10) / 10;


            if (isNaN(z1)) {
                y1.innerText = "";
            } else {
                y1.innerText = z1;
            }

            d62();
        });



    function d61() {

        //合計値の計算
        // d52 = document.getElementById("d52").innerText;
        // d52 = parseFloat(d52);
        // d55 = document.getElementById("d55").innerText;
        // d55 = parseFloat(d55);
        // d58 = document.getElementById("d58").innerText;
        // d58 = parseFloat(d58);
        // y1 = document.getElementById("d61");
        // z1 = d52 + d55 + d58;
        // if (isNaN(z1)) {
        //     y1.innerText = "";
        // } else {
        //     y1.innerText = z1;
        // }
    }

    function d62() {

        //合計値の計算
        // d53 = document.getElementById("d53").innerText;
        // d53 = parseFloat(d53);
        // d56 = document.getElementById("d56").innerText;
        // d56 = parseFloat(d56);
        // d59 = document.getElementById("d59").innerText;
        // d59 = parseFloat(d59);
        // y1 = document.getElementById("d62");
        // z1 = d53 + d56 + d59;
        // if (isNaN(z1)) {
        //     y1.innerText = "";
        // } else {
        //     y1.innerText = z1;
        // }
    }



});