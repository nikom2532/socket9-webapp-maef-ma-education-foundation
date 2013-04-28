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
 
class JElementZenoverridechecker extends JElement
{
	

	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	
	var	$_name = 'Zenoverridechecker';

	function fetchElement($name, $value, &$node, $control_name)
	{
	
		$zgfEnabled = JPluginHelper::isEnabled ( 'system', 'zengridframework' )	;
		if ($zgfEnabled) {
			
			$style = Zengrid::getParam('style');
			$path =  JPATH_ROOT.DS.'templates'.DS.Zengrid::getTemplate().DS.'layout'.DS;
			$class = $node->attributes('class') ? 'class="' . $node->attributes('class') . '"' : '';
		
			if(file_exists($path.$name.".php")) { $html = '<img src="images/tick.png" /> '.JText::_('ZENOVERRIDEAVAILABLE').'';  }
			else { $html = '<img src="images/publish_x.png" />'.JText::_('ZENOVERRIDENOTFOUND').''; }

			$options = array();
			$options[] = JHTML::_('select.option', '1', JText::_('Enabled'));
			$options[] = JHTML::_('select.option', '0', JText::_('Disabled'));

			return JHTML::_('select.radiolist', $options, ''.$control_name.'['.$name.']', $class, 'value', 'text', $value, $control_name.$name ) . $html;
		}
	}
	
}
?>