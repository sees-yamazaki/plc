<content>

    <input id="hamburger" class="hamburger" type="checkbox" />
    <label class="hamburger" for="hamburger" onclick="prizeHide()">
        <i></i>
        <text>
            <close>close</close>
            <open>menu</open>
        </text>
    </label>

    <section class="drawer-list">
        <div class="wrapper">
            <div id="st-title">
                <img id="st-img" src="./asset/image/title_logo_menu.png">
            </div>
            <div id="st-accordion" class="st-accordion">
                <ul>
                    <?php $dd = getSsn('SEQ'); ?>
                    <?php if(!empty($dd)){ ?>
                    <li>
                        <a href="u_info.php?menu=0">お知らせ</a>
                    </li>
                    <?php } ?>
                    <li>
                        <a href="u_info.php?menu=1">よくあるご質問</a>
                    </li>
                    <li>
                        <a href="u_info.php?menu=2">お問い合わせ</a>
                    </li>
                    <li>
                        <a href="u_info.php?menu=3">利用規約</a>
                    </li>
                    <li>
                        <a href="u_info.php?menu=4">プライバシーポリシー</a>
                    </li>
                    <?php if(empty($dd)){ ?>
                    <li>
                        <a href="u_membership.php">新規登録</a>
                    </li>
                    <li>
                        <a href="u_login.php">ログイン</a>
                    </li>
                    <?php }else{ ?>
                    <li>
                        <a href="u_member_edit.php">登録情報修正</a>
                    </li>
                    <li>
                        <a href="u_logoff.php">ログオフ</a>
                    </li>
                    <?php } ?>
                </ul>
            </div>

        </div>

    </section>
</content>

<script type="text/javascript" src="./asset/js/main.js"></script>
<!--
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script type="text/javascript" src="./asset/js/accordion/jquery.accordion.js"></script>
<script type="text/javascript" src="./asset/js/accordion/jquery.easing.1.3.js"></script>
<script type="text/javascript">
$(function() {
    $('#st-accordion').accordion();
});
</script>
-->