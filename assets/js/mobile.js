$(function(){

    $('#slide-submenu').on('click',function() {			        
        $('#sidebar1').toggle('slide',function(){
                $('#mini-submenu').fadeIn();	
        });

      });

    $('#mini-submenu').on('click',function(){		
        $('#sidebar1').toggle('slide');
        $('#mini-submenu').hide();
        })
})