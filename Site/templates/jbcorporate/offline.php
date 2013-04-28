<?php
/**
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

if (substr(JVERSION, 0, 3) >= '1.6') {
	$framework = JPATH_SITE.DS.'plugins'.DS.'system'.DS.'zengridframework'.DS.'zengridframework'.DS.'zengrid.php';
	$frameworkPath = JPATH_SITE.DS.'plugins'.DS.'system'.DS.'zengridframework'.DS.'zengridframework';
	$frameworkClass = JPATH_SITE.DS.'plugins'.DS.'system'.DS.'zengridframework'.DS.'zengridframework'.DS.'classes'.DS.'j17'.DS.'zengrid.php';
	require_once(JPATH_ROOT.DS.'plugins'.DS.'system'.DS.'zengridframework'.DS.'zengridframework'.DS.'functions'.DS.'vars.php');
}
else {
	$framework = JPATH_SITE.DS.'plugins'.DS.'system'.DS.'zengridframework'.DS.'zengrid.php';	
	$frameworkPath = JPATH_SITE.DS.'plugins'.DS.'system'.DS.'zengridframework';
	$frameworkClass = JPATH_SITE.DS.'plugins'.DS.'system'.DS.'zengridframework'.DS.'classes'.DS.'zengrid.php';
	require_once(JPATH_ROOT.DS.'plugins'.DS.'system'.DS.'zengridframework'.DS.'functions'.DS.'vars.php');
} ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<jdoc:include type="head" />
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/offline.css" type="text/css" />
</head>
<body>
<div id="offline">

	
			<div id="logo" style="width:<?php echo $$logoCols; ?>px">

				<<?php echo $logoClass; ?>>
					<a href="<?php echo $logoLink ?>" <?php if ($logoType =="text") { ?>class="<?php echo $fontStackLogo ?>" style="font-size:<?php echo $logoFontSize ?>" <?php } ?>>
						<?php if ($logoType =="image") { ?>
							<?php if ($logoType =="image" && $isOnward && $logoFile !=="tempLogo.png") { 
								// Logo Image in J1.7+ ?>
								<img src="<?php echo $logoFile; ?>" alt="<?php echo $logoAltTag ;?>" />
							<?php } 
							elseif ($logoType =="image" && $isOnward && $logoFile =="tempLogo.png") { 
								// Temp path for template package ?>
								<img src="templates/<?php echo $this->template; ?>/images/logo/logo.png" alt="<?php echo $logoAltTag ;?>" />		
							<?php } else { ?>
									<img src="<?php echo $this->baseurl.$logoLocation.'/'.$logoFile; ?>" alt="<?php echo $logoAltTag ;?>" />
							<?php }
							} ?>
						<?php if ($logoType =="text") { echo $logoText; } ?>								
					</a>
				</<?php echo $logoClass; ?>>

			
			</div>
	<p>
		<?php if (substr(JVERSION, 0, 3) >= '1.6') {
			echo $app->getCfg('offline_message');
		}
		else {
			echo $mainframe->getCfg('offline_message'); 
		} ?>
	</p>
	<?php if(JPluginHelper::isEnabled('authentication', 'openid')) : ?>
	<?php JHTML::_('script', 'openid.js'); ?>
<?php endif; ?>

<?php if (substr(JVERSION, 0, 3) >= '1.6') { ?>
<form action="<?php echo JRoute::_('index.php', true); ?>" method="post" id="form-login">
<fieldset class="input">
	<p id="form-login-username">
		<label for="username"><?php echo JText::_('JGLOBAL_USERNAME') ?></label>
		<input name="username" id="username" type="text" class="inputbox" alt="<?php echo JText::_('JGLOBAL_USERNAME') ?>" size="18" />
	</p>
	<p id="form-login-password">
		<label for="passwd"><?php echo JText::_('JGLOBAL_PASSWORD') ?></label>
		<input type="password" name="password" class="inputbox" size="18" alt="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" id="passwd" />
	</p>
	<p id="form-login-remember">
		<label for="remember"><?php echo JText::_('JGLOBAL_REMEMBER_ME') ?></label>
		<input type="checkbox" name="remember" class="inputbox" value="yes" alt="<?php echo JText::_('JGLOBAL_REMEMBER_ME') ?>" id="remember" />
	</p>
	<input type="submit" name="Submit" class="button" value="<?php echo JText::_('JLOGIN') ?>" />
	<input type="hidden" name="option" value="com_users" />
	<input type="hidden" name="task" value="user.login" />
	<input type="hidden" name="return" value="<?php echo base64_encode(JURI::base()) ?>" />
	<?php echo JHtml::_('form.token'); ?>
</fieldset>
</form>
<?php }
else { ?>
	
	<form action="index.php" method="post" name="login" id="form-login">
	<fieldset class="input">
		<div id="offlineuser">
			<label for="username"><?php echo JText::_('Username') ?></label><br />
			<input name="username" id="username" type="text" class="inputbox" alt="<?php echo JText::_('Username') ?>" size="18" />
		</div>
		<div id="offlinepass">
			<label for="passwd"><?php echo JText::_('Password') ?></label><br />
			<input type="password" name="passwd" class="inputbox" size="18" alt="<?php echo JText::_('Password') ?>" id="passwd" />
		</div>
		<div class="clear"></div>
			
			<input type="checkbox" name="remember" class="inputbox" value="yes" alt="<?php echo JText::_('Remember me') ?>" id="remember" /><?php echo JText::_('Remember me') ?>
		
		<span id="offlinebutton"><input type="submit" name="Submit" class="button" value="<?php echo JText::_('LOGIN') ?>" /></span>
	</fieldset>
	<input type="hidden" name="option" value="com_user" />
	<input type="hidden" name="task" value="login" />
	<input type="hidden" name="return" value="<?php echo base64_encode(JURI::base()) ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
	</form>
	<?php } ?>
	
		<jdoc:include type="message" />
</div>	
</body>
</html>