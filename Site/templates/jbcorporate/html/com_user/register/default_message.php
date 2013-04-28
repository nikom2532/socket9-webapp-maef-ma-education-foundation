<?php // @version $Id: default_message.php 11917 2009-05-29 19:37:05Z ian $
defined( '_JEXEC' ) or die( 'Restricted access' );

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

<h3>
	<?php echo $this->escape($this->message->title); ?>
</h3>

<p class="message">
	<?php echo $this->escape($this->message->text); ?>
</p>
