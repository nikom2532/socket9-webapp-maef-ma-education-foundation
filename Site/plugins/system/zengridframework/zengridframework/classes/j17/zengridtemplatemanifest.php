<?php
/**
 * @package		Joomla Bamboo Zen Grid Framework
 * @Type        Core Framework Files
 * @version		v2.0
 * @author		Joomal Bamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2010 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

class ZengridTemplateManifest extends JObject
{
	public $name;
	public $template;
	public $creationDate;
	public $author;
	public $copyright;
	public $authorEmail;
	public $authorUrl;
	public $version;
	public $description;
	public $positions;
	
	public function __construct($xmlPath = '')
	{
		parent::__construct();
		
		if (!empty($xmlPath))
		{
			$this->loadManifestFromXML($xmlPath);
		}
	}
	
	private function loadManifestFromXML($xmlFile = '')
	{
		$xml = JFactory::getXML($xmlFile);
		
		if( ! $xml)
		{
			$this->_errors[] = JText::sprintf('File not found: %s', $xmlFile);

			return FALSE;
		}
		else
		{
			$this->name         = (string) $xml->name;
			$this->template     = (string) $xml->template;
			$this->creationDate = (string) $xml->creationDate;
			$this->author       = (string) $xml->author;
			$this->copyright    = (string) $xml->copyright;
			$this->authorEmail  = (string) $xml->authorEmail;
			$this->authorUrl    = (string) $xml->authorUrl;
			$this->version      = (string) $xml->version;
			$this->description  = (string) $xml->description;
			
			// It is not just an Array, for compatibility with current extensions version,
			// that expect $manifest->positions->position as the array.
			$this->positions    = new stdClass();
			$this->positions->position = array();
			
			foreach ($xml->positions->position as $position)
			{
				$this->positions->position[] = (string) $position;
			}
			
			return TRUE;
		}
	}
}