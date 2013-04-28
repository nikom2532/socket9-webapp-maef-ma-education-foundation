<?php
/**
 * @package		Joomla Bamboo Zen Grid Framework
 * @version		v2.0
 * @author		Joomal Bamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2010 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * The Zen Grid Framework is a templating framework that uses the Joomla Content Manament System (http://www.joomla.org)
 * This file is called if the grid3 layout override is enabled and is placed in the templates/[your template name]/layout folder. 
 */
 

// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );
?>

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