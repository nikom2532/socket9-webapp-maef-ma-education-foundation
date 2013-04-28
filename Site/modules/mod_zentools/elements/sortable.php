<?php
/**
 * @package		Zentools
 * @version		v1.1
 * @author		Joomlabamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2012 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 * @package RocketTheme
 * @subpackage roktabs.elements
 */
class JElementSortable extends JElement {
	
	function fetchElement($name, $value, &$node, $control_name)
	{
	
		global $mainframe;
		$display		= $node->attributes( 'display' );
		
		// Global Document
		$document 	=& JFactory::getDocument();
		
		// Params
		$document->addStyleSheet( ''.JURI::root(true).'/modules/mod_zentools/css/admin/admin.css' );

		ob_start();	?>
		<div id="help">
			<div id="toggleAll">Toggle all panels</div>
			<!--
			<a id="masonry" href="<?php echo JURI::root() ?>/modules/mod_zentools/documentation/masonry.html" class="modal" rel="{handler: 'iframe', size: {x: 607, y: 600}}">Masonry Instructions</a>

			<a id="accordion"  href="<?php echo JURI::root() ?>/modules/mod_zentools/documentation/masonry.html" class="modal" rel="{handler: 'iframe', size: {x: 607, y: 600}}">Accordion Instructions</a>

			<a id="carousel"  href="<?php echo JURI::root() ?>/modules/mod_zentools/documentation/masonry.html" class="modal" rel="{handler: 'iframe', size: {x: 607, y: 600}}">Carousel Instructions</a>

			<a id="grid"  href="<?php echo JURI::root() ?>/modules/mod_zentools/documentation/masonry.html" class="modal" rel="{handler: 'iframe', size: {x: 607, y: 600}}">Grid Instructions</a>

			<a id="list"  href="<?php echo JURI::root() ?>/modules/mod_zentools/documentation/masonry.html" class="modal" rel="{handler: 'iframe', size: {x: 607, y: 600}}">List Instructions</a>

			<a id="twitter"  href="<?php echo JURI::root() ?>/modules/mod_zentools/documentation/masonry.html" class="modal" rel="{handler: 'iframe', size: {x: 607, y: 600}}">Twitter Instructions</a>

			<a id="slideshow"  href="<?php echo JURI::root() ?>/modules/mod_zentools/documentation/masonry.html" class="modal" rel="{handler: 'iframe', size: {x: 607, y: 600}}">Slideshow Instructions</a>--></div>


			<div id="zenmessage"><p></p></div>
			<div id="items">
				
				<ul id="sortable" class="ui-sortable">
					<li class="disabled">Drag items here to use</li>
						
				</ul>
				<ul id="sortable2" class="ui-sortable">
					<li class="disabled">Available Items</li>
				</ul>
			</div>

		
	<?php	return ob_get_clean();
	
	}
}
