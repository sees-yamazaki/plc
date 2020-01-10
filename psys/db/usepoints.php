<?php

class cls_usepoints
{
    public $up_seq;
    public $m_seq;
    public $up_point;
    public $createdt;
    public $up_status;
    public $g_seq;
    public $p_seq;
    public $pz_seq;
}

function countUsepointsByPseq($pSeq)
{
    try {
        $cnt = 0;
        require './db/dns.php';
        $stmt = $pdo->prepare('SELECT count(*) as cnt FROM `usepoints` WHERE p_seq=:p_seq');
        $stmt->bindParam(':p_seq', $pSeq, PDO::PARAM_INT);
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

    function countUsepointsByPzseq($pzSeq)
    {
        try {
            $cnt = 0;
            require './db/dns.php';
            $stmt = $pdo->prepare('SELECT count(*) as cnt FROM `usepoints` WHERE pz_seq=:pz_seq');
            $stmt->bindParam(':pz_seq', $pzSeq, PDO::PARAM_INT);
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

    function insertUsepoints($usepoints)
    {
        $id = 0;
        try {
            require './db/dns.php';
            $sql = 'INSERT  INTO `usepoints` (  `m_seq`,  `up_point`,  `up_status`,  `g_seq`,  `p_seq`,  `pz_seq`) VALUES (:m_seq, :up_point, :up_status, :g_seq, :p_seq, :pz_seq)';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':m_seq', $usepoints->m_seq, PDO::PARAM_INT);
            $stmt->bindParam(':up_point', $usepoints->up_point, PDO::PARAM_INT);
            $stmt->bindParam(':up_status', $usepoints->up_status, PDO::PARAM_INT);
            $stmt->bindParam(':g_seq', $usepoints->g_seq, PDO::PARAM_INT);
            $stmt->bindParam(':p_seq', $usepoints->p_seq, PDO::PARAM_INT);
            $stmt->bindParam(':pz_seq', $usepoints->pz_seq, PDO::PARAM_INT);
            execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

            $id = $pdo->lastInsertId();


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

        return $id;
    }


    function getUnShip($mSeq)
    {

        try {

            $results = array();
            require './db/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM `v_unships` WHERE `m_seq`=:m_seq ORDER BY createdt");
            $stmt->bindParam(':m_seq', $mSeq, PDO::PARAM_INT);
            execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result = new cls_usepoints();
                $result->up_seq = $row['up_seq'];
                $result->m_seq = $row['m_seq'];
                $result->up_point = $row['up_point'];
                $result->createdt = $row['createdt'];
                $result->up_status = $row['up_status'];
                $result->g_seq = $row['g_seq'];
                $result->p_seq = $row['p_seq'];
                $result->pz_seq = $row['pz_seq'];
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

    
