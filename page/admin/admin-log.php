<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>卡卡时光机-日志管理</title>
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
                        <th colspan="9">日志管理</th>
                    </tr>
                </table>
            </div>
            <div class="control">
                <table class="control-table">
                    <tr>
                        <td>
                            <div class="search">
                                <form action="admin-log.php" method="post">
                                    <label>
                                        <input type="text" name="search" placeholder="请输入关键字">
                                    </label>
                                    <input type="submit" name="submit" value="搜索">
                                </form>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="right-content-body-content">
                <div class="System-Login-Log">
                    <table class="user-info-table">
                        <tr>
                            <th>序号</th>
                            <th>用户名</th>
                            <th>用户角色</th>
                            <th>操作IP</th>
                            <th>操作时间</th>
                            <th>操作地点</th>
                            <th>操作</th>
                            <th>处理</th>
                        </tr>
                        <?php
                        //查询语句
                        $sql = "select * from `kaka`.`ka_oper_log` ORDER BY `oper_time` DESC";
                        //执行查询语句
                        $result = mysqli_query($conn, $sql);
                        //获取查询结果
                        $row = mysqli_fetch_array($result);
                        //输出查询结果
                        $i = 1;
                        while ($row) {
                            if ($row['oper_u_role'] = '0') {
                                $role = '超级管理员';
                            } else if ($row['oper_u_role'] = '1') {
                                $role = '管理员';
                            } else if ($row['oper_u_role'] = '2') {
                                $role = '普通用户';
                            }
                            echo "<tr>";
                            echo "<td>" . $i . "</td>";
                            echo "<td>" . $row['oper_u_name'] . "</td>";
                            echo "<td>" . $role . "</td>";
                            echo "<td>" . $row['oper_ip'] . "</td>";
                            echo "<td>" . $row['oper_time'] . "</td>";
                            echo "<td>" . $row['oper_address'] . "</td>";
                            echo "<td>" . $row['oper_content'] . "</td>";
                            echo "<td>";
//                            echo "<button><a href='/page/admin/ctrl/edit_log.php?id=" . $row['oper_id'] . "'>编辑</a></button>";
//                            echo "&ensp;";
                            echo "<button><a href='/page/admin/ctrl/delete_log.php?id=" . $row['oper_id'] . "'>删除</a></button>";
                            echo "</td></tr>";
                            $row = mysqli_fetch_array($result);
                            $i++;
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>