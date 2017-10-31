$(document).ready(function(){
    $('.banner-sec .owl-carousel').owlCarousel({
        loop:true,
        margin:0,
        nav:false,
        items:1,
        autoplay:true,
        animateOut: 'fadeOut', 
        autoWidth:false,
        dots:false,
    });
    
    $('.video-sec .owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:3
            },
            1200:{
                items:4
            }
        }
    });
    
    $( ".video-sec .owl-carousel .owl-prev" ).html('<i class="fa fa-angle-left" aria-hidden="true"></i>'); 
    $( ".video-sec .owl-carousel .owl-next" ).html('<i class="fa fa-angle-right" aria-hidden="true"></i>');
    
     console.log($(this).width());

        $('.equal-height-col').each(function() {
          var maxHeight = 0;
            $('.column', this).each(function() {
                if($(this).height() > maxHeight) {
                 maxHeight = $(this).height();  
                }
            });
          console.log(maxHeight);
          $('.equal-height-col').find('.column').height(maxHeight);
      });
    
    $('.menu-icon').on('click', function(){
        $('.left-sec').addClass('show');
    });
    
    
    
    $('body').on("click", ".right-bottom",function(){
        $(".left-sec").removeClass('show');
    });
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
});







