<?php
    include_once("../functions/database.php");
    $id = $_GET['id'];
    $userId = $_POST['userId'];
    $userName = $_POST['userName'];
    $email = $_POST['email'];
    $sql = "update users set id='$userId',userName='$userName',email='$email' where id='$id'";
    get_connection();
    mysqli_query($database_connection, $sql);
    close_connection();
    header("Location:information.php?userId=$userId");
?>