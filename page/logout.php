<?php
session_start();
//获取当前用户的用户名
$username = $_SESSION['user'];
echo '<script>alert("' . $username . '，您已成功退出登录！");</script>';
//连接数据库
$conn = mysqli_connect('localhost', 'root', '123456', 'kaka');
//获取当前用户的ID,用户名,角色
$ret = mysqli_query($conn, "SELECT * FROM `kaka`.`ka_user` WHERE user_name = '$username'");
$row = mysqli_fetch_array($ret);
$log_u_id = $row['user_id'];
$ip = $_SERVER['REMOTE_ADDR'];
$log_u_name = $row['user_name'];
$log_u_role = $row['user_role'];
//根据IP查询出省市
$url = file_get_contents("https://ip.taobao.com/outGetIpInfo?ip=" . $ip . "&accessKey=alibaba-inc");
$data = json_decode($url, true);
$address = $data['data']['country'] . $data['data']['region'] . $data['data']['city'];
//在数据库中写入退出登录的操作日志
$sql_insert = "INSERT INTO `kaka`.`ka_oper_log` (`oper_u_name`, `oper_u_role`,`oper_time`, `oper_content`, `oper_ip`, `oper_address`)
                        VALUES ('$log_u_name', '$log_u_role', now(), '用户登出', '$ip', '$address');";
mysqli_query($conn, $sql_insert);
//在数据库用户表中写入退出登录的状态 0为未登录 1为已登录
$sql_update = "update `kaka`.`ka_user` set `user_state` = '0' where `user_name` = '$username'";
mysqli_query($conn, $sql_update);
//关闭数据库
mysqli_close($conn);
//清除session
unset($_SESSION['user']);
echo "<script>window.location.href='/page/login.php';</script>";