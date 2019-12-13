<?php

  class cls_works{
    public $wk_seq=0;
    public $sys_seq=0;
    public $bus_seq=0;
    public $wk_name;
    public $wk_que=0;
    public $wk_note;
    public $wk_level=0;
    public $lv=0;
  }


function getWorks($bSeq){

    try {
    
        $results = array();

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT *,CASE WHEN wk_level=1 THEN 'SSS' WHEN wk_level=2 THEN 'SS' WHEN wk_level=3 THEN 'S' WHEN wk_level=4 THEN 'A' WHEN wk_level=5 THEN 'B' WHEN wk_level=6 THEN 'C' ELSE '-' END AS lv FROM works WHERE bus_seq=? ORDER BY wk_que,wk_seq");
        $stmt->execute(array($bSeq));

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result = new cls_works();
            $result->wk_seq = $row['wk_seq'];
            $result->sys_seq = $row['sys_seq'];
            $result->bus_seq = $row['bus_seq'];
            $result->wk_name = $row['wk_name'];
            $result->wk_que = $row['wk_que'];
            $result->wk_note = $row['wk_note'];
            $result->wk_level = $row['wk_level'];
            $result->lv = $row['lv'];

            array_push($results,$result);
        }

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

    return $results;
}

function getWork($wSeq){

    try {
    
        $result = new cls_works();

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT *,CASE WHEN wk_level=1 THEN 'SSS' WHEN wk_level=2 THEN 'SS' WHEN wk_level=3 THEN 'S' WHEN wk_level=4 THEN 'A' WHEN wk_level=5 THEN 'B' WHEN wk_level=6 THEN 'C' ELSE '-' END AS lv  FROM works WHERE wk_seq=?");
        $stmt->execute(array($wSeq));

        if ($row = $stmt->fetch()) {
            $result->wk_seq = $row['wk_seq'];
            $result->sys_seq = $row['sys_seq'];
            $result->bus_seq = $row['bus_seq'];
            $result->wk_name = $row['wk_name'];
            $result->wk_que = $row['wk_que'];
            $result->wk_note = $row['wk_note'];
            $result->wk_level = $row['wk_level'];
            $result->lv = $row['lv'];
        }

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

    return $result;
}


function insertWork($work){

    try {

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        $cnt = getWorks($work->bus_seq);

        $sql = "INSERT INTO `works`( `sys_seq`, `bus_seq`, `wk_name`, `wk_que`, `wk_note`, `wk_level`) VALUES (?,?,?,?,?,?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array( $work->sys_seq , $work->bus_seq , $work->wk_name , count($cnt)+1 , $work->wk_note,  $work->wk_level));

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

}

function updateWork($work){

    try {

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        $sql = "UPDATE `works` SET `sys_seq`=?, `bus_seq`=?, `wk_name`=?,`wk_que`=?, `wk_note`=?, `wk_level`=? WHERE `wk_seq`=?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($work->sys_seq, $work->bus_seq, $work->wk_name, $work->wk_que, $work->wk_note, $work->wk_level, $work->wk_seq));

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

}

function deleteWork($work){

    try {

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        $sql = "DELETE FROM `works` WHERE `wk_seq`=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($work->wk_seq));

        $sql = "DELETE FROM `tasks` WHERE `wk_seq`=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($work->wk_seq));


        //リナンバリング
        $sql = "SET @rownum=0;";
        $sql .= "UPDATE works t1, (";
        $sql .= "SELECT @rownum:=@rownum+1 as ROWNUM, wk_seq FROM works WHERE `bus_seq`=? ORDER BY wk_que";
        $sql .= ") AS t2  SET t1.`wk_que`=t2.ROWNUM  ";
        $sql .= "WHERE t1.wk_seq=t2.wk_seq;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($work->bus_seq));


    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

}

?>