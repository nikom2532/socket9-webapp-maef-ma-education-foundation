<?php
/**
 * @package		Joomla Bamboo Zen Grid Framework
 * @version		v2.0
 * @author		Joomlabamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2010 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * The Zen Grid Framework is a templating framework that uses the Joomla Content Manament System (http://www.joomla.org)
 * This file is called if the banner layout override is enabled and is placed in the templates/[your template name]/layout folder. 
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );

if ($openFile) : require("$openFile"); 
else : 
?>

<div class="fullWrap">

<?php 
endif; 

/* 
 *  If top.php was found in the layout folder, include it
 */
if ($top > "0") {
	if ($topFile) : require("$topFile"); 
	else : ?>
<div class="outerWrapper topRow"> <!-- Top Wrapper -->
		<div class="container <?php echo $position ?>" style="width:<?php echo $tWidth ?>px;<?php echo $containerOffset?>">
				<div class="containerBG">
						<div class="innerContainer" style="width:<?php echo $contentWidth ?>px;margin-left:<?php echo $gutter ?>px">
								<div id="topWrapper">
								
								
								<?php if($this->countModules('top1')) : ?>
									<div id="top1" style="width:<?php echo $$top1Cols; ?>px;margin-right: <?php echo $gutter ?>px">
											<?php if($debug) { echo $top1debug; } ?>
											<jdoc:include type="modules" name="top1" style="jbChrome" />
									</div>
									<?php endif; ?>
									
									<?php if($this->countModules('top2')) : ?>
									<div id="top2" style="width:<?php echo $$top2Cols; ?>px;margin-right: <?php echo $gutter ?>px">
											<?php if($debug) { echo $top2debug; } ?>
											<jdoc:include type="modules" name="top2" style="jbChrome" />
									</div>
									<?php endif; ?>
									
									<?php if($this->countModules('top3')) : ?>
									<div id="top3" style="width:<?php echo $$top3Cols; ?>px;margin-right: <?php echo $gutter ?>px">
											<?php if($debug) { echo $top3debug; } ?>
											<jdoc:include type="modules" name="top3" style="jbChrome" />
									</div>
									<?php endif; ?>
									
									<?php if($this->countModules('top4')) : ?>
									<div id="top4" style="width:<?php echo $$top4Cols; ?>px">
											<?php if($debug) { echo $top4debug; } ?>
											<jdoc:include type="modules" name="top4" style="jbChrome" />
											<?php if ($socialiconsposition =="top" && $socialicons) { require(YOURBASEPATH .DS."layout/socialicons.php"); } ?>
									</div>
								<?php endif; ?>

									
								</div> 
						</div>
				</div>
		</div>
</div><!-- Top Wrapper -->	
<?php 
	endif;
}

/* 
 *  If header.php was found in the layout folder, include it
 */	
if ($logoPosition == "above" or $header > "0") { 
	if ($headerFile) : require("$headerFile");
	else : ?>
<!-- Logo Wrapper -->
<div class="outerWrapper logoRow">
		<div class="container <?php echo $position ?>" style="width:<?php echo $tWidth ?>px;<?php echo $containerOffset?>">
				<div class="containerBG">
						<div class="innerContainer" style="width:<?php echo $contentWidth ?>px;margin-left:<?php echo $gutter ?>px">
								<?php if ($logoPosition =="above") { 
								
									require(YOURBASEPATH .DS."layout/logo.php"); 
								 								
								} ?>
								
								<?php if ($logoPosition =="below" or $logoPosition =="none"  or $logoPosition =="left") { ?>
								<div id="header1" style="width:<?php echo $$header1Cols; ?>px;margin-right: <?php echo $gutter ?>px">
									<?php if($debug) { echo $header1debug; } ?>
									<jdoc:include type="modules" name="header1" style="jbChrome" />
								</div> 								
								<?php } ?>
								
								<?php if($this->countModules('header2')) : ?>
								<div id="header2" style="width:<?php echo $$header2Cols; ?>px;margin-right: <?php echo $gutter ?>px">
									<?php if($debug) { echo $header2debug; } ?>
									<jdoc:include type="modules" name="header2" style="jbChrome" />
								</div>
								<?php endif; ?>
								
								<?php if($this->countModules('header3')) : ?>
								<div id="header3" style="width:<?php echo $$header3Cols; ?>px;margin-right: <?php echo $gutter ?>px">
										<?php if($debug) { echo $header3debug; } ?>
										<jdoc:include type="modules" name="header3" style="jbChrome" />
								</div>
								<?php endif; ?>
								
								<?php if($this->countModules('header4')) : ?>
								<div id="header4" style="width:<?php echo $$header4Cols; ?>px">
										<?php if($debug) { echo $header4debug; } ?>
										<jdoc:include type="modules" name="header4" style="jbChrome" />
										<?php if ($socialicons && $socialiconsposition =="header") { require(YOURBASEPATH .DS."layout/socialicons.php"); } ?>
								</div>
								<?php endif; ?>
								
						</div>
				</div>
		</div>
</div>
<!-- Logo Wrapper -->
<?php 
endif;
} 

