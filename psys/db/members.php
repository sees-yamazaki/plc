<?php

class cls_members
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
    public $point;
    public $crnt_point;
    public $logindt;
    public $sc_cnt;
    public $sc_point;
    public $cnt_0;
    public $up_point_0;
    public $cnt_1;
    public $up_point_1;
    public $cnt_99;
    public $up_point_99;
}

    function getMembers()
    {
        try {
            $results = array();
            require './db/dns.php';
            $stmt = $pdo->prepare('SELECT m.*,v.point FROM  `members` m LEFT JOIN v_point v ON m.m_seq=v.m_seq ORDER BY m_seq');
            execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result = new cls_members();
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
                $result->point = $row['point'];
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

    function getMember($mSeq)
    {
        try {
            $result = new cls_members();
            require './db/dns.php';
            $stmt = $pdo->prepare('SELECT m.*,v.point,L.logindt FROM  `members` m LEFT JOIN v_point v ON m.m_seq=v.m_seq LEFT JOIN v_lastlogin L ON L.m_seq=m.m_seq  WHERE m.m_seq=:m_seq');
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
                $result->point = $row['point'];
                $result->logindt = $row['logindt'];
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
            logging("DATABASE ERROR : ".$e->getMessage());
            logging("ARGS : ". json_encode(func_get_args()));
        }

        return $result;
    }

    function getMemberByMial($m_mail)
    {
        try {
            $result = new cls_members();
            require './db/dns.php';
            $stmt = $pdo->prepare('SELECT m.*,v.point,L.logindt FROM  `members` m LEFT JOIN v_point v ON m.m_seq=v.m_seq LEFT JOIN v_lastlogin L ON L.m_seq=m.m_seq  WHERE m.m_mail=:m_mail');
            $stmt->bindParam(':m_mail', $m_mail, PDO::PARAM_STR);
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
                $result->point = $row['point'];
                $result->logindt = $row['logindt'];
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
            logging("DATABASE ERROR : ".$e->getMessage());
            logging("ARGS : ". json_encode(func_get_args()));
        }

        return $result;
    }

    function getMemberRows($where)
    {
        try {
            $cnt = 0;
            require './db/dns.php';
            // $stmt = $pdo->prepare('SELECT count(*) as cnt FROM ( SELECT m.*,CASE v.point IS NULL WHEN 1 THEN 0 ELSE v.point END as point,L.logindt FROM `members` m LEFT JOIN v_point v ON m.m_seq=v.m_seq LEFT JOIN v_lastlogin L ON L.m_seq=m.m_seq ) x '.$where);
            $stmt = $pdo->prepare('SELECT count(*) as cnt FROM v_members '.$where);

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

    function getMembersLimit($limit, $offset, $where)
    {
        try {
            $results = array();
            require './db/dns.php';
            $stmt = $pdo->prepare('SELECT * FROM v_members '.$where.' ORDER BY m_seq LIMIT :lmt OFFSET :ofst');

            $stmt->bindParam(':lmt', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':ofst', $offset, PDO::PARAM_INT);
            execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result = new cls_members();
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
                //$result->crnt_point = $row['crnt_point'];
                $result->sc_cnt = $row['sc_cnt'];
                $result->sc_point = $row['sc_point'];
                $result->cnt_0 = $row['cnt_0'];
                $result->up_point_0 = $row['up_point_0'];
                $result->cnt_1 = $row['cnt_1'];
                $result->up_point_1 = $row['up_point_1'];
                $result->cnt_99 = $row['cnt_99'];
                $result->up_point_99 = $row['up_point_99'];
                $result->logindt = $row['logindt'];
                $result->crnt_point = $row['sc_point'] - $row['up_point_0'] - $row['up_point_1'] - $row['up_point_99'];
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


    function loginMember($m_mail, $m_pw)
    {
        try {
            $result = new cls_members();
            require './db/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM `members` WHERE m_mail=:m_mail and m_pw=:m_pw");
            $stmt->bindParam(':m_mail', $m_mail, PDO::PARAM_STR);
            $stmt->bindParam(':m_pw', $m_pw, PDO::PARAM_STR);
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
    

    function checkMemberByMail($m_mail)
    {
        try {
            $cnt = 0;
            require './db/dns.php';
            $stmt = $pdo->prepare("SELECT count(*) as cnt FROM `members` WHERE m_mail=:m_mail");
            $stmt->bindParam(':m_mail', $m_mail, PDO::PARAM_STR);
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
    
    function getMyPoints($mSeq)
    {
        try {
            $result = new cls_members();
            require './db/dns.php';
            $stmt = $pdo->prepare('SELECT * FROM v_members WHERE m_seq=:m_seq');

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
                //$result->crnt_point = $row['crnt_point'];
                $result->sc_cnt = $row['sc_cnt'];
                $result->sc_point = $row['sc_point'];
                $result->cnt_0 = $row['cnt_0'];
                $result->up_point_0 = $row['up_point_0'];
                $result->cnt_1 = $row['cnt_1'];
                $result->up_point_1 = $row['up_point_1'];
                $result->cnt_99 = $row['cnt_99'];
                $result->up_point_99 = $row['up_point_99'];
                $result->logindt = $row['logindt'];
                $result->crnt_point = $row['sc_point'] - $row['up_point_0'] - $row['up_point_1'] - $row['up_point_99'];
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
            logging("DATABASE ERROR : ".$e->getMessage());
            logging("ARGS : ". json_encode(func_get_args()));
        }

        return $result;
    }


    function insertMember($members)
    {
        try {
            require './db/dns.php';
            $sql = "INSERT  INTO `members` (  `m_id`,  `m_pw`,  `m_name`,  `m_mail`,  `m_post`,  `m_address1`,  `m_address2`,  `m_tel`) VALUES (:m_id, :m_pw, :m_name, :m_mail, :m_post, :m_address1, :m_address2, :m_tel)";
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
    
    function updateMember($members)
    {
        try {
            require './db/dns.php';
            $sql = " UPDATE `members`  SET  `m_name`=:m_name,  `m_mail`=:m_mail,  `m_post`=:m_post,  `m_address1`=:m_address1,  `m_address2`=:m_address2,  `m_tel`=:m_tel,editdt=NOW() WHERE m_seq=:m_seq";
            $stmt = $pdo -> prepare($sql);
            $stmt->bindParam(':m_seq', $members->m_seq, PDO::PARAM_INT);
            $stmt->bindParam(':m_name', $members->m_name, PDO::PARAM_STR);
            $stmt->bindParam(':m_mail', $members->m_mail, PDO::PARAM_STR);
            $stmt->bindParam(':m_post', $members->m_post, PDO::PARAM_INT);
            $stmt->bindParam(':m_address1', $members->m_address1, PDO::PARAM_STR);
            $stmt->bindParam(':m_address2', $members->m_address2, PDO::PARAM_STR);
            $stmt->bindParam(':m_tel', $members->m_tel, PDO::PARAM_STR);
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
    
    function updatePw($m_seq, $m_pw)
    {
        try {
            require './db/dns.php';
            $sql = "UPDATE `members` SET `m_pw`=:m_pw,editdt=NOW() WHERE m_seq=:m_seq";
            $stmt = $pdo -> prepare($sql);
            $stmt->bindParam(':m_seq', $m_seq, PDO::PARAM_INT);
            $stmt->bindParam(':m_pw', $m_pw, PDO::PARAM_STR);
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
