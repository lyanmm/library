<?php
include_once("../functions/database.php");
date_default_timezone_set("Asia/Shanghai");
$bookNo = $_GET['bookNo'];
$userName = $_GET['userName'];
$id = $_GET['userId'];
$returnDate = date('Y-m-d H:i:s');
$update_sql = "update book set statement='可借' where bookNo='$bookNo'";
$update_sql2 = "update borrow set returnDate='$returnDate' where bookNo='$bookNo'";
$update_sql3 = "update users set borrowCount=borrowCount-1 where id='$id'";
get_connection();
mysqli_query($database_connection, $update_sql);
mysqli_query($database_connection,$update_sql2);
mysqli_query($database_connection,$update_sql3);
close_connection();
echo "<script>alert('还书成功');parent.location.href='index.php?userId=$id&userName=$userName';</script>";
?>