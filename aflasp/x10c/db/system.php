<?php


function getSystemUrl()
{
    try {
        $result = '';
        require 'dns.php';
        $stmt = $pdo->prepare("SELECT `home` FROM `system` ");
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = $row['home'];
        }
    } catch (PDOException $e) {
        //
    }
    return $result;
}



class cls_pref
{
    public $id ;
    public $name ;
}
 function getPrefectures()
 {
    $results = array();
     try {
         require 'dns.php';
         $stmt = $pdo->prepare("SELECT * FROM `prefectures` ORDER BY id");
         execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

         while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new cls_pref();
             $result->id = $row['id'];
             $result->name = $row['name'];
             array_push($results, $result);
         }
     } catch (PDOException $e) {
         //
     }
     return $results;
 }
