<?php
session_start();
//获取评论id
$comment_id = $_GET['comment_id'];
//获取文章id
$article_id = $_GET['article_id'];
//连接数据库
$conn = mysqli_connect("localhost", "root", "123456", "kaka");
//设置编码
mysqli_set_charset($conn, "utf8");
//判断是否是该条评论的作者
$sql = "select * from `kaka`.`ka_comment` where comment_id = $comment_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if ($row['comment_author'] == $_SESSION['user']) {
    //删除评论
    $sql = "delete from `kaka`.`ka_comment` where comment_id = $comment_id";
    $result = mysqli_query($conn, $sql);
    //判断是否删除成功
    if ($result) {
        //查询评论数
        $sql_select = "SELECT * FROM `kaka`.`ka_article` WHERE article_id  = '$article_id'";
        $ret = mysqli_query($conn, $sql_select);
        $row = mysqli_fetch_array($ret);
        $comment_muns = $row['article_comment'];
        //评论数减1
        $comment_muns = $comment_muns - 1;
        //更新评论数
        $sql_update_comment = "UPDATE `kaka`.`ka_article` SET `article_comment` = '$comment_muns' WHERE `article_id` = '$article_id'";
        mysqli_query($conn, $sql_update_comment);
        echo "<script>alert('删除成功！');history.back();</script>";
    } else {
        echo "<script>alert('删除失败！');history.back();</script>";
    }
} else {
    echo "<script>alert('您不是该评论的作者，无法删除！');history.back();</script>";
}
