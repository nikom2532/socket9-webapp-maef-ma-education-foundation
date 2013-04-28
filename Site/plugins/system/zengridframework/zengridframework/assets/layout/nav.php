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
								<?php if ($splitMenu && $splitMenuNavPos =="topmenu") {
								if($debug) { echo $splitmenudebug; }
								require(YOURBASEPATH .DS."layout/splitmenuTop.php"); 
												
								} else { ?>
									<?php if($debug) { echo $menudebug; } ?>
									<div id="menuwrap" <?php if($mobilemenu) { ?>class="hide"<?php } ?>>		
										<jdoc:include type="modules" name="menu" style="jbChrome" />
									</div>
									<?php if($mobilemenu =="1") { ?>
										<div id="mobilemenu" title="<?php echo $mobileMenuTitle?>"></div>
									<?php } 
								} ?>
							</div>						
				
					</div>
				</div>	
			</div>
		</div>
	</div>
	<div class="clear"></div>
	<!-- Nav wrapper -->