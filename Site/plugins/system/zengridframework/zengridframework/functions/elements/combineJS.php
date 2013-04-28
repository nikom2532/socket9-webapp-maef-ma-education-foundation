<?php 
defined('_JEXEC') or die();


/**
 * @package		Joomla Bamboo Zen Grid Framework
 * @Type        Core Framework Files
 * @version		v1.0
 * @author		Joomal Bamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2010 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
	

	// Load the Joopmla document
	$document =& JFactory::getDocument();
	$bottomscriptfiles ="";
		
	// Need to swap the reference to the file depending on the context
	if (!$combinescripts){
		$filePath = JURI::base();
	}
	else {
		$filePath = JPATH_SITE;
	}
	
	// Include JS MIn
	include_once (dirname(__FILE__).DS.'jsmin-1.1.1.php');
	
	// The files to include
    $files = array();
	
	
	$files[] = $filePath."/components/com_k2/js/k2.js";
	
	if(($jQueryVersion !=="none" && $source=="local") or ($jQueryVersion !=="none" && $source=="google" && $combinescripts)) {
		$files[] = $filePath."/media/zengridframework/js/jquery/jquery-$jQueryVersion.min.js";
		$files[] = $filePath."/media/zengridframework/js/jquery/noconflict.js";
	}
	if ($panelMenu) $files[] = $filePath."/media/zengridframework/js/menus/accordionMenu.js";
	if ($panelMenu) $files[] = $filePath."/media/zengridframework/js/menus/jquery.cookie.js";
    
    // Load core popup
    //if ($zgfPanelJS) $files[] = $filePath."/media/zengridframework/js/modal/jquery.popup.js";

	// Load reveal popup
	$reveal ="";
    if ($reveal) $files[] = $filePath."/media/zengridframework/js/modal/jquery.reveal.js";
    

    // Load Superfish
    if ($superfish) $files[] = $filePath."/media/zengridframework/js/menus/superfish.js";

	// Load Superfish Hover Intent
    if ($superfish && $sfhover) $files[] = $filePath."/media/zengridframework/js/menus/jquery.hoverIntent.minified.js";

	// Load Slide.js
    $files[] = $filePath."/media/zengridframework/js/effects/slide.js";

	// Load Hidden Panel
   	if($panel) $files[] = $filePath."/media/zengridframework/js/modal/hiddenpanel.js";
	
	
	// Load Lazyload
   	if($lazyload) $files[] = $filePath."/media/zengridframework/js/effects/jquery.lazyload.js";

	// Load JS for tabs
	if ($tabs) $files[] = $filePath."/media/zengridframework/js/tabs/jbtabs.js";
	
	// Load JS for tabs
	if ($galleria) $files[] = $filePath."/media/zengridframework/js/gallery/galleria-1.2.5.min.js";
	
	// Slideshow Scripts
	if ($this->hasSlideshow) {
	// Load Slideshow if only using
	   	if ($this->SScycleType == 'fade') {
			$files[] = $filePath."/media/zengridframework/js/effects/jquery.cycle.lite.js";  
		}
    	else {
			$files[] = $filePath."/media/zengridframework/js/effects/jquery.cycle.js"; 
		}
    }

	// Microblog CSS References
    if ($this->hasMicroblog) {
		if ($this->_MBlinkTarget == "lightbox") {
			$files[] = $filePath."/media/zengridframework/js/modal/jquery.colorbox-min.js";
		}
	}
	
	// JTweet
	if ($this->hasJTweet) $files[] = $filePath."/modules/mod_jTweet/js/jquery.tweet.js"; 
	
	// Check for extra template js
	if(file_exists( JPATH_ROOT."/templates/$this->template/js/template.js")) 
	{
		// Load the template js file
    	$files[] = $filePath."/templates/$this->template/js/template.js";
  		
	}   
	
	// Code to allow users to uipload scripts to templates/yourtemplate/user folder to have it automatically included
	$path= "templates/$this->template/user";
	
	if (JFolder::exists($path)) {
	$userfiles = JFolder::files($path, 'js', false, true);
	$result = count($userfiles);
	}
	else {
			$userfiles ="";
			$result = 0;
	}
	if($result > 0) {
		foreach($userfiles as $jsfile)
		{
			$files[] = $filePath."/$jsfile";
		}
	}


    $js = "";

	if ($combinescripts){
		// Set up the md5 hash
			$md5sum = '';
			foreach($files as $js)
			{
				$md5sum .= md5($js);
			}

		// Setting up the file name and path to the file
			$path = "cache/zengridframework/js/";
			$cache_filename = "js-".md5($md5sum).".php";
		    $cache_fullpath = $path.DS.$cache_filename;

		// Grab the cache time from the template parameters				
			$cache_time = '100000';	

		// Set up the check to see if the file exists already or hasnt expired
		// The following was originally referenced from the Motif framework created by Cory Webb.
			if (JFile::exists($cache_fullpath)) {
			    $diff = (time()-filectime($cache_fullpath));
			} else {
			    $diff = $cache_time+1;
			} 

			if ( $diff > $cache_time )
			{
				$outfile='<?php 
				ob_start ("ob_gzhandler");
				header("Content-type: application/x-javascript; charset: UTF-8");
				header("Cache-Control: must-revalidate");
				$offset = 10000000 * 60 ;
				$ExpStr = "Expires: " . 
					gmdate("D, d M Y H:i:s",
					time() + $offset) . " GMT";
				header($ExpStr);
				?>';

				foreach($files as $file)
				{
					if (JFile::exists($file)) {
						$outfile .= JFile::read($file); 

					}
				}

				// Output the combined and compressed file
				JFile::write(JPATH_ROOT.'/cache/zengridframework/js/zengrid.js', $outfile);
				$newjs = JSMin::minify(file_get_contents(JPATH_ROOT.'/cache/zengridframework/js/zengrid.js'));

				// Create the js file
			    JFile::write($cache_fullpath,$newjs);

			}

				// Set the ZengridJS variable which gets output in the zgf index
				$document->addScript(JURI::base(true)."/cache/zengridframework/js/".$cache_filename);
						
		}
		
		// If not compressing lets just load the files one by one
		elseif (!$combinescripts){
			foreach($files as $file) {
				if(!$bottomScripts) {
					if ($source=="google") {
						$document->addScript('http://ajax.googleapis.com/ajax/libs/jquery/'.$jQueryVersion.'/jquery.min.js');
					}
					$document->addScript($file);
				}
				else {
					$bottomscriptfiles .= '<script type="text/javascript" src="'.$file.'"></script>'. "\n";
				}
			}	
		}
		
		
?>