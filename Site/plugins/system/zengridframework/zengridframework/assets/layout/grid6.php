<?php
/**
 * @package		Joomla Bamboo Zen Grid Framework
 * @version		v2.0
 * @author		Joomal Bamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2010 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * The Zen Grid Framework is a templating framework that uses the Joomla Content Manament System (http://www.joomla.org)
 * This file is called if the grid6 layout override is enabled and is placed in the templates/[your template name]/layout folder. 
 */
 
// This file is called if the grid6 layout override is enabled and is placed in the templates/[your template name]/layout folder. 
 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );
?>

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