<?php
/**
 * @package		Zentools
 * @version		v1.1
 * @author		Joomlabamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2012 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
defined('_JEXEC') or die('Restricted access'); 


$twitterUsername = $params->get('twitterUsername','');
$twitterAvatarSize = $params->get('twitterAvatarSize','60');
$twitterCount = $params->get('count','1');
$twitterRefresh = $params->get('twitterRefresh','10000');

// View Parameters

	if($elements !=="") {
		$enabled  = 1;
		$displayitems = explode(",", $elements);
		
		// Remove k2 items from the array if content or image directory as a source
		if($contentSource !=="3") {
			if(array_search('extrafields', $displayitems)) {
				unset($displayitems[array_search('extrafields',$displayitems)]);
			}
			
			if(array_search('comments', $displayitems)) {
				unset($displayitems[array_search('comments',$displayitems)]);
			}
			
			if(array_search('attachments', $displayitems)) {
				unset($displayitems[array_search('attachments',$displayitems)]);
			}
			
			if(array_search('video', $displayitems)) {
				unset($displayitems[array_search('video',$displayitems)]);
			}
			
			// Resets the array
			$displayitems = array_values($displayitems);							
		}
		
		$countElements = count($displayitems);
	}
	else {
		echo "";
		$enabled = 0;
	}
	if($link !==0) {
		$closelink ="</a>";
	}
	$catlinkclose ="</a>";
	$item->image = false;
?>	
	
		<div id="zentools<?php echo $moduleID ?>" class="zentools">
			<div class="<?php echo $layout ?>">
				<div id="zentweet<?php echo $moduleID ?>"></div>
				
				
		</div>
	</div>
	

		<!-- Place in the <head>, after the three links -->
		<script type="text/javascript" charset="utf-8">
		  jQuery(function(jQuery){
	        jQuery("#zentweet<?php echo $moduleID ?>").tweet({
	          username: "<?php echo $twitterUsername ?>",
	          avatar_size: <?php echo $twitterAvatarSize ?>,
	          count: <?php echo $twitterCount ?>,
		      list: null,                               // [string]   optional name of list belonging to username
		      favorites: false,                         // [boolean]  display the user's favorites instead of his tweets
		      query: null,                              // [string]   optional search query (see also: http://search.twitter.com/operators)
		      fetch: null,                              // [integer]  how many tweets to fetch via the API (set this higher than 'count' if using the 'filter' option)
		      page: 1,                                  // [integer]  which page of results to fetch (if count != fetch, you'll get unexpected results)
		      retweets: true,                           // [boolean]  whether to fetch (official) retweets (not supported in all display modes)
		 	  loading_text: null,                       // [string]   optional loading text, displayed while tweets load
		      refresh_interval: <?php echo $twitterRefresh ?>,                  // [integer]  optional number of seconds after which to reload tweets
		      template: "{avatar}<div class='tweetWrap'>{text}</div>{time}{join}",   // [string or function] template used to construct each tweet <li> - see code for available vars
	          loading_text: "loading tweets..."
	        });
	      });
		</script>

		
