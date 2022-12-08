<?php
//声明变量
$username = isset($_POST['username']) ? $_POST['username'] : "";
$password = md5(isset($_POST['password']) ? $_POST['password'] : "");
$email = isset($_POST['email']) ? $_POST['email'] : "";
$phone = isset($_POST['phone']) ? $_POST['phone'] : "";
$address = isset($_POST['address']) ? $_POST['address'] : "";
$role = isset($_POST['role']) ? $_POST['role'] : "";
$sex = isset($_POST['sex']) ? $_POST['sex'] : "";


//建立连接
$conn = mysqli_connect("localhost", "root", "123456", "kaka");
//准备SQL语句,查询用户名
$sql_select = "SELECT user_name,user_phone,user_email FROM `kaka`.`ka_user` WHERE user_name = '$username' or user_email = '$email' or user_phone = '$phone'";
//执行SQL语句
$ret = mysqli_query($conn, $sql_select);
$row = mysqli_fetch_array($ret);
//判断用户名是否已存在
if ($username == $row['user_name'] || $phone == $row['user_phone'] || $email == $row['user_email']) {
    //用户名已存在，显示提示信息
    echo "<script>alert('用户名、手机号或者邮箱已注册，请重新输入！');history.go(-1);</script>";
} else {
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
            $_FILES["file"]["name"] = $username . time() . "." . $extension;
            echo "<script>console.log('文件名：' + " . $_FILES["file"]["name"] . ");</script>";
            echo "<script>console.log('文件类型：' + " . $_FILES["file"]["type"] . ");</script>";
            echo "<script>console.log('文件大小：' + " . ($_FILES["file"]["size"] / 1024) . " + ' kB');</script>";
            // 判断当期目录下的 upload 目录是否存在该文件
            // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
            if (file_exists("D:\AppGallery\Software\phpstudy_pro\WWW\kaka\upload\userImg/" . $_FILES["file"]["name"])) {
                echo "<script>alert('文件已存在！');history.go(-1);</script>";
            } else {
                // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
                move_uploaded_file($_FILES["file"]["tmp_name"], "D:\AppGallery\Software\phpstudy_pro\WWW\kaka\upload\userImg/" . $_FILES["file"]["name"]);
                //生成URL
                $url = "http://127.0.0.1:80/upload/userImg/" . $_FILES["file"]["name"];
                echo "<script>console.log('文件上传成功');</script>";
                //插入数据
                //用户名不存在，插入数据
                $sql_insert = "INSERT INTO `kaka`.`ka_user` (`user_name`, `user_passwd`, `user_email`, `user_img`, `user_role`, `user_sex`, `user_phone`, `user_address`, `user_state`, `user_regtime`, `user_lasttime`)
                                VALUES ('$username', '$password', '$email', '$url', '$role', '$sex', '$phone', '$address','正常',now(), now());";
                //执行SQL语句
                mysqli_query($conn, $sql_insert);
                //查询刚刚插入的数据
                $sql_select = "SELECT * FROM `kaka`.`ka_user` WHERE user_name = '$username'";
                $ret = mysqli_query($conn, $sql_select);
                $row = mysqli_fetch_array($ret);
                //插入操作日志
//                $sql_insert_log = "INSERT INTO `kaka`.`operation_log` (`operatlog_u_id`, `operatlog_u_name`, `operatlog_u_role`,`operatlog_time`, `operatlog_content`)
//                        VALUES ('$id', '$username', '$role', now(), '注册');";
                //执行SQL语句
//                mysqli_query($conn, $sql_insert_log);
            }
        }
    } else {
        echo "<script>alert('非法的文件格式！');history.go(-1);</script>";
    }
    //判断是否插入成功
    if ($row) {
        //插入成功，跳转到登录页面
        echo "<script>alert('注册成功！');window.location.href='blog.php';</script>";
    } else {
        //插入失败，显示提示信息
        echo "<script>alert('注册失败！请稍后再试！');history.go(-1);</script>";
    }
} //关闭数据库
mysqli_close($conn);
?>
