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


/***********************************************************************************************************************
 * 
 * Check that were running PHP 5.2 or newer Thanks to the Simplex framework for the inspiration.
 * 
 **********************************************************************************************************************/

version_compare(PHP_VERSION, '5.0', '<') and exit('<div style="font-size:12px;font-family: helvetica neue, arial, sans serif;width:600px;margin:0 auto;background: #f9f9f9;border:1px solid #ddd ;margin-top:100px;padding:40px;line-height:2em"><h3>The Zen Grid Framework requires PHP 5.0 or newer.</h3><p>This error means that your server is using php v4 while the Zen Grid Framework needs php5 to function properly. Often changing to php5 is a matter of adding a rule to the htaccess file on your site but it is best to ask your host for help in determining the best way to use php on your server.</p></div>');  


/***********************************************************************************************************************
 * 
 * Joomla variables and globals
 * 
 **********************************************************************************************************************/

$doc = JFactory::getDocument();

$app = JFactory::getApplication();
$base = $this->baseurl;
jimport( 'joomla.filesystem.file' );
jimport( 'joomla.html.parameter' );
jimport( 'joomla.environment.browser' );



// Thanks to the Construct Framework for this gem
/**
* @package		Unified Template Framework for Joomla!
* @author		Joomla Engineering http://joomlaengineering.com
* @copyright	Copyright (C) 2010, 2011 Matt Thomas | Joomla Engineering. All rights reserved.
* @license		GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
*/

// Is version 1.6 and later
$isOnward = (substr(JVERSION, 0, 3) >= '1.6');
// Is version 1.5
$isPresent = (substr(JVERSION, 0, 3) == '1.5');

$manifest = Zengrid::getManifest();
$xmlPositions = json_decode(json_encode($manifest->positions));
$positions = $xmlPositions->position;


/***********************************************************************************************************************
 * 
 * Return Browser information
 * 
 **********************************************************************************************************************/

$browser = &JBrowser::getInstance();
$browserType = $browser->getBrowser(); //Show what browser the user is 
$browserVersion = $browser->getMajor(); //Show what bownser version


/***********************************************************************************************************************
 * 
 * Joomla 1.7 + specific queries
 * 
 **********************************************************************************************************************/

if($isOnward) {
	jimport( 'joomla.environment.request' );
	$Itemid = JRequest::getInt('Itemid');
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query->select('t.params, t.template');
	$query->from('#__template_styles as t');
	$query->from('#__menu as m');
	$query->where('m.id = '.$Itemid);
	$query->where('m.template_style_id = t.id');
	$db->setQuery($query);
	$result = $db->loadObject();
	if($result)$this->params = new JRegistry($result->params);
}



/***********************************************************************************************************************
 * 
 * Paths and other variables
 * 
 **********************************************************************************************************************/

$templatePath = JURI::base() . 'templates/' . $app->getTemplate();
$frameworkMedia = JURI::base() . 'media/zengridframework';
$themeCSSPath = JPATH_ROOT."/templates/$this->template/css/";




/***********************************************************************************************************************
 * 
 * Parameters
 * 
 **********************************************************************************************************************/

// Determines whetehr to use the legacy switch for older non 1.2+ templates
$debug = $this->params->get("debug", "0");

// Determines whetehr to use the legacy switch for older non 1.2+ templates
$legacy = $this->params->get("legacy", "1");

// Font Variables
$fonts = $this->params->get("fonts", "1");
$fontcss = "";
$fontStackBody = $this->params->get("fontStackBody", "");
$fontStackHeading = $this->params->get("fontStackHeading", "");
$fontStackNav = $this->params->get("fontStackNav", "");
$fontStackLogo = $this->params->get("fontStackLogo", "");
$logoFontSize = $this->params->get("logoFontSize", "2em");
$googleFonts = $this->params->get("googleFonts", 0);
$fontreplaceLogo = "";
$fontreplaceBody ="";
$fontreplaceHeading ="";
$fontreplaceNav  ="";
$fontSize = $this->params->get("fontSize", "82%");
$typekit = $this->params->get("typekit", "0");
$typekitId = $this->params->get("typekitId", "");
$style = $this->params->get("style", "default");

$fontStackSelector1 = $this->params->get("fontStackSelector1");
$fontStackSelector2 = $this->params->get("fontStackSelector2");
$fontStackSelector3 = $this->params->get("fontStackSelector3");

$fontStackCustom1 = $this->params->get("fontStackCustom1");
$fontStackCustom2 = $this->params->get("fontStackCustom2");
$fontStackCustom3 = $this->params->get("fontStackCustom3");


// Logo Variables
$logoType = $this->params->get("logoType", "image");
$logoClass = $this->params->get("logoClass", "h1");
$logoText = $this->params->get("logoText", "Enter your site name here");
$logoTextSize = $this->params->get("logoTextSize", "2em");
$logoLocation = $this->params->get("logoLocation", "templates/".$this->template."/images/logo");
$logoFile = $this->params->get("logoFile", "logo.png");
$logoAltTag = $this->params->get("logoAltTag", "");
$logoLink = $this->params->get("logoLink", "");
$logoPosition = $this->params->get("logoPosition", "below");
$logoTop = $this->params->get("logoTop",0);
$logoLeft = $this->params->get("logoLeft",0);
$logoAlign = $this->params->get("logoAlign", "left");
$logoImage = $this->params->get("logoImage", "0");
$enableTagline = $this->params->get("enableTagline", "1");
$tagline = $this->params->get("tagline", "");
$taglineCSS = $this->params->get("taglineCSS", "");
$taglineTop = $this->params->get("taglineTop", "0");
$taglineLeft = $this->params->get("taglineLeft", "0");

// Media Queries and Mobile
$mediaQueries = $this->params->get("mediaQueries", 0);
$mobileMeta = $this->params->get("mobileMeta", 0);
$mobilemenu = $this->params->get("mobilemenu", 0);
$mobileTemplate = $this->params->get("mobileTemplate", 0);
$mobileTemplateName = $this->params->get("mobileTemplateName");
$mobileMenuTitle = $this->params->get("mobileMenuTitle", "Main Menu");
$mobileDetect = $this->params->get("mobileDetect", 0);
$togglemenu = $this->params->get("togglemenu", 1);
$toggletrigger = $this->params->get("toggletrigger");

// Social Icons
$socialicons = $this->params->get("socialicons", "1");
$socialiconstitle = $this->params->get("socialiconstitle", "");
$socialiconsposition = $this->params->get("socialiconsposition", "header");
$socialiconsfloat = $this->params->get("socialiconsfloat", "left");
$socialiconswidth = $this->params->get("socialiconswidth", "three");
$socialalign = $this->params->get("socialalign", "zenright");
$icon1Image = $this->params->get("icon1Image", "");
$icon2Image = $this->params->get("icon2Image", "");
$icon3Image = $this->params->get("icon3Image", "");
$icon4Image = $this->params->get("icon4Image", "");
$icon5Image = $this->params->get("icon5Image", "");
$icon6Image = $this->params->get("icon6Image", "");
$panelImage = $this->params->get("panelImage", "");

// Icon link parameters
$icon1Link = $this->params->get("icon1Link", "");
$icon2Link = $this->params->get("icon2Link", "");
$icon3Link = $this->params->get("icon3Link", "");
$icon4Link = $this->params->get("icon4Link", "");
$icon5Link = $this->params->get("icon5Link", "");
$icon6Link = $this->params->get("icon6Link", "");

//Effects
$lazyload = $this->params->get("lazyload", 0);
$llSelector = $this->params->get("llSelector", "img");



// Style Variables
$style = $this->params->get("style", "default");
$customStyle = $this->params->get("customStyle", "custom");
$pngfix = $this->params->get("pngfix", "1");
$pngfixrules = $this->params->get("pngfixrules", ".pathway img,#logo a img");
$extraScripts = $this->params->get("extraScripts", "");
$bottomScripts = $this->params->get("bottomScripts", 0);
$modalType = $this->params->get("modalType", "default");
$paneltype = $this->params->get("paneltype", "opacity");
$doc->addScriptDeclaration("var paneltype = '".$paneltype."';");
$reveal ="";
$zenTranslate = $this->params->get("zenTranslate", "0");

// Theme style sheets to load into the compressor. Set via the templateVariables.php file if needed
$extraThemeCSS = "";


// Analytics
$analytics = $this->params->get("analytics","");
$analyticsPosition = $this->params->get("analyticsPosition","after");
$csscompress = $this->params->get("csscompress","0");
$cachecompress = $this->params->get("cachecompress","0");
$cachetime = $this->params->get("cachetime","36000");
$removeMootools = $this->params->get("removeMootools","0");
$combinescripts = $this->params->get("combinescripts","1");
$compresscripts = $this->params->get("compresscripts","1");
$cachejs = $this->params->get("cachejs","1");
$removeJgen = $this->params->get("removeJgen","1");
$hilite = $this->params->get("hilite","");
$jQueryVersion = $this->params->get("jQueryVersion", "1");
$source = $this->params->get("source", "1");

// If the user has not set a hilite
if($hilite=="-1") { $hilite=0;}

$colours = $this->params->get("colours","1");


// PrettyPhoto - accessed via JB Library
$prettyPhoto = $this->params->get("prettyPhoto","0");

