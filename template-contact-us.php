<?php
/*
Template Name: contact us
*/

get_header(); ?>

<div id="wrapper1">
<div id="wrapper2">
	    <div id="container">
			
		<?php get_template_part( 'nav-white' ) ; // left column navigation ?>

		<div id="page_content" class="white">
		<div id="contact-us">
			<?php if (have_posts()) : while (have_posts()) : the_post();
				echo '<div id="contact-info">';
				the_content(__('Read more'));?>
				<!-- <?php trackback_rdf(); ?> -->
				<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php endif; 
                    
		       comments_template(); // Get wp-comments.php template ?>
				</div>
                                
		</div>	
          </div> <!-- page content -->
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
			var contentheight = (jQuery(window).height()) - 50;
		};
		jQuery('#left_col.white').css({
				'height' : contentheight + 'px'
          }) 
     };
       
     windowresize(); // triggers when document first loads    
     jQuery(window).on("resize", function(){ // when browser resized
          windowresize();
     });
});
</script>

</body>
</html>