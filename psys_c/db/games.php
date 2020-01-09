<?php
class cls_games
{
    public $g_seq ;
    public $g_title ;
    public $g_image_start ;
    public $g_image_hit ;
    public $g_image_miss ;
    public $imgStts_start ;
    public $imgStts_hit ;
    public $imgStts_miss ;
    public $g_text ;
}
    
    function getGames()
    {
        try {
            $results = array();
            require './db/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM  `games` ORDER BY g_seq");
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result = new cls_games();
                $result->g_seq = $row['g_seq'];
                $result->g_title = $row['g_title'];
                $result->g_image_start = $row['g_image_start'];
                $result->g_image_hit = $row['g_image_hit'];
                $result->g_image_miss = $row['g_image_miss'];
                $result->g_text = $row['g_text'];
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
    
    function getGame($gSeq)
    {
        try {
            $result = new cls_games();
            require './db/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM `games` WHERE g_seq=:g_seq");
            $stmt->bindParam(':g_seq', $gSeq, PDO::PARAM_INT);
            $stmt->execute();
            if ($row = $stmt->fetch()) {
                $result->g_seq = $row['g_seq'];
                $result->g_title = $row['g_title'];
                $result->g_image_start = $row['g_image_start'];
                $result->g_image_hit = $row['g_image_hit'];
                $result->g_image_miss = $row['g_image_miss'];
                $result->g_text = $row['g_text'];
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            logging(__FILE__." : ".__METHOD__."()");
            logging("DATABASE ERROR : ".$e->getMessage());
            logging("ARGS : ". json_encode(func_get_args()));
        }
        return $result;
    }


    function countGames($gSeq)
    {
        try {
            $cnt = 0;
            require './db/dns.php';
            $stmt = $pdo->prepare("SELECT count(*) as cnt FROM `promos` WHERE g_seq=:g_seq");
            $stmt->bindParam(':g_seq', $gSeq, PDO::PARAM_INT);
            $stmt->execute();
            if ($row = $stmt->fetch()) {
                $cnt = $row['cnt'];
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            logging(__FILE__." : ".__METHOD__."()");
            logging("DATABASE ERROR : ".$e->getMessage());
            logging("ARGS : ". json_encode(func_get_args()));
        }
        return $cnt;
    }

    




    ?>