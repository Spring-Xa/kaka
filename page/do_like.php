    <?php
    session_start();
    $user = $_SESSION['user'];
    $id = $_GET['id'];
    if (empty($id)) {
        echo "<script>window.location.href='myblog.php';</script>";
    } else {
        $conn = mysqli_connect("localhost", "root", "123456", "kaka");
        $sql_select = "SELECT * FROM `kaka`.`ka_article` WHERE article_id  = '$id'";
        //执行SQL语句
        $ret = mysqli_query($conn, $sql_select);
        $row = mysqli_fetch_array($ret);
        $likes = $row['article_like'];
        //判断是否已经点赞
        $sql_select = "SELECT * FROM `kaka`.`ka_like` WHERE like_user  = '$user' AND like_article = '$id'";
        $ret = mysqli_query($conn, $sql_select);
        //如果已经点赞，取消点赞
        if (mysqli_num_rows($ret) > 0) {
            $sql_delete = "DELETE FROM `kaka`.`ka_like` WHERE like_user  = '$user' AND like_article = '$id'";
            $ret = mysqli_query($conn, $sql_delete);
            $likes = $likes - 1;
            echo "<script>history.back()</script>";
        } else {
            $sql_insert = "INSERT INTO `kaka`.`ka_like` (`like_user`, `like_article`, `like_time`) VALUES ('$user', '$id', now())";
            $ret = mysqli_query($conn, $sql_insert);
            $likes = $likes + 1;
            echo "<script>history.back()</script>";
        }
        $sql_update_like = "UPDATE `kaka`.`ka_article` SET `article_like` = '$likes' WHERE `article_id` = '$id'";
        mysqli_query($conn, $sql_update_like);
        mysqli_close($conn);
    }
    ?>