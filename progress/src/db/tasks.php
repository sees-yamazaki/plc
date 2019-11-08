<?php

  class cls_tasks{
    public $tsk_seq=0;
    public $sys_seq=0;
    public $bus_seq=0;
    public $wk_seq=0;
    public $tsk_name;
    public $tsk_que=0;
    public $tsk_k1=0;
    public $tsk_k2=0;
    public $tsk_i1=0;
    public $tsk_i2=0;
    public $tsk_i3=0;
    public $tsk_i4=0;
    public $tsk_i5=0;
    public $tsk_i6=0;
    public $tsk_i7=0;
    public $tsk_i8=0;
    public $tsk_i9=0;
    public $tsk_i10=0;
  }


function getTasks($wSeq){

    try {
    
        $results = array();

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM tasks WHERE wk_seq=? ORDER BY tsk_que,tsk_seq");
        $stmt->execute(array($wSeq));

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result = new cls_tasks();
            $result->tsk_seq = $row['tsk_seq'];
            $result->sys_seq = $row['sys_seq'];
            $result->bus_seq = $row['bus_seq'];
            $result->wk_seq = $row['wk_seq'];
            $result->tsk_name = $row['tsk_name'];
            $result->tsk_que = $row['tsk_que'];
            $result->tsk_k1 = $row['tsk_k1'];
            $result->tsk_k2 = $row['tsk_k2'];
            $result->tsk_i1 = $row['tsk_i1'];
            $result->tsk_i2 = $row['tsk_i2'];
            $result->tsk_i3 = $row['tsk_i3'];
            $result->tsk_i4 = $row['tsk_i4'];
            $result->tsk_i5 = $row['tsk_i5'];
            $result->tsk_i6 = $row['tsk_i6'];
            $result->tsk_i7 = $row['tsk_i7'];
            $result->tsk_i8 = $row['tsk_i8'];
            $result->tsk_i9 = $row['tsk_i9'];
            $result->tsk_i10 = $row['tsk_i10'];

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

function getTask($tSeq){

    try {
    
        $result = new cls_tasks();

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM tasks WHERE tsk_seq=?");
        $stmt->execute(array($tSeq));

        if ($row = $stmt->fetch()) {
            $result->tsk_seq = $row['tsk_seq'];
            $result->sys_seq = $row['sys_seq'];
            $result->bus_seq = $row['bus_seq'];
            $result->wk_seq = $row['wk_seq'];
            $result->tsk_name = $row['tsk_name'];
            $result->tsk_que = $row['tsk_que'];
            $result->tsk_k1 = $row['tsk_k1'];
            $result->tsk_k2 = $row['tsk_k2'];
            $result->tsk_i1 = $row['tsk_i1'];
            $result->tsk_i2 = $row['tsk_i2'];
            $result->tsk_i3 = $row['tsk_i3'];
            $result->tsk_i4 = $row['tsk_i4'];
            $result->tsk_i5 = $row['tsk_i5'];
            $result->tsk_i6 = $row['tsk_i6'];
            $result->tsk_i7 = $row['tsk_i7'];
            $result->tsk_i8 = $row['tsk_i8'];
            $result->tsk_i9 = $row['tsk_i9'];
            $result->tsk_i10 = $row['tsk_i10'];
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


function insertTask($tasks){

    try {

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        $cnt = getTasks($tasks->wk_seq);

        $sql = "INSERT INTO `tasks`(`sys_seq`,`bus_seq`, `wk_seq`, `tsk_name`, `tsk_que`) VALUES (?,?,?,?,?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array( $tasks->sys_seq ,$tasks->bus_seq , $tasks->wk_seq , $tasks->tsk_name , count($cnt)+1));

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

}

function updateTask($tasks){

    try {

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        $sql = "UPDATE `tasks` SET `sys_seq`=? ,`bus_seq`=? ,`wk_seq`=?,`tsk_name`=?,`tsk_que`=? WHERE `tsk_seq`=?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($tasks->sys_seq, $tasks->bus_seq, $tasks->wk_seq, $tasks->tsk_name, $tasks->tsk_que, $tasks->tsk_seq));

        var_dump($tasks);
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

}

function updateTaskStts($tasks){

    try {

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        $sql = "UPDATE `tasks` SET `tsk_k1`=?,`tsk_k2`=?,`tsk_i1`=? ,`tsk_i2`=?,`tsk_i3`=?,`tsk_i4`=?,`tsk_i5`=?,`tsk_i6`=?,`tsk_i7`=?,`tsk_i8`=?,`tsk_i9`=?,`tsk_i10`=? WHERE `tsk_seq`=?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array( $tasks->tsk_k1 , $tasks->tsk_k2 , $tasks->tsk_i1, $tasks->tsk_i2, $tasks->tsk_i3, $tasks->tsk_i4, $tasks->tsk_i5, $tasks->tsk_i6, $tasks->tsk_i7, $tasks->tsk_i8, $tasks->tsk_i9, $tasks->tsk_i10, $tasks->tsk_seq));

        var_dump($tasks);
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

}

function deleteTask($tasks){

    try {

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        $sql = "DELETE FROM `tasks` WHERE `tsk_seq`=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($tasks->tsk_seq));

        //リナンバリング
        $sql = "SET @rownum=0;";
        $sql .= "UPDATE tasks t1, (";
        $sql .= "SELECT @rownum:=@rownum+1 as ROWNUM, tsk_seq FROM tasks WHERE `wk_seq`=? ORDER BY tsk_que";
        $sql .= ") AS t2  SET t1.`tsk_que`=t2.ROWNUM  ";
        $sql .= "WHERE t1.tsk_seq=t2.tsk_seq;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($tasks->wk_seq));


    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

}

?>