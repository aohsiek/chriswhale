<?php
defined('JPATH_BASE') or die();


gantry_import('core.gantryfeature');


/**
 * @package     gantry
 * @subpackage  features
 */
class GantryFeatureSfMenu extends GantryFeature 
{
    var $_feature_name = 'sfmenu';
    var $_feature_prefix = 'respmenu';
    var $_menu_selector = 'respmenu-type';

    function isEnabled(){
        global $gantry;
        $menu_enabled = $gantry->get('respmenu-enabled');
        $selected_menu = $gantry->get($this->_menu_selector);

        if ($menu_enabled == true){
			return true;
		} else {
			return false;
		}
    }

    function isOrderable(){
        return false;
    }

    function render($position = ""){
        global $gantry;

        $renderer = $gantry->document->loadRenderer('module');
        $options = array('style' => "raw");
        $module = JModuleHelper::getModule('mod_superfish_menu','_z_empty');

        $params = $gantry->getParams($this->_feature_prefix . "-" . $this->_feature_name, true);
		
        $reg = new JRegistry();
			foreach ($params as $param_name => $param_value){
					$reg->set($param_name, $param_value['value']);
			}
        $module->params = $reg->toString();
		
        $rendered_menu = $renderer->render($module, $options);
		
        return $rendered_menu;
    }
}