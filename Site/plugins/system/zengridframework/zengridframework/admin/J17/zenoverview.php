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

class JFormFieldZenoverview extends JFormField
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	
	protected $type = 'zenoverview';

    protected function getInput()
	{
		$class          = (string) $this->element['class'];
		
		$app = JFactory::getApplication();
		jimport('joomla.environment.browser');
		//require_once(JPATH_ROOT.DS.'/templates/zengridframework/admin/classes/zengrid.php');
		$document =& JFactory::getDocument();
		$document->addStylesheet(JURI::root(true).'/templates/zengridframework/admin/css/zentabs.css');
		$document->addScript(JURI::root(true).'/templates/zengridframework/admin/js/zentabs.js');
		$browser = JBrowser::getInstance();
		if (substr_count(strtolower($browser->getBrowser()), 'msie') && $browser->getVersion() < 8) $document->addStylesheet(JURI::root(true).'/templates/zengridframework/admin/css/zentabs_ie.css');

		JHTML::_('behavior.modal', 'a.modal');
		
		
		return '<div class="zengridoverview ">' . JText::_('TPL_ZEN_GRID_FRAMEWORK_OVERVIEW'). '</div>';
	}

        public function getLabel() {
            return '<span class="hideLabel ' . $class . '">' . parent::getLabel() . '</span>';
        }

	



}
?>

 