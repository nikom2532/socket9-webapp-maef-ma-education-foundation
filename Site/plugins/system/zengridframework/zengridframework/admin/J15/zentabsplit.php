<?php
/**
 * @package		Joomla Bamboo Zen Grid Framework
 * @Type        Core Framework Files
 * @version		v2.0
 * @author		Joomal Bamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2010 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );

/**
 * Renders a editors element
 *
 * @package 	Joomla.Framework
 * @subpackage		Parameter
 * @since		1.5
 */

class JElementZentabsplit extends JElement
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	
	var	$_name = 'Zentabsplit';

	function fetchElement($name, $value, &$node, $control_name)
	{
		$zgfEnabled = JPluginHelper::isEnabled ( 'system', 'zengridframework' )	;
		if ($zgfEnabled) {
		
			$var			= $node->attributes( 'var' );
			$section			= $node->attributes( 'section' );
		
		
			//return '</td></tr></table></div><div id="tab2" class="mootabs_panel"><table class="adminlist"><tr><td>';
			return '</td></tr></table></div><h3 class="toggler atStart">'. $value . '</h3><div class="elements atStart"><div class="zenTitle"><h2 class="'.$section.'">' . JText::_($node->attributes('label')) . '</h2></div><table class="adminlist">';
		}
	}
	
	function fetchTooltip($label, $description, &$xmlElement, $control_name='', $name='') {
			return false;
	}

}
?>