<?php
/**
 * @version		$Id: category.php 569 2010-09-23 12:50:28Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');
$doc = JFactory::getDocument();
$app = JFactory::getApplication();

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

// Load the Slideshow Scripts.
$doc->addStyleSheet($template.'/html/com_k2/media/slideshow/flexslider.css', 'text/css', 'screen');
$doc->addScript( $template.'/html/com_k2/media/slideshow/jquery.flexslider-min.js');


?>
<!-- Start K2 Category Layout -->
<div id = "zenkit" class="itemListView slideshow<?php if($this->params->get('pageclass_sfx')) echo ' '.$this->params->get('pageclass_sfx'); ?>">

	<?php if($this->params->get('show_page_title')): ?>
	<!-- Page title -->
	<h1 class="componentheading <?php echo $this->params->get('pageclass_sfx')?>">
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</h1>
	<?php endif; ?>

	<?php if($this->params->get('catFeedLink')): ?>
	<!-- RSS feed icon -->
	<div class="k2FeedIcon">
		<a href="<?php echo $this->feed; ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>">
		</a>
		<div class="clear"></div>
	</div>
	<?php endif; ?>

	<?php if(isset($this->category) || ( $this->params->get('subCategories') && isset($this->subCategories) && count($this->subCategories) )): ?>
	<!-- Blocks for current category and subcategories -->
	<div class="k2CategoriesBlock">

		<?php if(isset($this->category) && ( $this->params->get('catImage') || $this->params->get('catTitle') || $this->params->get('catDescription') || $this->category->event->K2CategoryDisplay )): ?>
		<!-- Category block -->
		<div class="itemListCategory">

			<?php if(isset($this->addLink)): ?>
			<!-- Item add link -->
			<span class="k2AddLink">
				<a class="modal" rel="{handler:'iframe',size:{x:990,y:650}}" href="<?php echo $this->addLink; ?>">
					<?php echo JText::_('K2_ADD_A_NEW_ITEM_IN_THIS_CATEGORY'); ?>
				</a>
			</span>
			<?php endif; ?>

			<?php if($this->params->get('catImage') && $this->category->image): ?>
			<!-- Category image -->
			<img alt="<?php echo $this->category->name; ?>" src="<?php echo $this->category->image; ?>" style="width:<?php echo $this->params->get('catImageWidth'); ?>px; height:auto;" />
			<?php endif; ?>

			<?php if($this->params->get('catTitle')): ?>
			<!-- Category title -->
			<h2><?php echo $this->category->name; ?><?php if($this->params->get('catTitleItemCounter')) echo ' ('.$this->pagination->total.')'; ?></h2>
			<?php endif; ?>

			<?php if($this->params->get('catDescription')): ?>
			<!-- Category description -->
			<?php echo $this->category->description; ?>
			<?php endif; ?>

			<!-- K2 Plugins: K2CategoryDisplay -->
			<?php echo $this->category->event->K2CategoryDisplay; ?>

			<div class="clear"></div>
		</div>
		<?php endif; ?>

		<?php if($this->params->get('subCategories') && isset($this->subCategories) && count($this->subCategories)): ?>
		<!-- Subcategories -->
		<div class="k2SubCategories">
			<h2><?php echo JText::_('K2_CHILDREN_CATEGORIES'); ?></h2>

			<?php foreach($this->subCategories as $key=>$subCategory): ?>

			<?php
			// Define a CSS class for the last container on each row
			if( (($key+1)%($this->params->get('subCatColumns'))==0) || count($this->subCategories)<$this->params->get('subCatColumns') )
				$lastContainer= ' subCategoryContainerLast';
			else
				$lastContainer='';
			?>

			<div class="subCategoryContainer<?php echo $lastContainer; ?>"<?php echo (count($this->subCategories)== 1) ? '' : ' style="width:'.number_format((100/$this->params->get('subCatColumns') - 1), 1).'%;"'; ?>>
				<div class="subCategory">
					<?php if($this->params->get('subCatImage') && $subCategory->image): ?>
					<!-- Subcategory image -->
					<a class="subCategoryImage" href="<?php echo $subCategory->link; ?>">
						<img alt="<?php echo $subCategory->name; ?>" src="<?php echo $subCategory->image; ?>" />
					</a>
					<?php endif; ?>

					<?php if($this->params->get('subCatTitle')): ?>
					<!-- Subcategory title -->
					<h3>
						<a href="<?php echo $subCategory->link; ?>">
							<?php echo $subCategory->name; ?><?php if($this->params->get('subCatTitleItemCounter')) echo ' ('.$subCategory->numOfItems.')'; ?>
						</a>
					</h3>
					<?php endif; ?>

					<?php if($this->params->get('subCatDescription')): ?>
					<!-- Subcategory description -->
					<?php echo $subCategory->description; ?>
					<?php endif; ?>

					<!-- Subcategory more... -->
					<a class="subCategoryMore" href="<?php echo $subCategory->link; ?>">
						<?php echo JText::_('K2_VIEW_ITEMS'); ?>
					</a>

					<div class="clear"></div>
				</div>
			</div>
			<?php if(($key+1)%($this->params->get('subCatColumns'))==0): ?>
			<div class="clear"></div>
			<?php endif; ?>
			<?php endforeach; ?>

			<div class="clear"></div>
		</div>
		<?php endif; ?>

	</div>
	<?php endif; ?>

	<?php if((isset($this->leading) || isset($this->primary) || isset($this->secondary) || isset($this->links)) && (count($this->leading) || count($this->primary) || count($this->secondary) || count($this->links))): ?>
	<!-- Item list -->
	<div class="k2ItemList">

		<?php if(isset($this->leading) && count($this->leading)): ?>
		<!-- Leading items -->
		<?php if(isset($this->primary) && count($this->primary)) { ?>
		<div class="grid_nine">
			<?php } else { ?>
				<div class="grid_twelve">
					<?php } ?>
				<div id="k2ItemListLeading">
					<div class="flexslider">
				    	<ul class="slides">
		    		
								<?php foreach($this->leading as $key=>$item): ?>
									<li>
								<?php
								// Define a CSS class for the last container on each row
								if( (($key+1)%($this->params->get('num_leading_columns'))==0) || count($this->leading)<$this->params->get('num_leading_columns') )
									$lastContainer= ' zenlast';
								else
									$lastContainer='';
								?>
			
								<div class="k2ItemContainer<?php echo $lastContainer; ?> grid_<?php echo number_format($this->params->get('num_leading_columns')) ?>">
									<?php
										// Load category_item.php by default
										$this->item=$item;
										echo $this->loadTemplate('item');
									?>
								</div>
								<?php if(($key+1)%($this->params->get('num_leading_columns'))==0): ?>
								<div class="clear"></div>
								<?php endif; ?>
								</li>
								<?php endforeach; ?>
								<div class="clear"></div>
					
						</ul>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php if(isset($this->primary) && count($this->primary)): ?>
		<!-- Primary items -->
		<div class="grid_three zenlast">
		<div id="k2ItemListPrimary">
			<?php foreach($this->primary as $key=>$item): ?>
			
					<?php
					// Define a CSS class for the last container on each row
					if( (($key+1)%($this->params->get('num_primary_columns'))==0) || count($this->primary)<$this->params->get('num_primary_columns') )
						$lastContainer= ' zenlast';
					else
						$lastContainer='';

					if($key==0) {
						$firstitem = 'firstitem';
					}
					else {
						$firstitem = '';
					}
					?>
			
		<div class="k2ItemContainer<?php echo $lastContainer; ?> <?php echo $firstitem; ?> grid_<?php echo number_format($this->params->get('num_primary_columns')) ?>">
				<?php
					// Load category_item.php by default
					$this->item=$item;
					echo $this->loadTemplate('item');
				?>
			</div>
			<?php if(($key+1)%($this->params->get('num_primary_columns'))==0): ?>
			<div class="clear"></div>
			<?php endif; ?>
			<?php endforeach; ?>
			<div class="clear"></div>
		</div>
		</div>
		<div class="clear"></div>
		<?php endif; ?>

		<?php if(isset($this->secondary) && count($this->secondary)): ?>
		<!-- Secondary items -->
		<div id="k2ItemListSecondary">
			<?php foreach($this->secondary as $key=>$item): ?>
			
			<?php
			// Define a CSS class for the last container on each row
			if( (($key+1)%($this->params->get('num_secondary_columns'))==0))
				$lastContainer= ' zenlast';
			else
				$lastContainer='';
			?>
			
			<div class="k2ItemContainer<?php echo $lastContainer; ?> grid_<?php echo number_format($this->params->get('num_secondary_columns')) ?>">
				<?php
					// Load category_item.php by default
					$this->item=$item;
					echo $this->loadTemplate('item');
				?>
			</div>
			<?php if(($key+1)%($this->params->get('num_secondary_columns'))==0): ?>
			<div class="clear"></div>
			<?php endif; ?>
			<?php endforeach; ?>
			<div class="clear"></div>
		</div>
		<?php endif; ?>

			<?php if(isset($this->links) && count($this->links)): ?>
			<!-- Link items -->
			<div id="k2Links">
				<h4><?php echo JText::_('K2_MORE'); ?></h4>
				<ul>
				<?php foreach($this->links as $key=>$item): ?>
				<li>
				<?php
				// Define a CSS class for the last container on each row
				if( (($key+1)%($this->params->get('num_links_columns'))==0) || count($this->links)<$this->params->get('num_links_columns') )
					$lastContainer= ' zenlast';
				else
					$lastContainer='';
				?>

				<div class="k2ItemContainer<?php echo $lastContainer; ?>"<?php echo (count($this->links)==1) ? '' : ' style="width:'.number_format(100/$this->params->get('num_links_columns'), 1).'%;"'; ?>>
					<?php
						// Load category_item_links.php by default
						$this->item=$item;
						echo $this->loadTemplate('item_links');
					?>
				</div>
				<?php if(($key+1)%($this->params->get('num_links_columns'))==0): ?>
				<div class="clear"></div>
				<?php endif; ?>
				</li>
				<?php endforeach; ?>
				</ul>
				<div class="clear"></div>
			</div>
			<?php endif; ?>

	</div>

	<!-- Pagination -->
	<?php if(count($this->pagination->getPagesLinks())): ?>
	<div class="k2Pagination">
		<?php if($this->params->get('catPagination')) echo $this->pagination->getPagesLinks(); ?>
		<div class="clear"></div>
		<?php if($this->params->get('catPaginationResults')) echo $this->pagination->getPagesCounter(); ?>
	</div>
	<?php endif; ?>

	<?php endif; ?>
</div>
<!-- End K2 Category Layout -->

<script type="text/javascript">
	jQuery(window).load(function() {
		jQuery('.flexslider').flexslider({
			animation: "fade",              //String: Select your animation type, "fade" or "slide"
			slideDirection: "horizontal",   //String: Select the sliding direction, "horizontal" or "vertical"
			slideshow: true,                //Boolean: Animate slider automatically
			slideshowSpeed: 7000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
			animationDuration: 600,         //Integer: Set the speed of animations, in milliseconds
			directionNav: true,             //Boolean: Create navigation for previous/next navigation? (true/false)
			controlNav: true,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
			keyboardNav: true,              //Boolean: Allow slider navigating via keyboard left/right keys
			mousewheel: false,              //Boolean: Allow slider navigating via mousewheel
			prevText: "Previous",           //String: Set the text for the "previous" directionNav item
			nextText: "Next",               //String: Set the text for the "next" directionNav item
			pausePlay: false,               //Boolean: Create pause/play dynamic element
			pauseText: 'Pause',             //String: Set the text for the "pause" pausePlay item
			playText: 'Play',               //String: Set the text for the "play" pausePlay item
			randomize: false,               //Boolean: Randomize slide order
			slideToStart: 0,                //Integer: The slide that the slider should start on. Array notation (0 = first slide)
			animationLoop: true,            //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
			pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
			pauseOnHover: false
		});
		
		<?php if($this->params->get('pageclass_sfx')==" accordion") {?>
					jQuery('#zenkit.accordion #k2ItemListPrimary .contentheading').click(function() {
						jQuery('#zenkit.accordion #k2ItemListPrimary .accordionbody,#zenkit h2').removeClass('open');
						jQuery('#zenkit.accordion #k2ItemListPrimary .accordionbody').slideUp(300);

						if(jQuery(this).next().is(':hidden') == true) {
							jQuery(this).addClass('open');
							jQuery(this).next().animate({
							    height: 'toggle'
							});
						 } 
						return false;

					 });
					jQuery('#zenkit.accordion #k2ItemListPrimary .accordionbody').hide();
					jQuery('#zenkit.accordion #k2ItemListPrimary .firstitem h2').addClass('open');
					jQuery('#zenkit.accordion #k2ItemListPrimary .firstitem .accordionbody').slideDown();
		<?php } ?>
	});
</script>