// Variable for selectively loading prettyphoto
$ppAnimation = $this->params->get("ppAnimation","normal");
$ppSlideshow = $this->params->get("ppSlideshow",0);
$ppSlideshowAuto = $this->params->get("ppSlideshowAuto",0);
$ppOpacity = $this->params->get("ppOpacity","0.8");
$ppTitle = $this->params->get("ppTitle",0);
$ppResize = $this->params->get("ppResize",0);
$ppDefaulWidth = $this->params->get("ppDefaultWidth",0);
$ppDefaulHeight = $this->params->get("ppDefaultHeight",0);
$ppTheme = $this->params->get("ppTheme",'facebook');

// Scripts and Performance
$disableTP = $this->params->get("disableTP","1");
$zgfPanelJS = $this->params->get("zgfPanelJS","0");

// CSS and Heading Colours
$overwriteCSS = $this->params->get("overwriteCSS", "");
$extraCSS = $this->params->get("extraCSS", "");
$firstcolor = $this->params->get('firstcolor');
$firstcolorAtt = $this->params->get('firstcolorAtt', 'color');
$firstcolorelement = $this->params->get('firstcolorelement');
$secondcolor = $this->params->get('secondcolor');
$secondcolorelement = $this->params->get('secondcolorelement');
$secondcolorAtt = $this->params->get('secondcolorAtt', 'color');
$thirdcolor = $this->params->get('thirdcolor');
$thirdcolorelement = $this->params->get('thirdcolorelement');
$thirdcolorAtt = $this->params->get('thirdcolorAtt', 'color');
$fourthcolor = $this->params->get('fourthcolor');
$fourthcolorelement = $this->params->get('fourthcolorelement');
$fourthcolorAtt = $this->params->get('fourthcolorAtt', 'color');
$fifthcolor = $this->params->get('fifthcolor');
$fifthcolorelement = $this->params->get('fifthcolorelement');
$fifthcolorAtt = $this->params->get('fifthcolorAtt', 'color');
$sixthcolor = $this->params->get('sixthcolor');
$sixthcolourelement = $this->params->get('sixthcolourelement');
$sixthcolorAtt = $this->params->get('sixthcolorAtt', 'color');
$logoColor = $this->params->get('logoColour');
$extraCSS = $this->params->get('extraCSS');

// Layout Variables
$controlMainArea = $this->params->get("controlMainArea","1");
$layoutType = $this->params->get("layoutType","960");
$tWidth = $this->params->get("tWidth","960");
$gutter = $this->params->get("gutter","40");
$containerGutter = $this->params->get("containerGutter","0");
$halfgutter = $gutter/2;
$cols = "12";
$containerPosition = $this->params->get("containerPosition","left");
$containerMargin = $this->params->get("containerMargin","280px");

$allEqual = $this->params->get("allEqual","1");
$headerEqual = $this->params->get("headerEqual","1");
$topEqual = $this->params->get("topEqual","1");
$grid1Equal = $this->params->get("grid1Equal","1");
$grid2Equal = $this->params->get("grid2Equal","1");
$grid3Equal = $this->params->get("grid3Equal","1");
$grid4Equal = $this->params->get("grid4Equal","1");
$grid5Equal = $this->params->get("grid5Equal","1");
$grid6Equal = $this->params->get("grid6Equal","1");
$bottomEqual = $this->params->get("bottomEqual","1");
$panelEqual = $this->params->get("panelEqual","1");

$useragent 	= strtolower($_SERVER['HTTP_USER_AGENT']);

// Tabs Variables
$jbtabscss ="";

// Gallery Variables
$galleria = $this->params->get("galleria", 0); 

// Menu Variables
$panelMenu = $this->params->get("panelMenu", 0); 
$superfish = $this->params->get("superfish", 1);
$sfEffect = $this->params->get("sfEffect", "5");
$sfMinWidth = $this->params->get("sfMinWidth", "27");
$sfMaxWidth = $this->params->get("sfMaxWidth", "40");
$sfSpeed = $this->params->get("sfSpeed", "normal");
$sfDelay = $this->params->get("sfDelay", "1000");
$sfhover = $this->params->get("sfhover", "true");

$panelMenuType = $this->params->get("panelMenuType");
$accordionFirst = $this->params->get("accordionFirst");
$accordionShowActive = $this->params->get("accordionShowActive");

// Split Menu Options
// ------------------------------------------------------------------------
$splitMenuTest = $this->params->get("splitMenu", 1); 
$splitMenuName = $this->params->get("splitMenuName", 'mainmenu');
$splitMenuNav = $this->params->get("splitMenuNav", 0);
$splitMenuNavPos = $this->params->get("splitMenuNavPos", 'none');
$splitMenuNavStart = $this->params->get("splitMenuNavStart", 0);
$splitMenuNavEnd = $this->params->get("splitMenuNavEnd", 1);
$splitMenuSubNavStart = $this->params->get("splitMenuSubNavStart", 1);
$splitMenuSubNavEnd = $this->params->get("splitMenuSubNavEnd", 2);
$splitMenuAbove = $this->params->get("splitMenuAbove", 1);
$splitMenuAboveStart = $this->params->get("splitMenuAboveStart", 0);
$splitMenuAboveEnd = $this->params->get("splitMenuAboveEnd", 1);
$splitMenuLeft = $this->params->get("splitMenuLeft", 1);
$splitMenuLeftTitle = $this->params->get("splitMenuLeftTitle", 'In this section ...');
$splitMenuLeftStart = $this->params->get("splitMenuLeftStart", 1);
$splitMenuLeftEnd = $this->params->get("splitMenuLeftEnd", 2);
$splitMenuRight = $this->params->get("splitMenuRight", 0);
$splitMenuRightTitle = $this->params->get("splitMenuRightTitle", 'In this section ...');
$splitMenuRightStart = $this->params->get("splitMenuRightStart", 2);
$splitMenuRightEnd = $this->params->get("splitMenuRightEnd", 3);
$splitMenu = $this->params->get("splitMenu", 1);

$splitMenuNav = (($splitMenuTest ? $splitMenuNav : $splitMenuTest) && Zengrid::getSplitMenu($splitMenuName, $splitMenuNavStart, $splitMenuNavEnd)); ;
$splitMenuRight = (($splitMenuTest ? $splitMenuRight : $splitMenuTest) && Zengrid::getSplitMenu($splitMenuName, $splitMenuRightStart, $splitMenuRightEnd));
$splitMenuLeft = (($splitMenuTest ? $splitMenuLeft : $splitMenuTest) && Zengrid::getSplitMenu($splitMenuName, $splitMenuLeftStart, $splitMenuLeftEnd));


// Panel Variables
$panelWidth = $this->params->get("panelWidth", "800");
$panelHeight = $this->params->get("panelHeight", "600");
$openPanel = $this->params->get("openPanel", "Open Panel");
$closePanel = $this->params->get("closePanel", "Close Panel");



/***********************************************************************************************************************
 * 
 * Tests to see if Joomlabamboo modules are loaded on the page
 * 
**********************************************************************************************************************/

	$this->hasMicroblog = JModuleHelper::getModule( 'microblog');
	$this->hasSlideshow = JModuleHelper::getModule( 'slideshow3');
	$this->hasJTweet = JModuleHelper::getModule( 'jTweet');
	$this->hasCaptifyContent = JModuleHelper::getModule( 'captifyContent');
	$this->hasJBlogin = JModuleHelper::getModule( 'jblogin');
	$this->hasJflickr = JModuleHelper::getModule( 'jflickr');
	$this->hasPrettybox = JModuleHelper::getModule( 'prettyBox');
	$this->hasMinimoo = JModuleHelper::getModule( 'minimoo2');
	$this->hasJflickr = JModuleHelper::getModule( 'jflickr');
	

	


/***********************************************************************************************************************
 * 
 *  A Loop through the positions to create some variables that we can use later.
 * 
 **********************************************************************************************************************/

   if(file_exists( JPATH_ROOT."/templates/$this->template/includes/config.php")) 
{ 
	include_once (JPATH_ROOT."/templates/$this->template/includes/config.php");
}
	
	
	foreach ($positions as $position) {
    	${$position.'Cols'} = $this->params->get($position.'Width');
		${$position.'class'} = "";
		${$position.'pub'} = $this->countModules($position);
  	}


// Variables for Main Width with left module only
$leftCols2L = $this->params->get("leftCols2L", "six");
$midCols2L = $this->params->get("midCols2L", "six");

// Variables for the mainwidth with right column only
$rightCols2R = $this->params->get("rightCols2R", "three");
$midCols2R = $this->params->get("midCols2R", "nine");

// Variables for the main width with left and right
$leftCols3LR = $this->params->get("leftCols3LR", "three");
$midCols3LR = $this->params->get("midCols3LR", "six");
$rightCols3LR = $this->params->get("rightCols3LR", "three");

// Variables for the main width with left and right and center
$leftCols4LRC = $this->params->get("leftCols4LRC", "three");
$midCols4LRC = $this->params->get("midCols4LRC", "six");
$rightCols4LRC = $this->params->get("rightCols4LRC", "three");
$centerCols4LRC = $this->params->get("centerCols4LRC", "three");

