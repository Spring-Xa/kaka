<?php
//获取文章id
$article_id = $_GET['article_id'];
//获取评论内容
$comment = $_POST['comment'];
//连接数据库
$conn = mysqli_connect("localhost", "root", "123456", "kaka");
//设置编码
mysqli_set_charset($conn, "utf8");
//获取当前用户
session_start();
$user = $_SESSION['user'];
//插入评论
$sql = "insert into `kaka`.`ka_comment` (`comment_content`, `comment_time`, `comment_author`, `comment_article`) values ('$comment',now(),'$user', '$article_id')";
$result = mysqli_query($conn, $sql);
//判断是否插入成功
if ($result) {
    //查询评论数
    $sql_select = "SELECT * FROM `kaka`.`ka_article` WHERE article_id  = '$article_id'";
    $ret = mysqli_query($conn, $sql_select);
    $row = mysqli_fetch_array($ret);
    $comment_muns = $row['article_comment'];
    //评论数加1
    $comment_muns = $comment_muns + 1;
    //更新评论数
    $sql_update_comment = "UPDATE `kaka`.`ka_article` SET `article_comment` = '$comment_muns' WHERE `article_id` = '$article_id'";
    mysqli_query($conn, $sql_update_comment);
    echo "<script>alert('评论成功！');history.back();</script>";
} else {
    echo "<script>alert('评论失败！');history.back();</script>";
}
?>