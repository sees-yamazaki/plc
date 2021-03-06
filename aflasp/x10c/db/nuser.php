<?php

class cls_nuser
{
    public $shadow_id ;
    public $delete_key ;
    public $id ;
    public $name ;
    public $zip1 ;
    public $zip2 ;
    public $adds ;
    public $add_sub ;
    public $tel ;
    public $fax ;
    public $url ;
    public $mail ;
    public $bank_code ;
    public $bank ;
    public $branch_code ;
    public $branch ;
    public $bank_type ;
    public $number ;
    public $bank_name ;
    public $parent ;
    public $grandparent ;
    public $greatgrandparent ;
    public $pass ;
    public $terminal ;
    public $activate ;
    public $pay ;
    public $tier ;
    public $rank ;
    public $personal_rate ;
    public $magni ;
    public $mail_reception ;
    public $is_mobile ;
    public $limits ;
    public $regist ;
    public $logout ;
    //??W?p????
    public $mail_confirm ;
    public $pass_confirm ;
}

// function getNuser()
// {
//     try {
//         $results = array();
//         require 'dns.php';
//         $stmt = $pdo->prepare("SELECT * FROM  `nuser` ORDER BY shadow_id");
//         $stmt->execute();
//         while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//             $result = new cls_nuser();
//             $result->delete_key = $row['delete_key'];
//             $result->id = $row['id'];
//             $result->name = $row['name'];
//             $result->zip1 = $row['zip1'];
//             $result->zip2 = $row['zip2'];
//             $result->adds = $row['adds'];
//             $result->add_sub = $row['add_sub'];
//             $result->tel = $row['tel'];
//             $result->fax = $row['fax'];
//             $result->url = $row['url'];
//             $result->mail = $row['mail'];
//             $result->bank_code = $row['bank_code'];
//             $result->bank = $row['bank'];
//             $result->branch_code = $row['branch_code'];
//             $result->branch = $row['branch'];
//             $result->bank_type = $row['bank_type'];
//             $result->number = $row['number'];
//             $result->bank_name = $row['bank_name'];
//             $result->parent = $row['parent'];
//             $result->grandparent = $row['grandparent'];
//             $result->greatgrandparent = $row['greatgrandparent'];
//             $result->pass = $row['pass'];
//             $result->terminal = $row['terminal'];
//             $result->activate = $row['activate'];
//             $result->pay = $row['pay'];
//             $result->tier = $row['tier'];
//             $result->rank = $row['rank'];
//             $result->personal_rate = $row['personal_rate'];
//             $result->magni = $row['magni'];
//             $result->mail_reception = $row['mail_reception'];
//             $result->is_mobile = $row['is_mobile'];
//             $result->limits = $row['limits'];
//             $result->regist = $row['regist'];
//             $result->logout = $row['logout'];
//             array_push($results, $result);
//         }
//     } catch (PDOException $e) {
//         $errorMessage = 'DATABASE ERROR';
//         if (strcmp("1", $ini['debug'])==0) {
//             echo $e->getMessage();
//         }
//     }
//     return $results;
// }

