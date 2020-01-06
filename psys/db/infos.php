<?php

class cls_infos
{
    public $inf_seq ;
    public $inf_title ;
    public $inf_text1 ;
    public $inf_text2 ;
    public $inf_img ;
    public $inf_startdt ;
    public $inf_enddt ;
    public $imgStts;
    public $inf_order ;
}
 

function getInfos()
{
    try {
        $results = array();
        require './db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM  `infos` ORDER BY inf_seq");
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new cls_infos();
            $result->inf_seq = $row['inf_seq'];
            $result->inf_title = $row['inf_title'];
            $result->inf_text1 = $row['inf_text1'];
            $result->inf_text2 = $row['inf_text2'];
            $result->inf_img = $row['inf_img'];
            $result->inf_startdt = $row['inf_startdt'];
            $result->inf_enddt = $row['inf_enddt'];
            $result->inf_order = $row['inf_order'];
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

function getOpenInfos($dt)
{
    try {

        if($dt==""){
            $dt = date("Y-m-d");
        }


        $results = array();
        require './db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM `infos`WHERE :dt BETWEEN inf_startdt AND inf_enddt ORDER BY inf_order");
        $stmt->bindParam(':dt', $dt, PDO::PARAM_STR);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new cls_infos();
            $result->inf_seq = $row['inf_seq'];
            $result->inf_title = $row['inf_title'];
            $result->inf_text1 = $row['inf_text1'];
            $result->inf_text2 = $row['inf_text2'];
            $result->inf_img = $row['inf_img'];
            $result->inf_startdt = $row['inf_startdt'];
            $result->inf_enddt = $row['inf_enddt'];
            $result->inf_order = $row['inf_order'];
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

    function getInfo($iSeq)
    {
        try {
            $result = new cls_infos();
            require './db/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM `infos` WHERE inf_seq=:inf_seq");
            $stmt->bindParam(':inf_seq', $iSeq, PDO::PARAM_INT);
            $stmt->execute();
            if ($row = $stmt->fetch()) {
                $result->inf_seq = $row['inf_seq'];
                $result->inf_title = $row['inf_title'];
                $result->inf_text1 = $row['inf_text1'];
                $result->inf_text2 = $row['inf_text2'];
                $result->inf_img = $row['inf_img'];
                $result->inf_startdt = $row['inf_startdt'];
                $result->inf_enddt = $row['inf_enddt'];
                $result->inf_order = $row['inf_order'];
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (getSsnIsDebug()) {
                echo $e->getMessage();
            }
        }
        return $result;
    }
    
    function insertInfo($infos)
    {
        try {
            require './db/dns.php';
            $sql = "INSERT  INTO `infos` (  `inf_title`,  `inf_text1`,  `inf_text2`,  `inf_img`,  `inf_startdt`,  `inf_enddt`, `inf_order`) VALUES (:inf_title, :inf_text1, :inf_text2, :inf_img, :inf_startdt, :inf_enddt, :inf_order)";
            $stmt = $pdo -> prepare($sql);
            $stmt->bindParam(':inf_title', $infos->inf_title, PDO::PARAM_STR);
            $stmt->bindParam(':inf_text1', $infos->inf_text1, PDO::PARAM_STR);
            $stmt->bindParam(':inf_text2', $infos->inf_text2, PDO::PARAM_STR);
            $stmt->bindParam(':inf_img', $infos->inf_img, PDO::PARAM_STR);
            $stmt->bindParam(':inf_startdt', $infos->inf_startdt, PDO::PARAM_STR);
            $stmt->bindParam(':inf_enddt', $infos->inf_enddt, PDO::PARAM_STR);
            $stmt->bindParam(':inf_order', $infos->inf_order, PDO::PARAM_INT);
            $stmt->execute();


            $insertid = $pdo->lastInsertId();

            if ($infos->imgStts == 1) {
                $path = getSsn('PATH_INFO').'/'.$insertid;
                mkdir($path,0777);
                $file = $path.'/'.basename($_FILES['inf_img']['name']);
                move_uploaded_file($_FILES['inf_img']['tmp_name'], $file);
            }



        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (getSsnIsDebug()) {
                echo $e->getMessage();
            }
        }
    }
    
    function updateInfo($infos)
    {
        try {
            require './db/dns.php';
            $sql = '';
            if ($infos->imgStts == 1) {
                $sql = " UPDATE `infos`  SET  `inf_title`=:inf_title,  `inf_text1`=:inf_text1,  `inf_text2`=:inf_text2,  `inf_img`=:inf_img,  `inf_startdt`=:inf_startdt,  `inf_enddt`=:inf_enddt,  `inf_order`=:inf_order WHERE inf_seq=:inf_seq";
            } elseif ($infos->imgStts == 2) {
                $sql = " UPDATE `infos`  SET  `inf_title`=:inf_title,  `inf_text1`=:inf_text1,  `inf_text2`=:inf_text2, `inf_startdt`=:inf_startdt,  `inf_enddt`=:inf_enddt,  `inf_order`=:inf_order WHERE inf_seq=:inf_seq";
            } else {
                $sql = " UPDATE `infos`  SET  `inf_title`=:inf_title,  `inf_text1`=:inf_text1,  `inf_text2`=:inf_text2,  `inf_img`=:inf_img,  `inf_startdt`=:inf_startdt,  `inf_enddt`=:inf_enddt,  `inf_order`=:inf_order WHERE inf_seq=:inf_seq";
                $infos->inf_img = '';
            }

            $stmt = $pdo -> prepare($sql);
            $stmt->bindParam(':inf_seq', $infos->inf_seq, PDO::PARAM_INT);
            $stmt->bindParam(':inf_title', $infos->inf_title, PDO::PARAM_STR);
            $stmt->bindParam(':inf_text1', $infos->inf_text1, PDO::PARAM_STR);
            $stmt->bindParam(':inf_text2', $infos->inf_text2, PDO::PARAM_STR);
            if ($infos->imgStts != 2) {
                $stmt->bindParam(':inf_img', $infos->inf_img, PDO::PARAM_STR);
            }
            $stmt->bindParam(':inf_startdt', $infos->inf_startdt, PDO::PARAM_STR);
            $stmt->bindParam(':inf_enddt', $infos->inf_enddt, PDO::PARAM_STR);
            $stmt->bindParam(':inf_order', $infos->inf_order, PDO::PARAM_INT);
            $stmt->execute();


            if ($infos->imgStts == 1) {
                $file = getSsn('PATH_INFO').'/'.$infos->inf_seq.'/'.basename($_FILES['inf_img']['name']);
                echo "----------------------------------------------------";
                echo $file;
                move_uploaded_file($_FILES['inf_img']['tmp_name'], $file);
            }





        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (getSsnIsDebug()) {
                echo $e->getMessage();
            }
        }
    }



    function deleteInfo($iSeq)
    {
        try {
            require './db/dns.php';
            $sql = "DELETE FROM `infos` WHERE inf_seq=:inf_seq";
            $stmt = $pdo -> prepare($sql);
            $stmt->bindParam(':inf_seq', $iSeq, PDO::PARAM_INT);
            $stmt->execute();

        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (getSsnIsDebug()) {
                echo $e->getMessage();
            }
        }
    }


    ?>