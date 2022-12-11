var _wrapper = document.querySelector("#DateTime");

function test() {
    var date = new Date();
    var year = date.getFullYear(); //2022年
    var month = date.getMonth() + 1; //8月,国外0-11
    var day = date.getDate(); //1号
    var week = date.getDay(); //1，星期一
    //调用转换星期的函数
    week = switchWeek(week);
    var hours = date.getHours();
    hours = switchZero(hours);
    var minutes = date.getMinutes();
    minutes = switchZero(minutes);
    var seconds = date.getSeconds();
    seconds = switchZero(seconds);
    _wrapper.innerHTML = `${year}年${month}月${day}日&emsp;${week}&emsp;${hours}:${minutes}:${seconds}`
}

setInterval("test()", 1);

//星期转换
function switchWeek(days) {
    var res;
    if (days == 0) {
        res = "星期日"
    }
    if (days == 1) {
        res = "星期一"
    }
    if (days == 2) {
        res = "星期二"
    }
    if (days == 3) {
        res = "星期三"
    }
    if (days == 4) {
        res = "星期四"
    }
    if (days == 5) {
        res = "星期五"
    }
    if (days == 6) {
        res = "星期六"
    }
    ;
    return res;
}

//拼0转换
function switchZero(time) {
    if (time < 10) {
        time = "0" + time;
    }
    return time;
}

