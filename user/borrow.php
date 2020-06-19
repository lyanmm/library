<?php
include_once("../functions/database.php");
include_once("../functions/page.php");
include_once("../functions/myform.php");
@$userName = $_COOKIE['userName'];
@$userId = $_COOKIE['id'];
//构造查询所有书籍的SQl语句
$search_sql = "select * from borrow where id = '$userId'and returnDate is NULL";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../icon/img/timg.jpg">
    <title>图书管理系统</title>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css">
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
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
                <a class="list-group-item" href="index.php?userId=<?php echo $userId ?>&userName=<?php echo $userName ?>">查询书籍</a>
                <a class="list-group-item active" href="borrow.php?userId=<?php echo $userId ?>&userName=<?php echo $userName ?>">借还书籍</a>
                <a class="list-group-item" href="borrowed.php?userId=<?php echo $userId ?>&userName=<?php echo $userName ?>">借阅记录</a>
                <!--<a class="list-group-item" href="information.php?userId=<?php /*echo $userId */?>&userName=<?php /*echo $userName */?>">我的信息</a>-->
            </div>
        </div>
        <div class="col-sm-10">
            <div class="book-list">
                <div class="panel panel-default">
                    <div class="panel-heading">在借书籍</div>
                    <div class="panel-body">
                        <?php
                        get_connection();
                        $result = mysqli_query($database_connection, $search_sql);
                        $total_records = mysqli_num_rows($result);
                        $page_size = 5;
                        if(isset($_GET["page_current"])){
                            $page_current = $_GET["page_current"];
                        }else{
                            $page_current=1;
                        }
                        $start = ($page_current-1) * $page_size;
                        $search_sql = "select * from borrow where id='$userId'and returnDate is NULL limit $start,$page_size";
                        $result_set = mysqli_query($database_connection, $search_sql);
                        if(mysqli_num_rows($result_set)>0){
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
                        }else{
                            exit("");
                        }
                        while($row = mysqli_fetch_array($result_set)) {
                            $bookNo = $row['bookNo'];
                            $search_book_sql = "select * from book where bookNo='$bookNo'";
                            $result_book_set = mysqli_query($database_connection, $search_book_sql);
                            while ($row_book = mysqli_fetch_array($result_book_set)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $row_book["bookName"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row_book["authorName"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row_book["publisherName"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row_book["bookNo"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row_book["statement"] ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-xs" id="returnBook"
                                                onclick="location='bookReturn.php?bookNo=<?php echo $row['bookNo'] ?>&userName=<?php echo $userName ?>&userId=<?php echo $userId ?>'">
                                            还书
                                        </button>
                                        <button class="btn btn-primary btn-xs"
                                                onclick="location='bookRenew.php?bookNo=<?php echo $row['bookNo'] ?>&userName=<?php echo $userName ?>&userId=<?php echo $userId ?>'">
                                            续借
                                        </button>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        close_connection();
                        ?>
                        </tbody>
                        </table>
                        <nav aria-label="Page navigation" class="text-center">
                            <ul class="pagination">
                        <?php
                        //打印分页导航条
                        $url = $_SERVER["PHP_SELF"];
                        page($total_records,$page_size,$page_current,$url,null,$userId,$userName);
                        ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>