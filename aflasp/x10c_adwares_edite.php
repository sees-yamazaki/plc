<?php
session_start();

require('custom/conf.php');
require('x10c/db/x10.php');
require('x10c_helper.php');
require('x10c_logging.php');
require('x10c_mail.php');
require('x10c/db/adwares.php');
require('x10c/db/system.php');


$LOGIN_ID = $_SESSION[ $SESSION_NAME ];
$LOGIN_TYPE = $_SESSION[ $SESSION_TYPE ];
if (empty($LOGIN_ID)) {
    header('Location: x10c_session_err.php');
}

$id = empty($_GET['id']) ? $_POST['id'] : $_GET['id'];
$mode = empty($_GET['mode']) ? $_POST['mode'] : $_GET['mode'];

$adware = new cls_adwares();
$adware->shadow_id = $_POST['shadow_id'];
$adware->delete_key = 0;
$adware->id = $id;
$adware->cuser = $LOGIN_ID;
$adware->comment = $_POST['comment'];
$adware->ad_text = $_POST['ad_text'];
$adware->category = $_POST['category'];
$adware->banner_m = '';
$adware->banner_m2 = '';
$adware->banner_m3 = '';
$adware->url = str_replace(' ', '', $_POST['url']);
$adware->url_m = '';
$adware->url_over = $_POST['url_over'];
$adware->url_users = $_POST['url_users'];
$adware->name = $_POST['name'];
$adware->money = $_POST['money'];
$adware->ad_type = 'yen';
$adware->click_money = $_POST['click_money'];
$adware->continue_money = 0;
$adware->continue_type = 'yen';
$adware->limits = $_POST['limits'];
$adware->limit_type = $_POST['limit_type'];
$adware->span = $_POST['span'];
$adware->span_type = $_POST['span_type'];
$adware->use_cookie_interval = $_POST['use_cookie_interval'];
$adware->pay_span = $_POST['pay_span'];
$adware->pay_span_type = $_POST['pay_span_type'];
$adware->auto = $_POST['auto'];
$adware->click_auto = $_POST['click_auto'];
$adware->continue_auto = 1;
$adware->check_type = $_POST['check_type'];
$adware->open = $_POST['open'];

$adware->adware_type = $_POST['adware_type'];
$adware->approvable = $_POST['approvable'];
if (is_array($_POST['keyword'])) {
    $adware->keyword = implode(' ', $_POST['keyword']);
} else {
    $adware->keyword = $_POST['keyword'];
}
$adware->results = $_POST['results'];
$adware->hashtag = $_POST['hashtag'];
$adware->denials = $_POST['denials'];
$adware->ngword = $_POST['ngword'];
$adware->note = $_POST['note'];
$adware->meyasu = $_POST['meyasu'];
$adware->startdt = $_POST['startdt'];
$adware->enddt = $_POST['enddt'];
$adware->results_00 = empty($_POST['results_00']) ? 0 : $_POST['results_00'];
$adware->results_10 = empty($_POST['results_10']) ? 0 : $_POST['results_10'];
$adware->results_20 = empty($_POST['results_20']) ? 0 : $_POST['results_20'];
$adware->results_21 = empty($_POST['results_21']) ? 0 : $_POST['results_21'];
$adware->results_22 = empty($_POST['results_22']) ? 0 : $_POST['results_22'];
$adware->results_30 = empty($_POST['results_30']) ? 0 : $_POST['results_30'];
$adware->results_31 = empty($_POST['results_31']) ? 0 : $_POST['results_31'];
// $adware->results_10 = 0;
// $adware->results_20 = 0;
// $adware->results_21 = 0;
// $adware->results_22 = 0;
// $adware->results_30 = 0;
// $adware->results_31 = 0;
// if ($adware->adware_type=="0") {
//     $adware->results_20 = isset($_POST['results_20']) ? 1 : 0;
//     $adware->results_21 = isset($_POST['results_21']) ? 1 : 0;
//     $adware->results_22 = isset($_POST['results_22']) ? 1 : 0;
// } elseif ($adware->adware_type=="1") {
//     $adware->results_10 = isset($_POST['results_10']) ? 1 : 0;
// } elseif ($adware->adware_type=="2") {
//     $adware->results_30 = isset($_POST['results_30']) ? 1 : 0;
//     $adware->results_31 = isset($_POST['results_31']) ? 1 : 0;
// }

