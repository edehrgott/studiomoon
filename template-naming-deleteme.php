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
                    $title_override = get_field('title_override');
                    if (!($title_override)) {
                         the_title('<h1>', '</h1>');
                    } ?>
                    <?php the_content(__('Read more')); ?>
                    <!-- <?php trackback_rdf(); ?> -->
			<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php endif;
               
               $names_count = 0;
               
			$wp_query = new WP_Query(array('post_type'=>'studiomoon-clients','posts_per_page' => '-1','orderby' => 'title', 'order' => 'ASC' )); //get clients
			if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
               
                    // create array of logo image uri's and permalinks
                    if( get_field('names') ) {
                         while( has_sub_field('names') ) { // get the first item from each client 
                              $names[$names_count][0] = get_sub_field('names_image');
                              $names[$names_count][1] = get_sub_field('names_caption');
                              $names[$names_count][2] = get_sub_field('names_description');                         
                              $names_count++;
                         }
                    } 
               
               endwhile; endif; ?>

               <div id="slider">
               <div id="slider-image" class="imageslider">
                    <ul class="slides">
                    <?php $i = 0;
                    while( $i < $names_count) {
                         echo '<li><img src="' . $names[$i][0] . '"></li>';
                         $i++;
                    } ?>
                    </ul>
               </div>
               <div id="slider-caption" class="captionslider">
                    <ul class="slides">
                    <?php $j = 0;
                    while( $j < $names_count) {
                         echo '<li>';
                         echo '<p class="flex-caption">' . $names[$j][1] . '</p>';
                         echo '<p class="flex-description">' . $names[$j][2] . '</p>';
                         echo '</li>';
                         $j++;
                    } ?>
                    </ul>
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
			var contentheight = (jQuery(window).height()) - 55;
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
