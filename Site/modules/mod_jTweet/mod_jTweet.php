<?php
/**
* @id $Id$
* @author  Joomla Bamboo
* @package  jTweet
* @copyright Copyright (C) 2006 - 2010 Joomla Bamboo. http://www.joomlabamboo.com  All rights reserved.
* @license  GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
$document =& JFactory::getDocument();

// Import the filesystem
jimport( 'joomla.filesystem.file' );

// Test to see if the default template is a zgf v2 template
$app = JFactory::getApplication();
$framework = JPATH_ROOT.DS.'templates'.DS.$app->getTemplate().DS.'includes'.DS.'config.php';

if (file_exists($framework)){ $zgf = 1;} else {$zgf = 0;}

// Test to see if cache is enabled
if (substr(JVERSION, 0, 3) >= '1.6') {
	
	// Test to see if cache is enabled
	if ($app->getCfg('caching')) { 
		$cache = 1;
	}
	else {
		$cache = 0;
	}
}
else {
	
	// Test to see if cache is enabled
	if ($mainframe->getCfg('caching')) { 
		$cache = 1;
	}
	else {
		$cache = 0;
	}
}

	$modbase = JURI::base(true).'/modules/mod_jTweet/';

	// Load CSS & JS
	$moduleID	= $module->id;
	$type	= $params->get( 'type', 'query' );
	$twitterBird	= $params->get( 'twitterBird', 'bird1' );
	$joinText	= $params->get( 'joinText', 'auto' );
	$tweetSource		= $params->get('tweetSource','yes');
	$twitterName = $params->get('twitterName','yes');
	$noReplies = $params->get('noReplies','no');
	$tweetTemplate = $params->get('tweetTemplate','1');
	$userName	= $params->get( 'userName', 'joomlabamboo' );
	$query	= $params->get( 'query', 'joomlabamboo' );
	$avatar	= $params->get( 'avatar', 'no' );
	$avatarSize	= str_replace('px', '', $params->get( 'avatarSize', '48' ));
	$count	= $params->get( 'count', 5 );
	$autoDefault	= $params->get( 'autoDefault', 'i said' );
	$autoEd	= $params->get( 'autoEd', 'i' );
	$autoIng	= $params->get( 'autoIng', 'i am' );
	$autoReply	= $params->get( 'autoReply', 'i replied to' );
	$autoUrl	= $params->get( 'autoUrl', 'i was looking at' );
	$loadingText	= $params->get( 'loadingText', 'Loading...' );
	$introText	= htmlspecialchars($params->get( 'introText', null ),ENT_QUOTES);
	$popup = $params->get('popup','yes');
	$popupIntro = htmlspecialchars($params->get('popupIntro','I am on Twitter!'),ENT_QUOTES);
	$moreInfo = htmlspecialchars($params->get('moreInfo','More Info'),ENT_QUOTES);
	$follow	= $params->get( 'follow', 'yes' );
	$followMeText	= $params->get( 'followText', "Follow me on twitter" );
	$twitterAction = htmlspecialchars($params->get('twitterAction','tweeted'),ENT_QUOTES);
	$sourcePre = htmlspecialchars($params->get('sourcePre','from'),ENT_QUOTES);
	$userName = str_replace(" ","",$userName);
	$scripts = $params->get( 'scripts', 1);

	if($type == "query") {
		$popup = 'no';
	}

	if ($type == "multi") {
		$popup = 'no';
		$multiUsers = explode(",",$userName);
		$userName = $multiUsers[0];
		$userNameList = implode("+from:",$multiUsers);
	}
	if($type == "tweets") {
		$multiUsers = explode(",",$userName);
		$userName = $multiUsers[0];
	}


	// The parameters for the javascript
	$tweetScript = "jQuery.noConflict();jQuery(document).ready(function(){jQuery('.tweet$moduleID').tweet({";
	if ($avatar == 'yes') { 
		$tweetScript .= "avatar_size: ".$avatarSize.",";
	}
	$tweetScript .= "count: ".$count.",";
	$tweetScript .= "popup_intro: '".$popupIntro."',";
	$tweetScript .= "popup_info: '".$popup."',";
	$tweetScript .= "tweet_source: '".$tweetSource."',";
	$tweetScript .= "twitter_name: '".$twitterName."',";
	$tweetScript .= "suppress_replies: '".$noReplies."',";
	$tweetScript .= "tweet_template: '".$tweetTemplate."',";
	$tweetScript .= "twitter_action: '".$twitterAction."',";
	$tweetScript .= "source_pre: '".$sourcePre."',";
	if ($type == 'query') {
		$tweetScript .= "query: '".$query."',";
	} 
	elseif ($type == 'tweets') {
		$tweetScript .= "username: '".$userName."',";
	}
	else{
		$tweetScript .= "multiuser: '".$userNameList."',";
	}
	if ($joinText == 'auto') {
		$tweetScript .= "join_text: '".$joinText."',auto_join_text_default: '".$autoDefault."',auto_join_text_ed: '".$autoEd."',auto_join_text_ing: '".$autoIng."',auto_join_text_reply: '".$autoReply."',auto_join_text_url: '".$autoUrl."',";
	}
	$tweetScript .= "loading_text: '".$loadingText."'});})";

	// Load css and script references into the head
	if($scripts) {
		if(!$zgf) {
			if(!$cache) {
				$document->addStyleSheet($modbase.'css/jTweet.css');
				$document->addScript($modbase . "js/jquery.tweet.js");
			}
		}
	}

require(JModuleHelper::getLayoutPath('mod_jTweet', 'default'));
?>