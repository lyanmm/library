<?php
include_once("../functions/database.php");
include_once("../functions/page.php");
include_once("../functions/myform.php");
@$userName = $_COOKIE['userName'];
@$userId = $_COOKIE['id'];
//构造查询所有书籍的SQl语句
$search_sql = "select * from book";
//若进行模糊查询，取得模糊查询的关键字keyword
$keyword = "";
if(isset($_GET["keyword"])){
    $keyword = $_GET["keyword"];
    //构造模糊查询书籍的SQL语句
    $search_sql = "select * from book where bookNo like '%$keyword%' or bookName like '%$keyword%' or authorName like '%$keyword%'or publisherName like '%$keyword%'";
}
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
            <a href="index.php?userId=<?php echo $userId ?>&userName=<?php echo $userName ?>" class="navbar-brand"><img src="../icon/book.png"> 图书借阅管理系统</a>
        </div>

        <label id="toggle-label" class="visible-xs-inline-block" for="toggle-checkbox">MENU</label>
        <input class="hidden" id="toggle-checkbox" type="checkbox">
        <div class="hidden-xs">
            <ul class="nav navbar-nav navbar-right">
                <li ><a href="" data-toggle="modal" data-target="#myModal">欢迎你，<?php echo $userName ?></a> </li>
                <li><a href="login.php">注销</a> </li>
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
                <a class="list-group-item active" href="index.php?userId=<?php echo $userId ?>&userName=<?php echo $userName ?>">查询书籍</a>
                <a class="list-group-item" href="borrow.php?userId=<?php echo $userId ?>&userName=<?php echo $userName ?>">借还书籍</a>
                <a class="list-group-item" href="borrowed.php?userId=<?php echo $userId ?>&userName=<?php echo $userName ?>">借阅记录</a>
                <!--<a class="list-group-item" href="information.php?userId=<?php /*echo $userId */?>&userName=<?php /*echo $userName */?>">我的信息</a>-->
            </div>
       </div>
        <div class="col-sm-10">
            <div class="book-list">
                <div class="panel panel-default">
                    <div class="panel-heading">查询</div>
                    <div class="search-div  panel-body">
                        <form action="index.php" >
                            <div class="search-bar">
                                <input type="search" class="form-control" placeholder="查询书名，图书编码，作者，出版社" name="keyword" value="<?php echo $keyword?>">
                                <input type="hidden" name="userId" value="<?php echo $userId ?>">
                                <input type="hidden" name="userName" value="<?php echo $userName ?>">
                            </div>
                            <input type="submit" class="btn btn-primary" value="查询">
                        </form>
                    </div>
                </div>
                <div class="search-result">
                    <?php
                    get_connection();
                    $result_news = mysqli_query($database_connection, $search_sql);
                    $total_records = mysqli_num_rows($result_news);
                    $page_size = 5;
                    if(isset($_GET["page_current"])){
                        $page_current = $_GET["page_current"];
                    }else{
                        $page_current=1;
                    }
                    $start = ($page_current-1) * $page_size;
                    $search_sql = "select * from book limit $start,$page_size";
                    if(isset($_GET["keyword"])){
                        $keyword = $_GET["keyword"];
                        //构造模糊查询新闻的SQL语句
                        $search_sql = "select * from book where bookNo like '%$keyword%' or bookName like '%$keyword%' or authorName like '%$keyword%'or publisherName like '%$keyword%' limit $start,$page_size";
                    }
                    $result_set = mysqli_query($database_connection, $search_sql);
                    close_connection();
                    if(mysqli_num_rows($result_set)>0){
                        echo "
                        <table class=\"table table-hover\" >
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
                    }else{
                        exit("");
                    }
                    while($row = mysqli_fetch_array($result_set)){
                        $statement = $row["statement"];
                        ?>
                        <tr>
                            <td>
                                <?php echo $row["bookName"]?>
                            </td>
                            <td>
                                <?php echo $row["authorName"]?>
                            </td>
                            <td>
                                <?php echo $row["publisherName"]?>
                            </td>
                            <td>
                                <?php echo $row["bookNo"]?>
                            </td>
                            <td>
                                <?php echo $row["statement"]?>
                            </td>
                            <td>
                                <button class="btn btn-primary btn-xs" id="borrow"  onclick="location='bookBorrow.php?bookNo=<?php echo $row['bookNo']?>&userName=<?php echo $userName?>&userId=<?php echo $userId?>'">借阅</button>
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
                    page($total_records,$page_size,$page_current,$url,$keyword,$userId,$userName);
                    ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
</html>