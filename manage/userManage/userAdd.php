<?php
include_once("../../functions/myform.php");
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
                <li><a href="../bookManage/bookSearch.php">图书管理</a></li>
                <li class="active"><a href="userSearch.php">用户管理</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="" data-toggle="modal" data-target="#myModal">欢迎你，<?php echo $_COOKIE['userName'];?></a></li>
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
                <a class="list-group-item active" href="userAdd.php">增添用户</a>
                <a class="list-group-item" href="borrowed.php">借阅记录</a>
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
                    <div>密码</div>
                </div>
                <div class="form-group">
                    <div>邮箱</div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="information-result">
                <form action="userSave.php" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="id">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="userName">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary ">增添用户</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
<script src="../../js/jquery.js"></script>
<script src="../../js/bootstrap.js"></script>
<script>
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('myform').innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET", "../../css/myform.dat", true);
    xmlhttp.send();
</script>
</html>