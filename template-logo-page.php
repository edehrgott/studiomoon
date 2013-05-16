<?php
/*
Template Name: logo page
*/

get_header();

$logo_slider_uri = site_url() . '/logos-slider/'; ?>

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
               
               $logo_count = 0; // number of rows of client logos               
               $wp_query = new WP_Query(array('post_type'=>'studiomoon-clients','posts_per_page' => '64', 'orderby' => 'rand' )); //get clients
               if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();			   
               
                    // create array of logo image uri's and permalinks
                    if( get_field('logos') ) {
                         if( has_sub_field('logos') ) { // get the first logo thumbnail from each client 
                              $logos[$logo_count][0] = get_sub_field('logo_thumbnail');
                              $logos[$logo_count][1] = get_the_ID(); // we need the post id since the logos are randomized
                              $logo_count++;
                         }

                    } 
               
               endwhile; endif; ?>
                              
               <div id="logocircles">
               <?php for ($i = 0; $i <= 7; $i++) {
                    echo '<div class="logocirclerow">';
				for ($j = 0; $j <= 7; $j++) {
                         echo '<div id="logocircle-' .$i . '-' .$j .'" class="logocircle circlebright">';
                         $position = (($i * 8) + $j);
                         echo (($position < $logo_count) ? '<a href="' . $logo_slider_uri . '?clientid=' . $logos[$position][1] . '"><img src="' . $logos[$position][0] . '"></a>' : ''); 
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
     
     jQuery('#logocircles .logocircle').mouseenter(function(){
          jQuery('#logocircles .logocircle').removeClass('circlebright')
          jQuery('#logocircles .logocircle').addClass('circledim');
          jQuery(this).removeClass('circledim');
		  jQuery(this).addClass('circlebright');
	 //}).mouseleave(function(){
     //     jQuery('#logocircles .logocircle').addClass('circlebright');
     //     jQuery('#logocircles .logocircle').removeClass('circledim');
	 });     
     
});
</script>

</body>
</html>