// Variables for the main width with left and right and center
$leftCols3LC = $this->params->get("leftCols3LC", "three");
$midCols3LC = $this->params->get("midCols3LC", "six");
$centerCols3LC = $this->params->get("centerCols3LC", "three");

// Variables for the main width with left and right and center
$rightCols3RC = $this->params->get("rightCols3RC", "three");
$midCols3RC = $this->params->get("midCols3RC", "six");
$centerCols3RC = $this->params->get("centerCols3RC", "three");

// Width for the logo and navigation
$mainLayout = $this->params->get("mainLayout", 2);
$logoCols = $this->params->get("logoWidth", "four");
$navCols = $this->params->get("navWidth", "twelve");
$navLeft = $this->params->get("navposition", "1");
$navposition = $this->params->get("navposition", "navleft");
$menuposition = $this->params->get("menuposition", "menu");

// Footer Variables
$footerCols = $this->params->get("footerWidth", "nine");
$removejblogo = $this->params->get("removejblogo", "0");
$customcopyright = $this->params->get("customcopyright", "");


// Tab trigger titles
$tab1Title = $this->params->get("tab1Title", "Featured");
$tab2Title = $this->params->get("tab2Title", "Popular");
$tab3Title = $this->params->get("tab3Title", "Latest");
$tab4Title = $this->params->get("tab4Title", "Featured");

// Counts the number of modules assigned to tab positions to calculate the iwdth for the modules.
$tab1Count = ($this->countModules('tab1'));
$tab2Count = ($this->countModules('tab2'));
$tab3Count = ($this->countModules('tab3'));
$tab4Count = ($this->countModules('tab4'));


// Scripts for modules
$zgfLoadJS = $this->params->get("zgfLoadJS", 0);
$zgfLoadCSS = $this->params->get("zgfLoadCSS", 0);



/***********************************************************************************************************************
 * 
 * Calculating Grid layouts and widths for legacy themes. Can probably remove this after v1.3 or v2.0
 * 
 **********************************************************************************************************************/

	if($legacy) {
		

		// logic for grid widths
		$contentWidth = $tWidth-($gutter*2);
		$gutters = $cols - 1;
		$margins = $gutter * $gutters;
		$colWidths = ($contentWidth-$margins)/$cols;


		// widths of each grid div
		$one = (1*$colWidths);
		$two = (2*$colWidths) + (1*$gutter);
		$three = (3*$colWidths) + (2*$gutter);
		$four = (4*$colWidths) + (3*$gutter);
		$five = (5*$colWidths) + (4*$gutter);
		$six = (6*$colWidths) + (5*$gutter);
		$seven = (7*$colWidths) + (6*$gutter);
		$eight = (8*$colWidths) + (7*$gutter);
		$nine = (9*$colWidths) + (8*$gutter);
		$ten = (10*$colWidths) + (9*$gutter);
		$eleven = (11*$colWidths) + (10*$gutter);
		$twelve = (12*$colWidths) + (11*$gutter);
		$thirteen = (13*$colWidths) + (12*$gutter);
		$fourteen = (14*$colWidths) + (13*$gutter);
		$fifteen = (15*$colWidths) + (14*$gutter);
		$sixteen = (16*$colWidths) + (15*$gutter);

	}

/***********************************************************************************************************************
 * 
 *  Code to test whether to print a row
 * 
 **********************************************************************************************************************/
		
	if ($logoPosition=="above") {
		$header = ($this->countModules('header2')?1:0)+ ($this->countModules('header3')?1:0)+ ($this->countModules('header4')); 
	}
	else  {
		if(($socialiconsposition =="header" && $socialicons)){
			$header = ($this->countModules('header1')?1:0) + ($this->countModules('header2')?1:0)+ ($this->countModules('header3')?1:0)+ 1; 
		}
		else {
			$header = ($this->countModules('header1')?1:0) + ($this->countModules('header2')?1:0)+ ($this->countModules('header3')?1:0)+ ($this->countModules('header4')); 
		}
	}

		
		if(($socialiconsposition =="grid1" && $socialicons)){
			$grid1 = ($this->countModules('grid1')?1:0)+ ($this->countModules('grid2')?1:0)+ ($this->countModules('grid3')?1:0)+ 1; 
		}
		else {
			$grid1 = ($this->countModules('grid1')?1:0)+ ($this->countModules('grid2')?1:0)+ ($this->countModules('grid3')?1:0)+ ($this->countModules('grid4')?1:0); 
		}	
		
		$grid2 = ($this->countModules('grid5')?1:0)+ ($this->countModules('grid6')?1:0)+ ($this->countModules('grid7')?1:0)+ ($this->countModules('grid8')?1:0); 
		$grid3 = ($this->countModules('grid9')?1:0)+ ($this->countModules('grid10')?1:0)+ ($this->countModules('grid11')?1:0)+ ($this->countModules('grid12')?1:0); 
		$grid4 = ($this->countModules('grid13')?1:0)+ ($this->countModules('grid14')?1:0)+ ($this->countModules('grid15')?1:0)+ ($this->countModules('grid16')?1:0); 
		$grid5 = ($this->countModules('grid17')?1:0) + ($this->countModules('grid18')?1:0) + ($this->countModules('grid19')?1:0) + ($this->countModules('grid20')?1:0); 
		
		if(($socialiconsposition =="grid6" && $socialicons)){
			$grid6 = ($this->countModules('grid21')?1:0)+ ($this->countModules('grid22')?1:0)+ ($this->countModules('grid23')?1:0)+ 1;
		}
		else {
			$grid6 = ($this->countModules('grid21')?1:0)+ ($this->countModules('grid22')?1:0)+ ($this->countModules('grid23')?1:0)+ ($this->countModules('grid24')?1:0);
		}
		if(($socialiconsposition =="top" && $socialicons)){
			$top = ($this->countModules('top1')?1:0)+ ($this->countModules('top2')?1:0)+ ($this->countModules('top3')?1:0)+ 1;
		}
		else {
			$top = ($this->countModules('top1')?1:0)+ ($this->countModules('top2')?1:0)+ ($this->countModules('top3')?1:0)+ ($this->countModules('top4')?1:0);
		}
		
		if(($socialiconsposition =="bottom" && $socialicons)){
			$bottom = ($this->countModules('bottom1')?1:0)+ ($this->countModules('bottom2')?1:0)+ ($this->countModules('bottom3')?1:0)+ ($this->countModules('bottom4')?1:0)+ ($this->countModules('bottom5')?1:0)+ 1;
		}
		else {	
			$bottom = ($this->countModules('bottom1')?1:0)+ ($this->countModules('bottom2')?1:0)+ ($this->countModules('bottom3')?1:0)+ ($this->countModules('bottom4')?1:0)+ ($this->countModules('bottom5')?1:0)+ ($this->countModules('bottom6')?1:0);}
		
		$left = ($this->countModules('left')?1:0);
		$right = ($this->countModules('right')?1:0);
		$slides = ($this->countModules('slide1')?1:0)+ ($this->countModules('slide2')?1:0)+ ($this->countModules('slide3')?1:0)+ ($this->countModules('slide4')?1:0); 
		$advert1 = ($this->countModules('advert1')?1:0)+ ($this->countModules('advert2')?1:0)+ ($this->countModules('advert3')?1:0); 
		$advert2 = ($this->countModules('advert4')?1:0)+ ($this->countModules('advert5')?1:0)+ ($this->countModules('advert6')?1:0); 
		$panel = ($this->countModules('panel1')?1:0)+ ($this->countModules('panel2')?1:0)+ ($this->countModules('panel3')?1:0)+ ($this->countModules('panel4')?1:0);
		$footer = ($this->countModules('footer')?1:0); 
		$menuCount= ($this->countModules('menu')?1:0); 
		$banner= ($this->countModules('banner')?1:0); 
		$tabs = ($this->countModules('tab1')?1:0)+ ($this->countModules('tab2')?1:0)+ ($this->countModules('tab3')?1:0)+ ($this->countModules('tab4')?1:0); 
		$panelWidths = ($this->countModules('panel1')?1:0)+ ($this->countModules('panel2')?1:0)+ ($this->countModules('panel3')?1:0)+ ($this->countModules('panel4')?1:0); 


