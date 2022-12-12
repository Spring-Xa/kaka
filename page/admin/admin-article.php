<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>卡卡时光机-博客管理</title>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/common_table.css">
    <script src="js/loginTimeout.js"></script>
</head>
<body>
<?php
//开启session
session_start();
//声明变量
$username = isset($_SESSION['user']) ? $_SESSION['user'] : "";
$conn = mysqli_connect("localhost", "root", "123456", "kaka");
$role = mysqli_query($conn, "select * from `kaka`.`ka_user` where user_name='$username'");
$role = mysqli_fetch_array($role);
$role = $role['user_role'];

if ($username != "") {
    //判断身份
    if ($role != "1") {
        echo "<script>alert('您不是管理员，无法访问！');window.location.href='/page/login.php';</script>";
    } else {
        echo "<div class='container'>";
    }
} else {
    //未登录或者session过期，跳转到登录页面
    echo "<script>alert('登录信息已过期！');window.location.href='/page/login.php';</script>";
}
?>
<div class="container">
    <div class="header">
        <div class="logo">
            <img src="/images/login/logo.png" alt="logo">
        </div>
        <!--刷新-->
        <div class="refresh">
            <a href="javascript:location.reload();">刷新</a>
        </div>
        <div class="logout">
            <a href="/page/logout.php">退出系统</a>
        </div>
        <div class="enter_former">
            <a href="/page/blog.php">进入前台</a>
        </div>
    </div>
    <div class="left-nav">
        <div class="user-info">
            <div class="user-img">
                <!--查询数据库中头像url-->
                <?php
                $sql = "select * from `kaka`.`ka_user` where user_name='$username'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result);
                $img = $row['user_img'];
                echo "<img class='user-img' src='$img' alt='user-img'>";
                ?>
            </div>
            <div class="user-name">
                <?php
                echo $_SESSION['user'];
                ?>
            </div>
        </div>
        <div class="nav">
            <ul>
                <li><a href="admin-home.php">首页</a></li>
                <li><a href="admin-user.php">用户管理</a></li>
                <li><a href="admin-log.php">日志管理</a></li>
                <li><a href="admin-article.php">博客管理</a></li>
            </ul>
        </div>
    </div>
    <div class="right-content">
        <div class="right-content-header">
            <div class="welcome">
                <div class="welcome-text">
                    <!--让欢迎语滚动起来-->
                    <marquee behavior="scroll" direction="left" scrollamount="3" scrolldelay="3" width="100%">
                        <div><h4><?php echo $_SESSION['user']; ?> &ensp;欢迎来到卡卡时光机后台管理系统</h4></div>
                        <!--动态显示当前日期和时间-->
                        <div id="DateTime">
                            <!--引入js文件-->
                            <script type="text/javascript" src="js/DateTime.js"></script>
                        </div>
                    </marquee>
                </div>
            </div>
        </div>
        <div class=" right-content-body">
            <div class="right-content-body-header">
                <table class="title">
                    <tr>
                        <th colspan="9">博客管理</th>
                    </tr>
                </table>
            </div>
            <div class="control">
                <table class="control-table">
                    <tr>
                        <td>
                            <div class="search">
                                <form action="admin-article.php" method="post">
                                    <label>
                                        <input type="text" name="search" placeholder="请输入关键字">
                                    </label>
                                    <input type="submit" name="submit" value="搜索">
                                </form>
                            </div>
                        </td>
                        <td>
                            <div class="add">
                                <button onclick="add()">
                                    <a href="/page/publish.php">发布博客</a>
                                </button>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="right-content-body-content">
                <table class="user-info-table">
                    <tr>
                        <th>序号</th>
                        <th>blog-ID</th>
                        <th>作者</th>
                        <th>发布时间</th>
                        <th>状态</th>
                        <th>类型</th>
                        <th>浏览量</th>
                        <th>点赞</th>
                        <th>评论</th>
                        <th>操作</th>
                    </tr>
                    <?php
                    //连接数据库
                    $conn = mysqli_connect('localhost', 'root', '123456', 'kaka');
                    //查询语句
                    $sql = "select * from `kaka`.ka_article";
                    //执行查询语句
                    $result = mysqli_query($conn, $sql);
                    //判断是否查询成功
                    if ($result) {
                        $i = 1;
                        //遍历查询结果
                        while ($row = mysqli_fetch_assoc($result)) {
                            //输出查询结果
                            echo "<tr>";
                            echo "<td>" .$i. "</td>";
                            echo "<td>" . $row['article_id'] . "</td>";
                            echo "<td>" . $row['article_author'] . "</td>";
                            echo "<td>" . $row['article_time'] . "</td>";
                            echo "<td>" . $row['article_state'] . "</td>";
                            echo "<td>" . $row['article_type'] . "</td>";
                            echo "<td>" . $row['article_views'] . "</td>";
                            echo "<td>" . $row['article_like'] . "</td>";
                            echo "<td>" . $row['article_comment'] . "</td>";
                            echo "<td><button><a href='/page/edit.php?id=" . $row['article_id'] . "'>编辑</a></button> <button><a href='/page/delete.php?id=" . $row['article_id'] . "'>删除</a></button></td>";
                            echo "</tr>";
                            $i++;
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>