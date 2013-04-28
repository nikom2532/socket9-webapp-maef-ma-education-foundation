<?php
/**
 * @package		Joomla Bamboo Zen bottom Framework
 * @version		v2.0
 * @author		Joomal Bamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2010 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * The Zen bottom Framework is a templating framework that uses the Joomla Content Manament System (http://www.joomla.org)
 * This file is called if the bottom layout override is enabled and is placed in the templates/[your template name]/layout folder. 
 */
 
 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );
?>
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