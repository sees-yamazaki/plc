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