<?php
/**
 * @version		$Id: latest_item.php 1492 2012-02-22 17:40:09Z joomlaworks@gmail.com $
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
$doc->addStyleSheet($template.'/html/com_k2/media/css/zenkit.css', 'text/css', 'screen');

?>

<!-- Start K2 Item Layout -->
<div class="latestItemView">

	<!-- Plugins: BeforeDisplay -->
	<?php echo $this->item->event->BeforeDisplay; ?>

	<!-- K2 Plugins: K2BeforeDisplay -->
	<?php echo $this->item->event->K2BeforeDisplay; ?>


	<?php if($this->item->params->get('latestItemTitle')): ?>
		<!-- Item title -->
	  	<h1 class="contentheading">
	  		<?php if ($this->item->params->get('latestItemTitleLinked')): ?>
				<a href="<?php echo $this->item->link; ?>">
	  				<?php echo $this->item->title; ?>
	  			</a>
	  	
				<?php else: ?>
	  				<?php echo $this->item->title; ?>
	  			<?php endif; ?>
	  	</h1>
	  <?php endif; ?>


  	<div class="jbMeta zenmeta">
		<?php if($this->item->params->get('latestItemDateCreated')): ?>
			<!-- Date created -->
			<div class="jbCreatedate zenkitdate">
				<?php echo JHTML::_('date', $this->item->created , JText::_('DATE_FORMAT_LC3')); ?>
			</div>
		<?php endif; ?>
	
		<?php if($this->item->params->get('latestItemCategory')): ?>
			<!-- Item category name -->
			<div class="jbCategories zencategories">
				<span><strong><?php echo JText::_('K2_PUBLISHED_IN'); ?></strong></span>
					<a href="<?php echo $this->item->category->link; ?>"><?php echo $this->item->category->name; ?></a>
			</div>
		<?php endif; ?>
		
	
		<?php if($this->item->params->get('latestItemCommentsAnchor') && ( ($this->item->params->get('comments') == '2' && !$this->user->guest) || ($this->item->params->get('comments') == '1')) ): ?>
		<!-- Anchor link to comments below -->
		<div class="buttons">
			<div class="commentsLink">
				<?php if(!empty($this->item->event->K2CommentsCounter)): ?>
					<!-- K2 Plugins: K2CommentsCounter -->
					<?php echo $this->item->event->K2CommentsCounter; ?>
				<?php else: ?>
					<?php if($this->item->numOfComments > 0): ?>
					<a href="<?php echo $this->item->link; ?>#itemCommentsAnchor">
						<?php echo $this->item->numOfComments; ?> <?php echo ($this->item->numOfComments>1) ? JText::_('K2_COMMENTS') : JText::_('K2_COMMENT'); ?>
					</a>
					<?php else: ?>
					<a href="<?php echo $this->item->link; ?>#itemCommentsAnchor">
						<?php echo JText::_('K2_BE_THE_FIRST_TO_COMMENT'); ?>
					</a>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
		<?php endif; ?>
	</div>
  
	<!-- Plugins: AfterDisplayTitle -->
  	<?php echo $this->item->event->AfterDisplayTitle; ?>

  	<!-- K2 Plugins: K2AfterDisplayTitle -->
  	<?php echo $this->item->event->K2AfterDisplayTitle; ?>

  <div class="itemBody">
	
	  <?php if($this->params->get('latestItemVideo') && !empty($this->item->video)): ?>
	  <!-- Item video -->
	  	<div class="videoEmbedded">
			<div class="video-container">
				<div class="zenvideo">
	  				<h3><?php echo JText::_('K2_RELATED_VIDEO'); ?></h3>
		  				<?php if($this->item->videoType=='embedded'): ?> embedded<?php endif; ?>"><?php echo $this->item->video; ?>
				</div>
			</div>
	  </div>
	  <?php endif; ?>

	  <!-- Plugins: BeforeDisplayContent -->
	  <?php echo $this->item->event->BeforeDisplayContent; ?>

	  <!-- K2 Plugins: K2BeforeDisplayContent -->
	  <?php echo $this->item->event->K2BeforeDisplayContent; ?>

	  <?php if($this->item->params->get('latestItemImage') && !empty($this->item->image)): ?>
	  <!-- Item Image -->
	  <div class="imageBlock">
		  <span class="itemImage">
		    <a href="<?php echo $this->item->link; ?>" title="<?php if(!empty($this->item->image_caption)) echo K2HelperUtilities::cleanHtml($this->item->image_caption); else echo K2HelperUtilities::cleanHtml($this->item->title); ?>">
		    	<img src="<?php echo $this->item->image; ?>" alt="<?php if(!empty($this->item->image_caption)) echo K2HelperUtilities::cleanHtml($this->item->image_caption); else echo K2HelperUtilities::cleanHtml($this->item->title); ?>" style="width:<?php echo $this->item->imageWidth; ?>px;height:auto;" />
		    </a>
		  </span>
		  <div class="clear"></div>
	  </div>
	  <?php endif; ?>

	  <?php if($this->item->params->get('latestItemIntroText')): ?>
	  <!-- Item introtext -->
	  <div class="jbIntroText">
	  	<?php echo $this->item->introtext; ?>
	  </div>
	  <?php endif; ?>

		<div class="clear"></div>

	  <!-- Plugins: AfterDisplayContent -->
	  <?php echo $this->item->event->AfterDisplayContent; ?>

	  <!-- K2 Plugins: K2AfterDisplayContent -->
	  <?php echo $this->item->event->K2AfterDisplayContent; ?>

	  <div class="clear"></div>
  	</div>

  	<?php if($this->item->params->get('latestItemTags')): ?>
  	<div class="itemLinks">

	

	  <?php if($this->item->params->get('latestItemTags') && count($this->item->tags)): ?>
	  <!-- Item tags -->
	  <div class="tagsBlock">
		  <span><?php echo JText::_('K2_TAGGED_UNDER'); ?></span>
		  <ul class="tags">
		    <?php foreach ($this->item->tags as $tag): ?>
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

	<?php if ($this->item->params->get('latestItemReadMore')): ?>
	<!-- Item "read more..." link -->
	<div class="readMore zenbutton">
		<span>
			<a class="jbReadon"href="<?php echo $this->item->link; ?>">
				<?php echo JText::_('K2_READ_MORE'); ?>
			</a>
		</span>
	</div>
	<?php endif; ?>

	<div class="clear"></div>

  <!-- Plugins: AfterDisplay -->
  <?php echo $this->item->event->AfterDisplay; ?>

  <!-- K2 Plugins: K2AfterDisplay -->
  <?php echo $this->item->event->K2AfterDisplay; ?>

	<div class="clear"></div>
</div>

<!-- End K2 Item Layout -->
