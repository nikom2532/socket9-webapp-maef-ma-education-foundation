<?php
/**
 * @version		$Id: user.php 1492 2012-02-22 17:40:09Z joomlaworks@gmail.com $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2012 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

// Get user stuff (do not change)
$user = &JFactory::getUser(); 

$app = JFactory::getApplication();
$doc = JFactory::getDocument();

// Set the current template folder
$template = JURI::base() . 'templates/' . $app->getTemplate();

// Test to see if the default template is a zgf v2 template
$framework = JPATH_ROOT.DS.'templates'.DS.$app->getTemplate().DS.'includes'.DS.'config.php';

// Figure out whether to load the grid.css
if (!file_exists($framework)){
	$doc->addStyleSheet($template.'/html/com_k2/media/css/grid.css', 'text/css', 'screen');
}

// Load the zenkit k2.css
$doc->addStyleSheet($template.'/html/com_k2/media/css/zenkit.css', 'text/css', 'screen'); 

?>

<!-- Start K2 User Layout -->
<div id = "zenkit" class="userView<?php if($this->params->get('pageclass_sfx')) echo ' '.$this->params->get('pageclass_sfx'); ?>">


	<?php if($this->params->get('show_page_title') && $this->params->get('page_title')!=$this->user->name): ?>
		<!-- Page title -->
		<div class="componentheading<?php echo $this->params->get('pageclass_sfx')?>">
			<?php echo $this->escape($this->params->get('page_title')); ?>
		</div>
	<?php endif; ?>


	<?php if($this->params->get('userFeedIcon',1)): ?>
		<!-- RSS feed icon -->
		<div class="k2FeedIcon">
			<a href="<?php echo $this->feed; ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>">
				<span></span>
			</a>
			<div class="clear"></div>
		</div>
	<?php endif; ?>


	<?php if ($this->params->get('userImage') || $this->params->get('userName') || $this->params->get('userDescription') || $this->params->get('userURL') || $this->params->get('userEmail')): ?>
	<div class="userBlock">
		<?php if(isset($this->addLink) && JRequest::getInt('id')==$user->id): ?>
		<!-- Item add link -->
		<span class="userItemAddLink">
			<a class="modal" rel="{handler:'iframe',size:{x:990,y:550}}" href="<?php echo $this->addLink; ?>">
				<?php echo JText::_('K2_POST_A_NEW_ITEM'); ?>
			</a>
		</span>
		<?php endif; ?>
		
	
		<?php if ($this->params->get('userImage') && !empty($this->user->avatar)): ?>
			<div class="grid_three">
				<img src="<?php echo $this->user->avatar; ?>" alt="<?php echo $this->user->name; ?>" style="width:<?php echo $this->params->get('userImageWidth'); ?>px; height:auto;" />
			</div>
		<?php endif; ?>
		
		<div class="grid_nine zenlast">
			<?php if ($this->params->get('userName')): ?>
			<h2><?php echo $this->user->name; ?></h2>
			<?php endif; ?>
		
			<?php if ($this->params->get('userDescription') && isset($this->user->profile->description)): ?>
			<p class="userDescription"><?php echo $this->user->profile->description; ?></p>
			<?php endif; ?>
		
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
		</div>
			<div class="clear"></div>
		
			<?php echo $this->user->event->K2UserDisplay; ?>

			<div class="clear"></div>
	</div>
	<?php endif; ?>



	<?php if(count($this->items)): ?>
	<!-- Item list -->
	<div class="userItemList">
		<?php foreach ($this->items as $item): ?>
		
		<!-- Start K2 Item Layout -->
		<div class="userItemView<?php if(!$item->published || ($item->publish_up != $this->nullDate && $item->publish_up > $this->now) || ($item->publish_down != $this->nullDate && $item->publish_down < $this->now)) echo ' userItemViewUnpublished'; ?><?php echo ($item->featured) ? ' userItemIsFeatured' : ''; ?>">
		
			<!-- Plugins: BeforeDisplay -->
			<?php echo $item->event->BeforeDisplay; ?>
			
			<!-- K2 Plugins: K2BeforeDisplay -->
			<?php echo $item->event->K2BeforeDisplay; ?>
							
			  <?php if($item->params->get('userItemTitle')): ?>
			  <!-- Item title -->
			  <h1 class="contentheading">
					<?php if(isset($item->editLink)): ?>
					<!-- Item edit link -->
					<span class="userItemEditLink">
						<a class="modal" rel="{handler:'iframe',size:{x:990,y:550}}" href="<?php echo $item->editLink; ?>">
							<?php echo JText::_('K2_EDIT_ITEM'); ?>
						</a>
					</span>
					<?php endif; ?>

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
			  </h1>
			  <?php endif; ?>
			
			<div class="jbMeta zenmeta">
				<?php if($item->params->get('userItemDateCreated')): ?>
				<!-- Date created -->
				<span class="jbCreatedate">
					<?php echo JHTML::_('date', $item->created , JText::_('DATE_FORMAT_LC3')); ?>
				</span>
				<?php endif; ?>
				
				<?php if($item->params->get('userItemCategory')): ?>
				<!-- Item category name -->
				<div class="jbCategories zencategories">
					<span><strong><?php echo JText::_('K2_PUBLISHED_IN'); ?></strong></span>
					<a href="<?php echo $item->category->link; ?>"><?php echo $item->category->name; ?></a>
				</div>
				<?php endif; ?>
				
				
				<?php if($item->params->get('userItemCommentsAnchor') && ( ($item->params->get('comments') == '2' && !$this->user->guest) || ($item->params->get('comments') == '1')) ): ?>
					<div class="buttons">
					<!-- Anchor link to comments below -->
					<div class="commentsLink">
						<?php if(!empty($item->event->K2CommentsCounter)): ?>
							<!-- K2 Plugins: K2CommentsCounter -->
							<?php echo $item->event->K2CommentsCounter; ?>
						<?php else: ?>
							<?php if($item->numOfComments > 0): ?>
							<a href="<?php echo $item->link; ?>#itemCommentsAnchor">
								<?php echo $item->numOfComments; ?> <?php echo ($item->numOfComments>1) ? JText::_('K2_COMMENTS') : JText::_('K2_COMMENT'); ?>
							</a>
							<?php else: ?>
							<a href="<?php echo $item->link; ?>#itemCommentsAnchor">
								<?php echo JText::_('K2_BE_THE_FIRST_TO_COMMENT'); ?>
							</a>
							<?php endif; ?>
						<?php endif; ?>
					</div>
				</div>
				<?php endif; ?>	
			</div>

		
		  <!-- Plugins: AfterDisplayTitle -->
		  <?php echo $item->event->AfterDisplayTitle; ?>
		  
		  <!-- K2 Plugins: K2AfterDisplayTitle -->
		  <?php echo $item->event->K2AfterDisplayTitle; ?>

		  <div class="itemBody">
		
			  <!-- Plugins: BeforeDisplayContent -->
			  <?php echo $item->event->BeforeDisplayContent; ?>
			  
			  <!-- K2 Plugins: K2BeforeDisplayContent -->
			  <?php echo $item->event->K2BeforeDisplayContent; ?>
		
			  <?php if($item->params->get('userItemImage') && !empty($item->imageGeneric)): ?>
			  <!-- Item Image -->
			  <div class="imageBlock">
				  <span class="userItemImage">
				    <a href="<?php echo $item->link; ?>" title="<?php if(!empty($item->image_caption)) echo K2HelperUtilities::cleanHtml($item->image_caption); else echo K2HelperUtilities::cleanHtml($item->title); ?>">
				    	<img src="<?php echo $item->imageGeneric; ?>" alt="<?php if(!empty($item->image_caption)) echo K2HelperUtilities::cleanHtml($item->image_caption); else echo K2HelperUtilities::cleanHtml($item->title); ?>" style="width:<?php echo $item->params->get('itemImageGeneric'); ?>px; height:auto;" />
				    </a>
				  </span>
				  <div class="clear"></div>
			  </div>
			  <?php endif; ?>
			  
			  <?php if($item->params->get('userItemIntroText')): ?>
			  <!-- Item introtext -->
			  <div class="jbIntroText">
			  	<?php echo $item->introtext; ?>
			  </div>
			  <?php endif; ?>
		
				<div class="clear"></div>

			  <!-- Plugins: AfterDisplayContent -->
			  <?php echo $item->event->AfterDisplayContent; ?>
			  
			  <!-- K2 Plugins: K2AfterDisplayContent -->
			  <?php echo $item->event->K2AfterDisplayContent; ?>
		
			  <div class="clear"></div>
		  </div>
		
		  <?php if($item->params->get('userItemCategory') || $item->params->get('userItemTags')): ?>
		  <div class="userItemLinks">

			
				
			  	<?php if($item->params->get('userItemTags') && count($item->tags)): ?>
			  	<!-- Item tags -->
			  	<div class="tagsBlock">
				  	<span><?php echo JText::_('K2_TAGGED_UNDER'); ?></span>
				  	<ul class="userItemTags">
				    	<?php foreach ($item->tags as $tag): ?>
				    		<li><a href="<?php echo $tag->link; ?>"><?php echo $tag->name; ?></a></li>
				    	<?php endforeach; ?>
				  	</ul>
				  	<div class="clear"></div>
			  	</div>
			  	<?php endif; ?>

				<div class="clear"></div>
		  	</div>
		  <?php endif; ?>  
		
			<div class="clear"></div>

		
		  
			<?php if ($item->params->get('userItemReadMore')): ?>
			<!-- Item "read more..." link -->
			<div class="readMore zenbutton">
				<span>
					<a class="jbReadon"href="<?php echo $item->link; ?>">
						<?php echo JText::_('K2_READ_MORE'); ?>
					</a>
				</span>
			</div>
			<?php endif; ?>
			
			<div class="clear"></div>

		  <!-- Plugins: AfterDisplay -->
		  <?php echo $item->event->AfterDisplay; ?>
		  
		  <!-- K2 Plugins: K2AfterDisplay -->
		  <?php echo $item->event->K2AfterDisplay; ?>
			
			<div class="clear"></div>
		</div>
		<!-- End K2 Item Layout -->
		
		<?php endforeach; ?>
	</div>

	<!-- Pagination -->
	<?php if(count($this->pagination->getPagesLinks())): ?>
	<div class="k2Pagination">
		<?php echo $this->pagination->getPagesLinks(); ?>
		<div class="clear"></div>
		<?php echo $this->pagination->getPagesCounter(); ?>
	</div>
	<?php endif; ?>
	
	<?php endif; ?>

</div>

<!-- End K2 User Layout -->
