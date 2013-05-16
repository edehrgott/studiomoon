<?php
/*
Template Name: identity
*/

get_header(); ?>

<div id="wrapper1">
<div id="wrapper2">
	<div id="container">
			
          <?php get_template_part( 'nav-black' ) ; // left column navigation ?>

		<div id="page_content" class="black">
			<?php if (have_posts()) : while (have_posts()) : the_post();
                    $title_override = get_field('title_override');
                    if (!($title_override)) {
                        the_title('<h1 class="identity">', '</h1>');
                    }
				the_content(__('Read more'));?>
				<!-- <?php trackback_rdf(); ?> -->
				<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
               <?php endif; 
                    
		     comments_template(); // Get wp-comments.php template 
			 
			wp_nav_menu(array('menu_class' => 'sf-vertical-sub' , 'theme_location' => 'sub-menu', 'container_class' => 'sub-black')); ?>
				
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
			var contentheight = (jQuery(window).height()) - 55;
		};
		jQuery('#page_content').css({
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