if ($adware->adware_type=="0" || $adware->adware_type=="2") {
    $adware->click_money = 0;
} else {
    $adware->money = 0;
}

$st = $_POST['st'];
$deleteAd = $_POST['deleteAd'];


$adware->banner = $_POST['banner'];
$banner_DELETE = $_POST['banner_DELETE'];
$banner_filetmp = $_POST['banner_filetmp'];
$upFileNm = basename($_FILES ['banner'] ['name']);

if ($_POST['banner_DELETE']=="1") {
    //処理をさせない
} elseif (!empty($upFileNm)) {
    //アップロードファイルのフルパス
    $upFilepath = pathinfo($_FILES ['banner'] ['name']);
    //TMPファイルの名称決定
    $tmpFileNm = md5($LOGIN_ID.$st.'banner').".".$upFilepath['extension'];
    $adware->banner = 'file/image/'.date('Ym')."/".$tmpFileNm;
} elseif (empty($adware->banner) && !empty($_POST['banner_filetmp'])) {
    $adware->banner = substr($_POST['banner_filetmp'], 3);
}


$adware->banner2 = $_POST['banner2'];
$banner2_DELETE = $_POST['banner2_DELETE'];
$banner2_filetmp = $_POST['banner2_filetmp'];
$upFileNm2 = basename($_FILES ['banner2'] ['name']);

if ($_POST['banner2_DELETE']=="1") {
    //処理をさせない
} elseif (!empty($upFileNm2)) {
    //アップロードファイルのフルパス
    $upFilepath2 = pathinfo($_FILES ['banner2'] ['name']);
    //TMPファイルの名称決定
    $tmpFileNm = md5($LOGIN_ID.$st.'banner2').".".$upFilepath2['extension'];
    $adware->banner2 = 'file/image/'.date('Ym')."/".$tmpFileNm;
} elseif (empty($adware->banner2) && !empty($_POST['banner2_filetmp'])) {
    $adware->banner2 = substr($_POST['banner2_filetmp'], 3);
}


$adware->banner3 = $_POST['banner3'];
$banner3_DELETE = $_POST['banner3_DELETE'];
$banner3_filetmp = $_POST['banner3_filetmp'];
$upFileNm3 = basename($_FILES ['banner3'] ['name']);

if ($_POST['banner3_DELETE']=="1") {
    //処理をさせない
} elseif (!empty($upFileNm3)) {
    //アップロードファイルのフルパス
    $upFilepath3 = pathinfo($_FILES ['banner3'] ['name']);
    //TMPファイルの名称決定
    $tmpFileNm = md5($LOGIN_ID.$st.'banner3').".".$upFilepath3['extension'];
    $adware->banner3 = 'file/image/'.date('Ym')."/".$tmpFileNm;
} elseif (empty($adware->banner3) && !empty($_POST['banner3_filetmp'])) {
    $adware->banner3 = substr($_POST['banner3_filetmp'], 3);
}

$sys = getSystem();

$mailBody = "■広告概要━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
$mailBody .= "広告名：".$adware->name."\n";
if ($adware->adware_type=="0") {
    $mailBody .= "広告タイプ：成果報酬\n";
} elseif ($adware->adware_type=="1") {
    $mailBody .= "広告タイプ：クリック報酬\n";
} elseif ($adware->adware_type=="2") {
    $mailBody .= "広告タイプ：投稿報酬\n";
}
if ($adware->approvable=="0") {
    $mailBody .= "承認タイプ：オープン\n";
} elseif ($adware->approvable=="1") {
    $mailBody .= "承認タイプ：承認制\n";
}
$mailBody .= "報酬：".number_format($adware->money+$adware->click_money)."円\n";
$mailBody .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";