// ------------------------------------------------------------------------
// Assigns a class of .zenlast to last module in a row
//


	if(($grid3pub) && ($grid4pub == 0 && !($socialiconsposition =="grid1" && $socialicons))) {$grid3class = "zenlast";} 
	if(($grid3pub == 0 && $grid4pub == 0  && !($socialiconsposition =="grid1" && $socialicons))) {$grid2class = "zenlast";}
	
	if(($grid7pub) && ($grid8pub == 0)) {$grid7class = "zenlast";} 
	if(($grid7pub == 0 && $grid8pub == 0)) {$grid6class = "zenlast";}
	
	if(($grid11pub) && ($grid12pub == 0)) {$grid11class = "zenlast";} 
	if(($grid11pub == 0 && $grid12pub == 0)) {$grid10class = "zenlast";}

	if(($grid15pub) && ($grid16pub == 0)) {$grid15class = "zenlast";} 
	if(($grid15pub == 0 && $grid16pub == 0)) {$grid14class = "zenlast";}
	
	if(($grid19pub) && ($grid20pub == 0)) {$grid19class = "zenlast";} 
	if(($grid19pub == 0 && $grid20pub == 0)) {$grid18class = "zenlast";}
	
	if(($grid23pub) && ($grid24pub == 0 && !($socialiconsposition =="grid6" && $socialicons))) {$grid23class = "zenlast";} 
	if(($grid23pub == 0 && $grid24pub == 0 && !($socialiconsposition =="grid6" && $socialicons))) {$grid22class = "zenlast";}
	
	if(($header3pub) && ($header4pub == 0 && !($socialiconsposition =="header" && $socialicons))) {$header3class = "zenlast";} 
	if(($header3pub == 0 && $header4pub == 0 && !($socialiconsposition =="header" && $socialicons))) {$header2class = "zenlast";}
	
	if(($top3pub) && ($top4pub == 0 && !($socialiconsposition =="top" && $socialicons))) {$top3class = "zenlast";} 
	if(($top3pub == 0 && $top4pub == 0 && !($socialiconsposition =="top" && $socialicons))){$top2class = "zenlast";}
	
	if(($advert2pub) && ($advert3pub == 0)) {$advert2class = "zenlast";} 
	if(($advert5pub) && ($advert6pub == 0)) {$advert5class = "zenlast";} 
	
	if(($panel3pub) && ($panel4pub == 0)) {$panel3class = "zenlast";} 
	if(($panel3pub == 0 && $panel4pub == 0)) {$panel2class = "zenlast";}	
		
	if(($tab3pub) && ($tab4pub == 0)) {$tab3class = "zenlast";} 
	if(($tab3pub == 0 && $tab4pub == 0)) {$tab2class = "zenlast";}
	
	if (isset($bottom5pub)) {
		// A safety just in case its an old template that doesnt have bottom5, bottom6 positions
	//	if(($bottom5pub) && ($bottom6pub == 0)) {$bottom5class = "zenlast";} 
	//	if(($bottom5pub == 0 && $bottom6pub == 0)) {$bottom4class = "zenlast";}
	}
	

	
	if(($bottom3pub == 0) && ($bottom4pub == 0) && ($bottom5pub == 0) && ($bottom6pub == 0) && !($socialiconsposition =="bottom" && $socialicons)) {$bottom2class = "zenlast";} 
	if(($bottom4pub == 0) && ($bottom5pub == 0) && ($bottom6pub == 0) && !($socialiconsposition =="bottom" && $socialicons) ) {$bottom3class = "zenlast";} 
	if(($bottom5pub == 0) && ($bottom6pub == 0) && !($socialiconsposition =="bottom" && $socialicons)) {$bottom4class = "zenlast";} 
	if(($bottom6pub == 0) && !($socialiconsposition =="bottom" && $socialicons)) {$bottom5class = "zenlast";}
	 
	
/***********************************************************************************************************************
 * 
 * Controls the file overrides and tests whether to use the override file or not
 * Set to false unless found and enabled
 * 
 **********************************************************************************************************************/

$openFile = false;
$topFile = false;
$headerFile = false;
$navFile = false;
$bannerFile = false;
$tabFile = false;
$grid1File = false;
$grid2File = false;
$grid3File = false;
$frontpageFile = false;
$mainFile = false;
$grid4File = false;
$grid5File = false;
$grid6File = false;
$bottomFile = false;
$panelFile = false;
$footerFile = false;
$closeFile = false;
$logoOverride = false;
//$slideshowFile = false;


// Check for the openContainer file
if(file_exists( JPATH_ROOT."/templates/$this->template/layout/openContainer.php") && $this->params->get('openContainer')) 
{ 
	$openFile = "templates/$this->template/layout/openContainer.php"; 
}

// Check for the top file
if(file_exists( JPATH_ROOT."/templates/$this->template/layout/top.php") && $this->params->get('top')) 
{ 
	$topFile = "templates/$this->template/layout/top.php"; 
}

// Check for the header file
if(file_exists( JPATH_ROOT."/templates/$this->template/layout/header.php") && $this->params->get('header')) 
{ 
	$headerFile = "templates/$this->template/layout/header.php";
}

// Check for the nav file
if(file_exists( JPATH_ROOT."/templates/$this->template/layout/nav.php") && $this->params->get('nav')) 
{ 
	$navFile = "templates/$this->template/layout/nav.php";
}

// Check for the banner file	
if(file_exists( JPATH_ROOT."/templates/$this->template/layout/banner.php") && $this->params->get('banner'))
{ 
	$bannerFile = "templates/$this->template/layout/banner.php"; 
}

// Check for the slideshow file	
//if(file_exists( JPATH_ROOT."/templates/$this->template/layout/slideshow.php") && $this->params->get('slideshow'))
//{ 
//	$slideshowFile = "templates/$this->template/layout/slideshow.php"; 
//}

// Check for the tab file	
if(file_exists( JPATH_ROOT."/templates/$this->template/layout/jbtabs.php"))
{ 
	$tabFile = "templates/$this->template/layout/jbtabs.php"; 
}

// Check for the grid1 file	
if(file_exists( JPATH_ROOT."/templates/$this->template/layout/grid1.php") && $this->params->get('grid1')) 
{ 
	$grid1File = "templates/$this->template/layout/grid1.php"; 
}

// Check for the grid2 file	
if(file_exists( JPATH_ROOT."/templates/$this->template/layout/grid2.php") && $this->params->get('grid2')) 
{ 
	$grid2File = "templates/$this->template/layout/grid2.php"; 
}

// Check for the grid3 file
if(file_exists( JPATH_ROOT."/templates/$this->template/layout/grid3.php") && $this->params->get('grid3')) 
{ 
	$grid3File = "templates/$this->template/layout/grid3.php"; 
}

// Check for the frontpage file
if(file_exists( JPATH_ROOT."/templates/$this->template/layout/frontpage.php") && $this->params->get('frontpage'))
{ 
	$frontpageFile = "templates/$this->template/layout/frontpage.php";
}
	
// Check for main file
if(file_exists( JPATH_ROOT."/templates/$this->template/layout/main.php") && $this->params->get('main')) 
{ 
	$mainFile = "templates/$this->template/layout/main.php"; 
}
				
// Check for grid4 file
if(file_exists( JPATH_ROOT."/templates/$this->template/layout/grid4.php") && $this->params->get('grid4')) 
{ 
	$grid4File = "templates/$this->template/layout/grid4.php"; 
}

// Check for grid5 file
if(file_exists( JPATH_ROOT."/templates/$this->template/layout/grid5.php") && $this->params->get('grid5')) 
{ 
	$grid5File = "templates/$this->template/layout/grid5.php"; 
}

// Check for grid6 file
if(file_exists( JPATH_ROOT."/templates/$this->template/layout/grid6.php") && $this->params->get('grid6')) 
{ 
	$grid6File = "templates/$this->template/layout/grid6.php"; 
}

// Check for bottom file
if(file_exists( JPATH_ROOT."/templates/$this->template/layout/bottom.php") && $this->params->get('bottom')) 
{ 
	$bottomFile = "templates/$this->template/layout/bottom.php"; 
}

// Check for panel file
if(file_exists( JPATH_ROOT."/templates/$this->template/layout/panel.php") && $this->params->get('panel')) 
{ 
	$panelFile = "templates/$this->template/layout/panel.php"; 
}
	
// Check for footer file	
if(file_exists( JPATH_ROOT."/templates/$this->template/layout/footer.php") && $this->params->get('footer')) 
{ 
	$footerFile = "templates/$this->template/layout/footer.php"; 
}

// Check for close file
if(file_exists( JPATH_ROOT."/templates/$this->template/layout/closeContainer.php") && $this->params->get('closeContainer'))
{ 
	$closeFile = "templates/$this->template/layout/closeContainer.php";
}


// Check for close file
if(file_exists( JPATH_ROOT."/templates/$this->template/layout/logoOverride.php") && $this->params->get('logoOverride'))
{ 
	$logoOverride = "templates/$this->template/layout/logoOverride.php";
}



/***********************************************************************************************************************
 * 
 * A quick test to see if K2 is present
 * 
 **********************************************************************************************************************/

	$k2CSS = $this->params->get("k2CSS", 0);
	$k2JS = $this->params->get("k2JS", 0);
	
	// Checks for K2
	if (Zengrid::hasModule('k2_comments') || Zengrid::hasModule('k2_content') || Zengrid::hasModule('k2_login') || Zengrid::hasModule('k2_tools') || Zengrid::hasModule('k2_users') || 	JRequest::getCmd('option') == 'com_k2') {
		$k2 = 1;

	}
	else {
		$k2 = 0;
	}
	
	



/***********************************************************************************************************************
 * 
 * Determines equal columns calculations
 * 
 **********************************************************************************************************************/


$numbers=array("zero","one","two","three","four","five","six","seven","eight","nine","ten","eleven","twelve","thirteen","fourteen","sixteen","sixteen");

if(!($logoPosition=="above")) {
	if($header!=0 && $headerEqual || $allEqual && $header!=0 && $headerEqual || $header!=0 && $headerEqual || $allEqual && $header!=0) {
		$headerModules = $cols/$header;
		$header1Cols = $header2Cols = $header3Cols = $header4Cols = $numbers[$headerModules];
	} 
}
else {
	if($header!=0 && $headerEqual || $allEqual && $header!=0 ){
		$headerModules = $cols/($header+1);
		$logoCols = $header2Cols = $header3Cols = $header4Cols = $numbers[$headerModules];
	} 
}

