<?php
//建立连接
$conn = mysqli_connect('localhost', 'root', '123456', 'kaka');
//然后是指定php链接数据库的字符集
mysqli_set_charset($conn, 'utf8');

$id = $_GET['id'];

$sql_select = "select * from `kaka`.`ka_article` where article_id = '$id';";
$result = mysqli_query($conn, $sql_select);
$row = mysqli_fetch_array($result);
$user_name = $row['article_author'];

$sql = "DELETE FROM `kaka`.`ka_article` WHERE `article_id` = '$_GET[id]'";
$result = mysqli_query($conn, "$sql");
# 提示结果
$sql_select = "SELECT FROM `kaka`.`ka_article` WHERE `article_id` = '$_GET[id]'";
$result = mysqli_query($conn, $sql_select);
if ($result != "") {
    echo "<script>alert('删除失败！')</script>";
} else {
    //在数据库中写入操作日志
    //准备SQL语句
    $sql_select = "SELECT * FROM `kaka`.`ka_user` WHERE `user_name` = '$user_name'";
    //执行SQL语句
    $ret = mysqli_query($conn, $sql_select);
    $row = mysqli_fetch_array($ret);
    $user_name = $row['user_name'];
    $log_u_role = $row['user_role'];
    $ip = $_SERVER['REMOTE_ADDR'];
    //获取当前时间显示到秒
    $login_time = date("Y-m-d H:i:s");
    //根据IP查询出省市
    $url = file_get_contents("https://ip.taobao.com/outGetIpInfo?ip=" . $ip . "&accessKey=alibaba-inc");
    $data = json_decode($url, true);
    $address = $data['data']['country'] . $data['data']['region'] . $data['data']['city'];
    $sql_insert_log = "INSERT INTO `kaka`.`ka_oper_log` (`oper_u_name`, `oper_u_role`,`oper_time`, `oper_content`, `oper_ip`, `oper_address`)
                        VALUES ('$user_name', '$log_u_role', now(), '删除博客', '$ip', '$address');";
    mysqli_query($conn, $sql_insert_log);
    echo "<script>alert('删除成功！')</script>";
}
# 关闭数据库
mysqli_close($conn);
echo "<script>window.location.href='myblog.php';</script>";
?>
