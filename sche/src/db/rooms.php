<?php

  class cls_rooms{
    public $rooms_seq=0;
    public $rooms_name="";
    public $rooms_text="";
    public $del_flg=0;
  }


function getRooms(){

    try {
    
        $results = array();

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM rooms WHERE del_flg=0 ORDER BY rooms_seq");
        $stmt->execute(array());

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result = new cls_rooms();
            $result->rooms_seq = $row['rooms_seq'];
            $result->rooms_name = $row['rooms_name'];
            $result->rooms_text = $row['rooms_text'];

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

function getRoom($rSeq){

    try {
    
        $result = new cls_rooms();

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM rooms WHERE rooms_seq=?");
        $stmt->execute(array($rSeq));
        if ($row = $stmt->fetch()) {
            $result->rooms_seq = $row['rooms_seq'];
            $result->rooms_name = $row['rooms_name'];
            $result->rooms_text = $row['rooms_text'];
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



function insertRoom($room){

    try {

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        $sql = "INSERT INTO `rooms`( `rooms_name`, `rooms_text`) VALUES (?,?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array( $room->rooms_name , $room->rooms_text));

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

}

function updateRoom($room){

    try {

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        $sql = "UPDATE `rooms` SET `rooms_name`=?,`rooms_text`=? WHERE `rooms_seq`=?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array( $room->rooms_name , $room->rooms_text  , $room->rooms_seq));

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

}


function deleteRoom($room){

    try {

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        $sql = "UPDATE `rooms` SET `del_flg`=1 WHERE `rooms_seq`=?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($room->rooms_seq));

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

}


?>