if($menuCount or $logoPosition =="below") : 
/* 
 *  If nav.php was found in the layout folder, include it
 */	
if ($navFile) : require("$navFile");
else : ?>
<!-- Nav Wrapper -->
<div class="outerWrapper navRow">
		<div class="container <?php echo $position ?>" style="width:<?php echo $tWidth ?>px;<?php echo $containerOffset?>">
				<div class="containerBG">
						<div class="innerContainer" style="width:<?php echo $contentWidth ?>px;margin-left:<?php echo $gutter ?>px">
								<div id="navWrapper">
										<?php if ($logoPosition =="below") { 
														require(YOURBASEPATH .DS."layout/logo.php"); 			
										} ?>
										<div id="navWrap" <?php if ($logoPosition =="above" or $logoPosition == "none" or $navLeft) { ?> class="navLeft" <?php } ?>style="width:<?php echo $$navCols; ?>px">
											<div id="nav" class="<?php echo $fontStackNav ?>">
												<?php if($debug) { echo $menudebug; } ?>
												<?php if ($splitMenu) {
											
												require(YOURBASEPATH .DS."layout/splitmenuTop.php"); 
														
														
												} else { ?>
												
												<jdoc:include type="modules" name="menu" style="jbChrome" />
												<div id="mobilemenu" title="<?php echo $mobileMenuTitle?>"></div>
												<?php } ?>
												
											</div>	
										</div>
								</div>	
						</div>
				</div>
		</div>
</div>
<!-- Nav Wrapper -->
<?php
endif;
	endif;			
/* 
 *  If banner.php was found in the layout folder, include it
 */				
if($banner) { 
	if ($bannerFile) : require("$bannerFile");
	else : ?>
<!-- Banner Wrapper -->
<div class="outerWrapper bannerRow">
		<div class="container <?php echo $position ?>" style="width:<?php echo $tWidth ?>px;<?php echo $containerOffset?>">
				<div class="containerBG">
						<div class="innerContainer" style="width:<?php echo $contentWidth ?>px;margin-left:<?php echo $gutter ?>px">
																
								
								<div id="banner" style="width:100%">
									<?php if($debug) { echo $bannerdebug; } ?>
										<?php if($debug) { echo $bannerdebug; } ?>
										<jdoc:include type="modules" name="banner" style="jbChrome" />
										<?php if ($socialiconsposition =="banner" && $socialicons) { require(YOURBASEPATH .DS."layout/socialicons.php"); } ?>
								</div> 								
							
																
						</div>
				</div>
		</div>
</div>
<!-- Banner Wrapper -->
<?php
endif; 
}



/* 
 *  If tabs.php was found in the layout folder, include it
 */				
