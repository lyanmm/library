<?php
include_once("../../functions/database.php");
include_once("../../functions/file_system.php");
$bookName = $_POST["bookName"];
$authorName = $_POST["authorName"];
$publisherName = $_POST["publisherName"];
$bookNo = $_POST["bookNo"];
$sql = "insert into book (bookNo,bookName,authorName,publisherName) values('$bookNo','$bookName','$authorName','$publisherName')";
get_connection();
mysqli_query($database_connection, $sql);
close_connection();
upload();
echo "<script>alert('增添图书成功');location.href='bookAdd.php';</script>";