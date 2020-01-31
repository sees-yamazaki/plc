<?php
require('db/x10.php');

// セッション開始
session_start();

$LOGIN_ID = $_SESSION[ $SESSION_NAME ];
$LOGIN_TYPE = $_SESSION[ $SESSION_TYPE ];

$id = $_POST['id'];
$mode = $_POST['mode'];
$ad = new cls_secretadwares();
$ad = getAdware($id);
$tmpOfferFlg = $ad->offer_flg;

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

$ad->offer_flg = $_POST['offer_flg'];
$ad->text1 = $_POST['text1'];

if (isset($_POST['run'])) {

    if (empty($tmpOfferFlg)) {
        insertX10Adware($ad);
    }else{
        updateX10Adware($ad);
    }
    
    header("Location: offerad_edited.php");

}else{
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

    <div class="topics">HOME &gt; 広告の編集 &gt; 入力フォーム &gt; <span>入力内容の確認</span> &gt; 登録完了</div>

    <div class="search_list">
        <dl>
            <dd>
                <table class="search_list_table" summary="詳細テーブル">
                    <tbody>
                        <tr>
                            <th>広告タイプ<span>※</span></th>
                            <td><?php echo $ad_name[$adType]; ?></td>
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
                            <td><?php echo nl2br($ad->text1); ?></td>
                            </tr>
                        <?php  }else{ ?>
                        <?php } ?>
                    </tbody>
                </table>
            </dd>
        </dl>
    </div>

    <div class="input_box">
        <form action="" method="POST">
            <input type="submit" value="編集を完了する" class="input_base">
            <input type="button" value="入力画面に戻る" class="input_base" onclick="back()">
            <input type="hidden" name="run" value="true">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="offer_flg" value="<?php echo $ad->offer_flg; ?>">
            <input type="hidden" name="text1" value="<?php echo $ad->text1; ?>">
        </form>
    </div>
    
    <form action="offerad_edit.php" method="POST" name="frm">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="offer_flg" value="<?php echo $ad->offer_flg; ?>">
        <input type="hidden" name="text1" value="<?php echo $ad->text1; ?>">
        <input type="hidden" name="back" value="">
        <input type="hidden" name="mode" value="<?php echo $mode; ?>">
    </form>

</div>
<script>
    function back() {
        document.frm.submit();
    }
</script>

<?php include 'footer.php'; ?>