<?php // @version $Id: default.php$
defined('_JEXEC') or die('Restricted access');

/**
 * @package		Joomla Bamboo Zen Grid Framework
 * @Type        Core Framework Files
 * @version		v2.0
 * @author		Joomal Bamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2010 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

/***********************************************************************************************************************
 * 
 *  User override for 1.5. J1.7 uses com_users
 * 
**********************************************************************************************************************/

?>
<?php if($this->params->get('show_page_title',1)) : ?>
<h2 class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')) ?>">
	<?php echo $this->escape($this->params->get('page_title')) ?>
</h2>
<?php endif; ?>
<form action="<?php echo JRoute::_( 'index.php?option=com_user&task=remindusername' ); ?>" method="post" class="josForm form-validate">
	<p><?php echo JText::_('REMIND_USERNAME_DESCRIPTION'); ?></p>

	<label for="email" class="hasTip" title="<?php echo JText::_('REMIND_USERNAME_EMAIL_TIP_TITLE'); ?>::<?php echo JText::_('REMIND_USERNAME_EMAIL_TIP_TEXT'); ?>"><?php echo JText::_('Email Address'); ?>:</label>
	<input id="email" name="email" type="text" class="required validate-email" />

	<button type="submit" class="validate zenbutton"><span><?php echo JText::_('Submit'); ?></span></button>
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
