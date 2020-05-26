<?php
session_start();

include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';
include 'x10c/db/x10.php';
include 'x10c/db/nuser.php';
include 'x10c/db/adwares.php';


if ($LOGIN_TYPE=='admin') {
    include 'x10c_header_admin.php';
} else {
    include 'x10c_header_cuser.php';
}


?>

<div id="inc_side_body">

    <div class="topics"><span>エラー画面</span></div>

    <form name="form" method="post" action="login.php?logout=true" style="margin: 0px 0px;">
        <input name="search" type="hidden" value="1">

        <!--アクセスリスト-->
        <div class="topics_accs_list">
            <dl>
                <dt>セッションエラーが発生しました。</dt>
                <dd>
                    ログインしてください&nbsp;<input type="submit" value="ログインする">
                </dd>
            </dl>
        </div>
        <!--topics_list_END-->

    </form>



    </div>

    <?php include 'x10c_footer.php';?>