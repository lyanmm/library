<?php
include_once("../../functions/database.php");
$id = $_POST["id"];
$password = $_POST["password"];
$userName = $_POST["userName"];
$email = $_POST["email"];
$sql = "insert into users (id,userName,password,email) values('$id','$userName','$password','$email')";
get_connection();
mysqli_query($database_connection, $sql);
close_connection();
echo "<script>alert('增添用户成功');location.href='userAdd.php';</script>";
?>