<?php
/*
Template Name: black-on-white
*/

get_header(); ?>

<div id="wrapper1">
<div id="wrapper2">
	    <div id="container">
			
			<?php get_template_part( 'nav-white' ) ; // left column navigation ?>

			   <div id="page_content" class="white">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<?php $title_override = get_post_meta($post->ID, "title-override", true);
				if ($title_override) {
					if ($title_override != 'none') {  // no title if custom field is 'none'
						echo "<h1>$title_override</h1>";
					}
				} else {
					the_title('<h1>', '</h1>');
				} ?>
				<?php the_content(__('Read more'));?>
				<!-- <?php trackback_rdf(); ?> -->
				<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php endif; 
                    
		           comments_template(); // Get wp-comments.php template ?>

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
		  var contentheight = jQuery(window).height();
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