<?php

  class cls_schedules{
    public $sche_seq=0;
    public $users_seq;
    public $users_name;
    public $users_name_short;
    public $sche_start_dt;
    public $sche_start_ymd;
    public $sche_start_hm;
    public $sche_end_dt;
    public $sche_end_ymd;
    public $sche_end_hm;
    public $sche_title;
    public $sche_title_m;
    public $sche_title_s;
    public $sche_note;
    public $sche_type;
    public $sche_color;
    public $sche_mark;
    public $sche_allday;
    public $rooms_seq;
    public $rooms_name;



  }


  function getSchedules($sSeq){

    $result = new cls_schedules();

    try {
        
            require_once $_SESSION["MY_ROOT"].'/src/db/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM v_schedules_user WHERE sche_seq=? ");
            $stmt->execute(array($sSeq));

            if ($row = $stmt->fetch()) {
                $result->sche_seq = $row['sche_seq'];
                $result->users_seq = $row['users_seq'];
                $result->sche_start_dt = $row['sche_start_dt'];
                $result->sche_start_ymd = $row['sche_start_ymd'];
                $result->sche_start_hm = $row['sche_start_hm'];
                $result->sche_end_dt = $row['sche_end_dt'];
                $result->sche_end_ymd = $row['sche_end_ymd'];
                $result->sche_end_hm = $row['sche_end_hm'];
                $result->sche_title = $row['sche_title'];
                $result->sche_title_s = mb_substr($row['sche_title'],0,5);
                $result->sche_note = $row['sche_note'];
                $result->sche_type = $row['sche_type'];
                $result->sche_allday = $row['sche_allday'];
                $result->rooms_seq = $row['rooms_seq'];
                $result->rooms_name = $row['rooms_name'];
                
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



  function getSchedulesYMD($y,$m,$d){

    try {
        
            $results = array();

            $timestamp = strtotime($y . '-' . $m . '-' . $d);
            $ymd = date('Ymd', $timestamp);

            $result = new cls_schedules();

            require_once $_SESSION["MY_ROOT"].'/src/db/dns.php';
            $uSeq = $_SESSION['SEQ'];


            //自分の許可されているグループを取得する
            require_once $_SESSION["MY_ROOT"].'/src/db/user_group.php';
            $vUGs = array();
            $vUGs = getUserGroupListByUID($uSeq);

            $sql = "";
            foreach($vUGs as $vUG ){
                $stmt = $pdo->prepare("SELECT * FROM v_schedules WHERE sche_start_ymd<=? AND sche_end_ymd>=? AND groups_id LIKE ? AND (users_seq=? OR sche_type=1)");
                $stmt->execute(array($ymd,$ymd,$vUG->groups_id."%",$uSeq ));
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $sql .= " OR  sche_seq=".$row['sche_seq']; 
                }

            }

            // OR句を用いてスケジュールを取得
            $sql = substr($sql,4);

            $stmt = $pdo->prepare("SELECT * FROM v_schedules_user WHERE ".$sql." ORDER BY sche_start_dt");
            $stmt->execute(array());

            //$stmt = $pdo->prepare("SELECT s.*,u.users_name FROM schedules s LEFT JOIN users u ON u.users_seq = s.users_seq  WHERE s.users_seq=? AND s.sche_start_ymd<=? AND s.sche_end_ymd>=? ORDER BY s.sche_start_dt");
            //$stmt->execute(array($uSeq,$ymd,$ymd));

            require_once $_SESSION["MY_ROOT"].'/src/colors.php';
            $i = 0;

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $result = new cls_schedules();
                $result->sche_seq = $row['sche_seq'];
                $result->users_seq = $row['users_seq'];
                $result->users_name = $row['users_name'];
                $uName = $result->users_name;
                $fNames = explode(" ", $uName);
                $fName = explode("　", $fNames[0]);
                $result->users_name_short = $fName[0];
                $result->sche_start_dt = $row['sche_start_dt'];
                $result->sche_start_ymd = $row['sche_start_ymd'];
                $result->sche_start_hm = $row['sche_start_hm'];
                $result->sche_end_dt = $row['sche_end_dt'];
                $result->sche_end_ymd = $row['sche_end_ymd'];
                $result->sche_end_hm = $row['sche_end_hm'];
                $result->sche_title = $row['sche_title'];
                $result->sche_title_m = mb_substr($row['sche_title'],0,7);
                if($result->sche_title<>$result->sche_title_m){
                    $result->sche_title_m .= "..";
                }
                $result->sche_title_s = mb_substr($row['sche_title'],0,5);
                $result->sche_note = $row['sche_note'];
                $result->sche_type = $row['sche_type'];
                $result->sche_allday = $row['sche_allday'];
                $result->rooms_seq = $row['rooms_seq'];
                $result->rooms_name = $row['rooms_name'];
                if($uSeq==$result->users_seq){
                    $result->sche_mark = "●";
                }else{
                    $result->sche_mark = "◆";
                }
                $result->sche_color = getColor($i);
                $i++;

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


    function getSchedulesYMDwithRoom($y,$m,$d){

        try {
            
            $results = array();

            $timestamp = strtotime($y . '-' . $m . '-' . $d);
            $ymd = date('Ymd', $timestamp);

            $result = new cls_schedules();

            require $_SESSION["MY_ROOT"].'/src/db/dns.php';
            $uSeq = $_SESSION['SEQ'];
            $stmt = $pdo->prepare("SELECT * FROM schedules WHERE sche_start_ymd<=? AND sche_end_ymd>=? AND rooms_seq<>0");
            $stmt->execute(array($ymd,$ymd ));
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $sql .= " OR  sche_seq=".$row['sche_seq'];     
            }

            // OR句を用いてスケジュールを取得
            $sql = substr($sql,4);

            $stmt = $pdo->prepare("SELECT * FROM v_schedules_user WHERE ".$sql." ORDER BY sche_start_dt");
            $stmt->execute(array());
        
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $result = new cls_schedules();
                $result->sche_seq = $row['sche_seq'];
                $result->users_seq = $row['users_seq'];
                $result->users_name = $row['users_name'];
                $uName = $result->users_name;
                $fNames = explode(" ", $uName);
                $fName = explode("　", $fNames[0]);
                $result->users_name_short = $fName[0];
                $result->sche_start_dt = $row['sche_start_dt'];
                $result->sche_start_ymd = $row['sche_start_ymd'];
                $result->sche_start_hm = $row['sche_start_hm'];
                $result->sche_end_dt = $row['sche_end_dt'];
                $result->sche_end_ymd = $row['sche_end_ymd'];
                $result->sche_end_hm = $row['sche_end_hm'];
                $result->sche_title = $row['sche_title'];
                $result->sche_title_m = mb_substr($row['sche_title'],0,7);
                if($result->sche_title<>$result->sche_title_m){
                    $result->sche_title_m .= "..";
                }
                $result->sche_title_s = mb_substr($row['sche_title'],0,5);
                $result->sche_note = $row['sche_note'];
                $result->sche_type = $row['sche_type'];
                $result->sche_allday = $row['sche_allday'];
                $result->rooms_seq = $row['rooms_seq'];
                $result->rooms_name = $row['rooms_name'];
                $i++;

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
    

    function getSchedulesYM($y,$m){

        try {
            
            $results = array();

            $ym = $y."".$m;

            $timestamp = strtotime($y . '-' . $m . '-' . $d);
            $ymd = date('Ymd', $timestamp);

            $result = new cls_schedules();

            require_once $_SESSION["MY_ROOT"].'/src/db/dns.php';
            $uSeq = $_SESSION['SEQ'];



            //自分の許可されているグループを取得する
            require_once $_SESSION["MY_ROOT"].'/src/db/user_group.php';
            $vUGs = array();
            $vUGs = getUserGroupListByUID($uSeq);
            //対象のSEQを取得し、OR句を整形
            $sql = ""; 
            foreach($vUGs as $vUG ){

                //スケジュール
                $stmt = $pdo->prepare("SELECT * FROM v_schedules WHERE sche_start_ym<=? AND sche_end_ym>=? AND groups_id LIKE ? AND (users_seq=? OR sche_type=1)");
                $stmt->execute(array($ym,$ym,$vUG->groups_id."%",$uSeq ));
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $sql .= " OR  sche_seq=".$row['sche_seq']; 
                }
                
            }

            // OR句を用いてスケジュールを取得
            $sql = substr($sql,4);
            $stmt = $pdo->prepare("SELECT * FROM v_schedules_user WHERE ".$sql." ORDER BY sche_start_dt");
            $stmt->execute(array());

            require_once $_SESSION["MY_ROOT"].'/src/colors.php';
            $i = 0;

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $result = new cls_schedules();
                $result->sche_seq = $row['sche_seq'];
                $result->users_seq = $row['users_seq'];
                $result->users_name = $row['users_name'];
                $uName = $result->users_name;
                $fNames = explode(" ", $uName);
                $fName = explode("　", $fNames[0]);
                $result->users_name_short = $fName[0];
                $result->sche_start_dt = $row['sche_start_dt'];
                $result->sche_start_ymd = $row['sche_start_ymd'];
                $result->sche_start_hm = $row['sche_start_hm'];
                $result->sche_end_dt = $row['sche_end_dt'];
                $result->sche_end_ymd = $row['sche_end_ymd'];
                $result->sche_end_hm = $row['sche_end_hm'];
                $result->sche_title = $row['sche_title'];
                $result->sche_title_m = mb_substr($row['sche_title'],0,7);
                if($result->sche_title<>$result->sche_title_m){
                    $result->sche_title_m .= "..";
                }
                $result->sche_title_s = mb_substr($row['sche_title'],0,5);
                $result->sche_note = $row['sche_note'];
                $result->sche_type = $row['sche_type'];
                $result->sche_allday = $row['sche_allday'];
                $result->rooms_seq = $row['rooms_seq'];
                if($uSeq==$result->users_seq){
                    $result->sche_mark = "●";
                }else{
                    $result->sche_mark = "◆";
                }
                $result->sche_color = getColor($i);
                $i++;

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
    


    function getSchedulesYMwithRoom($y,$m){

        try {
            
            $results = array();

            $ym = $y."".$m;

            $timestamp = strtotime($y . '-' . $m . '-' . $d);
            $ymd = date('Ymd', $timestamp);

            $result = new cls_schedules();

            require $_SESSION["MY_ROOT"].'/src/db/dns.php';
            $uSeq = $_SESSION['SEQ'];

            $stmt = $pdo->prepare("SELECT * FROM schedules WHERE sche_start_ym<=? AND sche_end_ym>=? AND rooms_seq<>0");
            $stmt->execute(array($ym,$ym));
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $sql .= " OR  sche_seq=".$row['sche_seq']; 
            }
            
            // OR句を用いてスケジュールを取得
            $sql = substr($sql,4);
            $stmt = $pdo->prepare("SELECT * FROM v_schedules_user WHERE ".$sql." ORDER BY sche_start_dt");
            $stmt->execute(array());

            require_once $_SESSION["MY_ROOT"].'/src/colors.php';
            $i = 0;

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $result = new cls_schedules();
                $result->sche_seq = $row['sche_seq'];
                $result->users_seq = $row['users_seq'];
                $result->users_name = $row['users_name'];
                $uName = $result->users_name;
                $fNames = explode(" ", $uName);
                $fName = explode("　", $fNames[0]);
                $result->users_name_short = $fName[0];
                $result->sche_start_dt = $row['sche_start_dt'];
                $result->sche_start_ymd = $row['sche_start_ymd'];
                $result->sche_start_hm = $row['sche_start_hm'];
                $result->sche_end_dt = $row['sche_end_dt'];
                $result->sche_end_ymd = $row['sche_end_ymd'];
                $result->sche_end_hm = $row['sche_end_hm'];
                $result->sche_title = $row['sche_title'];
                $result->sche_title_m = mb_substr($row['sche_title'],0,7);
                if($result->sche_title<>$result->sche_title_m){
                    $result->sche_title_m .= "..";
                }
                $result->sche_title_s = mb_substr($row['sche_title'],0,5);
                $result->sche_note = $row['sche_note'];
                $result->sche_type = $row['sche_type'];
                $result->sche_allday = $row['sche_allday'];
                $result->rooms_seq = $row['rooms_seq'];
                $result->rooms_name = $row['rooms_name'];
                $result->sche_mark = "";
                $result->sche_color = getColor($i);
                $i++;

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


    function getMySchedulesYM($y,$m){

        try {
            
            $results = array();

            $ym = $y."".$m;

            $timestamp = strtotime($y . '-' . $m . '-' . $d);
            $ymd = date('Ymd', $timestamp);

            $result = new cls_schedules();

            require $_SESSION["MY_ROOT"].'/src/db/dns.php';
            $uSeq = $_SESSION['SEQ'];

            // 自分のスケジュールを取得
            $stmt = $pdo->prepare("SELECT * FROM v_schedules WHERE sche_start_ym<=? AND sche_end_ym>=? AND users_seq=? ORDER BY sche_start_dt");
            $stmt->execute(array($ym,$ym,$uSeq));

            require_once $_SESSION["MY_ROOT"].'/src/colors.php';
            $i = 0;

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
                $result->sche_title_m = mb_substr($row['sche_title'],0,7);
                if($result->sche_title<>$result->sche_title_m){
                    $result->sche_title_m .= "..";
                }
                $result->sche_title_s = mb_substr($row['sche_title'],0,5);
                $result->sche_note = $row['sche_note'];
                $result->sche_type = $row['sche_type'];
                $result->sche_allday = $row['sche_allday'];
                $result->rooms_seq = $row['rooms_seq'];
                if($uSeq==$result->users_seq){
                    $result->sche_mark = "●";
                }else{
                    $result->sche_mark = "◆";
                }
                $result->sche_color = getColor($i);
                $i++;

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
    

    function insertSchedule($sche){

        try {
            require $_SESSION["MY_ROOT"].'/src/db/dns.php';
    
            $sql = "INSERT INTO `schedules`(`users_seq`, `sche_start_dt`, `sche_start_ymd`, `sche_start_ym`, `sche_start_hm`, `sche_end_dt`, `sche_end_ymd`, `sche_end_ym`, `sche_end_hm`, `sche_title`, `sche_note`, `sche_type`, `sche_allday`, `rooms_seq`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    
            $stmt = $pdo->prepare($sql);
            var_dump($sche);
            $stmt->execute(array( $sche->users_seq , $sche->sche_start_dt  , $sche->sche_start_ymd  , $sche->sche_start_ym , $sche->sche_start_hm , $sche->sche_end_dt  , $sche->sche_end_ymd  , $sche->sche_end_ym  , $sche->sche_end_hm , $sche->sche_title  , $sche->sche_note  , $sche->sche_type , $sche->sche_allday, $sche->rooms_seq ));
    echo "E";
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
            if(strcmp("1",$ini['debug'])==0){
                echo $e->getMessage();
            }
        }
    
    }
    
    function updateSchedule($sche){

        try {
    
            require $_SESSION["MY_ROOT"].'/src/db/dns.php';
    
            $sql = "UPDATE `schedules` SET `sche_start_dt`=?,`sche_start_ymd`=?,`sche_start_ym`=?,`sche_start_hm`=?,`sche_end_dt`=?,`sche_end_ymd`=?,`sche_end_ym`=?,`sche_end_hm`=?,`sche_title`=?,`sche_note`=?,`sche_type`=?,`sche_allday`=?, `rooms_seq`=?  WHERE `sche_seq`=?";
    
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array( $sche->sche_start_dt  , $sche->sche_start_ymd  ,$sche->sche_start_ym  , $sche->sche_start_hm , $sche->sche_end_dt  , $sche->sche_end_ymd  , $sche->sche_end_ym  , $sche->sche_end_hm , $sche->sche_title  , $sche->sche_note  , $sche->sche_type,  $sche->sche_allday, $sche->rooms_seq , $sche->sche_seq ));
    
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
            if(strcmp("1",$ini['debug'])==0){
                echo $e->getMessage();
            }
        }
    
    }

    function checkRoomSchedule($sche){

        try {
            
            $results = array();
    
            require $_SESSION["MY_ROOT"].'/src/db/dns.php';
    
            $sql = "SELECT * FROM schedules WHERE rooms_seq<>0 AND rooms_seq=:roomSeq AND sche_seq<>:scheSeq AND ";
            $sql .= "(";
            $sql .= "(sche_start_dt <= :endDt AND sche_end_dt >= :startDt ) OR ";
            $sql .= "(:startDt BETWEEN sche_start_dt AND sche_end_dt ) OR ";
            $sql .= "(:endDt BETWEEN sche_start_dt AND sche_end_dt ) OR ";
            $sql .= "(sche_start_dt >= :startDt AND sche_end_dt <= :endDt ) ";
            $sql .= ")";
                
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':scheSeq', $sche->sche_seq, PDO::PARAM_INT);
            $stmt->bindValue(':roomSeq', $sche->rooms_seq, PDO::PARAM_INT);
            $stmt->bindValue(':startDt', $sche->sche_start_dt, PDO::PARAM_STR);
            $stmt->bindValue(':endDt', $sche->sche_end_dt, PDO::PARAM_STR);
            $stmt->execute();
    

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $result = new cls_schedules();
                $result->sche_seq = $row['sche_seq'];
                $result->users_seq = $row['users_seq'];
                $result->users_name = $row['users_name'];
                $uName = $result->users_name;
                $fNames = explode(" ", $uName);
                $fName = explode("　", $fNames[0]);
                $result->users_name_short = $fName[0];
                $result->sche_start_dt = $row['sche_start_dt'];
                $result->sche_start_ymd = $row['sche_start_ymd'];
                $result->sche_start_hm = $row['sche_start_hm'];
                $result->sche_end_dt = $row['sche_end_dt'];
                $result->sche_end_ymd = $row['sche_end_ymd'];
                $result->sche_end_hm = $row['sche_end_hm'];
                $result->sche_title = $row['sche_title'];
                $result->sche_title_m = mb_substr($row['sche_title'],0,7);
                if($result->sche_title<>$result->sche_title_m){
                    $result->sche_title_m .= "..";
                }
                $result->sche_title_s = mb_substr($row['sche_title'],0,5);
                $result->sche_note = $row['sche_note'];
                $result->sche_type = $row['sche_type'];
                $result->sche_allday = $row['sche_allday'];
                $result->rooms_seq = $row['rooms_seq'];
                if($uSeq==$result->users_seq){
                    $result->sche_mark = "●";
                }else{
                    $result->sche_mark = "◆";
                }
                $i++;

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
    
    function deleteSchedule($sche){

        try {
    
            require $_SESSION["MY_ROOT"].'/src/db/dns.php';
    
            $sql = "DELETE FROM `schedules` WHERE `sche_seq`=?";
    
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array( $sche->sche_seq ));
    
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
            if(strcmp("1",$ini['debug'])==0){
                echo $e->getMessage();
            }
        }
    
    }
    




?>