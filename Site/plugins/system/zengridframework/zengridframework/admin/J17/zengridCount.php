<?php
/**
 * @package		Joomla Bamboo Zen Grid Framework
 * @Type        Core Framework Files
 * @version		v2.0
 * @author		Joomal Bamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2010 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );

/**
 * Renders a list element
 *
 * @package 	Joomla.Framework
 * @subpackage		Parameter
 * @since		1.5
 */
class JFormFieldZengridCount extends JFormField

{
	/**
	* Element type
	*
	* @access	protected
	* @var		string
	*/
	protected $type = 'ZengridCount';

		protected function getInput()
		{
			$class = ( $this->element['class'] ? 'class="'.$this->element['class'].'"' : 'class="inputbox"' );

			$values = array('two' => '2', 'three' => '3', 'four' => '4', 'five' => '5', 'six' => '6', 'seven' => '7', 'eight' => '8', 'nine' => '9', 'ten' => '10', 'eleven' => '11', 'twelve' => '12', 'thirteen' => '13', 'fourteen' => '14', 'sixteen' => '16');

			$options = array ();
			foreach ($values as $val => $text)
			{
				$options[] = JHTML::_('select.option', $val, JText::_($text));
			}

			return JHTML::_('select.genericlist',  $options, $this->name, $class, 'value', 'text', $this->value, $this->id);
		}


	}
