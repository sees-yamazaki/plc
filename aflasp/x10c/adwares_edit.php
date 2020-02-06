<?php
session_start();

require('db/x10.php');
require('db/adwares.php');
require('../custom/conf.php');


$LOGIN_ID = $_SESSION[ $SESSION_NAME ];
$LOGIN_TYPE = $_SESSION[ $SESSION_TYPE ];

$id = empty($_GET['id']) ? $_POST['id'] : $_GET['id'];
$mode = empty($_GET['mode']) ? $_POST['mode'] : $_GET['mode'];



$adware = new cls_adwares();
//$adware->shadow_id = $_POST['shadow_id'];
$adware->delete_key = 0;
//$adware->id = $_POST['id'];
$adware->cuser = $LOGIN_ID;
$adware->comment = $_POST['comment'];
$adware->ad_text = $_POST['ad_text'];
$adware->category = $_POST['category'];
$adware->banner_m = '';
$adware->banner_m2 = '';
$adware->banner_m3 = '';
$adware->url = $_POST['url'];
$adware->url_m = '';
$adware->url_over = $_POST['url_over'];
$adware->url_users = $_POST['url_users'];
$adware->name = $_POST['name'];
$adware->money = $_POST['money'];
$adware->ad_type = $_POST['ad_type'];
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
$adware->continue_auto = 0;
$adware->check_type = $_POST['check_type'];
$adware->open = $_POST['open'];
//$adware->regist = $_POST['regist'];
$adware->adware_type = $_POST['adware_type'];
$adware->approvable = $_POST['approvable'];

if (isset($_POST['doCheck'])) {

    //画像処理
    //フォルダの確認
    $imgDir = '../file/image/'.date('Ym');
    if (!file_exists($imgDir)) {
        mkdir($imgDir, 0777);
    }

    $upFileNm = basename($_FILES ['banner'] ['name']);
    if ($_POST['banner_DELETE']=="1") {
        unlink($_POST['banner_filetmp']);
    } elseif (!empty($upFileNm)) {
        //アップロードファイルのフルパス
        $filepath = pathinfo($_FILES ['banner'] ['name']);
        //拡張子の確認
        if (!(strtolower($filepath['extension']) == 'png' || strtolower($filepath['extension']) == 'bmp' || strtolower($filepath['extension']) == 'jpg')) {
            $tmpMgs .= '<br>・アップロード画像が正しくありません。<br>png/bmp/jpgの拡張子のファイルをアップロードしてください。';
        }

        if (empty($tmpMgs)) {
            //TMPファイルの名称決定
            $tmpFileNm = md5($LOGIN_ID.$_POST['st'].'banner').".".$filepath['extension'];
            $adware->banner = 'file/image/'.date('Ym')."/".$tmpFileNm;
            move_uploaded_file($_FILES ['banner'] ['tmp_name'], $imgDir."/".$tmpFileNm);
        } else {
            $errorMessage .= '<br>アップロードされたファイル：'.$upFileNm.$tmpMgs."<br>";
        }
    } elseif (isset($_POST['banner_filetmp'])) {
        $adware->banner = substr($_POST['banner_filetmp'], 3);
    }

    $upFileNm = basename($_FILES ['banner2'] ['name']);
    if ($_POST['banner2_DELETE']=="1") {
        unlink($_POST['banner2_filetmp']);
    } elseif (!empty($upFileNm)) {
        //アップロードファイルのフルパス
        $filepath = pathinfo($_FILES ['banner2'] ['name']);
        //拡張子の確認
        if (!(strtolower($filepath['extension']) == 'png' || strtolower($filepath['extension']) == 'bmp' || strtolower($filepath['extension']) == 'jpg')) {
            $tmpMgs .= '<br>・アップロード画像が正しくありません。<br>png/bmp/jpgの拡張子のファイルをアップロードしてください。';
        }

        if (empty($tmpMgs)) {
            //TMPファイルの名称決定
            $tmpFileNm = md5($LOGIN_ID.$_POST['st'].'banner2').".".$filepath['extension'];
            $adware->banner2 = 'file/image/'.date('Ym')."/".$tmpFileNm;
            move_uploaded_file($_FILES ['banner2'] ['tmp_name'], $imgDir."/".$tmpFileNm);
        } else {
            $errorMessage .= '<br>アップロードされたファイル：'.$upFileNm.$tmpMgs."<br>";
        }
    } elseif (isset($_POST['banner2_filetmp'])) {
        $adware->banner2 = substr($_POST['banner2_filetmp'], 3);
    }

    $upFileNm = basename($_FILES ['banner3'] ['name']);
    if ($_POST['banner3_DELETE']=="1") {
        unlink($_POST['banner3_filetmp']);
    } elseif (!empty($upFileNm)) {
        //アップロードファイルのフルパス
        $filepath = pathinfo($_FILES ['banner3'] ['name']);
        //拡張子の確認
        if (!(strtolower($filepath['extension']) == 'png' || strtolower($filepath['extension']) == 'bmp' || strtolower($filepath['extension']) == 'jpg')) {
            $tmpMgs .= '<br>・アップロード画像が正しくありません。<br>png/bmp/jpgの拡張子のファイルをアップロードしてください。';
        }

        if (empty($tmpMgs)) {
            //TMPファイルの名称決定
            $tmpFileNm = md5($LOGIN_ID.$_POST['st'].'banner3').".".$filepath['extension'];
            $adware->banner3 = 'file/image/'.date('Ym')."/".$tmpFileNm;
            move_uploaded_file($_FILES ['banner3'] ['tmp_name'], $imgDir."/".$tmpFileNm);
        } else {
            $errorMessage .= '<br>アップロードされたファイル：'.$upFileNm.$tmpMgs."<br>";
        }
    } elseif (isset($_POST['banner3_filetmp'])) {
        $adware->banner3 = substr($_POST['banner3_filetmp'], 3);
    }

    if (empty($errorMessage)) {
        header('Location: adwares_edite.php', true, 307);
    } else {
        //
    }
}elseif(isset($_POST['back'])){
    $adware->banner = $_POST['banner'];
    $adware->banner2 = $_POST['banner2'];
    $adware->banner3 = $_POST['banner3'];
}






