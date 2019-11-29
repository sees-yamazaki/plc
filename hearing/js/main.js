function submitChk() {
    if (window.confirm('回答を登録しても良いでえすか？')) {
        return true;
    } else {
        return false;
    }
}

function addcheck() {
    if (window.confirm('登録してもよろしいですか？')) {
        return true;
    } else {
        return false;
    }
}

function selectcheck() {
    if (window.confirm('選択したデータを読み込んでよろしいですか？')) {
        return true;
    } else {
        return false;
    }
}

function delcheck() {
    if (window.confirm('削除してもよろしいですか？')) {
        return true;
    } else {
        return false;
    }
}


function reMyPWcheck() {
    if (window.confirm('パスワードを更新してもよろしいですか？')) {
        return true;
    } else {
        return false;
    }
}

function rePWcheck() {
    if (window.confirm('パスワードを　IDで　初期化してもよろしいですか？')) {
        return true;
    } else {
        return false;
    }
}

function back1() {
    if (window.confirm('登録を中断してもよろしいですか？')) {
        document.getElementById("sakubun1").submit();
        return true;
    } else {
        return false;
    }
}


function isReset() {
    if (window.confirm('リセットしてよろしいですか？')) {
        window.location.href = 'hearingsheet1.php';
    } else {}
}


function showList() {
    if (window.confirm('現在の編集内容は全て破棄されます。　よろしいですか？')) {
        window.location.href = 'info_list.php';
    } else {}
}

function showUser() {
    if (window.confirm('現在の編集内容は全て破棄されます。　よろしいですか？')) {
        window.location.href = 'users_list.php';
    } else {}
}

function back2() {
    document.getElementById("sakubun1").submit();
}

function sakubunCheck() {
    tmp = document.getElementById("a1r").value;
    if (tmp == "") {
        alert("「自動作文」を先に実行してください。");
    } else {
        document.getElementById("infos").submit();
    }
}


function sliceMaxLength(elem, maxLength) {
    elem.value = elem.value.slice(0, maxLength);
}

/**************************
 * カンマ編集を行うFunction
 **************************/
// function toComma(obj) {
//     if ((obj.value).trim().length != 0 && !isNaN(obj.value)) {
//         obj.value = Number(obj.value).toLocaleString();
//     }
// }

function toComma(obj, dp) {
    if ((obj.value).trim().length != 0 && !isNaN(obj.value)) {
        nf = new Intl.NumberFormat("ja-JP", { useGrouping: true, style: 'decimal', minimumFractionDigits: dp, maximumFractionDigits: dp });
        obj.value = nf.format(obj.value);
        //obj.value = Number(obj.value).toLocaleString();
    }
}

// function toComma2(obj) {
//     if ((obj.value).trim().length != 0 && !isNaN(obj.value)) {
//         nf = new Intl.NumberFormat("ja-JP", { useGrouping: true, style: 'decimal', minimumFractionDigits: 2, maximumFractionDigits: 2 });
//         obj.value = nf.format(obj.value);
//         //obj.value = Number(obj.value).toLocaleString();
//     }
// }


// function getValueExt2(rng, dp, mlp) {
//     tmp0 = document.getElementById(rng).value.replace(/,/g, '').replace('%', '');
//     tmp0 = tmp0 * mlp;
//     nf = new Intl.NumberFormat("ja-JP", { useGrouping: true, style: 'decimal', minimumFractionDigits: dp, maximumFractionDigits: dp });
//     rtn = nf.format(tmp0);
//     return rtn;
// }


/**************************
 * カンマ編集を解除するFunction
 **************************/
