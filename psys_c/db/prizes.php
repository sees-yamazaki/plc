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
            $stmt->execute();
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
            if (strcmp("1", $ini['debug'])==0) {
                echo $e->getMessage();
            }
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
            $stmt->execute();
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
            if (strcmp("1", $ini['debug'])==0) {
                echo $e->getMessage();
            }
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
            $stmt->execute();

            $stmt = $pdo->prepare("SELECT * FROM `prizes` WHERE pz_seq=:pz_seq");
            $stmt->bindParam(':pz_seq', $pzSeq, PDO::PARAM_INT);
            $stmt->execute();
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
            if (strcmp("1", $ini['debug'])==0) {
                echo $e->getMessage();
            }
        }
        return $result;
    }

    

    ?>