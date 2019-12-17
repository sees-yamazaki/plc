<?php
class cls_promos
{
    public $p_seq ;
    public $p_title ;
    public $p_text1 ;
    public $p_img ;
    public $p_text2 ;
    public $p_startdt ;
    public $p_enddt ;
}
    
    function getPromos()
    {
        try {
            $results = array();
            require './db/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM  `promos` ORDER BY p_seq");
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result = new cls_promos();
                $result->p_seq = $row['p_seq'];
                $result->p_title = $row['p_title'];
                $result->p_text1 = $row['p_text1'];
                $result->p_img = $row['p_img'];
                $result->p_text2 = $row['p_text2'];
                $result->p_startdt = $row['p_startdt'];
                $result->p_enddt = $row['p_enddt'];
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
    
    function getPromo($pSeq)
    {
        try {
            $result = new cls_promos();
            require './db/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM `promos` WHERE p_seq=:p_seq");
            $stmt->bindParam(':p_seq', $pSeq, PDO::PARAM_INT);
            $stmt->execute();
            if ($row = $stmt->fetch()) {
                $result->p_seq = $row['p_seq'];
                $result->p_title = $row['p_title'];
                $result->p_text1 = $row['p_text1'];
                $result->p_img = $row['p_img'];
                $result->p_text2 = $row['p_text2'];
                $result->p_startdt = $row['p_startdt'];
                $result->p_enddt = $row['p_enddt'];
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (strcmp("1", $ini['debug'])==0) {
                echo $e->getMessage();
            }
        }
        return $result;
    }
    
    function insertPromo($promos)
    {
        try {
            require './db/dns.php';
            $sql = "INSERT  INTO `promos` (  `p_title`,  `p_text1`,  `p_img`,  `p_text2`, `p_startdt`, `p_enddt`) VALUES (:p_title, :p_text1, :p_img, :p_text2, :p_startdt , :p_enddt)";
            $stmt = $pdo -> prepare($sql);
            $stmt->bindParam(':p_title', $promos->p_title, PDO::PARAM_STR);
            $stmt->bindParam(':p_text1', $promos->p_text1, PDO::PARAM_STR);
            $stmt->bindParam(':p_img', $promos->p_img, PDO::PARAM_STR);
            $stmt->bindParam(':p_text2', $promos->p_text2, PDO::PARAM_STR);
            $stmt->bindParam(':p_startdt', $promos->p_startdt, PDO::PARAM_STR);
            $stmt->bindParam(':p_enddt', $promos->p_enddt, PDO::PARAM_STR);
            
            $stmt->execute();

            $insertid = $pdo->lastInsertId();

            mkdir ( 'promos/'.$insertid );

            if($promos->p_img<>""){
                $file = 'promos/'.$insertid."/". basename( $_FILES ['p_img'] ['name'] );
                move_uploaded_file ( $_FILES ['p_img'] ['tmp_name'], $file );
            }


        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (strcmp("1", $ini['debug'])==0) {
                echo $e->getMessage();
            }
        }
    }
    
    function updatePromo($promos)
    {
        try {
            require './db/dns.php';
            $sql = " UPDATE `promos`  SET  `p_title`=:p_title,  `p_text1`=:p_text1,  `p_img`=:p_img,  `p_text2`=:p_text2,`p_startdt`=:p_startdt,`p_enddt`=:p_enddt WHERE p_seq=:p_seq";
            $stmt = $pdo -> prepare($sql);
            $stmt->bindParam(':p_seq', $promos->p_seq, PDO::PARAM_INT);
            $stmt->bindParam(':p_title', $promos->p_title, PDO::PARAM_STR);
            $stmt->bindParam(':p_text1', $promos->p_text1, PDO::PARAM_STR);
            $stmt->bindParam(':p_img', $promos->p_img, PDO::PARAM_STR);
            $stmt->bindParam(':p_text2', $promos->p_text2, PDO::PARAM_STR);
            $stmt->bindParam(':p_startdt', $promos->p_startdt, PDO::PARAM_STR);
            $stmt->bindParam(':p_enddt', $promos->p_enddt, PDO::PARAM_STR);
            $stmt->execute();

            if($promos->p_img<>""){
                $file = 'promos/'.$promos->p_seq."/". basename( $_FILES ['p_img'] ['name'] );
                move_uploaded_file ( $_FILES ['p_img'] ['tmp_name'], $file );
            }


        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (strcmp("1", $ini['debug'])==0) {
                echo $e->getMessage();
            }
        }
    }
    function deletePromo($pSeq)
    {
        try {
            require './db/dns.php';
            $sql = " DELETE FROM `promos` WHERE p_seq=:p_seq";
            $stmt = $pdo -> prepare($sql);
            $stmt->bindParam(':p_seq', $pSeq, PDO::PARAM_INT);
            $stmt->execute();

            exec('rm -rf '.'promos/'.$pSeq);


        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (strcmp("1", $ini['debug'])==0) {
                echo $e->getMessage();
            }
        }
    }



?>