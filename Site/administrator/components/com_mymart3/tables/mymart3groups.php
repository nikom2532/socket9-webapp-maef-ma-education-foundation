<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
 
// import Joomla table library
jimport('joomla.database.table');
 
/**
 * myMART3TablemyMART3Users class
 */
class myMART3TablemyMART3Groups extends JTable
{
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function __construct(&$db) 
	{
		parent::__construct('#__mymart3groups', 'id', $db);
	}
	
	public function bind($array, $ignore = '') 
	{ 
    if (!isset($array['onlinelearning'])) {
    	$array['onlinelearning'] = 0 ; 
    }
    return parent::bind($array, $ignore); 
	} 
}