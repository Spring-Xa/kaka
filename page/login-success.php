<!DOCTYPE html>
<html lang="zh">
<head>
    <title>AI智慧课堂-登录</title>
    <meta name="content-type" charset="UTF-8">
</head>
<body>
<div>
    <?php
    //开启session
    session_start();
    //声明变量
    $username = isset($_SESSION['user']) ? $_SESSION['user'] : "";
    //判断session不为空
    if ($username != "") {
        echo "<script>console.log('登录成功！');window.location.href='blog.php';</script>";
//        //判断身份
//        $conn = mysqli_connect('localhost', 'root', '123456', 'kaka');
//        $sql = "select * from ka_user where user_name = '$username'";
//        $result = mysqli_query($conn, $sql);
//        $row = mysqli_fetch_array($result);
//        $role = $row['user_role'];
//        if ($role == 1) {
//            echo "<script>alert('登录成功！');window.location.href='../admin/admin.php';</script>";
//        } else {
//            echo "<script>alert('登录成功！');window.location.href='../blog.php';</script>";
//        }
        //关闭数据库
//        mysqli_close($conn);
    } else {
        //跳转到登录页面
        header("Location:Login.php");
    }
    ?>
</div>
</body>
</html>