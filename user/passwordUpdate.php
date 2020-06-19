<?php
include_once("../functions/database.php");
get_connection();
@$id = $_POST['id'];
if($id){
    @$email = $_POST['email'];
    @$new_password = $_POST['new_password'];
    $update_sql = "update users set password='$new_password' where id='$id' and email='$email'";
    $result_set = mysqli_query($database_connection, $update_sql);
    if(mysqli_affected_rows($database_connection)){
        echo "<script>alert('修改密码成功!');window.location.href='login.php?userId=$id';</script>";
    }else{
        echo "<script>alert('修改密码失败，请输入正确的账号和电子邮箱！');window.location.href='#';</script>";
    }
}else{
    @$id = $_GET['id'];
    @$new_password = $_POST['new_password'];
    @$old_password = $_POST['old_password'];
    $update_sql = "update users set password='$new_password' where id='$id' and password='$old_password'";
    $result_set = mysqli_query($database_connection, $update_sql);
    if(mysqli_affected_rows($database_connection)){
        echo "<script>alert('修改密码成功!');window.location.href='information.php?userId=$id';</script>";
    }else{
        echo "<script>alert('修改密码失败!');history.back();</script>";
    }
}
close_connection();
?>