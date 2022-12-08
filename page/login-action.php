<?php
//声明变量
$username = isset($_POST['username']) ? $_POST['username'] : "";
$password = md5(isset($_POST['password']) ? $_POST['password'] : "");
$remember = isset($_POST['remember']) ? $_POST['remember'] : "";
//判断用户名和密码是否为空
if (!empty($username) && !empty($password)) {
    //建立连接
    $conn = mysqli_connect('localhost', 'root', '123456', 'kaka');
    //准备SQL语句
    $sql_select = "SELECT * FROM `kaka`.`ka_user` WHERE user_name = '$username' AND user_passwd = '$password'";
    //执行SQL语句
    $ret = mysqli_query($conn, $sql_select);
    $row = mysqli_fetch_array($ret);
    //声明日志变量
    $log_u_id = $row['user_id'];
    $log_u_name = $row['user_name'];
    $log_u_role = $row['user_role'];
    $login_ip = $_SERVER['REMOTE_ADDR'];
    //获取当前时间显示到秒
    $login_time = date("Y-m-d H:i:s");
    //根据IP查询出省市
    $url = file_get_contents("https://ip.taobao.com/outGetIpInfo?ip=" . $login_ip . "&accessKey=alibaba-inc");
    $data = json_decode($url, true);
    $login_address = $data['data']['country'] . $data['data']['region'] . $data['data']['city'];
    //判断用户名或密码是否正确
    if ($username == $row['user_name'] && $password == $row['user_passwd']) {
        //选中“记住我”
        if ($remember == "on") {
            //创建cookie
            setcookie("", $username, time() + 7 * 24 * 3600);
        }
//        //开启session
        session_start();
//        //创建session
        $_SESSION['user'] = $username;
//        //在数据库中写入登录日志
//        $sql_insert = "INSERT INTO `ai_classroom`.`login_log` (`log_u_id`, `log_u_name`, `log_u_role`, `log_ip`, `log_time`, `log_address`)
//                        VALUES ('$log_u_id', '$log_u_name', '$log_u_role', '$login_ip', now(), '$login_address');";
//        mysqli_query($conn, $sql_insert);
//        //在数据库中写入操作日志
//        $sql_insert = "INSERT INTO `ai_classroom`.`operation_log` (`operatlog_u_id`, `operatlog_u_name`, `operatlog_u_role`,`operatlog_time`, `operatlog_content`)
//                        VALUES ('$log_u_id', '$log_u_name', '$log_u_role', now(), '登录');";
//        mysqli_query($conn, $sql_insert);
//        //在用户表中写入登录时间和登录状态
//        $sql_update = "UPDATE `ai_classroom`.`user` SET `u_lasttime` = now(),`u_status` = 1 WHERE `u_id` = '$log_u_id';";
//        mysqli_query($conn, $sql_update);
        //关闭数据库,跳转至login-success.php

        mysqli_close($conn);
        header("Location:login-success.php");
    } else {
        //用户名或密码错误，赋值err为1
        header("Location:login.php?err=1");
    }
} else { //用户名或密码为空，赋值err为2
    header("Location:login.php?err=2");
}
?>