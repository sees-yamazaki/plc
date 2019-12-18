<?php

class cls_infos
{
    public $infos_seq ;
    public $users_seq ;
    public $users_name ;
    public $title1 ;
    public $title2 ;
    public $createdate ;
    public $k_seq ;
    public $d2 ;
    public $d3 ;
    public $d4 ;
    public $d6 ;
    public $d8 ;
    public $f8 ;
    public $d11 ;
    public $d12 ;
    public $e13 ;
    public $d29 ;
    public $d30 ;
    public $d31 ;
    public $l29 ;
    public $l30 ;
    public $l31 ;
    public $d49 ;
    public $d50 ;
    public $e51 ;
    public $c68 ;
    public $c69 ;
    public $l73 ;
    public $c88 ;
    public $c89 ;
    public $i18 ;
    public $i56 ;
    public $a1r ;
    public $a6r ;
    public $a11r ;
    public $a26r ;
    public $a29r ;
    public $a44r ;
    public $a51r ;
    public $a62r ;
    public $a75r ;
    public $a87r ;
    public $a96r ;
}

    function getinfos()
    {
        try {
            $results = array();

            require $_SESSION["MY_ROOT"].'/src/db/dns.php';
            $stmt = $pdo->prepare("SELECT infos.*, users.users_name FROM `infos` left join users on infos.users_seq=users.users_seq ORDER BY `infos_seq` desc");
            $stmt->execute(array());

    
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result = new cls_infos();
                $result->infos_seq = $row['infos_seq'];
                $result->users_seq = $row['users_seq'];
                $result->users_name = $row['users_name'];
                $result->title1 = $row['title1'];
                $result->title2 = $row['title2'];
                $result->createdate = $row['createdate'];
                $result->k_seq = $row['k_seq'];
                $result->d2 = $row['d2'];
                $result->d3 = $row['d3'];
                $result->d4 = $row['d4'];
                $result->d6 = $row['d6'];
                $result->d8 = $row['d8'];
                $result->f8 = $row['f8'];
                $result->d11 = $row['d11'];
                $result->d12 = $row['d12'];
                $result->e13 = $row['e13'];
                $result->d29 = $row['d29'];
                $result->d30 = $row['d30'];
                $result->d31 = $row['d31'];
                $result->l29 = $row['l29'];
                $result->l30 = $row['l30'];
                $result->l31 = $row['l31'];
                $result->d49 = $row['d49'];
                $result->d50 = $row['d50'];
                $result->e51 = $row['e51'];
                $result->c68 = $row['c68'];
                $result->c69 = $row['c69'];
                $result->l73 = $row['l73'];
                $result->c88 = $row['c88'];
                $result->c89 = $row['c89'];
                $result->i18 = $row['i18'];
                $result->i56 = $row['i56'];
                $result->a1r = $row['a1r'];
                $result->a6r = $row['a6r'];
                $result->a11r = $row['a11r'];
                $result->a26r = $row['a26r'];
                $result->a29r = $row['a29r'];
                $result->a44r = $row['a44r'];
                $result->a51r = $row['a51r'];
                $result->a62r = $row['a62r'];
                $result->a75r = $row['a75r'];
                $result->a87r = $row['a87r'];
                $result->a96r = $row['a96r'];
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
        
        function getinfo($iSeq)
        {
            $result = new cls_infos();
            try {
                require $_SESSION["MY_ROOT"].'/src/db/dns.php';
                $stmt = $pdo->prepare("SELECT infos.*, users.users_name FROM `infos` left join users on infos.users_seq=users.users_seq WHERE infos_seq=:infos_seq");
                $stmt->bindParam(':infos_seq', $iSeq, PDO::PARAM_INT);
                $stmt->execute();

                if ($row = $stmt->fetch()) {
                    $result->infos_seq = $row['infos_seq'];
                    $result->users_seq = $row['users_seq'];
                    $result->users_name = $row['users_name'];
                    $result->title1 = $row['title1'];
                    $result->title2 = $row['title2'];
                    $result->createdate = $row['createdate'];
                    $result->k_seq = $row['k_seq'];
                    $result->d2 = $row['d2'];
                    $result->d3 = $row['d3'];
                    $result->d4 = $row['d4'];
                    $result->d6 = $row['d6'];
                    $result->d8 = $row['d8'];
                    $result->f8 = $row['f8'];
                    $result->d11 = $row['d11'];
                    $result->d12 = $row['d12'];
                    $result->e13 = $row['e13'];
                    $result->d29 = $row['d29'];
                    $result->d30 = $row['d30'];
                    $result->d31 = $row['d31'];
                    $result->l29 = $row['l29'];
                    $result->l30 = $row['l30'];
                    $result->l31 = $row['l31'];
                    $result->d49 = $row['d49'];
                    $result->d50 = $row['d50'];
                    $result->e51 = $row['e51'];
                    $result->c68 = $row['c68'];
                    $result->c69 = $row['c69'];
                    $result->l73 = $row['l73'];
                    $result->c88 = $row['c88'];
                    $result->c89 = $row['c89'];
                    $result->i18 = $row['i18'];
                    $result->i56 = $row['i56'];
                    $result->a1r = $row['a1r'];
                    $result->a6r = $row['a6r'];
                    $result->a11r = $row['a11r'];
                    $result->a26r = $row['a26r'];
                    $result->a29r = $row['a29r'];
                    $result->a44r = $row['a44r'];
                    $result->a51r = $row['a51r'];
                    $result->a62r = $row['a62r'];
                    $result->a75r = $row['a75r'];
                    $result->a87r = $row['a87r'];
                    $result->a96r = $row['a96r'];
                }
            } catch (PDOException $e) {
                $errorMessage = `データベースエラー`;
                if (strcmp("1", $ini[`debug`])==0) {
                    echo $e->getMessage();
                }
            }
            return $result;
        }
        
        function insertinfos($infos)
        {
            try {
                require $_SESSION["MY_ROOT"].'/src/db/dns.php';
                $sql = "INSERT  INTO `infos` (  `users_seq`, `title1`,  `title2`,   `k_seq`,   `d2`,  `d3`,  `d4`,  `d6`,  `d8`,  `f8`,  `d11`,  `d12`,  `e13`,  `d29`,  `d30`,  `d31`,  `l29`,  `l30`,  `l31`,  `d49`,  `d50`,  `e51`,  `c68`,  `c69`,  `l73`,  `c88`,  `c89`,  `i18`,  `i56`,  `a1r`,  `a6r`,  `a11r`,  `a26r`,  `a29r`,  `a44r`,  `a51r`,  `a62r`,  `a75r`,  `a87r`,  `a96r`) VALUES (:users_seq, :title1, :title2, :k_seq, :d2, :d3, :d4, :d6, :d8, :f8, :d11, :d12, :e13, :d29, :d30, :d31, :l29, :l30, :l31, :d49, :d50, :e51, :c68, :c69, :l73, :c88, :c89, :i18, :i56, :a1r, :a6r, :a11r, :a26r, :a29r, :a44r, :a51r, :a62r, :a75r, :a87r, :a96r)";
                $stmt = $pdo -> prepare($sql);
                $stmt->bindParam(':users_seq', $_SESSION['SEQ'], PDO::PARAM_STR);
                $stmt->bindParam(':title1', $infos->title1, PDO::PARAM_STR);
                $stmt->bindParam(':title2', $infos->title2, PDO::PARAM_STR);
                $stmt->bindParam(':k_seq', $infos->k_seq, PDO::PARAM_INT);
                $stmt->bindParam(':d2', $infos->d2, PDO::PARAM_STR);
                $stmt->bindParam(':d3', $infos->d3, PDO::PARAM_STR);
                $stmt->bindParam(':d4', $infos->d4, PDO::PARAM_STR);
                $stmt->bindParam(':d6', $infos->d6, PDO::PARAM_STR);
                $stmt->bindParam(':d8', $infos->d8, PDO::PARAM_STR);
                $stmt->bindParam(':f8', $infos->f8, PDO::PARAM_STR);
                $stmt->bindParam(':d11', $infos->d11, PDO::PARAM_STR);
                $stmt->bindParam(':d12', $infos->d12, PDO::PARAM_STR);
                $stmt->bindParam(':e13', $infos->e13, PDO::PARAM_STR);
                $stmt->bindParam(':d29', $infos->d29, PDO::PARAM_STR);
                $stmt->bindParam(':d30', $infos->d30, PDO::PARAM_STR);
                $stmt->bindParam(':d31', $infos->d31, PDO::PARAM_STR);
                $stmt->bindParam(':l29', $infos->l29, PDO::PARAM_STR);
                $stmt->bindParam(':l30', $infos->l30, PDO::PARAM_STR);
                $stmt->bindParam(':l31', $infos->l31, PDO::PARAM_STR);
                $stmt->bindParam(':d49', $infos->d49, PDO::PARAM_STR);
                $stmt->bindParam(':d50', $infos->d50, PDO::PARAM_STR);
                $stmt->bindParam(':e51', $infos->e51, PDO::PARAM_STR);
                $stmt->bindParam(':c68', $infos->c68, PDO::PARAM_STR);
                $stmt->bindParam(':c69', $infos->c69, PDO::PARAM_STR);
                $stmt->bindParam(':l73', $infos->l73, PDO::PARAM_STR);
                $stmt->bindParam(':c88', $infos->c88, PDO::PARAM_STR);
                $stmt->bindParam(':c89', $infos->c89, PDO::PARAM_STR);
                $stmt->bindParam(':i18', $infos->i18, PDO::PARAM_STR);
                $stmt->bindParam(':i56', $infos->i56, PDO::PARAM_STR);
                $stmt->bindParam(':a1r', $infos->a1r, PDO::PARAM_STR);
                $stmt->bindParam(':a6r', $infos->a6r, PDO::PARAM_STR);
                $stmt->bindParam(':a11r', $infos->a11r, PDO::PARAM_STR);
                $stmt->bindParam(':a26r', $infos->a26r, PDO::PARAM_STR);
                $stmt->bindParam(':a29r', $infos->a29r, PDO::PARAM_STR);
                $stmt->bindParam(':a44r', $infos->a44r, PDO::PARAM_STR);
                $stmt->bindParam(':a51r', $infos->a51r, PDO::PARAM_STR);
                $stmt->bindParam(':a62r', $infos->a62r, PDO::PARAM_STR);
                $stmt->bindParam(':a75r', $infos->a75r, PDO::PARAM_STR);
                $stmt->bindParam(':a87r', $infos->a87r, PDO::PARAM_STR);
                $stmt->bindParam(':a96r', $infos->a96r, PDO::PARAM_STR);
                $stmt->execute();
            } catch (PDOException $e) {
                $errorMessage = 'データベースエラー';
                if (strcmp("1", $ini['debug'])==0) {
                    echo $e->getMessage();
                }
            }
        }
        
        function updateinfos($infos)
        {
            try {
                require $_SESSION["MY_ROOT"].'/src/db/dns.php';
                $sql = " UPDATE `infos`  SET  `title1`=:title1,  `title2`=:title2,    `k_seq`=:k_seq,   `d2`=:d2,  `d3`=:d3,  `d4`=:d4,  `d6`=:d6,  `d8`=:d8,  `f8`=:f8,  `d11`=:d11,  `d12`=:d12,  `e13`=:e13,  `d29`=:d29,  `d30`=:d30,  `d31`=:d31,  `l29`=:l29,  `l30`=:l30,  `l31`=:l31,  `d49`=:d49,  `d50`=:d50,  `e51`=:e51,  `c68`=:c68,  `c69`=:c69,  `l73`=:l73,  `c88`=:c88,  `c89`=:c89,  `i18`=:i18,  `i56`=:i56,  `a1r`=:a1r,  `a6r`=:a6r,  `a11r`=:a11r,  `a26r`=:a26r,  `a29r`=:a29r,  `a44r`=:a44r,  `a51r`=:a51r,  `a62r`=:a62r,  `a75r`=:a75r,  `a87r`=:a87r,  `a96r`=:a96r, `createdate`=NOW() WHERE infos_seq=:infos_seq";
                $stmt = $pdo -> prepare($sql);
                $stmt->bindParam(':infos_seq', $infos->infos_seq, PDO::PARAM_INT);
                $stmt->bindParam(':title1', $infos->title1, PDO::PARAM_STR);
                $stmt->bindParam(':title2', $infos->title2, PDO::PARAM_STR);
                $stmt->bindParam(':k_seq', $infos->k_seq, PDO::PARAM_INT);
                $stmt->bindParam(':d2', $infos->d2, PDO::PARAM_STR);
                $stmt->bindParam(':d3', $infos->d3, PDO::PARAM_STR);
                $stmt->bindParam(':d4', $infos->d4, PDO::PARAM_STR);
                $stmt->bindParam(':d6', $infos->d6, PDO::PARAM_STR);
                $stmt->bindParam(':d8', $infos->d8, PDO::PARAM_STR);
                $stmt->bindParam(':f8', $infos->f8, PDO::PARAM_STR);
                $stmt->bindParam(':d11', $infos->d11, PDO::PARAM_STR);
                $stmt->bindParam(':d12', $infos->d12, PDO::PARAM_STR);
                $stmt->bindParam(':e13', $infos->e13, PDO::PARAM_STR);
                $stmt->bindParam(':d29', $infos->d29, PDO::PARAM_STR);
                $stmt->bindParam(':d30', $infos->d30, PDO::PARAM_STR);
                $stmt->bindParam(':d31', $infos->d31, PDO::PARAM_STR);
                $stmt->bindParam(':l29', $infos->l29, PDO::PARAM_STR);
                $stmt->bindParam(':l30', $infos->l30, PDO::PARAM_STR);
                $stmt->bindParam(':l31', $infos->l31, PDO::PARAM_STR);
                $stmt->bindParam(':d49', $infos->d49, PDO::PARAM_STR);
                $stmt->bindParam(':d50', $infos->d50, PDO::PARAM_STR);
                $stmt->bindParam(':e51', $infos->e51, PDO::PARAM_STR);
                $stmt->bindParam(':c68', $infos->c68, PDO::PARAM_STR);
                $stmt->bindParam(':c69', $infos->c69, PDO::PARAM_STR);
                $stmt->bindParam(':l73', $infos->l73, PDO::PARAM_STR);
                $stmt->bindParam(':c88', $infos->c88, PDO::PARAM_STR);
                $stmt->bindParam(':c89', $infos->c89, PDO::PARAM_STR);
                $stmt->bindParam(':i18', $infos->i18, PDO::PARAM_STR);
                $stmt->bindParam(':i56', $infos->i56, PDO::PARAM_STR);
                $stmt->bindParam(':a1r', $infos->a1r, PDO::PARAM_STR);
                $stmt->bindParam(':a6r', $infos->a6r, PDO::PARAM_STR);
                $stmt->bindParam(':a11r', $infos->a11r, PDO::PARAM_STR);
                $stmt->bindParam(':a26r', $infos->a26r, PDO::PARAM_STR);
                $stmt->bindParam(':a29r', $infos->a29r, PDO::PARAM_STR);
                $stmt->bindParam(':a44r', $infos->a44r, PDO::PARAM_STR);
                $stmt->bindParam(':a51r', $infos->a51r, PDO::PARAM_STR);
                $stmt->bindParam(':a62r', $infos->a62r, PDO::PARAM_STR);
                $stmt->bindParam(':a75r', $infos->a75r, PDO::PARAM_STR);
                $stmt->bindParam(':a87r', $infos->a87r, PDO::PARAM_STR);
                $stmt->bindParam(':a96r', $infos->a96r, PDO::PARAM_STR);
                $stmt->execute();
            } catch (PDOException $e) {
                $errorMessage = 'データベースエラー';
                if (strcmp("1", $ini['debug'])==0) {
                    echo $e->getMessage();
                }
            }
        }

        function delteInfos($iSeq)
        {
            try {
                require $_SESSION["MY_ROOT"].'/src/db/dns.php';
                $sql = "DELETE FROM `infos` WHERE `infos_seq`=?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array($iSeq));
            } catch (PDOException $e) {
                $errorMessage = 'データベースエラー';
                if (strcmp("1", $ini['debug'])==0) {
                    echo $e->getMessage();
                }
            }
        }



        ?>


