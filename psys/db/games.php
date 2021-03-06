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
            execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
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
            logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
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
            execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
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
            logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
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

    
    function insertGame($games)
    {
        try {
            require './db/dns.php';
            $sql = "INSERT  INTO `games` ( `g_title`,  `g_image_start`,  `g_image_hit`,  `g_image_miss`,  `g_text`) VALUES ( :g_title, :g_image_start, :g_image_hit, :g_image_miss, :g_text)";
            $stmt = $pdo -> prepare($sql);
            $stmt->bindParam(':g_title', $games->g_title, PDO::PARAM_STR);
            $stmt->bindParam(':g_image_start', $games->g_image_start, PDO::PARAM_STR);
            $stmt->bindParam(':g_image_hit', $games->g_image_hit, PDO::PARAM_STR);
            $stmt->bindParam(':g_image_miss', $games->g_image_miss, PDO::PARAM_STR);
            $stmt->bindParam(':g_text', $games->g_text, PDO::PARAM_STR);
            execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

            if ($stmt->rowCount()==0) {
                logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
                logging("INSERT ERROR : ". $sql);
                logging("ARGS : ". json_encode(func_get_args()));
            } else {
                $insertid = $pdo->lastInsertId();

                $path = getSsn('PATH_GAME').'/'.$insertid;
                mkdir($path, 0777);

                $file = $path."/". basename($_FILES ['g_image_start'] ['name']);
                move_uploaded_file($_FILES ['g_image_start'] ['tmp_name'], $file);
                $file = $path."/". basename($_FILES ['g_image_hit'] ['name']);
                move_uploaded_file($_FILES ['g_image_hit'] ['tmp_name'], $file);
                $file = $path."/". basename($_FILES ['g_image_miss'] ['name']);
                move_uploaded_file($_FILES ['g_image_miss'] ['tmp_name'], $file);
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
            logging("DATABASE ERROR : ".$e->getMessage());
            logging("ARGS : ". json_encode(func_get_args()));
        }
    }




    function updateGame($games)
    {
        try {
            require './db/dns.php';
            $sql = " UPDATE `games`  SET  `g_title`=:g_title,  `g_text`=:g_text,editdt=NOW() WHERE g_seq=:g_seq";
            $stmt = $pdo -> prepare($sql);
            $stmt->bindParam(':g_seq', $games->g_seq, PDO::PARAM_INT);
            $stmt->bindParam(':g_title', $games->g_title, PDO::PARAM_STR);
            $stmt->bindParam(':g_text', $games->g_text, PDO::PARAM_STR);
            execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

            if ($stmt->rowCount()==0) {
                logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
                logging("UPDATE ERROR : ". $sql);
                logging("ARGS : ". json_encode(func_get_args()));
            } else {
                $path = getSsn('PATH_GAME').'/'.$games->g_seq;
            
                if ($games->imgStts_start=="1") {
                    $sql = "UPDATE `games` SET `g_image_start`=:g_image_start,editdt=NOW() WHERE g_seq=:g_seq";
                    $stmt = $pdo -> prepare($sql);
                    $stmt->bindParam(':g_seq', $games->g_seq, PDO::PARAM_INT);
                    $stmt->bindParam(':g_image_start', $games->g_image_start, PDO::PARAM_STR);
                    execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

                    $file = $path."/". basename($_FILES ['g_image_start'] ['name']);
                    move_uploaded_file($_FILES ['g_image_start'] ['tmp_name'], $file);
                }
                if ($games->imgStts_hit=="1") {
                    $sql = "UPDATE `games` SET `g_image_hit`=:g_image_hit,editdt=NOW() WHERE g_seq=:g_seq";
                    $stmt = $pdo -> prepare($sql);
                    $stmt->bindParam(':g_seq', $games->g_seq, PDO::PARAM_INT);
                    $stmt->bindParam(':g_image_hit', $games->g_image_hit, PDO::PARAM_STR);
                    execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
                    $file = $path."/". basename($_FILES ['g_image_hit'] ['name']);
                    move_uploaded_file($_FILES ['g_image_hit'] ['tmp_name'], $file);
                }
                if ($games->imgStts_miss=="1") {
                    $sql = "UPDATE `games` SET `g_image_miss`=:g_image_miss,editdt=NOW() WHERE g_seq=:g_seq";
                    $stmt = $pdo -> prepare($sql);
                    $stmt->bindParam(':g_seq', $games->g_seq, PDO::PARAM_INT);
                    $stmt->bindParam(':g_image_miss', $games->g_image_miss, PDO::PARAM_STR);
                    execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
                    $file = $path."/". basename($_FILES ['g_image_miss'] ['name']);
                    move_uploaded_file($_FILES ['g_image_miss'] ['tmp_name'], $file);
                }
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
            logging("DATABASE ERROR : ".$e->getMessage());
            logging("ARGS : ". json_encode(func_get_args()));
        }
    }


    function deleteGame($gSeq)
    {
        try {
            require './db/dns.php';
            $sql = "DELETE FROM `games` WHERE g_seq=:g_seq";
            $stmt = $pdo -> prepare($sql);
            $stmt->bindParam(':g_seq', $gSeq, PDO::PARAM_INT);
            execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
            logging("DATABASE ERROR : ".$e->getMessage());
            logging("ARGS : ". json_encode(func_get_args()));
        }
    }
