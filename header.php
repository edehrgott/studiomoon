<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<!-- developed by Ed Ehrgott, Tekpals  www.tekpals.com -->
<meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />
<title>
<?php
if (is_front_page()) {
bloginfo('description'); echo ' - '; bloginfo('name');
} else {
	if (function_exists('is_tag') && is_tag()) {
	single_tag_title('Tag Archive for &quot;'); echo '&quot; - ';
	} elseif (is_archive()) {
	wp_title(''); echo ' Archive - ';
	} elseif (is_search()) {
	echo 'Search for &quot;'.esc_html($s).'&quot; - ';
	} elseif ( !(is_404()) && (is_single()) || (is_page())) {
	wp_title(''); echo ' - ';
	} elseif (is_404()) {
	echo 'Not Found - ';
	} 
	bloginfo('name');
}
if ($paged > 1) {
echo ' - page '. $paged;
} ?>
</title>
<?php if(is_search()) { ?>
	<meta name="robots" content="noindex, nofollow" /> 
<?php }?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

$options = get_option('studiomoon_options');
if ( 'blank' == get_header_textcolor() ) { ?>
	  <style type="text/css">
	  #header_text h1 a {display: none;}
	  #header_text .description {display: none;}
	  </style>
<?php } else { ?>  
	  <style type="text/css">
	  #header_text h1 a {color: #<?php echo get_header_textcolor() ?>;}
	  #header_text .description {color: #<?php echo get_header_textcolor() ?>;}
	  </style>
<?php }

// get alternate styling for home page
if( (is_front_page()) ) {  // for home page only
	  if ($options['use_alt_home_style']) { ?>
		    <!-- alternate home page styling -->
		    <style type="text/css">
		    <?php echo $options['alt_home_style_text']; ?>
		    </style>

	  <?php }
} ?>

<!--
/* @license
 * MyFonts Webfont Build ID 2388774, 2012-10-20T17:05:26-0400
 * 
 * The fonts listed in this notice are subject to the End User License
 * Agreement(s) entered into by the website owner. All other parties are 
 * explicitly restricted from using the Licensed Webfonts(s).
 * 
 * You may obtain a valid license at the URLs below.
 * 
 * Webfont: Engravers Gothic BT by Bitstream
 * URL: http://www.myfonts.com/fonts/bitstream/engravers-gothic/engravers-gothic/
 * Copyright: Copyright 1990-2003 Bitstream Inc. All rights reserved.
 * Licensed pageviews: 20,000
 * 
 * 
 * License: http://www.myfonts.com/viewlicense?type=web&buildid=2388774
 * 
 * 2012 Bitstream Inc
*/

-->
<?php wp_enqueue_style( 'studiomoon_myfonts_engraversgothic', get_template_directory_uri() . '/css/MyFontsWebfontsKit.css' );
wp_enqueue_style( 'studiomoon_myfonts_mrseaves', get_template_directory_uri() . '/css/mrs-eaves.css' );

wp_head(); ?>

</head>

<body>

<div id="masthead">
	<?php
	if( (is_front_page()) ) {  // for home and sub page headers
	    include('home_logo.php'); // show home page logo
	} else {
	    include('sub_logo.php');  // show sub page logo
	} ?>
	
</div>
