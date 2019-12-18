<?php

class cls_templates
{
    public $t_seq ;
    public $t_title ;
    public $t_word_1 ;
    public $t_word_2 ;
    public $t_word_3 ;
    public $t_word_4 ;
    public $t_word_5 ;
    public $t_word_6 ;
    public $t_word_7 ;
    public $t_word_8 ;
    public $t_word_9 ;
    public $t_word_10 ;
    public $t_word_11 ;
    public $t_word_12 ;
    public $t_word_13 ;
    public $t_word_14 ;
    public $t_word_15 ;
}
    
    function getTemplates()
    {
        try {
            $results = array();
            require $_SESSION["MY_ROOT"].'/src/db/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM  `templates` ORDER BY t_seq");
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result = new cls_templates();
                $result->t_seq = $row['t_seq'];
                $result->t_title = $row['t_title'];
                $result->t_word_1 = $row['t_word_1'];
                $result->t_word_2 = $row['t_word_2'];
                $result->t_word_3 = $row['t_word_3'];
                $result->t_word_4 = $row['t_word_4'];
                $result->t_word_5 = $row['t_word_5'];
                $result->t_word_6 = $row['t_word_6'];
                $result->t_word_7 = $row['t_word_7'];
                $result->t_word_8 = $row['t_word_8'];
                $result->t_word_9 = $row['t_word_9'];
                $result->t_word_10 = $row['t_word_10'];
                $result->t_word_11 = $row['t_word_11'];
                $result->t_word_12 = $row['t_word_12'];
                $result->t_word_13 = $row['t_word_13'];
                $result->t_word_14 = $row['t_word_14'];
                $result->t_word_15 = $row['t_word_15'];
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
    
    function getTemplate($tSeq)
    {
        try {
            $result = new cls_templates();
            require $_SESSION["MY_ROOT"].'/src/db/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM `templates` WHERE t_seq=:t_seq");
            $stmt->bindParam(':t_seq', $tSeq, PDO::PARAM_INT);
            $stmt->execute();
            if ($row = $stmt->fetch()) {
                $result->t_seq = $row['t_seq'];
                $result->t_title = $row['t_title'];
                $result->t_word_1 = $row['t_word_1'];
                $result->t_word_2 = $row['t_word_2'];
                $result->t_word_3 = $row['t_word_3'];
                $result->t_word_4 = $row['t_word_4'];
                $result->t_word_5 = $row['t_word_5'];
                $result->t_word_6 = $row['t_word_6'];
                $result->t_word_7 = $row['t_word_7'];
                $result->t_word_8 = $row['t_word_8'];
                $result->t_word_9 = $row['t_word_9'];
                $result->t_word_10 = $row['t_word_10'];
                $result->t_word_11 = $row['t_word_11'];
                $result->t_word_12 = $row['t_word_12'];
                $result->t_word_13 = $row['t_word_13'];
                $result->t_word_14 = $row['t_word_14'];
                $result->t_word_15 = $row['t_word_15'];
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (strcmp("1", $ini['debug'])==0) {
                echo $e->getMessage();
            }
        }
        return $result;
    }


    function countTemplates($tSeq)
    {
        try {
            $cnt=0;
            require $_SESSION["MY_ROOT"].'/src/db/dns.php';
            $stmt = $pdo->prepare("SELECT count(*) as cnt FROM `kubuns` WHERE t_seq=:t_seq");
            $stmt->bindParam(':t_seq', $tSeq, PDO::PARAM_INT);
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
    
    function insertTemplate($templates)
    {
        try {
            require $_SESSION["MY_ROOT"].'/src/db/dns.php';
            $sql = "INSERT  INTO `templates` (  `t_title`,  `t_word_1`,  `t_word_2`,  `t_word_3`,  `t_word_4`,  `t_word_5`,  `t_word_6`,  `t_word_7`,  `t_word_8`,  `t_word_9`,  `t_word_10`,  `t_word_11`,  `t_word_12`,  `t_word_13`,  `t_word_14`,  `t_word_15`) VALUES (:t_title, :t_word_1, :t_word_2, :t_word_3, :t_word_4, :t_word_5, :t_word_6, :t_word_7, :t_word_8, :t_word_9, :t_word_10, :t_word_11, :t_word_12, :t_word_13, :t_word_14, :t_word_15)";
            $stmt = $pdo -> prepare($sql);
            $stmt->bindParam(':t_title', $templates->t_title, PDO::PARAM_STR);
            $stmt->bindParam(':t_word_1', $templates->t_word_1, PDO::PARAM_STR);
            $stmt->bindParam(':t_word_2', $templates->t_word_2, PDO::PARAM_STR);
            $stmt->bindParam(':t_word_3', $templates->t_word_3, PDO::PARAM_STR);
            $stmt->bindParam(':t_word_4', $templates->t_word_4, PDO::PARAM_STR);
            $stmt->bindParam(':t_word_5', $templates->t_word_5, PDO::PARAM_STR);
            $stmt->bindParam(':t_word_6', $templates->t_word_6, PDO::PARAM_STR);
            $stmt->bindParam(':t_word_7', $templates->t_word_7, PDO::PARAM_STR);
            $stmt->bindParam(':t_word_8', $templates->t_word_8, PDO::PARAM_STR);
            $stmt->bindParam(':t_word_9', $templates->t_word_9, PDO::PARAM_STR);
            $stmt->bindParam(':t_word_10', $templates->t_word_10, PDO::PARAM_STR);
            $stmt->bindParam(':t_word_11', $templates->t_word_11, PDO::PARAM_STR);
            $stmt->bindParam(':t_word_12', $templates->t_word_12, PDO::PARAM_STR);
            $stmt->bindParam(':t_word_13', $templates->t_word_13, PDO::PARAM_STR);
            $stmt->bindParam(':t_word_14', $templates->t_word_14, PDO::PARAM_STR);
            $stmt->bindParam(':t_word_15', $templates->t_word_15, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (strcmp("1", $ini['debug'])==0) {
                echo $e->getMessage();
            }
        }
    }
    
    function updateTemplate($templates)
    {
        try {
            require $_SESSION["MY_ROOT"].'/src/db/dns.php';
            $sql = " UPDATE `templates`  SET  `t_title`=:t_title,  `t_word_1`=:t_word_1,  `t_word_2`=:t_word_2,  `t_word_3`=:t_word_3,  `t_word_4`=:t_word_4,  `t_word_5`=:t_word_5,  `t_word_6`=:t_word_6,  `t_word_7`=:t_word_7,  `t_word_8`=:t_word_8,  `t_word_9`=:t_word_9,  `t_word_10`=:t_word_10,  `t_word_11`=:t_word_11,  `t_word_12`=:t_word_12,  `t_word_13`=:t_word_13,  `t_word_14`=:t_word_14,  `t_word_15`=:t_word_15 WHERE t_seq=:t_seq";
            $stmt = $pdo -> prepare($sql);
            $stmt->bindParam(':t_seq', $templates->t_seq, PDO::PARAM_INT);
            $stmt->bindParam(':t_title', $templates->t_title, PDO::PARAM_STR);
            $stmt->bindParam(':t_word_1', $templates->t_word_1, PDO::PARAM_STR);
            $stmt->bindParam(':t_word_2', $templates->t_word_2, PDO::PARAM_STR);
            $stmt->bindParam(':t_word_3', $templates->t_word_3, PDO::PARAM_STR);
            $stmt->bindParam(':t_word_4', $templates->t_word_4, PDO::PARAM_STR);
            $stmt->bindParam(':t_word_5', $templates->t_word_5, PDO::PARAM_STR);
            $stmt->bindParam(':t_word_6', $templates->t_word_6, PDO::PARAM_STR);
            $stmt->bindParam(':t_word_7', $templates->t_word_7, PDO::PARAM_STR);
            $stmt->bindParam(':t_word_8', $templates->t_word_8, PDO::PARAM_STR);
            $stmt->bindParam(':t_word_9', $templates->t_word_9, PDO::PARAM_STR);
            $stmt->bindParam(':t_word_10', $templates->t_word_10, PDO::PARAM_STR);
            $stmt->bindParam(':t_word_11', $templates->t_word_11, PDO::PARAM_STR);
            $stmt->bindParam(':t_word_12', $templates->t_word_12, PDO::PARAM_STR);
            $stmt->bindParam(':t_word_13', $templates->t_word_13, PDO::PARAM_STR);
            $stmt->bindParam(':t_word_14', $templates->t_word_14, PDO::PARAM_STR);
            $stmt->bindParam(':t_word_15', $templates->t_word_15, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (strcmp("1", $ini['debug'])==0) {
                echo $e->getMessage();
            }
        }
    }


    function deleteTemplate($tSeq)
    {
        try {
            
            require $_SESSION["MY_ROOT"].'/src/db/dns.php';
            $stmt = $pdo->prepare("DELETE FROM `templates` WHERE t_seq=:t_seq");
            $stmt->bindParam(':t_seq', $tSeq, PDO::PARAM_INT);
            $stmt->execute();

        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (strcmp("1", $ini['debug'])==0) {
                echo $e->getMessage();
            }
        }
        
    }





?>