if($top!=0 && $topEqual || $top!=0 && $allEqual) {				
$topModules = $cols/$top;
$top1Cols = $top2Cols = $top3Cols = $top4Cols = $numbers[$topModules];
}

if($bottom!=0 && $bottomEqual || $bottom!=0 && $allEqual) {
$bottomModules = $cols/$bottom;
$bottom1Cols = $bottom2Cols = $bottom3Cols = $bottom4Cols = $bottom5Cols  = $bottom6Cols = $numbers[$bottomModules];
}

if($grid1!=0 && $grid1Equal || $grid1!=0 && $allEqual) {
	$grid1Modules = $cols/$grid1;
	$grid1Cols = $grid2Cols = $grid3Cols = $grid4Cols = $numbers[$grid1Modules];
}

if($grid2!=0 && $grid2Equal || $grid2!=0 && $allEqual) {
	$grid2Modules = $cols/$grid2;
	$grid5Cols = $grid6Cols = $grid7Cols = $grid8Cols = $numbers[$grid2Modules];
}


if($grid3!=0 && $grid3Equal || $grid3!=0 && $allEqual) {
	$grid3Modules = $cols/$grid3;
	$grid9Cols = $grid10Cols = $grid11Cols = $grid12Cols = $numbers[$grid3Modules];
}

if($grid4!=0 && $grid4Equal || $grid4!=0 && $allEqual) {
	$grid4Modules = $cols/$grid4;
	$grid13Cols = $grid14Cols = $grid15Cols = $grid16Cols = $numbers[$grid4Modules];
}

if($grid5!=0 && $grid5Equal || $grid5!=0 && $allEqual) {
	$grid5Modules = $cols/$grid5;
	$grid17Cols = $grid18Cols = $grid19Cols = $grid20Cols = $numbers[$grid5Modules];
}

if($grid6!=0 && $grid6Equal || $grid6!=0 && $allEqual) {
	$grid6Modules = $cols/$grid6;
	$grid21Cols = $grid22Cols = $grid23Cols = $grid24Cols = $numbers[$grid6Modules];
}

if($panel!=0 && $panelEqual || $panel!=0 && $allEqual) {
	$panelModules = $cols/$panel;
	$panel1Cols = $panel2Cols = $panel3Cols = $panel4Cols = $numbers[$panelModules];
}



/***********************************************************************************************************************
 * 
 * Mainwidth Logic
 * 
 **********************************************************************************************************************/

if (($this->countModules( 'left' )) && !($this->countModules( 'right' )) && !($this->countModules( 'center' ))) { $mainWidth = 'twoL';}
if (($this->countModules( 'left' )) && ($this->countModules( 'right' )) && !($this->countModules( 'center' ))) { $mainWidth = 'threeLR';} 
elseif (!($this->countModules( 'left' )) && ($this->countModules( 'right' )) && !($this->countModules( 'center' ))) { $mainWidth = 'twoR';}
elseif (!($this->countModules( 'left' )) && !($this->countModules( 'right' )) && !($this->countModules( 'center' ))) { $mainWidth = 'one';}
elseif (!($this->countModules( 'left' )) && !($this->countModules( 'right' )) && ($this->countModules( 'center' ))) { $mainWidth = 'one';}
elseif (($this->countModules( 'left' )) && ($this->countModules( 'right' )) && ($this->countModules( 'center' ))) { $mainWidth = 'fourLRC';}
elseif (($this->countModules( 'left' )) && !($this->countModules( 'right' )) && ($this->countModules( 'center' ))) { $mainWidth = 'threeLC';}
elseif (!($this->countModules( 'left' )) && ($this->countModules( 'right' )) && ($this->countModules( 'center' ))) { $mainWidth = 'threeRC';}



if ((($splitMenuLeft) || ($this->countModules( 'left' ))) && (!(($splitMenuRight) || ($this->countModules( 'right' )))) && !($this->countModules( 'center' ))) 
{ $mainWidth = 'twoL';}

elseif ((($splitMenuLeft) || ($this->countModules( 'left' ))) && (($splitMenuRight) || ($this->countModules( 'right' ))) && !($this->countModules( 'center' ))) 
{ $mainWidth = 'threeLR';} 

elseif ((!(($splitMenuLeft) || ($this->countModules( 'left' )))) && (($splitMenuRight) || ($this->countModules( 'right' ))) && !($this->countModules( 'center' ))) 
{ $mainWidth = 'twoR';}

elseif ((!(($splitMenuLeft) || ($this->countModules( 'left' )))) && (!(($splitMenuRight) || ($this->countModules( 'right' )))) && !($this->countModules( 'center' ))) 
{ $mainWidth = 'one';}

elseif ((!(($splitMenuLeft) || ($this->countModules( 'left' )))) && (!(($splitMenuRight) || ($this->countModules( 'right' )))) && ($this->countModules( 'center' ))) 
{ $mainWidth = 'one';}

elseif ((($splitMenuLeft) || ($this->countModules( 'left' ))) && (($splitMenuRight) || ($this->countModules( 'right' ))) && ($this->countModules( 'center' ))) 
{ $mainWidth = 'fourLRC';}

elseif ((($splitMenuLeft) || ($this->countModules( 'left' ))) && (!(($splitMenuRight) || ($this->countModules( 'right' )))) && ($this->countModules( 'center' ))) 
{ $mainWidth = 'threeLC';}

elseif ((!(($splitMenuLeft) || ($this->countModules( 'left' )))) && (($splitMenuRight) || ($this->countModules( 'right' ))) && ($this->countModules( 'center' ))) 
{ $mainWidth = 'threeRC';}


// Sets the main width variables based on the above logic
if ($mainWidth == "one") {
	$midCols = $numbers[$cols];
	$midColFloat = "float:left";
	$midColMargin ="margin-right: 0";
}

if ($mainWidth == "twoR") {
	$midColFloat = "float:left";
	$midColMargin ="margin-right: 0";
	$midCols = $midCols2R;
	$rightCols = $rightCols2R;
}
if ($mainWidth == "twoL") {
	$midColFloat = "float:right";
	$midColMargin ="margin-right: 0";
	$midCols = $midCols2L;
	$leftCols = $leftCols2L;
}
if ($mainWidth == "threeLR") {
	$midColFloat = "float:left";
	$midColMargin ="margin-right: $gutter";
	$midCols = $midCols3LR;
	$leftCols = $leftCols3LR;
	$rightCols = $rightCols3LR;
}	

if ($mainWidth == "fourLRC") {
	$midColFloat = "float:left";
	$midColMargin ="margin-right: $gutter";
	$midCols = $midCols4LRC;
	$leftCols = $leftCols4LRC;
	$rightCols = $rightCols4LRC;
	$centerCols = $centerCols4LRC;
}	

if ($mainWidth == "threeLC") {
	$midColFloat = "float:right";
	$midColMargin ="margin-right: 0";
	$midCols = $midCols3LC;
	$leftCols = $leftCols3LC;
	$centerCols = $centerCols3LC;
}

if ($mainWidth == "threeRC") {
	$midColFloat = "float:left";
	$midColMargin ="margin-right: $gutter";
	$midCols = $midCols3RC;
	$rightCols = $rightCols3RC;
	$centerCols = $centerCols3RC;
}


/***********************************************************************************************************************
 *
 * Push and Pull for left and mid columns to get the main content to be sourced ordered.
 *
 **********************************************************************************************************************/
$midColPull ="";
$leftColPush = "";
$centerColPush = "";
$centerColPull = "";

// Variables for the main width with left and right and center
$leftCols3LC = $this->params->get("leftCols3LC", "three");
$midCols3LC = $this->params->get("midCols3LC", "six");
$centerCols3LC = $this->params->get("centerCols3LC", "three");



	if ($mainWidth == "threeLR" or $mainWidth =="fourLRC"){
		$midColPull = $leftCols."cols_push";
		$leftColPush = $midCols."cols_pull";
	}
	
	if ($mainWidth=="threeLC"){
	//	$midColPull = $leftCols.$centerCols."cols_push";
	//	$leftColPush = $midCols."cols_pull";
	//	$centerColPull = $leftCols."cols_pull";
	}

	if ($mainWidth=="fourLRC"){
	//	$midColPull = $centerCols."cols_push";
	//	$leftColPush = $midCols."cols_pull";
	//	$centerColPull = $midCols."cols_pull";
	}

/***********************************************************************************************************************
 * 
 * Test for home page
 * 
 **********************************************************************************************************************/

	$showMainArea = "1";

	if (Zengrid::isHome() && $controlMainArea) {
		$showMainArea = "0";
	}



/***********************************************************************************************************************
 * 
 * Main Container Alignment - Legacy and can be removed for 1.3 +
 * 
 **********************************************************************************************************************/
if($legacy) {
	if($isOnward) {
		$legacyFile = "plugins/system/zengridframework/zengridframework/layout/legacy.php";
	}
	else {
		$legacyFile = "plugins/system/zengridframework/layout/legacy.php";
	}
}


