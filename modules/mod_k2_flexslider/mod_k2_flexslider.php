<?php
/**
 * @version		$Id: mod_k2_flexslider.php 1492 2012-02-22 17:40:09Z joomlaworks@gmail.com $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2012 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

if(K2_JVERSION == '16'){
	$language = &JFactory::getLanguage();
	$language->load('mod_k2.j16', JPATH_ADMINISTRATOR, null, true);
}

require_once(dirname(__FILE__).DS.'helper.php');

// Params
$moduleclass_sfx = $params->get('moduleclass_sfx','');
$getTemplate = $params->get('getTemplate','Default');
$itemAuthorAvatarWidthSelect = $params->get('itemAuthorAvatarWidthSelect','custom');
$itemAuthorAvatarWidth = $params->get('itemAuthorAvatarWidth',50);
$itemCustomLinkTitle = $params->get('itemCustomLinkTitle','');
if($params->get('itemCustomLinkMenuItem')) {
	$menu = &JMenu::getInstance('site');
	$menuLink = $menu->getItem($params->get('itemCustomLinkMenuItem'));
	if(!$itemCustomLinkTitle){
		$itemCustomLinkTitle = (K2_JVERSION == '16') ? $menuLink->title : $menuLink->name;
	}
	$params->set('itemCustomLinkURL', JRoute::_($menuLink->link.'&Itemid='.$menuLink->id));
}

// Get component params
$componentParams = & JComponentHelper::getParams('com_k2');

// User avatar
if($itemAuthorAvatarWidthSelect=='inherit'){
	$avatarWidth = $componentParams->get('userImageWidth');
} else {
	$avatarWidth = $itemAuthorAvatarWidth;
}

$items = modK2FlexSliderHelper::getItems($params);

if(count($items)){
	require(JModuleHelper::getLayoutPath('mod_k2_flexslider', $getTemplate.DS.'default'));
}

//Attach styles and scripts

$document =& JFactory::getDocument();
$app = JFactory::getApplication();
$templateDir = JURI::base() . 'templates/' . $app->getTemplate();

switch($params->get("theme")){
	case 'default':
		$document->addStyleSheet('modules/mod_k2_flexslider/css/flexslider.css');
		break;
	case 'custom':
		$document->addStyleSheet($templateDir.'/css/flexslider.css');
		break;};

switch($params->get("script")){
	case 'default':
		$document->addScript('modules/mod_k2_flexslider/js/jquery.flexslider.js');
		break;
	case 'minified':
		$document->addScript('modules/mod_k2_flexslider/js/jquery.flexslider-min.js');
		break;
	case 'custom':
		$document->addScript($templateDir.'/js/jquery.flexslider.js');
		break;}; 

