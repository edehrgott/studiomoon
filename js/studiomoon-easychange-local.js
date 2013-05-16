/*
 * This file can be used to change any of the color elements. Anything entered
 * here will overrride built-in colors. Change the color codes only  - NOTHING
 * ELSE! - and don't forget the #!
 *
 * The background of the left column is defined by the file images/l_col_bg.png.
 * You'll need to edit this png file with the proper color. The .png file is used
 * to allow the left column to extend past the main column text.
 */

jQuery('ul.sf-menu').superfish();

jQuery(function(){
	jQuery('#masthead').css('background', '#005CAB'); // page header background color
	jQuery('p').css('color', '#717073'); // main column text color
	jQuery('#page_content h1').css('color', '#717073'); // h1 header text color
	jQuery('#page_content h2').css('color', '#717073'); // h2 header text color
	jQuery('#page_content h3').css('color', '#717073'); // h3 header text color
	jQuery('#page_content h4').css('color', '#717073'); // h4 header text color
	jQuery('#page_content a').css('color', '#78A22F'); // Unselected links
	jQuery('#page_content a').hover(function () {
		jQuery(this).css('color', '#005CAB'); // Selected links
	}, function () {
		jQuery(this).css('color', '#78A22F'); //Unselected link color again
	});	
	jQuery('#h_menu').css('background', '#717073'); // Main nav bar background color
	jQuery('.sf-menu a').css('color', '#A8D059'); // Unselected text in main nav
	jQuery('.sf-menu a').hover(function () {
		jQuery(this).css('color', '#ffffff'); // Selected links
	}, function () {
		jQuery(this).css('color : #A8D059', 'background : #717073'); //Unselected link color again
	});		
	

	
	jQuery('.sf-menu,.current-menu-item a,.sf-menu li:hover, \
		 .sf-menu li.sfHover,.sf-menu a:focus, .sf-menu a:hover, \
		 .sf-menu a:active,.current-page-ancestor a').css('color', '#A8D059 '); // Selected text main nav
	jQuery('.sf-menu,.current-menu-item a,.sf-menu li:hover, \
		 .sf-menu li.sfHover,.sf-menu a:focus, .sf-menu a:hover, \
		 .sf-menu a:active,.current-page-ancestor a, .sf-menu li, \
		 .sf-menu li li,.sf-menu li li li').css('background', '#717073 '); // Selected text main background






/*
Background of left column             Hex# 78A22F
Unselected text in left column         Hex# 5E5E60
Selected text in left column            White
                                                             

*/
	
	/*
	 * DON'T CHANGE ANYTHING BELOW THIS LINE!!!!!
	 */

	jQuery('ul.sub-menu').removeClass('sub-menu').addClass('l_sub_menu'); // move secondary menu to left column
});
