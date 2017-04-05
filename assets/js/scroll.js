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
            $("#menu").css({"position":"fixed","top":"0px","z-index":"100000","width":"100%"});
        } else {
            $("#menu").css({"position":"","top":"","z-index":"","width":""});
        }
      } else {
        if ($(this).scrollTop() >= 150) {
            $("#menu").css({"position":"fixed","top":"0px","z-index":"100000","width":"100%"});
        } else {
            $("#menu").css({"position":"","top":"","z-index":"","width":""});
        }
      }
    }
});