<?php

class cls_premembers
{
    public $m_seq;
    public $m_id;
    public $m_pw;
    public $m_name;
    public $m_mail;
    public $m_post;
    public $m_address1;
    public $m_address2;
    public $m_tel;
    public $createdt;
}

function countPreMember($mSeq)
{
    $result = 0;
    try {
        require './db/dns.php';
        $stmt = $pdo->prepare('SELECT count(*) as cnt FROM  `premembers`  WHERE m_seq=:m_seq');
        $stmt->bindParam(':m_seq', $mSeq, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        if ($row = $stmt->fetch()) {
            $result = $row['cnt'];
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }

    return $result;
}

function getPreMember($mSeq)
{
    try {
        $result = new cls_premembers();
        require './db/dns.php';
        $stmt = $pdo->prepare('SELECT * FROM  `premembers`  WHERE m_seq=:m_seq');
        $stmt->bindParam(':m_seq', $mSeq, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        if ($row = $stmt->fetch()) {
            $result->m_seq = $row['m_seq'];
            $result->m_id = $row['m_id'];
            $result->m_pw = $row['m_pw'];
            $result->m_name = $row['m_name'];
            $result->m_mail = $row['m_mail'];
            $result->m_post = $row['m_post'];
            $result->m_address1 = $row['m_address1'];
            $result->m_address2 = $row['m_address2'];
            $result->m_tel = $row['m_tel'];
            $result->createdt = $row['createdt'];
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }

    return $result;
}

    function insertPreMember($members)
    {
        $insertid = 0;
        try {
            require './db/dns.php';
            $sql = "INSERT  INTO `premembers` (  `m_id`,  `m_pw`,  `m_name`,  `m_mail`,  `m_post`,  `m_address1`,  `m_address2`,  `m_tel`) VALUES (:m_id, :m_pw, :m_name, :m_mail, :m_post, :m_address1, :m_address2, :m_tel)";
            $stmt = $pdo -> prepare($sql);
            $stmt->bindParam(':m_id', $members->m_id, PDO::PARAM_STR);
            $stmt->bindParam(':m_pw', $members->m_pw, PDO::PARAM_STR);
            $stmt->bindParam(':m_name', $members->m_name, PDO::PARAM_STR);
            $stmt->bindParam(':m_mail', $members->m_mail, PDO::PARAM_STR);
            $stmt->bindParam(':m_post', $members->m_post, PDO::PARAM_INT);
            $stmt->bindParam(':m_address1', $members->m_address1, PDO::PARAM_STR);
            $stmt->bindParam(':m_address2', $members->m_address2, PDO::PARAM_STR);
            $stmt->bindParam(':m_tel', $members->m_tel, PDO::PARAM_STR);
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
        return $insertid;
    }

    function registMember($mSeq)
    {
        try {
            require './db/dns.php';
            $sql = "INSERT INTO `members`( `m_id`, `m_pw`, `m_name`, `m_mail`, `m_post`, `m_address1`, `m_address2`, `m_tel`) SELECT `m_id`, `m_pw`, `m_name`, `m_mail`, `m_post`, `m_address1`, `m_address2`, `m_tel` FROM `premembers` WHERE `m_seq`=:m_seq;";
            $stmt = $pdo -> prepare($sql);
            $stmt->bindParam(':m_seq', $mSeq, PDO::PARAM_INT);
            execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);


            if ($stmt->rowCount()==0) {
                logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
                logging("INSERT ERROR : ". $sql);
                logging("ARGS : ". json_encode(func_get_args()));
            } else {
                $sql = "DELETE FROM `premembers` WHERE m_seq=:m_seq";
                $stmt = $pdo -> prepare($sql);
                $stmt->bindParam(':m_seq', $mSeq, PDO::PARAM_INT);
                execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

                if ($stmt->rowCount()==0) {
                    logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
                    logging("DELETE ERROR : ". $sql);
                    logging("ARGS : ". json_encode(func_get_args()));
                }
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
            logging("DATABASE ERROR : ".$e->getMessage());
            logging("ARGS : ". json_encode(func_get_args()));
        }
    }
