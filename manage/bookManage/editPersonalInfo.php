<?php
include_once("../../functions/database.php");
$id = $_COOKIE['id'];
$password = $_POST['password'];
$userName = $_POST['userName'];
$email = $_POST['email'];
$time = time() + 3600;
$updateInfo_sql = "UPDATE `users` SET `userName`='$userName',`password`='$password',`email`='$email' WHERE `id`='$id'";
get_connection();
if (mysqli_query($database_connection, $updateInfo_sql)) {
    setcookie("password",$password,$time,"/");
    setcookie("userName",$userName,$time,"/");
    setcookie("email",$email,$time,"/");
    echo "<script>alert('更新成功！');window.location='bookSearch.php'</script>";
} else {
    echo "<script>alert('更新失败！');window.location='bookSearch.php'</script>";
}