<?php
/**
 * @package		Zentools
 * @version		v1.1
 * @author		Joomlabamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2012 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
// no direct access
defined('_JEXEC') or die('Restricted access');

class JElementHeading extends JElement
{
	   var   $_name = 'Heading';
	   function fetchElement($name, $value, &$node, $control_name)
	   {

			   	//when our code starts the second td in a tr are open
			   	//we close the second td in tr

				//we close the current table and divs

				//we open the new table and divs
				//we retrieve the panel id and title attributes and add them to the toggle div
				$panel = '<div class="zenheading">
				<h4 class="zentools">
				<span>'.JText::_($node->attributes('title')).'</span>
				</h4></div>
				';
				//we allow the normal element function to close the td and tr
				return $panel;
		   }
	}
	?>
