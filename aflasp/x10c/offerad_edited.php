<?php
require('db/x10.php');

// セッション開始
session_start();

$LOGIN_ID = $_SESSION[ $SESSION_NAME ];
$LOGIN_TYPE = $_SESSION[ $SESSION_TYPE ];

?>

<?php
if($LOGIN_TYPE=='admin'){
    include 'header_admin.php'; 
}else{
    include 'header_cuser.php'; 
}
?>

<div id="inc_side_body">

<div class="topics">HOME &gt; 広告の編集 &gt; 入力フォーム &gt; 入力内容の確認 &gt; <span>編集完了</span></div>

    <div class="comp_list">
    <dl>
    <dt>[ COMPLETE - 編集完了 ]</dt>
    <dd>
    <p>登録情報の編集が完了しました。</p>
        <ul>
        <li><a href="../index.php">トップページ</a>に戻る。</li>
        </ul>
    </dd>
    </dl>
    </div>

</div>





<?php include 'footer.php'; ?>