<?php
/**
 * @version		$Id: user.php 1344 2011-11-25 16:47:03Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2011 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

// Get user stuff (do not change)
$user = &JFactory::getUser();

?>

<!-- Start K2 User Layout -->

<div id="k2Container" class="userView<?php if($this->params->get('pageclass_sfx')) echo ' '.$this->params->get('pageclass_sfx'); ?>">

<!-- Page title -->
	<?php if($this->params->get('show_page_title') && $this->params->get('page_title')!=$this->user->name): ?>
		<div class="componentheading <?php echo $this->params->get('pageclass_sfx')?>">
			<h2><?php echo $this->escape($this->params->get('page_title')); ?></h2>
		</div>
	<?php endif; ?>
	
<!-- RSS feed icon -->
	<?php if($this->params->get('userFeedIcon',1)): ?>
		<div class="k2FeedIcon">
			<a href="<?php echo $this->feed; ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>">
				<span><?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?></span>
			</a>
			<div class="clr"></div>
		</div>
	<?php endif; ?>
	

	<?php if ($this->params->get('userImage') || $this->params->get('userName') || $this->params->get('userDescription') || $this->params->get('userURL') || $this->params->get('userEmail')): ?>
	<div class="userBlock">
	
	<!-- Item add link -->
		<?php if(isset($this->addLink) && JRequest::getInt('id')==$user->id): ?>
			<span class="userItemAddLink">
				<a class="modal" rel="{handler:'iframe',size:{x:990,y:550}}" href="<?php echo $this->addLink; ?>">
					<?php echo JText::_('K2_POST_A_NEW_ITEM'); ?>
				</a>
			</span>
		<?php endif; ?>
			
	<!-- User image -->
		<?php if ($this->params->get('userImage') && !empty($this->user->avatar)): ?>
		<img src="<?php echo $this->user->avatar; ?>" alt="<?php echo $this->user->name; ?>" />
		<?php endif; ?>
	
	<!-- User name -->
		<?php if ($this->params->get('userName')): ?>
		<h3><?php echo $this->user->name; ?></h3>
		<?php endif; ?>
		
	<!-- User description -->
		<?php if ($this->params->get('userDescription') && trim($this->user->profile->description)): ?>
		<div class="userDescription"><?php echo $this->user->profile->description; ?></div>
		<?php endif; ?>
		
	<!-- User additional info -->
		<?php if (($this->params->get('userURL') && isset($this->user->profile->url) && $this->user->profile->url) || $this->params->get('userEmail')): ?>
			<div class="userAdditionalInfo">
				<?php if ($this->params->get('userURL') && isset($this->user->profile->url) && $this->user->profile->url): ?>
				<span class="userURL">
					<?php echo JText::_('K2_WEBSITE_URL'); ?>: <a href="<?php echo $this->user->profile->url; ?>" target="_blank" rel="me"><?php echo $this->user->profile->url; ?></a>
				</span>
				<?php endif; ?>

				<?php if ($this->params->get('userEmail')): ?>
				<span class="userEmail">
					<?php echo JText::_('K2_EMAIL'); ?>: <?php echo JHTML::_('Email.cloak', $this->user->email); ?>
				</span>
				<?php endif; ?>	
			</div>
		<?php endif; ?>

		<div class="clr"></div>
		
		<?php echo $this->user->event->K2UserDisplay; ?>
		
		<div class="clr"></div>
	</div>
	<?php endif; ?>


<!-- Item list -->
	<?php if(count($this->items)): ?>
	<div class="userItemList">
		<?php foreach ($this->items as $item): ?>
		
		<!-- Start K2 Item Layout -->
		<div class="userItemView<?php if(!$item->published || ($item->publish_up != $this->nullDate && $item->publish_up > $this->now) || ($item->publish_down != $this->nullDate && $item->publish_down < $this->now)) echo ' userItemViewUnpublished'; ?><?php echo ($item->featured) ? ' userItemIsFeatured' : ''; ?>">
		
			<!-- Plugins: BeforeDisplay -->
			<?php echo $item->event->BeforeDisplay; ?>
			
			<!-- K2 Plugins: K2BeforeDisplay -->
			<?php echo $item->event->K2BeforeDisplay; ?>

		<!-- Date created -->
					<?php if($item->params->get('userItemDateCreated')): ?>
						<span class="userItemDateCreated">
							<strong><?php echo JHTML::_('date', $item->created , JText::_('K2_DATE_FORMAT_LC9')); ?></strong>
							<?php echo JHTML::_('date', $item->created , JText::_('K2_DATE_FORMAT_LC10')); ?>
						</span>
					<?php endif; ?>
			
			<div class="userItemHeader">	


			<!-- Item title -->
				  <?php if($item->params->get('userItemTitle')): ?>
				  
							<?php if(isset($item->editLink)): ?>
							<!-- Item edit link -->
							<span class="userItemEditLink">
								<a class="modal" rel="{handler:'iframe',size:{x:990,y:550}}" href="<?php echo $item->editLink; ?>">
									<?php echo JText::_('K2_EDIT_ITEM'); ?>
								</a>
							</span>
							<?php endif; ?>
				  
					  <h3 class="userItemTitle">
						<?php if ($item->params->get('userItemTitleLinked') && $item->published): ?>
							<a href="<?php echo $item->link; ?>">
							<?php echo $item->title; ?>
						</a>
						<?php else: ?>
						<?php echo $item->title; ?>
						<?php endif; ?>
						<?php if(!$item->published || ($item->publish_up != $this->nullDate && $item->publish_up > $this->now) || ($item->publish_down != $this->nullDate && $item->publish_down < $this->now)): ?>
						<span>
							<sup>
								<?php echo JText::_('K2_UNPUBLISHED'); ?>
							</sup>
						</span>
						<?php endif; ?>
					</h3>
				<?php endif; ?>

			<?php if($item->params->get('userItemCommentsAnchor') && ( ($item->params->get('comments') == '2' && !$this->user->guest) || ($item->params->get('comments') == '1')) ): ?>
			<!-- Anchor link to comments below -->
			<div class="userItemCommentsLink">
				<?php if(!empty($item->event->K2CommentsCounter)): ?>
					<!-- K2 Plugins: K2CommentsCounter -->
					<?php echo $item->event->K2CommentsCounter; ?>
				<?php else: ?>
					<a href="<?php echo $item->link; ?>#itemCommentsAnchor">
						<?php echo $item->numOfComments; ?>
					</a>
				<?php endif; ?>
			</div>
			<?php endif; ?>

				<?php if($item->params->get('userItemCategory')): ?>
				<!-- Item category name -->
				<div class="userItemCategory">
					<span><?php echo JText::_('K2_PUBLISHED_IN'); ?></span>
					<a href="<?php echo $item->category->link; ?>"><?php echo $item->category->name; ?></a>
				</div>
				<?php endif; ?>
				
			</div>
			
			
		
		  <!-- Plugins: AfterDisplayTitle -->
		  <?php echo $item->event->AfterDisplayTitle; ?>
		  
		  <!-- K2 Plugins: K2AfterDisplayTitle -->
		  <?php echo $item->event->K2AfterDisplayTitle; ?>

		  <div class="userItemBody">
		
			  <!-- Plugins: BeforeDisplayContent -->
			  <?php echo $item->event->BeforeDisplayContent; ?>
			  
			  <!-- K2 Plugins: K2BeforeDisplayContent -->
			  <?php echo $item->event->K2BeforeDisplayContent; ?>
		
		<!-- Item Image -->
			  <?php if($item->params->get('userItemImage') && !empty($item->imageGeneric)): ?>
			  <div class="userItemImageBlock">
				  <span class="userItemImage">
				    <a href="<?php echo $item->link; ?>" title="<?php if(!empty($item->image_caption)) echo K2HelperUtilities::cleanHtml($item->image_caption); else echo K2HelperUtilities::cleanHtml($item->title); ?>">
				    	<img src="<?php echo $item->imageGeneric; ?>" alt="<?php if(!empty($item->image_caption)) echo K2HelperUtilities::cleanHtml($item->image_caption); else echo K2HelperUtilities::cleanHtml($item->title); ?>"/>
				    </a>
				  </span>
			  </div>
			  <?php endif; ?>
		
		<!-- Item introtext -->		
			  <?php if($item->params->get('userItemIntroText')): ?>
			  <div class="userItemIntroText">
			  	<?php echo $item->introtext; ?>

					<?php if ($item->params->get('userItemReadMore')): ?>
					<!-- Item "read more..." link -->
					<div class="userItemReadMore">
						<a class="k2ReadMore" href="<?php echo $item->link; ?>">
							<?php echo JText::_('K2_READ_MORE_THEME'); ?>
						</a>
					</div>
					<?php endif; ?>
			  </div>
			  <?php endif; ?>
		
				<div class="clr"></div>

			  <!-- Plugins: AfterDisplayContent -->
			  <?php echo $item->event->AfterDisplayContent; ?>
			  
			  <!-- K2 Plugins: K2AfterDisplayContent -->
			  <?php echo $item->event->K2AfterDisplayContent; ?>
		
			  <div class="clr"></div>
		  </div>
		
		  <?php if($item->params->get('userItemTags')): ?>
		  <div class="userItemLinks">
				
			  <?php if($item->params->get('userItemTags') && count($item->tags)): ?>
			  <!-- Item tags -->
			  <div class="userItemTagsBlock">
				  <span><?php echo JText::_('K2_TAGGED_UNDER'); ?></span>
				  <ul class="userItemTags">
				    <?php foreach ($item->tags as $tag): ?>
				    <li><a href="<?php echo $tag->link; ?>"><?php echo $tag->name; ?></a></li>
				    <?php endforeach; ?>
				  </ul>
				  <div class="clr"></div>
			  </div>
			  <?php endif; ?>

				<div class="clr"></div>
		  </div>
		  <?php endif; ?>
		 
			
			<div class="clr"></div>

		  <!-- Plugins: AfterDisplay -->
		  <?php echo $item->event->AfterDisplay; ?>
		  
		  <!-- K2 Plugins: K2AfterDisplay -->
		  <?php echo $item->event->K2AfterDisplay; ?>
			
			<div class="clr"></div>
		</div>
		<!-- End K2 Item Layout -->
		
		<?php endforeach; ?>
	</div>

	<!-- Pagination -->
	<?php if(count($this->pagination->getPagesLinks())): ?>
	<div class="k2Pagination">
		<?php echo $this->pagination->getPagesLinks(); ?>
		<div class="clr"></div>
		<p class="pagination-results"><?php echo $this->pagination->getPagesCounter(); ?></p>
	</div>
	<?php endif; ?>
	
	<?php endif; ?>

</div>

<!-- End K2 User Layout -->
