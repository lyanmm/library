<?php
include_once("../functions/database.php");
date_default_timezone_set("Asia/Shanghai");
$bookNo = $_GET['bookNo'];
$userName = $_GET['userName'];
$id = $_GET['userId'];
get_connection();
$select_sql = "select * from users where id = '$id'";
$select_sql2 = "select * from book where bookNo='$bookNo'";
$resultSet = mysqli_query($database_connection, $select_sql);
$resultSet2 = mysqli_query($database_connection, $select_sql2);
$row = mysqli_fetch_array($resultSet);
$row2 = mysqli_fetch_array($resultSet2);
if ($row2['statement'] === '已借') {
    echo "<script>alert('借书失败，此书已被借阅');history.back();</script>";
} else {
    if ($row['borrowCount'] >= 5) {
        echo "<script>alert('你的借书量已经超过5本，无法再借书');history.back();</script>";
    } else {
        $shouldDate = date('Y-m-d H:i:s', strtotime('+1month'));
        $update_sql = "update book set statement='已借' where bookNo='$bookNo'";
        $update_sql2 = "update users set borrowCount=borrowCount+1 where id='$id'";
        $insert_sql = "insert into borrow (id,bookNo,shouldDate) values('$id','$bookNo','$shouldDate')";
        mysqli_query($database_connection, $update_sql);
        mysqli_query($database_connection, $update_sql2);
        mysqli_query($database_connection, $insert_sql);
        close_connection();
        echo "<script>alert('借书成功，最迟归还日期为'+'$shouldDate');parent.location.href='index.php?userId=$id&userName=$userName';</script>";
    }
}
?>