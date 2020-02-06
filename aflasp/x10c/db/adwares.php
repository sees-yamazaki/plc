<?php

class cls_adwares
{
    public $shadow_id ;
    public $delete_key ;
    public $id ;
    public $cuser ;
    public $comment ;
    public $ad_text ;
    public $category ;
    public $banner ;
    public $banner2 ;
    public $banner3 ;
    public $tmp_banner ;
    public $tmp_banner2 ;
    public $tmp_banner3 ;
    public $banner_m ;
    public $banner_m2 ;
    public $banner_m3 ;
    public $url ;
    public $url_m ;
    public $url_over ;
    public $url_users ;
    public $name ;
    public $money ;
    public $ad_type ;
    public $click_money ;
    public $continue_money ;
    public $continue_type ;
    public $limits ;
    public $limit_type ;
    public $money_count ;
    public $pay_count ;
    public $click_money_count ;
    public $continue_money_count ;
    public $span ;
    public $span_type ;
    public $use_cookie_interval ;
    public $pay_span ;
    public $pay_span_type ;
    public $auto ;
    public $click_auto ;
    public $continue_auto ;
    public $check_type ;
    public $open ;
    public $open_user ;
    public $regist ;

    public $adware_type ;
    public $approvable ;
}



function getAdwaresNextId($approvable)
{
    $id=0;
    try {
        require 'dns.php';
        if($approvable=="0"){
            $sql = "select IFNULL(MAX(shadow_id),0)+1 as nxtid from `adwares`";
        }else{
            $sql = "select IFNULL(MAX(shadow_id),0)+1 as nxtid from `secretadwares`";
        }
        $stmt = $pdo->prepare($sql);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        if ($row = $stmt->fetch()) {
            $id = $row['nxtid'];
        }
    } catch (PDOException $e) {
        //
    }
    return $id;
}


