<?php
include_once("../../functions/database.php");
include_once("../../functions/page.php");
include_once("../../functions/myform.php");
$search_sql = "SELECT * FROM `users` WHERE 1";
$keyword = "";
if ($_POST['searchInfo'] != '') {
    $keyword = $_POST['searchInfo'];
    $search_sql = "SELECT `id`, `userName`, `password`, `email` FROM `users` WHERE `id` LIKE '%$keyword%' 
OR `userName` LIKE '%$keyword%' OR `password` LIKE '%$keyword%' OR `email` LIKE '%$keyword%'";
}
get_connection();
if ($_GET['id'] != '') {
    $deleteInfo = $_GET['id'];
    $deleteInfo_sql = "DELETE FROM `users` WHERE `id`='$deleteInfo'";
    if (mysqli_query($database_connection, $deleteInfo_sql)) {
        echo "<script>alert('删除成功！');window.location='userSearch.php'</script>";

    } else {
        echo "<script>alert('删除失败！');window.location='userSearch.php'</script>";
    }
}
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
                <li><a href="" data-toggle="modal" data-target="#myModal">欢迎你，<?php echo $_COOKIE['userName']; ?></a>
                </li>
                <li><a href="../../user/login.php">注销</a></li>
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
                <a class="list-group-item active" href="userSearch.php">查询用户</a>
                <a class="list-group-item" href="userAdd.php">增添用户</a>
                <a class="list-group-item" href="borrowed.php">借阅记录</a>
            </div>
        </div>
        <div class="col-sm-10">
            <div class="book-list">
                <div class="panel panel-default">
                    <div class="panel-heading">查询用户</div>
                    <div class="search-div  panel-body">
                        <form action="userSearch.php" method="post">
                            <div class="search-bar">
                                <input type="text" id="searchInfo" name="searchInfo" class="form-control"
                                       placeholder="查询用户账号、用户名、电子邮箱">
                            </div>
                            <button id="search" type="submit" class="btn btn-primary">查询</button>
                        </form>
                    </div>
                </div>
                <div class="search-result">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>账号</th>
                            <th>用户名</th>
                            <th>密码</th>
                            <th>电子邮箱</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $result_news = mysqli_query($database_connection, $search_sql);
                        $total_records = mysqli_num_rows($result_news);
                        $page_size = 6;
                        if (isset($_GET["page_current"])) {
                            $page_current = $_GET["page_current"];
                        } else {
                            $page_current = 1;
                        }
                        $start = ($page_current - 1) * $page_size;
                        $search_sql = "select * from users limit $start,$page_size";
                        if ($_POST["searchInfo"]!='') {
                            $keyword = $_POST["searchInfo"];
                            //构造模糊查询新闻的SQL语句
                            $search_sql = "SELECT `id`, `userName`, `password`, `email`,`statement` FROM `users` WHERE `id` LIKE '%$keyword%' 
OR `userName` LIKE '%$keyword%' OR `password` LIKE '%$keyword%' OR `email` LIKE '%$keyword%'";
                        }
                        $result_set = mysqli_query($database_connection, $search_sql);
                        while ($result = mysqli_fetch_array($result_set)) {
                            if ($result['statement'] == '普通用户') {
                                echo "
                            <tr>
                                <td>" . $result['id'] . "</td>
                                <td>" . $result['userName'] . "</td>
                                <td>" . $result['password'] . "</td>
                                <td>" . $result['email'] . "</td>
                                <td>
                                    <a class=\"btn btn-primary btn-xs\" href='userSearch.php?id=" . $result['id'] . "'>删除</a>
                                    <a class=\"btn btn-primary btn-xs\" href='userUpdate.php?id=" . $result['id'] . "'>修改</a>
                                </td>
                            </tr>
                            ";
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation" class="text-center">
                        <ul class="pagination">
                            <?php
                            //打印分页导航条
                            $url = $_SERVER["PHP_SELF"];
                            page($total_records, $page_size, $page_current, $url, $keyword, null, null);
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!--<script>

    /*document.getElementById('searchInfo').oninput = function () {
        if (document.getElementById('searchInfo').value == ''){
            document.getElementById('search').setAttribute('disabled','true');
        }
        if (document.getElementById('searchInfo').value != '') {
            document.getElementById('search').setAttribute('disabled','false');
        }
    };*/
   function deleteUser() {

   }
</script>-->

</body>
<script src="../../js/jquery.js"></script>
<script src="../../js/bootstrap.js"></script>
<!--<script>
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('myform').innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET", "../../css/myform.dat", true);
    xmlhttp.send();
</script>-->
</html>