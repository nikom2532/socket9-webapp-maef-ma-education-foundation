<?php
/**
 * @package		Joomla Bamboo Zen Grid Framework
 * @Type        Core Framework Files
 * @version		v1.0
 * @author		Joomal Bamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2010 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );
jimport('joomla.html.html');
jimport('joomla.form.formfield');

/**
 * Renders a editors element
 *
 * @package 	Joomla.Framework
 * @subpackage		Form
 * @since		1.6
 */
 

	

class JFormFieldZenoverridechecker extends JFormField
{
	

	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	
	protected $type = 'zenoverridechecker';

	protected function getInput()
	{
		$zgfEnabled = JPluginHelper::isEnabled ( 'system', 'zengridframework' )	;
		if ($zgfEnabled) {
			$class          = (string) $this->element['class'];
			
			//require_once(JPATH_ROOT.DS.'/templates/zengridframework/admin/classes/zengrid.php');
			$style = Zengrid::getParam('style');
			$path =  JPATH_ROOT.DS.'templates'.DS.Zengrid::getTemplate().DS.'layout'.DS;
		
			if(file_exists($path.$this->fieldname.".php")) { $html = '<span class="overrideStatus found">'.JText::_('ZENOVERRIDEAVAILABLE').'</span>';  }
			else { $html = '<span class="overrideStatus notfound"> '.JText::_('ZENOVERRIDENOTFOUND').'</span>'; }

			$options = array();
			$options[] = JHTML::_('select.option', '1', JText::_('ZENENABLED'));
			$options[] = JHTML::_('select.option', '0', JText::_('ZENDISABLED'));

			return '<div class="overrideRow ' . $class . '">'.JHTML::_('select.radiolist', $options, $this->name, '', 'value', 'text', $this->value, $this->id ) . $html . '</div>';
		}
	} 
	
}
?>