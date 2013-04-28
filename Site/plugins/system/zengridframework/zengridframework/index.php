<?php
/**
 * @package		Joomla Bamboo Zen Grid Framework
 * @Type        Core Framework Files
 * @version		v2.0
 * @author		Joomlabamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2010 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );

if ($this->template == "zengridframework") { ?>
<body style="background:#f9f9f9">
<div style="width:600px;margin:140px auto;height:110px;background:#fffbcc;padding:20px;border:1px solid #ddd;color:#444;line-height:2em;font-size:18px">You are attempting to use the Zen Grid Framework as your default template.<br /> <span style="font-size:15px">Please install and enable a Zen Grid Framework compatible template in order to use the Zen Grid Framework. Please refer to the Zen Grid2 framework documentation for more information.</span></div>
</body>

<?php } else {
	
	// Loads the vars file
	define( 'YOURBASEPATH', dirname(__FILE__) );

	// Loads the universal Zen Grid Class
	include_once ($frameworkClass);

	// Requires the vars file
	require(YOURBASEPATH .DS."functions/vars.php"); ?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>">
	<head>
	<link rel="shortcut icon" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/favicon.ico" />
	<?php if ($mobileMeta) {?><meta name = "viewport" content = "user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width" /><?php }?>
	<jdoc:include type="head" />
	
	<?php if ($getExtraCSS) {	
		// Checks for the extracss.php file.
		// This is deprecataed and can be removed for v1.3 +
		include_once (JPATH_ROOT."/templates/$this->template/css/extracss.php");
	}
	if ($analyticsPosition == "before") { echo $analytics; } ?>
	</head>

	<body class="<?php echo $bodyClass ?>">
			<div id="fontHeadings" <?php if (($fonts) && ($fontStackHeading[1] !=="-")) { ?>class="<?php echo $fontStackHeading ?>"<?php } ?>>
	 		<?php if($debug) { ?>
				<div class="notice">
				<?php echo $errorMessages ?>
				</div>
			<?php }


	if ($legacy) { require("$legacyFile"); }

	elseif($layout=="mobile") { require("$mobileFiles"); }

	else {
	/* 
	 *  If open.php was found in the layout folder, include it
	 */
	if ($openFile) : require("$openFile"); 
	else : 
	?>

	<div class="fullwrap<?php if($mobilemenu=="1") { ?> selectmenu<?php }?><?php if($mobilemenu=="2") { ?> togglemenu<?php }?>">
		
		<?php // Toggle Menu for small screens
			if($mobilemenu =="2" && $this->countModules('togglemenu')) { 
		?>
		<div id="togglemenu">
			<div id="togglemenutrigger">
				<?php echo $mobileMenuTitle ?>
			</div>
			<div id="togglemenucontent">
				<jdoc:include type="modules" name="togglemenu" style="jbChrome" />
			</div>
		</div>
	<?php }
	endif; 

	/* 
	 *  If top.php was found in the layout folder, include it
	 */
	if (($top > "0" && $topMob) or ($socialicons && $socialiconsposition =="top" && $topMob) or ($socialicons && $socialiconsposition =="top1" && $topMob)) {
		if ($topFile) : require("$topFile"); 
		else : ?>
			<div id="topwrap">
				<div class="container <?php echo $containerPosition ?>">
					<div class="row">
						<div class="inner">
							<div id="topwrapper">
								<?php if($this->countModules('top1') or ($splitMenu && $splitMenuNavPos =="top1")  or ($socialiconsposition =="top1" && $socialicons)) : ?>
									<div id="top1" class="grid_<?php echo $top1Cols; ?>">
										<?php if ($splitMenu && $splitMenuNavPos =="top1") {
										if($debug) { echo $splitmenudebug; }
										require(YOURBASEPATH .DS."layout/splitmenuTop.php"); 
														
										} ?>
										
										<?php if($debug) { echo $top1debug; } ?>
										<jdoc:include type="modules" name="top1" style="jbChrome" />
										<?php if ($socialiconsposition =="top1" && $socialicons) { require(YOURBASEPATH .DS."layout/socialicons.php"); } ?>
									</div>
								<?php endif; ?>
								<?php if($this->countModules('top2')) : ?>
									<div id="top2" class="grid_<?php echo $top2Cols; ?> <?php echo $top2class ?>">
										<?php if($debug) { echo $top2debug; } ?>
										<jdoc:include type="modules" name="top2" style="jbChrome" />
									</div>
								<?php endif; ?>
								<?php if($this->countModules('top3')) : ?>
									<div id="top3" class="grid_<?php echo $top3Cols; ?> <?php echo $top3class ?>">
										<?php if($debug) { echo $top3debug; } ?>
										<jdoc:include type="modules" name="top3" style="jbChrome" />
									</div>
								<?php endif; ?>
								<?php if($this->countModules('top4') or ($socialiconsposition =="top" && $socialicons)) : ?>
									<div id="top4" class="grid_<?php echo $top4Cols; ?> zenlast">
										<?php if($debug) { echo $top4debug; } ?>
										<jdoc:include type="modules" name="top4" style="jbChrome" />
										<?php if ($socialiconsposition =="top" && $socialicons) { require(YOURBASEPATH .DS."layout/socialicons.php"); } ?>
									</div>
								<?php endif; ?>
							</div> 
						</div>
					</div>
				</div>
			</div> <!-- Top wrapper -->
	<?php 
		endif;
	}
	
	if(($menuCount && $navMob && $menuposition =="topmenu") or ($logoPosition =="below" && $navMob && $menuposition =="topmenu")) : 
	/* 
	 *  If nav.php was found in the layout folder, include it
	 */	
	if ($navFile) : require("$navFile");
	else : ?>
			<!-- Nav wrapper -->
			<div id="navwrap">
				<div class="topmenu container <?php echo $containerPosition ?>">
					<div class="row">
						<div class="inner">
							<div id="navwrapper" >
								<?php if($debug) { echo $logodebug; } ?>
								<?php if ($logoPosition =="top") { 
										require(YOURBASEPATH .DS."layout/logo.php"); 			
								} ?>
					
								<div id="nav" class="grid_<?php echo $navCols; ?> <?php echo $fontStackNav ?> <?php echo $navposition ?>">
									<div id="menuwrap" <?php if($mobilemenu) { ?>class="hide"<?php } ?>>
										<?php if ($splitMenu && $splitMenuNavPos =="menu") {
											if($debug) { echo $splitmenudebug; }
												require(YOURBASEPATH .DS."layout/splitmenuTop.php"); 
											} else { 
											 	if($debug) { echo $menudebug; } ?>
													<jdoc:include type="modules" name="menu" style="jbChrome" />
											<?php } ?>
										</div>

									<?php if($mobilemenu =="1") { ?>
										<div id="mobilemenu" title="<?php echo $mobileMenuTitle?>"></div>
									<?php } ?>
								</div>									
							</div>
						</div>	
					</div>
				</div>
			</div>
			<div class="clear"></div>
			<!-- Nav wrapper -->
	<?php
	endif;
		endif;	

	/* 
	 *  If header.php was found in the layout folder, include it
	 */	
	if (($logoPosition == "above" or $header > "0" && $headerMob) or ($socialicons && $socialiconsposition =="header" && $headerMob)) {
		if ($headerFile) : require("$headerFile");
		else : ?>
		<!-- Logo wrapper -->
		<div id="headerwrap">
			<div class="container <?php echo $containerPosition ?>">
				<div class="row">
					<div class="inner">

										<?php if ($logoPosition =="above") { 
											if($debug) { echo $logodebug; }  

											require(YOURBASEPATH .DS."layout/logo.php"); 


										} ?>

										<?php if (!($logoPosition =="above")) { ?>
										<div id="header1"  class="grid_<?php echo $header1Cols; ?>">
												<?php if($debug) { echo $header1debug; } ?>
												<jdoc:include type="modules" name="header1" style="jbChrome" />
										</div> 								
										<?php } ?>

										<?php if($this->countModules('header2')) : ?>
										<div id="header2"  class="grid_<?php echo $header2Cols; ?> <?php echo $header2class ?>">
												<?php if($debug) { echo $header2debug; } ?>
												<jdoc:include type="modules" name="header2" style="jbChrome" />
										</div>
										<?php endif; ?>

										<?php if($this->countModules('header3')) : ?>
										<div id="header3"  class="grid_<?php echo $header3Cols; ?> <?php echo $header3class ?>">
												<?php if($debug) { echo $header3debug; } ?>
												<jdoc:include type="modules" name="header3" style="jbChrome" />
										</div>
										<?php endif; ?>

										<?php if($this->countModules('header4') or ($socialicons && $socialiconsposition =="header")) : ?>
										<div id="header4"  class="grid_<?php echo $header4Cols; ?> zenlast">
											<?php if($debug) { echo $header4debug; } ?>
												<jdoc:include type="modules" name="header4" style="jbChrome" />
												<?php if ($socialicons && $socialiconsposition =="header") { require(YOURBASEPATH .DS."layout/socialicons.php"); } ?>
										</div>
										<?php endif; ?>
									
								</div>
						</div>
				</div>
		</div>
		<!-- Logo wrapper -->
	<?php 
	endif; } 
	if ($logoPosition == "logo" && $logoMob) {
	if ($logoOverride) : require("$logoOverride");
	else : ?>

				<div id="logowrap">
					<div class="container <?php echo $containerPosition ?>">
						<div class="row">
							<div class="inner">
									<?php if($debug) { echo $logodebug; } ?>					
									<?php if ($logoPosition =="logo") { 

										require(YOURBASEPATH .DS."layout/logo.php"); 
 								
									} ?>
							</div>
						</div>
					</div>
				</div>
	<?php 
	endif;
	}

	if(($menuCount && $navMob && $menuposition =="menu") or ($logoPosition =="below" && $navMob && $menuposition =="menu")) : 
	/* 
	 *  If nav.php was found in the layout folder, include it
	 */	
	if ($navFile) : require("$navFile");
	else : ?>
			<!-- Nav wrapper -->
			<div id="navwrap">
				<div class="menu container <?php echo $containerPosition ?>">
					<div class="row">
						<div class="inner">
							<div id="navwrapper">
								<?php if($debug) { echo $logodebug; } ?>
								<?php if ($logoPosition =="below") { 
										require(YOURBASEPATH .DS."layout/logo.php"); 			
								} ?>
								
								<div id="nav" class="grid_<?php echo $navCols; ?> <?php echo $fontStackNav ?> <?php echo $navposition ?>">
									<div id="menuwrap" <?php if($mobilemenu) { ?>class="hide"<?php } ?>>
										<?php if($splitMenu && $splitMenuNavPos =="menu") { 
											if($debug) { echo $splitmenudebug; }
												require(YOURBASEPATH .DS."layout/splitmenuTop.php"); 
											} else { 
											 	if($debug) { echo $menudebug; } ?>
													<jdoc:include type="modules" name="menu" style="jbChrome" />
											<?php } ?>
									</div>
									<?php if($mobilemenu =="1") { ?>
										<div id="mobilemenu" title="<?php echo $mobileMenuTitle?>"></div>
									<?php } ?>
								</div>								
							</div>
						</div>	
					</div>
				</div>
			</div>
			<div class="clear"></div>
			<!-- Nav wrapper -->
	<?php
	endif;
		endif;	?>
		

		<?php
		// Display messages even if the front page main content area is hidden
		if (!$showMainArea) { ?>
		
		<div id="messageswrap">
			<div class="container <?php echo $containerPosition ?>">
				<div class="row">
					<div class="inner">
						<jdoc:include type="message" />
					</div>
				</div>
			</div>
		</div>
	<?php } 		
	/* 
	 *  If banner.php was found in the layout folder, include it
	 */				
	if(($banner && $bannerMob) or ($socialicons && $socialiconsposition =="banner" && $bottomMob)) {
		if ($bannerFile) : require("$bannerFile");
		else : ?>
				<!-- Banner wrapper -->
				<div id="bannerwrap">
					<div class="container <?php echo $containerPosition ?>">
						<div class="row">
							<div class="inner">
								<div id="banner" style="width:100%">
										<?php if($debug) { echo $bannerdebug; } ?>
										<jdoc:include type="modules" name="banner" style="jbChrome" />
										<?php if ($socialiconsposition =="banner" && $socialicons) { require(YOURBASEPATH .DS."layout/socialicons.php"); } ?>
								</div> 								
							</div>
						</div>
					</div>
				</div>
				<!-- Banner wrapper -->
	<?php
	endif; 
	}


	/* 
	 *  If tabs.php was found in the layout folder, include it
	 */				
	if(($tabs) && $tabMob) {
		if ($tabFile) : require("$tabFile");
		else : ?>
	
			<!-- Tab Row wrapper -->
			<div id="tabwrap">
				<div class="container <?php echo $containerPosition ?>">
					<div class="row">
						<div class="inner">
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
								        	<div id="jbtab2" class="jbtab_content jbtabwidth<?php echo $tab2Count; ?> <?php echo $tab2class ?>">
								           		<div class="jbtab2">
														<?php if($debug) { echo $tab2debug; } ?>
														<jdoc:include type="modules" name="tab2" style="jbChrome" />
												</div>
											</div>
										<?php endif; ?>

										<?php if($this->countModules('tab3')) : ?>
								        	<div id="jbtab3" class="jbtab_content jbtabwidth<?php echo $tab3Count; ?> <?php echo $tab3class ?>">
								           		<div class="jbtab3">
														<?php if($debug) { echo $tab3debug; } ?>
														<jdoc:include type="modules" name="tab3" style="jbChrome" />
												</div>
											</div>
										<?php endif; ?>

										<?php if($this->countModules('tab4')) : ?>
								        	<div id="jbtab4" class="jbtab_content jbtabwidth<?php echo $tab4Count; ?> zenlast">
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
			<!-- Tabs wrapper -->
	<?php

	endif; 

	}


	/* 
	 *  If grid1.php was found in the layout folder, include it
	 */
	if (($grid1 > "0" && $grid1Mob) or ($socialicons && $socialiconsposition =="grid1" && $bottomMob)) {
		if ($grid1File) : require("$grid1File"); 
		else : ?>
				<!-- First Row Grid -->
			<div id="grid1wrap">
				<div class="container <?php echo $containerPosition ?>">
					<div class="row">
						<div class="inner">
							<div class="grid1wrap">

								<?php if($this->countModules('grid1')) : ?>
									<div id="grid1" class="grid_<?php echo $grid1Cols; ?>">
										<?php if($debug) { echo $grid1debug; } ?>
										<jdoc:include type="modules" name="grid1" style="jbChrome" />
									</div>
								<?php endif; ?>
								<?php if($this->countModules('grid2')) : ?>
									<div id="grid2" class="grid_<?php echo $grid2Cols; ?> <?php echo $grid2class ?>">
										<?php if($debug) { echo $grid2debug; } ?>
										<jdoc:include type="modules" name="grid2" style="jbChrome" />
									</div>
								<?php endif; ?>
								<?php if($this->countModules('grid3')) : ?>
									<div id="grid3" class="grid_<?php echo $grid3Cols; ?> <?php echo $grid3class ?>">
										<?php if($debug) { echo $grid3debug; } ?>
										<jdoc:include type="modules" name="grid3" style="jbChrome" />
									</div>
								<?php endif; ?>
								<?php if($this->countModules('grid4') or ($socialiconsposition =="grid1" && $socialicons)) : ?>
									<div id="grid4" class="grid_<?php echo $grid4Cols; ?> zenlast">
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
	if ($grid2 > "0" && $grid2Mob) { 
		if ($grid2File) : require("$grid2File"); 
		else : ?>
				<!-- Second Row Grid -->
				<div id="grid2wrap">
					<div class="container <?php echo $containerPosition ?>">
						<div class="row">
							<div class="inner">
								<div class="grid2wrap">

									<?php if($this->countModules('grid5')) : ?>
										<div id="grid5" class="grid_<?php echo $grid5Cols; ?>">
											<?php if($debug) { echo $grid5debug; } ?>
											<jdoc:include type="modules" name="grid5" style="jbChrome" />
										</div>
									<?php endif; ?>
									<?php if($this->countModules('grid6')) : ?>
										<div id="grid6" class="grid_<?php echo $grid6Cols; ?> <?php echo $grid6class ?>">
											<?php if($debug) { echo $grid6debug; } ?>
											<jdoc:include type="modules" name="grid6" style="jbChrome" />
										</div>
									<?php endif; ?>
									<?php if($this->countModules('grid7')) : ?>
										<div id="grid7" class="grid_<?php echo $grid7Cols; ?> <?php echo $grid7class ?>">
											<?php if($debug) { echo $grid7debug; } ?>
											<jdoc:include type="modules" name="grid7" style="jbChrome" />
										</div>
									<?php endif; ?>
									<?php if($this->countModules('grid8')) : ?>
										<div id="grid8" class="grid_<?php echo $grid8Cols; ?> zenlast">
											<?php if($debug) { echo $grid8debug; } ?>
											<jdoc:include type="modules" name="grid8" style="jbChrome" />
										</div>
									<?php endif; ?>

								</div>
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
	if ($grid3 > "0" && $grid3Mob) {
		if ($grid3File) : require("$grid3File");
		else : ?>
				<!-- Third Row Grid -->
				<div id="grid3wrap">
					<div class="container <?php echo $containerPosition ?>">
						<div class="row">
							<div class="inner">
								<div class="grid3wrap">
									<?php if($this->countModules('grid9')) : ?>
										<div id="grid9" class="grid_<?php echo $grid9Cols; ?>">
											<?php if($debug) { echo $grid9debug; } ?>
											<jdoc:include type="modules" name="grid9" style="jbChrome" />
										</div>
									<?php endif; ?>
									<?php if($this->countModules('grid10')) : ?>
										<div id="grid10" class="grid_<?php echo $grid10Cols; ?> <?php echo $grid10class ?>">
											<?php if($debug) { echo $grid10debug; } ?>
											<jdoc:include type="modules" name="grid10" style="jbChrome" />
										</div>
									<?php endif; ?>
									<?php if($this->countModules('grid11')) : ?>
										<div id="grid11" class="grid_<?php echo $grid11Cols; ?> <?php echo $grid11class ?>">
											<?php if($debug) { echo $grid11debug; } ?>
											<jdoc:include type="modules" name="grid11" style="jbChrome" />
										</div>
									<?php endif; ?>
									<?php if($this->countModules('grid12')) : ?>
										<div id="grid12" class="grid_<?php echo $grid12Cols; ?> zenlast">
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
			if($_GET["option"]=="" && $_GET["view"]==""){
				?><?php
			}
		?>
			<div id="mainwrap"
<?php			if($_GET["option"]=="com_content" && $_GET["view"]=="featured"){
					?>style="display:none"<?php
				}
			?>>
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
	<?php
	}
	endif;
	}
 
	/* 
	 *  If grid4.php was found in the layout folder, include it
	 */
	if ($grid4 > "0" && $grid4Mob) {
		if ($grid4File) : require("$grid4File");
		else : ?>
		<!-- Fourth Row Grid -->
		<div id="grid4wrap">
			<div class="container <?php echo $containerPosition ?>">
				<div class="row">
					<div class="inner">
						<div class="grid4wrap">

								<?php if($this->countModules('grid13')) : ?>
										<div id="grid13" class="grid_<?php echo $grid13Cols; ?>">
												<?php if($debug) { echo $grid13debug; } ?>
												<jdoc:include type="modules" name="grid13" style="jbChrome" />
										</div>
								<?php endif; ?>
								<?php if($this->countModules('grid14')) : ?>
										<div id="grid14" class="grid_<?php echo $grid14Cols; ?> <?php echo $grid14class ?>">
												<?php if($debug) { echo $grid14debug; } ?>
												<jdoc:include type="modules" name="grid14" style="jbChrome" />
										</div>
								<?php endif; ?>
								<?php if($this->countModules('grid15')) : ?>
										<div id="grid15" class="grid_<?php echo $grid15Cols; ?> <?php echo $grid15class ?>">
												<?php if($debug) { echo $grid15debug; } ?>
												<jdoc:include type="modules" name="grid15" style="jbChrome" />
										</div>
								<?php endif; ?>
								<?php if($this->countModules('grid16')) : ?>
										<div id="grid16" class="grid_<?php echo $grid16Cols; ?> zenlast">
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
	if ($grid5 > "0" && $grid5Mob) { 
		if ($grid5File) : require("$grid5File"); 
		else : ?>
				<!-- Fifth Row Grid -->
				<div id="grid5wrap">
					<div class="container <?php echo $containerPosition ?>">
						<div class="row">
							<div class="inner">
								<div class="grid5wrap">

											<?php if($this->countModules('grid17')) : ?>
												<div id="grid17" class="grid_<?php echo $grid17Cols; ?>">
													<?php if($debug) { echo $grid17debug; } ?>
													<jdoc:include type="modules" name="grid17" style="jbChrome" />
												</div>
											<?php endif; ?>
											<?php if($this->countModules('grid18')) : ?>
												<div id="grid18" class="grid_<?php echo $grid18Cols; ?> <?php echo $grid18class ?>">
													<?php if($debug) { echo $grid18debug; } ?>
													<jdoc:include type="modules" name="grid18" style="jbChrome" />
												</div>
											<?php endif; ?>
											<?php if($this->countModules('grid19')) : ?>
												<div id="grid19" class="grid_<?php echo $grid19Cols; ?> <?php echo $grid19class ?>">
													<?php if($debug) { echo $grid19debug; } ?>
													<jdoc:include type="modules" name="grid19" style="jbChrome" />
												</div>
											<?php endif; ?>
											<?php if($this->countModules('grid20')) : ?>
												<div id="grid20" class="grid_<?php echo $grid20Cols; ?> zenlast">
													<?php if($debug) { echo $grid20debug; } ?>
													<jdoc:include type="modules" name="grid20" style="jbChrome" />
												</div>
											<?php endif; ?>

								</div>				
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
	if (($grid6 > "0" && $grid6Mob) or ($socialicons && $socialiconsposition =="grid6" && $grid6Mob)) {
		if ($grid6File) : require("$grid6File"); 
		else : ?>
	
				<!-- Sixth Row Grid -->
				<div id="grid6wrap">
					<div class="container <?php echo $containerPosition ?>">
						<div class="row">
							<div class="inner">
								<div class="grid6wrap">

										<?php if($this->countModules('grid21')) : ?>
												<div id="grid21" class="grid_<?php echo $grid21Cols; ?>">
														<?php if($debug) { echo $grid21debug; } ?>
														<jdoc:include type="modules" name="grid21" style="jbChrome" />
												</div>
										<?php endif; ?>
										<?php if($this->countModules('grid22')) : ?>
												<div id="grid22" class="grid_<?php echo $grid22Cols; ?> <?php echo $grid22class ?>">
														<?php if($debug) { echo $grid22debug; } ?>
														<jdoc:include type="modules" name="grid22" style="jbChrome" />
												</div>
										<?php endif; ?>
										<?php if($this->countModules('grid23')) : ?>
												<div id="grid23" class="grid_<?php echo $grid23Cols; ?> <?php echo $grid23class ?>">
														<?php if($debug) { echo $grid23debug; } ?>
														<jdoc:include type="modules" name="grid23" style="jbChrome" />
												</div>
										<?php endif; ?>
										<?php if($this->countModules('grid24') or ($socialiconsposition =="grid6" && $socialicons)) : ?>
												<div id="grid24" class="grid_<?php echo $grid24Cols; ?> zenlast">
														<?php if($debug) { echo $grid24debug; } ?>
														<jdoc:include type="modules" name="grid24" style="jbChrome" />
														<?php if ($socialiconsposition =="grid6" && $socialicons) { require(YOURBASEPATH .DS."layout/socialicons.php"); } ?>
												</div>
										<?php endif; ?>
									
								</div>
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
	if (($bottom > "0" && $bottomMob) or ($socialicons && $socialiconsposition =="bottom" && $bottomMob)) {
		if ($bottomFile) : require("$bottomFile"); 
		else : ?>
				<!-- Bottom Row bottom -->
				<div id="bottomrow">
						<div class="container <?php echo $containerPosition ?>">
							<div class="row">
								<div class="inner">						
										<div id="bottom">
											<?php if($this->countModules('bottom1')) : ?>
												<div id="bottom1" class="grid_<?php echo $bottom1Cols; ?>">
													<?php if($debug) { echo $bottom1debug; } ?>
													<jdoc:include type="modules" name="bottom1" style="jbChrome" />
												</div>
											<?php endif; ?>
											<?php if($this->countModules('bottom2')) : ?>
												<div id="bottom2" class="grid_<?php echo $bottom2Cols; ?> <?php echo $bottom2class ?>">
													<?php if($debug) { echo $bottom2debug; } ?>
													<jdoc:include type="modules" name="bottom2" style="jbChrome" />
												</div>
											<?php endif; ?>
											<?php if($this->countModules('bottom3')) : ?>
												<div id="bottom3" class="grid_<?php echo $bottom3Cols; ?> <?php echo $bottom3class ?>">
													<?php if($debug) { echo $bottom3debug; } ?>
													<jdoc:include type="modules" name="bottom3" style="jbChrome" />
												</div>
											<?php endif; ?>
											<?php if($this->countModules('bottom4')) : ?>
												<div id="bottom4" class="grid_<?php echo $bottom4Cols; ?> <?php echo $bottom4class ?>">
													<?php if($debug) { echo $bottom4debug; } ?>
													<jdoc:include type="modules" name="bottom4" style="jbChrome" />
												</div>
											<?php endif; ?>
											<?php if($this->countModules('bottom5')) : ?>
												<div id="bottom5" class="grid_<?php echo $bottom5Cols; ?> <?php echo $bottom5class ?>">
													<?php if($debug) { echo $bottom5debug; } ?>
													<jdoc:include type="modules" name="bottom5" style="jbChrome" />
												</div>
											<?php endif; ?>
											<?php if($this->countModules('bottom6') or ($socialiconsposition =="bottom" && $socialicons)) : ?>
												<div id="bottom6" class="grid_<?php echo $bottom6Cols; ?> zenlast">
													<?php if($debug) { echo $bottom6debug; } ?>
													<jdoc:include type="modules" name="bottom6" style="jbChrome" />
													<?php if ($socialiconsposition =="bottom" && $socialicons) { require(YOURBASEPATH .DS."layout/socialicons.php"); } ?>
												</div>
											<?php endif; ?>
										
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Bottom Row bottom -->
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
				<div id="footerwrap">
					<div class="container <?php echo $containerPosition ?>">
						<div class="row">
							<div class="inner">
								<div id="footer">
									<div id="footerLeft" class="grid_<?php echo $footerCols ?>">
										<?php if($debug) { echo $footerdebug; } ?>
										<jdoc:include type="modules" name="footer" style="jbChrome" />
										<?php if ($socialiconsposition =="footer" && $socialicons) { require(YOURBASEPATH .DS."layout/socialicons.php"); } ?>
									</div>
							

									<!-- Copyright -->				
									<div id="footerRight">
										<?php if (!$removejblogo) { ?>
											<a target="_blank" href="http://www.joomlabamboo.com"><img class="jbLogo" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/jb.png" alt="Joomla Bamboo" /></a>
										<?php } ?>

										<?php if ($customcopyright !=="") { 
											echo $customcopyright;
										 } ?>
									</div>			
								</div>						
							</div> <!-- innerContainer -->
						</div>	<!-- containerBG -->					
					</div> <!-- Container -->
				</div>

	<?php
	endif;

	/* 
	 *  If panel.php was found in the layout folder, include it
	 */
	if ($panel > "0") {
		if ($panelFile) : require("$panelFile");
		else : ?>
			<?php if($this->countModules('panel1') || $this->countModules('panel2') || $this->countModules('panel3') || $this->countModules('panel4')) : ?>
			<!-- The tab on top -->	
			<div id="zenpaneltrigger" class="tab width<?php echo $tWidth ?>">
				
					
						<a id="zenpanelopen" href="#"><?php echo $openPanel ?></a>
						<a id="zenpanelclose" href="#"><?php echo $closePanel ?></a>
					
				
			</div>

			<div id="zenpanel" style="width:<?php echo $panelWidth ?>px;height: <?php echo $panelHeight ?>px" class="overlay">
				<a id="zenpanelclose2" rel="#panelInner" href="#"><?php echo $closePanel ?></a>
				<div id="zenpanelInner">
			
					<?php if($this->countModules('panel1')) : ?>
						<div id="panel1" class="grid_<?php echo $panelWidths ?>">
							<jdoc:include type="modules" name="panel1" style="jbChrome"/>
						</div>
					<?php endif; ?> 
					<?php if($this->countModules('panel2')) : ?>
						<div id="panel2" class="grid_<?php echo $panelWidths ?> <?php echo $panel2class ?>">
							<jdoc:include type="modules" name="panel2" style="jbChrome"/>
						</div>
					<?php endif; ?> 
					<?php if($this->countModules('panel3')) : ?>
						<div id="panel3" class="grid_<?php echo $panelWidths ?> <?php echo $panel3class ?>">
							<jdoc:include type="modules" name="panel3" style="jbChrome"/>
						</div>
					<?php endif; ?> 
					<?php if($this->countModules('panel4')) : ?>
						<div id="panel4" class="grid_<?php echo $panelWidths ?> zenlast">
							<jdoc:include type="modules" name="panel4" style="jbChrome"/>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<div id="zenoverlay"></div>

		<?php endif; ?>
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
	</div>	<!-- Full wrap -->	
</div>
	<div class="clear"></div>
	<?php if ($socialiconsposition =="fixedleft" or $socialiconsposition =="fixedright" && $socialicons) { require(YOURBASEPATH .DS."layout/socialicons.php"); } ?>
	<jdoc:include type="modules" name="debug" style="jbChrome" />
	<?php if($debug) { echo $themedebug; } ?>
	<?php // End Legacy Layout override
	} ?>
	__BOTTOMSCRIPTS__
	<?php 
	if ($bottomScripts) {?>
		<script type="text/javascript">
			<?php echo $zengridJS; ?>
		</script>
		<?php }
	if ($analyticsPosition == "after") { echo $analytics; } 

		if($googlefonts){
		?>
			<script type="text/javascript">
				WebFontConfig = { 
			        google: { families: [ <?php foreach($gfonts as $font) {	echo $font; if(!($font == $lastfont)){echo ',';}} ?>]}
			      };
				(function() {
				        var wf = document.createElement('script');
				        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
				            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
				        wf.type = 'text/javascript';
				        wf.async = 'true';
				        var s = document.getElementsByTagName('script')[0];
				        s.parentNode.insertBefore(wf, s);
				      })();

			</script>
			<?php } ?>

			<?php if( $browserType == "msie" && $this->params->get('css3pierules') && $this->params->get('css3pie') == 1 ) { ?>
			<style>
				<?php echo $this->params->get('css3pierules'); ?>  { behavior: url( <?php echo $frameworkMedia; ?>/js/tools/PIE.htc); }
			</style>
			<?php }	?>
		</body>
		</html>
		<?php } ?>