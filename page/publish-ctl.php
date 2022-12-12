<?php
$author = $_POST['author'];
$title = $_POST['title'];
$htmlData = '';


if (get_magic_quotes_gpc()) {
    $htmlData = stripslashes($_POST['content']);
} else {
    $htmlData = $_POST['content'];
}


// 允许上传的图片后缀
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);     // 获取文件后缀名
if ((($_FILES["file"]["type"] == "image/gif")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/jpg")
        || ($_FILES["file"]["type"] == "image/pjpeg")
        || ($_FILES["file"]["type"] == "image/x-png")
        || ($_FILES["file"]["type"] == "image/png"))
    && ($_FILES["file"]["size"] < 2048000)   // 小于 2 M
    && in_array($extension, $allowedExts)) {
    if ($_FILES["file"]["error"] > 0) {
        echo "错误：: " . $_FILES["file"]["error"] . "<br>";
    } else {
        //为上传的文件重命名(用户名+时间戳)
        $_FILES["file"]["name"] = $author . time() . "." . $extension;
        echo "<script>console.log('文件名：' + " . $_FILES["file"]["name"] . ");</script>";
        echo "<script>console.log('文件类型：' + " . $_FILES["file"]["type"] . ");</script>";
        echo "<script>console.log('文件大小：' + " . ($_FILES["file"]["size"] / 1024) . " + ' kB');</script>";
        // 判断当期目录下的 upload 目录是否存在该文件
        // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
        if (file_exists("D:\AppGallery\Software\phpstudy_pro\WWW\kaka\upload\article/" . $_FILES["file"]["name"])) {
            echo "<script>alert('文件已存在！');history.go(-1);</script>";
        } else {
            // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
            move_uploaded_file($_FILES["file"]["tmp_name"], "D:\AppGallery\Software\phpstudy_pro\WWW\kaka\upload\article/" . $_FILES["file"]["name"]);
            //生成URL
            $url = "http://127.0.0.1:80/upload/article/" . $_FILES["file"]["name"];
            echo "<script>console.log('文件上传成功');</script>";
            //插入数据
            $sql_insert = "INSERT INTO `kaka`.`ka_article`(article_title, article_content, article_img, article_time, article_state, article_type, article_views, article_like, article_comment, article_author)
                        VALUE ('$title','$htmlData','$url',now(),'正常','普通','0','0','0','$author')";
            $conn = mysqli_connect("localhost", "root", "123456", "kaka");
            $result = mysqli_query($conn, $sql_insert);

            //在数据库中写入操作日志
            //准备SQL语句
            $sql_select = "SELECT * FROM `kaka`.`ka_user` WHERE `user_name` = '$author'";
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
                        VALUES ('$user_name', '$log_u_role', now(), '发布博客', '$ip', '$address');";
            mysqli_query($conn, $sql_insert_log);

            echo "<script>alert('发布成功！');window.location.href='myblog.php';</script>";
        }
    }
} else {
    echo "<script>alert('非法的文件格式！');history.go(-1);</script>";
}
