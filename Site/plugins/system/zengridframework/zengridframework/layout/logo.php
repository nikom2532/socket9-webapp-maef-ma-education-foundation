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
if(file_exists( JPATH_ROOT."/templates/$this->template/layout/logo.php")) 
{ 
	require(JPATH_ROOT."/templates/$this->template/layout/logo.php");   
}
else { ?>
	<div id="logo" class="grid_<?php echo $logoCols; ?> <?php echo $logoAlign ?>" style="margin-left:<?php echo $logoLeft ?>;margin-top:<?php echo $logoTop ?>">
		<div id="logoinner">
			<<?php echo $logoClass; ?>>
				<a href="<?php echo $logoLink ?>" <?php if ($logoType =="text") { ?>class="<?php echo $fontStackLogo ?>" style="font-size:<?php echo $logoFontSize ?>" <?php } ?>>
					<?php if ($logoType =="image" && $isOnward && $logoFile !=="tempLogo.png") { 
						// Logo Image in J1.7+ ?>
						<img src="<?php echo $logoFile; ?>" alt="<?php echo $logoAltTag ;?>" />
					<?php } 
					elseif ($logoType =="image" && $isOnward && $logoFile =="tempLogo.png") { 
						// Temp path for template package ?>
						<img src="templates/<?php echo $this->template; ?>/images/logo/logo.png" alt="<?php echo $logoAltTag ;?>" />		
					<?php }
						  elseif ($logoType =="image" && $isPresent) { 
							// Logo Image in J1.5 ?>
								<img src="<?php echo $this->baseurl.$logoLocation.'/'.$logoFile; ?>" alt="<?php echo $logoAltTag ;?>" />
					<?php } ?>
				
					<?php if ($logoType =="text") { 
						if(($zenTranslate)) {
									echo $logoText;
								} 
								else {
									echo JText::_("LOGOTEXT");
								} 
						} ?>								
				</a>
			</<?php echo $logoClass; ?>>
			
		<?php if ($enableTagline) { ?>
			<div id="tagline">
				<?php if($debug) { echo $taglinedebug; } ?>
				<span style="margin-left:<?php echo $taglineLeft ?>;margin-top:<?php echo $taglineTop ?>;"><?php echo $tagline ?></span>
			</div>
		<?php 

			} ?>
		</div>
	</div>
<?php } ?>