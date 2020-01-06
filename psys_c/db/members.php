<?php

class cls_members
{
    public $m_seq ;
    public $m_id ;
    public $m_pw ;
    public $m_name ;
    public $m_mail ;
    public $m_post ;
    public $m_address1 ;
    public $m_address2 ;
    public $m_tel ;
    public $createdt ;
}
    
    function getMembers()
    {
        try {
            $results = array();
            require './db/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM  `members` ORDER BY m_seq");
            $stmt->execute();
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
                array_push($results, $result);
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (getSsnIsDebug()) {
                echo $e->getMessage();
            }
        }
        return $results;
    }
    
    function getMember($mSeq)
    {
        try {
            $result = new cls_members();
            require './db/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM `members` WHERE m_seq=:m_seq");
            $stmt->bindParam(':m_seq', $mSeq, PDO::PARAM_INT);
            $stmt->execute();
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
            if (getSsnIsDebug()) {
                echo $e->getMessage();
            }
        }
        return $result;
    }
    
    function loginMember($m_mail,$m_pw)
    {
        try {
            $result = new cls_members();
            require './db/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM `members` WHERE m_mail=:m_mail and m_pw=:m_pw" );
            $stmt->bindParam(':m_mail', $m_mail, PDO::PARAM_STR);
            $stmt->bindParam(':m_pw', $m_pw, PDO::PARAM_STR);
            $stmt->execute();
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
            if (getSsnIsDebug()) {
                echo $e->getMessage();
            }
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
            $stmt->execute();
            if ($row = $stmt->fetch()) {
                $cnt = $row['cnt'];
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (getSsnIsDebug()) {
                echo $e->getMessage();
            }
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
            $stmt->execute();
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
            if (getSsnIsDebug()) {
                echo $e->getMessage();
            }
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
            $stmt->execute();
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (getSsnIsDebug()) {
                echo $e->getMessage();
            }
        }
    }
    
    function updateMember($members)
    {
        try {
            require './db/dns.php';
            $sql = " UPDATE `members`  SET  `m_id`=:m_id,  `m_pw`=:m_pw,  `m_name`=:m_name,  `m_mail`=:m_mail,  `m_post`=:m_post,  `m_address1`=:m_address1,  `m_address2`=:m_address2,  `m_tel`=:m_tel WHERE m_seq=:m_seq";
            $stmt = $pdo -> prepare($sql);
            $stmt->bindParam(':m_seq', $members->m_seq, PDO::PARAM_INT);
            $stmt->bindParam(':m_id', $members->m_id, PDO::PARAM_STR);
            $stmt->bindParam(':m_pw', $members->m_pw, PDO::PARAM_STR);
            $stmt->bindParam(':m_name', $members->m_name, PDO::PARAM_STR);
            $stmt->bindParam(':m_mail', $members->m_mail, PDO::PARAM_STR);
            $stmt->bindParam(':m_post', $members->m_post, PDO::PARAM_INT);
            $stmt->bindParam(':m_address1', $members->m_address1, PDO::PARAM_STR);
            $stmt->bindParam(':m_address2', $members->m_address2, PDO::PARAM_STR);
            $stmt->bindParam(':m_tel', $members->m_tel, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (getSsnIsDebug()) {
                echo $e->getMessage();
            }
        }
    }
    
    function updatePw($m_seq,$m_pw)
    {
        try {
            require './db/dns.php';
            $sql = "UPDATE `members` SET `m_pw`=:m_pw WHERE m_seq=:m_seq";
            $stmt = $pdo -> prepare($sql);
            $stmt->bindParam(':m_seq', $m_seq, PDO::PARAM_INT);
            $stmt->bindParam(':m_pw', $m_pw, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (getSsnIsDebug()) {
                echo $e->getMessage();
            }
        }
    }


    ?>
