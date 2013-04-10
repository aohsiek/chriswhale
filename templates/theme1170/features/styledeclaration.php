<?php
/**
 * @package     gantry
 * @subpackage  features
 * @version		3.2.16 February 8, 2012
 * @author		RocketTheme http://www.rockettheme.com
 * @copyright 	Copyright (C) 2007 - 2012 RocketTheme, LLC
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */

defined('JPATH_BASE') or die();

gantry_import('core.gantryfeature');

/**
 * @package     gantry
 * @subpackage  features
 */
class GantryFeatureStyleDeclaration extends GantryFeature {
    var $_feature_name = 'styledeclaration';

    function isEnabled() {
        global $gantry;
        $menu_enabled = $this->get('enabled');

        if (1 == (int)$menu_enabled) return true;
        return false;
    }

	function init() {
        global $gantry;

        //inline css for dynamic stuff

		$css = "";
		
	    if($gantry->get('bgcolor') !== ''){$css  = 'body {background:'.$gantry->get('bgcolor').';}';}
			
		//Top row color	
	    if($gantry->get('top_row-row') !== ''){$css .= '#rt-top {background:'.$gantry->get('top_row-row').';}';}
		if($gantry->get('top_row-container') !== ''){$css .= '#rt-top .rt-container {background:'.$gantry->get('top_row-container').';}';}

		//Header row color
	    if($gantry->get('header_row-row') !== ''){$css .= '#rt-header {background:'.$gantry->get('header_row-row').';}';}
	    if($gantry->get('header_row-container') !== ''){$css .= '#rt-header .rt-container {background:'.$gantry->get('header_row-container').';}';}
		
		//Navigation row color
	    if($gantry->get('nav_row-row') !== ''){$css .= '#rt-menu {background:'.$gantry->get('nav_row-row').';}';}
	    if($gantry->get('nav_row-container') !== ''){$css .= '#rt-menu .rt-container {background:'.$gantry->get('nav_row-container').';}';}
		
		//Showcase row color
	    if($gantry->get('showcase_row-row') !== ''){$css .= '#rt-showcase {background:'.$gantry->get('showcase_row-row').';}';}
	    if($gantry->get('showcase_row-container') !== ''){$css .= '#rt-showcase .rt-container {background:'.$gantry->get('showcase_row-container').';}';}
		
		//Feature row color
	    if($gantry->get('feature_row-row') !== ''){$css .= '#rt-feature {background:'.$gantry->get('feature_row-row').';}';}
	    if($gantry->get('feature_row-container') !== ''){$css .= '#rt-feature .rt-container {background:'.$gantry->get('feature_row-container').';}';}
		
		//Utility row color
	    if($gantry->get('utility_row-row') !== ''){$css .= '#rt-utility {background:'.$gantry->get('utility_row-row').';}';}
	    if($gantry->get('utility_row-container') !== ''){$css .= '#rt-utility .rt-container {background:'.$gantry->get('utility_row-container').';}';}
		
		//Maintop row color
	    if($gantry->get('maintop_row-row') !== ''){$css .= '#rt-maintop {background:'.$gantry->get('maintop_row-row').';}';}
	    if($gantry->get('maintop_row-container') !== ''){$css .= '#rt-maintop .rt-container {background:'.$gantry->get('maintop_row-container').';}';}
		
		//Main row color
	    if($gantry->get('main_row-row') !== ''){$css .= '.main_container {background:'.$gantry->get('main_row-row').';}';}
	    if($gantry->get('main_row-container') !== ''){$css .= '#rt-main .rt-container {background:'.$gantry->get('main_row-container').';}';}
		
		//Mainbottom row color
	    if($gantry->get('mainbottom_row-row') !== ''){$css .= '#rt-mainbottom {background:'.$gantry->get('mainbottom_row-row').';}';}
	    if($gantry->get('mainbottom_row-container') !== ''){$css .= '#rt-mainbottom .rt-container {background:'.$gantry->get('mainbottom_row-container').';}';}
		
		//Bottom row color
	    if($gantry->get('bottom_row-row') !== ''){$css .= '#rt-bottom {background:'.$gantry->get('bottom_row-row').';}';}
	    if($gantry->get('bottom_row-container') !== ''){$css .= '#rt-bottom .rt-container {background:'.$gantry->get('bottom_row-container').';}';}
		
		//Footer row color
	    if($gantry->get('footer_row-row') !== ''){$css .= '#rt-footer {background:'.$gantry->get('footer_row-row').';}';}
	    if($gantry->get('footer_row-container') !== ''){$css .= '#rt-footer .rt-container {background:'.$gantry->get('footer_row-container').';}';}
		
		//Copyright row color
	    if($gantry->get('copyright_row-row') !== ''){$css .= '#rt-copyright {background:'.$gantry->get('copyright_row-row').';}';}
	    if($gantry->get('copyright_row-container') !== ''){$css .= '#rt-copyright .rt-container {background:'.$gantry->get('copyright_row-container').';}';}
		
			//Link style
       		if($gantry->get('linkcolor-default') !== ''){$css .= 'body a {color:'.$gantry->get('linkcolor-default').';}';}
       		if($gantry->get('linkcolor-hover') !== ''){$css .= 'body a:hover {color:'.$gantry->get('linkcolor-hover').';}';}
			
			//Readmore style
       		if($gantry->get('more-default') !== '' || $gantry->get('more-bg') !== ''){$css .= 'a.moduleItemReadMore, a.k2ReadMore, a.moduleCustomLink,.commentLink a,div.itemComments .commentToolbar a,.toggle-editor a {color:'.$gantry->get('more-default').'; background:'.$gantry->get('more-bg').';}';}
       		if($gantry->get('more-hover') !== '' || $gantry->get('more-bg_hover') !== ''){$css .= 'a.moduleItemReadMore:hover, a.k2ReadMore:hover, a.moduleCustomLink:hover,.commentLink a:hover,div.itemComments .commentToolbar a:hover,.toggle-editor a:hover {color:'.$gantry->get('more-hover').';background:'.$gantry->get('more-bg_hover').';}';}
			
			//Button style
       		$css .= 'div.itemCommentsForm form input#submitCommentButton, input[type="submit"], button.button {color:'.$gantry->get('button-default').'; background:'.$gantry->get('button-bg').';}';
       		$css .= 'div.itemCommentsForm form input#submitCommentButton:hover, input[type="submit"]:hover, button.button:hover {color:'.$gantry->get('button-hover').';background:'.$gantry->get('button-bg_hover').';}';

			
		//Top menu style
			
		if($gantry->get('top_menu-enabled') == '1'){

			//menu item
       		if($gantry->get('top_menu-topMenuLinkBg') !== ''){$css .='.sf-menu > li{background:'.$gantry->get('top_menu-topMenuLinkBg').';}';}
       		if($gantry->get('top_menu-topMenuLink') !== ''){$css .='.sf-menu > li > a,.sf-menu > li > span{color:'.$gantry->get('top_menu-topMenuLink').'; }';}

       		//active menu item
			if($gantry->get('top_menu-topMenuLink_hoverBg') !== ''){$css .= '.sf-menu > li.sfHover, .sf-menu > li:hover, .sf-menu > li.current,	.sf-menu > li.active{background:'.$gantry->get('top_menu-topMenuLink_hoverBg').';}';}

			if($gantry->get('top_menu-topMenuLink_hover') !== ''){$css .= '.sf-menu > li > a:hover, .sf-menu > li > a:active, .sf-menu > li.sfHover > a, .sf-menu > li.sfHover > span, .sf-menu > li:hover > span, .sf-menu > li.current > a, .sf-menu > li.current > span, .sf-menu > li.active > a, .sf-menu > li.active > span {color:'.$gantry->get('top_menu-topMenuLink_hover').';}';}
					
		};

		//Sub-Menu style
		
		if($gantry->get('top_menu_sub-enabled') == '1'){
       		if($gantry->get('top_menu_sub-topMenu_sublevel') !== ''){$css .= '.sf-menu ul{background:'.$gantry->get('top_menu_sub-topMenu_sublevel').';}';}

       		//menu item
			
       		if($gantry->get('top_menu_sub-topMenuLinkBg') !== ''){$css .= '.sf-menu ul > li {background:'.$gantry->get('top_menu_sub-topMenuLinkBg').';}';}
       		if($gantry->get('top_menu_sub-topMenuLink') !== ''){$css .= ' .sf-menu ul > li > a, .sf-menu ul > li > span {color:'.$gantry->get('top_menu_sub-topMenuLink').';}';}

       		//active menu item

			if($gantry->get('top_menu_sub-topMenuLink_hoverBg') !== ''){$css .= '.sf-menu ul > li:hover, .sf-menu ul > li.current, .sf-menu ul > li.sfHover, .sf-menu ul > li.active {background:'.$gantry->get('top_menu_sub-topMenuLink_hoverBg').';}';}

			if($gantry->get('top_menu_sub-topMenuLink_hover') !== ''){$css .= ' .sf-menu ul > li > a:hover, .sf-menu ul > li:hover > a, .sf-menu ul > li:hover > span, .sf-menu ul > li > a:active, .sf-menu ul > li.current > a, .sf-menu ul > li.current > span, .sf-menu ul > li.sfHover > a, .sf-menu ul > li.sfHover > span, .sf-menu ul > li.active > span, .sf-menu ul > li.active > a 
			{color:'.$gantry->get('top_menu_sub-topMenuLink_hover').';}';}
		};
		
		//Color sets
			
		
		if($gantry->get('colorset_1-color') !== ''){$css .= $gantry->get('colorset_1-text').'{background:'.$gantry->get('colorset_1-color').';}';}
		if($gantry->get('colorset_2-color') !== ''){$css .= $gantry->get('colorset_2-text').'{background:'.$gantry->get('colorset_2-color').';}';}
		if($gantry->get('colorset_3-color') !== ''){$css .= $gantry->get('colorset_3-text').'{background:'.$gantry->get('colorset_3-color').';}';}
		
		//Default font style
		
		if($gantry->get('default_font-enabled') == '1'){
		
		$font = $gantry->get('default_font-font_family');
		switch($font){
		 	case 'arial':
				$font_family = 'Arial, Helvetica, sans-serif'; 	
				break;		
		 	case 'arial_black':
				$font_family = 'Arial Black, Gadget, sans-serif'; 
				break;	
		 	case 'courier':
				$font_family = 'Courier New, monospace'; 	
				break;		
		 	case 'georgia':
				$font_family = 'Georgia, serif'; 
				break;			
		 	case 'impact':
				$font_family = 'Impact, Charcoal, sans-serif'; 
				break;			
		 	case 'lucida_cons':
				$font_family = 'Monaco, monospace';
				break; 			
		 	case 'lucida_sans':
				$font_family = 'Lucida Grande, sans-serif'; 
				break;			
		 	case 'palatino':
				$font_family = 'Palatino Linotype, Book Antiqua, Palatino, serif'; 	
				break;		
		 	case 'tahoma':
				$font_family = 'Tahoma, Geneva, sans-serif'; 
				break;			
		 	case 'times':
				$font_family = 'Times New Roman, Times, serif'; 
				break;			
		 	case 'trebuchet':
				$font_family = 'Trebuchet MS, sans-serif'; 
				break;			
		 	case 'verdana':
				$font_family = 'Verdana, Geneva, sans-serif'; 
				break;			
		 	case 'ms':
				$font_family = 'MS Serif, New York, serif'; 
				break;			
		 	case 'ms_sans':
				$font_family = 'MS Sans Serif, Geneva, sans-serif'; 
				break;			
		};
						
			$css .= 'body {font-family:'.$font_family.'; font-size:'.$gantry->get('default_font-font_size').'; line-height:'.$gantry->get('default_font-line_height').'; color:'.$gantry->get('default_font-color').'; }';
		}
		
		
        $gantry->addInlineStyle($css);

        //style stuff
        $gantry->addStyle($gantry->get('cssstyle').".css");
	}

}