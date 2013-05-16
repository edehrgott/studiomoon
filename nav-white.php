<div id="left_col" class="white">
    
     <?php if ($pagename == 'identity-is-everything' | is_front_page()) { // add padding class for inentity page ?>
          <a href="<?php echo site_url(); ?>"><img src="/assets/STU-1-signature-blk-text.png" alt="StudioMoon"></a>
     <?php } else { ?>
          <a href="<?php echo site_url(); ?>"><img src="/assets/STU-1-signature-wht.png" alt="StudioMoon"></a>
     <?php }
	// the primary WP 3 menu is vertical at the top of the left sidebar
	wp_nav_menu(array('menu_class' => 'sf-vertical' , 'theme_location' => 'primary'));
	?>
    
</div> <!--left_col-->