// Custom CSS that gets loaded into the template head as inline css

// Check for custom css override
if(file_exists( JPATH_ROOT."/templates/$this->template/css/custom.css")) 
{ 
	$customCSS = "1";
	$loadCustom = "custom"; 
}




/***********************************************************************************************************************
 * 
 * Disable TP=1
 * 
 **********************************************************************************************************************/

if ($disableTP) {
JRequest::setVar('tp',0);
}





/***********************************************************************************************************************
 * 
 * Page Class Suffix
 * 
 **********************************************************************************************************************/

 $menus      = &JSite::getMenu();
 $menu      = $menus->getActive();
 $pageclass   = "";
   
 if (is_object( $menu )) : 
   $params = new JParameter( $menu->params );
   $pageclass = $params->get( 'pageclass_sfx' );
 endif;
 





/***********************************************************************************************************************
 * 
 * Load Template Variables
 * 
 **********************************************************************************************************************/
   
   if(file_exists( JPATH_ROOT."/templates/$this->template/includes/templateVariables.php")) 
{ 
	include_once (JPATH_ROOT."/templates/$this->template/includes/templateVariables.php");
}
   if(file_exists( JPATH_ROOT."/templates/$this->template/css/extracss.php")) 
{ 
	$getExtraCSS = "1";
} else {
	$getExtraCSS = "0";
}



// Incluse file that processes javascript
//include_once (dirname(__FILE__).DS.'elements/combineJS.php');



/***********************************************************************************************************************
 * 
 * Font Logic
 * 
 **********************************************************************************************************************/

if ($fonts =="1" or $fonts =="3" ) {
	include_once (dirname(__FILE__).DS.'elements/fonts.php');
	$fontcss ="fonts";
	$fonts=="1";
}


/***********************************************************************************************************************
 * 
 * Browser detection for mobile devices
 * 
 **********************************************************************************************************************/
	
	// Default Values
	$iPadpublish ="";
	$iPhonepublish ="";
	$androidpublish ="";
	$topMob = 1;
	$headerMob = 1;
	$bannerMob = 1;
	$logoMob = 1;
	$navMob = 1;
	$tabMob = 1;
	$grid1Mob = 1;
	$grid2Mob = 1;
	$grid3Mob = 1;
	$grid4Mob = 1;
	$grid5Mob = 1;
	$grid6Mob = 1;
	$bottomMob =1;	
	
	// Test for ios devices
	$isiPad = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPad');
	$isiPhone = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPhone');
	
	// Test for android
	$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
	$isAndroid="";
	if(stripos($ua,'android') !== false) { $isAndroid = 1;}
	
	$mobileDetect = $this->params->get('mobileDetect');
	$devicearray=($mobileDetect);
	
		// Check to see if its an array
		if (is_array($devicearray)){
			foreach($devicearray as $device){
				${$device.'publish'} = 1;
			}
		}
		
		// If not an array
		else {
			${$this->params->get('mobileDetect').'publish'} = $this->params->get('mobileDetect');
			${$this->params->get('mobileDetect').'publish'} = 1;
		}
		
			if (($iPhonepublish && $isiPhone) || ($iPadpublish && $isiPad) || ($androidpublish && $isAndroid)) {
	
				// The following can be used to toggle certain rows off for small screen browsers
				$topMob = $this->params->get('topMob');
				$headerMob = $this->params->get('headerMob');
				$bannerMob = $this->params->get('bannerMob');
				$logoMob  = $this->params->get('logoMob');
				$navMob = $this->params->get('navMob');
				$tabMob = $this->params->get('tabMob');
				$grid1Mob = $this->params->get('grid1Mob');
				$grid2Mob = $this->params->get('grid2Mob');
				$grid3Mob = $this->params->get('grid3Mob');
				$grid4Mob = $this->params->get('grid4Mob');
				$grid5Mob = $this->params->get('grid5Mob');
				$grid6Mob = $this->params->get('grid6Mob');
				$bottomMob = $this->params->get('bottomMob');
			}
	
	// Test for mobile css files int he template css folder
	if(file_exists( JPATH_ROOT."/templates/$this->template/css/ipad.css") && $isiPad) 
	{ 
		// Load the core theme.css
		$themecss[] = ''.$templatePath.'/css/ipad.css';
	}
	
	if(file_exists( JPATH_ROOT."/templates/$this->template/css/iphone.css") && $isiPhone) 
	{ 
		// Load the core theme.css
		$themecss[] = ''.$templatePath.'/css/iphone.css';
	}
	
	if(file_exists( JPATH_ROOT."/templates/$this->template/css/android.css") && $isAndroid) 
	{ 
		// Load the core theme.css
		$themecss[] = ''.$templatePath.'/css/android.css';
	}
	


/***********************************************************************************************************************
 * 
 * CSS files that get loaded by the framework
 * 
 **********************************************************************************************************************/

	// Definitions for css files and compression

	require_once($frameworkPath.DS.'functions'.DS.'elements'.DS.'zenurirewriter.php');
	
	if($csscompress) { $systemCSSPath = JPATH_ROOT."/templates/system/css/";}
	else {$systemCSSPath = JURI::base() . "templates/system/css/";}
	

	
	// Legacy mode for pre 1.2 + templates. The legacy variable can be set in the template templateVariables.php */
	if ($legacy) {
	
		$frameworkcss = array(''.$systemCSSPath.'system.css',''.$systemCSSPath.'general.css',''.$frameworkMedia.'/css/legacy/joomla.css',''.$frameworkMedia.'/css/legacy/template_css.css',''.$frameworkMedia.'/css/grid.css');
	
	}
	else {
		// Css files to load in v1.2 + template versions
		$frameworkcss = array(''.$frameworkMedia.'/css/base.css',''.$frameworkMedia.'/css/grid.css',''.$frameworkMedia.'/css/type.css',''.$frameworkMedia.'/css/forms.css');		
		$frameworkcss[] = ''.$frameworkMedia.'/css/superfish.css';
		
		if (Zengrid::isBrowser('ie6')) { 
			$frameworkcss[] = ''.$frameworkMedia.'/css/grid-ie6.css';
		}	
	}
	
	
	// Check to see if and which css we should load for the panel
	if ($panel) $frameworkcss[] = ''.$frameworkMedia.'/css/modal/'.$modalType.'.css';
		
	// Check to see if we should load the tabs.css
	if ($tabs) $frameworkcss[] = ''.$frameworkMedia.'/css/jbtabs.css';
	
	// Checks for JB Extensions
	if($this->hasJTweet) $frameworkcss[] = 'modules/mod_jTweet/css/jTweet.css';
	if($this->hasMicroblog) $frameworkcss[] = 'modules/mod_microblog/css/microblog.css';
	if($this->hasMicroblog) $frameworkcss[] = 'modules/mod_microblog/css/cbtheme1.css';
	if($this->hasSlideshow) $frameworkcss[] = 'modules/mod_slideshow3/slideshow/slideshow.css';
	if($this->hasCaptifyContent) $frameworkcss[] = 'modules/mod_captifyContent/css/captifyContent.css';
	if($this->hasJBlogin) $frameworkcss[] = 'modules/mod_jblogin/css/jbLogin.css';
	if($this->hasMinimoo) $frameworkcss[] = 'modules/mod_minimoo2/css/minimoo2.css';
	if($this->hasPrettybox) $frameworkcss[] = 'media/zengridframework/js/modal/prettyPhoto/css/prettyPhoto.css';
	if($this->hasJflickr) $frameworkcss[] = 'modules/mod_jflickr/js/jquery.fancybox/jquery.fancybox-1.3.4.css';

	
	// Load the font.css file
	if($fonts =="1" or $fonts =="3") $frameworkcss[] = ''.$frameworkMedia.'/css/fonts.css';
	
	// Code to allow users to uipload scripts to templates/yourtemplate/user folder to have it automatically included
	$path= "templates/$this->template/user";
	if (JFolder::exists($path)) {
		$usercssfiles = JFolder::files($path, 'css', false, true);
		$usercssfilesresult = count($usercssfiles);
	}
	else {
		$usercssfiles = array();
		$usercssfilesresult = 0;
	}

	// Combine the core framework and theme.css into an array
	$mergecss = array_merge($frameworkcss,$themecss,$usercssfiles);

	if (!$csscompress) {
		foreach ($mergecss as $cssfile) {
		
			$doc->addStyleSheet($cssfile, 'text/css', 'screen');

		}
	}

		
	else {
		
		$md5sum = '';
		$outfile = '';
		
		foreach ($mergecss as $cssfile) {
			$md5sum .= md5($cssfile);
			
		}	

		$cache_time ="";
		// Setting up the file name and path to the file
		$path = "cache/zengridframework/css";
		$cache_filename = "css-".md5($md5sum).".php";
		$cache_fullpath = $path.DS.$cache_filename;
		
		// Grab the cache time from the template parameters				
		$cache_time = '80000';

		if (JFile::exists($cache_fullpath)) {
    	    $diff = (time()-filectime($cache_fullpath));
    	} else {
    	    $diff = $cache_time+1;
    	} 
			
		if ( $diff > $cache_time )
			{
				$outfile='<?php 
				ob_start ("ob_gzhandler");
				ob_start("compress");
				header("Content-type: text/css;charset: UTF-8");
				header("Cache-Control: must-revalidate");
				$offset = 1000000 * 60 ; 
				$ExpStr = "Expires: " . gmdate("D, d M Y H:i:s",time() + $offset) . " GMT";
				header($ExpStr);
				
				function compress($buffer) {
				    $buffer = preg_replace("!/\*[^*]*\*+([^/][^*]*\*+)*/!", "", $buffer);
				    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", "  ", "    ", "    "), "", $buffer);
				    $buffer = str_replace("{ ", "{", $buffer);
				    $buffer = str_replace(" }", "}", $buffer);
				    $buffer = str_replace("; ", ";", $buffer);
				    $buffer = str_replace(", ", ",", $buffer);
				    $buffer = str_replace(" {", "{", $buffer);
				    $buffer = str_replace("} ", "}", $buffer);
				    $buffer = str_replace(": ", ":", $buffer);
				    $buffer = str_replace(" ,", ",", $buffer);
				    $buffer = str_replace(" ;", ";", $buffer);
				return $buffer;
				}
				?>';
		
			foreach($frameworkcss as $cssfile)
			{
				// We nominate the template/system pathj here since the framework doesnt have any images to load
				$css = ZenUriRewriter::rewrite(file_get_contents($cssfile),$systemCSSPath);
				$outfile .= $css;				
			}
					
			foreach($themecss as $cssfile)
			{
				$css = ZenUriRewriter::rewrite(file_get_contents($cssfile),$themeCSSPath);
				$outfile .= $css; 				
			}
			
			if ($usercssfilesresult > 0 ) {
				foreach($usercssfiles as $cssfile)
				{
					$css = ZenUriRewriter::rewrite(file_get_contents($cssfile),$themeCSSPath);
					$outfile .= $css; 				
				}
			}
			JFile::write($cache_fullpath,$outfile);
		}
		$doc->addStyleSheet($cache_fullpath, 'text/css', 'screen');
	};




