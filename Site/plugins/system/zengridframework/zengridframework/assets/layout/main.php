<?php
/**
 * @package		Joomla Bamboo Zen Grid Framework
 * @version		v2.0
 * @author		Joomlabamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2010 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * The Zen Grid Framework is a templating framework that uses the Joomla Content Manament System (http://www.joomla.org)
 * This file is called if the main content layout override is enabled and is placed in the templates/[your template name]/layout folder. 
 */
 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );
if ($showMainArea) {
?>

	<div id="mainwrap">
		<div class="container <?php echo $containerPosition ?>">
			<div class="row">
				<div class="inner">
					<div id="main" class="<?php echo $mainWidth ?>">

						<?php if($this->countModules('breadcrumb')) : ?>
						<!-- Breadcrumb -->
							<div id="breadcrumb">
									<?php if($debug) { echo $breadcrumbdebug; } ?>
									<jdoc:include type="modules" name="breadcrumb" style="jbChrome" />
							</div>
							<div class="clear"></div>
						<!-- End Breadcrumb -->
						<?php endif; ?>

								<?php if($this->countModules('above') || ($splitMenuAbove && $splitMenu)) : ?>
							<!--  above -->
							<div id="above" class="grid_twelve">
							<?php if($debug) { echo $splitmenudebug; } ?>
							<?php // Splitmenu: 
								if ($splitMenu && $splitMenuAbove) {
									$aboveSplitMenu = Zengrid::getSplitMenu($splitMenuName, $splitMenuAboveStart, $splitMenuAboveEnd);
									if ($aboveSplitMenu) {
									echo '<div id="jbSplitMenuAbove">';
									echo $aboveSplitMenu;
									echo '</div>';
								}
							} ?>			<?php if($debug) { echo $abovedebug; } ?>
											<jdoc:include type="modules" name="above" style="jbChrome" />
									</div>									

						<!-- End  above -->
						<div class="clear"></div>

						<?php endif; ?>

				

						<!-- Main Content -->
							<div id="midCol" class="grid_<?php echo $midCols; ?> <?php echo $mainWidth ?> <?php echo $midColPull ?>">
								<?php if ($logoPosition =="middle") { 
									if($debug) { echo $logodebug; } 
									require(YOURBASEPATH .DS."layout/logo.php"); 

								} 

						if ($advert1 > "0") : ?>
								<!-- Top Advert Row -->
								<div id="abovemain">
										<?php if($this->countModules('advert1')) : ?>
										<div id="abovemain1" class="grid_<?php echo $advert1 ?>">
												<?php if($debug) { echo $advert1debug; } ?>
												<jdoc:include type="modules" name="advert1" style="jbChrome" />
										</div>
										<?php endif; ?>

										<?php if($this->countModules('advert2')) : ?>
										<div id="abovemain2" class="grid_<?php echo $advert1 ?> <?php echo $advert2class ?>">
												<?php if($debug) { echo $advert2debug; } ?>
												<jdoc:include type="modules" name="advert2" style="jbChrome" />
										</div>
										<?php endif; ?>

										<?php if($this->countModules('advert3')) : ?>
										<div id="abovemain3"  class="grid_<?php echo $advert1 ?> zenlast">
												<?php if($debug) { echo $advert3debug; } ?>
												<jdoc:include type="modules" name="advert3" style="jbChrome" />
										</div>
										<?php endif; ?>
								</div>
								<!-- Top Advert Row -->
								<?php endif; ?>

								<div class="clear"></div>


								<div id="mainContent"  class="<?php echo $mainWidth ?>">
										<?php if($debug) { echo $maincontentdebug;echo ' | <span class="notice">Main Width Class: '.$mainWidth; } ?>
										<jdoc:include type="message" />
										<jdoc:include type="component" />
								</div>


								<div class="clear"></div>

								<?php if ($advert2 > "0") : ?>
								<!-- Bottom Advert Row -->
										<div id="belowmain">
										<?php if($this->countModules('advert4')) : ?>
										<div id="belowmain1"  class="grid_<?php echo $advert2 ?>">
												<?php if($debug) { echo $advert4debug; } ?>
												<jdoc:include type="modules" name="advert4" style="jbChrome" />
										</div>
										<?php endif; ?>

										<?php if($this->countModules('advert5')) : ?>
										<div id="belowmain2"  class="grid_<?php echo $advert2 ?> <?php echo $advert5class ?>">
												<?php if($debug) { echo $advert35ebug; } ?>
												<jdoc:include type="modules" name="advert5" style="jbChrome" />
										</div>
										<?php endif; ?>

										<?php if($this->countModules('advert6')) : ?>
										<div id="belowmain3"  class="grid_<?php echo $advert2 ?> zenlast">
												<?php if($debug) { echo $advert6debug; } ?>
												<jdoc:include type="modules" name="advert6" style="jbChrome" />
										</div>
										<?php endif; ?>
								</div>
								<?php endif; ?>
						</div>
						<!-- End Main Content -->
					
					
							<?php if($this->countModules('left') || ($splitMenuLeft && $splitMenu)) : ?>
							<!-- Left Column -->
								<div id="leftCol" class="grid_<?php echo $leftCols; ?> <?php echo $mainWidth ?>  <?php echo $leftColPush?>">
										<div id="left" class="sidebar">
											
											<?php if ($socialiconsposition =="left" && $socialicons) { require(YOURBASEPATH .DS."layout/socialicons.php"); } ?>

											<?php if ($logoPosition =="left") { 
												if($debug) { echo $logodebug; } 
												require(YOURBASEPATH .DS."layout/logo.php"); 

											} 

												// Splitmenu: Get all but the first level of the menu "topmenu"
												if ($splitMenu && $splitMenuLeft) {
														if($debug) { echo $splitmenudebug; }
														$leftSplitMenu = Zengrid::getSplitMenu($splitMenuName, $splitMenuLeftStart, $splitMenuLeftEnd);
														if ($leftSplitMenu) {
														echo '<div id="jbSplitMenuLeft">';
														echo '<h3><span>';
															echo $splitMenuLeftTitle;
														echo '</span></h3>';
														echo $leftSplitMenu;
														echo '</div>';
													}

												} ?>

												<?php if($debug) { echo $leftdebug; } ?>
												<jdoc:include type="modules" name="left" style="jbChrome" />
										</div>
								</div>
							<!-- End Left Column -->
							<?php endif; ?>
					
							<?php if($this->countModules('center')) : ?>
							<!-- Center Column -->
								<div id="centerCol" class="grid_<?php echo $centerCols; ?> <?php echo $mainWidth ?> <?php echo $centerColPull?>">
										<div id="center" class="sidebar">
												<?php if($debug) { echo $centerdebug; } ?>
												<jdoc:include type="modules" name="center" style="jbChrome" />
										</div>
								</div>
							<!-- End Center Column -->
							<?php endif; ?>

				

							<?php if($this->countModules('right') || ($splitMenuRight && $splitMenu)) : ?>
						<!-- Right Column -->
							<div id="rightCol" class="grid_<?php echo $rightCols; ?> <?php echo $mainWidth ?> zenlast">

									<div id="right" class="sidebar">

											<?php if ($splitMenu && $splitMenuRight) {
												if($debug) { echo $splitmenudebug; } 
												$rightSplitMenu = Zengrid::getSplitMenu($splitMenuName, $splitMenuRightStart, $splitMenuRightEnd);
												if ($rightSplitMenu) {
												echo '<div id="jbSplitMenuRight">';
												echo '<h3><span>';
												echo $splitMenuRightTitle;
												echo '</h3>';
												echo $rightSplitMenu;
												echo '</span></div>';
												}
											}?>
											<?php if($debug) { echo $rightdebug; } ?>
											<jdoc:include type="modules" name="right" style="jbChrome" />
									</div>
							</div>
						<!-- End Right Column -->
						<?php endif; ?>
						</div>

						

						<?php if($this->countModules('below')) : ?>
						<!-- Below -->
						<div class="clear"></div>
						<div id="below"  class="<?php echo $mainWidth ?>">
							<?php if($debug) { echo $belowdebug; } ?>
								<jdoc:include type="modules" name="below" style="jbChrome" />
							</div>									
						<!-- End Below -->
						<div class="clear"></div>

						<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php } ?>