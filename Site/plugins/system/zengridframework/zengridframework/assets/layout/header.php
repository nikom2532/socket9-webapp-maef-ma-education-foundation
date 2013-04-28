<?php
/**
 * @package		Joomla Bamboo Zen Grid Framework
 * @version		v2.0
 * @author		Joomlabamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2010 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * The Zen Grid Framework is a templating framework that uses the Joomla Content Manament System (http://www.joomla.org)
 * This file is called if the header layout override is enabled and is placed in the templates/[your template name]/layout folder. 
 */
 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );
?>

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