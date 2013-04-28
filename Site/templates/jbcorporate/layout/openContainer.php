<?php
/**
 * @package		Joomla Bamboo Zen Grid Framework
 * @version		v2.0
 * @author		Joomlabamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2010 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * The Zen Grid Framework is a templating framework that uses the Joomla Content Manament System (http://www.joomla.org)
 * This file is called if the openContainer layout override is enabled and is placed in the templates/[your template name]/layout folder. 
 */
 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );
?>
<?php if($this->countModules('background')) : ?>
<div id="background">
	<jdoc:include type="modules" name="background" style="jbChrome" />
	<?php if($this->params->get("bgpixels")) { ?>
		<div id="backgroundpixel"></div>
	<?php } ?>
	<div id="backgroundoverlay"></div>
</div>
 <?php endif; ?>
<div class="fullWrap<?php if($this->countModules('top1 or top2 or top3 or top4')) { ?> topenabled<?php } ?>">
		<?php // Toggle Menu for small screens
			if($mobilemenu =="2" && $this->countModules('togglemenu')) { 
		?>
		<div id="togglemenu">
			<div id="togglemenutrigger">
				<?php echo $mobileMenuTitle ?>
			</div>
			<div id="togglemenucontent">
				<jdoc:include type="modules" name="togglemenu" style="jbChrome" />
			</div>
		</div>
	<?php } ?>