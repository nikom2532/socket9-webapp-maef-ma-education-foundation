<?php
/**
 * @package		Joomla Bamboo Zen Grid Framework
 * @version		v2.0
 * @author		Joomlabamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2010 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * The Zen Grid Framework is a templating framework that uses the Joomla Content Manament System (http://www.joomla.org)
 * This file is called if the panel layout override is enabled and is placed in the templates/[your template name]/layout folder. 
 */
 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );
?>
<?php if($this->countModules('panel1') || $this->countModules('panel2') || $this->countModules('panel3') || $this->countModules('panel4')) : ?>
<!-- The tab on top -->	
<div id="zenpaneltrigger" class="tab width<?php echo $tWidth ?>">
	
		
			<a id="zenpanelopen" href="#"><?php echo $openPanel ?></a>
			<a id="zenpanelclose" href="#"><?php echo $closePanel ?></a>
		
	
</div>

<div id="zenpanel" style="width:<?php echo $panelWidth ?>px;height: <?php echo $panelHeight ?>px" class="overlay">
	<a id="zenpanelclose2" rel="#panelInner" href="#"><?php echo $closePanel ?></a>
	<div id="zenpanelInner">

		<?php if($this->countModules('panel1')) : ?>
			<div id="panel1" class="grid_<?php echo $panelWidths ?>">
				<jdoc:include type="modules" name="panel1" style="jbChrome"/>
			</div>
		<?php endif; ?> 
		<?php if($this->countModules('panel2')) : ?>
			<div id="panel2" class="grid_<?php echo $panelWidths ?> <?php echo $panel2class ?>">
				<jdoc:include type="modules" name="panel2" style="jbChrome"/>
			</div>
		<?php endif; ?> 
		<?php if($this->countModules('panel3')) : ?>
			<div id="panel3" class="grid_<?php echo $panelWidths ?> <?php echo $panel3class ?>">
				<jdoc:include type="modules" name="panel3" style="jbChrome"/>
			</div>
		<?php endif; ?> 
		<?php if($this->countModules('panel4')) : ?>
			<div id="panel4" class="grid_<?php echo $panelWidths ?> zenlast">
				<jdoc:include type="modules" name="panel4" style="jbChrome"/>
			</div>
		<?php endif; ?>
	</div>
</div>
<div id="zenoverlay"></div>

<?php endif; ?>

