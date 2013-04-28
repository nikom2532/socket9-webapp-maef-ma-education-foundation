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

class JElementZencache extends JElement
{
	var  $_name = 'Zencache';

	function fetchElement($name, $value, &$node, $control_name)
	{

		$html = '<input type="button" class="clearCacheButton" onclick="zenClearCache(this, \''.$node->attributes('section').'\', \''.JText::_('ZENCLEARCACHE_WAIT').'\',\''.JText::_('ZENCLEARCACHE_DONE').'\',\''.JText::_('ZENCLEARCACHE_ERROR').'\',\''.JText::_('ZENCLEARCACHE_NOCACHE').'\');" value="'.JText::_('ZENCLEARCACHE').'" />';
		
		return $html;
	}
		function fetchTooltip($label, $description, &$xmlElement, $control_name='', $name='') {
			return false;
		}
}