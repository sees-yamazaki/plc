<?php

  class cls_schedules{
    public $sche_seq=0;
    public $users_seq="";
    public $users_name="";
    public $sche_start_dt="";
    public $sche_start_ymd="";
    public $sche_start_hm="";
    public $sche_end_dt="";
    public $sche_end_ymd="";
    public $sche_end_hm="";
    public $sche_title="";
    public $sche_note="";
    public $sche_type="";



  }

  function getSchedulesYMD($y,$m,$d){

    try {
        
            $results = array();

            $timestamp = strtotime($y . '-' . $m . '-' . $d);
            $ymd = date('Ymd', $timestamp);

            $result = new cls_schedules();

            require_once $_SESSION["MY_ROOT"].'/src/db/dns.php';
            $uSeq = $_SESSION['SEQ'];
            $stmt = $pdo->prepare("SELECT s.*,u.users_name FROM schedules s LEFT JOIN users u ON u.users_seq = s.users_seq  WHERE s.users_seq=? AND s.sche_start_ymd>=? AND s.sche_end_ymd<=? ORDER BY s.sche_start_dt");
            $stmt->execute(array($uSeq,$ymd,$ymd));

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $result = new cls_schedules();
                $result->sche_seq = $row['sche_seq'];
                $result->users_seq = $row['users_seq'];
                $result->users_name = $row['users_name'];
                $result->sche_start_dt = $row['sche_start_dt'];
                $result->sche_start_ymd = $row['sche_start_ymd'];
                $result->sche_start_hm = $row['sche_start_hm'];
                $result->sche_end_dt = $row['sche_end_dt'];
                $result->sche_end_ymd = $row['sche_end_ymd'];
                $result->sche_end_hm = $row['sche_end_hm'];
                $result->sche_title = $row['sche_title'];
                $result->sche_note = $row['sche_note'];
                $result->sche_type = $row['sche_type'];

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

?>