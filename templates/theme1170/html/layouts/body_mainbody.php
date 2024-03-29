<?php
/**
 * @package   gantry
 * @subpackage html.layouts
 * @version   3.2.16 February 8, 2012
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2012 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */
defined('GANTRY_VERSION') or die();

gantry_import('core.gantrylayout');

/**
 *
 * @package gantry
 * @subpackage html.layouts
 */
class GantryLayoutBody_MainBody extends GantryLayout {
    var $render_params = array(
        'schema'        =>  null,
        'pushPull'      =>  null,
        'classKey'      =>  null,
        'sidebars'      =>  '',
        'contentTop'    =>  null,
        'contentBottom' =>  null
    );
    function render($params = array()){
        global $gantry;
			$option = $_GET['option'];
			$view = JRequest::getVar('view');
			
			$task = '';
			$task =& $_GET['task'];

        $fparams = $this-> _getParams($params);

        // logic to determine if the component should be displayed
        $display_component = !($gantry->get("component-enabled",true) == false && JRequest::getVar('view') == 'featured');
        ob_start();
// XHTML LAYOUT

		$rtmainWidth = $fparams->schema['mb'];
		$pushPull = $fparams->pushPull[0];
		$classKey = $fparams->classKey;
		if($option == 'com_search'){
			$rtmainWidth = GRID_SYSTEM;
			$pushPull = '';
			$classKey = 'mb12';
		}
		
?>          
			<div id="rt-main" class="<?php echo $classKey; ?>">
                <div class="rt-container">
                    <div class="rt-containerInner">
                    <div class="rt-grid-<?php echo $rtmainWidth; ?> <?php echo $pushPull; ?>">
                        <?php if ((isset($fparams->contentTop)) && ($option !== 'com_search') && ($view !== 'item') && ($task !== 'user')) : ?>
                        <div id="rt-content-top">
                            <?php echo $fparams->contentTop; ?>
                        </div>
                        <?php endif; ?>
                        <?php if ($display_component) : ?>
						<div class="rt-block">
	                        <div id="rt-mainbody">
								<div class="component-content">
	                            	<jdoc:include type="component" />
								</div>
	                        </div>
						</div>
                        <?php endif; ?>
                        <?php if ((isset($fparams->contentBottom)) && ($option !== 'com_search') && ($view !== 'item') && ($task !== 'user')) : ?>
                        <div id="rt-content-bottom">
                            <?php echo $fparams->contentBottom; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php 
   

   if ($option !== 'com_search') :
    echo $fparams->sidebars; ?>
    
   <?php endif; ?>
                    <div class="clear"></div>
                </div>
            </div>
            </div>
<?php
        return ob_get_clean();
    }
}