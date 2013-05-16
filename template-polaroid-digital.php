<?php
/*
Template Name: polaroid-digital
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
               
               $digital_count = 0;
               
			$wp_query = new WP_Query(array('post_type'=>'studiomoon-clients','posts_per_page' => '-1','orderby' => 'rand' )); //get clients
			if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
               
                    // create array of logo image uri's and permalinks
                    if( get_field('digital') ) {
                         while( has_sub_field('digital') ) { // get the first item from each client 
                              $digital[$digital_count][0] = get_sub_field('digital_image');
                              $digital[$digital_count][1] = get_the_title();							  
							  $digital[$digital_count][2] = get_sub_field('digital_description');
                              $digital[$digital_count][3] = get_sub_field('digital_caption');
                              $digital[$digital_count][4] = get_sub_field('digital_link');
                              $digital_count++;
                         }
                    } 
               
               endwhile; endif; ?>
               
               <div id="slider">
               <div id="slider-image" class="polaroidslider">
                    <ul class="slides">
                    <?php $i = 0;
                    while( $i < $digital_count) {
                         echo '<li><img src="' . $digital[$i][0] . '">';
						 // use link for caption if link exists else use caption
                         echo ( is_null($digital[$i][4])) ? '<p class="flex-caption">' . $logos[$i][3] . '</p></li>' : '<p class="flex-caption"><a href="http://' . $digital[$i][4] . '" target="_blank">' . $digital[$i][4] . '</a></p></li>';
                         $i++;
                    } ?>
                    </ul>
               </div>  <!-- slider-image -->
               <div style="clear: both;"></div>
               
               </div> <!-- slider -->
			   
               <div id="slider-title" class="polaroidtitleslider">
                    <ul class="slides">
                    <?php $j = 0;
                    while( $j < $digital_count) {
                         echo '<li>';
                         echo '<div class="flex-title">' . $digital[$j][1] . '</div>';
                         echo '<p class="flex-description">' . $digital[$j][2] . '</p></li>';					 
                         $j++;
                    } ?>
                    </ul>
               </div> <!-- slider-title -->
				
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
     
     // flexslider logo start pos
     jQuery('.polaroidtitleslider').flexslider({
          animation: "fade",
          controlNav: false,
          directionNav: false,
          slideshow: false,
          animationSpeed: 1,          
     });     
     
	jQuery('.polaroidslider').flexslider({
          animation: 'fade',
          sync: '.polaroidtitleslider',
          controlNav: false,           
          slideshow: false,     
	});     
     
});
</script>

</body>
</html>