function getNuser($nId)
{
    try {
        $result = new cls_nuser();
        require 'dns.php';
        $stmt = $pdo->prepare("SELECT * FROM `nuser` WHERE id=:id");
        $stmt->bindParam(':id', $nId, PDO::PARAM_STR);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        if ($row = $stmt->fetch()) {
            $result->delete_key = $row['delete_key'];
            $result->id = $row['id'];
            $result->name = $row['name'];
            $result->zip1 = $row['zip1'];
            $result->zip2 = $row['zip2'];
            $result->adds = $row['adds'];
            $result->add_sub = $row['add_sub'];
            $result->tel = $row['tel'];
            $result->fax = $row['fax'];
            $result->url = $row['url'];
            $result->mail = $row['mail'];
            $result->bank_code = $row['bank_code'];
            $result->bank = $row['bank'];
            $result->branch_code = $row['branch_code'];
            $result->branch = $row['branch'];
            $result->bank_type = $row['bank_type'];
            $result->number = $row['number'];
            $result->bank_name = $row['bank_name'];
            $result->parent = $row['parent'];
            $result->grandparent = $row['grandparent'];
            $result->greatgrandparent = $row['greatgrandparent'];
            $result->pass = $row['pass'];
            $result->terminal = $row['terminal'];
            $result->activate = $row['activate'];
            $result->pay = $row['pay'];
            $result->tier = $row['tier'];
            $result->rank = $row['rank'];
            $result->personal_rate = $row['personal_rate'];
            $result->magni = $row['magni'];
            $result->mail_reception = $row['mail_reception'];
            $result->is_mobile = $row['is_mobile'];
            $result->limits = $row['limits'];
            $result->regist = $row['regist'];
            $result->logout = $row['logout'];
        }
    } catch (PDOException $e) {
        $errorMessage = 'DATABASE ERROR';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
    return $result;
}

function getNuserByMail($mail)
{
    try {
        $result = new cls_nuser();
        require 'dns.php';
        $stmt = $pdo->prepare("SELECT * FROM `nuser` WHERE delete_key=0 AND mail=:mail");
        $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        if ($row = $stmt->fetch()) {
            $result->delete_key = $row['delete_key'];
            $result->id = $row['id'];
            $result->name = $row['name'];
            $result->zip1 = $row['zip1'];
            $result->zip2 = $row['zip2'];
            $result->adds = $row['adds'];
            $result->add_sub = $row['add_sub'];
            $result->tel = $row['tel'];
            $result->fax = $row['fax'];
            $result->url = $row['url'];
            $result->mail = $row['mail'];
            $result->bank_code = $row['bank_code'];
            $result->bank = $row['bank'];
            $result->branch_code = $row['branch_code'];
            $result->branch = $row['branch'];
            $result->bank_type = $row['bank_type'];
            $result->number = $row['number'];
            $result->bank_name = $row['bank_name'];
            $result->parent = $row['parent'];
            $result->grandparent = $row['grandparent'];
            $result->greatgrandparent = $row['greatgrandparent'];
            $result->pass = $row['pass'];
            $result->terminal = $row['terminal'];
            $result->activate = $row['activate'];
            $result->pay = $row['pay'];
            $result->tier = $row['tier'];
            $result->rank = $row['rank'];
            $result->personal_rate = $row['personal_rate'];
            $result->magni = $row['magni'];
            $result->mail_reception = $row['mail_reception'];
            $result->is_mobile = $row['is_mobile'];
            $result->limits = $row['limits'];
            $result->regist = $row['regist'];
            $result->logout = $row['logout'];
        }
    } catch (PDOException $e) {
        $errorMessage = 'DATABASE ERROR';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
    return $result;
}

function getNuserByPay($pay)
{
    try {
        $results = array();
        require 'dns.php';
        $stmt = $pdo->prepare("SELECT * FROM `nuser` WHERE delete_key=0 AND pay>=:pay");
        $stmt->bindParam(':pay', $pay, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new cls_nuser();
            $result->delete_key = $row['delete_key'];
            $result->id = $row['id'];
            $result->name = $row['name'];
            $result->zip1 = $row['zip1'];
            $result->zip2 = $row['zip2'];
            $result->adds = $row['adds'];
            $result->add_sub = $row['add_sub'];
            $result->tel = $row['tel'];
            $result->fax = $row['fax'];
            $result->url = $row['url'];
            $result->mail = $row['mail'];
            $result->bank_code = $row['bank_code'];
            $result->bank = $row['bank'];
            $result->branch_code = $row['branch_code'];
            $result->branch = $row['branch'];
            $result->bank_type = $row['bank_type'];
            $result->number = $row['number'];
            $result->bank_name = $row['bank_name'];
            $result->parent = $row['parent'];
            $result->grandparent = $row['grandparent'];
            $result->greatgrandparent = $row['greatgrandparent'];
            $result->pass = $row['pass'];
            $result->terminal = $row['terminal'];
            $result->activate = $row['activate'];
            $result->pay = $row['pay'];
            $result->tier = $row['tier'];
            $result->rank = $row['rank'];
            $result->personal_rate = $row['personal_rate'];
            $result->magni = $row['magni'];
            $result->mail_reception = $row['mail_reception'];
            $result->is_mobile = $row['is_mobile'];
            $result->limits = $row['limits'];
            $result->regist = $row['regist'];
            $result->logout = $row['logout'];
            array_push($results, $result);
        }
    } catch (PDOException $e) {
        $errorMessage = 'DATABASE ERROR';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
    return $results;
}

function countNUserByMail($mail)
{
    $cnt=0;
    try {
        require 'dns.php';
        $stmt = $pdo->prepare("SELECT count(*) as cnt FROM `nuser` WHERE mail=:mail AND delete_key=0");
        $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
        $stmt->execute();
        if ($row = $stmt->fetch()) {
            $cnt = $row['cnt'];
        }
    } catch (PDOException $e) {
        //
    }
    return $cnt;
}

function countNUserByMailOthers($mail, $id)
{
    $cnt=0;
    try {
        require 'dns.php';
        $stmt = $pdo->prepare("SELECT count(*) as cnt FROM `nuser` WHERE mail=:mail AND delete_key=0 AND id<>:id");
        $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        if ($row = $stmt->fetch()) {
            $cnt = $row['cnt'];
        }
    } catch (PDOException $e) {
        //
    }
    return $cnt;
}

function getNUserNextId()
{
    $id=0;
    try {
        require 'dns.php';
        $stmt = $pdo->prepare("select IFNULL(MAX(shadow_id),0)+1 as nxtid from nuser");
        $stmt->execute();
        if ($row = $stmt->fetch()) {
            $id = $row['nxtid'];
        }
    } catch (PDOException $e) {
        //
    }
    return $id;
}


function insertNuser($nuser)
{
    try {
        $insertid = 0;
        $nuser->shadow_id = getNUserNextId();
        $nuser->id =  "N".sprintf('%07d', $nuser->shadow_id);
        $dt = strtotime("now");
        require 'dns.php';
        $sql = "INSERT  INTO `nuser` (`shadow_id`,  `delete_key`,  `id`,  `name`,  `zip1`,  `zip2`,  `adds`,  `add_sub`,  `tel`,  `fax`,  `url`,  `mail`,  `bank_code`,  `bank`,  `branch_code`,  `branch`,  `bank_type`,  `number`,  `bank_name`,  `parent`,  `grandparent`,  `greatgrandparent`,  `pass`,`terminal`,  `activate`,  `pay`,  `tier`,  `rank`,  `personal_rate`,  `magni`,  `mail_reception`,  `is_mobile`,  `limits`,  `regist`,  `logout`) VALUES (:shadow_id, 0, :id, :name, :zip1, :zip2, :adds, :add_sub, :tel, :fax, :url, :mail, :bank_code, :bank, :branch_code, :branch, :bank_type, :number, :bank_name, '', '', '', :pass, '', '1', 0, 0, 'SA01', 5, 100,'', 0, 0, :regist, :logout)";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':shadow_id', $nuser->shadow_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $nuser->id, PDO::PARAM_STR);
        $stmt->bindParam(':name', $nuser->name, PDO::PARAM_STR);
        $stmt->bindParam(':zip1', $nuser->zip1, PDO::PARAM_STR);
        $stmt->bindParam(':zip2', $nuser->zip2, PDO::PARAM_STR);
        $stmt->bindParam(':adds', $nuser->adds, PDO::PARAM_STR);
        $stmt->bindParam(':add_sub', $nuser->add_sub, PDO::PARAM_STR);
        $stmt->bindParam(':tel', $nuser->tel, PDO::PARAM_STR);
        $stmt->bindParam(':fax', $nuser->fax, PDO::PARAM_STR);
        $stmt->bindParam(':url', $nuser->url, PDO::PARAM_STR);
        $stmt->bindParam(':mail', $nuser->mail, PDO::PARAM_STR);
        $stmt->bindParam(':bank_code', $nuser->bank_code, PDO::PARAM_STR);
        $stmt->bindParam(':bank', $nuser->bank, PDO::PARAM_STR);
        $stmt->bindParam(':branch_code', $nuser->branch_code, PDO::PARAM_STR);
        $stmt->bindParam(':branch', $nuser->branch, PDO::PARAM_STR);
        $stmt->bindParam(':bank_type', $nuser->bank_type, PDO::PARAM_STR);
        $stmt->bindParam(':number', $nuser->number, PDO::PARAM_STR);
        $stmt->bindParam(':bank_name', $nuser->bank_name, PDO::PARAM_STR);
        $newPw = 'AES_OK:'.$nuser->pass;
        $stmt->bindParam(':pass', $newPw, PDO::PARAM_STR);
        $stmt->bindParam(':regist', $dt, PDO::PARAM_INT);
        $stmt->bindParam(':logout', $dt, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
//        $stmt->execute();

        $insertid = $pdo->lastInsertId();

        if ($stmt->rowCount()==0) {
            logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
            logging("INSERT ERROR : ". $sql);
            logging("ARGS : ". json_encode(func_get_args()));
        }
    } catch (PDOException $e) {
        $errorMessage = 'DATABASE ERROR';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
    return $nuser->id;
}

function updateNuserB($nuser)
{
    try {
        require 'dns.php';
        $sql = " UPDATE `nuser` SET  `name`=:name,  `zip1`=:zip1,  `zip2`=:zip2,  `adds`=:adds,  `add_sub`=:add_sub,  `tel`=:tel,  `fax`=:fax,  `url`=:url WHERE id=:id";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':id', $nuser->id, PDO::PARAM_STR);
        $stmt->bindParam(':name', $nuser->name, PDO::PARAM_STR);
        $stmt->bindParam(':zip1', $nuser->zip1, PDO::PARAM_STR);
        $stmt->bindParam(':zip2', $nuser->zip2, PDO::PARAM_STR);
        $stmt->bindParam(':adds', $nuser->adds, PDO::PARAM_STR);
        $stmt->bindParam(':add_sub', $nuser->add_sub, PDO::PARAM_STR);
        $stmt->bindParam(':tel', $nuser->tel, PDO::PARAM_STR);
        $stmt->bindParam(':fax', $nuser->fax, PDO::PARAM_STR);
        $stmt->bindParam(':url', $nuser->url, PDO::PARAM_STR);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

        if ($stmt->rowCount()==0) {
            logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
            logging("UPDATE ERROR : ". $sql);
            logging("ARGS : ". json_encode(func_get_args()));
        }
    } catch (PDOException $e) {
        $errorMessage = 'DATABASE ERROR';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
}

function updateNuserC($nuser)
{
    try {
        require 'dns.php';
        $sql = " UPDATE `nuser` SET  `bank_code`=:bank_code,  `bank`=:bank,  `branch_code`=:branch_code,  `branch`=:branch,  `bank_type`=:bank_type,  `number`=:number,  `bank_name`=:bank_name WHERE id=:id";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':id', $nuser->id, PDO::PARAM_STR);
        $stmt->bindParam(':bank_code', $nuser->bank_code, PDO::PARAM_STR);
        $stmt->bindParam(':bank', $nuser->bank, PDO::PARAM_STR);
        $stmt->bindParam(':branch_code', $nuser->branch_code, PDO::PARAM_STR);
        $stmt->bindParam(':branch', $nuser->branch, PDO::PARAM_STR);
        $stmt->bindParam(':bank_type', $nuser->bank_type, PDO::PARAM_STR);
        $stmt->bindParam(':number', $nuser->number, PDO::PARAM_STR);
        $stmt->bindParam(':bank_name', $nuser->bank_name, PDO::PARAM_STR);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

        if ($stmt->rowCount()==0) {
            logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
            logging("UPDATE ERROR : ". $sql);
            logging("ARGS : ". json_encode(func_get_args()));
        }
    } catch (PDOException $e) {
        $errorMessage = 'DATABASE ERROR';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
}

function updateNuserBasic($nuser)
{
    try {
        require 'dns.php';
        if (empty($nuser->pass)) {
            $stmt = $pdo -> prepare("UPDATE `nuser` SET `name`=:name, `zip1`=:zip1, `zip2`=:zip2, `adds`=:adds, `add_sub`=:add_sub, `tel`=:tel WHERE id=:id");
        } else {
            $stmt = $pdo -> prepare("UPDATE `nuser` SET `pass`=:pass, `name`=:name, `zip1`=:zip1, `zip2`=:zip2, `adds`=:adds, `add_sub`=:add_sub,  `tel`=:tel WHERE id=:id");
            $stmt->bindParam(':pass', $nuser->pass, PDO::PARAM_STR);
        }
        $stmt->bindParam(':id', $nuser->id, PDO::PARAM_STR);
        $stmt->bindParam(':name', $nuser->name, PDO::PARAM_STR);
        $stmt->bindParam(':zip1', $nuser->zip1, PDO::PARAM_STR);
        $stmt->bindParam(':zip2', $nuser->zip2, PDO::PARAM_STR);
        $stmt->bindParam(':adds', $nuser->adds, PDO::PARAM_STR);
        $stmt->bindParam(':add_sub', $nuser->add_sub, PDO::PARAM_STR);
        $stmt->bindParam(':tel', $nuser->tel, PDO::PARAM_STR);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

        if ($stmt->rowCount()==0) {
            logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
            logging("UPDATE ERROR : ". $sql);
            logging("ARGS : ". json_encode(func_get_args()));
        }
    } catch (PDOException $e) {
        $errorMessage = 'DATABASE ERROR';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
}

function updateNuserBank($nuser)
{
    try {
        require 'dns.php';
        $sql = "UPDATE `nuser` SET `bank`=:bank, `branch`=:branch, `bank_type`=:bank_type,  `number`=:number,  `bank_name`=:bank_name WHERE id=:id";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':id', $nuser->id, PDO::PARAM_STR);
        $stmt->bindParam(':bank', $nuser->bank, PDO::PARAM_STR);
        $stmt->bindParam(':branch', $nuser->branch, PDO::PARAM_STR);
        $stmt->bindParam(':bank_type', $nuser->bank_type, PDO::PARAM_STR);
        $stmt->bindParam(':number', $nuser->number, PDO::PARAM_STR);
        $stmt->bindParam(':bank_name', $nuser->bank_name, PDO::PARAM_STR);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

        if ($stmt->rowCount()==0) {
            logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
            logging("UPDATE ERROR : ". $sql);
            logging("ARGS : ". json_encode(func_get_args()));
        }
    } catch (PDOException $e) {
        $errorMessage = 'DATABASE ERROR';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
}

function withdrawalNuser($nId)
{
    try {
        require 'dns.php';
        $sql = "UPDATE `nuser` SET delete_key=1 WHERE id=:id";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':id', $nId, PDO::PARAM_STR);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

        if ($stmt->rowCount()==0) {
            logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
            logging("UPDATE ERROR : ". $sql);
            logging("ARGS : ". json_encode(func_get_args()));
        }
    } catch (PDOException $e) {
        $errorMessage = 'DATABASE ERROR';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
}

function updateNuserActivate($nId, $stts)
{
    try {
        require 'dns.php';
        $sql = "UPDATE `nuser` SET `activate`=:activate WHERE id=:id";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':id', $nId, PDO::PARAM_STR);
        $stmt->bindParam(':activate', $stts, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

        if ($stmt->rowCount()==0) {
            logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
            logging("UPDATE ERROR : ". $sql);
            logging("ARGS : ". json_encode(func_get_args()));
        }
    } catch (PDOException $e) {
        $errorMessage = 'DATABASE ERROR';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
}
// function updateNuser($nuser)
// {
//     try {
//         require 'dns.php';
//         $sql = " UPDATE `nuser`  SET  `delete_key`=:delete_key,  `id`=:id,  `name`=:name,  `zip1`=:zip1,  `zip2`=:zip2,  `adds`=:adds,  `add_sub`=:add_sub,  `tel`=:tel,  `fax`=:fax,  `url`=:url,  `mail`=:mail,  `bank_code`=:bank_code,  `bank`=:bank,  `branch_code`=:branch_code,  `branch`=:branch,  `bank_type`=:bank_type,  `number`=:number,  `bank_name`=:bank_name,  `parent`=:parent,  `grandparent`=:grandparent,  `greatgrandparent`=:greatgrandparent,  `pass`=:pass,  `terminal`=:terminal,  `activate`=:activate,  `pay`=:pay,  `tier`=:tier,  `rank`=:rank,  `personal_rate`=:personal_rate,  `magni`=:magni,  `mail_reception`=:mail_reception,  `is_mobile`=:is_mobile,  `limits`=:limits,  `regist`=:regist,  `logout`=:logout WHERE shadow_id=:shadow_id";
//         $stmt = $pdo -> prepare($sql);
//         $stmt->bindParam(':shadow_id', $nuser->shadow_id, PDO::PARAM_INT);
//         $stmt->bindParam(':delete_key', $nuser->delete_key, PDO::PARAM_INT);
//         $stmt->bindParam(':id', $nuser->id, PDO::PARAM_STR);
//         $stmt->bindParam(':name', $nuser->name, PDO::PARAM_STR);
//         $stmt->bindParam(':zip1', $nuser->zip1, PDO::PARAM_STR);
//         $stmt->bindParam(':zip2', $nuser->zip2, PDO::PARAM_STR);
//         $stmt->bindParam(':adds', $nuser->adds, PDO::PARAM_STR);
//         $stmt->bindParam(':add_sub', $nuser->add_sub, PDO::PARAM_STR);
//         $stmt->bindParam(':tel', $nuser->tel, PDO::PARAM_STR);
//         $stmt->bindParam(':fax', $nuser->fax, PDO::PARAM_STR);
//         $stmt->bindParam(':url', $nuser->url, PDO::PARAM_STR);
//         $stmt->bindParam(':mail', $nuser->mail, PDO::PARAM_STR);
//         $stmt->bindParam(':bank_code', $nuser->bank_code, PDO::PARAM_STR);
//         $stmt->bindParam(':bank', $nuser->bank, PDO::PARAM_STR);
//         $stmt->bindParam(':branch_code', $nuser->branch_code, PDO::PARAM_STR);
//         $stmt->bindParam(':branch', $nuser->branch, PDO::PARAM_STR);
//         $stmt->bindParam(':bank_type', $nuser->bank_type, PDO::PARAM_STR);
//         $stmt->bindParam(':number', $nuser->number, PDO::PARAM_STR);
//         $stmt->bindParam(':bank_name', $nuser->bank_name, PDO::PARAM_STR);
//         $stmt->bindParam(':parent', $nuser->parent, PDO::PARAM_STR);
//         $stmt->bindParam(':grandparent', $nuser->grandparent, PDO::PARAM_STR);
//         $stmt->bindParam(':greatgrandparent', $nuser->greatgrandparent, PDO::PARAM_STR);
//         $stmt->bindParam(':pass', $nuser->pass, PDO::PARAM_STR);
//         $stmt->bindParam(':terminal', $nuser->terminal, PDO::PARAM_STR);
//         $stmt->bindParam(':activate', $nuser->activate, PDO::PARAM_STR);
//         $stmt->bindParam(':pay', $nuser->pay, PDO::PARAM_STR);
//         $stmt->bindParam(':tier', $nuser->tier, PDO::PARAM_STR);
//         $stmt->bindParam(':rank', $nuser->rank, PDO::PARAM_STR);
//         $stmt->bindParam(':personal_rate', $nuser->personal_rate, PDO::PARAM_STR);
//         $stmt->bindParam(':magni', $nuser->magni, PDO::PARAM_STR);
//         $stmt->bindParam(':mail_reception', $nuser->mail_reception, PDO::PARAM_STR);
//         $stmt->bindParam(':is_mobile', $nuser->is_mobile, PDO::PARAM_STR);
//         $stmt->bindParam(':limits', $nuser->limits, PDO::PARAM_STR);
//         $stmt->bindParam(':regist', $nuser->regist, PDO::PARAM_STR);
//         $stmt->bindParam(':logout', $nuser->logout, PDO::PARAM_STR);
//         $stmt->execute();
//     } catch (PDOException $e) {
//         $errorMessage = 'DATABASE ERROR';
//         if (strcmp("1", $ini['debug'])==0) {
//             echo $e->getMessage();
//         }
//     }
// }



class cls_nuser_x10
{
    public $id ;
    public $nickname ;
    public $instagram ;
    public $facebook ;
    public $twitter ;
    public $youtube ;
    public $kubun ;
    public $kana ;
    public $birthday ;
}

function getNuserX10($nId)
{
    try {
        $result = new cls_nuser();
        require 'dns.php';
        $stmt = $pdo->prepare("SELECT * FROM `x10_nuser` WHERE id=:id");
        $stmt->bindParam(':id', $nId, PDO::PARAM_STR);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        if ($row = $stmt->fetch()) {
            $result->id = $row['id'];
            $result->nickname = $row['nickname'];
            $result->instagram = $row['instagram'];
            $result->facebook = $row['facebook'];
            $result->twitter = $row['twitter'];
            $result->youtube = $row['youtube'];
            $result->kubun = $row['kubun'];
            $result->kana = $row['kana'];
            $result->birthday = $row['birthday'];
        }
    } catch (PDOException $e) {
        $errorMessage = 'DATABASE ERROR';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
    return $result;
}

function getNuserSNS($nId)
{
    try {
        require 'dns.php';
        $stmt = $pdo->prepare("SELECT * FROM `x10_nuser` WHERE id=:id");
        $stmt->bindParam(':id', $nId, PDO::PARAM_STR);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        $sns = "";
        if ($row = $stmt->fetch()) {
            $sns2 = empty($row['instagram']) ? '' : "instagram:https://www.instagram.com/".$row['instagram']."\n";
            $sns2 .= empty($row['facebook']) ? '' : "facebook:https://www.facebook.com/".$row['facebook']."\n";
            $sns2 .= empty($row['twitter']) ? '' : "twitter:https://twitter.com/".$row['twitter']."\n";
            $sns2 .= empty($row['youtube']) ? '' : "youtube:https://www.youtube.com/channel/".$row['youtube']."\n";
            $sns .= empty($sns2) ? "SNSアカウントは設定されていません" : $sns2;
        }
    } catch (PDOException $e) {
        $errorMessage = 'DATABASE ERROR';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
    return $sns;
}

function countNuserX10($nId)
{
    try {
        $result =0;
        require 'dns.php';
        $stmt = $pdo->prepare("SELECT count(*) as cnt FROM `x10_nuser` WHERE id=:id");
        $stmt->bindParam(':id', $nId, PDO::PARAM_STR);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        if ($row = $stmt->fetch()) {
            $result= $row['cnt'];
        }
    } catch (PDOException $e) {
        $errorMessage = 'DATABASE ERROR';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
    return $result;
}

function insertNuserX10($nuser)
{
    try {
        require 'dns.php';
        $sql = "INSERT INTO `x10_nuser`(`id`, `nickname`, `instagram`, `facebook`, `twitter`, `youtube`, `kubun`,`kana`,`birthday`) VALUES (:id, :nickname, :instagram, :facebook, :twitter, :youtube, :kubun, :kana, :birthday)";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':id', $nuser->id, PDO::PARAM_STR);
        $stmt->bindParam(':nickname', $nuser->nickname, PDO::PARAM_STR);
        $stmt->bindParam(':instagram', $nuser->instagram, PDO::PARAM_STR);
        $stmt->bindParam(':facebook', $nuser->facebook, PDO::PARAM_STR);
        $stmt->bindParam(':twitter', $nuser->twitter, PDO::PARAM_STR);
        $stmt->bindParam(':youtube', $nuser->youtube, PDO::PARAM_STR);
        $stmt->bindParam(':kubun', $nuser->kubun, PDO::PARAM_INT);
        $stmt->bindParam(':kana', $nuser->kana, PDO::PARAM_STR);
        $stmt->bindParam(':birthday', $nuser->birthday, PDO::PARAM_STR);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

        if ($stmt->rowCount()==0) {
            logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
            logging("INSERT ERROR : ". $sql);
            logging("ARGS : ". json_encode(func_get_args()));
        }
    } catch (PDOException $e) {
        $errorMessage = 'DATABASE ERROR';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
    return $insertid;
}

function updateNuserX10($nuser)
{
    try {
        require 'dns.php';
        $sql = "UPDATE `x10_nuser` SET `nickname`=:nickname, `instagram`=:instagram, `facebook`=:facebook, `twitter`=:twitter, `youtube`=:youtube, `kubun`=:kubun, `kana`=:kana, `birthday`=:birthday  WHERE `id`=:id";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':id', $nuser->id, PDO::PARAM_STR);
        $stmt->bindParam(':nickname', $nuser->nickname, PDO::PARAM_STR);
        $stmt->bindParam(':instagram', $nuser->instagram, PDO::PARAM_STR);
        $stmt->bindParam(':facebook', $nuser->facebook, PDO::PARAM_STR);
        $stmt->bindParam(':twitter', $nuser->twitter, PDO::PARAM_STR);
        $stmt->bindParam(':youtube', $nuser->youtube, PDO::PARAM_STR);
        $stmt->bindParam(':kubun', $nuser->kubun, PDO::PARAM_INT);
        $stmt->bindParam(':kana', $nuser->kana, PDO::PARAM_STR);
        $stmt->bindParam(':birthday', $nuser->birthday, PDO::PARAM_STR);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

        if ($stmt->rowCount()==0) {
            logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
            logging("UPDATE ERROR : ". $sql);
            logging("ARGS : ". json_encode(func_get_args()));
        }
    } catch (PDOException $e) {
        $errorMessage = 'DATABASE ERROR';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
    return $insertid;
}

function updateNuserX10Kubun($nuserId, $kubun, $kana, $birthday)
{
    try {
        require 'dns.php';
        $sql = "UPDATE `x10_nuser` SET `kubun`=:kubun, `kana`=:kana, `birthday`=:birthday  WHERE `id`=:id";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':id', $nuserId, PDO::PARAM_STR);
        $stmt->bindParam(':kubun', $kubun, PDO::PARAM_INT);
        $stmt->bindParam(':kana', $kana, PDO::PARAM_STR);
        $stmt->bindParam(':birthday', $birthday, PDO::PARAM_STR);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

        if ($stmt->rowCount()==0) {
            logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
            logging("UPDATE ERROR : ". $sql);
            logging("ARGS : ". json_encode(func_get_args()));
        }
    } catch (PDOException $e) {
        $errorMessage = 'DATABASE ERROR';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
}

function updateNuserX10sns($nuser)
{
    try {
        require 'dns.php';
        $sql = "UPDATE `x10_nuser` SET `nickname`=:nickname, `instagram`=:instagram, `facebook`=:facebook, `twitter`=:twitter, `youtube`=:youtube  WHERE `id`=:id";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':id', $nuser->id, PDO::PARAM_STR);
        $stmt->bindParam(':nickname', $nuser->nickname, PDO::PARAM_STR);
        $stmt->bindParam(':instagram', $nuser->instagram, PDO::PARAM_STR);
        $stmt->bindParam(':facebook', $nuser->facebook, PDO::PARAM_STR);
        $stmt->bindParam(':twitter', $nuser->twitter, PDO::PARAM_STR);
        $stmt->bindParam(':youtube', $nuser->youtube, PDO::PARAM_STR);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

        if ($stmt->rowCount()==0) {
            logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
            logging("UPDATE ERROR : ". $sql);
            logging("ARGS : ". json_encode(func_get_args()));
        }
    } catch (PDOException $e) {
        $errorMessage = 'DATABASE ERROR';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
    return $insertid;
}