$catHtml="";
$categories = getCategories();
foreach ($categories as $cat) {
    $wk = in_array($cat->id, (array)$category) ? " checked" : "";
    $catHtml .= '<option value="'.$cat->id.'" '.$wk.'>'.$cat->name."</option>";
}

$st = isset($_POST['st']) ? $_POST['st'] : strtotime("NOW");


if($LOGIN_TYPE=='admin'){
    include 'header_admin.php'; 
}else{
    include 'header_cuser.php'; 
}

$url_users_0 = " checked";
$url_users_1 = "";
if ($adware->url_users=="1") {
    $url_users_0 = "";
    $url_users_1 = " checked";
}

$limit_type_0 = " selected";
$limit_type_1 = "";
if ($adware->limit_type=="1") {
    $limit_type_0 = "";
    $limit_type_1 = " selected";
}

$span_type_s = ($adware->span_type=='s') ? " selected" : "";
$span_type_m = ($adware->span_type=='m') ?  "selected" : "";
$span_type_h = ($adware->span_type=='h') ? " selected" : "";
$span_type_d = ($adware->span_type=='d') ? " selected" : "";


$use_cookie_interval_0 = " checked";
$use_cookie_interval_1 = "";
if ($adware->use_cookie_interval=="1") {
    $use_cookie_interval_0 = "";
    $use_cookie_interval_1 = " checked";
}

$pay_span_type_s = ($adware->pay_span_type=='s') ? " selected" : "";
$pay_span_type_m = ($adware->pay_span_type=='m') ? " selected" : "";
$pay_span_type_h = ($adware->pay_span_type=='h') ? " selected" : "";
$pay_span_type_d = ($adware->pay_span_type=='d') ? " selected" : "";

$click_auto_0 = "";
$click_auto_1 = " checked";
if ($adware->click_auto=="0") {
    $click_auto_0 = " checked";
    $click_auto_1 = "";
}

$auto_0 = "";
$auto_1 = " checked";
if ($adware->auto=="0") {
    $auto_0 = " checked";
    $auto_1 = "";
}

$open_0 = "";
$open_1 = " checked";
if ($adware->open=="0") {
    $open_0 = " checked";
    $open_1 = "";
}

