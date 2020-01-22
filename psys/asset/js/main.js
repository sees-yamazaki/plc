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

function openclose() {
    obj = document.getElementById('open').style;
    if (obj.display == 'block') {
        obj.display = 'none';
        document.getElementById('searchfrom').style.backgroundColor = '#e4e4e4';
    } else {
        obj.display = 'block';
        document.getElementById('searchfrom').style.backgroundColor = '#eee';
    }

}

function prizeHide() {
    const p1 = document.getElementById("scrl");

    if (p1 != null) {
        var p2 = document.getElementsByName('scrl');
        for (var i = 0; p2.length; i++) {
            // if (p2[i].style.display != "none") {
            //     // noneで非表示
            //     p2[i].style.display = "none";
            // } else {
            //     // blockで表示
            //     p2[i].style.display = "block";
            //     p2[i].style.width = "10%";
            // }
            if (p2[i].clientWidth < 100) {
                p2[i].style.width = "100%";
            } else {
                p2[i].style.width = "0px";
            }

        }
    }
}