<?php

class cls_members
{
    public $m_seq ;
    public $m_no ;
    public $m_group ;
    public $m_position ;
    public $m_name ;
    public $m_date ;
    public $m_time ;
    public $m_flg1 ;
    public $m_flg2 ;
}
    
    function getAppMembers()
    {
        try {
            $results = array();
            require app_root('db').'/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM  `members` WHERE m_date IS NOT NULL AND m_flg1<>9 ORDER BY m_date,m_time");
            execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result = new cls_members();
                $result->m_seq = $row['m_seq'];
                $result->m_no = $row['m_no'];
                $result->m_group = $row['m_group'];
                $result->m_position = $row['m_position'];
                $result->m_name = $row['m_name'];
                $result->m_date = $row['m_date'];
                $result->m_time = $row['m_time'];
                $result->m_flg1 = $row['m_flg1'];
                $result->m_flg2 = $row['m_flg2'];
                array_push($results, $result);
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            logging(__FILE__." : ".__METHOD__."()");
            logging("DATABASE ERROR : ".$e->getMessage());
            logging("ARGS : ". json_encode(func_get_args()));
        }
        return $results;
    }

    function getGroupMembers($grp)
    {
        try {
            $results = array();
            require app_root('db').'/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM  `members` WHERE m_group=:m_group ORDER BY m_no");
            $stmt->bindParam(':m_group', $grp, PDO::PARAM_STR);
            //$stmt->execute();
            execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result = new cls_members();
                $result->m_seq = $row['m_seq'];
                $result->m_no = $row['m_no'];
                $result->m_group = $row['m_group'];
                $result->m_position = $row['m_position'];
                $result->m_name = $row['m_name'];
                $result->m_date = $row['m_date'];
                $result->m_time = $row['m_time'];
                $result->m_flg1 = $row['m_flg1'];
                $result->m_flg2 = $row['m_flg2'];
                array_push($results, $result);
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            logging(__FILE__." : ".__METHOD__."()");
            logging("DATABASE ERROR : ".$e->getMessage());
            logging("ARGS : ". json_encode(func_get_args()));
        }
        return $results;
    }
    
    function getMember($mSeq)
    {
        try {
            $result = new cls_members();
            require app_root('db').'/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM  `members` WHERE m_seq=:m_seq");
            $stmt->bindParam(':m_seq', $mSeq, PDO::PARAM_INT);
            execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
            if ($row = $stmt->fetch()) {
                $result->m_seq = $row['m_seq'];
                $result->m_no = $row['m_no'];
                $result->m_group = $row['m_group'];
                $result->m_position = $row['m_position'];
                $result->m_name = $row['m_name'];
                $result->m_date = $row['m_date'];
                $result->m_time = $row['m_time'];
                $result->m_flg1 = $row['m_flg1'];
                $result->m_flg2 = $row['m_flg2'];
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            logging(__FILE__." : ".__METHOD__."()");
            logging("DATABASE ERROR : ".$e->getMessage());
            logging("ARGS : ". json_encode(func_get_args()));
        }
        return $result;
    }
    
    
    function updateMember($member)
    {
        try {
            require app_root('db').'/dns.php';
            $sql = " UPDATE `members`  SET  `m_date`=:m_date,  `m_time`=:m_time, `m_flg1`=:m_flg1 WHERE m_seq=:m_seq";
            $stmt = $pdo -> prepare($sql);
            $stmt->bindParam(':m_seq', $member->m_seq, PDO::PARAM_INT);
            $stmt->bindParam(':m_date', $member->m_date, PDO::PARAM_STR);
            $stmt->bindParam(':m_time', $member->m_time, PDO::PARAM_STR);
            $stmt->bindParam(':m_flg1', $member->m_flg1, PDO::PARAM_INT);
            execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (strcmp("1", $ini['debug'])==0) {
                echo $e->getMessage();
            }
        }
    }

    function clearMember($mSeq)
    {
        try {
            require app_root('db').'/dns.php';
            $sql = " UPDATE `members`  SET  `m_date`=NULL,  `m_time`=NULL, `m_flg1`=0 WHERE m_seq=:m_seq";
            $stmt = $pdo -> prepare($sql);
            $stmt->bindParam(':m_seq', $mSeq, PDO::PARAM_INT);
            execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (strcmp("1", $ini['debug'])==0) {
                echo $e->getMessage();
            }
        }
    }