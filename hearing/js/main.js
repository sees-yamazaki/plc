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

function pwcheck() {
    if (window.confirm('パスワードを初期化してよろしいですか？')) {
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


function rePWcheck() {
    if (window.confirm('パスワードを初期化してもよろしいですか？')) {
        return true;
    } else {
        return false;
    }
}


function sliceMaxLength(elem, maxLength) {
    elem.value = elem.value.slice(0, maxLength);
}

/**************************
 * カンマ編集を行うFunction
 **************************/
function toComma(obj) {
    if ((obj.value).trim().length != 0 && !isNaN(obj.value)) {
        obj.value = Number(obj.value).toLocaleString();
    }
}

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
        elements[i].onblur = function() { toComma(this); }
    }
};