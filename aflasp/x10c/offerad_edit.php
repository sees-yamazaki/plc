<?php
require('db/x10.php');

// セッション開始
session_start();

$LOGIN_ID = $_SESSION[ $SESSION_NAME ];
$LOGIN_TYPE = $_SESSION[ $SESSION_TYPE ];

$id = empty($_GET['id']) ? $_POST['id'] : $_GET['id'];
$mode = empty($_GET['mode']) ? $_POST['mode'] : $_GET['mode'];

$adType;
if ($mode=="op") {
    $adType=0;
}else{
    if (empty($ad->offer_flg) || $ad->offer_flg==0) {
        $adType=1;
    }else{
        $adType=2;
    }
}
$ad_name = array('オープン広告','クローズド広告','オファー広告');

$ad = new cls_secretadwares();
$ad = getAdware($id);

$html="";
if (isset($_POST['back'])) {
    $ad->offer_flg = $_POST['offer_flg'];
    $ad->text1 = $_POST['text1'];
}

?>

<?php
if($LOGIN_TYPE=='admin'){
    include 'header_admin.php'; 
}else{
    include 'header_cuser.php'; 
}
?>

<div id="inc_side_body">

    <div class="topics">HOME &gt; 広告の編集 &gt; <span>入力フォーム</span> &gt; 入力内容の確認 &gt; 登録完了</div>

    <form action="offerad_edite.php" method="POST">
    <div class="search_list">

        <dl>
            <dd>
                <table class="search_list_table" summary="詳細テーブル">
                    <tbody>
                        <tr>
                            <th>広告タイプ<span>※</span></th>
                            <?php  if($mode=="op"){ ?>
                                <td><?php echo $ad_name[$adType]; ?><input type="hidden" name="offer_flg" value="0"></td>
                            <?php  }else{ ?>
                                <?php  if(empty($ad->offer_flg) || $ad->offer_flg==0){ ?>
                                <td><label><input type="radio" name="offer_flg" value="0" checked="checked">クローズド広告</label>
                                    <label><input type="radio" name="offer_flg" value="1">オファー広告</label></td>
                                <?php  }else{ ?>
                                <td><label><input type="radio" name="offer_flg" value="0">クローズド広告</label>
                                    <label><input type="radio" name="offer_flg" value="1" checked="checked">オファー広告</label>
                                </td>
                                <?php  } ?>

                            <?php  } ?>
                        </tr>
                        <tr>
                            <th>広告名</th>
                            <td><?php echo $ad->name; ?></td>
                        </tr>
                        <tr>
                            <th>カテゴリー</th>
                            <td><?php echo $ad->category_name; ?></td>
                        </tr>
                        <tr>
                            <th>広告説明文</th>
                            <td><?php echo $ad->comment; ?></td>
                        </tr>
                        <tr>
                            <th>テキスト広告文</th>
                            <td><?php echo $ad->ad_text; ?></td>
                        </tr>
                        <?php  if($mode=="op"){ ?>
                            <tr>
                            <th>拡張TEXT１</th>
                            <td><textarea name="text1" cols="" rows="" class="textarea"><?php echo $ad->text1; ?></textarea></td>
                            </tr>
                        <?php  }else{ ?>
                            <input type="hidden" name="text1" value="<?php echo $ad->text1; ?>">
                        <?php } ?>
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
    </div>
    </form>

</div>


<?php include 'footer.php'; ?>