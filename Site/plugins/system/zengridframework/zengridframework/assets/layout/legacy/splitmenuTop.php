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

	
	if ($splitMenu) {
		// Splitmenu: Get the first level of the menu "mainmenu"
			$main_menu = Yth::getSplitMenu('mainmenu', 0, 1);
			echo $main_menu;

			if ($splitMenuPos =="subnav") { 
				
			echo '<div id="subnav">';
																			
			// Splitmenu: Get all but the first level of the menu "topmenu"
				$main_menu = Yth::getSplitMenu($splitMenuName, 1, 9);
				echo $main_menu;
				
			echo '</div>';
			}
		}  


?>