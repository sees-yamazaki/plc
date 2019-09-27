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