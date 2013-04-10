<?php
/**
 * @version		$Id: default.php 834 2011-06-20 07:36:03Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2011 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

/*style="width: ?>"
// no direct access */
defined('_JEXEC') or die('Restricted access');

?>

<div id="k2ModuleBox<?php echo $module->id; ?>" class="k2ItemsBlock<?php if($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); ?>">

	<?php if($params->get('itemPreText')): ?>
	<p class="modulePretext"><?php echo $params->get('itemPreText'); ?></p>
	<?php endif; ?>

	<?php if(count($items)): ?>
	
<div class="flex-nav-container">
	
  <div id="flexslider-<?php if($params->get('moduleclass_sfx')) echo $params->get('moduleclass_sfx'); ?>" class="flexslider">
  
	<ul class="slides">
    <?php foreach ($items as $key=>$item):	?>

    <?php
	   $datathumb="";
			if ($params->get('controlNav') == "'thumbnails'"){
				$datathumb = $item->imageXSmall;
			} else {
				$datathumb='';
			}
     ?>

	    <li class="slide" data-thumb="<?php echo $datathumb; ?>">

	      <!-- Plugins: BeforeDisplay -->
	      <?php echo $item->event->BeforeDisplay; ?>

	      <!-- K2 Plugins: K2BeforeDisplay -->
	      <?php echo $item->event->K2BeforeDisplay; ?>
		  
		      <?php if($params->get('itemImage') && isset($item->image)): ?>
		      <a class="moduleItemImage" href="<?php echo $item->link; ?>" title="<?php echo JText::_('K2_CONTINUE_READING'); ?> &quot;<?php echo K2HelperUtilities::cleanHtml($item->title); ?>&quot;">
		      	<img src="<?php echo $item->image; ?>" alt="<?php echo K2HelperUtilities::cleanHtml($item->title); ?>"/>
		      </a>
		      <?php endif; ?>
		  
		 <div class="flex-caption"> 
		 
		 <div class="flexCaptionInner">
		 
	      <?php if($params->get('itemTitle')): ?>
	      <a class="moduleItemTitle" href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a>
	      <?php endif; ?>
		 
			<?php if ($params->get('itemIntroText')): ?>
				<?php echo $item->introtext; ?>
			<?php endif; ?>
			
				<?php if($params->get('itemReadMore') && $item->fulltext): ?>
				<a class="moduleItemReadMore" href="<?php echo $item->link; ?>">
					<?php echo JText::_('K2_READ_MORE_SLIDER_THEME'); ?>
				</a>
				<?php endif; ?>

	      <?php if($params->get('itemAuthorAvatar')): ?>
	      <a class="k2Avatar moduleItemAuthorAvatar" rel="author" href="<?php echo $item->authorLink; ?>">
					<img src="<?php echo $item->authorAvatar; ?>" alt="<?php echo K2HelperUtilities::cleanHtml($item->author); ?>" style="width:<?php echo $avatarWidth; ?>px;height:auto;" />
				</a>
	      <?php endif; ?>


	      <?php if($params->get('itemAuthor')): ?>
	      <div class="moduleItemAuthor">
		      <?php echo K2HelperUtilities::writtenBy($item->authorGender); ?>
		
					<?php if(isset($item->authorLink)): ?>
					<a rel="author" title="<?php echo K2HelperUtilities::cleanHtml($item->author); ?>" href="<?php echo $item->authorLink; ?>"><?php echo $item->author; ?></a>
					<?php else: ?>
					<?php echo $item->author; ?>
					<?php endif; ?>
				</div>
				<?php endif; ?>

	      <!-- Plugins: AfterDisplayTitle -->
	      <?php echo $item->event->AfterDisplayTitle; ?>

	      <!-- K2 Plugins: K2AfterDisplayTitle -->
	      <?php echo $item->event->K2AfterDisplayTitle; ?>

	      <!-- Plugins: BeforeDisplayContent -->
	      <?php echo $item->event->BeforeDisplayContent; ?>

	      <!-- K2 Plugins: K2BeforeDisplayContent -->
	      <?php echo $item->event->K2BeforeDisplayContent; ?>

	      <?php if($params->get('itemExtraFields') && count($item->extra_fields)): ?>
	      <div class="moduleItemExtraFields">
		      <b><?php echo JText::_('K2_ADDITIONAL_INFO'); ?></b>
		      <ul>
		        <?php foreach ($item->extra_fields as $extraField): ?>
						<?php if($extraField->value): ?>
						<li class="type<?php echo ucfirst($extraField->type); ?> group<?php echo $extraField->group; ?>">
							<span class="moduleItemExtraFieldsLabel"><?php echo $extraField->name; ?></span>
							<span class="moduleItemExtraFieldsValue"><?php echo $extraField->value; ?></span>
							<div class="clr"></div>
						</li>
						<?php endif; ?>
		        <?php endforeach; ?>
		      </ul>
	      </div>
	      <?php endif; ?>

	      <div class="clr"></div>

	      <?php if($params->get('itemVideo')): ?>
	      <div class="moduleItemVideo">
	      	<?php echo $item->video ; ?>
	      	<span class="moduleItemVideoCaption"><?php echo $item->video_caption ; ?></span>
	      	<span class="moduleItemVideoCredits"><?php echo $item->video_credits ; ?></span>
	      </div>
	      <?php endif; ?>

	      <div class="clr"></div>

	      <!-- Plugins: AfterDisplayContent -->
	      <?php echo $item->event->AfterDisplayContent; ?>

	      <!-- K2 Plugins: K2AfterDisplayContent -->
	      <?php echo $item->event->K2AfterDisplayContent; ?>

	      <?php if($params->get('itemDateCreated')): ?>
	      <span class="moduleItemDateCreated"><?php echo JText::_('K2_WRITTEN_ON') ; ?> <?php echo JHTML::_('date', $item->created, JText::_('K2_DATE_FORMAT_LC2')); ?></span>
	      <?php endif; ?>

	      <?php if($params->get('itemCategory')): ?>
	      <?php echo JText::_('K2_IN') ; ?> <a class="moduleItemCategory" href="<?php echo $item->categoryLink; ?>"><?php echo $item->categoryname; ?></a>
	      <?php endif; ?>

	      <?php if($params->get('itemTags') && count($item->tags)>0): ?>
	      <div class="moduleItemTags">
	      	<b><?php echo JText::_('K2_TAGS'); ?>:</b>
	        <?php foreach ($item->tags as $tag): ?>
	        <a href="<?php echo $tag->link; ?>"><?php echo $tag->name; ?></a>
	        <?php endforeach; ?>
	      </div>
	      <?php endif; ?>

	      <?php if($params->get('itemAttachments') && count($item->attachments)): ?>
				<div class="moduleAttachments">
					<?php foreach ($item->attachments as $attachment): ?>
					<a title="<?php echo K2HelperUtilities::cleanHtml($attachment->titleAttribute); ?>" href="<?php echo $attachment->link; ?>"><?php echo $attachment->title; ?></a>
					<?php endforeach; ?>
				</div>
	      <?php endif; ?>

				<?php if($params->get('itemCommentsCounter') && $componentParams->get('comments')): ?>		
					<?php if(!empty($item->event->K2CommentsCounter)): ?>
						<!-- K2 Plugins: K2CommentsCounter -->
						<?php echo $item->event->K2CommentsCounter; ?>
					<?php else: ?>
						<?php if($item->numOfComments>0): ?>
						<a class="moduleItemComments" href="<?php echo $item->link.'#itemCommentsAnchor'; ?>">
							<?php echo $item->numOfComments; ?> <?php if($item->numOfComments>1) echo JText::_('K2_COMMENTS'); else echo JText::_('K2_COMMENT'); ?>
						</a>
						<?php else: ?>
						<a class="moduleItemComments" href="<?php echo $item->link.'#itemCommentsAnchor'; ?>">
							<?php echo JText::_('K2_BE_THE_FIRST_TO_COMMENT'); ?>
						</a>
						<?php endif; ?>
					<?php endif; ?>
				<?php endif; ?>

				<?php if($params->get('itemHits')): ?>
				<span class="moduleItemHits">
					<?php echo JText::_('K2_READ'); ?> <?php echo $item->hits; ?> <?php echo JText::_('K2_TIMES'); ?>
				</span>
				<?php endif; ?>

	      <!-- Plugins: AfterDisplay -->
	      <?php echo $item->event->AfterDisplay; ?>

	      <!-- K2 Plugins: K2AfterDisplay -->
	      <?php echo $item->event->K2AfterDisplay; ?>
		  </div>
		</div>
	    </li>
    <?php endforeach; ?>
	</ul>
  </div>
  </div>
  <?php endif; ?>

	<?php if($params->get('itemCustomLink')): ?>
	<a class="moduleCustomLink" href="<?php echo $params->get('itemCustomLinkURL'); ?>" title="<?php echo K2HelperUtilities::cleanHtml($itemCustomLinkTitle); ?>"><?php echo $itemCustomLinkTitle; ?></a>
	<?php endif; ?>

