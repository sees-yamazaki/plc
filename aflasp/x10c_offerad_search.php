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
$adstts = isset($_GET['adstts']) ? $_GET['adstts'] : $_POST['adstts'];
$adstts = isset($_POST['doSearch']) ? "" : $adstts ;


$id = $_POST['id'];
$name = $_POST['name'];
$category = $_POST['category'];
$adware_type = $_POST['adware_type'];
$approvable = $_POST['approvable'];
$offer = $_POST['offer'];
$term = $_POST['term'];
$post = $_POST['post'];

$offsetPage = 0;
$limitPage = 5;
$crntPage = empty($_POST['page']) ? 1: $_POST['page'];

$adtyped = array('','','','');
$aprved = array('','','');
$offered = array('','');
$posted = array('','');
$termed = array('','','','');

$ads = array();

if (isset($_POST['run'])) {
    $tmp = array();

    if (!empty($id)) {
        $tmp[] = " (id LIKE '%".$id."%') ";
    }
    if (!empty($name)) {
        $tmp[] = " (name LIKE '%".$name."%') ";
    }
    // foreach ((array)$category as $ctgry) {
    //     $tmp2[] = "category='".$ctgry."'";
    // }
    // if (!empty($tmp2)) {
    //     $tmp[] = "(".implode(" OR ", $tmp2).")";
    // }
    if (!empty($category)) {
        $tmp[] = "(category='".$category."')";
    }

    // foreach ((array)$adware_type as $at) {
    //     if ($at=="0") {
    //         $tmp3[] = "(adware_type=0)";
    //         $adtyped[0]= " checked";
    //     } elseif ($at=="1") {
    //         $tmp3[] = "(adware_type=1)";
    //         $adtyped[1]= " checked";
    //     } elseif ($at=="2") {
    //         $tmp3[] = "(adware_type=2)";
    //         $adtyped[2]= " checked";
    //     } else {
    //         $tmp3[] = "(adware_type=0)";
    //     }
    // }
    // if (!empty($tmp3)) {
    //     $tmp[] = "(".implode(" OR ", $tmp3).")";
    // }

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

    foreach ((array)$offer as $ofr) {
        if ($ofr=="0") {
            $tmp5[] = "((cnt_offer=0) OR cnt_offer IS NULL)";
            $offered[0]= " checked";
        } elseif ($ofr=="1") {
            $tmp5[] = "(cnt_offer>0)";
            $offered[1]= " checked";
        }
    }
    if (!empty($tmp5)) {
        $tmp[] = "(".implode(" OR ", $tmp5).")";
    }


    foreach ((array)$post as $pst) {
        if ($pst=="0") {
            $tmp7[] = "((cnt_post=0) OR cnt_post IS NULL)";
            $posted[0]= " checked";
        } elseif ($pst=="1") {
            $tmp7[] = "(cnt_post>0)";
            $posted[1]= " checked";
        }
    }
    if (!empty($tmp7)) {
        $tmp[] = "(".implode(" OR ", $tmp7).")";
    }

    $tdy = date('Y-m-d');
    foreach ((array)$term as $trm) {
        if ($trm=="0") {
            $tmp6[] = "(enddt IS NULL AND isFinish = 0)";
            $termed[0]= " checked";
        } elseif ($trm=="1") {
            $tmp6[] = "(startdt>'".$tdy."' AND isFinish = 0)";
            $termed[1]= " checked";
        } elseif ($trm=="2") {
            $tmp6[] = "(startdt<='".$tdy."' AND enddt>='".$tdy."' AND isFinish = 0)";
            $termed[2]= " checked";
        } elseif ($trm=="3") {
            $tmp6[] = "(enddt<'".$tdy."')";
            $termed[3]= " checked";
        }
    }
    if (!empty($tmp6)) {
        $tmp[] = "(".implode(" OR ", $tmp6).")";
    }


    if (count($tmp)>0) {
        $where .= " AND ".implode(" AND ", $tmp);
    }
}




if (isset($_GET['adware_type'])) {
    if ($_GET['adware_type']=="0") {
        $where .= " AND (adware_type=0)";
        $adtyped[0]= " checked";
    } elseif ($_GET['adware_type']=="1") {
        $where .= " AND (adware_type=1)";
        $adtyped[1]= " checked";
    } elseif ($_GET['adware_type']=="2") {
        $where .= " AND (adware_type=2)";
        $adtyped[2]= " checked";
    }
} else {
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
        } else {
            $tmp3[] = "(adware_type=0)";
        }
    }
    if (!empty($tmp3)) {
        $where .=  " AND (".implode(" OR ", $tmp3).")";
    }
}


if (isset($_GET['approvable'])) {
    $where .=  " AND (approvable=1) ";
    $aprved[1]= " checked";
} elseif ($adstts<>"") {
    if ($adstts=="0") {
        $termed[0]= " checked";
        $termed[1]= " checked";
        $termed[2]= " checked";
        $where .=  " AND (isFinish=0) ";
    } else {
        $termed[3]= " checked";
        $where .=  " AND (isFinish=1) ";
    }
    //
} else {
    if (is_array($approvable)) {
        $where .=  " AND (approvable=1) ";
        $aprved[1]= " checked";
    } else {
        $where .= " AND (approvable=0) ";
    }
}


//広告主ログインの場合は自広告に制限する
if ($LOGIN_TYPE=='cUser') {
    $where .= " AND (cuser='".$LOGIN_ID."') ";
}

