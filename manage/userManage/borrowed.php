<?php
include_once("../../functions/database.php");
include_once("../../functions/myform.php");
$sql = "SELECT
    `borrow`.`bookNo`,
    `book`.`authorName`,
    `book`.`bookName`,
    `book`.`publisherName`,
    `borrow`.`borrowDate`,
    `borrow`.`returnDate`,
    `users`.`userName`
FROM
    `borrow`,
    `users`,
    `book`
WHERE
    `users`.`id` = `borrow`.`id` AND `borrow`.`bookNo` = `book`.`bookNo`";
get_connection();
$results_borrowed = mysqli_query($database_connection, $sql);
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
                <a class="list-group-item" href="userAdd.php">增添用户</a>
                <a class="list-group-item active" href="borrowed.php">借阅记录</a>
            </div>
        </div>
        <div class="col-sm-10">
            <div class="book-list">
                <div class="panel panel-default">
                    <div class="panel-heading">借阅记录</div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>书名</th>
                                <th>作者</th>
                                <th>出版社</th>
                                <th>ISBN</th>
                                <th>借书人</th>
                                <th>借书时间</th>
                                <th>归还时间</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            while ($result = mysqli_fetch_array($results_borrowed)) {
                                echo "<tr>
                                        <td>" . $result['bookName'] . "</td>
                                        <td>" . $result['authorName'] . "</td>
                                        <td>" . $result['publisherName'] . "</td>
                                        <td>" . $result['bookNo'] . "</td>
                                        <td>" . $result['userName'] . "</td>
                                        <td>" . $result['borrowDate'] . "</td>
                                        <td>" . $result['returnDate'] . "</td>
                                      </tr>";
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
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