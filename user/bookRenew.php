<?php
include_once("../functions/database.php");
$bookNo = $_GET['bookNo'];
$userName = $_GET['userName'];
$id = $_GET['userId'];
date_default_timezone_set("Asia/Shanghai");
$shouldDate = date('Y-m-d H:i:s',strtotime('+1month'));

$update_sql = "update borrow set shouldDate='$shouldDate' where bookNo='$bookNo'";

get_connection();
mysqli_query($database_connection, $update_sql);
close_connection();
echo "<script>alert('续借成功，最迟归还日期为'+'$shouldDate');parent.location.href='index.php?userId=$id&userName=$userName';</script>";
?>