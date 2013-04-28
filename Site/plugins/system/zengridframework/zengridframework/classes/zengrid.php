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

class Zengrid
{
	private $manifest;
	private $template;
	
	public function getTemplate()
	{
		if (!isset($this->template))
		{
			$request = JRequest::get();
			$this->template = $request['cid'][0];
		}
			
		return $this->template;
	}
	
	public function getFramework()
	{
		return 'plugins/system/zengridframework';
	}
	
	
	public function getFrameworkMedia()
	{
		return 'media/system/zengridframework';
	}
	
	public function loadLanguage()
	{
					$lang =& JFactory::getLanguage();
					$extension = 'plg_system_zengridframework';
					$base_dir = JPATH_SITE.'/administrator';
					$language_tag = 'en-GB';
					$lang->load($extension, $base_dir, $language_tag, true);
				
	}
	
	
	public function getManifest()
	{
		if (!isset($this->manifest))
		{
			$this->manifest = simplexml_load_file(JPATH_ROOT.DS.'templates'.DS.self::getTemplate().DS.'templateDetails.xml');
		}
		return $this->manifest;
	}
	
	public function frameworkDetails()
	{
		if (!isset($this->frameworkDetails))
		{
			$this->frameworkDetails = simplexml_load_file(JPATH_ROOT.DS.'plugins/system/zengridframework.xml');
		}
		return $this->frameworkDetails;
	}
	
	
	public function currentZenVersion()
	{
		if (!isset($this->zenversion))
		{
			$this->zenversion = simplexml_load_file('http://joomlabamboo.com/zengridframework.xml');
		}
		return $this->zenversion;
	}
	
	public function getParam($param)
	{
		if (isset($this->_parent->_registry['_default']['data']->$param)) {
			return $this->_parent->_registry['_default']['data']->$param;
		}
		else {
			return false;
		}
	}
	
	public function oldversionCheck()
	{
			if (!isset($this->oldversionCheck))
			
				$oldframework = JPATH_ROOT.DS.'templates/zengridframework/index.php';
				if (file_exists($oldframework)){ 
					return 1;
			}		
	}
	
	public function jbLibraryCheck()
	{
			if (!isset($this->jbLibraryCheck))
			
				$jblibrary = JPATH_ROOT.DS.'plugins/system/jblibrary.php';
				if (file_exists($jblibrary)){ 
					return 1;
			}	
	}
	
	private function _hasCURL()
	{
		return $result = function_exists('curl_init');
	}
	
