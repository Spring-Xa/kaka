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
    $user_name = $row['user_name'];
    $log_u_role = $row['user_role'];
    $ip = $_SERVER['REMOTE_ADDR'];
    //获取当前时间显示到秒
    $login_time = date("Y-m-d H:i:s");
    //根据IP查询出省市
    $url = file_get_contents("https://ip.taobao.com/outGetIpInfo?ip=" . $ip . "&accessKey=alibaba-inc");
    $data = json_decode($url, true);
    $address = $data['data']['country'] . $data['data']['region'] . $data['data']['city'];
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
        //更新最后登录时间
        $sql_update = "update `kaka`.`ka_user` set `user_lasttime` = now() where user_name = '$user_name';";
        mysqli_query($conn, $sql_update);
        //在数据库中写入操作日志
        $sql_insert = "INSERT INTO `kaka`.`ka_oper_log` (`oper_u_name`, `oper_u_role`,`oper_time`, `oper_content`, `oper_ip`, `oper_address`)
                        VALUES ('$user_name', '$log_u_role', now(), '用户登录', '$ip', '$address');";
        mysqli_query($conn, $sql_insert);
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