/***********************************************************************************************************************
 * 
 * Style Declarations
 * 
 **********************************************************************************************************************/

	$css_code ="";
	$containerOffset ="";
	$frontWidth ="";
	
	// In some cases we might want to apply a unique width to the front page of a site
	$frontpageWidth = $this->params->get("frontpageWidth");

	if($frontpageWidth !=="") {
		$frontWidth == "body.frontpage .container,body.featured .container {width: $frontpageWidth;max-width: $frontpageWidth}";
	}
	else {
		$frontWidth == "";
	}
	
	
	// Logic for the alignment of the site
	if ($containerPosition =="left") {$containerOffset = "margin: 0 0 0 $containerMargin";}
	if ($containerPosition =="right") {$containerOffset = "margin: 0 $containerMargin 0 0";}
	if ($containerPosition =="center") {$containerOffset = "";}
	
	

	if ($layoutType=="fixed" or $layoutType=="fluid") {
		
		$css_code .= "body {font-size: $fontSize} .container {width: $tWidth;$containerOffset} $frontWidth";
	}
	elseif ($layoutType="1140") {
		$css_code .= "body {font-size: $fontSize} .container {width: 100%;	max-width: 1140px;} $frontWidth";
	}

	if ($extraThemeCSS !="") { 
		$css_code .= $extraThemeCSS; 
	}
	
	if($overwriteCSS) {
		if (($extraCSS) !=="")  		{$css_code .= ''.$extraCSS.'';}
		if (($firstcolorelement) !=="") {$css_code .= ''.$firstcolorelement.' {'.$firstcolorAtt.':#'.$firstcolor.'}';}
		if (($secondcolorelement) !==""){$css_code .= ''.$secondcolorelement.'{'.$secondcolorAtt.':#'.$secondcolor.'}';}
		if (($thirdcolorelement) !=="") {$css_code .= ''.$thirdcolorelement.'{'.$thirdcolorAtt.':#'.$thirdcolor.'}';}
		if (($fourthcolorelement) !==""){$css_code .= ''.$fourthcolorelement.'{'.$fourthcolorAtt.':#'.$fourthcolor.'}';}
		if (($fifthcolorelement) !=="") {$css_code .= ''.$fifthcolorelement.'{'.$fifthcolorAtt.':#'.$fifthcolor.'}';}
		if (($sixthcolourelement) !=="") {$css_code .= ''.$sixthcolourelement.'{'.$sixthcolorAtt.':#'.$sixthcolor.'}';}
	}

	if($this->hasPrettybox) {
		$css_code .= '.prettydiv {margin-bottom: 10px;float: left;}
		.prettydiv1 {width: 100%}
		.prettydiv2 {width: 50%}
		.prettydiv3 {width: 33%}
		.prettydiv4 {width: 25%}
		.prettydiv5 {width: 20%}
		.prettydiv6 {width: 16.5%}
		.prettydiv7 {width: 14%}
		.prettydiv8 {width: 12.5%}
		.prettydiv9 {width: 11%}
		.prettydiv10 {width: 10%}';
	}
	
	if($this->hasJflickr) {
		$css_code .='.gallery-flickr ul li {list-style-type:none;float:left;background: none;margin-left:0}.gallery-flickr ul {margin: 0} #right .gallery-flickr ul li a,#left .gallery-flickr ul li a,.gallery-flickr ul li a {float:left;margin:0 4px 4px 0;padding: 0;background:none;border: 0;} .gallery-flickr ul li a:hover {background: #ddd} #gallery-flickr {padding: 0;line-height: 0;margin: 0} .clearfix {clear:both}';
	}
	
	if (($logoColor) !=="") 	{$css_code .= '	#logo '.$logoClass.' a{color:#'.$logoColor.'}';}
	
	$css_code .= '#tagline span{top: '.$taglineTop.';left:'.$taglineLeft.';'.$taglineCSS.'}';
	
	if ($legacy) {
		if(($isiPad or $isiPhone) && $tWidth >= 980) {
			$css_code .= ".outerWrapper {width: $tWidth !important}";
		}
	}
	
	$doc->addStyleDeclaration($css_code);



