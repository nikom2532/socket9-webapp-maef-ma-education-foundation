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

class JFormFieldFoldsers extends JFormField
{
   protected   $type = 'Folders';

   protected function getInput()
   {
			jimport( 'joomla.filesystem.folder' );
			$filter= '.';
			$exclude = array('.svn', 'CVS','.DS_Store','__MACOSX');
			$path = JPATH_ROOT.DS.'images';
			//get list of image dirs
			$folders = JFolder::folders($path, $filter, true, true, $exclude);
			//if were on windows or local server we replace the DS
			$path = str_replace('\\', '/', $path);
			//find start of local url
			$pos = strpos($path, '/images');
			//remove root path
			$local_image = substr_replace($path, '', 0, $pos);
			$id = '/images';
			$title = '/images'.'/';
			$options =array();
			$options[] = JHTML::_('select.option', $id, $title, 'id', 'title');
			foreach($folders as $folder){
				//if were on windows or local server we replace the DS
				$folder = str_replace('\\', '/', $folder);
				//find start of local url
				$pos = strpos($folder, '/images');
				//remove root path
				$local_image = substr_replace($folder, '', 0, $pos);				
				$id = $local_image;
				$title = $local_image.'/';
				$options[] = JHTML::_('select.option', $id, $title, 'id', 'title');
			}
			return JHTML::_('select.genericlist',  $options, ''.$control_name.'['.$name.'][]', 'class="inputbox"', 'id', 'title', $value, $control_name.$name);
   }
}