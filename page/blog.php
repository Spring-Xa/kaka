<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>我的时光机</title>
    <!-- load stylesheets -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Bootstrap style -->
    <link rel="stylesheet" href="../css/templatemo-style.css">
    <!-- Templatemo style -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php
    session_start();
    $user = $_SESSION['user'];
    //建立连接
    $conn = mysqli_connect('localhost', 'root', '123456', 'kaka');
    ?>
</head>

<body>
<div class="tm-header">
    <div class="container-fluid">
        <div class="tm-header-inner">
            <!--点击logo跳转到主页-->
            <a href="/page/blog.php" class="navbar-brand tm-site-name">卡卡时光机</a>
            <!-- 标题 -->
            <nav class="navbar tm-main-nav">
                <button class="navbar-toggler hidden-md-up" type="button" data-toggle="collapse"
                        data-target="#tmNavbar">&#9776;
                </button>
                <div class="collapse navbar-toggleable-sm" id="tmNavbar">
                    <ul class="nav navbar-nav">
                        <li class="nav-item active">
                            <a href="/page/blog.php" class="nav-link">首页</a>
                        </li>
                        <li class="nav-item">
                            <a href="/page/publish.php" class="nav-link">发布博客</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>

<div><img src="/images/tm-about-img.jpg" style="width: 100%;height: 150px" alt=""></div>

<section class="tm-section">
    <div class="search" style="margin-left: 80px;margin-top: -70px;margin-bottom: 10px;">
        <form method="post" name="search" action="/page/search.php">
            <table>
                <tr>
                    <td>
                        <input name="keywords" type="text" placeholder="请输入关键字！" required="required">
                    </td>
                    <td><input name="submit" type="submit" value="搜索"></td>
                </tr>
            </table>
        </form>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9 col-xl-9">
                <?php
                $sql_select_hot = "SELECT * FROM `kaka`.`ka_article` ORDER BY article_views DESC LIMIT 1;";
                $ret = mysqli_query($conn, $sql_select_hot);
                $row = mysqli_fetch_array($ret);
                $article_id = $row['article_id'];
                $article_title = $row['article_title'];
                $article_img = $row['article_img'];
                $article_content = $row['article_content'];
                print <<<EOT
                
                    <div class="tm-blog-post" style="color: black;border: #f5f5f5 1px solid;margin-bottom: 20px;padding-bottom: -40px;padding-top: 20px;padding-left: 20px;padding-right: 20px">
                        <a href='/page/content.php?id=$article_id' style="text-decoration: none;color: black">
                        <h3 class="tm-gold-text">$article_title</h3>
                        <img src="$article_img" alt="Image" class="img-fluid tm-img-post" style="max-height: 250px">
                        </a>
                        <p>$article_content</p>
                    </div>
                
