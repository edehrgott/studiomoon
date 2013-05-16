jQuery(function(){
	jQuery('ul.sf-menu').superfish();
	jQuery('ul.sub-menu').removeClass('sub-menu').addClass('l_sub_menu'); // move secondary menu to left column
});

// flexslider
jQuery(window).load(function() {
     jQuery('.captionslider').flexslider({
          animation: "fade",
          controlNav: false,
          directionNav: false,
          slideshow: false,
          animationSpeed: 1,
     });
          
	jQuery('.imageslider').flexslider({
		animation: 'fade',
          sync: '.captionslider',
          slideshow: false,
	});
    

    
});
