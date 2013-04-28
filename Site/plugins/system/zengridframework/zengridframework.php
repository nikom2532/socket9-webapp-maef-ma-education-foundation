<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

if (substr(JVERSION, 0, 3) >= '1.6') {
	JLoader::register('Zengrid',JPATH_ROOT.DS.'plugins'.DS.'system'.DS.'zengridframework'.DS.'zengridframework'.DS.'classes'.DS.'j17'.DS.'zengrid.php');
}
else {
		JLoader::register('Zengrid',JPATH_ROOT.DS.'plugins'.DS.'system'.DS.'zengridframework'.DS.'classes'.DS.'zengrid.php');
}


jimport( 'joomla.plugin.plugin' );
 
/**
 * Example system plugin
 */
class plgSystemZengridframework extends JPlugin
{

	public function __construct( &$subject, $config )
	{
		parent::__construct( $subject, $config );
		
			parent::__construct( $subject );
			$this->_tplparams = Zengrid::getTplParams();
			$this->_mainframe= &JFactory::getApplication();
			$this->_template = $this->_mainframe->getTemplate();
			$this->_frameworkTemplate = file_exists(JPATH_SITE.DS.'templates'.DS.$this->_template.DS.'includes'.DS.'config.php') ? true : false;
			
			if(!($this->_frameworkTemplate)) return;  
					// load the admin language file
					$this->loadLanguage( 'plg_system_zengridframework', JPATH_ADMINISTRATOR );
					
					// Loads English language file as fallback (for undefined stuff in other language file)
					if (substr(JVERSION, 0, 3) >= '1.6') {
			              $lang =& JFactory::getLanguage();
			              $extension = 'plg_system_zengridframework';
			              $base_dir = JPATH_ADMINISTRATOR;
			              $language_tag = 'en-GB';
			              $lang->load($extension, $base_dir, $language_tag, true);
						  $this->_jscripts = "";
			          }

			          else {
			                  $lang =& JFactory::getLanguage();
			                  $extension = 'plg_system_zengridframework';
			                  $base_dir = JPATH_ADMINISTRATOR;
			                  $language_tag = 'en-GB';
			                  $lang->load($extension, $base_dir, $language_tag, true);
							  $this->_jscripts = '<script type="text/javascript" src="'.JURI::base(true).'/media/zengridframework/js/tabs/jbtabs.js"></script>';
			          }
					
			 		if($this->_mainframe->isAdmin())return;
					
					$this->_combinescripts = $this->_tplparams->get('combinescripts',0);
					$this->_bottomScripts = $this->_tplparams->get('bottomScripts', 0);
					$this->_pngfix =  $this->_tplparams->get('pngfix',0);
					$this->_pngfixrules = $this->_tplparams->get('pngfixrules','');

					$this->_jQuerySource = $this->_tplparams->get('jQuerySource','local');
					$this->_jQueryVersion = $this->_tplparams->get('jQueryVersion');
					$this->_noconflict = $this->_tplparams->get('noConflict',0);
					$this->_stripOtherJquery = $this->_tplparams->get('stripOtherJquery',1);
					$this->_scrollbottom = $this->_tplparams->get('scrollbottom');
					$this->_scrolltop = $this->_tplparams->get('scrolltop');

					$this->_removeMootools = $this->_tplparams->get('removeMootools',0);
					$this->_removeModal = $this->_tplparams->get('removeModal',0);
					$this->_removeK2 = $this->_tplparams->get('removeK2',0);
					$this->_stripCustom = $this->_tplparams->get('stripCustom',0);
					$this->_customScripts = $this->_tplparams->get('customScripts');

					$this->_stickynav = $this->_tplparams->get('stickynav',0);
					$this->_stickynavthreshold = $this->_tplparams->get('stickynavthreshold','200');
					$this->_panelMenu = $this->_tplparams->get('panelMenu',0);
					$this->_panelMenuType = $this->_tplparams->get('panelMenuType',0);
					$this->_lazyLoad = $this->_tplparams->get('lazyload',0);
					$this->_lazyloadSelector = $this->_tplparams->get('lazyloadSelector','img');
					$this->_zgfPanelJS = $this->_tplparams->get('zgfPanelJS',0);
					$this->_reveal = $this->_tplparams->get('reveal',0);//Incorporate into template parameters
					$this->_superfish = $this->_tplparams->get('superfish',0);
					$this->_sfhover = $this->_tplparams->get('sfhover',1);
					$this->_moduleslide = $this->_tplparams->get('moduleslide',0);
					$this->_hiddenpanelLoad = $this->_tplparams->get('hiddenpanelLoad',1);//Incorporate into template parameters
					$this->_browser = Zengrid::getBrowser();
					$this->_isIE6 = Zengrid::isBrowser('ie6');
					$this->_ie6Warning = $this->_tplparams->get('ie6Warning',0);

					$this->_SScycleType = "fade";//$this->_slideshowparams->get('ticker_transition',0);
					$this->_MBlinkTarget = "lightbox";//$this->_microblogparams->get('linkTarget',0);

				

					$this->_extraJS = (file_exists( JPATH_ROOT."/templates/".$this->_template."/js/template.js")) ? "1" : "0"; 

					if (!($this->_combinescripts)){
						$this->_filePath = JURI::base(true);
					}
					else {
						$this->_filePath = JPATH_SITE;
					}
			
		}
 
		
		
