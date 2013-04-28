<?php
/**
 * @package		Joomla Bamboo Zen Grid Framework
 * @version		v2.0
 * @author		Joomal Bamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2010 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * The Zen Grid Framework is a templating framework that uses the Joomla Content Manament System (http://www.joomla.org)
 * This file is called if the footer layout override is enabled and is placed in the templates/[your template name]/layout folder. 
 */
 
 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );
?>

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
							<?php if (!$removejblogo) { /* ?>
								<a target="_blank" href="http://www.joomlabamboo.com"><img class="jbLogo" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/jb.png" alt="Joomla Bamboo" /></a>
							<?php */ } ?>

							<?php if ($customcopyright !=="") { 
								echo $customcopyright;
							 } ?>
						</div>			
					</div>						
				</div> <!-- innerContainer -->
			</div>	<!-- containerBG -->					
		</div> <!-- Container -->
	</div>
