$(window).on("scroll",function (e){
    //alert("www");
    if ($(this).scrollTop() > 200) {
        $("#sidebar1").css({"position":"fixed","top":"80px","z-index":"100000"});
        $("#menu").css({"position":"fixed","top":"0px","z-index":"100000","width":"100%"});
        $("#content").css({"margin-left":"250px"});
    } else {
        $("#sidebar1").css({"position":"","top":"","z-index":""});
        $("#menu").css({"position":"","top":"","z-index":"","width":""});
        $("#content").css({"margin-left":""});
    }
});