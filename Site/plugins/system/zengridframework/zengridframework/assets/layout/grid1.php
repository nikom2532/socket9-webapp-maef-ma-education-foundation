<?php
/**
 * @package		Joomla Bamboo Zen Grid Framework
 * @version		v2.0
 * @author		Joomal Bamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2010 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * The Zen Grid Framework is a templating framework that uses the Joomla Content Manament System (http://www.joomla.org)
 * This file is called if the grid1 layout override is enabled and is placed in the templates/[your template name]/layout folder. 
 */
  
// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );
?>

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