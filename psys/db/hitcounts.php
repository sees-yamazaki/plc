<?php

class cls_hitcounts
{
    public $hc_seq ;
    public $p_seq ;
    public $pz_seq ;
    public $hc_no ;
}
    
    function getHitcounts($pSeq)
    {
        try {
            $results = array();
            require $_SESSION["MY_ROOT"].'/src/db/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM  `hitcounts` WHERE p_seq=:p_seq ORDER BY p_seq,pz_seq,hc_no");
            $stmt->bindParam(':p_seq', $pSeq, PDO::PARAM_INT);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result = new cls_hitcounts();
                $result->p_seq = $row['hc_seq'];
                $result->p_seq = $row['p_seq'];
                $result->pz_seq = $row['pz_seq'];
                $result->hc_no = $row['hc_no'];
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
    
    // function getHitcounts($hitcounts)
    // {
    //     try {
    //         $results = array();
    //         require $_SESSION["MY_ROOT"].'/src/db/dns.php';
    //         $stmt = $pdo->prepare("SELECT * FROM `hitcounts` WHERE hc_seq=:hc_seq");
    //         $stmt->bindParam(':hc_seq', $hitcounts->hc_seq, PDO::PARAM_INT);
    //         $stmt->execute();
    //         if ($row = $stmt->fetch()) {
    //             $result = new cls_hitcounts();
    //             $result->p_seq = $row['p_seq'];
    //             $result->pz_seq = $row['pz_seq'];
    //             $result->hc_no = $row['hc_no'];
    //             array_push($results, $result);
    //         }
    //     } catch (PDOException $e) {
    //         $errorMessage = 'データベースエラー';
    //         if (strcmp("1", $ini['debug'])==0) {
    //             echo $e->getMessage();
    //         }
    //     }
    //     return $results;
    // }
    
    function insertHitcount($hitcounts)
    {
        try {
            require $_SESSION["MY_ROOT"].'/src/db/dns.php';
            $sql = "INSERT  INTO `hitcounts` (  `p_seq`,  `pz_seq`,  `hc_no`) VALUES (:p_seq, :pz_seq, :hc_no)";
            $stmt = $pdo -> prepare($sql);
            $stmt->bindParam(':p_seq', $hitcounts->p_seq, PDO::PARAM_INT);
            $stmt->bindParam(':pz_seq', $hitcounts->pz_seq, PDO::PARAM_INT);
            $stmt->bindParam(':hc_no', $hitcounts->hc_no, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (strcmp("1", $ini['debug'])==0) {
                echo $e->getMessage();
            }
        }
    }
    
    function updateHitcounts($hitcounts)
    {
        try {
            require $_SESSION["MY_ROOT"].'/src/db/dns.php';
            $sql = " UPDATE `hitcounts`  SET  `p_seq`=:p_seq,  `pz_seq`=:pz_seq,  `hc_no`=:hc_no WHERE hc_seq=:hc_seq";
            $stmt = $pdo -> prepare($sql);
            $stmt->bindParam(':hc_seq', $hitcounts->hc_seq, PDO::PARAM_INT);
            $stmt->bindParam(':p_seq', $hitcounts->p_seq, PDO::PARAM_INT);
            $stmt->bindParam(':pz_seq', $hitcounts->pz_seq, PDO::PARAM_INT);
            $stmt->bindParam(':hc_no', $hitcounts->hc_no, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (strcmp("1", $ini['debug'])==0) {
                echo $e->getMessage();
            }
        }
    }