EOT;
                ?>
                <div class="row">
                    <?php
                    //物理分页
                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $pageSize = 8;
                    $offset = ($page - 1) * $pageSize;
                    //准备SQL语句
                    $sql_select = "SELECT * FROM `kaka`.`ka_article` ORDER BY article_views DESC LIMIT $offset,$pageSize;";
                    //执行SQL语句
                    $ret = mysqli_query($conn, $sql_select);
                    while ($row = mysqli_fetch_array($ret)) {
                        if ($row != "") {
                            $article_id = $row['article_id'];
                            $article_time = $row['article_time'];
                            $article_title = $row['article_title'];
                            $article_img = $row['article_img'];
                            print <<<eot
                        <a href='/page/content.php?id=$article_id'>
                            <div class='col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3'>
                                <div class='tm-content-box'>
                                    <img src='$article_img' alt='Image' class='tm-margin-b-20 img-fluid' style='width: 310px;height: 180px;'>
                                    <table style='width: 100%;text-align: justify-all'>
                                        <tr>
                                            <td>
                                                <p class='tm-margin-b-20 tm-gold-text' style='width:100%;height:40px;white-space: nowrap;/*强制在一行显示*/text-overflow:ellipsis;/*设置超出内容显示...*/overflow: hidden;'>$article_title</p>
                                            </td>
                                            <td>
                                                <p class='tm-margin-b-20 tm-gold-text' style='width:100%;height:40px;white-space: nowrap;/*强制在一行显示*/text-overflow:ellipsis;/*设置超出内容显示...*/overflow: hidden;'>$article_time</p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </a>
eot;
                        } else {
                            echo "<div style='text-align: center'>暂无内容！</div>";
                        }
                    }
                    ?>
                </div>
                <!--分页-->
                <div style="text-align: center; margin-top: 15px">
                <span>
                    <?php
                    //查询总记录数
                    $sql_select_count = "SELECT COUNT(*) FROM `kaka`.`ka_article`;";
                    //执行SQL语句
                    $result = mysqli_query($conn, $sql_select_count);
                    $row = mysqli_fetch_array($result);
                    $count = $row[0];
                    //计算总页数
                    $pageCount = ceil($count / $pageSize);
                    echo "共{$count}条记录,共{$pageCount}页&ensp;";
                    echo "当前是第{$page}页";
                    echo "<br>";
                    if ($page == 1) {
                        echo "<a href='?page=1'>首页&ensp;</a>";
                        echo "<a href='?page=" . ($page + 1) . "'>下一页&ensp;</a>";
                        echo "<a href='?page=" . ($pageCount) . "'>尾页</a>";
                    } else if ($page == $pageCount) {
                        echo "<a href='?page=1'>首页&ensp;</a>";
                        echo "<a href='?page=" . ($page - 1) . "'>上一页&ensp;</a>";
                        echo "<a href='?page=" . ($pageCount) . "'>尾页</a>";
                    } else {
                        echo "<a href='?page=1'>首页&ensp;</a>";
                        echo "<a href='?page=" . ($page - 1) . "'>上一页&ensp;</a>";
                        echo "<a href='?page=" . ($page + 1) . "'>下一页&ensp;</a>";
                        echo "<a href='?page=" . ($pageCount) . "'>尾页</a>";
                    }
                    ?>
                </span>
                </div>
            </div>
            <aside class="col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xl-3 tm-aside-r">
                <div class="tm-aside-container">
                    <!--下面为我的个人信息-->
                    <div class="tm-aside-widget" style="text-align: center;border: #f5f5f5 1px solid;padding: 20px">
                        <?php
                        //    //判断是否登录
                        if (!isset($_SESSION['user'])) {
                            echo "未登录，去=><a href='/page/login.php'>登录！</a>";
                        } else {
                            $sql = "select * from `kaka`.`ka_user` where user_name = '$user'";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($result);
                            //输出个人信息
                            $img_url = $row['user_img'];
                            $address = $row['user_address'];
                            $email = $row['user_email'];
                            $regtime = $row['user_regtime'];
                            $lasttime = $row['user_lasttime'];
                            //ip
                            $login_ip = $_SERVER['REMOTE_ADDR'];
                            $url = file_get_contents("https://ip.taobao.com/outGetIpInfo?ip=" . $login_ip . "&accessKey=alibaba-inc");
                            $data = json_decode($url, true);
                            $login_address = $data['data']['country'] . $data['data']['region'] . $data['data']['city'];
                            //查询用户身份
                            $sql_select_role = "SELECT * FROM `kaka`.`ka_user` WHERE user_name = '$user';";
                            //执行SQL语句
                            $result = mysqli_query($conn, $sql_select_role);
                            $row = mysqli_fetch_array($result);
                            $role = $row['user_role'];
                            print <<<eto
                                <div>
                                    <a href='/page/myblog.php'>
                                        <img src='$img_url' alt='Image' style='width:120px;height:120px;'>
                                    </a>
                                </div>
                                <span>欢迎您!&ensp;$user</span>
                                
                                <hr>
                                <span>
                                    <a href='/page/logout.php' style='font-size: 14px'>退出登录</a>
                                </span>
                                <span id="admin">
                                        <a href='/page/admin/admin-home.php' style='margin-left: 20px;font-size: 14px'>进入后台</a>
                                </span>
                                <script>
                                    var ishidden = "$role";
                                    if (ishidden === '0' || ishidden === '1') {
                                        document.getElementById("admin").style.visibility="visible";
                                    } else {
                                        document.getElementById("admin").style.display="none";
                                    }
                                    </script>
                                
                                <table style='line-height: 60px;width: 100%;'>
                                     <tr>
                                         <td>邮箱</td>
                                         <td>$email</td>
                                     </tr>
                                     <tr>
                                         <td>注册时间</td>
                                         <td>$regtime</td>
                                     </tr>
                                     <tr>
                                         <td>上次登录</td>
                                         <td>$lasttime</td>
                                     </tr>
                                     <tr>
                                         <td>登录IP</td>
                                         <td>$login_ip</td>
                                     </tr>
                                     <tr>
                                        <td>IP属地</td>
                                        <td>$login_address</td>
                                     </tr>
                              </table>
eto;
                        }
                        ?>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<footer class="tm-footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <div class="tm-footer-content-box">
                    <h3 class="tm-gold-text tm-title tm-footer-content-box-title">时光机的宗旨</h3>
                    <div class="tm-gray-bg">
                        <p>
                            致力于让每一个人都能找到让自己放松的圈子,哪怕你喜欢的东西小众,冷门,也可以在卡卡时光机里找到伙伴</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <div class="tm-footer-content-box tm-footer-links-container">
                    <h3 class="tm-gold-text tm-title tm-footer-content-box-title">想加入时光机</h3>
                    <div class="tm-gray-bg">
                        <p>你可以将你的个人信息作为邮件发送给我们，我们会去联系你，期待你的加入！！！</p>
                    </div>
                </div>
            </div>
            <div class="clearfix hidden-lg-up"></div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <div class="tm-footer-content-box">
                    <h3 class="tm-gold-text tm-title tm-footer-content-box-title">时光机的声明</h3>
                    <div class="tm-gray-bg">
                        <p>网站文章内容纯属作者个人观点，与卡卡时光机无关，不代表卡卡时光机的立场！</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <div class="tm-footer-content-box">
                    <h3 class="tm-gold-text tm-title tm-footer-content-box-title">时光机的贡献者</h3>
                    <div class="tm-margin-b-30">
                        <img src="../images/tm-img-100x100-1.jpg" alt="Image" class="tm-footer-thumbnail">
                        <img src="../images/tm-img-100x100-2.jpg" alt="Image" class="tm-footer-thumbnail">
                        <img src="../images/tm-img-100x100-3.jpg" alt="Image" class="tm-footer-thumbnail">
                        <img src="../images/tm-img-100x100-4.jpg" alt="Image" class="tm-footer-thumbnail">
                        <img src="../images/tm-img-100x100-5.jpg" alt="Image" class="tm-footer-thumbnail">
                        <img src="../images/tm-img-100x100-6.jpg" alt="Image" class="tm-footer-thumbnail">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 tm-copyright-col">
                <p class="tm-copyright-text">Copyright &copy; 2022 卡卡时光机
                    <a target="_blank" href="https://beian.miit.gov.cn/"
                       style="color: #999999">黔ICP备2021007007号-1</a></p>
            </div>
        </div>
    </div>
</footer>

<!-- load JS files -->
<script src="../scripts/jquery-1.11.3.min.js"></script>             <!-- jQuery (https://jquery.com/download/) -->
<script src="https://www.atlasestateagents.co.uk/javascript/tether.min.js"></script>
<!-- Tether for Bootstrap, http://stackoverflow.com/questions/34567939/how-to-fix-the-error-error-bootstrap-tooltips-require-tether-http-github-h -->
<script src="../scripts/bootstrap.min.js"></script>
<!-- Bootstrap (http://v4-alpha.getbootstrap.com/) -->

</body>
</html>