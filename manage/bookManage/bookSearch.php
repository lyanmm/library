<?php
include_once("../../functions/database.php");
include_once("../../functions/page.php");
include_once("../../functions/myform.php");
//构造查询所有书籍的SQl语句
$search_sql = "select * from book";
//若进行模糊查询，取得模糊查询的关键字keyword
$keyword = "";
if ($_GET["keyword"]!='') {
    $keyword = $_GET["keyword"];
    //构造模糊查询书籍的SQL语句
    $search_sql = "select * from book where bookNo like '%$keyword%' or bookName like '%$keyword%' or authorName like '%$keyword%'or publisherName like '%$keyword%'";
}
//提供进行模糊查询的form表单
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
                <a class="list-group-item active" href="bookSearch.php">查询图书</a>
                <a class="list-group-item" href="bookAdd.php">增添图书</a>
            </div>
        </div>
        <div class="col-sm-10">
            <div class="book-list">
                <div class="panel panel-default">
                    <div class="panel-heading">查询图书</div>
                    <div class="search-div  panel-body">
                        <form action="bookSearch.php" method="get">
                            <div class="search-bar">
                                <input type="search" name="keyword" class="form-control" placeholder="查询书名、图书编码、作者、出版社">
                            </div>
                            <button type="submit" class="btn btn-primary">查询</button>
                        </form>

                    </div>
                </div>
                <div class="search-result">

                    <?php
                    get_connection();
                    $result_news = mysqli_query($database_connection, $search_sql);
                    $total_records = mysqli_num_rows($result_news);
                    $page_size = 5;
                    if (isset($_GET["page_current"])) {
                        $page_current = $_GET["page_current"];
                    } else {
                        $page_current = 1;
                    }
                    $start = ($page_current - 1) * $page_size;
                    $search_sql = "select * from book limit $start,$page_size";
                    if (isset($_GET["keyword"])) {
                        $keyword = $_GET["keyword"];
                        //构造模糊查询新闻的SQL语句
                        $search_sql = "select * from book where bookNo like '%$keyword%' or bookName like '%$keyword%' or authorName like '%$keyword%'or publisherName like '%$keyword%' limit $start,$page_size";
                    }
                    $result_set = mysqli_query($database_connection, $search_sql);
                    close_connection();
                    if (mysqli_num_rows($result_set) > 0) {
                        echo "
                        <table class=\"table table-hover\">
                        <thead>
                        <tr >
                            <th>书名</th>
                            <th>作者</th>
                            <th>出版社</th>
                            <th>ISBN</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>";
                    } else {
                        exit("");
                    }
                    while ($row = mysqli_fetch_array($result_set)) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $row["bookName"] ?>
                            </td>
                            <td>
                                <?php echo $row["authorName"] ?>
                            </td>
                            <td>
                                <?php echo $row["publisherName"] ?>
                            </td>
                            <td>
                                <?php echo $row["bookNo"] ?>
                            </td>
                            <td>
                                <?php echo $row["statement"] ?>
                            </td>
                            <td>
                                <?php
                                echo "<a href='bookDeleteAc.php?bookNo=" . $row["bookNo"] . "' class=\"btn btn-primary btn-xs\">删除</a> ";
                                echo "<a href='bookUpdate.php?bookNo=" . $row["bookNo"] . "' class='btn btn-primary btn-xs' >修改</a> ";
                                echo "<a href='http://localhost:8888/BookSoftware/manage/bookManage/upload/" . $row["bookName"] . ".txt' class='btn btn-primary btn-xs' >查看</a>";
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    </table>
                    <nav aria-label="Page navigation" class="text-center">
                        <ul class="pagination">
                            <?php
                            //打印分页导航条
                            $url = $_SERVER["PHP_SELF"];
                            page($total_records, $page_size, $page_current, $url, $keyword,null,null);
                            ?>
                        </ul>
                    </nav>
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