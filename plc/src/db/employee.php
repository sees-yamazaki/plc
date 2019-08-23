<?php

  class cls_employee{
    public $employee_seq=0;
    public $employee_id="";
    public $employee_pw="";
    public $employee_level=0;
    public $status=0;
    public $group_seq=0;
    public $kind=0;
    public $insurance=0;
    public $name_kana="";
    public $name="";
    public $sex=0;
    public $birthday="";
    public $post="";
    public $address_kana="";
    public $address="";
    public $tel1="";
    public $tel2="";
    public $answering=0;
    public $fax="";
    public $email1="";
    public $email2="";
    public $priority_email="";
    public $route="";
    public $station="";
    public $bus=0;
    public $bus_name="";
    public $bus_stop="";
    public $bank_kana="";
    public $bank="";
    public $branch_code="";
    public $branch_kana="";
    public $branch="";
    public $account="";
    public $education_from="";
    public $education_to="";
    public $school="";
    public $graduate="";
    public $recruit="";
    public $work1_from="";
    public $work1_to="";
    public $work1_status="";
    public $work1_company="";
    public $work1_location="";
    public $work1_job="";
    public $work2_from="";
    public $work2_to="";
    public $work2_status="";
    public $work2_company="";
    public $work2_location="";
    public $work2_job="";
    public $work3_from="";
    public $work3_to="";
    public $work3_status="";
    public $work3_company="";
    public $work3_location="";
    public $work3_job="";
    public $work4_from="";
    public $work4_to="";
    public $work4_status="";
    public $work4_company="";
    public $work4_location="";
    public $work4_job="";
    public $work5_from="";
    public $work5_to="";
    public $work5_status="";
    public $work5_company="";
    public $work5_location="";
    public $work5_job="";
    public $work_remarks="";
    public $emergency_kana="";
    public $emergency="";
    public $tel10="";
    public $tel11="";
    public $priority_tel=0;
    public $post2="";
    public $address2="";
    public $remarks="";
    public $alert_time=0;
    public $pay_type=0;
    public $pay_unitcost=0;
    public $sales_unitcost=0;
    public $transport_unitcosts=0;
    public $pass_cost=0;
    public $alert_mail_0="";
    public $alert_mail_1="";
    public $alert_mail_2="";
    public $alert_mail_3="";
    public $alert_mail_4="";
    private $create_date="";
    public $user_seq=0;


    function getAllUser(){

        try {
            $ini = parse_ini_file('../common.ini', FALSE);
            $pdo = new PDO('mysql:dbname=' . $ini['dbname'] . ';charset=utf8;host=' . $ini['host'] , $ini['dbuser'] , $ini['dbpass'] );
    
            //現在の値を取得する
            $stmt = $pdo->query("SELECT * FROM employee where (employee_level=2 or employee_level=3)  order by employee_seq'");
            $row = $stmt->fetch();
    
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $employee = new cls_employee();
                $employee->$status = $row['status'];
                $employee->$name = $row['name'];




            }


    
            return $no;
    
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
            if(strcmp("1",$ini['debug'])==0){
                echo $e->getMessage();
            }
        }

    }
  }

?>