<?php
/**
 * @package     gantry
 * @subpackage  features
 * @version    ${project.version} ${build_date}
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright   Copyright (C) 2007 - ${copyright_year} RocketTheme, LLC
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */

defined('JPATH_BASE') or die();

gantry_import('core.gantryfeature');


class GantryFeatureUserLogin extends GantryFeature {
    var $_feature_name = 'userlogin';

  function render($position="") {
		global $gantry;
      	ob_start();
	  
      ?>
    <div class="clear"></div>
    <div class="rt-block">
		<div id="rt-login-button">
		
		<!--<span class="account"><?php /*echo JText::_('ACCOUNT_TEXT');*/ ?></span>-->
		
		<?php 
			if(JFactory::getUser()->guest) {?>
				<a href="#" title="Login Form" class="buttontext" rel="rokbox[215 320][module=rt-popup]">
					<span><?php echo $gantry->get('userlogin-logintext'); ?></span>
				</a>
			<?php }	else { ?>
				<!--<a href="index.php?option=com_users&task=user.logout&<?php /*echo JUtility::getToken();*/ ?>=1&return=<?php /*echo base64_encode(JURI::current());*/ ?>">
					<span><?php /*echo $gantry->get('userlogin-logouttext');*/ ?></span>
				</a> -->
				<a href="#" title="Login Form" class="buttontext" rel="rokbox[215 320][module=rt-popup]">
					<span><?php echo $gantry->get('userlogin-logouttext'); ?></span>
				</a>
			<?php }; 	
		?>
		<!--<span class="or"><?php /*echo JText::_('TPL_OR');*/ ?></span>-->
		
		<a href="index.php?option=com_users&view=registration"><?php echo JText::_('TPL_REGISTER'); ?></a>
		</div>
		<div class="clear"></div>
    </div>
	
    <?php
      return ob_get_clean();
  }
}
