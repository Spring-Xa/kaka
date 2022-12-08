<?php
session_start();
//获取当前用户的用户名
$username = $_SESSION['user'];
echo '<script>alert("' . $username . '，您已成功退出登录！");</script>';
////连接数据库
//$conn = mysqli_connect('localhost', 'root', '123456', 'ai_classroom');
////获取当前用户的ID,用户名,角色
//$ret = mysqli_query($conn, "SELECT * FROM ka_user WHERE u_name = '$username'");
//$row = mysqli_fetch_array($ret);
//$log_u_id = $row['u_id'];
//$log_u_name = $row['u_name'];
//$log_u_role = $row['u_role'];
////在数据库中写入退出登录的操作日志
//$sql_insert = "INSERT INTO `ai_classroom`.`operation_log` (`operatlog_u_id`, `operatlog_u_name`, `operatlog_u_role`,`operatlog_time`, `operatlog_content`)
//                VALUES ('$log_u_id', '$log_u_name', '$log_u_role', now(), '登出');";
//mysqli_query($conn, $sql_insert);
////在数据库用户表中写入退出登录的状态 0为未登录 1为已登录
//$sql_update = "UPDATE `ai_classroom`.`user` SET `u_status` = '0' WHERE (`u_id` = '$log_u_id');";
//mysqli_query($conn, $sql_update);
////关闭数据库
//mysqli_close($conn);
//清除session
unset($_SESSION['user']);
echo "<script>window.location.href='Login.php';</script>";