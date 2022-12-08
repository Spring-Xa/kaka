<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <Link rel="stylesheet" href="/css/login.css">
    <title>卡卡时光机-登录</title>
</head>
<body>
<div class="container">
    <div class="login">
        <div class="login-left">
            <a href="blog.php">
            <img style="margin-top: 30px;margin-bottom:-30px;height: 120px" src="/images/login/logo.png" alt="">
            </a>
            <form id="login-form" action="login-action.php" method="post">
                <table>
                    <tr style="height: 60px">
                        <td><img src="/images/login/user-name.png" alt=""></td>
                        <td>
                            <label for="name"></label>
                            <input type="text" id="name" name="username" required="required"
                                   value="<?php echo isset($_COOKIE[""]) ? $_COOKIE[""] : ""; ?>"
                                   placeholder="请输入用户名">
                        </td>
                    </tr style="height: 60px">
                    <tr>
                        <td><img src="/images/login/user-password.png" alt=""></td>
                        <td>
                            <label for="password"></label>
                            <input type="password" id="password" name="password"
                                   placeholder="请输入密码">
                        </td>
                    </tr>
                    <!--点击输入框时，清除已有内容-->
                    <script>
                        const name = document.getElementById("name");
                        const password = document.getElementById("password");
                        name.onclick = function () {
                            name.value = "";
                        }
                        password.onclick = function () {
                            password.value = "";
                        }
                    </script>
                    <tr style="height: 35px">
                        <td colspan="2">
                            <div class="remember-password">
                                <label for="remember-password"></label>
                                <input type="checkbox" id="remember-password" name="remember">
                                <small>记住密码</small>
                            </div>
<!--                            <div class="forget-password">-->
<!--                                <small><a id="forget-password" href="retrieve-password.php">忘记密码？</a></small>-->
<!--                            </div>-->
                        </td>
                    </tr>
                    <tr style="height: 50px;">
                        <td colspan="2" style="color:red;font-size:10px;">
                            <!--提示信息-->
                            <?php
                            $err = isset($_GET["err"]) ? $_GET["err"] : "";
                            switch ($err) {
                                case 1:
                                    echo "用户名或密码错误！";
                                    break;

                                case 2:
                                    echo "用户名或密码不能为空！";
                                    break;
                            } ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" id="login" name="login" value="登录">
                            <input type="reset" id="reset" name="reset" value="重置">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <a href="register.php" style="text-decoration: none;">无账号？点击注册</a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div style="height: 100px;margin-top: 20px">
                                <p>第三方登录</p>
                                <div class="third-party-login">
                                    <a href="https://weixin.qq.com/" target="_blank">
                                        <img src="/images/login/wx.png" alt="">
                                    </a>
                                </div>
                                <div class="third-party-login">
                                    <a href="https://www.qq.com/" target="_blank">
                                        <img src="/images/login/qq.png" alt="">
                                    </a>
                                </div>
                                <div class="third-party-login">
                                    <a href="https://www.weibo.com/" target="_blank">
                                        <img src="/images/login/wb.png" alt="">
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <!--脚部-->
    <div class="footer"><small>Copyright &copy; 版权所有</small></div>
</div>
</body>
</html>