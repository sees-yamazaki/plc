<?php

class cls_meetings
{
    public $meet_seq = 0;
    public $meet_date;
    public $meet_title;
    public $resetFlg;
    public $gSeqs;
}

class cls_members
{
    public $mm_seq = 0;
    public $meet_seq;
    public $groups_seq;
    public $mm_status;
    public $users_seq;
    public $groups_name;
    public $users_name;
    public $meet_date;
    public $meet_title;
    public $mngr_seq;
    public $mngr_name;
}

function getMembers($mSeq)
{
    try {
        $result = new cls_members();

        require $_SESSION['MY_ROOT'].'/src/db/dns.php';
        $stmt = $pdo->prepare('SELECT mm.*,g.groups_name,u.users_name FROM `meeting_members` mm LEFT JOIN groups g ON mm.groups_seq=g.groups_seq LEFT JOIN users u ON mm.users_seq=u.users_seq WHERE meet_seq=?');
        $stmt->execute(array($mSeq));

        if ($row = $stmt->fetch()) {
            $result->mm_seq = $row['mm_seq'];
            $result->meet_seq = $row['meet_seq'];
            $result->groups_seq = $row['groups_seq'];
            $result->mm_status = $row['mm_status'];
            $result->users_seq = $row['users_seq'];
            $result->groups_name = $row['groups_name'];
            $result->users_name = $row['users_name'];
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if (strcmp('1', $ini['debug']) == 0) {
            echo $e->getMessage();
        }
    }

    return $result;
}

function getMeetingView($mSeq)
{
    try {
        $results = array();

        require $_SESSION['MY_ROOT'].'/src/db/dns.php';
        $stmt = $pdo->prepare('SELECT * FROM `meeting_view` WHERE meet_seq=?');
        $stmt->execute(array($mSeq));

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new cls_meetings();
            $result->mm_seq = $row['mm_seq'];
            $result->meet_seq = $row['meet_seq'];
            $result->groups_seq = $row['groups_seq'];
            $result->mm_status = $row['mm_status'];
            $result->users_seq = $row['users_seq'];
            $result->groups_name = $row['groups_name'];
            $result->users_name = $row['users_name'];
            $result->meet_date = $row['meet_date'];
            $result->meet_title = $row['meet_title'];
            $result->mngr_seq = $row['mngr_seq'];
            $result->mngr_name = $row['mngr_name'];
            array_push($results, $result);
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if (strcmp('1', $ini['debug']) == 0) {
            echo $e->getMessage();
        }
    }

    return $results;
}

function getMeeintgs()
{
    try {
        $results = array();

        require $_SESSION['MY_ROOT'].'/src/db/dns.php';
        $stmt = $pdo->prepare('SELECT * FROM `meetings` ORDER BY meet_date');
        $stmt->execute(array());

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new cls_meetings();
            $result->meet_seq = $row['meet_seq'];
            $result->meet_date = $row['meet_date'];
            $result->meet_title = $row['meet_title'];

            array_push($results, $result);
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if (strcmp('1', $ini['debug']) == 0) {
            echo $e->getMessage();
        }
    }

    return $results;
}

function getMeeting($mSeq)
{
    try {
        $result = new cls_meetings();

        require $_SESSION['MY_ROOT'].'/src/db/dns.php';
        $stmt = $pdo->prepare('SELECT * FROM `meetings` WHERE meet_seq=?');
        $stmt->execute(array($mSeq));

        if ($row = $stmt->fetch()) {
            $result->meet_seq = $row['meet_seq'];
            $result->meet_date = $row['meet_date'];
            $result->meet_title = $row['meet_title'];
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if (strcmp('1', $ini['debug']) == 0) {
            echo $e->getMessage();
        }
    }

    return $result;
}

function insertMeeting($meeting)
{
    try {
        require $_SESSION['MY_ROOT'].'/src/db/dns.php';

        $sql = 'INSERT INTO `meetings`(`meet_date`, `meet_title`)  VALUES (?,?)';

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($meeting->meet_date, $meeting->meet_title));

        foreach ($meeting->gSeqs as $gSeq) {
            $sql = 'INSERT INTO `meeting_members`(`meet_seq`, `groups_seq`, `mm_status`, `users_seq`) VALUES (?,?,?,?)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array($meeting->meet_seq, $gSeq, 0, 0));
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if (strcmp('1', $ini['debug']) == 0) {
            echo $e->getMessage();
        }
    }
}

function updateMeeting($meeting)
{
    try {
        require $_SESSION['MY_ROOT'].'/src/db/dns.php';

        $sql = 'UPDATE `meetings` SET `meet_date`=?,`meet_title`=? WHERE `meet_seq`=?';

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($meeting->meet_date, $meeting->meet_title, $meeting->meet_seq));

        if (empty($meeting->resetFlg)) {
            $sql = 'DELETE FROM `meeting_members` WHERE `meet_seq`=?';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array($meeting->meet_seq));

            foreach ($meeting->gSeqs as $gSeq) {
                $sql = 'INSERT INTO `meeting_members`(`meet_seq`, `groups_seq`, `mm_status`, `users_seq`) VALUES (?,?,?,?)';
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array($meeting->meet_seq, $gSeq, 0, 0));
            }
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if (strcmp('1', $ini['debug']) == 0) {
            echo $e->getMessage();
        }
    }
}

function updateMember($mm)
{
    try {
        require $_SESSION['MY_ROOT'].'/src/db/dns.php';

        $sql = 'UPDATE `meeting_members` SET `mm_status`=?,`users_seq`=? WHERE `mm_seq`=?';

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($mm->mm_status, $mm->users_seq, $mm->mm_seq));
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if (strcmp('1', $ini['debug']) == 0) {
            echo $e->getMessage();
        }
    }
}

function deleteMeeting($meeting)
{
    try {
        require $_SESSION['MY_ROOT'].'/src/db/dns.php';

        // ユーザを削除する
        $sql = 'DELETE FROM `meetings` WHERE `meet_seq`=?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($meeting->meet_seq));
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if (strcmp('1', $ini['debug']) == 0) {
            echo $e->getMessage();
        }
    }
}