if($this->countModules('tab1') || $this->countModules('tab2')  || $this->countModules('tab3')  || $this->countModules('tab4')) {
	if ($tabFile) : require("$tabFile");
	else : ?>
	
<!-- Tab Row Wrapper -->
<div class="outerWrapper tabRow">
		<div class="container <?php echo $position ?>" style="width:<?php echo $tWidth ?>px;<?php echo $containerOffset?>">
				<div class="containerBG">
						<div class="innerContainer" style="width:<?php echo $contentWidth ?>px;margin-left:<?php echo $gutter ?>px">
																
								
								<div id="jbtabbedArea">
										    <ul class="jbtabs">
											    	<?php if($debug) { echo $tabtitledebug; } ?>
											    	<?php if($this->countModules('tab1')) : ?>
											        	<li class="jbtab1" >
															<a href="#jbtab1">
																<?php if(($zenTranslate)) {
																			echo $tab1Title;
																		} 
																		else {
																			echo JText::_("Tab1");
																} ?>
																	
																</a>
														</li>
											        <?php endif; ?>
											        
											        <?php if($this->countModules('tab2')) : ?>
											        	<li class="jbtab2" >
																<a href="#jbtab2">
																	<?php if(($zenTranslate)) {
																				echo $tab2Title;
																			} 
																			else {
																				echo JText::_("Tab2");
																	} ?>
											        		
											        			</a></li>
											        <?php endif; ?>
											        
											        <?php if($this->countModules('tab3')) : ?>
											        	<li class="jbtab3" >
																<a href="#jbtab3">
																		<?php if(($zenTranslate)) {
																					echo $tab3Title;
																				} 
																				else {
																					echo JText::_("Tab3");
																		} ?>
																</a>
														</li>
											        <?php endif; ?>
											        
											        <?php if($this->countModules('tab4')) : ?>
											       	 <li class="jbtab4" >
															<a href="#jbtab4">
																	<?php if(($zenTranslate)) {
																				echo $tab4Title;
																			} 
																			else {
																				echo JText::_("Tab4");
																	} ?>
															</a>
														</li>
											        <?php endif; ?>
											    </ul>
											    <div class="jbtab_container">
											    
											    	<?php if($this->countModules('tab1')) : ?>
											        	<div id="jbtab1" class="jbtab_content jbtabwidth<?php echo $tab1Count; ?>">
											           		<div class="jbtab1">
																	<?php if($debug) { echo $tab1debug; } ?>
																	<jdoc:include type="modules" name="tab1" style="jbChrome" />
															</div>
														</div>
													<?php endif; ?>
													
																									
													<?php if($this->countModules('tab2')) : ?>
											        	<div id="jbtab2" class="jbtab_content jbtabwidth<?php echo $tab2Count; ?>">
											           		<div class="jbtab2">
																<?php if($debug) { echo $tab2debug; } ?>
																<jdoc:include type="modules" name="tab2" style="jbChrome" />
															</div>
														</div>
													<?php endif; ?>
													
													<?php if($this->countModules('tab3')) : ?>
											        	<div id="jbtab3" class="jbtab_content jbtabwidth<?php echo $tab3Count; ?>">
											           		<div class="jbtab3">
																<?php if($debug) { echo $tab3debug; } ?>
																<jdoc:include type="modules" name="tab3" style="jbChrome" />
															</div>
														</div>
													<?php endif; ?>
													
													<?php if($this->countModules('tab4')) : ?>
											        	<div id="jbtab4" class="jbtab_content jbtabwidth<?php echo $tab4Count; ?>">
											           		<div class="jbtab4">
																<?php if($debug) { echo $tab4debug; } ?>
																<jdoc:include type="modules" name="tab4" style="jbChrome" />
															</div>
														</div>
													<?php endif; ?>
										       
											       </div>
										</div>			
										
										<div class="clear"></div>
							
						</div>
				</div>
		</div>
</div>
<!-- Tabs Wrapper -->
<?php

endif; 

}


/* 
 *  If grid1.php was found in the layout folder, include it
 */
if ($grid1 > "0") {
	if ($grid1File) : require("$grid1File"); 
	else : ?>
<!-- First Row Grid -->
<div class="outerWrapper grid1Row">
		<div class="container <?php echo $position ?>" style="width:<?php echo $tWidth ?>px;<?php echo $containerOffset?>">
				<div class="containerBG">
						<div class="innerContainer" style="width:<?php echo $contentWidth ?>px;margin-left:<?php echo $gutter ?>px">
								<div class="gridWrap1">
									
										<?php if($this->countModules('grid1')) : ?>
												<div id="grid1" style="width:<?php echo $$grid1Cols; ?>px;margin-right: <?php echo $gutter ?>px">
														<?php if($debug) { echo $grid1debug; } ?>
														<jdoc:include type="modules" name="grid1" style="jbChrome" />
												</div>
										<?php endif; ?>
										<?php if($this->countModules('grid2')) : ?>
												<div id="grid2" style="width:<?php echo $$grid2Cols; ?>px;margin-right: <?php echo $gutter ?>px">
															<?php if($debug) { echo $grid2debug; } ?>
															<jdoc:include type="modules" name="grid2" style="jbChrome" />
												</div>
										<?php endif; ?>
										<?php if($this->countModules('grid3')) : ?>
												<div id="grid3" style="width:<?php echo $$grid3Cols; ?>px;margin-right: <?php echo $gutter ?>px">
														<?php if($debug) { echo $grid3debug; } ?>
														<jdoc:include type="modules" name="grid3" style="jbChrome" />
												</div>
										<?php endif; ?>
										<?php if($this->countModules('grid4')) : ?>
												<div id="grid4" style="width:<?php echo $$grid4Cols; ?>px">
														<?php if($debug) { echo $grid4debug; } ?>
														<jdoc:include type="modules" name="grid4" style="jbChrome" />
														<?php if ($socialiconsposition =="grid1" && $socialicons) { require(YOURBASEPATH .DS."layout/socialicons.php"); } ?>
												</div>
										<?php endif; ?>
									
								</div>
						</div>
				</div>
		</div>
</div>
<!-- First Grid -->	
<?php
endif; 
}
/* 
 *  If grid2.php was found in the layout folder, include it
 */
