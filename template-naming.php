<?php
/*
Template Name: naming
*/

get_header(); ?>

<div id="wrapper1">
<div id="wrapper2">
	    <div id="container">
			
			   <?php get_template_part( 'nav-white' ) ; // left column navigation ?>

			   <div id="page_content" class="white">
			   <?php if (have_posts()) : while (have_posts()) : the_post(); 					  
					  $title_override = get_post_meta($post->ID, "title-override", true);
					  if ($title_override) {
							 if ($title_override != 'none') {  // no title if custom field is 'none'
									echo "<h1>$title_override</h1>";
							 }
					  } else {
							 the_title('<h1>', '</h1>');
					  } ?>
					  <?php the_content(__('Read more')); ?>
					  <!-- <?php trackback_rdf(); ?> -->
			   <?php endwhile; else: ?>
					  <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			   <?php endif;
			   
			   $wp_query = new WP_Query(array('post_type'=>'studiomoon-clients','posts_per_page' => '-1','orderby' => 'title', 'order' => 'ASC' )); //get clients
			   if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();			   
			   
					  // check for rows (parent repeater)
					    if( get_field('names') ): ?>
							 <div id="names" class="flexslider">
							 <ul class="slides">
							 <?php while( has_sub_field('names') ): // loop through rows (parent repeater) ?>
									<li><p class="flex-caption"><?php the_sub_field('names_caption'); ?></p>
									<img src="<?php the_sub_field('names_image'); ?> ">
									<p class="flex-description"><?php the_sub_field('names_description'); ?></p>
									<!--<li><?php the_sub_field('names_menu_category'); ?></li>-->
									</li>
							 <?php endwhile; // while( has_sub_field('names') ): ?>
							 </ul>
							 </div>
					    <?php endif; // if( get_field('names') ): ?>					  
					  
			   <?php endwhile; else: ?>

			   comments_template(); // Get wp-comments.php template ?>
			   
			   <?php endif; ?>

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
