<?php
/**
 * @version		$Id: latest.php 1492 2012-02-22 17:40:09Z joomlaworks@gmail.com $
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

<!-- Start K2 Latest Layout -->
<div id = "zenkit" class="latestView<?php if($this->params->get('pageclass_sfx')) echo ' '.$this->params->get('pageclass_sfx'); ?>">

	<?php if($this->params->get('show_page_title')): ?>
	<!-- Page title -->
	<div class="componentheading<?php echo $this->params->get('pageclass_sfx')?>">
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</div>
	<?php endif; ?>

	<?php foreach($this->blocks as $key=>$block): 
		// Define a CSS class for the last container on each row
		if( (($key+1)%($this->params->get('latestItemsCols'))==0))
			$catlast= ' zenlast';
		else
			$catlast='';
	?>
	<div class="latestItemsContainer grid_<?php echo $this->params->get('latestItemsCols'); ?> <?php echo $catlast; ?>">
	
		<?php if($this->source=='categories'): $category=$block; ?>
		
		<?php if($this->params->get('categoryFeed') || $this->params->get('categoryImage') || $this->params->get('categoryTitle') || $this->params->get('categoryDescription')): ?>
		<!-- Start K2 Category block -->
		<div class="k2category">
			<div class="categoryinner">
				<?php if($this->params->get('categoryFeed')): ?>
				<!-- RSS feed icon -->
				<div class="k2FeedIcon">
					<a href="<?php echo $category->feed; ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>">
						<span></span>
					</a>
					<div class="clear"></div>
				</div>
				<?php endif; ?>
	
				<?php if ($this->params->get('categoryImage') && !empty($category->image)): ?>
				<div class="categoryImage">
					<img src="<?php echo $category->image; ?>" alt="<?php echo K2HelperUtilities::cleanHtml($category->name); ?>" style="width:<?php echo $this->params->get('catImageWidth'); ?>px;height:auto;" />
				</div>
				<?php endif; ?>
	
				<?php if ($this->params->get('categoryTitle')): ?>
				<h2><a href="<?php echo $category->link; ?>"><?php echo $category->name; ?></a></h2>
				<?php endif; ?>
	
				<?php if ($this->params->get('categoryDescription') && isset($category->description)): ?>
				<p><?php echo $category->description; ?></p>
				<?php endif; ?>
	
				<div class="clear"></div>
	
				<!-- K2 Plugins: K2CategoryDisplay -->
				<?php echo $category->event->K2CategoryDisplay; ?>
			</div>
		</div>

		<!-- End K2 Category block -->
		<?php endif; ?>
		
		<?php else: $user=$block; ?>


		<?php if ($this->params->get('userFeed') || $this->params->get('userImage') || $this->params->get('userName') || $this->params->get('userDescription') || $this->params->get('userURL') || $this->params->get('userEmail')): ?>
		<!-- Start K2 User block -->
		<div class="latestItemsUser">
			<div class="divider"></div>
			<?php if($this->params->get('userFeed')): ?>
			<!-- RSS feed icon -->
			<div class="k2FeedIcon">
				<a href="<?php echo $user->feed; ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>">
					<span></span>
				</a>
				<div class="clear"></div>
			</div>
			<?php endif; ?>

			<?php if ($this->params->get('userImage') && !empty($user->avatar)): ?>
			<?php if($this->params->get('latestItemsCols') == "1") { ?>
			<div class="grid_three">
			<?php } ?>
				<img src="<?php echo $user->avatar; ?>" alt="<?php echo $user->name; ?>" style="width:<?php echo $this->params->get('userImageWidth'); ?>px;height:auto;" />
			<?php if($this->params->get('latestItemsCols') == "1") { ?>
			</div>
			<?php } ?>
			<?php endif; ?>
			
			<?php if($this->params->get('latestItemsCols') == "1") { ?>
			<div class="grid_nine zenlast">
				<?php } ?>
				<?php if ($this->params->get('userName')): ?>
				<h2><a rel="author" href="<?php echo $user->link; ?>"><?php echo $user->name; ?></a></h2>
				<?php endif; ?>
	
				<?php if ($this->params->get('userDescription') && isset($user->profile->description)): ?>
				<p class="latestItemsUserDescription"><?php echo $user->profile->description; ?></p>
				<?php endif; ?>
	
				<?php if ($this->params->get('userURL') || $this->params->get('userEmail')): ?>
				<p class="latestItemsUserAdditionalInfo">
					<?php if ($this->params->get('userURL') && isset($user->profile->url)): ?>
					<span class="latestItemsUserURL">
						<?php echo JText::_('K2_WEBSITE_URL'); ?>: <a rel="me" href="<?php echo $user->profile->url; ?>" target="_blank"><?php echo $user->profile->url; ?></a>
					</span>
					<?php endif; ?>
					<br />
					<?php if ($this->params->get('userEmail')): ?>
					<span class="latestItemsUserEmail">
						<?php echo JText::_('K2_EMAIL'); ?>: <?php echo JHTML::_('Email.cloak', $user->email); ?>
					</span>
					<?php endif; ?>
				</p>
				<?php endif; ?>
				
			<?php if($this->params->get('latestItemsCols') == "1") { ?>
			</div>
			<?php } ?>
			<div class="clear"></div>
	
			<?php echo $user->event->K2UserDisplay; ?>
		</div>
			<div class="clear"></div>
		<!-- End K2 User block -->
		<?php endif; ?>
		
		<?php endif; ?>
		
		<div class="clear"></div>
		<!-- Start Items list -->
		<div class="latestItemList">
			
		<?php if($this->params->get('latestItemsDisplayEffect')=="first"): ?>
	
			<?php foreach ($block->items as $itemCounter=>$item): K2HelperUtilities::setDefaultImage($item, 'latest', $this->params); ?>
			<?php if($itemCounter==0): ?>
			<?php $this->item=$item; echo $this->loadTemplate('item'); ?>
			<?php else: ?>
		  <h2 class="latestItemTitleList">
		  	<?php if ($item->params->get('latestItemTitleLinked')): ?>
				<a href="<?php echo $item->link; ?>">
		  		<?php echo $item->title; ?>
		  	</a>
		  	<?php else: ?>
		  	<?php echo $item->title; ?>
		  	<?php endif; ?>
		  </h2>
			<?php endif; ?>
			<?php endforeach; ?>
	
		<?php else: ?>
	
			<?php foreach ($block->items as $item): K2HelperUtilities::setDefaultImage($item, 'latest', $this->params); ?>
			<?php $this->item=$item; echo $this->loadTemplate('item'); ?>
			<?php endforeach; ?>
	
		<?php endif; ?>
		</div>
		<!-- End Item list -->

	</div>

	<?php if(($key+1)%($this->params->get('latestItemsCols'))==0): ?>
	<div class="clear"></div>
	<?php endif; ?>

	<?php endforeach; ?>
	<div class="clear"></div>
</div>
<!-- End K2 Latest Layout -->
