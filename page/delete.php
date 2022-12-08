<?php
//建立连接
$conn = mysqli_connect('localhost', 'root', '123456', 'kaka');
//然后是指定php链接数据库的字符集
mysqli_set_charset($conn,'utf8');
$sql = "DELETE FROM `kaka`.`ka_article` WHERE `article_id` = '$_GET[id]'";
//模糊查询出像数据库中的title或者content里面的值或者说像数据库中的title或者content里面的某一段值相对应的就行了,就可以输出啦
$result=mysqli_query($conn,"$sql");
# 提示结果
$sql_select = "SELECT FROM `kaka`.`ka_article` WHERE `article_id` = '$_GET[id]'";
$result=mysqli_query($conn,$sql_select);
if($result != ""){
    echo "<script>alert('删除失败！')</script>";
} else {
    echo "<script>alert('删除成功！')</script>";
}
# 关闭数据库
mysqli_close($conn);
echo "<script>window.location.href='myblog.php';</script>";
?>