		function onAfterRoute()
		{
			
			if($this->_mainframe->isAdmin()){return;}
			if(!($this->_frameworkTemplate)) return;  
			$frameworkTemplateCheck = JPATH_SITE.DS.'templates'.DS.$this->_template.DS.'includes'.DS.'config.php';
			

			$document =& JFactory::getDocument();
			jimport( 'joomla.application.module.helper' );	
			
			$this->_hasMicroblog = JModuleHelper::getModule( 'microblog');
			$this->_hasSlideshow3 = JModuleHelper::getModule( 'slideshow3');
			$this->_hasJTweet = JModuleHelper::getModule( 'jTweet');
			$this->_hasJFlickr = JModuleHelper::getModule( 'jFlickr');
			$this->_hasPrettyBox = JModuleHelper::getModule( 'prettyBox');
			$this->_hasMinimoo = JModuleHelper::getModule( 'minimoo2');
			$this->_hasJflickr = JModuleHelper::getModule( 'jflickr');
			$this->_hasCaptify = JModuleHelper::getModule( 'captifyContent');	


			$panel = (Zengrid::countModules('panel1')?1:0)+ (Zengrid::countModules('panel2')?1:0)+ (Zengrid::countModules('panel3')?1:0)+ (Zengrid::countModules('panel4')?1:0);
			$tabs = (Zengrid::countModules('tab1')?1:0)+ (Zengrid::countModules('tab2')?1:0)+ (Zengrid::countModules('tab3')?1:0)+ (Zengrid::countModules('tab4')?1:0);

			$this->_k2 = (Zengrid::hasModule('k2_comments') || Zengrid::hasModule('k2_content') || Zengrid::hasModule('k2_login') || Zengrid::hasModule('k2_tools') || Zengrid::hasModule('k2_users') || JRequest::getCmd('option') == 'com_k2') ? 1 : 0 ;
			
		

			// Include JS MIn
			include_once (dirname(__FILE__).DS.'zengridframework'.DS.'functions'.DS.'elements'.DS.'jsmin-1.1.1.php');

			// Start of the array
			$files = array();

			//Only strip mootools and other files if we are combining scripts
	
			if($this->_removeMootools == 2 && $this->_combinescripts)	$files[]=$this->_filePath."/media/system/js/mootools.js";
			if($this->_removeModal == 2 && $this->_combinescripts) $files[]=$this->_filePath."/media/system/js/modal.js";
						
	
			// Check to see if we should load jQuery
			if(($this->_jQueryVersion != 'none') && (JFactory::getApplication()->get('jquery') == false))
		 		{  
					//$this->_mainframe->set('jquery', true);
					if(!$this->_bottomScripts) {
						if($this->_jQuerySource == 'local' && $this->_jQueryVersion !=="google"){ 
							$files[]=$this->_filePath."/media/zengridframework/js/jquery/jquery-".$this->_jQueryVersion.".min.js";
							if ($this->_noconflict) $files[]= $this->_filePath."/media/zengridframework/js/tools/noconflict.js";
							JFactory::getApplication()->set('jquery', true);
						}
					}
					else {
						if($this->_jQuerySource == 'local' && $this->_jQueryVersion !=="google"){ 
						$this->_jscripts .= '<script type="text/javascript" src="'.JURI::base(true).'/media/zengridframework/js/jquery/jquery-'.$this->_jQueryVersion.'.min.js"></script>';
						if ($this->_noconflict) $this->_jscripts .= '<script type="text/javascript" src="'.JURI::base(true).'/media/zengridframework/js/tools/noconflict.js"></script>';
						JFactory::getApplication()->set('jquery', true);
						}
						
					}
			
			 	}
			
					if($this->_removeMootools == 2 && $this->_combinescripts) $files[]=$this->_filePath."/components/com_k2/js/k2.js";
		
				// Panel Menu
				if ($this->_panelMenu){
					if($this->_panelMenuType == 1) {
			    		$files[]= $this->_filePath."/media/zengridframework/js/menus/accordionMenuTree.js";
					}
					else if($this->_panelMenuType !== "accordion") {
						$files[]= $this->_filePath."/media/zengridframework/js/menus/accordionMenu.js";
					}
				}
				
				if ($this->_panelMenu or $this->_moduleslide){
					$files[]= $this->_filePath."/media/zengridframework/js/menus/jquery.cookie.js";
				}
				
				if ($this->_lazyLoad) $files[]= $this->_filePath."/media/zengridframework/js/effects/jquery.lazyload.js";

			    // Load core popup
			    if ($this->_zgfPanelJS) $files[] = $this->_filePath."/media/zengridframework/js/modal/jquery.popup.js";

				// Load reveal popup
			    if ($this->_reveal) $files[] = $this->_filePath."/media/zengridframework/js/modal/jquery.reveal.js";

				// Carousel
			    //if ($this->_carousel > 0) $files[] = $this->_filePath."/media/zengridframework/js/effects/jquery.tinycarousel.min.js";

			    // Load Superfish
			    if ($this->_superfish) $files[] = $this->_filePath."/media/zengridframework/js/menus/superfish.js";

				// Load Superfish Hover Intent
			    if ($this->_superfish && $this->_sfhover) $files[] = $this->_filePath."/media/zengridframework/js/menus/jquery.hoverIntent.minified.js";

				// Load Slide.js
				$files[] = $this->_filePath."/media/zengridframework/js/effects/slide.js";

				// Load Hidden Panel
			    if (!$this->_zgfPanelJS && $panel && $this->_hiddenpanelLoad)  $files[] = $this->_filePath."/media/zengridframework/js/modal/hiddenpanel.js";

				// Load JS for tabs
				if ($tabs) $files[] = $this->_filePath."/media/zengridframework/js/tabs/jbtabs.js";
				
				// jTweet
				if($this->_hasJTweet) $files[] = $this->_filePath."/modules/mod_jTweet/js/jquery.tweet.js";

				// Minimoo2
				if($this->_hasMinimoo) $files[] = $this->_filePath."/modules/mod_minimoo2/js/jquery.flow.1.2.js";
				if($this->_hasMinimoo) $files[] = $this->_filePath."/modules/mod_minimoo2/js/jquery.easing.min.js";
				
				// jFlickr
				if($this->_hasJflickr) $files[] = $this->_filePath."/modules/mod_jflickr/js/JFlickr.js";
				if($this->_hasJflickr) $files[] = $this->_filePath."/modules/mod_jflickr/js/jquery.fancybox/jquery.fancybox-1.3.4.pack.js";

				
				// ie6 Warning
				if($this->_isIE6 && $this->_ie6Warning) {
					$files[] = $this->_filePath."/media/zengridframework/js/tools/jquery.badBrowser.js";
				} 

				// ie6 PNG Fix
				if($this->_isIE6 && $this->_pngfix) {
					$files[] = $this->_filePath."/media/zengridframework/js/pngfix/DD_belatedPNG0.0.8a-min.js";
				}


				// Slideshow Scripts
				if ($this->_hasSlideshow3) {
				// Load Slideshow if only using
				   	if ($this->_SScycleType == 'fade') {
						$files[] = $this->_filePath."/media/zengridframework/js/effects/jquery.cycle.lite.js";  
					}
			    	else {
						$files[] = $this->_filePath."/media/zengridframework/js/effects/jquery.cycle.js"; 
					}
			    }

				// Microblog CSS References
			    if ($this->_hasMicroblog) {
					if ($this->_MBlinkTarget == "lightbox") {
						$files[] = $this->_filePath."/media/zengridframework/js/modal/jquery.colorbox-min.js";
					}
				}
				
				if($this->_hasCaptify) {
					$files[] = $this->_filePath."/modules/mod_captifyContent/js/captify.tiny.js";
				}
				
				if($this->_hasPrettyBox) {
					$files[] = $this->_filePath."/media/zengridframework/js/modal/prettyPhoto/js/jquery.prettyPhoto.js";
				}

				// Load the template js file
			    if ($this->_extraJS) $files[] = $this->_filePath."/templates/$this->_template/js/template.js";   
			
				// Code to allow users to uipload scripts to templates/yourtemplate/user folder to have it automatically included
				$path= "templates/$this->_template/user";

	
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
						$files[] = $this->_filePath."/$jsfile";
					}
				}
				
			    $js = "";
				$zengridJSDec ="";
				$zengridJS ="";

				//Call Mootools Behaviour and strip  in onAfterRender if being combined or removed entirely
				//This guarantees loading order of the scripts. 
				if(($this->_jQueryVersion != 'none') && (JFactory::getApplication()->get('jquery') == false)) {
					JHTML::_(' behavior.mootools');
					if(($this->_jQuerySource == 'google') && ($this->_jQueryVersion != 'none') or ($this->_jQuerySource == 'local') && ($this->_jQueryVersion == 'google')){ 
						if(!$this->_bottomScripts) {
							$document->addScript("https://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js");
							JFactory::getApplication()->set('jquery', true);
						}
						else {
							$this->_jscripts .= '<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>'. "\n";
							JFactory::getApplication()->set('jquery', true);
						}	
					
					
						if ($this->_noconflict){
							if(!$this->_bottomScripts) {
								$document->addScript($this->_filePath."/media/zengridframework/js/tools/noconflict.js");
							}
							else {
								$this->_jscripts .= '<script type="text/javascript" src="'.JURI::base(true).'/media/zengridframework/tools/noconflict.js"></script>'. "\n";
							}
					 
						}
					}
				}

				// If we are only combining scripts.
				if (!$this->_combinescripts){
					foreach($files as $file) {
						if(!$this->_bottomScripts) {
							$document->addScript($file);
						}
						else {
							$this->_jscripts .= '<script type="text/javascript" src="'.$file.'"></script>'. "\n";
						}
					}	
				}

				// If we are caching and or combining or compressing
				if ($this->_combinescripts){

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
						$offset = 60 * 60 ;
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
							JFile::write(JPATH_ROOT.'/cache/zengridframework/js/zengridtemp.js', $outfile);
							$newjs = JSMin::minify(file_get_contents(JPATH_ROOT.'/cache/zengridframework/js/zengridtemp.js'));

							// Create the js file
						    JFile::write($cache_fullpath,$newjs);
					}

						// Set the ZengridJS variable which gets output in the zgf index
					
						if($this->_bottomScripts) {
							$this->_jscripts .= '<script type="text/javascript" src="'.JURI::base(true).'/cache/zengridframework/js/'.$cache_filename.'"></script>'. "\n";
						}
						else {
							$document =& JFactory::getDocument();
							$document->addScript(JURI::base(true)."/cache/zengridframework/js/".$cache_filename);
						}
				}				
		}
 		
		function onAfterDispatch()
		{
			
		}
		
		function onAfterRender()
		{
			// Check for clear cache command
			$clearCache = JRequest::getVar('clearcache', 0, 'get');
			if ($clearCache === 'css' || $clearCache === 'js')
			{
				$hasCache = FALSE;
				$cacheDir = JPATH_ROOT.DS.'cache'.DS.'zengridframework'.DS.$clearCache.DS;
				foreach(glob($cacheDir.'*') as $file)
				{
					chmod($file, 0777);
					unlink($file);
					$hasCache = TRUE;
				}
				
				if (file_exists($cacheDir))
				{
					chmod($cacheDir, 0777);
					rmdir($cacheDir);
				}
				
				// Check if the cache was completely cleaned
				$resp = new stdClass();
				if ($hasCache)
				{
					$resp->result = count(glob($cacheDir.'*')) > 0 ? 0 : 1;
				}
				else
				{
					$resp->result = -1;
				}
				
				JResponse::setBody(json_encode($resp));
				return true;
			}
			
			
			if($this->_mainframe->isAdmin()){return;}
			
			if(!($this->_frameworkTemplate)) return;  
			
			// ------------------------------------------------------------------------
			// Remove javascript from the page output
			// 
			$document =& JFactory::getDocument();
			$body =& JResponse::getBody();
			$panel = (ZenGrid::countModules('panel1')?1:0)+ (ZenGrid::countModules('panel2')?1:0)+ (ZenGrid::countModules('panel3')?1:0)+ (ZenGrid::countModules('panel4')?1:0);
			if ($this->_removeMootools == 2 || $this->_removeModal == 2 || $this->_removeK2 == 2 || $this->_stripCustom || $this->_removeMootools == 1 || $this->_removeModal == 1 || $this->_removeK2 == 1) {


			// ------------------------------------------------------------------------
			// Remove Mootools
			// 

			if(($this->_removeMootools == 2 && $this->_combinescripts) || ($this->_removeMootools == 1)){
				$body = preg_replace("#([\/a-zA-Z0-9_:\.-]*)mootools.js#", "", $body);
				$body = preg_replace("#([\/a-zA-Z0-9_:\.-]*)mootools-core.js#", "", $body);
				$body = preg_replace("#([\/a-zA-Z0-9_:\.-]*)mootools-more.js#", "", $body);
				$body = preg_replace("#([\/a-zA-Z0-9_:\.-]*)caption.js#", "", $body);
			}
				
			// ------------------------------------------------------------------------
			// Remove modal js
			// 
			

			if(($this->_removeModal == 2 && $this->_combinescripts) || ($this->_removeModal == 1)){
				$body = preg_replace("#([\/a-zA-Z0-9_:\.-]*)modal.js#", "", $body);
			}


			// ------------------------------------------------------------------------
			// Remove k2
			// 

			if(($this->_removeK2 == 2 && $this->_combinescripts) || ($this->_removeK2 == 1)){
				$body = preg_replace("#([\/a-zA-Z0-9_:\.-]*)k2.js#", "", $body);
			}


			// ------------------------------------------------------------------------
			// Remove custom scripts from the output
			// 
			
			if($this->_stripCustom && $this->_customScripts !=="") {
				
				$customScripts = preg_split("/[\s,]+/", trim($this->_customScripts));
			
						
					foreach($customScripts as $scriptName){
						$scriptRegex = '([\/a-zA-Z0-9_:\.-]*)'.trim($scriptName);
						$body = preg_replace("#$scriptRegex#", "", $body);
					}
				
			}
				$body = str_ireplace('<script type="text/javascript" src=""></script>', "", $body);

			}

			$scripts = $this->_bottomScripts ? $this->_jscripts : '';
			$scrollText= $this->_tplparams->get('scrollText');;
			
			
	
			// ------------------------------------------------------------------------
			// Scroll to top effect
			//

			//Load Scroll To Top if Not IE6
			$scrollIncompatible = array('ie6','iphone','ipod','ipad','blackberry','palmos','android');
			if($this->_scrolltop && !(in_array($this->_browser,$scrollIncompatible))){
				$scripts .= '
				<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery(function () {
					var scrollDiv = document.createElement("div");
					jQuery(scrollDiv).attr("id", "toTop").html("'.$scrollText.'").appendTo("body");    
					jQuery(window).scroll(function () {
							if (jQuery(this).scrollTop() != 0) {
								jQuery("#toTop").fadeIn();
							} else {
								jQuery("#toTop").fadeOut();
							}
						});
						jQuery("#toTop").click(function () {
							jQuery("body,html").animate({
								scrollTop: 0
							},
							800);
						});
					});
				});
				</script>
				';
			}

		// ------------------------------------------------------------------------
		// Scroll to bottom
		//

		if($this->_scrollbottom && !(in_array($this->_browser,$scrollIncompatible))){
			$scripts .= '
				 <script type="text/javascript">
					jQuery(document).ready(function(){
						jQuery("a.scroll").click(function() {
							if (location.pathname.replace(/^\//,"") == this.pathname.replace(/^\//,"") 
				    		&& location.hostname == this.hostname) {
				        		var jQuerytarget = jQuery(this.hash);
				        		jQuerytarget = jQuerytarget.length && jQuerytarget || jQuery("[name=\" + this.hash.slice(1) +\"]");
				        		if (jQuerytarget.length) {
				        			var targetOffset = jQuerytarget.offset().top;
				            		jQuery("html,body").animate({scrollTop: targetOffset}, 1000);
				           			return false;
				       			}
				    		}
						});
						jQuery(window).scroll(function () {
							if (jQuery(this).scrollTop() != 0) {
								jQuery(".scroll").fadeOut();
							} else {
								jQuery(".scroll").fadeIn();
							}
						});
					});
				 </script>
				';

		}

		if($this->_lazyLoad){
		// ------------------------------------------------------------------------
		// Lazyload Effect
		//
			$scripts .= '
				<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery("'.$this->_lazyloadSelector.'").lazyload({ 
			    effect : "fadeIn" 
				});
			});
			</script>
			';
		}
		
			if($this->_stickynav){
			$scripts .= '
			<script type="text/javascript">
				// Sticky Nav
				jQuery(window).scroll(function(e){ 
				    jQueryel = jQuery("#navwrap"); // element you want to scroll
				    jQueryscrolling = 0; // Position you want element to assume during scroll
				    jQuerybounds = '.$this->_stickynavthreshold.'; // boundary of when to change element to fixed and scroll

				    if (jQuery(this).scrollTop() > jQuerybounds && jQueryel.css("position") != "fixed"){ 
				        jQuery(jQueryel).css({"position": "fixed", "top": jQueryscrolling,"display": "none"}).addClass("sticky").fadeIn("slow");
				 		jQuery("body").addClass("sticky");
				    } 
				    if (jQuery(this).scrollTop() < jQuerybounds && jQueryel.css("position") != "absolute"){ 
				        jQuery(jQueryel).css({"position": "relative", "top": "0px"}).removeClass("sticky"); 
						jQuery("body").removeClass("sticky");
				    } 

				});
			</script>
			';
		}

		$body = str_replace ("__BOTTOMSCRIPTS__", $scripts, $body);
		JResponse::setBody($body);
		return true;
	}
}