if (isset($_POST['back'])) {
    header('Location: x10c_adwares_edit.php', true, 307);
} elseif (isset($_POST['doEdit']) && !empty($deleteAd)) {
    if ($LOGIN_TYPE=='admin') {
        deleteAdwares($adware);
        sendMail4Admin("広告が削除されました", "広告が削除されました\n\n".$mailBody);
        header('Location: x10c_adwares_edited.php?deleteAd=1');
    } else {
        stopAdwares($adware);
        header('Location: x10c_adwares_edited.php?deleteAd=2');
    }
} elseif (isset($_POST['doEdit'])) {
    if (empty($id)) {
        insertAdwares($adware);
        sendMail4Admin("広告が登録されました", "新規の広告が登録されました\n\n".$mailBody);
    } else {
        $old_adware= getAdware($adware->id);
        updateAdwares($adware);

        $mailBody .= "■更新内容━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        $mailBody .= $old_adware->name <> $adware->name ? "広告名：".$adware->name."\n" : "";
        $mailBody .= $old_adware->category <> $adware->category ? "カテゴリー：".$adware->category."\n" : "";
        $mailBody .= $old_adware->comment <> $adware->comment ? "広告説明文：".$adware->comment."\n" : "";
        $mailBody .= $old_adware->ad_text <> $adware->ad_text ? "キャッチコピー：".$adware->ad_text."\n" : "";
        $mailBody .= $old_adware->url <> $adware->url ? "ジャンプ先URL：".$adware->url."\n" : "";
        $mailBody .= $old_adware->money <> $adware->money ? "報酬：".$adware->money."\n" : "";
        $mailBody .= $old_adware->click_money <> $adware->click_money ? "報酬：".$adware->click_money."\n" : "";
        $mailBody .= $old_adware->limits <> $adware->limits ? "予算上限：".$adware->limits."\n" : "";
        $mailBody .= $old_adware->url_over <> $adware->url_over ? "予算オーバー時のURL：".$adware->url_over."\n" : "";
        $mailBody .= $old_adware->auto <> $adware->auto ? "成果の認証：".$adware->auto."\n" : "";
        $mailBody .= $old_adware->open <> $adware->open ? "公開/非公開：".$adware->open."\n" : "";
        $mailBody .= $old_adware->keyword <> $adware->keyword ? "キーワード、タグ：".$adware->keyword."\n" : "";
        $mailBody .= $old_adware->meyasu <> $adware->meyasu ? "承認条件目安：".$adware->meyasu."\n" : "";
        $mailBody .= $old_adware->results_00 <> $adware->results_00 ? "承認条件目安：サンプル提供可能\n" : "";
        $mailBody .= $old_adware->results <> $adware->results ? "成果条件：".$adware->results."\n" : "";
        $mailBody .= $old_adware->results_10 <> $adware->results_10 ? "成果条件：URLのクリック\n" : "";
        $mailBody .= $old_adware->results_20 <> $adware->results_20 ? "成果条件：商品購入\n" : "";
        $mailBody .= $old_adware->results_21 <> $adware->results_21 ? "成果条件：資料請求\n" : "";
        $mailBody .= $old_adware->results_22 <> $adware->results_22 ? "成果条件：会員登録\n" : "";
        $mailBody .= $old_adware->results_30 <> $adware->results_30 ? "成果条件：URLの貼り付け\n" : "";
        $mailBody .= $old_adware->results_31 <> $adware->results_31 ? "成果条件：指定のハッシュタグ\n" : "";
        $mailBody .= $old_adware->denials <> $adware->denials ? "否認条件：".$adware->denials."\n" : "";
        $mailBody .= $old_adware->hashtag <> $adware->hashtag ? "指定ハッシュタグ：".$adware->hashtag."\n" : "";
        $mailBody .= $old_adware->ngword <> $adware->ngword ? "NGキーワード：".$adware->ngword."\n" : "";
        $mailBody .= $old_adware->note <> $adware->note ? "備考：".$adware->note."\n" : "";
        $mailBody .= $old_adware->startdt <> $adware->startdt ? "開始日：".$adware->startdt."\n" : "";
        $mailBody .= $old_adware->enddt <> $adware->enddt ? "終了日：".$adware->enddt."\n" : "";
        $mailBody .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
        sendMail4Admin("広告が更新されました", "広告が更新されました\n\n".$mailBody);
    }

    header('Location: x10c_adwares_edited.php');
}

$txt_url = $adware->url;
if ($adware->url_users=="1") {
    $txt_url = 'アフィリエイターの自由入力';
}

    $txt_limits = '予算上限なし';
if ($adware->limit_type==" 1") {
    $txt_limits = $adware->limits.'円<div class="in_clip">予算オーバー時のジャンプ先URL　'.$adware->url_over.'<span class="info">予算オーバー時には上記で設定したURLに遷移します。</span></div>';
}

