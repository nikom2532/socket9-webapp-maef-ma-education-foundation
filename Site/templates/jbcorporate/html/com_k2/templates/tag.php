<?php
/**
 * @version		$Id: tag.php 1492 2012-02-22 17:40:09Z joomlaworks@gmail.com $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2012 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');
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
$doc->addStyleSheet($template.'/html/com_k2/media/css/zenkit.css', 'text/css', 'screen'); ?>

?>

<!-- Start K2 Tag Layout -->
<div id = "zenkit" class="tagView<?php if($this->params->get('pageclass_sfx')) echo ' '.$this->params->get('pageclass_sfx'); ?>">
	

	<?php if($this->params->get('show_page_title')): ?>
		<!-- Page title -->
		<div class="componentheading<?php echo $this->params->get('pageclass_sfx')?>">
			<?php echo $this->escape($this->params->get('page_title')); ?>
		</div>
	<?php endif; ?>


	<?php if($this->params->get('tagFeedIcon',1)): ?>
		<!-- RSS feed icon -->
		<div class="k2FeedIcon">
			<a href="<?php echo $this->feed; ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>">
				<span></span>
			</a>
			<div class="clear"></div>
		</div>
	<?php endif; ?>

	
	<?php if(count($this->items)): ?>
		<div class="tagItemList">
			<?php // Start of the loop
				foreach($this->items as $item): ?>

				<!-- Start K2 Item Layout -->
				<div class="tagItemView">
			
			
			  		<?php if($item->params->get('tagItemTitle',1)): ?>
					  <!-- Item title -->
					  <h1 class="contentheading">
					  	<?php if ($item->params->get('tagItemTitleLinked',1)): ?>
							<a href="<?php echo $item->link; ?>">
					  		<?php echo $item->title; ?>
					  	</a>
					  	<?php else: ?>
					  	<?php echo $item->title; ?>
					  	<?php endif; ?>
					  </h1>
					  <?php endif; ?>
			
			
					<div class="jbMeta zenmeta">
						<?php if($item->params->get('tagItemDateCreated',1)): ?>
						<!-- Date created -->
						<span class="jbCreatedate">
							<?php echo JHTML::_('date', $item->created , JText::_('DATE_FORMAT_LC3')); ?>
						</span>
						<?php endif; ?>
				
						<?php if($item->params->get('tagItemCategory')): ?>
						<!-- Item category name -->
						<div class="tagItemCategory">
							<span><?php echo JText::_('K2_PUBLISHED_IN'); ?></span>
							<a href="<?php echo $item->category->link; ?>"><?php echo $item->category->name; ?></a>
						</div>
						<?php endif; ?>
					</div>

		 
		 			<div class="itemBody">
					  <?php if($item->params->get('tagItemImage',1) && !empty($item->imageGeneric)): ?>
					  <!-- Item Image -->
					  <div class="imageBlock">
				  
						    <a href="<?php echo $item->link; ?>" title="<?php if(!empty($item->image_caption)) echo K2HelperUtilities::cleanHtml($item->image_caption); else echo K2HelperUtilities::cleanHtml($item->title); ?>">
						    	<img src="<?php echo $item->imageGeneric; ?>" alt="<?php if(!empty($item->image_caption)) echo K2HelperUtilities::cleanHtml($item->image_caption); else echo K2HelperUtilities::cleanHtml($item->title); ?>" style="width:<?php echo $item->params->get('itemImageGeneric'); ?>px; height:auto;" />
						    </a>
				  
						  <div class="clear"></div>
					  </div>
					  <?php endif; ?>
			  
					  <?php if($item->params->get('tagItemIntroText',1)): ?>
					  <!-- Item introtext -->
					  <div class="jbIntroText">
					  	<?php echo $item->introtext; ?>
					  </div>
					  <?php endif; ?>

					  <div class="clear"></div>
				  </div>
		  
				  <div class="clear"></div>
		  
				  <?php if($item->params->get('tagItemExtraFields',0) && count($item->extra_fields)): ?>
				  <!-- Item extra fields -->  
				  <div class="tagItemExtraFields">
				  	<h4><?php echo JText::_('K2_ADDITIONAL_INFO'); ?></h4>
				  	<ul>
						<?php foreach ($item->extra_fields as $key=>$extraField): ?>
						<?php if($extraField->value): ?>
						<li class="<?php echo ($key%2) ? "odd" : "even"; ?> type<?php echo ucfirst($extraField->type); ?> group<?php echo $extraField->group; ?>">
							<span class="tagItemExtraFieldsLabel"><?php echo $extraField->name; ?></span>
							<span class="tagItemExtraFieldsValue"><?php echo $extraField->value; ?></span>		
						</li>
						<?php endif; ?>
						<?php endforeach; ?>
						</ul>
				    <div class="clear"></div>
				  </div>
				  <?php endif; ?>
		  
			
			
				<?php if ($item->params->get('tagItemReadMore')): ?>
				<!-- Item "read more..." link -->
				<div class="tagItemReadMore">
					<a class="k2ReadMore" href="<?php echo $item->link; ?>">
						<?php echo JText::_('K2_READ_MORE'); ?>
					</a>
				</div>
				<?php endif; ?>

			<div class="clear"></div>
		</div>
		<!-- End K2 Item Layout -->
		
		<?php endforeach; ?>
	</div>

	<!-- Pagination -->
	<?php if($this->pagination->getPagesLinks()): ?>
	<div class="k2Pagination">
		<?php echo $this->pagination->getPagesLinks(); ?>
		<div class="clear"></div>
		<?php echo $this->pagination->getPagesCounter(); ?>
	</div>
	<?php endif; ?>

	<?php endif; ?>
	
</div>
<!-- End K2 Tag Layout -->
