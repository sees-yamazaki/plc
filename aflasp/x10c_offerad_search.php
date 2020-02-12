<?php
require('custom/conf.php');
require('x10c/db/x10.php');
include 'x10c_logging.php';
include 'x10c_helper.php';

// セッション開始
session_start();

$LOGIN_ID = $_SESSION[ $SESSION_NAME ];
$LOGIN_TYPE = $_SESSION[ $SESSION_TYPE ];

$mode = empty($_GET['mode']) ? $_POST['mode'] : $_GET['mode'];

$id = $_POST['id'];
$name = $_POST['name'];
$category = $_POST['category'];
$adware_type = $_POST['adware_type'];
$approvable = $_POST['approvable'];

$offsetPage = 0;
$limitPage = 5;
$crntPage = empty($_POST['page']) ? 1: $_POST['page'];

$adtyped = array('','','');
$aprved = array('','','');

$ads = array();

if (isset($_POST['run'])) {
    $tmp = array();

    if (!empty($id)) {
        $tmp[] = " (id LIKE '%".$id."%') ";
    }
    if (!empty($name)) {
        $tmp[] = " (name LIKE '%".$name."%') ";
    }
    foreach ((array)$category as $ctgry) {
        $tmp2[] = "category='".$ctgry."'";
    }
    if (!empty($tmp2)) {
        $tmp[] = "(".implode(" OR ", $tmp2).")";
    }

    foreach ((array)$adware_type as $at) {
        if ($at=="0") {
            $tmp3[] = "(adware_type=0)";
            $adtyped[0]= " checked";
        } elseif ($at=="1") {
            $tmp3[] = "(adware_type=1)";
            $adtyped[1]= " checked";
        }
    }
    if (!empty($tmp3)) {
        $tmp[] = "(".implode(" OR ", $tmp3).")";
    }

    foreach ((array)$approvable as $apv) {
        if ($apv=="0") {
            $tmp4[] = "(approvable=0)";
            $aprved[0]= " checked";
        } elseif ($apv=="1") {
            $tmp4[] = "(approvable=1)";
            $aprved[1]= " checked";
        }
    }
    if (!empty($tmp4)) {
        $tmp[] = "(".implode(" OR ", $tmp4).")";
    }
    if (count($tmp)>0) {
        $where .= " AND ".implode(" AND ", $tmp);
    }
}

//広告主ログインの場合は自広告に制限する
if ($LOGIN_TYPE=='cUser') {
    $where .= " AND (cuser='".$LOGIN_ID."') ";
}


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


$html="";
$categories = getCategories();
foreach ($categories as $cat) {
    $wk = in_array($cat->id, (array)$category) ? " checked" : "";
    $html .= "<label><input type='checkbox' name='category[]' value='".$cat->id."' ".$wk.">".$cat->name."</label>";
}

?>

<?php
if ($LOGIN_TYPE=='admin') {
    include 'x10c_header_admin.php';
} else {
    include 'x10c_header_cuser.php';
}
?>

<script>
    function paging(vlu) {
        document.frm.page.value = vlu;
        document.frm.reset();
        document.frm.submit();
    }
