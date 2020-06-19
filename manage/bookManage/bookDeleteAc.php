<?php
include_once("../../functions/database.php");
$bookNo = $_GET['bookNo'];
$book_delete_sql = "DELETE FROM `book` WHERE `bookNo`='$bookNo'";
get_connection();
if (mysqli_query($database_connection, $book_delete_sql)) {
    echo "<script>alert('删除成功！');window.location='bookSearch.php'</script>";

} else {
    echo "<script>alert('删除失败！');window.location='bookSearch.php'</script>";
}