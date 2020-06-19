<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../icon/img/timg.jpg">
    <title>修改密码</title>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
<div class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a href="login.php" class="navbar-brand"><img src="../icon/book.png"> 图书借阅管理系统</a>
        </div>
        <label id="toggle-label" class="visible-xs-inline-block" for="toggle-checkbox">MENU</label>
        <input class="hidden" id="toggle-checkbox" type="checkbox">
    </div>
</div>
<div class="container container-small">
    <h3>修改密码</h3>
    <form action="passwordUpdate.php" method="post">
        <div class="form-group">
            <label>账号</label>
            <input type="text" class="form-control" name="id">
        </div>
        <div class="form-group">
            <label>电子邮箱</label>
            <input type="text" class="form-control" name="email">
        </div>
        <div class="form-group">
            <label>新密码</label>
            <input type="password" class="form-control" name="new_password">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-block"  value="修改密码">
        </div>
        <div class="form-group">
            <div class="signup">没有账号？<a href="signup.html"> 注册</a></div>
        </div>
    </form>
</div>
</body>
</html>