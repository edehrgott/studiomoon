<?php
/*
Template Name: systems page
*/

get_header();

$systems_slider_uri = site_url() . '/systems-slider/';
?>

<div id="wrapper1">
<div id="wrapper2">
	<div id="container">
			
          <?php get_template_part( 'nav-black' ) ; // left column navigation ?>

		<div id="page_content" class="black">
			<?php if (have_posts()) : while (have_posts()) : the_post(); 
                    $title_override = get_field('title_override');
                    if (!($title_override)) {
                         the_title('<h1>', '</h1>');
                    }
				the_content(__('Read more'));?>
				<!-- <?php trackback_rdf(); ?> -->
				<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
               <?php endif; 
			   
               $systems_count = 0; // number of clients with systems               
               $wp_query = new WP_Query(array('post_type'=>'studiomoon-clients','posts_per_page' => '-1', 'orderby' => 'rand' )); //get clients
               if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();			   
               
                    // create array of logo image uri's and permalinks
                    if( get_field('systems') ) {
                         if( has_sub_field('systems') ) { // get the first logo thumbnail from each client
							$systems[$systems_count][0] = get_the_ID(); // we need the post id since the clients are randomized
							$systems[$systems_count][1] = get_the_title();
                            $systems_count++;
                         }
                    } 
               
               endwhile; endif; ?>			   
			   
          
               <div id="menucircles">
               <?php $n = 0;
			   if ($systems_count > 8) $systems_count = 8; //max of 8 clients with systems
               for ($i = 0; $i <= 3; $i++) {
                    echo '<div class="circlerow">';                 
                         
                    for ($j = 0; $j <= 3; $j++) {
                         echo '<div id="circle-' .$i . '-' .$j .'" class="menucircle circlebright">';
                         if ( ($i == 0) && ($j == 1 || $j == 3)) {  //first row
                              echo '<div class="circlemenu">';
                              echo '<div class="menucircletext">';
                              echo ($n < $systems_count) ? '<a href="' . $systems_slider_uri . '?systemsid=' . $systems[$n][0] . '">' . $systems[$n][1] . '</a>' : '';
                              echo '</div></div>';
                              $n++;
                         } elseif( ($i == 1) && ($j == 1 || $j == 3)) { //second row
                              echo '<div class="circlemenu">';
                              echo '<div class="menucircletext">';                                   
                              echo ($n < $systems_count) ? '<a href="' . $systems_slider_uri . '?systemsid=' . $systems[$n][0] . '">' . $systems[$n][1] . '</a>' : '';
                              echo '</div></div>';                                   
                              $n++;
                         } elseif( ($i == 2) && ($j == 0 || $j == 2)) {  //third row
                              echo '<div class="circlemenu">';
                              echo '<div class="menucircletext">';                                   
                              echo ($n < $systems_count) ? '<a href="' . $systems_slider_uri . '?systemsid=' . $systems[$n][0] . '">' . $systems[$n][1] . '</a>' : '';
                              echo '</div></div>';                                   
                              $n++;
                         } elseif( ($i == 3) && ($j == 1 || $j == 3)) {  // foruth row
                              echo '<div class="circlemenu">';
                              echo '<div class="menucircletext">';                                   
                              echo ($n < $systems_count) ? '<a href="' . $systems_slider_uri . '?systemsid=' . $systems[$n][0] . '">' . $systems[$n][1] . '</a>' : '';
                              echo '</div></div>';                                   
                              $n++;                              
                         } else {
                              echo '&nbsp;';
                         }
                         echo '</div>';
                    }
                    echo '</div>';
               } ?>
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
        jQuery('#page_content').css({
               'height' : contentheight + 'px'
          }) 
     };
       
     windowresize(); // triggers when document first loads    
     jQuery(window).on("resize", function(){ // when browser resized
          windowresize();
     });
          
     jQuery('#menucircles .menucircle').mouseenter(function(){
          jQuery('#menucircles .menucircle').removeClass('circlebright')
          jQuery('#menucircles .menucircle').addClass('circledim');
          jQuery(this).removeClass('circledim');
		  jQuery(this).addClass('circlebright');
	 });
     
});
</script>

</body>
</html>