if ($grid2 > "0") { 
	if ($grid2File) : require("$grid2File"); 
	else : ?>
<!-- Second Row Grid -->
<div class="outerWrapper grid2Row">
		<div class="container <?php echo $position ?>" style="width:<?php echo $tWidth ?>px;<?php echo $containerOffset?>">
				<div class="containerBG">
						<div class="innerContainer" style="width:<?php echo $contentWidth ?>px;margin-left:<?php echo $gutter ?>px">		
		
								<div class="gridWrap2">
									
											<?php if($this->countModules('grid5')) : ?>
													<div id="grid5" style="width:<?php echo $$grid5Cols; ?>px;margin-right: <?php echo $gutter ?>px">
															<?php if($debug) { echo $grid5debug; } ?>
															<jdoc:include type="modules" name="grid5" style="jbChrome" />
													</div>
											<?php endif; ?>
											<?php if($this->countModules('grid6')) : ?>
													<div id="grid6" style="width:<?php echo $$grid6Cols; ?>px;margin-right: <?php echo $gutter ?>px">
															<?php if($debug) { echo $grid6debug; } ?>
															<jdoc:include type="modules" name="grid6" style="jbChrome" />
													</div>
											<?php endif; ?>
											<?php if($this->countModules('grid7')) : ?>
													<div id="grid7" style="width:<?php echo $$grid7Cols; ?>px;margin-right: <?php echo $gutter ?>px">
															<?php if($debug) { echo $grid7debug; } ?>
															<jdoc:include type="modules" name="grid7" style="jbChrome" />
													</div>
											<?php endif; ?>
											<?php if($this->countModules('grid8')) : ?>
													<div id="grid8" style="width:<?php echo $$grid8Cols; ?>px">
															<?php if($debug) { echo $grid8debug; } ?>
															<jdoc:include type="modules" name="grid8" style="jbChrome" />
													</div>
											<?php endif; ?>
										
								</div>
								<div class="clear"></div>
								
						</div>
				</div>
		</div>
</div>
<!-- Second Row Grid -->
<?php
endif; 
}

/* 
 *  If grid3.php was found in the layout folder, include it
 */
if ($grid3 > "0") {
	if ($grid3File) : require("$grid3File");
	else : ?>
<!-- Third Row Grid -->
<div class="outerWrapper grid3Row">
		<div class="container <?php echo $position ?>" style="width:<?php echo $tWidth ?>px;<?php echo $containerOffset?>">
				<div class="containerBG">
						<div class="innerContainer" style="width:<?php echo $contentWidth ?>px;margin-left:<?php echo $gutter ?>px">
								
								
								<div class="gridWrap3">
									
										<?php if($this->countModules('grid9')) : ?>
												<div id="grid9" style="width:<?php echo $$grid9Cols; ?>px;margin-right: <?php echo $gutter ?>px">
														<?php if($debug) { echo $grid9debug; } ?>
														<jdoc:include type="modules" name="grid9" style="jbChrome" />
												</div>
										<?php endif; ?>
										<?php if($this->countModules('grid10')) : ?>
												<div id="grid10" style="width:<?php echo $$grid10Cols; ?>px;margin-right: <?php echo $gutter ?>px">
														<?php if($debug) { echo $grid10debug; } ?>
														<jdoc:include type="modules" name="grid10" style="jbChrome" />
												</div>
										<?php endif; ?>
										<?php if($this->countModules('grid11')) : ?>
												<div id="grid11" style="width:<?php echo $$grid11Cols; ?>px;margin-right: <?php echo $gutter ?>px">
														<?php if($debug) { echo $grid11debug; } ?>
														<jdoc:include type="modules" name="grid11" style="jbChrome" />
												</div>
										<?php endif; ?>
										<?php if($this->countModules('grid12')) : ?>
												<div id="grid12" style="width:<?php echo $$grid12Cols; ?>px">
														<?php if($debug) { echo $grid12debug; } ?>
														<jdoc:include type="modules" name="grid12" style="jbChrome" />
												</div>
										<?php endif; ?>
									
								</div>
								
						</div>
				</div>
		</div>
</div>
<!-- Third Row Grid -->
<?php
endif; 
}

/* 
 * If there is a frontpage.php file, and its the homepage, use it, otherwise if a main.php exists include it
 */
