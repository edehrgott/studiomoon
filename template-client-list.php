<?php
/*
Template Name: client list
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
                    }
				the_content(__('Read more'));?>
				<!-- <?php trackback_rdf(); ?> -->
				<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php endif;
				
            // create array of client names for later display
			$i = 0;	
			$wp_query = new WP_Query(array('post_type'=>'studiomoon-clients','posts_per_page' => '-1','orderby' => 'title', 'order' => 'ASC' )); //get clients
			if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
				$client_name[$i] = get_the_title();
				$i++;
				endwhile;
			else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php endif;
            
            if ($i == 64) { //64 clients so sort them for columnar display
               for ($j = 0; $j <= 15; $j++) {
                   for ($k = 0; $k <= 3; $k++) {
                         echo ($j == 0 && $k == 0) ? '<div class="three_col_list"><ul>' : '';
                         echo '<li>' . $client_name[(($k * 16) + $j)] . '</li>';
                   }
               }
               echo '</ul></div>';
            } else { //not 64 clients so scrap sorting and just display
               for ($j = 0; $j <= $i; $j++) {
                   echo ($j == 0) ? '<div class="three_col_list"><ul>' : '';
                   echo '<li>' . $client_name[$j] . '</li>';
               }
               echo '</ul></div>';               
            }
            
		     comments_template(); // Get wp-comments.php template
             
             echo '<div style="clear: both;"></div>';
             
             wp_nav_menu(array('menu_class' => 'sf-vertical-sub' , 'theme_location' => 'sub-menu', 'container_class' => 'sub-white')); ?>
             
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
