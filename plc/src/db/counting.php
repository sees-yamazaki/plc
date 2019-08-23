<?php
function getEmployeeNo(){

    try {
        $ini = parse_ini_file('../common.ini', FALSE);
        $pdo = new PDO('mysql:dbname=' . $ini['dbname'] . ';host=' . $ini['host'] , $ini['dbuser'] , $ini['dbpass'] );

        //現在の値を取得する
        $stmt = $pdo->query("select * from counting");
        $row = $stmt->fetch();
        $no = intval($row["employee_no"]);

        do {
            $no++; 
            $employee_id = sprintf('%04d', $no);
            $stmt = $pdo->query("select * from employee where employee_id=".$employee_id);
            if($row = $stmt->fetch()){
                //レコードが存在しているので使用できない
            }else{
                break;
            }
        } while (0);

        $stmt = $pdo->prepare("update counting set employee_no = ?");
        $stmt->execute(array($no));

        return $no;

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }
}




function getJobNo(){

    try {
        $ini = parse_ini_file('../common.ini', FALSE);
        $pdo = new PDO('mysql:dbname=' . $ini['dbname'] . ';host=' . $ini['host'] , $ini['dbuser'] , $ini['dbpass'] );

        $stmt = $pdo->prepare("update counting t1, counting t2 set t1.job_no = (t2.job_no + 1)");
        $stmt->execute(array($no));

        $stmt = $pdo->query("select * from counting");
        $row = $stmt->fetch();
        $no = intval($row["job_no"]);

        return $no;

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }
}

?>
