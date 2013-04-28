<?php
defined('_JEXEC') or die('Restricted access');

/**
 * This is a file to add template specific chrome to module rendering.  To use it you would
 * set the style attribute for the given module(s) include in your template to use the style
 * for each given modChrome function.
 *
 * eg.  To render a module mod_test in the sliders style, you would use the following include:
 * <jdoc:include type="module" name="test" style="slider" />
 *
 * This gives template designers ultimate control over how modules are rendered.
 *
 * NOTICE: All chrome wrapping methods should be named: modChrome_{STYLE} and take the same
 * three arguments.
 */


/**
 * Custom module chrome, echos the whole module in a <div> and the header in <h{x}>. The level of
 * the header can be configured through a 'headerLevel' attribute of the <jdoc:include /> tag.
 * Defaults to <h3> if none given
 */

function modChrome_jbChrome($module, &$params, &$attribs)
{
     
	if (!empty ($module->content)) : ?>
		<div class="moduletable<?php echo $params->get('moduleclass_sfx'); ?>">
			
			<?php if ($module->showtitle) : ?>
			<div class="moduleTitle">
				<h3><span><?php echo $module->title; ?></span></h3>
			</div>
			<?php endif; ?>
			
			
			<?php if (strpos($params->get('moduleclass_sfx'),"-slide") == "false") { ?>
			<div class="jbslideContent jbmoduleBody" id="jbSlide<?php echo $module->id; ?>">
			<?php echo $module->content; ?>
			</div>
			<?php } ?>
			
			
			
			<?php if (!(strpos($params->get('moduleclass_sfx'),"-slide") == "true")) { ?>
			<div class="jbmoduleBody">
			<?php echo $module->content; ?>
			</div>
			<?php } ?>
			
			
		</div>
	<?php endif;  

}


function modChrome_jbBottom($module, &$params, &$attribs)
{
     
		?>
			<div class="moduletable<?php echo $params->get('moduleclass_sfx'); ?>">

				<?php if ($module->showtitle) : ?>
				<div class="moduleTitle">
					<h3><span><?php echo $module->title; ?></span></h3>
				</div>
				<?php endif; ?>


				<?php if (strpos($params->get('moduleclass_sfx'),"-slide") == "false") { ?>
				<div class="jbslideContent jbmoduleBody" id="jbSlide<?php echo $module->id; ?>">
				<?php echo $module->content; ?>
				</div>
				<?php } ?>



				<?php if (!(strpos($params->get('moduleclass_sfx'),"-slide") == "true")) { ?>
				<div class="jbmoduleBody">
				<?php echo $module->content; ?>
				</div>
				<?php } ?>


			</div>
		<?php 

}