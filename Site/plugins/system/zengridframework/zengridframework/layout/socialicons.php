<?php
/**
 * @package		Joomla Bamboo Zen Grid Framework
 * @version		v2.0
 * @author		Joomlabamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2010 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * The Zen Grid Framework is a templating framework that uses the Joomla Content Manament System (http://www.joomla.org)
 * This file is called if the banner layout override is enabled and is placed in the templates/[your template name]/layout folder. 
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );
?>
	<div id="socialicons" class="<?php echo $socialalign ?> <?php echo $socialiconsposition ?>">
		<?php if ($socialiconstitle !="") {?>
			<h3><span><?php echo $socialiconstitle ?></span></h3>
		<?php } ?>
		<ul>
		<!-- Social Icons -->
		<?php if ($icon1Image !="-1") {?>
		<li><a class="topicons icon1" target="_blank" href="<?php echo $icon1Link ?>">
			<img src="templates/<?php echo $this->template ?>/images/icons/<?php echo $icon1Image ?>"  title="<?php echo $icon1Image ?>" alt="<?php echo $icon1Image ?>"/>
		</a></li>																
		<?php } ?>

		<?php if ($icon2Image !="-1") {?>
		<li><a class="topicons icon2" target="_blank" href="<?php echo $icon2Link ?>">
				<img src="templates/<?php echo $this->template ?>/images/icons/<?php echo $icon2Image ?>" title="<?php echo $icon2Image ?>" alt="<?php echo $icon2Image ?>"/>
		</a></li>
		<?php } ?>									

		<?php if ($icon3Image !="-1") {?>
		<li><a class="topicons icon3" target="_blank" href="<?php echo $icon3Link ?>">
				<img src="templates/<?php echo $this->template ?>/images/icons/<?php echo $icon3Image ?>" title="<?php echo $icon3Image ?>"  alt="<?php echo $icon3Image ?>"/>
		</a></li>
		<?php } ?>

		<?php if ($icon4Image !="-1") {?>
		<li><a class="topicons icon4" target="_blank" href="<?php echo $icon4Link ?>">
				<img src="templates/<?php echo $this->template ?>/images/icons/<?php echo $icon4Image ?>" title="<?php echo $icon4Image ?>"  alt="<?php echo $icon4Image ?>"/>
		</a></li>
		<?php } ?>

		<?php if ($icon5Image !="-1") {?>
		<li><a class="topicons icon5" target="_blank" href="<?php echo $icon5Link ?>">
				<img src="templates/<?php echo $this->template ?>/images/icons/<?php echo $icon5Image ?>" title="<?php echo $icon5Image ?>"  alt="<?php echo $icon5Image ?>"/>
		</a></li>
		<?php } ?>

		<?php if ($icon6Image !="-1") {?>
		<li><a class="topicons icon6" target="_blank" href="<?php echo $icon6Link ?>">
				<img src="templates/<?php echo $this->template ?>/images/icons/<?php echo $icon6Image ?>" title="<?php echo $icon6Image ?>"  alt="<?php echo $icon6Image ?>"/>
		</a></li>
		<?php } ?>
		</ul>
	</div>