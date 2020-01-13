<?php

class cls_serials
{
    public $s_seq ;
    public $s_title ;
    public $s_qty ;
    public $createdt ;
    public $users_seq ;
}

class cls_serialcodes
{
    public $sc_seq ;
    public $s_seq ;
    public $sc_code ;
    public $entrydt ;
    public $sc_point ;
    public $m_seq ;
}

class cls_v_serialcodes
{
    public $s_seq ;
    public $s_title ;
    public $s_qty ;
    public $createdt ;
    public $sc_code ;
    public $entrydt ;
    public $sc_point ;
    public $m_seq ;
    public $m_name ;
}

function getSerials()
{
    try {
        $results = array();
        require './db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM  `serials` ORDER BY createdt desc");
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new cls_serials();
            $result->s_seq = $row['s_seq'];
            $result->s_title = $row['s_title'];
            $result->s_qty = $row['s_qty'];
            $result->createdt = $row['createdt'];
            $result->users_seq = $row['users_seq'];
            array_push($results, $result);
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
    return $results;
}

function getSerial($sSeq)
{
    try {
        $result = new cls_serials();
        require './db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM `serials` WHERE s_seq=:s_seq");
        $stmt->bindParam(':s_seq', $sSeq, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        if ($row = $stmt->fetch()) {
            $result->s_seq = $row['s_seq'];
            $result->s_title = $row['s_title'];
            $result->s_qty = $row['s_qty'];
            $result->createdt = $row['createdt'];
            $result->users_seq = $row['users_seq'];
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
    return $result;
}

function getSerialOnToday()
{
    try {
        $cnt = 0;
        require './db/dns.php';
        $stmt = $pdo->prepare("SELECT count(*) as cnt FROM `serials` WHERE createdt>=:createdt");
        $stmt->bindParam(':createdt', date('Y/m/d 00:00:00'), PDO::PARAM_STR);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        if ($row = $stmt->fetch()) {
            $cnt = $row['cnt'];
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
    return $cnt;
}


function countSCodes($sSeq)
{
    $cnt=0;
    try {
        require './db/dns.php';
        $sql = " SELECT count(*) AS cnt FROM `serialcodes`WHERE entrydt IS NOT NULL AND s_seq=:s_seq";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':s_seq', $sSeq, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        if ($row = $stmt->fetch()) {
            $cnt = $row['cnt'];
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
    return $cnt;
}


function countVSCodes($where)
{
    $cnt=0;
    try {
        require './db/dns.php';
        $sql = " SELECT count(*) AS cnt FROM `v_serialcodes`".$where;
        $stmt = $pdo -> prepare($sql);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        if ($row = $stmt->fetch()) {
            $cnt = $row['cnt'];
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
    return $cnt;
}


function getMySCodes($mSeq)
{
    try {
        $results = array();
        require './db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM `v_serialcodes` WHERE m_seq=:m_seq ORDER BY entrydt desc");
        $stmt->bindParam(':m_seq', $mSeq, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new cls_v_serialcodes();
            $result->s_seq = $row['s_seq'];
            $result->s_title = $row['s_title'];
            $result->s_qty = $row['s_qty'];
            $result->createdt = $row['createdt'];
            $result->users_seq = $row['users_seq'];
            $result->sc_seq = $row['sc_seq'];
            $result->sc_code = $row['sc_code'];
            $result->entrydt = $row['entrydt'];
            $result->sc_point = $row['sc_point'];
            $result->m_seq = $row['m_seq'];
            $result->m_name = $row['m_name'];
            array_push($results, $result);
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
    return $results;
}


function getSCodesLimit($limit, $offset, $where)
{
    try {
        $results = array();
        require './db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM `v_serialcodes` ".$where.' ORDER BY sc_seq LIMIT :lmt OFFSET :ofst');
        $stmt->bindParam(':lmt', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':ofst', $offset, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new cls_v_serialcodes();
            $result->s_seq = $row['s_seq'];
            $result->s_title = $row['s_title'];
            $result->s_qty = $row['s_qty'];
            $result->createdt = $row['createdt'];
            $result->users_seq = $row['users_seq'];
            $result->sc_seq = $row['sc_seq'];
            $result->sc_code = $row['sc_code'];
            $result->entrydt = $row['entrydt'];
            $result->sc_point = $row['sc_point'];
            $result->m_seq = $row['m_seq'];
            $result->m_name = $row['m_name'];
            array_push($results, $result);
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
    return $results;
}


function insertSerials($serials)
{
    try {
        require './db/dns.php';
        $sql = "INSERT  INTO `serials` ( `s_title`, `s_qty`, `users_seq`) VALUES (:s_title, :s_qty, :users_seq)";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':s_title', $serials->s_title, PDO::PARAM_STR);
        $stmt->bindParam(':s_qty', $serials->s_qty, PDO::PARAM_INT);
        $stmt->bindParam(':users_seq', $serials->users_seq, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);


        if ($stmt->rowCount()==0) {
            logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
            logging("INSERT ERROR : ". $sql);
            logging("ARGS : ". json_encode(func_get_args()));
        } else {
            $insertid = $pdo->lastInsertId();
            $stmt->closeCursor();

            $fp = fopen("./".getSsn('PATH_SCODE')."/".$insertid.".csv", "w");

            //シリアルコード生成
            //YY/MM/DDを取得する
            $ymd = substr(date("Ymd"), 2);

            //指定回数をLOOPする
            for ($i = 1; $i <= $serials->s_qty; $i++) {
                //LOOP回数の１桁だけ使用する（キーコード）
                $j = substr($i, -1);
                //LOOP回数を０埋めし５桁にする
                $num = sprintf('%05d', $i);
                //日付とカウントを配列化する
                $tmp1 = str_split($ymd);
                $tmp2 = str_split($num);
                //サンドする
                $tmp3 = $tmp1[0].$tmp2[0].$tmp1[1].$tmp2[1].$tmp1[2].$tmp2[2].$tmp1[3].$tmp2[3].$tmp1[4].$tmp2[4].$tmp1[5];
                //文字列を配列化する
                $tmp4 = str_split($tmp3);
                //各桁にキーコードを加算する
                $tmp5 = "";
                foreach ($tmp4 as $tmpA) {
                    //10を超える場合は、下１桁だけ使用する
                    $tmp5 .= substr($tmpA+$j, -1);
                }
                //キーコード分だけ文字を入れ替え、末尾にキーコードを付与する
                if ($j==0) {
                    $sCode = $tmp3 . $j;
                } else {
                    $sCode = substr($tmp5, -1 *$j) . substr($tmp5, 0, 11-$j) . $j;
                }

                $sql = "INSERT INTO `serialcodes` (`s_seq`, `sc_code`) VALUES (:s_seq,:sc_code)";
                $stmt = $pdo -> prepare($sql);
                $stmt->bindParam(':s_seq', $insertid, PDO::PARAM_INT);
                $stmt->bindParam(':sc_code', $sCode, PDO::PARAM_STR);
                execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

                if ($stmt->rowCount()==0) {
                    logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
                    logging("INSERT ERROR : ". $sql);
                    logging("ARGS : ". json_encode(func_get_args()));
                } else {
                    $stmt->closeCursor();
                    fwrite($fp, $sCode. "\r\n");
                }
            }

            fclose($fp);
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
    return $errorMessage ;
}

function updateSerials($serials)
{
    try {
        require './db/dns.php';
        $sql = " UPDATE `serials` SET  `s_title`=:s_title,editdt=NOW() WHERE s_seq=:s_seq";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':s_seq', $serials->s_seq, PDO::PARAM_INT);
        $stmt->bindParam(':s_title', $serials->s_title, PDO::PARAM_STR);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

        if ($stmt->rowCount()==0) {
            logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
            logging("UPDATE ERROR : ". $sql);
            logging("ARGS : ". json_encode(func_get_args()));
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
}


function deleteSerials($sSeq)
{
    $cnt=0;
    try {
        require './db/dns.php';
        $sql = " DELETE FROM `serials`WHERE s_seq=:s_seq";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':s_seq', $sSeq, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

        $sql = " DELETE FROM `serialcodes`WHERE s_seq=:s_seq";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':s_seq', $sSeq, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
    return $cnt;
}
