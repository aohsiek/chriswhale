<?php
/**
 * @version		$Id: item_comments_form.php 1492 2012-02-22 17:40:09Z joomlaworks@gmail.com $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2012 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<h3><?php echo JText::_('K2_LEAVE_A_COMMENT') ?></h3>

<?php if($this->params->get('commentsFormNotes')): ?>
<p class="itemCommentsFormNotes">
	<?php if($this->params->get('commentsFormNotesText')): ?>
	<?php echo nl2br($this->params->get('commentsFormNotesText')); ?>
	<?php else: ?>
	<?php echo JText::_('K2_COMMENT_FORM_NOTES') ?>
	<?php endif; ?>
</p>
<?php endif; ?>

<form action="<?php echo JRoute::_('index.php'); ?>" method="post" id="comment-form" class="form-validate">

	<dl>
    
	<dt><label class="formName" for="userName"><?php echo JText::_('K2_NAME'); ?>*</label></dt>
	<dd><input class="inputbox" type="text" name="userName" id="userName" /></dd>

	<dt><label class="formEmail" for="commentEmail"><?php echo JText::_('K2_EMAIL'); ?>*</label></dt>
	<dd><input class="inputbox" type="text" name="commentEmail" id="commentEmail" /></dd>

	<dt><label class="formUrl" for="commentURL"><?php echo JText::_('K2_WEBSITE_URL'); ?></label></dt>
	<dd><input class="inputbox" type="text" name="commentURL" id="commentURL" /></dd>

	<dt><label class="formComment" for="commentText"><?php echo JText::_('K2_MESSAGE'); ?>*</label></dt>
	<dd><textarea rows="20" cols="10" class="inputbox" name="commentText" id="commentText"></textarea></dd>
    
	<?php if($this->params->get('recaptcha') && $this->user->guest): ?>
	<dt><label class="formRecaptcha"><?php echo JText::_('K2_ENTER_THE_TWO_WORDS_YOU_SEE_BELOW'); ?></label></dt>
	<dd><div id="recaptcha"></div></dd>
	<?php endif; ?>
	
	</dl>

	<input type="submit" class="button" id="submitCommentButton" value="<?php echo JText::_('K2_SUBMIT_COMMENT'); ?>" />
	<span id="formLog"></span>

	<input type="hidden" name="option" value="com_k2" />
	<input type="hidden" name="view" value="item" />
	<input type="hidden" name="task" value="comment" />
	<input type="hidden" name="itemID" value="<?php echo JRequest::getInt('id'); ?>" />
	<?php echo JHTML::_('form.token'); ?>
</form>
