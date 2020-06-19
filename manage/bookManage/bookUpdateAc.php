<?php
include_once("../../functions/database.php");
include_once("../../functions/file_system.php");
$bookNo = $_POST['bookNo'];
$authorName = $_POST['authorName'];
$bookName = $_POST['bookName'];
$publisherName = $_POST['publisherName'];
$statement = $_POST['statement'];
$book_update_sql = "UPDATE `book` SET `bookNo`='$bookNo',`bookName`='$bookName',`authorName`='$authorName',`publisherName`='$publisherName',`statement`='$statement' WHERE `bookNo`='$bookNo'";
get_connection();
upload();
if (mysqli_query($database_connection, $book_update_sql)) {
    echo "<script>alert('更新成功！');window.location='bookSearch.php'</script>";

} else {
    echo "<script>alert('更新失败！');window.location='bookSearch.php'</script>";
}