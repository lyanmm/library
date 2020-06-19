<?php
include_once("../functions/database.php");
//收集表单提交数据
$time = time() + 3600;
$id = $_POST['id'];
$password = $_POST['password'];
//连接数据库服务器
get_connection();
//判断账号和密码是否正确
$sql = "select * from users where id='$id' and password='$password'";
$resultSet = mysqli_query($database_connection, $sql);
$row = mysqli_fetch_array($resultSet);
$userId = $row["id"];
$userName = $row["userName"];
$statement = $row["statement"];
$email = $row["email"];
setcookie("id", $id, $time,"/");
if (mysqli_num_rows($resultSet) > 0) {
    setcookie("password", $password, $time,"/");
    setcookie("userName", $userName, $time,"/");
    setcookie("email", $email, $time,"/");
    if($statement == "管理员"){
        header("location:../manage/bookManage/bookSearch.php");
    }else{
        header("location:index.php");
    }
} else {
    echo "<script>alert('账号或密码错误！');window.location='login.php'</script>";
}
close_connection();
?>