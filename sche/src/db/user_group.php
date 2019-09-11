<?php

  class cls_user_group{
    public $users_seq=0;
    public $groups_seq=0;
    public $groups_id="";

  }

  function getUserGroupListByGID($gSeq){

    $results = array();
    
    try {
        
            require $_SESSION["MY_ROOT"].'/src/db/dns.php';

            //グループ情報を取得する
            $aGroup = getGroup($gSeq);

            $stmt = $pdo->prepare("SELECT * FROM v_user_group WHERE groups_id LIKE '".$aGroup->groups_id."%'");
            $stmt->execute(array());
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                $result = new cls_user_group();
                $result->users_seq = $row['users_seq'];
                $result->groups_seq = $row['groups_seq'];
                $result->groups_id = $row['groups_id'];

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

    function getUserGroupListByUID($uSeq){

        $results = array();
        
        try {
            
                require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        
                $stmt = $pdo->prepare("SELECT * FROM v_user_group WHERE users_seq=?");
                $stmt->execute(array($uSeq));
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    
                    $result = new cls_user_group();
                    $result->users_seq = $row['users_seq'];
                    $result->groups_seq = $row['groups_seq'];
                    $result->groups_id = $row['groups_id'];
    
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