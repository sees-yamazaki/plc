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
                    <a href="#pages2" data-toggle="collapse" aria-expanded="false" class="menu">
                        <span class="link-title">広告の掲載</span>
                        <i class="mdi mdi-account-multiple link-icon"></i>
                    </a>
                    <ul class="collapse navigation-submenu" id="pages2">
                        <li><a href="x10c_adwares_edit.php" class="menu">新しい広告を登録</a></li>
                        <li><a href="x10c_offerad_search.php" class="menu">過去に登録した広告</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#pages3" data-toggle="collapse" aria-expanded="false" class="menu">
                        <span class="link-title">累計</span>
                        <i class="mdi mdi-account-multiple link-icon"></i>
                    </a>
                    <ul class="collapse navigation-submenu" id="pages3">
                        <li><a href="search.php?type=access&run=true" class="menu">広告へのアクセス履歴</a></li>
                        <li><a href="search.php?type=pay&run=true" class="menu">獲得報酬の発生履歴</a></li>
                        <li><a href="search.php?type=click_pay&run=true" class="menu">クリック報酬の発生履歴</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#pages4" data-toggle="collapse" aria-expanded="false" class="menu">
                        <span class="link-title">ユーザー情報</span>
                        <i class="mdi mdi-account-multiple link-icon"></i>
                    </a>
                    <ul class="collapse navigation-submenu" id="pages4">
                        <li><a href="edit.php?type=cUser&id=(!--# val LOGIN_ID #--)" class="menu">ユーザー情報の編集</a></li>
                        <li><a href="other.php?key=pay_report" class="menu">成果レポート出力</a></li>
                    </ul>
                </li>
                <li>
                    <a href="login.php?logout=true" class="menu">
                        <span class="link-title">ログオフ</span>
                        <i class="mdi mdi-home link-icon"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>




            </div>
            <!--side_bar_END-->