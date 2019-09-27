<?php

  class cls_relut{
    public $an_id;
    public $sum_value;
    public $types_seq=0;
    public $types_id;
    public $types_name;
    public $types_note;
  }


  function getResults($an_id){

    try {
    
        $results = array();

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT t.*,v.sum_value FROM types t LEFT JOIN v_result v ON t.types_seq=v.types_seq and v.an_id = ? ORDER BY v.sum_value DESC");
        $stmt->execute(array($an_id));

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result = new cls_relut();
            $result->an_id = $row['an_id'];
            $result->types_id = $row['types_id'];
            $result->types_name = $row['types_name'];
            $result->types_note = $row['types_note'];
            $result->sum_value = $row['sum_value'];

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