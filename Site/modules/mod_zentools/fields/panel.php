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


/**
 * Form Field class for the Joomla Framework.
 *
 * @package		Mod_zentools
 * @subpackage	Form
 * @since		1.6
 */

class JFormFieldPanel extends JFormField
{
   protected   $type = 'Panel';

   protected function getInput()
   {
			$panelname			= (string) $this->element['panel'];
			$title			= (string) $this->element['title'];
			
		   	//when our code starts the second td in a tr are open
		   	//we close the second td in tr
			$panel = '</div>';
			//we close the current table and divs
			$panel .= '</div>';
			//we open the new table and divs
			//we retrieve the panel id and title attributes and add them to the toggle div
			$panel .= '<div id="'.$panelname.'" class="panel">
			<h3 class="zentools" id="'.$panelname.'">
			<span>'.$title.'</span>
			</h3><div class="zentools">
			';
			//we open and close the first td and open the second td
			$panel .= '';
			//we allow the normal element function to close the td and tr
			return $panel;
	   }
}
?>
