<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * myMART3ViewmyMART3 View
 */
class myMART3ViewmyMART3s extends JView
{
	/**
	 * myMART3 view display method
	 * @return void
	 */
	function display($tpl = null) 
	{
		// Get data from the model
		$items = $this->get('Items');
		$pagination = $this->get('Pagination');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		
		// Assign data to the view
		$this->items = $items;
		$this->pagination = $pagination;
 
		// Set the toolbar
		$this->addToolBar();

		// Display the template
		parent::display($tpl);

		// Set the document
		$this->setDocument();
	}
 
	/**
	 * Setting the toolbar
	 */
	protected function addToolBar() 
	{
		$u = JURI::getInstance();
		$updateCount = $u->getVar('updatecount','');
		if ($updateCount == '') {
			JToolBarHelper::title(JText::_('COM_MYMART3_MANAGER_MYMART3'), 'mymart3');
		} else {
		  JToolBarHelper::title(JText::_('COM_MYMART3_MANAGER_MYMART3'). ' - '. $updateCount . ' record(s) updated', 'mymart3');
		}
		
		JToolBarHelper::custom('mymart3s.refresh', 'purge', 'purge', 'Refresh', false, false);
	}
	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument() 
	{
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_MYMART3_ADMINISTRATION'));
	}
}