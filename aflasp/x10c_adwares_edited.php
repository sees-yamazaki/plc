<?php
session_start();

require('custom/conf.php');

$LOGIN_ID = $_SESSION[ $SESSION_NAME ];
$LOGIN_TYPE = $_SESSION[ $SESSION_TYPE ];

$deleteAd = $_GET['deleteAd'];


if (empty($deleteAd)) {
    $pankuzu = 'HOME &gt; 広告の編集 &gt; 入力フォーム &gt; 入力内容の確認 &gt; <span>編集完了</span>';
    $comment = '[ COMPLETE - 編集完了 ]';
    $comment2 = '登録情報の編集が完了しました。';
} else {
    $pankuzu = 'HOME &gt; 広告情報削除 &gt; 削除内容の確認 &gt; <span>削除完了</span>';
    $comment = '[ COMPLETE - 削除完了 ]';
    $comment2 = '登録情報の削除が完了しました。';
}

if ($LOGIN_TYPE=='admin') {
    include 'x10c_header_admin.php';
} else {
    include 'x10c_header_cuser.php';
}

?>

<div id="inc_side_body">

    <div class="topics"><?php echo $pankuzu; ?></div>

    <div class="comp_list">
        <dl>
            <dt><?php echo $comment; ?></dt>
            <dd>
                <p><?php echo $comment2; ?></p>
                <ul>
                    <li><a href="index.php">トップページ</a>に戻る。</li>
                </ul>
            </dd>
        </dl>
    </div>

</div>





<?php include 'x10c_footer.php';
