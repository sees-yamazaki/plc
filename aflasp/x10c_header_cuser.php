<html lang='ja'>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
    <meta http-equiv="Content-Script-Type" content="text/javascript">
    <meta http-equiv="Content-Style-Type" content="text/css">
    <meta name="description" content="アフィリエイトシステム">
    <meta name="keywords" content="アフィリエイト">
    <link rel="stylesheet" type="text/css" href="template/pc/css/base.css?1528179668" media="all">
    <link rel="stylesheet" type="text/css" href="template/pc/css/jquery.lightbox.css?1528179668" media="all">
    <link rel="stylesheet" type="text/css" href="template/pc/css/base.css?1528179668" media="all">


    <link rel="stylesheet" href="x10c/assets/vendors/iconfonts/mdi/css/materialdesignicons.css">
    <link rel="stylesheet" href="x10c/assets/css/demo_1/style.css">
    <link rel="stylesheet" href="x10c/assets/css/shared/style.css">
    <script type="text/javascript" src="js/jquery.js?1528179672"></script>
    <script type="text/javascript" src="js/jquery.selectboxes.js?1528179672"></script>
    <script type="text/javascript" src="js/jquery.lightbox.js?1528179672"></script>

    <script src="x10c/assets/vendors/js/core.js"></script>
    <title>アフィリエイトシステム</title>
    <script type="text/javascript">
    $(function() {
        $('a[@rel*=lightbox]').lightBox();
    });
    </script>
    <style>
    .cp_tooltip {
        position: relative;
        display: inline-block;
        cursor: pointer;
        background: linear-gradient(transparent 60%, #c1e4e9 60%);
    }

    .cp_tooltip .cp_tooltiptext {
        position: absolute;
        z-index: 1;
        top: -5px;
        left: 105%;
        visibility: hidden;
        /*width: auto;*/
        white-space: nowrap;
        padding: 0.3em 0.5em;
        transition: opacity 1s;
        text-align: center;
        opacity: 0;
        color: #ffffff;
        border-radius: 3px;
        background-color: #16160e;
    }

    cp_tooltip .cp_tooltiptext::after {
        position: absolute;
        top: 40%;
        right: 100%;
        margin-left: -5px;
        content: ' ';
        border: 5px solid transparent;
        border-right-color: #16160e;
    }

    .cp_tooltip:hover .cp_tooltiptext {
        visibility: visible;
        opacity: 1;
    }
    </style>
</head>

<body>
    <div id="container">
        <div id="contents">

            <div id="header">

                <!--
                <div id="home"><a href="index.php"><span>HOME</span></a></div>

                <div id="header_in">
                    <ul>
                        <li>+&nbsp;<a href="index.php">HOME</a></li>
                        <li>+&nbsp;<a href="login.php?logout=true">ログアウト</a></li>
                    </ul>
                </div>
    -->
            </div>


            <div id="side_bar">
                <!--
                <div class="side_menu">
                    <ul>
                        <li class="title2">広告の掲載(拡張)</li>
                        <li><a href="x10c_adwares_edit.php">新しい広告を登録</a></li>
                        <li><a href="x10c_offerad_search.php">過去に登録した広告</a></li>

                        <li class="title1">広告の掲載</li>
                        <li><a href="regist.php?type=adwares">新しい広告を登録</a></li>
                        <li><a href="search.php?type=adwares&amp;run=true">過去に登録した広告</a></li>

                        <li class="title2">クローズド広告</li>
                        <li><a href="regist.php?type=secretAdwares">新しい広告を登録</a></li>
                        <li><a href="search.php?type=secretAdwares&amp;run=true">過去に登録した広告</a></li>

                        <li class="title2">累計</li>
                        <li><a href="search.php?type=access&amp;run=true">広告へのアクセス履歴</a></li>
                        <li><a href="search.php?type=pay&amp;run=true">獲得報酬の発生履歴</a></li>
                        <li><a href="search.php?type=click_pay&amp;run=true">クリック報酬の発生履歴</a></li>
                        <li><a href="search.php?type=continue_pay&amp;run=true">継続報酬の発生履歴</a></li>
                        <li class="title3">ユーザー情報</li>
                        <li><a href="edit.php?type=cUser&amp;id=C0000001">ユーザー情報の編集</a></li>
                        <li><a href="other.php?key=pay_report">成果レポート出力</a></li>
                    </ul>
                </div>
    -->


                <div class="page-body">
                    <div class="sidebar">
                        <ul class="navigation-menu">
                            <li>
                                <a href="index.php" class="menu">
                                    <span class="link-title">ホーム</span>
                                    <i class="mdi mdi-home link-icon"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" data-toggle="collapse" aria-expanded="false" class="menu">
                                    <span class="link-title">広告の掲載</span>
                                    <i class="mdi mdi-content-copy link-icon"></i>
                                </a>
                                <ul class=" navigation-submenu" id="pages">
                                    <li><a href="x10c_adwares_edit.php" class="menu">新しい広告を登録</a></li>
                                    <li><a href="x10c_offerad_search.php?ofr=1&approvable=1" class="menu">承認申請のある広告</a></li>
                                    <li><a href="x10c_offerad_search.php?pst=1&approvable=1" class="menu">投稿申請のある広告</a></li>
                                    <li><a href="x10c_offerad_search.php?adstts=0" class="menu">進行中の広告</a></li>
                                    <li><a href="x10c_offerad_search.php?adstts=1" class="menu">終了した広告</a></li>
                                    <li><a href="x10c_post_check.php" class="menu">投稿を確定する</a></li>
                                    <li><a href="x10c_post_uncheck.php" class="menu">投稿の確定を取消</a></li>
                                    <!--<li><a href="x10c_offerad_search.php" class="menu">過去に登録した広告</a></li>-->
                                </ul>
                            </li>
                            <li>
                                <a href="#" data-toggle="collapse" aria-expanded="false" class="menu">
                                    <span class="link-title">累計</span>
                                    <i class="mdi mdi-file-document link-icon"></i>
                                </a>
                                <ul class=" navigation-submenu" id="pages3">
                                    <li><a href="search.php?type=access&run=true" class="menu">広告へのアクセス履歴</a></li>
                                    <li><a href="search.php?type=pay&run=true" class="menu">目標報酬の発生履歴</a></li>
                                    <li><a href="search.php?type=click_pay&run=true" class="menu">クリック報酬の発生履歴</a></li>
                                </ul>
                            </li>
                        <li>
                            <a href="#" data-toggle="collapse" aria-expanded="false" class="menu">
                                <span class="link-title">レポート</span>
                                <i class="mdi mdi-package-down link-icon"></i>
                            </a>
                            <ul class=" navigation-submenu" id="pages">
                                <li><a href="x10c_report_c.php" class="menu">広告主成果一覧</a></li>
                            </ul>
                        </li>
                            <li>
                                <a href="#" data-toggle="collapse" aria-expanded="false" class="menu">
                                    <span class="link-title">ユーザー情報</span>
                                    <i class="mdi mdi-account-circle link-icon"></i>
                                </a>
                                <ul class=" navigation-submenu" id="pages4">
                                    <li><a href="edit.php?type=cUser&id=<?php echo $LOGIN_ID; ?>"
                                            class="menu">ユーザー情報の編集</a></li>
                                    <!--
                                    <li><a href="other.php?key=pay_report" class="menu">成果レポート出力</a></li>-->
                                </ul>
                            </li>
                            <li>
                                <a href="login.php?logout=true" class="menu">
                                    <span class="link-title">ログオフ</span>
                                    <i class="mdi mdi-logout link-icon"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>




            </div>
            <!--side_bar_END-->