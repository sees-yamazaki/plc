$(function() {

    // テキストボックスにフォーカス時、フォームの背景色を変化
    $('.number')
        .focusin(function(e) {
            $(this).css('background-color', '#ffc');
        })
        .focusout(function(e) {
            $(this).css('background-color', '');
        });

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
            }
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
            }
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









});