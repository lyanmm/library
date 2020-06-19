<?php
include_once("../../functions/database.php");
include_once("../../functions/myform.php");

$bookNo = $_GET['bookNo'];
get_connection();
$book_select_sql = "SELECT * FROM `book` WHERE `bookNo`='$bookNo'";
$result_bookNo_select = mysqli_query($database_connection, $book_select_sql);
$result = mysqli_fetch_array($result_bookNo_select);
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
            <a href="bookSearch.php" class="navbar-brand"><img src="../../icon/book.png"> 图书借阅管理系统</a>
        </div>
        <label id="toggle-label" class="visible-xs-inline-block" for="toggle-checkbox">MENU</label>
        <input class="hidden" id="toggle-checkbox" type="checkbox">
        <div class="hidden-xs">
            <ul class="nav navbar-nav">
                <li class="active"><a href="bookSearch.php">图书管理</a></li>
                <li><a href="../userManage/userSearch.php">用户管理</a></li>
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
                <a class="list-group-item" href="bookSearch.php">查询图书</a>
                <a class="list-group-item" href="bookAdd.php">增添图书</a>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="information-list">
                <div class="form-group first">
                    <div>书名</div>
                </div>
                <div class="form-group">
                    <div>作者</div>
                </div>
                <div class="form-group">
                    <div>出版社</div>
                </div>
                <div class="form-group">
                    <div>ISBN</div>
                </div>
                <div class="form-group">
                    <div>状态</div>
                </div>
                <div class="form-group">
                    <div>电子书</div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="information-result">
                <form action="bookUpdateAc.php" method="post">
                    <div class="form-group">
                        <?php
                        echo "<input type=\"text\" class=\"form-control\" name=\"bookName\" value='" . $result['bookName'] . "' required=\"required\">";
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                        echo "<input type=\"text\" class=\"form-control\" name=\"authorName\" value='" . $result['authorName'] . "' required=\"required\">";
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                        echo "<input type=\"text\" class=\"form-control\" name=\"publisherName\" value='" . $result['publisherName'] . "' required=\"required\">";
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                        echo "<input type=\"text\" class=\"form-control\" name=\"bookNo\" value='" . $result['bookNo'] . "' required=\"required\">";
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                        echo "<input type=\"text\" class=\"form-control\" name=\"statement\" value='" . $result['statement'] . "' required=\"required\">";
                        ?>
                    </div>
                    <div class="form-group">
                        <input type="file" name="file">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary " value="提交修改">
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
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('myform').innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET", "../../css/myform.dat", true);
    xmlhttp.send();
</script>
</html>
