<?php
include_once("../../functions/database.php");
if ($_POST['userName'] != '') {
    $id = $_POST['id'];
    $userName = $_POST['userName'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $updateInfo_sql = "UPDATE `users` SET `userName`='$userName',`password`='$password',`email`='$email' WHERE `id`='$id'";
    get_connection();
    if (mysqli_query($database_connection, $updateInfo_sql)) {
        echo "<script>alert('更新成功！');window.location='userSearch.php'</script>";

    } else {
        echo "<script>alert('更新失败！');window.location='userSearch.php'</script>";
    }
}
else
    echo "<script>alert('更新失败！');window.location='userSearch.php'</script>";