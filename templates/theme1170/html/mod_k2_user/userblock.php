<?php
/**
 * @version		$Id$
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2011 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

$app = JFactory::getApplication();
$templateDir = JPATH_THEMES.DS.JFactory::getApplication()->getTemplate().DS;
$includesPath = $templateDir."includes/mobile_detect.php";

require_once ($includesPath);


	$detect = new Mobile_Detect();

		$detectTablet = $detect->isTablet();
		$detectMobile = $detect->isMobile();
		$detectIphone = $detect->isiPhone();
		
		$buttonClass="modal";
		$buttonRel = "{handler:'iframe',size:{x:990,y:550}}";

		if(($detectTablet == true) || ($detectMobile == true) || ($detectIphone == true)){
			$buttonRel = "";
			$buttonClass="";
		} 	

?>

<div id="k2ModuleBox<?php echo $module->id; ?>" class="k2UserBlock<?php if($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); ?>">

	<?php if($userGreetingText): ?>
	<p class="ubGreeting"><?php echo $userGreetingText; ?></p>
  <?php endif; ?>

	<div class="k2UserBlockDetails">
	  <?php if($params->get('userAvatar')): ?>
	  <a class="k2Avatar ubAvatar" href="<?php echo JRoute::_(K2HelperRoute::getUserRoute($user->id)); ?>" title="<?php echo JText::_('K2_MY_PAGE'); ?>">
	  	<img src="<?php echo K2HelperUtilities::getAvatar($user->id, $user->email); ?>" alt="<?php echo K2HelperUtilities::cleanHtml($user->name); ?>"/>
	  </a>
	  <?php endif; ?>
	  <span class="ubName"><?php echo $user->name; ?></span>
		<span class="ubCommentsCount"><?php echo JText::_('K2_YOU_HAVE'); ?> <b><?php echo $user->numOfComments; ?></b> <?php if($user->numOfComments==1) echo JText::_('K2_PUBLISHED_COMMENT'); else echo JText::_('K2_PUBLISHED_COMMENTS'); ?></span>
	  <div class="clr"></div>
	</div>

  <ul class="k2UserBlockActions">
		<?php if(is_object($user->profile) && isset($user->profile->addLink)): ?>
		<li>
			<a class="<?php echo $buttonClass; ?>" rel="<?php echo $buttonRel; ?>" href="<?php echo $user->profile->addLink; ?>"><?php echo JText::_('K2_ADD_NEW_ITEM'); ?></a>
		</li>
		<?php endif; ?>
		<li>
			<a href="<?php echo JRoute::_(K2HelperRoute::getUserRoute($user->id)); ?>"><?php echo JText::_('K2_MY_PAGE'); ?></a>
		</li>
		<li>
			<a href="<?php echo JRoute::_((K2_JVERSION=='16') ? 'index.php?option=com_users&view=profile&layout=edit' : 'index.php?option=com_user&view=user&task=edit'); ?>"><?php echo JText::_('K2_MY_ACCOUNT'); ?></a>
		</li>
		<li>
			<a class="<?php echo $buttonClass; ?>" rel="<?php echo $buttonRel; ?>" href="<?php echo JRoute::_('index.php?option=com_k2&view=comments&tmpl=component'); ?>"><?php echo JText::_('K2_MODERATE_COMMENTS'); ?></a>
		</li>
	</ul>
	
	<ul class="k2UserBlockRenderedMenu">
		<?php $level = 1; foreach($menu as $key => $link): $level++; ?>
		<li class="linkItemId<?php echo $link->id; ?>">
			<?php if($link->type=='url' && $link->browserNav==0): ?>
			<a href="<?php echo $link->route; ?>"><?php echo $link->name; ?></a>
			<?php elseif(strpos($link->link,'option=com_k2&view=item&layout=itemform') || $link->browserNav==2): ?>
			<a class="modal" rel="{handler:'iframe',size:{x:990,y:550}}" href="<?php echo $link->route; ?>"><?php echo $link->name; ?></a>
			<?php else: ?>
			<a href="<?php echo $link->route; ?>"<?php if($link->browserNav==1) echo ' target="_blank"'; ?>><?php echo $link->name; ?></a>
			<?php endif; ?>
	
			<?php if(isset($menu[$key+1]) && $menu[$key]->level < $menu[$key+1]->level): ?>
			<ul>
			<?php endif; ?>
	
			<?php if(isset($menu[$key+1]) && $menu[$key]->level > $menu[$key+1]->level): ?>
			<?php echo str_repeat('</li></ul>', $menu[$key]->level - $menu[$key+1]->level); ?>
			<?php endif; ?>
	
		<?php if(isset($menu[$key+1]) && $menu[$key]->level == $menu[$key+1]->level): ?>
		</li>
		<?php endif; ?>
		<?php endforeach; ?>
  </ul>

  <form action="index.php" method="post">
    <input type="submit" name="Submit" class="button ubLogout" value="<?php echo JText::_('K2_LOGOUT'); ?>" />
    <input type="hidden" name="option" value="<?php echo (K2_JVERSION=='16')?'com_users':'com_user'?>" />
    <input type="hidden" name="task" value="<?php echo (K2_JVERSION=='16')?'user.logout':'logout'?>" />
    <input type="hidden" name="return" value="<?php echo $return; ?>" />
    <?php echo JHTML::_( 'form.token' ); ?>
  </form>
</div>
