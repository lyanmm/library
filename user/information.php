<?php
    include_once("../functions/database.php");
    get_connection();
    @$id = $_GET['userId'];
    $search_sql = "select * from users where id='$id'";
    $result_set = mysqli_query($database_connection, $search_sql);
    $row = mysqli_fetch_array($result_set);
    $userId = $row["id"];
    $userName = $row["userName"];
    $password = $row['password'];
    $email = $row['email'];
    close_connection();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../icon/img/timg.jpg">
    <title>图书管理系统</title>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
<div class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a href="index.php?userId=<?php echo $userId ?>&userName=<?php echo $userName ?>" class="navbar-brand"><img src="../icon/book.png">图书借阅管理系统</a>
        </div>
        <label id="toggle-label" class="visible-xs-inline-block" for="toggle-checkbox">MENU</label>
        <input class="hidden" id="toggle-checkbox" type="checkbox">
        <div class="hidden-xs">
            <ul class="nav navbar-nav navbar-right">
                <li ><a href="information.php">欢迎你，<?php echo $userName ?></a> </li>
                <li><a href="login.php">注销</a> </li>
            </ul>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-2">
            <div class="list-group side-bar">
                <a class="list-group-item" href="index.php?userId=<?php echo $userId ?>&userName=<?php echo $userName ?>">查询书籍</a>
                <a class="list-group-item" href="borrow.php?userId=<?php echo $userId ?>&userName=<?php echo $userName ?>">借还书籍</a>
                <a class="list-group-item" href="borrowed.php?userId=<?php echo $userId ?>&userName=<?php echo $userName ?>">借阅记录</a>
                <a class="list-group-item active" href="information.php?userId=<?php echo $userId ?>&userName=<?php echo $userName ?>">我的信息</a>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="information-list">
                <div class="form-group first">
                    <div>账号</div>
                </div>
                <div class="form-group">
                    <div>用户名</div>
                </div>
                <div class="form-group">
                    <div>邮箱</div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                 <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                         <h4 class="modal-title" id="myModalLabel">修改密码</h4>
                     </div>
                     <form action="passwordUpdate.php?id=<?php echo $id?>" method="post"  id="updateform">
                         <div class="modal-body">
                             <div class="form-group">
                                 <label for="old_password">旧密码</label>
                                 <input type="text" name="old_password" class="form-control" id="old_password" placeholder="旧密码" name="old_password">
                             </div>
                             <div class="form-group">
                                 <label for="new_password">新密码</label>
                                 <input type="text" name="new_password" class="form-control" id="new_password" placeholder="新密码" name="new_password">
                             </div>
                         </div>
                         <div class="modal-footer">
                             <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                             <button type="submit" id="btn_submit" class="btn btn-primary" data-dismiss="modal" onclick="update()">修改</button>
                         </div>
                     </form>
                 </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="information-result">
                <form action="updateInfo.php?id=<?php echo $id?>" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" value="<?php echo $userId ?>" name="userId">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" value="<?php echo $userName ?>" name="userName">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" value="<?php echo $email ?>" name="email">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-warning" value="修改基本信息" >
                        <button  type="button" class="btn btn-primary" id="update" >修改账号密码</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.js"></script>
<script type="text/javascript">
    function update(){
        var form = document.getElementById('updateform');
        form.submit();
    }
    $("#update").click(function () {
        $("#myModalLabel").text("修改密码");
        $('#myModal').modal();
    });
</script>
</body>
</html>