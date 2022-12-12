<?php
//连接数据库
$conn = mysqli_connect('localhost', 'root', '123456', 'kaka');
//删除语句
$sql = "DELETE FROM `kaka`.`ka_user` where `user_id`=$_GET[id]";
//执行删除语句
$result = mysqli_query($conn, $sql);
//关闭数据库
mysqli_close($conn);
//判断是否删除成功
if ($result) {
    echo "<script>alert('删除成功！');window.location.href='../admin-user.php';</script>";
} else {
    echo "<script>alert('删除失败！');window.location.href='../admin-user.php';</script>";
}