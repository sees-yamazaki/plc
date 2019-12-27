<?php

// セッション開始
session_start();
require('session.php');

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

// ログイン状態チェック
if (getSsnIsLogin()==false) {
    header('Location: a_logoff.php');
    exit;
}

// エラーメッセージの初期化
$errorMessage = '';

    $mSeq = $_POST['mSeq'];
    if (!isset($mSeq)) {
        $mSeq = $_GET['mSeq'];
    }

    require './db/members.php';
    $member = new cls_members();
    $member = getMember($mSeq);

    require './db/views.php';
    $usepoints = getVUsepoints($mSeq);

    $html1 = "";
    $html2 = "";
    foreach ($usepoints as $usepoint) {
        if ($usepoint->up_status==99) {
            $html2 .= "<tr>";
            $html2 .= "<td>".$usepoint->createdt."</td>";
            $html2 .= "<td>".($usepoint->up_point * -1)."</td>";
            $html2 .= "</tr>";
        } else {
            $html1 .= "<tr>";
            $html1 .= "<td>".$usepoint->createdt."</td>";
            $html1 .= "<td>".$usepoint->p_title."</td>";
            $html1 .= "<td>".$usepoint->pz_title."</td>";
            $html1 .= "<td>".$usepoint->up_point."</td>";
            if ($usepoint->up_status==1) {
                $html1 .= "<td>当たり</td>";
            } else {
                $html1 .= "<td>外れ</td>";
            }
            $html1 .= "</tr>";
        }
    }

    require './db/serials.php';
    $scodes = getMySCodes($mSeq);
    $html3 = "";
    foreach ($scodes as $scode) {
        $html3 .= "<tr>";
        $html3 .= "<td>".$scode->entrydt."</td>";
        $html3 .= "<td>".substr($scode->sc_code, 0, 4)."-".substr($scode->sc_code, 4, 4)."-".substr($scode->sc_code, 8)."</td>";
        $html3 .= "<td>".$scode->sc_point."</td>";
        $html3 .= "</tr>";
    }






?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo getSsnMyname(); ?></title>
    <link rel="stylesheet" href="./assets/vendors/iconfonts/mdi/css/materialdesignicons.css">
    <link rel="stylesheet" href="./assets/css/shared/style.css">
    <link rel="stylesheet" href="./assets/css/demo_1/style.css">
    <link rel="shortcut icon" href="./assets/images/favicon.ico" />
    <link rel="stylesheet" href="./asset/css/main.css">
    <script src="./asset/js/main.js"></script>
    <script>
    function mmbrPoint(vlu) {
        document.frm.mSeq.value = vlu;
        document.frm.submit();
    }
    </script>
</head>

<body class="header-fixed">
    <form action='a_members_point.php' method='POST' name="frm">
        <input type='hidden' name='mSeq' value=''>
    </form>

    <?php include './a_menu.php'; ?>

    <div class="page-content-wrapper">
        <div class="page-content-wrapper-inner">
            <div class="content-viewport">


                <div class="col-lg-12">
                    <div class="grid">
                        <div class="grid-body">
                            <div class="item-wrapper">
                                <div class="row mb-3">
                                    <div class="col-md-8 mx-auto">
                                        <button type="button" class="btn btn-inverse-info"
                                            onclick="location.href='./a_members_list.php'">＜＜戻る</button>
                                        <button type="button" class="btn btn-inverse-dark"
                                            onclick='mmbrPoint(<?php echo $member->m_seq; ?>)'>ポイント付与する</button>
                                        <br><br>

                                        <p class="grid-header">会員情報</p>


                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">名前</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                <label for="inputType1"><?php echo $member->m_name; ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">メール</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                <label for="inputType1"><?php echo $member->m_mail; ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">郵便番号</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                <label for="inputType1"><?php echo $member->m_post; ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">住所１</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                <label for="inputType1"><?php echo $member->m_address1; ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">住所２</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                <label for="inputType1"><?php echo $member->m_address2; ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">電話番号</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                <label for="inputType1"><?php echo $member->m_tel; ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">登録日時</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                <label for="inputType1"><?php echo $member->createdt; ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">現在ポイント</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                <label for="inputType1"><?php echo $member->point; ?></label>
                                            </div>
                                        </div>

                                        <span class="clrRed"><?php echo $errorMessage; ?></span>
                                    </div>
                                </div>
                            </div>

                            <p class="grid-header">ポイント使用履歴</p>
                            <div class="table-responsive">
                                <table class="table info-table">
                                    <thead>
                                        <tr>
                                            <th>登録日</th>
                                            <th>キャンペーン名</th>
                                            <th>商品名</th>
                                            <th>使用ポイント</th>
                                            <th>結果</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo $html1; ?>
                                    </tbody>
                                </table>
                            </div>

                            <p class="grid-header">ポイント付与履歴</p>
                            <div class="table-responsive">
                                <table class="table info-table">
                                    <thead>
                                        <tr>
                                            <th>登録日</th>
                                            <th>付与ポイント</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo $html2; ?>
                                    </tbody>
                                </table>
                            </div>

                            <p class="grid-header">獲得ポイント履歴</p>
                            <div class="table-responsive">
                                <table class="table info-table">
                                    <thead>
                                        <tr>
                                            <th>獲得日</th>
                                            <th>シリアルコード</th>
                                            <th>獲得ポイント</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo $html3; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include './a_footer.php'; ?>

    </div>
    </div>
    <script src="./assets/vendors/js/core.js"></script>
    <script src="./assets/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="./assets/vendors/chartjs/Chart.min.js"></script>
    <script src="./assets/js/charts/chartjs.addon.js"></script>
    <script src="./assets/js/template.js"></script>
    <script src="./assets/js/dashboard.js"></script>
</body>

</html>