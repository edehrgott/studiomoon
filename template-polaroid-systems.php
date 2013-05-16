<?php
/*
Template Name: polaroid systems
*/

get_header(); ?>

<?php
$systems_slider_uri = site_url() . '/systems-slider/';

// get passing post id, if not found default to 0
if ($_GET['systemsid']) {
     $postid = $_GET['systemsid'];
} else {
     $postid = 0;
}
if ( !is_numeric($postid)) $postid = 0; // must be numeric, if not just make it 0
$startat = 0; // if startat is never set keep it at 0
$client_count=0;
?>

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
               
            $systems_count = 0;
			$strtatset = false;
               
			$wp_query = new WP_Query(array('post_type'=>'studiomoon-clients','posts_per_page' => '-1', orderby => 'rand' )); //get clients
			if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
               
                    // create array of systems
                    if( get_field('systems') ) {
                         while( has_sub_field('systems') ) { // get the items from each client 
                              $systems[$systems_count][0] = get_sub_field('systems_image');
							  $systems[$systems_count][1] = get_the_title();
                              $systems[$systems_count][2] = get_sub_field('systems_description');
                              $systems[$systems_count][3] = get_sub_field('systems_caption');							  
                              $systems[$systems_count][4] = get_the_ID();
                              if ( (!$startatset) && ( $systems[$systems_count][4] == $postid )) {
								   $startat = $systems_count;
								   $startatset = true;
							  }
							  $systems_count++;
                         }
						 
					// build menu items						 
					$systems_clients[$client_count][0] = get_the_ID();
					$systems_clients[$client_count][1] = get_the_title();					
					$client_count++;
                    }
               
               endwhile; endif;
			                                 
               ?>

               <div id="slider">
               <div id="slider-image" class="polaroidslider">
                    <ul class="slides">
                    <?php $i = 0;
                    while( $i < $systems_count) {
                         echo '<li><img src="' . $systems[$i][0] . '">';
                         echo '<p class="flex-caption">' . $systems[$i][3] . '</p></li>';
                         $i++;
                    } ?>
                    </ul>
               </div> <!-- slider-image -->
               <div style="clear: both;"></div>
               </div> <!-- slider -->
			   
			   <div id="slider-title" class="polaroidtitleslider">
                    <ul class="slides">
                    <?php $j = 0;
                    while( $j < $systems_count) {
                         echo '<li>';
                         echo '<div class="flex-title">' . $systems[$j][1] . '</div>'; // client name
                         echo '<p class="flex-description">' . $systems[$j][2] . '<br /><br />'; // description
						 
						 // systems menu
                         for ($y=0;$y<$client_count;$y++) {
                              echo '<a href="' . $systems_slider_uri . '?systemsid=' . $systems_clients[$y][0] . '">' . $systems_clients[$y][1] . '</a><br />';
                         }						 
                         echo '</p></li>';						 
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
     
     // flexslider logo start pos
     jQuery('.polaroidtitleslider').flexslider({
          animation: "fade",
          controlNav: false,
          directionNav: false,
          slideshow: false,
          animationSpeed: 1,          
          startAt: <?php echo $startat; ?>,
     });     
     
	jQuery('.polaroidslider').flexslider({
          animation: 'fade',
          sync: '.polaroidtitleslider',
          controlNav: false,           
          slideshow: false,     
          startAt: <?php echo $startat; ?>,
	});
             
});
</script>

</body>
</html>
