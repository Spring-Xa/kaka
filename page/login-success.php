<?php
//开启session
session_start();
//声明变量
$username = isset($_SESSION['user']) ? $_SESSION['user'] : "";
//判断session不为空
if ($username != "") {
    //判断身份
    $conn = mysqli_connect('localhost', 'root', '123456', 'kaka');
    $sql = "select * from `kaka`.`ka_user` where user_name = '$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $role = $row['user_role'];
    $sql_update = "update `kaka`.`ka_user` set `user_state` = '1' where `user_name` = '$username'";
    mysqli_query($conn, $sql_update);
    if ($role == 1) {
        echo "<script>alert('登录成功！');window.location.href='/page/admin/admin-home.php';</script>";
    } else {
        echo "<script>alert('登录成功！');window.location.href='/page/blog.php';</script>";
    }
    //关闭数据库
    mysqli_close($conn);
} else {
    //跳转到登录页面
    header("Location:Login.php");
}
?>