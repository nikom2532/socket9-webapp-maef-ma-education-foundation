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

	<div id="logo" style="width:<?php echo $$logoCols; ?>px">

		<<?php echo $logoClass; ?>>
			<a href="<?php echo $this->baseurl.'/'.$logoLink ?>" <?php if ($logoType =="text") { ?>class="<?php echo $fontStackLogo ?>" style="font-size:<?php echo $logoFontSize ?>" <?php } ?>>
				<?php if ($logoType =="image") { ?><img src="<?php echo $this->baseurl.$logoLocation.'/'.$logoFile; ?>" alt="<?php echo $logoAltTag ;?>" /><?php } ?>
				<?php if ($logoType =="text") { echo $logoText; } ?>								
			</a>
		</<?php echo $logoClass; ?>>
			
	<?php if ($enableTagline) { ?>
		<div id="tagline">
			<span style="margin-left:<?php echo $taglineLeft ?>;margin-top:<?php echo $taglineTop ?>;"><?php echo $tagline ?></span>
		</div>
	<?php 

		} ?>
	</div>