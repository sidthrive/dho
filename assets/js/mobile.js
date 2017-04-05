$(function(){

    $('#slide-submenu').on('click',function() {			        
        $('#sidebar1').toggle('slide',function(){
                $('#mini-submenu').fadeIn();	
                $("#content").css({"width":"100%"});
        });

      });

    $('#mini-submenu').on('click',function(){		
        $('#sidebar1').toggle('slide');
        $('#mini-submenu').hide();
        $("#content").css({"width":"700px"});
        })
})