/***********************************************************************************************************************
 * 
 * Browser Specific Files
 * 
 **********************************************************************************************************************/

	$ie7CSS = "";
	$ie6CSS = "";
	$ie8CSS = "";
	$ie9CSS = "";
	$extraJS = "";
	$customCSS ="";
	$loadCustom ="";
	$iosCSS ="";

	
	// Check for ie9 css override
	if(file_exists( JPATH_ROOT."/templates/$this->template/css/ie9.css")) 
	{ 
		$ie9CSS = "1"; 
	}
	
	// Check for ie7 css override
	if(file_exists( JPATH_ROOT."/templates/$this->template/css/ie8.css")) 
	{ 
		$ie8CSS = "1"; 
	}
	
	
	// Check for ie7 css override
	if(file_exists( JPATH_ROOT."/templates/$this->template/css/ie7.css")) 
	{ 
		$ie7CSS = "1"; 
	}


	// Check for ie6 css override
	if(file_exists( JPATH_ROOT."/templates/$this->template/css/ie6.css")) 
	{ 
		$ie6CSS = "1"; 
	}
	
	if (Zengrid::isBrowser('ie9') && $ie9CSS) { 
		$doc->addCustomTag( '<link href="'.$this->baseurl.'/templates/'.$this->template.'/css/ie9.css" rel="stylesheet" type="text/css" media="screen" />');
	}

	if (Zengrid::isBrowser('ie8') && $ie8CSS) { 
		$doc->addCustomTag( '<link href="'.$this->baseurl.'/templates/'.$this->template.'/css/ie8.css" rel="stylesheet" type="text/css" media="screen" />');
		
		$ie8_code = 'img {max-width:none}';
		$doc->addStyleDeclaration($ie8_code);
		
	}
	
	if (Zengrid::isBrowser('ie7') && $ie7CSS) { 
		$doc->addCustomTag( '<link href="'.$this->baseurl.'/templates/'.$this->template.'/css/ie7.css" rel="stylesheet" type="text/css" media="screen" />');
	}	

	if (Zengrid::isBrowser('ie6') && $ie6CSS) { 
		$doc->addCustomTag( '<link href="'.$this->baseurl.'/templates/'.$this->template.'/css/ie6.css" rel="stylesheet" type="text/css" media="screen" />');
	}  
	
	if (Zengrid::isBrowser('ie6') && $pngfix) { 
	$doc->addCustomTag( '<script src="'.$this->baseurl.'/templates/zengridframework/js/tools/DD_belatedPNG0.0.8a-min.js"></script>
		<script>
			DD_belatedPNG.fix('.$pngfixrules.'); 
		</script>');
	}

	//Load Responsive Design Scriot fot IE 6, 7 and 8
	if (Zengrid::isBrowser('ie6') && Zengrid::isBrowser('ie6') && Zengrid::isBrowser('ie8')) { 
		if ($this->params->get('mediqueries') == 1 && $this->params->get('jQueryVersion') != 'none') {
			$doc->addScript( $frameworkMedia.'/js/tools/respond.min.js"');
		}
	}


/***********************************************************************************************************************
 * 
 * Typekit script inclusion
 * 
 **********************************************************************************************************************/
	
	if ($typekit && $fonts =="2" or $typekit && $fonts =="3") { 
		$doc->addScript('http://use.typekit.com/'.$typekitId.'.js');
	}




/***********************************************************************************************************************
 * 
 * Body classes - used to insert hooks into the body tag so we can get some more styling
 * 
 **********************************************************************************************************************/

	   $menus      = &JSite::getMenu();
	   $menu      = $menus->getActive();
	   $pageclass   = "";

	   if (is_object( $menu )) : 
	   $params = new JParameter( $menu->params );
	   $pageclass = $params->get( 'pageclass_sfx' );
	   endif;


		// Detecting Active Variables
		$option = JRequest::getCmd('option', '');
		$view = JRequest::getCmd('view', '');
		$layout = JRequest::getCmd('layout', '');
		$task = JRequest::getCmd('task', '');
		$itemid = JRequest::getCmd('Itemid', '');
		$catid = JRequest::getInt('catid');

		$bodyClass = "";

		if ($fonts=='1' or $fonts=='3' or $pageclass !='') { 
			if($fontStackBody[1] !=="-") $bodyClass .="$fontStackBody";	$bodyClass .="$fontStackBody";
		}
		if ($pageclass !='') { 
			$bodyClass .=" $pageclass";
		}

		if ($this->params->get("bodyclassOption", 1)) {
			$bodyClass .=" $option";
		}

		if ($this->params->get("bodyclassView", 1)) {
			$bodyClass .=" $view";
		}

		if ($this->params->get("bodyclassLayout", 1)) {
			$bodyClass .=" $layout";
		}

		if ($this->params->get("bodyclassTask", 1)) {
			$bodyClass .=" $task";
		}

		if ($this->params->get("bodyclassItem", 1)) {
			$bodyClass .=" itemid$itemid";
		}

		if ($this->params->get("bodyclassMainWidth", 1)) {
			$bodyClass .=" $mainWidth";
		}
		
		if($k2) {
			$bodyClass .=" k2";
		}
		
		if($isPresent) {
			$bodyClass .=" present";
		}
		
		else {
			$bodyClass .=" onward";
		}
		
		$bodyClass .=" $containerPosition";



/***********************************************************************************************************************
 * 
 * Superfish, TypeKit and Extra Script Declarations
 * 
 **********************************************************************************************************************/
	
	$sfType="";

	// Logic for the superfish animation
	if ($sfEffect == "1") {
		$sfType = '{height:"show"}';
	}
	else if ($sfEffect == "2") {
		$sfType = '{width:"show"}';
	}
	else if ($sfEffect == "3") {
		$sfType = '{opacity:"show"}';
	}
	else if ($sfEffect == "4") {
		$sfType = '{width:"show", opacity:"show"}';
	}
	else if ($sfEffect == "5") {
		$sfType = '{height:"show", opacity:"show"}';
	}
	else if ($sfEffect == "6") {
		$sfType = '{height:"show", width:"show", opacity:"show"}';
	}
	else if ($sfEffect == "7") {
		$sfType = '{height:"show", width:"show"}';
	}


	$zengridJS ="";
	
	if($superfish || $lazyload) {
	$zengridJS .= 'jQuery(document).ready(function(){';
	
	if($superfish) {
		$zengridJS .= "		jQuery('.moduletable-superfish ul,#nav ul')\n";
		$zengridJS .= "			.supersubs({ \n";
	    $zengridJS .= "       		minWidth:    '$sfMinWidth',   // minimum width of sub-menus in em units \n";
	    $zengridJS .= "    			maxWidth:    '$sfMaxWidth',   // maximum width of sub-menus in em units \n";
		$zengridJS .= "				disableHI:   true,  // set to true to disable hoverIntent detection\n";
	    $zengridJS .= "				extraWidth:  1     // \n";
	    $zengridJS .= "			})\n";
		$zengridJS .= "			.superfish({\n";
		$zengridJS .= "				animation : {$sfType},\n";
		$zengridJS .= "				speed:       '$sfSpeed',\n";
		$zengridJS .= "				delay : $sfDelay \n";
		$zengridJS .= "			});	\n";
		$zengridJS .= "\n";
	}
	
	if($lazyload) {
		$zengridJS .= "jQuery('$llSelector').lazyload({";
		$zengridJS .= "effect : 'fadeIn'";
		$zengridJS .= "});";
	}
	
	if($panelMenuType =="accordion") {
	
	$zengridJS .= "jQuery('.moduletable-panelmenu ul ul').hide('slow');\n";
	$zengridJS .= "jQuery('.moduletable-panelmenu span').click(function() {\n";
	$zengridJS .= "jQuery('.moduletable-panelmenu span').removeClass('open');\n";
	$zengridJS .= "jQuery('.moduletable-panelmenu ul ul').slideUp();\n";
	$zengridJS .= "jQuery(this).next('ul').slideUp('normal');\n";

	$zengridJS .= "if(jQuery(this).next().is(':hidden') == true) {\n";
	$zengridJS .= "jQuery(this).addClass('open');\n";
	$zengridJS .= "jQuery(this).next().slideDown('normal');\n";
	$zengridJS .= " } \n";
	$zengridJS .= "});\n";
	
	if($accordionFirst) {
		$zengridJS .= "	jQuery('.moduletable-panelmenu ul ul:first').slideDown();\n";
		$zengridJS .= "	jQuery('.moduletable-panelmenu ul li span:first').addClass('open');\n";
	}
	if($accordionShowActive) {
		$zengridJS .= "jQuery('.moduletable-panelmenu ul li#current ul,.moduletable-panelmenu ul li.active ul').slideDown()\n";
		$zengridJS .= "	jQuery('.moduletable-panelmenu ul li.active span').addClass('open');\n";
	}
	$zengridJS .= "jQuery('.moduletable-panelmenu ul ul span').click(function() {\n";
	$zengridJS .= "jQuery('.moduletable-panelmenu ul ul ul').slideUp();\n";
	$zengridJS .= "});\n";
	
	}
		$zengridJS .= "		});\n";
	}
	

	if ($typekit && $fonts =="2" or $typekit && $fonts =="3") {  
		$zengridJS .= "try{Typekit.load();}catch(e){}";
	}
	
	if ($extraScripts != "") {
		$zengridJS .= $extraScripts;
	}
	
	// Load the Script Declaration
	if(!$bottomScripts) {
		$doc->addScriptDeclaration($zengridJS);
	}
	

/***********************************************************************************************************************
 * 
 * Debug loop
 * 
 **********************************************************************************************************************/


	if ($debug) {

		$logodebug ="";
		$themedebug = '';
		
		
		foreach ($positions as $position) {

	    	${$position.'debug'} = '<span class="notice">'.$position.' | '.${$position.'Cols'}.' columns</span>';

			if (${$position.'debug'} == "$logodebug") {
				$logodebug = '<span class="notice">'.$position.' | '.${$position.'Cols'}.' columns | '.$logoPosition.' | '.$logoType.'</span>';
			}
		}
		
		$splitmenudebug = '<span class="notice">Split Menu Enabled</span>';
		$taglinedebug = '<span class="notice">Tagline</span>';
		$tabtitledebug = '<span class="notice">Tab trigger titles set in template.</span>';
		$maincontentdebug = '<span class="notice">Main Content</span>';
		
		$themedebug .= '<div id="bottomdebug"><h3>CSS files loaded by the template.</h3>';
		foreach($mergecss as $file) {
			$themedebug .= '<pre>'.$file.'<br /></pre>';
		}
		$themedebug .= '<br /><br /><h3>Style declarations loaded by the template.</h3><pre>'.$css_code.'</pre>';
		$themedebug .= '<br /><br /><h3>Javascript files loaded by the template.</h3>';
		//foreach($files as $jsfile) {
		//	$themedebug .= '<pre>'.$jsfile.'<br /></pre>';
		//}
		$themedebug .= '<br /><br /><h3>Script declaration loaded by the template.</h3><pre>'.$zengridJS.'</pre></div>';
		
		$errorMessages ="";
		
		if($controlMainArea) {
		$errorMessages .="<strong>Main content is hidden on the frontpage.</strong> <br />That's an ok state of affairs if that's your intention, but your maincontent and any module published to the left, right, center and advert positions will <strong>not</strong> be visible on the front page of your site.";
		}
	}
	
	/***********************************************************************************************************************
	 * 
	 * Remove Mootools
	 * Removes Mootools
	 * Kinesphère "Mootools Control" Plugin for Joomla! 1.5.x - Version 0.1
	 * License: http://www.gnu.org/copyleft/gpl.html
	 * Copyright (c) 2009 Kinesphère
	 * More info at http://www.kinesphere.fr
	 * 
	 **********************************************************************************************************************/

	if ($removeMootools == '1') {
		$doc =& JFactory::getDocument();
		$headerstuff = $doc->getHeadData();

		foreach ($headerstuff['scripts'] as $file => $type) {
			if (preg_match("#mootools.js#s", $file)) unset($headerstuff['scripts'][$file]);
			if (preg_match("#caption.js#s",  $file)) unset($headerstuff['scripts'][$file]);
		}				
	}


	/***********************************************************************************************************************
	 * 
	 * Remove Joomla Metagen
	 * 
	 **********************************************************************************************************************/

	if ($removeJgen == '1') {
		$this->setGenerator('');
	} ?>