if (Zengrid::isHome() && ($frontpageFile)) require("$frontpageFile"); 
else {
	if ($mainFile) : require("$mainFile"); 
	else : 
	if ($showMainArea) {
	
	?>
<div class="outerWrapper mainRow">
		<div class="container <?php echo $position ?>" style="width:<?php echo $tWidth ?>px;<?php echo $containerOffset?>">
				<div class="containerBG">
						<div class="innerContainer" style="width:<?php echo $contentWidth ?>px;margin-left:<?php echo $gutter ?>px">
										

								<div id="mainWrap" class="<?php echo $mainWidth ?>">
							
								<?php if($this->countModules('breadcrumb')) : ?>
								<!-- Breadcrumb -->
									<div id="breadcrumb">
										<?php if($debug) { echo $breadcrumbdebug; } ?>
										<jdoc:include type="modules" name="breadcrumb" style="jbChrome" />
									</div>
									<div class="clear"></div>
								<!-- End Breadcrumb -->
								<?php endif; ?>
								
								<?php if($this->countModules('above')) : ?>
								<!--  above -->
									
											<div id="above" class="<?php echo $mainWidth ?>">
													<?php if($debug) { echo $abovedebug; } ?>
													<jdoc:include type="modules" name="above" style="jbChrome" />
											</div>									
								
								<!-- End  above -->
								<div class="clear"></div>
								
								<?php endif; ?>
								
								<?php if($this->countModules('left')) : ?>
								<!-- Left Column -->
									<div id="leftCol" style="margin-right: <?php echo $gutter ?>px">
											<div id="left" style="width:<?php echo $$leftCols; ?>px" class="<?php echo $mainWidth ?> sidebar">
											
											<?php if ($logoPosition =="left") { 
													if($debug) { echo $logodebug; } 
													require(YOURBASEPATH .DS."layout/logo.php"); 
																
											} 
										
										// Splitmenu: Get all but the first level of the menu "topmenu"
											if ($splitMenu && $splitMenuPos =="left") {
													if($debug) { echo $splitmenudebug; }
													require(YOURBASEPATH .DS."layout/splitmenuSidebar.php");
													
											} ?>
										
													<?php if($debug) { echo $leftdebug; } ?>
													<jdoc:include type="modules" name="left" style="jbChrome" />
											</div>
									</div>
								<!-- End Left Column -->
								<?php endif; ?>
								
								<?php if ($mainLayout =="1") {
								 if($this->countModules('center')) : ?>
								<!-- Center Column -->
									<div id="centerCol">
											<div id="center" style="width:<?php echo $$centerCols; ?>px;margin-right: <?php echo $gutter ?>px" class="<?php echo $mainWidth ?> sidebar">
													<jdoc:include type="modules" name="center" style="jbChrome" />
											</div>
									</div>
								<!-- End Center Column -->
								<?php endif; 
								} ?>

								<!-- Main Content -->
									<div id="midCol" style="width:<?php echo $$midCols; ?>px;<?php echo $midColFloat ?>;<?php echo $midColMargin ?>px" class="<?php echo $mainWidth ?>">
								
								<?php if ($advert1 > "0") : ?>
										<!-- Top Advert Row -->
										<div id="abovecontent">
												<?php if($this->countModules('advert1')) : ?>
												<div id="abovecontent1" style="width:<?php echo $$advert1Cols; ?>px;margin-right: <?php echo $gutter ?>px">
													<?php if($debug) { echo $advert1debug; } ?>
													<jdoc:include type="modules" name="advert1" style="jbChrome" />
												</div>
												<?php endif; ?>
												
												<?php if($this->countModules('advert2')) : ?>
												<div id="abovecontent2" style="width:<?php echo $$advert2Cols; ?>px;margin-right: <?php echo $gutter ?>px">
													<?php if($debug) { echo $advert2debug; } ?>
													<jdoc:include type="modules" name="advert2" style="jbChrome" />
												</div>
												<?php endif; ?>
												
												<?php if($this->countModules('advert3')) : ?>
												<div id="abovecontent3" style="width:<?php echo $$advert3Cols; ?>px">
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

										<div class="clear"></div>
										
										
										
										<?php if ($advert2 > "0") : ?>
										<!-- Bottom Advert Row -->
												<div id="belowcontent">
												<?php if($this->countModules('advert4')) : ?>
												<div id="belowcontent1" style="width:<?php echo $$advert4Cols; ?>px;margin-right: <?php echo $gutter ?>px">
														<?php if($debug) { echo $advert4debug; } ?>
														<jdoc:include type="modules" name="advert4" style="jbChrome" />
												</div>
												<?php endif; ?>
												
												<?php if($this->countModules('advert5')) : ?>
												<div id="belowcontent2" style="width:<?php echo $$advert5Cols; ?>px;margin-right: <?php echo $gutter ?>px">
														<?php if($debug) { echo $advert35ebug; } ?>
														<jdoc:include type="modules" name="advert5" style="jbChrome" />
												</div>
												<?php endif; ?>
												
												<?php if($this->countModules('advert6')) : ?>
												<div id="belowcontent3" style="width:<?php echo $$advert6Cols; ?>px">
														<?php if($debug) { echo $advert6debug; } ?>
														<jdoc:include type="modules" name="advert6" style="jbChrome" />
												</div>
												<?php endif; ?>
										</div>
										<?php endif; ?>
										
										</div>
								
								
								<div class="clear"></div>
								
								</div>
								<!-- End Main Content -->
								
								<?php if ($mainLayout =="2") {
								if($this->countModules('center')) : ?>
								<!-- Center Column -->
									<div id="centerCol">
											<div id="center" style="width:<?php echo $$centerCols; ?>px;margin-right: <?php echo $gutter ?>px" class="<?php echo $mainWidth ?> sidebar">
													<?php if($debug) { echo $centerdebug; } ?>
													<jdoc:include type="modules" name="center" style="jbChrome" />
											</div>
									</div>
								<!-- End Center Column -->
								<?php endif; 
								} ?>
								
								<?php if($this->countModules('right')) : ?>
								<!-- Right Column -->
									<div id="rightCol">
									
											<div id="right" style="width:<?php echo $$rightCols; ?>px"  class="<?php echo $mainWidth ?> sidebar">
												
													<?php
													
													// Splitmenu: Get all but the first level of the menu "topmenu"
														if ($splitMenu && $splitMenuPos =="right") {
																	if($debug) { echo $splitmenudebug; } 
																require(YOURBASEPATH .DS."layout/splitmenuSidebar.php"); 
																
														} ?>
													<?php if($debug) { echo $rightdebug; } ?>
													<jdoc:include type="modules" name="right" style="jbChrome" />
											</div>
									</div>
								<!-- End Right Column -->
								<?php endif; ?>
								
								<?php if($this->countModules('below')) : ?>
								<!-- Below -->
									
											<div id="below"  class="<?php echo $mainWidth ?>">
													?php if($debug) { echo $belowdebug; } ?>
													<jdoc:include type="modules" name="below" style="jbChrome" />
											</div>									
								
								<!-- End Below -->
								<div class="clear"></div>
								
								<?php endif; ?>
								</div>
						</div>
				</div>
		</div>
</div>
<?php
}
endif;
}
 
