<?php

/**
*** Zen Grid v2 Joomla Template Framework is a commercial Joomla template from Joomla Bamboo
*** @author    Joomlabamboo
*** @copyright (C) 2010 by Joomlabamboo
*** @license   Commercial
**/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/***********************************************************************************************************************
 * 
 * Configuration Hooks
 * 
 **********************************************************************************************************************/

$zgfPanelJS = $this->params->get("zgfPanelJS","1");
$bannerHeight = str_replace('px', '', $this->params->get("bannerHeight", "550"));
$bannerSubHeight = str_replace('px', '', $this->params->get("bannerSubHeight", "350"));
$buttonCSS = $this->params->get("buttonCSS", "buttonGreen");


$tabs = 1;
$legacy = 0;
$top = 1;
$bottom = 1;

/*
 * CSS Compression. Throws the following files into array for the compressor
*/	

	$themecss = array();

	// Check to see if we sholuld load the k2.css file
	if(JRequest::getCmd('option') == 'com_k2' or Zengrid::hasModule('mod_k2_comments')  or Zengrid::hasModule('mod_k2_tools') or Zengrid::hasModule('mod_k2_content') or Zengrid::hasModule('mod_k2_login') or Zengrid::hasModule('mod_k2_users')) {
		$themecss[] = ''.$templatePath.'/css/k2.css';
	}
	
	// Load the core theme.css
	$themecss[] = ''.$templatePath.'/css/theme.css';


	// Load the hilite file
	if ($hilite)	$themecss[] = ''.$templatePath.'/css/'.$hilite.'.css';
	
	// Load the Button colour
	if ($hilite)	$themecss[] = ''.$templatePath.'/css/'.$buttonCSS.'.css';
	
	// Load a custom mediaquery.css file if it exists
	if(file_exists( JPATH_ROOT."/templates/$this->template/css/mediaqueries.css")) {
		$themecss[] = ''.$templatePath.'/css/mediaqueries.css';
	}
	
	// Load the custom css file manually if it exists
	if(file_exists( JPATH_ROOT."/templates/$this->template/css/custom.css")) {
		$themecss[] = ''.$templatePath.'/css/custom.css';
	}
	

	$extracss = '';
	
	if(!$this->countModules('background')) {
		$extracss .= '#tabwrap {margin-top: 0}';
	}
	
	// Class applied to the body if breadcrumb not published
	if(!$this->countModules('breadcrumb')) {
		$extracss .= '.sidebar {margin-top:45px} ';
	}
	
	if($this->countModules('background')) : 
	$extracss .= '
		#contentwrap {margin-top:'.($bannerSubHeight - 186).'px }
		#background {height:'.($bannerSubHeight).'px !important }
		body.featured #contentwrap,body.frontpage #contentwrap {margin-top:'.($bannerHeight - 186).'px }
		body.featured #background,body.frontpage #background {height:'.($bannerHeight).'px !important }
		';  
		
		if(!$this->countModules('top1 or top2 or top3 or top4')) {
	
			$extracss .= '
			#contentwrap {margin-top:'.($bannerSubHeight - 152).'px }
			body.featured #contentwrap,body.frontpage #contentwrap {margin-top:'.($bannerHeight - 152).'px }
			';
		}
	endif;
	

	if(!$this->countModules('background')) {
		$extracss .= '.contentrow {margin-top: 0} ';
	} else {

		$extracss .= '.contentrow {margin-top: -40px;} ';
	}
	
	$doc->addStyleDeclaration( $extracss );
?>