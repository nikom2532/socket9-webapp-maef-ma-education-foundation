<?php
// @version $Id: default.php 10381 2008-06-01 03:35:53Z pasamio $
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
 *  User override for 1.5. J1.7 uses articles_latest
 * 
**********************************************************************************************************************/

if (substr(JVERSION, 0, 3) == '1.5') {

?>

<h4><?php echo $poll->title; ?></h4>
<form name="form2" method="post" action="index.php" class="poll">
	<fieldset>
		<?php for ($i = 0, $n = count($options); $i < $n; $i++) : ?>
		<input type="radio" name="voteid" id="voteid<?php echo $options[$i]->id; ?>" value="<?php echo $options[$i]->id; ?>" alt="<?php echo $options[$i]->id; ?>" />
		<label for="voteid<?php echo $options[$i]->id; ?>">
			<?php echo $options[$i]->text; ?>
		</label>
		<br />
		<?php endfor; ?>
	</fieldset>

	<input type="submit" name="task_button" class="button" value="<?php echo JText::_('Vote'); ?>" />
	<a href="<?php echo JRoute::_('index.php?option=com_poll&id='.$poll->slug.$itemid.'#content'); ?>">
		<?php echo JText::_('Results'); ?></a>

	<input type="hidden" name="option" value="com_poll" />
	<input type="hidden" name="id" value="<?php echo $poll->id; ?>" />
	<input type="hidden" name="task" value="vote" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
<?php } ?>
