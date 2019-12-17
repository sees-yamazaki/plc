<?php

class cls_prizes
{
    public $pz_seq ;
    public $p_seq ;
    public $pz_title ;
    public $pz_img ;
    public $pz_text ;
    public $pz_hitcnt ;
}
    
    function getPrizes($pSeq)
    {
        try {
            $results = array();
            require './db/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM  `prizes` WHERE p_seq = :p_seq ORDER BY pz_seq");
            $stmt->bindParam(':p_seq', $pSeq, PDO::PARAM_INT);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result = new cls_prizes();
                $result->pz_seq = $row['pz_seq'];
                $result->p_seq = $row['p_seq'];
                $result->pz_title = $row['pz_title'];
                $result->pz_img = $row['pz_img'];
                $result->pz_text = $row['pz_text'];
                $result->pz_hitcnt = $row['pz_hitcnt'];
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
                $result->pz_title = $row['pz_title'];
                $result->pz_img = $row['pz_img'];
                $result->pz_text = $row['pz_text'];
                $result->pz_hitcnt = $row['pz_hitcnt'];
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (strcmp("1", $ini['debug'])==0) {
                echo $e->getMessage();
            }
        }
        return $result;
    }
    
    function insertPrize($prizes)
    {
        try {
            require './db/dns.php';
            $sql = "INSERT  INTO `prizes` (  `p_seq`,  `pz_title`,  `pz_img`,  `pz_text`,  `pz_hitcnt`) VALUES (:p_seq, :pz_title, :pz_img, :pz_text, :pz_hitcnt)";
            $stmt = $pdo -> prepare($sql);
            $stmt->bindParam(':p_seq', $prizes->p_seq, PDO::PARAM_INT);
            $stmt->bindParam(':pz_title', $prizes->pz_title, PDO::PARAM_STR);
            $stmt->bindParam(':pz_img', $prizes->pz_img, PDO::PARAM_STR);
            $stmt->bindParam(':pz_text', $prizes->pz_text, PDO::PARAM_STR);
            $stmt->bindParam(':pz_hitcnt', $prizes->pz_hitcnt, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (strcmp("1", $ini['debug'])==0) {
                echo $e->getMessage();
            }
        }
    }
    
    function updatePrize($prizes)
    {
        try {
            require './db/dns.php';
            $sql = " UPDATE `prizes`  SET  `p_seq`=:p_seq,  `pz_title`=:pz_title,  `pz_img`=:pz_img,  `pz_text`=:pz_text,  `pz_hitcnt`=:pz_hitcnt WHERE pz_seq=:pz_seq";
            $stmt = $pdo -> prepare($sql);
            $stmt->bindParam(':pz_seq', $prizes->pz_seq, PDO::PARAM_INT);
            $stmt->bindParam(':p_seq', $prizes->p_seq, PDO::PARAM_INT);
            $stmt->bindParam(':pz_title', $prizes->pz_title, PDO::PARAM_STR);
            $stmt->bindParam(':pz_img', $prizes->pz_img, PDO::PARAM_STR);
            $stmt->bindParam(':pz_text', $prizes->pz_text, PDO::PARAM_STR);
            $stmt->bindParam(':pz_hitcnt', $prizes->pz_hitcnt, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (strcmp("1", $ini['debug'])==0) {
                echo $e->getMessage();
            }
        }
    }



?>