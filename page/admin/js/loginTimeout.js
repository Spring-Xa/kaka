//长时间无操作，清除session
var time = 0;
setInterval(function () {
    time++;
    if (time === 1800) {
        alert("登录信息已过期！");
        window.location.href = "/page/logout.php";
    }
}, 1000);
