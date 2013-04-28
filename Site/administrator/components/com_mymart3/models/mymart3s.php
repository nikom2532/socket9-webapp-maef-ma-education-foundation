<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
// import the Joomla modellist library
jimport('joomla.application.component.modellist');
/**
 * myMART3ModelmyMART3s Model
 */
class myMART3ModelmyMART3s extends JModelList
{
	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return	string	An SQL query
	 */
	protected function getListQuery()
	{
		// Create a new query object.		
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		// Select some fields
		$query->select('j.id as joomlaid, j.username as joomlausername, j.email as email, m.mymart3id as mymart3id, m.onlinelearningenabled as onlinelearningenabled');
		$query->from('#__users AS j');
		$query->leftJoin('#__mymart3users AS m ON j.id = m.userid');
		return $query;
	}
}