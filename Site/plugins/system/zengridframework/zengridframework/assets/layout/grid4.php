<?php
/**
 * @package		Joomla Bamboo Zen Grid Framework
 * @version		v2.0
 * @author		Joomal Bamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2010 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * The Zen Grid Framework is a templating framework that uses the Joomla Content Manament System (http://www.joomla.org)
 * This file is called if the grid4 layout override is enabled and is placed in the templates/[your template name]/layout folder. 
 */
 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );
?>
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