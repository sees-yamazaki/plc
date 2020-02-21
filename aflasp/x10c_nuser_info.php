<?php
include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';
include 'x10c/db/adwares.php';
include 'x10c/db/x10.php';
include 'x10c/db/system.php';
include 'x10c/db/nuser.php';

// セッション再開
session_start();

//Timezone
date_default_timezone_set('Asia/Tokyo');

$LOGIN_ID = $_SESSION[ $SESSION_NAME ];
$LOGIN_TYPE = $_SESSION[ $SESSION_TYPE ];


$id = empty($_GET['id']) ? $_POST['id'] : $_GET['id'];
$nuserid = empty($_GET['nuser']) ? $_POST['nuser'] : $_GET['nuser'];

$nuser = getNuser($nuserid);
$nuserX10 = getNuserX10($nuserid);

if ($LOGIN_TYPE=='admin') {
    include 'x10c_header_admin.php';
} else {
    include 'x10c_header_cuser.php';
}




?>

<div id="inc_side_body">

<div class="topics">HOME &gt; <span>ユーザーの詳細</span></div>

<div class="search_list">
<dl>
<dt>登録情報</dt>
<dd>
<table class="search_list_table" summary="詳細テーブル">
<tbody><tr>
    <th>ID／名前</th>
    <td><?php echo $nuser->id; ?>／<?php echo $nuser->name; ?></td>
</tr>
<tr>
    <th>ニックネーム</th>
    <?php if(!empty($nuserX10->nickname)){ ?>
    <td><?php echo $nuserX10->nickname; ?></td>
    <?php }else{ echo '<td>--</td>'; } ?>
</tr>
<tr>
<th>instagram</th>
    <?php if(!empty($nuserX10->instagram)){ ?>
    <td><a href='<?php echo $nuserX10->instagram; ?>' target='_blank'><?php echo $nuserX10->instagram; ?></a></td>
    <?php }else{ echo '<td>--</td>'; } ?>
</tr>
<tr>
<th>facebook</th>
<?php if(!empty($nuserX10->facebook)){ ?>
    <td><a href='<?php echo $nuserX10->facebook; ?>' target='_blank'><?php echo $nuserX10->facebook; ?></a></td>
    <?php }else{ echo '<td>--</td>'; } ?>
</tr>
<tr>
<th>twitter</th>
<?php if(!empty($nuserX10->twitter)){ ?>
    <td><a href='<?php echo $nuserX10->twitter; ?>' target='_blank'><?php echo $nuserX10->twitter; ?></a></td>
    <?php }else{ echo '<td>--</td>'; } ?>
</tr>
<tr>
<th>youtube</th>
<?php if(!empty($nuserX10->youtube)){ ?>
    <td><a href='<?php echo $nuserX10->youtube; ?>' target='_blank'><?php echo $nuserX10->youtube; ?></a></td>
    <?php }else{ echo '<td>--</td>'; } ?>
</tr>

</tbody></table>
</dd>
</dl>
</div>

<a href="x10c_offer_edit.php?id=<?php echo $id ?>" class="input_base">戻る</a>

</div>


<?php include 'x10c_footer.php';
