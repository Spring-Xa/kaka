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
        $likes = $row['article_like'];
        //获取文章的浏览量
        $views = $row['article_views'];
        //浏览量加1
        $views = $views + 1;
        $sql_update = "UPDATE `kaka`.`ka_article` SET `article_views` = '$views' WHERE `article_id` = '$id'";
        mysqli_query($conn, $sql_update);
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
                    <td style="background-color: white;color: black">
                        <?php echo $content ?>
                    </td>
                    <td style="background-color: white;color: black"></td>
                </tr>
            </table>
            <table class="table table-striped" style="text-align: center">
                <tr>
                    <td>
                        <!--浏览量-->
                        <span class="glyphicon glyphicon-eye-open">浏览量:</span>
                        <span><?php echo $views ?></span>
                        <svg t="1672297117689" class="icon" viewBox="0 0 1024 1024" version="1.1"
                             xmlns="http://www.w3.org/2000/svg" p-id="2144" width="16" height="16">
                            <path d="M997 435.6c-28.2-36.7-65.4-81.4-107.4-122.2-54.6-53.2-110.5-95.6-166.1-126.3-71.2-39.2-142-59.1-210.7-59.1s-139.6 19.9-210.7 59.1c-55.5 30.7-111.4 73.1-166.1 126.3-42 40.8-79.3 85.5-107.5 122.1-34.8 45.3-34.8 107.8 0 153.1 28.2 36.7 65.4 81.4 107.4 122.2C190.5 764 246.5 806.4 302 837.1c71.2 39.2 142.1 59.1 210.7 59.1 68.7 0 139.6-19.9 210.8-59 55.5-30.7 111.4-73.1 166.1-126.3 42-40.8 79.3-85.6 107.4-122.2 34.8-45.3 34.8-107.8 0-153.1z m-37.3 99c-66.2 89-243.8 299-446.8 299-57.5 0-117.7-17.1-179-50.8-50.5-27.7-101.7-66.6-152.2-115.6-51.1-49.5-91-99.5-115.7-132.6-10-13.5-10-31.6 0-44.9 66.1-89 243.7-299 446.8-299 57.5 0 117.6 17.1 179 50.8 50.5 27.7 101.7 66.6 152.2 115.6 51.1 49.5 91 99.5 115.7 132.6 9.9 13.4 9.9 31.6 0 44.9z"
                                  p-id="2145"></path>
                            <path d="M512 321.7c-105.7 0-191.6 86-191.6 191.6 0 105.7 86 191.6 191.6 191.6s191.6-86 191.6-191.6c0-105.7-86-191.6-191.6-191.6z m0 319.2c-70.3 0-127.6-57.2-127.6-127.6S441.7 385.7 512 385.7s127.6 57.2 127.6 127.6S582.3 640.9 512 640.9z"
                                  p-id="2146"></path>
                        </svg>
                    </td>
                    <td>
                        <!--点赞-->
                        <span class="glyphicon glyphicon-thumbs-up">点赞:</span>
                        <span><?php echo $likes ?></span>
                        <a href="/page/do_like.php?id=<?php echo $id ?>">
                            <svg t='1672297176134' class='icon' viewBox='0 0 1024 1024' version='1.1'
                             xmlns='http://www.w3.org/2000/svg' p-id='3153' width='16' height='16'>
                            <path d='M857.28 344.992h-264.832c12.576-44.256 18.944-83.584 18.944-118.208 0-78.56-71.808-153.792-140.544-143.808-60.608 8.8-89.536 59.904-89.536 125.536v59.296c0 76.064-58.208 140.928-132.224 148.064l-117.728-0.192A67.36 67.36 0 0 0 64 483.04V872c0 37.216 30.144 67.36 67.36 67.36h652.192a102.72 102.72 0 0 0 100.928-83.584l73.728-388.96a102.72 102.72 0 0 0-100.928-121.824zM128 872V483.04c0-1.856 1.504-3.36 3.36-3.36H208v395.68H131.36A3.36 3.36 0 0 1 128 872z m767.328-417.088l-73.728 388.96a38.72 38.72 0 0 1-38.048 31.488H272V476.864a213.312 213.312 0 0 0 173.312-209.088V208.512c0-37.568 12.064-58.912 34.72-62.176 27.04-3.936 67.36 38.336 67.36 80.48 0 37.312-9.504 84-28.864 139.712a32 32 0 0 0 30.24 42.496h308.512a38.72 38.72 0 0 1 38.048 45.888z'
                                  p-id='3154'></path>
                        </svg>
                        </a>
                    </td>
                    <td>
                        <!--评论-->
                        <span class="glyphicon glyphicon-thumbs-up">评论:</span>
                        <span>暂未开发</span>
                        <svg t="1672297233552" class="icon" viewBox="0 0 1024 1024" version="1.1"
                             xmlns="http://www.w3.org/2000/svg" p-id="4128" width="16" height="16">
                            <path d="M853.333333 768c35.413333 0 64-20.650667 64-55.978667V170.581333A63.978667 63.978667 0 0 0 853.333333 106.666667H170.666667C135.253333 106.666667 106.666667 135.253333 106.666667 170.581333v541.44C106.666667 747.285333 135.338667 768 170.666667 768h201.173333l110.016 117.44a42.752 42.752 0 0 0 60.586667 0.042667L651.904 768H853.333333z m-219.029333-42.666667h-6.250667l-115.797333 129.962667c-0.106667 0.106667-116.010667-129.962667-116.010667-129.962667H170.666667c-11.776 0-21.333333-1.621333-21.333334-13.312V170.581333A21.205333 21.205333 0 0 1 170.666667 149.333333h682.666666c11.776 0 21.333333 9.536 21.333334 21.248v541.44c0 11.754667-9.472 13.312-21.333334 13.312H634.304zM341.333333 490.666667a42.666667 42.666667 0 1 0 0-85.333334 42.666667 42.666667 0 0 0 0 85.333334z m170.666667 0a42.666667 42.666667 0 1 0 0-85.333334 42.666667 42.666667 0 0 0 0 85.333334z m170.666667 0a42.666667 42.666667 0 1 0 0-85.333334 42.666667 42.666667 0 0 0 0 85.333334z"
                                  fill="#3D3D3D" p-id="4129"></path>
                        </svg>
                    </td>
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
                       style="color: #999999">黔ICP备2021007007号</a></p>
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