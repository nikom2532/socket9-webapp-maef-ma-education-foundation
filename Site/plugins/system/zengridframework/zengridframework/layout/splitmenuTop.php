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

if(file_exists( JPATH_ROOT."/templates/$this->template/layout/splitmenuTop.php")) 
{ 
	require(JPATH_ROOT."/templates/$this->template/layout/splitmenuTop.php");   
}
else {
	
	if ($splitMenuTest) {
		// Splitmenu: Get the first level of the menu "mainmenu"
			echo '<div id="splitmenu">';
				echo Zengrid::getSplitMenu($splitMenuName, $splitMenuNavStart, $splitMenuNavEnd);
			echo '</div>';
			
			if ($splitMenuNav) {
			echo '<div id="subnav">';	
			// Splitmenu: Get all but the first level of the menu "topmenu"
				echo Zengrid::getSplitMenu($splitMenuName, $splitMenuSubNavStart, $splitMenuSubNavEnd);
				
			echo '</div>';
			}
		}
}
?>