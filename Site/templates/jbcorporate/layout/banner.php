<?php
/**
 * @package		Joomla Bamboo Zen Grid Framework
 * @version		v2.0
 * @author		Joomal Bamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2010 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * The Zen Grid Framework is a templating framework that uses the Joomla Content Manament System (http://www.joomla.org)
 * This file is called if the banner layout override is enabled and is placed in the templates/[your template name]/layout folder. 
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );
?>

<!-- Banner wrapper -->
<div id="bannerwrap" style="height: <?php echo $bannerHeight; ?>px">
	<div class="container <?php echo $containerPosition ?>">
		<div class="row">
			<div class="inner">
				<div id="banner">
						<?php if($debug) { echo $bannerdebug; } ?>
						<jdoc:include type="modules" name="banner" style="jbChrome" />
						<?php if ($socialiconsposition =="banner" && $socialicons) { require(YOURBASEPATH .DS."layout/socialicons.php"); } ?>
				</div> 								
			</div>
		</div>
	</div>
</div>
<!-- Banner wrapper -->