	private function _getCurl($url)
	{
		$result = false;		
		$curlhandle = curl_init($url);
		curl_setopt($curlhandle, CURLOPT_AUTOREFERER, true);
		curl_setopt($curlhandle, CURLOPT_FAILONERROR, true);
		curl_setopt($curlhandle, CURLOPT_HEADER, false);
		curl_setopt($curlhandle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curlhandle, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curlhandle, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($curlhandle, CURLOPT_TIMEOUT, 30);
		$result = curl_exec($curlhandle);
		curl_close($curlhandle);
		
		return $result;
	}
	
	private function _mergeLatestGFonts($fontArray)
	{
		return $fontArray;
	}
	
	public function getFontArray($exptime = 86400)
	{
		jimport('joomla.filesystem.file');
		$app =& JFactory::getApplication();
		$fontCache = JPATH_ROOT.DS.'cache'.DS.'zengridframework'.DS.'fonts'.DS.'zenfonts.json';
		$customfontlist = JPATH_ROOT.DS.'templates'.DS.self::getTemplate().DS.'zenfontlist.php';
		if (file_exists($customfontlist)) {
			$baseFontPath = JPATH_ROOT.DS.'templates'.DS.self::getTemplate().DS.'zenfontlist.php';
		}
		else {
			$baseFontPath = JPATH_ROOT.DS.'plugins'.DS.'system'.DS.'zengridframework'.DS.'assets'.DS.'zenfontlist.php';
		}
		$overrideFontPath = JPATH_ROOT.DS.'templates'.DS.self::getTemplate().DS.'includes'.DS.'zenfontlist.php';
		$zgf_plugin = JPluginHelper::getPlugin( 'system', 'zengridframework' );
        $zgf_params = new JParameter( $zgf_plugin->params );
		$fontOverride = $zgf_params->get('fontOverride','none');
		$standardFontsList = array();
		$gserifFontsList = array();
		$gsansFontsList = array();
		$ghandFontsList = array();
		$gdisplayFontsList = array();
		static $fontArray = array();
		
		if((JFile::exists($fontCache)) and (time() - filemtime($fontCache) >= $exptime)){
			if(($fontOverride != 'replace') or ($fontOverride == 'none')){
				require($baseFontPath);
				$fontArray = array_merge($standardFontsList,$gserifFontsList,$gsansFontsList,$ghandFontsList,$gdisplayFontsList);
				$fontArray = self::_mergeLatestGFonts($fontArray);
			}
			if ((JFile::exists($overrideFontPath)) and $fontOverride != 'none'){ 
				require($overrideFontPath);
				if($fontOverride == 'add'){
					$fontArray = array_merge($standardFontsList,$gserifFontsList,$gsansFontsList,$ghandFontsList,$gdisplayFontsList,$fontArray);
				}elseif($fontOverride == 'remove'){
					print_r($gserifFontsList);
					$fontArray = array_diff_key($fontArray,$standardFontsList,$gserifFontsList,$gsansFontsList,$ghandFontsList,$gdisplayFontsList);
				}elseif($fontOverride == 'replace'){
					$fontArray = array_merge($standardFontsList,$gserifFontsList,$gsansFontsList,$ghandFontsList,$gdisplayFontsList);
				}
				
			}
			
			JFile::write($fontCache, json_encode($fontArray));
			return $fontArray;
		}else{
			if($fontArray)
			{
				return $fontArray;
			}
			elseif (JFile::exists($fontCache)){
				$fontCacheJson = file_get_contents($fontCache);
				$tempFontArray = (array)json_decode($fontCacheJson);
				$fontArray = array();
				foreach($tempFontArray as $key=>$value){
					$fontArray[$key]=(array)$value;
				}
				return $fontArray;
			}else{
				
				if(($fontOverride != 'replace') or ($fontOverride == 'none')){
					require($baseFontPath);
					$fontArray = array_merge($standardFontsList,$gserifFontsList,$gsansFontsList,$ghandFontsList,$gdisplayFontsList);
					$fontArray = self::_mergeLatestGFonts($fontArray);
				}
				if ((JFile::exists($overrideFontPath)) and $fontOverride != 'none'){ 
					require($overrideFontPath);
					if($fontOverride == 'add'){
						$fontArray = array_merge($standardFontsList,$gserifFontsList,$gsansFontsList,$ghandFontsList,$gdisplayFontsList,$fontArray);
					}elseif($fontOverride == 'remove'){
						print_r($gserifFontsList);
						$fontArray = array_diff_key($fontArray,$standardFontsList,$gserifFontsList,$gsansFontsList,$ghandFontsList,$gdisplayFontsList);
					}elseif($fontOverride == 'replace'){
						$fontArray = array_merge($standardFontsList,$gserifFontsList,$gsansFontsList,$ghandFontsList,$gdisplayFontsList);
					}

				}

				JFile::write($fontCache, json_encode($fontArray));
				return $fontArray;
			}
		}
	}
	
 	static public function getTplParams(){
      $app =& JFactory::getApplication();
      $cont = null;
      $ini   = JPATH_THEMES.DS.$app->getTemplate().DS.'params.ini';
      $xml   = JPATH_THEMES.DS.$app->getTemplate().DS.'templateDetails.xml';
      jimport('joomla.filesystem.file');
      if (JFile::exists($ini)) {
         $cont = JFile::read($ini);
      } else {
         $cont = null;
      }
      return new JParameter($cont, $xml, $app->getTemplate());      
   }

	/*
    * Method to get the HTML of a splitmenu
    *
    * @static
    * @access public
    * @param string $menu 
    * @param int $startLeve
    * @param int $endLevel
    * @param bool $show_children
    * @return string
    */
   public function getSplitMenu( $menu = 'mainmenu', $startLevel = 0, $endLevel = 1, $show_children = false ) 
   {
       // Import the module helper
       jimport('joomla.application.module.helper');

       // Get a new instance of the mod_mainmenu module
       $module =& JModuleHelper::getModule( 'mod_mainmenu', 'mainmenu' );
       if(!empty($module) && is_object($module)) {

           // Construct the module parameters (as a string)
           $params = "menutype=".$menu."\n" 
               . "showAllChildren=".$show_children."\n"
               . "startLevel=".$startLevel."\n"
               . "endLevel=".$endLevel;
           $module->params = $params;

           // Construct the module options
           $options = array( 'style' => 'raw' );

           // Render this module
           $document =& JFactory::getDocument();
           $renderer = $document->loadRenderer('module');
           $output = $renderer->render($module, $options);
           return $output;
       }

       return null;
   }

   /*
    * Method to determine whether a certain module is loaded or not
    *
    * @static
    * @access public
    * @param string $name
    * @return boolean
    */
	public function hasModule($name, $title = null )
	{
		$result		= false;
		$modules	=& self::_load();
		$total		= count($modules);
		for ($i = 0; $i < $total; $i++)
		{
			// Match the name of the module
			if ($modules[$i]->name == $name)
			{
				// Match the title if we're looking for a specific instance of the module
				if ( ! $title || $modules[$i]->title == $title )
				{
					$result = true;
					break;	// Found it
				}
			}
		}

		return $result;
	}
	
	/*
	    * Method to determine the number of modules published to a templates module position
	    *Replicated from core J helper
	    * @static
	    * @access public
	    * @param string $condition
	    * @return int
	    */
	public function countModules($condition)
	{
		$result = '';

		$words = explode(' ', $condition);
		for($i = 0; $i < count($words); $i+=2)
		{
			// odd parts (modules)
			$name		= strtolower($words[$i]);
			$words[$i]	= ((isset($this->_buffer['modules'][$name])) && ($this->_buffer['modules'][$name] === false)) ? 0 : count(self::getModules($name));
		}

		$str = 'return '.implode(' ', $words).';';

		return eval($str);
	}
	
	/*
	    * Method to determine the number of modules published to a templates module position

		    * @static
		    * @access public
		    * @param string $name
		    * @return Module Object array
		    */
	public function getModules($position)
	{
		$position	= strtolower( $position );
		$result		= array();

		$modules =& self::_load();

		$total = count($modules);
		for($i = 0; $i < $total; $i++) {
			if($modules[$i]->position == $position) {
				$result[] =& $modules[$i];
			}
		}
		if(count($result) == 0) {
			if(JRequest::getBool('tp')) {
				$result[0] = JModuleHelper::getModule( 'mod_'.$position );
				$result[0]->title = $position;
				$result[0]->content = $position;
				$result[0]->position = $position;
			}
		}

		return $result;
	}
	
   /*
    * Method to return a certain modules parameters
    *
    * @static
    * @access public
    * @param string $name
    * @return array
    */
   public function getModuleParams($name = '')
   {
       // Import the module helper
       jimport('joomla.application.module.helper');

       $module = JModuleHelper::getModule($name);
       if(is_object($module)) {
           $mod_params = new JParameter( $module->params );
           return $mod_params;
       }

       return false;
   }


/*
    * Method to return a certain module parameter for every instance of a module
    *
    * @static
    * @access public
    * @param string $name
    * @return array
    */
   public function getModuleParamArray($name = '',$param = '')
   {
       	
		$result		= array();
		$modArray 	= array();
		$modules	=& self::_load();
		$total		= count($modules);
		for ($i = 0; $i < $total; $i++)
		{
			// Match the name of the module
			if ($modules[$i]->name == $name)
			{
				$modArray[] =& $modules[$i];
			}
		}
// Import the module helper
       jimport('joomla.application.module.helper');
		foreach ($modArray as $module){
	       if(is_object($module)) {
	           $mod_params = new JParameter( $module->params );
	           $result[] = $mod_params->get($param);
	       }
		}

		return $result;
   }

/*
    * Method to verify if a certain module has a certain parameter value
    *
    * @static
    * @access public
    * @param string $name, $param, $value
    * @return boolean
    */
   public function hasModuleParamValue($name = '',$param = '', $value = '')
   {
		return in_array($value,self::getModuleParamArray($name,$param));	
   }


/*
    * Method to return a certain modules parameters for plugin events
    *
    * @static
    * @access public
    * @param string $name
    * @return array
    */
   public function getModuleParamsZGF($name = '')
   {
       // Import the module helper
       jimport('joomla.application.module.helper');

       $module = self::getModule($name);
       if(is_object($module)) {
           $mod_params = new JParameter( $module->params );
           return $mod_params;
       }

       return false;
   }

/*
    * Method to return a module 
    *
    * @static
    * @access public
    * @param string $name
    * @return Module Object
    */

	function getModule($name, $title = null )
	{
		$result		= null;
		$modules	=& self::_load();
		$total		= count($modules);
		for ($i = 0; $i < $total; $i++)
		{
			// Match the name of the module
			if ($modules[$i]->name == $name)
			{
				// Match the title if we're looking for a specific instance of the module
				if ( ! $title || $modules[$i]->title == $title )
				{
					$result =& $modules[$i];
					break;	// Found it
				}
			}
		}

		// if we didn't find it, and the name is mod_something, create a dummy object
		if (is_null( $result ) && substr( $name, 0, 4 ) == 'mod_')
		{
			$result				= new stdClass;
			$result->id			= 0;
			$result->title		= '';
			$result->module		= $name;
			$result->position	= '';
			$result->content	= '';
			$result->showtitle	= 0;
			$result->control	= '';
			$result->params		= '';
			$result->user		= 0;
		}

		return $result;
	}

	/**
	 * Load published modules
	 *
	 * @access	private
	 * @return	array
	 */
	function &_load()
	{
		global $mainframe, $Itemid;

		static $modules;

		if (isset($modules)) {
			return $modules;
		}

		$user	=& JFactory::getUser();
		$db		=& JFactory::getDBO();

		$aid	= $user->get('aid', 0);

		$modules	= array();

		$wheremenu = isset( $Itemid ) ? ' AND ( mm.menuid = '. (int) $Itemid .' OR mm.menuid = 0 )' : '';

		$query = 'SELECT id, title, module, position, content, showtitle, control, params'
			. ' FROM #__modules AS m'
			. ' LEFT JOIN #__modules_menu AS mm ON mm.moduleid = m.id'
			. ' WHERE m.published = 1'
			. ' AND m.access <= '. (int)$aid
			. ' AND m.client_id = '. (int)$mainframe->getClientId()
			. $wheremenu
			. ' ORDER BY position, ordering';

		$db->setQuery( $query );

		if (null === ($modules = $db->loadObjectList())) {
			JError::raiseWarning( 'SOME_ERROR_CODE', JText::_( 'Error Loading Modules' ) . $db->getErrorMsg());
			return false;
		}

		$total = count($modules);
		for($i = 0; $i < $total; $i++)
		{
			//determine if this is a custom module
			$file					= $modules[$i]->module;
			$custom 				= substr( $file, 0, 4 ) == 'mod_' ?  0 : 1;
			$modules[$i]->user  	= $custom;
			// CHECK: custom module name is given by the title field, otherwise it's just 'om' ??
			$modules[$i]->name		= $custom ? $modules[$i]->title : substr( $file, 4 );
			$modules[$i]->style		= null;
			$modules[$i]->position	= strtolower($modules[$i]->position);
		}

		return $modules;
	}


   /*
    * Method to get the parent Menu-Item of the current page
    *
    * @static
    * @access public
    * @param int $level
    * @return string
    */
   public function getActiveParent($level = 0) 
   {
       // Fetch the active menu-item
       $menu = JSite::getMenu();
       $active = $menu->getActive();

       // Get the parent (at a certain level)
       $parent = $active->tree[$level];

       // Return the title of this Menu-Item
       return $menu->getItem($parent)->name;
   }

   /*
    * Method to determine whether the current page is the Joomla! homepage
    *
    * @static
    * @access public
    * @param null
    * @return bool
    */
   public function isHome() 
   {
       // Fetch the active menu-item
       $menu = JSite::getMenu();
       $active = $menu->getActive();

       // Return whether this active menu-item is home or not
		if (isset($active))
       return (boolean)$active->home;
		else return false;
   }

   /*
    * Method to add a global title to every page title
    *
    * @static
    * @access public
    * @param string $global_title
    * @return null
    */
   public function addGlobalTitle( $global_title = null ) 
   {
       // Get the current title
       $document = JFactory::getDocument();
       $title = $document->getTitle();

       // Add the global title to the current title
       $document->setTitle( $title . '' . $global_title );
   }

   /*
    * Method to detect a certain browser type
    *
    * @static
    * @access public
    * @param string $shortname
    * @return string
    */
   public function isBrowser($shortname = 'ie6')
   {
       jimport('joomla.environment.browser'); 
       $browser = JBrowser::getInstance(); 
		$agent = $browser->getAgentString();

       $rt = false;
       switch($shortname) {
           case 'ie6':
               $rt = (stripos($agent, 'msie 6')) ? true : false;
               break;

           case 'ie7':
               $rt = (stripos($agent, 'msie 7')) ? true : false;
               break;

           case 'ie8':
               $rt = (stripos($agent, 'msie 8')) ? true : false;
               break;
       }

       return $rt;
   }

/*
    * Method to return browser type
    *
    * @static
    * @access public
    * @param none
    * @return string
    */
   public function getBrowser()
   {
       jimport('joomla.environment.browser'); 
       $browser = JBrowser::getInstance(); 
	   $agent_string = $browser->getAgentString();

       
		if(stripos($agent_string,'firefox') !== false) :
			$agent = 'firefox';
		elseif(stripos($agent_string, 'chrome') !== false) :
			$agent = 'chrome';
		elseif(stripos($agent_string, 'msie 8') !== false) :
			$agent = 'ie8';
		elseif(stripos($agent_string, 'msie 7') !== false) :
			$agent = 'ie7';
		elseif(stripos($agent_string, 'msie 6') !== false) :
			$agent = 'ie6';
		elseif(stripos($agent_string,'iphone') !== false || stripos($agent_string,'ipod') !== false) :
			$agent = 'iphone';
		elseif(stripos($agent_string,'ipad') !== false) :
			$agent = 'ipad';
		elseif(stripos($agent_string,'blackberry') !== false) :
			$agent = 'blackberry';
		elseif(stripos($agent_string,'palmos') !== false) :
			$agent = 'palm';
		elseif(stripos($agent_string,'android') !== false) :
			$agent = 'android';
		elseif(stripos($agent_string,'safari') !== false) :
			$agent = 'safari';
		elseif(stripos($agent_string, 'opera') !== false) :
			$agent = 'opera';
		else :
			$agent = null;
		endif;
	
		return $agent;
   }

   /* Moved the css function to the compressCss.php file.
    * Method to construct the URL for the Yireo CSS/PHP-script
    *
    * @static
    * @access public
    * @param array $stylesheets
    * @param bool $system_css
    * @return string
    */
   public function addCssPhp($stylesheets, $system_css = false) 
   {
     $template = JFactory::getApplication()->getTemplate();
       $path = 'templates/zengridframework/'.Zengrid::loadCssPhp($stylesheets, $system_css);
       echo '<link rel="stylesheet" href="'.$path.'" type="text/css" />';
   }

   /*
    * Method to construct the URL for the Yireo CSS/PHP-script
    *
    * @static
    * @access public
    * @param array $extra
    * @return string
    */
   public function loadCssPhp($sheets = array(), $system_css = false) 
   {
       // The actual file
       $css_php = 'css/css.php';

       // Detect component CSS automatically
       $option = JRequest::getCmd('option');
       if(is_file(dirname(__FILE__).'/css/'.$option.'.css')) {
           $sheets[] = $option;
       }

       // Load the sheet options
     $options = array();
     if(!empty($sheets) && is_array($sheets)) {
         $options[] = 's='.implode(',', $sheets);
     }

       // Add a SSL-flag
     if(JURI::getInstance()->isSsl()) {
         $options[] = 'ssl=1';
     }

       // Add the system CSS flag
     if($system_css == true) {
         $options[] = 'system=1';
     }

     if(!empty($options)) {
         $css_php .= '?'.implode('&amp;', $options);
     }
     return $css_php;
  }	
			
}