$prmlink='';
if (isset($_GET['ofr'])) {
    $where .= " AND (cnt_offer>0)";
    $offered[1]= " checked";
    $prmlink='&amp;prmOfr=1';
}

if (isset($_GET['pst'])) {
    $where .= " AND (cnt_post>0)";
    $posted[1]= " checked";
    $prmlink='&amp;prmPst=1';
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


$html="<option value=''>選択しない</option>";
$categories = getCategories();
foreach ($categories as $cat) {
    $wk = in_array($cat->id, (array)$category) ? " selected" : "";
    $html .= "<option  value='".$cat->id."' ".$wk.">".$cat->name."</option>";
//    $html .= "<label><input type='checkbox' name='category[]' value='".$cat->id."' ".$wk.">".$cat->name."</label>";
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
        <form action="x10c_offerad_search.php" method="POST" name="frm">
            <dl>
                <dt><span>検索</span></dt>
                <dd>
                    <!---->
                    <input type="hidden" name="type" value="adwares">
                    <input type="hidden" name="run" value="true">
                    <input type="hidden" name="page" value="">
                    <input type="hidden" name="mode" value="<?php echo $mode; ?>">
                    <?php if ($adstts<>"") {  ?>
                        <input type="hidden" name="adstts" value="<?php echo $adstts; ?>">
                    <?php  } ?>
                    <table class="search_table" summary="検索用テーブル">
                        <tbody>
                            <tr>
                                <th>広告タイプ</th>
                                <td>
                                    <label><input type="checkbox" name="adware_type[]" value="0"
                                            <?php echo $adtyped[0]; ?>>目標達成タイプ</label>
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
                                            <?php echo $aprved[1]; ?>>承認（クローズド）</label>
                                </td>
                            </tr>
                            <tr>
                                <th>ＩＤ</th>
                                <td><input type="text" name="id" value="<?php  echo $id; ?>" size="10" maxlength="8">
                                </td>
                            </tr>
                            <tr>
                                <th>広告名</th>
                                <td>
                                    <input type="text" name="name" value="<?php  echo $name; ?>" size="25"
                                        maxlength="25">
                                </td>
                            </tr>
                            <tr>
                                <th>カテゴリ</th>
                                <td><select  name='category'><?php  echo $html; ?></select>
                                </td>
                            </tr>
                            <tr>
                                <th>承認申請</th>
                                <td>
                                    <label><input type="checkbox" name="offer[]" value="0" <?php echo $offered[0]; ?>>なし</label>
                                    <label><input type="checkbox" name="offer[]" value="1" <?php echo $offered[1]; ?>>あり</label>
                                </td>
                            </tr>
                            <tr>
                                <th>投稿申請</th>
                                <td>
                                    <label><input type="checkbox" name="post[]" value="0" <?php echo $posted[0]; ?>>なし</label>
                                    <label><input type="checkbox" name="post[]" value="1" <?php echo $posted[1]; ?>>あり</label>
                                </td>
                            </tr>
                            <tr>
                                <th>開催期間</th>
                                <td>
                                    <label><input type="checkbox" name="term[]" value="0" <?php echo $termed[0]; ?>>無期限</label>
                                    <label><input type="checkbox" name="term[]" value="1" <?php echo $termed[1]; ?>>開催前</label>
                                    <label><input type="checkbox" name="term[]" value="2" <?php echo $termed[2]; ?>>開催中</label>
                                    <label><input type="checkbox" name="term[]" value="3" <?php echo $termed[3]; ?>>終了</label>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <div class="input_box">
                        <input type="submit" value="検索する" name="doSearch" class="input_base">
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
                        <?php  } elseif ($ad->adware_type=="1") { ?>
                        <td>クリック報酬タイプ</td>
                        <?php  } elseif ($ad->adware_type=="2") { ?>
                        <td>投稿報酬タイプ</td>
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
                            <div class="ad_image"><img src="<?php echo $ad->banner; ?>" style="max-width: 400px;">
                            </div>
                            <?php  } else { ?>
                            <div class="ad_image"><span>No Image</span></div>
                            <?php  } ?>
                        </td>
                    </tr>


<tr>
    <th>広告期間</th>
    <td>
        <?php  if (!empty($ad->enddt)) { ?>
        <div class="ad_image"><?php echo $ad->startdt; ?> 〜 <?php echo $ad->enddt; ?>
        </div>
        <?php  } else { ?>
        <div class="ad_image"><span>無期限</span></div>
        <?php  } ?>
    </td>
</tr>

                    <tr>
                        <th>広告の説明</th>
                        <td class="adwares_info" style="max-width: 500px;"><?php echo nl2br($ad->comment); ?>
                        </td>
                    </tr>
                    <?php  if ($ad->approvable=="1") { ?>
                    <tr>
                        <th>申請承認待ち件数</th>
                        <td class="adwares_info">
                            <a href="x10c_offer_edit.php?pid=srch&amp;id=<?php echo $ad->id; ?>&amp;prmOfr=1&amp;mode=<?php echo $mode.$prmlink; ?>">
                            <?php echo $ad->cnt_offer; ?>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>投稿承認待ち件数</th>
                        <td class="adwares_info">
                            <a href="x10c_offer_edit.php?pid=srch&amp;id=<?php echo $ad->id; ?>&amp;prmPst=1&amp;mode=<?php echo $mode.$prmlink; ?>">
                            <?php echo $ad->cnt_post; ?>
                            </a>
                        </td>
                    </tr>
                    <?php  } ?>



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
