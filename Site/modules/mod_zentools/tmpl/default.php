<?php
/**
 * @package		Zentools
 * @version		v1.1
 * @author		Joomlabamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2012 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

defined('_JEXEC') or die('Restricted access'); 

// View Parameters
$masonryColumnWidth = $params->get('masonryColumnWidth');
$masonryGutter = $params->get('masonryGutter');
$masonryWidths = $params->get('masonryWidths');
$masonryColWidths = $params->get('masonryColWidths');
$browserThreshold = $params->get('browserThreshold');
$border = $params->get('imageEffect');
$slideshowTheme = $params->get('slideshowTheme');
$slideTrigger = $params->get('slideshowPaginationType','thumb');

// Lightbox
$modalVideo = $params->get('modalVideo');
$modalFullText = $params->get('modalFullText');
$modaltitle = $params->get('modaltitle');

// Place Holder Image
$usePlaceholder = $params->get('usePlaceholder', 0);
$placeHolderImage = $params->get('placeHolderImage');

$slideCountSep = $params->get('slideCountSep');
$slideCount = $params->get('slideCount');


// Set the default path for the placeholder image 
if (substr(JVERSION, 0, 3) >= '1.6') {
	$imagesPath = 'images/';
}
else {
	$imagesPath = 'images/stories/';
}

if (substr(JVERSION, 0, 3) >= '2.5') {
	$joomla25 = 1;
	$altlink = $params->get('altlink');
}
else {
	$joomla25 = 0;
	$altlink = 0;
}

// Grid Layout
$disableMargin = $params->get('disableMargin');


// Images
$imageFade= $params->get('imageFade', 0);

// Logic for applying zenlast class to the last column.
$lastcolumn2 = false;
$lastcolumn3 = false;
$column2 = false;
$column3 = false;
$column4 = false;



	if($elements) {
		$enabled  = 1;
		$displayitems = explode(",", $elements);
		
		if(array_search('column2', $displayitems) !== false){	$column2 = 1;}
		if(array_search('column3', $displayitems) !== false){	$column3 = 1;}
		if(array_search('column4', $displayitems) !== false){	$column4 = 1;}
		
		if(!$column4 && !$column3) {$lastcolumn2 = "zenlast";}
		if(!$column4) {$lastcolumn3 = "zenlast";}


		// Remove non-image as directory options from array
		if($contentSource =="1") {
			if(array_search('extrafields', $displayitems) !== false){
				unset($displayitems[array_search('extrafields',$displayitems)]);
			}
			if(array_search('comments', $displayitems) !== false){
				unset($displayitems[array_search('comments',$displayitems)]);
			}
			if(array_search('attachments', $displayitems) !== false){
				unset($displayitems[array_search('attachments',$displayitems)]);
			}
			if(array_search('video', $displayitems) !== false){
				unset($displayitems[array_search('video',$displayitems)]);
			}
			if(array_search('date', $displayitems) !== false){
				unset($displayitems[array_search('video',$displayitems)]);
			}
			if(array_search('category', $displayitems) !== false){
				unset($displayitems[array_search('category',$displayitems)]);
			}
			// Resets the array
			$displayitems = array_values($displayitems);
		}
	
		
		// Remove k2 items from the array if content as a source
		if($contentSource =="2") {
			
			if(array_search('extrafields', $displayitems) !== false){
				unset($displayitems[array_search('extrafields',$displayitems)]);
				
			}
			
			if(array_search('comments', $displayitems)!== false){
				unset($displayitems[array_search('comments',$displayitems)]);
			}
			
			if(array_search('video', $displayitems) !== false){
				unset($displayitems[array_search('video',$displayitems)]);
			}
			//print_r($displayitems);
			
			// Resets the array
			$displayitems = array_values($displayitems);
	
		}		
		
		$countElements = count($displayitems);
	}
	else {
		echo "<div class='notice'>No content assigned to be displayed.</div>";
		$enabled = 0;
	}
	if($link !==0) {
		$closelink ="</a>";
	}
	$catlinkclose ="</a>";
	$readmoreclose ="</span></a>";
	
		
	// Params for column markup in the module
	if(!$column2 && !$column3 && !$column4) {
		$column1col = "twelve";
	}
	else {
		$column1col = $params->get('col1Width');
	}
	$column2col = $params->get('col2Width');
	$column3col = $params->get('col3Width');
	$column4col = $params->get('col4Width');
	
	$column2Markup="</div><div class='column2 grid_$column2col $lastcolumn2'>";
	$column3Markup="</div><div class='column3 grid_$column3col $lastcolumn3'>";
	$column4Markup="</div><div class='column4 grid_$column4col zenlast'>";
	
	
	// Null some of the item variables
	$titleMarkup = false;
	$textMarkup = false;					
	$imageMarkup = false;
	
	$numMB = sizeof($list);
	
	if($enabled) { 
		
		/**
		* 
		* Filter triggerLoop
		* 
		**/ 
		
			if($categoryFilter && ($layout == "grid" or $layout =="list")) {
			?>


			<ul id="filters">
				<li><a href="#" class="active" data-filter="*">Show all</a></li>
					<?php 

						foreach($list as $key => $item) : 
						$replace=array(" ","'",".","/","-","&","%","*","#","_","+","=","(",")");
						$item->catname = strtolower(str_replace($replace, '', $item->category));
						?>
			  			<li><a href="#" data-filter=".<?php echo $item->catname ?>"><?php echo $item->category ?></a></li>
					<?php endforeach; ?>
			</ul>
			<?php } ?>
		
		<div id="zentools<?php echo $moduleID ?>" class="<?php if($layout=="slideshow") { ?>slideshow slideshow<?php echo $slideshowTheme; } ?> <?php if($layout=="carousel") {?>es-carousel-wrapper<?php } ?>">
			<div class="zentools <?php echo $layout ?> <?php if($layout=="slideshow") {?>flexslider<?php } ?> <?php echo $border ?> count<?php echo $countElements ?> <?php if($layout == "carousel") { ?>es-carousel<?php } ?><?php if($layout == "grid" && $disableMargin) {?> nomargin<?php }?><?php if(($layout == "grid" && $overlayGrid) || ($layout == "carousel" && $overlayCarousel)) {?> overlay<?php }?>">
				<ul id="zentoolslist<?php echo $moduleID ?>"  <?php if($layout=="slideshow") {?>class="slides"<?php } ?>>	
					
					<?php 
					if (is_array($list)) { 
						
						foreach($list as $key => $item) :
						
							$item->cleantitle = $item->title;
										
							/**
							* 
							* Read More
							* 
							**/

							if($link==1){
								if($altlink && $item->newlink && $joomla25) {
									$item->more = '<a rel="group3" class="iframe"'.$item->altlink.'><span class="readon">'.$params->get('readonText').$readmoreclose;
								}
								else {
									$item->more = '<a rel="group3" class="inline"'.$item->link.'><span class="readon">'.$params->get('readonText').$readmoreclose;
								}
							}
							elseif($link==2) {
								if($altlink && isset($item->altlink) && $joomla25) {
									$item->more = '<a class="inline" '.$item->altlink.'><span class="readon">'.$params->get('readonText').$readmoreclose;
								}
								else {
									$item->more = '<a '.$item->link.'><span class="readon">'.$params->get('readonText').$readmoreclose;
								}
								
							}
							else {
								$item->more = false;
							}
							
							
							/**
							* 
							* Slideshow links
							* 
							**/
							
								if($layout=="slideshow") {
									if($slideTrigger=="thumb"){
										if($item->image !=="") {
											$item->trigger = '<img src="'.$item->thumb.'" alt="'.$item->cleantitle.'" title="'.$item->title.'"/>';
										}
										else {
											$item->trigger = '<img src="'.resizeImageHelper::getResizedImage('modules/mod_zentools/images/placeholder.jpg', $thumb_width, $thumb_height, $option).'" alt="image"  title="'.$item->title.'"/>';
										}
									}
									elseif($slideTrigger=="title"){
										$item->trigger = '<'.$titleClass.'>'.$item->title.'</'.$titleClass.'>';
									}
									elseif($slideTrigger=="numbers" || $slideTrigger=="discs"){
										$item->trigger = $key+1;
									}
									else {
										$item->trigger = false;
									}
								}
								

							/**
							* 
							* Title and Link
							* 
							**/
							
							if ($params->get('renderPlugin') == 'render'){
								if (substr(JVERSION, 0, 3) >= '1.6') {
										$item->title = JHtml::_('content.prepare', $item->title);
								} else {
									$plgparams 	   =& $mainframe->getParams('com_content');	
									$dispatcher	   =& JDispatcher::getInstance();
									JPluginHelper::importPlugin('content');
									$results = $dispatcher->trigger('onPrepareContent', array (& $item, & $plgparams));
									$results = $dispatcher->trigger('onPrepareContent', array (& $item, & $plgparams));
									$item->title = $item->title;
								}
							} else {
									$item->title = preg_replace('/{([a-zA-Z0-9\-_]*)\s*(.*?)}/i','', $item->title);

							}
							
							// Clean title for image titles etc
							$item->cleantitle = preg_replace('/{([a-zA-Z0-9\-_]*)\s*(.*?)}/i','', $item->title);
							
							
								
							if(($layout == "accordion") && ($displayitems[0] == "title")) { 
								$item->title = '<'.$titleClass.'>'.$item->title.'</'.$titleClass.'>';
							}
							else {
								if($link==1){
									$item->title = '<'.$titleClass.'><a rel="group2" class="inline" '.$item->link.'>'.$item->title.$closelink.'</'.$titleClass.'>';
								}
								elseif($link==2){
									if($altlink && isset($item->altlink) && $joomla25) {
										$item->title = '<'.$titleClass.'><a '.$item->altlink.'>'.$item->title.$closelink.'</'.$titleClass.'>';
									}
									else {
										$item->title = '<'.$titleClass.'><a '.$item->link.'>'.$item->title.$closelink.'</'.$titleClass.'>';
									}
								}
								else {
									$item->title = '<'.$titleClass.'>'.$item->title.'</'.$titleClass.'>';
								}
							}
							
							if($contentSource == "1") {
								$item->id = $key;
							}
								
								
											
							
							/**
							* 
							* Image and Link
							* 
							**/
							
							if($item->image !=="") {
								if($imagesreplace && isset($item->video) && $contentSource == 3) {
									$item->image = '<div class="video-container"><div class="zenvideo">'.$item->video.'</div></div>';
									$typeclass = "video";
								}
								else {
									if($link==1){
										$item->image = '<a rel="group1" class="inline" '.$item->link.'><img src="'.$item->image.'" alt="'.$item->image.'" title="'.$item->cleantitle.'"/>'.$closelink;
									}
									elseif($link==2) {
										if($altlink && isset($item->altlink) && $joomla25) {
											$item->image = '<a '.$item->altlink.'><img src="'.$item->image.'" alt="'.$item->cleantitle.'" title="'.$item->cleantitle.'"/>'.$closelink;
										}
										else {
											$item->image = '<a '.$item->link.'><img src="'.$item->image.'" alt="'.$item->cleantitle.'" title="'.$item->cleantitle.'"/>'.$closelink;
										}
									}
									else {
										$item->image = '<img src="'.$item->image.'" alt="'.$item->cleantitle.'" title="'.$item->cleantitle.'"/>';
									}
									$typeclass = "text";
								}
							}
							else {
								if($usePlaceholder) {
									if($link==1){
										$item->image = '<a rel="group1" class="inline"'.$item->link.'><img src="'.resizeImageHelper::getResizedImage(''.$imagesPath.$placeHolderImage.'', $image_width, $image_height,  $option).'" alt="'.$item->cleantitle.'" title="'.$item->cleantitle.'"/>'.$closelink;
									}
									else {
										$item->image = '<a '.$item->link.'><img src="'.resizeImageHelper::getResizedImage(''.$imagesPath.$placeHolderImage.'', $image_width, $image_height,  $option).'" alt="'.$item->cleantitle.'" title="'.$item->cleantitle.'"/>'.$closelink;
									}	
								}
								else {
									$item->image = "";
								}
							}



							/**
							* 
							* Category and Link
							* 
							**/
							
							$item->catname = strtolower(str_replace(' ', '', $item->category));
							if(($layout == "accordion") && ($displayitems[0] == "category") or ($layout == "grid")) { 
								$item->category = $item->category;
							}
							else {
								$item->category = $item->catlink.$item->category.$catlinkclose;
							}
					
							// Adds zenlast to the last item in the row
							$lastitem = ($key == ($numMB -1)) ? "zenlast" : "";
					
							// Assigns the last image in the row to have 0 margin		
							$imageNumber++;
					
							$rowFlag = ($imageNumber % $imagesPerRow) ? 0 : 1;
					
							if($contentSource =="3") {
								// K2 Extra fields
								if(is_array($item->extrafields)) {
									foreach ($item->extrafields as $extraField): 
										$item->extrafields = $extraField->value;
							    		endforeach; 
									}
							}
														
							
							if($contentSource !=="1") {
								$meta = explode(" ", $item->metakey);
							}		
							if($layout == "masonry") {
								if($masonryWidths && $contentSource !=="1") {
									$gridclass = $meta[0];
								}
								else {
									$gridclass = $masonryColWidths;
								}
							}
							elseif($layout == "list" || $layout == "accordion" || $layout =="slideshow"|| $layout =="carousel") {
								$gridclass="twelve";
							}
							
							
							/*
							* Process the prepare content plugins
							*/
							
							if ($params->get('renderPlugin') == 'render'){
								if (substr(JVERSION, 0, 3) >= '1.6') {
										$item->text = JHtml::_('content.prepare', $item->text);
								} else {
									$plgparams 	   =& $mainframe->getParams('com_content');	
									$dispatcher	   =& JDispatcher::getInstance();
									JPluginHelper::importPlugin('content');
									$results = $dispatcher->trigger('onPrepareContent', array (& $item, & $plgparams));
									$results = $dispatcher->trigger('onPrepareContent', array (& $item, & $plgparams));
									$item->text = $item->text;
								}
							} else {
									$item->text = preg_replace('/{([a-zA-Z0-9\-_]*)\s*(.*?)}/i','', $item->text);

							}
								

							// Leading then title view. Basically nulls the elements for all items after the first one	
							if($layout =="leading") {
								if($key !==0){$item->image = $item ->category = $item->text = $item->more = $item->date ="";}
							}
								
								
							?>
							
					<li class="grid_<?php echo $gridclass; ?> element <?php if($categoryFilter && ($layout == "grid" or $layout =="list")) { echo strtolower(str_replace($replace, '', $item->catname)); }?> <?php if($rowFlag) { echo "zenlast"; } ?>">		
							<div class="zenitem zenitem<?php echo $key + 1; ?> <?php if($item->featured) { echo "featured"; } ?> <?php echo $displayitems[0]; ?>">
								<div class="zeninner">
															
									<div class="column grid_<?php echo $column1col; ?>">
										<?php if(count($displayitems) > 0)  {?>
											<div class="zen<?php echo $displayitems[0]; ?> element1 firstitem"><?php echo $item->$displayitems[0]; ?></div>
										<?php } ?>
										
										<?php if($layout == "accordion" || ($layout =="slideshow" && $slideshowTheme == "overlay") || ($layout =="slideshow" && $slideshowTheme == "overlayFrame") || ($layout == "grid" && $overlayGrid) || ($layout == "carousel" && $overlayCarousel)) {?>
											<div class="allitems <?php echo $typeclass ?> container"><div>
										<?php } ?>
											<?php if(count($displayitems) > 1)  {
												if($displayitems[1] == "column2" || $displayitems[1] == "column3"  || $displayitems[1] ==  "column4") {echo ${$displayitems[1].'Markup'}; } else {	?>
												<div class="zen<?php echo $displayitems[1]; ?> element2"><?php echo $item->$displayitems[1]; ?></div>										
											<?php } } ?>
					
											<?php if(count($displayitems) > 2)  {
												
												if($displayitems[2] == "column2" || $displayitems[2] == "column3"  || $displayitems[2] ==  "column4") {echo ${$displayitems[2].'Markup'};} else {	?>
												<div class="zen<?php echo $displayitems[2]; ?> element3"><?php echo $item->$displayitems[2]; ?></div>
											<?php } }?>
					
											<?php if(count($displayitems) > 3)  {
												if($displayitems[3] == "column2" || $displayitems[3] == "column3"  || $displayitems[3] ==  "column4") {echo ${$displayitems[3].'Markup'};} else {	?>
												<div class="zen<?php echo $displayitems[3]; ?> element4"><?php echo $item->$displayitems[3]; ?></div>
											<?php } } ?>
					
											<?php if(count($displayitems) > 4)  {
												if($displayitems[4] == "column2" || $displayitems[4] == "column3"  || $displayitems[4] ==  "column4") {echo ${$displayitems[4].'Markup'};} else {	?>
												<div class="zen<?php echo $displayitems[4]; ?> element5"><?php echo $item->$displayitems[4]; ?></div>
											<?php } }?>
					
											<?php if(count($displayitems) > 5)  {
												if($displayitems[5] == "column2" || $displayitems[5] == "column3"  || $displayitems[5] ==  "column4") {echo ${$displayitems[5].'Markup'};} else {	?>
												<div class="zen<?php echo $displayitems[5]; ?> element6"><?php echo $item->$displayitems[5]; ?></div>
											<?php } } ?>
					
											<?php if(count($displayitems) > 6)  {
												if($displayitems[6] == "column2" || $displayitems[6] == "column3"  || $displayitems[6] ==  "column4") {echo ${$displayitems[6].'Markup'};} else {	?>
												<div class="zen<?php echo $displayitems[6]; ?> element7"><?php echo $item->$displayitems[6]; ?></div>
											<?php } } ?>
					
											<?php if(count($displayitems) > 7)  {
												if($displayitems[7] == "column2" || $displayitems[7] == "column3"  || $displayitems[7] ==  "column4") {echo ${$displayitems[7].'Markup'};} else {	?>
												<div class="zen<?php echo $displayitems[7]; ?> element8"><?php echo $item->$displayitems[7]; ?></div>
											<?php } } ?>
					
											<?php if(count($displayitems) > 8)  {
												if($displayitems[8] == "column2" || $displayitems[8] == "column3"  || $displayitems[8] ==  "column4") {echo ${$displayitems[8].'Markup'};} else {	?>
												<div class="zen<?php echo $displayitems[8]; ?> element9"><?php echo $item->$displayitems[8]; ?></div>
											<?php } } ?>
					
											<?php if(count($displayitems) > 9)  {
												if($displayitems[9] == "column2" || $displayitems[9] == "column3"  || $displayitems[9] ==  "column4") {echo ${$displayitems[9].'Markup'};} else {	?>
												<div class="zen<?php echo $displayitems[9]; ?> element10"><?php echo $item->$displayitems[9]; ?></div>
											<?php } }?>
										
											<?php if($layout == "accordion" || ($layout =="slideshow" && $slideshowTheme == "overlay") || ($layout =="slideshow" && $slideshowTheme == "overlayFrame") || ($layout == "grid" && $overlayGrid) || ($layout == "carousel" && $overlayCarousel)) {?>
											</div></div>
										<?php } ?>
									</div>
									<div class="clear"></div>
								</div>
							</div>
					
						<?php if($link == 1) {?>

							<div style="display:none">
								<div id="data<?php echo $item->id ?>">
									<?php if($item->image !=="" || $item->modalimage !=="") {
											if($modalImage) { ?>
												<img src="<?php echo $item->modalimage; ?>" alt="<?php echo $item->modaltitle ?>" />
									<?php 	}
								 		} ?>
									<?php if($modalTitle) { ?>
										<?php echo '<h2>'.$item->modaltitle.'</h2>'; ?>
									<?php } ?>
										<?php if($modalVideo && $contentSource == 3) { ?>
											<?php if($item->video !=="") { echo $item->video; }?>
										<?php } ?>
									<?php if($modalText) { ?>
										<?php echo $item->modaltext; ?>
									<?php } ?>
									<?php //if($modalFullText) { ?>
										<?php // echo $item->fulltext; ?>
									<?php //} ?>
									
								</div>
							</div>
						<?php } ?>					
					</li>
						<?php 
							if($rowFlag && ($layout =="grid") or ($layout =="leading")) { ?><li class="clear"></li>
						<?php } ?>
					<?php endforeach; 
				} else {
					echo "<div class='notice'>No content assigned to be displayed.</div>";
				}?>
			
				</ul>
				
				<?php if($layout=="slideshow") {?>
					<div class="slide-controller">
						<div class="slidenav<?php echo $slideTrigger ?> slidenav<?php echo $moduleID ?>">
							<?php $numMB = sizeof($list);
								if($numMB > 1) { ?>
									<ul class="slidenav">
										<?php foreach($list as $key => $item) :
											echo '<li>';
											echo '<span>';
								  			echo $item->trigger;
											echo '</span>';
											echo '</li>';
											endforeach; ?>
									</ul>
								<?php } 
							if($slideCount) {?>
							<div class="slidecount">
								<span class="current-slide"></span> 
								<span class="slide-count-sep"><?php echo $slideCountSep ?></span>
								<span class="total-slides"></span>
							</div>
							<?php } ?>
						</div>
					</div>
					<div class="clear"></div>
				<?php } ?>
		</div>
	</div>

	<?php // Scripts if cache is on 
	if($scripts) {
		//if(!$zgf) {
			if($cache){ ?>
	
				<link rel="stylesheet" href="<?php echo $modbase?>css/zentools.css" type="text/css" />
				<?php if(!$zgf) { ?>
				<link rel="stylesheet" href="<?php echo $modbase?>css/grid.css" type="text/css" />
				<?php } ?>

				<?php if ($link == 1){ 
					$zoomClass .= $moduleID; 
				?>
					<link rel="stylesheet" href="<?php echo $modbase?>js/jquery.fancybox/jquery.fancybox-1.3.4.css" type="text/css" />
					<script type="text/javascript" src="<?php echo $modbase?>js/jquery.fancybox/jquery.fancybox-1.3.4.pack.js"></script>
				<?php } 

				if($layout == "slideshow") { ?>
					<link rel="stylesheet" href="<?php echo $modbase?>css/flexslider.css" type="text/css" />
					<script type="text/javascript" src="<?php echo $modbase?>js/jquery.flexslider-min.js"></script>
				<?php } 

				if($layout == "masonry") { ?>
					<script type="text/javascript" src="<?php echo $modbase?>js/jquery.masonry.js"></script>
				<?php } 

				if($layout == "twitter") { ?>
					<script type="text/javascript" src="<?php echo $modbase?>js/jquery.tweet.js"></script>
				<?php } 

				if($layout == "carousel") { ?>
					<link rel="stylesheet" href="<?php echo $modbase?>css/elastislide.css" type="text/css" />
					<script type="text/javascript" src="<?php echo $modbase?>js/jquery.elastislide.js"></script>
				<?php } 
				
				if($categoryFilter && ($layout == "grid" or $layout =="list")) { ?>
					<script type="text/javascript" src="<?php echo $modbase?>js/jquery.isotope.min.js"></script>
				<?php }
			}
			//}
	}
	
	
	 if($layout == "slideshow") { 
		$slideshowAuto = $params->get('slideshowAuto');
		$slideshowNav = $params->get('slideshowNav');
		$slideshowLoop = $params->get('slideshowLoop');
		$slideshowPagination = $params->get('slideshowPagination');
		$slideshowPause = $params->get('slideshowPause');
		$slideshowSpeed = $params->get('slideshowSpeed');
		$slideshowDuration = $params->get('slideshowDuration');
		$transition = $params->get('transition','slide');
		$pauseText = $params->get('pauseText','');
		$playText = $params->get('playText','');
		$overlayAnimation = $params->get('overlayAnimation','');
	
		?>
		
		<script type="text/javascript" charset="utf-8">
		  jQuery(window).load(function() {
		    jQuery('#zentools<?php echo $moduleID ?>').flexslider({
				animation: "<?php echo $transition ?>",              //String: Select your animation type, "fade" or "slide"
				slideDirection: "horizontal",   //String: Select the sliding direction, "horizontal" or "vertical"
				manualControls: ".slidenav<?php echo $moduleID ?> ul li", 
				<?php if($slideshowAuto) { ?>
					slideshow: true,                //Boolean: Animate slider automatically
					slideshowSpeed: <?php echo $slideshowSpeed ?>,           //Integer: Set the speed of the slideshow cycling, in milliseconds
					animationDuration: <?php echo $slideshowDuration ?>,         //Integer: Set the speed of animations, in milliseconds
				<?php } 
				else { ?>
					slideshow: false,
				<?php }
				if($slideshowNav) { ?>
					directionNav: true,             //Boolean: Create navigation for previous/next navigation? (true/false)
				<?php } else { ?>
					directionNav: false, 
				<?php } 
				if($slideshowPagination !=="none") { ?>
					controlNav: true,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
				<?php } else { ?>
					controlNav: false,  
				<?php } ?>
					keyboardNav: true,              //Boolean: Allow slider navigating via keyboard left/right keys
					mousewheel: false,              //Boolean: Allow slider navigating via mousewheel
					//prevText: "Previous",           //String: Set the text for the "previous" directionNav item
					//nextText: "Next",               //String: Set the text for the "next" directionNav item
				<?php if($slideshowPause) { ?>
					pausePlay: true,               //Boolean: Create pause/play dynamic element
					pauseText: '<?php echo $pauseText; ?>',             //String: Set the text for the "pause" pausePlay item
					playText: '<?php echo $playText; ?>',               //String: Set the text for the "play" pausePlay item
				<?php } ?>
				<?php if($slideshowPagination) { ?>
					randomize: false,               //Boolean: Randomize slide order
				<?php } ?>
					slideToStart: 0,                //Integer: The slide that the slider should start on. Array notation (0 = first slide)
				<?php if($slideshowLoop) { ?>
					animationLoop: true,            //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
				<?php } else { ?>
					animationLoop: false,
				<?php }?>

					pauseOnAction: false,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
					pauseOnHover:false,
					controlsContainer: '.slide-controller', 
					
					start: function(slider){
						jQuery('#zentools<?php echo $moduleID ?> .current-slide').text(slider.currentSlide + 1);
						jQuery('#zentools<?php echo $moduleID ?> .total-slides').text(slider.count);
					},
					
					<?php if($overlayAnimation) { ?>
					before: function(slider){
						jQuery("#zentools<?php echo $moduleID ?> .allitems.text").slideUp();
					
					},
					<?php } ?>
					after: function(slider){
						<?php if($overlayAnimation) { ?>
							jQuery("#zentools<?php echo $moduleID ?> .allitems.text").slideDown();
						<?php } ?>
							jQuery('#zentools<?php echo $moduleID ?> .current-slide').text(slider.currentSlide + 1);
					}
					
				});
			
				<?php if($overlayAnimation) { ?>
					jQuery("#zentools<?php echo $moduleID ?> .flex-control-nav a,#zentools<?php echo $moduleID ?> .flex-direction-nav a,.slidenav<?php echo $moduleID ?> ul li").click(function() {
						jQuery("#zentools<?php echo $moduleID ?> .allitems.text").slideUp();
					});
				<?php } ?>
		  });
		</script>
	<?php } ?>
		
	<?php if($layout == "masonry") { ?>
  	<script type="text/javascript">

		jQuery(document).ready(function(){
		
		
			var jQuerycontainer = jQuery('#zentoolslist<?php echo $moduleID ?>');
			
			<?php if($masonryWidths) { ?>
			jQuerycontainer.imagesLoaded( function(){
				jQuerycontainer.masonry({
					itemSelector: '#zentoolslist<?php echo $moduleID ?> li',
					isAnimated: true,
					isResizable: true,
					columnWidth: <?php echo $masonryColumnWidth ?>,
					gutterWidth: <?php echo $masonryGutter ?>
				});
			});
			<?php } 
			else { ?>
				jQuerycontainer.imagesLoaded( function(){
					jQuerycontainer.masonry({
				    	itemSelector: '#zentoolslist<?php echo $moduleID ?> li',
					  	isResizable: true,
					    isAnimated: true,
				    	columnWidth: (jQuerycontainer.width() - 15) / <?php echo $masonryColWidths; ?>
					});
				});
				
				jQuery(window).resize(function(){
					var windowsize = jQuery(window).width();
					
					if(windowsize > <?php echo $browserThreshold; ?>) {
						jQuery("#zentoolslist<?php echo $moduleID ?> li");
					  		jQuerycontainer.masonry({
								isResizable: true,
							    isAnimated: true,
					    		columnWidth: jQuerycontainer.width() / <?php echo $masonryColWidths; ?>
					  	});
					}
					else {			
	
						jQuery("#zentoolslist<?php echo $moduleID ?> li");
				  				jQuerycontainer.masonry({
								isResizable: true,
						    	isAnimated: true,
				    			columnWidth: jQuerycontainer.width() / 1
				  		});
					}
				});
			
				
			<?php } ?>
			
			jQuery('#jbToggle').click(function(){
					// We use this as a hook for templates to trigger and retrigger the masonry layout
					
						setTimeout( function() {
						var jQuerycontainer = jQuery('#zentoolslist<?php echo $moduleID ?>');

						jQuerycontainer.masonry({
					    	itemSelector: '#zentools<?php echo $moduleID ?> li',
						  	isResizable: true,
						    isAnimated: true,
							columnWidth: jQuerycontainer.width() / <?php echo $masonryColWidths; ?>
					  	});
						}, 500 );
				
				});
		});

	</script>
	<?php } 
	if($categoryFilter && ($layout == "grid" or $layout =="list")) {?>
	
	<script type="text/javascript">
		jQuery(document).ready(function(){
			
			// Strips duplicates form the list
			var seen = {};
			jQuery('#filters li').each(function() {
			    var txt = jQuery(this).text();
			    if (seen[txt])
			        jQuery(this).remove();
			    else
			        seen[txt] = true;
			});
			
			
				// cache container
				var jQuerycontainer = jQuery('#zentoolslist<?php echo $moduleID ?>');
				// initialize isotope
				jQuerycontainer.imagesLoaded( function(){

					jQuerycontainer.isotope({
						animationOption: "Best Available",

						<?php if($layout == "list") { ?>
						 layoutMode : 'straightDown'
						<?php } ?>
						<?php if($layout == "grid") { ?>
							//resizable: false, // disable normal resizing
							//masonry: { columnWidth: jQuerycontainer.width() / 3 }
							
						    	layoutMode: 'fitRows'
							//	resizable: false, 
							//	masonry: { columnWidth: jQuerycontainer.width() / 3 }
						<?php } ?>
					});
					
					// update columnWidth on window resize
				    jQuery(window).smartresize(function(){
				        jQuerycontainer.isotope({
				            masonry: { columnWidth: jQuerycontainer.width() / <?php echo $imagesPerRow ?> }
				        });
				    });
				});

				// filter items when filter link is clicked
				jQuery('#filters a').click(function(){
				  var selector = jQuery(this).attr('data-filter');
				  jQuerycontainer.isotope({ 
					filter: selector,
					 masonry: { columnWidth: jQuerycontainer.width() / <?php echo $imagesPerRow ?> }
					//layoutMode: 'fitRows'
					});

				  jQuery('#filters a').removeClass('active');
				  jQuery(this).toggleClass('active');

				  return false;
				});
			
			// Filter tabs hidden by css and then shown after load
			jQuery('#filters li a').show();
		});
	</script>
	<?php } ?>
	<?php if($layout == "tabs") { ?>
	<script type="text/javascript">
		jQuery(document).ready(function(){	

			//Default Action
			jQuery(".allitems").hide(); //Hide all content
			jQuery("#zentools<?php echo $moduleID ?> ul li:first").addClass("active").show(); //Activate first tab
			jQuery("#zentools<?php echo $moduleID ?> ul li:first .allitems").show(); //Show first tab content

			// js for jbtabs
			jQuery("#zentools<?php echo $moduleID ?> ul li").click(function(){
					jQuery("#zentools<?php echo $moduleID ?> li").removeClass("active");
					jQuery(this).addClass("active");
					jQuery(".allitems").hide();
					var activeTab=jQuery(this).find("a").attr("href");
					jQuery(activeTab).fadeIn(1000);
					return false});
		});
	
	</script>
	<?php } ?>
	
	
	<?php if($layout == "accordion") { ?>
		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery('#zentools<?php echo $moduleID ?> .firstitem').click(function() {

					jQuery('#zentools<?php echo $moduleID ?> .firstitem').removeClass('open');
					jQuery('#zentools<?php echo $moduleID ?> .allitems').slideUp(300);

					if(jQuery(this).next().is(':hidden') == true) {
						jQuery(this).addClass('open');
						jQuery(this).next().animate({
						    height: 'toggle'
						});
					 } 

				 });
				jQuery('#zentools<?php echo $moduleID ?> .allitems').hide();
				jQuery('#zentools<?php echo $moduleID ?> li:first-child .firstitem').addClass('open');
				jQuery('#zentools<?php echo $moduleID ?> li:first-child .allitems').slideDown();
			});
		</script>
	<?php } ?>
	
	
	<?php if($layout == "carousel") { 
	
	$minItems= $params->get('minItems');
	$carouselSpeed= $params->get('carouselSpeed');
	$imageW= $params->get('imageW');

	?>
	<script type="text/javascript">
	
			jQuery('#zentools<?php echo $moduleID ?>').elastislide({

					minItems	: <?php echo $minItems; ?>,
					speed		: <?php echo $carouselSpeed; ?>,
					imageW		: <?php echo $imageW; ?>
				});
		

	</script>
	<?php } ?>	
		
	<?php if($link == 1) {
		$fancyTitle= $params->get('fancyTitle', 0);
		$fancyTitleType= $params->get('fancyTitleType', 'over');

	?>
			<script type="text/javascript">
			jQuery("#zentools<?php echo $moduleID ?> a.inline").fancybox({
					'hideOnContentClick': true,
					'autoDimensions': false,
					'width': <?php echo $modalWidth ?>,
					'height': <?php echo $modalHeight ?>,
					'centerOnScroll': true,
					zoomOpacity: false,
					padding: <?php echo $fancyPadding ?>,
					overlayOpacity: <?php echo $fancyOverlay ?>,
					'overlayShow'			: <?php echo $fancyOverlayShow ?>,
					'zoomSpeedIn'			: 600,
					'zoomSpeedOut'			: 500,
					'showNavArrows'			: true,
					'hideOnContentClick'	: false,
					'scrolling'	: 'auto',
					'titlePosition': '<?php echo $fancyTitleType ?>',
					<?php if ($fancyTitle) { ?>
					'titleShow': true
					<?php } else { ?>
					'titleShow': false						
					<?php } ?>
				});	
				
			//	jQuery("a.fancybox").attr('rel', 'gallery').fancybox();
				
			<?php // Load external urls in a iframe lightbox.
			if($altlink && $link!==0 && $joomla25) { ?>	
				jQuery("#zentools<?php echo $moduleID ?> a.iframe").fancybox({
							'hideOnContentClick': true,
							'autoDimensions': false,
							'width': '98%',
							'height': '98%',
							'centerOnScroll': true,
							zoomOpacity: false,
							padding: <?php echo $fancyPadding ?>,
							overlayOpacity: <?php echo $fancyOverlay ?>,
							'overlayShow'			: <?php echo $fancyOverlayShow ?>,
							'zoomSpeedIn'			: 600,
							'zoomSpeedOut'			: 500,
							'showNavArrows'			: true,
							'hideOnContentClick'	: false,
							'titlePosition': '<?php echo $fancyTitleType ?>',
							<?php if ($fancyTitle) { ?>
							'titleShow': true
							<?php } else { ?>
							'titleShow': false						
							<?php } ?>
						});	
			<?php } ?>
			</script>
			<?php } ?>
			
	<?php if($imageFade) { 	?>
			<script type="text/javascript">
				jQuery('#zentools<?php echo $moduleID ?> img').fadeTo('fast', 1.0); 
				jQuery('#zentools<?php echo $moduleID ?> img').hover(function(){
				jQuery(this).fadeTo('fast', 0.3); 
					},function(){
						jQuery(this).fadeTo('fast', 1.0); // This should set the opacity back to 60% on mouseout
					});
			</script>
	<?php } ?>
	
	<?php if(($layout == "grid" && $overlayGrid) || ($layout == "carousel" && $overlayCarousel)) { 	?>
		<script type="text/javascript">
		jQuery(document).ready(function(){		
			
			var captionHeight = jQuery(".allitems").innerHeight();

			jQuery("#zentools<?php echo $moduleID ?> .allitems").css({'bottom': '-' + captionHeight +'px','display': 'none'});
			
			jQuery('#zentools<?php echo $moduleID ?> li').hover(
				function(){
					jQuery(this).find('.allitems').show().animate({bottom:"0"}, 400);	
				}, 
				function(){	
					jQuery(this).find('.allitems').animate({bottom:'-' + captionHeight}, 100).fadeOut('slow');
				}		
				);			
			});
		</script>
	<?php } ?>		
<?php } ?>