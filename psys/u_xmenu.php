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
            <div id="st-accordion" class="st-accordion">
                <ul>
                    <li>
                        <a href="javascript:void(0)">
                            お知らせ
                            <span class="st-arrow">Open or Close</span>
                        </a>
                        <div class="st-content">
                            <p>現在発送できない商品がございます。</p>
                        </div>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            利用規約
                            <span class="st-arrow">Open or Close</span>
                        </a>
                        <div class="st-content">
                            <p>
                                利用規約。利用規約。利用規約。<br>
                                利用規約。利用規約。利用規約。<br>
                                利用規約。利用規約。利用規約。
                            </p>
                        </div>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            新規登録
                        </a>
                        <div class="st-content">
                            <p><a href="u_membership.php">移動する</a></p>
                        </div>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            ログイン
                        </a>
                        <div class="st-content">
                            <p><a href="u_login.php">移動する</a></p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

    </section>
</content>

<script type="text/javascript" src="./asset/js/main.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script type="text/javascript" src="./asset/js/accordion/jquery.accordion.js"></script>
<script type="text/javascript" src="./asset/js/accordion/jquery.easing.1.3.js"></script>
<script type="text/javascript">
$(function() {
    $('#st-accordion').accordion();
});
</script>