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