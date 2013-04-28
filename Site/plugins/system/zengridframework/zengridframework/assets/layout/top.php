<?php
/**
 * @package		Joomla Bamboo Zen Grid Framework
 * @version		v2.0
 * @author		Joomlabamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2010 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * The Zen Grid Framework is a templating framework that uses the Joomla Content Manament System (http://www.joomla.org)
 * This file is called if the top layout override is enabled and is placed in the templates/[your template name]/layout folder. 
 */
 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );
?>

	<div id="topwrap">
		<div class="container <?php echo $containerPosition ?>">
			<div class="row">
				<div class="inner">
					<div id="topwrapper">
						<?php if($this->countModules('top1') or ($splitMenu && $splitMenuNavPos =="top1")  or ($socialiconsposition =="top1" && $socialicons)) : ?>
							<div id="top1" class="grid_<?php echo $top1Cols; ?>">
								<?php if ($splitMenu && $splitMenuNavPos =="top1") {
								if($debug) { echo $splitmenudebug; }
								require(YOURBASEPATH .DS."layout/splitmenuTop.php"); 
												
								} ?>
								
								<?php if($debug) { echo $top1debug; } ?>
								<jdoc:include type="modules" name="top1" style="jbChrome" />
								<?php if ($socialiconsposition =="top1" && $socialicons) { require(YOURBASEPATH .DS."layout/socialicons.php"); } ?>
							</div>
						<?php endif; ?>
						<?php if($this->countModules('top2')) : ?>
							<div id="top2" class="grid_<?php echo $top2Cols; ?> <?php echo $top2class ?>">
								<?php if($debug) { echo $top2debug; } ?>
								<jdoc:include type="modules" name="top2" style="jbChrome" />
							</div>
						<?php endif; ?>
						<?php if($this->countModules('top3')) : ?>
							<div id="top3" class="grid_<?php echo $top3Cols; ?> <?php echo $top3class ?>">
								<?php if($debug) { echo $top3debug; } ?>
								<jdoc:include type="modules" name="top3" style="jbChrome" />
							</div>
						<?php endif; ?>
						<?php if($this->countModules('top4') or ($socialiconsposition =="top" && $socialicons)) : ?>
							<div id="top4" class="grid_<?php echo $top4Cols; ?> zenlast">
								<?php if($debug) { echo $top4debug; } ?>
								<jdoc:include type="modules" name="top4" style="jbChrome" />
								<?php if ($socialiconsposition =="top" && $socialicons) { require(YOURBASEPATH .DS."layout/socialicons.php"); } ?>
							</div>
						<?php endif; ?>
					</div> 
				</div>
			</div>
		</div>
	</div> <!-- Top wrapper -->