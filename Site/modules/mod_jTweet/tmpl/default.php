<?php
/**
* @id $Id$
* @author  Joomla Bamboo
* @package  jTweet
* @copyright Copyright (C) 2006 - 2010 Joomla Bamboo. http://www.joomlabamboo.com  All rights reserved.
* @license  GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
*/
defined( '_JEXEC' ) or die( 'Restricted access' );?>
<?php
// Load css and script references into the head
if($scripts) {
	if(!$zgf) {
		if($cache) {?>
			<link rel="stylesheet" href="<?php echo $modbase ?>css/jTweet.css" type="text/css" />
			<script type="text/javascript" src="<?php echo $modbase?>js/jquery.tweet.js"></script>
		<?php }
	} 
} ?>

<script type="text/javascript">
		<?php echo $tweetScript; ?>
	</script>

<script type="text/javascript">
	jQuery(document).ready(function () {
	  jQuery('.bubbleInfo').each(function () {
		// options
		var distance = 10;
		var time = 250;
		var hideDelay = 500;
		var hideDelayTimer = null;
		// tracker
		var beingShown = false;
		var shown = false;
		var trigger = jQuery('.trigger', this);
		var popup = jQuery('.popup', this).css('opacity', 0);
		// set the mouseover and mouseout on both element
		jQuery([trigger.get(0), popup.get(0)]).mouseover(function () {
		  // stops the hide event if we move from the trigger to the popup element
		  if (hideDelayTimer) clearTimeout(hideDelayTimer);
		  // don't trigger the animation again if we're being shown, or already visible
		  if (beingShown || shown) {
			return;
		  } else {
			beingShown = true;
			// reset position of popup box
			popup.css({
			  top: -20,
			  left: 90,
			  display: 'block' // brings the popup back in to view
			})
			// (we're using chaining on the popup) now animate it's opacity and position
			.animate({
			  top: '-=' + distance + 'px',
			  opacity: 1
			}, time, 'swing', function() {
			  // once the animation is complete, set the tracker variables
			  beingShown = false;
			  shown = true;
			});
		  }
		}).mouseout(function () {
		  // reset the timer if we get fired again - avoids double animations
		  if (hideDelayTimer) clearTimeout(hideDelayTimer);
		  // store the timer so that it can be cleared in the mouseover if required
		  hideDelayTimer = setTimeout(function () {
			hideDelayTimer = null;
			popup.animate({
			  top: '-=' + distance + 'px',
			  opacity: 0
			}, time, 'swing', function () {
			  // once the animate is complete, set the tracker variables
			  shown = false;
			  // hide the popup entirely after the effect (opacity alone doesn't do the job)
			  popup.css('display', 'none');
			});
		  }, hideDelay);
		});
	  });
	});
</script>
<!-- Start Joomla Bamboo jTweet -->
<div class="jTweet">
    <?php if ($popup == "yes") :?>
    <div class="jTweetInfo">
        <div class="bubbleInfo">
            <div class="trigger">
                <?php if(!($twitterBird == "none")) :?>
                <img src="modules/mod_jTweet/images/<?php echo $twitterBird ?>.png" alt="twitter Bird" />
                <?php endif;?>
                <span class="triggerDetail"><?php echo $moreInfo ?></span> </div>
            <div class="popup"></div>
        </div>
    </div>
    <?php endif;?>
    <div class="tweet tweet<?php echo $moduleID;?>"> </div>
    <?php if (!($popup == "yes")) :?>
    <div class="noPopup">
        <?php if(!($twitterBird == "none")) :?>
        <img src="modules/mod_jTweet/images/<?php echo $twitterBird ?>.png" alt="twitter Bird" />
        <?php endif;?>
        <?php if($follow == "yes") :?>
        <span class="triggerDetail"><a target="_blank" href="http://twitter.com/<?php echo $userName ?>/"><?php echo $followMeText ?></a></span>
        <?php endif;?>
    </div>
    <?php endif;?>
</div>
<div class="jTweetClear"></div>
<!-- End Joomla Bamboo jTweet -->