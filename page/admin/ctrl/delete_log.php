<?php
//删除数据库中的登录日志
$conn = mysqli_connect('localhost', 'root', '123456', 'kaka');
if ($conn->connect_error) die($conn->connect_error);
$query = "DELETE FROM `kaka`.`ka_oper_log` where `oper_id`=$_GET[id]";
$result = $conn->query($query);
//关闭数据库
mysqli_close($conn);
if (!$result) die($conn->error);
echo "<script>alert('删除成功！');history.go(-1);</script>";
?>