<?php 
defined('_JEXEC') or die();


/**
 * @package		Joomla Bamboo Zen Grid Framework
 * @Type        Core Framework Files - Manually loads the scripts for the zgf and JB extensions into the head of the index file.
 * @version		v2.0
 * @author		Joomlabamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2010 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

if(file_exists( JPATH_ROOT."/templates/$this->template/layout/splitmenuSidebar.php")) 
{ 
	require(JPATH_ROOT."/templates/$this->template/layout/splitmenuSidebar.php");   
}
else {
	
	// Splitmenu: Get all but the first level of the menu "topmenu"
	$main_menu = Zengrid::getSplitMenu($splitMenuName, 1, 9);
	
	if ($main_menu) {
	echo '<div id="jbSplitMenu">';
		echo '<h3><span>';
			echo $splitMenuTitle;
		echo '</span></h3>';
		
	
	echo $main_menu;
	echo '</div>';
}
}
?>