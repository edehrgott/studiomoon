<?php get_header();
//
// front page template
//

?>

<div id="wrapper1">
<div id="wrapper2">
	    <div id="container">
			
			<?php get_template_part( 'nav-black' ) ; // left column navigation ?>

			<div id="home_content">
                
                <div id="home_left_side">
			   	<img class="moon1" src="/assets/moon1_70px.png" alt="full moon">
			     <img class="moon2" src="/assets/moon2_70px.png" alt="crescent moon">
                </div> <!-- home left side -->
                        
                <div id="home_right_side">
			   	<img class="moon3" src="/assets/moon3_70px.png" alt="half moon">
			     <img class="moon4" src="/assets/moon4_70px.png" alt="new moon">
                </div> <!-- home right side -->
				
            </div> <!-- home content -->
		</div> <!-- container -->
     <?php get_footer(); ?>
	</div> <!-- wrapper2 -->  
</div> <!-- wrapper1 -->

<script type="text/javascript">
jQuery(document).ready(function() {

	    // get window height and feed it to css height
	    function windowresize() {
		if (jQuery(window).height() <= 693) {
			var contentheight = 693;
		} else {
			var contentheight = jQuery(window).height();
		};
        jQuery('#home_left_side').css({
			   'height' : contentheight + 'px'
		  })
		  jQuery('#home_right_side').css({
			   'height' : contentheight + 'px'
		  })   
	    };
		 
	    windowresize(); // triggers when document first loads    
	    jQuery(window).on("resize", function(){ // when browser resized
		  windowresize();
	    });
	    
	    // moon animation
	    function moon1fade() {
			   jQuery('.moon1').animate({
				  'opacity': '0.05'},
				  3000,
				  'linear',
				  moon1restore
			   );
	    }
	    
	    function moon1restore() {
			   jQuery('.moon1').animate({
				  'opacity': '1'},
				  3000,
				  'linear',
				  moon1fade
			   );
	    }
	    
	    function moon2fade() {
			   jQuery('.moon2').animate({
				  'opacity': '0.05'},
				  2500,
				  'linear',
				  moon2restore
			   );
	    }
	    
	    function moon2restore() {
			   jQuery('.moon2').animate({
				  'opacity': '1'},
				  2500,
				  'linear',
				  moon2fade
			   );
	    }

	    function moon3fade() {
			   jQuery('.moon3').animate({
				  'opacity': '0.05'},
				  3500,
				  'linear',
				  moon3restore
			   );
	    }
	    
	    function moon3restore() {
			   jQuery('.moon3').animate({
				  'opacity': '1'},
				  3500,
				  'linear',
				  moon3fade
			   );
	    }

	    function moon4fade() {
			   jQuery('.moon4').animate({
				  'opacity': '0.05'},
				  4000,
				  'linear',
				  moon4restore
			   );
	    }
	    
	    function moon4restore() {
			   jQuery('.moon4').animate({
				  'opacity': '1'},
				  4000,
				  'linear',
				  moon4fade
			   );
	    }
	    
        moon1fade();
	    moon2fade();
	    moon3fade();
	    moon4fade();
});
</script>

</body>
</html>
