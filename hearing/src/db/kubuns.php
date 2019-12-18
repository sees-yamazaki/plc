<?php

class cls_kubuns
{
    public $k_seq ;
    public $k_title ;
    public $k_kubun1 ;
    public $k_kubun2 ;
    public $t_seq ;
}
    
    function getKubuns()
    {
        try {
            $results = array();
            require $_SESSION["MY_ROOT"].'/src/db/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM  `kubuns` ORDER BY k_seq");
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result = new cls_kubuns();
                $result->k_seq = $row['k_seq'];
                $result->k_title = $row['k_title'];
                $result->k_kubun1 = $row['k_kubun1'];
                $result->k_kubun2 = $row['k_kubun2'];
                $result->t_seq = $row['t_seq'];
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
    
    function getKubun($kSeq)
    {
        try {
            $result = new cls_kubuns();
            require $_SESSION["MY_ROOT"].'/src/db/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM `kubuns` WHERE k_seq=:k_seq");
            $stmt->bindParam(':k_seq', $kSeq, PDO::PARAM_INT);
            $stmt->execute();
            if ($row = $stmt->fetch()) {
                $result->k_seq = $row['k_seq'];
                $result->k_title = $row['k_title'];
                $result->k_kubun1 = $row['k_kubun1'];
                $result->k_kubun2 = $row['k_kubun2'];
                $result->t_seq = $row['t_seq'];
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (strcmp("1", $ini['debug'])==0) {
                echo $e->getMessage();
            }
        }
        return $result;
    }
    
    function countKubuns($kSeq)
    {
        try {
            $cnt=0;
            require $_SESSION["MY_ROOT"].'/src/db/dns.php';
            $stmt = $pdo->prepare("SELECT count(*) as cnt FROM `infos` WHERE k_seq=:k_seq");
            $stmt->bindParam(':k_seq', $kSeq, PDO::PARAM_INT);
            $stmt->execute();
            if ($row = $stmt->fetch()) {
                $cnt = $row['cnt'];
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (strcmp("1", $ini['debug'])==0) {
                echo $e->getMessage();
            }
        }
        return $cnt;
    }



    function insertKubun($kubuns)
    {
        try {
            require $_SESSION["MY_ROOT"].'/src/db/dns.php';
            $sql = "INSERT  INTO `kubuns` (  `k_title`,  `k_kubun1`,  `k_kubun2`,  `t_seq`) VALUES (:k_title, :k_kubun1, :k_kubun2, :t_seq)";
            $stmt = $pdo -> prepare($sql);
            $stmt->bindParam(':k_title', $kubuns->k_title, PDO::PARAM_STR);
            $stmt->bindParam(':k_kubun1', $kubuns->k_kubun1, PDO::PARAM_STR);
            $stmt->bindParam(':k_kubun2', $kubuns->k_kubun2, PDO::PARAM_STR);
            $stmt->bindParam(':t_seq', $kubuns->t_seq, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (strcmp("1", $ini['debug'])==0) {
                echo $e->getMessage();
            }
        }
    }
    
    function updateKubun($kubuns)
    {
        try {
            require $_SESSION["MY_ROOT"].'/src/db/dns.php';
            $sql = " UPDATE `kubuns`  SET  `k_title`=:k_title,  `k_kubun1`=:k_kubun1,  `k_kubun2`=:k_kubun2,  `t_seq`=:t_seq WHERE k_seq=:k_seq";
            $stmt = $pdo -> prepare($sql);
            $stmt->bindParam(':k_seq', $kubuns->k_seq, PDO::PARAM_INT);
            $stmt->bindParam(':k_title', $kubuns->k_title, PDO::PARAM_STR);
            $stmt->bindParam(':k_kubun1', $kubuns->k_kubun1, PDO::PARAM_STR);
            $stmt->bindParam(':k_kubun2', $kubuns->k_kubun2, PDO::PARAM_STR);
            $stmt->bindParam(':t_seq', $kubuns->t_seq, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (strcmp("1", $ini['debug'])==0) {
                echo $e->getMessage();
            }
        }
    }

    function deleteKubun($kSeq)
    {
        try {
            
            require $_SESSION["MY_ROOT"].'/src/db/dns.php';
            $stmt = $pdo->prepare("DELETE FROM `kubuns` WHERE k_seq=:k_seq");
            $stmt->bindParam(':k_seq', $kSeq, PDO::PARAM_INT);
            $stmt->execute();

        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (strcmp("1", $ini['debug'])==0) {
                echo $e->getMessage();
            }
        }
        
    }



    ?>
