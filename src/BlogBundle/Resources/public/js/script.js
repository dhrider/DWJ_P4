$(document).ready(function () {
    var value = false;
    setInterval(function(){
        value = !value;
        $(".signaled").css('opacity', Number(value))
    }, 500)
});