$txt_click_auto = "手動認証";
if ($adware->click_auto=="1") {
    $txt_click_auto = '自動認証';
}

$txt_auto = "手動認証";
if ($adware->auto=="1") {
    $txt_auto = '自動認証';
}

$txt_use_cookie_interval = "同一IP";
if ($adware->use_cookie_interval=="1") {
    $txt_use_cookie_interval = 'COOKIE発行';
}

$unit = array('s'=>'秒','m'=>'分','h'=>'時','d'=>'日');
$ckType = array('ip'=>'IPアドレス','aid'=>'Cookie(1st)','cookie'=>'Cookie(3rd)');


$txt_open = "公開";
if ($adware->open=="0") {
    $txt_open = '非公開';
}

$txt_adware_type = "成果報酬タイプ";
if ($adware->adware_type=="1") {
    $txt_adware_type = 'クリック報酬タイプ';
} elseif ($adware->adware_type=="2") {
    $txt_adware_type = '投稿報酬タイプ';
}

$txt_approvable= "オープン";
if ($adware->approvable=="1") {
    $txt_approvable = '承認';
}


if ($LOGIN_TYPE=='admin') {
    include 'x10c_header_admin.php';
} else {
    include 'x10c_header_cuser.php';
}

$category = getCategory($adware->category);

if (empty($deleteAd)) {
    $pankuzu = 'HOME &gt; 広告の編集 &gt; <span>入力フォーム</span> &gt; 入力内容の確認 &gt; 登録完了';
    $comment = '入力内容を確認してください。';
    $btn = '登録を完了する';
} else {
    $pankuzu = 'HOME &gt; 広告情報削除 &gt; <span>削除内容の確認</span> &gt; 削除完了';
    $comment = '削除内容を確認してください。';
    $btn = '削除を完了する';
}

?>

