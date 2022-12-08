<!DOCTYPE html>
<html lang="zh">
<head><title>卡卡时光机-注册</title>
    <meta name="content-type" charset="UTF-8">
    <Link rel="stylesheet" href="/css/register.css">
<!--    <link rel="stylesheet" href="../images/userImg/">-->
</head>
<body>
<div class="container">
    <!--头部-->
    <div class="header">
        <h1>卡卡时光机</h1>
        <p>欢迎注册</p>
    </div>
    <!--注册表单-->
    <div class="middle" style="text-align: center;margin: auto">
        <!--注册表单,可以提交图片-->
        <form id="register-form" action="register-action.php" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>头像：</td>
                    <td>
                        <input type="file" name="file" id="file">
                    </td>
                </tr>
                <tr>
                    <td>用户名：</td>
                    <td>
                        <label for="username"></label>
                        <input type="text" id="username" name="username" required="required">
                    </td>
                </tr>
                <tr>
                    <td>密码：</td>
                    <td>
                        <label for="password"></label>
                        <input type="password" id="password" name="password" required="required">
                    </td>
                </tr>
                <tr>
                    <td>重复密码：</td>
                    <td>
                        <label for="re_password"></label>
                        <input type="password" id="re_password" name="re_password" required="required">
                        <script>
                            const re_password = document.getElementById("re_password");
                            re_password.onblur = function () {
                                if (re_password.value !== password.value) {
                                    alert("两次密码不一致");
                                    re_password.value = "";
                                }
                            }
                        </script>
                    </td>
                </tr>
                <tr>
                    <td>邮箱：</td>
                    <td>
                        <label for="email"></label>
                        <input type="text" id="email" name="email" required="required">
                        <script>
                            const email = document.getElementById("email");
                            email.onblur = function () {
                                const reg = /^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
                                if (!reg.test(email.value)) {
                                    email.placeholder = "邮箱格式不正确";
                                    email.value = "";
                                }
                            }
                        </script>
                    </td>
                </tr>
                <tr>
                    <td>手机号：</td>
                    <td>
                        <label for="phone"></label>
                        <input type="text" id="phone" name="phone" required="required">
                        <script>
                            const phone = document.getElementById("phone");
                            phone.onblur = function () {
                                const reg = /^1[3-9][0-9]{9}$/;
                                if (!reg.test(phone.value)) {
                                    phone.placeholder = "手机号码不正确";
                                    phone.value = "";
                                }
                            }
                        </script>
                    </td>
                </tr>
                <tr>
                    <td>地址：</td>
                    <td>
                        <label for="address"></label>
                        <input type="text" id="address" name="address" required="required">
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>角色：</td>
                    <td>
                        <label for="role"></label>
                        <select name="role" id="role">
                            <option value="1">管理员</option>
                            <option value="2">普通用户</option>
                        </select>

                    </td>
                    <td>性别：</td>
                    <td>
                        <label for="sex"></label>
                        <select name="sex" id="sex">
                            <option value="男">男</option>
                            <option value="女">女</option>
                        </select>
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>
                        <input type="submit" id="register" name="register" value="注册"
                               style="width:125px;height:30px;color: #ffffff;
                               background-color:#cc9900;border-color: #cc9900">
                        <input type="reset" id="reset" name="reset" value="重置"
                               style="width:125px;height:30px;color: #ffffff;
                               background-color:#cc9900;border-color: #cc9900">
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="login.php">已有账号？点击登录</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <!--脚部-->
    <div class="footer"><small>Copyright &copy; 版权所有</small></div>
</div>
</body>
</html>