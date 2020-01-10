<?php

class cls_prizes
{
    public $pz_seq ;
    public $p_seq ;
    public $pz_order ;
    public $pz_title ;
    public $pz_img ;
    public $pz_text ;
    public $pz_hitcnt ;
    public $imgStts ;
    public $pz_nowcnt ;
}
    
    function getPrizes($pSeq)
    {
        try {
            $results = array();
            require './db/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM  `prizes` WHERE p_seq = :p_seq ORDER BY pz_order");
            $stmt->bindParam(':p_seq', $pSeq, PDO::PARAM_INT);
            execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result = new cls_prizes();
                $result->pz_seq = $row['pz_seq'];
                $result->p_seq = $row['p_seq'];
                $result->pz_order = $row['pz_order'];
                $result->pz_title = $row['pz_title'];
                $result->pz_img = $row['pz_img'];
                $result->pz_text = $row['pz_text'];
                $result->pz_hitcnt = $row['pz_hitcnt'];
                $result->pz_nowcnt = $row['pz_nowcnt'];
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
    
    function getPrize($pzSeq)
    {
        try {
            $result = new cls_prizes();
            require './db/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM `prizes` WHERE pz_seq=:pz_seq");
            $stmt->bindParam(':pz_seq', $pzSeq, PDO::PARAM_INT);
            execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
            if ($row = $stmt->fetch()) {
                $result->pz_seq = $row['pz_seq'];
                $result->p_seq = $row['p_seq'];
                $result->pz_order = $row['pz_order'];
                $result->pz_title = $row['pz_title'];
                $result->pz_img = $row['pz_img'];
                $result->pz_text = $row['pz_text'];
                $result->pz_hitcnt = $row['pz_hitcnt'];
                $result->pz_nowcnt = $row['pz_nowcnt'];
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            logging(__FILE__." : ".__METHOD__."()");
            logging("DATABASE ERROR : ".$e->getMessage());
            logging("ARGS : ". json_encode(func_get_args()));
        }
        return $result;
    }

    function countupPrize($pzSeq)
    {
        try {
            $result = new cls_prizes();
            require './db/dns.php';
            $stmt = $pdo->prepare("UPDATE `prizes` SET `pz_nowcnt` = `pz_nowcnt` + 1  WHERE pz_seq=:pz_seq");
            $stmt->bindParam(':pz_seq', $pzSeq, PDO::PARAM_INT);
            execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

            if ($stmt->rowCount()==0) {
                logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
                logging("UPDATE ERROR : ". $sql);
                logging("ARGS : ". json_encode(func_get_args()));
            } else {
                $stmt = $pdo->prepare("SELECT * FROM `v_prizes` WHERE pz_seq=:pz_seq");
                $stmt->bindParam(':pz_seq', $pzSeq, PDO::PARAM_INT);
                execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
                if ($row = $stmt->fetch()) {
                    $result->pz_seq = $row['pz_seq'];
                    $result->p_seq = $row['p_seq'];
                    $result->pz_order = $row['pz_order'];
                    $result->pz_title = $row['pz_title'];
                    $result->pz_img = $row['pz_img'];
                    $result->pz_text = $row['pz_text'];
                    $result->pz_hitcnt = $row['hc_no'];
                    $result->pz_nowcnt = $row['pz_nowcnt'];
                }
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            logging(__FILE__." : ".__METHOD__."()");
            logging("DATABASE ERROR : ".$e->getMessage());
            logging("ARGS : ". json_encode(func_get_args()));
        }
        return $result;
    }
