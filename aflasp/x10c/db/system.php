<?php

class cls_sys
{
    public $mail_address ;
    public $mail_name ;
    public $site_title ;
    public $home ;
}

function getSystem()
{
    try {
        $result = new cls_pref();
        require 'dns.php';
        $stmt = $pdo->prepare("SELECT * FROM `system` ");
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $result->mail_address = $row['mail_address'];
        $result->mail_name = $row['mail_name'];
        $result->site_title = $row['site_title'];
        $result->home = $row['home'];

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
 function getPrefectureByName($prefName)
 {
     $result = 0;
     try {
         require 'dns.php';
         $stmt = $pdo->prepare("SELECT * FROM `prefectures` WHERE name=:name");
         $stmt->bindParam(':name', $prefName, PDO::PARAM_STR);
         execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

         $row = $stmt->fetch(PDO::FETCH_ASSOC);
         $result = $row['id'];

        } catch (PDOException $e) {
         //
     }
     return $result;
 }
