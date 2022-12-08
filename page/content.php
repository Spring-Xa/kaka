<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>卡卡时光机</title>
    <!-- 加载样式表 -->
    <!-- Google web字体“Open Sans” -->
    <link rel="stylesheet" href="/css?family=Open+Sans:300,400">
    <!-- Bootstrap样式 -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <!-- 模板样式 -->
    <link rel="stylesheet" href="/css/templatemo-style.css">

    <!-- HTML5填充和响应。js for IE8支持HTML5元素和媒体查询 -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

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
        $title = $row['article_title'];
        $content = $row['article_content'];
        $time = $row['article_time'];
    }
    ?>

</head>
<body>
<div class="tm-header">
    <div class="container-fluid">
        <div class="tm-header-inner">
            <!--点击logo跳转到主页-->
            <a href="blog.php" class="navbar-brand tm-site-name">卡卡时光机</a>
            <!-- 标题 -->
            <nav class="navbar tm-main-nav">
                <button class="navbar-toggler hidden-md-up" type="button" data-toggle="collapse"
                        data-target="#tmNavbar">&#9776;
                </button>
                <div class="collapse navbar-toggleable-sm" id="tmNavbar">
                    <ul class="nav navbar-nav">

                        <li class="nav-item">
                            <a href="blog.php" class="nav-link">首页</a>
                        </li>
                        <li class="nav-item">
                            <a href="publish.php" class="nav-link">发布博客</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>

<div><img src="/images/tm-blog-img.jpg" style="width: 100%;height: 150px" alt=""></div>

<section class="tm-section">
    <div class="container-fluid" style="margin-top: -60px">
        <div class="row">
                <table class="table table-striped">
                    <tr>
                        <td style="width: 120px">标题：</td>
                        <td>
                           <?php echo $title; ?>
                        </td>
                        <td style="width: 60px">
                            <a href="blog.php">退出</a>
                        </td>
                    </tr>
                    <tr>
                        <td>发布时间：</td>
                        <td><?php echo $time; ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>内容：</td>
                        <td>
                            <?php echo $content ?>
                        </td>
                        <td></td>
                    </tr>
                </table>
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
                        <img src="/images/tm-img-100x100-1.jpg" alt="Image" class="tm-footer-thumbnail">
                        <img src="/images/tm-img-100x100-2.jpg" alt="Image" class="tm-footer-thumbnail">
                        <img src="/images/tm-img-100x100-3.jpg" alt="Image" class="tm-footer-thumbnail">
                        <img src="/images/tm-img-100x100-4.jpg" alt="Image" class="tm-footer-thumbnail">
                        <img src="/images/tm-img-100x100-5.jpg" alt="Image" class="tm-footer-thumbnail">
                        <img src="/images/tm-img-100x100-6.jpg" alt="Image" class="tm-footer-thumbnail">
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

<!-- 加载JS文件 -->
<script src="/scripts/jquery-1.11.3.min.js"></script>
<script src="/scripts/tether.min.js"></script>
<script src="/scripts/bootstrap.min.js"></script>

</body>
</html>