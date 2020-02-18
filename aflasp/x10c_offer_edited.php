<?php

// セッション開始
session_start();

$LOGIN_ID = $_SESSION[ $SESSION_NAME ];
$LOGIN_TYPE = $_SESSION[ $SESSION_TYPE ];


if ($LOGIN_TYPE=='admin') {
    include 'x10c_header_admin.php';
} else {
    include 'x10c_header_cuser.php';
}

?>

<div id="inc_side_body">

    <div class="topics">HOME &gt; 広告の編集 &gt; 対象ユーザー &gt; <span>編集完了</span></div>

    <div class="comp_list">
        <dl>
            <dt>[ COMPLETE - 編集完了 ]</dt>
            <dd>
                <p>対象ユーザーの承認ステータスを変更しました。</p>
                <ul>
                    <li><a href="index.php">トップページ</a>に戻る。</li>
                </ul>
            </dd>
        </dl>
    </div>

</div>





<?php include 'x10c_footer.php';
