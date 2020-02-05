<?php

class cls_books
{
    public $bks_seq ;
    public $bks_shelf ;
    public $bks_title ;
    public $bks_text ;
    public $bks_opendt ;
    public $bks_pw ;
    public $bks_file ;
}
    
    function getBooks($shelf)
    {
        try {
            $results = array();
            require './db/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM  `books` WHERE bks_shelf=:bks_shelf ORDER BY bks_seq");
            $stmt->bindParam(':bks_shelf', $shelf, PDO::PARAM_INT);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result = new cls_books();
                $result->bks_seq = $row['bks_seq'];
                $result->bks_shelf = $row['bks_shelf'];
                $result->bks_title = $row['bks_title'];
                $result->bks_text = $row['bks_text'];
                $result->bks_opendt = $row['bks_opendt'];
                $result->bks_pw = $row['bks_pw'];
                $result->bks_file = $row['bks_file'];
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
    
    function getBook($bSeq)
    {
        try {
            $result = new cls_books();
            require './db/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM `books` WHERE bks_seq=:bks_seq");
            $stmt->bindParam(':bks_seq', $bSeq, PDO::PARAM_INT);
            $stmt->execute();
            if ($row = $stmt->fetch()) {
                $result->bks_seq = $row['bks_seq'];
                $result->bks_shelf = $row['bks_shelf'];
                $result->bks_title = $row['bks_title'];
                $result->bks_text = $row['bks_text'];
                $result->bks_opendt = $row['bks_opendt'];
                $result->bks_pw = $row['bks_pw'];
                $result->bks_file = $row['bks_file'];
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            logging(__FILE__." : ".__METHOD__."()");
            logging("DATABASE ERROR : ".$e->getMessage());
            logging("ARGS : ". json_encode(func_get_args()));
        }
        return $result;
    }
    
    // function insertBooks($books)
    // {
    //     try {
    //         require './db/dns.php';
    //         $sql = "INSERT  INTO `books` (  `bks_title`,  `bks_text`,  `bks_opendt`,  `bks_pw`,  `bks_file`) VALUES (:bks_title, :bks_text, :bks_opendt, :bks_pw, :bks_file)";
    //         $stmt = $pdo -> prepare($sql);
    //         $stmt->bindParam(':bks_title', $books->bks_title, PDO::PARAM_STR);
    //         $stmt->bindParam(':bks_text', $books->bks_text, PDO::PARAM_STR);
    //         $stmt->bindParam(':bks_opendt', $books->bks_opendt, PDO::PARAM_STR);
    //         $stmt->bindParam(':bks_pw', $books->bks_pw, PDO::PARAM_STR);
    //         $stmt->bindParam(':bks_file', $books->bks_file, PDO::PARAM_STR);
    //         $stmt->execute();
    //     } catch (PDOException $e) {
    //         $errorMessage = 'データベースエラー';
    //         if (strcmp("1", $ini['debug'])==0) {
    //             echo $e->getMessage();
    //         }
    //     }
    // }
    
    // function updateBooks($books)
    // {
    //     try {
    //         require './db/dns.php';
    //         $sql = " UPDATE `books`  SET  `bks_title`=:bks_title,  `bks_text`=:bks_text,  `bks_opendt`=:bks_opendt,  `bks_pw`=:bks_pw,  `bks_file`=:bks_file WHERE bks_seq=:bks_seq";
    //         $stmt = $pdo -> prepare($sql);
    //         $stmt->bindParam(':bks_seq', $books->bks_seq, PDO::PARAM_INT);
    //         $stmt->bindParam(':bks_title', $books->bks_title, PDO::PARAM_STR);
    //         $stmt->bindParam(':bks_text', $books->bks_text, PDO::PARAM_STR);
    //         $stmt->bindParam(':bks_opendt', $books->bks_opendt, PDO::PARAM_STR);
    //         $stmt->bindParam(':bks_pw', $books->bks_pw, PDO::PARAM_STR);
    //         $stmt->bindParam(':bks_file', $books->bks_file, PDO::PARAM_STR);
    //         $stmt->execute();
    //     } catch (PDOException $e) {
    //         $errorMessage = 'データベースエラー';
    //         if (strcmp("1", $ini['debug'])==0) {
    //             echo $e->getMessage();
    //         }
    //     }
    // }
