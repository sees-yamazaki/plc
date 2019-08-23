<?php
session_start();



$ini = parse_ini_file('../common.ini', FALSE);
if(isset($_POST['edit'])){
    header('Location: employeeEdit.php', true, 307);
}elseif(isset($_POST['view'])){
    header('Location: employeeView.php', true, 307);
}elseif(isset($_POST['shift'])){
    $_SESSION['eName'] = $_POST['eName'];
    $_SESSION['eSeq'] = $_POST['eSeq'];
    $_SESSION['alertTime'] = $_POST['alert_time'];
    header('Location: employeeShift.php', true, 307);
}else{
    echo "no edit";
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/table.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../js/main.js"></script>
</head>

<body>
    <?php include('./menu.php'); ?>

    <font color="#ff0000"><?php echo $_POST['edit']; ?>k</font>



</body>

</html>
