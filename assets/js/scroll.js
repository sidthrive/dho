$(window).on("scroll",function (e){
    if (matchMedia) {
      var mq = window.matchMedia("(min-width: 1025px)");
      mq.addListener(WidthChange);
      WidthChange(mq);
    }

    // media query change
    function WidthChange(mq) {
      if (mq.matches) {
        if ($(this).scrollTop() >= 265) {
            $("#sidebar1").css({"position":"fixed","top":"80px","z-index":"10000"});
            $("#menu").css({"position":"fixed","top":"0px","z-index":"100000","width":"100%"});
            $("#content").css({"margin-left":"300px"});
        } else {
            $("#sidebar1").css({"position":"","top":"","z-index":""});
            $("#menu").css({"position":"","top":"","z-index":"","width":""});
            $("#content").css({"margin-left":""});
        }
      } else {
        if ($(this).scrollTop() >= 150) {
            $("#sidebar1").css({"position":"fixed","top":"100px","z-index":"10000"});
            $("#menu").css({"position":"fixed","top":"0px","z-index":"100000","width":"100%"});
        } else {
            $("#sidebar1").css({"position":"","top":"","z-index":""});
            $("#menu").css({"position":"","top":"","z-index":"","width":""});
        }
      }
    }
});