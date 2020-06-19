<?php
include_once("../functions/database.php");
$id = addslashes($_POST['id']);
$password = addslashes($_POST['password']);
$userName = $_POST['userName'];
$email = $_POST['email'];
//判断账号是否占用
$idSQL = "select * from users where id='$id'";
get_connection();
$resultSet = mysqli_query($database_connection, $idSQL);
if(mysqli_num_rows($resultSet)>0){
    close_connection();
    exit("账户已经被占用，请更换其他账户！");
}
//收集用户其他信息
$registerSQL = "insert into users (id,userName,password,email) values ('$id','$userName','$password','$email')";
$ResultTest=mysqli_query($database_connection, $registerSQL);
//$userID = mysqli_insert_id($database_connection);
echo "用户信息成功注册！<br/>";
//从数据库中提取用户注册信息
$userSQL = "select * from users where id='$id'";
$userResult = mysqli_query($database_connection, $userSQL);
$num = mysqli_num_rows($userResult);
if($user = mysqli_fetch_array($userResult)){
    header("Location:login.php");
}else{
    echo "<script>alert('用户注册失败');parent.location.href='signup.html';</script>";
}
close_connection();
?>