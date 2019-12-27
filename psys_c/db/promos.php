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
    public $g_seq ;
    public $imgStts ;
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
                $result->g_seq = $row['g_seq'];
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
    
    function getOpenPromo()
    {
        try {
            $result = new cls_promos();
            require './db/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM  promos WHERE CURDATE() BETWEEN `p_startdt`AND`p_enddt` ORDER BY `p_startdt`");
            $stmt->execute();
            if ($row = $stmt->fetch()) {
                $result->p_seq = $row['p_seq'];
                $result->p_title = $row['p_title'];
                $result->p_text1 = $row['p_text1'];
                $result->p_img = $row['p_img'];
                $result->p_text2 = $row['p_text2'];
                $result->p_startdt = $row['p_startdt'];
                $result->p_enddt = $row['p_enddt'];
                $result->g_seq = $row['g_seq'];
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (getSsnIsDebug()) {
                echo $e->getMessage();
            }
        }
        return $result;
    }
    

?>