/* 
 *  If grid4.php was found in the layout folder, include it
 */
if ($grid4 > "0") {
	if ($grid4File) : require("$grid4File");
	else : ?>
<!-- Fourth Row Grid -->
<div class="outerWrapper grid4Row">
		<div class="container <?php echo $position ?>" style="width:<?php echo $tWidth ?>px;<?php echo $containerOffset?>">
			<div class="containerBG">
				<div class="innerContainer" style="width:<?php echo $contentWidth ?>px;margin-left:<?php echo $gutter ?>px">								
								
						
								<div class="gridWrap4">
									
											<?php if($this->countModules('grid13')) : ?>
													<div id="grid13" style="width:<?php echo $$grid13Cols; ?>px;margin-right: <?php echo $gutter ?>px">
																<?php if($debug) { echo $grid13debug; } ?>
																<jdoc:include type="modules" name="grid13" style="jbChrome" />
													</div>
											<?php endif; ?>
											<?php if($this->countModules('grid14')) : ?>
													<div id="grid14" style="width:<?php echo $$grid14Cols; ?>px;margin-right: <?php echo $gutter ?>px">
															<?php if($debug) { echo $grid14debug; } ?>
															<jdoc:include type="modules" name="grid14" style="jbChrome" />
													</div>
											<?php endif; ?>
											<?php if($this->countModules('grid15')) : ?>
													<div id="grid15" style="width:<?php echo $$grid15Cols; ?>px;margin-right: <?php echo $gutter ?>px">
															<?php if($debug) { echo $grid15debug; } ?>
															<jdoc:include type="modules" name="grid15" style="jbChrome" />
													</div>
											<?php endif; ?>
											<?php if($this->countModules('grid16')) : ?>
													<div id="grid16" style="width:<?php echo $$grid16Cols; ?>px">
															<?php if($debug) { echo $grid16debug; } ?>
															<jdoc:include type="modules" name="grid16" style="jbChrome" />
													</div>
											<?php endif; ?>
									
								</div>
				
					</div>
			</div>
		</div>
</div><!-- Fourth Grid -->
<?php
endif; 
}

/* 
 *  If grid5.php was found in the layout folder, include it
 */