</div>


<script type="text/javascript">
(function($){ 
   $(window).load(function(){
		$('#flexslider-<?php if($params->get('moduleclass_sfx')) echo $params->get('moduleclass_sfx'); ?>').flexslider({
		 	namespace: 'flex-',     												//{NEW} String: Prefix string attached to the class of every element generated by the plugin
		    selector: '.slides > li',       										//{NEW} Selector: Must match a simple pattern. '{container} > {slide}' -- Ignore pattern at your own peril
			animation: '<?php echo $params->get("animation"); ?>',     				//String: Select your animation type, "fade" or "slide"
			easing: '<?php echo $params->get("easing"); ?>',           				//{NEW} String: Determines the easing method used in jQuery transitions. jQuery easing plugin is supported!
		    direction: '<?php echo $params->get("direction"); ?>', 	   				//String: Select the sliding direction, "horizontal" or "vertical"
		    reverse: <?php echo $params->get("reverse"); ?>,       					//{NEW} Boolean: Reverse the animation direction
		    animationLoop: <?php echo $params->get("animationLoop"); ?>,			//Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
		    smoothHeight:  <?php echo $params->get("smoothHeight"); ?>,    		 //{NEW} Boolean: Allow height of the slider to animate smoothly in horizontal mode  
		    startAt:  <?php echo $params->get("startAt"); ?>,              		 //Integer: The slide that the slider should start on. Array notation (0 = first slide)
		    slideshow: <?php echo $params->get("slideshow"); ?>,           		 //Boolean: Animate slider automatically
		    slideshowSpeed: <?php echo $params->get("slideshowSpeed"); ?>,  		//Integer: Set the speed of the slideshow cycling, in milliseconds
		    animationSpeed: <?php echo $params->get("animationSpeed"); ?>,  		//Integer: Set the speed of animations, in milliseconds
		    initDelay: <?php echo $params->get("initDelay"); ?>,            		//{NEW} Integer: Set an initialization delay, in milliseconds
		    randomize: <?php echo $params->get("randomize"); ?>,             		//Boolean: Randomize slide order
		    
		    // Usability features
		    pauseOnAction: <?php echo $params->get("pauseOnAction"); ?>,     		//Boolean: Pause the slideshow when interacting with control elements, highly recommended.
		    pauseOnHover: <?php echo $params->get("pauseOnHover"); ?>,       		//Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
		    useCSS: <?php echo $params->get("useCSS"); ?>,                   		//{NEW} Boolean: Slider will use CSS3 transitions if available
		    touch: <?php echo $params->get("touch"); ?>,                     		//{NEW} Boolean: Allow touch swipe navigation of the slider on touch-enabled devices
		    video: <?php echo $params->get("video"); ?>,                     		//{NEW} Boolean: If using video in the slider, will prevent CSS3 3D Transforms to avoid graphical glitches
		    
		    // Primary Controls
		    controlNav: <?php echo $params->get("controlNav"); ?>,               	//Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
		    directionNav: <?php echo $params->get("directionNav"); ?>,              //Boolean: Create navigation for previous/next navigation? (true/false)
		    prevText:"<?php echo $params->get('prevText'); ?>",           			//String: Set the text for the "previous" directionNav item
		    nextText: "<?php echo $params->get('nextText'); ?>",               		//String: Set the text for the "next" directionNav item
		    
		    // Secondary Navigation
		    keyboard: <?php echo $params->get("keyboard"); ?>,                 		//Boolean: Allow slider navigating via keyboard left/right keys
		    multipleKeyboard: <?php echo $params->get("multipleKeyboard"); ?>,      //{NEW} Boolean: Allow keyboard navigation to affect multiple sliders. Default behavior cuts out keyboard navigation with more than one slider present.
		    mousewheel: <?php echo $params->get("mousewheel"); ?>,              	//{UPDATED} Boolean: Requires jquery.mousewheel.js (https://github.com/brandonaaron/jquery-mousewheel) - Allows slider navigating via mousewheel
		    pausePlay: <?php echo $params->get("pausePlay"); ?>,               		//Boolean: Create pause/play dynamic element
		    pauseText: "<?php echo $params->get('pauseText'); ?>",             		//String: Set the text for the "pause" pausePlay item
		    playText: "<?php echo $params->get('playText'); ?>",               		//String: Set the text for the "play" pausePlay item
		    
		    // Special properties
		    controlsContainer: ".flex-nav-container",     							 //{UPDATED} jQuery Object/Selector: Declare which container the navigation elements should be appended too. Default container is the FlexSlider element. Example use would be $(".flexslider-container"). Property is ignored if given element is not found.
		    manualControls: "<?php echo $params->get('manualControls'); ?>",            //{UPDATED} jQuery Object/Selector: Declare custom control navigation. Examples would be $(".flex-control-nav li") or "#tabs-nav li img", etc. The number of elements in your controlNav should match the number of slides/tabs.
		    sync: "<?php echo $params->get('sync'); ?>",                       			//{NEW} Selector: Mirror the actions performed on this slider with another slider. Use with care.
		    asNavFor: "<?php echo $params->get('asNavFor'); ?>",                   		//{NEW} Selector: Internal property exposed for turning the slider into a thumbnail navigation for another slider
		    
		    // Carousel Options
		    itemWidth: <?php echo $params->get("itemWidth"); ?>,                   	//{NEW} Integer: Box-model width of individual carousel items, including horizontal borders and padding.
		    itemMargin: <?php echo $params->get("itemMargin"); ?>,                  //{NEW} Integer: Margin between carousel items.
		    minItems: <?php echo $params->get("minItems"); ?>,                    	//{NEW} Integer: Minimum number of carousel items that should be visible. Items will resize fluidly when below this.
		    maxItems: <?php echo $params->get("maxItems"); ?>,                    	//{NEW} Integer: Maxmimum number of carousel items that should be visible. Items will resize fluidly when above this limit.
		    move: <?php echo $params->get("move"); ?>,                        		//{NEW} Integer: Number of carousel items that should move on animation. If 0, slider will move all visible items.
		                                    
		    // Callback API
		    start: function(){},            //Callback: function(slider) - Fires when the slider loads the first slide
		    before: function(){},           //Callback: function(slider) - Fires asynchronously with each slider animation
		    after: function(){},            //Callback: function(slider) - Fires after each slider animation completes
		    end: function(){},              //Callback: function(slider) - Fires when the slider reaches the last slide (asynchronous)
		    added: function(){},            //{NEW} Callback: function(slider) - Fires after a slide is added
		    removed: function(){}           //{NEW} Callback: function(slider) - Fires after a slide is removed
		});
	});
})(jQuery);     

</script>
