<?php

class cls_prizes
{
    public $pz_seq;
    public $p_seq;
    public $pz_order;
    public $pz_title;
    public $pz_img;
    public $pz_text;
    public $pz_code;
    public $pz_hitcnt;
    public $imgStts;
    public $pz_nowcnt;
}

class cls_hitcounts
{
    public $hc_seq ;
    public $p_seq ;
    public $pz_seq ;
    public $hc_no ;
}

    function getPrizes($pSeq)
    {
        try {
            $results = array();
            require './db/dns.php';
            $stmt = $pdo->prepare('SELECT * FROM  `v_prizes` WHERE p_seq = :p_seq ORDER BY pz_order');
            $stmt->bindParam(':p_seq', $pSeq, PDO::PARAM_INT);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result = new cls_prizes();
                $result->pz_seq = $row['pz_seq'];
                $result->p_seq = $row['p_seq'];
                $result->pz_order = $row['pz_order'];
                $result->pz_title = $row['pz_title'];
                $result->pz_code = $row['pz_code'];
                $result->pz_img = $row['pz_img'];
                $result->pz_text = $row['pz_text'];
                $result->pz_nowcnt = $row['pz_nowcnt'];
                $result->pz_hitcnt = $row['hc_no'];
                array_push($results, $result);
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (getSsnIsDebug()) {
                echo $e->getMessage();
            }
        }

        return $results;
    }

    function getPrize($pzSeq)
    {
        try {
            $result = new cls_prizes();
            require './db/dns.php';
            $stmt = $pdo->prepare('SELECT * FROM `v_prizes` WHERE pz_seq=:pz_seq');
            $stmt->bindParam(':pz_seq', $pzSeq, PDO::PARAM_INT);
            $stmt->execute();
            if ($row = $stmt->fetch()) {
                $result->pz_seq = $row['pz_seq'];
                $result->p_seq = $row['p_seq'];
                $result->pz_order = $row['pz_order'];
                $result->pz_title = $row['pz_title'];
                $result->pz_code = $row['pz_code'];
                $result->pz_img = $row['pz_img'];
                $result->pz_text = $row['pz_text'];
                $result->pz_hitcnt = $row['hc_no'];
                $result->pz_nowcnt = $row['pz_nowcnt'];
                $result->pz_hitcnt = $row['hc_no'];
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (getSsnIsDebug()) {
                echo $e->getMessage();
            }
        }

        return $result;
    }

    function insertPrize($prizes)
    {
        try {
            require './db/dns.php';
            $sql = 'INSERT  INTO `prizes` (  `p_seq`,  `pz_order`, `pz_title`,  `pz_code`,  `pz_img`,  `pz_text`) VALUES (:p_seq, :pz_order,:pz_title, :pz_code, :pz_img, :pz_text)';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':p_seq', $prizes->p_seq, PDO::PARAM_INT);
            $stmt->bindParam(':pz_order', $prizes->pz_order, PDO::PARAM_INT);
            $stmt->bindParam(':pz_title', $prizes->pz_title, PDO::PARAM_STR);
            $stmt->bindParam(':pz_code', $prizes->pz_code, PDO::PARAM_STR);
            $stmt->bindParam(':pz_img', $prizes->pz_img, PDO::PARAM_STR);
            $stmt->bindParam(':pz_text', $prizes->pz_text, PDO::PARAM_STR);
//            $stmt->bindParam(':pz_hitcnt', $prizes->pz_hitcnt, PDO::PARAM_INT);
             $stmt->execute();

            $insertid = $pdo->lastInsertId();

            if ($prizes->imgStts == 1) {
                $path = getSsn('PATH_PROMO').'/'.$prizes->p_seq;
                $file = $path.'/'.basename($_FILES['pz_img']['name']);
                move_uploaded_file($_FILES['pz_img']['tmp_name'], $file);
            }

            $hitcnts = explode(",",$prizes->pz_hitcnt);
            foreach($hitcnts as $hitcnt){
                if (strlen($hitcnt)>0) {
                    $sql = 'INSERT  INTO `hitcounts` (  `p_seq`,  `pz_seq`,  `hc_no`) VALUES (:p_seq, :pz_seq,:hc_no)';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':p_seq', $prizes->p_seq, PDO::PARAM_INT);
                    $stmt->bindParam(':pz_seq', $insertid, PDO::PARAM_INT);
                    $stmt->bindParam(':hc_no', $hitcnt, PDO::PARAM_INT);
                    $stmt->execute();
                }
            }


        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (getSsnIsDebug()) {
                echo $e->getMessage();
            }
        }
    }

    function updatePrize($prizes)
    {
        try {
            require './db/dns.php';
            $sql = '';
            if ($prizes->imgStts == 1) {
                $sql = ' UPDATE `prizes`  SET  `p_seq`=:p_seq, `pz_order`=:pz_order, `pz_title`=:pz_title,  `pz_img`=:pz_img,  `pz_text`=:pz_text, `pz_code`=:pz_code WHERE pz_seq=:pz_seq';
            } elseif ($prizes->imgStts == 2) {
                $sql = ' UPDATE `prizes`  SET  `p_seq`=:p_seq, `pz_order`=:pz_order, `pz_title`=:pz_title,   `pz_text`=:pz_text, `pz_code`=:pz_code WHERE pz_seq=:pz_seq';
            } else {
                $sql = ' UPDATE `prizes`  SET  `p_seq`=:p_seq, `pz_order`=:pz_order, `pz_title`=:pz_title,  `pz_img`=:pz_img,  `pz_text`=:pz_text, `pz_code`=:pz_code WHERE pz_seq=:pz_seq';
                $prizes->pz_img = '';
            }
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':pz_seq', $prizes->pz_seq, PDO::PARAM_INT);
            $stmt->bindParam(':p_seq', $prizes->p_seq, PDO::PARAM_INT);
            $stmt->bindParam(':pz_order', $prizes->pz_order, PDO::PARAM_INT);
            $stmt->bindParam(':pz_title', $prizes->pz_title, PDO::PARAM_STR);
            $stmt->bindParam(':pz_code', $prizes->pz_code, PDO::PARAM_STR);
            if ($prizes->imgStts != 2) {
                $stmt->bindParam(':pz_img', $prizes->pz_img, PDO::PARAM_STR);
            }
            $stmt->bindParam(':pz_text', $prizes->pz_text, PDO::PARAM_STR);
            $stmt->execute();

            if ($prizes->imgStts == 1) {
                $path = getSsn('PATH_PROMO').'/'.$prizes->p_seq;
                $file = $path.'/'.basename($_FILES['pz_img']['name']);
                move_uploaded_file($_FILES['pz_img']['tmp_name'], $file);
            }


            $sql = 'DELETE FROM `hitcounts` WHERE `pz_seq`=:pz_seq';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':pz_seq', $prizes->pz_seq, PDO::PARAM_INT);
            $stmt->execute();

            $hitcnts = explode(",",$prizes->pz_hitcnt);
            foreach($hitcnts as $hitcnt){
                if (strlen($hitcnt)>0) {
                    $sql = 'INSERT  INTO `hitcounts` (`p_seq`, `pz_seq`, `hc_no`) VALUES (:p_seq, :pz_seq,:hc_no)';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':p_seq', $prizes->p_seq, PDO::PARAM_INT);
                    $stmt->bindParam(':pz_seq', $prizes->pz_seq, PDO::PARAM_INT);
                    $stmt->bindParam(':hc_no', $hitcnt, PDO::PARAM_INT);
                    $stmt->execute();
                }
            }

        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (getSsnIsDebug()) {
                echo $e->getMessage();
            }
        }
    }

    function deletePrize($pzSeq)
    {
        try {
            require './db/dns.php';
            $sql = 'DELETE FROM `prizes` WHERE pz_seq=:pz_seq';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':pz_seq', $pzSeq, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (getSsnIsDebug()) {
                echo $e->getMessage();
            }
        }
    }