if ($grid5 > "0") { 
	if ($grid5File) : require("$grid5File"); 
	else : ?>
<!-- Fifth Row Grid -->
<div class="outerWrapper grid5Row">
		<div class="container <?php echo $position ?>" style="width:<?php echo $tWidth ?>px;<?php echo $containerOffset?>">
			<div class="containerBG">
				<div class="innerContainer" style="width:<?php echo $contentWidth ?>px;margin-left:<?php echo $gutter ?>px">

								
									<div class="gridWrap5">
												
											<?php if($this->countModules('grid17')) : ?>
													<div id="grid17" style="width:<?php echo $$grid17Cols; ?>px;margin-right: <?php echo $gutter ?>px">
															<?php if($debug) { echo $grid17debug; } ?>
															<jdoc:include type="modules" name="grid17" style="jbChrome" />
													</div>
											<?php endif; ?>
											<?php if($this->countModules('grid18')) : ?>
													<div id="grid18" style="width:<?php echo $$grid18Cols; ?>px;margin-right: <?php echo $gutter ?>px">
															<?php if($debug) { echo $grid18debug; } ?>
															<jdoc:include type="modules" name="grid18" style="jbChrome" />
													</div>
											<?php endif; ?>
											<?php if($this->countModules('grid19')) : ?>
													<div id="grid19" style="width:<?php echo $$grid19Cols; ?>px;margin-right: <?php echo $gutter ?>px">
															<?php if($debug) { echo $grid19debug; } ?>
															<jdoc:include type="modules" name="grid19" style="jbChrome" />
													</div>
											<?php endif; ?>
											<?php if($this->countModules('grid20')) : ?>
													<div id="grid20" style="width:<?php echo $$grid20Cols; ?>px">
														<?php if($debug) { echo $grid20debug; } ?>
															<jdoc:include type="modules" name="grid20" style="jbChrome" />
													</div>
											<?php endif; ?>
									
								</div>

						<div class="clear"></div>
					
				</div>
		</div>
	</div>
</div>
<!-- Fifth Row Grid -->
<?php
endif; 
}

/* 
 *  If grid6.php was found in the layout folder, include it
 */
if ($grid6 > "0") {
	if ($grid6File) : require("$grid6File"); 
	else : ?>
	
	<!-- Sixth Row Grid -->
<div class="outerWrapper grid6Row">
		<div class="container <?php echo $position ?>" style="width:<?php echo $tWidth ?>px;<?php echo $containerOffset?>">
			<div class="containerBG">
				<div class="innerContainer" style="width:<?php echo $contentWidth ?>px;margin-left:<?php echo $gutter ?>px">

								
									<div class="gridWrap6">
												
											<?php if($this->countModules('grid21')) : ?>
													<div id="grid21" style="width:<?php echo $$grid21Cols; ?>px;margin-right: <?php echo $gutter ?>px">
														<?php if($debug) { echo $grid21debug; } ?>
														<jdoc:include type="modules" name="grid21" style="jbChrome" />
													</div>
											<?php endif; ?>
											<?php if($this->countModules('grid22')) : ?>
													<div id="grid22" style="width:<?php echo $$grid22Cols; ?>px;margin-right: <?php echo $gutter ?>px">
														<?php if($debug) { echo $grid22debug; } ?>
														<jdoc:include type="modules" name="grid22" style="jbChrome" />
													</div>
											<?php endif; ?>
											<?php if($this->countModules('grid23')) : ?>
													<div id="grid23" style="width:<?php echo $$grid23Cols; ?>px;margin-right: <?php echo $gutter ?>px">
															<?php if($debug) { echo $grid23debug; } ?>
															<jdoc:include type="modules" name="grid23" style="jbChrome" />
													</div>
											<?php endif; ?>
											<?php if($this->countModules('grid24')) : ?>
													<div id="grid24" style="width:<?php echo $$grid24Cols; ?>px">
															<?php if($debug) { echo $grid24debug; } ?>
															<jdoc:include type="modules" name="grid24" style="jbChrome" />
															<?php if ($socialiconsposition =="grid6" && $socialicons) { require(YOURBASEPATH .DS."layout/socialicons.php"); } ?>
													</div>
											<?php endif; ?>
									
								</div>

						<div class="clear"></div>
					
				</div>
		</div>
	</div>
</div>
<!-- Sixth Row Grid -->
<?php
endif; 
}

/* 
 *  If bottom.php was found in the layout folder, include it
 */
if ($bottom > "0") {
	if ($bottomFile) : require("$bottomFile"); 
	else : ?>
<!-- Bottom Row Grid -->
<div class="outerWrapper bottomRow">
		<div class="container <?php echo $position ?>" style="width:<?php echo $tWidth ?>px;<?php echo $containerOffset?>">
			<div class="containerBG">
				<div class="innerContainer" style="width:<?php echo $contentWidth ?>px;margin-left:<?php echo $gutter ?>px">						
								<div class="bottomWrap">
									<div id="bottom">
											<?php if($this->countModules('bottom1')) : ?>
													<div id="bottom1" style="width:<?php echo $$bottom1Cols; ?>px;margin-right: <?php echo $gutter ?>px">
															<?php if($debug) { echo $bottom1debug; } ?>
															<jdoc:include type="modules" name="bottom1" style="jbChrome" />
													</div>
											<?php endif; ?>
											<?php if($this->countModules('bottom2')) : ?>
													<div id="bottom2" style="width:<?php echo $$bottom2Cols; ?>px;margin-right: <?php echo $gutter ?>px">
														<?php if($debug) { echo $bottom2debug; } ?>
														<jdoc:include type="modules" name="bottom2" style="jbChrome" />
													</div>
											<?php endif; ?>
											<?php if($this->countModules('bottom3')) : ?>
													<div id="bottom3" style="width:<?php echo $$bottom3Cols; ?>px;margin-right: <?php echo $gutter ?>px">
														<?php if($debug) { echo $bottom3debug; } ?>
														<jdoc:include type="modules" name="bottom3" style="jbChrome" />
													</div>
											<?php endif; ?>
											<?php if($this->countModules('bottom4')) : ?>
													<div id="bottom4" style="width:<?php echo $$bottom4Cols; ?>px">
														<?php if($debug) { echo $bottom4debug; } ?>
														<jdoc:include type="modules" name="bottom4" style="jbChrome" />
														<?php if ($socialiconsposition =="bottom" && $socialicons) { require(YOURBASEPATH .DS."layout/socialicons.php"); } ?>
													</div>
											<?php endif; ?>
									</div>
								</div>

				</div>
		</div>
	</div>
</div>
<!-- Bottom Row Grid -->
<?php 
endif; 
}
?>

