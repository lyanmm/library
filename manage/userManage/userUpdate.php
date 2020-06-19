<?php
include_once("../../functions/database.php");
include_once("../../functions/myform.php");
$id = $_GET['id'];
$id_select_sql = "SELECT  `id`, `userName`, `password`, `email` FROM `users` WHERE `id`='$id'";
get_connection();
$result_id_select = mysqli_query($database_connection,$id_select_sql);
$result = mysqli_fetch_array($result_id_select);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../../icon/img/timg.jpg">
    <title>图书管理系统</title>
    <link href="../../css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/main.css">
</head>
<body>
<div class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a href="../bookManage/bookSearch.php" class="navbar-brand"><img src="../../icon/book.png"> 图书借阅管理系统</a>
        </div>
        <label id="toggle-label" class="visible-xs-inline-block" for="toggle-checkbox">MENU</label>
        <input class="hidden" id="toggle-checkbox" type="checkbox">
        <div class="hidden-xs">
            <ul class="nav navbar-nav">
                <li ><a href="../bookManage/bookSearch.php">图书管理</a> </li>
                <li class="active"><a href="userSearch.php">用户管理</a> </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li ><a href="" data-toggle="modal" data-target="#myModal">欢迎你，<?php echo $_COOKIE['userName'];?></a> </li>
                <li><a href="../../user/login.php">注销</a> </li>
            </ul>
        </div>
        <?php
        form();
        ?>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-2">
            <div class="list-group side-bar">
                <a class="list-group-item" href="userSearch.php">查询用户</a>
                <a class="list-group-item" href="userAdd.php">增添用户</a>
                <a class="list-group-item" href="borrowed.php">借阅记录</a>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="information-list">
                <div class="form-group first">
                    <div>用户名</div>
                </div>
                <div class="form-group">
                    <div>密码</div>
                </div>
                <div class="form-group">
                    <div>邮箱</div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="information-result">
                <form action="userUpdateAc.php" method="post">
                    <div class="form-group">
                        <?php
                        echo "<input type=\"text\" class=\"form-control\" name=\"userName\" value=\"".$result['userName']."\" required=\"required\">";
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                        echo "<input type=\"text\" class=\"form-control\" name=\"password\" value=\"".$result['password']."\" required=\"required\">";
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                        echo "<input type=\"text\" class=\"form-control\" name=\"email\" value=\"".$result['email']."\" required=\"required\">";
                        ?>
                    </div>
                    <div class="form-group sr-only">
                        <?php
                        echo "<input type=\"text\" class=\"form-control\" name=\"id\" value=\"".$result['id']."\">";
                        ?>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary ">提交修改</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
<script src="../../js/jquery.js"></script>
<script src="../../js/bootstrap.js"></script>
</html>