$check_type_ip = " checked";
if (!empty($adware->check_type)) {
    $check_type_ip =  ($adware->check_type=='ip') ? " checked" : "";
    $check_type_aid =  ($adware->check_type=='aid') ? " checked" : "";
    $check_type_cookie =  ($adware->check_type=='cookie') ? " checked" : "";
}


$adware_type_0 = " checked";
$adware_type_1 = "";
if ($adware->adware_type=="1") {
    $adware_type_0 = "";
    $adware_type_1 = " checked";
}

$approvable_0 = " checked";
$approvable_1 = "";
if ($adware->approvable=="1") {
    $approvable_0 = "";
    $approvable_1 = " checked";
}

$cls_money = "";
$cls_click_money = " class='inactive' readonly";
if ($adware->adware_type=="1") {
    $cls_money = " class='inactive' readonly";
    $cls_click_money = "";
}

?>
<script type="text/javascript">
function typeChange() {
    radio = document.getElementsByName('adware_type')
    if (radio[0].checked) {
        document.getElementById('money').readOnly = false;
        document.getElementById('money').style.backgroundColor = "white";
        document.getElementById('click_money').readOnly = true;
        document.getElementById('click_money').style.backgroundColor = "#9fa0a0";
    } else if (radio[1].checked) {
        document.getElementById('money').readOnly = true;
        document.getElementById('money').style.backgroundColor = "#9fa0a0";
        document.getElementById('click_money').readOnly = false;
        document.getElementById('click_money').style.backgroundColor = "white";
    }
}

window.onload = entryChange1;
</script>
<style>
    .inactive {
        background-color: #9fa0a0;
    }
</style>

