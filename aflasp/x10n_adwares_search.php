<?php
include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';
include 'x10c/db/adwares.php';
include 'x10c/db/x10.php';

// セッション再開
session_start();

//Timezone
date_default_timezone_set('Asia/Tokyo');

// エラーメッセージの初期化
$errorMessage = '';

$LOGIN_ID = $_SESSION[ $SESSION_NAME ];
if(empty($LOGIN_ID)){ header('Location: x10n_logoff.php'); }

$category = $_POST['category'];
$adware_type = $_POST['adware_type'];
$approvable = $_POST['approvable'];


$offsetPage = 0;
$limitPage = 5;
$crntPage = empty($_POST['page']) ? 1: $_POST['page'];

$adtyped = array('','','','');
$aprved = array('','','');

$ads = array();

if (isset($_POST['run'])) {
    $tmp = array();

    // foreach ((array)$category as $ctgry) {
    //     $tmp2[] = "category='".$ctgry."'";
    // }
    // if (!empty($tmp2)) {
    //     $tmp[] = "(".implode(" OR ", $tmp2).")";
    // }
    if (!empty($category)) {
        $tmp[] = "(category='".$category."')";
    }

    foreach ((array)$adware_type as $at) {
        if ($at=="0") {
            $tmp3[] = "(adware_type=0)";
            $adtyped[0]= " checked";
        } elseif ($at=="1") {
            $tmp3[] = "(adware_type=1)";
            $adtyped[1]= " checked";
        } elseif ($at=="2") {
            $tmp3[] = "(adware_type=2)";
            $adtyped[2]= " checked";
        }
    }
    if (!empty($tmp3)) {
        $tmp[] = "(".implode(" OR ", $tmp3).")";
    }

    // foreach ((array)$approvable as $apv) {
    //     if ($apv=="0") {
    //         $tmp4[] = "(approvable=0)";
    //         $aprved[0]= " checked";
    //     } elseif ($apv=="1") {
    //         $tmp4[] = "(approvable=1)";
    //         $aprved[1]= " checked";
    //     }
    // }
    // if (!empty($tmp4)) {
    //     $tmp[] = "(".implode(" OR ", $tmp4).")";
    // }


    if (count($tmp)>0) {
        $where .= " AND ".implode(" AND ", $tmp);
    }
}


if (is_array($approvable)) {
    $where .=  " AND (approvable=1) ";
    $aprved[1]= " checked";
} else {
    $where .= " AND (approvable=0) ";
}

$where .= " AND (isFinish=0) ";

//検索結果件数を取得
$cnt = countAdwares($where);

//ページ数を計算
$pages = ceil($cnt / $limitPage);

//オフセットページ
$offsetPage = ($crntPage - 1) * $limitPage;


$pagerhtml='';
if ($offsetPage==0) {
    $pagerhtml .= '<span class="previous">&lt;&lt; 前はありません</span>';
} else {
    $pagerhtml .= '<span class="previous"><a href="javascript:paging('.($crntPage - 1).')">&lt;&lt; 前の5 件</a></span>';
}
for ($i = 1; $i <= $pages; $i++) {
    if ($i==$crntPage) {
        $pagerhtml .= '<span class="active">'.$i.'</span>';
    } else {
        $pagerhtml .= '<span><a href="javascript:paging('.$i.')">'.$i.'</a></span>';
    }
}
if ($crntPage==$pages || $pages==0) {
    $pagerhtml .= '<span class="next">次はありません &gt;&gt;</span>';
} elseif ($crntPage==($pages-1)) {
    $pagerhtml .= '<span class="next"><a href="javascript:paging('.($crntPage + 1).')">次の'.($cnt % $limitPage).'件 &gt;&gt;</a></span>';
} else {
    $pagerhtml .= '<span class="next"><a href="javascript:paging('.($crntPage + 1).')">次の'.$limitPage.'件 &gt;&gt;</a></span>';
}


$ads = getAdwaresLimit($where, $limitPage, $offsetPage);


$html="<option value=''>選択しない</option>";
$categories = getCategories();
foreach ($categories as $cat) {
    $wk = in_array($cat->id, (array)$category) ? " selected" : "";
    $html .= "<option  value='".$cat->id."' ".$wk.">".$cat->name."</option>";
//    $html .= "<label><input type='checkbox' name='category[]' value='".$cat->id."' ".$wk.">".$cat->name."</label>";
}



?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo ""; ?></title>
    <link rel="stylesheet" href="x10n/css/main.css">
<script>
function paging(vlu) {
    document.frm.page.value = vlu;
    document.frm.reset();
    document.frm.submit();
}
</script>
</head>

<body>

    オファー一覧<br>
    <br>
    <form action="" method="POST" name="frm">
        <input type="hidden" name="type" value="adwares">
        <input type="hidden" name="run" value="true">
        <input type="hidden" name="page" value="">
        <input type="hidden" name="mode" value="<?php echo $mode; ?>">
        <table class="search_table" summary="検索用テーブル">
            <tbody>
                <tr>
                    <th>広告タイプ</th>
                    <td>
                        <label><input type="checkbox" name="adware_type[]" value="0"
                                <?php echo $adtyped[0]; ?>>成果報酬タイプ</label>
                        <label><input type="checkbox" name="adware_type[]" value="1"
                                <?php echo $adtyped[1]; ?>>クリック報酬タイプ</label>
                        <label><input type="checkbox" name="adware_type[]" value="2"
                                <?php echo $adtyped[2]; ?>>投稿報酬タイプ</label>
                    </td>
                </tr>
                <tr>
                    <th>承認タイプ</th>
                    <td>
                        <!--
                        <label><input type="checkbox" name="approvable[]" value="0"
                                <?php echo $aprved[0]; ?>>オープン</label>
                        -->
                        <label><input type="checkbox" name="approvable[]" value="1"
                                <?php echo $aprved[1]; ?>>承認制オファー</label>
                    </td>
                </tr>
                <tr>
                    <th>カテゴリ</th>
                    <td><select  name='category'><?php  echo $html; ?></select>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="input_box">
            <input type="submit" value="条件検索" class="input_base">
        </div>
    </form>
<br><br>




    <!--blocks-->
    <table>
        <?php foreach ((array)$ads as $ad) { ?>
        <tr>
            <?php  if ($ad->adware_type=="0") { ?>
            <td>[目標]</td>
            <?php  } elseif ($ad->adware_type=="1") { ?>
            <td>[クリック]</td>
            <?php  } elseif ($ad->adware_type=="2") { ?>
            <td>[投稿]</td>
            <?php  } ?>
            <td>
                <a href="x10n_adwares_info.php?id=<?php echo $ad->id; ?>">
                    <?php echo $ad->name; ?>
                </a>
                <?php  if ($ad->approvable=="1") { ?>
                [承認]</td>
                <?php  } ?>
            </td>
        </tr>
        <?php } ?>
    </table>
    <!--blocks_END-->





    <!--ページャー-->
    <div class="pager">
        <p class="pagination">
            <?php echo $pagerhtml; ?>
        </p>
    </div>
    <!--ページャーここまで-->


    <br><br>
    <input type="button" onclick="location.href='x10n_home.php'" value="トップへ">

</body>

</html>