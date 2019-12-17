<?php

class cls_serials
{
    public $s_seq ;
    public $s_title ;
    public $s_qty ;
    public $createdt ;
    public $users_seq ;
}

class cls_serialcodes
{
    public $sc_seq ;
    public $s_seq ;
    public $c_code ;
    public $entrydt ;
    public $sc_point ;
    public $c_seq ;
}

function getSerials()
{
    try {
        $results = array();
        require './db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM  `serials` ORDER BY s_seq");
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new cls_serials();
            $result->s_seq = $row['s_seq'];
            $result->s_title = $row['s_title'];
            $result->s_qty = $row['s_qty'];
            $result->createdt = $row['createdt'];
            $result->users_seq = $row['users_seq'];
            array_push($results, $result);
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (strcmp("1", $ini['debug'])==0) {
            echo $e->getMessage();
        }
    }
    return $results;
}

function getSerial($sSeq)
{
    try {
        $result = new cls_serials();
        require './db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM `serials` WHERE s_seq=:s_seq");
        $stmt->bindParam(':s_seq', $sSeq, PDO::PARAM_INT);
        $stmt->execute();
        if ($row = $stmt->fetch()) {
            $result->s_seq = $row['s_seq'];
            $result->s_title = $row['s_title'];
            $result->s_qty = $row['s_qty'];
            $result->createdt = $row['createdt'];
            $result->users_seq = $row['users_seq'];
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (strcmp("1", $ini['debug'])==0) {
            echo $e->getMessage();
        }
    }
    return $result;
}


function countSCodes($sSeq)
{
    $cnt=0;
    try {
        require './db/dns.php';
        $sql = " SELECT count(*) AS cnt FROM `serialcodes`WHERE entrydt IS NOT NULL AND s_seq=:s_seq";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':s_seq', $sSeq, PDO::PARAM_INT);
        $stmt->execute();
        if ($row = $stmt->fetch()) {
            $cnt = $row['cnt'];
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (strcmp("1", $ini['debug'])==0) {
            echo $e->getMessage();
        }
    }
    return $cnt;
}


function insertSerials($serials)
{
    try {
        require './db/dns.php';
        $sql = "INSERT  INTO `serials` (  `s_title`,  `s_qty`,  `users_seq`) VALUES (:s_title, :s_qty, :users_seq)";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':s_title', $serials->s_title, PDO::PARAM_STR);
        $stmt->bindParam(':s_qty', $serials->s_qty, PDO::PARAM_INT);
        $stmt->bindParam(':users_seq', $serials->users_seq, PDO::PARAM_INT);
        $stmt->execute();

        $insertid = $pdo->lastInsertId();
        $stmt->closeCursor();

        $fp = fopen("./output/".$insertid.".csv", "w");

        //シリアルコード生成
        //YY/MM/DDを取得する
        $ymd = substr(date("Ymd"), 2);

        //指定回数をLOOPする
        for ($i = 1; $i <= $serials->s_qty; $i++) {
            //LOOP回数の１桁だけ使用する（キーコード）
            $j = substr($i, -1);
            //LOOP回数を０埋めし５桁にする
            $num = sprintf('%05d', $i);
            //日付とカウントを配列化する
            $tmp1 = str_split($ymd);
            $tmp2 = str_split($num);
            //サンドする
            $tmp3 = $tmp1[0].$tmp2[0].$tmp1[1].$tmp2[1].$tmp1[2].$tmp2[2].$tmp1[3].$tmp2[3].$tmp1[4].$tmp2[4].$tmp1[5];
            //文字列を配列化する
            $tmp4 = str_split($tmp3);
            //各桁にキーコードを加算する
            $tmp5 = "";
            foreach ($tmp4 as $tmpA) {
                //10を超える場合は、下１桁だけ使用する
                $tmp5 .= substr($tmpA+$j, -1);
            }
            //キーコード分だけ文字を入れ替え、末尾にキーコードを付与する
            if ($j==0) {
                $sCode = $tmp3 . $j;
            }else{
                $sCode = substr($tmp5, -1 *$j) . substr($tmp5, 0, 11-$j) . $j;
            }

            $sql = "INSERT INTO `serialcodes` (`s_seq`, `sc_code`) VALUES (:s_seq,:sc_code)";
            $stmt = $pdo -> prepare($sql);
            $stmt->bindParam(':s_seq', $insertid, PDO::PARAM_INT);
            $stmt->bindParam(':sc_code', $sCode, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();
            fwrite($fp, $sCode. "\r\n");
        }

        fclose($fp);

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (strcmp("1", $ini['debug'])==0) {
            echo $e->getMessage();
        }
    }
    return $errorMessage ;
}

function updateSerials($serials)
{
    try {
        require './db/dns.php';
        $sql = " UPDATE `serials` SET  `s_title`=:s_title WHERE s_seq=:s_seq";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':s_seq', $serials->s_seq, PDO::PARAM_INT);
        $stmt->bindParam(':s_title', $serials->s_title, PDO::PARAM_STR);
        $stmt->execute();
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (strcmp("1", $ini['debug'])==0) {
            echo $e->getMessage();
        }
    }
}


function deleteSerials($sSeq)
{
    $cnt=0;
    try {
        require './db/dns.php';
        $sql = " DELETE FROM `serials`WHERE s_seq=:s_seq";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':s_seq', $sSeq, PDO::PARAM_INT);
        $stmt->execute();

        $sql = " DELETE FROM `serialcodes`WHERE s_seq=:s_seq";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':s_seq', $sSeq, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (strcmp("1", $ini['debug'])==0) {
            echo $e->getMessage();
        }
    }
    return $cnt;
}