<div id="inc_side_body">

    <div class="topics">HOME &gt; 広告の編集 &gt; <span>入力フォーム</span> &gt; 入力内容の確認 &gt; 登録完了</div>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="search_list">
            <dl>
                <dt>※印が付いている項目は必須です。</dt>
                <dd>
                    <table class="search_list_table" summary="詳細テーブル">
                        <tbody>
                            <tr>
                                <th>広告タイプ<span>※</span></th>
                                <td>
                                    <label><input type="radio" name="adware_type" onclick="typeChange();" value="0"
                                            <?php echo $adware_type_0; ?>>目標達成タイプ</label>
                                    <label><input type="radio" name="adware_type" onclick="typeChange();" value="1"
                                            <?php echo $adware_type_1; ?>>クリック報酬タイプ</label>
                                </td>
                            </tr>
                            <tr>
                                <th>承認タイプ<span>※</span></th>
                                <td>
                                    <label><input type="radio" name="approvable" value="0"
                                            <?php echo $approvable_0; ?>>オープン</label>
                                    <label><input type="radio" name="approvable" value="1"
                                            <?php echo $approvable_1; ?>>承認</label>
                                </td>
                            </tr>
                            <tr>
                                <th>成果表示名<span>※</span></th>
                                <td><input type="text" name="name" value="<?php echo $adware->name; ?>" size="50"
                                        maxlength="128" required>
                                </td>
                            </tr>
                            <tr>
                                <th>カテゴリーの選択<span>※</span></th>
                                <td>
                                    <select name="category" required>
                                        <?php echo $catHtml; ?>
                                    </select><br>
                                    ※ご希望のカテゴリーがない場合は管理者に連絡してください。
                                </td>
                            </tr>
                            <tr>
                                <th>広告説明文<span>※</span></th>
                                <td><textarea name="comment" cols="" rows="" class="textarea"
                                        required><?php echo $adware->comment; ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <th>テキスト広告文<span>※</span></th>
                                <td><input type="text" name="ad_text" value="<?php echo $adware->ad_text; ?>" size="50"
                                        maxlength="128" required>
                                </td>
                            </tr>
                            <tr>
                                <th>ジャンプ先URL(PC用)<span>※</span></th>
                                <td>
                                    <input type="text" name="url" value="<?php echo $adware->url; ?>" size="50"
                                        maxlength="256" required>

                                    <label><input type="radio" name="url_users" value="0"
                                            <?php echo $url_users_0; ?>>固定</label>
                                    <label><input type="radio" name="url_users" value="1"
                                            <?php echo $url_users_1; ?>>アフィリエイターの自由入力</label>

                                </td>
                            </tr>

                            <tr id="box_money">
                                <th>獲得単価<span>※</span></th>
                                <td><input type="text" name="money" id="money" value="<?php echo $adware->money; ?>" size="15"
                                        maxlength="10" <?php echo $cls_money; ?> required>
                                        円</td>
                            </tr>
                            <tr id="box_click_money">
                                <th>クリック単価<span>※</span></th>
                                <td><input type="text" name="click_money" id="click_money" value="<?php echo $adware->click_money; ?>"
                                        size="15" maxlength="10" <?php echo $cls_click_money; ?> required>
                                    円</td>
                            </tr>
                            <!--
                            <tr>
                                <th>継続課金</th>
                                <td><input type="text" name="continue_money" value="" size="15" maxlength="10">
                                    <select name="continue_type">
                                        <option value="yen" selected="selected">円</option>
                                        <option value="per">％</option>
                                    </select>
                                </td>
                            </tr>
                            -->
                            <tr>
                                <th>予算上限<span>※</span></th>
                                <td><input type="text" name="limits" value="<?php echo $adware->limits; ?>" size="15"
                                        maxlength="10">
                                    <select name="limit_type">
                                        <option value="0" <?php echo $limit_type_0; ?>>予算上限なし</option>
                                        <option value="1" <?php echo $limit_type_1; ?>>円</option>
                                    </select>

                                    <div class="in_clip">
                                        予算オーバー時のジャンプ先URL　<input type="text" name="url_over"
                                            value="<?php echo $adware->url_over; ?>" size="50" maxlength="256">

                                        <span class="info">予算オーバー時には上記で設定したURLに遷移します。</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>クリック間隔<span>※</span></th>
                                <td>
                                    不正防止の為、最後のクリックから <input type="text" name="span" value="<?php echo $adware->span; ?>"
                                        size="15" maxlength="10" required>
                                    <select name="span_type">
                                        <option value="s" <?php echo $span_type_s; ?>>秒</option>
                                        <option value="m" <?php echo $span_type_m; ?>>分</option>
                                        <option value="h" <?php echo $span_type_h; ?>>時</option>
                                        <option value="d" <?php echo $span_type_d; ?>>日</option>
                                    </select>
                                    間のクリックを無効にする。
                                    <div class="in_clip">
                                        同一ユーザーかどうかを　「　<label><input type="radio" name="use_cookie_interval" value="1"
                                                <?php echo $use_cookie_interval_1; ?>>COOKIEで判別</label>
                                        <label><input type="radio" name="use_cookie_interval" value="0"
                                                <?php echo $use_cookie_interval_0; ?>>IPで判別</label>
                                        　」する
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>報酬成果間隔<span>※</span></th>
                                <td>不正防止の為、最後の成果発生から <input type="text" name="pay_span"
                                        value="<?php echo $adware->pay_span; ?>" size="15" maxlength="10" required>
                                    <select name="pay_span_type">
                                        <option value="s" <?php echo $pay_span_type_s; ?>>秒</option>
                                        <option value="m" <?php echo $pay_span_type_m; ?>>分</option>
                                        <option value="h" <?php echo $pay_span_type_h; ?>>時</option>
                                        <option value="d" <?php echo $pay_span_type_d; ?>>日</option>
                                    </select>
                                    間の成果発生を無効にする。(同一IP)</td>
                            </tr>
                            <tr>
                                <th>クリック成果の認証<span>※</span></th>
                                <td><label><input type="radio" name="click_auto" value="1"
                                            <?php echo $click_auto_1; ?>>自動</label>
                                    <label><input type="radio" name="click_auto" value="0"
                                            <?php echo $click_auto_0; ?>>手動</label>
                                </td>
                            </tr>
                            <tr>
                                <th>アフィリエイト成果の認証<span>※</span></th>
                                <td><label><input type="radio" name="auto" value="1" <?php echo $auto_1; ?>>自動</label>
                                    <label><input type="radio" name="auto" value="0" <?php echo $auto_0; ?>>手動</label>
                                </td>
                            </tr>
                            <!--
                            <tr>
                                <th>継続成果の認証<span>※</span></th>
                                <td><label><input type="radio" name="continue_auto" value="1"
                                            checked="checked">自動</label>
                                    <label><input type="radio" name="continue_auto" value="0">手動</label>
                                </td>
                            </tr>
                            -->
                            <tr>
                                <th>広告バナー(PC用)</th>
                                <td>
                                    <?php if(empty($adware->banner)){ ?>
                                    <input name="banner" type="file">
                                    <input name="banner" type="hidden" value="">
                                    <?php }else{ ?>
                                    <a href="../<?php echo $adware->banner; ?>" target="_blank"><img
                                            src="../<?php echo $adware->banner; ?>" alt=""></a>
                                    <br><input name="banner" type="file">
                                    <input name="banner_filetmp" type="hidden"
                                        value="../<?php echo $adware->banner; ?>">
                                    <label><input type="checkbox" name="banner_DELETE" value="1">削除</label>
                                    <input name="banner" type="hidden" value="../<?php echo $adware->banner; ?>">
                                    <?php } ?>
                                    <br>
                                    <?php if(empty($adware->banner2)){ ?>
                                    <input name="banner2" type="file">
                                    <input name="banner2" type="hidden" value="">
                                    <?php }else{ ?>
                                    <a href="../<?php echo $adware->banner2; ?>" target="_blank"><img
                                            src="../<?php echo $adware->banner2; ?>" alt=""></a>
                                    <br><input name="banner2" type="file">
                                    <input name="banner2_filetmp" type="hidden"
                                        value="../<?php echo $adware->banner2; ?>">
                                    <label><input type="checkbox" name="banner2_DELETE" value="1">削除</label>
                                    <input name="banner2" type="hidden" value="../<?php echo $adware->banner2; ?>">
                                    <?php } ?>
                                    <br>
                                    <?php if(empty($adware->banner3)){ ?>
                                    <input name="banner3" type="file">
                                    <input name="banner3" type="hidden" value="">
                                    <?php }else{ ?>
                                    <a href="../<?php echo $adware->banner3; ?>" target="_blank"><img
                                            src="../<?php echo $adware->banner3; ?>" alt=""></a>
                                    <br><input name="banner3" type="file">
                                    <input name="banner3_filetmp" type="hidden"
                                        value="../<?php echo $adware->banner3; ?>">
                                    <label><input type="checkbox" name="banner3_DELETE" value="1">削除</label>
                                    <input name="banner3" type="hidden" value="../<?php echo $adware->banner3; ?>">
                                    <?php } ?>

                                </td>
                            </tr>

                            <tr>
                                <th>広告認証形式<span>※</span></th>
                                <td><label><input type="radio" name="check_type" value="ip"
                                            <?php echo $check_type_ip; ?>>IPアドレス</label>
                                    <label><input type="radio" name="check_type" value="aid"
                                            <?php echo $check_type_aid; ?>>Cookie(1st)</label>
                                    <label><input type="radio" name="check_type" value="cookie"
                                            <?php echo $check_type_cookie; ?>>Cookie(3rd)</label>

                                    <span class="info">広告経由情報の認証方法を選択して下さい。(PCのみ設定可能です)</span>
                                    <span class="info">※Apple ITPに対応したトラッキングを行うにはIPまたはCookie(1st)を使用してください。</span>
                                    <span class="info">※Cookie(1st)とそれ以外の認証形式はトラッキングコードの形式が異なりますのでご注意ください。</span>
                                </td>
                            </tr>
                            <tr>
                                <th>広告の公開/非公開<span>※</span></th>
                                <td><label><input type="radio" name="open" value="1" <?php echo $open_1; ?>>公開</label>
                                    <label><input type="radio" name="open" value="0" <?php echo $open_0; ?>>非公開</label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </dd>
            </dl>
        </div>

        <div class="input_box">
            <input type="submit" value="入力内容の確認" class="input_base">
            <input type="reset" value="リセット" class="input_base">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="mode" value="<?php echo $mode; ?>">
            <input type="hidden" name="st" value="<?php echo $st; ?>">
            <input type="hidden" name="MAX_FILE_SIZE" value="512000">
            <input type="hidden" name="doCheck" value="0">
        </div>
    </form>

</div>


<?php include 'footer.php'; ?>