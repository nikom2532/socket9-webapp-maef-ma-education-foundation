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


class JFormFieldK2itemslist extends JFormField
{
   protected   $type = 'k2itemslist';

   protected function getInput()
   {
      	$db =& JFactory::getDBO();
		$size = ( $this->element['size'] ? $this->element['size'] : 5 );
			$query = 'SELECT id, title FROM #__k2_items WHERE published = 1 
			AND trash = 0
			AND unix_timestamp(publish_up) <= '.time().' AND (unix_timestamp(publish_down) >= '.time().' OR unix_timestamp(publish_down)=0) ORDER BY title';
	      $db->setQuery($query);
	      $options = $db->loadObjectList();
		$k2items=array();
		// Create the 'all categories' listing
		$k2items[0]->id = '';
		$k2items[0]->title = JText::_("Select all Items");
		foreach ($options as $result) {
			array_push($k2items,$result);

		}

	      return JHTML::_('select.genericlist',  $k2items, ''.$this->formControl.'[params]['.$this->fieldname.'][]',  'class="inputbox" style="width:90%;" multiple="multiple" size="5"', 'id', 'title', $this->value, $this->id);
   	}
}