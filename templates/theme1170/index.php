<?php
/**
* @package Gantry Template Framework - RocketTheme
* @version 3.2.8 August 1, 2011
* @author RocketTheme http://www.rockettheme.com
* @copyright Copyright (C) 2007 - 2011 RocketTheme, LLC
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*
* Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
*
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );

//Strip shortcodes from title
$title = $this->getTitle();
$title = preg_replace('/(?:[\[]|[\[][\/])[a-zA-Z0-9_\s]+[\]]/', '', $title);
$this->setTitle($title);

// load and inititialize gantry class

require_once('lib/gantry/gantry.php');

$class="";
$menu = JSite::getMenu();
if ($menu->getActive() == $menu->getDefault()) {
	$class="homepage";
}

global $gpath;
$gpath = $this->baseurl."/templates/".$this->template;

$menus = &JSite::getMenu();
$menu_array = $menus->getActive();

$pageID   = "";

if (is_object( $menu_array )) :
	$params = new JParameter( $menu_array->params );
	$cleanPID = $pageID = $params->get( 'pageclass_sfx' );
endif;

if ($pageID != "") {
	$pageID = "id=\"".$pageID."\"";
} else {
	$pageID = "id=\"all\"";
}

	$view = JRequest::getVar('view'); /*Current page view. K2 related pages*/
	$option = $_GET['option']; /*Current page view. Joomla related pages*/
		$task = '';
		$task =& $_GET['task'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $gantry->language; ?>" lang="<?php echo $gantry->language;?>" >
    <head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
	
        <?php
            $gantry->displayHead();
            $gantry->addStyles(array(
				'skeleton'.GRID_SYSTEM.'.css',
				'default.css',
				'normalize.css',
				'template.css',
				'responsive.css',
				'sfmenu.css',
				'touch.gallery.css',
				'http://fonts.googleapis.com/css?family=Oswald'
			));
			
			$gantry->addScript(array(
				'tooltips.js',
				'jquery.preloader.js',
				'touch.gallery.js',
				'scripts.js'
			));
		?>

		<script type="text/javascript">
			jQuery(document).ready(function($) {
				/*Image Preloader*/
				$("span.catItemImage, span.itemImage, span.userItemImage, span.genericItemImage").preloader({
					iconURL:"<?php echo $gpath.'/images/system/loading.gif' ;?>"
				});
			});
		</script>
    </head>
	
    <body <?php echo $gantry->displayBodyTag();  echo ' '. $pageID; ?>>
	
		<div id="body-wrapper">
		
			<div id="rt-iewarn">
				<div class="rt-container">
					<?php echo $gantry->displayModules('iewarn','standard','standard'); ?>
					<div class="clear"></div>
				</div>
			</div>
	
		<div id="wrapper" class="<?php echo ' '. $class .' view-'. $view .' option-'. $option .' task-'. $task; ?>">
			<?php /** Begin Drawer **/ if ($gantry->countModules('drawer')) : ?>
			<div id="rt-drawer">
				<div class="rt-container">
					<?php echo $gantry->displayModules('drawer','standard','standard'); ?>
					<div class="clear"></div>
				</div>
			</div>
			<?php /** End Drawer **/ endif; ?>
			<?php /** Begin Top **/ if ($gantry->countModules('top')) : ?>
			<div id="rt-top" <?php echo $gantry->displayClassesByTag('rt-top'); ?>>
				<div class="rt-container">
					<?php echo $gantry->displayModules('top','standard','standard'); ?>
					<div class="clear"></div>
				</div>
			</div>
			<?php /** End Top **/ endif; ?>
			<?php /** Begin Header **/ if ($gantry->countModules('header')) : ?>
			<div id="rt-header">
				<div class="rt-container">
					<div id="mobileMenu"></div>
					<?php echo $gantry->displayModules('header','standard','standard'); ?>
					<div class="clear"></div>
				</div>
			</div>
			<?php /** End Header **/ endif; ?>
			<?php /** Begin Feature **/ if ($gantry->countModules('feature') && ($option !== 'com_search')) : ?>
			<div id="rt-feature">
				<div class="rt-container">
					<?php echo $gantry->displayModules('feature','standard','standard'); ?>
					<div class="clear"></div>
				</div>
			</div>
			<?php /** End Feature **/ endif; ?>
			<?php /** Begin Menu **/ if ($gantry->countModules('navigation') && ($option !== 'com_search') && ($view !== 'item')) : ?>
			<div id="rt-menu">
				<div class="rt-container">
					<?php echo $gantry->displayModules('navigation','standard','standard'); ?>
					<div class="clear"></div>
				</div>
			</div>
			<?php /** End Menu **/ endif; ?>
			<?php /** Begin Showcase **/ if ($gantry->countModules('showcase') && ($option !== 'com_search') && ($view !== 'item')) : ?>
			<div id="rt-showcase">
				<div class="rt-container <?php echo $class; ?>">
					<?php echo $gantry->displayModules('showcase','standard','standard'); ?>
					<div class="clear"></div>
				</div>
			</div>
			<?php /** End Showcase **/ endif; ?>
			<?php /** Begin Utility **/ if ($gantry->countModules('utility')) : ?>
			<div id="rt-utility">
				<div class="rt-container">
					<?php echo $gantry->displayModules('utility','standard','basic'); ?>
					<div class="clear"></div>
				</div>
			</div>
			<?php /** End Utility **/ endif; ?>
			<?php /** Begin Breadcrumbs **/ if ($gantry->countModules('breadcrumb')) : ?>
			<div id="rt-breadcrumbs">
				<div class="rt-container">
					<?php echo $gantry->displayModules('breadcrumb','standard','standard'); ?>
					<div class="clear"></div>
				</div>
			</div>
			<?php /** End Breadcrumbs **/ endif; ?>
			<div class="main_container">
			<?php /** Begin Main Top **/ if ($gantry->countModules('maintop') && ($option !== 'com_search') && ($view !== 'item')) : ?>
			<div id="rt-maintop">
				<div class="rt-container">
					<?php echo $gantry->displayModules('maintop','standard','standard'); ?>
					<div class="clear"></div>
				</div>
			</div>
			<?php /** End Main Top **/ endif; ?>
			<?php /** Begin Main Body **/ ?>
			<?php echo $gantry->displayMainbody('mainbody','sidebar','standard','standard','standard','standard','standard'); ?>
			<?php /** End Main Body **/ ?>
			<?php /** Begin Main Bottom **/ if ($gantry->countModules('mainbottom') && ($option !== 'com_search') && ($view !== 'item')) : ?>
			<div id="rt-mainbottom">
				<div class="rt-container">
					<?php echo $gantry->displayModules('mainbottom','standard','standard') ; ?>
					<div class="clear"></div>
				</div>
			</div>
			<?php /** End Main Bottom **/ endif; ?>
            </div>
			<?php /** Begin Bottom **/ if ($gantry->countModules('bottom')) : ?>
			<div id="rt-bottom">
				<div class="rt-container">
					<?php echo $gantry->displayModules('bottom','standard','standard'); ?>
					<div class="clear"></div>
				</div>
			</div>
			<?php /** End Bottom **/ endif; ?>
			<div class="footer-container">
			
				<?php /** Begin Footer **/ if ($gantry->countModules('footer')) : ?>
				<div id="rt-footer">
					<div class="rt-container">
						<?php echo $gantry->displayModules('footer','standard','standard'); ?>
						 <?php if ($class=="homepage" )  { ?>
							 More <a  rel='nofollow' href='http://www.templatemonster.com/category/fishing-joomla-templates/' target='_blank'>Fishing Joomla Templates at TemplateMonster.com</a>
						 <?php } ?>
						<div class="clear"></div>
					</div>
				</div>
				<?php /** End Footer **/ endif; ?>
			
				<?php /** Begin Copyright **/ if ($gantry->countModules('copyright')) : ?>
				<div id="rt-copyright">
					<div class="rt-container">
						<?php echo $gantry->displayModules('copyright','standard','standard'); ?>
						<div class="clear"></div>
					</div>
				</div>
				<?php /** End Copyright **/ endif; ?>
				<?php /** Begin Debug **/ if ($gantry->countModules('debug')) : ?>
				<div id="rt-debug">
					<div class="rt-container">
						<?php echo $gantry->displayModules('debug','standard','standard'); ?>
						<div class="clear"></div>
					</div>
				</div>
				<?php /** End Debug **/ endif; ?>
				<?php /** Begin Analytics **/ if ($gantry->countModules('analytics')) : ?>
				<?php echo $gantry->displayModules('analytics','basic','basic'); ?>
				<?php /** End Analytics **/ endif; ?>
				<?php /** Begin Popup **/ 
				echo $gantry->displayModules('popup','popup','standard'); 
				/** End Popup **/ ?>
			</div>
		</div>
		</div>
	</body>
</html>
<?php
$gantry->finalize();
?>