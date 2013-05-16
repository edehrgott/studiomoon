<?php
/*
Template Name: naming page
*/

get_header();

// names categories
$names_category[0][0] = 'corporate_names';
$names_category[0][1] = 'Corporate Names';
$names_category[1][0] = 'product_names';
$names_category[1][1] = 'Product Names';
$names_category[2][0] = 'service_names';
$names_category[2][1] = 'Service Names';
$names_category[3][0] = 'campaign_names';
$names_category[3][1] = 'Campaign Names';
$names_category[4][0] = 'descriptive_taglines';
$names_category[4][1] = 'Descriptive Taglines';
$names_category[5][0] = 'promotional_taglines';
$names_category[5][1] = 'Promotional Taglines';
$names_category[6][0] = 'creative_writing';
$names_category[6][1] = 'Creative Writing';
$names_category[7][0] = 'just_for_fun';
$names_category[7][1] = 'Just For Fun';
$naming_slider_uri = site_url() . '/naming-slider/';
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
               <?php endif; ?>
          
               <div id="menucircles">
               <?php $n = 0;
               for ($i = 0; $i <= 3; $i++) {
                    echo '<div class="circlerow">';                 
                         
                    for ($j = 0; $j <= 3; $j++) {
                         echo '<div id="circle-' .$i . '-' .$j .'" class="menucircle circlebright">';
                         if ( ($i == 0) && ($j == 1 || $j == 3)) {  //first row
                              echo '<div class="circlemenu">';
                              echo '<div class="menucircletext">';
                              echo '<a href="' . $naming_slider_uri . '?namingid=' . $names_category[$n][0] . '">' . $names_category[$n][1] . '</a>';
                              echo '</div></div>';
                              $n++;
                         } elseif( ($i == 1) && ($j == 1 || $j == 3)) { //second row
                              echo '<div class="circlemenu">';
                              echo '<div class="menucircletext">';                                   
                              echo '<a href="' . $naming_slider_uri . '?namingid=' . $names_category[$n][0] . '">' . $names_category[$n][1] . '</a>';
                              echo '</div></div>';                                   
                              $n++;
                         } elseif( ($i == 2) && ($j == 0 || $j == 2)) {  //third row
                              echo '<div class="circlemenu">';
                              echo '<div class="menucircletext">';                                   
                              echo '<a href="' . $naming_slider_uri . '?namingid=' . $names_category[$n][0] . '">' . $names_category[$n][1] . '</a>';
                              echo '</div></div>';                                   
                              $n++;
                         } elseif( ($i == 3) && ($j == 1 || $j == 3)) {  // foruth row
                              echo '<div class="circlemenu">';
                              echo '<div class="menucircletext">';                                   
                              echo '<a href="' . $naming_slider_uri . '?namingid=' . $names_category[$n][0] . '">' . $names_category[$n][1] . '</a>';
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
