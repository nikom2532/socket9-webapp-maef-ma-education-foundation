<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
// import the Joomla modellist library
jimport('joomla.application.component.modellist');
/**
 * myMART3ModelmyMART3s Model
 */
class myMART3ModelGroups extends JModelList
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
		$query->select('m.id as id, u.title as title, m.onlinelearning as onlinelearning');
		$query->from('#__mymart3groups as m');
		$query->leftJoin('#__usergroups AS u ON u.id = m.groupid');
		return $query;
	}
}