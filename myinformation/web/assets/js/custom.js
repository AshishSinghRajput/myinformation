(function ($, window, document) {



    /* ------------------------------------------------------------------------ 
       SMALL HEADER 
    ------------------------------------------------------------------------ */ 
    jQuery(window).scroll(function() {    
        var scroll = jQuery(window).scrollTop();	
        if (scroll >= 250) {
            jQuery("body.fixed-header").addClass("smallHeader");
            if (scroll >= 350) {
                jQuery("body.fixed-header").addClass("active");
            }
        }
        else {
            jQuery("body.fixed-header").removeClass("smallHeader active");
        }
    });

    

/* ------------------------------------------------------------------------ 
       Smooth Scroll
------------------------------------------------------------------------ */	
$(function(){

var $window = $(window);		//Window object

var scrollTime = 0.6;			//Scroll time
var scrollDistance = 355;		//Distance. Use smaller value for shorter scroll and greater value for longer scroll

$window.on("mousewheel DOMMouseScroll", function(event){

event.preventDefault();	

var delta = event.originalEvent.wheelDelta/125 || -event.originalEvent.detail/3;
var scrollTop = $window.scrollTop();
var finalScroll = scrollTop - parseInt(delta*scrollDistance);

TweenMax.to($window, scrollTime, {
scrollTo : { y: finalScroll, autoKill:true },
ease: Power1.easeOut,	
autoKill: true,
overwrite: 5							
});

});

});
    
    
    
    /* ------------------------------------------------------------------------ 
       ITEM COUNTER
    ------------------------------------------------------------------------ */
    var itemcount= 0;

    $('.pluss-item').on("click", function() { 
        itemcount++;
        $(this).parent().find('.total-items').val(itemcount);
    });

    $('.less-item').on("click", function() { 
        itemcount--;
        $(this).parent().find('.total-items').val(itemcount);
    });
    
    

    
    
    /* ------------------------------------------------------------------------ 
       ADD REVIEW CUSTOM SCRIPT [open/close]
    ------------------------------------------------------------------------ */
    jQuery("#add-review-btn").click(function(){
        jQuery("#add-review-form").slideDown();
    });
    jQuery("#review-form-close").click(function(){
        jQuery("#add-review-form").slideUp();
    });
    
    
    
        /* ------------------------------------------------------------------------ 
           MOBILE MENU
        ------------------------------------------------------------------------ */
        jQuery(".main-nav li a").on("click", function() { 
            jQuery(this).parent("li").find(".dropdown-menu").slideToggle();
            jQuery(this).find("i").toggleClass("fa-caret-down fa-caret-up");
        });
        jQuery("#review-form-close").on("click", function() { 
            jQuery("#add-review-form").slideUp();
        });

    
    /* ------------------------------------------------------------------------ 
       SMOOTH SCROLLING
    ------------------------------------------------------------------------ */ 
    jQuery('.scroll').each( function() {
    var $this = jQuery(this), 
        target = this.hash;
        jQuery(this).click(function (e) { 
            e.preventDefault();
            if( $this.length > 0 ) {
                if($this.attr('href') == '#' ) {  
                } else {
                   jQuery('html, body').animate({ 
                        scrollTop: (jQuery(target).offset().top) - -1
                    }, 1000);
                }  
            }
        });
    });
    
    
    
    
    
    
});

$(document).ready(function(){
    $(function() {
      var selectedClass = "";
      $(".fil-cat").click(function(){ 
      selectedClass = $(this).attr("data-rel"); 
       $("#portfolio").fadeTo(100, 0.1);
      $("#portfolio div").not("."+selectedClass).fadeOut().removeClass('scale-anm');
      setTimeout(function() {
        $("."+selectedClass).fadeIn().addClass('scale-anm');
        $("#portfolio").fadeTo(300, 1);
      }, 300); 
      
    });
});
});

$(document).ready(function(){
    $(function() {
      var selectedClass = "";
      $(".fil-cat1").click(function(){ 
      selectedClass = $(this).attr("data-rel"); 
       $("#portfolio1").fadeTo(100, 0.1);
      $("#portfolio1 div").not("."+selectedClass).fadeOut().removeClass('scale-anm');
      setTimeout(function() {
        $("."+selectedClass).fadeIn().addClass('scale-anm');
        $("#portfolio1").fadeTo(300, 1);
      }, 300); 
      
    });
});
});

