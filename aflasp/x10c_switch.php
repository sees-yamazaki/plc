<?php
include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';
include 'x10c/db/x10.php';
include 'x10c/db/nuser.php';

// セッション再開
session_start();


// エラーメッセージの初期化
$errorMessage = '';

$nId = $_GET['id'];
$LOGIN_TYPE = $_SESSION[ $SESSION_TYPE ];


// ログインボタンが押された場合
$nuser = getNuser($nId);
if ($LOGIN_TYPE=='admin' && $nuser->id<>"0") {
    $_SESSION[ $SESSION_NAME ] = $nId;
    header('Location: x10u_mypage.php');
}



if ($LOGIN_TYPE=='admin') {
    include 'x10c_header_admin.php';
} else {
    include 'x10c_header_cuser.php';
}

?>

<div id="inc_side_body">
    
    <div class="topics">HOME &gt; <span>自動ログイン</span></div>

    <div class="search_accs">
        <table class="search_accs_table">
            <tr>
                <th width="540">自動ログインに失敗しました</th>
            </tr>
        </table>
    </div>

    </div>

    <?php include 'x10c_footer.php';?>