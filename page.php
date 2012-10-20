<?php
$access_restricted_to = get_post_meta($post->ID, "access-restricted-to", true);
$current_user = wp_get_current_user();

get_header(); ?>

<div id="wrapper1">
<div id="wrapper2">
	<div id="container">
	    
	<?php if ( !($access_restricted_to) || (( current_user_can( 'administrator' )) || ( $current_user->user_login == $access_restricted_to))) { //access restriction is set and user is admin or auth user
		
		get_sidebar();
		
		get_template_part( 'nav' ) ; // left column navigation ?>		

		<div id="page_content">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<?php $title_override = get_post_meta($post->ID, "title-override", true);
				if ($title_override) {
					if ($title_override != 'none') {  // no title if custom field is 'none'
						echo "<h1>$title_override</h1>";
					}
				} else {
					the_title('<h1>', '</h1>');
				} ?>
				<?php the_content(__('Read more'));?>
				<!-- <?php trackback_rdf(); ?> -->
				<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php endif; 
								
	} else { ?>
							 
		<div id="page_content">
			<p>We're sorry; you are not authorized to view this page.<br />
			Please contact xxx@studiomoon.com if you need help.</p>
		</div>
	<?php } ?>

        </div> <!-- page content -->
		</div> <!-- container -->
    <?php get_footer(); ?>
	</div> <!-- wrapper2 -->  
</div> <!-- wrapper1 -->

</body>
</html>