function offComma(obj) {
    var reg = new RegExp(",", "g");
    var chgVal = obj.value.replace(reg, "");
    if (!isNaN(chgVal)) {
        obj.value = chgVal; //値セット
        obj.select(); //全選択
    }
}
window.onload = function() {
    var elements = document.getElementsByClassName("number");
    for (var i = 0; i < elements.length; i++) {
        elements[i].onfocus = function() { offComma(this); }
        elements[i].onblur = function() { toComma(this, 0); }
    }
    var elements = document.getElementsByClassName("number1");
    for (var i = 0; i < elements.length; i++) {
        elements[i].onfocus = function() { offComma(this); }
        elements[i].onblur = function() { toComma(this, 1); }
    }
    var elements = document.getElementsByClassName("number2");
    for (var i = 0; i < elements.length; i++) {
        elements[i].onfocus = function() { offComma(this); }
        elements[i].onblur = function() { toComma(this, 2); }
    }



    x1 = document.getElementById("cnt").value;
    if (x1 == "1") {

        document.getElementById("users_seq").value = document.getElementById("users_seqx").value;
        document.getElementById("title1").value = document.getElementById("title1x").value;
        document.getElementById("title2").value = document.getElementById("title2x").value;
        document.getElementById("d2").value = document.getElementById("d2x").value;
        document.getElementById("d3").value = document.getElementById("d3x").value;
        document.getElementById("d4").value = document.getElementById("d4x").value;
        document.getElementById("d6").value = document.getElementById("d6x").value;
        document.getElementById("d8").value = document.getElementById("d8x").value;
        document.getElementById("f8").value = document.getElementById("f8x").value;
        document.getElementById("d11").value = document.getElementById("d11x").value;
        document.getElementById("d12").value = document.getElementById("d12x").value;
        document.getElementById("e13").value = document.getElementById("e13x").value;
        document.getElementById("d29").value = document.getElementById("d29x").value;
        document.getElementById("scrl1").value = document.getElementById("d29x").value;
        document.getElementById("d30").value = document.getElementById("d30x").value;
        document.getElementById("d31").value = document.getElementById("d31x").value;
        document.getElementById("l29").value = document.getElementById("l29x").value;
        document.getElementById("l30").value = document.getElementById("l30x").value;
        document.getElementById("l31").value = document.getElementById("l31x").value;
        document.getElementById("d49").value = document.getElementById("d49x").value;
        document.getElementById("d50").value = document.getElementById("d50x").value;
        document.getElementById("e51").value = document.getElementById("e51x").value;
        document.getElementById("c68").value = document.getElementById("c68x").value;
        document.getElementById("c69").value = document.getElementById("c69x").value;
        document.getElementById("l73").value = document.getElementById("l73x").value;
        document.getElementById("c88").value = document.getElementById("c88x").value;
        document.getElementById("c89").value = document.getElementById("c89x").value;
        document.getElementById("i18").value = document.getElementById("i18x").value;
        document.getElementById("i56").value = document.getElementById("i56x").value;
        document.getElementById("a1r").value = document.getElementById("a1rx").value;
        document.getElementById("a6r").value = document.getElementById("a6rx").value;
        document.getElementById("a11r").value = document.getElementById("a11rx").value;
        document.getElementById("a26r").value = document.getElementById("a26rx").value;
        document.getElementById("a29r").value = document.getElementById("a29rx").value;
        document.getElementById("a44r").value = document.getElementById("a44rx").value;
        document.getElementById("a51r").value = document.getElementById("a51rx").value;
        document.getElementById("a62r").value = document.getElementById("a62rx").value;
        document.getElementById("a75r").value = document.getElementById("a75rx").value;
        document.getElementById("a87r").value = document.getElementById("a87rx").value;
        document.getElementById("a96r").value = document.getElementById("a96rx").value;
        doCalc();
        sakubun(1);
        page1();
    }
};


function page1() {
    const p1 = document.getElementById("inputsheet");
    const p2 = document.getElementById("calcsheet");
    const p3 = document.getElementById("report");
    p1.style.display = "block";
    p2.style.display = "none";
    p3.style.display = "none";
    p1.classList.add("active");
    p2.classList.remove("active");
    p3.classList.remove("active");

}

function page2() {
    const p1 = document.getElementById("inputsheet");
    const p2 = document.getElementById("calcsheet");
    const p3 = document.getElementById("report");
    p1.style.display = "none";
    p2.style.display = "block";
    p3.style.display = "none";
    p1.classList.remove("active");
    p2.classList.add("active");
    p3.classList.remove("active");

}

function page3() {
    const p1 = document.getElementById("inputsheet");
    const p2 = document.getElementById("calcsheet");
    const p3 = document.getElementById("report");
    p1.style.display = "none";
    p2.style.display = "none";
    p3.style.display = "block";
    p1.classList.remove("active");
    p2.classList.remove("active");
    p3.classList.add("active");

}