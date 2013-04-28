<?php
/**
 * @package		Joomla Bamboo Zen Grid Framework
 * @version		v2.0
 * @author		Joomlabamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2010 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * The Zen Grid Framework is a templating framework that uses the Joomla Content Manament System (http://www.joomla.org)
 * This file is called if the nav layout override is enabled and is placed in the templates/[your template name]/layout folder. 
 */
 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );
?>

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