<div id="inc_side_body">

    <div class="topics"><?php echo $pankuzu; ?></div>

    <form action="" method="POST">
        <div class="search_list">
            <dl>
                <dt><?php echo $comment; ?></dt>
                <dd>
                    <table class="search_list_table" summary="詳細テーブル">
                        <tbody>
                            <tr>
                                <th>広告タイプ</th>
                                <td><?php echo $txt_adware_type; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>承認タイプ</th>
                                <td><?php echo $txt_approvable; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>広告名</th>
                                <td><?php echo $adware->name; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>カテゴリー</th>
                                <td><?php echo $category->name; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>広告説明文</th>
                                <td style="max-width: 500px;word-break : break-all;"><?php echo nl2br($adware->comment); ?>
                                </td>
                            </tr>
                            <tr>
                                <th>テキスト広告文</th>
                                <td><?php echo $adware->ad_text; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>ジャンプ先URL</th>
                                <td><?php echo $txt_url; ?>
                                </td>
                            </tr>

                            <tr>
                                <th>獲得単価</th>
                                <td><?php echo $adware->money; ?>円
                                </td>
                            </tr>
                            <tr>
                                <th>クリック単価</th>
                                <td><?php echo $adware->click_money; ?>円
                                </td>
                            </tr>
                            <tr>
                                <th>予算上限</th>
                                <td><?php echo $txt_limits; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>クリック成果の認証<span>※</span></th>
                                <td><?php echo $txt_click_auto; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>アフィリエイト成果の認証</th>
                                <td><?php echo $txt_auto; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>クリック間隔</th>
                                <td>不正防止の為、最後のクリックから [<?php echo $adware->span; ?><?php echo $unit[$adware->span_type]; ?>]
                                    間のクリックを無効にする。(<?php echo $txt_use_cookie_interval; ?>)
                                </td>
                            </tr>
                            <tr>
                                <th>報酬成果間隔<span>※</span></th>
                                <td>不正防止の為、最後の成果発生から <?php echo $adware->pay_span; ?><?php echo $unit[$adware->pay_span_type]; ?>
                                    間の成果発生を無効にする。(同一IP)</td>
                            </tr>
                            <tr>
                                <th>広告バナー</th>
                                <td>
                                    <?php if (empty($adware->banner)) { ?>
                                    <span>No Image</span><br>
                                    <?php } else { ?>
                                    <img src="<?php echo $adware->banner; ?>"
                                        alt="" style="max-width: 80%;"><br>
                                    <?php } ?>
                                    <?php if (empty($adware->banner2)) { ?>
                                    <span>No Image</span><br>
                                    <?php } else { ?>
                                    <img src="<?php echo $adware->banner2; ?>"
                                        alt=""><br>
                                    <?php } ?>
                                    <?php if (empty($adware->banner3)) { ?>
                                    <span>No Image</span>
                                    <?php } else { ?>
                                    <img src="<?php echo $adware->banner3; ?>"
                                        alt=""><br>
                                    <?php } ?>
                                </td>
                            </tr>

                            <tr>
                                <th>広告認証形式<span>※</span></th>
                                <td><?php echo $ckType[$adware->check_type]; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>広告の公開/非公開</th>
                                <td><?php echo $txt_open; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>キーワード、タグ</th>
                                <td><?php echo nl2br($adware->keyword); ?>
                                </td>
                            </tr>
                            <tr>
                                <th>承認条件目安</th>
                                <td style="max-width: 500px;">
                                <?php
                                    if ($adware->results_00=="1") {
                                        echo "サンプル提供可能<br>";
                                    }
                                ?>
                                <?php echo nl2br($adware->meyasu); ?>
                                </td>
                            </tr>
                            <tr>
                                <th>成果条件</th>
                                <td style="max-width: 500px;">
                                <?php
                                    if ($adware->results_10=="1") {
                                        echo "URLのクリック<br>";
                                    }
                                    if ($adware->results_20=="1") {
                                        echo "商品購入<br>";
                                    }
                                    if ($adware->results_21=="1") {
                                        echo "資料請求<br>";
                                    }
                                    if ($adware->results_22=="1") {
                                        echo "会員登録<br>";
                                    }
                                    if ($adware->results_30=="1") {
                                        echo "URLの貼り付け<br>";
                                    }
                                    if ($adware->results_31=="1") {
                                        echo "指定のハッシュタグ<br>";
                                    }
                                ?>
                                <?php echo nl2br($adware->results); ?>
                                </td>
                            </tr>
                            <tr>
                                <th>指定ハッシュタグ</th>
                                <td style="max-width: 500px;"><?php echo nl2br($adware->hashtag); ?>
                                </td>
                            </tr>
                            <tr>
                                <th>否認条件</th>
                                <td style="max-width: 500px;"><?php echo nl2br($adware->denials); ?>
                                </td>
                            </tr>
                            <tr>
                                <th>NGキーワード</th>
                                <td style="max-width: 500px;"><?php echo nl2br($adware->ngword); ?>
                                </td>
                            </tr>
                            <tr>
                                <th>備考</th>
                                <td style="max-width: 500px;"><?php echo nl2br($adware->note); ?>
                                </td>
                            </tr>
                            <tr>
                                <th>開始日</th>
                                <td><?php echo $adware->startdt; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>終了日</th>
                                <td><?php echo $adware->enddt; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </dd>
            </dl>
        </div>

        <div class="input_box">
            <input type="submit" value="<?php echo $btn; ?>" class="input_base" name="doEdit">
            <input type="submit" value="入力画面に戻る" class="input_base" name="back">
            <input type="hidden" name="shadow_id"
                value="<?php echo $adware->shadow_id; ?>">
            <input type="hidden" name="comment"
                value="<?php echo $adware->comment; ?>">
            <input type="hidden" name="id"
                value="<?php echo $adware->id; ?>">
            <input type="hidden" name="ad_text"
                value="<?php echo $adware->ad_text; ?>">
            <input type="hidden" name="category"
                value="<?php echo $adware->category; ?>">
            <input type="hidden" name="url"
                value="<?php echo $adware->url; ?>">
            <input type="hidden" name="url_over"
                value="<?php echo $adware->url_over; ?>">
            <input type="hidden" name="url_users"
                value="<?php echo $adware->url_users; ?>">
            <input type="hidden" name="name"
                value="<?php echo $adware->name; ?>">
            <input type="hidden" name="money"
                value="<?php echo $adware->money; ?>">
            <input type="hidden" name="ad_type"
                value="<?php echo $adware->ad_type; ?>">
            <input type="hidden" name="click_money"
                value="<?php echo $adware->click_money; ?>">
            <input type="hidden" name="limits"
                value="<?php echo $adware->limits; ?>">
            <input type="hidden" name="limit_type"
                value="<?php echo $adware->limit_type; ?>">
            <input type="hidden" name="span"
                value="<?php echo $adware->span; ?>">
            <input type="hidden" name="span_type"
                value="<?php echo $adware->span_type; ?>">
            <input type="hidden" name="use_cookie_interval"
                value="<?php echo $adware->use_cookie_interval; ?>">
            <input type="hidden" name="pay_span"
                value="<?php echo $adware->pay_span; ?>">
            <input type="hidden" name="pay_span_type"
                value="<?php echo $adware->pay_span_type; ?>">
            <input type="hidden" name="auto"
                value="<?php echo $adware->auto; ?>">
            <input type="hidden" name="click_auto"
                value="<?php echo $adware->click_auto; ?>">
            <input type="hidden" name="check_type"
                value="<?php echo $adware->check_type; ?>">
            <input type="hidden" name="open"
                value="<?php echo $adware->open; ?>">
            <input type="hidden" name="st"
                value="<?php echo $st; ?>">
            <input type="hidden" name="banner"
                value="<?php echo $adware->banner; ?>">
            <input type="hidden" name="banner_DELETE"
                value="<?php echo $banner_DELETE; ?>">
            <input type="hidden" name="banner_filetmp"
                value="<?php echo $banner_filetmp; ?>">
            <input type="hidden" name="upFileNm"
                value="<?php echo $upFileNm; ?>">
            <input type="hidden" name="upFilepath"
                value="<?php echo $upFilepath; ?>">
            <input type="hidden" name="banner2"
                value="<?php echo $adware->banner2; ?>">
            <input type="hidden" name="banner2_DELETE"
                value="<?php echo $banner2_DELETE; ?>">
            <input type="hidden" name="banner2_filetmp"
                value="<?php echo $banner2_filetmp; ?>">
            <input type="hidden" name="upFileNm2"
                value="<?php echo $upFileNm2; ?>">
            <input type="hidden" name="upFilepath2"
                value="<?php echo $upFilepath2; ?>">
            <input type="hidden" name="banner3"
                value="<?php echo $adware->banner3; ?>">
            <input type="hidden" name="banner3_DELETE"
                value="<?php echo $banner3_DELETE; ?>">
            <input type="hidden" name="banner3_filetmp"
                value="<?php echo $banner3_filetmp; ?>">
            <input type="hidden" name="upFileNm3"
                value="<?php echo $upFileNm3; ?>">
            <input type="hidden" name="upFilepath3"
                value="<?php echo $upFilepath3; ?>">
            <input type="hidden" name="adware_type"
                value="<?php echo $adware->adware_type; ?>">
            <input type="hidden" name="approvable"
                value="<?php echo $adware->approvable; ?>">
            <input type="hidden" name="keyword"
                value="<?php echo $adware->keyword; ?>">
            <input type="hidden" name="results"
                value="<?php echo $adware->results; ?>">
            <input type="hidden" name="hashtag"
                value="<?php echo $adware->hashtag; ?>">
            <input type="hidden" name="denials"
                value="<?php echo $adware->denials; ?>">
            <input type="hidden" name="ngword"
                value="<?php echo $adware->ngword; ?>">
            <input type="hidden" name="note"
                value="<?php echo $adware->note; ?>">
            <input type="hidden" name="meyasu"
                value="<?php echo $adware->meyasu; ?>">
            <input type="hidden" name="startdt"
                value="<?php echo $adware->startdt; ?>">
            <input type="hidden" name="enddt"
                value="<?php echo $adware->enddt; ?>">
            <input type="hidden" name="deleteAd"
                value="<?php echo $deleteAd; ?>">
            <input type="hidden" name="results_00"
                value="<?php echo $adware->results_00; ?>">
            <input type="hidden" name="results_10"
                value="<?php echo $adware->results_10; ?>">
            <input type="hidden" name="results_20"
                value="<?php echo $adware->results_20; ?>">
            <input type="hidden" name="results_21"
                value="<?php echo $adware->results_21; ?>">
            <input type="hidden" name="results_22"
                value="<?php echo $adware->results_22; ?>">
            <input type="hidden" name="results_30"
                value="<?php echo $adware->results_30; ?>">
            <input type="hidden" name="results_31"
                value="<?php echo $adware->results_31; ?>">
        </div>
    </form>

</div>


<?php include 'x10c_footer.php';
