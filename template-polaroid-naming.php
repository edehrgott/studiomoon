<?php
/*
Template Name: polaroid naming
*/

get_header(); ?>

<?php
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

$names_cat[0] = 'corporate_names';
$names_cat[1] = 'product_names';
$names_cat[2] = 'service_names';
$names_cat[3] = 'campaign_names';
$names_cat[4] = 'descriptive_taglines';
$names_cat[5] = 'promotional_taglines';
$names_cat[6] = 'creative_writing';
$names_cat[7] = 'just_for_fun';

$naming_slider_uri = site_url() . '/naming-slider/';

// get passing name category id, if not found default to null
if ($_GET['namingid']) {
     $nameid = $_GET['namingid'];
} else {
     $nameid = null;
}

//no spaces allowed - don't get fucked up with actual category titles
if (!is_null($nameid)) {
     $space = strrpos($nameid, ' ');
     if ($space !== false) $nameid = null;
}

// must be one of the defined values, otherwise make it null
if (!is_null($nameid)) {
     if (!in_array($nameid, $names_cat)) $nameid = null;
}

$startat = 0; // if startat is never set, keep it at 0

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
               
            $names_count = 0;
               
			$wp_query = new WP_Query(array('post_type'=>'studiomoon-clients','posts_per_page' => '-1', orderby => 'rand' )); //get clients
			if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
               
                    // create array of names
                    if( get_field('names') ) {
                         while( has_sub_field('names') ) { // get the items from each client 
                              $names[$names_count][0] = get_sub_field('names_image');
                              $names[$names_count][1] = get_the_title();
                              $names[$names_count][2] = get_sub_field('names_description');
                              $names[$names_count][3] = get_sub_field('names_caption');
                              $names[$names_count][4] = get_sub_field('names_menu_category');
                              $names_sort[$names_count] = get_sub_field('names_menu_category'); //populate sort key array
                              $names_count++;
                         }
                    }
               
               endwhile; endif;
               
               array_multisort( $names_sort, SORT_ASC, $names ); // sort the names array by category
               
               $startatset = false;
               
               // get the selected category after sorting     
               for($x=0; $x<$names_count;$x++) {     
                    if ((!$startatset) && ($names[$x][4] == $nameid)) {
                         $startat = $x;
                         $startatset = true;
                    }
               }
               
               ?>

               <div id="slider">
               <div id="slider-image" class="polaroidslider">
                    <ul class="slides">
                    <?php $i = 0;
                    while( $i < $names_count) {
                         echo '<li><img src="' . $names[$i][0] . '">'; //image
                         echo '<p class="flex-caption">' . $names[$i][3] . '</p></li>'; //caption
                         $i++;
                    } ?>
                    </ul>
               </div> <!-- slider-image -->
               <div style="clear: both;"></div>
               </div> <!-- slider -->
               
               <div id="slider-title" class="polaroidtitleslider">
                    <ul class="slides">
                    <?php $j = 0;
                    while( $j < $names_count) {
                         echo '<li>';
                         echo '<div class="flex-title">' . $names[$j][1] . '</div>'; //client name
                         echo '<p class="flex-description">' . $names[$j][2] . '<br /><br />'; //description

                         // names category menu
                         for ($y=0;$y<=7;$y++) {
                              echo '<a href="' . $naming_slider_uri . '?namingid=' . $names_category[$y][0] . '">' . $names_category[$y][1] . '</a><br />';
                         }
                         echo '</p></li>';
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
