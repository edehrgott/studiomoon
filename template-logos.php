<?php
/*
Template Name: logos
*/

get_header(); ?>

<div id="wrapper1">
<div id="wrapper2">
	<div id="container">
			
          <?php get_template_part( 'nav-white' ) ; // left column navigation ?>

		<div id="page_content" class="white">
			<?php if (have_posts()) : while (have_posts()) : the_post();
                    $title_override = get_post_meta($post->ID, "title-override", true);
                    if (!($title_override)) {
                         the_title('<h1>', '</h1>');
                    } ?>
                    <?php the_content(__('Read more')); ?>
                    <!-- <?php trackback_rdf(); ?> -->
			<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php endif;
               
               $logos_count = 0;
               
			$wp_query = new WP_Query(array('post_type'=>'studiomoon-clients','posts_per_page' => '-1')); //get clients
			if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
               
                    // create array of logo image uri's and permalinks
                    if( get_field('logos') ) {
                         while( has_sub_field('logos') ) { // get the first item from each client 
                              $logos[$logos_count][0] = get_sub_field('logos_image');
                              $logos[$logos_count][1] = get_sub_field('logos_caption');
                              $logos[$logos_count][2] = get_sub_field('logos_description');                         
                              $logos_count++;
                         }
                    } 
               
               endwhile; endif; ?>

               <div id="slider-image" class="logoslider">
                    <ul class="slides">
                    <?php $i = 0;
                    while( $i < $logos_count) {
                         echo '<li><img src="' . $logos[$i][0] . '"></li>';
                         $i++;
                    } ?>
                    </ul>
               </div>
               <div id="slider-caption" class="captionslider">
                    <ul class="slides">
                    <?php $j = 0;
                    while( $j < $logos_count) {
                         echo '<li>';
                         echo '<p class="flex-caption">' . $logos[$j][1] . '</p>';
                         echo '<p class="flex-description">' . $logos[$j][2] . '</p>';
                         echo '</li>';
                         $j++;
                    } ?>
                    </ul>
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

// pass to flexslider
jQuery(window).load(function() {
	// get logo position variable passed in url
	function getUrlVars() {
		var vars = {};
		var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
			vars[key] = value;
			});
		return vars;
	}
	
	var get_pos = ~~Number(getUrlVars()["position"]); // convert whatever is here into a whole number
	
	if( typeof get_pos != 'number' ) {
		get_pos = 0; // if err default to first slide
	}
	
	if (get_pos < 0 || get_pos > 63) {
		get_pos = 0; // must be between 0 and 63
	}
	
     jQuery('.logoslider').flexslider({
		startAt: get_pos,
		animation: 'fade',
          sync: '.captionslider',
          slideshow: false,		
     });
	
});
	
</script>

</body>
</html>