</script>
<div id="inc_side_body">

    <div class="topics">HOME &gt; オファー広告 &gt; <span>広告の検索結果一覧</span></div>

    <!--角丸-->
    <div class="cc">
        <form action="" method="POST" name="frm">
            <dl>
                <dt><span>検索</span></dt>
                <dd>
                    <!---->
                    <input type="hidden" name="type" value="adwares">
                    <input type="hidden" name="run" value="true">
                    <input type="hidden" name="page" value="">
                    <input type="hidden" name="mode"
                        value="<?php echo $mode; ?>">
                    <table class="search_table" summary="検索用テーブル">
                        <tbody>
                            <tr>
                                <th>広告タイプ</th>
                                <td>
                                    <label><input type="checkbox" name="adware_type[]" value="0" <?php echo $adtyped[0]; ?>>目標達成タイプ</label>
                                    <label><input type="checkbox" name="adware_type[]" value="1" <?php echo $adtyped[1]; ?>>クリック報酬タイプ</label>
                                </td>
                            </tr>
                            <tr>
                                <th>承認タイプ</th>
                                <td>
                                    <label><input type="checkbox" name="approvable[]" value="0" <?php echo $aprved[0]; ?>>オープン</label>
                                    <label><input type="checkbox" name="approvable[]" value="1" <?php echo $aprved[1]; ?>>承認（クローズド）</label>
                                </td>
                            </tr>
                            <tr>
                                <th>ＩＤ</th>
                                <td><input type="text" name="id"
                                        value="<?php  echo $id; ?>"
                                        size="10" maxlength="8">
                                </td>
                            </tr>
                            <tr>
                                <th>広告名</th>
                                <td>
                                    <input type="text" name="name"
                                        value="<?php  echo $name; ?>"
                                        size="25" maxlength="25">
                                </td>
                            </tr>
                            <tr>
                                <th>カテゴリ</th>
                                <td><?php  echo $html; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="input_box">
                        <input type="submit" value="検索する" class="input_base">
                        <input type="reset" value="リセット" class="input_base">
                    </div>
                    <!---->
                </dd>
            </dl>
        </form>
    </div>
    <!--角丸終わり-->

    <?php if (count((array)$ads)==0) { ?>

    <div class="comp_list">
        <dl>
            <dt>[ SEARCH - 検索が完了しました ]</dt>
            <dd>
                <p>その条件に一致する情報はありませんでした。</p>
                <ul>
                    <li>条件を変更して、継続して検索がご利用いただけます。</li>
                </ul>
            </dd>
        </dl>
    </div>

    <?php } else { ?>

    <!--ページャー-->
    <div class="pager_info">
        <p><span>全<?php echo $cnt; ?>件中</span><span><?php echo count($ads); ?>件を表示しています</span></p>
    </div>


    <div class="pager">
        <p class="pagination">
            <?php echo $pagerhtml; ?>
        </p>
    </div>

    <!--ページャーここまで-->


    <?php foreach ((array)$ads as $ad) { ?>

    <!--blocks-->
    <div class="as">
        <div class="adwares_list">
            <table class="adwares_list_table">
                <tbody>
                    <tr>
                        <th colspan="2" class="list_head">広告ID：<?php echo $ad->id; ?>
                        </th>
                    </tr>
                    <tr>
                        <th>広告タイプ</th>
                        <?php  if ($ad->adware_type=="0") { ?>
                        <td>目標達成タイプ</td>
                        <?php  } else { ?>
                        <td>クリック報酬タイプ</td>
                        <?php  } ?>
                    </tr>
                    <tr>
                        <th>承認タイプ</th>
                        <?php  if ($ad->approvable=="0") { ?>
                        <td>オープン</td>
                        <?php  } else { ?>
                        <td>承認（クローズド）</td>
                        <?php  } ?>
                    </tr>
                    <tr>
                        <th>広告名</th>
                        <td>
                            <!-- <a href="offerad_edit.php?type=adwares&amp;id=<?php echo $ad->id; ?>&amp;mode=<?php echo $mode; ?>"><?php echo $ad->name; ?></a>
                            -->
                            <a
                                href="x10c_adwares_edit.php?type=adwares&amp;id=<?php echo $ad->id; ?>&amp;mode=<?php echo $mode; ?>"><?php echo $ad->name; ?></a>
                        </td>
                    </tr>
                    <tr>
                        <th>広告カテゴリー</th>
                        <td><?php echo $ad->category_name; ?>
                        </td>
                    </tr>
                    <?php  if ($ad->adware_type=="0") { ?>
                    <tr>
                        <th>成果報酬</th>
                        <td><?php echo $ad->money; ?>円</td>
                    </tr>
                    <?php  } ?>
                    <?php  if ($ad->adware_type=="1") { ?>
                    <tr>
                        <th>クリック報酬</th>
                        <td><?php echo $ad->click_money; ?>円</td>
                    </tr>
                    <?php  } ?>

                    <tr>
                        <th>URL</th>
                        <td><?php echo $ad->url; ?>
                        </td>
                    </tr>


                    <tr>
                        <th>広告バナー画像</th>
                        <td>
                            <?php  if (!empty($ad->banner)) { ?>
                            <div class="ad_image"><img
                                    src="<?php echo $ad->banner; ?>">
                            </div>
                            <?php  } else { ?>
                            <div class="ad_image"><span>No Image</span></div>
                            <?php  } ?>
                        </td>
                    </tr>
                    <tr>
                        <th>広告の説明</th>
                        <td class="adwares_info"><?php echo nl2br($ad->comment); ?>
                        </td>
                    </tr>



                </tbody>
            </table>
        </div>

    </div>
    <!--blocks_END-->

    <?php } ?>


    <!--ページャー-->
    <div class="pager">
        <p class="pagination">
            <?php echo $pagerhtml; ?>
        </p>
    </div>
    <!--ページャーここまで-->

    <?php } ?>

</div>

<?php include 'x10c_footer.php';