function insertAdwares($adwares)
{
    try {
        $adwares->shadow_id = getAdwaresNextId($adwares->approvable);
        if($adwares->approvable=="0"){
            $adwares->id =  "A".sprintf('%07d', $adwares->shadow_id);
        }else{
            $adwares->id =  "SA".sprintf('%06d', $adwares->shadow_id);
        }
        $dt = strtotime("now");
        require 'dns.php';
        if($adwares->approvable=="0"){
            $sql = "INSERT  INTO `adwares` (  `shadow_id`,  `delete_key`,  `id`,  `cuser`,  `comment`,  `ad_text`,  `category`,  `banner`,  `banner2`,  `banner3`,  `banner_m`,  `banner_m2`,  `banner_m3`,  `url`,  `url_m`,  `url_over`,  `url_users`,  `name`,  `money`,  `ad_type`,  `click_money`,  `continue_money`,  `continue_type`,  `limits`,  `limit_type`,  `money_count`,  `pay_count`,  `click_money_count`,  `continue_money_count`,  `span`,  `span_type`,  `use_cookie_interval`,  `pay_span`,  `pay_span_type`,  `auto`,  `click_auto`,  `continue_auto`,  `check_type`,  `open`,  `regist`) VALUES (:shadow_id, :delete_key, :id, :cuser, :comment, :ad_text, :category, :banner, :banner2, :banner3, :banner_m, :banner_m2, :banner_m3, :url, :url_m, :url_over, :url_users, :name, :money, :ad_type, :click_money, :continue_money, :continue_type, :limits, :limit_type, :money_count, :pay_count, :click_money_count, :continue_money_count, :span, :span_type, :use_cookie_interval, :pay_span, :pay_span_type, :auto, :click_auto, :continue_auto, :check_type, :open, :regist)";
        }else{
            $sql = "INSERT  INTO `secretadwares`  (  `shadow_id`,  `delete_key`,  `id`,  `cuser`,  `comment`,  `ad_text`,  `category`,  `banner`,  `banner2`,  `banner3`,  `banner_m`,  `banner_m2`,  `banner_m3`,  `url`,  `url_m`,  `url_over`,  `url_users`,  `name`,  `money`,  `ad_type`,  `click_money`,  `continue_money`,  `continue_type`,  `limits`,  `limit_type`,  `money_count`,  `pay_count`,  `click_money_count`,  `continue_money_count`,  `span`,  `span_type`,  `use_cookie_interval`,  `pay_span`,  `pay_span_type`,  `auto`,  `click_auto`,  `continue_auto`,  `check_type`,  `open`, `open_user`,  `regist`) VALUES (:shadow_id, :delete_key, :id, :cuser, :comment, :ad_text, :category, :banner, :banner2, :banner3, :banner_m, :banner_m2, :banner_m3, :url, :url_m, :url_over, :url_users, :name, :money, :ad_type, :click_money, :continue_money, :continue_type, :limits, :limit_type, :money_count, :pay_count, :click_money_count, :continue_money_count, :span, :span_type, :use_cookie_interval, :pay_span, :pay_span_type, :auto, :click_auto, :continue_auto, :check_type, :open, '', :regist)";
        }
        
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':shadow_id', $adwares->shadow_id, PDO::PARAM_INT);
        $stmt->bindParam(':delete_key', $adwares->delete_key, PDO::PARAM_INT);
        $stmt->bindParam(':id', $adwares->id, PDO::PARAM_STR);
        $stmt->bindParam(':cuser', $adwares->cuser, PDO::PARAM_STR);
        $stmt->bindParam(':comment', $adwares->comment, PDO::PARAM_STR);
        $stmt->bindParam(':ad_text', $adwares->ad_text, PDO::PARAM_STR);
        $stmt->bindParam(':category', $adwares->category, PDO::PARAM_STR);
        $stmt->bindParam(':banner', $adwares->banner, PDO::PARAM_STR);
        $stmt->bindParam(':banner2', $adwares->banner2, PDO::PARAM_STR);
        $stmt->bindParam(':banner3', $adwares->banner3, PDO::PARAM_STR);
        $stmt->bindParam(':banner_m', $adwares->banner_m, PDO::PARAM_STR);
        $stmt->bindParam(':banner_m2', $adwares->banner_m2, PDO::PARAM_STR);
        $stmt->bindParam(':banner_m3', $adwares->banner_m3, PDO::PARAM_STR);
        $stmt->bindParam(':url', $adwares->url, PDO::PARAM_STR);
        $stmt->bindParam(':url_m', $adwares->url_m, PDO::PARAM_STR);
        $stmt->bindParam(':url_over', $adwares->url_over, PDO::PARAM_STR);
        $stmt->bindParam(':url_users', $adwares->url_users, PDO::PARAM_INT);
        $stmt->bindParam(':name', $adwares->name, PDO::PARAM_STR);
        $stmt->bindParam(':money', $adwares->money, PDO::PARAM_STR);
        $stmt->bindParam(':ad_type', $adwares->ad_type, PDO::PARAM_STR);
        $stmt->bindParam(':click_money', $adwares->click_money, PDO::PARAM_STR);
        $stmt->bindParam(':continue_money', $adwares->continue_money, PDO::PARAM_STR);
        $stmt->bindParam(':continue_type', $adwares->continue_type, PDO::PARAM_STR);
        $stmt->bindParam(':limits', $adwares->limits, PDO::PARAM_INT);
        $stmt->bindParam(':limit_type', $adwares->limit_type, PDO::PARAM_STR);
        $ZERO = 0;
        $stmt->bindParam(':money_count', $ZERO , PDO::PARAM_INT);
        $stmt->bindParam(':pay_count', $ZERO , PDO::PARAM_INT);
        $stmt->bindParam(':click_money_count', $ZERO , PDO::PARAM_INT);
        $stmt->bindParam(':continue_money_count', $ZERO , PDO::PARAM_INT);
        $stmt->bindParam(':span', $adwares->span, PDO::PARAM_INT);
        $stmt->bindParam(':span_type', $adwares->span_type, PDO::PARAM_STR);
        $stmt->bindParam(':use_cookie_interval', $adwares->use_cookie_interval, PDO::PARAM_INT);
        $stmt->bindParam(':pay_span', $adwares->pay_span, PDO::PARAM_INT);
        $stmt->bindParam(':pay_span_type', $adwares->pay_span_type, PDO::PARAM_STR);
        $stmt->bindParam(':auto', $adwares->auto, PDO::PARAM_STR);
        $stmt->bindParam(':click_auto', $adwares->click_auto, PDO::PARAM_STR);
        $stmt->bindParam(':continue_auto', $adwares->continue_auto, PDO::PARAM_STR);
        $stmt->bindParam(':check_type', $adwares->check_type, PDO::PARAM_STR);
        $stmt->bindParam(':open', $adwares->open, PDO::PARAM_INT);
        $stmt->bindParam(':regist', $dt, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

        $insertid = $pdo->lastInsertId();

        if ($stmt->rowCount()==0) {
            logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
            logging("INSERT ERROR : ". $sql);
            logging("ARGS : ". json_encode(func_get_args()));
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
}



// function updateAdwares($adwares)
// {
//     try {
//         require $_SESSION["MY_ROOT"].'/src/db/dns.php';
//         $sql = " UPDATE `adwares`  SET  `delete_key`=:delete_key,  `id`=:id,  `cuser`=:cuser,  `comment`=:comment,  `ad_text`=:ad_text,  `category`=:category,  `banner`=:banner,  `banner2`=:banner2,  `banner3`=:banner3,  `banner_m`=:banner_m,  `banner_m2`=:banner_m2,  `banner_m3`=:banner_m3,  `url`=:url,  `url_m`=:url_m,  `url_over`=:url_over,  `url_users`=:url_users,  `name`=:name,  `money`=:money,  `ad_type`=:ad_type,  `click_money`=:click_money,  `continue_money`=:continue_money,  `continue_type`=:continue_type,  `limits`=:limits,  `limit_type`=:limit_type,  `money_count`=:money_count,  `pay_count`=:pay_count,  `click_money_count`=:click_money_count,  `continue_money_count`=:continue_money_count,  `span`=:span,  `span_type`=:span_type,  `use_cookie_interval`=:use_cookie_interval,  `pay_span`=:pay_span,  `pay_span_type`=:pay_span_type,  `auto`=:auto,  `click_auto`=:click_auto,  `continue_auto`=:continue_auto,  `check_type`=:check_type,  `open`=:open,  `regist`=:regist WHERE shadow_id=:shadow_id";
//         $stmt = $pdo -> prepare($sql);
//         $stmt->bindParam(':shadow_id', $adwares->shadow_id, PDO::PARAM_INT);
//         $stmt->bindParam(':delete_key', $adwares->delete_key, PDO::PARAM_INT);
//         $stmt->bindParam(':id', $adwares->id, PDO::PARAM_STR);
//         $stmt->bindParam(':cuser', $adwares->cuser, PDO::PARAM_STR);
//         $stmt->bindParam(':comment', $adwares->comment, PDO::PARAM_STR);
//         $stmt->bindParam(':ad_text', $adwares->ad_text, PDO::PARAM_STR);
//         $stmt->bindParam(':category', $adwares->category, PDO::PARAM_STR);
//         $stmt->bindParam(':banner', $adwares->banner, PDO::PARAM_STR);
//         $stmt->bindParam(':banner2', $adwares->banner2, PDO::PARAM_STR);
//         $stmt->bindParam(':banner3', $adwares->banner3, PDO::PARAM_STR);
//         $stmt->bindParam(':banner_m', $adwares->banner_m, PDO::PARAM_STR);
//         $stmt->bindParam(':banner_m2', $adwares->banner_m2, PDO::PARAM_STR);
//         $stmt->bindParam(':banner_m3', $adwares->banner_m3, PDO::PARAM_STR);
//         $stmt->bindParam(':url', $adwares->url, PDO::PARAM_STR);
//         $stmt->bindParam(':url_m', $adwares->url_m, PDO::PARAM_STR);
//         $stmt->bindParam(':url_over', $adwares->url_over, PDO::PARAM_STR);
//         $stmt->bindParam(':url_users', $adwares->url_users, PDO::PARAM_STR);
//         $stmt->bindParam(':name', $adwares->name, PDO::PARAM_STR);
//         $stmt->bindParam(':money', $adwares->money, PDO::PARAM_STR);
//         $stmt->bindParam(':ad_type', $adwares->ad_type, PDO::PARAM_STR);
//         $stmt->bindParam(':click_money', $adwares->click_money, PDO::PARAM_STR);
//         $stmt->bindParam(':continue_money', $adwares->continue_money, PDO::PARAM_STR);
//         $stmt->bindParam(':continue_type', $adwares->continue_type, PDO::PARAM_STR);
//         $stmt->bindParam(':limits', $adwares->limits, PDO::PARAM_STR);
//         $stmt->bindParam(':limit_type', $adwares->limit_type, PDO::PARAM_STR);
//         $stmt->bindParam(':money_count', $adwares->money_count, PDO::PARAM_STR);
//         $stmt->bindParam(':pay_count', $adwares->pay_count, PDO::PARAM_STR);
//         $stmt->bindParam(':click_money_count', $adwares->click_money_count, PDO::PARAM_STR);
//         $stmt->bindParam(':continue_money_count', $adwares->continue_money_count, PDO::PARAM_STR);
//         $stmt->bindParam(':span', $adwares->span, PDO::PARAM_STR);
//         $stmt->bindParam(':span_type', $adwares->span_type, PDO::PARAM_STR);
//         $stmt->bindParam(':use_cookie_interval', $adwares->use_cookie_interval, PDO::PARAM_STR);
//         $stmt->bindParam(':pay_span', $adwares->pay_span, PDO::PARAM_STR);
//         $stmt->bindParam(':pay_span_type', $adwares->pay_span_type, PDO::PARAM_STR);
//         $stmt->bindParam(':auto', $adwares->auto, PDO::PARAM_STR);
//         $stmt->bindParam(':click_auto', $adwares->click_auto, PDO::PARAM_STR);
//         $stmt->bindParam(':continue_auto', $adwares->continue_auto, PDO::PARAM_STR);
//         $stmt->bindParam(':check_type', $adwares->check_type, PDO::PARAM_STR);
//         $stmt->bindParam(':open', $adwares->open, PDO::PARAM_STR);
//         $stmt->bindParam(':regist', $adwares->regist, PDO::PARAM_STR);
//         $stmt->execute();
//     } catch (PDOException $e) {
//         $errorMessage = 'データベースエラー';
//         if (strcmp("1", $ini['debug'])==0) {
//             echo $e->getMessage();
//         }
//     }
// }
