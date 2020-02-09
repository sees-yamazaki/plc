<html lang="ja">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
    <meta http-equiv="Content-Script-Type" content="text/javascript">
    <meta http-equiv="Content-Style-Type" content="text/css">
    <meta name="description" content="アフィリエイトシステム">
    <meta name="keywords" content="アフィリエイト">
    <link rel="stylesheet" type="text/css" href="template/pc/css/base.css?1528179668" media="all">
    <link rel="stylesheet" type="text/css" href="template/pc/css/jquery.lightbox.css?1528179668" media="all">
    <link rel="stylesheet" type="text/css" href="template/pc/css/base.css?1528179668" media="all">


    <script type="text/javascript" src="js/jquery.js?1528179672"></script>
    <script type="text/javascript" src="js/jquery.selectboxes.js?1528179672"></script>
    <script type="text/javascript" src="js/jquery.lightbox.js?1528179672"></script>
    <script type="text/javascript" src="js/pay.js?1545385488"></script>

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

                <div id="home"><a href="index.php"><span>HOME</span></a></div>

                <div id="header_in">
                    <ul>
                        <li>+&nbsp;<a href="login.php?logout=true">ログアウト</a></li>
                    </ul>
                </div>
            </div>

            <div id="side_bar">
                <div class="side_menu">
                    <ul>
                        <li class="title1">ユーザー管理</li>
                        <li><a href="search.php?type=nUser">ユーザー検索</a></li>
                        <li><a href="regist.php?type=multimail">一括メール送信</a></li>
                        <li><a href="regist.php?type=sales">ユーザーランク追加</a></li>
                        <li><a href="search.php?type=sales&amp;sort=rate&amp;sort_PAL[]=desc&amp;run=true">ユーザーランク管理</a>
                        </li>
                        <li class="title2">広告の掲載(拡張)</li>
                        <li><a href="x10c_adwares_edit.php">新しい広告を登録</a></li>
                        <li><a href="x10c_offerad_search.php">過去に登録した広告</a></li>
                        <li class="title2">掲載広告</li>
                        <li><a href="regist.php?type=adwares">広告の登録</a></li>
                        <li><a href="search.php?type=adwares&amp;run=true">登録されている広告</a></li>
                        <li><a href="regist.php?type=pay">成果の登録</a></li>
                        <li><a href="search.php?type=category&amp;run=true">広告カテゴリの管理</a></li>

                        <li><a href="search.php?type=cUser">広告主検索</a></li>


                        <li class="title2">クローズド広告</li>
                        <li><a href="regist.php?type=secretAdwares">広告の登録</a></li>
                        <li><a href="search.php?type=secretAdwares&amp;run=true">登録されている広告</a></li>

                        <li class="title2">拡張</li>
                        <li><a href="adwares_edit.php">NewPage</a></li>
                        <li><a href="offerad_search.php?mode=co">オファー広告への切り替え</a></li>
                        <li><a href="offerad_search.php?mode=op">付加情報編集</a></li>

                        <li class="title3">リスト</li>
                        <li><a href="search.php?type=access&amp;run=true">アクセスリスト</a></li>
                        <li><a href="search.php?type=pay&amp;run=true">会員登録・商品の購入履歴</a></li>
                        <li><a href="search.php?type=click_pay&amp;run=true">広告クリック履歴</a></li>
                        <li><a href="search.php?type=continue_pay&amp;run=true">継続課金履歴</a></li>
                        <li><a href="search.php?type=log_pay&amp;run=true">報酬の変動ログ</a></li>
                        <li class="title4">換金</li>
                        <li><a href="search.php?type=returnss&amp;run=true">換金申請履歴</a></li>
                        <li><a href="return.php">一括換金処理</a></li>
                        <li class="title5">レポート</li>
                        <li><a href="other.php?key=pay_report">成果レポート出力</a></li>
                        <li><a href="other.php?key=access4month">アクセス集計</a></li>
                        <li><a href="other.php?key=tier4month">ティア集計</a></li>
                        <li class="title6">サイト設定</li>
                        <li><a href="edit.php?type=system&amp;id=ADMIN">サイト設定の変更</a></li>
                        <li><a href="edit.php?type=admin&amp;id=ADMIN">ログイン情報の変更</a></li>
                        <li><a href="regist.php?type=page">ページの追加</a></li>
                        <li><a href="search.php?type=page&amp;run=true">ページの検索</a></li>

                        <li><a href="search.php?type=accountLockConfig&amp;run=true">アカウントロック設定</a></li>

                    </ul>
                </div>
            </div>
            <!--side_bar_END-->