<?php
/* 
 *  If footer.php was found in the layout folder, include it
 */

	if ($footerFile) : require("$footerFile"); 
	else : ?>
<div class="outerWrapper footerRow">
		<div class="container <?php echo $position ?>" style="width:<?php echo $tWidth ?>px;<?php echo $containerOffset?>">
			<div class="containerBG">
				<div class="innerContainer" style="width:<?php echo $contentWidth ?>px;margin-left:<?php echo $gutter ?>px">
					
					
					
					<div id="footer">
					
					
							<div id="footerLeft" style="width:<?php echo $$footerCols; ?>px;margin-right: <?php echo $gutter ?>px">
									<?php if($debug) { echo $footerdebug; } ?>
									<jdoc:include type="modules" name="footer" style="jbChrome" />
									<?php if ($socialiconsposition =="footer" && $socialicons) { require(YOURBASEPATH .DS."layout/socialicons.php"); } ?>
							</div>
									
							<!-- Copyright -->				
					<div id="footerRight">
							<?php if (!$removejblogo) { ?>
									<a href="http://www.joomlabamboo.com"><img class="jbLogo" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/jb.png" alt="Joomla Bamboo" /></a>
							<?php } ?>
							
							<?php if ($customcopyright !=="") { 
									echo $customcopyright;
							 } ?>
					</div>			
				</div>
					
						
	
		</div> <!-- innerContainer -->
	</div>	<!-- containerBG -->					
</div> <!-- Container -->

<?php
endif;

?>
			
<?php
/* 
 *  If panel.php was found in the layout folder, include it
 */
if ($panel > "0") {
	if ($panelFile) : require("$panelFile");
	else : ?>
<!-- Panel -->
<div id="toppanel">
		<!-- The tab on top -->	
		<div class="tab">
			
			<a id="open" rel="#panelInner" href="#nogo">
				
								<?php if(($zenTranslate)) {
											echo $openPanel;
										} 
										else {
											echo JText::_("Open Panel");
								} ?>
					</a>
		</div> <!-- / top -->
		<div id="panelInner"  style="width:<?php echo $contentWidth ?>px;height: <?php echo $panelHeight ?>px" class="overlay">
				<div id="panel">
								<?php if($this->countModules('panel1')) : ?>
									<div id="panel1" style="width:<?php echo $$panel1Cols; ?>px;margin-right: <?php echo $gutter ?>px">
										<jdoc:include type="modules" name="panel1" style="jbChrome"/>
									</div>
								<?php endif; ?> 
								<?php if($this->countModules('panel2')) : ?>
									<div id="panel2" style="width:<?php echo $$panel2Cols; ?>px;margin-right: <?php echo $gutter ?>px">
										<jdoc:include type="modules" name="panel2" style="jbChrome"/>
									</div>
								<?php endif; ?> 
								<?php if($this->countModules('panel3')) : ?>
									<div id="panel3" style="width:<?php echo $$panel3Cols; ?>px">
										<jdoc:include type="modules" name="panel3" style="jbChrome"/>
									</div>
								<?php endif; ?> 
								<?php if($this->countModules('panel4')) : ?>
									<div id="panel4" style="width:<?php echo $$panel4Cols; ?>px">
										<jdoc:include type="modules" name="panel4" style="jbChrome"/>
									</div>
								<?php endif; ?> 
							</div> <!-- /login -->	
							
							<div class="close"></div>
				</div>
				<div id="backgroundPopup"></div>
		</div> <!--panel -->
<?php
endif; 
}

/* 
 *  If closeContainer.php was found in the layout folder, include it
 */
if ($closeFile) : require("$closeFile"); 
else : ?>

<?php
endif;
?>
</div>	<!-- Full Wrap -->	

<div class="clear"></div>
<jdoc:include type="modules" name="debug" style="jbChrome" />